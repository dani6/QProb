<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $categoria=$_POST['CATEGORIA'];
    
    $db->query("ALTER TABLE CATEGORIA AUTO_INCREMENT=1");
    $result=$db->query("INSERT INTO CATEGORIA VALUES (0,'".$categoria."')");
    
    if($result>=1){
        echo 1;
    }else{
        echo $result;
    }
    $db->close();