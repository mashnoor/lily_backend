@extends('master')

@section('title', 'Customers')

@section('content')
    <h3>Top Customers</h3>


    <div class="form-group">
        <h4>Search</h4>
        <form action="{{ url('/customerrides/search') }}" method="get">
            <input type="text" class="form-control" id="search"
                   placeholder="Search by User id, Name, Phone, Email or Share Code" name="search"/>
            <br>
            <button type="submit" class="btn btn-info">
                <span class="glyphicon glyphicon-search"></span> Search
            </button>
        </form>
        <br>


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
                        <td><a href="/profile/{{$user->id}}">{{ $user->name }}</a></td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->cnt }}</td>

                    </tr>

                @endforeach


            </table>

        </div>
    </div>

@endsection