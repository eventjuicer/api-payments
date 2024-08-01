<?php

namespace App\Services\PaymentGates\Mollie\Webhook;

use App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses\Status;
use Mollie\Api\Resources\Payment;

class WebhookContext
{
    public function __construct(private Status $status)
    {
    }

    public function handle(Payment $payment)
    {
        $this->status->handle($payment);
    }
}
