<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema Experto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/steve.png">
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
        <script type="text/javascript" src="css/materialize.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <style type="text/css">
			#steve {
				-webkit-filter: grayscale(100%);;
				filter: grayscale(100%);
			}
        </style>
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

						if (isset($_POST['pregunta'])) {
							if ($_POST['pregunta']) {

								$sqlnuevapregunta = "INSERT INTO preguntas (pregunta, solucion) VALUES ('" . $_POST['pregunta'] . "', '0')";
								$connection->query($sqlnuevapregunta);
								$id = $connection->insert_id;
								$_SESSION['nuevapregunta'] = $id;

								$sqlactualizarrespuesta = "UPDATE respuestas SET siguiente = " . $id . " WHERE id = " . $_SESSION['respuesta'];
								$connection->query($sqlactualizarrespuesta);
								echo "<h4>¿Cual era tu animal?</h4>";
					?>
								<form method="POST" action="nuevasolucion.php">
									<div class="input-field">
						          		<input type="text" name="solucion" id="solucion" class="validate" required>
						          		<label for="solucion">Animal</label>
							        </div>
									<div class="input-field">
										<input type="submit" class="btn" value="Siguiente">
									</div>
								</form>
					<?php
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>