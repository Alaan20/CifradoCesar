<?php

	include_once('../clases/Mensaje.class.php');

	$obj_mensaje = new Mensaje();

	$resultado_del_insertar = $obj_mensaje->insertar_en_tabla_mensajes($_POST['asunto_cif'], $_POST['mensaje_cif'], $_POST['id_usuario_actual'], $_POST['destinatario'], $_POST['desplazamiento'], 0, $_POST['asunto_r'], $_POST['mensaje_r']);	

	//este resultado es true o false
	if ($resultado_del_insertar) {
		
		if (isset($_POST['mensaje_a_responder'])) {
			$obj_mensaje->insertar_en_tabla_respuesta($_POST['mensaje_a_responder']);
		}
		$obj_mensaje->cerrar_conexion();
		header('location: ..\pagina_principal.php');
	}
	$obj_mensaje->cerrar_conexion();
?>