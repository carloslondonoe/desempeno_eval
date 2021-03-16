@extends('crudbooster::admin_template')
@section('content')
@php
    use App\Evaluacion;
    use App\Seguimiento;
    use App\PlanTrabajo;



@endphp
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card box-body table-responsive no-padding">

    <h2>Registro de evaluaciones</h2>

    <table class="table table-hover table-striped table-bordered">
        <thead>
                <th style="text-align: center">Apellido</th>
                <th style="text-align: center">Nombre</th>
                <th style="text-align: center">Cargo</th>
                <th style="text-align: center">Evaluación</th>
                <th colspan="2"  style="text-align: center">Estado</th>
        </thead>
        <tbody>
          <?php
          $mesactual = new \DateTime();
          $mesciclo = date_format($mesactual,'m');

          switch ($mesciclo ) {
            case '12':
              $ciclo = 1;
              break;
              case '11':
                $ciclo = 2;
                break;
                case '10':
                  $ciclo = 2;
                  break;
                  case '9':
                    $ciclo = 2;
                    break;
                    case '8':
                      $ciclo = 2;
                      break;
                      case '7':
                        $ciclo = 2;
                        break;
                        case '6':
                        $ciclo = 2;
                          break;
                          case '5':
                            $ciclo = 2;
                            break;
                            case '4':
                              $ciclo = 1;
                              break;
                              case '3':
                                $ciclo = 1;
                                break;
                                case '2':
                                  $ciclo = 1;
                                  break;
                                  case '1':
                                    $ciclo = 1;
                                    break;

          }

          ?>



                @foreach ($users as $user)
                @if($user->status <> 'Retirado')
                <tr>
                    <td> {{ $user->apellido  }} </td>
                    <td>{{$user->name}}</td>
                    <td> {{$user->cargo->cargo}} </td>
                    <td>{{ $user->valoraciones->last()->evaluacion->titulo}} </td>
                     @endif
                    <?php
                    $planes = Seguimiento::SELECT('plan_de_trabajo.valoracion_id as pp','cerrado')
                                                 ->whereIn('plan_de_trabajo.valoracion_id',array($user->valoraciones->last()->id) )
                                                ->JOIN('plan_de_trabajo','plan_de_trabajo.id','seguimientos.plan_id')
                                                ->get();
                     ?>

                     @foreach ($planes as $pln)



                     @endforeach


                    @if ( sizeof($user->valoraciones) > 0)
                        <?php



                            $evaluacion = Evaluacion::where('idcargo', '=', $user->cargoid)->get();

                            $date_start = new \DateTime($user->valoraciones->last()->created_at);
                            $fecha_eval = date_format($date_start,'m');
                            $fecha_ano= date_format($date_start,'Y');
                            $hoy = new \DateTime();
                            $hoyy = date_format($hoy,'Y');
                            $hoyys = date_format($hoy,'m');
                            $annos = $hoy->diff($date_start);
//echo $user->valoraciones->last()->id;

$error = 0;

      //11nov                      //Fechas fin
                            $fecha_fn1 = new \DateTime($user->valoraciones->last()->evaluacion->fecha);
                            $fecha_fn2 = new \DateTime();
                           $dias = $fecha_fn1->diff($fecha_fn2);


                            if( ($user->valoraciones->last()->evaluacion->formato == 'd') && $user->status <> 'Retirado'){
                                //if((( $user->valoraciones->last()->id) == $pln->pp) && ($pln->cerrado == 0))
                                if(  ($error == 0))
                                {
                        ?>

                            <td>
                                <a href="{{ route('plan_trabajo', $user->valoraciones->last()) }}" class="btn btn-primary"> Plan de trabajo {{$hoyy}}</a>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ URL::to('/reporte_final/'.$user->valoraciones->last()->id) }}"> Reporte General {{$hoyy}}</a>
                            </td>

                            <?php
                          } elseif ((($user->valoraciones->last()->periodo == 2) || ($user->valoraciones->last()->periodo == 1)) && $fecha_ano == $hoyy && $pln->cerrado == 0)  {

                            ?>

                            <td>
                                <a href="{{ route('plan_trabajo', $user->valoraciones->last()) }}" class="btn btn-primary"> Generar Plan de trabajo {{$hoyy}}</a>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ URL::to('/reporte_final/'.$user->valoraciones->last()->id) }}"> Reporte General {{$hoyy}}</a>
                            </td>

                        <?php
                                }


                                else {
                        ?>
                            @if (sizeof($user->autoevaluaciones) == 0 || sizeof($user->autoevaluacioncoordinador) == 0)
                                <!--AutoEvaluacion -->
                                @if ($user->autoevaluaciones->last() != null )
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
                                        <a href="{{ route('calificar_autoevaluacion', $user) }}" class="btn btn-warning">Evaluar</a>
                                    </td>
                                @endif
                            @else
                                <td colspan="2">
                                    <a href="{{ route('valorar_evaluacion', $user->autoevaluaciones->last()->id) }}" class="btn btn-warning">Valoración final</a>
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
                                    <span class="label label-primary">Evaluado por el empleados</span>
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
                                    <a href="{{ route('calificar_autoevaluacion', $user) }}" class="btn btn-warning">Evaluar</a>
                                </td>
                            @endif
                        @else
                            <td colspan="2">
                                <a href="{{ route('valorar_evaluacion', $user->autoevaluaciones->last()->id ) }}" class="btn btn-warning">Valoración final</a>
                            </td>
                        @endif
                    @endif
                </tr>
                @endforeach
        </tbody>
    </table>
</div>
@endsection
