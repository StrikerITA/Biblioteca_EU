<?php
	$email = "";
	$pass = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if(!empty($_POST["email"])){
			$email = $_POST["email"];
		}

		if(!empty($_POST["password"])){
			$pass = $_POST["password"];
		}

			if (empty($email)and empty($pass)){
			$email="";
			$pass="";
		}
	}

	if (!empty($email)and !empty($pass)){

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "biblioteca";

		$conn = new mysqli($servername, $username, $password,$dbname);

		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
		
		//comando in sql fatto 3 volte quando si deve fare tutto in uno
		$sql = "SELECT Email FROM utente WHERE Email = '$email'";
		$sql2 = "SELECT CodiceFiscale FROM utente WHERE Email = '$email' AND Password = '$pass'";
		$sql3 = "SELECT Password FROM utente WHERE Password = '$pass'";
		$sql4 = "SELECT Privilegi FROM utente WHERE Email = '$email' AND Password = '$pass'" ;


		//gestire la parte della registrazione prendendo da una query il codice fiscale che verrà poi passato nella session
		// togliere il codice fiscale dal login
		$result = $conn->query($sql);

		$result2 = $conn->query($sql2);

		$result3 = $conn->query($sql3);
		$result4 = $conn->query($sql4);

			//COSA STO VEDENDO??? "and" dentro ad un if....
			if ($result->num_rows>0 and $result2->num_rows>0 and $result3->num_rows>0){
				
				echo " ti abbiamo trovato l'account, ti stiamo collegando...";
				//session_start();
				$codfisc=$result2->fetch_assoc();
				$priv=$result4->fetch_assoc();

				if (session_status() == PHP_SESSION_ACTIVE) {
					$_SESSION["privilegi"]=$priv["Privilegi"];
					$_SESSION["CodiceFiscale"]=$codfisc["CodiceFiscale"];
				}else{
					session_start();
					$_SESSION["privilegi"]=$priv["Privilegi"];
					$_SESSION["CodiceFiscale"]=$codfisc["CodiceFiscale"];

				}

				$_SESSION["privilegi"]=$priv["Privilegi"];
				$_SESSION["CodiceFiscale"]=$codfisc["CodiceFiscale"];

				header("Location: /Biblioteca_polizzi/index.php");
			}else{
				echo " ERRORE I dati introdotti non sono collegati a nessun account ! Reintroduci i dati! ";

				sleep(100);
				header("Location: /Biblioteca_polizzi/login_registrazione/login.php");
			}
		$conn->close();
	}
?>