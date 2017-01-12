<?php
require_once 'inc/crud.php';
require 'inc/connection.php';
require 'inc/session.php';

$Gebruikersnaam = $_POST['gebruikersnaam'];
$Wachtwoord = $_POST['nieuw_wachtwoord_1'];
$Herhaal_wachtwoord = $_POST['nieuw_wachtwoord_2'];
$Hash = Password_Hash($Wachtwoord, PASSWORD_DEFAULT);


if ($Wachtwoord !== $Herhaal_wachtwoord) {
	$_SESSION['errors'][] = 'Wachtwoorden komen niet overeen!';
	header('Location: insert_new_password.php?Gebruikersnaam=' . $Gebruikersnaam);
	exit;
}


$query = $db->prepare("UPDATE members SET wachtwoord=? WHERE gebruikersnaam=?");
if ($query->execute(array($Hash, $Gebruikersnaam))) {
	if ($query->rowCount() == 0) {
		$_SESSION['errors'][] = 'De gegevens zijn niet gevonden of er is iets foutgegaan!';
		header('Location: insert_new_password.php?Gebruikersnaam=' . $Gebruikersnaam);
		exit;
	}
	if ($query->rowCount() > 1 ) {
		$_SESSION['errors'][] = 'Je bewerkt teveel gegevens!';
		header('Location: insert_new_password.php?Gebruikersnaam=' . $Gebruikersnaam);
		exit;
	}
	if ($query->rowCount() == 1 ) {
		$_SESSION['errors'][] = 'Uw nieuwe wachtwoord is opgeslagen in de database en klaar voor gebruik!';
		header('Location: login.php');
		exit;
	}
}