@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />

<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<style>

.title_notification_plan{
    display: none;
}

</style>

<div class="row">
    <div class="col-md-9">
        <h3>Plan de trabajo: {{ $valoracion->user->name.' '.$valoracion->user->apellido }}</h3>
    </div>

    <!--div class="col-md-3">
        <a class="btn btn-info" href="{{ URL::previous() }}">volver</a>
    </div-->
</div>

<input type="hidden" value="{{$valoracion->user->id}}" name="user_id" id="user_id">
<input type="hidden" value="{{$valoracion->id}}" name="valoracion_id" id="valoracion_id">
<input type="hidden" value="{{$user->id}}" name="lider_id" id="lider_id">

@if (!empty($valoracion->planes))
    <input type="hidden" value="{{$valoracion->planes->id}}" name="plan_id" id="plan_id">
@else
    <input type="hidden" value="" name="plan_id" id="plan_id">
@endif

<div class="row">
    <div class="col-md-6" id="container_situacion_presentada" >
        <label for="">Situación Presentada</label>
        <textarea id="situacion_presentada" type="text" class="form-control has-error"></textarea>
        <p></p>
    </div>

    <div class="col-md-6 " id="container_aspecto_a_mejorar">
        <label for="">Aspecto por Mejorar</label>
        <textarea id="aspecto_a_mejorar"  type="text" class="form-control"></textarea>
        <p></p>
    </div>

    <div class="col-md-6" id="container_accion_a_tomar">
        <label for="">Acción a tomar</label>
        <textarea id="accion_a_tomar" type="text" class="form-control"></textarea>
        <p></p>
    </div>

    <div class="col-md-6" id="container_fecha_seguimiento">
        <label for="">Fecha de Seguimiento</label>
        <div class='input-group date datetimepicker1' id="datetimepicker1">
            <input type='text' id="fecha_seguimiento" class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>

    <div class="col-md-12">
        <br>
    </div>
    
    <div class="col-md-12">
        <button id="send_seguimiento" class="btn btn-success btn-block">Guardar plan de trabajo</button>
    </div>

    <div class="col-md-12">
        <br>
    </div>
</div>





