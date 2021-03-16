@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">



<input id="user_id" type="hidden" value="{{$user->id}}" >

<div class="col-md-12 card">
    <div class="col-md-12">
        @if (!empty($evaluacion))
            @foreach ($evaluacion as $key => $eva)
                <h3>Calificar autoevaluación: {{$user->cargo->cargo}} </h3>
            @endforeach
        @endif
    </div>

    <div class="col-md-6">
        <p> <strong>Nombres Completos:</strong>  {{$user->name.' '.$user->apellido}} </p>
    </div>
    <div class="col-md-6">
        <p> <strong>Fecha:</strong>  {{date("m/d/y")}}</p>
    </div>

    <div class="col-md-12">
        <p>
            Califique de 1 a 5 los siguientes factores, teniendo en cuenta que 1 es la menor calificacion con respecto al nivel de observacion y 5 es la mayor:</p>
        </p>
    </div>
</div>

<div class="col-md-12">
    <br>
    <br>
</div>

<div class="">
    <form method="POST" action="{{ route('save_autoevaluacion') }}">
        {{ csrf_field() }}
        @if (!empty($evaluacion))
            @foreach ($evaluacion as $key => $eva)
            <!-competencia A-->
            @if (!empty($eva->comp_a)) 
                <div class="col-md-12 card">
                    
                        <input id="evaluacion_id" type="hidden" value="{{$eva->id}}" name="evaluacion_id">
                        <br>
                    <p class="title_competency">
                        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
                        <strong>
                                Competencia  {{$eva->comp_a->competencia }} 
                        </strong>
                    </p>

                    <p>
                        {{$eva->comp_a->descripcion}}
                    </p>
                            
                    <table class="table table-condensed">
                        <thead>
                            <th>Comportamiento</th>
                            <th>Calificación</th>
                            <th>Observaciones</th>
                        </thead>
                        <tbody>
                            @if (!empty($eva->comp_a))  
                                @if (!empty($eva->comp_a->comportamientos))
                                    @foreach ($eva->comp_a->comportamientos as $key => $comportamiento)
                                        <tr>
                                            <td style="width: 60%;">{{$comportamiento->comportamiento }} </td>
                                            <td class="contenedor_td">
                                                <input class="comportamiento_id" type="hidden" name="autoevaluacion[0][comportamiento][{{$key}}][comportamiento_id]" value="{{$comportamiento->id}} ">
                                                <input class="competencia_id" type="hidden" name="autoevaluacion[0][comportamiento][{{$key}}][competencia_id]" value="{{$eva->comp_a->id}} ">
                                                <select  name="autoevaluacion[0][comportamiento][{{$key}}][respuesta]" class="form-control control_change select_comportamiento_{{ $comportamiento->id }}" >
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select> 
                                            </td>
                                            <td class="contenedor_td_textarea">
                                                <input class="comportamiento_id" type="hidden"  class="comportamiento_id" value="{{$comportamiento->id}} ">
                                                <input class="competencia_id" type="hidden"value="{{$eva->comp_a->id}} ">
                                                <textarea name="autoevaluacion[0][comportamiento][{{$key}}][observaciones]" class="form-control observaciones texarea_comportamiento_{{ $comportamiento->id }}" rows="2" id="comment"></textarea>
                                            </td>
                                        </tr>
                                    @endforeach  
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            @endif
            
            <div class="col-md-12">
                <br>
                <br>
            </div>

            <!-competencia B-->
            @if (!empty($eva->comp_b)) 
                <div class="col-md-12 card">
                    <br>
                    <p class="title_competency">
                        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
                        <strong >
                                Competencia  {{$eva->comp_b->competencia }} 
                        </strong>
                    </p>

                    <p >
                        {{$eva->comp_b->descripcion}}
                    </p>
                            
                    <table class="table table-condensed">
                        <thead>
                            <th style="text-align: center">Comportamiento</th>
                            <th style="text-align: center">Calificación</th>
                            <th style="text-align: center">observaciones</th>
                        </thead>
                        <tbody>
                            
                                @if (!empty($eva->comp_b->comportamientos))
                                    @foreach ($eva->comp_b->comportamientos as $key => $comportamiento)
                                    <tr>
                                        <td style="width: 60%;">{{$comportamiento->comportamiento }} </td>
                                        <td class="contenedor_td">
                                            <input class="comportamiento_id" type="hidden" name="autoevaluacion[1][comportamiento][{{$key}}][comportamiento_id]" value="{{$comportamiento->id}} ">
                                            <input class="competencia_id" type="hidden" name="autoevaluacion[1][comportamiento][{{$key}}][competencia_id]" value="{{$eva->comp_b->id}} ">
                                            <select  name="autoevaluacion[1][comportamiento][{{$key}}][respuesta]" class="form-control control_change select_comportamiento_{{ $comportamiento->id }}"" id="">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select> 
                                        </td>
                                        <td class="contenedor_td_textarea">
                                            <input class="comportamiento_id" type="hidden"  class="comportamiento_id" value="{{$comportamiento->id}} ">
                                            <input class="competencia_id" type="hidden"value="{{$eva->comp_b->id}} ">
                                            <textarea name="autoevaluacion[1][comportamiento][{{$key}}][observaciones]" class="form-control observaciones texarea_comportamiento_{{ $comportamiento->id }}" rows="2" id="comment"></textarea>
                                        </td>
                                    </tr>
                                    @endforeach  
                                @endif
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="col-md-12">
                <br>
                <br>
            </div>

            <!-competencia C-->
            @if (!empty($eva->comp_c)) 
                <div class="col-md-12 card">
                    <br>
                    <p class="title_competency">
                        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
                        <strong>
                                Competencia  {{$eva->comp_c->competencia }} 
                        </strong>
                    </p>

                    <p >
                        {{$eva->comp_c->descripcion}}
                    </p>
                        
                    <table class="table table-condensed">
                        <thead>
                            <th>Comportamiento</th>
                            <th>Calificación</th>
                            <th>Observaciones</th>
                        </thead>
                        <tbody>
                            
                                @if (!empty($eva->comp_c->comportamientos))
                                    @foreach ($eva->comp_c->comportamientos as $key => $comportamiento)
                                    <tr>
                                        <td style="width: 60%;">{{$comportamiento->comportamiento }} </td>
                                        <td class="contenedor_td">
                                            <input class="comportamiento_id" type="hidden" name="autoevaluacion[2][comportamiento][{{$key}}][comportamiento_id]" value="{{$comportamiento->id}} ">
                                            <input class="competencia_id" type="hidden" name="autoevaluacion[2][comportamiento][{{$key}}][competencia_id]" value="{{$eva->comp_c->id}} ">
                                            <select  name="autoevaluacion[2][comportamiento][{{$key}}][respuesta]" class="form-control control_change select_comportamiento_{{ $comportamiento->id }}"" id="">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select> 
                                        </td>
                                        <td class="contenedor_td_textarea">
                                            <input class="comportamiento_id" type="hidden"  class="comportamiento_id" value="{{$comportamiento->id}} ">
                                            <input class="competencia_id" type="hidden"value="{{$eva->comp_c->id}} ">
                                            <textarea name="autoevaluacion[2][comportamiento][{{$key}}][observaciones]" class="form-control observaciones texarea_comportamiento_{{ $comportamiento->id }}" rows="2" id="comment"></textarea>
                                        </td>
                                    </tr>
                                    @endforeach  
                                @endif
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="col-md-12">
                <br>
                <br>
            </div>

            <!-competencia D-->
            @if (!empty($eva->comp_d)) 
                <div class="col-md-12 card">
                    <br>
                    <p class="title_competency">
                        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
                        <strong>
                                Competencia  {{$eva->comp_d->competencia }} 
                        </strong>
                    </p>

                    <p >
                        {{$eva->comp_d->descripcion}}
                    </p>
                        
                    <table class="table table-condensed">
                        <thead>
                            <th>Comportamiento</th>
                            <th>Calificación</th>
                            <th>Observaciones</th>
                        </thead>
                        <tbody>
                            
                                @if (!empty($eva->comp_d->comportamientos))
                                    @foreach ($eva->comp_d->comportamientos as $key => $comportamiento)
                                    <tr>
                                        <td style="width: 60%;">{{$comportamiento->comportamiento }} </td>
                                        <td class="contenedor_td">
                                            <input class="comportamiento_id" type="hidden" name="autoevaluacion[3][comportamiento][{{$key}}][comportamiento_id]" class="comportamiento_id" value="{{$comportamiento->id}} ">
                                            <input class="competencia_id" type="hidden" name="autoevaluacion[3][comportamiento][{{$key}}][competencia_id]" value="{{$eva->comp_d->id}} ">
                                            <select  name="autoevaluacion[3][comportamiento][{{$key}}][respuesta]" class="form-control control_change select_comportamiento_{{ $comportamiento->id }}" >
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select> 
                                        </td>
                                        <td class="contenedor_td_textarea">
                                            <input class="comportamiento_id" type="hidden"  class="comportamiento_id" value="{{$comportamiento->id}} ">
                                            <input class="competencia_id" type="hidden"value="{{$eva->comp_d->id}} ">
                                            <textarea name="autoevaluacion[3][comportamiento][{{$key}}][observaciones]" class="form-control observaciones texarea_comportamiento_{{ $comportamiento->id }}" rows="2" id="comment"></textarea>
                                        </td>
                                    </tr>
                                    @endforeach  
                                @endif
                        </tbody>
                    </table>
                </div>
                @endif

            <!--End For and if-->
            @endforeach
        @endif


        <button  type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success">Enviar Respuestas</button>


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        Confirmar Respuestas?
                    </div>
                    <button  type="submit" class="btn btn-success">Enviar Respuestas </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No enviar respuestas</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    evaluacion_id = $('#evaluacion_id').val()
    user_id = $('#user_id').val()


    data= {
        evaluacion_id: evaluacion_id,
        user_id: user_id,
    }

    $.ajax({
            type:'GET',
            url:'./temporal_evaluacion',
            data: data,
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){
                        console.log(data.evaluacion.respuestas);
                        resp = data.evaluacion.respuestas
                        for (let i = 0; i < resp.length; i++) {
                            const comp_id = resp[i]['comportamiento_id'];
                            const punt = resp[i]['puntuacion'];
                            const obs = resp[i]['observaciones'];

                            $('.select_comportamiento_'+comp_id).val(punt)
                            if(obs == 'nullo'){
                                $('.texarea_comportamiento_'+comp_id).val('')
                            }else{
                                $('.texarea_comportamiento_'+comp_id).val(obs)                                    
                            }
                            console.log($('.select_comportamiento_'+comp_id));
                            
                        }
                    }
                }
        });


})



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});





