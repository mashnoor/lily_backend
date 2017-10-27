@extends('master')

@section('title', 'Customers')

@section('content')
    <h3>Top Customers</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>E-mail</th>
                <th>No of Rides</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->cnt }}</td>

                </tr>

            @endforeach


        </table>

    </div>

@endsection