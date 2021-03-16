@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<input id="user_id" type="hidden" value="{{$evaluado->id}}" >

<div class="card">
    <h3>Calificar: {{$evaluado->cargo->cargo }}</h3>
    <div class="col-md-6">
        <p> <strong>Nombres completos:</strong>  {{$evaluado->name.' '.$evaluado->name  }} </p>
    </div>
    <div class="col-md-6">
        <p> <strong>Fecha:</strong>  {{$autoevaluacion->created_at }}</p>
    </div>

    <div class="">
        <p>
            Califique de 1 a 5 los siguientes factores, teniendo en cuenta que 1 es la menor calificación con respecto al nivel de observación y 5 es la mayor:</p>
        </p>
    </div>
</div>


<br>

<form method="POST" action="{{ route('valorar_evaluacion_save') }}">
{{ csrf_field() }}
<input type="hidden" value="{{$evaluado->id}}" name="user_id">
<input type="hidden" value="{{ $autoevaluacion->id }}" name="autoevaluacion_id">
<input type="hidden" value="{{$evaluacion->cargo->id}}" name="cargo_id">


<!-competencia A-->
@if (!empty($evaluacion))
    <div class="card">
        <input type="hidden" value="{{$evaluacion->id}}" name="evaluacion_id">
        <br>
        @if (!empty($evaluacion->comp_a))
        <p>
            <strong>
                    Competencia  {{$evaluacion->comp_a->competencia }} :
            </strong>
        </p>

        <p>
            {{$evaluacion->comp_a->descripcion}}
        </p>

        <table class="table table-condensed">
            <thead>
                    <th style="text-align: center">Comportamiento</th>
                    <th style="text-align: center"> Calificación Líder </th>
                    <th style="text-align: center">Observación Líder</th>
                    <th style="text-align: center"> Calificación colaborador </th>
                    <th style="text-align: center">Observación colaborador</th>
                    <th style="text-align: center">Calificación</th>
                    <th style="text-align: center">Anexar observación</th>
            </thead>
            <tbody>
                @if (!empty($evaluacion->comp_a))
                    @if (!empty($evaluacion->comp_a->comportamientos))
                        @foreach ($evaluacion->comp_a->comportamientos as $key => $comportamiento)
                            <tr>
                                <td style="width: 50%;">{{$comportamiento->comportamiento }} </td>

                                <td style="text-align: center">
                                        @php
                                        $resp_coor = $evaluado->autoevaluacioncoordinador
                                                            ->where('evaluador_id', '=', $user->id)
                                                            ->where('user_id', '=', $evaluado->id)->last();

                                        @endphp
                                        @if ($resp_coor != null)

                                            @foreach ($resp_coor->puntuaciones as $puntuacion)

                                                @if ($puntuacion->comportamiento_id == $comportamiento->id)
                                                    <p style="text-align: center"> {{ $puntuacion->puntuacion }} </p>
                                                                                                      @endif
                                            @endforeach

                                        @endif
                                </td>
                                <td style="text-align: center">
                                        @php
                                        $resp_coor = $evaluado->autoevaluacioncoordinador
                                                            ->where('evaluador_id', '=', $user->id)
                                                            ->where('user_id', '=', $evaluado->id)->last();

                                        @endphp
                                        @if ($resp_coor != null)

                                            @foreach ($resp_coor->puntuaciones as $puntuacion)

                                                @if ($puntuacion->comportamiento_id == $comportamiento->id)
                                                    <p style="text-align: center"> {{ $puntuacion->observaciones }} </p>
                                                                                                      @endif
                                            @endforeach

                                        @endif
                                </td>
                                <td style="text-align: center">
                                        @php
                                        $resp = $autoevaluacion->puntuaciones()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                            ->where('comportamiento_id', '=', $comportamiento->id)->get();
                                        @endphp
                                        @if (!empty($resp))
                                            <p style="text-align: center">{{$resp[0]->observaciones}}</p>
                                        @endif

                                </td>
                                <td style="text-align: center">
                                        @php
                                        $resp = $autoevaluacion->puntuaciones()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                            ->where('comportamiento_id', '=', $comportamiento->id)->get();
                                        @endphp
                                        @if (!empty($resp))
                                            <p style="text-align: center">{{$resp[0]->puntuacion}}</p>
                                        @endif

                                </td>

                                <td class="contenedor_td">
                                    <input class="comportamiento_id" type="hidden" name="autoevaluacion[0][comportamiento][{{$key}}][comportamiento_id]" value="{{$comportamiento->id}} ">
                                    <input class="competencia_id" type="hidden" name="autoevaluacion[0][comportamiento][{{$key}}][competencia_id]" value="{{$evaluacion->comp_a->id}} ">
                                    <select  name="autoevaluacion[0][comportamiento][{{$key}}][respuesta]" class="form-control control_change select_comportamiento_{{ $comportamiento->id }}" id="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </td>

                                <td class="contenedor_td_textarea">
                                    <input class="comportamiento_id" type="hidden"  class="comportamiento_id" value="{{$comportamiento->id}} ">
                                    <input class="competencia_id" type="hidden"value="{{$evaluacion->comp_a->id}} ">
                                    <textarea name="autoevaluacion[0][comportamiento][{{$key}}][observaciones]" class="form-control observaciones texarea_comportamiento_{{ $comportamiento->id }}" rows="1" id="comment"></textarea>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endif
            </tbody>
        </table>
        @endif
    </div>
