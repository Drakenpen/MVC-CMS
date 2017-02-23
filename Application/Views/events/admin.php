<div class="container">
<i>(work in progress)</i>
<hr class="featurette-divider">
        <h3>Add an event here:</h3><br>
        <form action="<?php echo URL; ?>events/addevent" method="POST">
            <label>Title</label>
            <input type="text" name="title" value="" required />
            <label>Banner</label>
            <input type="text" name="large_banner_url" value="" required />
            <label>Starts</label>
            <input type="text" name="start_date" value="" required />
            <label>Ends</label>
            <input type="text" name="end_date" value="" /><br><br>
            <input type="submit" name="submit_add_event" value="Submit" class="btn btn-info"/>
        </form>
        <br>
        <div class="box">
        <h3>Add an activity here:</h3><br>
        <form action="<?php echo URL; ?>events/addactivity" method="POST">
     
            
           <label>Event</label>
                <select name="event_id" value="" required>
                <?php foreach ($events as $event) { ?>
                  <option value="<?php if (isset($event->id)) echo htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($event->id)) echo htmlspecialchars($event->title, ENT_QUOTES, 'UTF-8'); ?></option>
                  <?php } ?>
                </select>
                            
            <label>Title</label>
            <input type="text" name="title" value="" required />
            <label>Banner</label>
            <input type="text" name="banner_url" value="" required />
            <label>Description</label>
            <input type="text" name="description" value="" /><br><br>
            <input type="submit" name="submit_add_activity" value="Submit" class="btn btn-info"/>
        </form>
        </div>

    <hr class="featurette-divider">
    <div class="featurette" id="events">
        <h4><i>A total of <?php echo $amount_of_events; ?> events were found:</i></h4><br>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Title</td>
                <td>Banner</td>
                <td>Starts</td>
                <td>Ends</td>
                <td>DELETE</td>
                <td>EDIT</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td><?php if (isset($event->id)) echo htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($event->title)) echo htmlspecialchars($event->title, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($event->large_banner_url)) echo htmlspecialchars($event->large_banner_url, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($event->start_date)) echo htmlspecialchars($event->start_date, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($event->end_date)) echo htmlspecialchars($event->end_date, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'events/deleteEvent/' . htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8'); ?>">Delete</a></td>
                    <td><a href="<?php echo URL . 'events/editEvent/' . htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a></td>
                </tr>
            <?php } ?>
            </tbody>


        </table>
    </div>
<hr class="featurette-divider">
   <div class="featurette" id="activities">
        <h4><i>A total of <?php echo $amount_of_activities; ?> activities were found:</i></h4><br>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Event</td>
                <td>Title</td>
                <td>Banner</td>
                <td>DELETE</td>
                <td>EDIT</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($activities as $activity) { ?>
                <tr>
                    <td><?php if (isset($activity->event_id)) echo htmlspecialchars($activity->event_id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($activity->title)) echo htmlspecialchars($activity->title, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($activity->banner_url)) echo htmlspecialchars($activity->banner_url, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'events/deleteActivity/' . htmlspecialchars($activity->id, ENT_QUOTES, 'UTF-8'); ?>">Delete</a></td>
                    <td><a href="<?php echo URL . 'events/editActivity/' . htmlspecialchars($activity->id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a></td>
                </tr>
            <?php } ?>
            </tbody>



        </table>
    </div>

<hr class="featurette-divider">
