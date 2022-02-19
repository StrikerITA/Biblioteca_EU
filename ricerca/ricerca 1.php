<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://kit.fontawesome.com/15ee1b0016.js" crossorigin="anonymous"></script>

<body>

	<?php
		$err_titolo ="";
		$testo ="";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (empty($_POST["testo"])) {
			  $err_testo="inserire il testo";
			}
		}
	?>

	

	<form action="/Biblioteca_polizzi/ricerca/visualizazione.php" method="POST">

		<div id="conteiner" class="text-select-btn">
			<!--selezione-->
			<select class="select" name="selezione">
				<option value="1">Titolo</option>
				<option value="0">Autore</option>
				
			</select>

			<!--text-->
			<input required="" placeholder="inserire: " class="insert" name="testo" type="text"/><br/>

			<!--botton-->			  
			<button type="submit" value="Submit" class="btn">
			  	<i class="fas fa-search"></i>
			</button>
		</div>
	</form>
</body>
</html>
