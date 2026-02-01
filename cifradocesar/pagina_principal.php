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
	<title>Pagina Principal</title>
	<link rel="stylesheet" type="text/css" href="estilos/estilos_pagina_principal.css">
	<script type="module" src=".\javascript\pagina_principal.js"></script>
	<script>
		function cerrar_y_limpiar_modal () {
			let lbl_asunto = document.getElementById("id_lbl_asunto")
			let lbl_mensaje = document.getElementById("id_lbl_mensaje")
			let lbl_fecha = document.getElementById("id_lbl_fecha")
			let lbl_remitente = document.getElementById("id_lbl_remitente")
			let div_oculto_mensaje_previo = document.getElementById("id_div_msj_anterior") 	
			
			lbl_asunto.innerHTML = ''
			lbl_mensaje.innerHTML = ''
			lbl_fecha.innerHTML = ''
			lbl_remitente.innerHTML = ''
			div_oculto_mensaje_previo.hidden = true

			let dialog = document.getElementById('dialog_mensaje')
			dialog.close()
		}

		function cerrar_modal(){
			let dialog_bienvenida = document.getElementById("dialog_bienvenida")
			dialog_bienvenida.close()
		}

		function ocultar_seccion() {
			div = document.getElementById("id_div_rta")
			div.hidden = true
		}

		function mostrar_seccion_rta(){
			div = document.getElementById("id_div_rta")
			div.hidden = false
		}

		function ocultar_mensaje_previo() {
			let div_oculto_mensaje_previo = document.getElementById("id_div_msj_anterior") 	
			div_oculto_mensaje_previo.hidden = true
		}

	</script>
</head>
<body>
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
		<button onclick="cerrar_modal()">OK</button>
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
				echo $res;

				$_SESSION['ult_fecha_acceso'] = $fecha_actual;

				$usuario_obj->actualizo_ultima_fecha_acceso ($_SESSION['id_usuario_actual'], $_SESSION['ult_fecha_acceso']);
				?>
			</span>  
		</h3>
	</section>

	<section id="seccion_listados">
				
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
		<button onclick="cerrar_y_limpiar_modal()">Cerrar</button>
		<button id="id_btn_responder" onclick="mostrar_seccion_rta()" hidden>Responder</button>
	
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
			<button onclick="ocultar_mensaje_previo()">Ocultar mensaje previo</button>
		</div>

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
					
				<button onclick="ocultar_seccion()" type="button">Ocultar</button>
				<button id="btn_enviar_respuesta">Enviar</button>

			</form>
		</div>

	</dialog>

</body>
</html>