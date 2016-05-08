<?php 
    require('../layouts/header.php');
?>
<!-- <section> -->
    <style type="text/css" scoped>
        @import url("../css/pages/dependencies.css");
    </style> 
    
    <script>
        function updateParams(edificio,planta,aula){
                var parametros = {
                        "EDIFICIO": edificio,
                        "PLANTA": planta,
                        "AULA": aula
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/pages/dependencies.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            document.open();
                            document.write(response);
                            document.close();
                        }
                });
            }
            
            function deleteDependency2(edificio,planta,aula){
                var parametros = {
                        "EDIFICIO": edificio,
                        "PLANTA": planta,
                        "AULA": aula
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/deleteDependency.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            swal(
                                '<?php echo $DEPENDENCIES_delete;?>',
                                '<?php echo $DEPENDENCIES_verify_deleted;?>',
                                'success'
                            ).then(function(isConfirm){
                                updateParams(0,0,0);
                            });
                        }
                });
            }
            
            function deleteDependency(edificio,planta,aula){
                swal({
                    title: '<?php echo $DEPENDENCIES_confirm;?>',
                    text: "<?php echo $DEPENDENCIES_warning;?>",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<?php echo $DEPENDENCIES_cancel_accept;?>'
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        deleteDependency2(edificio,planta,aula);
                    }
                });
            }
            
            function updateParams2(edificio,aula){
                var parametros = {
                        "EDIFICIO": edificio,
                        "AULA": aula
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/updateDependency2.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            $('#addDependency').html(response);
                            $('#edificio2 > option[value="'+edificio+'"]').attr('selected', 'selected');
                            
                            $("input").focus(function(){
                                this.select();
                            }); 
                        }
                });
            }
            
            function addDependency2(edificio,planta,aula){
                var parametros = {
                        "EDIFICIO": edificio,
                        "PLANTA": planta,
                        "AULA": aula
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/addDependency.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            if(response=='1'){
                                swal(
                                    '<?php echo $DEPENDENCIES_added;?>',
                                    '<?php echo $DEPENDENCIES_verify_added;?>',
                                    'success'
                                ).then(function(){
                                    updateParams(0,0,0);
                                });
                            }else{
                                swal(
                                    '<?php echo $DEPENDENCIES_error;?>',
                                    '<?php echo $DEPENDENCIES_error_message;?>',
                                    'error'
                                ).then(function(){
                                    addDependency(edificio,planta);
                                });
                            }
                        }
                });
            }
            
            function addDependency(edificio,planta){
                swal({
                    title: '<?php echo $DEPENDENCIES_add_classroom;?>',
                    width: 800,
                    html: '<div id="addDependency"><select id="edificio2" onchange="updateParams2($(\'#edificio2\').val(),$(\'#aula2\').val());"><option value="0"> <?php echo $DEPENDENCIES_select_build;?> <?php $result = $db->query("select e.id EDIFICIO_ID, e.NOMBRE EDIFICIO_NOMBRE FROM EDIFICIO e;");
                        while($row = mysqli_fetch_array($result)){ echo '<option value="'.$row['EDIFICIO_ID'].'">'.$row["EDIFICIO_NOMBRE"]; }?></select>'
                        +'<select id="planta2" onchange="updateParams2($(\'#edificio2\').val(),$(\'#aula2\').val());"><option value="0"> <?php echo $DEPENDENCIES_select_floor;?> <?php $result = $db->query("select p.id PLANTA_ID, p.NUMERO PLANTA_NUMERO FROM PLANTA p where p.id_edificio like '".$_POST['EDIFICIO2']."';");while($row = mysqli_fetch_array($result)){ echo '<option value="'.$row['PLANTA_ID'].'">'.$row['PLANTA_NUMERO'];}?></select>'
                        +'<input id="aula2" class="input-field" max="50" value="<?php echo $DEPENDENCIES_classroom;?>"></div>',
                    confirmButtonText: '<?php echo $DEPENDENCIES_accept;?>',
                    showCancelButton: true,
                    cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>',
                    closeOnConfirm: true,
                    allowEscapeKey: true,
                    allowOutsideClick: true
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        addDependency2($('#edificio2').val(),$('#planta2').val(),$("#aula2").val());
                    }
                });
                
                $("input").focus(function(){
                    this.select();
                }); 
            }
    </script>
    <div id="wrapper">
        <h1> <?php $DEPENDENCIES_dependencies;?> </h1>
        <hr size="2px"/>
        <br>
        <br>
        <div class="button" onclick="addDependency(0,0);"> <?php echo $DEPENDENCIES_add;?> </div>
        <script>
            function info(){
                swal({
                    title: '<?php $DEPENDENCIES_how_to_add;?>',
                    html: "<?php $DEPENDENCIES_instructions;?>",
                    type: 'info', 
                    width: 800,       
                    confirmButtonText: '<?php echo $OK;?>'
                  });
            }
        </script>
        <div class="info" onclick="info();"> <?php echo $DEPENDENCIES_question;?> </div>
        <div class="options">
            
            <select id="edificio" onchange="updateParams($('#edificio').val(),0,0);">
                <option value="0"> <?php $DEPENDENCIES_select_build;?>
                <?php
                    $result = $db->query("select e.id EDIFICIO_ID, e.NOMBRE EDIFICIO_NOMBRE FROM EDIFICIO e;");
                    while($row = mysqli_fetch_array($result)){
                        ?>
                           <option value="<?php echo $row['EDIFICIO_ID'];?>"><?php echo $row['EDIFICIO_NOMBRE'];?>
                        <?php
                    }
                ?>
            </select>
            <select id="planta" onchange="updateParams($('#edificio').val(),$('#planta').val(),0);">
                <option value="0"> <?php $DEPENDENCIES_select_floor;?>
                <?php
                    $result = $db->query("select p.id PLANTA_ID, p.NUMERO PLANTA_NUMERO FROM PLANTA p where p.id_edificio like '".$_POST['EDIFICIO']."';");
                    while($row = mysqli_fetch_array($result)){
                        ?>
                           <option value="<?php echo $row['PLANTA_ID'];?>"><?php echo $row['PLANTA_NUMERO'];?>
                        <?php
                    }
                ?>
            </select>
            <select id="aula" onchange="updateParams($('#edificio').val(),$('#planta').val(),$('#aula').val());">
                <option value="0"> <?php $DEPENDENCIES_select_classroom;?>
                <?php
                    $result = $db->query("select a.id AULA_ID, a.AULA AULA_NOMBRE FROM AULA a where a.id_planta like '".$_POST['PLANTA']."';");
                    while($row = mysqli_fetch_array($result)){
                        ?>
                           <option value="<?php echo $row['AULA_ID'];?>"><?php echo $row['AULA_NOMBRE'];?>
                        <?php
                    }
                ?>
            </select>
        </div>
        <br>
        <table id="table_dependencies">
            <tr class="top">
                <td><?php echo $DEPENDENCIES_build;?></td>
                <td><?php echo $DEPENDENCIES_floor;?></td>
                <td><?php echo $DEPENDENCIES_classroom;?></td>
                <td class="empty"></td>
            </tr>
