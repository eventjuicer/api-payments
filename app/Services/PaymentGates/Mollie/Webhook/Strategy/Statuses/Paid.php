<?php

namespace App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses;

use App\Events\PaymentWasPaid;
use Mollie\Api\Resources\Payment;

class Paid extends Status implements StatusInterface
{
    public function handle(Payment $payment): void
    {
        parent::handle($payment);

        event(new PaymentWasPaid($payment));
    }
}
