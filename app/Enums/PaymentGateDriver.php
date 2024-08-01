<?php

namespace App\Enums;

enum PaymentGateDriver: string
{
    case MOLLIE = 'mollie';
    case STRIPE = 'stripe';
}
