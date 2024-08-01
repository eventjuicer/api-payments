<?php

namespace App\Http\Controllers\PaymentGates\Mollie;

use App\Enums\PaymentGateDriver;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentGates\Mollie\CreatePaymentRequest;
use App\Models\Payment;
use Illuminate\Support\Str;
use Mollie\Api\MollieApiClient;
use Throwable;

class CreatePaymentController extends Controller
{
    public function __construct(private MollieApiClient $mollie) {
    }

    public function __invoke(CreatePaymentRequest $request)
    {
        try {

            $this->mollie->setApiKey(env('MOLLIE_KEY'));

            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => rand(1,10) . ".00"
                ],
                "description" => Str::random(15),
                "redirectUrl" => "http://onet.pl",
                "webhookUrl" => "https://weci.pl/payment_gates/mollie/webhooks",
                "metadata" => [],
            ]);

            $item = new Payment();
            $item->payment_id = $payment->id;
            $item->participant_id = $request->participant_id;
            $item->pay_gate = PaymentGateDriver::MOLLIE->value;
            $item->purchase_id = $request->purchase_id;
            $item->status = PaymentStatus::OPEN->value;
            $item->save();

        } catch (Throwable $e) {
            dd($e);
        }

        return response()->json([
            'status' => 'created',
            'checkout_url' => $payment->getCheckoutUrl()
        ]);
    }
}
