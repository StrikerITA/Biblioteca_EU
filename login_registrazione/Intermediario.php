<?php
	$email = "";
	$pass = "";
	$codf = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

	if(!empty($_POST["email"])){
		$email = $_POST["email"];
	}

	if(!empty($_POST["password"])){
		$pass = $_POST["password"];
	}

	if(!empty($_POST["codice_fiscale"])){
		$codf = $_POST["codice_fiscale"];
	}


	if (empty($codf)and empty($email)and empty($pass))
	{
		$email="";
		$pass="";
		$codf="";
	}

}


if (!empty($codf)and !empty($email)and !empty($pass))
{

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
	  $sql2 = "SELECT CodiceFiscale FROM utente WHERE CodiceFiscale = '$codf'";
	  $sql3 = "SELECT Password FROM utente WHERE Password = '$pass'";

		//si no faccio io
	$result = $conn->query($sql);

	$result2 = $conn->query($sql2);

	$result3 = $conn->query($sql3);

		//COSA STO VEDENDO??? "and" dentro ad un if....
		if ($result->num_rows>0 and $result2->num_rows>0 and $result3->num_rows>0)
		{
			echo " ti abbiamo trovato l'account, ti stiamo collegando...";
            header("Location: /Biblioteca_polizzi/index.php");
		}
		else
		{
		  	echo " ERRORE I dati introdotti non sono collegati a nessun account ! Reintroduci i dati! ";


              sleep(1000);
              header("Location: /Biblioteca_polizzi/login_registrazione/login.php");
		}


	$conn->close();

}


?>