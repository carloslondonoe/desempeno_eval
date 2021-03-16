@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="col-md-12 card">
    <p class="title_competency">                          
        <strong>
               Mis planes de trabajo
        </strong>
    </p>

    <div class="col-md-4">
        <strong>Nombres Completos:</strong>  {{$user->name.' '.$user->apellido}}
    </div>

</div>

<div class="col-md-12">
    <br>
</div>
@foreach ($years as $year)
    
 <div class="card col-md-12">

 

            <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h4 class="panel-title">
                            
                            <button value="{{ $year }}" type="button" class="btn btn-primary select_date"> {{ $year }} </button>
                            <input type="hidden" id="input_value_{{$year}}" value="0">
                        </h4>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <br>
                        </div>

                        <div id="collapse_{{ $year }}" class="panel-collapse collapse ">
                                @foreach ($user->valoraciones as $valoracion)
                                    @if ($valoracion->planes != null)
                                            @if ( date("Y", strtotime($valoracion->planes->created_at)) == $year )
                                                

                                                    @foreach ($valoracion->planes->seguimientos as $seguimiento)
                                                        <div class="col-md-12">
                                                            <div class="panel-group" id="accordion">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title row">
                                                                            <div class="col-md-6">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$seguimiento->id}}">
                                                                                    {{ $seguimiento->situacion_presentada }} 
                                                                                </a>
                                                                            </div>
                        
                                                                            @if ($seguimiento->estado == 'pendiente')
                                                                            <div class="col-md-6">
                                                                                <a id='state_notification_{{ $seguimiento->id }}'  class="btn btn-success " href="{{ route('show_state_seguimiento', $seguimiento) }}">
                                                                                    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Aceptar Plan de trabajo
                                                                                </a>
                                                                            </div>
                                                                            @endif
                        
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse_{{$seguimiento->id}}" class="panel-collapse collapse ">
                                                                        <div class="">
                                                                            
                        
                        
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
                                                                                    
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                        
                        
                                                                            <!-- Table -->
                                                                            @if (!empty($seguimiento->actividades))   
                                                                            <div class="">
                                        
                                                                                
                                        
                                                                                <table class="table table-responsive" id="table_actividades">
                                                                                    <thead>
                                                                                        <th>Seguimiento</th>
                                                                                        <th>Observaciones</th>
                                                                                        <th>Fecha de seguimiento</th>
                                                                                    </thead>
                                                                                    <tbody id="addActivity_{{ $seguimiento->id }}">
                                                                                        @foreach ($seguimiento->actividades as $actividad)
                                                                                            <tr id="tr_activity_{{ $actividad->id }}">
                                                                                                <td id="td_actividad_{{ $actividad->id }}">{{ $actividad->actividad }}</td>
                                                                                                <td id="td_observaciones_{{ $actividad->id }}">{{ $actividad->observaciones }}</td>
                                                                                                <td id="td_fecha_{{ $actividad->id }}">{{ $actividad->fecha }}</td>
                                                                                            {{-- @if (!$seguimiento->cerrado)
                                                                                                    <td style="text-align:center" id="state_activity_{{ $actividad->id }}">
                                                    
                                                                                                        @if ($actividad->cerrado)
                                                                                                            <button  class="btn btn-success plan_cerrado">
                                                                                                                Actividad cerrada    
                                                                                                            </button>
                                                                                                        @else
                                                                                                            <button  class="btn btn-warning ">
                                                                                                                    Actividad abierta    
                                                                                                            </button>
                                                                                                        @endif
                                                    
                                                                                                    </td>
                                                                                                @else 
                                                                                                    <td>
                                                                                                        <button  class="btn btn-success ">
                                                                                                            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Actividad cerrada    
                                                                                                        </button>
                                                                                                    </td>
                                                                                                @endif --}}
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            @endif
                    
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        
                                                        
                                            @endif
                                    
                                    @endif
                                @endforeach
                        </div>
                    </div>
            </div>
    </div>
@endforeach

<script>

$('.select_date').click(function(){
    
    value = $(this).val()
    sw = $('#input_value_'+value).val()
    
    console.log(value);
    $('.ocultar').hide()
    if(sw == '0'){
        $('#input_value_'+value).val('1')
        $('#collapse_'+value).addClass('in')
    }else{
        $('#input_value_'+value).val('0')
        $('#collapse_'+value).removeClass('in')
    }
});
</script>

@endsection


