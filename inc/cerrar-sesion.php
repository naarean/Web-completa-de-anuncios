<?php //ESTE ARCHIVO CIERRA SESION DESTRUYENDO LAS VARIABLES DE SESION

require_once('../conexion.php');  


//CERRAR SESION, destruyendo variables de sesion y las cookies
if ((isset($_GET['cerrar'])) &&($_GET['cerrar']=="yes"))
{
    $_SESSION['iduser'] = NULL;
    $_SESSION['nombreuser'] = NULL;
    unset($_SESSION['iduser']);
    unset($_SESSION['nombreuser']);

    
    setcookie("usercookie", "", time() + (365 * 24 * 60 * 60),"/"); //para borrala ponemos que "usercookie" = "", es decir, la setea a vacio
  	setcookie("passcookie", "", time() + (365 * 24 * 60 * 60),"/"); 
    
        
    $logoutGoTo = $dato['0']; //donde queremos ir al cerrar sesión, en este caso la página principal
      
    header("Location: $logoutGoTo");
    exit;
}



?>