<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    

    protected $commands = [
        \App\Console\Commands\SendWeeklyNewsletter::class,
    ];

    public function schedule(Schedule $schedule): void
    {
        date_default_timezone_set('Asia/Jakarta');
        $schedule->command('send:weekly-newsletter')
                ->everyMinute()
                //->dailyAt('15:21')
                ->timezone('Asia/Jakarta');
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
