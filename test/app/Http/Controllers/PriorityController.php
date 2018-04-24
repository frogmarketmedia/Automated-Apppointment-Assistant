<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PriorityController extends Controller
{
    public function setRating(Request $req,User $user) {
    	$uud = Auth::user();
    	$rating = $user->rating;
    	$new_rating = ($rating * $user->rates + $req->get('stars')) / ($user->rates + 1) ;    	
    	$user->rating=$new_rating;
    	$user->rates=$user->rates+1;
    	$user->save();
    	return view('users.show',compact('user'));
    }
}
