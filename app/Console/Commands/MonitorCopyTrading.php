<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MonitorCopyTrading extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy-trading:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor master accounts for new trades and replicate them to subscribers.';

    /**
     * Execute the console command.
     */
    public function handle(\App\Services\CopyTradingEngine $engine)
    {
        $this->info('Starting copy trading monitor...');

        // Get all active master accounts that have at least one active subscriber
        $masterAccounts = \App\Models\CopyTradeRelationship::where('status', 'ACTIVE')
            ->distinct()
            ->pluck('master_account_id');

        foreach ($masterAccounts as $masterId) {
            try {
                $this->info("Checking master account: {$masterId}");
                $engine->monitorMasterAccount($masterId);
            } catch (\Exception $e) {
                $this->error("Failed to monitor master {$masterId}: {$e->getMessage()}");
            }
        }

        $this->info('Copy trading monitor check complete.');
    }
}
