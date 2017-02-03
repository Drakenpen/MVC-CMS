<div class="container">
    <h2>You are in the View: application/view/events/index.php</h2>

    <?php foreach ($events as $event) { ?>
	    <div class="box">
	    	<?php if (isset($event->title)) { ?>
	    	<a href="<?php echo htmlspecialchars($event->title, ENT_QUOTES, 'UTF-8'); ?>">
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