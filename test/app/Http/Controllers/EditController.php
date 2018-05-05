<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\User;
use DB;
use App\Mail\AppointmentChanged;
use App\Mail\AppointmentDeleted;
use App\Mail\AppointmentApproval;
use Illuminate\Support\Facades\Mail as Email;
use App\Notifications\AppointmentDelete;
use App\Notifications\AppointmentApproved;
use App\Notifications\AppointmentUpdate;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }
    public function update(Request $request,User $user)
    { 
        $user->name = ucfirst($request->get('name'));
        $user->email = $request->get('email');
        $user->profession = ucfirst($request->get('profession'));
        $user->phone = $request->get('phone');
        $user->password = bcrypt( $request->get('password'));

        $user->save();

        return redirect('/home');
    }
    public function deleteAppointment(Request $request){
        $requested = $request->get('delete');
        //echo $requested;
        $user = Auth::user();
        $appointment = Appointment::find($requested);
        if($appointment->user_id==$user->id)
        {
            $send = User::find($appointment->client_id);
        }
        else
        {
            $send = User::find($appointment->user_id);
        }
        $send->notify(new AppointmentDelete($appointment));
        Email::to($send->email)->send(new AppointmentDeleted($appointment));
        DB::table('appointments')->where('id',$requested)->delete();
        return redirect('/home');
        //DB::table('appointments')->where('id',$requested)->delete();

    }
     public function updateAppointmentindex(Request $request,Appointment $appointment){
        $requested = $request->get('update');
        $app= Appointment::where('id','=',$requested)->first();

        return view('updateappointment', compact('app'));
    }
    public function updateAppointment(Request $request){
        // $client = Auth::user();
        // $user = User::find($request->get('user_id'));

        // $timeStamp = $request->get('appointmentTime');
        // $time = date('H:i:s', strtotime($timeStamp));
        // $app = $appointment;
 
        // $conflictingApp = Appointment::where([
        //     'user_id' => $user->id,
        //     'appointmentTime' => $timeStamp
        // ])->get();
        
        
        // if($conflictingApp->count()) {
        //     $hoise = "na mama hobe na ei time e,onnor sathe appointment ase";
        //     return view('updateappointment',compact('hoise','app'));
        // }
        // else if($time>$user['workStart'] && $time<$user['workStop']) {
            // echo "ok";
            // $id=$request->get('id');
            // $appointment = Appointment::find($id);
            // $appointment->user_id=$request->get('user_id');
            // $appointment->client_id=$request->get('client_id');
            // $appointment->appointmentTime = $request->get('appointmentTime');
            // $appointment->save();
            // if($appointment->user_id==$user->id)
            // {
            //     $send = User::find($appointment->client_id);
            // }
            // else
            // {
            //     $send = User::find($appointment->user_id);
            // }
            // $send->notify(new AppointmentUpdate($appointment));
            // Email::to($send->email)->send(new AppointmentChanged($appointment));
            // return redirect('/home');
        // }
        // else {
        //     $hoise = "na mama hobe na ei time e dekha kore na";
        //     return view('updateappointment',compact('hoise','app'));
        // }

        $client = Auth::user();
        $user = User::find($request->get('userID'));
        $timeStamp = $request->get('appointmentTime');
        $timeStampCarbon = Carbon::createFromTimeString($timeStamp);
        $appEnd = Carbon::createFromTimeString($timeStamp);
        $appEnd->hour += $request->get('hourD');
        $appEnd->minute += $request->get('minD');
        $userEnd = Carbon::createFromTimeString($user['workStop']);


        $time = date('H:i:s', strtotime($timeStamp));
        $date = date('Y-m-d', strtotime($timeStamp));

        $conflictingApp = Appointment::whereRaw("DATE(appointmentTime) = '$date'")->get();

        foreach ($conflictingApp as $capp => &$pcapp) {
            $timeAppStart = Carbon::createFromTimeString($pcapp->appointmentTime);
            $timeAppEnd = Carbon::createFromTimeString($pcapp->appointmentTime);
            $timeAppEnd->hour = $timeAppEnd->hour + $pcapp->hour;
            $timeAppEnd->minute = $timeAppEnd->minute + $pcapp->min;
            if(!($timeStampCarbon>$timeAppStart && $timeStampCarbon<$timeAppEnd)) {
                unset($conflictingApp[$capp]);
            }
        }

        foreach ($conflictingApp as $capp => &$pcapp) {
            $timeAppStart = Carbon::createFromTimeString($pcapp->appointmentTime);
            $timeAppEnd = Carbon::createFromTimeString($pcapp->appointmentTime);
            $timeAppEnd->hour = $timeAppEnd->hour + $pcapp->hour;
            $timeAppEnd->minute = $timeAppEnd->minute + $pcapp->min;
            echo "$timeAppStart----------$timeAppEnd-----------$timeStampCarbon<br>";
        }
        
        $now = new Carbon();

        if($timeStampCarbon<$now) {
            $hoise = "na mama past e appointment dewa jabe nah :p";
            return view('updateappointment',compact('hoise','user'));
        }
        else if($appEnd > $userEnd) {
            $hoise = "shale chor,appointment duration crosses the working hour,pakad liya!hu!!";
            return view('updateappointment',compact('hoise','user'));
        }
        else if($conflictingApp->count()) {
            $hoise = "na mama hobe na ei time e,onnor sathe appointment ase";
            return view('updateappointment',compact('hoise','user'));
        }
        else if($time>$user['workStart'] && $time<$user['workStop']) {
            $id=$request->get('id');
            $appointment = Appointment::find($id);
            $appointment->user_id=$request->get('user_id');
            $appointment->client_id=$request->get('client_id');
            $appointment->appointmentTime = $request->get('appointmentTime');
            $appointment->save();
            if($appointment->user_id==$user->id)
            {
                $send = User::find($appointment->client_id);
            }
            else
            {
                $send = User::find($appointment->user_id);
            }
            $send->notify(new AppointmentUpdate($appointment));
            Email::to($send->email)->send(new AppointmentChanged($appointment));
            return redirect('/home');
        }
        else {
            $hoise = "na mama hobe na ei time e";
            return view('updateappointment',compact('hoise','user'));
        }
        
    }
    public function approved(Request $request)
    {
        $requested = $request->get('approved');
        $appointment = Appointment::find($requested);
        $userid = $appointment->user_id;
        $clientid=$appointment->client_id;
        $appointmenttime=$appointment->appointmentTime;
        $appointment->user_id= $userid;
        $appointment->client_id= $clientid;
        $appointment->appointmentTime=$appointmenttime;
        $appointment->approved = true;
        $appointment->save();
        $send = User::find($appointment->client_id);
        $send->notify(new AppointmentApproved($appointment));
        Email::to($send->email)->send(new AppointmentApproval($appointment));
        return redirect('/home');
    }

}