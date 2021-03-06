<?php

namespace App\Console\Commands;

use App\Mail\ThreeDaysBeforeExpireMail;
use App\Mail\WelcomeMemberMail;
use App\Models\GymMember;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class ThreeDaysBeforeExpireMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memberships:check_expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            $expireDate = now()->addDays(3)->format('y-m-d');
            $expiredMembers = GymMember::where('expire_date', '=', $expireDate)->get();
            foreach ($expiredMembers as $member) {
                $email = $member->email;
                Mail::to($email)
                    ->send(new ThreeDaysBeforeExpireMail());
            }
        return 0;
    }
}
