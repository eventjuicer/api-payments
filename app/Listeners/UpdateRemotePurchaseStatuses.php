<?php

namespace App\Listeners;

use App\Events\PaymentWasPaid;
use App\Models\Payment;
use App\Services\Remotes\Contracts\MainRemoteRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateRemotePurchaseStatuses
{
    /**
     * Create the event listener.
     */
    public function __construct(private MainRemoteRepositoryInterface $mainRemoteRepository)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentWasPaid $event): void
    {
        $model = Payment::where('payment_id', $event->getPayment()->id)->firstOrFail();

        foreach($model->purchases as $purchase)
        {
            $this->mainRemoteRepository->updatePurchase($purchase->id);
            Log::debug('update remote purchaces status for' , $purchase->id );
        }
    }
}
