<?php

namespace App\Console\Commands;

use App\Mail\ExpiredMembersMail;
use App\Mail\TwoDaysBeforeExpireMail;
use App\Models\GymMember;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ExpiredMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memberships:expired';

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

        $expireDate = now()->format('y-m-d');
        $expiredMembers = GymMember::where('expire_date', '<', $expireDate)->get();
        foreach ($expiredMembers as $member) {
            $email = $member->email;
            Mail::to($email)
                ->send(new ExpiredMembersMail());
        }
        return 0;
    }
}
