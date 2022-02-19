<?php
    include "../header.php";
?>
<div class="p-5 py-5 my-5 text-center container" style="background-color: #eee;">
    <h1>Verifica la Prenotazione</h1>
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

        $codicePrenotazione = $_POST["codicePrenotazione"];

        $query = "SELECT * FROM prenota WHERE CodicePrenotazione='$codicePrenotazione' AND statoPrenotazione != 'prenotato'";
        $result = $conn->query($query);

        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
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
                    
                    <input type='hidden' name='codicePrenotazione' value='".$codicePrenotazione." '>
                </form> ";   
            }
        }else{
            echo "<br>";
            
            echo "<span class='alert alert-danger'> Non ci sono prenotazioni attive corrispondenti al codice inserito </span>";

            echo "<br>";
            echo "<br>";


            echo ' <a class="btn btn-warning" type="submit" href="inserimentoPrenotazione.php" style="color:white; background-color:#f0ab35;">Torna Indietro</a>';
        }
        $conn->close();              
    ?>
</div>
<?php
    include "../footer.html";
?>