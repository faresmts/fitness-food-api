<?php

namespace App\Console;

use App\Console\Commands\ProductsDatabaseUpdateCommand;
use App\Models\SystemEnv;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ProductsDatabaseUpdateCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        /** @var SystemEnv $systemEnv */
        $systemEnv = SystemEnv::where('version', '=', SystemEnv::CURRENT_SYSTEM_VERSION)->first();
        $schedule->command('products_database:update')->dailyAt($systemEnv->update_hour);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
