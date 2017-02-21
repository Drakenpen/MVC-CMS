<div class="container">
    <h2>Welcome,   
			 <?php if ( $this->model->isAdmin()) : ?>
			    Admin
			 <?php endif; ?> 
			 <span class="text-muted"><?php echo $_SESSION['Voornaam'] ?>.</span>
			 </h2>
    <hr class="featurette-divider">

    <div class="featurette" id="index">
		<div class ="box">
		     <p>  You are currently logged in as <?php echo $_SESSION['Gebruikersnaam']; ?>.</p>
		     <p>  Your registered email address is <?php echo $_SESSION['Email']; ?>.</p>
		</div>
    </div>

	<hr class="featurette-divider">
