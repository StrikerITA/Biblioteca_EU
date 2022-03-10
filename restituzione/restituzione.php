<!DOCTYPE html>
<html>
	<?php
		
	?>
	<!-- 
		Togliere il css da qua e spostarlo in un codice unico
		Aggiungere Header & Footer
		Aggiungere il form di PaginaPR
		Non si è capito se la restituzione è per ogni utente o meno, in tal caso modifica la prima query (condizione mancante)
	-->
	
		<head>
		<!--<style>
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
	</style>-->
			 
	<title>Restituzione</title>
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

				echo "<br>";

				$codicePrestito = "";
				$err_codPrestito = "";
				//a cosa serve  $err_codPrestito?
				
// primo cos

				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "biblioteca";
					
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				$nome = $_GET['nomeLibro'];

				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				
				// $sql = "SELECT CodiceCopia, CodicePrenotazione, FinePrestito, InizioPrestito, StatoPrestito FROM prestito";
				// $sql = "SELECT * FROM prestito WHERE StatoPrestito !='restituito' AND ";
				$sql = "select Titolo, CodiceFiscale, CodiceCopia, prestito.CodicePrenotazione
				from prestito, prenota, libro
				where prenota.CodicePrenotazione=prestito.CodicePrenotazione and prenota.CodiceLibro = libro.CodiceLibro
				and titolo like '%$nome%' AND prestito.statoPrestito<>'restituito';";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					echo '

					<div class="px-4 py-5 my-5 text-center container" style="background-color: #eee;">
						<h1 class="">Restituzione</h1>
						<br>
						<table class="table table-hover table-striped" style ="background:white;">
					
							<thead>

								<tr>
									<th scope="col">Titolo</th>
									<th scope="col">Codice Fiscale</th>
									<th scope="col">Numero Copia</th>
									<th scope="col">Restituisci</th>
								</tr>
							</thead>
							<tbody>
					';
					while($row = $result->fetch_assoc()) {
						echo '
								<tr>
									<td>'.$row["Titolo"].'</td>
									<td>'.$row["CodiceFiscale"].'</td>
									<td>'.$row["CodiceCopia"].'</td>	
									<td>' . '<form method="post" action="restituisci2.php">
									<input type="hidden" name="codicePrenotazione" value="'.$row["CodicePrenotazione"].'">
									<button class="btn btn-secondary">clicca</button></form>' . '</td>						
								</tr>
						';
					}
					echo'
							</tbody>
						</table>
					</div>
						';
					/*echo "<br><table>";
					echo "<tr><td>CodiceCopia</td><td>CodicePrenotazione</td><td>FinePrestito</td><td>InizioPrestito</td><td>StatoPrestito</td></tr>";
					while($row = $result->fetch_assoc()) {

						echo "<tr><td>".$row["CodiceCopia"]."</td><td>".$row["CodicePrenotazione"]."</td><td>".$row["FinePrestito"]."</td><td>".$row["InizioPrestito"]."</td><td>".$row["StatoPrestito"];
					}
					echo "</table>";*/
				} else {
					//qui si intende una restituzione personale o globale?
					alertRedirect("Non ci sono prenotazioni per questo tiolo","/Biblioteca_polizzi/restituzione/cercaPrestito.php");
					
				}
//fine cos
				
			?>		
			
		</body>
	</html>