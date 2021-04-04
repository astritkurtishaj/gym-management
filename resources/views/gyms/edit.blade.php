@extends('layouts.app')
@section('content')

    <h1>Formulari per Editimin e Antarit</h1>
    <form class="col-6 m-auto" method="POST" action="{{ url("members/$member->id") }}" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        <div class="mb-3">
            <label for="first_name" class="form-label">Emri</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $member->first_name }}" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Mbiemri</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $member->last_name }}" required>
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">Data Lindjes</label>
            <input type="date" class="form-control" id="birthdate"  name="birthdate" value="{{ $member->birthdate->toDateString() }}" required>
        </div>
        <div class="mb-3">
            <label for="expire_date" class="form-label">Data Skadimit</label>
            <input type="date" class="form-control" id="expire_date" name="expire_date" value="{{ $member->expire_date->toDateString() }}" required>
        </div>

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Foto</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
        </div>

        <button class="btn btn-primary" type="submit">Ruaj</button>
    </form>
@stop
