<?php require_once('../conexion.php'); //ESTE FICHERO CAMBIA EL AVATAR DEL USUARIO

//coge la imagen, la renombra usando el iduser, cambia en la base de datos y cambia el html de la página precendente para que salga actualizada con el nuevo avatar


if (isset($_POST['oculto']))
{
	if ($_FILES['imagen3']['type'] == "image/png" || $_FILES['imagen3']['type'] == "image/jpg" || $_FILES['imagen3']['type'] == "image/jpeg")
	{
		//Subir imagen y la nombraremos con el iduser
		$nombre_imagen = $_FILES['imagen3']['name'];

		$partes_imagen = explode('.' , $nombre_imagen); //asi dividimos nombre de extensión

		$nuevo_nombre = $partes_imagen['0']; //nombre original de la imagen subida
		$extension = $partes_imagen['1'];  //extensión de la imagen subida

		move_uploaded_file($_FILES['imagen3']['tmp_name'], "avatar/".$_SESSION['iduser'].'.'.$extension);
		

		//actualizamos los datos en bbdd
		$updateSQL = sprintf("UPDATE z_users SET avatar=%s WHERE id=%s",
					   		GetSQLValueString($_SESSION['iduser'].'.'.$extension, "text"),
                       		GetSQLValueString($_SESSION['iduser'], "int"));
	    mysql_select_db($database_conexion, $conexion);
	    $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());


		?>
		<script>
			//cambiamos el html actualizado el avatar al nuevo
			opener.document.getElementById('img_avatar').src = 'avatar/<?php echo $_SESSION['iduser'].'.'.$extension ?>' //con opener le decimos que el cambio le ha de hacer en la página precendente
			//cierra la ventana emergente al subir la imagen correctamente
			self.close(); 
		</script>
		<?php
	}
	else
	{
		echo "Extensión de fichero no válida, solo JPG, PNG o JPEG";
	}
}

?>
<form method="POST" enctype="multipart/form-data" action="avatar.php">
	<input type="file" name="imagen3" value="" id="imagen3"> <br>
	<input type="hidden" name="oculto" value="ok">
	<input type="submit" value="Subir avatar">
</form>