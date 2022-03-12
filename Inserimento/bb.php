<!DOCTYPE html>
<html>

	<head>
		<title>Gestione Biblioteca</title>
	</head>

	<body>
		


		<?php
			include "../header.php";
			if (isset($_SESSION["privilegi"])) {   
				if(!$_SESSION["privilegi"]==1){
					header("Location: /Biblioteca_polizzi/deniedAccess.php");
				}
			}else{
				header("Location: /Biblioteca_polizzi/deniedAccess.php");
			}
		?>
		<!-- A che servono le label se poi non vengono usate? -->
		<div class="px-4 py-5 my-5 text-center container" style="background-color: #eee;">
			<form enctype="multipart/form-data" class="row g-3" method="POST" action="carico.php">
				<div class="col-md-4">
					<input required placeholder="Titolo" type="text" class="form-control" name="titolo">
				</div>
				<div class="col-md-4">
					<input required placeholder="Autore" type="text" class="form-control" name="autore">
				</div>
				<div class="col-md-4">
					<input required placeholder="Editore" type="text" class="form-control" name="editore">
				</div>

				<div class="col-md-12">
					<label for="[]" class="form-label"></label>
					<textarea required maxlength="2000" class="form-control" placeholder="Descrizione" name="descrizione"></textarea>
				</div>

				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Pagina" type="number" class="form-control" name="pagine">
				</div>
				
				<div class="col-md-4">
					<label for="[]" class="form-label"></label>	
					<input required placeholder="Numero Copie" type="number" class="form-control" name="numeroCopie">
				</div>

				<!--<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Copie Disponibili" type="number" class="form-control" name="copieDisponibili">
				</div>-->
				
				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Ultimo Prezzo" type="number" step="0.01" class="form-control" name="ultimoPrezzo">
				</div>
				<!-- Si potrebbe aggiungere una dropbox con la scelta delle categorie già esistenti -->
				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
							
				
					<select require class="form-select" name="codiceCategoria">
					<option selected>Scegli categoria</option>
						<?php
							$servername="localhost";
							$username="root";
							$password="";
							$dbname="biblioteca";

							$conn = new mysqli($servername, $username, $password, $dbname);
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							$sql = "SELECT codiceCategoria, nomeCategoria FROM categoria";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								
								while($row = $result->fetch_assoc()) {
									echo '<option value="'.$row["codiceCategoria"].'">'.$row["nomeCategoria"].'</option>';
								}
							} else {
								echo "ERRORE: NON ESISTE ALCUNA CATEGORIA";
							}						
						?>
						</select>		
				</div>

				<!--<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Codice Libro" type="text"  class="form-control" name="codiceLibro">
				</div>-->
				

				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required class="form-control form-control-sm" type="file" name="image">
				</div>
				
				<!-- Bisogna dare la funzione che mette l'immagine dal sito alla cartella -->
				<div class="col-12">
					<br>
					<button type="submit" class="btn btn-primary">Invia</button>
				</div>
			</form>
		</div>
	</body>
</html>