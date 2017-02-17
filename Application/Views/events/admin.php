<div class="container">
<i>(work in progress)</i>
        <h3>Add an event here:</h3>
        <form action="<?php echo URL; ?>events/addevent" method="POST">
            <label>Title</label>
            <input type="text" name="title" value="" required />
            <label>Banner</label>
            <input type="text" name="large_banner_url" value="" required />
            <label>Starts</label>
            <input type="text" name="start_date" value="" required />
            <label>Ends</label>
            <input type="text" name="end_date" value="" />
            <input type="submit" name="submit_add_event" value="Submit" />
        </form>
    <div class="box">
    <h3><i>A total of <?php echo $amount_of_events; ?> events were found.</i></h3>
    </div>
    <div class="box">
        <h3>List of events:</h3>
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
                    <td><a href="<?php echo URL . 'events/deleteEvent/' . htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
                    <td><a href="<?php echo URL . 'events/editEvent/' . htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
