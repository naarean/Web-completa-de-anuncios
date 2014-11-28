<?php //ESTE ARCHIVO recibe por GET el idpost de fotos.php, sube las imágen e inserta un registr en la bbdd
// y devuelve al function subir_fotos_ajax un html con las imágenes

require_once('../conexion.php');  


if ($_FILES['imagen2']['type'] == "image/png" || $_FILES['imagen2']['type'] == "image/jpg" || $_FILES['imagen2']['type'] == "image/jpeg")
{
	//Subir imagen
	$nombre_imagen = $_FILES['imagen2']['name'];
	    move_uploaded_file($_FILES['imagen2']['tmp_name'], "../img/upload/".$nombre_imagen);
}
else
{
	$nombre_imagen =''; //para que no de error si no metemos foto ya que necesitamos un valor para el insert aunque sea null
}


//Insertar foto en bbdd
$insertSQL = sprintf("INSERT INTO z_fotos (nombre, idpost) VALUES (%s, %s)",
                       GetSQLValueString($nombre_imagen, "text"),
					   GetSQLValueString($_SESSION['idpost'], "int")); //se le habiamos pasado por variable de sesion que es mas seguro

mysql_select_db($database_conexion, $conexion);
$Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());


//CONSULTA BASE DATOS
mysql_select_db($database_conexion, $conexion);
$query_DatosImagen = sprintf("SELECT * FROM z_fotos WHERE idpost = %s", 
								$_SESSION['idpost'], "int");
$DatosImagen = mysql_query($query_DatosImagen, $conexion) or die(mysql_error());
$row_DatosImagen = mysql_fetch_assoc($DatosImagen);
$totalRows_DatosImagen = mysql_num_rows($DatosImagen);


?>

<?php do { ?>
	<img src="<?php echo $dato['0']?>/img/upload/<?php echo $row_DatosImagen['nombre']?>" width="100" height="100">
<?php } while ($row_DatosImagen = mysql_fetch_assoc($DatosImagen)); ?>

<?php mysql_free_result($DatosImagen);?>