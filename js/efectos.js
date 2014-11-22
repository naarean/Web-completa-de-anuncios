
urlWeb = 'http://localhost/curso2014/'; //la cambiamos por el dominio final


//MUESTRA U OCULTA LA CAPA DE LOGIN
function mostrar_capa_login(abrirocerrar){
	if (abrirocerrar == 1) //abrir capa login
	{
		$("#capa_login").fadeIn(500);
	}
	else if (abrirocerrar == 2) //cerrar capa login
	{
		$("#capa_login").fadeOut(500);
	}
}

//RECIBE LOS DATOS DEL FORMULARIO DE LOGUEO Y LOS ENVIA A LOGIN.PHP
function login_ajax(user, pass){
	$.ajax({
		type: 'POST',
		url: urlWeb + 'inc/login.php',
		data: 'user=' + user + '&pass=' + pass,
		success: function(html) {
	   }
	});
	location.reload();
}

//CREA UNA COOKIE PARA RECORDAR QUE HA ACEPTADO LA POLÍTICA DE COOKIES
function crear_cookie(valor){
	$.ajax({
		type: 'POST',
		url: urlWeb + 'inc/cookie.php',
		data: 'valor=' + valor
	});
	$('#cookies').css("display","none"); //que oculte la capa de aceptar cookies
}