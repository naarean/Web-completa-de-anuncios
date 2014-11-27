<?php require_once('../conexion.php');  //saca todo lo que hay en la bbdd, devuelve un html que es invocado con un include desde chat/index.php


//CONSULTA BASE DATOS para leer en z_chat
mysql_select_db($database_conexion, $conexion);
$query_DatosMensaje = "SELECT * FROM z_chat ORDER BY id ASC";
$DatosMensaje = mysql_query($query_DatosMensaje, $conexion) or die(mysql_error());
$row_DatosMensaje = mysql_fetch_assoc($DatosMensaje);
$totalRows_DatosMensaje = mysql_num_rows($DatosMensaje);



do { ?>
	<span class="listas_chat">
		<?php echo nombre($row_DatosMensaje['user'])?> dijo: <?php echo $row_DatosMensaje['mensaje']?><br>
		<span class="hacecuanto"><?php echo tiempo_transcurrido($row_DatosMensaje['time'])?></span>
	</span>
<?php } while($row_DatosMensaje = mysql_fetch_assoc($DatosMensaje));

mysql_free_result($DatosMensaje)

?>