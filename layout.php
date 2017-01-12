<?php 

 require_once 'inc/session.php';
 require_once 'inc/blade.php';
 $errors = [];
 

// output everything
echo $blade->view()->make('layout')->withErrors($errors)->render();