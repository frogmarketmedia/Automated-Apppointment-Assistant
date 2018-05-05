@extends('layout')

@section('content')
 @if(isset($user->avatar))
  <img src="{{$user->avatar}}" style=" width:160px; height:165px; float:left; border-radius:50%; margin-right:25px;">
  @else
    <img src="{{asset('/image/default.jpg')}}" style="width:160px; height:165px; float:left; border-radius:50%; margin-right:25px;">
  @endif
<h1 style="text-shadow: 2px 2px 5px #00004d;"><strong>{{ $user->name }}</strong></h1>
<h2 style="text-shadow: 2px 2px 5px #00004d;"><strong>{{ $user->profession }}</strong></h2>
<h2 style="text-shadow: 2px 2px 5px #00004d;"><strong>Working Start Time:</strong>{{ $user->workStart }}</h2>
<h2 style="text-shadow: 2px 2px 5px #00004d;"><strong>Working End Time:</strong>{{ $user->workStop }}</h2>


<form method="POST" action="/placeappointments/{{$user->id}}">
  {{ csrf_field() }}
  <div class="form-group">
    <span style="text-shadow: 2px 2px 5px #00004d;">Appointment date and time:</span>
    <input type="datetime-local" name="appointmentTime" style="text-shadow: 2px 2px 5px #00004d;">
    <span style="text-shadow: 2px 2px 5px #00004d;">Hour:</span>
    <input type="number" name="hourD" min="0" max="3" value="0" style="text-shadow: 2px 2px 5px #00004d;">
    <span style="text-shadow: 2px 2px 5px #00004d;">Minute:</span>
    <input type="number" name="minD" min="0" max="59" value="20" style="text-shadow: 2px 2px 5px #00004d;">
    <input type="hidden" name="userID" value="{{$user->id}}" style="text-shadow: 2px 2px 5px #00004d;">
    <?php if(isset($hoise)) echo '<p style="color:red;">'.$hoise.'</p>' ?>
  </div>
  <button type="submit" class="btn btn-primary">Place Appointment</button>
</form>
@endsection