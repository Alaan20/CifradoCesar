<?php
class Mensaje {

	function __construct (){
		$this->conexion = new mysqli("localhost","root","","cifradocesar") or die ("Error al realizar la conexion a la base de datos");
	}

	function cerrar_conexion () {
		$this->conexion->close();
	}

	function insertar_en_tabla_mensajes ($asunto_cif, $mensaje_cif, $id_usuario_actual, $id_destinatario, $desplazamiento, $leido, $asunto_r, $mensaje_r) {
		
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$arr_fecha = getdate();

		$minutos_modificados = rand(1,2) + $arr_fecha['minutes'];  //esto es para simular un delay entre los usuarios

		$fecha_recepcion_usuario = ''.$arr_fecha['year'].'-'.$arr_fecha['mon'].'-'.$arr_fecha['mday'].' '.$arr_fecha['hours'].':'.$minutos_modificados.':'.$arr_fecha['seconds'];
		
		$sql_insertar_mensaje = "INSERT INTO mensajes (asunto, contenido, remitente, destinatario, fecha_recepcion , desplazamiento, leido, reemplazo_asunto, reemplazo_mensaje) VALUES ('".$asunto_cif."','".$mensaje_cif."', ".$id_usuario_actual.",".$id_destinatario.", '".$fecha_recepcion_usuario."', ".$desplazamiento.", $leido, '".$asunto_r."','".$mensaje_r."')";

		$this->conexion->query("Begin");
		$bool_mensaje_insertado = $this->conexion->query($sql_insertar_mensaje) or die("Error al realizar la consulta");
		$id_ultimo_mensaje = $this->conexion->insert_id;
		if ($bool_mensaje_insertado) {
			$this->conexion->query("Commit");
			return $id_ultimo_mensaje;
		} else {
			$this->conexion->query("Rollback");
			return 0;
		}
		
	}

	function insertar_en_tabla_respuesta ($id_mensaje_principal_ing, $id_mensaje_respuesta_ing) {
		$sql_insertar_respuesta = "INSERT INTO respuestas (id_mensaje_original, id_mensaje_respuesta) VALUES (".$id_mensaje_principal_ing.",".$id_mensaje_respuesta_ing.")";

		$this->conexion->query("Begin");
		$bool_insertado = $this->conexion->query($sql_insertar_respuesta) or die("Error al insertar en la tabla respuestas");
		if ($bool_insertado) {
			$this->conexion->query("Commit");
		} else {
			$this->conexion->query("Rollback");
		}
	}

	function busco_mensaje_previo_con_id_respuesta ($id_respuesta) {
		
		if ($this->existe_mensaje_previo($id_respuesta)) {
			
			$sql_selecciono_msj_previo = "SELECT * FROM mensajes men INNER JOIN respuestas res ON men.id_mensaje = res.id_mensaje_original WHERE id_mensaje_respuesta = ".$id_respuesta;
			
			$resultado = $this->conexion->query($sql_selecciono_msj_previo) or die("Error al realizar la consulta");


			$mensaje = $resultado->fetch_object();

			$fecha = date_create($mensaje->fecha_recepcion);
			$fecha_formateada = date_format($fecha,'H:i:s d/m/y');
			
			$obj_a_devolver = new StdClass();
			$obj_a_devolver->id_mensaje = $mensaje->id_mensaje;
			$obj_a_devolver->asunto = $mensaje->asunto;
			$obj_a_devolver->contenido = $mensaje->contenido;
			$obj_a_devolver->remitente = $mensaje->remitente;
			$obj_a_devolver->destinatario = $mensaje->destinatario;
			$obj_a_devolver->fecha_recepcion = $fecha_formateada;
			$obj_a_devolver->desplazamiento = $mensaje->desplazamiento;
			$obj_a_devolver->reemplazo_asunto = $mensaje->reemplazo_asunto;
			$obj_a_devolver->reemplazo_mensaje = $mensaje->reemplazo_mensaje;
		} else {
			$obj_a_devolver->existe_mensaje_previo = 'no';
		}

		$resultado->free();
		$this->conexion->close();
		return $obj_a_devolver;
	}

