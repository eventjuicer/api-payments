<?php

namespace App\Http\Controllers\PaymentGates\Mollie\Webhooks;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentGates\Mollie\WebhookRequest;
use App\Jobs\PaymentGates\Mollie\HandleMollieWebhook;
use Illuminate\Support\Facades\Log;
use Mollie\Api\MollieApiClient;

class WebhookController extends Controller
{
    public function __construct(private MollieApiClient $mollie)
    {
    }

    public function __invoke(WebhookRequest $request)
    {
        try {
            Log::debug('Mollie.Webhook', $request->all());

            if ($request->get('id')) {
                $this->mollie->setApiKey(env('MOLLIE_KEY'));
                $payment = $this->mollie->payments->get($request->get('id'));

                dispatch(new HandleMollieWebhook($payment));
            }
        } catch (\Throwable $e) {
            Log::debug($e);
        }

        Log::debug('Mollie.Payment.Get', (array) $payment);

        return response()->json(['status' => 'success']);
    }
}
