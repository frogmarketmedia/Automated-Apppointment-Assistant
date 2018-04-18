@extends('layout')

@section('content')
<?php 
    use App\Appointment;
    $user = Auth::user();
    $appointmentToMe = Appointment::where('user_id','=', $user->id)->get();
    $appointmentFromMe = Appointment::where('client_id','=', $user->id)->get();
?>
<h1>{{ $user->name }}</h1>
<h2>{{ $user->profession }}</h2>

<div>
  <h2>Appointment List To Me</h2>
  <ul align="left">
    @foreach($appointmentToMe as $appointment)
        <li>{{ $appointment->id }},{{ $appointment->user_id }},{{ $appointment->client_id }},{{ $appointment->appointmentTime }} </a></li>
    @endforeach
`</ul>
</div>

<div>
  <h2>Appointment List From Me</h2>
  <ul align="left">
    @foreach($appointmentFromMe as $appointment)
        <li>{{ $appointment->id }},{{ $appointment->user_id }},{{ $appointment->client_id }},{{ $appointment->appointmentTime }} </a></li>
    @endforeach
`</ul>
</div>

<style>

 
h2 {
  font: 400 40px/1.5 Helvetica, Verdana, sans-serif;
  margin: 0;
  padding: 0;
}
 
ul {
  list-style-type: none;
  margin: 0;
  padding: 100;
}
 
li {
  font: 200 20px/1.5 Helvetica, Verdana, sans-serif;
  border-bottom: 2px solid #ccc;
}
 
li:last-child {
  border: none;
}
 
li a {
  text-decoration: none;
  color: #5D6D7E;
  display: block;
  width: 200px;
 
  -webkit-transition: font-size 0.3s ease, background-color 0.3s ease;
  -moz-transition: font-size 0.3s ease, background-color 0.3s ease;
  -o-transition: font-size 0.3s ease, background-color 0.3s ease;
  -ms-transition: font-size 0.3s ease, background-color 0.3s ease;
  transition: font-size 0.3s ease, background-color 0.3s ease;
}
 
li a:hover {
  font-size: 30px;
  color: #5D6D7E;
  text-decoration:none;
}
</style>

@endsection
