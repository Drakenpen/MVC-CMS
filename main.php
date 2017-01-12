<?php 
require_once 'inc/session.php';
require_once 'inc/blade.php';
$errors = [];


echo $blade->view()->make('main')->withErrors($errors)->render();
