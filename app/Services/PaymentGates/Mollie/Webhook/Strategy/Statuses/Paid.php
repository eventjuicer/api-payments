<?php

namespace App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses;

use Mollie\Api\Resources\Payment;

class Paid extends Status implements StatusInterface
{
    public function handle(Payment $payment): void
    {
        parent::handle($payment);
        //sht else ex. request to MAIN
    }
}
