@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div id="app">


    <ul class="nav nav-tabs">
        <!--li class="menu_btn_state active">
            <input type="hidden" id="autoevaluacion" value="autoevaluacion">
            <a href="#">Evaluacion empleado</a>
        </li>
        <li class="menu_btn_state">
            <input type="hidden" id="evaluacion_coordinador" value="coordinador_evaluacion">
            <a href="#">Evaluacion coordinador</a>
        </li-->
        <li class="menu_btn_state active">
            <input type="hidden" id="valoracion_id" value="valoracion">
            <a href="#" >Valoración final</a>
        </li>
    </ul>


    <div class="container_valoraciones">


        <div class="container_valoracion contenedores">
            @include('evaluaciones/partials/_valoracion', [
                'valoracion' => $valoracion
            ])
        </div>
    </div>

</div>



<script>
    $('.container_autoevaluacion').hide()
    $('.container_coordinador_evaluacion').hide()
    //$('.container_valoracion').hide()

    $('.menu_btn_state').click(function() {
        $('.menu_btn_state').removeClass('active')
        $(this).addClass('active')
        value = $(this).find("input").val()

        $('.container_valoraciones .contenedores').hide();

        $('.container_'+value).show()


    });
</script>
@endsection
