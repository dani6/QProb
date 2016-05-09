<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
    
    $login_user=$_POST['user'];
    $login_password=$_POST['pass'];
    
    $result=$db->query("SELECT * FROM USUARIO where md5('$login_user')=user and '$login_password'=pass and VALIDO=1");
    if($result->num_rows>0){
        $row = mysqli_fetch_array($result);
        
        $_SESSION['control_session']=1; 
        $_SESSION['user']=$login_user;
        $_SESSION['id']=$row['ID'];
        $_SESSION['name']=$row['NOMBRE'];
        $_SESSION['surname']=$row['APELLIDOS'];
        $_SESSION['email']=$row['EMAIL'];
        $_SESSION['tlf']=$row['TLF'];
        $_SESSION['language']=$row['IDIOMA'];
        $_SESSION['id_department']=$row['id_departamento'];
        $_SESSION['type']=$row['TIPO']; // Añadir tipo de usuario
                
        $db->query("INSERT INTO LOG VALUES (0,CURRENT_DATE,CURRENT_TIMESTAMP,".$row['ID'].",'USER: ".$login_user." ACTION: Log In');");
        echo 1;
    }else if(($_POST['user']==$admin_user)&&($_POST['pass']==md5($password_admin_user))){
        $_SESSION['control_session']=1; 
        $_SESSION['user']=$login_user;
        $_SESSION['id']=0;
        $_SESSION['name']="Admin";
        $_SESSION['surname']="Admin";
        $_SESSION['email']=$correo_admin;
        $_SESSION['tlf']=000000000;
        $_SESSION['id_department']=1;
        $_SESSION['type']='ADMIN';
        $_SESSION['language']=$default_language;
        echo 1;
    }else{
        echo 0;
    }
    
    $db->close();