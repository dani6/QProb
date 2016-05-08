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
            
            function deleteDependencie2(edificio,planta,aula){
                var parametros = {
                        "EDIFICIO": edificio,
                        "PLANTA": planta,
                        "AULA": aula
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/deleteDependencie.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(function(isConfirm){
                                updateParams(0,0,0);
                            });
                        }
                });
            }
            
            function deleteDependencie(edificio,planta,aula){
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        deleteDependencie2(edificio,planta,aula);
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
                        url:   '../php/scripts/updateDependencie2.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            $('#addDependencie').html(response);
                            $('#edificio2 > option[value="'+edificio+'"]').attr('selected', 'selected');
                            
                            $("input").focus(function(){
                                this.select();
                            }); 
                        }
                });
            }
            
            function addDependencie2(edificio,planta,aula){
                var parametros = {
                        "EDIFICIO": edificio,
                        "PLANTA": planta,
                        "AULA": aula
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/addDependencie.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            if(response=='1'){
                                swal(
                                    'Added!',
                                    'Your file has been added.',
                                    'success'
                                ).then(function(){
                                    updateParams(0,0,0);
                                });
                            }else{
                                swal(
                                    'Error!',
                                    'Ha ocurrido un error. Puede ya existir el aula.',
                                    'error'
                                ).then(function(){
                                    addDependencie(edificio,planta);
                                });
                            }
                            
                        }
                });
            }
            
            function addDependencie(edificio,planta){
                swal({
                title: 'Añadir aula',
                width: 800,
                html: '<div id="addDependencie"><select id="edificio2" onchange="updateParams2($(\'#edificio2\').val(),$(\'#aula2\').val());"><option value="0"> -- Selecciona un edificio<?php $result = $db->query("select e.id EDIFICIO_ID, e.NOMBRE EDIFICIO_NOMBRE FROM EDIFICIO e;");
                    while($row = mysqli_fetch_array($result)){ echo '<option value="'.$row['EDIFICIO_ID'].'">'.$row["EDIFICIO_NOMBRE"]; }?></select>'
                    +'<select id="planta2" onchange="updateParams2($(\'#edificio2\').val(),$(\'#aula2\').val());"><option value="0"> -- Selecciona una planta<?php $result = $db->query("select p.id PLANTA_ID, p.NUMERO PLANTA_NUMERO FROM PLANTA p where p.id_edificio like '".$_POST['EDIFICIO2']."';");while($row = mysqli_fetch_array($result)){ echo '<option value="'.$row['PLANTA_ID'].'">'.$row['PLANTA_NUMERO'];}?></select>'
                    +'<input id="aula2" class="input-field" max="50" value="AULA"></div>',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
                cancelButtonText: 'CANCEL',
                closeOnConfirm: true,
                allowEscapeKey: true,
                allowOutsideClick: true
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        addDependencie2($('#edificio2').val(),$('#planta2').val(),$("#aula2").val());
                    }
                });
                
                $("input").focus(function(){
                    this.select();
                }); 
            }
    </script>
    <div id="wrapper">
        <h1> Dependencies </h1>
        <hr size="2px"/>
        <br>
        <br>
        <div class="button" onclick="addDependencie(0,0);"> Añadir +</div>
        <script>
            function info(){
                swal({
                    title: 'Cómo añadir edificios y plantas',
                    html: "<p>Puedes usar los siguientes comandos en la terminal de mysql para añadir edificios y plantas:</p><p style='color: blue;margin-top: 20px;'>INSERT INTO EDIFICIO VALUES (0, '--NOMBRE EDIFICIO--');</p>"
                    +"<p style='color: blue;margin-top: 20px;'>INSERT INTO PLANTA VALUES (0,--NUMERO_PLANTA--,(select id from edificio where nombre like '--NOMBRE_EDIFICIO--'));</p>"
                    +"<p style='margin-top: 30px;'>O bien utilizar una interfaz para la manipulación de bases de datos. </p>"
                    +"<p>El motivo principal por el que no se puede añadir es debido a que los edificios y plantas no suelen cambiar con relativa frencuencia.</p>",
                    type: 'info', 
                    width: 800,       
                    confirmButtonText: '<?php echo $OK;?>'
                  });
            }
        </script>
        <div class="info" onclick="info();"> ¿Desea añadir nuevos edificios y plantas? </div>
        <div class="options">
            
            <select id="edificio" onchange="updateParams($('#edificio').val(),0,0);">
                <option value="0"> -- Selecciona un edificio
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
                <option value="0"> -- Selecciona una planta
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
                <option value="0"> -- Selecciona un aula
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
                <td>Edificio</td>
                <td>Planta</td>
                <td>Aula</td>
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
                <td class="X" onClick="deleteDependencie(<?php echo $row['EDIFICIO_ID'];?>,<?php echo $row['PLANTA_ID'];?>,<?php echo $row['AULA_ID'];?>);">X</td> 
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