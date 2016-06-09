<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $categoria=$_POST['DEPARTAMENTO'];
    
    $db->query("ALTER TABLE DEPARTAMENTO AUTO_INCREMENT=1");
    $result=$db->query("INSERT INTO DEPARTAMENTO VALUES (0,'".$categoria."')");
    
    if($result>=1){
        echo 1;
    }else{
        echo $result;
    }
    $db->close();