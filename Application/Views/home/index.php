<div class="container">
    <h3>Welkom,     
			 <?php if ( $this->model->isAdmin()) : ?>
			    Admin
			 <?php endif; ?>
			 <?php echo $_SESSION['Voornaam'] ?>.</h3>
	<div class ="box">
	     <p>  You are currently logged in as <?php echo $_SESSION['Gebruikersnaam']; ?>.</p>
	     <p>  Your registered email address is <?php echo $_SESSION['Email']; ?>.</p>
	</div>
</div>
