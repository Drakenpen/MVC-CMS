<?php

class RegistrationModel
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


public function checkIfPostIsValid()

	$Voornaam = $_POST['voornaam'];
	$Voorvoegsel = $_POST['tussenvoegsel'];
	$Achternaam = $_POST['achternaam'];
	$Gebruikersnaam = $_POST['gebruikersnaam'];
	$Email = $_POST['email'];
	$Wachtwoord = $_POST['wachtwoord'];
	$Herhaal_wachtwoord = $_POST['wachtwoord2'];
	$Hash = md5($Wachtwoord);

if ( empty($_POST['voornaam']) || empty($_POST['achternaam']) || empty($_POST['gebruikersnaam']) || empty($_POST['email']) || empty($_POST['wachtwoord']) || empty($_POST['wachtwoord2'])) {
	$_SESSION['errors'][] = 'Één van de velden of meer zijn niet ingevuld.';
	return false;
	exit;
}
	
public function checkNewPassword()
{
if ($Wachtwoord !== $Herhaal_wachtwoord) {
	$_SESSION['errors'][] = 'Wachtwoorden komen niet overeen!';
	return false;
	exit;
}

if ( strlen( $Wachtwoord ) < 8 ) 
	{
   	  	if ( preg_match( "/[^0,9]/", $Wachtwoord ) ) {
			$_SESSION['errors'][] = 'Uw wachtwoord moet minimaal 8 tekens lang zijn';
			return false;
			exit;
  		}
	}
}

public function checkNewUsername()
$sql = $db->prepare("SELECT * FROM members WHERE gebruikersnaam=?");
if ($sql->execute(array($Gebruikersnaam)))
	{
		if ( $sql->rowCount() > 0 ) {
			$_SESSION['errors'][] = 'De gebruikersnaam bestaat al!';
			return false;
			exit;
		}
	}

public function checkNewEmail()
$query = $db->prepare("SELECT * FROM members WHERE email=?");
if ($query->execute(array($Email)))
	{
		if ( $query->rowCount() > 0 ) {
			$_SESSION['errors'][] = 'Deze emailadres is al in gebruik!';
			return false;
			exit;
		}
	}


public function addNewUserToDatabase ($Voornaam, $Voorvoegsel, $Achternaam, $Email, $Hash, $Gebruikersnaam)
$sth = $db->prepare("INSERT INTO members (voornaam, voorvoegsel, achternaam, email, wachtwoord, gebruikersnaam) VALUES (?, ?, ?, ?, ?, ?)");
if ($sth->execute(array($Voornaam, $Voorvoegsel, $Achternaam, $Email, $Hash, $Gebruikersnaam)))
{
	$_SESSION['errors'][] = 'De ingevoerde gegevens zijn opgeslagen in de database..';
	header('location: ' . URL . 'login/index');
	exit;
}
else
{
	$_SESSION['errors'][] = 'Er is iets fout gegaan. Probeer het later nog eens.';
	header('location: ' . URL . 'register/index');
	exit;
}

$_SESSION['errors'][] = 'De ingevoerde gegevens zijn opgeslagen in de database, maar nog niet gevarieerd.';
header('location: ' . URL . 'login/index');
exit;

 }

}

/** if yes or no in Model  (return true/false;) 

register has a check if yes = show x
