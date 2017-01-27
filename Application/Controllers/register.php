<?php
	session_start();

class Register extends Controller
{
    public function index()
    {
        require APP . 'Views/_templates/header.php';
        require APP . 'Views/register/index.php';
        require APP . 'Views/_templates/footer.php';
    }

/** werkt soort van */
    public function Register_Action()
    {
    	$this->model->registerNewUser();

 		header('location: ' . URL . 'login/index');
    	 
    }

 }