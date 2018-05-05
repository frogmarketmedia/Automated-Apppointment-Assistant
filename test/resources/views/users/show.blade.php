@extends('layout')

@section('content')
<?php
use App\Educations;
use App\Experiences;
$educations = Educations::where('user_id','=',$user->id)->get();
$experiences = Experiences::where('user_id','=',$user->id)->get();
?>
 @if(isset($user->avatar))
  <img src="{{$user->avatar}}" style=" width:250px; height:300px; float:left;  margin-right:25px;">
  @else
    <img class="imagesize img-responsive center-block" src="{{asset('/image/default.jpg')}}" style="width:250px; height:300px; float:left; margin-right:25px;">
  @endif
<h1 style="text-shadow: 2px 2px 5px #00004d;" ><strong>{{ $user->name }}</strong></h1>
<h2 style="text-shadow: 2px 2px 5px #00004d; font-size: 20px; padding-left: 250px;">Profession:{{ $user->profession }}</h2>
@foreach($experiences as $experience)
@if($experience->present)
  <h2 style="text-shadow: 2px 2px 5px #00004d; width: 80%; padding-left: 500px;font-size: 20px;">{{$experience->designation}} at {{$experience->work_place}}</h2>
@else
  <h2 style="text-shadow: 2px 2px 5px #00004d; width: 80%; padding-left: 500px;font-size: 15px;">Worked as {{$experience->designation}} at {{$experience->work_place}}</h2>
@endif
@endforeach
<br>
@foreach($educations as $education)
@if($education->present)
  <h2 style="text-shadow: 2px 2px 5px #00004d; width: 80%; padding-left: 500px;font-size: 20px;">Studies {{$education->degree}} at {{$education->department}},{{ $education->institution }}</h2>
@else
  <h2 style="text-shadow: 2px 2px 5px #00004d; width: 80%; padding-left: 500px;font-size: 15px;">Studied {{$education->degree}} at {{$education->department}},{{ $education->institution }}</h2>
@endif
@endforeach

<h2 style="text-shadow: 2px 2px 5px #00004d; padding-left: 200px;font-size: 20px;">Phone:{{ $user->phone }}</h2>
<h2 style="text-shadow: 2px 2px 5px #00004d; padding-left: 200px; font-size: 20px;">Email:{{ $user->email }}</h2>
<h2 style="text-shadow: 2px 2px 5px #00004d; padding-left: 250px; font-size: 20px;">Rating:{{ $user->rating }}</h2>
<br>
<br>
<br>
<form id="demo" class="rating" method="POST" action="/setrating/{{$user->id}}" style="padding-left: 30px;">
  {{ csrf_field() }}
  <input type="submit" style="position: absolute; left: -9999px"/>
  <label>
    <input type="radio" name="stars" value="1" />
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="2" />
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="3" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>   
  </label>
  <label>
    <input type="radio" name="stars" value="4" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="5" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>

</form>
<form method="GET" action="/placeappointments/{{$user->id}}" style="padding-left: 300px;">
      {{ csrf_field() }}
      <div class="top-right links">
            <button type="submit" class="btn btn-primary">Place Appointment</button>
        </div>
</form>
<style type="text/css">
.rating {
  display: inline-block;
  position: relative;
  height: 50px;
  line-height: 50px;
  font-size: 50px;
}

.rating label {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  cursor: pointer;
}

.rating label:last-child {
  position: static;
}

.rating label:nth-child(1) {
  z-index: 5;
}

.rating label:nth-child(2) {
  z-index: 4;
}

.rating label:nth-child(3) {
  z-index: 3;
}

.rating label:nth-child(4) {
  z-index: 2;
}

.rating label:nth-child(5) {
  z-index: 1;
}

.rating label input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.rating label .icon {
  float: left;
  color: transparent;
}

.rating label:last-child .icon {
  color: #000;
}

.rating:not(:hover) label input:checked ~ .icon,
.rating:hover label:hover input ~ .icon {
  color: #09f;
}

.rating label input:focus:not(:checked) ~ .icon:last-child {
  color: #000;
  text-shadow: 0 0 5px #09f;
}
</style>
@endsection





