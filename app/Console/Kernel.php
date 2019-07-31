<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
   
    protected $commands = [
        //
    ];
    
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            DB::table('users')->update(['leads_daily' => 0] );
          })->everyMinute();
    }
    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
