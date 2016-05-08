<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
    
    $nombre = $_POST['NOMBRE'];
    $apellidos = $_POST['APELLIDOS'];
    $email = $_POST['EMAIL'];
    $tlf = $_POST['TLF'];
    $departamento = $_POST['DEPARTAMENTO'];
    $tipo = $_POST['TYPE'];
    
    $db->query("UPDATE USUARIO SET NOMBRE='".$nombre."' WHERE ID=".$_POST['ID']);
    $db->query("UPDATE USUARIO SET APELLIDOS='".$apellidos."' WHERE ID=".$_POST['ID']);
    $db->query("UPDATE USUARIO SET EMAIL='".$email."' WHERE ID=".$_POST['ID']);
    $db->query("UPDATE USUARIO SET TLF=".$tlf." WHERE ID=".$_POST['ID']);
    $db->query("UPDATE USUARIO SET id_departamento='".$departamento."' WHERE ID=".$_POST['ID']);
    $db->query("UPDATE USUARIO SET TIPO='".$tipo."' WHERE ID=".$_POST['ID']);