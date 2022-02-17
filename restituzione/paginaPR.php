<!DOCTYPE html>
<html>
	<!-- 
		Togliere il css da qua e spostarlo in un codice unico
		Aggiungere Header & Footer
		Eliminare questa pagina e spostare tutto su restituzione.php
	-->
	<style>
		body{
			background-color: #f18973;
			text-align: center;
		}
		
		h1{
			font-size: 40px;
		}
		
		div{
			position: absolute;
			font-family: 'Courier New', monospace;
			border: 4px solid #000;
			background-color: white; 
			height: auto;
			width: 600px;
			top: 38%;
			left: 33%;
			padding: 15px;
		}
	</style>
	
	<body>
	<div>
		<h1> FUNZIONE DI RESTITUZIONE </h1>
		<form method="post" action="restituzione.php">
			<input type="submit" value="AVVIA FUNZIONE" style="font-size : 20px; width: auto; height: 100px;  font-family: 'Courier New', monospace;">
		</form>
	</div>
	</body>
</html>