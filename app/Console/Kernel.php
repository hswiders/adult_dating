<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
				$schedule->command('log:cron')->everyMinute();
				//$schedule->call('\App\Http\Controllers\Admin\ImportController@testing')->everyMinute();
				$schedule->command('ImportSportMovies:cron')->daily()->timezone('America/New_York');
				$schedule->command('ImportImdbID:cron')->hourly()->timezone('America/New_York');
				$schedule->command('ImportSportSeries:cron')->daily('03:00')->timezone('America/New_York');
				$schedule->command('ImportSportSeriesEpisode:cron')->daily('05:00')->timezone('America/New_York');
				$schedule->command('ImportMostWatch:cron')->weeklyOn(1, '1:00')->timezone('America/New_York');
				$schedule->command('ImportRetiringWatch:cron')->weeklyOn(1, '2:00')->timezone('America/New_York');
				$schedule->command('ImportMostWatchTvShows:cron')->weeklyOn(1, '3:00')->timezone('America/New_York');
				$schedule->command('ImportRetiringWatchTvShows:cron')->weeklyOn(1, '4:00')->timezone('America/New_York');
				$schedule->command('ImportCastForMovie:cron')->hourly()->timezone('America/New_York');
				$schedule->command('ImportCastForTv:cron')->hourly()->timezone('America/New_York');
				$schedule->command('ImportSportFromRapid:cron')->daily()->timezone('America/New_York');
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
