<?php

class RegistrationModel
{
	function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function registerNewUser()
    {
        $voornaam = $_POST['voornaam'];
        $voorvoegsel = $_POST['voorvoegsel'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $wachtwoord = $_POST['wachtwoord'];
        $wachtwoord_hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

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

}
