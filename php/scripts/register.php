<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
    
    $REGISTER_user=$_POST['user'];
    $REGISTER_name=$_POST['name'];
    $REGISTER_surname=$_POST['surname'];
    $REGISTER_email=$_POST['email'];
    $REGISTER_tlf=$_POST['tlf'];
    $REGISTER_department=$_POST['department'];
    $REGISTER_password=$_POST['pass'];
    $REGISTER_idioma=$_SESSION['language'];
    
    if(empty($_POST['type'])){
        $REGISTER_type="NORMAL";
        $REGISTER_valid=0;
    }else {
        $REGISTER_type=$_POST['type'];
        $REGISTER_valid=1;
    }
    
    $db->query('alter table USUARIO AUTO_INCREMENT=1');
    $result=$db->query("INSERT INTO USUARIO VALUES (0,'".$REGISTER_name."','".$REGISTER_surname."','".$REGISTER_email."',".$REGISTER_tlf.",md5('".$REGISTER_user."'),'".$REGISTER_password."',".$REGISTER_valid.",'".$REGISTER_type."',".$REGISTER_department.",'".$REGISTER_idioma."')");
    if ($result>=1){        
        //Usamos el SetFrom para decirle al script quien envia el correo
        $correo->SetFrom($correo_admin,$organization);
        
        //Usamos el AddAddress para agregar un destinatario
        $correo->AddAddress($REGISTER_email,$REGISTER_user);
        
        //Ponemos el asunto del mensaje
        $correo->Subject = $EMAIL_REGISTER_TITLE;
        $correo->MsgHTML("<div style='font-size: 21px;'>".$REGISTER_name." ".$REGISTER_surname.$EMAIL_REGISTER_MSG."<br><br><strong style='color: darkblue;'><i>QProb</i><strong>.</p>");
        
        // Si deseamos agregar un archivo adjunto utilizamos AddAttachment
        // $correo->AddAttachment("images/phpmailer.gif");
        
        // Timeout para el servidor de correos. Por defecto es valor es '10'
        $correo->Timeout=30;
        // Codificación UTF8. Obligado utilizarlo en aplicaciones en Español
        $correo->CharSet = 'UTF-8';
        $correo->Send();
                
        $result = $db->query("SELECT * FROM USUARIO WHERE md5('".$REGISTER_user."')=user;");
        $row = mysqli_fetch_array($result);
        $db->query('alter table LOG AUTO_INCREMENT=1');
        $db->query("INSERT INTO LOG VALUES (0,CURRENT_DATE,CURRENT_TIMESTAMP,".$row['ID'].",'USER: ".$REGISTER_user." ACTION: Sign Up');");
        
        echo 1;   
    }else{
        echo $REGISTER_ERROR_onInsert;
    }
    
    $db->close();