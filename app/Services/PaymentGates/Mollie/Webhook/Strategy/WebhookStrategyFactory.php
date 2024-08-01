<?php

namespace App\Services\PaymentGates\Mollie\Webhook\Strategy;

use App\Enums\PaymentGates\Mollie\WebhookStatus;
use App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses\Canceled;
use App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses\Expired;
use App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses\Failed;
use App\Services\PaymentGates\Mollie\Webhook\Strategy\Statuses\Paid;
use Exception;
use Mollie\Api\Resources\Payment;

class WebhookStrategyFactory
{
    public static function createStrategy(Payment $payment)
    {
        return match (WebhookStatus::tryFrom($payment->status)) {
            WebhookStatus::PAID => new Paid(),
            WebhookStatus::EXPIRED => new Expired(),
            WebhookStatus::FAILED => new Failed(),
            WebhookStatus::CANCELED => new Canceled(),
            default => throw new Exception('This status ' . $payment->status . ' not exists')
        };
    }
}
