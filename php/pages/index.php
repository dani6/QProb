<?php 
    require('../layouts/header.php');
?>
<!-- <section> -->
        <style type="text/css" scoped>
            @import url("../css/pages/index.css");
            @import url("../css/pages/indexmedia.css") screen and (max-width: 1000px);
        </style>  
        
        <?php if(($_SESSION['type'] == "ADMIN") || ($_SESSION['type'] == "TECHNICAL")){?>
        <script>
            
        </script>
        <?php }?>
        
        <div id="wrapper2">
            <?php if($_SESSION['type'] == "ADMIN"){?>
                <script>
                    <?php
                        $enero = $db->query("select count(*) total from incidencia where month(FECHA)=1 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $febrero = $db->query("select count(*) total from incidencia where month(FECHA)=2 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $marzo = $db->query("select count(*) total from incidencia where month(FECHA)=3 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $abril = $db->query("select count(*) total from incidencia where month(FECHA)=4 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $mayo = $db->query("select count(*) total from incidencia where month(FECHA)=5 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $junio = $db->query("select count(*) total from incidencia where month(FECHA)=6 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $julio = $db->query("select count(*) total from incidencia where month(FECHA)=7 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $agosto = $db->query("select count(*) total from incidencia where month(FECHA)=8 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $septiembre = $db->query("select count(*) total from incidencia where month(FECHA)=9 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $octubre = $db->query("select count(*) total from incidencia where month(FECHA)=10 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $noviembre = $db->query("select count(*) total from incidencia where month(FECHA)=11 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        $diciembre = $db->query("select count(*) total from incidencia where month(FECHA)=12 and year(FECHA)=year(CURRENT_TIMESTAMP);");

                    ?>
                    
                    var config = {
                        type: 'radar',
                        data: {
                            labels: ["<?php echo $MONTH1;?>", "<?php echo $MONTH2;?>", "<?php echo $MONTH3;?>", "<?php echo $MONTH4;?>", "<?php echo $MONTH5;?>", "<?php echo $MONTH6;?>", "<?php echo $MONTH7;?>", "<?php echo $MONTH8;?>", "<?php echo $MONTH9;?>", "<?php echo $MONTH10;?>","<?php echo $MONTH11;?>","<?php echo $MONTH12;?>"],
                            datasets: [{
                                label: "<?php echo $INDEX_TOTAL_INCIDENCIAS;?>",
                                borderColor: 'rgb(0, 0, 255)',
                                backgroundColor: "rgba(0,0,255,0.2)",
                                pointBackgroundColor: "rgba(220,220,220,1)",
                                data: [<?php echo mysqli_fetch_array($enero)['total'].", ".mysqli_fetch_array($febrero)['total'].", ".mysqli_fetch_array($marzo)['total'].", ".mysqli_fetch_array($abril)['total'].", ".mysqli_fetch_array($mayo)['total'].", ".mysqli_fetch_array($junio)['total'].", ".mysqli_fetch_array($julio)['total'].", ".mysqli_fetch_array($agosto)['total'].", ".mysqli_fetch_array($septiembre)['total'].", ".mysqli_fetch_array($octubre)['total'].", ".mysqli_fetch_array($noviembre)['total'].", ".mysqli_fetch_array($diciembre)['total'];?>]
                            }, {
                                label: "<?php echo $INCIDENCIES_resolved;?>",
                                borderColor: 'rgb(0, 220, 0)',
                                backgroundColor: "rgba(0, 255, 0, 0.2)",
                                pointBackgroundColor: "rgba(151,187,205,1)",
                                hoverPointBackgroundColor: "#fff",
                                pointHighlightStroke: "rgba(151,187,205,1)",
                                <?php
                                    $enero = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=1 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $febrero = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=2 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $marzo = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=3 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $abril = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=4 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $mayo = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=5 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $junio = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=6 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $julio = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=7 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $agosto = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=8 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $septiembre = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=9 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $octubre = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=10 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $noviembre = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=11 and year(FECHA)=year(CURRENT_TIMESTAMP);");
                                    $diciembre = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=12 and year(FECHA)=year(CURRENT_TIMESTAMP);");

                                ?>
                                data: [<?php echo mysqli_fetch_array($enero)['total'];?>,<?php echo mysqli_fetch_array($febrero)['total'];?>,<?php echo mysqli_fetch_array($marzo)['total'];?>,<?php echo mysqli_fetch_array($abril)['total'];?>,<?php echo mysqli_fetch_array($mayo)['total'];?>,<?php echo mysqli_fetch_array($junio)['total'];?>,<?php echo mysqli_fetch_array($julio)['total'];?>,<?php echo mysqli_fetch_array($agosto)['total'];?>,<?php echo mysqli_fetch_array($septiembre)['total'];?>,<?php echo mysqli_fetch_array($octubre)['total'];?>,<?php echo mysqli_fetch_array($noviembre)['total'];?>,<?php echo mysqli_fetch_array($diciembre)['total'];?>]
                            }]
                        },
                        options: {
                            title:{
                                display:false,
                            },
                            elements: {
                                line: {
                                    tension: 0.0,
                                }
                            },
                            scale: {
                                beginAtZero: true,
                                reverse: false
                            }
                        }
                    };

                    window.onload = function() {
                        window.myRadar = new Chart(document.getElementById("canvas"), config);
                    };
                </script>
                <div class="box">
                    <a class="imprimir" style="position: absolute;" onclick="imprSelec('impresion')"><?php echo $INDEX_USER_PRINT;?></a>
                    <script>
                          function imprSelec(nombre) 
                            { 
                                var articulo = document.getElementById(nombre); 
                                var ventimp = window.open(' ','impresion','no','no','0','no','no','no','no','no','no','no','no','0'); 
                                ventimp.document.write(articulo.innerHTML); 
                                ventimp.document.close(); 
                                ventimp.print(); 
                                ventimp.close(); 
                            } 
                    </script>
                    <div>
                        <?php
                        $consulta = "select i.ID ID, u.NOMBRE USUARIO_NOMBRE, u.APELLIDOS USUARIO_APELLIDOS, c.NOMBRE CATEGORIA_NAME,i.DESCRIPCION INCIDENCIA_DESCRIPCION, i.TITULO INCIDENCIA_TITULO, i.TIPO INCIDENCIA_TIPO, e.NOMBRE EDIFICIO_NOMBRE, p.NUMERO PLANTA_NUMERO, a.AULA AULA, i.FECHA FECHA from incidencia i inner join rel_aula_incidencia rai on rai.id_incidencia=i.id inner join rel_categoria_incidencia rci on rci.id_incidencia=i.id inner join usuario u on u.id=i.id_usuario inner join departamento d on d.id=u.id_departamento inner join categoria c on c.id=rci.id_categoria inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio where i.ESTADO LIKE 'ABIERTA' and i.TIPO LIKE 'URGENTE' ORDER BY FECHA limit 3;";
                        $result = $db->query($consulta);
                            echo "<h1 style='text-align: right; margin-top: 40px;'>$INCIDENCIES_urgent_incidence</h1><br>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<div class='incidencia' onclick='window.location=\"incidencia.html?id=".$row['ID']."\";'>";
                                echo "<p class='cabecera'>".$row['FECHA']." $category: ".$row['CATEGORIA_NAME']."</p>";
                                echo "<p class='lugar'>".$row['EDIFICIO_NOMBRE']." $DEPENDENCIES_floor: ".$row['PLANTA_NUMERO']." $DEPENDENCIES_classroom: ".$row['AULA']."</p>";
                                echo "<p class='titulo'>".$row['INCIDENCIA_TITULO']."</p>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="box" style="font-size: 20px;">
                    <h1><?php echo $INDEX_USER_INFORMATION;?>: </h1>
                    <?php
                        echo "<br>"; 
                        $mes = $db->query("select count(*) total from incidencia where month(FECHA)=month(CURRENT_TIMESTAMP) and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        echo "<p> $INDEX_USER_TOTAL1: ".mysqli_fetch_array($mes)['total']." </p>";
                        echo "<br>";
                        $mes = $db->query("select count(*) total from incidencia where ESTADO LIKE 'RESUELTA' and month(FECHA)=month(CURRENT_TIMESTAMP) and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        echo "<p> $INDEX_USER_TOTAL2: ".mysqli_fetch_array($mes)['total']." </p>";
                        echo "<br>";
                        $mes = $db->query("select count(*) total from incidencia where ESTADO LIKE 'EN CURSO' and month(FECHA)=month(CURRENT_TIMESTAMP) and year(FECHA)=year(CURRENT_TIMESTAMP);");
                        echo "<p> $INDEX_USER_TOTAL3: ".mysqli_fetch_array($mes)['total']." </p>";
                        
                        echo "<br>";
                        $presupuesto_total = $db->query("select sum(r.presupuesto) total from incidencia i inner join revision r on r.id_incidencia=i.id where year(i.FECHA)=year(CURRENT_TIMESTAMP);");
                        echo "<p style='text-align: right; color: rgb(31,81,127);'> $INDEX_USER_TOTAL4: ".mysqli_fetch_array($presupuesto_total)['total']."€</p>";
                    ?>
                </div>
                
                
                <div class="box full">
                    <div>
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
                <div id="impresion" style="display: none; text-align: left; font-family: Square;">
                    <?php
                        $consulta = "select u.NOMBRE USUARIO_NOMBRE, u.APELLIDOS USUARIO_APELLIDOS, c.NOMBRE CATEGORIA_NAME,i.DESCRIPCION INCIDENCIA_DESCRIPCION, i.TITULO INCIDENCIA_TITULO, i.TIPO INCIDENCIA_TIPO, e.NOMBRE EDIFICIO_NOMBRE, p.NUMERO PLANTA_NUMERO, a.AULA AULA, i.FECHA FECHA from incidencia i inner join rel_aula_incidencia rai on rai.id_incidencia=i.id inner join rel_categoria_incidencia rci on rci.id_incidencia=i.id inner join usuario u on u.id=i.id_usuario inner join departamento d on d.id=u.id_departamento inner join categoria c on c.id=rci.id_categoria inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio where i.ESTADO LIKE 'ABIERTA' ORDER BY i.TIPO, FECHA;";
                        $result = $db->query($consulta);
                        echo "<h1>Incidencias</h1><br>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<p class='cabecera'>".$row['FECHA']." Tipo: ".$row['INCIDENCIA_TIPO']." Categoría: ".$row['CATEGORIA_NAME']."</p>";
                            echo "<p class='lugar'>".$row['EDIFICIO_NOMBRE']." Planta: ".$row['PLANTA_NUMERO']." ".$row['AULA']."</p>";
                            echo "<p class='titulo'>".$row['INCIDENCIA_TITULO']."</p>";
                            echo "<p style='font-size: 12px'>Por: ".$row['USUARIO_NOMBRE']." ".$row['USUARIO_APELLIDOS']."</p>";
                            echo "<p class='descripcion' style='font-size: 14px; border: 1px solid rgba(0,0,0,0.2); padding: 10px;'>".$row['INCIDENCIA_DESCRIPCION']."</p>";
                            echo "<br>";
                        }
                    ?>
                </div>
            <?php }else if($_SESSION['type'] == "TECHNICAL"){ ?>
                    <div class="box">
                        <a style="position: absolute;" class="imprimir" onclick="imprSelec('impresion')"><?php echo $INDEX_USER_PRINT;?></a>
                        <script>
                            function imprSelec(nombre) 
                                { 
                                    var articulo = document.getElementById(nombre); 
                                    var ventimp = window.open(' ','impresion','no','no','0','no','no','no','no','no','no','no','no','0'); 
                                    ventimp.document.write(articulo.innerHTML); 
                                    ventimp.document.close(); 
                                    ventimp.print(); 
                                    ventimp.close(); 
                                } 
                        </script>
                        <div>
                            <?php
                            $consulta = "select i.ID ID, u.NOMBRE USUARIO_NOMBRE, u.APELLIDOS USUARIO_APELLIDOS, c.NOMBRE CATEGORIA_NAME,i.DESCRIPCION INCIDENCIA_DESCRIPCION, i.TITULO INCIDENCIA_TITULO, i.TIPO INCIDENCIA_TIPO, e.NOMBRE EDIFICIO_NOMBRE, p.NUMERO PLANTA_NUMERO, a.AULA AULA, i.FECHA FECHA from incidencia i inner join rel_aula_incidencia rai on rai.id_incidencia=i.id inner join rel_categoria_incidencia rci on rci.id_incidencia=i.id inner join usuario u on u.id=i.id_usuario inner join departamento d on d.id=u.id_departamento inner join categoria c on c.id=rci.id_categoria inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio where i.ESTADO LIKE 'ABIERTA' and i.TIPO LIKE 'URGENTE' ORDER BY FECHA limit 5;";
                            $result = $db->query($consulta);
                                echo "<h1 style='text-align: right; margin-top: 40px;'>$INCIDENCIES_urgent_incidence</h1><br>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<div class='incidencia' onclick='window.location=\"incidencia.html?id=".$row['ID']."\";'>";
                                    echo "<p class='cabecera'>".$row['FECHA']." $category: ".$row['CATEGORIA_NAME']."</p>";
                                    echo "<p class='lugar'>".$row['EDIFICIO_NOMBRE']." $DEPENDENCIES_floor: ".$row['PLANTA_NUMERO']." $DEPENDENCIES_classroom: ".$row['AULA']."</p>";
                                    echo "<p class='titulo'>".$row['INCIDENCIA_TITULO']."</p>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="box">
                        <div>
                            <?php
                            $consulta = "select i.ID ID, u.NOMBRE USUARIO_NOMBRE, u.APELLIDOS USUARIO_APELLIDOS, c.NOMBRE CATEGORIA_NAME,i.DESCRIPCION INCIDENCIA_DESCRIPCION, i.TITULO INCIDENCIA_TITULO, i.TIPO INCIDENCIA_TIPO,i.ESTADO INCIDENCIA_ESTADO, e.NOMBRE EDIFICIO_NOMBRE, p.NUMERO PLANTA_NUMERO, a.AULA AULA, i.FECHA FECHA from incidencia i inner join rel_aula_incidencia rai on rai.id_incidencia=i.id inner join rel_categoria_incidencia rci on rci.id_incidencia=i.id inner join usuario u on u.id=i.id_usuario inner join departamento d on d.id=u.id_departamento inner join categoria c on c.id=rci.id_categoria inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio ORDER BY FECHA DESC limit 5;";
                            $result = $db->query($consulta);
                                echo "<h1 style='font-family: Square; font-size: 20px; text-align: right; margin-top: 30px;'>$RECENT_INCIDENCE: </h1><br>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<div class='incidencia' onclick='window.location=\"incidencia.html?id=".$row['ID']."\";'>";
                                    echo "<p style='font-size: 10px;'>$INCIDENCIES_state ".$row['INCIDENCIA_ESTADO']."</p>";
                                    echo "<p class='cabecera'>".$row['FECHA']." $category: ".$row['CATEGORIA_NAME']."</p>";
                                    echo "<p class='lugar'>".$row['EDIFICIO_NOMBRE']." $DEPENDENCIES_floor: ".$row['PLANTA_NUMERO']." $DEPENDENCIES_classroom: ".$row['AULA']."</p>";
                                    echo "<p class='titulo'>".$row['INCIDENCIA_TITULO']."</p>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
                    </div>
            <?php }else{ ?>
                    <div class="box full" style='min-height:0;'>
                        <div>
                            <?php
                            $consulta = "select COUNT(*) total FROM usuario u inner join incidencia i on i.id_usuario=u.id where i.ESTADO LIKE 'ABIERTA' and u.id=".$_SESSION['id'];
                            $result = $db->query($consulta);
                            echo "<p>".$INDEX_USER_INCIDENCIAS_TOTAL.": <span style='color: rgba(31,81,127,0.8)'>".mysqli_fetch_array($result)["total"]."</span></p>";
                            
                            $consulta = "select COUNT(*) total FROM usuario u inner join incidencia i on i.id_usuario=u.id where i.ESTADO LIKE 'RESUELTA'";
                            $result = $db->query($consulta);
                            if(mysqli_fetch_array($result)>0){
                                echo "<p>".$INDEX_RESOLVED_INCIDENCES."</p><br>";
                            }
                            
                            $consulta = "select i.ID ID, u.NOMBRE USUARIO_NOMBRE, u.APELLIDOS USUARIO_APELLIDOS, c.NOMBRE CATEGORIA_NAME,i.DESCRIPCION INCIDENCIA_DESCRIPCION, i.TITULO INCIDENCIA_TITULO, i.TIPO INCIDENCIA_TIPO,i.ESTADO INCIDENCIA_ESTADO, e.NOMBRE EDIFICIO_NOMBRE, p.NUMERO PLANTA_NUMERO, a.AULA AULA, i.FECHA FECHA from incidencia i inner join rel_aula_incidencia rai on rai.id_incidencia=i.id inner join rel_categoria_incidencia rci on rci.id_incidencia=i.id inner join usuario u on u.id=i.id_usuario inner join departamento d on d.id=u.id_departamento inner join categoria c on c.id=rci.id_categoria inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio where i.ESTADO LIKE 'EN CURSO' and i.id_Usuario='".$_SESSION['id']."' ORDER BY FECHA DESC;";
                            $result = $db->query($consulta);
                            if($result->num_rows>0){
                                echo "<h1 style='margin-top: 30px;'>$INDEX_USER_INCIDENCIAS_CARRIED_OUT</h1><br>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<div class='incidencia' onclick='window.location=\"incidencia.html?id=".$row['ID']."\";'>";
                                    echo "<p style='font-size: 10px;'>$INCIDENCIES_state ".$row['INCIDENCIA_ESTADO']."</p>";
                                    echo "<p class='cabecera'>".$row['FECHA']." $category: ".$row['CATEGORIA_NAME']."</p>";
                                    echo "<p class='lugar'>".$row['EDIFICIO_NOMBRE']." $DEPENDENCIES_floor: ".$row['PLANTA_NUMERO']." $DEPENDENCIES_classroom: ".$row['AULA']."</p>";
                                    echo "<p class='titulo'>".$row['INCIDENCIA_TITULO']."</p>";
                                    echo "</div>";
                                }
                            }else{
                                echo $INDEX_USER_INCIDENCIAS_NOT;
                            }                                
                            ?>
                        </div>
                    </div>
            <?php } ?>
        </div>
<!-- </section> -->    
<?php
    require('../layouts/footer.php');
?>