@endif
<br>
<!-competencia B-->
@if (!empty($evaluacion))
    <div class="card">
        <input type="hidden" value="{{$evaluacion->id}}" name="evaluacion_id">
        <br>
        @if (!empty($evaluacion->comp_b))
        <p>
            <strong>
                    Competencia  {{$evaluacion->comp_b->competencia }} :
            </strong>
        </p>

        <p>
            {{$evaluacion->comp_b->descripcion}}
        </p>

        <table class="table table-condensed">
            <thead>
                    <th>Comportamiento</th>
                    <th> Calificación coordinador </th>
                    <th> Observación Líder </th>
                    <th> Calificación colaborador </th>
                    <th> Observación colaborador</th>
                    <th>Calificación</th>
                    <th>Anexar observación</th>
            </thead>
            <tbody>
                @if (!empty($evaluacion->comp_b))
                    @if (!empty($evaluacion->comp_b->comportamientos))
                        @foreach ($evaluacion->comp_b->comportamientos as $key => $comportamiento)
                            <tr>
                              <td style="width: 50%;">{{$comportamiento->comportamiento }} </td>

                              <td style="text-align: center">
                                      @php
                                      $resp_coor = $evaluado->autoevaluacioncoordinador
                                                          ->where('evaluador_id', '=', $user->id)
                                                          ->where('user_id', '=', $evaluado->id)->last();

                                      @endphp
                                      @if ($resp_coor != null)

                                          @foreach ($resp_coor->puntuaciones as $puntuacion)

                                              @if ($puntuacion->comportamiento_id == $comportamiento->id)
                                                  <p style="text-align: center"> {{ $puntuacion->puntuacion }} </p>
                                                                                                    @endif
                                          @endforeach

                                      @endif
                              </td>
                              <td style="text-align: center">
                                      @php
                                      $resp_coor = $evaluado->autoevaluacioncoordinador
                                                          ->where('evaluador_id', '=', $user->id)
                                                          ->where('user_id', '=', $evaluado->id)->last();

                                      @endphp
                                      @if ($resp_coor != null)

                                          @foreach ($resp_coor->puntuaciones as $puntuacion)

                                              @if ($puntuacion->comportamiento_id == $comportamiento->id)
                                                  <p style="text-align: center"> {{ $puntuacion->observaciones }} </p>
                                                                                                    @endif
                                          @endforeach

                                      @endif
                              </td>
                              <td style="text-align: center">
                                      @php
                                      $resp = $autoevaluacion->puntuaciones()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                          ->where('comportamiento_id', '=', $comportamiento->id)->get();
                                      @endphp
                                      @if (!empty($resp))
                                          <p style="text-align: center">{{$resp[0]->observaciones}}</p>
                                      @endif

                              </td>
                              <td style="text-align: center">
                                      @php
                                      $resp = $autoevaluacion->puntuaciones()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                          ->where('comportamiento_id', '=', $comportamiento->id)->get();
                                      @endphp
                                      @if (!empty($resp))
                                          <p style="text-align: center">{{$resp[0]->puntuacion}}</p>
                                      @endif

                              </td>
                                <td class="contenedor_td">
                                    <input class="comportamiento_id" type="hidden" name="autoevaluacion[1][comportamiento][{{$key}}][comportamiento_id]" value="{{$comportamiento->id}} ">
                                    <input class="competencia_id" type="hidden" name="autoevaluacion[1][comportamiento][{{$key}}][competencia_id]" value="{{$evaluacion->comp_b->id}} ">
                                    <select  name="autoevaluacion[1][comportamiento][{{$key}}][respuesta]" class="form-control control_change select_comportamiento_{{ $comportamiento->id }}" id="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </td>

                                <td class="contenedor_td_textarea">
                                    <input class="comportamiento_id" type="hidden"  class="comportamiento_id" value="{{$comportamiento->id}} ">
                                    <input class="competencia_id" type="hidden"value="{{$evaluacion->comp_b->id}} ">
                                    <textarea name="autoevaluacion[1][comportamiento][{{$key}}][observaciones]" class="form-control observaciones texarea_comportamiento_{{ $comportamiento->id }}" rows="1" id="comment"></textarea>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endif
            </tbody>
        </table>
        @endif
    </div>
