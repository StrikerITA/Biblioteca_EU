<?php
    include "../header.php";
?>
<?php
if (isset($_SESSION["privilegi"])) {   
    if(!$_SESSION["privilegi"]==1){
        header("Location: /Biblioteca_polizzi/deniedAccess.php");
    }
}else{
    header("Location: /Biblioteca_polizzi/deniedAccess.php");
}

?>

    
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "Biblioteca";

        //gestione connessione
        $conn = new mysqli($servername, $username, $password, $database);
        if($conn -> connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $titoloFromPost = $_GET["titolo"];

        //$query = "SELECT * FROM prenota WHERE CodicePrenotazione='$codicePrenotazione' AND statoPrenotazione = 'attesa'";
        $query = "SELECT * FROM prenota p, libro l, utente u WHERE p.CodiceLibro=l.CodiceLibro AND p.CodiceFiscale=u.CodiceFiscale
        AND p.StatoPrenotazione<>'prenotato' AND l.Titolo LIKE '%".$titoloFromPost."%' ";


        $result = $conn->query($query);

        if($result->num_rows>0){


            echo '

					<div class="px-4 py-5 my-5 text-center container" style="background-color: #eee;">
                    <h1>Verifica la Prenotazione</h1>
						<table class="table table-hover table-striped" style ="background:white;">
					
							<thead>

								<tr>
									<th scope="col">Titolo</th>
									<th scope="col">Cognome e nome</th>
									<th scope="col">Copia da prestare</th>
									<th scope="col">Dai in prestito</th>
								</tr>
							</thead>
							<tbody>
					';
					while($row = $result->fetch_assoc()) {
						echo '
								<tr>
									<td>'.$row["Titolo"].'</td>
									<td>'.$row["Cognome"].' '.$row["Nome"].'</td>	
									' . '<form method="post" action="prestito.php">
                                    <td> <input type="text"  class="form-control" placeholder="Inserire il codice copia..." name="codiceCopia" required></td>
									<input type="hidden" name="codicePrenotazione" value="'.$row["CodicePrenotazione"].'">
									<td><button class="btn btn-secondary">clicca</button></form>' . '</td>						
								</tr>
						';
					}
					echo'
							</tbody>
						</table>
					</div>
						';







           /* while($row = $result->fetch_assoc()){
                //echo '<div class="it-list-wrapper">';
                echo '<ul class="list-group ml-lg-5 mr-lg-5">';
                echo '<li class="list-group-item">Codice Prenotazione: ' . $row["CodicePrenotazione"] .  '</li>';
                echo '<li class="list-group-item">Data Prenotazione: ' . $row["DataPrenotazione"] . "</li>";
                echo '<li class="list-group-item">Codice Fiscale: ' . $row["CodiceFiscale"] . "</li>";
                echo '<li class="list-group-item">Codice Libro: ' . $row["CodiceLibro"] . "</li>";
                echo '</ul>';
                //echo '</div>';
                echo "<br>
                <form action='prestito.php' method='post'>
                    <h4>Inserisci la copia</h4>
                    <input type='text'  class='form-control' placeholder='Inserire il codice copia...' name='codiceCopia'>
                    <br>
                    <button class='btn btn-warning ' style='color:white;'>Inserisci</button>
                    <a class='btn btn-warning' href='inserimentoPrenotazione.php' style='margin-right:2px;color:white;'>Torna Indietro</a>
                    
                    <input type='hidden' name='codicePrenotazione' value='".$row["CodicePrenotazione"]." '>
                </form> ";   
            }*/
        }else{
            echo "<br>";
            
            echo "<span class='alert alert-danger'> Non ci sono prenotazioni attive corrispondenti al codice inserito </span>";

            echo "<br>";
            echo "<br>";


            echo ' <a class="btn btn-warning" type="submit" href="inserimentoPrenotazione.php" style="color:white; background-color:#f0ab35;">Torna Indietro</a>';
        }
        $conn->close();              
    ?>

<?php
    include "../footer.html";
?>