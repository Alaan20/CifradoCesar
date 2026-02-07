import {cifrar} from './cifrado_cesar.js'
	
document.addEventListener('DOMContentLoaded', function() {

	let btn_enviar = document.getElementById("id_btn_enviar")
	btn_enviar.addEventListener('click',() => {
	
		//obtengo el label e input de la pagina, el label para mostrarle al usuario y el input para usarlo en $_get
		let lbl_asunto_cif = document.getElementById("id_lbl_asunto_cif")
		let inp_asunto_cif = document.getElementById("id_inp_asunto_cif")
		

		//obtengo el label e input de la pagina, el label para mostrarle al usuario y el input para usarlo en $_get
		let inp_mensaje_cif = document.getElementById("id_inp_mensaje_cif")
		let lbl_mensaje_cif = document.getElementById("id_lbl_mensaje_cif")

		//obtengo el destinatario y lo escribo en el input ubicado dentro del form para usarlo en $_get
		let destinatario = document.getElementById("id_h_destinatario")
		let obj_destinatario_obt = document.getElementById("select_usuario")
		

		//lo mismo que hice con el destinatario, pero ahora lo hago con el desplazamiento
		let obj_desplazamiento = document.getElementById("select_desplazamiento")
		let desplazamiento_obt = parseInt(obj_desplazamiento.value)
		let span_des = document.getElementById("id_h_des")

		//asunto y mensaje sin encriptar, escritos por el usuario
		let obj_asunto_original = document.getElementById("inp_texto_asunto")
		let asunto_original = obj_asunto_original.value
		let asunto_sin_espacios = asunto_original.replace(/\s+/g, '')

		let mensaje_original = document.getElementById("inp_texto_mensaje")
		let cont_mensaje_original = mensaje_original.innerText
		let mensaje_sin_espacios = cont_mensaje_original.replace(/\s+/g, '')
		
		if (asunto_sin_espacios.length < 4) {
			alert("el minimo de caracteres en el asunto es 4")
			obj_asunto_original.focus()
		} else if (mensaje_sin_espacios.length < 4) {
			alert("el minimo de caracteres en el mensaje es 4")
			mensaje_original.focus()
		} else if (obj_destinatario_obt.value == 'ninguno') {
			alert("No seleccionaste ningun destinatario")
			obj_destinatario_obt.focus()
		} else if (obj_desplazamiento.value == 0) {
			alert("No seleccionaste ningun desplazamiento")
			obj_desplazamiento.focus()
		}
		
		if (asunto_sin_espacios.length>=4 && mensaje_sin_espacios.length>=4 &&
		 obj_desplazamiento.value != 0 && obj_destinatario_obt.value != 'ninguno') {
	
			if (cont_mensaje_original.length>400) {
				cont_mensaje_original = cont_mensaje_original.slice(0,400)
			}		
		
			destinatario.setAttribute('value',obj_destinatario_obt.value)
			span_des.setAttribute('value',desplazamiento_obt)
			
			//obtengo un arreglo cuyos indices son: 0 y 1. el 0 contiene la cadena cifrada, y el 1 contiene las 
			//posiciones con el correspondiente reemplazo
			let arreglo_asunto_cif = cifrar(asunto_original, desplazamiento_obt)
			let arreglo_mensaje_cif = cifrar(cont_mensaje_original, desplazamiento_obt)

			
			let reemplazos_del_asunto_enc = document.getElementById("id_asunto_h")
			let reemplazos_del_mensaje_enc = document.getElementById("id_h_mensaje")


			reemplazos_del_asunto_enc.setAttribute('value',arreglo_asunto_cif[1])
			inp_asunto_cif.setAttribute('value',arreglo_asunto_cif[0]) 
			lbl_asunto_cif.innerHTML = arreglo_asunto_cif[0]
			

			reemplazos_del_mensaje_enc.setAttribute('value',arreglo_mensaje_cif[1])
			inp_mensaje_cif.setAttribute('value',arreglo_mensaje_cif[0])
			lbl_mensaje_cif.innerHTML = arreglo_mensaje_cif[0]
			

			let dialog = document.getElementById("dialog_rta")
			dialog.showModal()
		}
		
	})
	

	let btn_cerrar = document.getElementById("id_btn_cerrar")
	btn_cerrar.addEventListener('click', () => {
		let dialog = document.getElementById("dialog_rta")
		dialog.close()
	})

	let div_mensaje = document.getElementById("inp_texto_mensaje")
	div_mensaje.addEventListener('keypress', (e) => {
		let div_actual = e.target

		if (div_actual.innerText.length >= 400) {
			e.preventDefault()
			alert("Ya llegaste al limite de caracteres!")
		}
	})

})