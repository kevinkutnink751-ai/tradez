<?php

namespace App\Console;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Settings;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Monitor every minute (standard Laravel schedule limit, but can be simulated for 30s)
        $schedule->command('copy-trading:monitor')->everyMinute();

        // Virtual trades generated every minute, interval checks are done inside the command
        $schedule->command('generate:virtual-trades --action=cycle')->everyMinute();

        // Sync market prices twice a day (e.g. 1am and 1pm)
        $schedule->command('assets:sync-prices')->twiceDaily(1, 13);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
