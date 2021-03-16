@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<div class="card box-body table-responsive no-padding">
    <h3>Reporte general por año</h3>

    <form method="POST" action="{{ route('reporte_general_export_excel_por_mes') }}">
        {{ csrf_field() }}
        <div class="col-md-6">
            <label for="">Seleccione año</label>
            <select name="ano" id="ano" class="form-control">
                
            </select>
        </div>

        <div class="col-md-6"  style="text-align: center">
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