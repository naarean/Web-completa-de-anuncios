<?php //ESTE ARCHIVO CONECTA A LA BBDD Y CARGA AQUELLOS ARCHIVOS QUE NECESITAMOS TENER SIEMPRE CARGADOS

	if (!isset($_SESSION)) {
	  session_start();
	}

	//CONEXION BASE DATOS
	    $hostname_conexion = "localhost";
	    $database_conexion = "Curso2014";
	    $username_conexion = "root";
	    $password_conexion = "";
	    $conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 


	include('inc/funciones.php'); //aprovechando que siempre cargamos conexion.php y necesitamos cargar siempre funciones.php
?>