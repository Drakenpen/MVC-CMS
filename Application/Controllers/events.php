<?php 

class events extends Controller
{
    public function index()
    {
    	$_SESSION['errors']= [];
		if ( $this->model->IsLoggedInSession()==false ) 
		{
		// stuur direct door naar main pagina
	    $_SESSION['errors'][] = "U bent niet ingelogd!";
		header('location: ' . URL . 'login/index');
		} 
		else 
		{
	        $events = $this->model->loadEvents();

        	require APP . 'Views/_templates/header.php';
        	require APP . 'Views/events/index.php';
        	require APP . 'Views/_templates/footer.php';
    	}
    }

    public function activities()
    {
            $events = $this->model->selectEvent();
            $activities = $this->model->loadEventActivities();

            require APP . 'Views/_templates/header.php';
            require APP . 'Views/events/activities.php';
            require APP . 'Views/_templates/footer.php';
    }

    public function Select_Activity()
    {
         $this->model->selectActivity();

        header('location: ' . URL . 'home/index');
    }

}