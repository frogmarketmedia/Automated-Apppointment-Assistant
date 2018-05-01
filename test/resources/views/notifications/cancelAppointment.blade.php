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
?>
<span style=" font-size: 12px;">Appointment Deleted by {{$appointmentgivenby->name}}</span>