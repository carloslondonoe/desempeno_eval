@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card col-md-12 col-xs-12">

    <form method="POST" action="{{ route('permisos_save') }}">
            {{ csrf_field() }}
    <h3>Permisos de salida</h3>
    <div class="col-md-12">
            <p class="title_competency">
                <strong>
                       Información personal
                </strong>
            </p>

            <div class="col-md-4">
                <strong>Nombres Completos:</strong>  {{$user->name.' '.$user->apellido}}
            </div>

            <div class="col-md-4">
                <strong>Fecha:</strong>  {{date("m/d/y")}}
            </div>
    </div>


    <div class="col-md-12">
        <br>
            <p class="title_competency">
                <strong>
                        Motivo salida
                </strong>
            </p>


            <div class="">
                <div class="col-md-12"  id="container_razon_salida">
                    <label for="razon_salida">Motivo de salida</label>
                    <select class="form-control" id="razon_salida" name="razon_salida">
                        <option value="calamidad_domestica">Calamidad domestica</option>
                        <option value="cita_eps">Cita EPS</option>
                        <option value="compensatorio">Compensatorio</option>
                        <option value="diligencia_personal">Diligencia Personal</option>
                        <option value="dia_de_cumpleanos">Día De Cumpleaños</option>
                        <option value="otro"> Otro Cúal? </option>
                    </select>
                    <p></p>
                </div>


                <div class="col-md-12" id="container_otra_razon_salida">
                    <label for="">Otra razón de salida</label>
                    <input type="text" class="form-control" name="otra_razon_salida" id="otra_razon_salida">
                    <p></p>
                </div>

                <div class="col-md-12">
                    <br/>
                </div>

                <p class="title_competency">
                    <strong>
                            Fechas
                    </strong>
                </p>

                <div class="col-md-6" id="container_dia_salida">
                    <label for="">Día de salida</label>
                    <div class='input-group date datetimepicker1' >
                        <input type='text' id="dia_salida" name="dia_salida" class="form-control" required="true" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <p></p>
                </div>

                <div class="col-md-6" id="container_hora_salida">
                    <label for="">Hora de salida</label>
                    <div class="form-group">
                        <div class='input-group date hourpicker' >
                            <input type='text' class="form-control" id="hora_salida" name="hora_salida" required="true" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <p></p>
                </div>


                <div class="col-md-6" id="container_dia_regreso">
                    <label for="">Día regreso</label>
                    <div class='input-group date datetimepicker1' >
                        <input type='text' id="dia_regreso" name="dia_regreso" class="form-control" required="true" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <p></p>
                </div>

                <div class="col-md-6" id="container_hora_regreso">
                    <label for="">Hora de entrada</label>
                    <div class="form-group">
                        <div class='input-group date hourpicker'>
                            <input type='text' id="hora_regreso" class="form-control" name="hora_regreso" required="true" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <p></p>
                </div>

                <div class="col-md-12" id="container_observaciones">
                    <label for="">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones"  rows="5"></textarea>
                    <p></p>
                </div>

                <div class="col-md-12">
                    <br/>
                </div>


                <div class="col-md-12">
                    <button type="submit" id="sendData" class="btn btn-success">Enviar</button>
                </div>

            </div>
            </div>
            </div>
    </div>


</form>

</div>

<script>
    $(document).ready(function(){
        $('.datetimepicker1').datepicker({
            format: 'yyyy-mm-dd',
            language: 'es'
        });
        $('.hourpicker').datetimepicker({
            format: 'LT'
        });
        $('#container_otra_razon_salida').hide()
    })

    var getData = [
        $('#razon_salida'),
        $('#dia_salida'),
        $('#hora_salida'),
        // $('#dia_regreso'),
        // $('#hora_regreso'),
        //$('#observaciones')
    ]


    $('#razon_salida').change(function() {
        if($(this).val() == 'otro' ){
            $('#container_otra_razon_salida').show()

        }else{
            $('#container_otra_razon_salida').hide()
        }
    })

    $('#sendData').click(function(e){
        validates = validate(getData)

        if(validates == false){
            e.preventDefault();
        }
    })

    function validate(data){
        sendForm = true
        for (let i = 0; i < data.length; i++) {
            const element = data[i];


            if(element.val() === ''){
                id = element.attr('id')
                $('#container_'+id).removeClass('has-success')
                $('#container_'+id).addClass('has-error')
                $('#container_'+id+' p').html('Este campo no puede estar vacío')

                sendForm = false
            }else{
                id = element.attr('id')
                $('#container_'+id).removeClass('has-error')
                $('#container_'+id).addClass('has-success')
                $('#container_'+id+' p').html('')

            }
        }
        return sendForm
    }
</script>
@endsection
