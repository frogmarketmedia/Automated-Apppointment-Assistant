@extends('layout')
@section('content')
<h1>{{ $user->name }}</h1>
<h2>{{ $user->profession }}</h2>
<h2>{{ $user->phone }}</h2>
<h2>{{ $user->email }}</h2>
<form method="GET" action="/placeappointments/{{$user->id}}">
  		{{ csrf_field() }}
  		<div class="top-right links">
            <button type="submit" class="btn btn-primary">Place Appointment</button>
        </div>
</form>
@endsection
