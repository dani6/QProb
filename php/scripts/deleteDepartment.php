<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
     
    
    $categoria=$_POST['DEPARTAMENTO'];
    
    $db->query("DELETE FROM DEPARTAMENTO WHERE id=".$categoria);
    
    $db->close();