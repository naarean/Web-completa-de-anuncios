<?php //ESTE ARCHIVO inserta los datos de formulario que le llegan de agregar.php
// despues hace una consulta del campo time para sacar el id del anuncio que acabamos de insertar y poder pasarselo a fotos.php
//por seguridad para que no se vea en la url no lo enviaremos el idpost por GET lo enviaremos como variable de sesion

require_once('../conexion.php');  

//Subir imagen
$nombre_imagen = rand().$_FILES['imagen1']['name'];
    move_uploaded_file($_FILES['imagen1']['tmp_name'], "../img/upload/".$nombre_imagen);


$tiempocotejo=rand(); //numero aleatorio que pasaremos a fotos.php para saber que anuncio estamos insertando

//Insertar anuncio
$insertSQL = sprintf("INSERT INTO z_posts (titulo, mensaje, autor, imagen, time) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['mensaje'], "text"),
                       GetSQLValueString($_SESSION['iduser'], "int"),
                       GetSQLValueString($nombre_imagen, "text"),
					   GetSQLValueString($tiempocotejo, "int")); 

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

mysql_free_result($DatosId);

$_SESSION['idpost'] = $idpost; //la guardamos como variable de sesion para que sea invisible al usuario


header('Location:'.$dato['0'].'fotos.php'); //que nos lleve despues de inserar en la bbdd a fotos.php

?>