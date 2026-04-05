<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreHmsLabCaseRequest;
use App\Models\Patient;
use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class HmsLabCaseController extends Controller
{
    public function catalog(): JsonResponse
    {
        $rows = Test::query()->orderBy('code')->get();

        return response()->json([
            'tests' => $rows->map(function (Test $t) {
                $row = [
                    'id' => $t->id,
                    'code' => $t->code,
                    'name' => $t->name,
                    'price' => $t->price,
                ];
                if (array_key_exists('department', $t->getAttributes())) {
                    $row['department'] = $t->department;
                }

                return $row;
            })->values(),
        ]);
    }

    public function store(StoreHmsLabCaseRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $receiptNo = filled($validated['invoice_number'] ?? null)
            ? $validated['invoice_number']
            : $validated['receipt_no'];

        $codes = $validated['test_codes'];
        $missing = [];
        $testIds = [];

        foreach ($codes as $code) {
            $codeKey = self::normalizeTestCode($code);
            $test = Test::query()->where('code', $codeKey)->first();

            if (! $test) {
                $missing[] = $code;
            } else {
                $testIds[] = $test->id;
            }
        }

        if ($missing !== []) {
            return response()->json([
                'message' => 'One or more test codes were not found.',
                'missing_test_codes' => array_values(array_unique($missing, SORT_REGULAR)),
            ], 422);
        }

        $testIds = array_values(array_unique($testIds));

        $patient = DB::transaction(function () use ($validated, $receiptNo, $testIds) {
            $patient = Patient::create([
                'name' => $validated['name'],
                'age' => $validated['age'] ?? null,
                'age_unit' => $validated['age_unit'] ?? 'Year',
                'phone' => $validated['phone'] ?? null,
                'gender' => $validated['gender'],
                'receipt_no' => $receiptNo,
                'doctor' => 'Self',
            ]);

            $patient->tests()->attach($testIds);

            return $patient;
        });

        return response()->json([
            'message' => 'Lab case created.',
            'patient_id' => $patient->id,
            'invoice_url' => URL::signedRoute('guest.invoice', ['patient' => $patient]),
        ], 201);
    }

    private static function normalizeTestCode(int|float|string $code): string
    {
        if (is_string($code)) {
            return preg_replace('/\s+/', '', trim($code));
        }

        return (string) (int) $code;
    }
}
