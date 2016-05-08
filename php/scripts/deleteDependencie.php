<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $edificio=$_POST['EDIFICIO'];
    $planta=$_POST['PLANTA'];
    $aula=$_POST['AULA'];
    
    $db->query("DELETE FROM AULA WHERE id=".$aula);
    
    $db->close();