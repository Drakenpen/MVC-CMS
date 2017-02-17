<?php

class Home extends Controller
{
    public function index()
    {
        $_SESSION['errors']= [];
        if ( $this->model->isLoggedInSession()==false ) 
        {
        // stuur direct door naar main pagina
        $_SESSION['errors'][] = "U bent ingelogd!";
        header('location: ' . URL . 'login/index');
        } 
        else 
        {
            require APP . 'Views/_templates/header.php';
            require APP . 'Views/home/index.php';
            require APP . 'Views/_templates/footer.php';
        }
    }

    public function about()
    {
        {
            require APP . 'Views/_templates/header.php';
            require APP . 'Views/home/about.php';
            require APP . 'Views/_templates/footer.php';
        }
    }


}
