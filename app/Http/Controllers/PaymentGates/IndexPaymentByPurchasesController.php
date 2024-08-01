<?php

namespace App\Http\Controllers\PaymentGates;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class IndexPaymentByPurchasesController extends Controller
{
    public function __invoke()
    {
        $ids = explode(',', request()->ids);

        return response()->json(['payments' => Payment::whereHas('purchases', function($q) use ($ids) {
            $q->whereIn('purchase_id', $ids);
        })->get()->toArray()]);
    }
}
