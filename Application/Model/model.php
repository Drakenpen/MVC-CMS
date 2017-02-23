<?php

class Model
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /** Functional registration model
    */

    public function registerNewUser()
    {
        $voornaam = $_POST['voornaam'];
        $voorvoegsel = $_POST['voorvoegsel'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $wachtwoord = $_POST['wachtwoord'];
        //$wachtwoord_hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $wachtwoord_hash = md5($wachtwoord);

        if ($this->checkNewEmail($email)) { 
            return false;
            } 

        if ($this->checkNewUsername($gebruikersnaam)) { 
            return false;
            } 

        if ($this->addUsertoDB($voornaam, $voorvoegsel, $achternaam, $email, $gebruikersnaam, $wachtwoord_hash)) { 
            return false; 
            } 
    }


    public function checkNewEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM members WHERE email=?");
        if ($query->execute(array($email))){
            }
        $count = $query->rowCount();
        if ($count==1){
            return true;
        }
        return false;
    }

    public static function doesEmailExist($email) 
    { 
  
        $query = $this->db->prepare("SELECT id FROM members WHERE email = :email LIMIT 1"); 
        $query->execute(array(':email' => $email)); 
        $count = $query->rowCount();
        if ($count==1){
            return true;
        }
        return false;
    }


    public function checkNewUsername($gebruikersnaam)
    {
        $query = $this->db->prepare("SELECT * FROM members WHERE gebruikersnaam=?");
        if ($query->execute(array($gebruikersnaam))){
            }
        $count = $query->rowCount();
        if ($count==1){
            return true;
        }
        return false;
    }

    public static function doesUsernameExist($gebruikersnaam) 
    { 
  
        $query = $this->db->prepare("SELECT id FROM members WHERE gebruikersnaam = :gebruikersnaam LIMIT 1"); 
        $query->execute(array(':gebruikersnaam' => $gebruikersnaam)); 
        $count = $query->rowCount();
        if ($count==1){
            return true;
        }
        return false;
    }

    public function addUsertoDB($voornaam, $voorvoegsel, $achternaam, $email, $gebruikersnaam, $wachtwoord_hash)
    {
        $sql = "INSERT INTO members (voornaam, voorvoegsel, achternaam, email, gebruikersnaam, wachtwoord_hash) 
                        VALUES (:voornaam, :voorvoegsel, :achternaam, :email, :gebruikersnaam, :wachtwoord_hash)";
        $query = $this->db->prepare($sql);
        $query->execute (array(':voornaam' => $voornaam, 
                               ':voorvoegsel' => $voorvoegsel, 
                               ':achternaam' => $achternaam, 
                               ':email' => $email, 
                               ':gebruikersnaam' => $gebruikersnaam, 
                               ':wachtwoord_hash' => $wachtwoord_hash));
        $count = $query->rowCount();
        if ($count==1){
            return true;
        }
        return false;
    }

    /** End login model
    */

    /** Functional login model
    */

    public static function logout()
    {
        session_destroy();
    }

    public function isLoggedInSession()
    {
        if (isset($_SESSION['Id'])==false || empty($_SESSION['Id']) ) {
            return 0;
        }
        else
        {
            return 1;
        }
    }


    public function checkUser()
    {      
        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
        $wachtwoord_hash = password_hash($wachtwoord, PASSWORD_DEFAULT); 
      //  $wachtwoord_verified = password_verify($wachtwoord, $wachtwoord_hash);
        $wachtwoord_verified = md5($wachtwoord);

        if ($this->getUserFromDB($email, $wachtwoord_verified)) { 
            return false; 
            }
    } 

    public function getUserFromDB($email, $wachtwoord_verified)
    {
        $sql = "SELECT id, gebruikersnaam, email, isadmin, voornaam FROM members 
                WHERE email = :email AND wachtwoord_hash = :wachtwoord_hash AND active=1 ;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':email' => $email, 
                              ':wachtwoord_hash' => $wachtwoord_verified));
        //echo $email;
        //echo $wachtwoord_verified;
        $count = $query->rowCount();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($count == 1) {
                $_SESSION['Id'] = $row['id'];
                $_SESSION['Gebruikersnaam'] = $row['gebruikersnaam'];
                $_SESSION['Email'] = $row['email'];
                $_SESSION['isAdmin'] = $row['isadmin'];
                $_SESSION['Voornaam'] = $row['voornaam'];
        }
        else
        {
            $_SESSION['errors'][] = "Combinatie van gebruikersnaam en wachtwoord niet gevonden";
        }
    }

    /** End login model
    */

    /** Event model
    */

    public function amountEvents()
    {
        $sql = "SELECT COUNT(id) AS amount_of_events FROM events";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->amount_of_events;
    }

    public function amountActivities()
    {
        $sql = "SELECT COUNT(id) AS amount_of_activities FROM activities";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->amount_of_activities;
    }

    public function loadEvents()
    {
        $sql = "SELECT * FROM events ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function loadActivities()
    {
        $sql = "SELECT * FROM activities ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function selectEvent()
    {
        $id = $_GET['id'];

        $sql = "SELECT * FROM events WHERE id=? ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $query->execute(array($id));

        return $query->fetchAll();
    }


    public function loadEventActivities()
    {
        $id = $_GET['id'];
        $userid = $_SESSION['Id']; 

        $sql = "SELECT activities.id AS id, activities.event_id, activities.title, activities.banner_url, 
                activities.description,  
                (SELECT count(ma.activity_id) AS aantal 
                FROM members_activities ma WHERE ma.member_id = ? 
                AND ma.activity_id = activities.id) AS ingeschreven 
                FROM activities
                WHERE activities.event_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute(array($userid, $id));

        return $query->fetchAll();
    }

    public function selectActivity()
    {
        $activity_id = $_POST['activity_id'];
        $user_id = $_POST['user_id'];


        $sql = "DELETE FROM members_activities WHERE activity_id=? AND member_id=?";
        $query = $this->db->prepare($sql);

        $query->execute(array($activity_id, $user_id));

        $sql = "INSERT INTO members_activities (activity_id, member_id) VALUES (?, ?)";
        $query = $this->db->prepare($sql);
        $query->execute(array($activity_id, $user_id));
    }

    /** End event model
    */


    /** Admin model
    */

        /** Edit Event model 
        **/

    public function isAdmin()
    {
        if (isset($_SESSION['isAdmin'])==false || empty($_SESSION['isAdmin']) ) {
            return 0;
        }
        else
        {
            return 1;
        }
    }   

    public function addEvent($title, $large_banner_url, $start_date, $end_date)
    {
        $sql = "INSERT INTO events (title, large_banner_url, start_date, end_date) VALUES (:title, :large_banner_url,:start_date, :end_date)";
        $query = $this->db->prepare($sql);
        $parameters = array(':title' => $title, ':large_banner_url' => $large_banner_url, ':start_date' => $start_date, ':end_date' => $end_date);
        $query->execute($parameters);
    }

    public function deleteEvent($event_id)
    {
        $sql = "DELETE FROM events WHERE id = :event_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':event_id' => $event_id);
        $query->execute($parameters);
    }

    public function getEvent($event_id)
    {
        $sql = "SELECT id, title, large_banner_url, start_date, end_date FROM events WHERE id = :event_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':event_id' => $event_id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function updateEvent($title, $large_banner_url, $start_date, $end_date, $event_id)
    {
        $sql = "UPDATE events SET title = :title, large_banner_url = :large_banner_url, start_date = :start_date, end_date = :end_date WHERE id = :event_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':title' => $title, ':large_banner_url' => $large_banner_url, ':start_date' => $start_date, ':end_date' => $end_date, ':event_id' => $event_id);
        $query->execute($parameters);
    }

        /** End Edit event model 
        **/

        /** Edit Activity model 
        **/

    public function addActivity($event_id, $title, $banner_url,  $description)
    {
        $sql = "INSERT INTO activities (event_id, title, banner_url, description) VALUES (:event_id, :title, :banner_url,  :description)";
        $query = $this->db->prepare($sql);
        $parameters = array(':event_id' => $event_id, ':title' => $title, ':banner_url' => $banner_url, ':description' => $description);
        $query->execute($parameters);
    }

    public function deleteActivity($activity_id)
    {
        $sql = "DELETE FROM activities WHERE id = :activity_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':activity_id' => $activity_id);
        $query->execute($parameters);
    }

    public function getActivity($activity_id)
    {
        $sql = "SELECT id, event_id, title, banner_url, description FROM activities WHERE id = :activity_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':activity_id' => $activity_id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function updateActivity($event_id, $title, $banner_url, $description, $activity_id)
    {
        $sql = "UPDATE activities SET event_id = :event_id, title = :title, banner_url = :banner_url, description = :description WHERE id = :activity_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':event_id' => $event_id, ':title' => $title, ':banner_url' => $banner_url, ':description' => $description, ':activity_id' => $activity_id);
        $query->execute($parameters);
    }


        /** End Edit activity model 
        **/

    /** End Admin model
    */
}