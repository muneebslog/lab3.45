<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY)->subWeek();
        $weekEnd = (clone $weekStart)->endOfWeek(Carbon::SUNDAY);

        $pendingTests = 0;
        $testsOrderedLastWeek = 0;
        $completedLastWeek = 0;

        if (Schema::hasTable('patient_test')) {
            $pendingQuery = DB::table('patient_test')->where('isResultAdded', 0);

            $ordersQuery = DB::table('patient_test');

            if (Schema::hasColumn('patient_test', 'created_at')) {
                $pendingQuery->whereBetween('created_at', [$weekStart, $weekEnd]);
                $ordersQuery->whereBetween('created_at', [$weekStart, $weekEnd]);
            } elseif (Schema::hasTable('patients')) {
                $pendingQuery
                    ->join('patients', 'patient_test.patient_id', '=', 'patients.id')
                    ->whereBetween('patients.created_at', [$weekStart, $weekEnd]);

                $ordersQuery
                    ->join('patients', 'patient_test.patient_id', '=', 'patients.id')
                    ->whereBetween('patients.created_at', [$weekStart, $weekEnd]);
            } else {
                $pendingQuery->whereRaw('1 = 0');
                $ordersQuery->whereRaw('1 = 0');
            }

            $pendingTests = (int) $pendingQuery->count();
            $testsOrderedLastWeek = (int) $ordersQuery->count();
        }

        $newPatientsLastWeek = Schema::hasTable('patients')
            ? (int) Patient::whereBetween('created_at', [$weekStart, $weekEnd])->count()
            : 0;

        if (Schema::hasTable('test_results') && Schema::hasColumn('test_results', 'created_at')) {
            $completedLastWeek = (int) DB::table('test_results')
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->selectRaw('COUNT(DISTINCT patient_test_id) as aggregate')
                ->value('aggregate');
        }

        return view('dashboard', compact(
            'weekStart',
            'weekEnd',
            'pendingTests',
            'testsOrderedLastWeek',
            'completedLastWeek',
            'newPatientsLastWeek',
        ));
    }
}
