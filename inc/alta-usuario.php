<?php //ESTE ARCHIVO recoge los datos de registro-usuario.php y les inserta en base de datos

require_once('../conexion.php');  

//Insertar usuario
$insertSQL = sprintf("INSERT INTO z_users (user, password) VALUES (%s, %s)",
                       GetSQLValueString($_POST['user'], "text"),
                       GetSQLValueString(md5($_POST['pass']), "text")); //hay que meterlas en MD5

mysql_select_db($database_conexion, $conexion);
$Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());


?>