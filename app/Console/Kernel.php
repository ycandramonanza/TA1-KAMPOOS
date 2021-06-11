<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\statusCron::class,
        Commands\labaCron::class,
        Commands\piutangCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // update transaksi setiap jam 12 malam
        $schedule->command('status:cron')
                           ->hourlyAt(23);;
        // menambahkan laba
        $schedule->command('laba:cron')
                           ->hourlyAt(22);
        // menambahkan piutang
          // menambahkan laba
          $schedule->command('piutang:cron')
          ->hourlyAt(22);
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
