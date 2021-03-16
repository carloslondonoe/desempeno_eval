@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card col-md-12 col-xs-12">

    <table class="table">
        <thead>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>programar</th>
        </thead>
        <tbody>
            @foreach ($evaluaciones as $eva)
                <tr>
                    <td> {{ $eva->titulo }} </td>
                    <td> {{ $eva->descripción }} </td>
                    <td> 
                        <button value=" {{ $eva->id }} " type="button" data-toggle="modal" data-target="#myModal_{{ $eva->id }}"  class="btn btn-info btn_duration">Configurar duración</button> 
                        <!-- Modal -->
                        <div id="myModal_{{ $eva->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div id="notification_{{ $eva->id }}" class="col-md-12 alert alert-success ocultar notification">
                                            Configuración exitosa
                                        </div>  

                                        <div id="container_duration_{{ $eva->id }}">
                                            <label for="">Cantidad</label>
                                            <input value="{{ $eva->duracion }}" type="number" id="duration_{{ $eva->id }}" class="form-control"/>
                                            <p></p>
                                        </div>
                                        
                                        <div id="container_format_{{ $eva->id }}">
                                            <label for="">Tipo de fecha</label>
                                            <select  class="form-control" name="" id="format_{{ $eva->id }}">
                                                <option value="d">Días</option>
                                                <option value="m">Meses</option>
                                                <option value="y">Años</option>
                                            </select>
                                            <p></p>
                                        </div>
                                        <br>
                                        <div>
                                            <button value="{{ $eva->id }}" class="btn btn-success btn_send_data" >Registrar</button>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info close_modal" data-dismiss="modal">Cerrar</button>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                    </td>            
                </tr>
            @endforeach
        </tbody>
    </table>

    

</div>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$(".btn_send_data").click(function (){
    $('#notification').addClass('ocultar')

    id          = $(this).val()
    duration    = $('#duration_'+id)
    format      = $('#format_'+id)

    var getData = [
     duration,
     format
    ]

    sendForm = validate(getData)

    if(sendForm){
        data = {
            id: $(this).val(),
            duration: duration.val(),
            format: format.val()
        }
        $.ajax({
            type:'POST',
            url:'./save_duration',
            data: data,
                success:function(data){ 
                    $('#notification_'+data.evaluacion.id).removeClass('ocultar')
                    if(data.status == "ok"){
                        setTimeout(
                            function(){
                                $('#notification_'+data.evaluacion.id).addClass('ocultar')
                            }, 4000
                        );
                    }
                }
        });
    }
})

function validate(data) {
    sendForm = true
    for (let i = 0; i < data.length; i++) {
        const element = data[i];
        if(element.val() === ''){
            sendForm = false
            id = element.attr('id')
            $('#container_'+id).removeClass('has-success')
            $('#container_'+id).addClass('has-error')
            $('#container_'+id+' p').html('Este campo no puede estar vacío')
        }else{
            id = element.attr('id')
            $('#container_'+id).removeClass('has-error')
            $('#container_'+id).addClass('has-success')
            $('#container_'+id+' p').html('')
        }
    }
    return sendForm;
}


</script>
@endsection