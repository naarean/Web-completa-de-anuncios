<nav class="menu">
	<a href="<?php echo $dato['0']?>"><li class="item_menu">Incio</li></a>
	<a href="<?php echo $dato['0']?>chat/index.php"><li class="item_menu">Chat</li></a>
	<a href="<?php echo $dato['0']?>contacto.php"><li class="item_menu">Contacto</li></a>

	<?php  if (isset($_SESSION['iduser'])) { ?> <!-- si esta loguado puedes agregar anuncios -->
		<a href="<?php echo $dato['0']?>agregar.php"><li class="item_menu">Agregar</li></a>
	<?php } ?>
	
	<?php 
		if (!isset($_SESSION['iduser'])) //que solo muestre iniciar sesion y registrarse si no ha sido iniciada
		{ ?>
			<a onClick="mostrar_capa_login(1);" class="cursor"><li class="item_menu_login">Inciar sesi&oacute;n</li></a>
			<a href="registro-usuario.php"><li class="item_menu_login">Registrarse</li></a>
	<?php } else {?> <!-- si esta logueado que muestre su usuario y haya opcion de desloguearse-->
		<a href="<?php echo $dato['0']?>user/perfil-usuario.php"><li class="item_menu_login"><?php echo $_SESSION['nombreuser'] ?></li></a>
		<a href="<?php echo $dato['0']?>inc/cerrar-sesion.php?cerrar=yes"><li class="item_menu_login">X</li></a>
	<?php } ?>
</nav>