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
<br>
  <h2 align="left">Appointment List To Me</h2>
  <table>
     <tr >
        <th style=" padding-right: 20px;">Appoinment ID</th>
        <th style=" padding-right: 20px;">Client_ID</th>
        <th >Appointment Time</th>
      </tr>
      @foreach($appointmentToMe as $appointment)
      <div>
        <tr >
          <td style=" padding-right: 20px;">{{ $appointment->id }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->client_id }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->appointmentTime }}</td>
           <td style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="update"/>
              <button type="submit">Update</button>
            </form>
          </td>
          <td>
            <form method="POST" action="/user/deleteappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="delete"/>
              <button type="submit">Delete</button>
            </form>
          </td>
        </tr>
      </div>
      @endforeach
  </table>
<br>
  <h2 align="left">Appointment List From Me</h2>
  <table>
     <tr >
        <th style=" padding-right: 20px;">Appoinment ID</th>
        <th style=" padding-right: 20px;">User_ID</th>
        <th >Appointment Time</th>
        <th >Appointment Duration</th>
      </tr>
      @foreach($appointmentFromMe as $appointment)
        <tr>
          <td style=" padding-right: 20px;">{{ $appointment->id }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->user_id }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->appointmentTime }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->hour }}Hr  {{ $appointment->min }}Min</td>
          <td style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="up"/>
              <button type="submit" >↑</button>
            </form>
          </td>
          <td style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="down"/>
              <button type="submit" >↓</button>
            </form>
          </td>
          <td style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="update"/>
              <button type="submit" >Update</button>
            </form>
          </td>
          <td>
            <form method="POST" action="/user/deleteappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="delete"/>
              <button type="submit">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
 </table>
<div style="clear: both"></div>
@endsection
