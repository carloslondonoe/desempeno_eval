@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">


<div class="col-md-12" style="text-align: right">
    <a class="btn btn-info" href="{{ URL::previous() }}">volver</a>
    <br/>
    <br/>
</div>

<div class="card col-md-12 col-xs-12">
       
    <input type="hidden" id="user_id" value="{{ $user->id }}">
    <input type="hidden" id="jefe_id" value="{{ $jefe->id }}">

    @if (!empty($user->permisos))
        <table class="table table-hover table-striped table-bordered">
            <thead>
                    <th style="text-align: center">Motivo de salida</th>
                    <th style="text-align: center">Día de salida</th>
                    <th style="text-align: center">Hora de salida</th>
                    <th style="text-align: center" colspan="3" ></th>
            </thead>
            <tbody>
                    @foreach ($user->permisos as $permiso)    
                        <tr id="table_permisos_{{ $permiso->id }}">
                            <td style="text-align: center"> {{ $permiso->razon_salida }} </td>
                            <td style="text-align: center"> {{ $permiso->dia_salida }} </td>
                            <td style="text-align: center"> {{ $permiso->hora_salida }} </td>
                            <td style="text-align: center">
                                <button 
                                value="{{ $permiso->id }}"
                                class="btn btn-info show_details"
                                type="button">
                                    Ver Detalle
                                </button>
                            </td>
                            @if ($jefe != null)
                                @if ($permiso->autorizado == 'pendiente')
                                        <td style="text-align: center" class="delete_row_autorization{{$permiso->id }}" >
                                            <button 
                                            value="{{ $permiso->id }}"
                                            class="btn btn-success accept_permission">
                                                Aceptar Permiso
                                            </button >
                                        </td>
                                        <td style="text-align: center" class="delete_row_autorization{{$permiso->id }}">
                                            <button  
                                            value="{{ $permiso->id }}"
                                            class="btn btn-warning cancel_permission">
                                                Rechazar Permiso
                                            </button >
                                        </td>
                                @else
                                    
                                    <td style="text-align: center" colspan="2">
                                        @if ($permiso->autorizado == 'confirmado')
                                            <button  
                                            class="btn btn-info cancel_permission">
                                                Permiso confirmado
                                            </button >
                                        @else
                                            <button  
                                            class="btn btn-primary cancel_permission">
                                                Permiso rechazado
                                            </button >
                                        @endif
                                    </td>
                                @endif
                            @else
                                @if ($permiso->autorizado == 'pendiente')
                                    <td style="text-align: center" class="delete_row_autorization{{$permiso->id }}" >
                                        <button 
                                        class="btn btn-infor">
                                            Pendiente por confirmar
                                        </button >
                                    </td>
                                @else
                                    
                                    <td style="text-align: center" colspan="2">
                                        @if ($permiso->autorizado == 'confirmado')
                                            <button  
                                            class="btn btn-info cancel_permission">
                                                Permiso confirmado
                                            </button >
                                        @else
                                            <button  
                                            class="btn btn-primary cancel_permission">
                                                Permiso rechazado
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
        url= '../permisos/aceptar_permiso/'+id+'/'+jefe_id
    }else{
        url = '../../aceptar_permiso/'+id+'/'+jefe_id
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
                            'Permiso confirmado'+
                        '</button >'+
                    '</td>'+
                '';

                $('.delete_row_autorization'+id).remove()

                $('#table_permisos_'+id).append(row)
            }

        }
    });    
})

$('.cancel_permission').click(function () {
    id = $(this).val()
    url = '';
    if(jefe_id == '' || jefe_id == null){
        url= '../permisos/cancelar_permiso/'+id+'/'+jefe_id
    }else{
        url = '../../cancelar_permiso/'+id+'/'+jefe_id
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
                        'class="btn btn-info">'+
                            'Permiso rechazado'+
                        '</button >'+
                    '</td>'+
                '';

                $('.delete_row_autorization'+id).remove()

                $('#table_permisos_'+id).append(row)
            }

        }
    });    
})

$('.show_details').click(function () {
    id = $(this).val()

    url = '';
    if(jefe_id == '' || jefe_id == null){
        url= '../permisos/show_permiso/'+id
    }else{
        url = '../show_permiso/'+id
    }
    $.ajax({
        type:'GET',
        url: url,
        success:function(data){ 
            console.log(data);
            if( data.status == 'ok' ){
               let razon_salida_option = ''
                if(data.permiso.razon_salida != 'otro'  ){
                    if(data.permiso.razon_salida == 'calamidad_domestica'){
                        razon_salida_option = 'Calamidad domestica';
                    }
            
                    if(data.permiso.razon_salida == 'cita_eps'){
                        razon_salida_option = 'Cita Eps';
                    }
            
                    if(data.permiso.razon_salida == 'compensatorio'){
                        razon_salida_option = 'Compensatorio';
                    }
            
                    if(data.permiso.razon_salida == 'diligencia_personal'){
                        razon_salida_option = 'Diligencia Personal';
                    }
            
                    if(data.permiso.razon_salida == 'dia_de_cumpleanos'){
                        razon_salida_option = 'Día De Cumpleaños';
                    }
            
                    if(data.permiso.razon_salida == 'otro'){
                        razon_salida_option = 'Otro Cúal?';
                    }
            
                    if(data.permiso.razon_salida == null){
                        razon_salida_option = '';
                    }
                }else{
                    razon_salida_option = data.permiso.otra_razon_salida
                }

                container = ''+
                '<div class="">'+
                    '<p class="title_competency">                          '+
                        '<strong>'+
                                'Motivo salida'+
                        '</strong>'+
                    '</p>'+
                    '<div class="">'+
                        '<div class="col-md-12"  id="container_razon_salida">'+
                            '<label for="razon_salida">Motivo de salida</label>'+
                            '<p>'+razon_salida_option+'</p>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<br/>'+
                        '</div>'+
                        '<p class="title_competency">                          '+
                            '<strong>'+
                                    'Fechas'+
                            '</strong>'+
                        '</p>'+
                        '<div class="col-md-6" id="container_dia_salida">'+
                            '<label for="">Día de salida</label>'+
                            '<p>'+data.permiso.dia_salida+'</p>'+
                        '</div>'+
                        '<div class="col-md-6" id="container_hora_salida">'+
                            '<label for="">Hora de salida</label>'+
                            '<p>'+data.permiso.hora_salida+'</p>'+
                        '</div>'+
                        '<div class="col-md-6" id="container_dia_regreso">'+
                            '<label for="">Día regreso</label>'+
                            '<p>'+data.permiso.dia_regreso+'</p>'+
                        '</div>'+
                        '<div class="col-md-6" id="container_hora_regreso">'+
                            '<label for="">Hora de entrada</label>'+
                            '<p>'+data.permiso.hora_regreso+'</p>'+
                        '</div>'+
                        '<div class="col-md-12" id="container_observaciones">'+
                            '<label for="">Observaciones</label>'+
                            '<p>'+data.permiso.observaciones+'</p>'+
                        '</div>'+
                    '</div>'+
                    '</div>'+
                '';

                $('#detail_modal').html(container)
                $('#modalDetails').modal('show')
                
            }
        }
    });  
});




</script>

@endsection