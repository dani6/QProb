<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
    
    $consulta="SELECT SUM(R.PRESUPUESTO) TOTAL FROM USUARIO U INNER JOIN INCIDENCIA I ON I.id_usuario=u.id INNER JOIN REVISION R ON R.id_incidencia=I.id where U.ID=".$_POST['ID'];
    $result = $db->query($consulta);
    
    $row = mysqli_fetch_array($result);
    
    if($row['TOTAL']==null){
        echo 0;
    }else{
        echo $row['TOTAL'];
    }