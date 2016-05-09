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
                                window.location="../html/<?php echo ($filename=="login")?"index":$filename;?>.html";
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
                                alert(categoria+" "+titulo+" "+descripcion+" "+tipo+" "+edificio+" "+planta+" "+aula+" "+response);
                                window.location="<?php echo $filename;?>.html";
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
                
                
                function addIncidence(){
                    swal({
                        title: 'Incidencia',
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
                }
                
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