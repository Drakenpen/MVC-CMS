<?php 

 require_once 'inc/session.php';
 require_once 'inc/blade.php';
 require_once 'inc/crud.php';
 $errors = [];

 echo $blade->view()->make('password_forget')->withErrors($errors)->render();