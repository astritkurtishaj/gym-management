@extends('layouts.app')
@section('content')
    <h1>Contact Page </h1>

    <a class="btn btn-primary" href="{{ url('/members/create') }}" role="button">Add New Member</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Emri</th>
            <th scope="col">Mbiemri</th>
            <th scope="col">Datelindja</th>
            <th scope="col">Data Skadimit</th>
            <th scope="col">Fotografia</th>
            <th scope="col">Veprimet </th>
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
                            <a class="btn btn-success" href="{{ url("members/$member->id/edit") }}">Edito</a>

                            <button type="submit" class="btn btn-danger">Fshije</button>
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
