@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">



<input id="user_id" type="hidden" value="CRUDBooster::myId()" >

<div class="col-md-12 card">
    <div class="col-md-12">

            @foreach ($eval360 as $eva)
                <h3>Calificar evaluación 360: {{$eva->t_evaluacion}} </h3>


    </div>

    <div class="col-md-6">
        <p> <strong>Nombres Completos:</strong>  {{$eva->colaborador}} </p>
    </div>
    <div class="col-md-6">
        <p> <strong>Fecha:</strong>  {{date("m/d/y")}}</p>
    </div>

    <div class="col-md-12">
        <p>
            Califique de 1 a 5 los siguientes factores, teniendo en cuenta que 1 es la menor calificacion con respecto al nivel de observacion y 5 es la mayor:</p>
        </p>
    </div>
</div>
@endforeach
<div class="col-md-12">
    <br>
    <br>
</div>

<div class="">
    <form method="POST" action="{{ route('360salvar') }}">
        {{ csrf_field() }}

        <div class="col-md-12 card">
          <input id="evaluacion_id" type="hidden" value="{{$eval}}" name="evaluacion_id">
          <br>
          <div>
<h3>Liderazgo</h3>
<p>Capacidad para inspirar, cuidar y generar compromiso en los equipos de trabajo, así como para conseguir el respaldo de la organización para enfrentar exitosamente los desafíos de cada día. Teniendo, además, una buena coordinación de las personas, desarrollando su talento e impactando positivamente en el clima y la cultura de la organización.</p>
          </div>
          <table class="table table-condensed">
                        <thead>
                            <th>Comportamiento</th>
                            <th>Calificación</th>
                            <!--th>Observaciones</th-->
                        </thead>
                        <tbody>
          @foreach($preguntas as $pp)
          @if($pp->p_acargo == $eva->p_cargo && $pp->id_competencia == 1)
    <tr>
      <td  style="width: 60%;">{{$pp->nombre}}</td>
      <td class="contenedor_td">
        <select  name="liderazgo" class="form-control control_change select_comportamiento_{{ $pp->id }}" >
<option value="0" selected hidden>Seleccion una opción</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>

      </td>
    </tr>
          @endif
          @endforeach
        </tbody>
  </table>
        </div>

        <div class="col-md-12 card">
          <br>
          <div>
<h3>Comunicación</h3>
<p>Capacidad para transmitir de manera asertiva, la información necesaria para el buen funcionamiento del equipo y de la compañía, logrando de una manera clara y respetuosa que dicha información fluya en todos los niveles de Motoborda apalancando a su vez el logro de los resultados. Implica escuchar de manera activa y cuidar los modos y las formas en cada interacción al interior de la compañía.</p>
          </div>
          <table class="table table-condensed">
                        <thead>
                            <th>Comportamiento</th>
                            <th>Calificación</th>
                            <!--th>Observaciones</th-->
                        </thead>
                        <tbody>
          @foreach($preguntas as $pp)
          @if($pp->p_acargo == $eva->p_cargo && $pp->id_competencia == 2)
    <tr>
      <td  style="width: 60%;">{{$pp->nombre}}</td>
      <td class="contenedor_td">
        <select  name="comunicacion" class="form-control control_change select_comportamiento_{{ $pp->id }}" >
<option value="0" selected hidden>Seleccion una opción</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>

      </td>
    </tr>
          @endif
          @endforeach
        </tbody>
  </table>
        </div>

        <div class="col-md-12 card">
          <br>
          <div>
<h3>Trabajo en Equipo</h3>
<p>Capacidad para colaborar con los demás, formar parte de un grupo y trabajar con otras áreas de la organización, con el propósito de alcanzar, en conjunto, la estrategia organizacional, subordinar los intereses personales a los objetivos grupales. Implica tener expectativas positivas respecto a los demás, comprender a los otros, y generar y mantener un buen clima de trabajo.</p>
          </div>
          <table class="table table-condensed">
                        <thead>
                            <th>Comportamiento</th>
                            <th>Calificación</th>
                            <!--th>Observaciones</th-->
                        </thead>
                        <tbody>
          @foreach($preguntas as $pp)
          @if($pp->p_acargo == $eva->p_cargo && $pp->id_competencia == 3)
    <tr>
      <td  style="width: 60%;">{{$pp->nombre}}</td>
      <td class="contenedor_td">
        <select  name="trabajo_w" class="form-control control_change select_comportamiento_{{ $pp->id }}" >
