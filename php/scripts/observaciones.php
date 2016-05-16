<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $result = $db->query("SELECT R.ID ID_REVISION, U.USER USUARIO_USUARIO, U.NOMBRE NOMBRE_USUARIO, U.APELLIDOS APELLIDOS_USUARIO, R.FECHA FECHA_REVISION, R.OBSERVACION OBSERVACION_REVISION, R.PRESUPUESTO PRESUPUESTO_REVISION FROM REVISION R INNER JOIN USUARIO U ON U.id=R.id_usuario WHERE R.id_incidencia=".$_POST['ID']." ORDER BY FECHA");
    $contador=0;  
    while($row = mysqli_fetch_array($result)){
        if($contador%2==0){
            echo '<div class="observacion" style="float: left;">';
        }else{
            echo '<div class="observacion" style="float: right;">';
        }
?>    
        <div> Orden: <?php  echo ++$contador." &nbsp&nbsp&nbsp&nbsp ".$row['FECHA_REVISION'];?></div>
        <?php
            if($_SESSION['user']==$row['USUARIO_USUARIO']){
        ?>
            <div class="X" onclick="deleteObservacion(<?php echo $row['ID_REVISION'];?>);" style="float: right;margin-top: -20px;font-family: Shangai;"> X </div>
        <?php
            }
        ?>
        <div class="comentario"> 
            <?php echo $row['NOMBRE_USUARIO']." ".$row['APELLIDOS_USUARIO'].": ";?>
            <div class="text">
                <?php echo $row['OBSERVACION_REVISION'];?>
            </div>
        </div>
        <div style="text-align: right;"> Presupuesto: <span style="color: blue; font-weight: bold;"><?php echo $row['PRESUPUESTO_REVISION'];?> €</span></div>
    </div>
<?php
    }
    
    if($contador==0){
        echo "No hay observaciones para esta incidencia";
    }
?>