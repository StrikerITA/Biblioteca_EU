<!DOCTYPE html>
<html>
	<head>
		<title>Biblioteca Online </title>
		<!-- <link rel="stylesheet" href="stilebiblioteca.css"> -->
	</head>
	<body>
		<?php
			include "../header.php";
			//gestione variabili di sessione
		?>
		
		<!-- echo htmlspecialchars($_SERVER["PHP_SELF"]) nell'action wrappato con il php -->

		<div class="px-4 py-5 my-5 text-center container rounded-5 align-middle"  style="background-color: #eee;">
			<p><h1> Registrazione Biblioteca </h1></p>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

			<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						<label for="[]" class="form-label"></label>		
						<input placeholder="Nome" id="inserimento" class="form-control px-5" type="text" name="name" required>
						<label for="[]" class="form-label"></label>	
					</div>
				</div>
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						
						<input placeholder="Cognome" class="form-control px-5" id="inserimento" type="text" name="surname" required>
						<label for="[]" class="form-label"></label>
						
					</div>
				</div>
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						
						<input placeholder="Email" class="form-control px-5" id="inserimento" type="email" name="email" required>
						<label for="[]" class="form-label"></label>
					</div>
				</div>
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						
						<input placeholder="Password" class="form-control px-5" id="inserimento" type="password" name="password" required>
						<label for="[]" class="form-label"></label>
					</div>
				</div>
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						
						<input placeholder="Codice fiscale" class="form-control px-5" id="inserimento" type="text" name="codice_fiscale" required>
						<label for="[]" class="form-label"></label>
					</div>
				</div>

				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
						
							<input placeholder="Indirizzo" class="form-control px-5" id="inserimento" type="text" name="indirizzo" required>
						<label for="[]" class="form-label"></label>
					</div>
				</div>

				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
							<input placeholder="Telefono" class="form-control px-5" type="tel" id="inserimento" name="telefono" pattern="[0-9]{3} [0-9]{3} [0-9]{4}">
						<label for="[]" class="form-label"></label>
					</div>
				</div>

				<div class="row">
					<div class="col-4"></div>
					<div class="col-4">
					
						<input  class="btn btn-primary" id=button type="submit" value="Registrati" name="submit">
					</div>
				</div>


				
				
				

			</form>
		</div>
		
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "biblioteca";

			$conn = new mysqli($servername, $username, $password,$dbname);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			//FUNZIONE che controlla l'inserimento dei caratteri speciali
			//se trova un carattere speciale cosa fa?
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			function check_char($work, $input_field, $long_check){

				if (preg_match('/^[\p{L}., ]+$/u', $work)==1 or strlen($work)>$long_check){

					//se la condizione e vera allora da il valore del post alla variabile:	
					$work = test_input($_POST[$input_field]);

				}else{
					echo " Reinserire ". $input_field ."!! <br><br>";
					//se la condizione fallisce allora svuota la variabile:
					$work = test_input("");
				}
			}

			//variabili:
			$nom = $cog = $email = $pass = $codf = $indi = $tel = "";

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
				check_char($nom, "name", 3);
				check_char($cog, "surname", 3);
				check_char($email, "email", 13);
				check_char($indi, "indirizzo", 5);
				check_char($tel, "telefono", 11);

				//una verifica speciale per il codice fiscale tramite la quale verifica ogni campo del codice fiscale:
				if (preg_match('/^[a-zA-Z]{6}\d{2}[0-9]\d{1}[a-zA-Z]\d{2}[0-9]\d{1}[a-zA-Z]\d{3}[0-9]\d{1}[a-zA-Z]$/', $codf)==1 or strlen($codf)>15){
					$codf = test_input($_POST["codice_fiscale"]);
				}else{
					echo " Reinserire il codice fiscale!! <br><br>";
					$codf = test_input("");
				}
				if (strlen($pass)>4){
					$pass = test_input($_POST["password"]);

				}else{
					echo " Reinserire la password !! <br><br>";
					$pass = test_input("");
				}
			}

			if (!empty($codf) && !empty($cog) && !empty($email) && !empty($indi) && !empty($nom) && !empty($pass) && !empty($tel)){

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
					if($result2->num_rows>0){
						echo "<br>Questo Codice Fiscale e gia stato utilizzato!<br>";
					}
					if($result3->num_rows>0){
						echo "<br>Questo numero di telefono e gia stato utilizzato!<br>";
					}

				}elseif($result2->num_rows>0){
					echo "<br> Questo Codice Fiscale e gia stato utilizzato!<br>";
					if($result->num_rows>0){
						echo "<br>Questa email e gia stata usata!<br>";
					}
					if($result3->num_rows>0){
						echo "<br>Questo numero di telefono e gia stato utilizzato!<br>";
					}

				}elseif($result3->num_rows>0){
					echo "<br>Questo numero di telefono e gia stato utilizzato!<br>";
					if($result->num_rows>0){
						echo "<br>Questa email e gia stata usata!<br>";
					}
					if($result2->num_rows>0){
						echo "<br>Questo Codice Fiscale e gia stato utilizzato!<br>";
					}
				}else{
					//ucfirst serve per mettere la prima lettera maiuscola
					//modifica tutti i caratteri in minuscolo e poi porta solo la prima maiuscola
					//entra AnDreA deve diventare Andrea
					$cogmaiuscolo = ucfirst($cog);
					$nommaiuscolo = ucfirst($nom);
					$codfmaiuscolo = strtoupper($codf);

					$sql = "INSERT INTO utente (CodiceFiscale,Cognome,Email,Indirizzi,Nome,Password,Telefono) VALUES ('$codfmaiuscolo','$cogmaiuscolo','$email','$indi','$nommaiuscolo','$pass','$tel')";
					if ($conn->query($sql)===true){
						//condizione che va a verificare se il bottone e stato schiacciato, nel momento in cui il bottone viene schiacciato allora ti manda alla prossima pagina salvando anche tutto nel database
						if(isset($_POST['submit'])){
							header('Location: login.php');
						}
					}else{
						echo "ERRORE". $sql . "" . $conn->connect_error;
					}
				}
				$conn->close();
			}
		?>
		<?php
			include "../footer.html";
		?>
	</body>
</html>