export function cifrar (cadena_original, desplazamiento) {
	
	let cadena_resultante = ''
	let cadena_minimizada = ''

	const excepciones= {};
	for (let i=0; i<cadena_original.length; i++){
		if (cadena_original[i].match(/[áéíóúñÁÉÍÓÚÑ]/) ) {
			excepciones[i] = cadena_original[i]
		}
	}
	
	cadena_minimizada = cadena_original.toLowerCase()
	let cadena_normalizada = cadena_minimizada.normalize('NFD').replace(/[\u0300-\u036f]/g,'')
	
	for (var i = 0; i <= cadena_original.length-1; i++) {

		let codigo_letra_actual = cadena_normalizada.charCodeAt(i)  //valor ASCII de la letra actual	
		let cod_a_min = 97 //valor ascii de 'a' minuscula
		let limite = cod_a_min + 25  //valor ascii de 'z' minuscula
		let indice = parseInt(codigo_letra_actual) + parseInt(desplazamiento)

		if (codigo_letra_actual >= cod_a_min && codigo_letra_actual <=  limite ) {
			indice = indice>limite ? indice-26: indice
			
			if (cadena_original[i] != cadena_minimizada[i]) { 
			//compara la cadena original con la cadena en minusculas, si son distintas, 
			//quiere decir que la original está en mayusculas
				cadena_resultante += String.fromCharCode(indice).toUpperCase()
				continue
			}

			cadena_resultante += String.fromCharCode(indice) //obtiene la letra segun el codigo ASCII dado (indice)

		} else if (codigo_letra_actual >= 48 && codigo_letra_actual <= 57 ) { // se encuentra en el rango de los numeros 0 a 9
			
			cadena_resultante += indice>57 ? String.fromCharCode(indice-10) : String.fromCharCode(indice)
			
		} else {
			cadena_resultante += cadena_normalizada[i]
		}
	}
	
	let arreglo_cifrado = [cadena_resultante,JSON.stringify(excepciones)]
	return arreglo_cifrado
}


export function cifrar_todo() {
	//obtengo el label e input de la pagina, el label para mostrarle al usuario y el input para usarlo en $_get
	let lbl_asunto_cif = document.getElementById("id_lbl_asunto_cif")
	let inp_asunto_cif = document.getElementById("id_inp_asunto_cif")
	

	//obtengo el label e input de la pagina, el label para mostrarle al usuario y el input para usarlo en $_get
	let inp_mensaje_cif = document.getElementById("id_inp_mensaje_cif")
	let lbl_mensaje_cif = document.getElementById("id_lbl_mensaje_cif")

	//obtengo el destinatario y lo escribo en el input ubicado dentro del form para usarlo en $_get
	let destinatario = document.getElementById("id_h_destinatario")
	let dest_seleccionado = document.getElementById("select_usuario").value
	destinatario.setAttribute('value',dest_seleccionado)

	//lo mismo que hice con el destinatario, pero ahora lo hago con el desplazamiento
	let desplazamiento_obt = parseInt(document.getElementById("select_desplazamiento").value)
	let span_des = document.getElementById("id_h_des")
	span_des.setAttribute('value',desplazamiento_obt)

	//asunto y mensaje sin encriptar, escritos por el usuario
	let asunto_original = document.getElementById("inp_texto_asunto").value	
	let mensaje_original = document.getElementById("inp_texto_mensaje").value

	//obtengo un arreglo cuyos indices son: 0 y 1. el 0 contiene la cadena cifrada, y el 1 contiene las 
	//posiciones con el correspondiente reemplazo
	let arreglo_asunto_cif = cifrar(asunto_original, desplazamiento_obt)
	let arreglo_mensaje_cif = cifrar(mensaje_original, desplazamiento_obt)

	
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


export function descifrar (cadena, reemplazos, desplazamiento){
	
	let texto_resultante = ''
	let cadena_minimizada = ''
	let cadena_normalizada = cadena.normalize('NFD').replace(/[-]/g,'')
	for (var i=0; i<=cadena.length-1; i++) {
		cadena_minimizada = cadena_normalizada.toLowerCase()
		let codigo_letra_actual = cadena_minimizada.charCodeAt(i)
		let limite = 97 + 25
		let indice = parseInt(codigo_letra_actual) - parseInt(desplazamiento)

		if (codigo_letra_actual>=97 && codigo_letra_actual<=limite) {

			indice = indice < 97 ? indice += 26 : indice
			
			let letra = String.fromCharCode(indice)
			
			letra = (cadena_minimizada[i] != cadena[i]) ? letra.toUpperCase() : letra
			texto_resultante += letra

		} else if (codigo_letra_actual>=48 && codigo_letra_actual<=57) {

			indice += indice < 48 ? 10 : 0

			texto_resultante += String.fromCharCode(indice)

		} else {
			texto_resultante += cadena[i]
		}
	}
	
	const caracteres = texto_resultante.split('') 
	
	Object.entries(reemplazos).forEach(([index,char]) => {
		if (Number(index)<caracteres.length) {
			caracteres[Number(index)] = char
		}
	})

	return caracteres.join('')
}
