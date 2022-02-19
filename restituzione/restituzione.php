<!DOCTYPE html>
<html>
	<!-- 
		Togliere il css da qua e spostarlo in un codice unico
		Aggiungere Header & Footer
		Aggiungere il form di PaginaPR
		Non si è capito se la restituzione è per ogni utente o meno, in tal caso modifica la prima query (condizione mancante)
	-->
	
		<head>
		<style>
		body{
			background-color: #f18973;
		}

		table {
			border-collapse: collapse;
		}

		td {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 100%;
			background: #666;
			color: #FFF;
			padding: 2px 6px;
			border-collapse: separate;
			border: 4px solid #000;
		}

		span {
			color: red;
		}
	</style>
			 
	<title>Restituzione</title>
		</head>
		<body>
			
			<?php


			include "../header.php";


				$codicePrestito = "";
				$err_codPrestito = "";
				//a cosa serve  $err_codPrestito?
				
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					
					if(!empty($_POST["codPrestito"])){
						$codicePrestito = $_POST["codPrestito"];
					}else{
						$err_codPrestito = "Inserisci un codice";
					}
					
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "biblioteca";
					
					$conn = new mysqli($servername, $username, $password, $dbname);

					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					
					$sql = "SELECT CodiceCopia, CodicePrenotazione, FinePrestito, InizioPrestito, StatoPrestito FROM prestito";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						echo "<br><table>";
						echo "<tr><td>CodiceCopia</td><td>CodicePrenotazione</td><td>FinePrestito</td><td>InizioPrestito</td><td>StatoPrestito</td></tr>";
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>".$row["CodiceCopia"]."</td><td>".$row["CodicePrenotazione"]."</td><td>".$row["FinePrestito"]."</td><td>".$row["InizioPrestito"]."</td><td>".$row["StatoPrestito"];
						}
						echo "</table>";
					} else {
						//qui si intende una restituzione personale o globale?
						echo "Non sono presenti libri da restituire";
					}
						
					if(!empty($codicePrestito)){
						//verifica codice prestito == CodicePrenotazione
						$sql = "SELECT CodicePrenotazione FROM prestito WHERE CodicePrenotazione='$codicePrestito' AND StatoPrestito<>'restituito'";
						$result = $conn->query($sql);
						
						if($result->num_rows > 0){
							$sql = "UPDATE prestito SET StatoPrestito='restituito' WHERE CodicePrenotazione='$codicePrestito'";
							$result = $conn->query($sql);
							$sql = "UPDATE prenota SET StatoPrenotazione='annullato' WHERE CodicePrenotazione='$codicePrestito'";
							$result = $conn->query($sql);
							$sql = "SELECT CodiceLibro, CodiceCopia FROM libro, prestito WHERE CodiceLibro=CodiceCopia AND CodicePrenotazione='$codicePrestito'";
							$result = $conn->query($sql);

							if($result->num_rows > 0){
								echo "<br><br>TROVATO";
								//chiedere a compa a cosa serve AND in questa query
								$sql = "UPDATE libro SET CopieDisponibili=(SELECT CopieDisponibili+1 FROM libro, prestito WHERE CodiceLibro = AND CodicePrenotazione='$codicePrestito')
								 WHERE CodiceLibro=(SELECT CodiceCopia FROM prestito WHERE CodicePrenotazione='$codicePrestito' AND CopieDisponibili<NumeroCopie)";
								 
								 if($conn->query($sql)==TRUE){
									 echo "<br>FUNZIONE 'UPDATE' ANDATA A BUON FINE";
									 $sql = "SELECT CodiceLibro FROM libro WHERE CopieDisponibili=NumeroCopie AND
											CodiceLibro=(SELECT CodiceCopia FROM prestito WHERE CodicePrenotazione='$codicePrestito')";
									 $result = $conn->query($sql);
									 if($result->num_rows > 0){
										 echo "<br>ERRORE: NUMERO MASSIMO DI COPIE RESTITUITE RAGGIUNTO";
									 }else{
										 echo "<br>FUNZIONE UPDATE EFFETTUATA CON SUCCESSO";
									 }
								 }else{
									echo "ERRORE DI COMUNICAZIONE: UPDATE"; 
								 }
							}
							echo "<br>DATI STAMPATI TRAMITE TABELLA";
						}else{
							echo "<br>LIBRO GIA' RESTITUITO O CODICE INCORRETTO";
						}
						
						$conn->close();
					}
				}
				
			?>		
			<form method = "post">
				<br>Inserisci il codice del prestito interessato: <input type="text" name="codPrestito"><span> <?php echo "*".$err_codPrestito; ?> </span>
				<br><br><input type="submit" value="Restituzione">
			</form>
			
		</body>
	</html>