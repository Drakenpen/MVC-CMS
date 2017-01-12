<?php
require_once 'inc/crud.php';
require_once 'inc/connection.php';
require_once 'inc/session.php';


	$sth = $db->prepare("SELECT * FROM activities");
	$sth->execute();
	$activities = $sth->fetchAll(PDO::FETCH_ASSOC);

$items = array();
foreach($activities as $activity) {
 $items[] = $activity;
}

print_r($items);