<?php

require_once 'inc/session.php';
require 'inc/connection.php';
require 'inc/crud.php';


$Gebruikersnaam = $_GET['gebruikersnaam'];
$Email = $_GET['email'];

if ( empty($_GET['gebruikersnaam']) ) {
	$_SESSION['errors'][] = 'Fout: geen e-mail ingevuld.';
	header('location: password_forget.php');
	exit;
}

// redirect back to login with error if user didn't enter email
if ( empty($_GET['email']) ) {
	$_SESSION['errors'][] = 'Fout: geen e-mail ingevuld.';
	header('location: password_forget.php');
	exit;
}


$query = $db->prepare("SELECT * FROM members WHERE gebruikersnaam =? AND email=?");
if ($query->execute(array($Gebruikersnaam, $Email))) {
	if ($query->rowCount() == 0) {
		$_SESSION['errors'][] = 'Het emailadres is niet gevonden in de database.';
		header('location: password_forget.php');
		exit;
	}
	if ($query->rowCount() > 1) {
		$_SESSION['errors'][] = 'Je haalt teveel rijen op!';
		header('location: password_forget.php');
		exit;
	}
	if ($query->rowCount() == 1) {
		require 'inc/password_forget_mail.php';
		$result = SendPasswordEmail($Gebruikersnaam, $Email);
	}
}

$_SESSION['errors'][] = 'Emailadres gevonden! Er is een email naar u verstuurd!';
header('location: login.php');
exit;

?>