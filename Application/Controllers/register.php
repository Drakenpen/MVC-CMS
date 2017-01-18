<?php

class Register extends Controller
{
    public function index()
    {
        require APP . 'Views/_templates/header.php';
        require APP . 'Views/register/index.php';
        require APP . 'Views/_templates/footer.php';
    }
    
/** werkt niet */
    public function addUser() 
    { 
        if (isset($_POST["submit_add_user"])) { 
         	$this->model->addUser($_POST["voornaam"], $_POST["tussenvoegsel"], $_POST["achternaam"], $_POST["email"], 			$_POST["wachtwoord"], $_POST["gebruikersnaam"]);
    } 
     header('location: ' . URL . 'register/index');
 	}


/** werkt */
    public function Register_Action()
    {
        if (isset($_POST["submit_add_user"])) {
            $this->model->Register_Action($_POST["voornaam"], $_POST["voorvoegsel"],  $_POST["achternaam"], $_POST["email"]);
    }
      header('location: ' . URL . 'register/index');
    }

 }