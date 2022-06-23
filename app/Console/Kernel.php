<?php

   

namespace App\Console;

    

use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

    

class Kernel extends ConsoleKernel

{

    /**

     * Команды Artisan, предоставленные вашим приложением.

     *

     * @var array

     */

    protected $commands = [

        Commands\DemoCron::class,

    ];

     

    /**

     * Определение расписания выполнения команд.

     *

     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule

     * @return void

     */

    protected function schedule(Schedule $schedule)

    {

        $schedule->command('demo:cron')->everyMinute();

    }

     

    /**

     * Регистрация команд приложения.

     *

     * @return void

     */

    protected function commands()

    {

        $this->load(__DIR__.'/Commands');

     

        require base_path('routes/console.php');

    }

}