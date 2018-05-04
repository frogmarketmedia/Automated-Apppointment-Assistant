@extends('layout')

@section('content')
<?php 
    use App\Appointment;
    $user = Auth::user();
    $appointmentToMe = Appointment::where('user_id','=', $user->id)->get();
    $appointmentFromMe = Appointment::where('client_id','=', $user->id)->get();
?>

<div align="left">
 
  <img src="{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
    <form enctype="multipart/form-data" action="/user/profilepicupdated" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary">
    </form>
  <h1>{{ $user->name }}</h1>
  <h2>{{ $user->profession }}</h2>
  <a href="/user/{{$user->id}}/edit" class="btn btn-success"> Edit Profile</a>
</div>

 <br><br><br><br>
  <h2 style="border-style:solid; border-color:black; text-shadow: 2px 2px 5px green;" align="center">Appointment List From Me</h2>
  <table class="table table-bordered">
  <thead>
     <tr>
        <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Appoinment ID</th>
        <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Client_ID</th>
        <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Appointment Time</th>
    <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Update</th>
    <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Delete</th>
      </tr>
  </thead>
      <tbody>
        @foreach($appointmentFromMe as $appointment)
        <tr>
          <td style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">{{$appointment->id}}</td>
          <td style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">{{$appointment->user_id}}</td>
          <td style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">{{ $appointment->appointmentTime }}</td>
          <td style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="update"/>
              <button style="text-shadow: 2px 2px 5px green;" type="submit">Update</button>
            </form>
           </td>
          <td>
            <form method="POST" action="/user/deleteappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="delete"/>
              <button style="text-shadow: 2px 2px 5px green;" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </div>
    </tbody>
  </table>
<br><br><br><br><br><br>

  <h2 style="border-style:solid; border-color:black; text-shadow: 2px 2px 5px green;" align="center">Appointment List To Me</h2>
 <table class="table table-bordered">
  <thead>
     <tr>
        <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Appoinment ID</th>
        <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">User_ID</th>
        <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Appointment Time</th>
    <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Update</th>
    <th style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">Delete</th>
  </thead>
  <tbody>
        @foreach($appointmentToMe as $appointment)
        <tr>
          <td style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">{{$appointment->id}}</td>
          <td style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">{{$appointment->client_id}}</td>
          <td style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">{{ $appointment->appointmentTime }}</td>
          <td style="text-shadow: 2px 2px 5px green;" style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="update"/>
              <button style="text-shadow: 2px 2px 5px green;" type="submit" >Update</button>
            </form>
          </td>
          <td>
            <form method="POST" action="/user/deleteappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="delete"/>
              <button style="text-shadow: 2px 2px 5px green;" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
  </tbody>
 </table>
 <br><br><br><br><br><br>
<div style="clear: both"></div>
@endsection
