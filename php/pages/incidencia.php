<?php 
    require('../layouts/header.php');
    
    $result = $db->query("SELECT I.ESTADO ESTADO_INCIDENCIA, I.FECHA FECHA_INCIDENCIA, I.TITULO TITULO_INCIDENCIA, I.DESCRIPCION DESCRIPCION_INCIDENCIA, I.TIPO TIPO_INCIDENCIA, c.NOMBRE NOMBRE_CATEGORIA, e.NOMBRE NOMBRE_EDIFICIO, p.NUMERO NUMERO_PLANTA, a.AULA NOMBRE_AULA, u.NOMBRE NOMBRE_USUARIO, u.APELLIDOS APELLIDO_USUARIO, u.USER USUARIO_USUARIO, d.NOMBRE NOMBRE_DEPARTAMENTO FROM INCIDENCIA I INNER JOIN REL_CATEGORIA_INCIDENCIA RCI ON I.ID=RCI.id_incidencia inner join categoria c on c.id=RCI.id_categoria inner join REL_AULA_INCIDENCIA RAI ON RAI.id_incidencia=i.id inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio inner join usuario u on u.id = i.id_usuario inner join DEPARTAMENTO d on d.id = i.id_departamento where i.id=".$_POST['ID_INCIDENCIA']);
    
    $row = mysqli_fetch_array($result);
    
    $result2 = $db->query("SELECT SUM(PRESUPUESTO) TOTAL FROM REVISION WHERE id_incidencia=".$_POST['ID_INCIDENCIA']);
    $row2 = mysqli_fetch_array($result2);
