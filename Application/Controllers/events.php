<?php 

class events extends Controller
{
    public function index()
    {
    	$_SESSION['errors']= [];
		if ( $this->model->IsLoggedInSession()==false ) 
		{
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

    public function selectActivity()
    {
         $this->model->selectActivity();

        header('location: ' . URL . 'events/index');
    }

    public function Admin()
    {
        $_SESSION['errors']= [];
        if ( $this->model->isAdmin()==false ) 
        {
        $_SESSION['errors'][] = "U heeft geen admin rechten!";
        header('location: ' . URL . 'home/index');
        } 
        else 
        {
            $amount_of_events = $this->model->amountEvents();
            $amount_of_activities = $this->model->amountActivities();
            $events = $this->model->loadEvents();
            $activities = $this->model->loadActivities();

            require APP . 'Views/_templates/header.php';
            require APP . 'Views/events/admin.php';
            require APP . 'Views/_templates/footer.php';
        }
    }

    public function addEvent()
    {
        $_SESSION['errors']= [];
        if ( $this->model->isAdmin()==false ) 
        {
        $_SESSION['errors'][] = "U heeft geen admin rechten!";
        header('location: ' . URL . 'home/index');
        } 
        else 
        {
        if (isset($_POST["submit_add_event"])) {
            $this->model->addEvent($_POST["title"], $_POST["large_banner_url"],  $_POST["start_date"], $_POST["end_date"]);
            }
        } 
        header('location: ' . URL . 'events/admin');
    }

    public function deleteEvent($event_id)
    {
        $_SESSION['errors']= [];
        if ( $this->model->isAdmin()==false ) 
        {
        $_SESSION['errors'][] = "U heeft geen admin rechten!";
        header('location: ' . URL . 'home/index');
        } 
        else 
        {
        if (isset($event_id)) {
            $this->model->deleteEvent($event_id);
        }
            header('location: ' . URL . 'events/admin');
        }
    }

    public function editEvent($event_id)
    {
        $_SESSION['errors']= [];
        if ( $this->model->isAdmin()==false ) 
        {
        $_SESSION['errors'][] = "U heeft geen admin rechten!";
        header('location: ' . URL . 'home/index');
        } 
        else 
        {
        if (isset($event_id)) {
            $event = $this->model->getEvent($event_id);

            require APP . 'Views/_templates/header.php';
            require APP . 'Views/events/edit.php';
            require APP . 'Views/_templates/footer.php';
        } 
        else 
            {
            header('location: ' . URL . 'events/index');
            }
        }
    }
    
    public function updateEvent()
    {
        if (isset($_POST["submit_update_event"])) {
            $this->model->updateEvent($_POST["title"], $_POST["large_banner_url"],  $_POST["start_date"], $_POST["end_date"], $_POST['event_id']);
        }
        header('location: ' . URL . 'events/admin');
    }

/** Activity controller **/

    public function addActivity()
    {
        $_SESSION['errors']= [];
        if ( $this->model->isAdmin()==false ) 
        {
        $_SESSION['errors'][] = "U heeft geen admin rechten!";
        header('location: ' . URL . 'home/index');
        } 
        else 
        {
        if (isset($_POST["submit_add_activity"])) {
            $this->model->addActivity($_POST["event_id"], $_POST["title"], $_POST["banner_url"],  $_POST["description"]);
            }
        } 
        header('location: ' . URL . 'events/admin');
    }

    public function deleteActivity($activity_id)
    {
        $_SESSION['errors']= [];
        if ( $this->model->isAdmin()==false ) 
        {
        $_SESSION['errors'][] = "U heeft geen admin rechten!";
        header('location: ' . URL . 'home/index');
        } 
        else 
        {
        if (isset($activity_id)) {
            $this->model->deleteActivity($event_id);
        }
            header('location: ' . URL . 'events/admin');
        }
    }

    public function editActivity($activity_id)
    {
        $_SESSION['errors']= [];
        if ( $this->model->isAdmin()==false ) 
        {
        $_SESSION['errors'][] = "U heeft geen admin rechten!";
        header('location: ' . URL . 'home/index');
        } 
        else 
        {
        if (isset($activity_id)) {
            $activity = $this->model->getActivity($activity_id);

            require APP . 'Views/_templates/header.php';
            require APP . 'Views/events/edit_activity.php';
            require APP . 'Views/_templates/footer.php';
        } 
        else 
            {
            header('location: ' . URL . 'events/index');
            }
        }
    }
    
    public function updateActivity()
    {
        if (isset($_POST["submit_update_activity"])) {
            $this->model->updateActivity($_POST["event_id"], $_POST["title"], $_POST["banner_url"],  $_POST["description"], $_POST['activity_id']);
        }
        header('location: ' . URL . 'events/admin');
    }
/** end activity controller**/

}