@@ -1,72 +0,0 @@
<html>
    <body>
        <?php
            include "../header.php";
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "biblioteca";

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $CodiceLibro = $_POST["codiceLibro"];
                $CodiceFiscale = $_SESSION["CodiceFiscale"]; //caricatanel login
                $StatoPrenotazione = "attesa";

                $dateEnd = date_create(date("l"));
                $dateEnd = date_modify($dateEnd, '+7 days');
                $DataPrenotazione = date_format($dateEnd, 'Y/m/d');
                            
                // Creazione connessione
                $connessione = new mysqli($servername, $username, $password, $dbname);
                    
                // Check connection
                if ($connessione->connect_error) {
                    die("Connection failed: " . $connessione->connect_error);
                } else {
                    $sql_copie = "SELECT CopieDisponibili FROM libro WHERE CodiceLibro = '$CodiceLibro'";
                    $result = $connessione->query($sql_copie);
                    $row = $result->fetch_assoc();
    
                    if($row["CopieDisponibili"] > 0){
                        $sql = "INSERT INTO prenota (DataPrenotazione, CodiceFiscale, CodiceLibro, StatoPrenotazione) VALUES ('$DataPrenotazione', '$CodiceFiscale', '$CodiceLibro', '$StatoPrenotazione')";
    
                        //inserimento nel database
                        if($connessione->query($sql) === TRUE) {
                            $num_copie = $row["CopieDisponibili"]; // sottrae le copie
                            $num_copie = $num_copie - 1; //lascialo così sennò si bugga e non lo fa
                            $sql = "UPDATE libro SET CopieDisponibili = '$num_copie' WHERE CodiceLibro = '$CodiceLibro'";
                            
                            //cambia il record delle copie nel database
                            if($connessione->query($sql) === TRUE){
                                alertRedirect("Deve ritirare il libro entro il ".date_format($dateEnd, 'd/m/y'), "/Biblioteca_polizzi/index.php");
                            }else{
                                echo "Impossibile aggiornare le copie disponibili!";
                            }
                        } else {
                            echo "Errore nella prenotazione, il libro non è stato prenotato";
                        }
                    }else{
                        alert("Non ci sono copie disponibili del libro selezionato!");
                    }  
                    //alertRedirect("Deve ritirare il libro entro il ".date_format($dateEnd, 'd/m/y'), "/Biblioteca_polizzi/index.php");
                }
                $connessione->close();
            }
        ?>
    </body>
</html>