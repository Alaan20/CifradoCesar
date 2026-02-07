<?php

	include_once('../clases/Mensaje.class.php');

	$obj_mensaje = new Mensaje();

	$resultado_del_insertar = $obj_mensaje->insertar_en_tabla_mensajes($_POST['asunto_cif'], $_POST['mensaje_cif'], $_POST['id_usuario_actual'], $_POST['destinatario'], $_POST['desplazamiento'], 0, $_POST['asunto_r'], $_POST['mensaje_r']);	

	//este resultado devuelve el id del ultimo mensaje ingresado, si es 0 significa que el mensaje no se inserto en la tabla mensajes.
	if ($resultado_del_insertar != 0) {
		
		//si el metodo post esta seteado significa que existe un mensaje a responder, en caso contrario no posee valor.
		if (isset($_POST['mensaje_a_responder'])) {
			$obj_mensaje->insertar_en_tabla_respuesta($_POST['mensaje_a_responder'], $resultado_del_insertar);
		}
		$obj_mensaje->cerrar_conexion();
		header('location: ..\menu_principal.php');
	}
	$obj_mensaje->cerrar_conexion();
?>