?>
<!-- <section> -->
    
    <style type="text/css" scoped>
        @import url("../css/pages/incidencia.css");
    </style>  
    <script>
        $(function(){
            $('a[href*=#]').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
                && location.hostname == this.hostname) {
                    var $target = $(this.hash);
                    $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
                    if ($target.length) {
                        var targetOffset = $target.offset().top;
                        $('html,body').animate({scrollTop: targetOffset}, 1000);
                        return false;
                    }
                }
            });
        });
            
        function cambiarEstado2(id,estado){
            var parametros = {
                    "ID": id,
                    "ESTADO": estado
            };
            
            $.ajax({
                    data:  parametros, //Datos que mandamos
                    url:   '../php/scripts/cambiarEstado.php', //Direccion a donde lo mandamos
                    type:  'post', 
                    
                    //Antes del envío se produce...:
                    beforeSend: function () {
                            // No hacemos nada
                    },
                    
                    //Despues del envio se produce...:
                    success:  function (response) {
                        //window.location="users.html";
                        location.reload(true);
                    }
            });
        }
        
        function cambiarEstado(id,estado){
             swal({
                    title: '<?php echo $DEPENDENCIES_confirm;?>',
                    text: "<?php echo $DEPENDENCIES_warning;?>",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '<?php echo $INCIDENCIES_change_status;?>'
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        cambiarEstado2(id,estado);
                    }
                });
        }
        
        function mostrarObservaciones(id){
                var parametros = {
                    "ID": id
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/observaciones.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                           $("#observaciones").html(response);
                           $('#observaciones').show("fast",function(){
                                $('#a').click();
                            });
                        }
                });
            }
        
        function deleteObservacion2(id){
            var parametros = {
                    "ID": id
            };
            
            $.ajax({
                    data:  parametros, //Datos que mandamos
                    url:   '../php/scripts/borrarObservacion.php', //Direccion a donde lo mandamos
                    type:  'post', 
                    
                    //Antes del envío se produce...:
                    beforeSend: function () {
                            // No hacemos nada
                    },
                    
                    //Despues del envio se produce...:
                    success:  function (response) {
                        //window.location="users.html";
                        location.reload(true);
                    }
            });
        }
        
        function deleteObservacion(id){
                swal({
                    title: '<?php echo $DEPENDENCIES_confirm;?>',
                    text: "<?php echo $DEPENDENCIES_warning;?>",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '<?php echo $INCIDENCIES_delete_comment;?>'
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        deleteObservacion2(id);
                    }
                });
        }
        
        function addObservacion2(id,observacion,presupuesto){
            var parametros = {
                    "ID": id,
                    "OBSERVACION": observacion,
                    "PRESUPUESTO": presupuesto
            };
            
            $.ajax({
                    data:  parametros, //Datos que mandamos
                    url:   '../php/scripts/addObservacion.php', //Direccion a donde lo mandamos
                    type:  'post', 
                    
                    //Antes del envío se produce...:
                    beforeSend: function () {
                            // No hacemos nada
                    },
                    
                    //Despues del envio se produce...:
                    success:  function (response) {
                        //window.location="users.html";
                        if(response==''){
                            swal('<?php echo $DEPENDENCIES_added;?>','<?php echo $INCIDENCIES_comment_added;?>','success').then(function(){
                                location.reload(true);
                            });
                        }else{
                            swal('ERROR','<?php echo $INCIDENCIES_comment_error;?>','error').then(function(){
                                addObservacion(id,observacion,presupuesto);
                            });
                        }
                    }
            });
        }
        
        function addObservacion(id,observacion,presupuesto){
                swal({
                    title: '<?php echo $INCIDENCIES_new_comment;?>',
                    html: '<center><table class="formObservacion"><tr><td colspan="2"><input style="width:100%" tabindex="1" value="" placeholder="Observacion" class="input-field" id="observacion3"></td></tr><tr><td><?php echo $COMMENT_estimate;?> </td><td><input tabindex="2" type="number" value="0" class="input-field" id="presupuesto3"></td></table></center>',
                    confirmButtonText: '<?php echo $INCIDENCIES_new_comment;?>',
                    showCancelButton: true,
                    cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>',
                    closeOnConfirm: true,
                    allowEscapeKey: true,
                    allowOutsideClick: true
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        addObservacion2(id,$('#observacion3').val(),$('#presupuesto3').val());
                    }
                });
                
                $(".formObservacion .input-field").focus(function(){
                    this.select();
                });
                
                $('#observacion3').val(observacion); 
                $('#presupuesto3').val(presupuesto);
        }
    </script>
    <div id="wrapper">
        <div id="wrapper2">
            <h2 style="float: right; margin-top: -8px;"> <?php echo $INCIDENCIES_total_cost;?> <span style="color: blue"><?php echo ($row2['TOTAL']!='')?$row2['TOTAL']:0;?>€</span></h2>
            <br>
            <h3>ID: <?php echo $_POST['ID_INCIDENCIA'];?> &nbsp&nbsp&nbsp&nbsp <?php echo $INCIDENCIES_state;?> <?php echo $row['ESTADO_INCIDENCIA'];?>  &nbsp&nbsp&nbsp&nbsp <?php echo $INCIDENCIES_type;?> <?php echo $row['TIPO_INCIDENCIA'];?></h3>
            <br>
            <h3><?php echo $category;?>: <?php echo $row['NOMBRE_CATEGORIA'];?> &nbsp&nbsp&nbsp&nbsp <?php echo $INCIDENCIES_department;?> <?php echo $row['NOMBRE_DEPARTAMENTO'];?></h3>
            <br>
            <h1><?php echo $row['TITULO_INCIDENCIA'];?></h1>
            <h2><?php echo $in;?>: <?php echo "<br> &nbsp&nbsp&nbsp&nbsp <span style='font-family: Geneva; font-size: 16px;'> $DEPENDENCIES_build: ".$row['NOMBRE_EDIFICIO']."&nbsp&nbsp&nbsp&nbsp  $INCIDENCIES_select_classroom: ".$row['NUMERO_PLANTA']." &nbsp&nbsp&nbsp&nbsp&nbsp $DEPENDENCIES_classroom: ".$row['NOMBRE_AULA']."</span>";?></h2>
            <br>
            <h3 style="text-align: right;"><?php echo $row['FECHA_INCIDENCIA'];?></h3>
            <hr/>
            <h2><?php echo $row['APELLIDO_USUARIO'].", ".$row['NOMBRE_USUARIO'].":";?></h2>
            <p><?php echo $row['DESCRIPCION_INCIDENCIA'];?></p>
        </div>
        <div style="margin-bottom: 20px;">
             <?php if ($_SESSION['type']!='NORMAL' && $_SESSION['type']!='SPECIAL' && $row['ESTADO_INCIDENCIA']!='RESUELTA'){?><input type="button" class="button" onclick="addObservacion(<?php echo $_POST['ID_INCIDENCIA'];?>,'',0);" value=" <?php echo $INCIDENCIES_comment;?>"><?php }?>
            <input type="button" class="simple-button" onclick="mostrarObservaciones(<?php echo $_POST['ID_INCIDENCIA'];?>);" value="<?php echo $INCIDENCIES_show_comment;?>">
            <?php if ($_SESSION['type']!='NORMAL' && $_SESSION['type']!='SPECIAL' && $row['ESTADO_INCIDENCIA']=='ABIERTA'){?><input type="button" class="simple-button" onclick="cambiarEstado(<?php echo $_POST['ID_INCIDENCIA'];?>,'EN CURSO');" value="<?php echo $INCIDENCIES_accept_incidence;?>"><?php }?>
            <?php if ($row['ESTADO_INCIDENCIA']!='RESUELTA'){?><input type="button" class="simple-button" onclick="cambiarEstado(<?php echo $_POST['ID_INCIDENCIA'];?>,'RESUELTA');" value="<?php echo $INCIDENCIES_resolved_incidence;?>"><?PHP }?>
        </div>
        
        <div id="observaciones">
        </div>
    </div>
    <a href="#observaciones" id="a"></a>
<!-- </section> -->    
<?php
    require('../layouts/footer.php');
?>