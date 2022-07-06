<?php
    
    session_start();
    $_SESSION=array();
    session_destroy();

    header("Location: /Biblioteca_polizzi/index.php");

?>