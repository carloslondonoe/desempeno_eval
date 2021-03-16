@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card col-md-12 col-xs-12">
    <h3>Solicitud notificada</h3>
    <p style="text-align: center">
        Su solicitud fue remitida a su jefe de manera éxitosa y notificado por correo.
        Cuando este conteste usted será notificado por medio de un email
    </p>
</div>
@endsection