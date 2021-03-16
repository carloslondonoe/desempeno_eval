@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card box-body table-responsive no-padding">
    
    <h3 style="text-align: center">Registro de solicitud de tiquetes</h3>
    
    <table class="table table-hover table-striped table-bordered">
        <thead>
                <th style="text-align: center">Apellido</th>
                <th style="text-align: center">Nombre</th>
                <th style="text-align: center">Cargo</th>
                <th style="text-align: center">Ver Permisos</th>
        </thead>
        <tbody>
            @foreach ($users as $user)    
                <tr>
                    <td style="text-align: center"> {{ $user->apellido }} </td>
                    <td style="text-align: center"> {{ $user->name }} </td>
                    <td style="text-align: center"> {{ $user->cargo->cargo }} </td>
                    <td style="text-align: center">
                        <a class="btn btn-primary" href="{{ route('solicitudes_show', $user) }}">
                            Ver Solicitudes
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>
@endsection