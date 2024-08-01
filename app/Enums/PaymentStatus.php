<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case OPEN = 'open';
    case PAID = 'paid';
    case FAILED = 'failed';
}
