<?php require_once('../conexion.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- <meta charset="iso-8859-1"> -->
	<meta charset="UTF-8">
	<title>Chat</title>
	<link rel="shortcut icon" type="img/x-icon" href="../favicon.ico" />
	<meta content='width-device-width', initial-scale=1, maximum-scale=1, name='viewport'><!-- Responsive -->
	<!-- <link rel="stylesheet" type="text/css" href="fonts.googleapis.com/css?family=Lato"> -->
	<link rel="stylesheet" href="../css/estilos.css">
	<script src="../js/jquery.min.js"></script>
	<script src="../js/efectos.js">></script>
</head>
<body>

	<?php if (!isset($_COOKIE['galleta'])) { ?>
		<div id="cookies">Este sitio web utiliza cookies <a class="cursor" onClick="crear_cookie('yes');">Aceptar</a></div>
	<?php } ?>
	

	<?php include ('../inc/header.php') ?>

	<?php include ('../inc/menu.php') ?>

	<script>
		function agregar_chat(mensaje)
		{
			$.ajax({
				type: 'POST',
				url: urlWeb + 'chat/insertar.php',
				data: 'nuevo_mensaje=' + mensaje,
				success: function(html) {
				}
			});

			$("#listar_chat").load('mensajes.php'); //para que fuerce un refresco de los mensajes
			$("#input_mensaje").val(''); //borramos el input de mensaje despues de enviarlo
			$("#listar_chat").scrollTop($("#listar_chat")[0].scrollHeight); //para que haga scroll solo y muestre siempre el último mensaje
			   
		}
	</script>

	<div class="cuerpo">
		<h1>Chat</h1>
		<div id="listar_chat">
			<?php include ('mensajes.php') ?>
		</div>
		<br>
		<form onSubmit="agregar_chat(mensajes.value); return false;"> <!-- QUe llame a la función y no se recargue -->
			<input type="text" name="mensajes" id="input_mensaje" class="chatinput"> <br>
			<input type="submit" value="Enviar">
		</form>
	</div>

	<?php include ('../inc/footer.php') ?>

	<?php if (!isset($_SESSION['iduser'])) { //para que no carge esta capa si esta logueado
		 include ('../inc/capa-login.php');
	} ?>

	<script> 
		refrescar(); // para que cada segundo recargue la página
		$("#input_mensaje").focus(); //dar el foco a este campo
		$("#listar_chat").scrollTop($("#listar_chat")[0].scrollHeight); //para que haga scroll solo y muestre siempre el último mensaje
	</script> 
	
</body>
</html>