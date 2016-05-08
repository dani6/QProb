<?php 
    require('../layouts/header.php');
?>
<!-- <section> -->
    <style type="text/css" scoped>
        @import url("../css/pages/login.css");
    </style>   
    
    <script>
        function login(user,password){
            var parametros = {
                    "user": user,
                    "pass": hex_md5(password)
            };
            
            $.ajax({
                    data:  parametros, //Datos que mandamos
                    url:   '../php/scripts/login.php', //Direccion a donde lo mandamos
                    type:  'post', 
                    
                    //Antes del envío se produce...:
                    beforeSend: function () {
                            // No hacemos nada
                    },
                    
                    //Despues del envio se produce...:
                    success:  function (response) {
                        if(response==1){
                            window.location="index.html";
                        }else{
                            swal({
                                title: '<?php echo $login_error;?>',
                                text: '<?php echo $login_error_message;?>',
                                type: 'error',
                                showCancelButton: true,
                                closeOnConfirm: true,
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                confirmButtonText: 'Try again',
                                confirmButtonColor: '#d33'
                                });
                        }
                    }
            });
        }
            
        var keycombo = "";	
        $(document).keypress(function(e) 
        {
            try	
            {	
                keycombo += e.keyCode+"";
                if(keycombo==10811110310511013) // login /Enter/
                {		
                    keycombo = "";	 	
                    showLogin();
                }else if (e.keyCode==13){
                    keycombo="";
                } 
            }catch(e){}
        });	
        
        function notaccess(){
            swal({
                title: '<?php echo $cannot_access2;?>',
                text: '<?php echo $contact_with_administrator;?>',
                type: 'info'
            });
        }
    </script>
    <div id="title-login">
        <h1><span>Q</span>Prob</h1>
        <p id="org"><?php echo $organization;?></p>
        <p><?php echo $description;?></p>
    </div>
    <div id="login">
        <h1><?php echo $welcome;?></h1>
        <table>
            <tr>
                <td class="input-text"><?php echo $user_text;?></td>
                <td colspan="2"><input class="input-field2" id="user2" value=""></input></td>
            </tr>
            <tr>
                <td class="input-text"><?php echo $password_text; ?></td>
                <td colspan="2"><input class="input-field2" id="pass2" type="password" value=""></input></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><?php echo $register;?></td>
            </tr>
            <tr>
                <td></td>
                <td><p class="button-login" onclick="login($('#user2').val(),$('#pass2').val());"><?php echo $enter;?></p></td>
                <td><?php echo $cannot_access;?></td>
            </tr>
        </table>
        <script>
            // Funcion para el evento de presionar enter.
            function showSweet2(e){
                if (e.keyCode==13){
                    login($('#user2').val(),$('#pass2').val());
                }     
            }
            
            $("#user2").bind("keydown",showSweet2);
            $("#pass2").bind("keydown",showSweet2);
            
            function validateNumber(){
                if(!($('#tlf').val()>=0&&$('#tlf').val()<=999999999)){
                    if($('#tlf').val()>999999999){
                        $('#tlf').val(Math.floor($('#tlf').val()/10));
                    }else{
                        $('#tlf').val('');
                    }
                }
            }
            
            function errorRegister(msg,name,surname,email,tlf,department,user){
                swal({
                    title: 'Error',
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
                        showRegister(name,surname,email,tlf,department,user);
                    });
            }
            
            var control = "";
            // Validate the register form
            function validar(name,surname,email,tlf,department,user,pass,confirmpass,response){
                if( name == null || name.length == 0 || /^\s+$/.test(name) ) {
                  errorRegister("<?php echo $REGISTER_ERROR_name;?>",name,surname,email,tlf,department,user);
                  control="name";
                  return false;
                }
                
                if( surname == null || surname.length == 0 || /^\s+$/.test(surname) ) {
                  errorRegister("<?php echo $REGISTER_ERROR_surname;?>",name,surname,email,tlf,department,user);
                  control="surname";
                  return false;
                }
                
                expr=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if( !expr.test(email) ) {
                   errorRegister("<?php echo $REGISTER_ERROR_email;?>",name,surname,email,tlf,department,user);
                   control="email";
                   return false;
                }
                
                if( !(/^\d{9}$/.test(tlf)) ) {
                   errorRegister("<?php echo $REGISTER_ERROR_tlf;?>",name,surname,email,tlf,department,user);
                   control="tlf";
                   return false;
                }

                if( user==null || user.length == 0 || response==0){
                    errorRegister("<?php echo $REGISTER_ERROR_user;?>",name,surname,email,tlf,department,user);
                    control="user";
                    return false;
                }
                
                if( pass == null || pass.length < 8) {
                    errorRegister("<?php echo $REGISTER_ERROR_passwords1;?>",name,surname,email,tlf,department,user);
                    control="pass";
                    return false;
                }else if(pass!=confirmpass){
                    errorRegister("<?php echo $REGISTER_ERROR_passwords2;?>",name,surname,email,tlf,department,user);
                    control="pass";
                    return false;
                }
                
                return true;
            }
            
            function check(name,surname,email,tlf,department,user,pass,confirmpass){
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
                           if(validar(name,surname,email,tlf,department,user,pass,confirmpass,response)){
                                register(name,surname,email,tlf,department,user,pass);       
                           }
                        }
                });
            }
            
            function register(name,surname,email,tlf,department,user,pass){
                var parametros = {
                    "name": name,
                    "surname": surname,
                    "email": email,
                    "tlf": tlf,
                    "department": department,
                    "user": user,
                    "pass": hex_md5(pass)
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
                                });
                           }else{
                                errorRegister(response,name,surname,email,tlf,department,user);
                                control="email";
                           }
                           $(".register input").bind("keydown",null);
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
                    check($('#name').val(),$('#surname').val(),$('#email').val(),$('#tlf').val(),$('#department').val(),$('#Ruser').val(),$('#Rpass').val(),$('#Rpassconfirm').val());
                }, 200);
            }
                    
            // Funcion para el evento de presionar enter.
            function showSweetCheck(e){
                if (e.keyCode==13){
                    loading_check();
                }     
            }
            
            // Show the register window.
            function showRegister(name,surname,email,tlf,department,user){
                swal({
                title: '<?php echo $signup;?>',
                width: 800,
                html: '<center><table class="register"><tr><td><?php echo $name;?></td><td><input value="'+name+'" class="input-field2" maxlength="20" id="name"></td>'
                    +'<td><?php echo $surname;?></td><td><input value="'+surname+'" class="input-field2" maxlength="20" id="surname"></td></tr>'
                    +'<tr><td><?php echo $email;?></td><td><input value="'+email+'" class="input-field2" maxlength="30" id="email"></td>'
                    +'<td><?php echo $tlf;?></td><td><input value="'+tlf+'" onkeyup="validateNumber();" type="number" class="input-field2" min="0" max="999999999" id="tlf"></tr>'
                    +'<tr><td><?php echo $department;?></td><td colspan="3"><select style="width: 100%;"class="input-field2" maxlength="20" id="department"><?php echo $valor_departamento;?></select></td></tr></table>'
                    +'<table class="register"><tr><td></td><td><?php echo $user_text.":";?></td><td><input value="'+user+'" class="input-field2" maxlength="50" id="Ruser"></td><td></td></tr>'
                    +'<tr><td></td><td><?php echo $password_text.":";?></td><td><input class="input-field2" id="Rpass" type="password" value=""></td><td></td></tr>'
                    +'<tr><td></td><td><?php echo $confirm_password;?></td><td><input class="input-field2" id="Rpassconfirm" type="password" value=""></td><td></td></tr>'
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
                $(".register input").bind("keydown",showSweetCheck);
                
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
            }
            
            $("input").focus(function(){
                this.select();
            });
        </script>
    </div>
        
<!-- </section> -->    
<?php
    require('../layouts/footer.php');