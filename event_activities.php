<?php 
 require_once 'inc/session.php';
 require_once 'inc/blade.php';
 require_once'inc/connection.php';
 $errors = [];
// go away if user not logged in
if ( empty($_SESSION['userId'])) {
    die('not allowed if not logged in.');
}

	$id = $_GET['id'];

	$sth = $db->prepare("SELECT * FROM events WHERE id=? ORDER BY id ASC");
	// controleer of er een foutmelding is ontstaan en zo ja, plaats die dan in $_SESSION['errors'][] = $msg

	if ($sth->execute(array($id)))
	{
  		$events = $sth->fetchAll(PDO::FETCH_ASSOC);	
  		if ( $sth->rowCount() == 0 ) $_SESSION['errors'][] = 'Kan event met id '. $id .' niet vinden';
		if ( $sth->rowCount() > 1 ) $_SESSION['errors'][] = 'Je haalt teveel rijen op';
	}
	else
	{
		$_SESSION['errors'][] = 'Het is niet gelukt om de gegevens op te halen.';
	}

    $userid = $_SESSION['userId']; 
	$sth = $db->prepare("SELECT activities.id as id, activities.event_id, activities.title, activities.banner_url, activities.description,
    ( select count(ma.activity_id) as aantal
	  from members_activities ma 
	  where ma.member_id = ? 
	  and ma.activity_id = activities.id  
    ) as ingeschreven
    FROM activities
    WHERE activities.event_id = ?");
	$sth->execute(array($userid, $id));
	/* Fetch all of the remaining rows in the result set */
	$activities = $sth->fetchAll(PDO::FETCH_ASSOC); 
	// tell blade to create HTML from the template "login.blade.php"
	echo $blade->view()->make('event_activities')
	->with('events', $events)
	->with('activities', $activities)
    ->with('userid', $userid)
    ->withErrors($errors)->render();
