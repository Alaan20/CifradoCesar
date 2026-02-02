import {cifrar, descifrar} from './cifrado_cesar.js';

document.addEventListener('DOMContentLoaded', ()=> {

	//esta porcion de codigo sirve para detectar que fila del listado se clickeo, para mostrar
	//el mensaje descifrado, independientemente de la tabla en la que se encuentre
	let nodos_fila = document.querySelectorAll('tr')
	nodos_fila.forEach(fila => {
		fila.addEventListener('click', function(e){
			let fila_actual = e.target.closest('tr')
			let id = fila_actual.getAttribute('value')
			let clase_fila_actual = fila_actual.getAttribute('class')
			mostrar_mensaje_descifrado(id, clase_fila_actual)
		})

	})
	//termina porcion de codigo


	//seccion dedicada a la apertura y cierre del dialog bienvenida, utilizado como 
	//ventana emergente luego de iniciar sesion.
	let muestro_dialog_bienvenida = document.getElementById("id_muestro_bienvenida")
	let valor_muestro_bienvenida = muestro_dialog_bienvenida.getAttribute('value')

	var dialog_bienvenida = document.getElementById("dialog_bienvenida")
	
	if (valor_muestro_bienvenida == 'verdadero') {
		dialog_bienvenida.showModal()
	}

	let btn_cerrar_bienvenida = document.getElementById("id_btn_cerrar_bienvenida")
	btn_cerrar_bienvenida.addEventListener('click', () => {
		dialog_bienvenida.close()
	})

	//termina seccion dedicada a la apertura y cierre del dialog bienvenida


	let btn_cerrar_en_dialog = document.getElementById("id_btn_cerrar_mensaje")
	btn_cerrar_en_dialog.addEventListener('click', () => {
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
	})


	//SECCION RESPUESTA      SE HABILITA LA SECCION Y LUEGO SE DESHABILITA
	let div_seccion_respuesta = document.getElementById("id_div_rta")
	

	let btn_responder_en_dialog_mensaje = document.getElementById("id_btn_responder")
	btn_responder_en_dialog_mensaje.addEventListener('click', () => {
		div_seccion_respuesta.hidden = false
	})


	let btn_ocultar_seccion_respuesta = document.getElementById("id_btn_ocultar_seccion_respuesta")
	btn_ocultar_seccion_respuesta.addEventListener('click', () => {
		div_seccion_respuesta.hidden = true
	})



	let btn_enviar = document.getElementById("btn_enviar_respuesta")
	btn_enviar.addEventListener('click', (e)=> {
		e.preventDefault()
		let input_mensaje = document.getElementById("id_inp_mensaje")
		let desplazamiento_obt = document.getElementById("id_desplazamiento").value
		if (input_mensaje.value!= '') {
			let arreglo_cifrado = cifrar(input_mensaje.value, desplazamiento_obt)
			let	inp_mensaje_cifrado = document.getElementById("id_mensaje_cif")
			inp_mensaje_cifrado.setAttribute('value', arreglo_cifrado[0])
			let inp_mensaje_r = document.getElementById("id_mensaje_r")
			inp_mensaje_r.setAttribute('value', arreglo_cifrado[1])

			let id_mensaje = document.getElementById("id_mensaje").value
			let id_mensaje_a_responder = document.getElementById("id_mensaje_a_responder")

			id_mensaje_a_responder.setAttribute('value', id_mensaje)
			
			let form = document.getElementById("formulario_respuesta")
			form.submit()
			
		} else {
			alert("Faltan datos por completar!!")
			input_mensaje.focus()
		}
	})



	//SECCION MENSAJE PREVIO, SE ENCUENTRA LA FUNCIONALIDAD DE MOSTRAR LA SECCION Y DE OCULTARLA

	let btn_mostrar_mensaje_previo = document.getElementById("id_btn_mostrar_mensaje")
	
	btn_mostrar_mensaje_previo.addEventListener('click',(e)=>{
	
		let obj_con_id_msj_actual = document.getElementById("id_mensaje")
		let msj_actual = obj_con_id_msj_actual.getAttribute('value')
		let attr_conexion = "idmensaje="+msj_actual
		let obj_conexion = new XMLHttpRequest()
		obj_conexion.open('GET','php/obtener_info_mensaje.php?'+attr_conexion, true)
		obj_conexion.onreadystatechange = muestro_informacion
		obj_conexion.send(null)

		function muestro_informacion (){
		
			if ( (obj_conexion.readyState == 4) && (obj_conexion.status == 200) ) {

				let resultado = JSON.parse(obj_conexion.responseText)
			
				if (resultado.existe_mensaje_previo == 'no') {
					alert("no existe mensaje anterior")
				} else {

					let lbl_asunto = document.getElementById("id_lbl_asunto_msj_ant")
					let lbl_mensaje = document.getElementById("id_lbl_mensaje_msj_ant")
					let lbl_fecha = document.getElementById("id_lbl_fecha_msj_ant")
					let lbl_remitente = document.getElementById("id_lbl_remitente_msj_ant")

					let asunto = resultado.asunto
					let rem_asunto = JSON.parse(resultado.reemplazo_asunto)
					let contenido = resultado.contenido
					let rem_contenido = JSON.parse(resultado.reemplazo_mensaje)

					lbl_asunto.innerHTML = descifrar(asunto,rem_asunto,resultado.desplazamiento) 
					lbl_mensaje.innerHTML = descifrar(contenido,rem_contenido,resultado.desplazamiento)
					lbl_fecha.innerHTML = resultado.fecha
					lbl_remitente.innerHTML = resultado.remitente
				
					let div_oculto_mensaje_previo = document.getElementById("id_div_msj_anterior") 	
					div_oculto_mensaje_previo.hidden = false
				}
			}
		}
	})

	let btn_ocultar_mensaje_previo = document.getElementById("id_btn_ocultar_msj_previo")
	btn_ocultar_mensaje_previo.addEventListener('click', () => {
		let div_oculto_mensaje_previo = document.getElementById("id_div_msj_anterior") 	
		div_oculto_mensaje_previo.hidden = true
	})

})


