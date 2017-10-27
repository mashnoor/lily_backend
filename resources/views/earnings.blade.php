@extends('master')

@section('title', 'Earnings')

@section('content')
    <h2>Earning Detail</h2>
    <h4>Overall Status</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>No.</th>
                <th>Earning Type</th>
                <th>Earning</th>

            </tr>

            <tr>
                <td>1</td>
                <td>Total Earning</td>
                <td><b>{{ $totalFare }}</b></td>

            </tr>

            <tr>
                <td>2</td>
                <td>Rider Percent</td>
                <td><b>{{ $riderPercent }}</b></td>

            </tr>

            <tr>
                <td>3</td>
                <td>Company Percent</td>
                <td><b>{{ $companyPercent }}</b></td>

            </tr>


        </table>

    </div>


@endsection