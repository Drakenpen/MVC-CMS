<div class="container">
    <h2>You are in the View: application/view/register/index.php</h2>
        <div class="box">
        <form action="<?php echo URL; ?>register/register_action" method="POST">
        <div>
            <div>
                <label>Voornaam:</label>
            </div><br>
            <input type="text" name="voornaam" value="" placeholder="Voornaam" required />
        </div><br>
        <div>
            <div>
                <label>Achternaam:</label>
            </div><br>
            <input type="text" name="voorvoegsel" placeholder="Voorvoegsel" value="" /><br>
            <input type="text" name="achternaam" placeholder="Achternaam" value="" required />
        </div><br>
        <div>
            <div>
                <label>Gebruikersnaam:</label>
            </div><br>
            <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" value="" required />
        </div><br>        
        <div>
            <div>
                <label>Email:</label>
            </div><br>
            <input type="email" name="email" placeholder="Email" value="" required />
        </div><br>
        <div>
            <div>
                <label>Wachtwoord:</label>
            </div><br>
            <input type="password" name="wachtwoord" placeholder="**********" value="" required />
        </div><br>
            <input type="submit" name="submit_add_user" value="Submit" />
        </form>
    </div>