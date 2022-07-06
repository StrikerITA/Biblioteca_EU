<!DOCTYPE html>
	<!-- Formattare tutto il foglio, indentazione mancante --> 
<html>
	<head>
		<title>Biblioteca Online </title>
	<!-- <link rel="stylesheet" href="stilebiblioteca.css"> -->		
	</head>
	<body>
		<?php include "../header.php"; ?>
		<div class="px-4 py-5 my-5 text-center container rounded-5 align-middle"  style="background-color: #eee;">
			<p>
				<h1> Log-in </h1>
			</p>
			<form method="post" action="/Biblioteca_polizzi/login_registrazione/intermediario.php">
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						<label for="[]" class="form-label"></label>
						<input placeholder="Email" class="form-control px-5" id="inserimento" type="email" name="email" required>
						<label for="[]" class="form-label"></label>
					</div>
				</div>
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						<input placeholder="Password" class="form-control px-5" id="inserimento" type="password" name="password" required>
						<label for="[]" class="form-label"></label>
					</div>
				</div>
				<div class="row">
					<div class="col-5"></div>
					<div class="col-2">
					<button class="btn btn-primary" id="button" type="submit">Login</button>
					</div>
				</div>
			</form>
				<!-- action va in registrazione.php -->
			<label class="text-secondary">
				Non hai ancora creato un account ? Clicca <a href="/Biblioteca_polizzi/login_registrazione/registrazione.php"> registrati</a>! 
     		</label>
		</div>
		<?php include "../footer.html"; ?>
	</body>
</html>