	function obtengo_informacion_de_mensaje_con_id ($id_mensaje) {
		$consulta = "SELECT * FROM mensajes WHERE id_mensaje = ".$id_mensaje;
		$resultado = $this->conexion->query($consulta) or die("Error al obtener informacion del mensaje");

		if ($resultado->num_rows>0) {
			$mensaje = $resultado->fetch_object();

			$obj_date_fecha_envio = date_create($mensaje->fecha_envio);
			$fecha_envio_formateada = date_format($obj_date_fecha_envio,'H:i:s d/m/y');
			
			$obj_date_fecha_recepcion = date_create($mensaje->fecha_recepcion);
			$fecha_recepcion_formateada = date_format($obj_date_fecha_recepcion,'H:i:s d/m/y');


			$obj_a_devolver = new StdClass();
			$obj_a_devolver->id_mensaje = $mensaje->id_mensaje;
			$obj_a_devolver->asunto = $mensaje->asunto;
			$obj_a_devolver->contenido = $mensaje->contenido;
			$obj_a_devolver->remitente = $mensaje->remitente;
			$obj_a_devolver->destinatario = $mensaje->destinatario;
			$obj_a_devolver->fecha_envio = $fecha_envio_formateada;
			$obj_a_devolver->fecha_recepcion = $fecha_recepcion_formateada;
			$obj_a_devolver->desplazamiento = $mensaje->desplazamiento;
			$obj_a_devolver->leido = $mensaje->leido;
			$obj_a_devolver->reemplazo_asunto = $mensaje->reemplazo_asunto;
			$obj_a_devolver->reemplazo_mensaje = $mensaje->reemplazo_mensaje;
			$obj_a_devolver->existe_msj_previo = $this->existe_mensaje_previo($mensaje->id_mensaje);
			$obj_a_devolver->existe_respuesta_a_msj = $this->mensaje_tiene_respuesta ($mensaje->id_mensaje);
		}

		$resultado->free();
		$this->conexion->close();

		return $obj_a_devolver;
	}

	function existe_mensaje_previo ($id_mensaje) {
		$consulta = "SELECT coalesce(count(id_mensaje_original),0) as contador_mensaje_anterior FROM respuestas where id_mensaje_respuesta= ".$id_mensaje;
		$resultado = $this->conexion->query($consulta) or die("Error al consultar los mensajes previos");
		$obj = $resultado->fetch_object();
		$resultado->free();
		if ($obj->contador_mensaje_anterior > 0) {
			return true;
		}
		return false;
	}

	function mensaje_tiene_respuesta ($id_mensaje) {
		$consulta = "SELECT coalesce(count(id_mensaje_respuesta),0) as contador_respuesta FROM respuestas where id_mensaje_original= ".$id_mensaje;
		$resultado = $this->conexion->query($consulta) or die("Error al consultar las respuestas del mensaje");
		$obj = $resultado->fetch_object();
		$resultado->free();
		if ($obj->contador_respuesta > 0) {
			return 'true';
		}
		return 'false';
	}

	function marcar_mensaje_como_leido ($id_mensaje){
		$conexion = new mysqli("localhost","root","","cifradocesar") or die ("Error al realizar la conexion a la base de datos");
		
		$consulta = "UPDATE mensajes SET leido = 1 WHERE id_mensaje = ".$id_mensaje;
		
		$bool_resultado = $conexion->query($consulta) or die("Error al actualizar el estado leido del mensaje");

		$conexion->close();
		return $bool_resultado;
	}

	function obtengo_listado_mensajes_enviados ($id_usuario) {
		$consulta = "SELECT id_mensaje, asunto, nombre_usuario, fecha_envio FROM mensajes INNER JOIN usuarios ON mensajes.destinatario = usuarios.id_usuario WHERE remitente = ".$id_usuario." ORDER BY fecha_envio DESC";

		$listado_rta = $this->conexion->query($consulta) or die("Error al realizar la consulta");
		return $listado_rta;
	}

	function obtengo_listado_mensajes_recibidos ($id_usuario) {
		$consulta = "SELECT id_mensaje, asunto, nombre_usuario, fecha_recepcion, leido FROM mensajes INNER JOIN usuarios ON mensajes.remitente = usuarios.id_usuario WHERE destinatario = ".$id_usuario."  AND fecha_recepcion < CURRENT_TIMESTAMP() ORDER BY fecha_envio DESC";

		$listado = $this->conexion->query($consulta) or die("Error al realizar la consulta");
		return $listado;
	}

	function obtengo_mensajes_recibidos_desde_ultima_vez ($id_usuario) {
		$consulta = "SELECT COUNT(id_mensaje) as cuenta FROM mensajes WHERE destinatario = ".$id_usuario." AND fecha_recepcion > (SELECT ultima_fecha_hora_acceso FROM usuarios WHERE id_usuario = ".$id_usuario.") AND fecha_recepcion < CURRENT_TIMESTAMP()";

		$listado = $this->conexion->query($consulta) or die("Error al realizar la consulta");
		$elem = $listado->fetch_object();
		return $elem;
	}

}
?>