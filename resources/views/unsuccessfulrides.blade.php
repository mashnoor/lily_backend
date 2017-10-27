@extends('master')

@section('title', 'Unsuccessful Rides')

@section('content')
    <h2>Unsuccessful Rides</h2>
    <h3>Today Detail ({{ $date }})</h3>

    <h5>Total Unsuccessful Rides Today = {{ $totalUnsuccessfulToday }}</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>User Customer ID</th>
                <th>User Rider ID</th>
                <th>Date</th>
                <th>Reason</th>

            </tr>
            @foreach($toadyUnsuccessfuls as $todayUnsuccessful)
                <tr>
                    <td>{{ $todayUnsuccessful->userCustomer_id }}</td>
                    <td>{{ $todayUnsuccessful->userRider_id }}</td>
                    <td>{{ $todayUnsuccessful->date }}</td>
                    <td>{{ $todayUnsuccessful->reason }}</td>


                </tr>

            @endforeach


        </table>

    </div>
    <h3>Overall Detail</h3>

    <h5>Total Unsuccessful Rides = {{ $totalUnsuccessful }}</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>User Customer ID</th>
                <th>User Rider ID</th>
                <th>Date</th>
                <th>Reason</th>

            </tr>
            @foreach($allunsuccessfulrides as $allunsuccessfulride)
                <tr>
                    <td>{{ $allunsuccessfulride->userCustomer_id }}</td>
                    <td>{{ $allunsuccessfulride->userRider_id }}</td>
                    <td>{{ $allunsuccessfulride->date }}</td>
                    <td>{{ $allunsuccessfulride->reason }}</td>


                </tr>

            @endforeach


        </table>

    </div>

@endsection