$('.control_change').change( function(){
    
    value = $(this).val()
    comportamiento_id = $(this).parent('.contenedor_td').find('.comportamiento_id').val()
    competencia_id = $(this).parent('.contenedor_td').find('.competencia_id').val()
    evaluacion_id = $('#evaluacion_id').val()
    user_id = $('#user_id').val()
    console.log(user_id);


    data= {
        user_id: user_id,
        value: value,
        comportamiento_id: comportamiento_id,
        competencia_id: competencia_id,
        evaluacion_id: evaluacion_id,
        observaciones: 'nullo'
    }


    
    $.ajax({
            type:'POST',
            url:'./temporal_evaluacion',
            data: data,
                success:function(data){ 
                    console.log(data);
                    
                    if(data.status == 'ok'){
                        console.log(data);
                        
                      
                    }
                }
        });
    /* */
});


$('.observaciones').focusout( function(){
    
    observaciones = $(this).val()
    comportamiento_id = $(this).parent('.contenedor_td_textarea').find('.comportamiento_id').val()
    competencia_id = $(this).parent('.contenedor_td_textarea').find('.competencia_id').val()
    evaluacion_id = $('#evaluacion_id').val()
    user_id = $('#user_id').val()

    data= {
        user_id: user_id,
        value: 'nullo',
        comportamiento_id: comportamiento_id,
        competencia_id: competencia_id,
        evaluacion_id: evaluacion_id,
        observaciones: observaciones
    }
    
    $.ajax({
            type:'POST',
            url:'./temporal_evaluacion',
            data: data,
                success:function(data){ 
                    console.log(data);
                    if(data.status == 'ok'){
                        console.log(data);
                    }
                }
        });
    /* */
});



</script>
@endsection