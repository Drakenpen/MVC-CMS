<!doctype html>
<html>
<head>
	<link href="css/style.css" rel="stylesheet">
	<title>Inschrijfsysteem</title>
	<script src="https://use.fontawesome.com/bf8ab24a40.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<!-- show the topmenu bar -->
<div class="topbar">

@if(isset($_SESSION['userEmail']))
	<span class="">Gebruiker: {{ $_SESSION['userEmail'] }}</span>
	<span class="" style="float:right;"><a class="navbar_link" href="logout_action.php">Logout</a></span>
@else
	<span class="" style="float:right;"><a class="navbar_link" href="register.php">Registreren</a></span>
	<span class="" style="float:right;"><a class="navbar_link" href="login.php">Login</a></span>
@endif
<span style="float:left;"></span>
</div>


<?php
   if ( isset($_SESSION['errors'])) {
      $errors = $_SESSION['errors'];
      $_SESSION['errors'] = array();  // remove all errors
   } 
   else
   {
      $_SESSION['errors'] = array();
   }
 ?>
 

@if(isset($errors))       {{-- does $errors exist? --}}
  @if(count($errors)>0)     {{-- does $errors have any errors? --}}
    <div class="control-sidebar-bg"></div>
      <ul>
        @foreach ($errors as $error)   
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
@endif

<!-- content goes here -->
<div class="content">
@yield('content')
</div>


<div style="display:none;" class="debugbar">
	<div class="debugbar-inner">
		<div class="col">
			<h3>Cookie contents: </h3>
			<p><?php print_r($_COOKIE); ?></p>
		</div>

		<div class="col">
			<h3>Session contents: </h3>
			<p><?php print_r($_SESSION); ?></p>
		</div>

	</div>
</div>

<script src="http://code.jquery.com/jquery-1.7.min.js"></script>
<script src="js/password_verification.js"></script>

</body>
</html>