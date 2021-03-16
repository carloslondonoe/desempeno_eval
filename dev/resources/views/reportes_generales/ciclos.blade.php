@extends('crudbooster::admin_template')
@section('content')
<style>
th {
    text-align: center !important;
}
table {

    margin-left: auto !important;
    margin-right: auto !important;
}
#td2 {
    text-align: center;
}
#inic {
    text-align: center;
}
table tbody tr:nth-child(odd) {
	background:white;
}
table tbody tr:nth-child(even) {
	background: #e36969a3;
}

body{
	background-color: #632432;
	font-family: Arial;
}

#main-container{
	margin: 150px auto;
	width: 600px;
}

table{
	background-color: white;
	text-align: left;
	border-collapse: collapse;
	width: 100%;
}

th, td{
	padding: 20px;
}

thead{
	background-color: #246355;
	border-bottom: solid 5px #0F362D;
	color: white;
}

tr:nth-child(even){
	background-color: #ddd;
}

tr:hover td{
	background-color: #369681;
	color: white;
}
</style>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>


<form method="POST" action="{{ route('reporte_ciclos') }}">
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
        Generar Reporte por ciclos
    </button>
</div>

<div class="col-md-12">
    <br/>
</div>
</form>
<div class="content">
  <div id="inic"><h4><strong>Ciclo: </strong>{{$ciclo}}  <strong>Año: </strong>{{$ano}} <strong>Personal a cargo: </strong>{{$acargo}}</h4></div>

@if($ciclo == '')
@else
<table>
      <tr><th colspan="2"><h4>Indicadores</h4></th></tr>
  <tr><th>Competencia</th><th>Porcentaje</th></tr>

@foreach ($puntuacionfnl as $pt)
<tr>
<td>{{$pt->competencia}}</td><td id="td2">{{$pt->promedio}}</td>
</tr>
@endforeach
</table>
<br/>
<table>
      <tr id="tilt"><th colspan="2"><h4>Liderazgo</h4></th></tr>
  <tr><th>Competencia</th><th>Porcentaje</th></tr>

@foreach ($liderazgo as $lz)
<tr>
<td id="td1">{{$lz->competencia}}</td><td id="td2">{{$lz->promedio}}</td>
</tr>
@endforeach
</table>
</br>
<table>
      <tr id="tilt"><th colspan="2"><h4>Trabajo en Equipo</h4></th></tr>
  <tr><th>Competencia</th><th>Porcentaje</th></tr>
@foreach ($trabajoenequipo as $tw)
<tr>
<td>{{$tw->competencia}}</td><td id="td2">{{$tw->promedio}}</td>
</tr>
@endforeach
</table>
</br>
<table>
      <tr id="tilt"><th colspan="2"><h4>Innovación</h4></th></tr>
  <tr><th>Competencia</th><th>Porcentaje</th></tr>
@foreach ($innovacion as $inn)
<tr>
<td>{{$inn->competencia}}</td><td id="td2">{{$inn->promedio}}</td>
</tr>
@endforeach
</table>
</br>
@endif



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




@endsection
