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
    public function updateAppointment(Request $request,Appointment $appointment){
        $client = Auth::user();
        $user = User::find($request->get('user_id'));

        $timeStamp = $request->get('appointmentTime');
        $time = date('H:i:s', strtotime($timeStamp));
        $app = $appointment;
 
        $conflictingApp = Appointment::where([
            'user_id' => $user->id,
            'appointmentTime' => $timeStamp
        ])->get();
        
        
        if($conflictingApp->count()) {
            $hoise = "na mama hobe na ei time e,onnor sathe appointment ase";
            return view('updateappointment',compact('hoise','app'));
        }
        else if($time>$user['workStart'] && $time<$user['workStop']) {
            //echo "ok";
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
            $hoise = "na mama hobe na ei time e dekha kore na";
            return view('updateappointment',compact('hoise','app'));
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