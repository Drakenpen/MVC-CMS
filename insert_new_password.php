<?php 
require_once 'inc/session.php';			// start session
require_once 'inc/crud.php';	// helper functions
require_once 'inc/blade.php';
$errors = [];

require 'inc/connection.php';

$Gebruikersnaam = $_GET['Gebruikersnaam'];

$query = $db->prepare("SELECT * FROM members WHERE gebruikersnaam=?");
if ($query->execute(array($Gebruikersnaam))) {
	$user = $query->fetchAll(PDO::FETCH_ASSOC);
	$username = $user[0]['gebruikersnaam'];

	if ($query->rowCount() == 0) {
		$_SESSION['errors'][] = 'Kan gebruiker met gebruikersnaam'. $Gebruikersnaam . ' niet vinden';
	}
	if ($query->rowCount() > 1) {
		$_SESSION['errors'][] = "Je haalt teveel rijen op!";
	}
}

echo $blade->view()->make('insert_new_password')->with('username', $username)->withErrors($errors)->render();