<?php

namespace Database\Factories;

use App\Enums\PaymentGateDriver;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'payment_id' => random_int(100,999),
            'pay_gate' => PaymentGateDriver::MOLLIE->value,
            'participant_id' => Str::random(12),
            'purchase_id' => Str::random(12),
            'status' => array_rand(PaymentStatus::cases()),
        ];
    }
}
