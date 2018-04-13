<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AppointmentsController extends Controller
{
    public function index() {

    	$users = User::all();
        return view('users.showAll',compact('users'));
    }

    public function register(Request $request) {
        dd($request->get('user_id'));
        dd(Auth::id());
    	/*DB::table('appointments')->insert([
    		'user_id' => Auth::id() ,
            'client_id' => request('$user->id'),
    		
    	]
    	);*/
    	//return redirect("/user/{$user->id}");
    }
}
