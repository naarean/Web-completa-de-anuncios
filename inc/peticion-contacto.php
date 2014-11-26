<?php //ESTE ARCHIVO recibe serializado los datos del formulario contacto.php

require_once('../conexion.php');

$nombre = $_POST['nombre'];  //recogemos los datos traidos por POST
$emails = $_POST['emails'];
$mensajes = $_POST['mensajes'];

$para      = $dato['2'];  //dato[2] lo obtenemos de inc/funciones.php, es el email del administrador
$titulo    = 'Correo de mi pagina web';
$mensaje   = $mensajes;
$cabeceras = 'From: nocontestar@example.com' . "\r\n" .
	'Reply-To: '.$emails . "\r\n" .
	'X-Mailer: PHP/' . phpversion();


mail($para, $titulo, $mensaje, $cabeceras); //enviar el email en si. No funciona en localhost



?>