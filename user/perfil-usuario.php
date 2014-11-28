<?php require_once('../conexion.php');

//CONSULTA BASE DATOS
mysql_select_db($database_conexion, $conexion);
$query_DatosUsuario = sprintf("SELECT * FROM z_users WHERE id=%s", $_SESSION['iduser'], "int");
$DatosUsuario = mysql_query($query_DatosUsuario, $conexion) or die(mysql_error());
$row_DatosUsuario = mysql_fetch_assoc($DatosUsuario);
$totalRows_DatosUsuario = mysql_num_rows($DatosUsuario);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- <meta charset="iso-8859-1"> -->
	<meta charset="UTF-8">
	<title>Perfil de <?php echo nombre($_SESSION['iduser'])?></title>
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
		function cambiar_avatar(){
			window.open('avatar.php',"remote", "width=350, height=230, scrollbars=NO"); //abre ventana emergente con un php
		}
	</script>

	<div class="cuerpo">
		<h1>Perfil de <?php echo $row_DatosUsuario['user']?></h1>
		<img id="img_avatar" src="avatar/<?php echo $row_DatosUsuario['avatar']?>" width="80" height="80" class="avatares">
		<br>
		<a onClick="cambiar_avatar();">Cambiar Avatar</a>
	</div>

	<?php include ('../inc/footer.php') ?>

	<?php if (!isset($_SESSION['iduser'])) { //para que no carge esta capa si esta logueado
		 include ('../inc/capa-login.php');
	} ?>
	
</body>
</html>

<?php mysql_free_result($DatosUsuario) ?>