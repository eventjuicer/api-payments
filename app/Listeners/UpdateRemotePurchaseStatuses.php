<?php

namespace App\Listeners;

use App\Events\PaymentWasPaid;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateRemotePurchaseStatuses
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentWasPaid $event): void
    {
        Log::debug('update remote purchaces status');
    }
}
