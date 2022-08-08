@extends('layouts.app')
@section('content')
<div class="btn-group">
  <button class="btn btn-light-secondary text-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Estatus
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    @foreach ($estatus as $est)
      <li><a class="dropdown-item" href="#">{{$est->titulo}}</a></li>
    @endforeach
  </ul>
</div>
<div class="container-fluid">
  <div class="row justify-content-center text-white">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Grafico de Barras</h4>
            <div id="chart-bar"></div>
          </div>
        </div>
      </div>
      <!-- End Patterned Bar Chart -->
      <!-- Start Dinut Pie Chart -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Grafico de Pastel</h4>
            <div id="container"></div>
          </div>
        </div>
      </div>
      <!-- End Dinut Pie Chart -->
      <!-- Start Dinut Pie Chart -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Columnas</h4>
            <div id="column-chart"></div>
          </div>
        </div>
      </div>
      <!-- End Dinut Pie Chart -->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Grafico de Barras</h4>
            <div id="chart-b"></div>
          </div>
        </div>
      </div>
  </div>
</div>
<!-- this page js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<link href="https://code.highcharts.com/css/themes/dark-unica.css"rel="stylesheet"/>
<style>
  .card{
    background-color: transparent !important;
  }
  ul{
    background-color: rgb(90, 89, 89) !important; 
  }
</style>
<script>
  Highcharts.chart('container', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'requerimientos por sistema'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.y}'
        },
        showInLegend: true
      }
    },
    series: [{
      name: 'Requerimientos',
      colorByPoint: true,
      data: <?= $RxS ?>
    }],
    credits: {
        text: 'it-strategy.mx',
        href: 'http://www.it-strategy.mx'
    }
  });
</script>
<script>
  // Create the chart
  var aObj = <?= $exa ?>;
  let nuevoObjeto = {}
  //Recorremos el arreglo 
  aObj.forEach( x => {
    //Si la ciudad no existe en nuevoObjeto entonces
    //la creamos e inicializamos el arreglo de profesionales. 
    if( !nuevoObjeto.hasOwnProperty(x.titulo)){
      nuevoObjeto[x.titulo] = {
        name: [x.titulo],
        data: []
      }
    }
    const dat = [];
    //Agregamos los datos de profesionales. 
    nuevoObjeto[x.titulo].data.push({
      name: x.nombre_cl,
      y: x.total
    });
  })
  console.log(nuevoObjeto);
  Highcharts.chart('chart-bar', {
    chart: {
      type: 'column'
    },
    title: {
      align: 'center',
      text: 'Requerimientos por Cliente'
    },  
    accessibility: {
      announceNewData: {
        enabled: true
      }
    },
    xAxis: {
      type: 'category'
    },
    yAxis: {
      title: {
        text: 'Total de registros'
      }
    },
    legend: {
      enabled: true,
      //align: 'right',
      //verticalAlign: 'top',
      //x: -10,
      //y: 50,
      //floating: true
    },
    plotOptions: {
      series: {
        dataLabels: {
          enabled: true,
          format: '{point.y}',
        },
        showInLegend: true
      }
    },
    tooltip: {
      headerFormat: '<span style="color:{point.color}; font-size:11px">{series.name}</span><br>',
      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> del total<br/>'        
    },
    series: [
      nuevoObjeto['PLANTEAMIENTO DE LA SOLICITUD'],
      nuevoObjeto['REVISIÓN CON CLIENTE'],
      nuevoObjeto['SE ENTREGA PLANTEAMIENTO DE LA SOLICITUD A CLIENTE'],
      nuevoObjeto['EN ESPERA DE PROPUESTA O ANÁLISIS'],
      nuevoObjeto['EN ESPERA DE TIEMPOS'],
      nuevoObjeto['EN CONSTRUCCIÓN'],
      nuevoObjeto['EN PRUEBAS'],
      nuevoObjeto['EN IMPLEMENTACIÓN'],
      nuevoObjeto['IMPLEMENTADO'],
      nuevoObjeto['POSPUESTO']
    ]
       //console.log(nuevoObjeto['IMPLEMENTADO'])/*
    /*  [{name: ['EN CONSTRUCCIÓN'],
      data: [
        {name: 'DEL MONTE', y: 2},
        {name: 'ENERGIZER', y: 1},
        {name: 'GENERAL', y: 2},
        {name: 'SPLENDA', y: 1},
        {name: 'TALENT GROUP', y: 2},
        {name: 'TRIPLE I', y: 1},
        {name: 'TUM', y: 1}]}]
    [
      {
        name: 'Requerimientos',
        colorByPoint: true,
        data: <?= $RxC ?>
      }
    ]*/,
    credits: {
        text: 'it-strategy.mx',
        href: 'http://www.it-strategy.mx'
    }
  })
</script>
<script>
  Highcharts.chart('column-chart', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Requerimientos por agente'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      type: 'category',
      labels: {
        rotation: -45,
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Total de Requeriminetos'
      }
    },
    legend: {
      enabled: false
    },
    tooltip: {
      pointFormat: 'Requerimientos: <b>{point.y:.1f}</b>'
    },
    series: [{
      name: 'Requerimientos',
      data: <?= $SxR ?>,
      dataLabels: {
        enabled: true,
        rotation: -90,
        color: '#FFFFFF',
        align: 'right',showInLegend: true,
        format: '{point.y:.1f}', // one decimal
        y: 10, // 10 pixels down from the top
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    }],
    credits: {
        text: 'it-strategy.mx',
        href: 'http://www.it-strategy.mx'
    }
  });
</script>
<script>
  var kvArray = <?= $ex ?>;
  //<?= $ex ?>;
  var reformattedArray;
      reformattedArray = kvArray.map(function(obj){
        var rObj = {};
        rObj['name'] = obj.name;
        //dObj.forEach(element => rObj['data'] = element);
        //rObj['data'] = [Array.from(obj.data.split(','))]//.replace(/['"]+/g, '');
        rObj['data'] = JSON.parse("[" + obj.data + "]");
        return rObj;
      })
  Highcharts.chart('chart-b', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Requerimientos por cliente'
    },
    xAxis: {
      categories: [
        'EN CONSTRUCCIÓN',
        'EN ESPERA DE PROPUESTA O ANÁLISIS',
        'EN ESPERA DE TIEMPOS',
        'EN IMPLEMENTACIÓN',
        'EN PRUEBAS',
        'IMPLEMENTADO',
        'PLANTEAMIENTO DE LA SOLICITUD',
        'POSPUESTO',
        'REVISIÓN CON CLIENTE',
        'SE ENTREGA PLANTEAMIENTO DE LA SOLICITUD A CLIENTE',
      ],
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Requerimientos'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:f} </b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: reformattedArray,
    credits: {
        text: 'it-strategy.mx',
        href: 'http://www.it-strategy.mx'
    }
  });
  //console.log(reformattedArray)
</script>
@endsection