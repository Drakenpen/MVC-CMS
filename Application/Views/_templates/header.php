<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MINI</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>


    <!-- navigation -->

    <div class="navigation">
        <a href="<?php echo URL; ?>">home</a>
        <a href="<?php echo URL; ?>login">Login</a>
        <a href="<?php echo URL; ?>register">Register</a>
    <?php if ( $this->model->IsLoggedInSession()) : ?>
            <a href="<?php echo URL; ?>events">Events</a>
            <a href="<?php echo URL; ?>login/logout">Logout</a>
            <a> Logged in as: <?php echo $_SESSION['Gebruikersnaam']; ?> </a>
    <?php endif; ?>
    </div>