@endif
<br>
<!-competencia C-->
@if (!empty($evaluacion))
    <div class="card">
        <input type="hidden" value="{{$evaluacion->id}}" name="evaluacion_id">
        <br>
        @if (!empty($evaluacion->comp_c))
        <p>
            <strong>
                    Competencia  {{$evaluacion->comp_c->competencia }} :
            </strong>
        </p>

        <p>
            {{$evaluacion->comp_c->descripcion}}
        </p>

        <table class="table table-condensed">
            <thead>
              <th style="text-align: center">Comportamiento</th>
<th style="text-align: center"> Calificación Líder </th>
<th style="text-align: center">Observación Líder</th>
<th style="text-align: center"> Calificación colaborador </th>
<th style="text-align: center">Observación colaborador</th>
<th style="text-align: center">Calificación</th>
<th style="text-align: center">Anexar observación</th>
            </thead>
            <tbody>
                @if (!empty($evaluacion->comp_c))
                    @if (!empty($evaluacion->comp_c->comportamientos))
                        @foreach ($evaluacion->comp_c->comportamientos as $key => $comportamiento)
                            <tr>
                              <td style="width: 50%;">{{$comportamiento->comportamiento }} </td>

                              <td style="text-align: center">
                                      @php
                                      $resp_coor = $evaluado->autoevaluacioncoordinador
                                                          ->where('evaluador_id', '=', $user->id)
                                                          ->where('user_id', '=', $evaluado->id)->last();

                                      @endphp
                                      @if ($resp_coor != null)

                                          @foreach ($resp_coor->puntuaciones as $puntuacion)

                                              @if ($puntuacion->comportamiento_id == $comportamiento->id)
                                                  <p style="text-align: center"> {{ $puntuacion->puntuacion }} </p>
                                                                                                    @endif
                                          @endforeach

                                      @endif
                              </td>
                              <td style="text-align: center">
                                      @php
                                      $resp_coor = $evaluado->autoevaluacioncoordinador
                                                          ->where('evaluador_id', '=', $user->id)
                                                          ->where('user_id', '=', $evaluado->id)->last();

                                      @endphp
                                      @if ($resp_coor != null)

                                          @foreach ($resp_coor->puntuaciones as $puntuacion)

                                              @if ($puntuacion->comportamiento_id == $comportamiento->id)
                                                  <p style="text-align: center"> {{ $puntuacion->observaciones }} </p>
                                                                                                    @endif
                                          @endforeach

                                      @endif
                              </td>
                              <td style="text-align: center">
                                      @php
                                      $resp = $autoevaluacion->puntuaciones()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                          ->where('comportamiento_id', '=', $comportamiento->id)->get();
                                      @endphp
                                      @if (!empty($resp))
                                          <p style="text-align: center">{{$resp[0]->observaciones}}</p>
                                      @endif

                              </td>
                              <td style="text-align: center">
                                      @php
                                      $resp = $autoevaluacion->puntuaciones()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                          ->where('comportamiento_id', '=', $comportamiento->id)->get();
                                      @endphp
                                      @if (!empty($resp))
                                          <p style="text-align: center">{{$resp[0]->puntuacion}}</p>
                                      @endif

                              </td>
                                <td class="contenedor_td">
                                    <input class="comportamiento_id" type="hidden" name="autoevaluacion[2][comportamiento][{{$key}}][comportamiento_id]" value="{{$comportamiento->id}} ">
                                    <input class="competencia_id" type="hidden" name="autoevaluacion[2][comportamiento][{{$key}}][competencia_id]" value="{{$evaluacion->comp_c->id}} ">
                                    <select  name="autoevaluacion[2][comportamiento][{{$key}}][respuesta]" class="form-control  control_change select_comportamiento_{{ $comportamiento->id }}" id="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </td>

                                <td class="contenedor_td_textarea">
                                    <input class="comportamiento_id" type="hidden"  class="comportamiento_id" value="{{$comportamiento->id}} ">
                                    <input class="competencia_id" type="hidden"value="{{$evaluacion->comp_c->id}} ">
                                    <textarea name="autoevaluacion[2][comportamiento][{{$key}}][observaciones]" class="form-control observaciones texarea_comportamiento_{{ $comportamiento->id }}" rows="1" id="comment"></textarea>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endif
            </tbody>
        </table>
        @endif
    </div>
