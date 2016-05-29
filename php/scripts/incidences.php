<?php
    // All scripts call session.php like:
    require('../layouts/session.php');
    
    $usuario = $_POST['USUARIO'];
    $categoria = $_POST['CATEGORIA'];
    $estado = $_POST['ESTADO']; 
    $titulo = $_POST['TITULO']; 
    $tipo = $_POST['TIPO']; 
    $departamento = $_POST['DEPARTAMENTO'];
    $edificio = $_POST['EDIFICIO'];
    $planta = $_POST['PLANTA'];
    $aula = $_POST['AULA'];
    $nombre = $_POST['NOMBRE'];
    $file = $_POST['FILE'];
    
    $result = $db->query("SELECT * FROM EDIFICIO;");
    
    $edificios="";
    while($row = mysqli_fetch_array($result)){
        $edificios.='<option value="'.$row['id'].'">'.$row['NOMBRE'];
    }
    
    if($edificio!=""){
        $result = $db->query("SELECT * FROM PLANTA WHERE id_edificio like '%".$edificio."%'");

        $planta2="";
        while ($row = mysqli_fetch_array($result)) {
            $planta2.='<option value="'.$row['id'].'">'.$row['NUMERO'];
        }
    }
    if($planta!=""){
        $result = $db->query("SELECT * FROM AULA WHERE id_planta like '%".$planta."%' order by aula");
        
        $aula2="";
        while ($row = mysqli_fetch_array($result)) {
            $aula2.='<option value="'.$row['id'].'">'.$row['AULA'];
        }
    }
    ?>
    
    <script>
        function reset(){
            updateIncidences('<?php echo $usuario;?>','','<?php echo $estado;?>','','','','','','','','<?php echo $file;?>');
        }
        
        function borrarIncidencia2(id){
                    var parametros = {
                            "ID": id
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/deleteIncidencia.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                swal(
                                    '<?php echo $DEPENDENCIES_delete;?>',
                                    '<?php echo $INCIDENCIES_delete;?>',
                                    'success'
                                ).then(function(isConfirm){
                                    //window.location="<?php echo $file;?>.html";
                                    location.reload(true);
                                });
                            }
                    });
                }
                
                function borrarIncidencia(id){
                    swal({
                        title: '<?php echo $DEPENDENCIES_confirm;?>',
                        text: "<?php echo $DEPENDENCIES_warning;?>",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '<?php echo $INCIDENCIES_delete_incidence;?>'
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            borrarIncidencia2(id);
                        }
                    });
                }
    </script>
    
    <?php 
    if($file=="incidences" || $file=="in_progress" || $file=="resolved" || $file=="open"){ ?>
    <table class="buscador" style='text-align: right;'>
        <tr>
            <td> 
                <?php echo $categories;?> :
            </td>
            <td>
                <select id="categories" onchange="updateIncidences($('#usuario').val(),$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),$('#departamento').val(),$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),$('#nombre').val(),'<?php echo $file;?>');">
                    <option value=""> <?php echo $CATEGORIES_select;?>
                    <?php
                        $result = $db->query("select c.id CATEGORIA_ID, c.NOMBRE CATEGORIA_NOMBRE FROM CATEGORIA c;");
                        while($row = mysqli_fetch_array($result)){
                            ?>
                                <option value="<?php echo $row['CATEGORIA_NOMBRE'];?>"><?php echo $row['CATEGORIA_NOMBRE'];?>
                            <?php
                        }
                    ?>
                </select>
            </td>
            <td>
                <?php echo $INCIDENCIES_name;?> 
            </td>
            <td>
                <input class="input-field2" id='nombre' type="text" name="txt" value="" onchange="updateIncidences($('#usuario').val(),$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),$('#departamento').val(),$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),$('#nombre').val(),'<?php echo $file;?>');"/>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $INCIDENCIES_user_name;?> 
            </td>
            <td>
                <input class="input-field2" id='usuario' type="text" name="txt" value="" onchange="updateIncidences($('#usuario').val(),$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),$('#departamento').val(),$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),$('#nombre').val(),'<?php echo $file;?>');"/>
            </td>
            <td>
                <?php echo $INCIDENCIES_title;?>
            </td>
            <td>
                <input class="input-field2" id='titulo' type="text" name="txt" value="" onchange="updateIncidences($('#usuario').val(),$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),$('#departamento').val(),$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),$('#nombre').val(),'<?php echo $file;?>');"/>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $INCIDENCIES_type;?>
            </td>
             <td>
                <select id="tipo" onchange="updateIncidences($('#usuario').val(),$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),$('#departamento').val(),$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),$('#nombre').val(),'<?php echo $file;?>');">
                        <option value=""> <?php echo $INCIDENCIES_select_type;?>
                        <option value="GENERAL"> GENERAL 
                        <option value="TIC"> TIC
                </select>
            </td>
            <td>
                <?php echo $INCIDENCIES_department;?>
            </td>
            <td>
                <input class="input-field2" id='departamento' type="text" name="txt" value="" onchange="updateIncidences($('#usuario').val(),$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),$('#departamento').val(),$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),$('#nombre').val(),'<?php echo $file;?>');"/>
            </td>
        </tr>
    </table>
    <?php }else{ ?>
        <table class="buscador" style='text-align: right;'>
           <tr>
                <td>
                    <?php echo $INCIDENCIES_title;?>
                </td>
                <td colspan="3">
                    <input style="width: 90%;"class="input-field2" id='titulo' type="text" name="txt" value="" onchange="updateIncidences('<?php echo $usuario;?>',$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),'',$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),'','<?php echo $file;?>');"/>
                </td>   
            </tr>
            <tr style='margin-left: 5px;'>
                <td> 
                    <?php echo $categories;?> :
                </td>
                <td>
                    <select id="categories" onchange="updateIncidences('<?php echo $usuario;?>',$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),'',$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),'','<?php echo $file;?>');">
                        <option value=""> <?php echo $CATEGORIES_select;?>
                        <?php
                            $result = $db->query("select c.id CATEGORIA_ID, c.NOMBRE CATEGORIA_NOMBRE FROM CATEGORIA c;");
                            while($row = mysqli_fetch_array($result)){
                                ?>
                                    <option value="<?php echo $row['CATEGORIA_NOMBRE'];?>"><?php echo $row['CATEGORIA_NOMBRE'];?>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                Tipo:
            </td>
             <td>
                <select id="tipo" onchange="updateIncidences('<?php echo $usuario;?>',$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),'',$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),'','<?php echo $file;?>');">
                        <option value=""> <?php echo $INCIDENCIES_select_type;?>
                        <option value="GENERAL"> GENERAL 
                        <option value="TIC"> TIC
                </select>
            </td>
            </tr>
        </table>
    <?php }  ?>
    <br>
    <select style="margin-left: 80px;"id="edificio4" onchange="updateIncidences('<?php echo $usuario;?>',$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),'',$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),'','<?php echo $file;?>');">
        <option value=""> <?php echo $INCIDENCIES_select_build;?>
        <?php
             echo $edificios;
        ?>
    </select>

    <select id="planta4" onchange="updateIncidences('<?php echo $usuario;?>',$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),'',$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),'','<?php echo $file;?>');">
        <option value=""><?php echo $INCIDENCIES_floor;?>
        <?php
            echo $planta2;
        ?>    
    </select>

    <select id="aula4" style="width: 350px;"onchange="updateIncidences('<?php echo $usuario;?>',$('#categories').val(),'<?php echo $estado;?>',$('#titulo').val(),$('#tipo').val(),'',$('#edificio4').val(),$('#planta4').val(),$('#aula4').val(),'','<?php echo $file;?>');">
        <option value=""> <?php echo $INCIDENCIES_select_classroom;?>
        <?php
            echo $aula2;
        ?>    
    </select>

    <input type="button" class="simple-button" onclick="reset();" value="<?php echo $reset_form;?>">
    <br>
    <br>
    <?php
    $result = $db->query("select i.ID ID,u.USER USUARIO_USUARIO, u.NOMBRE USUARIO_NAME, c.NOMBRE CATEGORIA_NAME, i.ESTADO INCIDENCIA_ESTADO, i.TITULO INCIDENCIA_TITULO, i.TIPO INCIDENCIA_TIPO, e.NOMBRE EDIFICIO_NOMBRE, p.NUMERO PLANTA_NUMERO, a.AULA AULA, i.FECHA FECHA from incidencia i inner join rel_aula_incidencia rai on rai.id_incidencia=i.id inner join rel_categoria_incidencia rci on rci.id_incidencia=i.id inner join usuario u on u.id=i.id_usuario inner join departamento d on d.id=u.id_departamento inner join categoria c on c.id=rci.id_categoria inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio where u.USER LIKE '%".$usuario."%' and c.NOMBRE like '%".$categoria."%' and i.ESTADO like '%".$estado."%' and i.TITULO like '%".$titulo."%' and i.TIPO like '%URGENTE%' and d.NOMBRE LIKE '%".$departamento."%' and e.id like '%".$edificio."%' and p.id like '%".$planta."%' and a.id like '%".$aula."%' and concat(u.NOMBRE,' ',u.APELLIDOS) LIKE '%".$nombre."%' ORDER BY FECHA DESC;");

    echo "<h2>$INCIDENCIES_urgent_incidence</h2>";
    
    if ($result->num_rows > 0) {
    ?>    
        
         <table style="width: 100%">
                <tr class="top">
                    <td><?php echo $title;?></td>
                    <td><?php echo $user_text;?></td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $status;?></td>
                    <?php if($row['INCIDENCIA_ESTADO']!='RESUELTA'){?><td class="empty"></td><?php }?>
                    <td class="empty"></td>
                </tr>
                <tr style="display:none;">
                    <td></td>
                    <td style="width: 100px;"></td>
                    <td style="width: 170px;"></td>
                    <td style="width: 100px;"></td>
                    <?php if($row['INCIDENCIA_ESTADO']!='RESUELTA'){?><td class="X" onclick="borrarIncidencia(<?php echo $row['ID'];?>);"> X</td><?php }?>
                    <td style="font-size: 10px; width: 100px;" class="editar" onclick="window.location='incidencia.html?id=<?php echo $row['ID'];?>';"> <?php echo $INCIDENCIES_show_incidence;?></td>
                </tr>
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['INCIDENCIA_TITULO'];?></td>
                    <td style="width: 100px;"><?php echo $row['USUARIO_USUARIO'];?></td>
                    <td style="width: 170px;"><?php echo $row['FECHA'];?></td>
                    <td style="width: 100px;"><?php echo $row['INCIDENCIA_ESTADO'];?></td>
                    <?php if($row['INCIDENCIA_ESTADO']!='RESUELTA'){?><td class="X" onclick="borrarIncidencia(<?php echo $row['ID'];?>);"> X</td><?php }?>
                    <td style="font-size: 10px; width: 100px;" class="editar" onclick="window.location='incidencia.html?id=<?php echo $row['ID'];?>';"> <?php echo $INCIDENCIES_show_incidence;?></td>
                </tr>
            <?php
                }
                ?>
        </table>
        <?php
    }else{
        echo "$INCIDENCIES_no_exist_urgent";
    }
    
    $result = $db->query("select i.ID ID,u.USER USUARIO_USUARIO, u.NOMBRE USUARIO_NAME, c.NOMBRE CATEGORIA_NAME, i.ESTADO INCIDENCIA_ESTADO, i.TITULO INCIDENCIA_TITULO, i.TIPO INCIDENCIA_TIPO, e.NOMBRE EDIFICIO_NOMBRE, p.NUMERO PLANTA_NUMERO, a.AULA AULA, i.FECHA FECHA from incidencia i inner join rel_aula_incidencia rai on rai.id_incidencia=i.id inner join rel_categoria_incidencia rci on rci.id_incidencia=i.id inner join usuario u on u.id=i.id_usuario inner join departamento d on d.id=u.id_departamento inner join categoria c on c.id=rci.id_categoria inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio where u.USER LIKE '%".$usuario."%' and c.NOMBRE like '%".$categoria."%' and i.ESTADO like '%".$estado."%' and i.TITULO like '%".$titulo."%' and i.TIPO like '%".$tipo."%' and i.TIPO not like 'URGENTE' and d.NOMBRE LIKE '%".$departamento."%' and e.id like '%".$edificio."%' and p.id like '%".$planta."%' and a.id like '%".$aula."%' and concat(u.NOMBRE,' ',u.APELLIDOS) LIKE '%".$nombre."%' ORDER BY FECHA DESC;");
    
    echo "<h2>$INCIDENCIES_others_incidences</h2>";
    
    if ($result->num_rows > 0) {
    ?>
            <table style="width: 100%">
                <tr class="top">
                    <td><?php echo $title;?></td>
                    <td><?php echo $user_text;?></td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $status;?></td>
                    <?php if($row['INCIDENCIA_ESTADO']!='RESUELTA'){?><td class="empty"></td><?php }?>
                    <td class="empty"></td>
                </tr>
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['INCIDENCIA_TITULO'];?></td>
                    <td style="width: 100px;"><?php echo $row['USUARIO_USUARIO'];?></td>
                    <td style="width: 170px;"><?php echo $row['FECHA'];?></td>
                    <td style="width: 100px;"><?php echo $row['INCIDENCIA_ESTADO'];?></td>
                    <?php if($row['INCIDENCIA_ESTADO']!='RESUELTA'){?><td class="X" onclick="borrarIncidencia(<?php echo $row['ID'];?>);"> X</td><?php }?>
                    <td style="font-size: 10px; width: 100px;" class="editar" onclick="window.location='incidencia.html?id=<?php echo $row['ID'];?>';"> <?php echo $INCIDENCIES_show_incidence;?></td>
                </tr>
                <?php
                    }
        }else{
            echo "$INCIDENCIES_no_exist_incidences";
        }
        ?>
        
        <script>
            $('input').focus(function(){
                this.select();
            });
        </script>
