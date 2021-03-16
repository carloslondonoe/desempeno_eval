@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<div class="card box-body table-responsive no-padding">
    <h3>Reporte general</h3>

    <form method="POST" action="{{ route('reporte_general_export_excel') }}">
        {{ csrf_field() }}
        <div class="col-md-4">
            <label for="">Seleccione año</label>
            <select name="ano" id="ano" class="form-control">
               
            </select>
        </div>

        <!-- <div class="col-md-4"  style="text-align: center">
            <label for="">Seleccione mes</label>
            <select name="mes" id="mes" class="form-control">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
        </div> -->

        <div class="col-md-4"  style="text-align: center">
            <label for="">Seleccione ciclo</label>
            <select name="ciclo" id="ciclo" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>

        <div class="col-md-4"  style="text-align: center">
            <label for="">Colaboradores con personal a cargo</label><br/>
            Si<input type="radio" name="acargo" id="acargo" value="true" checked>
            No<input type="radio" name="acargo" id="acargo" value="false" >
        </div>

        <div class="col-md-12">
            <br/>
        </div>

        <div class="col-md-12" style="text-align: center">
            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-cloud-download"></span>
                Descargar
            </button>
        </div>

        <div class="col-md-12">
            <br/>
        </div>
    </form>
    
<div>


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
    }) 
</script>
@endsection