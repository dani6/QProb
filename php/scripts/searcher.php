<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $consulta="SELECT ID, TITULO, FECHA FROM INCIDENCIA WHERE ID LIKE '".$_POST['TEXT']."' OR TITULO LIKE '%".$_POST['TEXT']."%' ORDER BY FECHA DESC LIMIT 3 ";
    $result = $db->query($consulta);
    
    if ($result->num_rows>0){
        while($row = mysqli_fetch_array($result)){
<<<<<<< HEAD
            echo '<div class="element_sub_toolbar" onclick="alert(\'HOLA\');window.location=\'incidencia.html?id='.$row['ID'].'\';"> 
                ID:'.$row['ID'].'<br>
                $title:'.$row['TITULO'].'<br>
                $date:'.$row['FECHA'].'
=======
            echo '<div class="element_sub_toolbar" onclick="window.location=\'incidencia.html?id='.$row['ID'].'\';"> 
                ID:'.$row['ID'].'<br><br>
                <span style="font-weight: bold; color: black;">'.$row['TITULO'].'</span><br><br>
                '.$row['FECHA'].'
>>>>>>> 02971a2c8e448f91024f0e67834622b6e9edc359
            </div>';
        }    
    }else{
        echo 0;
    }
    