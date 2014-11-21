<?php 

if (!isset($_SESSION)) {
  session_start();
}

//CONEXION BASE DATOS
    $hostname_conexion = "localhost";
    $database_conexion = "Curso2014";
    $username_conexion = "root";
    $password_conexion = "";
    $conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 

?>