<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $consult="SELECT * FROM USUARIO WHERE ID=".$_POST['ID']." AND PASS='".$_POST['PASS']."';";
    $result = $db->query($consult); 
  
    if($result->num_rows>0){
        echo 1;
    }else{
        echo 0;
    }