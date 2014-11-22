<?php require_once('conexion.php');

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
	<title><?php echo $dato['1']?></title> <!-- variable global declarada en funciones.php -->
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


	<div class="cuerpo">
		<h2>Agregar anuncio</h2>
		<form name="miform" action="inc/insertar-anuncio.php" method="POST" enctype="multipart/form-data">
			Título: <br>
			<input type="text" name="titulo" value="" class="titulo_anuncio"> <br>
			Imágen: <br>
			<input type="file" name="imagen1" class="imagen_anuncio"> <br>
			Descripción: <br>
			<textarea name="mensaje" class="textarea_anuncio"></textarea> <br>
			<input type="submit" value="Publicar" class="miboton">
		</form>
	</div>

	<?php include ('inc/footer.php') ?>

	<?php if (!isset($_SESSION['iduser'])) { //para que no carge esta capa si esta logueado
		 include ('inc/capa-login.php');
	} ?>
	

</body>
</html>