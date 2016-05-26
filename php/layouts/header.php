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
        <script type="text/javascript" src="../js/responsiveslides.min.js"></script>
            <!-- Notify.js Library -->
        <script type="text/javascript" src="../js/notify.min.js"></script>
            <!-- Chart -->
        <script type="text/javascript" src="../js/Chart.js"></script>
        
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
                                // window.location="../html/<?php echo ($filename=="login")?"index":$filename;?>.html";
                                location.reload(true);
                            }
                    });
                }
                
                /** 
                Log out function
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
                
                function addIncidence2(categoria,titulo,descripcion,tipo,edificio,planta,aula){
                    var parametros = {
                        "CATEGORIA": categoria,
                        "TITULO": titulo,
                        "DESCRIPCION": descripcion,
                        "TIPO": tipo,
                        "EDIFICIO": edificio,
                        "PLANTA": planta,
                        "AULA": aula
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/addIncidence.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                if (response != ""){
                                    swal('ERROR','<?php echo $INCIDENCIES_missing_field;?>','error').then(function(){
                                        addIncidence(categoria,titulo,descripcion,tipo);
                                    });
                                }else{
                                    //window.location="<?php echo $filename;?>.html";
                                    swal('Incidencia añadida','Se ha añadido la incidencia correctamente','success').then(function(){
                                        location.reload(true);
                                    });
                                }
                            }
                    });
                }
                
                function updateFloor(edificio){
                    var parametros = {
                        "EDIFICIO": edificio
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/floors.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                $("#plantatd").html(response);
                                updateClass(0);
                            }
                    });
                }
                
                function updateClass(planta){
                    var parametros = {
                        "PLANTA": planta
                    };
                    
                    $.ajax({
                            data:  parametros, //Datos que mandamos
                            url:   '../php/scripts/classrooms.php', //Direccion a donde lo mandamos
                            type:  'post', 
                            
                            //Antes del envío se produce...:
                            beforeSend: function () {
                                    // No hacemos nada
                            },
                            
                            //Despues del envio se produce...:
                            success:  function (response) {
                                $("#aulatd").html(response);
                            }
                    });
                }
                
                
                function addIncidence(categoria,titulo,descripcion,tipo){
                    swal({
                        title: '<?php echo $INCIDENCIES_incidence;?>',
                        width: 800,
                        html: '<div id="addIncidence"><?php include("../layouts/formIncidence.php");?></div>',
                        confirmButtonText: '<?php echo $DEPENDENCIES_accept;?>',
                        showCancelButton: true,
                        cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>',
                        closeOnConfirm: false,
                        allowEscapeKey: true,
                        allowOutsideClick: true
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            addIncidence2($('#categoria3').val(),$('#titulo3').val(),$('#descripcion3').val(),$('#tipo3').val(),$('#edificio3').val(),$('#planta3').val(),$('#aula3').val());
                        }
                        swal.close();
                    });
                    
                    $(".formIncidence .input-field").focus(function(){
                        this.select();
                    });
                    
                    $('#categoria3').val(categoria);
                    $('#titulo3').val(titulo);
                    $('#descripcion3').val(descripcion); 
                    $('#tipo3').val(tipo);
                }
                
                (function($) {  
                    $.get = function(key)   {  
                        key = key.replace(/[\[]/, '\\[');  
                        key = key.replace(/[\]]/, '\\]');  
                        var pattern = "[\\?&]" + key + "=([^&#]*)";  
                        var regex = new RegExp(pattern);  
                        var url = unescape(window.location.href);  
                        var results = regex.exec(url);  
                        if (results === null) {  
                            return null;  
                        } else {  
                            return results[1];  
                        }  
                    }  
                })(jQuery); 
                
                $(document).ready(main);
                $(document).ready(main2);
                
                var contador = 1;
                
                function main2(){
                    $('section').click(function(){ 
                        if(contador != 1){
                            contador = 1;
                            $('nav').animate({
                                left: '-100%'
                            });
                        }
                    });
                };
                
                function main(){
                    $('#menu_bar').click(function(){
                        //$('nav').toggle(); 
                
                        if(contador == 1){
                            $('nav').animate({
                                left: '0'
                            });
                            contador = 0;
                        } else {
                            contador = 1;
                            $('nav').animate({
                                left: '-100%'
                            });
                        }
                
                    });
                };
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
        
        <section onclick="main2()">

            <!-- Page Content -->