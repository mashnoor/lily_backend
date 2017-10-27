@extends('master')

@section('title', 'Page Title')

@section('content')
    <h3>Welcome Lily Admin Panel</h3>
    <h4>Most Active Hours</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Hour</th>
                <th>No. Of Rides</th>

            </tr>
            @foreach($hours as $hour)
                <tr>
                    <td>{{ $hour->hour }}</td>
                    <td>{{ $hour->cnt }}</td>

                </tr>

            @endforeach


        </table>

    </div>

@endsection