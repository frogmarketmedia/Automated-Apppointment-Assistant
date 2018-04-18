@extends('layout')
@section('content')
<div>
    <h2 align="left">User List</h2>
    <div class="search" >
      <form method="POST" action="/user">
        {{ csrf_field() }}
        <input type="text" placeholder="Search User's" name="searched">
      </form>
    </div>
    <ul align="left">
      <li>NameProfession</li>
    </ul>
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
    </ul>
  @endif
  
</div>
<style>

 
h2 {
  
  left: 100px;
  font: 400 40px/1.5 Helvetica, Verdana, sans-serif;
  margin: 0;
  padding: 0;
 
}
 
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

.search input[type=text] {
    position: absolute;
    top: 120px;
    right: 80px;
    float: right;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;

}
@media screen and (max-width: 600px) {
   .search{
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
}


</style>

@endsection
