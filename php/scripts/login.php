<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
    
    $login_user=$_POST['user'];
    $login_password=$_POST['pass'];
    
    $result=$db->query("SELECT * FROM USUARIO where md5('$login_user')=user and '$login_password'=pass");
    if(($result->num_rows>0)||(($_POST['user']==$admin_user)&&($_POST['pass']==md5($password_admin_user)))){
        
        $_SESSION['user']=$login_user;
        $_SESSION['control_session']=1; 
        $_SESSION['type']="ADMIN"; // Añadir tipo de usuario
        
        echo 1;
    }else{
        echo 0;
    };