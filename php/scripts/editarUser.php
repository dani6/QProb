<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    
    
    $id_post = $_POST['ID'];
    
    $result = $db->query("SELECT U.ID ID_USUARIO,U.USER USUARIO_USUARIO, U.NOMBRE NOMBRE_USUARIO, U.APELLIDOS APELLIDOS_USUARIO, D.NOMBRE NOMBRE_DEPARTAMENTO, U.EMAIL EMAIL_USUARIO, U.TLF TLF_USUARIO, U.TIPO TIPO_USUARIO FROM USUARIO U INNER JOIN DEPARTAMENTO D ON U.id_departamento=D.ID WHERE U.ID=".$id_post);

    $row = mysqli_fetch_array($result);
    $departamento=$row['NOMBRE_DEPARTAMENTO'];
    $tipo=$row['TIPO_USUARIO'];
    
    $result = $db->query("SELECT * FROM DEPARTAMENTO;");
    $valor_departamento="";
    while( $row2 = mysqli_fetch_array($result))
        if($departamento==$row2['NOMBRE']){
            $valor_departamento.="<option selected=\"selected\" value=\"".$row2['ID']."\">".$row2['NOMBRE']."</option>";    
        }else{
            $valor_departamento.="<option value=\"".$row2['ID']."\">".$row2['NOMBRE']."</option>";
        }
        
                    
    ?>
    
    <table class="register">
        <tr>
            <td><?php echo $name;?></td>
            <td><input value="<?php echo $row['NOMBRE_USUARIO'];?>" class="input-field" maxlength="20" id="name"></td>
            <td><?php echo $surname;?></td>
            <td><input value="<?php echo $row['APELLIDOS_USUARIO'];?>" class="input-field" maxlength="20" id="surname"></td>
        </tr>
        <tr>
            <td><?php echo $email;?></td>
            <td><input value="<?php echo $row['EMAIL_USUARIO'];?>" class="input-field" maxlength="30" id="email"></td>
            <td><?php echo $tlf;?></td>
            <td><input value="<?php echo $row['TLF_USUARIO'];?>" onkeyup="validateNumber();" type="number" class="input-field" min="0" max="999999999" id="tlf"></td>
        </tr>
        <tr>
            <td><?php echo $user_text;?>:</td>
            <td colspan="3"><input style="width:100%;" value="<?php echo $row['USUARIO_USUARIO'];?>" class="input-field" maxlength="50" id="user_name"></td>
        </tr>
        <tr>
            <td><?php echo $department;?></td>
            <td colspan="3">
                <select style="width: 100%;"class="input-field" maxlength="20" id="department">
                    <?php echo $valor_departamento;?>
                </select>
            </td>
        </tr>
        <?php if($_SESSION['type']=="ADMIN"){?>
        <tr>
            <td><?php echo $type;?></td>
            <td colspan="3">
                <select style="width: 100%;"class="input-field" maxlength="20" id="type">
                    <option <?php if($tipo=="NORMAL") echo "selected=\"selected\"";?> value="NORMAL">NORMAL
                    <option <?php if($tipo=="TECHNICAL") echo "selected=\"selected\"";?> value="TECHNICAL">TECHNICAL
                    <option <?php if($tipo=="ADMIN") echo "selected=\"selected\"";?> value="ADMIN">ADMIN
                    <option <?php if($tipo=="SPECIAL") echo "selected=\"selected\"";?> value="SPECIAL">SPECIAL
                </select>
            </td>
        </tr>
        <?php } ?>
    </table>            