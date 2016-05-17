<?php 
    require('../layouts/header.php');
?>
<!-- <section> -->
     <style type="text/css" scoped>
        @import url("../css/pages/users.css");
    </style>  
    
    <div id="wrapper">
        <h1> <?php echo $USERS_users;?> </h1>
        <hr size="2px"/>
        <br>
        <br>
        <script>
                function validate(id){
                    swal({
                        title: '<?php echo $USERS_validate;?>',
                        text: "<?php echo $USERS_verify_validate;?>",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: 'green',
                        confirmButtonText: '<?php echo $USERS_confirm;?>'
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            validate2(id);
                        }
                    });
                }
                
                function validate2(id){
                    var parametros = {
                        "ID": id
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/validateUser.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                swal(
                                    '<?php echo $USERS_validated;?>',
                                    '<?php echo $USERS_validated_message;?>',
                                    'success'
                                ).then(function(isConfirm){
                                    //window.location="users.html";
                                    location.reload(true);
                                });
                            }
                    });
                }
                
                // Registro:
                function validateNumber(){
                    if(!($('#tlf').val()>=0&&$('#tlf').val()<=999999999)){
                        if($('#tlf').val()>999999999){
                            $('#tlf').val(Math.floor($('#tlf').val()/10));
                        }else{
                            $('#tlf').val('');
                        }
                    }
                }
                
                function errorRegister(msg,name,surname,email,tlf,department,user,type){
                    swal({
                        title: '<?php echo $DEPENDENCIES_error;?>',
                        text: msg,
                        type: 'error',        
                        confirmButtonText: '<?php echo $OK;?>',
                        showCancelButton: true,
                        cancelButtonText: '<?php echo $login_CANCEL;?>',
                        closeOnConfirm: false,
                        allowEscapeKey: true,
                        allowOutsideClick: true,
                        confirmButtonColor: '#d33'
                        }).then(function(isConfirm) {
                            showRegister(name,surname,email,tlf,department,user,type);
                        });
                }
                
                var control = "";
                // Validate the register form
                function validar(name,surname,email,tlf,department,user,pass,confirmpass,response,type){
                    if( name == null || name.length == 0 || /^\s+$/.test(name) ) {
                    errorRegister("<?php echo $REGISTER_ERROR_name;?>",name,surname,email,tlf,department,user,type);
                    control="name";
                    return false;
                    }
                    
                    if( surname == null || surname.length == 0 || /^\s+$/.test(surname) ) {
                    errorRegister("<?php echo $REGISTER_ERROR_surname;?>",name,surname,email,tlf,department,user,type);
                    control="surname";
                    return false;
                    }
                    
                    expr=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if( !expr.test(email) ) {
                    errorRegister("<?php echo $REGISTER_ERROR_email;?>",name,surname,email,tlf,department,user,type);
                    control="email";
                    return false;
                    }
                    
                    if( !(/^\d{9}$/.test(tlf)) ) {
                    errorRegister("<?php echo $REGISTER_ERROR_tlf;?>",name,surname,email,tlf,department,user,type);
                    control="tlf";
                    return false;
                    }

                    if( user==null || user.length == 0 || response==0){
                        errorRegister("<?php echo $REGISTER_ERROR_user;?>",name,surname,email,tlf,department,user,type);
                        control="user";
                        return false;
                    }
                    
                    if( pass == null || pass.length < 8) {
                        errorRegister("<?php echo $REGISTER_ERROR_passwords1;?>",name,surname,email,tlf,department,user,type);
                        control="pass";
                        return false;
                    }else if(pass!=confirmpass){
                        errorRegister("<?php echo $REGISTER_ERROR_passwords2;?>",name,surname,email,tlf,department,user,type);
                        control="pass";
                        return false;
                    }
                    
                    return true;
                }
                
                function check(name,surname,email,tlf,department,user,pass,confirmpass,type){
                    var parametros = {
                        "user": user
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/checkUser.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                if(validar(name,surname,email,tlf,department,user,pass,confirmpass,response,type)){
                                        register(name,surname,email,tlf,department,user,pass,type);       
                                }
                            }
                    });
                }
                
                function register(name,surname,email,tlf,department,user,pass,type){
                    var parametros = {
                        "name": name,
                        "surname": surname,
                        "email": email,
                        "tlf": tlf,
                        "department": department,
                        "user": user,
                        "pass": hex_md5(pass),
                        "type": type
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/register.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                if(response==1){
                                        swal({
                                        title: '<?php echo $REGISTER_congratulation;?>',
                                        text: '<?php echo $REGISTER_OK_msg;?>',
                                        type: 'success',        
                                        confirmButtonText: '<?php echo $OK;?>',
                                        closeOnConfirm: true,
                                        allowEscapeKey: true,
                                        allowOutsideClick: true
                                        }).then(function(){
                                            //window.location="users.html";
                                            location.reload(true);
                                        });
                                }else{
                                        errorRegister(response,name,surname,email,tlf,department,user,type);
                                        control="email";
                                }
                            }
                    });
                }
                <?php
                    $result = $db->query("SELECT * FROM DEPARTAMENTO;");
                    $valor_departamento="";
                    while( $row = mysqli_fetch_array($result))
                        $valor_departamento.="<option value=\"".$row['ID']."\">".$row['NOMBRE']."</option>";
                    
                ?>
                
                // Función para hacer la llamada a check.
                function loading_check(){
                    swal.enableLoading();
                    setTimeout(function() {
                        check($('#name').val(),$('#surname').val(),$('#email').val(),$('#tlf').val(),$('#department').val(),$('#Ruser').val(),$('#Rpass').val(),$('#Rpassconfirm').val(),$('#type').val());
                    }, 200);
                }
                        
                // Funcion para el evento de presionar enter.
                function showSweetCheck(e){
                    if (e.keyCode==13){
                        loading_check();
                    }     
                }
                
                // Show the register window.
                function showRegister(name,surname,email,tlf,department,user,type){
                    swal({
                    title: '<?php echo $signup;?>',
                    width: 800,
                    html: '<center><table class="register"><tr><td><?php echo $name.":";?></td><td><input placeholder="<?php echo $name;?>"value="'+name+'" class="input-field" maxlength="20" id="name"></td>'
                        +'<td><?php echo $surname.":";?></td><td><input placeholder="<?php echo $surname;?>"value="'+surname+'" class="input-field" maxlength="20" id="surname"></td></tr>'
                        +'<tr><td><?php echo $email.":";?></td><td><input placeholder="<?php echo $email;?>"value="'+email+'" class="input-field" maxlength="30" id="email"></td>'
                        +'<td><?php echo $tlf.":";?></td><td><input placeholder="<?php echo $tlf;?>"value="'+tlf+'" onkeyup="validateNumber();" type="number" class="input-field" min="0" max="999999999" id="tlf"></tr>'
                        +'<tr><td><?php echo $department;?></td><td colspan="3"><select style="width: 100%;"class="input-field" maxlength="20" id="department"><?php echo $valor_departamento;?></select></td></tr>'
                        +'<tr><td><?php echo $type;?></td><td colspan="3"><select style="width: 100%;"class="input-field" maxlength="20" id="type"><option value="NORMAL">NORMAL<option value="TECHNICAL">TECHNICAL<option value="ADMIN">ADMIN<option value="SPECIAL">SPECIAL</select></td></tr></table>'
                        +'<table class="register"><tr><td></td><td><?php echo $user_text.":";?></td><td><input placeholder="<?php echo $user_text;?>" value="'+user+'" class="input-field" maxlength="50" id="Ruser"></td><td></td></tr>'
                        +'<tr><td></td><td><?php echo $password_text.":";?></td><td><input placeholder="<?php echo $password_text;?>" class="input-field" id="Rpass" type="password" value=""></td><td></td></tr>'
                        +'<tr><td></td><td><?php echo $confirm_password.":";?></td><td><input placeholder="<?php echo $confirm_password;?>" class="input-field" id="Rpassconfirm" type="password" value=""></td><td></td></tr>'
                        +'</table></center>', 
                    confirmButtonText: '<?php echo $signup_botton;?>',
                    showCancelButton: true,
                    cancelButtonText: '<?php echo $login_CANCEL;?>',
                    closeOnConfirm: false,
                    allowEscapeKey: true,
                    allowOutsideClick: true
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            loading_check();
                        }
                    });
                    
                    $("#name").select();
                    $("input").focus(function(){
                        this.select();
                    }); 
                    $("input").bind("keydown",showSweetCheck);
                    
                    switch(control) {
                        case "surname":
                            $("#surname").select();
                            control="";
                            break;
                        case "email":
                            $("#email").select();
                            control="";
                            break;
                        case "tlf":
                            $("#tlf").select();
                            control="";
                            break;
                        case "user":
                            $("#Ruser").select();
                            control="";
                            break;
                        case "pass":
                            $("#Rpass").select();
                            control="";
                            break;
                        default:
                            $("#name").select();
                            control="";
                            break;
                    }
                    
                    $('#department > option[value="'+department+'"]').attr('selected', 'selected');
                    $('#type > option[value="'+type+'"]').attr('selected', 'selected');
                }
                
                function deleteUser2(id){
                    var parametros = {
                            "ID": id
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/deleteUser.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                swal(
                                    '<?php echo $DEPENDENCIES_delete;?>',
                                    '<?php echo $USERS_deleted;?>',
                                    'success'
                                ).then(function(isConfirm){
                                    //window.location="users.html";
                                    location.reload(true);
                                });
                            }
                    });
                }
                
                function deleteUser(id){
                    swal({
                        title: '<?php echo $DEPENDENCIES_confirm;?>',
                        text: "<?php echo $DEPENDENCIES_warning;?>",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '<?php echo $USERS_delete_accept;?>'
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            deleteUser2(id);
                        }
                    });
                }
            </script>
        <div class="button" style="margin-left:30px;" onclick="showRegister('','','','','','','');"><?php echo $DEPENDENCIES_add;?></div><br><br><br><br>
        <script>
            function update(nombre,departamento,email,cuenta){
                var parametros = {
                        "NOMBRE_USUARIO": nombre,
                        "NOMBRE_DEPARTAMENTO": departamento,
                        "EMAIL_USUARIO": email,
                        "TIPO_USUARIO": cuenta
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/pages/users.php', //Direccion a donde lo mandamos
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
                            
                            $("#porNombre").val(nombre);
                            $("#porDepartamento").val(departamento);
                            $("#porCorreo").val(email);
                            $('#porTipo > option[value="'+cuenta+'"]').attr('selected', 'selected');
                        }
                });
            }
            
            function updateUser(id,name,surname,email,tlf,department,type,user){
                var parametros = {
                        "ID": id,
                        "NOMBRE": name,
                        "APELLIDOS": surname,
                        "EMAIL": email,
                        "TLF": tlf,
                        "DEPARTAMENTO": department,
                        "TYPE": type,
                        "USER_NAME": user
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/updateUser2.php', //Direccion a donde lo mandamos
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
            
            function editar(id){
                var parametros = {
                        "ID": id
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/editarUser.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            swal({
                                title: '<?php echo $USERS_edit;?>',
                                width: 800,
                                html: response,
                                confirmButtonText: '<?php echo $OK;?>',
                                showCancelButton: true,
                                cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>',
                                closeOnConfirm: false,
                                allowEscapeKey: true,
                                allowOutsideClick: true
                            }).then(function(isConfirm) {
                                if (isConfirm) {
                                    updateUser(id,$("#name").val(),$("#surname").val(),$("#email").val(),$("#tlf").val(),$("#department").val(),$("#type").val(),$("#user_name").val());
                                }
                                swal.close();
                            });
                            $("#name").select();
                            $(".register input").focus(function(){
                                this.select();
                            }); 
                            
                            $(".register input").bind("keydown",function(e){
                                if (e.keyCode==13){
                                    updateUser(id,$("#name").val(),$("#surname").val(),$("#email").val(),$("#tlf").val(),$("#department").val(),$("#type").val(),$("#user_name").val());
                                }     
                            });
                        }
                });
            }
            
            function updatePass(id,pass){
                var parametros = {
                        "ID": id,
                        "PASS": pass
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/updatePass.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                           swal('<?php echo $USERS_congratulation;?>','<?php echo $USERS_changed_pass;?>','success');
                        }
                });
            }
            
            function validatePass(id,pass){
                if(pass.length < 8){
                    swal("<?php echo $DEPENDENCIES_error;?>",'<?php echo $REGISTER_ERROR_passwords1;?>','error').then(function(){cambiarPass(id);});
                }else{
                    updatePass(id,hex_md5(pass));
                    swal.enableLoading();
                }
            }
            
            function cambiarPass(id){
                swal({
                    title: '<?php echo $USERS_change_pass;?>',
                    html: '<input type="password" class="input-field" id="new_pass">',
                    confirmButtonText: '<?php echo $OK;?>',
                    showCancelButton: true,
                    cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>',
                    closeOnConfirm: false,
                    allowEscapeKey: true,
                    allowOutsideClick: true
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        validatePass(id,$('#new_pass').val());
                    }else{
                        swal.close();
                    }
                });
            }
        </script>
        <table class="buscador" style='text-align: left;'>
            <tr style='margin-left: 5px;'>
                <td> <?php echo $USERS_search_name;?> </td>
                <td> 
                    <input class="input-field2" id='porNombre' type="text" name="txt" value="" onchange='update($("#porNombre").val(), $("#porDepartamento").val(), $("#porCorreo").val(), $("#porTipo").val());' onClick="this.select();"/>
                </td>
                <td> <?php echo $USERS_search_department;?> </td>
                <td> 
                    <input class="input-field2" id='porDepartamento' type="text" name="txt" value="" onchange='update($("#porNombre").val(), $("#porDepartamento").val(), $("#porCorreo").val(), $("#porTipo").val());' onClick="this.select();"/>
                </td>
            </tr>
            <tr style='margin-left: 5px;'>
                <td> <?php echo $USERS_search_mail;?> </td>
                <td>
                    <input class="input-field2" id='porCorreo' type="text" name="txt" value="" onchange='update($("#porNombre").val(), $("#porDepartamento").val(), $("#porCorreo").val(), $("#porTipo").val());' onClick="this.select();"/>
                </td>
                <td> <?php echo $USERS_search_type;?> </td>
                <td>
                    <select id="porTipo" onchange='update($("#porNombre").val(), $("#porDepartamento").val(), $("#porCorreo").val(), $("#porTipo").val());'>
                        <option value=''> <?php echo $USERS_any;?> </option>
                        <option value='NORMAL'> <?php echo $USERS_normal;?> </option>
                        <option value='TECHNICAL'> <?php echo $USERS_technical;?> </option>
                        <option value='SPECIAL'> <?php echo $USERS_special;?> </option>
                        <option value='ADMIN'> <?php echo $USERS_admin;?> </option>
                    </select>
                </td>
            </tr>
        </table>
        <script>
            function reset(){
                update('','','','');
            }
        </script>
        <input type="button" class="simple-button" onclick="reset();" value="<?php echo $reset_form;?>">
        <br>
        <br>
        <h2> <?php echo $USERS_unvalidated;?> </h2>
        <?php
            $result = $db->query("SELECT U.ID ID_USUARIO, U.NOMBRE NOMBRE_USUARIO, U.APELLIDOS APELLIDOS_USUARIO, U.EMAIL EMAIL_USUARIO, U.TLF TLF_USUARIO, U.TIPO TIPO_USUARIO, D.NOMBRE NOMBRE_DEPARTAMENTO FROM USUARIO U INNER JOIN DEPARTAMENTO D ON U.id_departamento=D.id where U.VALIDO=0 and CONCAT(U.NOMBRE,' ',U.APELLIDOS) LIKE '%".$_POST['NOMBRE_USUARIO']."%' and U.EMAIL LIKE '%".$_POST['EMAIL_USUARIO']."%' and U.TIPO LIKE '%".$_POST['TIPO_USUARIO']."%' and D.NOMBRE LIKE '%".$_POST['NOMBRE_DEPARTAMENTO']."%';");
            if($result->num_rows>0){  
        ?>  
            <table>
                <tr class="top">
                    <td><?php echo $USERS_name;?></td>
                    <td><?php echo $USERS_department;?></td>
                    <td>EMAIL</td>
                    <td>TLF</td>
                    <td class="empty"></td>
                    <td class="empty"></td>
                </tr>
            <?php   
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                            <td><?php echo $row['NOMBRE_USUARIO']." ".$row['APELLIDOS_USUARIO'];?></td>
                            <td><?php echo $row['NOMBRE_DEPARTAMENTO'];?></td>
                            <td><?php echo $row['EMAIL_USUARIO'];?></td>
                            <td><?php echo $row['TLF_USUARIO'];?></td>
                            <td onclick="deleteUser(<?php echo $row['ID_USUARIO'];?>);" class="X">X</td>
                            <td onclick="validate(<?php echo $row['ID_USUARIO'];?>);" class="editar"><?php echo $USERS_validar;?></td>
                        </tr>    
                    <?php
                }
            ?>
            </table>
        <?php
            }else {
                ?>
                <p> <?php echo $USERS_users_unvalidated;?> </p>
                <?php
            }
        ?>
        <h2> <?php echo $USERS_validated;?> </h2>
        <?php
            $result = $db->query("SELECT U.ID ID_USUARIO, U.NOMBRE NOMBRE_USUARIO, U.APELLIDOS APELLIDOS_USUARIO, U.EMAIL EMAIL_USUARIO, U.TLF TLF_USUARIO, U.TIPO TIPO_USUARIO, D.NOMBRE NOMBRE_DEPARTAMENTO, U.USER USER FROM USUARIO U INNER JOIN DEPARTAMENTO D ON U.id_departamento=D.id where U.VALIDO=1 and CONCAT(U.NOMBRE,' ',U.APELLIDOS) LIKE '%".$_POST['NOMBRE_USUARIO']."%' and U.EMAIL LIKE '%".$_POST['EMAIL_USUARIO']."%' and U.TIPO LIKE '%".$_POST['TIPO_USUARIO']."%' and D.NOMBRE LIKE '%".$_POST['NOMBRE_DEPARTAMENTO']."%';");
            if($result->num_rows>0){  
        ?>
            <table>
                <tr class="top">
                    <td><?php echo $USERS_name;?></td>
                    <td><?php echo $USERS_department;?></td>
                    <td>EMAIL</td>
                    <td class="empty"></td>
                    <td class="empty"></td>
                    <td class="empty"></td>
                </tr>
            <?php   
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                            <td><?php echo $row['NOMBRE_USUARIO']." ".$row['APELLIDOS_USUARIO'];?></td>
                            <td style="text-align: center;"><?php echo $row['NOMBRE_DEPARTAMENTO'];?></td>
                            <td><?php echo $row['EMAIL_USUARIO'];?></td>
                            <td onclick="deleteUser(<?php echo $row['ID_USUARIO'];?>);" class="X">X</td>
                            <td style="font-size: 10px;" onclick="editar(<?php echo $row['ID_USUARIO'];?>);" class="editar"><?php echo $USERS_editar;?></td>
                            <?php if ($row['USER']!=$admin_user){?>
                                <td style="font-size: 10px;" onclick="cambiarPass(<?php echo $row['ID_USUARIO'];?>);" class="editar"><?php echo $USERS_change_pass;?></td>
                            <?php }else{ ?>
                                <td class="empty"></td>
                            <?php } ?>
                        </tr>    
                    <?php
                }
            ?>
            </table>
        <?php
            }else {
                ?>
                <p> <?php echo $USERS_users_validated;?> </p>
                <?php
            }
        ?>
    </div>
<!-- </section> -->    
<?php
    require('../layouts/footer.php');
?>