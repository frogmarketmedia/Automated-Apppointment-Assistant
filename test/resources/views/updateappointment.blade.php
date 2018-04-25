@extends('layout')

@section('content')

<form method="POST" action="/user/updateappointment/{{$app->id}}/updated">
  {{ csrf_field() }}
  <div class="form-group">
  	 <input type="hidden" value="{{$app->id}}" name="id"/><br>
  	 <input type="hidden" value="{{$app->user_id}}" name="user_id"/><br>
  	 <input type="hidden" value="{{$app->client_id}}" name="client_id"/><br>
  	Old  Appointment date and time:{{$app->appointmentTime}}<br>
    New Appointment date and time:
    <input type="datetime-local" name="appointmentTime" value="{{$app->appointmentTime}}">
    <?php if(isset($hoise)) echo "<p>$hoise</p>" ?>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection