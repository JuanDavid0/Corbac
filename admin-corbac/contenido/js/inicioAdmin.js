function donutchart(arl,eps) {
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Incapacidades', 'Tipo incapacidad'],
            ['ARL', parseInt(arl)],
            ['EPS', parseInt(eps)]
        ]);
        var options = {
            animation: {
                easing: 'linear',
                startup: true,
                duration: 500
            },
            position: 'top',
            textStyle: {color: 'blue', fontSize: 16},
            chartArea: {left: 50, top: 20, width: '100%', height: '100%'},
            title: 'Incapacidades',
            pieHole: 0.2
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
}
function donutchart1(n_quincenal,n_mensual) {
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Trabajadores', 'Tipo'],
            ['Mineros', parseInt(n_quincenal)],
            ['Administrativos', parseInt(n_mensual)]
        ]);
        var options = {
            animation: {
                easing: 'linear',
                startup: true,
                duration: 500
            },
            position: 'top',
            textStyle: {color: 'rgba(33,86,178,.3)', fontSize: 16},
            chartArea: {left: 50, top: 20, width: '100%', height: '100%'},
            title: 'Trabajadores',
            pieHole: 0.2
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
        chart.draw(data, options);
    }
}
// GRAFICA GASTOS DE NOMINA MENSUAL
function chart_div(fechas,sumas) {
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var arreglo_aux = fechas.split(",");
        var arreglo_aux1 = sumas.split(",");         
        var data = google.visualization.arrayToDataTable([]);
        data.addColumn('string', 'Mes');
        data.addColumn('number', 'Gastos Mensual');    
         for (i = arreglo_aux.length -1; i >= 0; i--) {
        if(arreglo_aux[i] !== '')
            data.addRow([''+arreglo_aux[i]+'', parseInt(arreglo_aux1[i])]);                   
        }        
        var options = {
            pointSize: 5,
            dataOpacity: 0.5,
            animation: {
                easing: 'linear',
                startup: true,
                duration: 500
            },
            title: 'Gastos nomina mes',
            hAxis: {title: 'Mes', titleTextStyle: {color: '#333'}},
            legend: {position: 'top', maxLines: 1},
            vAxis: {minValue: 0},
            chartArea: {left: 70, top: 20, width: '75%', height: '70%'}

        };
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
}
//GRAFICOS GASTOS DE NOMINA QUINCENAL
function chart_div2(fechas,sumasQ1,sumasQ2) {
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var arreglo_aux = fechas.split(",");
        var arreglo_aux1 = sumasQ1.split(",");         
        var arreglo_aux2 = sumasQ2.split(",");
        var data = google.visualization.arrayToDataTable([]);
        data.addColumn('string', 'Mes');
        data.addColumn('number', 'Quincena 1');
        data.addColumn('number', 'Quincena 2');
         for (i = arreglo_aux.length -1; i >= 0; i--) {
            if(arreglo_aux[i] !== '')
            data.addRow([''+arreglo_aux[i]+'', parseInt(arreglo_aux1[i]), parseInt(arreglo_aux2[i])]);                   
        }                                              
        var options = {
            pointSize: 5,
            dataOpacity: 0.5,
            animation: {
                easing: 'linear',
                startup: true,
                duration: 500
            },
            chartArea: {left: 70, top: 30, width: '70%', height: '60%'},
            title: 'Nomina quincena',
            hAxis: {title: 'Mes',
                titleTextStyle: {color: '#333'}
            },
            legend: {position: 'top', maxLines: 1},
            vAxis: {minValue: 0}
        };
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
    }
}
//GRAFICA DE PROVISIONES
function chart_div3(fechas,sumasQ1,sumasQ2) {
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var arreglo_aux = fechas.split(",");
        var arreglo_aux1 = sumasQ1.split(",");         
        var arreglo_aux2 = sumasQ2.split(",");
        var data = google.visualization.arrayToDataTable([]);
        data.addColumn('string', 'Mes');
        data.addColumn('number', 'Total prestacion social');
        data.addColumn('number', 'Total Seguridad Social');
        for (i = arreglo_aux.length -1; i >= 0; i--) {
            if(arreglo_aux[i] !== '')
            data.addRow([''+arreglo_aux[i]+'', parseInt(arreglo_aux1[i]), parseInt(arreglo_aux2[i])]);                   
        }           
        var options = {
            animation: {
                easing: 'linear',
                startup: true,
                duration: 500
            },
            chartArea: {left: 50, top: 20, right: 50, width: '50%', height: '100%'},
            chart: {left: 50, top: 20,
                title: 'Provisiones'
            },
            hAxis: {
                textStyle: {
                    fontSize: 11
                }
            },
            legend: {position: 'top', textStyle: {fontSize: 11}},
            bars: 'vertical',
            vAxis: {format: 'decimal'},
            colors: ['#1b9e77','#82e5c8']
        };
        var chart = new google.charts.Bar(document.getElementById('chart_div3'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
}