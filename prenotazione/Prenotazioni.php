<html>
    <head>
        <!-- Il form va tolto, tutti i paramentri dovranno passare con delle variabili di sessione 
        oppure tramite il POST del foglio precedente -->
    </head>
    <body>
        <div>
            <span>PRENOTA QUI IL TUO LIBRO:</span>
            <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                <span>
                    Data Prenotazioni: <input type="date" name="DataPrenotazione" value=""><br>
                </span>
                <span>
                    Codice Fiscale: <input type="varchar" name="CodiceFiscale" value=""><br>
                </span>
                <span>
                    Codice Libro: <input type="int" name="CodiceLibro" value=""><br> 
                </span>
                <br>
                <input type="submit">
            </form>
        </div>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "biblioteca";

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                //dati utente
                if(!empty($_POST["DataPrenotazione"]) && !empty($_POST["CodiceFiscale"]) && !empty($_POST["CodiceLibro"])){
                    $DataPrenotazione = $_POST["DataPrenotazione"];
                    $CodiceFiscale = $_POST["CodiceFiscale"];
                    $CodiceLibro = $_POST["CodiceLibro"];
                    $StatoPrenotazione = "attesa";

                    // Creazione connessione
                    $connessione = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check connection
                    if ($connessione->connect_error) {
                        die("Connection failed: " . $connessione->connect_error);
                    }
                    
                    $sql_copie = "SELECT NumeroCopie FROM libro WHERE CodiceLibro = '$CodiceLibro'";
                    $result = $connessione->query($sql_copie);

                    if($result->num_rows > 0){
                        $sql = "INSERT INTO prenota (DataPrenotazione, CodiceFiscale, CodiceLibro) VALUES ('$DataPrenotazione', '$CodiceFiscale', '$CodiceLibro')";

                        //inserimento nel database
                        if($connessione->query($sql) === TRUE) {
                            echo "Prenotazione aggiunta con successo";
                        } else {
                            echo "Error: " . $sql . "<br>" . $connessione->error;
                        }
                        
                        $row = $result->fetch_assoc();

                        //NON CONVERTE L'OBJ IN STRING E DA STRING IN INT
                        $num_copie = $row["NumeroCopie"]; // sottrae le copie
                        $num_copie = $num_copie - 1;
                        $sql = "UPDATE libro SET CopieDisponibili = '$num_copie' WHERE CodiceLibro = '$CodiceLibro'";

                        //cambia il record nel database
                        if($connessione->query($sql) === TRUE){
                            echo "Copie aggiornate";
                        }else{
                            echo "Impossibile aggiornare le copie disponibili!";
                        }

                    }
                    header('Location: test.html'); //sostituire test.html con la pagina successiva
                    $connessione->close();
                }
            }
        ?>
    </body>
</html>