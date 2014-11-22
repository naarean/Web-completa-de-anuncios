<?php //ESTE ARCHIVO CIERRA SESION DESTRUYENDO LAS VARIABLES DE SESION

require_once('../conexion.php');  


//CERRAR SESION
if ((isset($_GET['cerrar'])) &&($_GET['cerrar']=="yes"))
{
    $_SESSION['iduser'] = NULL;
    $_SESSION['nombreuser'] = NULL;
    unset($_SESSION['iduser']);
    unset($_SESSION['nombreuser']);
    
        
    $logoutGoTo = $dato['0']; //donde queremos ir al cerrar sesión, en este caso la página principal
      
    header("Location: $logoutGoTo");
    exit;
}



?>