<?php require_once('conexion.php');?>



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
		
	</div>

	<?php include ('inc/footer.php') ?>

	<?php include ('inc/capa-login.php') ?>

</body>
</html>