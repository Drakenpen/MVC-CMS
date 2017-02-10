<div class="container">
    <h2>You are in the View: application/view/events/activities.php</h2>
	
	<form action="<?php echo URL; ?>events/select" method="POST">
	    <?php foreach ($events as $event) { ?>	    
		<div class="img" style='background-image:url(<?php if (isset($event->small_banner_url)) echo ($event->small_banner_url); ?>)'>  
		<p><?php if (isset($event->title)) echo htmlspecialchars($event->title, ENT_QUOTES, 'UTF-8'); ?></p>
		<?php } ?> 
        </div>  

	    <?php foreach ($activities as $activity) { ?>
	    <div class="box">
			<p><?php if (isset($activity->title)) echo htmlspecialchars($activity->title, ENT_QUOTES, 'UTF-8'); ?></p>
			<p><?php if (isset($activity->description)) echo htmlspecialchars($activity->description, ENT_QUOTES, 'UTF-8'); ?></p>
	                
	        <input type="hidden" name="activity_id" value="<?php if (isset($activity->id)) echo htmlspecialchars($activity->id, ENT_QUOTES, 'UTF-8'); ?>" >
	        <input type="hidden" name="member_id" value="<?php $_SESSION['Id'] ?>" >
	        <input type="submit" name="submit" id="submit" value="Select" class="btn btn-info pull-right">
		<?php } ?>
		</div>
	</form>

</div>