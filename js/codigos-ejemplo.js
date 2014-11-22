//FUNCION AJAX		
		$.ajax({
		type: 'POST',
		url: urlWeb + 'inc/recuperar.php',
		data: 'email=' + emailajax,
		success: function(html) {
	   }
	});
	
//CAMBIAR DISPLAY
       $('#error_login').css("display","none");
	   
//RETRASAR ACCION
        setTimeout(function(){
		},1000);

//IMPRIMIR HTML
        $('#resultados').html(html);
		
//DESACTIVAR BOTON
        document.getElementById('mi_btn').disabled=false;
		
//ACTUALIZAR CKEDITOR
    for (instance in CKEDITOR.instances) {
                CKEDITOR.instances.mensajes.updateElement();
            }
			
//ELIMINAR CARACTERES
         conteotitulo = titulo.split(" ").join("");
		 
//CONFIRMACION
function confirmacion(valor){
	if (valor==1){
     return confirm('Banear al user?');
    }

}

//Checkbox
if($("#checar").is(':checked')) {  
		recordar='on';
		} else {
		recordar='off';	
		}
//Ejecutar función al hacer clic
$("body,html").click(function(){
    alert('ejecucion');
});