<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Auth;
use URL;
class userController extends Controller
{
    public function showAll() {
    	$users = User::all();
    	return view('users.showAll',compact('users'));
    }

    public function show(User $user) {
        if(Auth::check()) {
            $loggedIn = Auth::user();
            if($loggedIn->id === $user->id) return view('home');
        }
    	return view('users.show',compact('user'));
    }
    public function update_photo(Request $request){

        // Handle the user upload of avatar
        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $avatar->move(public_path().'/image/',$avatar->getClientOriginalName());
            $url =URL::to("/").'/image/'.$avatar->getClientOriginalName();
            $user = Auth::user();
            $user->avatar = $url;
            $user->save();
            
        }
        return view('home', array('user' => Auth::user()) );

    }
    public function showSearched(Request $request){
    	$users = User::all();
    	$searched = $request->input('searched');
    	if($searched != ""){
    		$matcheduser = User :: where('name','LIKE','%'.$searched.'%')
    									->orWhere('profession','LIKE','%'.$searched.'%')->get();
            //dd($matcheduser);
    		if(count($matcheduser) > 0)
    			return view('users.showAll')->withDetails($matcheduser)->withQuery($searched);
        }
    	return view('users.showAll',compact('users'));

    }
    public function index()
    {
        return view('homenew');
    }
}
