<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php
		include "../header.php";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$select = $_POST["selezione"];
			$text = $_POST["testo"];

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "biblioteca";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			//ricerca tramite autore o tramite titolo || dipende dalla var select
			if ($select == "0"){
				$sql= "SELECT CodiceLibro FROM libro WHERE Autore like'%$text%'";
			}else if ($select == "1") {
				$sql= "SELECT CodiceLibro FROM libro WHERE Titolo like'%$text%'";
			}else {
				$result = $sql = $row = " ";
			}

			$result = $conn -> query($sql);
			$row = $result->fetch_assoc();
			$CodiceLibro_ricercato = $row["CodiceLibro"];
			$sql_datilibro = "SELECT Titolo, Autore, Editore, Descrizione FROM libro WHERE CodiceLibro = '$CodiceLibro_ricercato'";

			//entra solo se abbiamo scelto la select
			if($select == "0" || $select == "1"){
				//se abbiamo scelto mi fa la query e mi trova tutti i dati basandomi sul codicelibro_ricercato
				$result_dati = $conn->query($sql_datilibro);

				//non stampava l'immagine, quindi ho scelto di creare una query per poifar stampare l'immagine
				$sql_img = "SELECT Immagine FROM libro WHERE CodiceLibro = '$CodiceLibro_ricercato'";
				$result_img = $conn->query($sql_img);
				$img = $result_img->fetch_assoc();
				$immagine = $img["Immagine"];
				echo $immagine;

				//se esiste un libro corrispondente alla ricerca lo stampa
				if($result_dati->num_rows > 0) {
					echo "<table>";
					while($row = $result_dati->fetch_assoc()) {
						//immagine non viene stampata correttamente 
						//a video viene visualizzato il percorso dell'immagine
						echo "<tr><td><th>". $CodiceLibro_ricercato ."</td><td><th>". $row["Autore"]."</td><td><th>". $row["Editore"]. "</td><td><th>". $row["Titolo"].  $row["Descrizione"]. "<img src='/Biblioteca_polizzi/Immagini/".$immagine."'/>"."</td></tr>";
					}
					echo "</table>";
				} else {
					//se non lo trova stampa l'errore
					echo "Nessun libro trovato!";
				}
			}
			
			$conn->close();
		}
	?>
</body>
</html>