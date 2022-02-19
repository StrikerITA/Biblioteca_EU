<!DOCTYPE html>

<!-- Formattare tutto il foglio, indentazione mancante -->
 
<html>
<head>
<title>
Biblioteca Online 
</title>
<!-- <link rel="stylesheet" href="stilebiblioteca.css"> -->

	
</head>
<body>
<?php
include "../header.php";
?>


<p><h1> Log-in </h1></p>



<td>
	<!-- action mancante -->
<form method="post" action="/Biblioteca_polizzi/login_registrazione/intermediario.php">

	Email <input id="inserimento" type="email" name="email" required>
	<br><br>
	Password <input id="inserimento" type="password" name="password" required>
	<br><br>
	Codice fiscale <input id="inserimento" type="text" name="codice_fiscale" required>
	<br><br>
	<button id="button" type="submit">
	Login
	</button>

</form>


<!-- action deve andare a registrazione.php -->
<form method="post" action="registrazione.php"></form>
	
	<br><br>
	<p> Non hai ancora un account creato ? Crealo qui sotto! </p>
	<button id ="button" type="submit"> Registrati </button>

</form>
</td>
<!-- spostare tutto il blocco sopra -->


</body>
</html>
	