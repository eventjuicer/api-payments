<?php

namespace App\Models;

use Database\Factories\PaymentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $casts = [
        'purchases' => 'json'
    ];

    use HasFactory;

    protected static function newFactory()
    {
        return new PaymentFactory();
    }
}
