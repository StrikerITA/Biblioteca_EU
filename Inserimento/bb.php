<!DOCTYPE html>
<html>

<head>
	<title>Gestione Biblioteca</title>
</head>

<body>

	<?php
		$Err="";
		$autore=$editore=$titolo=$descrizione=$immagine=$pagine=$ultimoPrezzo=$numeroCopie=$copieDisponibili=$codiceCategoria="";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (empty($_POST["autore"])) {
				$Err = "campo richiesto";
			}else{
				$autore = $_POST["autore"];
			}

			 if( empty($_POST["editore"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$editore = $_POST["editore"];
    		}
			
			if( empty($_POST["titolo"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$titolo = $_POST["titolo"];
    		}

    		if( empty($_POST["descrizione"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$descrizione = $_POST["descrizione"];
    		}

    		if( empty($_POST["immagine"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$immagine = $_POST["immagine"];
    		}

    		if( empty($_POST["pagine"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$pagine = $_POST["pagine"];
    		}

    		if( empty($_POST["ultimoPrezzo"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$ultimoPrezzo = $_POST["ultimoPrezzo"];
    		}

    		if( empty($_POST["numeroCopie"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$numeroCopie = $_POST["numeroCopie"];
    		}

    		if( empty($_POST["copieDisponibili"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$copieDisponibili = $_POST["copieDisponibili"];
    		}

    		if( empty($_POST["codiceCategoria"])){
   	 			$Err = "campo richiesto";
    		}else{
   				$codiceCategoria = $_POST["codiceCategoria"];
    		}

		}

	?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Autore: <input type = "text" name = "autore">
		<br>
		<br>

		Editore: <input type="text" name="editore">
		<br>
		<br>

		Titolo: <input type="text" name="titolo">
		<br>
		<br>

		Descrizione: <input type="text" name="titolo">
		<br>
		<br>

		Immagine: <input type="file" name="immagine">
		<br>
		<br>

		Pagine: <input type="text" name="pagine">
		<br>
		<br>

		Ultimo prezzo: <input type="text" name="ultimoPrezzo">
		<br>
		<br>

		Numero copie: <input type="text" name="numeroCopie">
		<br>
		<br>

		Copie disponibli: <input type="text" name="copieDisponibili">
		<br>
		<br>

		Codice categoria: <input type="text" name="codiceCategoria">
		<br>
		<br>

		<input type="submit" name="invia" value="submit">
</form>

		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$servername="localhost";
		$username="root";
		$password=false;
		$dbname="biblioteca";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
 			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO libro (autore, editore, titolo, descrizione,immagine, pagine, ultimoPrezzo, numeroCopie, copieDisponibili, codiceCategoria)
		VALUES('$autore' , '$editore' , '$titolo' , '$descrizione' , '$immagine' , '$pagine' , '$ultimoPrezzo' , '$numeroCopie' , '$copieDisponibili' , '$codiceCategoria')";

		if ($conn->query($sql) === TRUE) {
  			echo "New record created successfully <br><br>" ;
		} else {
 			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
}
?>

</body>
</html>