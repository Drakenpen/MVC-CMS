<div class="container">
<hr class="featurette-divider">
    <div>
        <h3>Edit an activity</h3>
        <form action="<?php echo URL; ?>events/updateactivity" method="POST">
            <label>Event ID</label>
            <input autofocus type="text" name="event_id" value="<?php echo htmlspecialchars($activity->event_id, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Title</label>
            <input autofocus type="text" name="title" value="<?php echo htmlspecialchars($activity->title, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Banner</label>
            <input type="text" name="banner_url" value="<?php echo htmlspecialchars($activity->banner_url, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Description</label>
            <input type="text" name="description" value="<?php echo htmlspecialchars($activity->description, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="hidden" name="activity_id" value="<?php echo htmlspecialchars($activity->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_activity" value="Update" />
        </form>
    </div>

<hr class="featurette-divider">
