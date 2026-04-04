<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreHmsLabCaseRequest;
use App\Models\Patient;
use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HmsLabCaseController extends Controller
{
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
            $test = Test::query()
                ->where(function ($q) use ($code) {
                    $q->where('code', $code)->orWhere('short_hand', $code);
                })
                ->first();

            if (! $test) {
                $missing[] = $code;
            } else {
                $testIds[] = $test->id;
            }
        }

        if ($missing !== []) {
            return response()->json([
                'message' => 'One or more test codes were not found.',
                'missing_test_codes' => array_values(array_unique($missing)),
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
            'invoice_url' => url('/invoice/'.$patient->id),
        ], 201);
    }
}
