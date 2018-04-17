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
    public function showSearched(Request $request){
    	$users = User::all();
    	$searched = $request->input('searched');
    	//dd($searched) ;
    	if($searched != "")
    		$matcheduser = User :: where('name','LIKE','%'.$searched.'%')->get();
    									//->orWhere('profession','LIKE','%'.$searched.'%')->get();
    		if(count($matcheduser) > 0)
    			return view('users.showAll')->withDetails($matcheduser)->withQuery($searched);
    			//$cnt =count($matcheduser);
    			//dd($cnt);
    	
    	return view('users.showAll',compact('users'));

    }
}
