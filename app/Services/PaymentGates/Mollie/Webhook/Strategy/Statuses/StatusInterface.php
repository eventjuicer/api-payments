<?php

namespace App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses;

use Mollie\Api\Resources\Payment;

interface StatusInterface
{
    public function handle(Payment $payment): void;
}
