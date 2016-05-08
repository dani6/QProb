<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $id = $_POST['ID'];

    $result = $db->query("SELECT U.ID ID_USUARIO, U.NOMBRE NOMBRE_USUARIO, U.APELLIDOS APELLIDOS_USUARIO, D.NOMBRE NOMBRE_DEPARTAMENTO, U.EMAIL EMAIL_USUARIO, U.TLF TLF_USUARIO, U.TIPO TIPO_USUARIO FROM USUARIO U INNER JOIN DEPARTAMENTO D ON U.id_departamento=D.ID WHERE U.ID=".$id);

    $row = mysqli_fetch_array($result);

    //$row['ID_USUARIO']...
    ?>

    <input class="input-field" value="<?php echo $row['NOMBRE_USUARIO'];?>">
    <select>