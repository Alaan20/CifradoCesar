<?php

	include_once('../clases/Usuario.class.php');
	$usuario = new Usuario();
	$obj_a_devolver = $usuario->insertar_usuario_en_bd($_GET['nombre'], $_GET['apellido'], $_GET['correo'], $_GET['nombre_usuario'], $_GET['contrasenia']);

	echo json_encode($obj_a_devolver);

?>