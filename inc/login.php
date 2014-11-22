<?php //ESTE ARCHIVO RECIBE DE PARAMETROS EL USUARIO Y LA CONTRASEÑA Y HA DE VER SI ESTAN EN LA BBDD, si lo estan crea dos variables de sesión

require_once('../conexion.php');  



//CONSULTA BASE DATOS
    mysql_select_db($database_conexion, $conexion);
    $query_DatosLogin = sprintf("SELECT * FROM z_users WHERE user=%s AND password=%s",
    									GetSQLValueString($_POST['user'], "text"),
    									GetSQLValueString(md5($_POST['pass']), "text")); //contraseña está en MD5
    $DatosLogin = mysql_query($query_DatosLogin, $conexion) or die(mysql_error());
    $row_DatosLogin = mysql_fetch_assoc($DatosLogin);
    $totalRows_DatosLogin = mysql_num_rows($DatosLogin);



    if($totalRows_DatosLogin==1) //si existe el usuarui le creamos dos variables de sesión
    {
    	$_SESSION['iduser'] = $row_DatosLogin['id'];
    	$_SESSION['nombreuser'] = $row_DatosLogin['user'];
    }
    else
    {
        echo "DATOS DE ACCESO INCORRECTOS";
    }
    
    mysql_free_result($DatosLogin);



?>