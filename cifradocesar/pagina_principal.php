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
	<title>Pagina Principal</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos_pagina_principal.css">
	<script type="module" src=".\javascript\pagina_principal.js"></script>
</head>
<body>
	
	<!-- Este dialog se abre solamente despues del login, indica la fecha y hora de la ultima vez que se conectó el usuario y los mensajes recibidos desde esa fecha hasta la actual -->

	<?php
		if ($_SESSION['muestro_bienvenida'] == 'verdadero') {
			
			echo '<input type="text" hidden id="id_muestro_bienvenida" value="'.$_SESSION['muestro_bienvenida'].'">';
			$_SESSION['muestro_bienvenida'] = 'falso';

		} else {
			echo '<input type="text" hidden id="id_muestro_bienvenida" value="'.$_SESSION['muestro_bienvenida'].'">';
		}

	?>
		<dialog id="dialog_bienvenida">
			<h2>Bienvenido/a 	<?php   echo '  '.$_SESSION['nombre_usuario']; ?>  </h2>

			<span>Recibiste:
				<?php
					include_once('../cifradocesar/clases/Mensaje.class.php');
					$mensaje_obj = new Mensaje();
					$elemento = $mensaje_obj->obtengo_mensajes_recibidos_desde_ultima_vez($_SESSION['id_usuario_actual']);
					echo $elemento->cuenta." mensajes desde la ultima vez.";

					include_once('../cifradocesar/clases/Usuario.class.php');
					$usuario_obj = new Usuario();
					$res = $usuario_obj->consultar_ultima_fecha_hora();
					echo '<br>Ultima fecha de acceso: '.$res;
				?>
			</span>
			<br><br>
			<button id="id_btn_cerrar_bienvenida">OK</button>

		</dialog>



	<span id="id_usuario" hidden> 
		<?php  echo $_SESSION['id_usuario_actual'];  ?>
	</span>


	<section id="seccion_cabecera">
		<h2>¡¡Bienvenido/a  <?php  echo '  '.$_SESSION['nombre_usuario'];  ?> !! </h2>
		
		<h3> Su &uacuteltimo acceso fue el: 
			<span id="span_ultimo_acceso">
				<?php
				date_default_timezone_set('America/Argentina/Buenos_Aires');
				$arr_fecha = getdate();

				$fecha_actual = ''.$arr_fecha['year'].'-'.$arr_fecha['mon'].'-'.$arr_fecha['mday'].' '.$arr_fecha['hours'].':'.$arr_fecha['minutes'].':'.$arr_fecha['seconds'];

				include_once('../cifradocesar/clases/Usuario.class.php');
				$usuario_obj = new Usuario();
				$res = $usuario_obj->consultar_ultima_fecha_hora();
				echo $res;  //muestra la ultima vez para corroborar que lo mostrado anteriormente (cantidad de mensajes recibidos desde la ultima vez) sea correcto, ademas queda bien.

				$usuario_obj->actualizo_ultima_fecha_acceso ($_SESSION['id_usuario_actual'], $fecha_actual);
				?>
			</span>  
		</h3>
	</section>


	<section id="seccion_listados">
		
		<!-- Contiene los mensajes recibidos, aquellos que tengan como destinatario al usuario actual -->		

		<article>
			<p>Aclaraci&oacuten: Los mensajes no le&iacutedos aparecen coloreados</p>
			<p>Mensajes recibidos</p>
			<table id="tabla_recibidos">
				
				<thead>
					<th>Asunto</th>
					<th>Remitente</th>
					<th>Fecha de Recepci&oacuten</th>
				</thead>

				<tbody id="contenido_tabla_recibidos">
					<?php
						include_once('../cifradocesar/clases/Mensaje.class.php');
						$obj_mensaje = new Mensaje();
						$coleccion_obj_consulta = $obj_mensaje->obtengo_listado_mensajes_recibidos($_SESSION['id_usuario_actual']);
					
						if ($coleccion_obj_consulta->num_rows>0) {
							$filas_a_insertar = '';
							while ($mensaje = $coleccion_obj_consulta->fetch_object()) {
								$filas_a_insertar .= "<tr value='".$mensaje->id_mensaje."' ";
								if ($mensaje->leido == '0') {
									$filas_a_insertar .= "class='no_leido'>
											<td class='no_leido'>".$mensaje->asunto."</td>
											<td class='no_leido'>".$mensaje->nombre_usuario."</td>
											<td class='no_leido'>".$mensaje->fecha_envio."</td>";		
								} else {
									$filas_a_insertar .= "class='leido'>
											<td class='leido'>".$mensaje->asunto."</td>
											<td class='leido'>".$mensaje->nombre_usuario."</td>
											<td class='leido'>".$mensaje->fecha_envio."</td>";
								}
								$filas_a_insertar .= "</tr>";
							}
							echo $filas_a_insertar;
						} else {
							echo '<p>No recibiste ning&uacuten mensaje.</p>';
						}

					?>
				</tbody>

			</table>

		</article>
	
		<!-- Contiene los mensajes enviados por el usuario actual -->	
		<article>
			<p>Listado de mensajes enviados</p>
			<table id="tabla_enviados">
				
				<thead>
					<th>Asunto</th>
					<th>Destinatario</th>
					<th>Fecha de Env&iacuteo</th>
				</thead>

				<tbody id="contenido_tabla_enviados">
					<?php
						include_once('../cifradocesar/clases/Mensaje.class.php');
						$obj_mensaje = new Mensaje();
						$coleccion_obj_consulta = $obj_mensaje->obtengo_listado_mensajes_enviados($_SESSION['id_usuario_actual']);
						if ($coleccion_obj_consulta->num_rows>0) {
							while ($mensaje = $coleccion_obj_consulta->fetch_object()) {
								echo "<tr class='enviados' value='".$mensaje->id_mensaje."'>
										<td>".$mensaje->asunto."</td>
										<td>".$mensaje->nombre_usuario."</td>
										<td>".$mensaje->fecha_envio."</td>
									  </tr>";						
							}
						}
					?>
				</tbody>

			</table>
	
		</article>

		<button class="btn_funcional">
			<a href="./redactar.php">Redactar mensaje</a>
		</button>

	</section>
	

	<!-- Esta seccion muestra la informacion del mensaje seleccionado desde la tabla, dependiendo que boton toques, podes responder, consultar el mensaje previo o volver al listado anterior.   -->

	<dialog id="dialog_mensaje">
		<p>Asunto</p>
		<label id="id_lbl_asunto"></label>

		<p>Mensaje</p>
		<label id="id_lbl_mensaje"></label>

		<p>Fecha recepci&oacuten</p>
		<label id="id_lbl_fecha"></label>

		<p>Remitente: 
		<label id="id_lbl_remitente"></label>
		</p>

		<input id="id_mensaje" hidden type="text">
		<br>
		<button id="id_btn_mostrar_mensaje" hidden>Mostrar Mensaje Anterior</button>
		<button id="id_btn_cerrar_mensaje">Cerrar</button>
		<button id="id_btn_responder" hidden>Responder</button>


		<!-- Esta seccion esta dedicada a mostrar el mensaje previo a la respuesta
		seria como el mensaje de tipo "pregunta" aunque como tal no lo sea.  --> 	
		<div hidden id="id_div_msj_anterior">
			<p>Asunto</p>
			<label id="id_lbl_asunto_msj_ant"></label>

			<p>Mensaje</p>
			<label id="id_lbl_mensaje_msj_ant"></label>

			<p>Fecha recepci&oacuten</p>
			<label id="id_lbl_fecha_msj_ant"></label>

			<p>Remitente:
			<label id="id_lbl_remitente_msj_ant"></label>
			</p>
			<button id="id_btn_ocultar_msj_previo">Ocultar mensaje previo</button>
		</div>



		<!-- Esta seccion esta dedicada a que el usuario pueda responder el mensaje
		de todos los datos al usuario solo se le solicita llenar el campo 
		"mensaje", debido a que los demas se toman del mensaje actual.  -->

		<div hidden id="id_div_rta">
			<form id="formulario_respuesta" method="post" action="./php/enviar_mensaje.php">

				<input id="id_inp_asunto" name="asunto_cif" hidden type="text">
				<input id="id_asunto_r" name="asunto_r" hidden  type="text">
				<input id="id_mensaje_cif" name="mensaje_cif" hidden  type="text">
				<input id="id_mensaje_r" name="mensaje_r" hidden  type="text">

				<input type="text" name="id_usuario_actual" hidden 
					<?php  echo "value='".$_SESSION['id_usuario_actual']."'";  ?>
				>

				<input id="id_mensaje_a_responder" name="mensaje_a_responder" hidden type="text">

				<p>Mensaje</p>
				<input type="text" id="id_inp_mensaje" maxlength="400" required>

				<br>

				<select name="destinatario" hidden>
					<option selected id="opc_destinatario"></option>
				</select>

				<input name="desplazamiento" id="id_desplazamiento" hidden>
					
				<button id="id_btn_ocultar_seccion_respuesta" type="button">Ocultar</button>
				<button id="btn_enviar_respuesta">Enviar</button>

			</form>
		</div>

	</dialog>

</body>
</html>