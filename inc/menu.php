<nav class="menu">
	<a href="<?php echo $dato['0']?>"><li class="item_menu">Incio</li></a>
	<li class="item_menu">Posts</li>
	<li class="item_menu">Contacto</li>

	<?php  if (isset($_SESSION['iduser'])) { ?> <!-- si esta loguado puedes agregar anuncios -->
		<a href="<?php echo $dato['0']?>agregar.php"><li class="item_menu">Agregar</li></a>
	<?php } ?>
	
	<?php 
		if (!isset($_SESSION['iduser'])) //que solo muestre iniciar sesion y registrarse si no ha sido iniciada
		{ ?>
			<a onClick="mostrar_capa_login(1);" class="cursor"><li class="item_menu_login">Inciar sesi&oacute;n</li></a>
			<a href="registro-usuario.php"><li class="item_menu_login">Registrarse</li></a>
	<?php } else {?> <!-- si esta logueado que muestre su usuario y haya opcion de desloguearse-->
		<li class="item_menu_login"><?php echo $_SESSION['nombreuser'] ?></li>
		<a href="inc/cerrar-sesion.php?cerrar=yes"><li class="item_menu_login">X</li></a>
	<?php } ?>
</nav>