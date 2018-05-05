<?php
use App\User;
if($notification->data['appointment']['client_id'] == $notification->notifiable_id)
{
	$appointmentgivenby = User::where('id','=',$notification->data['appointment']['user_id'])->first();
}
else
{
	$appointmentgivenby = User::where('id','=',$notification->data['appointment']['client_id'])->first();
}
$appointmenttime=$notification->data['appointment']['appointmentTime'];
?>
<div style="border-style: inset;">
	<p width="20px"><span style=" font-size: 12px;">Appointment Cancelled by {{$appointmentgivenby->name}} at {{$appointmenttime}}</span></p>
	<form method="POST" action="/delete/notification" style="display: inline-block;">
	              {{ csrf_field() }}
	  	<input type="hidden" value="{{$notification->id}}" name="notificationid">
	  	<button style="font-size:10px"><i class="fa fa-close"></i></button>
	</form>
<div style="border-style: inset;">