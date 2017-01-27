<?php
    session_start();
    print_r($_SESSION);

class Login extends Controller
{
    public function index()
    {
	if ( $this->model->IsLoggedInSession()==true ) 
		{
		// stuur direct door naar main pagina
	    $_SESSION['errors'][] = "U bent al ingelogd!";
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
		// redirect back to login with error if user didn't enter email
		if ( empty($_POST['email']) ) {
			$_SESSION['errors'][] = 'Fout: Geen e-mail ingevuld.';
		}

		// redirect back to login with error if user didn't enter pass
		if ( empty($_POST['wachtwoord']) ) {
			$_SESSION['errors'][] = 'Fout: Geen wachtwoord ingevuld.';
		}

		// check if user can be found
		if (empty($_SESSION['errors'])) $result = CheckUser($_POST['email'], $_POST['wachtwoord']);
    }


 }