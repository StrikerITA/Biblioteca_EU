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
<form method="POST" action="restituzione.php" style="margin: 5px 5px 5px 5px;">
    <input type="text" placeholder="Nome del libro..." name="nomeLibro">
    <button>Clicca</button>
</form>
<?php
    echo "<br>";
    include "../footer.html";
?>