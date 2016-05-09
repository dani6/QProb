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
    
    $consulta="INSERT INTO INCIDENCIA VALUES (0,'ABIERTA',CURRENT_TIMESTAMP,'".$titulo."','".$descripcion."','".$tipo."',".$_SESSION['id_department'].",".$_SESSION['id'].")";
    $db->query($consulta);
    echo $consulta;
    $consulta="INSERT INTO REL_AULA_INCIDENCIA VALUES (".$aula.",(SELECT ID FROM INCIDENCIA WHERE id_Departamento=".$_SESSION['id_department']." and id_Usuario=".$_SESSION['id']." order by fecha desc limit 1));";
    $db->query($consulta);
    echo $consulta;
    $consulta="INSERT INTO REL_CATEGORIA_INCIDENCIA VALUES((SELECT ID FROM INCIDENCIA WHERE id_Departamento=".$_SESSION['id_department']." and id_Usuario=".$_SESSION['id']." order by fecha desc limit 1),".$categoria.");";
    $db->query($consulta);
    echo $consulta;