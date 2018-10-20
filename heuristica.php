<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema Experto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/steve.png">
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
        <script type="text/javascript" src="css/materialize.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <?php
	        if (isset($_POST['heuristica'])) {
				if (!$_POST['heuristica']) {
		?>
			        <style type="text/css">
						#steve {
							animation-name: roll;
			    			animation-duration: 1s;
			    			animation-iteration-count: infinite;
						}
			        </style>
		<?php
			    } else {
		?>
					<style type="text/css">
						#steve {
							-webkit-filter: grayscale(100%);;
							filter: grayscale(100%);
						}
			        </style>
		<?php
			    }
			}
		?>
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
						$password   = "";		      // para iniciar la conexion
						$database   = "sistemaexperto";  // con la base de datos

						// Se crea la conexion
						$connection = new mysqli($servername, $username, $password, $database);

						// Se prueba la conexion y si falla se detiene la ejecucion del programa y se muestra el error
						if ($connection->connect_error) {
						    die("Connection failed: " . $connection->connect_error);
						}

						if (isset($_POST['heuristica'])) {
							if ($_POST['heuristica']) {
								echo "<h4>¿Que característica diferencia a tu animal del que te mostre?</h4>";
					?>
								<form method="POST" action="nuevapregunta.php">
									<div class="input-field">
						          		<input type="text" name="pregunta" id="pregunta" class="validate" required>
						          		<label for="pregunta">Característica</label>
							        </div>
									<div class="input-field">
										<input type="submit" class="btn" value="Siguiente">
									</div>
								</form>
					<?php
								echo '</div><div class="card-action"><a href="index.php">Atras</a></div>';
								return;
							} else {
								echo '<h4 class="graffiti">Yaaay!!! Acierto de nuevo!</h4>';
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