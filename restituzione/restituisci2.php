<?php
    include "../header.php";
    if (isset($_SESSION["privilegi"])) {   
        if(!$_SESSION["privilegi"]==1){
            header("Location: /Biblioteca_polizzi/deniedAccess.php");
        }
    }else{
        header("Location: /Biblioteca_polizzi/deniedAccess.php");
    }

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
                $sql = "UPDATE prestito SET StatoPrestito='restib  b v h  tuito' WHERE CodicePrenotazione='$codicePrestito'";
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
                         $sql = "SELECT CodiceLibro FROM libro WHERE CopieDisponibili<=NumeroCopie AND
                                CodiceLibro=(SELECT CodiceCopia FROM prestito WHERE CodicePrenotazione='$codicePrestito')";
                         $result = $conn->query($sql);
                         if($result->num_rows > 0){
                            alertRedirect("Libro restituito con successo","/Biblioteca_polizzi/restituzione/cercaPrestito.php");
                         }else{
                            alertRedirect("Libro restituito con successo","/Biblioteca_polizzi/restituzione/cercaPrestito.php");
                             
                         }
                     }else{
                        alertRedirect("Libro restituito con successo","/Biblioteca_polizzi/restituzione/cercaPrestito.php");
                     }
                }
               
            }else{
                echo "<br>LIBRO GIA' RESTITUITO O CODICE INCORRETTO";
            }
            
            $conn->close();
        }
    }
    include "../footer.html";
?>