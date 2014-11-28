<?php //ESTE ARCHIVO LE NECESITAMOS SIEMPRE ASI QUE LE LLAMAMOS DESDE CONEXION.PHP, en el guardamos cosas como variables globales para php

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
    header('Content-Type: text/html; charset=UTF-8'); 


//CONSULTA BASE DATOS
    mysql_select_db($database_conexion, $conexion);
    $query_DatosWeb = "SELECT * FROM z_datos";
    $DatosWeb = mysql_query($query_DatosWeb, $conexion) or die(mysql_error());
    $row_DatosWeb = mysql_fetch_assoc($DatosWeb);
    $totalRows_DatosWeb = mysql_num_rows($DatosWeb);

    //varibales globales para luego usarlas en páginas de php
    $dato = array($row_DatosWeb['url'], $row_DatosWeb['titulo'], $row_DatosWeb['admin']);

    mysql_free_result($DatosWeb);


//RECIBE EL ID DE USUARIO Y DEVUELVE EL NOMBRE DEL USUARIO
function nombre($iduser){
    global $database_conexion, $conexion;

    //CONSULTA BASE DATOS
    mysql_select_db($database_conexion, $conexion);
    $query_DatosFuncion = sprintf("SELECT user FROM z_users WHERE id=%s",
                      GetSQLValueString($iduser, "int")); 
    $DatosFuncion = mysql_query($query_DatosFuncion, $conexion) or die(mysql_error());
    $row_DatosFuncion = mysql_fetch_assoc($DatosFuncion);
    $totalRows_DatosFuncion = mysql_num_rows($DatosFuncion);

    return $row_DatosFuncion['user']; //devuelve el nombre de usuario
    
    mysql_free_result($DatosFuncion);
  }

//RECIBE DOS PARAMETROS DE LOGIN.PHP Y CREA DOS COOKIES 
function recordarsesion($user, $pass){

  setcookie("usercookie", $user, time() + (365 * 24 * 60 * 60),"/"); //la barra final es para que sirve en todas las páginas del dominio
  setcookie("passcookie", $pass, time() + (365 * 24 * 60 * 60),"/"); 

}

if(isset($_COOKIE['usercookie']) && isset($_COOKIE['passcookie']) && !isset($_SESSION['iduser'])) //si estan creadas estas cookies y no lo estan las variables de sesión, iniciamos sesion
{
  //CONSULTA BASE DATOS
  mysql_select_db($database_conexion, $conexion);
  $query_DatosLogin = sprintf("SELECT * FROM z_users WHERE user=%s AND password=%s",
                    GetSQLValueString($_COOKIE['usercookie'], "text"),
                    GetSQLValueString($_COOKIE['passcookie'], "text")); //la contraseña ya está en MD5 por eso no lo ponemos
  $DatosLogin = mysql_query($query_DatosLogin, $conexion) or die(mysql_error());
  $row_DatosLogin = mysql_fetch_assoc($DatosLogin);
  $totalRows_DatosLogin = mysql_num_rows($DatosLogin);



  if($totalRows_DatosLogin==1) //si existe el usuario le creamos dos variables de sesión
  {
    $_SESSION['iduser'] = $row_DatosLogin['id'];
    $_SESSION['nombreuser'] = $row_DatosLogin['user'];
  }
  
  mysql_free_result($DatosLogin);

}

//COGE FECHA EN FORMATO TIMESTAMP DE LA BBDD Y NOS DICE HACE CUANTO OCURRIO, la usamos en el chat
function tiempo_transcurrido($fecha) {
  if(empty($fecha)) {
      return "No hay fecha";
  }
   
  $intervalos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año");
  $duraciones = array("60","60","24","7","4.35","12");
   
  $ahora = time();
  $Fecha_Unix = strtotime($fecha);
  
  if(empty($Fecha_Unix)) {   
      return "Fecha incorracta";
  }
  if($ahora > $Fecha_Unix) {   
      $diferencia     =$ahora - $Fecha_Unix;
      $tiempo         = "Hace";
  } else {
      $diferencia     = $Fecha_Unix -$ahora;
      $tiempo         = "Dentro de";
  }
  for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
    $diferencia /= $duraciones[$j];
  }
   
  $diferencia = round($diferencia);
  
  if($diferencia != 1) {
    $intervalos[5].="e"; //MESES
    $intervalos[$j].= "s";
  }
   
    return "$tiempo $diferencia $intervalos[$j]";
}


//RECIBE UN NÚMERO Y DEVUELVE EL NOMBRE DE LA CATEGORÍA
function categoria($numero){
  if ($numero =='1') return 'HTML5';
  if ($numero =='2') return 'CSS3';
  if ($numero =='3') return 'AJAX';
}

?>