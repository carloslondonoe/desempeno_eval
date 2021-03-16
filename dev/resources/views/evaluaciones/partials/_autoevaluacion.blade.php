
<!--Competencia A-->
@if (!empty($autoevaluacion))
    <div class="card">
        @if (!empty($autoevaluacion->evaluacion->comp_a)) 

            <p class="title_competency">
                <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
                <strong>
                        Competencia  {{$autoevaluacion->evaluacion->comp_a->competencia }} :
                </strong>
            </p>

            <p >
                {{$autoevaluacion->evaluacion->comp_a->descripcion}}
            </p>
            <table class="table table-condensed">
                <thead>
                    <th>Comportamiento</th>
                    <th>Calificación</th>
                    
                    <th>Observaciones</th>
                </thead>
                <tbody>
                    @if (!empty($autoevaluacion->evaluacion->comp_a))  
                        @if (!empty($autoevaluacion->evaluacion->comp_a->comportamientos))
                            @foreach ($autoevaluacion->evaluacion->comp_a->comportamientos as $key => $comportamiento)
                                <tr>
                                    <td style="width: 30%;">
                                        {{$comportamiento->comportamiento }} 
                                    </td>
                                    <td >
                                        @if (!empty($autoevaluacion->puntuaciones))
                                            @foreach ($autoevaluacion->puntuaciones as $resp)
                                                @if ($resp->comportamiento_id == $comportamiento->id )
                                                    <p >
                                                        <strong>
                                                                {{$resp->puntuacion}}
                                                        </strong>
                                                    </p>
                                                @endif
                                            @endforeach
                                        @endif      
                                    </td>
                                    <td>
                                        @if (!empty($autoevaluacion->puntuaciones))
                                            @foreach ($autoevaluacion->puntuaciones as $resp)
                                                @if ($resp->comportamiento_id == $comportamiento->id )
                                                    <p >
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
@if (!empty($autoevaluacion))
    <div class="card">
        @if (!empty($autoevaluacion->evaluacion->comp_b)) 
            <p class="title_competency">
                <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
                <strong>
                        Competencia  {{$autoevaluacion->evaluacion->comp_b->competencia }} :
                </strong>
            </p>

            <p >
                {{$autoevaluacion->evaluacion->comp_b->descripcion}}
            </p>
            <table class="table table-condensed">
                <thead>
                    <th>Comportamiento</th>
                    <th>Calificación</th>
                    <th>Observaciones</th>
                </thead>
                <tbody>
                    @if (!empty($autoevaluacion->evaluacion->comp_b))  
                        @if (!empty($autoevaluacion->evaluacion->comp_b->comportamientos))
                            @foreach ($autoevaluacion->evaluacion->comp_b->comportamientos as $key => $comportamiento)
                                <tr>
                                    <td style="width: 30%;">
                                        {{$comportamiento->comportamiento }} 
                                    </td>
                                    <td >
                                        @if (!empty($autoevaluacion->puntuaciones))
                                            @foreach ($autoevaluacion->puntuaciones as $resp)
                                                @if ($resp->comportamiento_id == $comportamiento->id )
                                                    <p >
                                                        <strong>
                                                                {{$resp->puntuacion}}
                                                        </strong>
                                                    </p>
                                                @endif
                                            @endforeach
                                        @endif      
                                    </td>
                                
                                    <td>
                                        @if (!empty($autoevaluacion->puntuaciones))
                                            @foreach ($autoevaluacion->puntuaciones as $resp)
                                                @if ($resp->comportamiento_id == $comportamiento->id )
                                                    <p >
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
@if (!empty($autoevaluacion))
<div class="card">
@if (!empty($autoevaluacion->evaluacion->comp_c)) 
    <p class="title_competency">
        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
        <strong>
                Competencia  {{$autoevaluacion->evaluacion->comp_c->competencia }} :
        </strong>
    </p>

    <p >
        {{$autoevaluacion->evaluacion->comp_c->descripcion}}
    </p>
    <table class="table table-condensed">
        <thead>
            <th>Comportamiento</th>
            <th>Calificación</th>
            
            <th>Observaciones</th> 
        </thead>
        <tbody>
            @if (!empty($autoevaluacion->evaluacion->comp_c))  
                @if (!empty($autoevaluacion->evaluacion->comp_c->comportamientos))
                    @foreach ($autoevaluacion->evaluacion->comp_c->comportamientos as $key => $comportamiento)
                        <tr>
                            <td style="width: 30%;">
                                {{$comportamiento->comportamiento }} 
                            </td>
                            <td >
                                @if (!empty($autoevaluacion->puntuaciones))
                                    @foreach ($autoevaluacion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p >
                                                <strong>
                                                        {{$resp->puntuacion}}
                                                </strong>
                                            </p>
                                        @endif
                                    @endforeach
                                @endif      
                            </td>
                           
                            <td>
                                @if (!empty($autoevaluacion->puntuaciones))
                                    @foreach ($autoevaluacion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p >
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
@if (!empty($autoevaluacion))
<div class="card">
@if (!empty($autoevaluacion->evaluacion->comp_d)) 
    <p class="title_competency">
        <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
        <strong>
                Competencia  {{$autoevaluacion->evaluacion->comp_d->competencia }} :
        </strong>
    </p>

    <p >
        {{$autoevaluacion->evaluacion->comp_d->descripcion}}
    </p>
    <table class="table table-condensed">
        <thead>
            <th>Comportamiento</th>
            <th>Calificación</th>
            
            <th>Observaciones</th>
        </thead>
        <tbody>
            @if (!empty($autoevaluacion->evaluacion->comp_d))  
                @if (!empty($autoevaluacion->evaluacion->comp_d->comportamientos))
                    @foreach ($autoevaluacion->evaluacion->comp_d->comportamientos as $key => $comportamiento)
                        <tr>
                            <td style="width: 30%;">
                                {{$comportamiento->comportamiento }} 
                            </td>
                            <td >
                                @if (!empty($autoevaluacion->puntuaciones))
                                    @foreach ($autoevaluacion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p >
                                                <strong>
                                                        {{$resp->puntuacion}}
                                                </strong>
                                            </p>
                                        @endif
                                    @endforeach
                                @endif      
                            </td>
                            
                            <td>
                                @if (!empty($autoevaluacion->puntuaciones))
                                    @foreach ($autoevaluacion->puntuaciones as $resp)
                                        @if ($resp->comportamiento_id == $comportamiento->id )
                                            <p >
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