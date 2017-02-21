<div class="container">
<hr class="featurette-divider">
        <div class="form" id="register">
        <form action="<?php echo URL; ?>register/register_action" method="POST">
        <div>
            <div>
                <label>Voornaam:</label>
            </div><br>
                <input type="text" name="voornaam" class="form-control" value="" placeholder="Voornaam" required />
        </div><br>
        <div>
            <div>
                <label>Achternaam:</label>
            </div><br>
                <input type="text" name="voorvoegsel" class="form-control" placeholder="Voorvoegsel" value="" /><br>
                <input type="text" name="achternaam" class="form-control" placeholder="Achternaam" value="" required />
        </div><br>
        <div>
            <div>
                <label>Gebruikersnaam:</label>
            </div><br>
                <input type="text" name="gebruikersnaam" class="form-control" placeholder="Gebruikersnaam" value="" required />
        </div><br>        
        <div>
            <div>
                <label>Email:</label>
            </div><br>
                <input type="email" name="email" class="form-control" placeholder="Email" value="" required />
        </div><br>
        <div>
            <div>
                <label>Wachtwoord:</label>
            </div><br>
                <input type="password" name="wachtwoord" class="form-control" placeholder="**********" value="" required />
        </div><br>
            <div>
                <input type="submit" name="submit_add_user" value="Submit" class="btn" />
            </div><br>
        </form>
        </div>
<hr class="featurette-divider">