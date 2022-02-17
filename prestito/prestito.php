<?php
    include "./header.html";
?>
<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Biblioteca";

    //return della funzione usata per creare una query
    $esitoQuery=false;

    $conn = new mysqli($servername, $username, $password, $database);

    //alert molto gradito, mi piace mettiamolo in tutte le pagine
    if($conn -> connect_error){
        die("Connection failed: " . $conn->connect_error);
        echo '<div class="alert alert-danger" role="alert">
            Non riesco ad accedere al server 404
        </div>';
    }

    function verificaQuery($result, $conn, $query){
        if($conn->query($query)==TRUE){
            $esitoQuery=true;
        }
        return $esitoQuery;
    }

    $codiceCopia = $_POST["codiceCopia"];
    $codicePrenotazione = $_POST["codicePrenotazione"];

    $dateStart = date_create(date("l"));
    $dateEnd = date_create(date("l"));

    $dateEnd = date_modify($dateEnd, '+30 days');

    $dateStartString = date_format($dateStart, 'Y/m/d');
    $dateEndString = date_format($dateEnd, 'Y/m/d');

    $query = "INSERT INTO prestito (CodicePrenotazione, InizioPrestito, FinePrestito, StatoPrestito, CodiceCopia)
                VALUES ('$codicePrenotazione', '$dateStartString', '$dateEndString', 'prestato', '$codiceCopia')";

    //query fatta con la funzione appositamente creata
    $esitoQuery = verificaQuery($result, $conn, $query);

    //$query_remove = "UPDATE libro SET CopieDisponibili=CopieDisponibili-1 WHERE CodiceLibro='$codiceCopia'";
    //$aggiornaStatoPrenotazione = "UPDATE prenota SET StatoPrenotazione='prenotato' WHERE CodicePrenotazione='$codicePrenotazione'";

    //in caso di esito positivo 
    if($esitoQuery){
        $query = "UPDATE prenota SET StatoPrenotazione='prenotato' WHERE CodicePrenotazione='$codicePrenotazione'";
        $esitoQuery = verificaQuery($result, $conn, $query);  
    }

    if ($esitoQuery) {
        echo'<div class="alert alert-success" role="alert">
        Prenotazione realizzata con successo
    </div>';
    }else {
        echo '<div class="alert alert-danger" role="alert">
            Prenotazione fallita
        </div>';
    }

    echo "<a class='btn btn-warning' href='inserimentoPrenotazione.php' style='margin-right:2px;color:white;'>Torna Indietro</a>";

    include "../footer.html";
?>