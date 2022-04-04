<?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
				if(!empty($_POST["autore"]) && !empty($_POST["editore"]) && !empty($_POST["titolo"]) && !empty($_POST["descrizione"]) /*&& !empty($_POST["image"])*/ && !empty($_POST["pagine"]) && !empty($_POST["ultimoPrezzo"]) && !empty($_POST["numeroCopie"]) && !empty($_POST["codiceCategoria"])){
					$autore = $_POST["autore"];
					$editore = $_POST["editore"];
					$titolo = $_POST["titolo"];
					$descrizione = $_POST["descrizione"];
					//$immagine = $_POST["image"];
					$pagine = $_POST["pagine"];
					$ultimoPrezzo = $_POST["ultimoPrezzo"];
					$numeroCopie = $_POST["numeroCopie"];
					$copieDisponibili = $_POST["numeroCopie"];
					$codiceCategoria = $_POST["codiceCategoria"];
					//$codiceLibro = $_POST["codiceLibro"];

					$tmp = $_FILES['image']['tmp_name']; 
					$type = $_FILES['image']['type'];
					$size = $_FILES['image']['size'];
					$ext = get_ext($type);
					$folder = "/Biblioteca_polizzi/Immagini/";
					//$ext = get_ext($type); //estensione dell'immagine
					$name = time().rand(0,999); //timestamp attuale + un numero random compreso tra 0 e 999
					$name = $name.$ext; //aggiungo al nome appena creato l'estensione
					$immagine=$name;
				
					echo $name;
					//$immagine=$name;
					if(move_uploaded_file($_FILES['image']['tmp_name'],"Immagini/".$name)) {

						$giusto=true;


						$servername="localhost";
						$username="root";
						$password="";
						$dbname="biblioteca";
							
						$conn = new mysqli($servername, $username, $password, $dbname);
							
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}

						$sql = "INSERT INTO libro (autore, editore, titolo, descrizione, immagine, pagine, ultimoPrezzo, numeroCopie, copieDisponibili, codiceCategoria)
						VALUES('$autore' , '$editore' , '$titolo' , '$descrizione' , '$immagine' , '$pagine' , '$ultimoPrezzo' , '$numeroCopie' , '$copieDisponibili' , '$codiceCategoria')";

						if($conn->query($sql) === TRUE){
                            alertRedirect("Il libro e stato aggiunto con successo","/Biblioteca_polizzi/areaBibliotecario.php");
							echo "Un nuovo libro è stato aggiunto con successo!";
						} else {
							echo "Error: " . "<br>" . $conn->error;
						}
						
						$conn->close();
					} else {
						echo "Non è stato possibile caricare l'immagine<br />";
					}

				}
			}

            function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            function alertRedirect($msg,$redirect){
                echo '<script type="text/javascript">
                alert("' . $msg . '")
                window.location.href = "'.$redirect.'"
                </script>';
            }

			function check_ext($tipo) {

				switch($tipo) {
					case "image/png": 
						return true;
						break;
					case "image/jpg":
						return true;
						break;
					case "image/jpeg":
						return true;
						break;
					case "image/gif":
						return true;
						break;
					
						break;
					default:
						return false;
						break;
				}
			
			}
			
			function get_ext($tipo) {
			
				switch($tipo) {
					case "image/png": 
						return ".png";
						break;
					case "image/jpg":
						return ".jpg";
						break;
					case "image/jpeg":
						return ".jpg";
						break;
					case "image/gif":
						return ".gif";
						break;
					
					default:
						return false;
						break;
				}
			
			}
			
			function get_error($tmp, $type, $size, $max_size) {
			
				if(!is_uploaded_file($tmp)) {
					echo "File caricato in modo non corretto<br />";
				}
				if(!check_ext($type)) {
					echo "Estensione del file non ammesso<br />";
				}
				if($size > $max_size) {
					echo "Dimensione del file troppo grande<br />";
				}
				echo '<a href="/uploader/index.php">Torna all\'uploader</a>';
			
			}
		?>