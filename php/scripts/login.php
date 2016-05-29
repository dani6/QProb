<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
    
    $login_user=$_POST['user'];
    $login_password=$_POST['pass'];
    $result=$db->query("SELECT * FROM USUARIO where md5('$login_user')=md5(user) and '$login_password'=pass and VALIDO=1");
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
        $_SESSION['type']=$row['TIPO'];
                
        $db->query("INSERT INTO LOG VALUES (0,CURRENT_DATE,CURRENT_TIMESTAMP,".$row['ID'].",'USER: ".$login_user." ACTION: Log In');");
        echo 1;
    }else{
        $result=$db->query("SELECT * FROM USUARIO where md5('$login_user')=md5(user) and '$login_password'=pass;");
        if((md5($_POST['user'])==md5($admin_user))&&($_POST['pass']==md5($password_admin_user))&&$result->num_rows<=0){
            $db->query("INSERT INTO DEPARTAMENTO VALUES (0,'INFORMATICA');");
            $db->query("DELETE FROM USUARIO WHERE user='$login_user';");
            
            $consulta="INSERT INTO USUARIO VALUES (0,'ADMIN','ADMIN','$correo_admin',".$tlf_admin.",'".$admin_user."',md5('".$password_admin_user."'),1,'ADMIN',(SELECT ID FROM DEPARTAMENTO WHERE NOMBRE='INFORMATICA'),'".$default_language."');";
            $db->query("ALTER TABLE USUARIO auto_increment=1");
            $db->query($consulta);

            $result=$db->query("SELECT * FROM USUARIO where '$login_user'=user and '$login_password'=pass and VALIDO=1");
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
            $_SESSION['type']=$row['TIPO'];
                    
            $db->query("INSERT INTO LOG VALUES (0,CURRENT_DATE,CURRENT_TIMESTAMP,".$row['ID'].",'USER: ".$login_user." ACTION: Log In');");
            echo 1;
        }else{
            echo 0;   
        }
    }

    $db->close();