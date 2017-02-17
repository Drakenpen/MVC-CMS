<?php

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all songs from database
     */
    public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a song to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a song from database
     */
    public function getSong($song_id)
    {
        $sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a song in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $song_id Id
     */
    public function updateSong($artist, $track, $link, $song_id)
    {
        $sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     */
    public function getAmountOfSongs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
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

    public function loadEvents()
    {
        $sql = "SELECT * FROM events ORDER BY id ASC";
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


    /** End Admin model
    */
}