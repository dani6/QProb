<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
?>
    
    <select id="edificio2" onchange="updateParams2($(\'#edificio2\').val(),0);">
        <option value="0"> -- Selecciona un edificio
        
        <?php 
            $result = $db->query("select e.id EDIFICIO_ID, e.NOMBRE EDIFICIO_NOMBRE FROM EDIFICIO e;");
            while($row = mysqli_fetch_array($result)){ 
                echo '<option value="'.$row['EDIFICIO_ID'].'">'.$row["EDIFICIO_NOMBRE"]; 
            }
        ?>
    </select>
    <select id="planta2" onchange="updateParams2($(\'#edificio2\').val(),$(\'#planta2\').val());">
        <option value="0"> -- Selecciona una planta
        <?php 
            $result = $db->query("select p.id PLANTA_ID, p.NUMERO PLANTA_NUMERO FROM PLANTA p where p.id_edificio like '".$_POST['EDIFICIO']."';");
            while($row = mysqli_fetch_array($result)){ 
                echo '<option value="'.$row['PLANTA_ID'].'">'.$row['PLANTA_NUMERO'];
            }
        ?>
    </select>
    <input id="aula2" class="input-field" max="50" value="<?php echo $_POST['AULA'];?>">