<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\User;
use App\Educations;
use App\Experiences;
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
        $education= Educations::where('user_id','=',$user->id)->get();
        $experience= Experiences::where('user_id','=',$user->id)->get();
        return view('users.edit', compact('user','education','experience'));
    }

    public function update(Request $request,User $user)
    { 
        $user->name = ucfirst($request->get('name'));
        $user->email = $request->get('email');
        $user->profession = ucfirst($request->get('profession'));
        $user->phone = $request->get('phone');
        $user->password = bcrypt( $request->get('password'));
        $user->save();

        $userid=$user->id;
        $eduid=$request->get('eduid');
        if(!is_null($eduid))
        {
            $institution = $request->get('instituion');
            $department = $request->get('department');
            $degree = $request->get('degree');
            $present = $request->get('present');
            $totaledu=count($request->get('eduid'));
            for($i=0 ; $i < $totaledu ; $i++) {
                if(strtolower($present[$i])=="true")
                    $istrue=1;
                else
                    $istrue=0;
                $education=Educations::find($eduid[$i]);
                $education->user_id=$userid;
                $education->institution=$institution[$i];
                $education->department=$department[$i];
                $education->degree=$degree[$i];
                $education->present=$istrue;
                $education->save();
            }
        }
        $exid=$request->get('exid');
        if(!is_null($exid))
        {
            $totalex=count($request->get('exid'));
            $company =$request->get('company');
            $designation=$request->get('designation');
            $present=$request->get('presentex');
            for($i=0 ; $i < $totalex ; $i++) {
                if(strtolower($present[$i])=="true")
                    $istrue=1;
                else
                    $istrue=0;
                $experience=Experiences::find($exid[$i]);
                $experience->user_id=$userid;
                $experience->work_place=$company[$i];
                $experience->designation=$designation[$i];
                $experience->present=$istrue;
                $experience->save();

            }
        }
        return redirect('/home');
    }
    public function editEducation(User $user)
    {   

        $user = Auth::user();
        return view('users.editEducation');
    }
    public function updateEducation(User $user,Request $request)
    {
        $user = Auth::user();
        $institutions = $request->input('instituion');
        $departments = $request->input('department');
        $degrees = $request->input('degree');
        $presents = $request->input('present');
        $total=count($institutions);
        for($i = 0; $i < $total; $i++)
        {
            if(strtolower($presents[$i])=="true")
                $istrue=1;
            else
                $istrue=0;
            Educations::create([
                'user_id'=>$user->id,
                'institution'=>$institutions[$i],
                'department'=>$departments[$i],
                'degree'=>$degrees[$i],
                'present'=>$istrue,
            ]);
        }
        return redirect('/home');
    }
    public function editExperience(User $user)
    {   

        $user = Auth::user();
        return view('users.editExperience');
    }
    public function updateExperience(User $user,Request $request)
    {   
        //'user_id','institution','degree','present'
        $workplace = $request->input('workplace');
        $designation = $request->input('designation');
        $present = $request->input('present');
        $total=count($workplace);
        for($i = 0; $i < $total; $i++)
        {
            if(strtolower($present[$i])=="true")
                $istrue=1;
            else
                $istrue=0;
            Experiences::create([
                'user_id'=>$user->id,
                'work_place'=>$workplace[$i],
                'designation'=>$designation[$i],
                'present'=>$istrue,
            ]);
        }
        return redirect('/home');
    }

    public function deleteAppointment(Request $request){
        $requested = $request->get('delete');
        //echo $requested;
        $requestid=$request->get('notificationidd');
        if(!is_null($requestid))
        {
            DB::table('notifications')->where('id','=',$requestid)->delete();
        }
        $user = Auth::user();
        $appointment = Appointment::find($requested);
        $send = User::find($appointment->client_id);
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
            $client = Auth::user();
            $user = User::find($request->get('user_id'));
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
                return view('updateappointment',compact('hoise','user'));
            }
            else if($appEnd->format('H:i:s') > $userEnd->format('H:i:s')) {
                $hoise = "$appEnd ==$userEnd\n shale chor,appointment duration crosses the working hour,pakad liya!hu!!";
                return view('updateappointment',compact('hoise','user'));
            }
            else if($conflictingApp->count()) {
                $hoise = "na mama hobe na ei time e,onnor sathe appointment ase<br>";
                for($key=0;$key<sizeof($freeTime)-1;$key=$key+2) {
                    $hoise .= $freeTime[$key]." theke ".$freeTime[$key+1]."free ase mama<br>";
                }
                return view('updateappointment',compact('hoise','user'));
            }
            else if($time>$user['workStart'] && $time<$user['workStop']) {
                $id=$request->get('id');
                $appointment = Appointment::find($id);
                $appointment->user_id=$request->get('user_id');
                $appointment->client_id=$request->get('client_id');
                $appointment->appointmentTime = $request->get('appointmentTime');
                $appointment->save();
                $send = User::find($appointment->client_id);
                $send->notify(new AppointmentUpdate($appointment));
                Email::to($send->email)->send(new AppointmentChanged($appointment));
                $requestid=$request->get('notificationidu');
                if(!is_null($requestid))
                {
                    DB::table('notifications')->where('id','=',$requestid)->delete();
                }
                //return redirect("gc/$appointment->id");
            }
            else {
                $hoise = "na mama hobe na ei time e";
                return view('updateappointment',compact('hoise','user'));
            }
            return redirect('/home');
        
    }
    public function approved(Request $request)
    {
        $requested = $request->get('approved');
        $requestid=$request->get('notificationida');
        DB::table('notifications')->where('id','=',$requestid)->delete();
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
    public function deleteNotification(Request $request)
    {
        $requestid=$request->get('notificationid');
        DB::table('notifications')->where('id','=',$requestid)->delete();
        return redirect('/home');
    }

}