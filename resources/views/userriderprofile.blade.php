@extends('master')

@section('title', 'Customers')

@section('content')





    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Rider's Profile</h4></div>
                <div class="panel-body">


                    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                        <img alt="User Pic" src="{{$user[0]->userPic}}" id="profile-image1" class="img-circle"
                             alt="Cinque Terre" width="304" height="300">


                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                        <div class="container">
                            <h2>{{ $user[0]->name}}</h2>


                            <form method="post" action="/update/{{$user[0] ->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <button class="btn btn-lg btn-success" type="submit">
                                    <?php
                                    if ($user[0]->status == "0") {
                                        echo " BAN Rider";

                                    } else {
                                        echo "  Active Rider";
                                    } ?>

                                </button>
                            </form>

                        </div>
                        <br>
                        <h4>
                            <?php   if ($user[0]->status == "0") {
                                echo "<div style ='color:#33FF3F'>  The Rider is Active now.";

                            } else {
                                echo "<div style ='color:#FF3333'>  The Rider is BANNED now.";
                            } ?></h4>
                        <hr>


                        <ul class="container details">
                            <li><p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>Mobile
                                    No. {{$user[0]->phone}}</p></li>
                            <li><p><span class="glyphicon glyphicon-envelope one"
                                         style="width:50px;"></span>{{$user[0]->email}}</p></li>
                        </ul>
                        <hr>
                        <div class="col-sm-5 col-xs-6 tital ">Date of joinig: {{$user[0]->date}}</div>
                        <div class="col-sm-5 col-xs-6 tital ">ShareCode: {{$user[0]->shareCode}}</div>


                    </div>
                </div>
            </div>
        </div>
        <h2>History</h2>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>History ID</th>
                  
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Fare</th>
                    <th>Rider Percent</th>
                    <th>Company Percent</th>
                    <th>Promo Amount</th>
                    <th>User Customer ID</th>
                    <th>Duration</th>
                    <th>Travel Distance</th>
                    <th>Ride Start Time</th>
                    <th>Ride End Time</th>
                </tr>
                @foreach($userHistory as $history)
                    <tr>
                        <td>{{ $history->historyId }}</td>

                        <td>{{ $history->origin }}</td>
                        <td>{{ $history->destination }}</td>
                        <td>{{ $history->fare }}</td>
                        <td>{{ $history->riderPercent }}</td>
                        <td>{{ $history->companyPercent }}</td>
                        <td>{{ $history->promoAmount }}</td>
                        <td><a href="/profile/{{$history->userCustomer_id}}">{{ $history->userCustomer_id }}</a></td>
                        <td>{{ $history->travelDuration }}</td>
                        <td>{{ $history->travelDistance }}</td>
                        <td>{{ $history->rideStartTime }}</td>
                        <td>{{ $history->rideEndTIme }}</td>

                    </tr>

                @endforeach


            </table>

        </div>


    </div>






@endsection