<option value="0" selected hidden>Seleccion una opción</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>

      </td>
    </tr>
          @endif
          @endforeach
        </tbody>
  </table>
        </div>

        <div class="col-md-12 card">
          <br>
          <div>
<h3>Innovación</h3>
<p>Capacidad para idear soluciones nuevas y diferentes dirigidas a resolver problemas o mejorar situaciones que se presenten bien sea en el puesto de trabajo o en la organización en general. Implica sugerir y mantener la disposición permanente a retar lo establecido y pensar de manera creativa.</p>
          </div>
          <table class="table table-condensed">
                        <thead>
                            <th>Comportamiento</th>
                            <th>Calificación</th>
                            <!--th>Observaciones</th-->
                        </thead>
                        <tbody>
          @foreach($preguntas as $pp)
          @if($pp->p_acargo == $eva->p_cargo && $pp->id_competencia == 4)
    <tr>
      <td  style="width: 60%;">{{$pp->nombre}}</td>
      <td class="contenedor_td">
        <select  name="innovacion" class="form-control control_change select_comportamiento_{{ $pp->id }}" >
<option value="0" selected hidden>Seleccion una opción</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>

      </td>
    </tr>
          @endif
          @endforeach
        </tbody>
  </table>
        </div>


        <div class="col-md-12 card">
          <br>
          <div>
<h3>Preguntas cualitativas</h3>
          </div>
          <table class="table table-condensed">
                        <thead>
                            <th>Preguntas cualitativas</th>
                            <th>Respuestas</th>
                            <!--th>Observaciones</th-->
                        </thead>
                        <tbody>
          @foreach($preguntas as $pp)
          @if($pp->id_competencia == 5)
    <tr>
      <td  class="contenedor_td_textarea" style="width: 60%;">{{$pp->nombre}}</td>
      <td class="cualitativa_1">
        <textarea name="cualitativa_1" style="width: 60%;" rows="2" id="comment"></textarea>

      </td>
    </tr>
          @endif
          @endforeach
        </tbody>
  </table>
        </div>

      <div style="text-align: center;">

        <button  type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success">Enviar Respuestas</button>
      </div>

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
</div>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    evaluacion_id = $('#evaluacion_id').val()
    //user_id = $('#user_id').val()


    data= {
        evaluacion_id: evaluacion_id,
        //user_id: user_id,
    }

    $.ajax({
            type:'GET',
            url:'./360salvar',
            data: data,
                success:function(data){
                    console.log(data);
                    if(data.status == 'ok'){
                        console.log(data.evaluacion.respuestas);
                        resp = data.evaluacion.respuestas
                        for (let i = 0; i < resp.length; i++) {
                            const comp_id = resp[i]['comportamiento_id'];
                            const punt = resp[i]['puntuacion'];
                            //const obs = resp[i]['observaciones'];

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
    cualitativa_1 = $(this).parent('.contenedor_td').find('.cualitativa_1').val()
    //cualitativa_1 = $('#cualitativa_1').val()
    console.log(user_id);


    data= {
        user_id: user_id,
        value: value,
        comportamiento_id: comportamiento_id,
        competencia_id: competencia_id,
        evaluacion_id: evaluacion_id,
        cualitativa_1:cualitativa_1
        //observaciones: 'nullo'
    }



    $.ajax({
            type:'POST',
            url:'./360salvar',
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

    //observaciones = $(this).val()
    comportamiento_id = $(this).parent('.contenedor_td_textarea').find('.comportamiento_id').val()
    competencia_id = $(this).parent('.contenedor_td_textarea').find('.competencia_id').val()
    evaluacion_id = $('#evaluacion_id').val()
     cualitativa_1 = $(this).parent('.contenedor_td').find('.cualitativa_1').val()
    //user_id = $('#user_id').val()

    data= {
        user_id: user_id,
        value: 'nullo',
        comportamiento_id: comportamiento_id,
        competencia_id: competencia_id,
        evaluacion_id: evaluacion_id,
        cualitativa_1:cualitativa_1
        //observaciones: observaciones
    }

    $.ajax({
            type:'POST',
            url:'./360salvar',
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
