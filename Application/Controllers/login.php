<?php

class Login extends Controller
{
    public function index()
    {
    	$_SESSION['errors']= [];
		if ( $this->model->isLoggedInSession()==true ) 
		{
		// stuur direct door naar main pagina
	    $_SESSION['errors'][] = "U bent ingelogd!";
		header('location: ' . URL . 'home/index');
		} 
		else 
		{
        	require APP . 'Views/_templates/header.php';
        	require APP . 'Views/login/index.php';
        	require APP . 'Views/_templates/footer.php';
    	}
    }

/** werkt soort van 
    public function Login_Action()
    {
    	$this->model->checkUser();

     	header('location: ' . URL . 'login/index');
    	 
    }*/

    public function Login_Action()
    {
    	$_SESSION['errors']= [];
		// redirect back to login with error if user didn't enter email
		if ( empty($_POST['email']) ) {
			$_SESSION['errors'][] = 'Fout: Geen e-mail ingevuld.';
		}

		// redirect back to login with error if user didn't enter pass
		if ( empty($_POST['wachtwoord']) ) {
			$_SESSION['errors'][] = 'Fout: Geen wachtwoord ingevuld.';
		}

		// check if user can be found
		if (empty($_SESSION['errors'])) $result = $this->model->checkUser($_POST['email'], $_POST['wachtwoord']);

		header('location: ' . URL . 'login/index');
    }

    public function logout()
    {
    	$this->model->logout();

    	header('location: ' . URL . 'home/index');
    }


 }