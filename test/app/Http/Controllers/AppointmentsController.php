<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use Auth;
use DB;
use App\Notifications\AppointmentGiven;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    public function makeAppointment(Request $request) {   
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

            $conflictingApp = Appointment::whereRaw("DATE(appointmentTime) = '$date'")->orderBy('appointmentTime')->get();
            $freeTime = array();

            //dd($conflictingApp);
            $index = 0;
            foreach ($conflictingApp as $capp => &$pcapp) {
//                echo "$pcapp<br>";
                if($capp<sizeof($conflictingApp)-1) {
                    $timeAppEnd = Carbon::createFromTimeString($pcapp->appointmentTime);
                    $timeAppEnd->hour = $timeAppEnd->hour + $pcapp->hour;
                    $timeAppEnd->minute = $timeAppEnd->minute + $pcapp->min;

                    $timeAppStart = Carbon::createFromTimeString($conflictingApp[$capp+1]->appointmentTime);
                    
                    if($capp==0) {
                        $freeTime[$index++] = $user['workStart'];
                        $freeTime[$index++] = Carbon::createFromTimeString($pcapp->appointmentTime)->format('H:i:s');
                    }

                    $freeTime[$index++] = $timeAppEnd->format('H:i:s');
                    $freeTime[$index++] = $timeAppStart->format('H:i:s');                    
                }
                else{
                    $timeAppEnd = Carbon::createFromTimeString($pcapp->appointmentTime);
                    $timeAppEnd->hour = $timeAppEnd->hour + $pcapp->hour;
                    $timeAppEnd->minute = $timeAppEnd->minute + $pcapp->min;

                    $freeTime[$index++] = $timeAppEnd->format('H:i:s');
                    $freeTime[$index++] = $user['workStop'];
                }
            }

//            dd($freeTime);

            foreach ($conflictingApp as $capp => &$pcapp) {
                $timeAppStart = Carbon::createFromTimeString($pcapp->appointmentTime);
                $timeAppEnd = Carbon::createFromTimeString($pcapp->appointmentTime);
                $timeAppEnd->hour = $timeAppEnd->hour + $pcapp->hour;
                $timeAppEnd->minute = $timeAppEnd->minute + $pcapp->min;
                if(!($timeStampCarbon>=$timeAppStart && $timeStampCarbon<=$timeAppEnd) && !($appEnd>=$timeAppStart && $appEnd<=$timeAppEnd)) {
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
                return view('appointment',compact('hoise','user'));
            }
            else if($appEnd->format('H:i:s') > $userEnd->format('H:i:s')) {
                $hoise = "$appEnd ==$userEnd\n shale chor,appointment duration crosses the working hour,pakad liya!hu!!";
                return view('appointment',compact('hoise','user'));
            }
            else if($conflictingApp->count()) {
                $hoise = "na mama hobe na ei time e,onnor sathe appointment ase<br>";
                for($key=0;$key<sizeof($freeTime)-1;$key=$key+2) {
                    $hoise .= $freeTime[$key]." theke ".$freeTime[$key+1]."free ase mama<br>";
                }
                return view('appointment',compact('hoise','user'));
            }
            else if($time>$user['workStart'] && $time<$user['workStop']) {
                $appointment = Appointment::create([
                'user_id' => $user['id'],
                'client_id' => $client['id'],
                'appointmentTime' => $timeStamp,
                'hour' => $request->get('hourD'),
                'min' => $request->get('minD')
                ]);
                $user->notify(new AppointmentGiven($appointment));
                //return redirect("gc/$appointment->id");
            }
            else {
                $hoise = "na mama hobe na ei time e";
                return view('appointment',compact('hoise','user'));
            }
            return redirect('/home');
    }

    public function index(User $user) {
        if(Auth::check()) return view('appointment',compact('user'));
        else return view('auth.login',compact('user'));
    }

}
