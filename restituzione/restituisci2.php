<?php
    include "../header.php";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "biblioteca";
        
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
		$codicePrestito = $_POST["codicePrenotazione"];
        /*
        if(!empty($_POST["codicePrenotazione"])){
            $codicePrestito = $_POST["codicePrenotazione"];
        }else{
            $err_codPrestito = "Inserisci un codice";
        } */
        
        if(!empty($codicePrestito)){
            
            $sql = "SELECT CodicePrenotazione FROM prestito WHERE CodicePrenotazione='$codicePrestito' AND StatoPrestito<>'restituito'";
            $result = $conn->query($sql);
            
            if($result->num_rows > 0){
                $sql = "UPDATE prestito SET StatoPrestito='restituito' WHERE CodicePrenotazione='$codicePrestito'";
                $result = $conn->query($sql);
                $sql = "UPDATE prenota SET StatoPrenotazione='annullato' WHERE CodicePrenotazione='$codicePrestito'";
                $result = $conn->query($sql);
                $sql = "SELECT CodiceLibro FROM libro WHERE CodiceLibro=(SELECT CodiceLibro FROM prenota WHERE CodicePrenotazione='$codicePrestito')";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    // echo "<br><br>TROVATO";
                    $sql = "UPDATE libro SET CopieDisponibili=(SELECT CopieDisponibili+1 FROM libro WHERE CodiceLibro=
                                                              (SELECT CodiceLibro FROM prenota WHERE CodicePrenotazione='$codicePrestito'))
                                                               WHERE CodiceLibro=(SELECT CodiceLibro FROM prenota WHERE CodicePrenotazione='$codicePrestito')";
                     
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
    include "../footer.html";
?>