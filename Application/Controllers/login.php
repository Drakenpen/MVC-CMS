<?php
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

 /**placeholder */ 
    public function Login_Action()
    {
        if (empty($_SESSION['errors'])) {
            $this->model->checkUser();
    	}
     	//header('location: ' . URL . 'home/index');
    }

/** test function 
    public function Login_Action()
    {
        if (isset($_POST["submit_login"])) {
            $this->model->checkUser();
    	}
     	header('location: ' . URL . 'home/index');
    }
*/


 }