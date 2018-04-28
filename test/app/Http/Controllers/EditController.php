<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\User;
use DB;
use App\Mail\AppointmentChanged;
use App\Mail\AppointmentDeleted;
use Illuminate\Support\Facades\Mail as Email;
use App\Notifications\AppointmentDelete;
use App\Notifications\AppointmentUpdate;
class EditController extends Controller
{
    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }
    public function update(Request $request,User $user)
    { 
        $user->name = ucfirst($request->get('name'));
        $user->email = $request->get('email');
        $user->profession = ucfirst($request->get('profession'));
        $user->phone = $request->get('phone');
        $user->password = bcrypt( $request->get('password'));

        $user->save();

        return view('home');
    }
    public function deleteAppointment(Request $request){
        $requested = $request->get('delete');
        //echo $requested;
        $user = Auth::user();
        $appointment = Appointment::find($requested);
        if($appointment->user_id==$user->id)
        {
            $send = User::find($appointment->client_id);
        }
        else
        {
            $send = User::find($appointment->user_id);
        }
        $send->notify(new AppointmentDelete($appointment));
        Email::to($send->email)->send(new AppointmentDeleted($appointment));
        DB::table('appointments')->where('id',$requested)->delete();
        return view('home');
        //DB::table('appointments')->where('id',$requested)->delete();

    }
     public function updateAppointmentindex(Request $request,Appointment $appointment){
        $requested = $request->get('update');
        $app= Appointment::where('id','=',$requested)->first();

        return view('updateappointment', compact('app'));
    }
    public function updateAppointment(Request $request,Appointment $appointment){
        $client = Auth::user();
        $user = User::find($request->get('user_id'));

        $timeStamp = $request->get('appointmentTime');
        $time = date('H:i:s', strtotime($timeStamp));
        $app = $appointment;
 
        $conflictingApp = Appointment::where([
            'user_id' => $user->id,
            'appointmentTime' => $timeStamp
        ])->get();
        
        
        if($conflictingApp->count()) {
            $hoise = "na mama hobe na ei time e,onnor sathe appointment ase";
            return view('updateappointment',compact('hoise','app'));
        }
        else if($time>$user['workStart'] && $time<$user['workStop']) {
            //echo "ok";
            $id=$request->get('id');
            $appointment = Appointment::find($id);
            $appointment->user_id=$request->get('user_id');
            $appointment->client_id=$request->get('client_id');
            $appointment->appointmentTime = $request->get('appointmentTime');
            $appointment->save();
            if($appointment->user_id==$user->id)
            {
                $send = User::find($appointment->client_id);
            }
            else
            {
                $send = User::find($appointment->user_id);
            }
            $send->notify(new AppointmentUpdate($appointment));
            Email::to($send->email)->send(new AppointmentChanged($appointment));
            return view('home');
        }
        else {
            $hoise = "na mama hobe na ei time e dekha kore na";
            return view('updateappointment',compact('hoise','app'));
        }

        
    }

}