<?php require_once('conexion.php');?>



<!DOCTYPE html>
<html lang="es">
<head>
	<!-- <meta charset="iso-8859-1"> -->
	<meta charset="UTF-8">
	<title>Curso p&aacute;gina 2014</title>
	<meta content='width-device-width', initial-scale=1, maximum-scale=1, name='viewport'><!-- Responsive -->
	<!-- <link rel="stylesheet" type="text/css" href="fonts.googleapis.com/css?family=Lato"> -->
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/efectos.js">></script>
</head>
<body>
	<script>
		function crear_cookie(valor){
			$.ajax({
				type: 'POST',
				url: urlWeb + 'inc/cookie.php',
				data: 'valor=' + valor
			});
			$('#cookies').css("display","none"); //que oculte la capa de aceptar cookies
		}
	</script>
	<?php if (!isset($_COOKIE['galleta'])) { ?>
		<div id="cookies">Este sitio web utiliza cookies <a class="cursor" onClick="crear_cookie('yes');">Aceptar</a></div>
	<?php } ?>

	<header class="encabezado">
		<div id="logo">
			<a href="<?php echo $dato['0']?>"><img src="img/logo.png" width="220" height="80"></a>
		</div>
	</header>

	<nav class="menu">
		<a href="<?php echo $dato['0']?>"><li class="item_menu">Incio</li></a>
		<li class="item_menu">Posts</li>
		<li class="item_menu">Contacto</li>

		<?php 
			if (!isset($_SESSION['iduser'])) //que solo muestre iniciar sesion y registrarse si no ha sido iniciada
			{ ?>
				<a onClick="mostrar_capa_login(1);" class="cursor"><li class="item_menu_login">Inciar sesi&oacute;n</li></a>
				<li class="item_menu_login">Registrarse</li>
		<?php } else {?> <!-- si esta logueado que muestre su usuario y haya opcion de desloguearse-->
			<li class="item_menu_login"><?php echo $_SESSION['nombreuser'] ?></li>
			<a href="inc/cerrar-sesion.php?cerrar=yes"><li class="item_menu_login">X</li></a>
		<?php } ?>

	</nav>

	<div class="cuerpo">
		
	</div>

	<footer class="pie">
		Conctacto - Creado por Sergio Alegre
	</footer>
	<script>

	</script>
	<div id="capa_login" style="display:none">
		<div id="flotantelogin">
			<a onClick="mostrar_capa_login(2);" class="cursor"><span class="derecha">X</span></a>
			<form onSubmit="return false" id="formularioLogin">  <!-- para que no recarge la página al ser ajax necesitamos  onSubmi="return false" -->
				Usuario: <br>
				<input type="text" name="user" id="user"> <br>
				Contraseseña: <br>
				<input type="password" name="pass" id="pass"> <br>
				<input type="submit" id="miboton" class="cursor" onClick="login_ajax(user.value,pass.value);" value="Iniciar">
			</form>
		</div>
		<div id="fondonegro"></div>
	</div>
</body>
</html>