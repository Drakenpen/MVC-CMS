<?php

class Admin extends Controller
{
    public function index()
    {
        $_SESSION['errors']= [];
	    if ( $this->model->isAdmin()==false ) 
		{
		// stuur direct door naar main pagina
	    $_SESSION['errors'][] = "U heeft geen admin rechten!";
		header('location: ' . URL . 'home/index');
		} 
		else 
		{
        	require APP . 'Views/_templates/header.php';
        	require APP . 'Views/admin/index.php';
        	require APP . 'Views/_templates/footer.php';
    	}
    }


 }