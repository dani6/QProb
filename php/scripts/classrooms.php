<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
        
    $result = $db->query("SELECT * FROM AULA WHERE id_planta=".$_POST['PLANTA']." order by aula");
    
    $aula="";
    while ($row = mysqli_fetch_array($result)) {
        $aula.='<option value="'.$row['id'].'">'.$row['aula'];
    }
?>

<select style="width: 400px;" class="input-field" maxlength="20" id="aula3">
    <option value="0"><?php echo $INCIDENCIES_select_classroom;?>
    <?php
        echo $aula;
    ?>
</select>