<div id="lista_seguimiento">
    @if (!empty($valoracion->planes->seguimientos))   
        @foreach ($valoracion->planes->seguimientos as $seguimiento)
            <div class="" id="container_seguimiento_{{ $seguimiento->id }}">
                <div class="">
                    <div class="panel panel-default">

                        <div class="panel-heading"> 
                            <div class="row">
                                <div class="col-md-6">
                                
                                    @if ($seguimiento->cerrado == true)
                                        <button id='title_notification_{{ $seguimiento->id }}'  class="btn btn-success ">
                                            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Plan cerrado
                                        </button>
                                    @else

                                        <button value="{{ $seguimiento->id }}"  class="btn btn-success close_plan plan_cerrado_{{$seguimiento->id}}"> Cerrar plan de trabajo</button>
                                        <button id='title_notification_{{ $seguimiento->id }}'  class="btn btn-success title_notification_plan">
                                            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Plan cerrado
                                        </button>
                                    @endif
                                </div>
                                <div class="col-md-6" style="float: right;">
                                    @if ($seguimiento->estado == 'pendiente' || $seguimiento->estado == 'rechazado')
                                        <a id='state_notification_{{ $seguimiento->id }}'  class="btn btn-success " href="{{ route('show_state_seguimiento', $seguimiento) }}">
                                            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Aceptar Plan de trabajo por parte del empleado
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Default panel contents -->
                        <div>
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <th>Situación presentada </th>
                                    <th>Aspecto por mejorar</th>
                                    <th>Acción a tomar </th>
                                    <th>Fecha de seguimiento</th>
                                    <th class="plan_cerrado" colspan="3">  </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="title_situacion_presentada_{{ $seguimiento->id }}""> {{ $seguimiento->situacion_presentada }}</td>
                                        <td id="title_aspecto_a_mejorar_{{ $seguimiento->id }}"> {{ $seguimiento->aspecto_a_mejorar}} </td>
                                        <td id="title_accion_a_tomar_{{ $seguimiento->id }}"> {{ $seguimiento->accion_a_tomar}} </td>
                                        <td id="title_fecha_seguimiento_{{ $seguimiento->id }}"> {{ $seguimiento->fecha_seguimiento}} </td>
                                        @if (!$seguimiento->cerrado)

                                            <td class="plan_cerrado_{{$seguimiento->id}}"> <button value="{{$seguimiento->id}}" class="btn btn-primary open_activities "> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Crear seguimiento </button> </td>
                                            <td class="plan_cerrado_{{$seguimiento->id}}"> <button value="{{$seguimiento->id}}" class="btn btn-primary select_seguimiento"> <span class="glyphicon glyphicon-edit " aria-hidden="true"></span> Editar plan de trabajo </button> </td>
                                            <td class="plan_cerrado_{{$seguimiento->id}}"> <button value="{{$seguimiento->id}}" class="btn btn-danger select_delete_seguimiento float-right"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Eliminar </button> </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>
                
                        <!-- Table -->
                        @if (!empty($seguimiento->actividades))   
                            <div class="">
                                <table class="table table-responsive" id="table_actividades">
                                    <thead>
                                        <th>Seguimiento</th>
                                        <th>Observaciones</th>
                                        <th>Fecha de Creación</th>
                                        <th>Fecha de seguimiento</th>

                                        <th colspan="2"></th>
                                    </thead>
                                    <tbody id="addActivity_{{ $seguimiento->id }}">
                                        @foreach ($seguimiento->actividades as $actividad)
                                            <tr id="tr_activity_{{ $actividad->id }}">
                                                <td id="td_actividad_{{ $actividad->id }}">{{ $actividad->actividad }}</td>
                                                <td id="td_observaciones_{{ $actividad->id }}">{{ $actividad->observaciones }}</td>
                                                <td id="td_fecha_{{ $actividad->id }}">{{ date( "Y-m-d", strtotime($actividad->created_at) ) }}</td>
                                                <td id="td_creado_{{ $actividad->id }}">{{ $actividad->fecha }}</td>
                                                @if (!$seguimiento->cerrado)
                                                    <td style="text-align:center">
                                                        <button value="{{ $actividad->id }}" class="btn btn-primary open_update_activities plan_cerrado_{{$seguimiento->id}}">
                                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"> </span> Editar 
                                                        </button>
                                                    </td>
                                                   {{-- <td style="text-align:center" id="state_activity_{{ $actividad->id }}">

                                                        @if ($actividad->cerrado)
                                                            <button  class="btn btn-success plan_cerrado">
                                                                <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Actividad cerrada    
                                                            </button>
                                                        @else
                                                            <button onclick="close_activity( {{$actividad->id}} )" value="{{ $actividad->id }}" class="btn btn-primary plan_cerrado_{{$seguimiento->id}}">
                                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Cerrar 
                                                            </button>
                                                        @endif

                                                    </td> --}}
                                                    <td style="text-align:center">
                                                        <button value="{{ $actividad->id }}" class="btn btn-danger confirm_delete_activity plan_cerrado_{{$seguimiento->id}}">
                                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Eliminar 
                                                        </button>
                                                    </td>
                                                @else 
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        
        @endforeach

    @endif
</div>

