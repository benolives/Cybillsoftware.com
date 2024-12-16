<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\payments\mpesa\MpesaController;

// This is the default route that comes with Laravel for authenticated users (not related to the callback).
Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
    return $request->user();
});

/*========================================================================================\
                                The Mpesa B2B/BUSINESS PAYBILL payment Routes... 
\*========================================================================================*/
Route::any('/b2bcallback', [MpesaController::class, 'b2BCallback'])->withoutMiddleware('verified');
Route::any('/timeoutUrl', [MpesaController::class, 'PaymentProcessTimeOut'])->withoutMiddleware('verified');
Route::any('/benolives/payment-callback', [MpesaController::class, 'benolivesPaymentCallback'])->withoutMiddleware('verified');
