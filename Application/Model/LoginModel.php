<?php

class LoginModel
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

    function LoginSession($Id, $Email, $Gebruikersnaam) {
        $_SESSION['Id'] = $Id;
        $_SESSION['Email'] = $Email;
        $_SESSION['Gebruikersnaam'] = $Gebruikersnaam;
    }

    function IsLoggedInSession() {
        if (isset($_SESSION['Id'])==false || empty($_SESSION['Id']) ) {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    function LogOut() {
        $_SESSION['errors'][] = "Logged out.";

        unset($_SESSION['Id'], $_SESSION['Email'], $_SESSION['Gebruikersnaam']);

        // verwijder het cookie door expiration 
        setcookie("Id", null, time() -3600, "/"); // 86400 = 1 day
        setcookie("Email", null, time() -3600, "/"); // 86400 = 1 day
        setcookie("Name", null, time() -3600, "/"); // 86400 = 1 day
    }


}