<?php require_once('conexion.php'); //esta p´gina procesara las fotos del id de anuncio que le llega por get de insertar-anuncio.php

if (!isset($_SESSION['iduser'])) //si no has iniciado sesión no puedes acceder a agregar.php asi que te envio a index.php
{
	header('Location:'.$dato['0']);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- <meta charset="iso-8859-1"> -->
	<meta charset="UTF-8">
	<title>Agregar imágenes</title> <!-- variable global declarada en funciones.php -->
	<link rel="shortcut icon" type="img/x-icon" href="favicon.ico" />
	<meta content='width-device-width', initial-scale=1, maximum-scale=1, name='viewport'><!-- Responsive -->
	<!-- <link rel="stylesheet" type="text/css" href="fonts.googleapis.com/css?family=Lato"> -->
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/efectos.js">></script>
</head>
<body>

	<?php if (!isset($_COOKIE['galleta'])) { ?>
		<div id="cookies">Este sitio web utiliza cookies <a class="cursor" onClick="crear_cookie('yes');">Aceptar</a></div>
	<?php } ?>
	

	<?php include ('inc/header.php') ?>

	<?php include ('inc/menu.php') ?>
 
 	<script>
 		function subir_fotos_ajax (){
 			var formData = new FormData($("#formFotos")[0]); //no se puede cambiar el nombre a esta variable o no funcionará
 			
 			$.ajax({
				type: 'POST',
				url: urlWeb + 'inc/subir-fotos.php',
				data: formData,
				contentType: false,
				processData: false,
				success: function(respuesta) {
					$("#imagenes_subidas").html(respuesta);
			   }
			});
 		}

 		function terminar_publicacion_anuncio(){
 			location.href = urlWeb + 'anuncio-publicado-ok.php';
 		}
 	</script>

	<div class="cuerpo">
		<h2>Agregar imágenes</h2>
		<div id="imagenes_subidas"></div>
		<form onSubmit="return false" method="POST" enctype="multipart/form-data" id="formFotos">
			<input type="file" name="imagen2" onChange="subir_fotos_ajax();">
			<br><br>
			<input type="submit" value="Publicar" onClick="terminar_publicacion_anuncio();">
		</form>
	</div>

	<?php include ('inc/footer.php') ?>

	<?php if (!isset($_SESSION['iduser'])) { //para que no carge esta capa si esta logueado
		 include ('inc/capa-login.php');
	} ?>
	

</body>
</html>