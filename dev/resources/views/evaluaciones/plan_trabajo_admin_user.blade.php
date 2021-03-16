@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<a style="float: right" href="{{ route('plan_trabajo_admin') }}" class="btn btn-primary">volver</a>

<br>
<br>

<div class="card">
    <div style="text-align: center">
        <h3>
            Lista de seguimientos de <br>
        </h3>
        <p>
            {{$planes->last()->valoracion->user->name.' '.$planes->last()->valoracion->user->apellido }}
        </p>
    </div>

</div>

    <br>
    <br>


<div >
   
  

        @foreach ($years as $year)    
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h4 class="panel-title">
                        <a style="color: white" class="btn btn-primary" data-toggle="collapse" href="#collapse_{{ $year }}"> {{ $year }} </a>
                    </h4>
                    </div>
                    <div id="collapse_{{ $year }}" class="panel-collapse collapse">
                    <ul class="list-group">
                        
                        @foreach ($planes as $plan)
                            @if ($plan->seguimientos != null)

                                @foreach ($plan->seguimientos as $seguimiento)
                            
                                    @if ( date("Y", strtotime($plan->created_at)) == $year )
                                        <li class="list-group-item ">
                                            <div class="row">
                                                <p class="col-md-4">
                                                    Situación presentada: {{ $seguimiento->situacion_presentada }} 
                                                </p>
                                                <p class="col-md-4">
                                                    Fecha de seguimiento: {{ $seguimiento->fecha_seguimiento}}
                                                </p>
                                                <div class="col-md-4">
                                                   

                                                        <a href="{{ route('plan_trabajo_admin_user_seguimiento', $seguimiento->id) }}" class="btn btn-primary">Ver seguimientos</a>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif

                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
</div>



@endsection