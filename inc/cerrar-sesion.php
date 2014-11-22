<?php //ESTE ARCHIVO CIERRA SESION DESTRUYENDO LAS VARIABLES DE SESION

require_once('../conexion.php');  


//CERRAR SESION
if ((isset($_GET['cerrar'])) &&($_GET['cerrar']=="yes"))
{
    $_SESSION['iduser'] = NULL;
    $_SESSION['nombreuser'] = NULL;
    unset($_SESSION['iduser']);
    unset($_SESSION['nombreuser']);
    
        
    $logoutGoTo = 'http://localhost/curso2014/'; //donde queremos ir al cerrar sesión
      
    header("Location: $logoutGoTo");
    exit;
}



?>