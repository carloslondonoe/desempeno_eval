@extends('crudbooster::admin_template')
@section('content')
@php
    use App\Evaluacion;
@endphp
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card">
    <table class="table table-condensed">
        <thead>
            <th>Titulo</th>
            <th>Cargo</th>
            <th></th>
        </thead>
        <tbody>
    
    
    
    
    
                <tr>
                        <td> {{ $user->valoraciones->last()->evaluacion->titulo}} </td>
                        <td> {{$user->cargo->cargo}} </td>
                
                        @if ( sizeof($user->valoraciones) > 0)
                            <?php
                                        
                                $date_start = new \DateTime($user->valoraciones->last()->created_at);
                                $hoy = new \DateTime();
                                $annos = $hoy->diff($date_start);
    
                                if($user->valoraciones->last()->evaluacion->formato == 'd'){
                                    if($annos->d <= $user->valoraciones->last()->evaluacion->duracion){ 
                            ?>
                                
                                <td>
                                    <a class="btn btn-primary" href="{{ URL::to('/reporte_final/'.$user->valoraciones->last()->id) }}"> 
                                        Reporte General 
                                        ( {{   date('Y', strtotime($user->valoraciones->last()->created_at))  }} {{ ' - ' }} {{ $user->valoraciones->last()->periodo }} ) 
                                    </a>
                                </td>
                            <?php
                                    }else {
                            ?>
                                @if (sizeof($user->autoevaluaciones) == 0 || sizeof($user->autoevaluacioncoordinador) == 0)
                                    <!--AutoEvaluacion -->
                                    @if ($user->autoevaluaciones->last() != null)
                                        <td>
                                            <span class="label label-primary">Evaluado por el empleado</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="label label-warning">Pendiente por autoevaluación</span>
                                        </td>
                                    @endif
    
                                    <!--Evaluación coordinador -->
                                    @if ($user->autoevaluacioncoordinador->last() != null)
                                        <td>
                                            <span class="label label-primary">Evaluado por parte del jefe</span>
                                        </td>
                                    @else
                                        <td>
                                                <span class="label label-warning">Pendiente por evaluación jefe</span>
                                        </td>
                                    @endif
                                @else 
                                    <td colspan="2">
                                        <span class="label label-warning">Pendiente por valoración final</span>
                                    </td>
                                @endif
                            <?php           
                                    }
                                }
                            ?>
    
    
                            <?php
                            if($user->valoraciones->last()->evaluacion->formato == 'm'){
                                    if($annos->m <= $user->valoraciones->last()->evaluacion->duracion){ 
                            ?>
                                
                                <td>
                                        <a class="btn btn-primary" href="{{ URL::to('/reporte_final/'.$user->valoraciones->last()->id) }}"> 
                                            Reporte General 
                                            ( {{   date('Y', strtotime($user->valoraciones->last()->created_at))  }} {{ ' - ' }} {{ $user->valoraciones->last()->periodo }} ) 
                                        </a>
                                </td>
                            <?php
                                    }else {
                            ?>
                                @if (sizeof($user->autoevaluacionevaluada) == 0 || sizeof($user->autoevaluacioncoordinador) == 0)
                                    <!--AutoEvaluacion -->
                                    @if ($user->autoevaluaciones != null)
                                        <td>
                                            <span class="label label-primary">Evaluado por el empleado</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="label label-warning">Pendiente por autoevaluación</span>
                                        </td>
                                    @endif
    
                                    <!--Evaluación coordinador -->
                                    @if ($user->autoevaluacioncoordinador->last() != null)
                                        <td>
                                            <span class="label label-primary">Evaluado por parte del jefe</span>
                                        </td>
                                    @else
                                        <td>
                                                <span class="label label-warning">Pendiente por evaluación jefe</span>
                                        </td>
                                    @endif
                                @else 
                                    <td colspan="2">
                                        <span class="label label-warning">Pendiente por valoración final</span>
                                    </td>
                                @endif
                            <?php           
                                    }
                                }
                            ?>    
    
                            <?php
                            if($user->valoraciones->last()->evaluacion->formato == 'y'){
                                    if($annos->y <= $user->valoraciones->last()->evaluacion->duracion){ 
                            ?>
                                
                                <td>
                                        <a class="btn btn-primary" href="{{ URL::to('/reporte_final/'.$user->valoraciones->last()->id) }}"> 
                                        Reporte General 
                                        ( {{   date('Y', strtotime($user->valoraciones->last()->created_at))  }} {{ ' - ' }} {{ $user->valoraciones->last()->periodo }} ) 
                                        </a>
                                </td>
                            <?php
                                    }else {
                            ?>
                                @if (sizeof($user->autoevaluacionevaluada) == 0 || sizeof($user->autoevaluacioncoordinador) == 0)
                                    <!--AutoEvaluacion -->
                                    @if ($user->autoevaluaciones != null)
                                        <td>
                                            <span class="label label-primary">Evaluado por el empleado</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="label label-warning">Pendiente por autoevaluación</span>
                                        </td>
                                    @endif
    
                                    <!--Evaluación coordinador -->
                                    @if ($user->autoevaluacioncoordinador->last() != null)
                                        <td>
                                            <span class="label label-primary">Evaluado por parte del jefe</span>
                                        </td>
                                    @else
                                        <td>
                                                <span class="label label-warning">Pendiente por evaluación jefe</span>
                                        </td>
                                    @endif
                                @else 
                                    <td >
                                            <span class="label label-warning">Pendiente por valoración final</span>
                                    </td>
                                @endif
                            <?php           
                                    }
                                }
                            ?>    
                       
                        @else
                            @if (sizeof($user->autoevaluaciones) == 0 || sizeof($user->autoevaluacioncoordinador) == 0)
                                <!--AutoEvaluacion -->
                                @if ($user->autoevaluaciones->last() != null)
                                    <td>
                                        <span class="label label-primary">Evaluado</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="label label-warning">Pendiente por evaluar</span>
                                    </td>
                                @endif
    
                                <!--Evaluación coordinador -->
                                @if ($user->autoevaluacioncoordinador->last() != null)
                                    <td>
                                        <span class="label label-primary">Evaluado</span>
                                    </td>
                                @else
                                    <td>
                                            <span class="label label-warning">Pendiente por autoevaluación por parte del jefe</span>
                                    </td>
                                @endif
                            @else 
                                <td >
                                    <span class="label label-warning">Pendiente por valoración final</span>
                                </td>
                            @endif
                        @endif
                    </tr>
    
    
    
    
        </tbody>
    </table>
</div>
{{ $autoevaluaciones->links() }}




@endsection