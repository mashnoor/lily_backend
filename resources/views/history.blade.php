@extends('master')

@section('title', 'Customers')

@section('content')





    <div class="container">
        <div class="row">
                <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
 <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form  action="{{ url('/history/search') }}" method="get">
     <div class="form-group ">
      <label class="control-label " for="date">
       Date
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-calendar">
        </i>
       </div>
       <input class="form-control" id="date" name="date" placeholder="YYYY/MM/DD" type="text"/>
      </div>
     </div>
     <div class="form-group ">
      <label class="control-label " for="date">
       Date
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-calendar">
        </i>
       </div>
       <input class="form-control form-control" id="date" name="date" placeholder="YYYY/MM/DD" type="text"/>
      </div>
     </div>
     <div class="form-group">
      <div>
       <button class="btn btn-primary " name="submit" type="submit">
        Submit
       </button>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>


<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>

        <h2>History</h2>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>History ID</th>
                    <th>User Customer ID</th>
    <th>Origin</th>
                    <th>Destination</th>
                    <th>Fare</th>
                    <th>Rider Percent</th>
                    <th>Company Percent</th>
                    <th>Promo Amount</th>
                
                    <th>Duration</th>
                    <th>Travel Distance</th>
                    <th>Ride Start Time</th>
                    <th>Ride End Time</th>
                </tr>
                @foreach($histories as $history)
                    <tr>
                        <td>{{ $history->historyId }}</td>
<td><a href="rider/profile/{{$history->userCustomer_id}}">{{ $history->userCustomer_id }}</a></td>
                        <td>{{ $history->origin }}</td>
                        <td>{{ $history->destination }}</td>
                        <td>{{ $history->fare }}</td>
                        <td>{{ $history->riderPercent }}</td>
                        <td>{{ $history->companyPercent }}</td>
                        <td>{{ $history->promoAmount }}</td>
                        
                        <td>{{ $history->travelDuration }}</td>
                        <td>{{ $history->travelDistance }}</td>
                        <td>{{ $history->rideStartTime }}</td>
                        <td>{{ $history->rideEndTime }}</td>

                    </tr>

                @endforeach


            </table>

        </div>


    </div>






@endsection