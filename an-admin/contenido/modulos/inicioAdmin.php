<?php
require_once './conexion/bdconexion.php';
require_once './contenido/clases/inicio.php';
ini_set('error_reporting', E_ALL);
$inicio = new Inicio();
$ciudades = Inicio::listarCiudades();
$totalVisitas = Inicio::totalVisitas();
$totalRegistros = Inicio::totalRegistros();
$visitasxmes = Inicio::listarVisitantesXMes();
var_dump($totalVisitas);
?>
<div id="contenedor-AreaTrabjo-Admin" style="background-image: url(<?php echo $rutaFinal?>contenido/assets/fondo.jpg)" >
    <div class="contenedor_time">
        <p class="title">Bienvenido: <?php echo $_SESSION['usuario'];?> </p>
        <p id="fecha" class="clock"></p>
        <script>
            var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            var f = new Date();
            document.getElementById('fecha').innerHTML = (f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
        </script>
    </div>
    <div id="contenedor-inicio">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ciudad', 'Cantidad'],
          ['<?php echo $ciudades[0]['ciudad'];  ?>', <?php echo $ciudades[0]['cantidad'];  ?>],
          ['<?php echo $ciudades[1]['ciudad'];  ?>', <?php echo $ciudades[1]['cantidad'];  ?>],
          ['<?php echo $ciudades[2]['ciudad'];  ?>', <?php echo $ciudades[2]['cantidad'];  ?>],
          ['<?php echo $ciudades[3]['ciudad'];  ?>', <?php echo $ciudades[3]['cantidad'];  ?>],
          ['<?php echo $ciudades[4]['ciudad'];  ?>', <?php echo $ciudades[4]['cantidad'];  ?>]
        ]);
        var data1 = google.visualization.arrayToDataTable([
          ['Visitas', '#', { role: 'style' }],
          ['Total visitas', <?php echo $totalVisitas[0];  ?>, '#82a337']
        ]);
        var data2 = google.visualization.arrayToDataTable([
          ['Registros', '#', { role: 'style' }],
          ['Total registros', <?php echo $totalRegistros[0];  ?>, '#82a337']
        ]);
        var options = {
          pieHole: 0.3,
          colors: ['#82a337', '#335C67', '#FFF3B0', '#9E2A2B', '#540B0E'],
        };
        var chart = new google.visualization.PieChart(document.getElementById('opcion-inicio-valor-1'));
        var chart1 = new google.visualization.ColumnChart(document.getElementById('opcion-inicio-valor-2'));
        var chart2 = new google.visualization.ColumnChart(document.getElementById('opcion-inicio-valor-3'));
        chart.draw(data, options);
        chart1.draw(data1, options);
        chart2.draw(data2, options);
      }
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Fecha',  'Cantidad'],
          ['<?php if($visitasxmes[0] != null ) echo $visitasxmes[0]['mes']."/".$visitasxmes[0]['anio']; else echo "nn"?>',<?php if($visitasxmes[0] != null ) echo $visitasxmes[0]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[1] != null ) echo $visitasxmes[1]['mes']."/".$visitasxmes[1]['anio']; else echo "nn"?>',<?php if($visitasxmes[1] != null ) echo $visitasxmes[1]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[2] != null ) echo $visitasxmes[2]['mes']."/".$visitasxmes[2]['anio']; else echo "nn"?>',<?php if($visitasxmes[2] != null ) echo $visitasxmes[2]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[3] != null ) echo $visitasxmes[3]['mes']."/".$visitasxmes[3]['anio']; else echo "nn"?>',<?php if($visitasxmes[3] != null ) echo $visitasxmes[3]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[4] != null ) echo $visitasxmes[4]['mes']."/".$visitasxmes[4]['anio']; else echo "nn"?>',<?php if($visitasxmes[4] != null ) echo $visitasxmes[4]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[5] != null ) echo $visitasxmes[5]['mes']."/".$visitasxmes[5]['anio']; else echo "nn"?>',<?php if($visitasxmes[5] != null ) echo $visitasxmes[5]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[6] != null ) echo $visitasxmes[6]['mes']."/".$visitasxmes[6]['anio']; else echo "nn"?>',<?php if($visitasxmes[6] != null ) echo $visitasxmes[6]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[7] != null ) echo $visitasxmes[7]['mes']."/".$visitasxmes[7]['anio']; else echo "nn"?>',<?php if($visitasxmes[7] != null ) echo $visitasxmes[7]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[8] != null ) echo $visitasxmes[8]['mes']."/".$visitasxmes[8]['anio']; else echo "nn"?>',<?php if($visitasxmes[8] != null ) echo $visitasxmes[8]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[9] != null ) echo $visitasxmes[9]['mes']."/".$visitasxmes[9]['anio']; else echo "nn"?>',<?php if($visitasxmes[9] != null ) echo $visitasxmes[9]['cantidad']; else echo "0" ?>],['<?php if($visitasxmes[10] != null ) echo $visitasxmes[10]['mes']."/".$visitasxmes[10]['anio']; else echo "nn"?>',<?php if($visitasxmes[10] != null ) echo $visitasxmes[10]['cantidad']; else echo "0" ?>],
          ['<?php if($visitasxmes[11] != null ) echo $visitasxmes[11]['mes']."/".$visitasxmes[11]['anio']; else echo "nn"?>',<?php if($visitasxmes[11] != null ) echo $visitasxmes[11]['cantidad']; else echo "0" ?>],
        ]);
        var options = {
          title: 'Visitas mensuales',
          hAxis: {title: 'Fechas',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
          chartArea: {  width: "80%", height: "70%" }
        };
        var chart = new google.visualization.AreaChart(document.getElementById('opcion-general-valor'));
        chart.draw(data, options);
      }
</script>
    <div id="contenedor-inicio">
        <div class="opcion-inicio">
            <div class="opcion-inicio-titulo">
                Ciudades más visitas
            </div>
            <div id="opcion-inicio-valor-1"></div>
            
        </div>
        <div class="opcion-inicio">
            <div class="opcion-inicio-titulo">
                Total visitas a la web.
            </div>
            <div id="opcion-inicio-valor-2"></div>
        </div>
        <div class="opcion-inicio">
            <div class="opcion-inicio-titulo">
                Personas registradas.
            </div>
            <div id="opcion-inicio-valor-3"></div>
        </div>
        <div id="opcion-general">
            <div id="opcion-general-titulo">
                Visitas mensuales.
            </div>
            <div id="opcion-general-valor"></div>
        </div>
    </div>     
</div>