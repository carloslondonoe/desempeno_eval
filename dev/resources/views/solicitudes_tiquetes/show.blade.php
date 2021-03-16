@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">


<div class="col-md-12" style="text-align: right">
    <a class="btn btn-info" href="{{ URL::previous() }}">Volver</a>
    <br/>
    <br/>
</div>

<div class="card col-md-12 col-xs-12">

    <input type="hidden" id="user_id" value="{{ $user->id }}">
    <input type="hidden" id="jefe_id" value="{{ $jefe->id }}">

    @if (!empty($user->solicitudes))
        <table class="table table-hover table-striped table-bordered">
            <thead>
                    <th style="text-align: center">Nombre</th>
                    <th style="text-align: center">Motivo de salida</th>
                    <th style="text-align: center">Proyecto</th>
                    <th style="text-align: center" colspan="3" ></th>
            </thead>
            <tbody>
                    @foreach ($user->solicitudes as $solicitud)    
                        <tr id="table_solicitud_{{ $solicitud->id }}">
                            <td style="text-align: center"> {{ $user->name.' '.$user->apellido }} </td>
                            <td style="text-align: center"> {{ $solicitud->motivo }} </td>
                            <td style="text-align: center"> {{ $solicitud->proyecto }} </td>
                            <td style="text-align: center">
                                <button 
                                value="{{ $solicitud->id }}"
                                class="btn btn-info show_details"
                                type="button">
                                    Ver Detalle
                                </button>
                            </td>
                            @if ($jefe != null)
                                @if ($solicitud->autorizado == 'pendiente')
                                        <td style="text-align: center" class="delete_row_autorization{{$solicitud->id }}" >
                                            <button 
                                            value="{{ $solicitud->id }}"
                                            class="btn btn-success accept_permission">
                                                Aceptar Solicitud
                                            </button >
                                        </td>
                                        <td style="text-align: center" class="delete_row_autorization{{$solicitud->id }}">
                                            <button  
                                            value="{{ $solicitud->id }}"
                                            class="btn btn-warning cancel_permission">
                                                Rechazar Solicitud
                                            </button >
                                        </td>
                                @else
                                    
                                    <td style="text-align: center" colspan="2">
                                        @if ($solicitud->autorizado == 'confirmado')
                                            <button  
                                            class="btn btn-info cancel_permission">
                                                Solicitud confirmada
                                            </button >
                                        @else
                                            <button  
                                            class="btn btn-primary cancel_permission">
                                                Solicitud rechazada
                                            </button >
                                        @endif
                                    </td>
                                @endif
                            @else
                                @if ($solicitud->autorizado == 'pendiente')
                                    <td style="text-align: center" class="delete_row_autorization{{$permiso->id }}" >
                                        <button 
                                        class="btn btn-infor">
                                            Pendiente por confirmar
                                        </button >
                                    </td>
                                @else
                                    
                                    <td style="text-align: center" colspan="2">
                                        @if ($solicitud->autorizado == 'confirmado')
                                            <button  
                                            class="btn btn-info cancel_permission">
                                                Solicitud confirmada
                                            </button >
                                        @else
                                            <button  
                                            class="btn btn-primary cancel_permission">
                                                Solicitud rechazada
                                            </button >
                                        @endif
                                    </td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
            </tbody>
        </table>
            <!-- Modal -->
            <div id="modalNotification" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        <div id="msg_save"class="alert alert-success">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div id="modalDetails" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="detail_modal">
                        


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>

    @else
        <h3 style="text-align: center">Este usuario no ha solicitado permisos</h3>
    
    @endif
</div>
</div>

<script>
user_id = $('#user_id').val()
jefe_id = $('#jefe_id').val()

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.accept_permission').click(function () {
    id = $(this).val()
    url = '';
    if(jefe_id == '' || jefe_id == null){
        url= '../solicitudes/aceptar_solicitud/'+id+'/'+jefe_id
    }else{
        url = '../../aceptar_solicitud/'+id+'/'+jefe_id
    }

    $.ajax({
        type:'GET',
        url: url,
        success:function(data){ 
            console.log(data);
            if( data.status == 'ok' ){
                $('#msg_save').html(data.msg)
                $('#modalNotification').modal('show')

                row = ''+
                    '<td style="text-align: center" colspan="2">'+
                        '<button  '+
                        'class="btn btn-info cancel_permission">'+
                            'Solicitud confirmada'+
                        '</button >'+
                    '</td>'+
                '';

                $('.delete_row_autorization'+id).remove()
                        
                $('#table_solicitud_'+id).append(row)
            }

        }
    });    
})

