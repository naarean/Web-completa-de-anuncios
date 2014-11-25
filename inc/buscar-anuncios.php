<?php //ESTE ARCHIVO recibe del buscador del header un texto de búsqueda

require_once('../conexion.php');


//CONSULTA BASE DATOS
mysql_select_db($database_conexion, $conexion);
$query_DatosBusqueda = sprintf("SELECT * FROM z_posts WHERE titulo LIKE %s", 
							GetSQLValueString("%" . $_POST['textoescrito'] . "%", "text"));
$DatosBusqueda = mysql_query($query_DatosBusqueda, $conexion) or die(mysql_error());
$row_DatosBusqueda = mysql_fetch_assoc($DatosBusqueda);
$totalRows_DatosBusqueda = mysql_num_rows($DatosBusqueda); 


if ($totalRows_DatosBusqueda == '') //no hay resultados
{ ?>
	<span class="resultado_busqueda">No hay resultados para la búsqueda</span>
<?php  }
else if($totalRows_DatosBusqueda !='' ) //si hay resultados
{
	do { ?>
		<a href="<?php echo $dato['0']?>ver-anuncio.php?id=<?php echo $row_DatosBusqueda['id'] ?>"><span class="resultado_busqueda"> <?php echo $row_DatosBusqueda['titulo'] ?></span></a><br>
	<?php } while ($row_DatosBusqueda = mysql_fetch_assoc($DatosBusqueda)); 
} ?>

<?php mysql_free_result($DatosBusqueda); 

?>