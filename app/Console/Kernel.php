<?php

namespace App\Console;

use App\Console\Commands\ThreeDaysBeforeExpireMemberships;
use App\Mail\ThreeDaysBeforeExpireMail;
use App\Mail\WelcomeMemberMail;
use App\Models\GymMember;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ThreeDaysBeforeExpireMemberships::class,
        Commands\TwoDaysBeforeExpireMembership::class,
        Commands\ExpiredMemberships::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('memberships:check_expire')->everyMinute();
        $schedule->command('two-days-before:expire')->everyMinute();
        $schedule->command('memberships:expired')->everyMinute();

//        $schedule->call(function () {
//            $expireDate = now()->addDays(3)->format('y-m-d');
//            $expiredMembers = GymMember::where('expire_date', '=', $expireDate)->get();
//            foreach ($expiredMembers as $member) {
//                $email = $member->email;
//                Mail::to($email)
//                    ->send(new ThreeDaysBeforeExpireMail());
//            }
//        })->everyMinute();
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
