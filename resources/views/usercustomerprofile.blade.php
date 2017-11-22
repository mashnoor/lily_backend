@extends('master')

@section('title', 'Customers')

@section('content')


            <div class="container">    
                  <div class="row">
                      <div class="panel panel-default">
                      <div class="panel-heading">  <h4 >Customer Profile</h4></div>
                       <div class="panel-body">
                      <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                       <img alt="User Pic" src="{{$user[0]->picture}}" id="profile-image1" class="img-circle" alt="Cinque Terre" width="304" height="300"> 
                     
                 
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
                          <div class="container" >
                            <h2>{{ $user[0]->name}}</h2>
                           
                           
                          </div>
                           <hr>
                          <ul class="container details" >
                            <li><p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>Mobile No. {{$user[0]->phone}}</p></li>
                            <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$user[0]->email}}</p></li>
                          </ul>
                          <hr>
                          <div class="col-sm-5 col-xs-6 tital " >Date of joinig: {{$user[0]->date}}</div>
                          <div class="col-sm-5 col-xs-6 tital " >ShareCode: {{$user[0]->shareCode}}</div>
                         
                       
                      </div>
                </div>
            </div>
            </div>

            <div class="container">

<h2>History</h2>
<br>

<h4>
 <?php

$arrlength = count($userHistory);

for($x = 0; $x < $arrlength; $x++) {
 echo "On ";
 echo $userHistory[$x]->date;
 echo "   ";

 echo $userHistory[$x]->origin; 
 echo "  to ";
 echo $userHistory[$x]->destination.".";
 echo "   Fare: ";
 echo $userHistory[$x]->fare." TK."."<br>";

   
} 
    
?></h4>

</div>



@endsection