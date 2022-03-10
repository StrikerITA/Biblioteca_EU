<?php
    include "../header.php";
    echo "<br>";
    if (isset($_SESSION["privilegi"])) {   
        if(!$_SESSION["privilegi"]==1){
            header("Location: /Biblioteca_polizzi/deniedAccess.php");
        }
    }else{
        header("Location: /Biblioteca_polizzi/deniedAccess.php");
    }

?>

<div class="px-4 py-5 my-5 text-center container" style="background-color: #eee;">
    <h1 class="">Restituzione</h1>
    <form method="GET" action="restituzione.php" style="margin: 5px 5px 5px 5px;">
        <!--<input type="text" placeholder="Nome del libro..." name="nomeLibro">
        <button>Clicca</button>-->

        <br>
        <input type="text" class="form-control" required placeholder="Inserire il titolo del libro..." name="nomeLibro">
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
        <br><br>
        <button  type="submit" class="btn btn-primary " style="color:white">Cerca</button>


    </form>
</div>
<?php
    echo "<br>";
    include "../footer.html";
?>