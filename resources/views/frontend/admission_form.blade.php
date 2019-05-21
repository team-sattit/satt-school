@extends('frontend.layouts.master')
@section('pageTitle') @lang('site.admission') @endsection
@section('extraStyle')
<style>

.time
{
  width: 50%;
   display: inline-block;
  margin: 0 25%;
  text-align: center;
  color: white;
  background: #222;
}
.time div {
  display: inline-block;
  line-height: 1;
  padding: 20px;
  font-size: 40px;
}

span {
  display: block;
  font-size: 20px;
  color: white;
}

#days {
  font-size: 50px;
  color: #db4844;
}
#hours {
  font-size: 50px;
  color: #f07c22;
}
#minutes {
  font-size: 50px;
  color: #f6da74;
}
#seconds {
  font-size: 50px;
  color: #abcd58;
}
.row{
	max-width: 100%
}
.col-md-4{
	width: 33%;
	display:inline-block;
}

.col-md-2{
	width: 16%;
	display:inline-block;
}
</style>
@endsection

@section('pageBreadCrumb')
	<!-- page title -->
	<div class="page-title">
		<div class="grid-row">
			<h1>@lang('site.admission')</h1>
			<nav class="bread-crumb">
				<a href="{{URL::route('home')}}">@lang('site.menu_home')</a>
				<i class="fa fa-long-arrow-right"></i>
				<a href="#">@lang('site.admission')</a>
			</nav>
		</div>
	</div>
	<!-- / page title -->
@endsection

@section('pageContent')
	<!-- content -->
<?php 
date_default_timezone_set('Asia/Dhaka');

$start = $admis_one->open.' 00:00:00';
$end = $admis_one->close.' 23:59:59';

$current = strtotime(date('Y-m-d H:i:s'));

// echo  $className = $admis_one->class;
// echo $sessionName = $admis_one->session;
// echo $admName = $admis_one->admission;


 ?>
 <div class="page-content">
 <div class="container">
			<!-- main content -->
	<main>
		<div class="time">
		<div id="timer">
		  <div id="days"></div>
		  <div id="hours"></div>
		  <div id="minutes"></div>
		  <div id="seconds"></div>
		</div>
		</div>
@if ($current > strtotime($start) && $current < strtotime($end))

	<div class="widget-contact-form">
							<!-- contact-form -->
							<div class="info-boxes error-message alert-boxes error-alert" id="feedback-form-errors">
								<strong>Attention!</strong>
								<div class="message"></div>
							</div>
							<div class="email_server_responce"></div>
							<form action="{{URL::route('site.contact_us_form')}}" method="post" enctype="text/plain" class="supportForm alt clear-fix">
								@csrf
							<div class="row">
							 <div class="col-md-4">
							  <div class="form-group">
                              <label for="fname">Student Name</label>
                             <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                <input type="text" class="form-control" required name="name" placeholder="Full Name">
                              </div>
                             </div>
							</div>
						 <div class="col-md-4">
						  <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                <input type="text" class="form-control" required  name="nationality" placeholder="Nationality">
                            </div>
                        </div>
						</div>
						<div class="col-md-4">
                        <div class="form-group ">
                        <label for="photo">Photo</label>
                        <input id="photo" name="photo" size="50" onchange="previewFile()" required type="file">
                        </div>

						</div>
						<div class="col-md-4">
							   <div class="form-group ">
                              <label for="photo" class="text-info">File Size must be Less than 200KB</label>
                              <label id="lblmsgphoto" class="text-danger"></label>
                            </div>
						</div>
						<div class="col-md-4">
							
						</div>
						<div class="col-md-4"></div>
					</div>
						
								<button type="submit" class="cws-button border-radius alt">@lang('site.send')</button>
							</form>
							<!--/contact-form -->
						</div>

@endif

  </main>
			<!-- / main content -->
</div>
</div>
	<!-- / content -->

@endsection

@section('extraScript')
@php
	$date =date('Y-m-d');
	$db =DB::table('admissions')->first();
@endphp

<script>

	function makeTimer() {

	//		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");	
		var endTime = new Date("{{$end}}");			
			endTime = (Date.parse(endTime) / 1000);

			var now = new Date();
			now = (Date.parse(now) / 1000);

			var timeLeft = endTime - now;

			var days = Math.floor(timeLeft / 86400); 
			var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
			var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
			var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
  
			if (hours < "10") { hours = "0" + hours; }
			if (minutes < "10") { minutes = "0" + minutes; }
			if (seconds < "10") { seconds = "0" + seconds; }

			$("#days").html(days + "<span>Days</span>");
			$("#hours").html(hours + "<span>Hours</span>");
			$("#minutes").html(minutes + "<span>Minutes</span>");
			$("#seconds").html(seconds + "<span>Seconds</span>");		

	}

setInterval(function() { makeTimer(); }, 1000);

// var countDownDate = new Date('{{$end}}').getTime();

// var x = setInterval(function() {

//   var now = new Date().getTime();
//   var distance = countDownDate - now;
  
//   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//   var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
//   document.getElementById("demo").innerHTML = days + "d " + hours + "h "
//   + minutes + "m " + seconds + "s ";

// }, 1000);
</script>

@endsection
