<?php
//include $_SERVER['DOCUMENT_ROOT']."/Biblioteca_polizzi/header.html";
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
<br>
<br>
<br>

<div class="px-4 py-5 my-5 text-center container" style="background-color: #eee;">
    <h1 class="">Inserirere Prenotazione</h1>
    <form class="class="was-validated" method="post" action="verificaPrenotazione.php">
        <br>
        <input type="text" class="form-control" required placeholder="Inserire il codice del libro..." name="codicePrenotazione">
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
        <br><br>
        <button  type="submit" class="btn btn-warning " style="color:white">Cerca</button>
    </form> 
</div>
<?php
include "../footer.html";
?>