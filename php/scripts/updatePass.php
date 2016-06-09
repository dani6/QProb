<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');

    $db->query("UPDATE USUARIO SET PASS='".$_POST['PASS']."' WHERE ID=".$_POST['ID']);