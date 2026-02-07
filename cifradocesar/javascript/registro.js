function ir_a_login () {
	window.location.assign('./login.php')
}

function valido_registro() {
	nombre_ing = document.getElementById('inp_nombre_completo').value
	apellido_ing = document.getElementById('inp_apellido').value
	correo_ing = document.getElementById('inp_correo').value
	nombre_usuario_ing = document.getElementById('inp_nombre_usuario').value
	contrasenia_ing = document.getElementById('inp_contrasenia').value

	nombre_sin_espacios = nombre_ing.replace(/\s+/g, '')
	apellido_sin_espacios = apellido_ing.replace(/\s+/g, '')
	nombre_usuario_sin_espacios = nombre_usuario_ing.replace(/\s+/g, '')
	contrasenia_sin_espacios = contrasenia_ing.replace(/\s+/g, '')
	
	boolean_nombre_y_apellido = nombre_sin_espacios.length>=3 && apellido_sin_espacios.length>=3

	boolean_nombre_usuario_y_contrasenia = nombre_usuario_sin_espacios.length>=4 && contrasenia_sin_espacios.length >=5
	if ( boolean_nombre_y_apellido &&  boolean_nombre_usuario_y_contrasenia && correo_ing.length>=4) {

		comienzo_registro_en_bd(nombre_ing, apellido_ing, correo_ing, nombre_usuario_ing, contrasenia_ing)
	
	} else {
		alert("Quedan campos por completar o te falta algún caracter en alguno")
	}
}

function comienzo_registro_en_bd (nombre, apellido, correo, nombre_usuario, contra) {
	attr_conexion = "nombre="+nombre+"&apellido="+apellido+"&correo="+correo+"&nombre_usuario="+nombre_usuario+"&contrasenia="+contra
	obj_conexion = new XMLHttpRequest()
	obj_conexion.open('GET','php/registrarse.php?'+attr_conexion, true)
	obj_conexion.onreadystatechange = notifico_usuario
	obj_conexion.send(null)

	function notifico_usuario (){
		
		if ( (obj_conexion.readyState == 4) && (obj_conexion.status == 200) ) {

			resultado = JSON.parse(obj_conexion.responseText)
			
			if (resultado.insertado == 'false'){
				alert("El nombre de usuario ingresado ya existe en la bd. Pruebe con otro.")
			} else {
				alert("Usuario agregado exitosamente. Redirigiendo al login...")
				window.location.assign("./login.php")
			}
		}
	}
}