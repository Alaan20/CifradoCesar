import {cifrar_todo} from './cifrado_cesar.js'
	
document.addEventListener('DOMContentLoaded', function() {

	let btn_enviar = document.getElementById("id_btn_enviar")
	btn_enviar.addEventListener('click',()=>{
		cifrar_todo()
	})

	let btn_cerrar = document.getElementById("id_btn_cerrar")
	btn_cerrar.addEventListener('click', () => {
		let dialog = document.getElementById("dialog_rta")
		dialog.close()
	})

	let formulario = document.getElementById("formulario_enviar_mensaje")
	formulario.preventDefault
})