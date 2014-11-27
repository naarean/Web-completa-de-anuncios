
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


//CREA UNA COOKIE PARA RECORDAR QUE HA ACEPTADO LA POLÍTICA DE COOKIES
function crear_cookie(valor){
	$.ajax({
		type: 'POST',
		url: urlWeb + 'inc/cookie.php',
		data: 'valor=' + valor
	});
	$('#cookies').css("display","none"); //que oculte la capa de aceptar cookies
}


//RECIBE LOS DATOS DEL FORMULARIO DE LOGUEO Y LOS ENVIA A LOGIN.PHP
function login_ajax(user, pass)
{
	//Comprobamos el checkbox de recordar datos
	if($("#chekar").is(':checked')) 
	{  
		var recordar='on';
	} 
	else
	{
		recordar='off';	
	}
	
	if (user == '' || pass == '') //si faltan datos
	{
		$("#error_login").slideDown(500); //es como display block pero ademas con transicion
		$("#error_login").html("Faltan datos");
	}
	else //si estan completos, hago el login
	{
		$.ajax({
			type: 'POST',
			url: urlWeb + 'inc/login.php',
			data: 'user=' + user + '&pass=' + pass + '&recordar=' + recordar,
			success: function(respuesta) { 
				if(respuesta == 'correcto') //la sesion esta inciada asi que le recargo la página
				{ 
					location.reload(); 
				}
				else if(respuesta == 'error')
				{
					$("#error_login").slideDown(500); //es como display block pero ademas con transicion
					$("#error_login").html("Datos de acceso incorrectos");
				}
		   	}
		});
	}
}

//PARA REGISTRAR USUARIOS, LA LLAMAMOS DESDE REGISTRO-USUARIO.PHP
function registro_ajax(user, pass, pass2)
{
	if(user == '' || pass == '' || pass2 == '')
	{
		$("#error").slideDown(500);
		$("#error").html("Faltan datos");
	}
	else if (pass != pass2)
	{
		$("#error").slideDown(500);
		$("#error").html("Las Contraseñas no coinciden");
	}
	else if (( user != '' && pass != '' && pass2 != '') && (pass = pass2))  //todo correcto
	{
		$.ajax({
			type: 'POST',
			url: urlWeb + 'inc/alta-usuario.php',
			data: 'user=' + user + '&pass=' + pass,
			success: function(html) {
				if (html == 'error')
				{
					$("#error").slideDown(500);
					$("#error").html("Este nombre de usuario ya existe, elije otro");
				}
				else if (html == 'correcto')
				{
					$("#registro_usuario").html("Registro de usuario correcto");
				}
		   }
		});
	}
}

//LLAMADO DESDE INDEX.PHP PAARA PAGINAR ANUNCIOS, RECIBE COMO PARAMETRO EL NUMERO DE ANUNCIOS A PAGINAR
function paginar_anuncios(anuncios_a_paginar)
{
	$.ajax({
		type: 'POST',
		url: urlWeb + 'inc/paginar-anuncios.php',
		data: 'numero=' + anuncios_a_paginar,
		success: function(respuesta) {
			if (respuesta!='') //aun hay anuncios a mostrar
			{
				$("#listar-ajax").append(respuesta);  //añade el contenido a la capa listar-ajax
				//$("#listar-ajax").html(respuesta); //con esta opcion paginariamos sin añadir, sobreesxribiendo el html
			}
			else if (respuesta =='') //no hay mas anuncios, ocultamos el botón de cargar mas
			{
				$(".cargarmas").css("display","none");
			}
	   }
	});
}

//actualiza el contenido de un div cada segundo
function refrescar()
{
	setInterval(function(){
		$("#listar_chat").load('mensajes.php'); //cada segundo saca todo lo que hay en bbdd de chat
		$("#listar_chat").scrollTop($("#listar_chat")[0].scrollHeight); //para que haga scroll solo y muestre siempre el último mensaje
	},1000)
}


//Controla el formulario de contacto.php
function contacto_ajax(email, numero2)
{
	var numero1 = parseInt($("#numero1").html());   //lo recogemos del formulario y lo convertimos a entero

	if (numero1 != numero2) //captcha incorrecto
	{
		$("#error_contacto").slideDown(500); //es como display block pero ademas con transicion
		$("#error_contacto").html("Captcha inválido");
	}
	else if (numero1 == numero2) //captcha correcto
	{
		re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/

		if (re.exec(email))  // si es email válido
		{
			var formserializado = $("#formContacto");

			$.ajax({
				type: 'POST',
				url: urlWeb + 'inc/peticion-contacto.php',
				data: formserializado.serialize(),  //serializamos el formulario
				success: function(html) {
			   }
			});

			$("#respuesta").html("Email enviado");
		}
		else if (!re.exec(email)) //si no es un email
		{
			$("#error_contacto").slideDown(500); //es como display block pero ademas con transicion
			$("#error_contacto").html("Email no válido");
		}
	}
}