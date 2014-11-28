<?php require_once('conexion.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- <meta charset="iso-8859-1"> -->
	<meta charset="UTF-8">
	<title>Contacto</title>
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
		<h1>Contacto</h1>
		<div id="respuesta">
			<form onSubmit="return false" name="formContacto">
				Nombre: <br>
				<!-- Si ya esta logueado, sacamos el nombre por variable de sesión -->
			<?php	if (isset($_SESSION['iduser']))
					{ ?>
						<input type="text" name="nombre_registro" value="<?php echo nombre($_SESSION['iduser'])?>" disabled class="mi_input"> <br> <!-- con el disabled no permitimos cambiar el valor -->
			<?php	}
					else
					{ ?>
						<input type="text" name="nombre_registro" value="" class="mi_input"> <br>
			<?php	} ?>

				Email: <br>
				<input type="email" name="emails" value="" class="mi_input"> <br>
				Mensaje: <br>
				<textarea name="mensajes" class="textarea_anuncio"></textarea> <br><br>
				<span class="captcha" id="numero1"><?php echo rand(999,9999) ?></span> <br>
				<input placeholder="Introduce el número" type="text" name="numero2" class="mi_input" id="numero2" value=""> <br><br>
				<div id="error_contacto" style="display:none"></div>
				<input type="submit" value="Enviar" onClick="contacto_ajax(emails.value, numero2.value);"> <!-- Solo paso el email xq necesito comprobarlo, el resto de campos no pongo porque van a ser serializarlo -->
			</form>
		</div>
	</div>

	<?php include ('inc/footer.php') ?>

	<?php if (!isset($_SESSION['iduser'])) { //para que no carge esta capa si esta logueado
		 include ('inc/capa-login.php');
	} ?>
	

</body>
</html>