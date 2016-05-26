<div id="logo" onclick="window.location='index.html';">
    <h1><span>Q</span>Prob</h1>
</div>

<div class="toolbar">
<?php
    if($filename!="login"){
    // User menú
?>
    <script>
        /*var keycombo = "";	
        $(document).keypress(function(e) 
        {
            try	
            {	
                keycombo += e.keyCode+"";
                if(keycombo==9910811111510113) // Close /Enter/
                {		
                    keycombo = "";	 	
                    logout();
                }else if (e.keyCode==13){
                    keycombo="";
                } 
            }catch(e){}
        });*/
    </script>
    <div id="menu_bar">&#9776;</div> 
    <nav>
        <ul>
            <?php if($_SESSION['type']=="ADMIN" || $_SESSION['type']=="TECHNICAL") {?>
            <li onclick="window.location='incidences.html'"><a>Incidencias</a></li>   
            <li onclick="window.location='users.html'"><a>Usuarios</a></li>
            
            <li onclick="window.location='dependencies.html'"><a>Dependencias</a></li>
            <li onclick="window.location='categories.html'"><a>Categorías</a></li>
            <?php } ?>
            
            <li onclick="window.location='yours_incidences.html'"><a>Tus incidencias</a></li>
            <li onclick="perfil(<?php echo $_SESSION['id'];?>);"><a>Perfil</a></li>
            <li onclick="editar_User(<?php echo $_SESSION['id'];?>)"><a>Gestionar cuenta</a></li>
            
            <?php if($_SESSION['type']=="ADMIN") {?>
            <li onclick="validarAdmin(<?php echo $_SESSION['id'];?>);" class="reset"><a>Resetear incidencias</a></li>
            <?php } ?>
            <li class="cerrar" onclick="logout()"><a>Cerrar sesión</a></li>
        </ul>
    </nav>
    
    
    <div id="element_toolbar2" style="margin-right: 40px">
        <input id="searcher" class="buscador" type="text" placeHolder="Search">
        <div class="sub_toolbar"></div>
    </div>
    <script>
        $("#searcher").change(function(){
            if($("#searcher").val()==""){
                $("#element_toolbar2 .sub_toolbar").hide();
            }else{
                var parametros = {
                    "TEXT": $("#searcher").val()
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/searcher.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            if(response != 0){
                                $("#element_toolbar2 .sub_toolbar").html(response);  
                            }else{
                                $("#element_toolbar2 .sub_toolbar").html('<div class="element_sub_toolbar"> No se han encontrado resultados.</div>');  
                            }
                            $("#element_toolbar2 .sub_toolbar").show();
                        }
                });
            }
        });
        
        $("#searcher").focus(function(){
            this.select();
        });
    </script>
    <div class="element_toolbar special" onclick="addIncidence('','','','','','','','','');">
        <p><?php echo $addincident;?></p>
    </div> 
    <?php if ($_SESSION['type']=="ADMIN" || $_SESSION['type']=="TECHNICAL") { ?>
    <div class="element_toolbar" onclick="">
        <p><?php echo $maintenance;?></p>
         <div class="sub_toolbar">
             <div class="element_sub_toolbar"> 
                <p onclick="window.location='incidences.html'"><?php echo $incidences; ?></p>
                <div class="sub_sub_toolbar">
                    <div class="element_sub_sub_toolbar" onclick="window.location='in_progress.html'"> 
                        <p><?php echo $incidences_in_progress; ?></p> 
                    </div>
                    <div class="element_sub_sub_toolbar" onclick="window.location='open.html'">  
                        <p><?php echo $incidences_open; ?></p> 
                    </div>
                    <div class="element_sub_sub_toolbar" onclick="window.location='resolved.html'"> 
                        <p><?php echo $incidences_resolved; ?></p> 
                    </div>
                </div>
            </div>
            <div class="element_sub_toolbar" onclick="window.location='users.html'"> 
                <p><?php echo $users; ?></p> 
            </div>
            <div class="element_sub_toolbar" onclick="window.location='dependencies.html'"
                style="
                    border-top: 1px solid rgba(0,0,0,0.2);
                    "> 
                <p><?php echo $dependencies; ?></p> 
            </div>
            <div class="element_sub_toolbar" onclick="window.location='categories.html'"> 
                <p><?php echo $categories; ?></p> 
            </div>
            
            <?php if ($_SESSION['type']=="ADMIN"){ ?>
             <script>
                function borrarIncidencias(){
                     var parametros = {
                     };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/borrarIncidencias.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                swal(
                                    '<?php echo $DEPENDENCIES_delete;?>',
                                    'Las incidencias han sido eliminada',
                                    'success'
                                ).then(function(){
                                    window.location='index.html';
                                });
                            }
                    });
                }
                 
                 function validatePass_Admin(id,pass){
                    var parametros = {
                            "ID": id,
                            "PASS": hex_md5(pass)
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/confirmarPassword.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                if(response==1){
                                    swal({
                                        title: '<?php echo $DEPENDENCIES_confirm;?>',
                                        text: "<?php echo $DEPENDENCIES_warning;?>. <?php echo $pdf;?>",
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: '<?php echo $delete;?>'
                                    }).then(function(isConfirm) {
                                        if (isConfirm) {
                                            borrarIncidencias();
                                        }
                                    });
                                }
                                else{ swal('ERROR','<?php echo $USERS_error_confirm_pass;?>','error'); }
                                $('#your_pass2').bind("keydown",null);
                            }
                    });
                }
                
                function validarAdmin(id){
                    swal({
                        title: '<?php echo $USERS_confirm_pass;?>',
                        html: '<center><table class="register"><tr><td><?php echo $password_text;?>:</td><td><input type="password" class="input-field" id="your_pass3"></td></tr></table></center>',
                        confirmButtonText: '<?php echo $OK;?>',
                        showCancelButton: true,
                        cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>',
                        closeOnConfirm: false,
                        allowEscapeKey: true,
                        allowOutsideClick: true
                    }).then(function(isConfirm) {
                        if(isConfirm){
                            validatePass_Admin(id,$('#your_pass3').val());
                         }
                    });
                    
                    $('#your_pass3').bind("keydown",function(e){
                        if (e.keyCode==13){
                            validatePass_Admin(id,$('#your_pass3').val());
                        }   
                    });
                }
            </script>
             <div class="element_sub_toolbar" 
                style="
                    border-top: 1px solid rgba(0,0,0,0.2);
                    "
                onclick="validarAdmin(<?php echo $_SESSION['id'];?>);"
                    >  
                <p><?php echo $reset; ?></p> 
            </div>
            
            <?php } ?>
        </div>
    </div>  
    <?php } ?>   
    <div class="element_toolbar">
        <p><?php echo $user; ?></p>
        <div class="sub_toolbar">
            <div class="element_sub_toolbar"> 
                <p onclick="window.location='yours_incidences.html'"><?php echo $your_incidences; ?></p>
                <div class="sub_sub_toolbar" style="margin-top:-37px;">
                    <div class="element_sub_sub_toolbar" onclick="window.location='yours_incidences_in_progress.html'"> 
                        <p><?php echo $incidences_in_progress; ?></p> 
                    </div> 
                    <div class="element_sub_sub_toolbar" onclick="window.location='yours_incidences_open.html'">  
                        <p><?php echo $incidences_open; ?></p> 
                    </div>
                    <div class="element_sub_sub_toolbar" onclick="window.location='yours_incidences_resolved.html'"> 
                        <p><?php echo $incidences_resolved; ?></p> 
                    </div>
                </div>
            </div>
            <script>
                function perfil(id){
                    var parametros = {
                            "ID": id
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/perfil.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                swal({
                                    html: response
                                });
                            }
                    });
                }
            </script>
             <div class="element_sub_toolbar" 
                style="
                    border-top: 1px solid rgba(0,0,0,0.2);
                    "
                onclick="perfil(<?php echo $_SESSION['id'];?>);"
                    >  
                <p><?php echo $profile; ?></p> 
            </div>
            <script>
                function update_User(id,name,surname,email,tlf,department,user){
                    var parametros = {
                            "ID": id,
                            "NOMBRE": name,
                            "APELLIDOS": surname,
                            "EMAIL": email,
                            "TLF": tlf,
                            "DEPARTAMENTO": department,
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
                                //window.location="<?php echo $filename;?>.html";
                                location.reload(true);
                            }
                    });
                }
                
                function editar_User(id){
                    var parametros = {
                            "ID": id
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/editarUser2.php', //Direccion a donde lo mandamos
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
                                        update_User(id,$("#name").val(),$("#surname").val(),$("#email").val(),$("#tlf").val(),$("#department").val(),$("#user_name").val());
                                    }
                                    swal.close();
                                });
                                $("#name").select();
                                $(".register input").focus(function(){
                                    this.select();
                                }); 
                                
                                $(".register input").bind("keydown",function(e){
                                    if (e.keyCode==13){
                                        update_User(id,$("#name").val(),$("#surname").val(),$("#email").val(),$("#tlf").val(),$("#department").val(),$("#user_name").val());
                                    }     
                                });
                            }
                    });
                }
            </script>
            <div class="element_sub_toolbar" onclick="editar_User(<?php echo $_SESSION['id'];?>)">
                <p><?php echo $manage_account; ?></p> 
            </div>
            <script>
                function updatePass2(id,pass){
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
                                alert(response);
                                swal('<?php echo $USERS_congratulation;?>','<?php echo $USERS_changed_pass;?>','success');
                            }
                    });
                }
                
                function validatePass2(id,pass,confirm){
                    if(pass.length < 8){
                        swal('<?php echo $DEPENDENCIES_error;?>','<?php echo $REGISTER_ERROR_passwords1;?>','error').then(function(){cambiarPass2(id);});
                    }else if(pass!=confirm){
                        swal('<?php echo $DEPENDENCIES_error;?>','<?php echo $REGISTER_ERROR_passwords2;?>','error').then(function(){cambiarPass2(id);});
                    }else{
                        updatePass2(id,hex_md5(pass));
                        swal.enableLoading();
                    }
                }
                
                function cambiarPass2(id){
                    swal({
                        title: '<?php echo $USERS_change_pass;?>',
                        html: '<center><table class="register"><tr><td><?php echo $password_text;?>:</td><td><input type="password" class="input-field" id="new_pass2"></td><tr><td><?php echo $confirm_password;?></td><td><input type="password" class="input-field" id="confirm_new_pass2"></td></tr></table></center>',
                        confirmButtonText: '<?php echo $OK;?>',
                        showCancelButton: true,
                        cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>',
                        closeOnConfirm: false,
                        allowEscapeKey: true,
                        allowOutsideClick: true
                    }).then(function(isConfirm) {
                        if(isConfirm){ 
                            validatePass2(id,$('#new_pass2').val(),$('#confirm_new_pass2').val());
                        }
                    });
                }
                
                function validatePass_User2(id,pass){
                    var parametros = {
                            "ID": id,
                            "PASS": hex_md5(pass)
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/confirmarPassword.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                if(response==1){
                                    swal({
                                        title: '<?php echo $DEPENDENCIES_confirm;?>',
                                        text: "<?php echo $DEPENDENCIES_warning;?>",
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: '<?php echo $INCIDENCIES_delete_all;?>'
                                    }).then(function(isConfirm) {
                                        if (isConfirm) {
                                            borrarIncidencias();
                                        }
                                    });
                                }
                                else{ swal('ERROR','<?php echo $USERS_error_confirm_pass;?>','error');}
                                $('#your_pass2').bind("keydown",null);
                            }
                    });
                }
                
                function validarUsuario(id){
                    swal({
                        title: '<?php echo $USERS_confirm_pass;?>',
                        html: '<center><table class="register"><tr><td><?php echo $password_text;?>:</td><td><input type="password" class="input-field" id="your_pass2"></td></tr></table></center>',
                        confirmButtonText: '<?php echo $OK;?>',
                        showCancelButton: true,
                        cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>',
                        closeOnConfirm: false,
                        allowEscapeKey: true,
                        allowOutsideClick: true
                    }).then(function(isConfirm) {
                        if(isConfirm){
                            validatePass_User2(id,$('#your_pass2').val());
                         }
                    });
                    
                    $('#your_pass2').bind("keydown",function(e){
                        if (e.keyCode==13){
                            validatePass_User2(id,$('#your_pass2').val());
                        }   
                    });
                }
            </script>
            <?php if ($_SESSION['user']!=$admin_user){?>
                <div class="element_sub_toolbar" onclick="validarUsuario(<?php echo $_SESSION['id'];?>);">
                    <p><?php echo $USERS_change_pass; ?></p> 
                </div>
            <?php } ?>
            <div class="element_sub_toolbar" 
                style="
                    text-align: right;
                    border-top: 1px solid rgba(0,0,0,0.2);
                    "
                onclick="logout()"
                    > 
                <p><?php echo $logout; ?></p> 
            </div>
        </div>
    </div>
