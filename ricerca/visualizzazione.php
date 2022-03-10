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
			}

			//ricerca tramite autore o tramite titolo || dipende dalla var select
			if ($select == "0"){
				$sql_datilibro= "SELECT CodiceLibro, Titolo, Autore, Editore, Descrizione, Immagine FROM libro WHERE Autore like'%$text%'";
			}else if ($select == "1") {
				$sql_datilibro= "SELECT CodiceLibro, Titolo, Autore, Editore, Descrizione, Immagine FROM libro WHERE Titolo like'%$text%'";
			}else {
				$result = $sql = $row = " ";
			}

			//$result = $conn -> query($sql);
			//$row = $result->fetch_assoc();
			//$CodiceLibro_ricercato = $row["CodiceLibro"];
			//$sql_datilibro = "SELECT  Titolo, Autore, Editore, Descrizione, Immagine FROM libro WHERE CodiceLibro = '$CodiceLibro_ricercato'";

			//entra solo se abbiamo scelto la select
			//if($select == "0" || $select == "1"){

			
				//se abbiamo scelto mi fa la query e mi trova tutti i dati basandomi sul codicelibro_ricercato
				$result_dati = $conn->query($sql_datilibro);

				//non stampava l'immagine, quindi ho scelto di creare una query per poifar stampare l'immagine
				/*$sql_img = "SELECT Immagine FROM libro WHERE CodiceLibro = '$CodiceLibro_ricercato'";
				$result_img = $conn->query($sql_img);
				$img = $result_img->fetch_assoc();
				$immagine = $img["Immagine"];*/

				//se esiste un libro corrispondente alla ricerca lo stampa

				if($result_dati->num_rows > 0) {

					
					echo '<div class="px-4 py-5 my-5  container rounded-5 align-middle"  style="background-color: #eee;">';

					if (!isset($_SESSION["CodiceFiscale"] )) {
						echo "<br>";
						echo "<h4><span class='alert alert-warning'> Per prenotare un libro prima devi accedere</span></h4>";
						echo "<br><br>";
					}else{
						echo "<br>";
						echo "<h4><span class='text-light alert alert-warning'> Una volta prenotato un libro hai 7 giorni per andare a ritirarlo</span></h4>";
						echo "<br><br>";

					}

					echo '<br>';


					while($row = $result_dati->fetch_assoc()) {
						//immagine non viene stampata correttamente 
						//a video viene visualizzato il percorso dell'immagine


						/*echo "<tr>
						<td><th>". $CodiceLibro_ricercato ."</td>
						<td><th>". $row["Autore"]."</td><td><th>". $row["Editore"]. "</td>
						<td><th>". $row["Titolo"].  $row["Descrizione"]. "
						<img width='500' height='500' class='img-thumbnail' src='/Biblioteca_polizzi/Inserimento/Immagini/".$immagine."'/>"."</td>
						</tr>";*/
						echo '

						';



						
						echo "<form action=". "/Biblioteca_polizzi/prenotazione/Prenotazioni.php"." method='POST'>";
						echo "
						<div class='row'>
							<div class='col-4'>
								<img width='80%' height='60%'class='img-thumbnail' src='/Biblioteca_polizzi/Inserimento/Immagini/". $row["Immagine"]."'/>
							</div>
							<div class='col-8'>
							<div class='row'>

								<div class='row'><h2>".  $row["Titolo"] ."</h2> </div>
								<div class='row'><h5>".  $row["Autore"] ."</h5> </div>
								</div>
								<div class='row'>
									<h6>".  $row["Descrizione"] ."</h6>
								</div>
								
							</div>
							<input type='hidden' value='".$row["CodiceLibro"]."' name='codiceLibro' >";

							echo '<div class="row">
								<div class="col-10"></div>
							';

							if (isset($_SESSION["CodiceFiscale"] )) {
								echo "<div class='col-2' ><button class='btn btn-secondary'>Prenota</button></div>";
                            }else{
								echo "<div class='col-2'><button  class='btn btn-secondary' disabled>Prenota</button></div>";
							}
							
							echo '</div>';

							
						echo "</div>";
						echo "<br>";

						echo "</form>";

						
						


					}

					echo '</div>';
					
				} else {
					//se non lo trova stampa l'errore
					echo "Nessun libro trovato!";
				}
			//}
			
			$conn->close();
		}

		include "../footer.html"
	?>
</body>
</html>