<!-- Modal -->
<div id="modal_notification_close" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            
        </div>
        <div class="modal-body" id="addMsg">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalNotification" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>
        <div class="modal-body">
            <div id="msg_save"class="alert alert-warning">
                Su plan de trabajo esta siendo generado
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>
        <div class="modal-body">
            <div id="msg_save"class="alert alert-success">
                Plan de trabajo Registrado de manera exitosa
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
<!-- Modal Update Seguimiento -->
<div id="updateSeguimiento" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>
        <div class="modal-body">
            
                <input type="hidden" id="udpate_seguimiento_id">
                <div class="col-md-6" id="container_situacion_presentada" >
                    <label for="">Situación Presentada</label>
                    <textarea id="udpate_situacion_presentada" type="text" class="form-control has-error"></textarea>
                    <p></p>
                </div>
            
                <div class="col-md-6 " id="container_aspecto_a_mejorar">
                    <label for="">Aspecto por Mejorar</label>
                    <textarea id="udpate_aspecto_a_mejorar"  type="text" class="form-control"></textarea>
                    <p></p>
                </div>
            
                <div class="col-md-6" id="container_accion_a_tomar">
                    <label for="">Acción a tomar</label>
                    <textarea id="udpate_accion_a_tomar" type="text" class="form-control"></textarea>
                    <p></p>
                </div>
            
                <div class="col-md-6" id="container_fecha_seguimiento">
                    <label for="">Fecha de Seguimiento</label>
                    <div class='input-group date datetimepicker1' id="datetimepicker1">
                        <input type='text' id="udpate_fecha_seguimiento" class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            
                <div class="col-md-12">
                    <br>
                </div>
                
                <div class="col-md-6">
                    <button id="update_seguimiento" class="btn btn-success btn-block">Guardar cambios</button>
                </div>
                
                <div class="col-md-6 align-right">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                </div>


                <div class="col-md-12">
                    <br>
                </div>

        </div>
        <div class="modal-footer">
            
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="notificationDeleteSeguimiento" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>
        <div class="modal-body">
            <div id="msg_save"class="alert alert-success">
                Registro eliminado de manera exitosa
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="deleteSeguimientoModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>
        <div class="modal-body">
            <div id="msg_save"class="alert alert-warning">
                Realmente desea eliminar este registro?
            </div>

            <input type="hidden" id="delete_seguimiento_id">

            <div class="col-md-6">
                <button id="delete_seguimiento" class="btn btn-success">Eliminar</button>
            </div>

            <div class="col-md-6">
                <button data-dismiss="modal" class="btn btn-danger">Cancelar</button>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="deleteActivityModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
                <div id="msg_save"class="alert alert-warning">
                    Realmente desea eliminar este registro?
                </div>
    
                <input type="hidden" id="delete_activity_id">
    
                <div class="col-md-6">
                    <button id="delete_activity" class="btn btn-success">Eliminar</button>
                </div>
    
                <div class="col-md-6">
                    <button data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                </div>
    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>



<!-- Modal Activities-->
<div id="myModalActivities" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal Activities-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registro de actividades</h4>
        </div>
        <div class="modal-body">

            <div id="msg_activity" class="alert alert-success">
                Registro creado
            </div>

            <input type="hidden" id="seguimiento_id">

            <div class="col-md-12">
                <label for="">Seguimiento</label>
                <input type="text" id="actividad"  class="form-control" >
            </div>

            <div class="col-md-12">
                <label for="">Observaciones</label>
                <input type="text" id="observacion" class="form-control" >
            </div>

            <div class="col-md-12">
                <label for="">Fecha de seguimiento</label>
                <div class='input-group date datetimepicker1' >
                    <input type='text' id="fecha_seguimiento_actividad" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <br>
            </div>
            
            <div class="col-md-6">
                <button id="send_activity" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-md-6 align-right">
                <button type="button" class="btn btn-info " data-dismiss="modal">Cerrar</button>
            </div>

        </div>
        <div class="modal-footer">
            
        </div>
        </div>
    
    </div>
</div>

<!-- Modal Activities-->
<div id="modalUpadateActivity" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal Activities-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registro de actividades</h4>
        </div>
        <div class="modal-body">

                <div id="msg_activity_update" class="alert alert-success">
                    Registro editado
                </div>

            <input type="hidden" id="update_activity_id">    
            
            <div class="col-md-12">
                <label for="">Seguimiento</label>
                <input type="text" id="update_actividad"  class="form-control" >
            </div>

            <div class="col-md-12">
                <label for="">Observaciones</label>
                <input type="text" id="update_observacion" class="form-control" >
            </div>

            <div class="col-md-12">
                <label for="">Fecha de seguimiento</label>
                <div class='input-group date datetimepicker1' >
                    <input type='text' id="update_fecha_seguimiento_actividad" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <br>
            </div>
            
            <div class="col-md-6">
                <button id="update_activity" class="btn btn-success">Guardar</button>
            </div>

            <div class="col-md-6 align-right">
                <button type="button" class="btn btn-info " data-dismiss="modal">Cerrar</button>
            </div>

        </div>
        <div class="modal-footer">
            
        </div>
        </div>
    
    </div>
