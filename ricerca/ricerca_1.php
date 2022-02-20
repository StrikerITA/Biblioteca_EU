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
		<div class="px-4 py-5 my-5 text-center container rounded-5 align-middle"  style="background-color: #eee;">
			<h1>Cerca un libro</h1><br>
		<form class="row g-3" action="ricerca/visualizzazione.php" method="POST">
			<!--selezione-->
			<div class="col-md-2">
			<select class="form-control" name="selezione">
				<option value="1">Titolo</option>
				<option value="0">Autore</option>
			</select>
			</div>
			<div class="col-md-8"> 
				<input required placeholder="inserire: " class="form-control " name="testo" type="text">
			</div>
			<!--text-->
		
			<!--botton-->			  
			<div class="col-md-1">
				<button type="submit" value="Submit" class="btn btn-primary">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</form>
		</div>
	</body>
</html>