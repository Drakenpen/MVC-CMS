<?php
class Register extends Controller
{
    public function index()
    {
        $_SESSION['errors']= [];
	    if ( $this->model->IsLoggedInSession()==true ) 
		{
		// stuur direct door naar main pagina
	    $_SESSION['errors'][] = "U bent ingelogd!";
		header('location: ' . URL . 'home/index');
		} 
		else 
		{
        	require APP . 'Views/_templates/header.php';
        	require APP . 'Views/register/index.php';
        	require APP . 'Views/_templates/footer.php';
    	}
    }

/** werkt soort van */
    public function Register_Action()
    {
    	$this->model->registerNewUser();

 		header('location: ' . URL . 'login/index');
   	 
    }

 }