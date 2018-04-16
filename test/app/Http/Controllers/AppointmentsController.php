<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AppointmentsController extends Controller
{
    public function makeAppointment(Request $request) {
        $user = Auth::user();
        echo $user['id'];
        echo "<br>";
        echo $request->get('userID');
    }
}
