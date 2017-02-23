<div class="container">
<h2>Log in om je in te schrijven voor evenementen.</h2>
<hr class="featurette-divider">
    <div class="form">
        <form action="<?php echo URL; ?>login/login_action" method="POST">
            <div>
                <div>
                    <label>Email</label>
                    <div>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="Email" >
                    </div>
                </div>
                <br>
                <div>
                    <label>Wachtwoord</label>
                    <div>
                        <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" placeholder="**********">
                    </div>
                </div>
                <br>
                <div>       
                    <a href="<?php echo URL; ?>problem/index" onclick="return confirm('Oeps. Deze functie bestaat nog niet.')" ">Wachtwoord vergeten?</a>
                </div>
                <br>
                  <input name="remember" type="checkbox" value="checked"> Onthoud mij <br>
                <br>
                <input type="submit" name="submit_login" value="Submit" class="btn"/>
                <br>
                <br>
                <p>Nog geen account? <a href="<?php echo URL; ?>register">Klik hier.</a> <p>
            </div>
        </form>
    </div>

<hr class="featurette-divider">