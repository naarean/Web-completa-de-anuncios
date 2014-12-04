<?php //ESTE ARCHIVO inserta los datos de formulario que le llegan de agregar.php
// despues hace una consulta del campo time para sacar el id del anuncio que acabamos de insertar y poder hacer 2 cosas
// 1º actualizar el campo seo para que la url no solo dependa del titulo sino tambien de la id para evitar urls duplicadas
// 2º pasarle el id a fotos.php
//por seguridad para que no se vea en la url no lo enviaremos el idpost por GET lo enviaremos como variable de sesion

require_once('../conexion.php');  

if ($_FILES['imagen1']['type'] == "image/png" || $_FILES['imagen1']['type'] == "image/jpg" || $_FILES['imagen1']['type'] == "image/jpeg")
{
	//Subir imagen
	$nombre_imagen = $_FILES['imagen1']['name'];
	    move_uploaded_file($_FILES['imagen1']['tmp_name'], "../img/upload/".$nombre_imagen);
}
else
{
	$nombre_imagen =''; //para que no de error si no metemos foto ya que necesitamos un valor para el insert aunque sea null
}


$tiempocotejo=rand(); //numero aleatorio que pasaremos a fotos.php para saber que anuncio estamos insertando

//Insertar anuncio
$insertSQL = sprintf("INSERT INTO z_posts (titulo, mensaje, autor, imagen, time, categoria, seo) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['mensaje'], "text"),
                       GetSQLValueString($_SESSION['iduser'], "int"),
                       GetSQLValueString($nombre_imagen, "text"),
					   GetSQLValueString($tiempocotejo, "int"),
					   GetSQLValueString($_POST['categoria'], "int"),
					   GetSQLValueString(url_amigable($_POST['titulo']), "text"));  //URL amigable

mysql_select_db($database_conexion, $conexion);
$Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());


//CONSULTA BASE DATOS
mysql_select_db($database_conexion, $conexion);
$query_DatosId = sprintf("SELECT * FROM z_posts WHERE time = %s", $tiempocotejo, "text");
$DatosId = mysql_query($query_DatosId, $conexion) or die(mysql_error());
$row_DatosId = mysql_fetch_assoc($DatosId);
$totalRows_DatosId = mysql_num_rows($DatosId);

//de la fila obtenida por la consulta sacamos el id
$idpost=$row_DatosId['id'];


//Update para que el campo seo sea id+seo ya que sino podría haber dos urls iguales con solo poner el mismo título al anuncio
$updateSQL = sprintf("UPDATE z_posts SET seo=%s WHERE id=%s",
			   		GetSQLValueString($idpost.'-'.url_amigable($_POST['titulo']), "text"), //ej: 21-Actualizar-datos-del-programa
               		GetSQLValueString($idpost, "int"));
mysql_select_db($database_conexion, $conexion);
$Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());


mysql_free_result($DatosId);

$_SESSION['idpost'] = $idpost; //la guardamos como variable de sesion para que sea invisible al usuario


header('Location:'.$dato['0'].'fotos.php'); //que nos lleve despues de inserar en la bbdd a fotos.php

?>