<!DOCTYPE html>
<html>

	<head>
		<title>Gestione Biblioteca</title>
	</head>

	<body>
		<?php
			include "../header.php";
		?>
		<!-- A che servono le label se poi non vengono usate? -->
		<div class="px-4 py-5 my-5 text-center container" style="background-color: #eee;">
			<form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
					<textarea required class="form-control" placeholder="Descrizione" name="descrizione"></textarea>
				</div>

				<div class="col-md-3">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Pagina" type="number" class="form-control" name="pagine">
				</div>
				
				<div class="col-md-3">
					<label for="[]" class="form-label"></label>	
					<input required placeholder="Numero Copie" type="number" class="form-control" name="numeroCopie">
				</div>

				<div class="col-md-3">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Copie Disponibili" type="number" class="form-control" name="copieDisponibili">
				</div>
				
				<div class="col-md-3">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Ultimo Prezzo" type="number" step="0.01" class="form-control" name="ultimoPrezzo">
				</div>

				<!-- Si potrebbe aggiungere una dropbox con la scelta delle categorie già esistenti -->
				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Codice Categoria" type="text"  class="form-control" name="codiceCategoria">
				</div>

				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Codice Libro" type="text"  class="form-control" name="codiceLibro">
				</div>

				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required class="form-control form-control-sm" type="file" name="immagine">
				</div>
				
				<!-- Bisogna dare la funzione che mette l'immagine dal sito alla cartella -->
				<div class="col-12">
					<button required type="submit" class="btn btn-primary">Invia</button>
				</div>
			</form>
		</div>
		<?php
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				if(!empty($_POST["autore"]) && !empty($_POST["editore"]) && !empty($_POST["titolo"]) && !empty($_POST["descrizione"]) && !empty($_POST["immagine"]) && !empty($_POST["pagine"]) && !empty($_POST["ultimoPrezzo"]) && !empty($_POST["numeroCopie"]) && !empty($_POST["copieDisponibili"]) && !empty($_POST["codiceCategoria"]) && !empty($_POST["codiceLibro"])){
					$autore = $_POST["autore"];
					$editore = $_POST["editore"];
					$titolo = $_POST["titolo"];
					$descrizione = $_POST["descrizione"];
					$immagine = $_POST["immagine"];
					$pagine = $_POST["pagine"];
					$ultimoPrezzo = $_POST["ultimoPrezzo"];
					$numeroCopie = $_POST["numeroCopie"];
					$copieDisponibili = $_POST["copieDisponibili"];
					$codiceCategoria = $_POST["codiceCategoria"];
					$codiceLibro = $_POST["codiceLibro"];

					// ho aggiunto queste due righe che servono a prendere il nome edil file immagine, ti lascio qui il link per il sito che ho visto
					// http://talkerscode.com/webtricks/upload%20image%20to%20database%20and%20server%20using%20HTML,PHP%20and%20MySQL.php
					$immagine_nome = $_FILES["immagine"]["name"];
					$imagetmp = addslashes (file_get_contents($_FILES['immagine']['tmp_name']));
					
					$servername="localhost";
					$username="root";
					$password="";
					$dbname="biblioteca";
						
					$conn = new mysqli($servername, $username, $password, $dbname);
						
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					$sql = "INSERT INTO libro(CodiceLibro, Autore, Editore, Titolo, Descrizione, Immagine, Pagine, UltimoPrezzo, NumeroCopie, CopieDisponibili, CodiceCategoria) 
					VALUES('$codiceLibro', '$autore', '$editore', '$titolo', '$descrizione', '$immagine', '$pagine', '$ultimoPrezzo', '$numeroCopie', '$copieDisponibili', '$codiceCategoria')";

					if($conn->query($sql) === TRUE){
						echo "Un nuovo libro è stato aggiunto con successo!";
					} else {
						echo "Error: " . "<br>" . $conn->error;
					}
					
					//controlla l'header che da errore ma l'inserimento dei libri ora va
					header('Location: Biblioteca_polizzi/ricerca/ricerca_1.php');
					$conn->close();
				}
			}
		?>
	</body>
</html>