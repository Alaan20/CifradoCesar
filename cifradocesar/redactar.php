<?php

	//esto se encuentra en la mayoria de paginas para evitar que usuarios no registrados ingresen al sistema, en caso de que no se detecte una sección, te redirige al login (o Iniciar Sesion)

	session_start();
	if (!isset($_SESSION['nombre_usuario']) ) {
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Redactar</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos_redactar.css">
	<script type="module" src=".\javascript\redactar_nuevo.js"></script>
	
</head>

<body>

	<!-- Esta seccion esta dedicada a redactar un mensaje, todos los campos se completan y/o seleccionan, segun corresponda, para luego poder ver cómo se almacenara el mensaje cifrado con el cifrado cesar y desplazamiento seleccionado -->
	<section id="div_caja">
	
		<h1>Redactar Mensaje</h1>
			
		<h3>Asunto</h3>
		<input id="inp_texto_asunto" type="text" placeholder="ingrese un texto" maxlength="20" minlength="4">

		<h3>Mensaje</h3>
		<div id="inp_texto_mensaje" contenteditable role="textbox" aria-placeholder="ingrese un text"></div>
		
		<p>Seleccione el desplazamiento a aplicar:
			<select id="select_desplazamiento">
				<option selected disabled value="0">0</option>
				<?php
					for ($i=1; $i <= 9; $i++) { 
						echo "<option value='".$i."'>".$i."</option>";	
					}
				?>
			</select>
		</p>

		<p>Seleccione el destinatario del mensaje:
			<select id="select_usuario">
				<option selected disabled>ninguno</option>
				<?php
					include_once('../cifradocesar/clases/Usuario.class.php');
					$usuario = new Usuario();
					$resultado = $usuario->obtengo_todos_los_usuarios_en_bd();
					echo $resultado; //imprime todos los usuarios en formato option
				?>	
			</select>
		</p>
		
		<button id="id_btn_enviar">Enviar Mensaje</button><br>

	</section>

	<!-- Esta seccion muestra el asunto y contenido del mensaje cifrados, solo espera que el usuario confirme los datos para guardarlos en la base de datos -->

	
	<dialog id="dialog_rta">
		<form id='formulario_enviar_mensaje' method="post" action="./php/enviar_mensaje.php">
		
		<label >Asunto cifrado:</label>
		<br>
		<input type="text" name="asunto_cif" id="id_inp_asunto_cif" hidden readonly>
		<label id="id_lbl_asunto_cif" readonly></label>
		<br><br>

		<label for="mensaje_cif">Mensaje cifrado:</label>
		<br>
		<input type="text" name="mensaje_cif" id="id_inp_mensaje_cif" hidden></input>
		<div id="id_lbl_mensaje_cif" readonly role="textbox" aria-placeholder="ingrese un text"></div>
		<br><br>
		<input type="text" name="asunto_r" id="id_asunto_h" hidden maxlength="100" readonly>
		<input type="text" name="mensaje_r" id="id_h_mensaje" hidden maxlength="800" readonly>
		<input type="text" name="desplazamiento" id="id_h_des" hidden readonly>
		<input type="text" name="destinatario" id="id_h_destinatario" hidden readonly>
		<input type="text" name="id_usuario_actual" hidden readonly 
		<?php  
			echo "value='".$_SESSION['id_usuario_actual']."'";
		?>
		>

		<h4>Desea enviar el mensaje?</h4>
		<button id="btn_dialog" type="submit">Si</button><button type="button" id="id_btn_cerrar">No</button>
		</form>
		
	</dialog>

</body>

</html>