$('.cancel_permission').click(function () {
    console.log('data');
    
    id = $(this).val()
    url = '';
    if(jefe_id == '' || jefe_id == null){
        url= '../solicitudes/cancelar_solicitud/'+id+'/'+jefe_id
    }else{
        url = '../../cancelar_solicitud/'+id+'/'+jefe_id
    }

    $.ajax({
        type:'GET',
        url: url,
        success:function(data){ 
            console.log(data);
            if( data.status == 'ok' ){
                $('#msg_save').html(data.msg)
                $('#modalNotification').modal('show')

                row = ''+
                    '<td style="text-align: center" colspan="2">'+
                        '<button  '+
                        'class="btn btn-primary cancel_permission">'+
                            'Solicitud cancelada'+
                        '</button >'+
                    '</td>'+
                '';

                $('.delete_row_autorization'+id).remove()

                $('#table_solicitud_'+id).append(row)
            }

        }
    });    
})

$('.show_details').click(function () {
    id = $(this).val()

    url = '';
    if(jefe_id == '' || jefe_id == null){
        url= '../solicitudes/show_solicitud/'+id
    }else{
        url = '../show_solicitud/'+id
    }
    $.ajax({
        type:'GET',
        url: url,
        success:function(data){ 
            console.log(data);
            if( data.status == 'ok' ){
               let razon_salida_option = ''
                container = '';
                  
                container = ''+
                '<div class="">'+
                    '<p class="title_competency">                          '+
                        '<strong>'+
                                'Motivo'+
                        '</strong>'+
                    '</p>'+
                    '<div class="">'+
                        '<div class="col-md-12"  id="container_razon_salida">'+
                            '<label for="razon_salida">Motivo</label>'+
                            '<p>'+data.solicitud.motivo+'</p>'+
                        '</div>'+
                        '<div class="col-md-6"  id="container_razon_salida">'+
                            '<label for="razon_salida">Proyecto</label>'+
                            '<p>'+data.solicitud.proyecto+'</p>'+
                        '</div>'+
                        '<div class="col-md-6"  id="container_razon_salida">'+
                            '<label for="razon_salida">Dirección</label>'+
                            '<p>'+data.solicitud.direccion+'</p>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<br/>'+
                        '</div>'+
                        '<p class="title_competency">'+
                            '<strong>'+
                                    'Destinos'+
                            '</strong>'+
                        '</p>'+
                        '<div class="col-md-12">'+
                            '<br/>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<table class="table table-hover table-striped table-bordered" >'+
                                '<thead>'+
                                    '<th style="text-align: center"> Destino </th>'+
                                    '<th style="text-align: center"> Día salida </th>'+
                                    '<th style="text-align: center"> Hora salida </th>'+
                                    '<th style="text-align: center"> Día regreso </th>'+
                                    '<th style="text-align: center"> Hora regreso </th>'+
                                '</thead>'+
                                '<tbody id="destinos_array">'+
                                '</tbody>'+
                            '</table>'+
                        '</div>'+
                    '</div>'+
                    '</div>'+
                '';

                
                $('#detail_modal').html(container)
                for (let i = 0; i < data.destinos.length; i++) {
                    const destino = data.destinos[i];
                    console.log(destino.destino);
                    
                    const row = '<tr>'+
                        '<td  id="">'+
                            '<p>'+destino.destino+'</p>'+
                        '</td>'+
                        '<td  id="">'+
                            '<label for="">Día salida</label>'+
                            '<p>'+destino.dia_salida+'</p>'+
                        '</td>'+
                        '<td  id="">'+
                            '<label for="">Hora salida</label>'+
                            '<p>'+destino.hora_salida+'</p>'+
                        '</td>'+
                        '<td  id="">'+
                            '<label for="">Día regreso</label>'+
                            '<p>'+destino.dia_regreso+'</p>'+
                        '</td>'+
                        '<td  id="">'+
                            '<label for="">Hora regreso</label>'+
                            '<p>'+destino.hora_regreso+'</p>'+
                        '</td>'+
                    '</tr>';
                    console.log(row)
                    $('#destinos_array').append(row)
                }
                /* */
                $('#modalDetails').modal('show')
                
            }
        }
    });  
});




</script>

@endsection