<?php
    if($_POST['EDIFICIO']=='0' || empty($_POST['EDIFICIO'])){
        $result = $db->query("select e.id EDIFICIO_ID, e.NOMBRE EDIFICIO_NOMBRE, p.id PLANTA_ID, p.NUMERO PLANTA_NUMERO, a.id AULA_ID, a.AULA AULA_NOMBRE from edificio e inner join planta p on p.id_edificio=e.id inner join aula a on p.id=a.id_planta;");    
    }else if($_POST['PLANTA']=='0' || empty($_POST['PLANTA'])){
        $result = $db->query("select e.id EDIFICIO_ID, e.NOMBRE EDIFICIO_NOMBRE, p.id PLANTA_ID, p.NUMERO PLANTA_NUMERO, a.id AULA_ID, a.AULA AULA_NOMBRE from edificio e inner join planta p on p.id_edificio=e.id inner join aula a on p.id=a.id_planta where e.id like '%".$_POST['EDIFICIO']."%';");
    }else if($_POST['AULA']=='0' || empty($_POST['AULA'])){
        $result = $db->query("select e.id EDIFICIO_ID, e.NOMBRE EDIFICIO_NOMBRE, p.id PLANTA_ID, p.NUMERO PLANTA_NUMERO, a.id AULA_ID, a.AULA AULA_NOMBRE from edificio e inner join planta p on p.id_edificio=e.id inner join aula a on p.id=a.id_planta where e.id like '%".$_POST['EDIFICIO']."%' and p.id like '%".$_POST['PLANTA']."';");
    }else{
        $result = $db->query("select e.id EDIFICIO_ID, e.NOMBRE EDIFICIO_NOMBRE, p.id PLANTA_ID, p.NUMERO PLANTA_NUMERO, a.id AULA_ID, a.AULA AULA_NOMBRE from edificio e inner join planta p on p.id_edificio=e.id inner join aula a on p.id=a.id_planta where e.id like '%".$_POST['EDIFICIO']."%' and p.id like '%".$_POST['PLANTA']."' and a.id like '%".$_POST['AULA']."%';");
    }
    while($row = mysqli_fetch_array($result)){
        ?>
            <tr>
                <td><?php echo $row['EDIFICIO_NOMBRE'];?></td>
                <td><?php echo $row['PLANTA_NUMERO'];?></td>
                <td><?php echo $row['AULA_NOMBRE'];?></td>
                <td class="X" onClick="deleteDependency(<?php echo $row['EDIFICIO_ID'];?>,<?php echo $row['PLANTA_ID'];?>,<?php echo $row['AULA_ID'];?>);">X</td> 
            </tr>
        <?php
    }
?>
        </table>
        <script>
            <?php
                if(empty($_POST['EDIFICIO'])){
                    echo "var edificio = 0;";
                }else{
                    echo "var edificio =".$_POST['EDIFICIO'].";";
                }
                
                if(empty($_POST['PLANTA'])){
                    echo "var planta = 0;";
                }else{
                    echo "var planta =".$_POST['PLANTA'].";";
                }
                
                if(empty($_POST['AULA'])){
                    echo "var aula = 0;";
                }else{
                    echo "var aula =".$_POST['AULA'].";";
                }
            ?>
            $('#edificio > option[value="'+edificio+'"]').attr('selected', 'selected');
            $('#planta > option[value="'+planta+'"]').attr('selected', 'selected');
            $('#aula > option[value="'+aula+'"]').attr('selected', 'selected');
        </script>
    </div>
<!-- </section> -->    
<?php
    require('../layouts/footer.php');
?>