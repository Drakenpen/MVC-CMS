<!doctype html>
<html>
<head>
	<link href="css/style.css" rel="stylesheet">
	<title>Valideer account</title>
	<script src="https://use.fontawesome.com/bf8ab24a40.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
						<h1>Validate account</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<p>Dear {{$Voornaam}}</p>
					<p>Thank you for making a account on our website!</p>
					<p>But before you can officially use your account, please click on the validation link down below.</p>
					<a href="http://localhost/inschrijfsysteem_2/validate_action.php?id={{$id}}&token={{$Validation_token}}">Validation link</a>
				</div><!--/col-sm-6-->
			</div><!--/row-->
		</div>
	</body>
</html>

