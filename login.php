<?php 
 require_once 'inc/session.php';
 require_once 'inc/crud.php';
 require_once 'inc/blade.php';
 $errors = [];

if ( IsLoggedInSession()==true ) {
	// stuur direct door naar main pagina
    $_SESSION['errors'][] = "U bent al ingelogd!";
	header('location: main.php');
	exit;
}
else
{
 // output everything
echo $blade->view()->make('login')->withErrors($errors)->render();
}