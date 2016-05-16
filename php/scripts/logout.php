<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
    
    $aux_idioma=$_SESSION['language'];
    $aux_user=$_SESSION['user'];
    
    unset($_SESSION['user']);
    unset($_SESSION['control_session']); 
    session_destroy();
    
    // Actualizar el idioma del usuario
    $db->query("UPDATE USUARIO SET IDIOMA='".$aux_idioma."' WHERE user='".$aux_user."'");