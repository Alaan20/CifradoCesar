<?php
	include_once('../clases/Mensaje.class.php');

	$obj_mensaje = new Mensaje();

	if (!isset($_GET['tipo_fila']) && !isset($_GET['idusuario'])) {
	
		$obj_resultado_consulta = $obj_mensaje->busco_mensaje_previo_con_id_respuesta($_GET['idmensaje']);		
			
	} else {

		$obj_resultado_consulta = $obj_mensaje->obtengo_informacion_de_mensaje_con_id($_GET['idmensaje']);
		$obj_resultado_consulta->tipo_fila = $_GET['tipo_fila'];
		
		if ($_GET['idusuario'] == $obj_resultado_consulta->destinatario && $_GET['tipo_fila'] !='enviados' && $obj_resultado_consulta->leido != '1') {
			
			$exito_en_marcar_leido_en_bd = $obj_mensaje->marcar_mensaje_como_leido($_GET['idmensaje']);

			//este if esta por si acaso, asi no hay inconsistencias entre cliente y servidor
			if ($exito_en_marcar_leido_en_bd) {	$obj_resultado_consulta->leido = '1'; }
		}
	}
	
	echo json_encode($obj_resultado_consulta);
?>