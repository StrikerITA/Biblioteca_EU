<!DOCTYPE html>
<html>
<head>
<title>
Biblioteca Online 
</title>
<link rel="stylesheet" href="stilebiblioteca.css">

</head>
<body>

<?php

session_start();

?>


<p><h1> Registrazione Biblioteca </h1></p>
<td> <!-- echo htmlspecialchars($_SERVER["PHP_SELF"]) nell'action wrappato con il php -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

	Nome <input id="inserimento" type="text" name="name" required>
	<br><br>
	Cognome <input id="inserimento" type="text" name="surname" required>
	<br><br>
	Email <input id="inserimento" type="email" name="email" required>
	<br><br>
	Password <input id="inserimento" type="password" name="password" required>
	<br><br>
	Codice fiscale <input id="inserimento" type="text" name="codice_fiscale" required>
	<br><br>
	Indirizzo <input id="inserimento" type="text" name="indirizzo">
	<br><br>
	Telefono <input type="tel" id="inserimento" name="telefono" pattern="[0-9]{10}">
	<br><br>
	<input id=button type="submit" value="Registrati" name="submit">
	</button>

</form>
</td>

<?php
//variabili:

	$nom = "";
	$cog = "";
	$email = "";
	$pass = "";
	$codf = "";
	$indi = "";
	$tel = "";


//condizione che verifica tutti i dati inseriti:


if (isset ($_POST["submit"])){

	//togliamo sto test_input che non serve a nulla perchè se si vuole fare il pragmatch
	$nom = test_input($_POST["name"]);
	$cog = test_input($_POST["surname"]);
	$email = test_input($_POST["email"]);
	$pass = test_input($_POST["password"]);
	$codf = test_input($_POST["codice_fiscale"]);
	$indi = test_input($_POST["indirizzo"]);
	$tel = test_input($_POST["telefono"]);


	//verifica che il dato inserito non abbia caratteri strani e che abbia un minimo di caratteri:
	if (preg_match('/^[\p{L}., ]+$/u',$nom)==1 or strlen($nom)>3)
	{
		//se la condizione e vera allora da il valore del post alla variabile:	
		$nom = test_input($_POST["name"]);

	}

	else

	{
		

			echo " Reinserire il nome!! <br><br>";
			//se la condizione fallisce allora svuota la variabile:
			$nom = test_input("");
			
	}


	//una verifica speciale per il codice fiscale tramite la quale verifica ogni campo del codice fiscale:

	if (preg_match('/^[a-zA-Z]{6}\d{2}[0-9]\d{1}[a-zA-Z]\d{2}[0-9]\d{1}[a-zA-Z]\d{3}[0-9]\d{1}[a-zA-Z]$/', $codf)==1 or strlen($codf)>15)
	{

	$codf = test_input($_POST["codice_fiscale"]);

	}

	else

	{
		
		echo " Reinserire il codice fiscale!! <br><br>";
		$codf = test_input("");

	}



	if (preg_match('/^[\p{L}., ]+$/u',$indi)==1 or strlen($indi)>5)
	{


	$indi = test_input($_POST["indirizzo"]);

	}

	else

	{
		

			echo " Reinserire l'indirizzo!! <br><br>";
			$indi = test_input("");
			

	}




	if (preg_match('/^[\p{L}., ]+$/u',$tel)==1 or strlen($tel)>11)
	{


	$tel = test_input($_POST["telefono"]);

	}

	else

	{
		

		echo " Reinserire il numero di telefono!! <br><br>";
		$tel = test_input("");
			
	}


	if (preg_match('/^[\p{L}., ]+$/u',$email)==1 or strlen($email)>13)
	{


	$email = test_input($_POST["email"]);

	}

	else

	{
		
		
			echo " Reinserire l'email !! <br><br>";
			$email = test_input("");
			

	}

	if (strlen($pass)>4)
	{


	$pass = test_input($_POST["password"]);

	}

	else

	{
		
		
			echo " Reinserire la password !! <br><br>";
			$pass = test_input("");
			

	}


	if (preg_match('/^[\p{L}., ]+$/u',$cog)==1 or strlen($cog)>3)
	{


	$cog = test_input($_POST["surname"]);

	}

	else

	{
		
	
		echo " Reinserire il cognome!! <br><br>";
		$cog = test_input("");
			

	}
	
	//caricare dalle variabili e non dai post
	//caricare solo il codice fiscale, il resto è superfluo, non verranno mai usati questi dati
	$_SESSION["telefono"] = $_POST["telefono"];
	$_SESSION["nome"] = $_POST["name"];
	$_SESSION["cognome"] = $_POST["surname"];
	$_SESSION["password"] = $_POST["password"];
	$_SESSION["email"] = $_POST["email"];
	$_SESSION["codice_fiscale"] = $_POST["codice_fiscale"];
	$_SESSION["indirizzo"] = $_POST["indirizzo"];
}

