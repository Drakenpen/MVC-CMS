<div class="container">
    <h2>You are in the View: application/view/register/index.php (everything in this box comes from that file)</h2>
    <div class="box">
        <h3>Log in</h3>
        <form action="<?php echo URL; ?>login/CheckUserIsValid" method="POST">
            <div>
                <div>
                    <label for="Email">Email</label>
                    <div>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email" required>
                    </div>
                </div>
                <br>
                <div>
                    <label for="pwd">Wachtwoord</label>
                    <div>
                        <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" placeholder="Enter password">
                    </div>
                </div>
                <br>
                <div>       
                    <a href="password_forget.php">Wachtwoord vergeten?</a>
                </div>
                <br>
                  <input name="remember" type="checkbox" value="checked"> Onthoud mij <br>
                <br>
                <input type="submit" name="submit_login" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>
    </div>
</div>