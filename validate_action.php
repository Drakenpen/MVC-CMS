<?php
require 'inc/crud.php';
require 'inc/connection.php';
require 'inc/session.php';

// zorg dat in de mail deze link komt: http://localhost/validate_action.php?user_id=36&token=hfwkjehflwjkeh

// get user with ID=36 from database
$id = $_GET['id'];
$Validation_token = $_GET['token'];

// compare token from that user, with token in URL   $_GET['token']
$query = $db->prepare("SELECT * FROM members WHERE id=? AND validation_token=?");
if ($query->execute(array($id, $Validation_token))) {
	if ($query->rowCount() == 0) {
		$_SESSION['errors'][] = "De token is niet gevonden of ze zijn niet hetzelfde.";
		header('Location: register.php');
		exit;
	}
}

// sla in database op dat voor deze user het veld 'active' = 1, en token moet leeg worden "" 
$sql = $db->prepare("UPDATE members SET active=1, validation_token='' WHERE id=?");
if ($sql->execute(array($id))) {

	if ($sql->rowCount() == 0) {
		$_SESSION['errors'][] = "Uw account is niet gevonden!";
		header('Location: register.php');
		exit;
	}
	if ($sql->rowCount() > 1) {
		$_SESSION['errors'][] = "Het haalt teveel rijen op!";
		header('Location: register.php');
		exit;
	}
	if ($sql->rowCount() == 1) {
		$_SESSION['errors'][] = "Uw account is officieel geactiveerd!";
		header('Location: login.php');
		exit;
	}
}