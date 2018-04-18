<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use Auth;

class AppointmentsController extends Controller
{
    public function makeAppointment(Request $request) {
        if(Auth::check()) {
            $user = Auth::user();
            echo $user['id'];
            echo "<br>";
            echo $request->get('userID');
            $appointment = Appointment::create([
                'user_id' => $user['id'],
                'client_id' => $request->get('userID'),
                'appointmentTime' => $request->get('appointmentTime')
            ]);
        }
        else {

        }
        dd($appointment);
    }

    public function index(User $user) {
        return view('appointment',compact('user'));
    }

}
