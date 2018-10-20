<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema Experto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/steve.png">
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
	</head>
	<body>
		<div class="container">
			<div class="card">
				<div class="card-content">
					<h1>CompuSteve</h1>
					<img id="steve" src="img/steve-neon.png">
					<?php
						session_start(); // Se inicia la sesion
						$servername = "localhost";    // Se declaran todas
						$username   = "root";         // las variables necesarias
						$password   = "";			  // para iniciar la conexion
						$database   = "sistemaexperto";  // con la base de datos

						// Se crea la conexion
						$connection = new mysqli($servername, $username, $password, $database);

						// Se prueba la conexion y si falla se detiene la ejecucion del programa y se muestra el error
						if ($connection->connect_error) {
						    die("Connection failed: " . $connection->connect_error);
						}

						if (isset($_POST['solucion'])) {
							if ($_POST['solucion']) {

								$sqlnuevasolucion = "INSERT INTO preguntas (pregunta, solucion) VALUES ('" . $_POST['solucion'] . "', '1')";
								$connection->query($sqlnuevasolucion);
								$id = $connection->insert_id;

								$sqlnuevarespuesta = "INSERT INTO respuestas (respuesta, pregunta, siguiente) VALUES ('si', '" . $_SESSION['nuevapregunta'] . "', '" . $id . "')";
								$connection->query($sqlnuevarespuesta);

								$sqlnuevarespuesta = "INSERT INTO respuestas (respuesta, pregunta, siguiente) VALUES ('no', '" . $_SESSION['nuevapregunta'] . "', '" . $_SESSION['pregunta'] . "')";
								$connection->query($sqlnuevarespuesta);
								
								echo '<h4 class="graffiti">Gracias!!! me has ayudado a ser un poco mas inteligente</h4>';
							}
						}
					?>
				</div>
				<div class="card-action">
					<a href="index.php">Volver a jugar</a>
		        </div>
		    </div>
		</div>
	</body>
</html>