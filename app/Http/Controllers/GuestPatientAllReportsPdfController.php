<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Services\PatientAllReportsPdf;
use Symfony\Component\HttpFoundation\Response;

class GuestPatientAllReportsPdfController extends Controller
{
    public function __invoke(string $invoice_number, PatientAllReportsPdf $pdf): Response
    {
        $patient = Patient::query()
            ->where('receipt_no', $invoice_number)
            ->firstOrFail();

        return $pdf->response($patient, 'attachment');
    }
}
