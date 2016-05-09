<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $usuario = $_POST['USUARIO'];
    $categoria = $_POST['CATEGORIA'];
    $estado = $_POST['ESTADO'];
    $titulo = $_POST['TITULO'];
    $tipo = $_POST['TIPO'];
    $departamento = $_POST['DEPARTAMENTO'];
    $edificio = $_POST['EDIFICIO'];
    $planta = $_POST['PLANTA'];
    $aula = $_POST['AULA'];
    
    $result = $db->query("SELECT * FROM INCIDENCIAS");