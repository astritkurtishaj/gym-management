<?php


namespace App\Http\Controllers;


use App\Mail\DeletedMembers;
use App\Mail\ExpiredMembersMail;
use App\Mail\ThreeDaysBeforeExpireMail;
use App\Mail\TwoDaysBeforeExpireMail;
use App\Mail\WelcomeMemberMail;
use App\Models\GymMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class GymController extends \Illuminate\Routing\Controller
{
    public function index() {

        $members = GymMember::latest()->get();

        return view('gyms.index', [ 'members' => $members ]);
    }

    public function create() {
        return view('gyms.create');
    }

    public function store(Request $request) {

        $attributions = $request->only('first_name', 'last_name', 'email', 'birthdate', 'expire_date');

        if ($picture = $request->file('profile_picture')) {
            $path = str_replace("public/", "", $picture->store('public/'));
            $attributions['profile_picture'] = $path;
        }
        $member = GymMember::create($attributions);

        $email = $request->get('email');
        $send_time = now()->addMinutes(2);
        Mail::to($email)
            ->later($send_time, new WelcomeMemberMail());
        return redirect('/')->with('member', $member);
    }

    public function edit($id) {

        $member = GymMember::findOrFail($id);

        return view('gyms.edit', ['member' => $member]);
    }

    public function update($id, Request $request) {

        $member = GymMember::findOrFail($id);

        $attributions = $request->only('first_name', 'last_name', 'birthdate', 'expire_date');

        if ($picture = $request->file('profile_picture')) {
            $path = str_replace("public/", "", $picture->store('public/'));
            $attributions['profile_picture'] = $path;
        }

        $member->update($attributions);

        return redirect('/members');
    }

    public function destroy($id) {
        $member = GymMember::findOrFail($id);

        $member->delete();
        $email = $member->email;
        Mail::to($email)
            ->send(new DeletedMembers());
        return redirect('/members');
    }

    public function twoDaysBeforeExpireMailSender(){
        $expireDate = now()->addDays(2)->format('y-m-d');
        $expiredMembers = GymMember::where('expire_date', '=', $expireDate)->get();
        foreach ($expiredMembers as $member) {
            $email = $member->email;
            Mail::to($email)
                ->send(new TwoDaysBeforeExpireMail());
        }
    }

    public function threeDaysBeforeExpireMailSender(){
        $expireDate = now()->addDays(3)->format('y-m-d');
        $expiredMembers = GymMember::where('expire_date', '=', $expireDate)->get();

        foreach ($expiredMembers as $member) {
            $email = $member->email;
            Mail::to($email)
                ->send(new ThreeDaysBeforeExpireMail());
        }
    }

    public function membershipsExpired(){
        $expireDate = now()->format('y-m-d');
        $expiredMembers = GymMember::where('expire_date', '<', $expireDate)->get();
        foreach ($expiredMembers as $member) {
            $email = $member->email;
            Mail::to($email)
                ->send(new ExpiredMembersMail());
        }
    }


}
