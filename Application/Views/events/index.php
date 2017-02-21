<div class="container">
		<h2>Kies een event om een activiteit te selecteren</h2>

<hr class="featurette-divider">

    <?php foreach ($events as $event) { ?>
	    <div class="featurette">
	    	<?php if (isset($event->id)) { ?>
	    	<a href="<?php echo URL; ?>events/activities?id=<?php echo ($event->id); ?>">
	    	<?php } ?>
		    	<div class="img" style='background-image:url(<?php if (isset($event->small_banner_url)) echo ($event->small_banner_url); ?>)'>
		            <div class="img2"'>
		            	<p><?php if (isset($event->title)) echo htmlspecialchars($event->title, ENT_QUOTES, 'UTF-8'); ?></p>
		            	<p><?php if (isset($event->start_date)) echo htmlspecialchars($event->start_date, ENT_QUOTES, 'UTF-8'); ?></p>
		            	<p><?php if (isset($event->end_date)) echo htmlspecialchars($event->end_date, ENT_QUOTES, 'UTF-8'); ?></p>
		            </div>
		        </div>
	        </a>
	    </div>
	<?php } ?>

<hr class="featurette-divider">


