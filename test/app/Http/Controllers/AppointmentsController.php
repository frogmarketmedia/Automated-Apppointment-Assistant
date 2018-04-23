<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use Auth;

class AppointmentsController extends Controller
{
    public function makeAppointment(Request $request) {   
            $user = Auth::user();
            $appointment = Appointment::create([
                'user_id' => $user['id'],
                'client_id' => $request->get('userID'),
                'appointmentTime' => $request->get('appointmentTime')
            ]);
            return view('home');
    }

    public function index(User $user) {
        if(Auth::check()) return view('appointment',compact('user'));
        else return view('auth.login',compact('user'));
    }

}
