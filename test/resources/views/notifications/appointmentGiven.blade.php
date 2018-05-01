<?php
use App\User;
$appointmentid=$notification->data['appointment']['id'];
if($notification->data['appointment']['client_id'] == $notification->notifiable_id)
{
	$appointmentgivenby = User::where('id','=',$notification->data['appointment']['user_id'])->first();
}
else
{
	$appointmentgivenby = User::where('id','=',$notification->data['appointment']['client_id'])->first();
}
?>

	<form method="POST" action="/user/updateappointment/{{$user->id}}" style="display: inline-block;">
              {{ csrf_field() }}
    <input type="hidden" value="{{$appointmentid}}" name="update"/>
    <span style=" font-size: 12px;">Appointment Placed by {{$appointmentgivenby->name}} </span>
	<!-- <button style="font-size:12px"><i class="fa fa-pencil"></i></button>
	</form>
	<form method="POST" action="/user/deleteappointment/{{$user->id}}" style="display: inline-block;">
              {{ csrf_field() }}
    <input type="hidden" value="{{$appointmentid}}" name="delete"/>
	<button style="font-size:12px"><i class="fa fa-close"></i></button> --></form>
