@extends('layout')
@section('content')
<h1>{{ $user->name }}</h1>
<h2>{{ $user->profession }}</h2>
<h2>{{ $user->phone }}</h2>
<h2>{{ $user->email }}</h2>
<form method="POST" action="/placeappointments">
  		 {{ csrf_field() }}
  		 @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <button type="submit" class="btn btn-primary">Give Appointments</button>
                @endauth
            </div>
        @endif
  		
</form>
@endsection