<?php
    }else{
        // Log In menu
?>
        <!--JS scripts used to log in-->
    <script>
        // Función para hacer la llamada a login.
        function loading(){
            swal.enableLoading();
            setTimeout(function() {
                login($('#user').val(),$('#pass').val());
            }, 200);
        }
                
        // Funcion para el evento de presionar enter.
        function showSweet(e){
            if (e.keyCode==13){
                loading();
            }     
        }
        
        /**
        * Show a modal window to log in.
        **/
        function showLogin(){
               swal({
                title: '<?php echo $login;?>',
                html: '<p><input class="input-field" id="user" placeholder="<?php echo $user_text; ?>">'
                    +'<p><input class="input-field" id="pass" type="password" placeholder="<?php echo $password_text; ?>"><p id="void"></p>',        
                confirmButtonText: '<?php echo $login_OK;?>',
                showCancelButton: true,
                cancelButtonText: '<?php echo $login_CANCEL;?>',
                closeOnConfirm: false,
                allowEscapeKey: false,
                allowOutsideClick: true
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        loading();
                    }
                });
                
                $("#user").select();
                $("#user").focus(function(){
                    this.select();
                });
                
                $("#pass").focus(function(){
                    this.select();
                });
                
                
                $("#user").bind("keydown",showSweet);
                $("#pass").bind("keydown",showSweet);
            } 
    </script>
    <div class="element_toolbar no-responsive" onclick="showLogin();">
        <p><?php echo $login;?></p>
    </div>
    <div class="element_toolbar special" onclick="showRegister('','','','','','');">
        <p><?php echo $signup;?></p>
    </div>
<?php
    }
?>
    <div id="language" class="element_toolbar">
        <img style="float:left;margin-top:2px;" src="../resources/images/<?php echo $_SESSION['language']; ?>.png" height="15px"/>
        <p><?php echo $_SESSION['language']; ?></p>
        <div class="sub_toolbar">
            <div class="element_sub_toolbar" onclick="cambiarIdioma('ES');"> 
                <img class="language" src="../resources/images/ES.png" height="15px"/>
                <p><?php echo $spanish; ?></p> 
            </div>
            <div class="element_sub_toolbar" onclick="cambiarIdioma('EN');"> 
                <img class="language" src="../resources/images/EN.png" height="15px"/>
                <p><?php echo $english; ?></p> 
            </div>
        </div>
    </div>
</div>
