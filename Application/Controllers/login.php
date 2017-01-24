<?php

class Login extends Controller
{
    public function index()
    {
        require APP . 'Views/_templates/header.php';
        require APP . 'Views/login/index.php';
        require APP . 'Views/_templates/footer.php';
    }

/** placeholder */
    public function Login_Action()
    {
        if (isset($_POST["user_login"])) {
            $this->model->loginUser();
    	}
     	header('location: ' . URL . 'login/index');
    }


 }