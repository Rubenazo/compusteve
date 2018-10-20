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
		?>
		<div class="container">
			<div class="card">
				<div class="card-content">
					<h1>CompuSteve</h1>
					<div class="row">
						<div class="col s3">
							<img id="steve" src="img/steve-neon.png">
						</div>
						<?php
							if (isset($_POST['respuesta'])) {
								$pregunta = $_POST['respuesta'];
							} else {
								$pregunta = 1;
							}

							$sqlpreg   = "SELECT * FROM preguntas WHERE id = " . $pregunta;
							$preguntas = $connection->query($sqlpreg);

							$sqlresp    = "SELECT * FROM respuestas WHERE pregunta = " . $pregunta;
							$respuestas = $connection->query($sqlresp);

							if ($preguntas->num_rows > 0) {
							    // se imprimen los datos de cada registro
							    while($row = $preguntas->fetch_assoc()) {
							    	if ($row['solucion']) {
							        	$_SESSION['pregunta'] = $row['id'];
							        	$_SESSION['respuesta'] = $_POST['ultimarespuesta'];
							        	echo "<h4>Estás pensando en...</h4>";
							        	echo "<h3>" . $row['pregunta'] . "!</h3>";
							        	echo "<h4>¿Es correcto?</h4>";
						?>
							        	<form method="POST" action="heuristica.php">
							        		<label>
							        			<input type="radio" name="heuristica" value="0">
							        			<span>Si</span>
							        		</label>
							        		<label>
							        			<input type="radio" name="heuristica" value="1">
							        			<span>No</span>
							        		</label>
											<div class="input-field">
												<input type="submit" class="btn" value="Siguiente">
											</div>
										</form>
						<?php
										echo '</div></div><div class="card-action"><a href="index.php">Atras</a></div>';
							        	return;
							        }
							        echo "<h3>¿" . $row['pregunta'] . "?</h3>";
							    }
							} else {
							    echo "0 results";
							}

							if ($respuestas->num_rows > 0) {
						?>

						<form method="POST" action="sistemaexperto.php">
							<input type="hidden" name="ultimarespuesta">
						<?php
								// se imprimen los datos de cada registro
							    while($row = $respuestas->fetch_assoc()) {
							        echo "<label><input type='radio' name='respuesta' value='" . $row['siguiente'] . "' data-id='" . $row['id'] . "'><span>" . $row['respuesta'] . "</span></label>";
							    }
							} else {
							    echo "0 resultados";
							}
						?>
							<div class="input-field">
								<input type="submit" class="btn" value="Siguiente">
							</div>
						</form>
					</div>
				</div>
				<div class="card-action">
					<a href="index.php">Atras</a>
		        </div>
			</div>
		</div>
		<script type="text/javascript">
			for(var i = 0; i < document.getElementsByName('respuesta').length; i++) {
				document.getElementsByName('respuesta')[i].addEventListener('change', function(event) {
					document.getElementsByName('ultimarespuesta')[0].value = event.target.getAttribute('data-id');
				});
			}
		</script>
	</body>
</html>