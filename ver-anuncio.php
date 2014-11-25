<?php //ESTE ARCHIVO RECIBE POR GET EL ID DE ANUNCIO A VISUALIZAR

require_once('conexion.php');

$idpost = $_GET['id'];  //recogemos el parametro que recibe esta página

//CONSULTA BASE DATOS
mysql_select_db($database_conexion, $conexion);
$query_DatosAnuncio = "SELECT * FROM z_posts WHERE id='$idpost'";
$DatosAnuncio = mysql_query($query_DatosAnuncio, $conexion) or die(mysql_error());
$row_DatosAnuncio = mysql_fetch_assoc($DatosAnuncio);
$totalRows_DatosAnuncio = mysql_num_rows($DatosAnuncio);


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- <meta charset="iso-8859-1"> -->
	<meta charset="UTF-8">
	<title><?php echo $row_DatosAnuncio['titulo']?></title>
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
		<h1><?php echo $row_DatosAnuncio['titulo']?></h1>
		<?php echo $row_DatosAnuncio['mensaje']?> <br>
		<?php echo nombre($row_DatosAnuncio['autor'])?>
	</div>

	<?php include ('inc/footer.php') ?>

	<?php if (!isset($_SESSION['iduser'])) { //para que no carge esta capa si esta logueado
		 include ('inc/capa-login.php');
	} ?>
	
</body>
</html>

<?php mysql_free_result($DatosAnuncio);  ?>