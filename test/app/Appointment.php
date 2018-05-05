<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
	protected $fillable = ['user_id','client_id','appointmentTime','hour','min','approved'];
    //

   	public static function deletePast() {
   		$n = Carbon::now()->toDateTimeString();
   		//$appointments = Appointment::where('appointmentTime','<',$n)->delete();
   		return;
   	}
}
