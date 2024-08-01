<?php

namespace App\Http\Controllers\PaymentGates\Mollie;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class IndexPaymentController extends Controller
{
    public function __invoke()
    {

        return response()->json(['payments' => Payment::get()->toArray()]);
    }
}
