@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<style>

img {
    vertical-align: middle;
    width: 181px !important;
    height: 210px;
  
}

#contenedor {
    column-count: 2;
    margin-top: 51px;
   text-align: center;
}

td, th {
    padding: 10px;
}


</style>

{{csrf_field()}}
<div id="contenedor">
<table>
<tr>
<td><a href="/permisos/create?m=118"><img src="img/solicitud.png" /></a><br></td>
<td><a href="/solicitud/create?m=135"><img src="img/viajes.png" /></a><br></td>
</tr>
<tr></tr>
<div></div>
</table>
</div>


@endsection
