<?php //ESTE ARCHIVO inserta los datos de formulario que le llegan de agregar.php y cuando termine nos lleve a index.php

require_once('../conexion.php');  

//Subir imagen
$nombre_imagen = rand().$_FILES['imagen1']['name'];
    move_uploaded_file($_FILES['imagen1']['tmp_name'], "../img/upload/".$nombre_imagen);


//Insertar anuncio
$insertSQL = sprintf("INSERT INTO z_posts (titulo, mensaje, autor, imagen) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['mensaje'], "text"),
                       GetSQLValueString($_SESSION['iduser'], "int"),
                       GetSQLValueString($nombre_imagen, "text"));

mysql_select_db($database_conexion, $conexion);
$Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

header('Location:'.$dato['0']); //que nos lleve al acabar a la página de incio

?>