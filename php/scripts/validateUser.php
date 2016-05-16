<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');

    $db->query("UPDATE USUARIO SET VALIDO=1 WHERE ID=".$_POST['ID']);