@extends('layout')

@section('content')

<?php
use App\Educations;
use App\Experiences;
$user=Auth::user();
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
@endsection





