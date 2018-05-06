@extends('layout')

@section('content')
<?php 
    use App\User;
    use App\Appointment;
    use App\Educations;
    use App\Experiences;
    use Carbon\Carbon;
    $user = Auth::user();
    Appointment::deletePast();
    $now = Carbon::now()->toDateTimeString();
    $appointmentToMe = Appointment::where('user_id','=', $user->id)
                                    ->where('approved','=',1)
                                    ->where('appointmentTime','>=',$now)
                                    ->orderBy('appointmentTime')->get();
    $appointmentFromMe = Appointment::where('client_id','=', $user->id)
                                    ->where('approved','=',1)
                                    ->where('appointmentTime','>=',$now)
                                    ->orderBy('appointmentTime')->get();
    $education = Educations::where('user_id','=',$user->id)->where('present','=',1)->first();
    $experience = Experiences::where('user_id','=',$user->id)->where('present','=',1)->first();
?>

<div align="left">
  @if(isset($user->avatar))
    <img src="{{$user->avatar}}" style=" width:160px; height:165px; float:left; border-radius:50%; margin-right:25px;">
  @else
    <img src="{{asset('/image/default.jpg')}}" style="width:160px; height:165px; float:left; border-radius:50%; margin-right:25px;">
  @endif
  <h1 style="text-shadow: 2px 2px 5px green;">{{$user->name}}</h1>
  <h2 style="text-shadow: 2px 2px 5px green;">{{$user->profession}}</h2><br>
  @if(isset($experience))
  <h2 style="text-shadow: 2px 2px 5px #00004d; font-size: 20px;">{{$experience->designation}} at {{$experience->work_place}}</h2>
  @endif
  @if(isset($education))
  <h2 style="text-shadow: 2px 2px 5px #00004d; font-size: 20px;">Studies {{$education->degree}} at {{$education->department}},{{ $education->institution }}</h2>
  @endif
  <a href="/viewprofile" class="btn btn-success" > View Profile Details</a>
    <div style="float:right" align="right">
      <form enctype="multipart/form-data" action="/user/profilepicupdated" method="POST">
        {{ csrf_field() }}
        <label style="text-shadow: 2px 2px 5px green;">Update Profile Image</label>
        <input type="file" name="avatar">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" class="pull-right btn btn-sm btn-success">
      </form>
    </div>
</div>

 <br><br><br><br>
  <h2 style="border-style:solid; border-color:black; text-shadow: 2px 2px 5px #00004d;" align="center">Appointment List From Me</h2>
  <table class="table table-bordered">
  <thead>
     <tr>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Appoinment ID</th>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">User Name</th>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Appointment Time</th>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Duration</th>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Delete</th>
      </tr>

  </thead>
      <tbody>
        @foreach($appointmentFromMe as $appointment)
        <?php
            
            $username=User::find($appointment->user_id);
        ?>
        <tr>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">{{$appointment->id}}</td>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">{{$username->name}}</td>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">{{ $appointment->appointmentTime }}</td>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">{{ $appointment->hour }}hr{{$appointment->min}}min</td>
          <td>
            <form method="POST" action="/user/deleteappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="delete"/>
              <button style="text-shadow: 2px 2px 5px #00004d;" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </div>
    </tbody>
  </table>
<br><br><br><br><br><br>

  <h2 style="border-style:solid; border-color:black; text-shadow: 2px 2px 5px #00004d;" align="center">Appointment List To Me</h2>
 <table class="table table-bordered">
  <thead>
     <tr>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Appoinment ID</th>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Client Name</th>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Appointment Time</th>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Duration</th>
        <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Update</th>
    <th style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">Delete</th>
  </thead>
  <tbody>
        @foreach($appointmentToMe as $appointment)
        <?php
            
            $username=User::find($appointment->client_id);
        ?>
        <tr>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">{{$appointment->id}}</td>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">{{$username->name}}</td>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">{{ $appointment->appointmentTime }}</td>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">{{ $appointment->hour }}hr{{$appointment->min}}min</td>
          <td style="text-shadow: 2px 2px 5px #00004d;" style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="update"/>
              <button style="text-shadow: 2px 2px 5px #00004d;" type="submit" >Update</button>
            </form>
          </td>

          <td>
            <form method="POST" action="/user/deleteappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="delete"/>
              <button style="text-shadow: 2px 2px 5px #00004d;" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
  </tbody>
 </table>
 <br><br><br><br><br><br>
<style> 
img { 
    border: 2px solid #00004d;
}
</style>
<div style="clear: both"></div>
@endsection
