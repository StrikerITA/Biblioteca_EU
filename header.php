<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/Biblioteca_polizzi/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Biblioteca_polizzi/css/style.css">
        <script src="https://kit.fontawesome.com/15ee1b0016.js" crossorigin="anonymous"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    </head>
    <body>
        <nav class="navbar navbar-expand navbar-light" style="background-color: rgb(255, 181, 43);">
            <span class="navbar-brand text-white" >Biblioteca</span>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white"  href="/Biblioteca_polizzi/index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link text-white" href="/Biblioteca_polizzi/areaBibliotecario.php">Area Bibliotecario</a>
                    </li>
                    
                </ul>
                <ul class="navbar-nav ml-auto">
                <?php
                    if (session_status() == PHP_SESSION_ACTIVE) {
                        if($_SESSION["privilegi"]==0){
                            echo"non hai privilegi";
                        }else{
                          echo "hai privilegi";
                      }
                        
                      }
                    

                /*
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }else if (session_status() !== PHP_SESSION_NONE) {
                    echo $_SESSION["favcolor"];
                }*/

                ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/Biblioteca_polizzi/login_registrazione/registrazione.php">Registrazione</a>
                    </li>
                    <li class="nav-item text-white">
                        <a class="nav-link text-white" href="/Biblioteca_polizzi/login_registrazione/login.php">Log In</a>
                    </li>
                    
                </ul>
            </div>
        </nav>
        <div>
            
            
        
        </div>
    </body>
    
    
</html>
