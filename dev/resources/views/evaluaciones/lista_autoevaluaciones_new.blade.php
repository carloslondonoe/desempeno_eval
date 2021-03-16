@extends('crudbooster::admin_template')
@section('content')
@php
    use App\Evaluacion;
@endphp
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card box-body table-responsive no-padding">

    <h2>Registro de evaluaciones</h2>

    <table class="table table-hover table-striped table-bordered">
        <thead>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>Evaluación</th>
            <th colspan="2"></th>
        </thead>
        <tbody>

                @foreach ($users as $user)
                <tr>
                    <td> {{ $user->apellido  }}</td>
                    <td>{{$user->name}}</td>
                    <td> {{$user->cargo->cargo}} </td>
                    <td>{{ $user->valoraciones->last()->evaluacion->titulo}} </td>
                    @if ( sizeof($user->valoraciones) > 0)
                        <?php

                            $date_start = new \DateTime($user->valoraciones->last()->created_at);
                            $hoy = new \DateTime();
                            $annos = $hoy->diff($date_start);

                            if($user->valoraciones->last()->evaluacion->formato == 'd'){
                                if($annos->d < $user->valoraciones->last()->evaluacion->duracion){
                        ?>
                            <td>
                                <a href="{{ route('plan_trabajo', $user->valoraciones->last()) }}" class="btn btn-primary">Plan de trabajo</a>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ URL::to('/reporte_final/'.$user->autoevaluaciones->last()->id.'/'.$user->autoevaluacioncoordinador->last()->id.'/'.$user->valoraciones->last()->id) }}"> Reporte General </a>
                            </td>
                        <?php
                                }else {
                        ?>
                            @if (sizeof($user->autoevaluacionevaluada) < 0 || sizeof($user->autoevaluacioncoordinador) < 0)
                                <!--AutoEvaluacion -->
                                @if ($user->autoevaluacioncoordinador != null)
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
                                        <span class="label label-primary">Evaluado</span>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('calificar_autoevaluacion', $user) }}" class="btn btn-warning">Calificar</a>
                                    </td>
                                @endif
                            @else
                                <td colspan="2">
                                    <a href="{{ route('valorar_evaluacion', $user->autoevaluaciones->last()) }}" class="btn btn-warning">valoración final</a>
                                </td>
                            @endif
                        <?php
                                }
                            }
                        ?>


                        <?php
                        if($user->valoraciones->last()->evaluacion->formato == 'm'){
                                if($annos->m < $user->valoraciones->last()->evaluacion->duracion){
                        ?>
                            <td>
                                <a href="{{ route('plan_trabajo', $user->valoraciones->last()) }}" class="btn btn-primary">Plan de trabajo</a>
                            </td>
                            <td>
                                    <a class="btn btn-primary" href="{{ URL::to('/reporte_final/'.$user->autoevaluaciones->last()->id.'/'.$user->autoevaluacioncoordinador->last()->id.'/'.$user->valoraciones->last()->id) }}"> Reporte General </a>
                            </td>
                        <?php
                                }else {
                        ?>
                            @if (sizeof($user->autoevaluacionevaluada) < 0 || sizeof($user->autoevaluacioncoordinador) < 0)
                                <!--AutoEvaluacion -->
                                @if ($user->autoevaluacioncoordinador != null)
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
                                        <span class="label label-primary">Evaluado</span>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('calificar_autoevaluacion', $user) }}" class="btn btn-warning">Calificar</a>
                                    </td>
                                @endif
                            @else
                                <td colspan="2">
                                    <a href="{{ route('valorar_evaluacion', $user->autoevaluaciones->last()) }}" class="btn btn-warning">valoración final</a>
                                </td>
                            @endif
                        <?php
                                }
                            }
                        ?>

                        <?php
                        if($user->valoraciones->last()->evaluacion->formato == 'y'){
                                if($annos->y < $user->valoraciones->last()->evaluacion->duracion){
                        ?>
                            <td>
                                <a href="{{ route('plan_trabajo', $user->valoraciones->last()) }}" class="btn btn-primary">Plan de trabajo</a>
                            </td>
                            <td>
                                    <a class="btn btn-primary" href="{{ URL::to('/reporte_final/'.$user->autoevaluaciones->last()->id.'/'.$user->autoevaluacioncoordinador->last()->id.'/'.$user->valoraciones->last()->id) }}"> Reporte General </a>
                            </td>
                        <?php
                                }else {
                        ?>
                            @if (sizeof($user->autoevaluacionevaluada) < 0 || sizeof($user->autoevaluacioncoordinador) < 0)
                                <!--AutoEvaluacion -->
                                @if ($user->autoevaluacioncoordinador != null)
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
                                        <span class="label label-primary">Evaluado</span>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('calificar_autoevaluacion', $user) }}" class="btn btn-warning">Calificar</a>
                                    </td>
                                @endif
                            @else
                                <td colspan="2">
                                    <a href="{{ route('valorar_evaluacion', $user->autoevaluaciones->last()) }}" class="btn btn-warning">valoración final</a>
                                </td>
                            @endif
                        <?php
                                }
                            }
                        ?>

                    @else
                    <td> sfsd </td>
                        @if (sizeof($user->autoevaluacionevaluada) < 0 || sizeof($user->autoevaluacioncoordinador) < 0)
                            <!--AutoEvaluacion -->
                            @if ($user->autoevaluacioncoordinador != null)
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
                                    <span class="label label-primary">Evaluado</span>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('calificar_autoevaluacion', $user) }}" class="btn btn-warning">Calificar</a>
                                </td>
                            @endif
                        @else
                            <td>Evaluar</td>
                        @endif
                    @endif
                </tr>
                @endforeach
        </tbody>
    </table>
</div>
@endsection