//FUNZIONE che controlla l'inserimento dei caratteri speciali
//se trova un carattere speciale cosa fa?
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (!empty($codf)and !empty($cog)and !empty($email)and !empty($indi)and !empty($nom)and !empty($pass)and !empty($tel)){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//troppi sql, da convertire in uno solo
//andare a guardare visualizazione.php dentro ricerca per usare il fetch_assoc() e usare un solo sql
  $sql = "SELECT Email FROM utente WHERE Email = '$email'";
  $sql2 = "SELECT CodiceFiscale FROM utente WHERE CodiceFiscale = '$codf'";
  $sql3 = "SELECT Telefono FROM utente WHERE Telefono = '$tel'";


$result = $conn->query($sql);

$result2 = $conn->query($sql2);

$result3 = $conn->query($sql3);


if ($result->num_rows>0){
	echo "<br>Questa email e gia stata usata!<br>";
	if($result2->num_rows>0)
	{
		echo "<br>Questo Codice Fiscale e gia stato utilizzato!<br>";
	}
	if($result3->num_rows>0)
	{
		echo "<br>Questo numero di telefono e gia stato utilizzato!<br>";
	}

}
elseif($result2->num_rows>0)
{

echo "<br> Questo Codice Fiscale e gia stato utilizzato!<br>";

	if($result->num_rows>0)
	{
		echo "<br>Questa email e gia stata usata!<br>";
	}
	if($result3->num_rows>0)
	{
		echo "<br>Questo numero di telefono e gia stato utilizzato!<br>";
	}

}
elseif($result3->num_rows>0)
{

echo "<br>Questo numero di telefono e gia stato utilizzato!<br>";

	if($result->num_rows>0)
	{
		echo "<br>Questa email e gia stata usata!<br>";
	}
	if($result2->num_rows>0)
	{
		echo "<br>Questo Codice Fiscale e gia stato utilizzato!<br>";
	}
}
else
{
	//ucfirst serve per mettere la prima lettera maiuscola
	//modifica tutti i caratteri in minuscolo e poi porta solo la prima maiuscola
	//entra AnDreA deve diventare Andrea
	$cogmaiuscolo = ucfirst($cog);
	$nommaiuscolo = ucfirst($nom);
	$codfmaiuscolo = strtoupper($codf);

  $sql = "INSERT INTO utente (CodiceFiscale,Cognome,Email,Indirizzi,Nome,Password,Privilegi,Telefono) VALUES ('$codfmaiuscolo','$cogmaiuscolo','$email','$indi','$nommaiuscolo','$pass','0','$tel')";
		if ($conn->query($sql)===true) {
		  	//condizione che va a verificare se il bottone e stato schiacciato, nel momento in cui il bottone viene schiacciato allora ti manda alla prossima pagina salvando anche tutto nel database
		  	if(isset($_POST['submit'])){
				header('Location: login.php');
			}
		}else
		{
			echo "ERRORE". $sql . "" . $conn->connect_error;
		}
}


$conn->close();

}

?>



</body>
</html>
