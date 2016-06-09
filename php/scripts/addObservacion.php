<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $consulta="INSERT INTO revision VALUES (CURRENT_TIMESTAMP,".$_SESSION['id'].",".$_POST['ID'].",'".$_POST['OBSERVACION']."',".$_POST['PRESUPUESTO'].",0)";
    $db->query($consulta);
    
    $db->close();