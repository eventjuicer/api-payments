<?php

namespace App\Enums\PaymentGates\Mollie;

enum WebhookStatus: string
{
    case PAID = 'paid';
    case OPENED = 'open';
    case PENDING = 'pending';
    case AUTHORIZED = 'authorized';
    case EXPIRED = 'expired';
    case FAILED = 'failed';
    case CANCELED = 'canceled';
}
