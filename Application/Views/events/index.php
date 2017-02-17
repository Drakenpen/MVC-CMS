<div class="container">

		<div class="img" style='background-image'>
			<h3>Kies een event om een activiteit te selecteren</h3>
        </div>  

    <?php foreach ($events as $event) { ?>
	    <div class="box">
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
</div>