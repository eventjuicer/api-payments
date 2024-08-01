<?php

use App\Http\Controllers\PaymentGates\Mollie\CreatePaymentController;
use App\Http\Controllers\PaymentGates\Mollie\IndexPaymentByPurchasesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/payments', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('payments', CreatePaymentController::class)->name('payments.create');
Route::get('payments_by_purchases/{ids}', IndexPaymentByPurchasesController::class)->name('payments.index_by_purchases');
