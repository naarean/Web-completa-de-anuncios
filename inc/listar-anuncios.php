<?php //ESTE ARCHIVO lista en index.php los anuncios que haya en bbdd

//como es include del index no necesita la referencia a conexion.php

//CONSULTA BASE DATOS
	mysql_select_db($database_conexion, $conexion);
	$query_DatosAnuncios = "SELECT * FROM z_posts ORDER BY id DESC";
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
		<h3><?php echo $row_DatosAnuncios['titulo'] ?></h3>
		<span><?php $cortar=substr($row_DatosAnuncios['mensaje'], 0, 350)."..."; echo $cortar; ?></span> <br> <!--substr acorta un texto largo, en este caso muestra del caracter 0 al 350 y concatena ... -->
		<?php echo nombre($row_DatosAnuncios['autor']) ?>
	</div>
<?php } while($row_DatosAnuncios = mysql_fetch_assoc($DatosAnuncios));
}
else 
{
	echo 'No hay anuncios en la base de datos';
}


mysql_free_result($DatosAnuncios); 

?>