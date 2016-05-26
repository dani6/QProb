<?php
    // All scripts call session.php like: 
    require('../layouts/session.php');
    
    $consulta="SELECT SUM(R.PRESUPUESTO) TOTAL, U.USER USUARIO_USUARIO, U.NOMBRE NOMBRE_USUARIO, U.APELLIDOS APELLIDOS_USUARIO, D.NOMBRE NOMBRE_DEPARTAMENTO, U.EMAIL EMAIL_USUARIO, U.TLF TLF_USUARIO, U.TIPO TIPO_USUARIO FROM USUARIO U INNER JOIN DEPARTAMENTO D ON U.id_departamento=D.ID INNER JOIN INCIDENCIA I ON I.id_usuario=u.id INNER JOIN REVISION R ON R.id_incidencia=I.id where U.ID=".$_POST['ID'];
    $result = $db->query($consulta);
    
    $row = mysqli_fetch_array($result);
    
    
    
    ?>
    
    <h2 style="text-align: left;"><?php echo $row['NOMBRE_USUARIO']." ".$row['APELLIDOS_USUARIO'];?> </h2>
    <div style="padding: 10px 10px 20px 10px; ">
        <h1 style="text-align: left"> <?php echo $department." ".$row['NOMBRE_DEPARTAMENTO'];?></h1>
        <center>
            <table style="width: 100%; font-size: 18px; font-family: Square; margin-top: 20px;">
                <tr>
                    <td style="padding: 10px;"> <?php echo $email.": ";?> </td>
                    <td style="padding: 10px;"> <?php echo $row['EMAIL_USUARIO'];?> </td>
                </tr>
                <tr>
                    <td style="padding: 10px;"> <?php echo $tlf.": ";?> </td>
                    <td style="padding: 10px;"> <?php echo $row['TLF_USUARIO'];?></td>
                </tr>
                <tr>
                    <td style="padding: 10px;"> <?php echo $tipo_name.": ";?> </td>
                    <td style="padding: 10px;"> <?php echo $row['TIPO_USUARIO'];?></td>
                </tr>
        
                <?php
                    echo "<tr>
                    <td></td>
                    <td style='padding: 10px; text-align: right; font-weight: 10px; color: blue;'> $INCIDENCIES_total_expense: ";
                        if($row['TOTAL']==null)
                            echo 0;
                        else
                            echo $row['TOTAL'];
                    echo "€</td></tr>";
                ?>
            </table>
        </center>
    </div>