@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card">

    @if ($seguimiento->estado == 'aceptado')
        <h3>El Plan de trabajo ha sido aceptado y notificado</h3>
    
    @elseif ($seguimiento->estado == 'rechazado')

        <h3>El Plan de trabajo ha sido rechazado y notificado</h3>

    @else
        <table class="table" id="table_seguimientos">
            <thead>
                <th>Situación Presentada</th>
                <th>Aspecto por Mejorar</th>
                <th>Acción a tomar</th>
                <th>Fecha de Seguimiento</th>
                <th colspan="2"></th>
            </thead>
            <tbody>
                <tr>
                    <td>{{$seguimiento->situacion_presentada}}</td>
                    <td>{{$seguimiento->aspecto_a_mejorar}}</td>
                    <td>{{$seguimiento->accion_a_tomar}}</td>
                    <td>{{$seguimiento->fecha_seguimiento}}</td>
                    <td>  
                        <a href="{{ route('aceptar_plan_trabajo', $seguimiento) }}" class="btn btn-success">Aceptar</a>
                    </td>
                    <td>  
                        <button data-toggle="modal" data-target="#modal_notification" class="btn btn-warning">Denegar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    @endif




    <!-- Modal -->
<div id="modal_notification" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            
        </div>
        <div class="modal-body" id="addMsg">


            <form action="{{ route('rechazar_plan_trabajo', $seguimiento) }}" class="form-search content-search navbar-form" method="get">
   
                <div class="col-md-12">
                    <label class="" for="">Observaciones</label><br>
                    <textarea style="width: 100%" id="udpate_accion_a_tomar" type="text" name="observaciones" class="form-control"></textarea>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-warning">Denegar</button>
                </div>

                <div class="col-md-6 align-right">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>



<script>


</script>
        

@endsection