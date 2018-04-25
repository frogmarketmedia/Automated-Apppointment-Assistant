@extends('layout')
@section('content')
<div>
  <div class="search" >
    <form method="POST" action="/user">
      {{ csrf_field() }}
      <input type="text" placeholder="Search User's" name="searched">
      <button type="submit"><img src="/image/search_icon.png"/></button>
    </form>
  </div>
  <div class="content" style="width: 2000px;">
    <h3 style="float: left;padding-left: 40px;"> Name</h3>
    <h3 style="padding-left: 310px; "> Profession</h3>
  </div>
  @if(isset($details))
    <ul align="left">
      @foreach($details as $user)
        <li><a href="/user/{{$user->id}}">{{ $user->name }}</a>{{ $user->profession }}</li>
      @endforeach 
    </ul>
  @else
    <ul align="left">
      @foreach($users as $user)
        <li><a href="/user/{{$user->id}}">{{ $user->name }}</a>{{ $user->profession }}</li>
      @endforeach
        <div class="pagination">{!! str_replace('/?', '?', $users->render()) !!}</div> 
    </ul>

  @endif
  
</div>
<br>
<br>
  
<style>

 
ul {
  list-style-type: none;
  margin: 0;
  padding: 100;
}
 
li {
  border-bottom: 2px solid #ccc;
  -webkit-column-count: 2; /* Chrome, Safari, Opera */
  -moz-column-count: 2; /* Firefox */
  column-count: 2;
}
li:last-child {
  border: none;
}
li p{
   display: inline;
   font: 100 10px/1.5 Helvetica, Verdana, sans-serif;

}
 
li a {
  font: 200 20px/1.5 Helvetica, Verdana, sans-serif;
  display: inline;
  text-decoration: none;
  color: #5D6D7E;
  display: block;
  width: 200px;
 
  -webkit-transition: font-size 0.3s ease, background-color 0.3s ease;
  -moz-transition: font-size 0.3s ease, background-color 0.3s ease;
  -o-transition: font-size 0.3s ease, background-color 0.3s ease;
  -ms-transition: font-size 0.3s ease, background-color 0.3s ease;
  transition: font-size 0.3s ease, background-color 0.3s ease;
}
 
li a:hover {
  font-size: 30px;
  color: #5D6D7E;
  text-decoration:none;
}
.content{
  -webkit-column-count: 2; /* Chrome, Safari, Opera */
  -moz-column-count: 2; /* Firefox */
  column-count: 2;
}
.search{
    float: right;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
    -webkit-column-count: 2; /* Chrome, Safari, Opera */
    -moz-column-count: 2; /* Firefox */
    column-count: 2;

}
.pagination{
    transform-origin: unset;
    transform-style: unset;
    transform: unset;
    transition: unset;
    user-focus: unset;
    border: none;

}


</style>
 
@endsection
