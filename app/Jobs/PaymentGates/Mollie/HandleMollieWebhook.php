<?php

namespace App\Jobs\PaymentGates\Mollie;

use App\Services\PaymentGates\Mollie\Webhook\Strategy\WebhookStrategyFactory;
use App\Services\PaymentGates\Mollie\Webhook\WebhookContext;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mollie\Api\Resources\Payment;

class HandleMollieWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Payment $payment)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $factory = WebhookStrategyFactory::createStrategy($this->payment);

        $context = new WebhookContext($factory);
        $context->handle($this->payment);
    }
}
