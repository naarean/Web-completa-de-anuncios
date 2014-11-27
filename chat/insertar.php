<?php require_once('../conexion.php');  //insertamos en la bbdd


//Insertar mensaje de chat
$insertSQL = sprintf("INSERT INTO z_chat (user, mensaje) VALUES (%s, %s)",
                       GetSQLValueString($_SESSION['iduser'], "int"),
                       GetSQLValueString($_POST['nuevo_mensaje'], "text")); 

mysql_select_db($database_conexion, $conexion);
$Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());


?>