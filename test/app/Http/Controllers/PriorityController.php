<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function setRating(Request $req,User $user) {
    	
    	dd($req);
    	return view('users.show',compact('user'));
    }
}
