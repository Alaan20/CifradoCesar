<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio de Sesi&oacuten</title>
	<link rel="stylesheet" type="text/css" href="estilos\login.css">
	<script type="text/javascript" src="javascript\login.js"></script>
</head>

<body>
	<?php
		if ($_POST) {
			
			include_once('../cifradocesar/clases/Usuario.class.php');
			$usuario = new Usuario();
			$respuesta_bool = $usuario->existe_usuario_en_bd ($_POST['inp_nombre_usuario'],$_POST['inp_contrasenia']);
			
			if ($respuesta_bool) {
				$_SESSION['id_usuario_actual'] = $usuario->obtener_id_usuario($_POST['inp_nombre_usuario']);
				$_SESSION['nombre_usuario'] = $_POST['inp_nombre_usuario'];
				header("location: pagina_principal.php");
			} else {
				header("location: login.php");
			}
			
		}
		else
		{
	
	?>
	<section>
		
		<h2>Iniciar Sesi&oacuten</h2>

		<form method="post" action="login.php">
		
			<p>Usuario</p>
			<input type="text" name="inp_nombre_usuario" placeholder="nombre de usuario" required maxlength="40">
							
			<p>Contraseña</p>
			<input type="password" name="inp_contrasenia" placeholder="contraseña" required maxlength="30">

			<br><br>
			<button>Acceder</button>
		</form>

		<button onclick="ir_a_registrarse()">Registrarse</button>

	</section>

	<br><br>

	<?php
		}
	?>
</body>


<footer>
	Alan Viera
</footer>

</html>