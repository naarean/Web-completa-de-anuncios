<?php //ESTE ARCHIVO RECIBE DE PARAMETROS EL USUARIO Y LA CONTRASEÑA Y HA DE VER SI ESTAN EN LA BBDD

require_once('../conexion.php');  



//CONSULTA BASE DATOS
    mysql_select_db($database_conexion, $conexion);
    $query_DatosWeb = sprintf("SELECT * FROM z_users WHERE user=%s AND password=%s",
    									GetSQLValueString($_POST['user'], "text"),
    									GetSQLValueString($_POST['pass'], "text"));
    $DatosWeb = mysql_query($query_DatosWeb, $conexion) or die(mysql_error());
    $row_DatosWeb = mysql_fetch_assoc($DatosWeb);
    $totalRows_DatosWeb = mysql_num_rows($DatosWeb);



    if($totalRows_DatosWeb==1) //si existe el usuarui le creamos dos variables de sesión
    {
    	$_SESSION['iduser'] = $row_DatosWeb['id'];
    	$_SESSION['nombreuser'] = $row_DatosWeb['user'];
    }
    
    mysql_free_result($DatosWeb);



?>