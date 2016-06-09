<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    
    
    $id=$_POST['ID'];
    
    $db->query("DELETE FROM USUARIO WHERE id=".$id);
    
    $db->close();