<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $consulta="SELECT ID, TITULO, FECHA FROM INCIDENCIA WHERE ID LIKE '".$_POST['TEXT']."' OR TITULO LIKE '%".$_POST['TEXT']."%' LIMIT 3";
    $result = $db->query($consulta);
    
    if ($result->num_rows>0){
        while($row = mysqli_fetch_array($result)){
            echo '<div class="element_sub_toolbar" onclick="alert(\'HOLA\');window.location=\'incidencia.html?id='.$row['ID'].'\';"> 
                ID:'.$row['ID'].'<br>
                $title:'.$row['TITULO'].'<br>
                $date:'.$row['FECHA'].'
            </div>';
        }    
    }else{
        echo 0;
    }
    