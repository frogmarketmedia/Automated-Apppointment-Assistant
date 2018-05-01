@extends('layout')

@section('content')
<h1>{{ $user->name }}</h1>
<h2>{{ $user->profession }}</h2>
<h2>{{ $user->workStart }}</h2>
<h2>{{ $user->workStop }}</h2>


<form method="POST" action="/placeappointments/{{$user->id}}">
  {{ csrf_field() }}
  <div class="form-group">
    Appointment date and time:
    <input type="datetime-local" name="appointmentTime">
    Hour:
    <input type="number" name="hourD" min="0" max="3" value="0">
    Minute:
    <input type="number" name="minD" min="0" max="59" value="20">
    <input type="hidden" name="userID" value="{{$user->id}}">
    <?php if(isset($hoise)) echo "<p>$hoise</p>" ?>
  </div>
  <button type="submit" class="btn btn-primary">Place Appointment</button>
</form>
@endsection