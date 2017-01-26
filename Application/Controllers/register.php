<?php
class Register extends Controller
{
    public function index()
    {
        require APP . 'Views/_templates/header.php';
        require APP . 'Views/register/index.php';
        require APP . 'Views/_templates/footer.php';
    }

/** werkt */
    public function Register_Action()
    {
        if (isset($_POST["submit_add_user"])) {
            $this->model->registerNewUser();
    	}
     	header('location: ' . URL . 'login/index');
    }


 }