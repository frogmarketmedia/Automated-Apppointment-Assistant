@extends('layout')
@section('content')
<h1>{{ $user->name }}</h1>
<h2>{{ $user->profession }}</h2>
<h2>{{ $user->phone }}</h2>
<h2>{{ $user->email }}</h2>

<form method="POST" action="">
  		{{ csrf_field() }}
  		<button type="submit" class="btn btn-primary">Confirm Appointments</button>
</form>
@endsection
