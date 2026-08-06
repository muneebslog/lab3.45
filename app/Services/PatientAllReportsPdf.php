<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\PatientTest;
use Barryvdh\DomPDF\Facade\Pdf;
use iio\libmergepdf\Merger;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PatientAllReportsPdf
{
    /**
     * @return Collection<int, PatientTest>
     */
    public function completedReports(Patient $patient): Collection
    {
        return PatientTest::query()
            ->with([
                'patient',
                'test',
                'testResults.testField.normalRanges',
            ])
            ->where('patient_id', $patient->id)
            ->where('isResultAdded', 1)
            ->orderBy('id')
            ->get();
    }

    /**
     * @param  Collection<int, PatientTest>  $reports
     */
    public function merge(Collection $reports): string
    {
        $merger = new Merger;

        foreach ($reports as $report) {
            $pdf = Pdf::loadView('reports.report-with-header-pdf', [
                'data' => $report,
            ])
                ->setPaper('a4', 'portrait')
                ->output();

            $merger->addRaw($pdf);
        }

        return $merger->merge();
    }

    public function filename(Patient $patient): string
    {
        return 'lab-reports-'.Str::slug($patient->name ?? 'patient').'-'.$patient->receipt_no.'.pdf';
    }

    public function response(Patient $patient, string $disposition = 'inline'): Response
    {
        $reports = $this->completedReports($patient);

        abort_if($reports->isEmpty(), 404, 'No completed reports available.');

        foreach ($reports as $report) {
            $report->markAsPrinted();
        }

        $filename = $this->filename($patient);
        $contentDisposition = $disposition === 'attachment'
            ? 'attachment; filename="'.$filename.'"'
            : 'inline; filename="'.$filename.'"';

        return response($this->merge($reports), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => $contentDisposition,
        ]);
    }
}
