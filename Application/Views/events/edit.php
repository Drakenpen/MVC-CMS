<div class="container">
<hr class="featurette-divider">
    <div>
        <h3>Edit an event</h3>
        <form action="<?php echo URL; ?>events/updateevent" method="POST">
            <label>Title</label>
            <input autofocus type="text" name="title" value="<?php echo htmlspecialchars($event->title, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Banner</label>
            <input type="text" name="large_banner_url" value="<?php echo htmlspecialchars($event->large_banner_url, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Start</label>
            <input type="text" name="start_date" value="<?php echo htmlspecialchars($event->start_date, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>End</label>
            <input type="text" name="end_date" value="<?php echo htmlspecialchars($event->end_date, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_event" value="Update" />
        </form>
    </div>

<hr class="featurette-divider">
