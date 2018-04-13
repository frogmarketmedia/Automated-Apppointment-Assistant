<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class userController extends Controller
{
    public function showAll() {
    	$users = User::all();
    	return view('users.showAll',compact('users'));
    }

    public function show(User $user) {
    	return view('users.show',compact('user'));
    }
}
