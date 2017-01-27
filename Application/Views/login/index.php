<div class="container">
    <h2>You are in the View: application/view/login/index.php</h2>
    <div class="box">
        <h3>Log in</h3>
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
                    <a href="password_forget.php">Wachtwoord vergeten?</a>
                </div>
                <br>
                  <input name="remember" type="checkbox" value="checked"> Onthoud mij <br>
                <br>
                <input type="submit" name="submit_login" value="Submit"/>
            </div>
        </form>
    </div>
</div>