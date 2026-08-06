<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Services\PatientAllReportsPdf;
use Symfony\Component\HttpFoundation\Response;

class PatientAllReportsPdfController extends Controller
{
    public function __invoke(Patient $patient, PatientAllReportsPdf $pdf): Response
    {
        return $pdf->response($patient, 'inline');
    }
}