function mostrar_mensaje_descifrado (id_mensaje, clase_fila){
	let id = document.getElementById("id_usuario").innerText
	let attr_conexion = "idmensaje="+id_mensaje+"&idusuario="+id+"&tipo_fila="+clase_fila
	let obj_conexion = new XMLHttpRequest()
	obj_conexion.open('GET','php/obtener_info_mensaje.php?'+attr_conexion, true)
	obj_conexion.onreadystatechange = notifico_usuario
	obj_conexion.send(null)

	function notifico_usuario (){
		
		if ( (obj_conexion.readyState == 4) && (obj_conexion.status == 200) ) {

			let resultado = JSON.parse(obj_conexion.responseText)
			let lbl_asunto = document.getElementById("id_lbl_asunto")
			let lbl_mensaje = document.getElementById("id_lbl_mensaje")
			let lbl_fecha = document.getElementById("id_lbl_fecha")
			let lbl_remitente = document.getElementById("id_lbl_remitente")
			let inp_id_mensaje = document.getElementById("id_mensaje")

			let asunto = resultado.asunto
			let rem_asunto = JSON.parse(resultado.reemplazo_asunto)
			let contenido = resultado.contenido
			let rem_contenido = JSON.parse(resultado.reemplazo_mensaje)
			inp_id_mensaje.setAttribute('value',resultado.id_mensaje)

			lbl_asunto.innerHTML = descifrar(asunto,rem_asunto,resultado.desplazamiento) 
			lbl_mensaje.innerHTML = descifrar(contenido,rem_contenido,resultado.desplazamiento)
			lbl_fecha.innerHTML = resultado.fecha
			lbl_remitente.innerHTML = resultado.remitente

			let campo_rem = document.getElementById("opc_destinatario")
			campo_rem.innerHTML = resultado.remitente
			campo_rem.setAttribute('value',resultado.remitente)

			let asunto_rta = document.getElementById("id_inp_asunto")
			asunto_rta.setAttribute('value',asunto)

			let inp_reemplazo_asunto = document.getElementById("id_asunto_r")
			inp_reemplazo_asunto.setAttribute('value',resultado.reemplazo_asunto)

			let inp_desplazamiento_rta = document.getElementById("id_desplazamiento")
			inp_desplazamiento_rta.setAttribute('value',resultado.desplazamiento)

			let fila = document.querySelector('tr[value="'+resultado.id_mensaje+'"][class="'+resultado.tipo_fila+'"]')
			let arreglo_hijos = fila.childNodes
			
			let btn_responder = document.getElementById("id_btn_responder")

			let btn_mostrar_mensaje_previo = document.getElementById("id_btn_mostrar_mensaje")				
			
			btn_mostrar_mensaje_previo.hidden = resultado.existe_msj_previo ? false : true


			if (resultado.leido == 0 && resultado.tipo_fila != "enviados") {
				
				btn_responder.hidden = false

			} else if (resultado.tipo_fila != "enviados") {
				
				btn_responder.hidden = false
				fila.setAttribute('class','leido')
				arreglo_hijos.forEach((hijo)=>{
					hijo.innerHTML!= undefined ? hijo.setAttribute('class','leido'): null	
				})

			} else {
				btn_responder.hidden = true
			}			

			let dialog = document.getElementById('dialog_mensaje')
			dialog.showModal()
		}
	}
}