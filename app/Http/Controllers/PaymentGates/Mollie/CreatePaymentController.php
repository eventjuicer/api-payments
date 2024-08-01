<?php

namespace App\Http\Controllers\PaymentGates\Mollie;

use App\Enums\PaymentGateDriver;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentGates\Mollie\CreatePaymentRequest;
use App\Models\Payment;
use App\Services\Remotes\Contracts\MainRemoteRepositoryInterface;
use Illuminate\Support\Str;
use Mollie\Api\MollieApiClient;
use Throwable;

class CreatePaymentController extends Controller
{
    public function __construct(
        private MollieApiClient $mollie,
        private MainRemoteRepositoryInterface $mainRemoteRepository) {
    }

    public function __invoke(CreatePaymentRequest $request)
    {
        try {

            $purchases = $this->mainRemoteRepository->getPurchases($request->ids);

            $amounts = array_column($purchases, 'amount');
            $totalAmount = array_sum($amounts) / 100;

            $this->mollie->setApiKey(env('MOLLIE_KEY'));

            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => $purchases[0]['currency'],
                    "value" => number_format($totalAmount, 2)
                ],
                "description" => Str::random(15),
                "redirectUrl" =>env('MOLLIE_REDIRECT_URL'),
                "webhookUrl" => env('MOLLIE_WEBHOOK_URL') . "payment_gates/mollie/webhook",
                "metadata" => [],
            ]);

            $item = new Payment();
            $item->payment_id = $payment->id;
            $item->pay_gate = PaymentGateDriver::MOLLIE->value;
            $item->status = PaymentStatus::OPEN->value;
            $item->save();

            foreach($purchases as $purchase)
            {
                $item->purchases()->create(['purchase_id' => $purchase->id, 'data' => $purchase]);
            }

        } catch (Throwable $e) {
            dd($e);
        }

        return response()->json([
            'status' => 'created',
            'checkout_url' => $payment->getCheckoutUrl()
        ]);
    }
}
