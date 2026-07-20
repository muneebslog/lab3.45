<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\GuestReportWithHeaderPdfController;
use App\Http\Controllers\LetterPadController;
use App\Http\Controllers\ReportWithHeaderPdfController;
use App\Http\Controllers\TestViewController;
use App\Livewire\AddResults;
use App\Livewire\EditReport;
use App\Livewire\GuestInvoice;
use App\Livewire\GuestPatientReports;
use App\Livewire\GuestShowReport;
use App\Livewire\Invoice;
use App\Livewire\ListCases;
use App\Livewire\NewformFilament;
use App\Livewire\NoHeaderShowReport;
use App\Livewire\PatientEdit;
use App\Livewire\PublicInvoice;
use App\Livewire\Reports;
use App\Livewire\ShowReport;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('my-reports', GuestPatientReports::class)
    ->middleware('throttle:30,1')
    ->name('guest.patient-reports');

Route::get('my-visit/{invoice_number}', GuestInvoice::class)
    ->middleware('throttle:60,1')
    ->name('guest.invoice');

Route::get('public/invoice/{invoice_number}', function (string $invoice_number) {
    return redirect()->route('guest.invoice', ['invoice_number' => $invoice_number], 301);
})->middleware('throttle:60,1')
    ->name('guest.public.invoice');

Route::get('my-report/{patientTest}/view', GuestShowReport::class)
    ->middleware(['signed', 'throttle:60,1'])
    ->name('guest.report.show');

Route::get('my-report/{patientTest}/pdf', GuestReportWithHeaderPdfController::class)
    ->middleware(['signed', 'throttle:30,1'])
    ->name('guest.report.pdf');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('admin/reports/{patientTest}/mark-printed', [DashboardController::class, 'markPrinted'])
        ->name('admin.reports.mark-printed');
    Route::post('admin/reports/{patientTest}/mark-result-added', [DashboardController::class, 'markResultAdded'])
        ->name('admin.reports.mark-result-added');

    Route::get('invoice/{id}', Invoice::class)->name('invoice');
    Route::get('caselist', ListCases::class)->name('cases-list');
    Route::get('reports', Reports::class)->name('reports.index');
    Route::get('newcase/', NewformFilament::class)->name('new-case');

    Route::get('test/addresults/{patientId}/{testId}', AddResults::class)
        ->middleware('lab.admin')
        ->name('addResults');

    Route::get('report/show/{id}', ShowReport::class)->name('showreport');
    Route::get('report/pdf/header/{patientTest}', ReportWithHeaderPdfController::class)
        ->middleware('throttle:30,1')
        ->name('report.pdf.header');
    Route::get('report/show/noheader/{id}', NoHeaderShowReport::class)->name('noheaderreport');
    Route::get('report/edit/{patientId}/{testId}', EditReport::class)
        ->middleware('lab.admin')
        ->name('editreport');

    Route::get('patient/edit/{id}', PatientEdit::class)
        ->middleware('lab.admin')
        ->name('patientEdit');

    Route::get('invoice/{invoiceId}/download', invoiceController::class)->name('invoiceDownload');
    Route::get('letterpad', LetterPadController::class)->name('letterpad');
    Route::get('report/view/{id}', TestViewController::class)->name('reportShow');
});

require __DIR__.'/auth.php';
