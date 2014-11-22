<?php //ESTE ARCHIVO crea una cookie

require_once('../conexion.php');  


//setear cookie 1 mes
setcookie("galleta", $_POST['valor'], time() + (30 * 24 * 60 * 60),"/"); // la ultima / sirve para que sea extensible esta cookie a todas las páginas del dominio



?>