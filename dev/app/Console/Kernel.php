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
        //
        // Commands\SendMailNotificationSeguimiento::class,
        // Commands\SendMailNotificationActividades::class
        'App\Console\Commands\SendMailNotificationActividades',
        'App\Console\Commands\SendMailNotificationSeguimiento'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sendMailSeguimiento:notification')
                    ->dailyAt('06:00');

        $schedule->command('sendMailActividades:notification')
                    ->dailyAt('06:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
