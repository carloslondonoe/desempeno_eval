@extends('crudbooster::admin_template')
<style>
.col-md-12 {
    text-align: center !important;
}
</style>
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

    <form method="POST" action="{{ route('solicitudes_save') }}">
            {{ csrf_field() }}
        <h3>Solicitud de tiquetes</h3>
        <h4 style="color:red">Por favor diligenciar todos los datos.</h4>
        <div class="col-md-12">
                <p class="title_competency">
                    <strong>
                        Información personal
                    </strong>
                </p>

                <div class="col-md-6">
                    <strong>Nombres Completos:</strong>  {{$user->name.' '.$user->apellido}}
                </div>

                <div class="col-md-6">
                    <strong>Fecha de solicitud:</strong>  {{date("m/d/y")}}
                </div>

                <div class="col-md-6"  id="container_direccion">
                    <label for="direccion">Dirección recogida</label>
                    <input type="text" name="direccion" id="direccion" class="form-control">
                    <p></p>
                </div>

                <div class="col-md-6"  id="container_direccion">
                    <label for="phone">Teléfono</label>
                    <input type="text" value="{{ $user->phone }}" name="phone" id="phone" class="form-control">
                    <p></p>
                </div>


        </div>

        <div class="col-md-12">
            <br>
            <p class="title_competency">
                <strong>
                        Motivo salida
                </strong>
            </p>

            <div>
                <div class="col-md-6"  id="container_motivo">
                    <label for="motivo">Motivo</label>
                    <input type="text" name="motivo" id="motivo" class="form-control">
                    <p></p>
                </div>
                <div class="col-md-6"  id="container_motivo">
                    <label for="proyecto">Proyecto</label>
                    <input type="text" name="proyecto" id="proyecto" class="form-control">
                    <p></p>
                </div>
            </div>



                <div class="col-md-12">
                    <br/>
                </div>

                <p class="title_competency">
                    <strong>
                        DATOS DE DESTINOS Y HORARIOS TENTATIVOS
                    </strong>
                </p>

                <!-- Destinos array -->
                <div id="destinos_array">
                    <div id="destino_0">
                        <div class="col-md-2"  id="container_motivo">
                            <label for="destino">Destino</label>
                            <input type="text" name="destino_attibutes[0][destino]" id="destino" class="form-control" required="true">
                            <p></p>
                        </div>

                        <div class="col-md-2" id="container_dia_salida">
                            <label for="">Día de salida</label>
                            <div class='input-group date datetimepicker1' >
                                <input type='text' id="dia_salida" name="destino_attibutes[0][dia_salida]" class="form-control" required="true" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <p></p>
                        </div>

                        <div class="col-md-2" id="container_hora_salida">
                            <label for="">Hora de salida estimada</label>
                            <div class="form-group">
                                <div class='input-group date hourpicker' >
                                    <input type='text' class="form-control" id="destino_attibutes[0][hora_salida]" name="destino_attibutes[0][hora_salida]" required="true" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                            <p></p>
                        </div>


                        <div class="col-md-2 container_dia_regreso" id="container_dia_regreso_0">
                            <label for="">Día regreso</label>
                            <div class='input-group date datetimepicker1' >
                                <input type='text' id="dia_regreso" name="destino_attibutes[0][dia_regreso]" class="form-control" required="false" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <p></p>
                        </div>

                        <div class="col-md-2 container_hora_regreso" id="container_hora_regreso_0">
                            <label for="">Hora de regreso estimada</label>
                            <div class="form-group">
                                <div class='input-group date hourpicker'>
                                    <input type='text' id="hora_regreso" class="form-control" name="destino_attibutes[0][hora_regreso]" required="false" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                            <p></p>
                        </div>

                        <div class="col-md-1"  id="container_is_back">
                            <label for="">Sin fecha de regreso</label><br/>
                            <input type="checkbox" name="is_back" value="0" id="is_back" class="is_back" >
                        </div>

                        <div class="col-md-1"  id="container_motivo">
                            <label for="">Eliminar</label> <br/>
                            <button type="button" value="0" class="btn btn-danger remove_destiny">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>


                </div>
                <!-- Destinos array -->


                <div class="col-md-12">
                        <button type="button" id="addDestino" class="btn btn-warning">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true">Agregar</span>
                        </button>
                    </div>



                    <div class="col-md-6"  style="text-align: center">
                        <label for="">Requiere reserva hotelera</label><br/>
                        Si<input type="radio" name="reserva_hotelera" id="reserva_hotelera" value="true" >
                        No<input type="radio" name="reserva_hotelera" id="reserva_hotelera" value="false" checked>
                    </div>

                    <div class="col-md-6"  style="text-align: center">
                        <label for="">Taxi</label><br/>
                        Si<input type="radio" name="taxi" id="taxi" value="true" >
                        No<input type="radio" name="taxi" id="taxi" value="false" checked>
                    </div>

            </div>

            <div class="col-md-12">
                <button type="submit" id="sendData" class="btn btn-success">
                    Enviar
                </button>
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






        cont_destino = 0
        function addDestino(){
            cont_destino += 1

            var row = ''+
                '<div id="destino_'+cont_destino+'">'+
                    '<div class="col-md-12"  >'+
                        '<br/>'+
                    '</div>'+
                    '<div class="col-md-2"  id="container_motivo">'+
                        '<label for="destino">Destino</label>'+
                        '<input type="text" name="destino_attibutes['+cont_destino+'][destino]" id="destino" class="form-control">'+
                        '<p></p>'+
                    '</div>'+
                    '<div class="col-md-2" id="container_dia_salida">'+
                        '<label for="">Día de salida</label>'+
                        '<div class="input-group date datetimepicker1" >'+
                            '<input type="text" id="dia_salida" name="destino_attibutes['+cont_destino+'][dia_salida]" class="form-control" />'+
                            '<span class="input-group-addon">'+
                                '<span class="glyphicon glyphicon-calendar"></span>'+
                            '</span>'+
                        '</div>'+
                        '<p></p>'+
                    '</div>'+
                    '<div class="col-md-2" id="container_hora_salida">'+
                        '<label for="">Hora de salida</label>'+
                        '<div class="form-group">'+
                            '<div class="input-group date hourpicker">'+
                                '<input type="text" class="form-control" id="destino_attibutes['+cont_destino+'][hora_salida]" name="destino_attibutes['+cont_destino+'][hora_salida]" />'+
                                '<span class="input-group-addon">'+
                                    '<span class="glyphicon glyphicon-time"></span>'+
                                '</span>'+
                            '</div>'+
                        '</div>'+
                        '<p></p>'+
                    '</div>'+
                    '<div class="col-md-2" id="container_dia_regreso_'+cont_destino+'">'+
                        '<label for="">Día regreso</label>'+
                        '<div class="input-group date datetimepicker1" >'+
                            '<input type="text" id="dia_regreso" name="destino_attibutes['+cont_destino+'][dia_regreso]" class="form-control" />'+
                            '<span class="input-group-addon">'+
                                '<span class="glyphicon glyphicon-calendar"></span>'+
                            '</span>'+
                        '</div>'+
                        '<p></p>'+
                    '</div>'+
                    '<div class="col-md-2" id="container_hora_regreso_'+cont_destino+'">'+
                        '<label for="">Hora de entrada</label>'+
                        '<div class="form-group">'+
                            '<div class="input-group date hourpicker">'+
                                '<input type="text" id="hora_regreso" class="form-control" name="destino_attibutes['+cont_destino+'][hora_regreso]" />'+
                                '<span class="input-group-addon">'+
                                    '<span class="glyphicon glyphicon-time"></span>'+
                                '</span>'+
                            '</div>'+
                        '</div>'+
                        '<p></p>'+
                    '</div>'+
                    '<div class="col-md-1"  id="container_is_back">'+
                        '<label for="">Sin fecha de regreso</label><br/>'+
                        '<input type="checkbox" name="is_back" value="'+cont_destino+'" id="is_back" class="is_back">'+
                    '</div>'+
                    '<div class="col-md-1"  id="container_motivo">'+
                        '<label for="">Eliminar</label>'+
                        '<br/>'+
                        '<button type="button" value="'+cont_destino+'" class="btn btn-danger remove_destiny">'+
                            '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+
                        '</button>'+
                    '</div>'+
                '</div>'+
            '';
             /* */

            jQuery('#destinos_array').append(row);
            $('.remove_destiny').click(function () {
                id = $(this).val()
                cont_destino -= 1
                jQuery('#destino_'+id).remove();
                console.log('delete');
            })
            $('.datetimepicker1').datepicker({
                format: 'yyyy-mm-dd',
                language: 'es'
            });
            $('.hourpicker').datetimepicker({
                format: 'LT'
            });

            $('.is_back').change( function() {
                id = $(this).val()
                if( $(this).is(':checked')   ){
                    $('#container_dia_regreso_'+id).hide()
                    $('#container_hora_regreso_'+id).hide()
                }else{
                    $('#container_dia_regreso_'+id).show()
                    $('#container_hora_regreso_'+id).show()
                }
            });

        }

        $('#addDestino').click(function () {
            addDestino()
        })

        $('.remove_destiny').click(function () {
            id = $(this).val()
            cont_destino -= 1
            jQuery('#destino_'+id).remove();
            console.log('delete');

        })

        $('.is_back').change( function() {
            id = $(this).val()
            if( $(this).is(':checked')   ){
                $('#container_dia_regreso_'+id).hide()
                $('#container_hora_regreso_'+id).hide()
            }else{
                $('#container_dia_regreso_'+id).show()
                $('#container_hora_regreso_'+id).show()
            }
        });

        $('#sendData').click( function(e) {
            var getData = [
                $('#direccion'),
                $('#phone'),
                $('#motivo'),
                $('#proyecto')
            ]
            is_valid = validate(getData)
            if( !is_valid ){
                e.preventDefault()
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



    })



</script>

@endsection
