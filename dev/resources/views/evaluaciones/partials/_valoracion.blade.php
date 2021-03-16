
<!--Competencia A-->
@if (!empty($valoracion))
<div class="card">
    @if (!empty($valoracion->evaluacion->comp_a))

        <p class="title_competency">
            <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>
            <strong>
                    Competencia  {{$valoracion->evaluacion->comp_a->competencia }} :
            </strong>
        </p>

        <p >
            {{$valoracion->evaluacion->comp_a->descripcion}}
        </p>
        <table class="table table-condensed">
            <thead>
                <th style="text-align:center">Comportamiento</th>
                <th style="text-align:center">Calificación</th>

                <th style="text-align:center">observaciones</th>
            </thead>
            <tbody>
                @if (!empty($valoracion->evaluacion->comp_a))
                    @if (!empty($valoracion->evaluacion->comp_a->comportamientos))
                        @foreach ($valoracion->evaluacion->comp_a->comportamientos as $key => $comportamiento)
                            <tr>
                                <td style="width: 30%;">
                                    {{$comportamiento->comportamiento }}
                                </td>
                                <td >
                                    @if (!empty($valoracion->puntuaciones))
                                        @foreach ($valoracion->puntuaciones as $resp)
                                            @if ($resp->comportamiento_id == $comportamiento->id )
                                                <p style="text-align:center">
                                                    <strong>
                                                            {{$resp->puntuacion}}
                                                    </strong>
                                                </p>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($valoracion->puntuaciones))
                                        @foreach ($valoracion->puntuaciones as $resp)
                                            @if ($resp->comportamiento_id == $comportamiento->id )
                                                <p style="text-align:center">
                                                    {{$resp->observaciones}}
                                                </p>
                                            @endif
                                        @endforeach
                                    @endif
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


<!--Competencia B-->
@if (!empty($valoracion))
<div class="card">
@if (!empty($valoracion->evaluacion->comp_b))
    <p class="title_competency">
        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>
        <strong>
                Competencia  {{$valoracion->evaluacion->comp_b->competencia }} :
        </strong>
    </p>

    <p >
        {{$valoracion->evaluacion->comp_b->descripcion}}
    </p>
    <table class="table table-condensed">
        <thead>
            <th style="text-align:center">Comportamiento</th>
            <th style="text-align:center">Calificación</th>
            <th style="text-align:center">observaciones</th>
        </thead>
        <tbody>
            @if (!empty($valoracion->evaluacion->comp_b))
                @if (!empty($valoracion->evaluacion->comp_b->comportamientos))
                    @foreach ($valoracion->evaluacion->comp_b->comportamientos as $key => $comportamiento)
                        <tr>
                            <td style="width: 30%;">
                                {{$comportamiento->comportamiento }}
                            </td>
                            <td >
                                @if (!empty($valoracion->puntuaciones))
                                    @foreach ($valoracion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p style="text-align:center">
                                                <strong>
                                                        {{$resp->puntuacion}}
                                                </strong>
                                            </p>
                                        @endif
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @if (!empty($valoracion->puntuaciones))
                                    @foreach ($valoracion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p style="text-align:center">
                                                {{$resp->observaciones}}
                                            </p>
                                        @endif
                                    @endforeach
                                @endif
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

<!--Competencia C-->
@if (!empty($valoracion))
<div class="card">
@if (!empty($valoracion->evaluacion->comp_c))
    <p class="title_competency">
        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>
        <strong>
                Competencia  {{$valoracion->evaluacion->comp_c->competencia }} :
        </strong>
    </p>

    <p >
        {{$valoracion->evaluacion->comp_c->descripcion}}
    </p>
    <table class="table table-condensed">
        <thead>
            <th style="text-align:center">Comportamiento</th>
            <th style="text-align:center">Calificación</th>

            <th style="text-align:center">observaciones</th>
        </thead>
        <tbody>
            @if (!empty($valoracion->evaluacion->comp_c))
                @if (!empty($valoracion->evaluacion->comp_c->comportamientos))
                    @foreach ($valoracion->evaluacion->comp_c->comportamientos as $key => $comportamiento)
                        <tr>
                            <td style="width: 30%;">
                                {{$comportamiento->comportamiento }}
                            </td>
                            <td >
                                @if (!empty($valoracion->puntuaciones))
                                    @foreach ($valoracion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p style="text-align:center">
                                                <strong>
                                                        {{$resp->puntuacion}}
                                                </strong>
                                            </p>
                                        @endif
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @if (!empty($valoracion->puntuaciones))
                                    @foreach ($valoracion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p style="text-align:center">
                                                {{$resp->observaciones}}
                                            </p>
                                        @endif
                                    @endforeach
                                @endif
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


<!--Competencia D-->
@if (!empty($valoracion))
<div class="card">
@if (!empty($valoracion->evaluacion->comp_d))
    <p class="title_competency">
        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>
        <strong>
                Competencia  {{$valoracion->evaluacion->comp_d->competencia }} :
        </strong>
    </p>

    <p >
        {{$valoracion->evaluacion->comp_d->descripcion}}
    </p>
    <table class="table table-condensed">
        <thead>
            <th style="text-align:center">Comportamiento</th>
            <th style="text-align:center">Calificación</th>

            <th style="text-align:center">observaciones</th>
        </thead>
        <tbody>
            @if (!empty($valoracion->evaluacion->comp_d))
                @if (!empty($valoracion->evaluacion->comp_d->comportamientos))
                    @foreach ($valoracion->evaluacion->comp_d->comportamientos as $key => $comportamiento)
                        <tr>
                            <td style="width: 30%;">
                                {{$comportamiento->comportamiento }}
                            </td>
                            <td style="text-align:center">
                                @if (!empty($valoracion->puntuaciones))
                                    @foreach ($valoracion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p style="text-align:center">
                                                <strong>
                                                        {{$resp->puntuacion}}
                                                </strong>
                                            </p>
                                        @endif
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @if (!empty($valoracion->puntuaciones))
                                    @foreach ($observacionval->puntuacion_valoracion as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p style="text-align:center">
                                                {{$resp->observaciones}}
                                            </p>
                                        @endif
                                    @endforeach
                                @endif
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
