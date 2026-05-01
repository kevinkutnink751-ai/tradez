<?php

namespace App\Listeners;

use App\Events\TradeSignalDetected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReplicateTradeSignalListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(TradeSignalDetected $event): void
    {
        $engine = app(\App\Services\CopyTradingEngine::class);
        $engine->replicateTradeSignal($event->signal);
    }
}
