@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<a style="float: right" href="{{ route('plan_trabajo_admin_user', $seguimiento->plan->valoracion->user) }}" class="btn btn-primary">volver</a>

<br>
<br>

<div class="card">
    <div style="text-align: center">
        <h3>
            Lista de seguimientos de <br>
        </h3>
        <p>
            {{$seguimiento->plan->valoracion->user->name.' '.$seguimiento->plan->valoracion->user->apellido }}
        </p>
    </div>

</div>

    <br>
    <br>



         <div class="">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title row">
                                            <div class="col-md-6">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$seguimiento->id}}">
                                                    {{ $seguimiento->situacion_presentada }} 
                                                </a>
                                            </div>

                                      

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




@endsection