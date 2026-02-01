<?php
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
	<title>Prueba de pagina</title>
	
	<link rel="stylesheet" type="text/css" href="estilos/redactar.css">
	<script type="module" src=".\javascript\pagina_redactar.js"></script>
	
</head>

<body>

	<div>
		<section>
			<h1>Redactar Mensaje</h1>
		</section>

		<section>
			<h3>Asunto</h3>
			<input id="inp_texto_asunto" type="text" placeholder="ingrese un texto" maxlength="20" required>

			<br>
			<h3>Mensaje</h3>
			<textarea id="inp_texto_mensaje" type="text" placeholder="ingrese un texto" maxlength="400" required></textarea>

			<br>
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

		<section id="seccion_rta">
			<dialog id="dialog_rta">
				<form id='formulario_enviar_mensaje' method="post" action="./php/enviar_mensaje.php">
					
				<input type="text" name="asunto_cif" id="id_inp_asunto_cif" hidden>
				<label id="id_lbl_asunto_cif"></label>
				<br><br>

				<input type="text" name="mensaje_cif" id="id_inp_mensaje_cif" hidden></input>
				<label id="id_lbl_mensaje_cif"></label>
				<br><br>
				<input type="text" name="asunto_r" id="id_asunto_h" hidden maxlength="100">
				<input type="text" name="mensaje_r" id="id_h_mensaje" hidden maxlength="800">
				<input type="text" name="desplazamiento" id="id_h_des" hidden>
				<input type="text" name="destinatario" id="id_h_destinatario" hidden>
				<input type="text" name="id_usuario_actual"hidden 
				<?php  
					echo "value='".$_SESSION['id_usuario_actual']."'";
				?>
				>

				<h4>Desea enviar el mensaje?</h4>
				<button type="submit">Si</button><button type="button" id="id_btn_cerrar">No</button>
				</form>
				
			</dialog>
		</section>

	</div>

</body>

</html>