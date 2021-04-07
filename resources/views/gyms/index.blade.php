@extends('layouts.app')
@section('content')
    <h1>All Gym Members </h1>

    <a class="btn btn-success mb-2" href="{{ url('/members/create') }}" role="button">Add New Member</a>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Birthdate</th>
            <th scope="col">Expire Date</th>
            <th scope="col">Profile Picture</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->first_name }}</td>
                    <td>{{ $member->last_name }}</td>
                    <td>{{ $member->birthdate->format('d.m.y') }}</td>
                    <td>{{ $member->expire_date->format('d.m.y') }}</td>
                    <td>
                        <img src="{{ $member->profile_picture_url }}" class="img-thumbnail" alt="...">
                    </td>
                    <td scope="col">

                        <form class="form-inline" method="post" action="{{ url("members/$member->id") }}">

                            @csrf
                            {{ method_field('DELETE') }}
                            <a class="btn btn-secondary" href="{{ url("members/$member->id/edit") }}">Edit</a>

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6"><p>No gym members</p></td>
                </tr>
            @endforelse

        </tbody>
    </table>
@stop
