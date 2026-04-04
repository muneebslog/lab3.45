<?php

namespace App\Http\Controllers;

use App\Models\PatientTest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class ReportWithHeaderPdfController extends Controller
{
    public function __invoke(PatientTest $patientTest)
    {
        $data = PatientTest::query()
            ->with([
                'patient',
                'test',
                'testResults.testField.normalRanges',
            ])
            ->findOrFail($patientTest->id);

        $filename = 'lab-report-'.Str::slug($data->patient->name ?? 'patient').'-'.$data->id.'.pdf';

        return Pdf::loadView('reports.report-with-header-pdf', ['data' => $data])
            ->setPaper('a4', 'portrait')
            ->download($filename);
    }
}
