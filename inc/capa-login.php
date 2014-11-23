<div id="capa_login" style="display:none">
	<div id="flotantelogin">
		<a onClick="mostrar_capa_login(2);" class="cursor"><span class="derecha">X</span></a>

		<form onSubmit="return false" id="formularioLogin">  <!-- para que no recarge la página al ser ajax necesitamos  onSubmi="return false" -->
			Usuario: <br>
			<input type="text" name="user" id="user"> <br>
			Contrasese&ntilde;a: <br>
			<input type="password" name="pass" id="pass"> <br>
			<div id="error_login" style="display:none;"></div> <!-- capa oculta para mostrar errores -->
			<input type="submit" id="miboton" class="cursor" onClick="login_ajax(user.value,pass.value);" value="Iniciar">
		</form>
	</div>
	<div id="fondonegro"></div>
</div>