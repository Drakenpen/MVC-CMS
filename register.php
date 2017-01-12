<?php 
require_once 'inc/session.php';			// start session
require_once 'inc/crud.php';	// helper functions
require_once 'inc/blade.php';			// creates $blade 
$errors = [];

if ( IsLoggedInSession()==true ) {
	// stuur direct door naar main pagina
	$_SESSION['errors'][] = "Je bent al ingelogd, klik <a href='main.php'>hier</a> om direct door te gaan.";
}

echo $blade->view()->make('register')->withErrors($errors)->render();