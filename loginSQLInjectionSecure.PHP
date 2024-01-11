<!DOCTYPE html>
<html>
<head>
	<title>SQL injection</title>
	<style>
		body{
		}
		.user {
			background-color: yellow;
		}
	</style>
</head>

<body>
	<h1>PDO vulnerable a SQL injection</h1>

	<?php
	if (isset($_POST["user"]) && isset($_POST["password"])) {
		$dbhost = $_ENV["localhost"];
		$dbname = $_ENV["mylogin"];
		$dbuser = $_ENV["arnau"];
		$dbpass = $_ENV["P@ssw0rd1234"];

		# Connectem a MySQL (host,usuari,contrassenya)
		$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
 
		$username = $_POST["user"];
		$pass = $_POST["password"];
		# (2.1) creem el string de la consulta (query)
		$qstr = "SELECT * FROM users WHERE name='$username' AND password=SHA2('$pass',512);";
		$consulta = $pdo->prepare($qstr);

		# Enviem la query al SGBD per obtenir el resultat
		$consulta->execute();
 
		if( $consulta->errorInfo()[1] ) {
			echo "<p>ERROR: ".$consulta->errorInfo()[2]."</p>\n";
			die;
		}

		if ($consulta->rowCount() >= 1) {
			# Si la autenticación fue exitosa, muestra un mensaje
			foreach( $consulta as $user ) {
				echo "<div class='user'>¡Inicio de sesión exitoso para ".$user["name"]."!</div>";
			}
		} else {
			echo "<div class='user'>No se encontró ningún usuario con ese nombre o contraseña.</div>";
		}
	}
	?>
 	
 	<fieldset>
 		<legend>Login form</legend>
	  	<form method="post">
			User: <input type="text" name="user" /><br>
			Pass: <input type="text" name="password" /><br>
			<input type="submit" /><br>
	 	</form>
  	</fieldset>
</body>
</html>
