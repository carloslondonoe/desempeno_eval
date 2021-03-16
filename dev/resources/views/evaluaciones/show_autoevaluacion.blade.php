@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="container">
    <div class="col-md-9">
            <h3>Autoevaluacion {{$autoevaluacion->evaluacion->cargo->cargo}} </h3>
    </div>

    <div class="col-md-3">
            <a class="btn btn-info" href="{{ URL::previous() }}">volver</a>
    </div>

    <div class="col-md-6">
        <p> <strong>Nombres completos: </strong>  {{$autoevaluacion->user->name.''.$autoevaluacion->user->apellido}} </p>
    </div>
    <div class="col-md-6"> 
        <p> <strong>Fecha: </strong>  {{$autoevaluacion->created_at}}</p>
    </div>
</div>
<div class="col-md-12">
        <br>
</div>

    <!--Competencia A-->
    @if (!empty($autoevaluacion))
        <div class="card">
            @if (!empty($autoevaluacion->evaluacion->comp_a)) 
                <p class="title_competency">
                    <span class="glyphicon glyphicon glyphicon-check" aria-hidden="true"></span>                            
                    <strong>
                            competencia  {{$autoevaluacion->evaluacion->comp_a->competencia }} :
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
                        competencia  {{$autoevaluacion->evaluacion->comp_b->competencia }} :
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
                        competencia  {{$autoevaluacion->evaluacion->comp_c->competencia }} :
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
                        competencia  {{$autoevaluacion->evaluacion->comp_d->competencia }} :
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



@endsection