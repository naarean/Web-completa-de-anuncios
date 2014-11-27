<?php //ESTE ARCHIVO recibe por POST el numero de anuncios a paginar, y usa la variable de sesion de conteo para hacer una consulta a la bbdd y saber que anuncios mostrar

require_once('../conexion.php');

$_SESSION['conteo'] += $_POST['numero']; //cambiamos el índice al paginar y le incrementamos en el valor que llega por el ajax de paginar_anuncios()

//CONSULTA BASE DATOS
	mysql_select_db($database_conexion, $conexion);
	$query_DatosAnuncios = sprintf("SELECT * FROM z_posts ORDER BY id DESC LIMIT %s,2", $_SESSION['conteo'], "int");  //cuando el limit lleva dos parametros el primero es el indice de inicio y el segundo el número de elementos
	$DatosAnuncios = mysql_query($query_DatosAnuncios, $conexion) or die(mysql_error());
	$row_DatosAnuncios = mysql_fetch_assoc($DatosAnuncios);
	$totalRows_DatosAnuncios = mysql_num_rows($DatosAnuncios);


if($totalRows_DatosAnuncios != 0)  //si hay algun anuncio les mostramos
{
 do { ?>
	<div id="listado_anuncios"> 
		<?php if($row_DatosAnuncios['imagen'] != '') { ?> <!-- si hay alguna imagen que la muestre -->
			<img src="<?php echo $dato['0']?>img/upload/<?php echo $row_DatosAnuncios['imagen'] ?>" width="150" height="100" class="foto_miniatura_anuncio">
		<?php } ?>
		<a href="<?php echo $dato['0']?>ver-anuncio.php?id=<?php echo $row_DatosAnuncios['id'] ?>"><h3><?php echo $row_DatosAnuncios['id'] ?> <?php echo $row_DatosAnuncios['titulo']?></h3></a>
		<span><?php $cortar=substr($row_DatosAnuncios['mensaje'], 0, 350)."..."; echo $cortar; ?></span> <br> <!--substr acorta un texto largo, en este caso muestra del caracter 0 al 350 y concatena ... -->
		<?php echo nombre($row_DatosAnuncios['autor']) ?>
	</div>
<?php } while($row_DatosAnuncios = mysql_fetch_assoc($DatosAnuncios));
}


mysql_free_result($DatosAnuncios); 

?>