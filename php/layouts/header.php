<?php
    // Call a script to start the session.
    require('../layouts/session.php');    
?>
<html>
    <head>
        <title>QProb</title>
        <meta charset="UTF-8"/>
        
        <!-- Links to CSS files -->
            <!-- General Design -->
        <link rel="stylesheet" href="../css/design.css" type="text/css"/>
            <!-- Stylesheet for text fonts -->
        <link rel="stylesheet" href="../css/fonts.css" type="text/css"/>
            <!-- Stylesheet for SweetAlet library -->
        <link rel="stylesheet" href="../css/sweetalert2.min.css" type="text/css" >
        
        <!-- Links to JS files -->
            <!-- SweetAlert Library -->
        <script src="../js/sweetalert2.min.js"></script>
            <!-- JQuery Library -->
        <script type="text/javascript" src="../js/jQuery.js"></script>
            <!-- MD5 Library -->
        <script type="text/javascript" src="../js/md5.js"></script>
            <!-- Slider Library -->
        <script type="text/javascript" src="../js/coin-slider.min.js"></script>
        
        <!-- Functions -->
        
        <!-- NOTA: TRADUCIR CÓDIGO -->
        <script>
            /*
            *   Función AJAX que llama al script cambiarIdioma.php 
            *
            *   Pasandole como parametros el selected_language, que será 
            *   asignado a la variable $_SESSION['language'].
            *
            */
            function cambiarIdioma(selected_language){
                    var parametros = {
                            language: selected_language
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/cambiarIdioma.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                // Reload
                                window.location="../html/<?php echo ($filename=="login")?"index":$filename;?>.html";
                            }
                    });
                }
                
                /** 
                COMENTAR FUNCION
                **/
                function logout(){
                    var parametros = {
                            
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/logout.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                // Reload
                                window.location="../html/index.html";
                            }
                    });
                }
                
                /*var keycombo = "";	
                $(document).keypress(function(e) 
                {
                    
                    try	
                    {	
                        keycombo += e.keyCode+"";
                        if(keycombo==108111103105110) // 108111103105110 is "login"
                        {		
                                keycombo = "";	 	
                                showLogin();
                                
                        }else if (e.keyCode==13){
                                keycombo="";
                        } 
                    }catch(e){}
                });*/
        </script>
    </head>
    <body>
        
        <header>
            <!-- 
                Header content:
                    
                    - Horizontal and vertical menu.
                    - Ads
                    - PHP content to control sessions
            -->
            <?php require('../layouts/menu.php'); ?>
        </header>
        
        <section>

            <!-- Page Content -->