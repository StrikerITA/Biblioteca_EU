<?php
include "header.php";
?>

<style>
    h1{
        text-align: center;
    }
    </style>


<?php
if (isset($_SESSION["privilegi"])) {   
    if(!$_SESSION["privilegi"]==1){
        header("Location: /Biblioteca_polizzi/deniedAccess.php");
    }
}else{
    header("Location: /Biblioteca_polizzi/deniedAccess.php");
}

?>
    


            
            <br>
            <br>
            <br>
                <h1>Vai per </h1>
            <br>
            
            <div class="container row m-3">

            <div class="btn btn-dark col m-1">
                <a class="text-decoration-none" href="prestito/inserimentoPrenotazione.php" for="Conferma Prenotazione" style="color:white;">Prestito</a>
            </div>
        
            <div class="btn btn-dark col m-1" >
                <a class="text-decoration-none" href="Inserimento/bb.php" for="inserimento" style="color:white;">Inserimento</a>
            </div>
        
            <div class="btn btn-dark col m-1">
                    <a class="text-decoration-none" href="restituzione/cercaPrestito.php" style="color:white;">Restituzione</a>
            </div>
        </div>
        
       





<?php
include "footer.html";
?>

