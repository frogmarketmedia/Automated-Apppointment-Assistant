<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Priority;
use Auth;

class PriorityController extends Controller
{
    public function setRating(Request $req,User $user) {
    	$uud = Auth::user();
    	$rating = $req->get('stars');
        $priority = Priority::where([
            'user_id' => $user['id'],
            'client_id' => $uud['id']   
       	])->first();

        if($priority===null)
	    {	
	    	Priority::create([
            'user_id' => $user['id'],
            'client_id' => $uud['id'],
            'rating' => $rating   
       		]);
	    	$new_rating = ($rating * $user->rates + $req->get('stars')) / ($user->rates + 1) ;
	    	$user->rating=$new_rating;
	    	$user->rates=$user->rates+1;
	    	$user->save();
	    }
	    else {
	    	$new_rating = ($rating - $priority->rating) / ($user->rates);

	    	$user->rating+=$new_rating;
	    	$priority->rating=$rating;
	    	// echo $priority;
	    	// echo "<br>";
	    	// echo "$rating,,,$priority->rating,,,$new_rating";
	    	$user->save();
	    	$priority->save();
	    }
	    return view('users.show',compact('user'));
    }
}
