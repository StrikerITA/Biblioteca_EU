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
			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				$select = $_GET["selezione"];
				$text = $_GET["testo"];

				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "biblioteca";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}else{
					//ricerca tramite autore o tramite titolo || dipende dalla var select
					if ($select == "0"){
						$sql_datilibro = "SELECT CodiceLibro, Titolo, Autore, Editore, Descrizione, Immagine FROM libro WHERE Autore like'%$text%'";
					}else {
						$sql_datilibro = "SELECT CodiceLibro, Titolo, Autore, Editore, Descrizione, Immagine FROM libro WHERE Titolo like'%$text%'";
					}
					
					//se abbiamo scelto mi fa la query e mi trova tutti i dati basandomi sul codicelibro_ricercato
					$result_dati = $conn->query($sql_datilibro);

					//se esiste un libro corrispondente alla ricerca lo stampa
					if($result_dati->num_rows > 0) {
						//apertura main div	
						echo '<div class="px-4 py-5 my-5  container rounded-5 align-middle"  style="background-color: #eee;">';
							if (!isset($_SESSION["CodiceFiscale"] )) {
								echo "<br>";
								echo "<h4><span class='alert alert-warning'> Per prenotare un libro prima devi accedere</span></h4>";
								echo "<br><br>";
							}else{
								echo "<br>";
								echo "<h4><span class=' alert alert-warning'> Una volta prenotato un libro hai 7 giorni per andare a ritirarlo</span></h4>";
								echo "<br><br>";
							}
							//stampa dati dei libri trovati
							echo '<br>';
							while($row = $result_dati->fetch_assoc()) {
								echo "<form action=". "/Biblioteca_polizzi/prenotazione/Prenotazioni.php"." method='POST'>";
									echo "
									<div class='row'>
										<div class='col-4'>
											<img width='80%' height='60%'class='img-thumbnail' src='/Biblioteca_polizzi/Inserimento/Immagini/". $row["Immagine"]."'/>
										</div>
										<div class='col-8'>
											<div class='row'>	
												<div class='row'>
													<div class='col-10'>
														<h3>".  $row["Titolo"] ."</h3>
													</div>
													<div class='col-2'>
														"; //fine echo
														if (isset($_SESSION["CodiceFiscale"] )) {
															echo "<div class='col-2' ><button class='btn btn-secondary'>Prenota</button></div>";
														}else{
															echo "<div class='col-2'><button  class='btn btn-secondary' disabled>Prenota</button></div>";
														}
														echo "
													</div>
													<div class='row'><h5>".  $row["Autore"] ."</h5> </div>
												</div>
											</div>
											<div class='row'>
												<h6>".  $row["Descrizione"] ."</h6>
											</div>	
										</div>
										<input type='hidden' value='".$row["CodiceLibro"]."' name='codiceLibro' >";
										echo '<div class="row">
											<div class="col-10"></div>
										';
										echo '</div>';	
									echo "</div>";
									echo "<br>";
								echo "</form>";
							}
							//chiusura main div
						echo '</div>';		
					} else {
						//se non lo trova stampa l'errore
						echo "Nessun libro trovato!";
					}
					$conn->close();
				}
			}
			include "../footer.html"
		?>
	</body>
</html>


