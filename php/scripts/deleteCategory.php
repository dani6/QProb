<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
     
    
    $categoria=$_POST['CATEGORIA'];
    
    $db->query("DELETE FROM CATEGORIA WHERE id=".$categoria);
    
    $db->close();