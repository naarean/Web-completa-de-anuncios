<?php require_once('conexion.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- <meta charset="iso-8859-1"> -->
	<meta charset="UTF-8">
	<title>Registro Usuarios</title> <!-- variable global declarada en funciones.php -->
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
		<h2>Registro de usuarios</h2>
		<div id="registro_usuario"> <!-- usamos esta capa para mostrar formulario antes de envialo o mostrar registro correcto al acabar -->
			<form onSubmit="return false" name="formRegistro">
				Nombre: <br>
				<input type="text" name="nombre_registro" value="" class="mi_input"> <br>
				Contraseña: <br>
				<input type="password" name="pass_registro" value="" class="mi_input"> <br>
				Repetir Contraseña: <br>
				<input type="password" name="pass_registro2" value="" class="mi_input"> <br>
				<input type="submit" value="Registro" onClick="registro_ajax(nombre_registro.value, pass_registro.value, pass_registro2.value);">
				<div id="error" style="display:none"></div>
			</form>
		</div>
	</div>

	<?php include ('inc/footer.php') ?>

	<?php if (!isset($_SESSION['iduser'])) { //para que no carge esta capa si esta logueado
		 include ('inc/capa-login.php');
	} ?>
	

</body>
</html>