<?php //ESTE ARCHIVO recibe del buscador del header un texto de búsqueda

require_once('../conexion.php');


//CONSULTA BASE DATOS
mysql_select_db($database_conexion, $conexion);
$query_DatosAnuncios = sprintf("SELECT * FROM z_posts WHERE titulo LIKE %s", 
							GetSQLValueString("%" . $_POST['textoescrito'] . "%", "text"));
$DatosAnuncios = mysql_query($query_DatosAnuncios, $conexion) or die(mysql_error());
$row_DatosAnuncios = mysql_fetch_assoc($DatosAnuncios);
$totalRows_DatosAnuncios = mysql_num_rows($DatosAnuncios); 


if ($totalRows_DatosAnuncios == '') //no hay resultados
{ ?>
	<span class="resultado_busqueda">No hay resultados para la búsqueda</span>
<?php  }
else if($totalRows_DatosAnuncios !='' ) //si hay resultados
{
	do { ?>
		<a href="<?php echo $dato['0']?>ver-anuncio.php?id=<?php echo $row_DatosAnuncios['id'] ?>"><span class="resultado_busqueda"> <?php echo $row_DatosAnuncios['titulo'] ?></span></a><br>
	<?php } while ($row_DatosAnuncios = mysql_fetch_assoc($DatosAnuncios)); 
} ?>

<?php mysql_free_result($DatosAnuncios); 

?>