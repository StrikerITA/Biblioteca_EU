<!DOCTYPE html>
<html>

<head>
	<title>Gestione Biblioteca</title>
</head>

<body>
<?php
include "../header.php";
?>

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
<div class="px-4 py-5 my-5 text-center container" style="background-color: #eee;">
	<form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		<div class="col-md-4">
			<input placeholder="Titolo" type="text" class="form-control" name="titolo">
		</div>
		<div class="col-md-4">
    		<input placeholder="Autore" type="text" class="form-control" name="autore">
  		</div>
		<div class="col-md-4">
    		<input placeholder="Editore" type="text" class="form-control" name="editore">
  		</div>

		<div class="col-md-12">
			<label for="[]" class="form-label"></label>
			<textarea class="form-control" placeholder="Descrizione" name="descrizione"></textarea>
		</div>

		<div class="col-md-3">
			<label for="[]" class="form-label"></label>
    		<input placeholder="Pagina" type="number" class="form-control" name="pagine">
  		</div>
		  
		<div class="col-md-3">
			<label for="[]" class="form-label"></label>	
    		<input placeholder="Numero Copie" type="number" class="form-control" name="numeroCopie">
  		</div>

		<div class="col-md-3">
			<label for="[]" class="form-label"></label>
    		<input placeholder="Copie Disponibili" type="number" class="form-control" name="copieDisponibili">
  		</div>
		
		<div class="col-md-3">
			<label for="[]" class="form-label"></label>
    		<input placeholder="Ultimo Prezzo" type="number" step="0.01" class="form-control" name="ultimoPrezzo">
  		</div>

		<div class="col-md-4">
			<label for="[]" class="form-label"></label>
    		<input placeholder="Codice Categoria" type="text"  class="form-control" name="codiceCategoria">
  		</div>

		  <div class="col-md-4">
			<label for="[]" class="form-label"></label>
			
			
  		</div>
		  <div class="col-md-4">
			<label for="[]" class="form-label"></label>
			<input class="form-control form-control-sm" type="file" name="codiceCategoria">
			
  		</div>

		
	
		<div class="col-12">
    		<button type="submit" class="btn btn-primary">Invia</button>
  		</div>

			
	</form>
</div>

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