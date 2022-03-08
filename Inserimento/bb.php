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
			<form enctype="multipart/form-data" class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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

				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Pagina" type="number" class="form-control" name="pagine">
				</div>
				
				<div class="col-md-4">
					<label for="[]" class="form-label"></label>	
					<input required placeholder="Numero Copie" type="number" class="form-control" name="numeroCopie">
				</div>

				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Copie Disponibili" type="number" class="form-control" name="copieDisponibili">
				</div>
				
				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Ultimo Prezzo" type="number" step="0.01" class="form-control" name="ultimoPrezzo">
				</div>

				<!-- Si potrebbe aggiungere una dropbox con la scelta delle categorie già esistenti -->
				<div class="col-md-4">
					<label for="[]" class="form-label"></label>
					<input required placeholder="Codice Categoria" type="text"  class="form-control" name="codiceCategoria">
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
		
		<?php
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				if(!empty($_POST["autore"]) && !empty($_POST["editore"]) && !empty($_POST["titolo"]) && !empty($_POST["descrizione"]) /*&& !empty($_POST["image"])*/ && !empty($_POST["pagine"]) && !empty($_POST["ultimoPrezzo"]) && !empty($_POST["numeroCopie"]) && !empty($_POST["copieDisponibili"]) && !empty($_POST["codiceCategoria"])){
					$autore = $_POST["autore"];
					$editore = $_POST["editore"];
					$titolo = $_POST["titolo"];
					$descrizione = $_POST["descrizione"];
					//$immagine = $_POST["image"];
					$pagine = $_POST["pagine"];
					$ultimoPrezzo = $_POST["ultimoPrezzo"];
					$numeroCopie = $_POST["numeroCopie"];
					$copieDisponibili = $_POST["copieDisponibili"];
					$codiceCategoria = $_POST["codiceCategoria"];
					//$codiceLibro = $_POST["codiceLibro"];

					// ho aggiunto queste due righe che servono a prendere il nome edil file immagine, ti lascio qui il link per il sito che ho visto
					// http://talkerscode.com/webtricks/upload%20image%20to%20database%20and%20server%20using%20HTML,PHP%20and%20MySQL.php
					//$immagine_nome = $_FILES["immagine"]["name"];


					//


					$tmp = $_FILES['image']['tmp_name']; 
					$type = $_FILES['image']['type'];
					$size = $_FILES['image']['size'];
					$ext = get_ext($type);
					$folder = "/Biblioteca_polizzi/Immagini/";
					//$ext = get_ext($type); //estensione dell'immagine
					$name = time().rand(0,999); //timestamp attuale + un numero random compreso tra 0 e 999
					$name = $name.$ext; //aggiungo al nome appena creato l'estensione
					$immagine=$name;
					//$name = $folder.$name; //aggiungo il folder di destinazione
					//esempio risultato finale: folder/timestamp657.gif
					echo $name;
					//$immagine=$name;
					if(move_uploaded_file($_FILES['image']['tmp_name'],"Immagini/".$name)) {

						echo 'Immagine caricata con successo, <a href="'.$name.'"/>vai all\'immagine</a> <br />';
						echo '<a href="/uploader/index.php">Torna all\'uploader</a>';



						$servername="localhost";
						$username="root";
						$password="";
						$dbname="biblioteca";
							
						$conn = new mysqli($servername, $username, $password, $dbname);
							
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}

						$sql = "INSERT INTO libro (autore, editore, titolo, descrizione,immagine, pagine, ultimoPrezzo, numeroCopie, copieDisponibili, codiceCategoria)
						VALUES('$autore' , '$editore' , '$titolo' , '$descrizione' , '$immagine' , '$pagine' , '$ultimoPrezzo' , '$numeroCopie' , '$copieDisponibili' , '$codiceCategoria')";

						if($conn->query($sql) === TRUE){
							echo "Un nuovo libro è stato aggiunto con successo!";
						} else {
							echo "Error: " . "<br>" . $conn->error;
						}
						
						//controlla l'header che da errore ma l'inserimento dei libri ora va
						//header('Location: Biblioteca_polizzi/ricerca/ricerca_1.php');
						$conn->close();
					} else {
						echo "Non è stato possibile caricare l'immagine<br />";
					}

					//
					//$imagetmp = addslashes (file_get_contents($_FILES['immagine']['tmp_name']));
					
					
				}
			}


			function check_ext($tipo) {

				switch($tipo) {
					case "image/png": 
						return true;
						break;
					case "image/jpg":
						return true;
						break;
					case "image/jpeg":
						return true;
						break;
					case "image/gif":
						return true;
						break;
					
						break;
					default:
						return false;
						break;
				}
			
			}
			
			function get_ext($tipo) {
			
				switch($tipo) {
					case "image/png": 
						return ".png";
						break;
					case "image/jpg":
						return ".jpg";
						break;
					case "image/jpeg":
						return ".jpg";
						break;
					case "image/gif":
						return ".gif";
						break;
					
					default:
						return false;
						break;
				}
			
			}
			
			function get_error($tmp, $type, $size, $max_size) {
			
				if(!is_uploaded_file($tmp)) {
					echo "File caricato in modo non corretto<br />";
				}
				if(!check_ext($type)) {
					echo "Estensione del file non ammesso<br />";
				}
				if($size > $max_size) {
					echo "Dimensione del file troppo grande<br />";
				}
				echo '<a href="/uploader/index.php">Torna all\'uploader</a>';
			
			}
		?>
	</body>
</html>