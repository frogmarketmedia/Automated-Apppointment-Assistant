<?php
	use App\User;
	$appointmentgivenby = User::find($notification->data['appointment']['user_id']);
	$appointmentgivenbyname= $appointmentgivenby['name'];
	$appointmenttime=$notification->data['appointment']['appointmentTime'];
?>
<div style="border-style: inset;">
	<p width="20px"><span style=" font-size: 12px;">Appointment Approved by {{$appointmentgivenbyname}} at {{$appointmenttime}}</span></p>
	<form method="POST" action="/delete/notification" style="display: inline-block;">
	              {{ csrf_field() }}
	  	<input type="hidden" value="{{$notification->id}}" name="notificationid">
	  	<button style="font-size:10px"><i class="fa fa-close"></i></button>
	</form>
<div style="border-style: inset;">


