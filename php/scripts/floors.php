<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $result = $db->query("SELECT * FROM PLANTA WHERE id_edificio=".$_POST['EDIFICIO']);

    $planta="";
    while ($row = mysqli_fetch_array($result)) {
        $planta.='<option value="'.$row['id'].'">'.$row['NUMERO'];
    }
?>

<select style="width: 100px;"class="input-field" id="planta3" onchange="updateClass($('#planta3').val());">
    <option value="0"><?php echo $INCIDENCIES_floor;?>
    <?php
        echo $planta;
    ?>
</select>