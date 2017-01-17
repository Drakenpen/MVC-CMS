<?php

class Login extends Controller
{
    public function index()
    {
        require APP . 'Views/_templates/header.php';
        require APP . 'Views/login/index.php';
        require APP . 'Views/_templates/footer.php';
    }


	public function CheckUserIsValid()
	{
		// redirect back to login with error if user didn't enter email
		if ( empty($_POST['email']) ) {
			$_SESSION['errors'][] = 'Fout: Geen e-mail ingevuld.';
		}

		// redirect back to login with error if user didn't enter pass
		if ( empty($_POST['wachtwoord']) ) {
			$_SESSION['errors'][] = 'Fout: Geen wachtwoord ingevuld.';
		}

		// check if user can be found
		if (empty($_SESSION['errors'])) $resultarray = CheckUserIsValid($db, $_POST['email'], $_POST['wachtwoord']);

		if ( $resultarray['result'] == 1 ) {
			LoginSession($resultarray['userId'], $resultarray['userEmail'], $resultarray['Gebruikersnaam']);

			// als gebruiker heeft aangevinkt "onthou mij", bewaar userId en Gebruikersnaam dan in cookie
			if ( isset($_POST['remember']) && $_POST['remember'] == "checked") {
				RememberCookie($resultarray['userId'], $resultarray['userEmail'], $resultarray['Gebruikersnaam']);
			}

			header('location: ' . URL . 'home/index');
			exit;	
		}
		else
		{
			$_SESSION['errors'][] = 'Fout: combinatie van e-mail en wachtwoord niet gevonden, of account niet actief.';
			header('location: ' . URL . 'login/index');
			exit;
		}
	}
}