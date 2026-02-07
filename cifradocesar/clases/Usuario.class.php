<?php
class Usuario {

	private $conexion;

	function __construct () {
		$this->conexion = new mysqli("localhost","root","","cifradocesar") or die ("Error al realizar la conexion a la base de datos");
	}

	function consultar_ultima_fecha_hora (){
		$sql_consulto = "SELECT COALESCE(ultima_fecha_hora_acceso, 'nulo') as ultima FROM usuarios where id_usuario = ".$_SESSION['id_usuario_actual'];
		$respuesta = $this->conexion->query($sql_consulto) or die("fallo al actualizar ultima hora acceso");
		$obj = $respuesta->fetch_object();
		return $obj->ultima;
	}

	function actualizo_ultima_fecha_acceso ($id_usuario, $nueva_fecha_hora_acceso){
		$sql_actualizo = "UPDATE usuarios SET ultima_fecha_hora_acceso = '".$nueva_fecha_hora_acceso."' WHERE id_usuario = ".$id_usuario;
		$bool = $this->conexion->query($sql_actualizo) or die("fallo al actualizar ultima hora acceso");
	}

	function insertar_usuario_en_bd ($nombre, $apellido, $correo, $nombre_usuario, $contrasenia) {

		$sql_insertar_usuario = "INSERT INTO usuarios (nombre, apellido, correo, nombre_usuario, contrasenia) VALUES ('".$nombre."','".$apellido."', '".$correo."','".$nombre_usuario."','".$contrasenia."')";
		
		$obj = new StdClass();
		
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		
		try {
			$bool_usuario_insertado = $this->conexion->query($sql_insertar_usuario) or die("Error al realizar la consulta");
			$obj->insertado = 'true';
		} catch (\mysqli_sql_exception $e){
			if ($e->getCode() == 1062) {
				$obj->insertado = 'false';
			}
		}
		$this->conexion->close();
		return $obj;
	}

	function obtengo_todos_los_usuarios_en_bd () {

		$consulta = "SELECT id_usuario,nombre_usuario FROM usuarios";

		$listado = $this->conexion->query($consulta) or die("Error al realizar la consulta");
	
		$cadena_resultante = '';

		if ($listado->num_rows>0) {
			while ($usuario = $listado->fetch_object()) {
				$cadena_resultante .= "<option value='".$usuario->id_usuario."'>".$usuario->nombre_usuario."</option>";
			}
		}
		
		$this->conexion->close();
		$listado->free();

		return $cadena_resultante;
	}

	function existe_usuario_en_bd ($nombre_usuario, $contrasenia) {
	
		$consulta = "SELECT * FROM usuarios WHERE 
		nombre_usuario = '".$nombre_usuario."' AND 
		contrasenia = '".$contrasenia."'";

		$listado = $this->conexion->query($consulta) or die("Error al realizar la consulta");

		if ($listado->num_rows>0) {
			return true; 
		}
		return false;
	}

	function get_nombre_usuario_por_id($id_usuario) {
		$consulta = "SELECT nombre_usuario FROM usuarios WHERE 
		id_usuario = ".$id_usuario;

		$resultado = $this->conexion->query($consulta) or die("Error al realizar la consulta");
		$resultado_obj_usuario = $resultado->fetch_object();
		
		return $resultado_obj_usuario->nombre_usuario;
	}

	function obtener_id_usuario ($nombre_usuario) {
		$consulta = "SELECT id_usuario FROM usuarios WHERE nombre_usuario = '".$nombre_usuario."'";
		$resultado = $this->conexion->query($consulta) or die("Error al obtener id usando el nombre de usuario");
		$usuario_obt = $resultado->fetch_object();
		
		return $usuario_obt->id_usuario;
	}

}
?>