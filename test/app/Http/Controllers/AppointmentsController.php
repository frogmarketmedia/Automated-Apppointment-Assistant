<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use Auth;
use App\Notifications\AppointmentGiven;
class AppointmentsController extends Controller
{
    public function makeAppointment(Request $request) {   
            $client = Auth::user();
            $user = User::find($request->get('userID'));
            $timeStamp = $request->get('appointmentTime');
            $time = date('H:i:s', strtotime($timeStamp));

            $conflictingApp = Appointment::where([
                'user_id' => $user->id,
                'appointmentTime' => $timeStamp
            ])->get();
            
            
            if($conflictingApp->count()) {
                $hoise = "na mama hobe na ei time e,onnor sathe appointment ase";
                return view('appointment',compact('hoise','user'));
            }
            else if($time>$user['workStart'] && $time<$user['workStop']) {
                
                //echo "ok";
                $appointment = Appointment::create([
                'user_id' => $user['id'],
                'client_id' => $client['id'],
                'appointmentTime' => $timeStamp
                ]);
                $user->notify(new AppointmentGiven($appointment));
                return redirect("gc/$appointment->id");
            }
            else {
                $hoise = "na mama hobe na ei time e";
                return view('appointment',compact('hoise','user'));
            }
            return view('home');
    }

    public function index(User $user) {
        if(Auth::check()) return view('appointment',compact('user'));
        else return view('auth.login',compact('user'));
    }

}