</div>
    
@if ($save == 200)
    <script>
        $('#myModal').modal('show')
    </script>
@endif

<script>
    $(document).ready(function(){
        $('.datetimepicker1').datepicker({
            format: 'yyyy-mm-dd',
            language: 'es'
        });

        $('#msg_activity').hide()
        $('#msg_activity_update').hide()
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var getData = [
        $('#situacion_presentada'),
        $('#aspecto_a_mejorar'),
        $('#accion_a_tomar'),
        $('#fecha_seguimiento')
    ]

    $('#send_seguimiento').click(function(){
        validate(getData)
    })

    $('.open_activities').click(function() {
        data= {
            seguimiento_id: $(this).val()
        }

        $('#seguimiento_id').val($(this).val())
        $('#myModalActivities').modal('show')

        $.ajax({
            type:'POST',
            url:'./select_activities',
            data: data,
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){
                        $('#addActivity').html('');
                        for (let i = 0; i < data.actividades.length; i++) {
                            const element = data.actividades[i]['actividad'];
                            var row = ''+
                                '<li class="list-group-item">'+
                                    '<p> Seguimiento: '+data.actividades[i]['actividad']+'</p>'+ 
                                    '<p> observaciones: '+data.actividades[i]['observaciones']+'</p>'+
                                    '<p> fecha: '+data.actividades[i]['fecha']+'</p>'+
                                '</li>'+
                            '';
                            $('#addActivity').append(row);
                        }
                    }
                }
        });
    })

    $('.open_update_activities').click(function() {
        $.ajax({
            type:'POST',
            url:'./select_activity/'+$(this).val(),
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){

                        $('#update_activity_id').val(data.actividad.id)
                        $('#update_actividad').val(data.actividad.actividad)
                        $('#update_observacion').val(data.actividad.observaciones)
                        $('#update_fecha_seguimiento_actividad').val(data.actividad.fecha)

                        $('#modalUpadateActivity').modal('show')
                    }
                }
        });
    })

    $('#update_activity').click(function() {
        data = {
            actividad:          $('#update_actividad').val(),
            observaciones:      $('#update_observacion').val(),
            fecha:              $('#update_fecha_seguimiento_actividad').val(),
        }

        $.ajax({
            type:'POST',
            url:'./update_activity/'+$('#update_activity_id').val(),
            data: data,
                success:function(data){ 
                    console.log(data);
                    
                    if(data.status == 'ok'){
                        
                        $('#msg_activity_update').show()

                        

                        $('#td_actividad_'+data.actividad.id).html(data.actividad.actividad)
                        $('#td_observaciones_'+data.actividad.id).html(data.actividad.observaciones)
                        $('#td_fecha_'+data.actividad.id).html(data.actividad.fecha)

                        setTimeout(function(){
                            $('#msg_activity_update').hide()
                        }, 3000);
                    }
                }
        });
    });

    $('.open_manager_activities').click(function() {
            data= {
                seguimiento_id: $(this).val()
            }

            $('#seguimiento_id').val($(this).val())
            $('#addActivities').html('');
            $('#modalActivities').modal('show')

            $.ajax({
                type:'POST',
                url:'./select_activities',
                data: data,
                    success:function(data){ 
                        console.log(data);
                        if(data.status == 'ok'){
                        
                            if(data.actividades.length > 0){
                                for (let i = 0; i < data.actividades.length; i++) {
                                    const element = data.actividades[i]['actividad'];
                                    
                                    
                                    if ( data.actividades[i]['cerrado'] == 0) {
                                        row = ''+
                                            '<li class="list-group-item">'+
                                                '<span class="badge my-baged" id="baged_'+data.actividades[i]['id']+'">'+
                                                        '<button onclick="close_activity('+data.actividades[i]['id']+')" value="'+data.actividades[i]['id']+'" class="btn btn-success close_activity">cerrar</button>'+
                                                '</span>'+
                                                '<p> seguimiento: '+data.actividades[i]['actividad']+'</p>'+ 
                                                '<p> observaciones: '+data.actividades[i]['observaciones']+'</p>'+
                                                '<p> fecha: '+data.actividades[i]['fecha']+'</p>'+
                                            '</li>'+
                                        '';
                                        
                                    } else {

                                        row = ''+
                                            '<li class="list-group-item">'+
                                                '<span class="badge my-baged" id="baged_'+data.actividades[i]['id']+'" >cerrado</span>'+
                                                '<p> seguimiento: '+data.actividades[i]['actividad']+'</p>'+ 
                                                '<p> observaciones: '+data.actividades[i]['observaciones']+'</p>'+
                                                '<p> fecha: '+data.actividades[i]['fecha']+'</p>'+
                                            '</li>'+
                                        '';
                                    
                                    }
                                    
                                    $('#addActivities').append(row);
                            
                                }
                            }else{
                                $('#addActivities').html('<p class="alert alert-warning">No hay actividades creadas<p>');
                            }
                        }
                    }
            });
        
    });

    $('#send_activity').click(function(){

        data = {
            seguimiento_id :    $('#seguimiento_id').val(),
            actividad:          $('#actividad').val(),
            observaciones:      $('#observacion').val(),
            fecha:              $('#fecha_seguimiento_actividad').val(),
            user_id:            $('#user_id').val(),
            lider_id:           $('#lider_id').val(),
        }

        
        console.log(data);
        

        $.ajax({
            type:'POST',
            url:'./save_activity',
            data: data,
                success:function(data){ 
                    console.log(data);
                    
                    if(data.status == 'ok'){
                        
                        $('#msg_activity').show()
                        setTimeout(function(){
                            $('#msg_activity').hide()
                        }, 3000);

                        $('#actividad').val('')
                        $('#observacion').val('')
                        $('#fecha_seguimiento_actividad').val('')

                        /*
                        if(data.actividad['cerrado']){
                            var state = ''
                                '<button  class="btn btn-success">'+
                                '    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Actividad cerrada    '+
                                '</button>'+
                            '';
                        }else{
                            var state = ''+
                                '<button onclick="close_activity( '+data.actividad.id+' )" value="'+data.actividad.id+'" class="btn btn-primary">'+
                                    '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Cerrar'+
                                '</button>'+
                            ''
                        }
                        /* */
                        var row = ''+
                            '<li class="list-group-item">'+
                                '<p> seguimiento: '+data.actividad['actividad']+'</p>'+ 
                                '<p> observaciones: '+data.actividad['observaciones']+'</p>'+
                                '<p> fecha: '+data.actividad['fecha']+'</p>'+
                            '</li>'+
                        '';
                        

                        var row_table = ''+

                            

                            '<tr id="tr_activity_'+data.actividad.id+'">'+
                                '<td id="td_actividad_'+data.actividad.id+'">'+data.actividad['actividad']+'</td>'+
                                '<td id="td_observaciones_'+data.actividad.id+'">'+data.actividad['observaciones']+'</td>'+
                                '<td id="td_creado_'+data.actividad.id+'">'+data.actividad['created_at']+'</td>'+
                                '<td id="td_fecha_'+data.actividad.id+'">'+data.actividad['fecha']+'</td>'+
                                
                                '<td style="text-align:center">'+
                                    '<button value="'+data.actividad.id+'" class="btn btn-primary open_update_activities">'+
                                            '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar'+
                                    '</button>'+
                                '</td>'+
                    
                                '<td style="text-align:center">'+
                                    '<button value="'+data.actividad.id+'" class="btn btn-danger confirm_delete_activity">'+
                                        '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Eliminar'+
                                    '</button>'+
                                '</td>'+

                            '</tr>'+
                        '';

                     
                        //$('#addActivity_'+data.actividad['seguimiento_id']).append(row);
                        $('#addActivity_'+data.actividad['seguimiento_id']).append(row_table);


                        $('.open_update_activities').click(function() {
                            $.ajax({
                                type:'POST',
                                url:'./select_activity/'+$(this).val(),
                                    success:function(data){ 
                                        console.log(data);
                                        if(data.status == 'ok'){

                                            $('#update_activity_id').val(data.actividad.id)
                                            $('#update_actividad').val(data.actividad.actividad)
                                            $('#update_observacion').val(data.actividad.observaciones)
                                            $('#update_fecha_seguimiento_actividad').val(data.actividad.fecha)

                                            $('#modalUpadateActivity').modal('show')
                                        }
                                    }
                            });
                        })

                        $('.confirm_delete_activity').click(function(){
                            $('#delete_activity_id').val($(this).val())

                            $('#deleteActivityModal').modal('show');
                        });

                    }
                }
        });
        /* */
    });

    $('#edit_activity').click(function(){

        data = {
            seguimiento_id :    $('#seguimiento_id').val(),
            actividad:          $('#actividad').val(),
            observaciones:      $('#observacion').val(),
            fecha:              $('#fecha_seguimiento_actividad').val(),
            user_id:            $('#user_id').val(),
            lider_id:           $('#lider_id').val(),
        }

        
        console.log(data);
        

        $.ajax({
            type:'POST',
            url:'./save_activity',
            data: data,
                success:function(data){ 
                    console.log(data);
                    
                    if(data.status == 'ok'){
                        
                        $('#actividad').val('')
                        $('#observacion').val('')
                        $('#fecha_seguimiento_actividad').val('')

                        var row = ''+
                            '<li class="list-group-item">'+
                                '<p> seguimiento: '+data.actividad['actividad']+'</p>'+ 
                                '<p> observaciones: '+data.actividad['observaciones']+'</p>'+
                                '<p> fecha: '+data.actividad['fecha']+'</p>'+
                            '</li>'+
                        '';

                        var row_table = ''+

                            '<tr>'+
                                '<td>'+data.actividad['actividad']+'</td>'+
                                '<td>'+data.actividad['observaciones']+'</td>'+
                                '<td>'+data.actividad['fecha']+'</td>'+
                                '<td style="text-align:center">'+
                                    '<button >'+
                                            '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>'+
                                    '</button>'+
                                '</td>'+
                            '</tr>'+
                        '';
                        //$('#addActivity_'+data.actividad['seguimiento_id']).append(row);
                        $('#addActivity_'+data.actividad['seguimiento_id']).append(row_table);


                    }
                }
        });
        /* */
    });

    $('.select_seguimiento').click(function(){
        $.ajax({
            type:'POST',
            url:'./select_seguimiento/'+$(this).val(),
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){
                        $('#udpate_seguimiento_id').val(data.seguimiento.id)
                        $('#udpate_situacion_presentada').val(data.seguimiento.situacion_presentada)
                        $('#udpate_aspecto_a_mejorar').val(data.seguimiento.aspecto_a_mejorar)
                        $('#udpate_accion_a_tomar').val(data.seguimiento.accion_a_tomar)
                        $('#udpate_fecha_seguimiento').val(data.seguimiento.fecha_seguimiento)

                        $('#updateSeguimiento').modal('show')
                    }
                }
        });
    })

    $('#update_seguimiento').click(function(){
        data = {
                        
            situacion_presentada:   $('#udpate_situacion_presentada').val(),
            aspecto_a_mejorar:      $('#udpate_aspecto_a_mejorar').val(),
            accion_a_tomar:         $('#udpate_accion_a_tomar').val(),
            fecha_seguimiento:      $('#udpate_fecha_seguimiento').val(),
        }

        $.ajax({
            type:'POST',
            url:'./update_seguimiento/'+$('#udpate_seguimiento_id').val(),
            data: data,
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){
                        
                        $('#title_situacion_presentada_'+data.seguimiento.id).html(data.seguimiento.situacion_presentada  )
                        $('#title_aspecto_a_mejorar_'+data.seguimiento.id).html(data.seguimiento.aspecto_a_mejorar  )
                        $('#title_accion_a_tomar_'+data.seguimiento.id).html(data.seguimiento.accion_a_tomar  )
                        $('#title_fecha_seguimiento_'+data.seguimiento.id).html(data.seguimiento.fecha_seguimiento  )
                        
                    }
                }
        });

    })

    $('.select_delete_seguimiento').click(function(){
       $('#delete_seguimiento_id').val( $(this).val() )
       $('#deleteSeguimientoModal').modal('show');
    })

    $('#delete_seguimiento').click(function(){
        console.log($('#delete_seguimiento').val());
        
        $.ajax({
            type:'POST',
            url:'./delete_seguimiento/'+$('#delete_seguimiento_id').val(),
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){
                        $('#deleteSeguimientoModal').modal('hide');
                        $('#container_seguimiento_'+data.seguimiento.id).remove()
                        $('#notificationDeleteSeguimiento').modal('show');
                        
                    }
                }
        });

    });

    $('.confirm_delete_activity').click(function(){
        $('#delete_activity_id').val($(this).val())

        $('#deleteActivityModal').modal('show');
    });

    $('#delete_activity').click(function(){
        $.ajax({
            type:'POST',
            url:'./delete_activity/'+$('#delete_activity_id').val(),
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){
                        $('#tr_activity_'+data.actividad.id).remove()
                        $('#deleteActivityModal').modal('hide');
                        $('#notificationDeleteSeguimiento').modal('show');
                    }
                }
        });
    });

    $('.close_plan').click(function(){
        $.ajax({
            type:'POST',
            url:'./close_plan/'+$(this).val(),
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){
                        var div = ''+
                            '<div id="msg_notification_close"class="alert  '+data.class+'">'+
                                data.msg
                            '</div>'+
                        '';

                        $('#addMsg').html(div)

                        $('#modal_notification_close').modal('show')
                        $('.plan_cerrado_'+data.seguimiento.id).hide();
                        $('#title_notification_'+data.seguimiento.id).show();

                    } else{
                        var div = ''+
                            '<div id="msg_notification_close"class="alert  '+data.class+'">'+
                                data.msg
                            '</div>'+
                        '';

                        $('#addMsg').html(div)

                        $('#modal_notification_close').modal('show')
                    }
                    
                }
        });
    });

    function validate(data) {


        for (let i = 0; i < data.length; i++) {
            const element = data[i];
            sendForm = true
        
            if(element.val() === ''){
                sendForm = false
                id = element.attr('id')
                $('#container_'+id).removeClass('has-success')
                $('#container_'+id).addClass('has-error')
                $('#container_'+id+' p').html('Este campo no puede estar vacío')
            }else{
                id = element.attr('id')
                $('#container_'+id).removeClass('has-error')
                $('#container_'+id).addClass('has-success')
                $('#container_'+id+' p').html('')
                
            }


            
        }


        if(sendForm){
                $('#modalNotification').modal('show');

                data = {
                    user_id : $('#user_id').val(),
                    valoracion_id: $('#valoracion_id').val(),
                    lider_id: $('#lider_id').val(),
                    plan_id: $('#plan_id').val(),
                    situacion_presentada :  $('#situacion_presentada').val(),
                    aspecto_a_mejorar :     $('#aspecto_a_mejorar').val(),
                    accion_a_tomar :        $('#accion_a_tomar').val(),
                    fecha_seguimiento :     $('#fecha_seguimiento').val()
                }
                $.ajax({
                    type:'POST',
                    url:'./save',
                    data: data,
                        success:function(data){ 

                            if(data.status == 'ok'){

                                

                                var URLactual = window.location.href;
                                window.location.href = URLactual+'?save=200';

                            }

                            $('.open_activities').click(function() {
                                data= {
                                    seguimiento_id: $(this).val()
                                }

                                $('#seguimiento_id').val($(this).val())
                                $('#myModalActivities').modal('show')

                                $.ajax({
                                    type:'POST',
                                    url:'./select_activities',
                                    data: data,
                                        success:function(data){ 
                                            console.log(data);
                                            if(data.status == 'ok'){
                                                $('#addActivity').html('');
                                                for (let i = 0; i < data.actividades.length; i++) {
                                                    const element = data.actividades[i]['actividad'];
                                                    var row = ''+
                                                        '<li class="list-group-item">'+
                                                            '<p> seguimiento: '+data.actividades[i]['actividad']+'</p>'+ 
                                                            '<p> observaciones: '+data.actividades[i]['observaciones']+'</p>'+
                                                            '<p> fecha: '+data.actividades[i]['fecha']+'</p>'+
                                                        '</li>'+
                                                    '';
                                                    $('#addActivity').append(row);
                                                }
                                            }
                                        }
                                });
                            })

                            $('.open_manager_activities').click(function() {
                                    data= {
                                        seguimiento_id: $(this).val()
                                    }

                                    $('#seguimiento_id').val($(this).val())
                                    $('#addActivities').html('');
                                    $('#modalActivities').modal('show')

                                    $.ajax({
                                        type:'POST',
                                        url:'./select_activities',
                                        data: data,
                                            success:function(data){ 
                                                console.log(data);
                                                if(data.status == 'ok'){
                                                
                                                    if(data.actividades.length > 0){
                                                        for (let i = 0; i < data.actividades.length; i++) {
                                                            const element = data.actividades[i]['actividad'];
                                                            
                                                            
                                                            if ( data.actividades[i]['cerrado'] == 0) {
                                                                row = ''+
                                                                    '<li class="list-group-item">'+
                                                                        '<span class="badge my-baged" id="baged_'+data.actividades[i]['id']+'">'+
                                                                                '<button onclick="close_activity('+data.actividades[i]['id']+')" value="'+data.actividades[i]['id']+'" class="btn btn-success close_activity">cerrar</button>'+
                                                                        '</span>'+
                                                                        '<p> actividad: '+data.actividades[i]['actividad']+'</p>'+ 
                                                                        '<p> observaciones: '+data.actividades[i]['observaciones']+'</p>'+
                                                                        '<p> fecha: '+data.actividades[i]['fecha']+'</p>'+
                                                                    '</li>'+
                                                                '';
                                                                
                                                            } else {

                                                                row = ''+
                                                                    '<li class="list-group-item">'+
                                                                        '<span class="badge my-baged" id="baged_'+data.actividades[i]['id']+'" >cerrado</span>'+
                                                                        '<p> actividad: '+data.actividades[i]['actividad']+'</p>'+ 
                                                                        '<p> observaciones: '+data.actividades[i]['observaciones']+'</p>'+
                                                                        '<p> fecha: '+data.actividades[i]['fecha']+'</p>'+
                                                                    '</li>'+
                                                                '';
                                                            
                                                            }
                                                            
                                                            $('#addActivities').append(row);
                                                    
                                                        }
                                                    }else{
                                                        $('#addActivities').html('<p class="alert alert-warning">No hay actividades creadas<p>');
                                                    }
                                                }
                                            }
                                    });
                                
                            });

                        }
                    });
            }
    }

    function close_activity(id) {
            data= {
                actividad_id: id
            }

            $.ajax({
                type:'POST',
                url:'./close_activities',
                data: data,
                    success:function(data){ 
                        console.log(data);
                        if(data.status == 'ok'){
                            console.log(data);
                            $('#state_activity_'+data.actividad['id']).html( '<span  class="label label-success">cerrado</span>' )
                        }
                    }
            });
        
    }
</script>
@endsection