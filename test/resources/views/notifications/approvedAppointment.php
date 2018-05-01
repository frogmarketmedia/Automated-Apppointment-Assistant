<span style=" font-size: 12px;">Appointment Approved by 
<?php
use App\User;
$appointmentgivenby = User::find($notification->data['appointment']['user_id']);
echo $appointmentgivenby['name'];
?>
</span>