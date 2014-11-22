<?php
//FORMATEO BASE DE DATOS
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
      if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
      }
    
      $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
    
      switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;    
        case "long":
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "double":
          $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
          break;
        case "date":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "defined":
          $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
          break;
      }
      return $theValue;
    }
}

//FORMATO DE CARACTERES
    header('Content-Type: text/html; charset=iso-8859-1'); 

//CONSULTA BASE DATOS
    mysql_select_db($database_conexion, $conexion);
    $query_DatosWeb = "SELECT * FROM tabla WHERE columna";
    $DatosWeb = mysql_query($query_DatosWeb, $conexion) or die(mysql_error());
    $row_DatosWeb = mysql_fetch_assoc($DatosWeb);
    $totalRows_DatosWeb = mysql_num_rows($DatosWeb);
    
    mysql_free_result($DatosWeb);

//ACTUALIZACION BASE DATOS
     $updateSQL = sprintf("UPDATE tabla SET columna",
                       GetSQLValueString($idautor, "int"));
     mysql_select_db($database_conexion, $conexion);
     $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
     
//BORRADO BASE DATOS
    $deleteSQL = sprintf("DELETE FROM tabla WHERE columna",
                               GetSQLValueString($limite, "int"));
        
    mysql_select_db($database_conexion, $conexion);
    $Result1 = mysql_query($deleteSQL, $conexion) or die(mysql_error());
    
//CERRAR SESION
if ((isset($_GET['cerrar'])) &&($_GET['cerrar']=="yes")){
      //to fully log out a visitor we need to clear the session varialbles
      $_SESSION['iduser'] = NULL;
      $_SESSION['nombreuser'] = NULL;
      unset($_SESSION['iduser']);
      unset($_SESSION['nombreuser']);
    
        
      $logoutGoTo = $dato['0'];
      
       header("Location: $logoutGoTo");
       exit;
  
}

//CONEXION BASE DATOS
    require_once('');
    
    $hostname_conexion = "localhost";
    $database_conexion = "DB";
    $username_conexion = "root";
    $password_conexion = "";
    $conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
    
//SESSIONES
if (!isset($_SESSION)) {
  session_start();
}


//setear cookie 1 mes
setcookie("galleta", $_POST['aceptar'], time() + (30 * 24 * 60 * 60),"/"); 


//Insertar registro
$insertSQL = sprintf("INSERT INTO tabla (colum1, colum2) VALUES (%s, %s)",
                       GetSQLValueString($_SESSION['nombreuser'], "text"),
                       GetSQLValueString($_POST['mensajes'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

//Subir imagen
$nombre_imagen = rand().$_FILES['imagen1']['name'];
    move_uploaded_file($_FILES['imagen1']['tmp_name'], "../directorio/".$nombre_imagen);

//Función php
function datos ($id)
{

    global $database_conexion, $conexion;
    //Codigo
}

//Buscador
    mysql_select_db($database_conexion, $conexion);
    $query_SacarPost = sprintf("SELECT * FROM z_posts WHERE titulo LIKE %s", GetSQLValueString("%" . $cadena . "%", "text"));
    $SacarPost = mysql_query($query_SacarPost, $conexion) or die(mysql_error());
    $row_SacarPost = mysql_fetch_assoc($SacarPost);
    $totalRows_SacarPost = mysql_num_rows($SacarPost);

   mysql_free_result($SacarPost);
?>