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
