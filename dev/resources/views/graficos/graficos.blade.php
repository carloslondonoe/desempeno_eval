@extends('crudbooster::admin_template')
@section('content')

    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>


<form method="POST" action="{{ route('grafico_general') }}">
  {!! csrf_field() !!}
    <div class="col-md-4">
        <label for="">Seleccione año</label>
        <select name="ano" id="ano" class="form-control">
          <option value="0">Seleccione un año</option>

        </select>
    </div>

    <div class="col-md-4"  style="text-align: center">
        <label for="">Seleccione ciclo</label>
        <select name="ciclo" id="ciclo" class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </div>

    <div class="col-md-4"  style="text-align: center">
        <label for="">Colaboradores con personal a cargo</label><br/>
        Si<input type="radio" name="acargo" id="acargo" value="Si" checked>
        No<input type="radio" name="acargo" id="acargo" value="No" >
    </div>

    <div class="col-md-12">
        <br/>
    </div>
    <div class="col-md-12" style="text-align: center">
        <button type="submit" class="btn btn-success">
            <span class="glyphicon glyphicon-cloud-download"></span>
            Generar Reporte
        </button>
    </div>

    <div class="col-md-12">
        <br/>
    </div>
</form>

<div>
<div  class="chart-container">
<canvas id="myChart" style="-moz-user-select:none; -webkit-user-select:none;-ms-user-select:none;"></canvas>
</div>
<br>
<div  class="chart-container">
<canvas id="lider"></canvas>
</div>
<br>
<div class="chart-container">
<canvas id="trabajo" ></canvas>
</div>
<br>
<div class="chart-container" >
<canvas id="innova"></canvas>
</div>
</div>
<script>
$(document).ready(function () {
    selectYear = document.getElementById("ano");
    var d = new Date();
    var n = d.getFullYear();
    for(var i = n; i >= 2019; i--) {
        var opc = document.createElement("option");
        opc.text = i;
        opc.value = i;
        selectYear.add(opc)
    }

});

</script>

<?php
$puntua;
$liderpuntos;
$puntostrabajoenequipo;
$puntosinnovacion;
?>

<script type="text/javascript">
var competencia=[];
var promedio=[];
var arreglo = '<?php echo $puntua; ?>';
var arreglo = JSON.parse(arreglo);
for(var x=0; x< arreglo.length;x++){
  competencia.push(arreglo[x].competencia);
  promedio.push(arreglo[x].promedio);
  console.log(arreglo);
  generarGrafica();


  }

function generarGrafica(){
  var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:competencia,
            datasets: [{
                label: 'Competencia',
                data:promedio,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            events:['click']

          }


    });

}
</script>
<script type="text/javascript">
var lidertext=[];
var liderpts=[];
var arreglo = '<?php echo $liderpuntos; ?>';
var arreglo = JSON.parse(arreglo);
for(var x=0; x< arreglo.length;x++){
  lidertext.push(arreglo[x].competencia);
  liderpts.push(arreglo[x].promedio);
  console.log(arreglo);
  graficalider();

  }
function graficalider(){
  Chart.defaults.global.defaultFontStyle = 'normal';
  Chart.defaults.global.defaultFontSize = 13;
  Chart.defaults.global.hover.mode = 'nearest';
    var ctxl = document.getElementById('lider').getContext('2d');
    var lider = new Chart(ctxl, {
        type: 'bar',
      
        data: {
            labels:lidertext,
            datasets: [{
                label: 'LIDERAZGO',
                data:liderpts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legendCallback:function(chart){

            },

            events:['click']

          }



    });

}
</script>

<script type="text/javascript">
var trbajotext=[];
var trbajopts=[];
var arreglo = '<?php echo $puntostrabajoenequipo; ?>';
var arreglo = JSON.parse(arreglo);
for(var x=0; x< arreglo.length;x++){
  trbajotext.push(arreglo[x].competencia);
  trbajopts.push(arreglo[x].promedio);
  console.log(arreglo);
  graficalider();

  }
function graficalider(){
  var ctxt = document.getElementById('trabajo').getContext('2d');
    var trabajo = new Chart(ctxt, {
        type: 'bar',
        data: {
            labels:trbajotext,
            datasets: [{
                label: 'TRABAJO EN EQUIPO',
                data:trbajopts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            events:['click']

          }


    });

}
</script>

<script type="text/javascript">
var innovatext=[];
var innovapts=[];
var arreglo = '<?php echo $puntosinnovacion; ?>';
var arreglo = JSON.parse(arreglo);
for(var x=0; x< arreglo.length;x++){
  innovatext.push(arreglo[x].competencia);
  innovapts.push(arreglo[x].promedio);
  console.log(arreglo);
  graficalider();

  }
function graficalider(){
  var ctxi = document.getElementById('innova').getContext('2d');
    var innova = new Chart(ctxi, {
        type: 'bar',
        data: {
            labels:innovatext,
            datasets: [{
                label: 'INNOVACIÓN',
                data:innovapts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            events:['click']

          }


    });

  }
</script>




@endsection