@endif
<br>
<!-competencia D-->
@if (!empty($evaluacion))
    <input type="hidden" value="{{$evaluacion->id}}" name="evaluacion_id">
    <br>
    @if (!empty($evaluacion->comp_d))
    <p>
        <strong>
                Competencia  {{$evaluacion->comp_d->competencia }} :
        </strong>
    </p>

    <p>
        {{$evaluacion->comp_d->descripcion}}
    </p>

    <table class="table table-condensed">
        <thead>
          <th>Comportamiento</th>
          <th> Calificación coordinador </th>
          <th> Observación Líder </th>
          <th> Calificación colaborador </th>
          <th> Observación colaborador</th>
          <th>Calificación</th>
          <th>Anexar observación</th>
        </thead>
        <tbody>
            @if (!empty($evaluacion->comp_d))
                @if (!empty($evaluacion->comp_d->comportamientos))
                    @foreach ($evaluacion->comp_d->comportamientos as $key => $comportamiento)
                        <tr>
                          <td style="width: 50%;">{{$comportamiento->comportamiento }} </td>

                          <td style="text-align: center">
                                  @php
                                  $resp_coor = $evaluado->autoevaluacioncoordinador
                                                      ->where('evaluador_id', '=', $user->id)
                                                      ->where('user_id', '=', $evaluado->id)->last();

                                  @endphp
                                  @if ($resp_coor != null)

                                      @foreach ($resp_coor->puntuaciones as $puntuacion)

                                          @if ($puntuacion->comportamiento_id == $comportamiento->id)
                                              <p style="text-align: center"> {{ $puntuacion->puntuacion }} </p>
                                                                                                @endif
                                      @endforeach

                                  @endif
                          </td>
                          <td style="text-align: center">
                                  @php
                                  $resp_coor = $evaluado->autoevaluacioncoordinador
                                                      ->where('evaluador_id', '=', $user->id)
                                                      ->where('user_id', '=', $evaluado->id)->last();

                                  @endphp
                                  @if ($resp_coor != null)

                                      @foreach ($resp_coor->puntuaciones as $puntuacion)

                                          @if ($puntuacion->comportamiento_id == $comportamiento->id)
                                              <p style="text-align: center"> {{ $puntuacion->observaciones }} </p>
                                                                                                @endif
                                      @endforeach

                                  @endif
                          </td>
                          <td style="text-align: center">
                                  @php
                                  $resp = $autoevaluacion->puntuaciones()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                      ->where('comportamiento_id', '=', $comportamiento->id)->get();
                                  @endphp
                                  @if (!empty($resp))
                                      <p style="text-align: center">{{$resp[0]->observaciones}}</p>
                                  @endif

                          </td>
                          <td style="text-align: center">
                                  @php
                                  $resp = $autoevaluacion->puntuaciones()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                      ->where('comportamiento_id', '=', $comportamiento->id)->get();
                                  @endphp
                                  @if (!empty($resp))
                                      <p style="text-align: center">{{$resp[0]->puntuacion}}</p>
                                  @endif

                          </td>

                            <td class="contenedor_td">
                                <input class="comportamiento_id" type="hidden" name="autoevaluacion[3][comportamiento][{{$key}}][comportamiento_id]" value="{{$comportamiento->id}} ">
                                <input class="competencia_id" type="hidden" name="autoevaluacion[3][comportamiento][{{$key}}][competencia_id]" value="{{$evaluacion->comp_d->id}} ">
                                <select  name="autoevaluacion[3][comportamiento][{{$key}}][respuesta]" class="form-control control_change select_comportamiento_{{ $comportamiento->id }}" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>

                            <td class="contenedor_td_textarea">
                                <input class="comportamiento_id" type="hidden"  class="comportamiento_id" value="{{$comportamiento->id}} ">
                                <input class="competencia_id" type="hidden"value="{{$evaluacion->comp_d->id}} ">
                                <textarea name="autoevaluacion[3][comportamiento][{{$key}}][observaciones]" class="form-control observaciones texarea_comportamiento_{{ $comportamiento->id }}" rows="1" id="comment"></textarea>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endif
        </tbody>
    </table>
    @endif
