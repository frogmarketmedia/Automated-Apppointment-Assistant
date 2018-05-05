<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
	protected $fillable = ['user_id','client_id','appointmentTime','hour','min'];
    //

   	public static function deletePast() {
   		$n = Carbon::now()->toDateTimeString();
   		echo "$n<br>";
   		$appointments = Appointment::where('appointmentTime','<',$n)->delete();
   		return;
   	}
}
