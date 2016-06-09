<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $register_user=$_POST['user'];
    
    $result=$db->query("SELECT * FROM USUARIO where '$login_user'=user;");
    if($result->num_rows>0){
         echo 0;
    } else {
         echo 1;
    }
    
    $db->close();