<?php
    // All scripts call session.php like:
    require('../layouts/session.php');

    $categoria = $_POST['CATEGORIA'];
    $titulo = $_POST['TITULO'];
    $descripcion = $_POST['DESCRIPCION'];
    $tipo = $_POST['TIPO'];
    $edificio = $_POST['EDIFICIO'];
    $planta = $_POST['PLANTA'];
    $aula = $_POST['AULA'];
    
    $db->query("START TRANSACTION");
    $db->query("ALTER TABLE INCIDENCIA auto_increment=1");
    $consulta="INSERT INTO INCIDENCIA VALUES (0,'ABIERTA',CURRENT_TIMESTAMP,'".$titulo."','".$descripcion."','".$tipo."',".$_SESSION['id_department'].",".$_SESSION['id'].")";
    $result=$db->query($consulta);
    if(!$result){
        echo 0;
        $db->query("ROLLBACK");
    }else{
        $consulta="INSERT INTO REL_AULA_INCIDENCIA VALUES (".$aula.",(SELECT ID FROM INCIDENCIA WHERE id_Departamento=".$_SESSION['id_department']." and id_Usuario=".$_SESSION['id']." order by fecha desc limit 1));";
        $result=$db->query($consulta);
        if(!$result){
            echo 0;
            $db->query("ROLLBACK");
        }else{
            $consulta="INSERT INTO REL_CATEGORIA_INCIDENCIA VALUES((SELECT ID FROM INCIDENCIA WHERE id_Departamento=".$_SESSION['id_department']." and id_Usuario=".$_SESSION['id']." order by fecha desc limit 1),".$categoria.");";
            $result=$db->query($consulta);
            if(!$result){
                echo 0;
                $db->query("ROLLBACK");
            }
        }
    }
    
    $db->query("COMMIT");
    
    $db->close();
    
    