@endif

<!--
<table class="table table-condensed">
    <thead>
        <th>Peso</th>
        <th>factores de evaluacion</th>
        <th>Calificación</th
    </thead>
    <tbody>
        @if (!empty($evaluacion))
            <input type="hidden" value="{{$evaluacion->id }}" name="evaluacion_id">
                    @if (!empty($evaluacion->comp_a ))
                    <tr>
                        <td>
                            {{$evaluacion->comp_a->valor }} %
                        </td>
                        <td style="width: 40%;">
                            <strong>
                                    {{$evaluacion->comp_a->competencia  }} :
                            </strong>
                            <p >
                                {{$evaluacion->comp_a->descripcion }}
                            </p>
                        </td>
                        <td>
                            <input type="hidden" name="autoevaluacion[0][competencia_id]" value="{{$evaluacion->comp_a->id}} ">
                            @php
                                $resp = $autoevaluacion->respuestas()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                    ->where('competencia_id', '=', $evaluacion->comp_a->id)->get();
                            @endphp
                            @if (!empty($resp))
                                <p>Puntuación autoevaluación: {{$resp[0]->puntuacion}}</p>
                            @endif
                            <label for="">Calificar competencia</label>
                            <select  name="autoevaluacion[0][respuesta]" class="form-control" id="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>
                            <p>{{$resp[0]->observaciones}}</p>
                            <textarea name="autoevaluacion[0][observaciones]" class="form-control" rows="1" id="comment"></textarea>
                        </td>
                    </tr>
                    @endif
                    @if (!empty($evaluacion->comp_b))
                        <tr>
                            <td>
                                {{$evaluacion->comp_b->valor  }} %
                            </td>
                            <td style="width: 40%;">
                                <strong>
                                        {{$evaluacion->comp_b->competencia   }} :
                                </strong>
                                <p >
                                    {{$evaluacion->comp_b->descripcion  }}
                                </p>
                            </td>
                            <td>
                                <input type="hidden" name="autoevaluacion[1][competencia_id]" value="{{$evaluacion->comp_b->id}} ">
                                @php
                                $resp = $autoevaluacion->respuestas()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                    ->where('competencia_id', '=', $evaluacion->comp_b->id)->get();
                                @endphp
                                @if (!empty($resp))
                                    <p>Puntuación autoevaluación: {{$resp[0]->puntuacion }}</p>
                                @endif
                                <label for="">Calificar competencia</label>
                                <select name="autoevaluacion[1][respuesta]" class="form-control" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                            <td>
                                <p>{{$resp[0]->observaciones}}</p>
                                <textarea name="autoevaluacion[1][observaciones]"  class="form-control" rows="1" id="comment"></textarea>
                            </td>
                        </tr>
                    @endif
                    @if (!empty($evaluacion->comp_c))
                        <tr>
                            <td>
                                {{$evaluacion->comp_c->valor  }} %
                            </td>
                            <td style="width: 40%;">
                                <strong>
                                        {{$evaluacion->comp_c->competencia   }} :
                                </strong>
                                <p >
                                    {{$evaluacion->comp_c->descripcion  }}
                                </p>
                            </td>
                            <td>
                                <input type="hidden" name="autoevaluacion[2][competencia_id]" value="{{$evaluacion->comp_c->id}} ">
                                @php
                                $resp = $autoevaluacion->respuestas()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                    ->where('competencia_id', '=', $evaluacion->comp_c->id)->get();
                                @endphp
                                @if (!empty($resp))
                                    <p>Puntuación autoevaluación: {{$resp[0]->puntuacion}}</p>
                                @endif
                                <label for="">Calificar competencia</label>
                                <select name="autoevaluacion[2][respuesta]" class="form-control" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                            <td>
                                <p>{{$resp[0]->observaciones}}</p>
                                <textarea name="autoevaluacion[2][observaciones]"  class="form-control" rows="1" id="comment"></textarea>
                            </td>
                        </tr>
                    @endif
                    @if (!empty($evaluacion->comp_d))
                        <tr>
                            <td>
                                {{$evaluacion->comp_d->valor  }} %
                            </td>
                            <td style="width: 40%;">
                                <strong>
                                        {{$evaluacion->comp_d->competencia   }} :
                                </strong>
                                <p >
                                    {{$evaluacion->comp_d->descripcion  }}
                                </p>
                            </td>
                            <td>
                                <input type="hidden" name="autoevaluacion[3][competencia_id]" value="{{$evaluacion->comp_d->id}} ">
                                @php
                                $resp = $autoevaluacion->respuestas()->where('autoevaluacion_id', '=', $autoevaluacion->id)
                                                    ->where('competencia_id', '=', $evaluacion->comp_d->id)->get();
                                @endphp
                                @if (!empty($resp))
                                    <p>Puntuación autoevaluación: {{$resp[0]->puntuacion}}</p>
                                @endif
                                <label for="">Calificar competencia</label>
                                <select name="autoevaluacion[3][respuesta]" class="form-control" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                            <td>
                                <p>{{$resp[0]->observaciones}}</p>
                                <textarea name="autoevaluacion[3][observaciones]"  class="form-control" rows="1" id="comment"></textarea>
                            </td>
                        </tr>
                    @endif
        @endif
    </tbody>
</table>
-->

<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success">Enviar Respuestas</button>


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
                    url:'../temporal_valoracion',
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
                    url:'../temporal_valoracion',
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

            console.log(data);


            $.ajax({
                    type:'POST',
                    url:'../temporal_valoracion',
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
