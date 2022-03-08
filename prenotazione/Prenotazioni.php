<html>
    <head>
        <!-- Il form va tolto, tutti i paramentri dovranno passare con delle variabili di sessione 
        oppure tramite il POST del foglio precedente -->
    </head>
    <body>
    <?php include "../header.php";?>
        <?php
            //modificare il codice per far si che faccia la prenotazione, poi deve verificare il file
            function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "biblioteca";

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $CodiceLibro = $_POST["codiceLibro"];
                echo $CodiceLibro;
                

                //dati utente
                if(!empty($_POST["DataPrenotazione"]) && !empty($_POST["CodiceFiscale"]) && !empty($_POST["CodiceLibro"])){
                    $DataPrenotazione = $_POST["DataPrenotazione"];
                    $CodiceFiscale = $_POST["CodiceFiscale"];
                    
                    $StatoPrenotazione = "attesa";
                    $CodiceLibro = $_POST["codiceLibro"];
                    echo $CodiceLibro;
                    
                    // Creazione connessione
                    $connessione = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check connection
                    if ($connessione->connect_error) {
                        die("Connection failed: " . $connessione->connect_error);
                    }
                    
                    $sql_copie = "SELECT CopieDisponibili FROM libro WHERE CodiceLibro = '$CodiceLibro'";
                    $result = $connessione->query($sql_copie);
                    $row = $result->fetch_assoc();

                    if($row["CopieDisponibili"] > 0){
                        $sql = "INSERT INTO prenota (DataPrenotazione, CodiceFiscale, CodiceLibro, StatoPrenotazione) VALUES ('$DataPrenotazione', '$CodiceFiscale', '$CodiceLibro', '$StatoPrenotazione')";

                        //inserimento nel database
                        if($connessione->query($sql) === TRUE) {
                            //alert("Prenotazione aggiunta con successo");
                            //messaggio spostato dopo l'aggiornamento copie
                        } else {
                            echo "Errore nella prenotazione, il libro non è stato prenotato";
                        }

                        //NON CONVERTE L'OBJ IN STRING E DA STRING IN INT
                        $num_copie = $row["CopieDisponibili"]; // sottrae le copie
                        $num_copie = $num_copie - 1;
                        $sql = "UPDATE libro SET CopieDisponibili = '$num_copie' WHERE CodiceLibro = '$CodiceLibro'";

                        //cambia il record nel database
                        if($connessione->query($sql) === TRUE){
                            //ha aggiornato le copie e fa un alert 
                            alert("Prenotazione aggiunta con successo");
                        }else{
                            echo "Impossibile aggiornare le copie disponibili!";
                        }

                    }else{
                        alert("Non ci sono copie disponibili del libro selezionato!");
                    }
                    header('Location: /Biblioteca_polizzi/index.php');
                    $connessione->close();
                }
            }
        ?>
    </body>
</html>