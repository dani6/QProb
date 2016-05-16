<?php 
    require('../layouts/header.php');
?>
<!-- <section> -->
     <style type="text/css" scoped>
        @import url("../css/pages/yours_incidences_open.css");
    </style>  
    
    <div id="wrapper">
        <h1> Yours incidences openned </h1>
        <hr size="2px"/>
        <br>
        <br>
        <script>
            function updateIncidences(user,categoria,estado,titulo,tipo,departamento,edificio,planta,aula,nombre,file){
                var parametros = {
                    "USUARIO": user,
                    "CATEGORIA": categoria,
                    "ESTADO": estado,
                    "TITULO": titulo,
                    "TIPO": tipo,
                    "DEPARTAMENTO": departamento,
                    "EDIFICIO": edificio,
                    "PLANTA": planta,
                    "AULA": aula,
                    "NOMBRE": nombre,
                    "FILE": file
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/incidences.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                           $("#incidences").html(response);
                           $('#categories').val(categoria);
                           $('#titulo').val(titulo);
                           $('#edificio4').val(edificio);
                           $('#planta4').val(planta);
                           $('#aula4').val(aula);
                           $('#tipo').val(tipo);
                        }
                });
            }
            
            updateIncidences('<?php echo $_SESSION['user'];?>','','ABIERTA','','','','','','','','<?php echo $filename;?>');
        </script>
        <div id="incidences">
        </div>
    </div>
<!-- </section> -->    
<?php
    require('../layouts/footer.php');
?>