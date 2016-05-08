<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $edificio=$_POST['EDIFICIO'];
    $planta=$_POST['PLANTA'];
    $aula=$_POST['AULA'];
    
    $result=$db->query("INSERT INTO AULA VALUES (0,'".$aula."',".$planta.")");
    
    if($result>=1){
        echo 1;
    }else{
        echo $result;
    }
    $db->close();