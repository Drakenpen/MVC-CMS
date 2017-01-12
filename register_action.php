<?php
require_once 'inc/crud.php';
require 'inc/connection.php';
require 'inc/session.php';
require 'inc/random.php';


$Voornaam = $_POST['voornaam'];
$Voorvoegsel = $_POST['tussenvoegsel'];
$Achternaam = $_POST['achternaam'];
$Gebruikersnaam = $_POST['gebruikersnaam'];
$Email = $_POST['email'];
$Wachtwoord = $_POST['wachtwoord'];
$Herhaal_wachtwoord = $_POST['wachtwoord2'];
$Hash = md5($Wachtwoord);
$Validation_token = generateRandomString(10);

if ( empty($_POST['voornaam']) || empty($_POST['achternaam']) || empty($_POST['gebruikersnaam']) || empty($_POST['email']) || empty($_POST['wachtwoord']) || empty($_POST['wachtwoord2'])) {
	$_SESSION['errors'][] = 'Één van de velden of meer zijn niet ingevuld.';
	header('Location: register.php');
	exit;
}

if ($Wachtwoord !== $Herhaal_wachtwoord) {
	$_SESSION['errors'][] = 'Wachtwoorden komen niet overeen!';
	header('Location: register.php');
	exit;
}

if ( strlen( $Wachtwoord ) < 8 ) 
	{
   	  	if ( preg_match( "/[^0,9]/", $Wachtwoord ) ) {
			$_SESSION['errors'][] = 'Uw wachtwoord moet minimaal 8 tekens lang zijn';
			header('Location: register.php');
			exit;
  		}
}

$sql = $db->prepare("SELECT * FROM members WHERE gebruikersnaam=?");
if ($sql->execute(array($Gebruikersnaam)))
	{
		if ( $sql->rowCount() > 0 ) {
			$_SESSION['errors'][] = 'De gebruikersnaam bestaat al!';
			header('Location: register.php');
			exit;
		}
	}

$query = $db->prepare("SELECT * FROM members WHERE email=?");
if ($query->execute(array($Email)))
	{
		if ( $query->rowCount() > 0 ) {
			$_SESSION['errors'][] = 'Deze emailadres is al in gebruik!';
			header('Location: register.php');
			exit;
		}
	}

$sth = $db->prepare("INSERT INTO members (voornaam, voorvoegsel, achternaam, email, wachtwoord, gebruikersnaam, validation_token) VALUES (?, ?, ?, ?, ?, ?, ?)");
if ($sth->execute(array($Voornaam, $Voorvoegsel, $Achternaam, $Email, $Hash, $Gebruikersnaam, $Validation_token)))
{
	require 'inc/validation_mail.php';

	$id = $db->lastInsertId();

	$result = SendActivationEmail($id, $Email, $Voornaam, $Validation_token);

	$_SESSION['errors'][] = 'De ingevoerde gegevens zijn opgeslagen in de database, maar nog niet geverifieerd.';
	header('Location: login.php');
	exit;
}
else
{
	$_SESSION['errors'][] = 'Er is iets fout gegaan. Probeer het later nog eens.';
	header('Location: register.php');
	exit;
}

$_SESSION['errors'][] = 'De ingevoerde gegevens zijn opgeslagen in de database, maar nog niet gevarieerd.';
header('Location: login.php');
exit;
