<?php //ESTE ARCHIVO lista en index.php los anuncios que haya en bbdd

//como es include del index no necesita la referencia a conexion.php

//CONSULTA BASE DATOS
    mysql_select_db($database_conexion, $conexion);
    $query_DatosAnuncios = "SELECT * FROM z_posts ORDER BY id DESC";
    $DatosAnuncios = mysql_query($query_DatosAnuncios, $conexion) or die(mysql_error());
    $row_DatosAnuncios = mysql_fetch_assoc($DatosAnuncios);
    $totalRows_DatosAnuncios = mysql_num_rows($DatosAnuncios);

?>


<?php do { ?>
	<div id="listado_anuncios"> 
		<?php if($row_DatosAnuncios['imagen'] != '') { ?> <!-- si hay alguna imagen que la muestre -->
			<img src="<?php echo $dato['0']?>img/upload/<?php echo $row_DatosAnuncios['imagen'] ?>" width="150" height="100" class="foto_miniatura_anuncio">
		<?php } ?>
		<h3><?php echo $row_DatosAnuncios['titulo'] ?></h3>
		<span><?php echo $row_DatosAnuncios['mensaje'] ?></span> <br>
		<?php echo $row_DatosAnuncios['autor'] ?>
	</div>
<?php } while($row_DatosAnuncios = mysql_fetch_assoc($DatosAnuncios)) ?>

<?php mysql_free_result($DatosAnuncios); ?>