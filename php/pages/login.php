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
                                confirmButtonColor: '#d33',
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
        <h1>Welcome to QProb!</h1>
        <table>
            <tr>
                <td><?php echo $user_text;?></td>
                <td colspan="2"><input class="input-field2" id="user2" value=""></input></td>
            </tr>
            <tr>
                <td><?php echo $password_text; ?></td>
                <td colspan="2"><input class="input-field2" id="pass2" type="password" value=""></input></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><?php echo $register;?></td>
            </tr>
            <tr>
                <td></td>
                <td><p class="button-login" onclick="login($('#user2').val(),$('#pass2').val());">Entrar</p></td>
                <td><?php echo $cannot_access;?></td>
            </tr>
        </table>
        <script>
            $("#user2").focus(function(){
                this.select();
            });
            
            $("#pass2").focus(function(){
                this.select();
            });
                    
            // Funcion para el evento de presionar enter.
            function showSweet2(e){
                if (e.keyCode==13){
                    login($('#user2').val(),$('#pass2').val());
                }     
            }
            
            $("#user2").bind("keydown",showSweet2);
            $("#pass2").bind("keydown",showSweet2);
        </script>
    </div>
        
<!-- </section> -->    
<?php
    require('../layouts/footer.php');