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

	<script>
		//VALIDA EL CONTENIDO DE LOS CAMPOS DEL FORMULARIO
		function validar_post(titulo, categoria, imagen1, mensaje){
			if (titulo!='' && categoria!='0' && imagen1!='' && mensaje!='') //0 en categoría que es el valor nulo del option dentro de un select
			{
				return true;  //para que funcione en el form tenemos onSumbit="return nombre_funcion();"
			}
			else if (titulo == '' || mensaje == '')
			{
				$("#error4").slideDown(500);
				$("#error4").html("Rellene los campos de texto");
				return false;
			}
			else if (categoria == 0)
			{
				$("#error4").slideDown(500);
				$("#error4").html("Selecione Categoría");
				return false;
			}
		}
	</script>


	<div class="cuerpo">
		<h2>Agregar anuncio</h2>
		<form onSubmit="return validar_post(titulo.value, categoria.value, imagen1.value, mensaje.value);" name="miform" action="inc/insertar-anuncio.php" method="POST" enctype="multipart/form-data">
			Título: <br>
			<input type="text" name="titulo" value="" class="titulo_anuncio"> <br>
			Categoría: <br>
			<select name="categoria" id="categoria">
				<option value="0">Seleccionar categoría</option>
				<option value="1">HTML5</option>
				<option value="2">CSS3</option>
				<option value="3">AJAX</option>
			</select> <br><br>
			Miniatura: <br>
			<input type="file" name="imagen1" class="imagen_anuncio"> <br>
			Descripción: <br>
			<textarea name="mensaje" class="textarea_anuncio"></textarea> <br>
			<div id="error4" style="display:none"></div>
			<input type="submit" value="Continuar" class="miboton">
		</form>
	</div>

	<?php include ('inc/footer.php') ?>

	<?php if (!isset($_SESSION['iduser'])) { //para que no carge esta capa si esta logueado
		 include ('inc/capa-login.php');
	} ?>
	

</body>
</html>