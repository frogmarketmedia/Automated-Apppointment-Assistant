@extends('layout')
@section('content')
<div>
    <div style="width :1200px;">
        <div style="width :300px;float:right;">
            <h1 class="">Starfox221</h1>
            <a href="/users"><img title="profile image" class="img-circle img-responsive" src="http://www.rlsandbox.com/img/profile.jpg"></a>
            <button type="button" class="btn btn-success">Edit Image</button> 
        </div>
        <div style="width :500px; float:left;">
            <ul>
              <li><a class="active" href="#home">Home</a></li>
              <li><a href="#news">News</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><a href="#about">About</a></li>
            </ul>
        </div>
        
    </div>
</div>
<style>

ul {
    
    list-style-type: none;
    margin: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
</style>
@endsection