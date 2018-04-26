@extends('layout')
@section('content')
<div>
  <div align="right">
    <div style="position: relative;right: 0;">
      <div class="search" >
        <form method="POST" action="/user">
          {{ csrf_field() }}
          <input type="text" placeholder="Search User's" name="searched">
          <button type="submit"><img src="/image/search_icon.png"/></button>
        </form>
      </div>
    </div>
  </div>
  <div style="padding-top: 25px;" class="details">
    @if(isset($details))
        <div class="row">
        @foreach($details as $user)
        <div class="col-3">
          <a href="/user/{{$user->id}}">
            <div class="card" >
              @if(isset($user->avatar))
              <img src="{{$user->avatar}}" alt="Avatar" style="width:100%;">
              @else
              <img src="{{asset('/image/default.jpg')}}" alt="Avatar" style="width:100%;">
              @endif
              <div class="container">
                <h4><b>{{ $user->name }}</b></h4> 
                <p>{{ $user->profession }}</p> 
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    @else
      <div class="row">
        @foreach($users as $user)
        <div class="col-3">
          <a href="/user/{{$user->id}}">
            <div class="card" >
              @if(isset($user->avatar))
              <img src="{{$user->avatar}}" alt="Avatar" style="width:100%;">
              @else
              <img src="{{asset('/image/default.jpg')}}" alt="Avatar" style="width:100%;">
              @endif
              <div class="container">
                <h4><b>{{ $user->name }}</b></h4> 
                <p>{{ $user->profession }}</p> 
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
      <div style="padding-left: 450px; padding-top: 25px;" >
       {!! str_replace('/?', '?', $users->render()) !!}
      </div>
    @endif
    </div>
</div>
  
<style>
a:link {
    color: red;
    text-decoration: none;
}
a:visited {
    color: green;
    text-decoration: none;
}
a:hover {
    color: hotpink;
    text-decoration: none;
}
a:active {
    color: blue;
    text-decoration: none;
}
.details img {
  width: 150px;
  height: 300px;
  max-height: 300px;

  size: cover;
}
.search{
    align-self: right;
    border: none;
    font-size: 17px;

}
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 100%;
    height: 100%;

}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
    padding: 2px 16px;
}
</style>
 
@endsection
