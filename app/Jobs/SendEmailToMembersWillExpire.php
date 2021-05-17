<?php

namespace App\Jobs;

use App\Mail\WelcomeMemberMail;
use App\Models\GymMember;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToMembersWillExpire implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $expireDate = now()->addDays(3);
        $expiredMembers = GymMember::where('expire_date', '=', $expireDate)->get();

        foreach ($expiredMembers as $member) {
            $email = $member->email;
            Mail::to($email)
                ->subject("Your membership will expire in 3 days.")
                ->send(new WelcomeMemberMail());
        }
    }
}
