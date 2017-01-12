<?php
require_once 'inc/crud.php';
require 'inc/connection.php';
require 'inc/session.php';

$activity_id = $_POST['activity_id'];
$member_id = $_POST['member_id'];

if ( empty($activity_id) || empty($member_id)) {
	$_SESSION['errors'][] = 'Één van de velden of meer zijn niet ingevuld.';
	header('Location: events.php');
	exit;
}

$sql = $db->prepare("DELETE FROM members_activities WHERE activity_id=? AND member_id=?");
if ($sql->execute(array($activity_id, $member_id)))
		if ( $sql->rowCount() > 0 ) {
            $_SESSION['errors'][] = 'U bent nu niet meer ingeschreven voor deze activiteit';            
			header('Location: events.php');
			exit;
		}

$sth = $db->prepare("INSERT INTO members_activities (activity_id, member_id) VALUES (?, ?)");
if ($sth->execute(array($activity_id, $member_id)))
{
	$_SESSION['errors'][] = 'De activiteit is toegevoegd.';
	header('Location: events.php');
	exit;
}
else
{
	$_SESSION['errors'][] = 'Er is iets fout gegaan. Probeer het later nog eens.';
	header('Location: events.php');
	exit;
}

