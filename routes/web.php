<?php

use App\Http\Controllers\PaymentGates\Mollie\Webhooks\WebhookController;
use App\Http\Middleware\PaymentGates\Mollie\MollieWebhookMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('payment_gates/mollie/webhook', [WebhookController::class])->name('payment_gates.mollie.webhook')->middleware(MollieWebhookMiddleware::class);

