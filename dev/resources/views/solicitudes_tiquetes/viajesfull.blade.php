@extends('crudbooster::admin_template')
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte viajes</title>

        <!-- Required meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    </head>
		@section('content')
    <body class="container-fluid p-5">

    <div class="table-responsive" id="mydatatable-container">
			<h1 style="color:red;">TIQUETES SOLICITADOS</h1>
    <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
        <thead>
            <tr>
                <th>Nombres Completos</th>
                <th>Documento</th>
                <th>Fecha solicitud</th>
                <th>Estado</th>
                <th>Proyecto</th>
                <th>Autorización</th>
                <th>Destino</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Filtro..</th>
                <th>Filtro..</th>
                <th>Filtro..</th>
                <th>Filtro..</th>
                <th>Filtro..</th>
                <th>Filtro..</th>
                <th>Filtro..</th>
                <th>Filtro..</th>

            </tr>
        </tfoot>
        <tbody>
          @foreach($rptviajes as $vj)
           <tr @if($vj->gestion == 1) id="gest" @else id="singestin" @endif>
                <td>{{$vj->apellido}} {{$vj->nombre}}</td>
                <td>{{$vj->documento}}</td>
                <td>{{$vj->soliciado}}</td>
                <td>@if($vj->gestion == 1) <strong>Gestionado</strong> @else <strong>Falta Gestionar</strong> @endif</td>
                <td>{{$vj->proyecto}}</td>
                <td>{{$vj->autorizado}}</td>
                <td>{{$vj->destino}}</td>
                <td><button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#{{$vj->id}}">Detalles</button></td>
            </tr>
					  @endforeach


        </tbody>
    </table>

</div>


<!--  inicio modal -->
@foreach($rptviajes as $vj)
<div class="modal fade" id="{{$vj->id}}" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Motivo de viaje: {{$vj->motivo}}</h4>
			</div>
			<div class="modal-body">
				<p><strong>Fecha solicitud:</strong>{{$vj->soliciado}}</p>
				<p><strong>Proyecto: </strong>{{$vj->proyecto}}</p>
				<p><strong>Nombres completos: </strong>{{$vj->apellido}} {{$vj->nombre}}</p>
				<p><strong>Documento: </strong>{{$vj->documento}}</p>
				<p><strong>Destino: </strong>{{$vj->destino}}</p>
				<p><strong>Dirección recogida: </strong>{{$vj->direccion}}</p>
				 <p><strong>Requiere reserva hotelera: </strong>@if($vj->reservah == 1) SI @else NO @endif</p>
				<p><strong>Requiere Taxi:</strong> @if($vj->taxi == 1) SI @else NO @endif</p>
				<p><strong>Fecha y hora de salida: </strong>{{$vj->dsalida}} {{$vj->hsalida}}</p>
				<p><strong>Fecha y hora de regreso:</strong> {{$vj->dregreso}} {{$vj->hregreso}}</p>
				<p>{{$vj->observaciones}}</p>
			</div>
			<div class="modal-footer">
@if(($vj->gestion == 0) && ($vj->autorizado == 'confirmado'))
				<form method="POST" action="{{ route('viajes_r') }}">
					{!! csrf_field() !!}
					<input class="rdo" type="text" id="{{$vj->id}}" name="vjs" value="{{$vj->id}}">
<button type="submit" class="btn btn-primary">Gestionar</button>
<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
				</form>
				@elseif($vj->autorizado == 'pendiente')
				<div><h4>Este viaje esta pendiente por autorización</h4></div>
				<div>
					<div id="autorizar"><form method="POST" action="{{ route('viajes_r') }}">
					{!! csrf_field() !!}
					<input class="rdo" type="text" id="{{$vj->idst}}" name="autorizar" value="{{$vj->idst}}">
				<button type="submit" class="btn btn-success">Autorizar</button>
			</form></div>
				<div id="rechazar"><form method="POST" action="{{ route('viajes_r') }}">
					{!! csrf_field() !!}
					<input class="rdo" type="text" id="{{$vj->idst}}" name="rechazar" value="{{$vj->idst}}">
				<button type="submit" class="btn btn-danger">Rechazar</button>
			</form></div>
			</div>
				@elseif($vj->autorizado == 'rechazado')
				<button type="button" class="btn btn-success" data-dismiss="modal">Este viaje fue rechazado</button>
				<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
@else
<button type="button" class="btn btn-success" data-dismiss="modal">Este viaje ya fue gestionado</button>
<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
				@endif

			</div>
		</div>

	</div>
</div>
@endforeach
<!-- fin modal -->

<style>

.modal-footer {
    text-align: center !important;
}

#mydatatable tfoot input{
    width: 100% !important;
}
#mydatatable tfoot {
    display: table-header-group !important;
}

#gest {
    background-color: tomato;
    color: white;
}
#singestin {
    background-color: cornflowerblue;
    color: white;
}
.rdo {
    visibility: collapse;
}
#mydatatable_info {
    visibility: collapse;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    $('#mydatatable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Filtro.." />' );
    } );

    var table = $('#mydatatable').DataTable({
        "dom": 'B<"float-left"i><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
        "responsive": false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        "order": [[ 3, "asc" ]],
        "initComplete": function () {
            this.api().columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                        }
                });
            })
        }
    });
});
</script>
</body>
@endsection
</html>
