<div class="container">
    <h2>You are in the View: application/view/song/index.php (everything in this box comes from that file)</h2>
    <div class = "box">
        <form method="post" action="<?php echo URL; ?>register/register_action">
            <div>
                <div>
                    <label for="txt_voornaam">Voornaam</label>
                    <div>
                    <br>
                        <input type="text" class="form-control" id="voornaam" name="voornaam" placeholder="Vul een voornaam in" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <br>
                <div>
                    <label for="txt_achternaam">Achternaam</label>
                    <div>
                        <input type="text" class="form-control" name="tussenvoegsel" id="tussenvoegsel" placeholder="Tussenvoegsel (optioneel)">
                        <br>
                        <input type="text" class="form-control" name="achternaam" id="achternaam" placeholder="Vul een achternaam in" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <br>
                <div>
                    <label for="txt_gebruikersnaam">Gebruikersnaam</label>
                    <div>
                        <input type="text" class="form-control" name="gebruikersnaam" id="gebruikersnaam" placeholder="Vul een gebruikersnaam in" required>
                        <br>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <br>
                <div>
                    <label for="txt_email">Email</label>
                    <div>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Vul een email in" required>
                        <br>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <br>
                <div>
                    <label for="txt_wachtwoord">Wachtwoord</label>
                    <div>
                        <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" placeholder="Vul een wachtwoord in">
                        <br>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                    <br>
                </div>
                <input type="submit" value="Register" class="btn btn-info pull-right">
            </div>
        </form>
    </div>
