<?php


namespace App\Http\Controllers;


use App\Models\GymMember;
use Illuminate\Http\Request;

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

        $attributions = $request->only('first_name', 'last_name', 'birthdate', 'expire_date');

        if ($picture = $request->file('profile_picture')) {
            $path = str_replace("public/", "", $picture->store('public/'));
            $attributions['profile_picture'] = $path;
        }

        $member = GymMember::create($attributions);

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

        return redirect('/members');
    }
}
