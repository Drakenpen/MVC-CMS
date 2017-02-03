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

    public function event_activities()
    {
	        $activities = $this->model->getActivity();
	        $events = $this->model->loadEvents();

        	require APP . 'Views/_templates/header.php';
        	require APP . 'Views/events/event_activities.php';
        	require APP . 'Views/_templates/footer.php';
    	
    }
}