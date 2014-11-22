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
?>