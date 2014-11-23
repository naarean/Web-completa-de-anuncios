<?php //ESTE ARCHIVO recoge los datos de registro-usuario.php y les inserta en base de datos

require_once('../conexion.php');  


//Antes de insertar comprobamos que no exista
//CONSULTA BASE DATOS
mysql_select_db($database_conexion, $conexion);
$query_DatosRegistro = sprintf("SELECT * FROM z_users WHERE user = %s",
						GetSQLValueString($_POST['user'], "text"));

$DatosRegistro = mysql_query($query_DatosRegistro, $conexion) or die(mysql_error());
$row_DatosRegistro = mysql_fetch_assoc($DatosRegistro);
$totalRows_DatosRegistro = mysql_num_rows($DatosRegistro);

if($totalRows_DatosRegistro == 0) //no existe nadie llamado asi, entonces lo creamos
{
	//Insertar usuario
	$insertSQL = sprintf("INSERT INTO z_users (user, password) VALUES (%s, %s)",
	                       GetSQLValueString($_POST['user'], "text"),
	                       GetSQLValueString(md5($_POST['pass']), "text")); //hay que meterlas en MD5

	mysql_select_db($database_conexion, $conexion);
	$Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
	echo 'correcto';  //devolvemos error al ajax para que sepa que todo ha ido bien
}
else
{
	echo 'error'; //devolvemos error al ajax para que sepa que algo ha ido mal
}




mysql_free_result($DatosRegistro);


?>