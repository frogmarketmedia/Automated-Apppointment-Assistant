<?php
use App\User;
$appointmentid=$notification->data['appointment']['id'];
$appointmentTime=$notification->data['appointment']['appointmentTime'];
if($notification->data['appointment']['client_id'] == $notification->notifiable_id)
{
	$appointmentgivenby = User::where('id','=',$notification->data['appointment']['user_id'])->first();
}
else
{
	$appointmentgivenby = User::where('id','=',$notification->data['appointment']['client_id'])->first();
}
?>
<div style="border-style: inset;">

	<p width="20px"><span style=" font-size: 12px;">Appointment Placed by {{$appointmentgivenby->name}}</span> <span style=" font-size: 10px;">At {{$appointmentTime}}</span> </p>
	<form method="POST" action="/user/approved" style="display: inline-block;">
              {{ csrf_field() }}
    <input type="hidden" value="{{$notification->id}}" name="notificationida">
    <input type="hidden" value="{{$appointmentid}}" name="approved"/>
    <button style="font-size:10px"><i class="fa fa-check"></i></button>
	</form>
	<form method="POST" action="/user/updateappointment/{{$user->id}}" style="display: inline-block;">
              {{ csrf_field() }}
    <input type="hidden" value="{{$notification->id}}" name="notificationidu">
    <input type="hidden" value="{{$appointmentid}}" name="update"/>
	<button style="font-size:10px"><i class="fa fa-pencil"></i></button>
	</form>
	<form method="POST" action="/user/deleteappointment/{{$user->id}}" style="display: inline-block;">
              {{ csrf_field() }}
    <input type="hidden" value="{{$notification->id}}" name="notificationidd">
    <input type="hidden" value="{{$appointmentid}}" name="delete"/>
	<button style="font-size:10px"><i class="fa fa-close"></i></button></form>
</div>