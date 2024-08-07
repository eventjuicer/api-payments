<?php

use App\Http\Controllers\PaymentGates\Mollie\Webhooks\WebhookController;
use Illuminate\Support\Facades\Route;

Route::post('payment_gates/mollie/webhook', WebhookController::class)->name('payment_gates.mollie.webhook');

