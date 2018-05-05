<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Appointment Assistant</title>
  </head>
  <body>
    <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="/" class="navbar-brand d-flex align-items-center">
            
            <strong>Appointment Assistant</strong>
          </a>
            <?php 
              use App\Appointment;
              $user = Auth::user();
              if(!is_null($user))
              {
                $notificationcount =count(Auth::user()->unreadNotifications);
                $notify = Auth::user()->unreadNotifications;
              }
          ?>
            @auth
            <div style="padding-left: 600px;">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-decoration: none; color: white;">
                <strong>{{$user->name}}</strong></a> 
               <ul class="dropdown-menu" role="menu">
                  <li>
                     <a href="/home" role="button" style="text-decoration: none; color: #1A5276;">
                    My Profile</a>
                  </li>
                  <li>
                     <a href="/user/{{$user->id}}/edit" role="button" style="text-decoration: none;color: #1A5276;">
                    Edit Profile</a>
                  </li>
                  <li>
                     <a href="/user" role="button" style="text-decoration: none; color: #1A5276;">
                    Users</a>
                  </li>
                  <li>
                     <a href="logout" role="button" style="text-decoration: none; color: #1A5276;">
                    Logout</a>
                  </li>
                </ul>
              </li>
            </div>
            <div align="right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: white;">
               <i class="fa fa-globe" style="font-size:20px;"></i><span class="badge">{{$notificationcount}}</span></a> 
               <ul class="dropdown-menu" role="menu">
                  @foreach($notify as $notification)
                  <li>
                    @if($notification->type=='App\Notifications\AppointmentGiven')
                      @include('notifications.appointmentGiven')
                    @elseif($notification->type=='App\Notifications\AppointmentDelete')
                      @include('notifications.cancelAppointment')
                    @elseif($notification->type=='App\Notifications\AppointmentApproved')
                      @include('notifications.approvedAppointment')
                    @elseif($notification->type=='App\Notifications\AppointmentUpdate')
                      @include('notifications.updateAppointment')
                    @endif
                  </li>
                  @endforeach
                </ul>
              </li>
          </div>
          @endauth
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
              <div class="center-block">
                @yield('content')
              </div>
        </div>
      </section>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>New to Appointment Assistant? <a href="/">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>