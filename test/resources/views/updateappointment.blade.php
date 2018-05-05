@extends('layout')

@section('content')

<form method="POST" action="/user/updateappointment/{{$app->id}}/updated">
  {{ csrf_field() }}
  <div class="form-group">
     @if(isset($refer))
      <input type="hidden" value="{{$refer['notificationidu']}}" name="notificationidu"/><br>
     @endif
  	 <input type="hidden" value="{{$app->id}}" name="id"/><br>
  	 <input type="hidden" value="{{$app->user_id}}" name="user_id"/><br>
  	 <input type="hidden" value="{{$app->client_id}}" name="client_id"/><br>
    <?php
      use App\User;
      $username=User::find($app->client_id);
      $user = Auth::user();
    ?>
    <h2 style="text-shadow: 2px 2px 5px #00004d;"><strong>Appointment From: </strong>{{$username->name}}</h2>
  	<h2 style="text-shadow: 2px 2px 5px #00004d;"><strong>Old  Appointment date and time:</strong>{{$app->appointmentTime}}</h2>
    <h2 style="text-shadow: 2px 2px 5px #00004d;"><strong>Old  Appointment duration: </strong>{{$app->hour}}Hr  {{$app->min}}Min </h2>
    <h2 style="text-shadow: 2px 2px 5px #00004d;"><strong>Works From </strong>{{$user->workStart }} <strong> To </strong> {{$user->workStop }}</h2>
    <h2 style="text-shadow: 2px 2px 5px #00004d;"></strong>New Appointment date and time:</strong></h2>
    <input type="datetime-local" name="appointmentTime" value="{{$app->appointmentTime}}">
    Hour:
    <input type="number" name="hourD" min="0" max="3" value="0">
    Min:
    <input type="number" name="minD" min="0" max="59" value="20">
    <?php if(isset($hoise)) echo "<p>$hoise</p>" ?>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection