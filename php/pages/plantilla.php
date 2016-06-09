<?php 
    require('../layouts/header.php');
?>
<!-- <section> -->
    
    <!-- Aquí irá el código de cada página -->
    <p> Soy una prueba </p>
     
     <!-- Ejemplo de Chart.js -->
    <div style="width:75%">
        <div>
            <canvas id="canvas"></canvas>
        </div>
    </div>
    <!--<button id="randomizeData">Randomize Data</button>-->
    <script>
        /*var randomScalingFactor = function() {
            return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
        };*/
        var randomColor = function(opacity) {
            return 'rgba(' + Math.round(Math.random() * 255) + ',' + Math.round(Math.random() * 255) + ',' + Math.round(Math.random() * 255) + ',' + (opacity || '.3') + ')';
        };

        var scatterChartData = {
            datasets: [{
                label: "Departamento1",
                data: [{
                    x: 2,
                    y: 3,
                }, {
                    x: 4,
                    y: 5,
                }]
            }, {
                label: "Departamento2",
                data: [{
                    x: 1,
                    y: 4,
                }, {
                    x: 6,
                    y: 10,
                }]
            }, {
                label: "Departamento3",
                data: [{
                    x: 10,
                    y: 15,
                }, {
                    x: 12,
                    y: 12,
                }]
            }]
        };

        $.each(scatterChartData.datasets, function(i, dataset) {
            dataset.borderColor = randomColor(0.4);
            //dataset.backgroundColor = randomColor(0.1);
            dataset.backgroundColor = "rgba(0,0,0,0)";
            //dataset.pointBorderColor = randomColor(0);
            dataset.pointBorderColor = "rgba(0,0,0,1)";
            dataset.pointBackgroundColor = randomColor(1);
            dataset.pointBorderWidth = 1;
        });

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myScatter = Chart.Scatter(ctx, {
                data: scatterChartData,
                options: {
                    scales: {
                        xAxes: [{
                            position: 'bottom',
                            gridLines: {
                                zeroLineColor: "rgba(0,255,0,1)"
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Incidencias'
                            }
                        }],
                        yAxes: [{
                            position: 'left',
                            gridLines: {
                                zeroLineColor: "rgba(0,255,0,1)"
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Profesores'
                            }
                        }]
                    }
                }
            });
        };

        /*$('#randomizeData').click(function() {
            scatterChartData.datasets[0].data = [{
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }];
            scatterChartData.datasets[1].data = [{
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }, {
                x: randomScalingFactor(),
                y: randomScalingFactor(),
            }]
            window.myScatter.update();
        });*/
        
        $.notify("Welcome!", { autoHide: false,position:"right top", className: 'success' });
    </script>
<!-- </section> -->    
<?php
    require('../layouts/footer.php');
?>