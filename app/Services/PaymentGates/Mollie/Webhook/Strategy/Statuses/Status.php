<?php

namespace App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses;

use App\Models\Payment;

abstract class Status implements StatusInterface
{
    public function handle(\Mollie\Api\Resources\Payment $payment): void
    {
        $this->update($payment);
    }

    protected function update($payment)
    {
        $item = Payment::where('payment_id', $payment->id)->firstOrFail();
        $item->status = $payment->status;
        $item->save();
    }
}
