function valido_registro() {
	nombre_ing = document.getElementById('inp_nombre_completo').value
	apellido_ing = document.getElementById('inp_apellido').value
	correo_ing = document.getElementById('inp_correo').value
	nombre_usuario_ing = document.getElementById('inp_nombre_usuario').value
	contrasenia_ing = document.getElementById('inp_contraseña').value

	attr_conexion = "nombre="+nombre_ing+"&apellido="+apellido_ing+"&correo="+correo_ing+"&nombre_usuario="+nombre_usuario_ing+"&contrasenia="+contrasenia_ing
	obj_conexion = new XMLHttpRequest()
	obj_conexion.open('GET','php/registrarse.php?'+attr_conexion, true)
	obj_conexion.onreadystatechange = notifico_usuario
	obj_conexion.send(null)

	function notifico_usuario (){
		
		if ( (obj_conexion.readyState == 4) && (obj_conexion.status == 200) ) {

			resultado = JSON.parse(obj_conexion.responseText)
			if (resultado.insertado == 'false'){
				alert("el nombre de usuario ingresado ya existe en la bd")
			} else {
				alert("usuario agregado exitosamente")
			}
		}
	}

}