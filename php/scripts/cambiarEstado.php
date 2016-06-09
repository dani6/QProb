<?php
    // All scripts call session.php like:
    require('../layouts/session.php');

    $id_incidencia = $_POST['ID'];
    $estado_incidencia = $_POST['ESTADO'];
    
    $consulta="UPDATE INCIDENCIA SET ESTADO='".$estado_incidencia."' WHERE ID=".$id_incidencia;
    $result=$db->query($consulta);
   
    $db->close();