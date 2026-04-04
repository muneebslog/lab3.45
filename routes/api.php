<?php

use App\Http\Controllers\Api\HmsLabCaseController;
use App\Http\Middleware\VerifyHmsApiToken;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:60,1', VerifyHmsApiToken::class])->group(function (): void {
    Route::post('/hms/lab-cases', [HmsLabCaseController::class, 'store']);
});
