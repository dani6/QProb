<div id="logo" onclick="window.location='index.html';">
    <h1><span>Q</span>Prob</h1>
</div>
<div class="toolbar">
<?php
    if($filename!="login"){
    // User menú
?>
    <script>
        var keycombo = "";	
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
        });
    </script>
    <div class="element_toolbar special" onclick="">
        <p><?php echo $addincident;?></p>
    </div> 
    <div class="element_toolbar" onclick="">
        <p><?php echo $maintenance;?></p>
         <div class="sub_toolbar">
            <div class="element_sub_toolbar" onclick="window.location='dependencies.html'"> 
                <p><?php echo $dependencies; ?></p> 
            </div>
            <div class="element_sub_toolbar"> 
                <p><?php echo $categories; ?></p> 
            </div>
            <div class="element_sub_toolbar" 
                style="
                    border-top: 1px solid rgba(0,0,0,0.2);
                    "
                onclick=""
                    > 
                <p><?php echo $incidences; ?></p>
                <div class="sub_sub_toolbar">
                    <div class="element_sub_sub_toolbar" > 
                        <p><?php echo $incidences_in_progress; ?></p> 
                    </div>
                    <div class="element_sub_sub_toolbar">  
                        <p><?php echo $incidences_open; ?></p> 
                    </div>
                    <div class="element_sub_sub_toolbar"> 
                        <p><?php echo $incidences_resolved; ?></p> 
                    </div>
                </div>
            </div>
            <div class="element_sub_toolbar"> 
                <p><?php echo $users; ?></p> 
            </div>
             <div class="element_sub_toolbar" 
                style="
                    border-top: 1px solid rgba(0,0,0,0.2);
                    "
                onclick=""
                    >  
                <p><?php echo $reset; ?></p> 
            </div>
        </div>
    </div>     
    <div class="element_toolbar">
        <p><?php echo $user; ?></p>
        <div class="sub_toolbar">
            <div class="element_sub_toolbar" > 
                <p><?php echo $your_incidences; ?></p>
                <div class="sub_sub_toolbar">
                    <div class="element_sub_sub_toolbar" > 
                        <p><?php echo $incidences_in_progress; ?></p> 
                    </div>
                    <div class="element_sub_sub_toolbar">  
                        <p><?php echo $incidences_open; ?></p> 
                    </div>
                    <div class="element_sub_sub_toolbar"> 
                        <p><?php echo $incidences_resolved; ?></p> 
                    </div>
                </div>
            </div>
             <div class="element_sub_toolbar" 
                style="
                    border-top: 1px solid rgba(0,0,0,0.2);
                    "
                onclick=""
                    >  
                <p><?php echo $profile; ?></p> 
            </div>
            <div class="element_sub_toolbar"> 
                <p><?php echo $manage_account; ?></p> 
            </div>
            
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
                html: '<p><input class="input-field" id="user" value="<?php echo $user_text; ?>">'
                    +'<p><input class="input-field" id="pass" type="password" value="<?php echo $password_text; ?>"><p id="void"></p>',        
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
    <div class="element_toolbar" onclick="showLogin();">
        <p><?php echo $login;?></p>
    </div>
    <div class="element_toolbar special" onclick="showRegister('','','','','','');">
        <p><?php echo $signup;?></p>
    </div>
<?php
    }
?>
    <div class="element_toolbar">
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
