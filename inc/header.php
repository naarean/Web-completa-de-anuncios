<header class="encabezado">
	<div id="logo">
		<a href="<?php echo $dato['0']?>"><img src="img/logo.png" height="80"></a>
	</div>

	<script>
		function buscador_ajax(busqueda){
			$.ajax({
				type: 'POST',
				url: urlWeb + 'inc/buscar-anuncios.php',
				data: 'textoescrito=' + busqueda,
				success: function(resultados) { 
					$("#resultados_busqueda").html(resultados);
					$("#resultados_busqueda").css("display","block");

					//si borran los datos del buscador que oculte la capa de resultados
					var valorcampo = $("#textoescrito").val();
					if (valorcampo == '')
					{
						$("#resultados_busqueda").css("display","none");
					}
		   		}
			});
		}
	</script>
	<div id="buscador">
		<form onSubmit="return false" name="formBuscador">
			<input type="text" name="textoescrito" id="textoescrito" placeholder="Texto búsqueda" onKeyup="buscador_ajax(textoescrito.value);" value="">
			<input type="submit" value="Buscar">
		</form>
		<div id="resultados_busqueda" style="display:none"></div>
	</div>
</header>