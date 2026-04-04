<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportWithHeaderPdfController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\LetterPadController;
use App\Http\Controllers\QRcodeGenerateController;
use App\Http\Controllers\TestViewController;
use App\Livewire\AddResults;
use App\Livewire\EditReport;
use App\Livewire\GuestInvoice;
use App\Livewire\GuestPatientReports;
use App\Livewire\Invoice;
use App\Livewire\ListCases;
use App\Livewire\NewCase;
use App\Livewire\NewformFilament;
use App\Livewire\NoHeaderShowReport;
use App\Livewire\PatientEdit;
use App\Livewire\ShowReport;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('my-reports', GuestPatientReports::class)
    ->middleware('throttle:30,1')
    ->name('guest.patient-reports');

Route::get('my-visit/{patient}', GuestInvoice::class)
    ->middleware('throttle:60,1')
    ->name('guest.invoice');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route::get('newcase',NewCase::class)->name('new-case');

Route::get('invoice/{id}', Invoice::class)->name('invoice');
// Route::get('caselist',ListCases::class)->name('cases-list');
Route::get('caselist', ListCases::class)->name('cases-list');
// Route::get('test/add/results/{id}',AddResults::class)->name('addResults');
Route::get('test/addresults/{patientId}/{testId}', AddResults::class)->name('addResults');
Route::get('report/show/{id}', ShowReport::class)->name('showreport');
Route::get('report/pdf/header/{patientTest}', ReportWithHeaderPdfController::class)
    ->middleware('throttle:30,1')
    ->name('report.pdf.header');
Route::get('report/show/noheader/{id}', NoHeaderShowReport::class)->name('noheaderreport');
// Route::get('report/edit/',EditReport::class)->name('editreport');
Route::get('report/edit/{patientId}/{testId}', EditReport::class)->name('editreport');

Route::get('patient/edit/{id}', PatientEdit::class)->name('patientEdit');
Route::get('invoice/{invoiceId}/download', invoiceController::class)->name('invoiceDownload');
Route::get('letterpad', LetterPadController::class)->name('letterpad');
Route::get('report/view/{id}', TestViewController::class)->name('reportShow');
// Route::get('/qr', [QRcodeGenerateController::class,'qrcode']);
// Route::get('newcase/{id}', NewformFilament::class)->name('new-case');
Route::get('newcase/', NewformFilament::class)->name('new-case');

// Route::get('testing', NewformFilament::class);

require __DIR__.'/auth.php';
