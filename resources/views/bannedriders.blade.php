@extends('master')

@section('title', 'Customers')

@section('content')
    <h3>Banned Riders</h3>


   

<br>


    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>E-mail</th>
                
            </tr>
            @foreach($bannedRiders as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                   <td><a href = "riders/profile/{{$user->id}}">{{ $user->name }}</a></td>  
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                  

                </tr>

            @endforeach


        </table>

    </div>

@endsection