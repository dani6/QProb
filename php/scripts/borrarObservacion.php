<?php
    // All scripts call session.php like:
    require('../layouts/session.php');

    $db->query("DELETE FROM REVISION WHERE ID=".$_POST['ID']);
    
    $db->close();