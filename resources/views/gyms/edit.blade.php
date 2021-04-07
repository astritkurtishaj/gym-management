@extends('layouts.app')
@section('content')

    <br>
    <div class="container m-auto col-5">
        <h3>Edit Gym Member Form</h3>
        <a href="{{url('members')}}">Back to main page</a>
    </div><br>
    <form class="col-6 m-auto" method="POST" action="{{ url("members/$member->id") }}" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $member->first_name }}" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $member->last_name }}" required>
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" class="form-control" id="birthdate"  name="birthdate" value="{{ $member->birthdate->toDateString() }}" required>
        </div>
        <div class="mb-3">
            <label for="expire_date" class="form-label">Expire Date</label>
            <input type="date" class="form-control" id="expire_date" name="expire_date" value="{{ $member->expire_date->toDateString() }}" required>
        </div>

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>
@stop
