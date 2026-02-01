# CifradoCesar
En este repositorio se guarda mi trabajo para el final de una materia llamada "Laboratorio de Programación y Lenguajes", la cual tiene como objetivo implementar un sistema en el cual los usuarios pueden: <br>
  
  --> Registrarse. <br>
  --> Enviar y recibir mensajes. <br>
  --> Responder algún mensaje recibido. <br>
  --> Cifrar el asunto y contenido del mensaje mediante "Cifrado Cesar". <br>
  --> Disponer de un mensaje de bienvenida que les indica la última fecha de acceso y la cantidad de mensajes recibidos desde la última vez. <br>

Al momento de redactar un mensaje, se le solicita ingresar el Asunto y Contenido del mensaje, también debe seleccionar el desplazamiento y el destinatario del mensaje (para este se muestra un listado de los nombres de usuarios registrados). En el caso de responder un mensaje, solo se le pide ingresar el contenido del mensaje. En ambos casos se muestr una vista previa del mensaje cifrado y una confirmación para guardarlo finalmente en la base de datos. 

El cifrado de los mensajes se hace del lado del cliente. Posteriormente, al iniciar sesión, los mensajes se recuperan cifrados y se descifran del lado del cliente al momento de seleccionar algún mensaje del listado.

En caso de que el usuario esté viendo una respuesta a un mensaje suyo, el sistema le da la opción de "Ver el Mensaje Anterior", como para refrescar el hilo de la conversación.
