<?php

class RegisterController extends Controller
{
    public function index()
    {
        require APP . 'Views/_templates/header.php';
        require APP . 'Views/register/index.php';
        require APP . 'Views/_templates/footer.php';
    }

      public function register_action() 
     { 
         $registration_successful = $this->RegistrationModel->register_action(); 
  
         if ($registration_successful) { 
             Redirect::to('home/index'); 
         } else { 
             Redirect::to('home/index'); 
         } 
     } 

 }