@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<style>
.select_input{
  width: 500%;
}

</style>

<div class="card">
  <table class="table">
      <thead>
              <th>Cargo</th>
              <th></th>
      </thead>
      <tbody>
          @foreach ($cargos as $cargo)
            @if ($cargo->pcargos == 'Si')
              <tr>
                  <td>{{$cargo->cargo}}</td>
                  <td>
                    <button  class="btn btn-warning open_modal" value="{{ $cargo->id }}">Asignar Cargos</button>
                  </td>
              </tr>
            @endif
          @endforeach
      </tbody>
  </table>
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
                <div id="msg_save"class="alert alert-success">

                </div>
                <h3 id="title_cargo_modal"></h3>
                <input type="hidden" value="" id="cargo_id">
                <select id="select_orden_cargo_modal" class="js-example-basic-multiple form-control select_input" name="orden_cargos[]" multiple="multiple">
                    @foreach ($cargos as $cargo)
                      @if ($cargo->pcargos == 'No')
                        <option value="{{$cargo->id}}"> {{$cargo->cargo}} </option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
              <button id="respuestas_orden_cargos" type="button" class="btn btn-success">Guardar</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.js-example-basic-multiple').select2();
                $('.open_modal').click(function (){
                  id = $(this).val()
                  $.ajax({
                    type:'POST',
                    url:'cargos/search',
                    data:{id:id},
                      success:function(data){ 
                        $('#msg_save').html('')
                        $('#msg_save').hide()
                        const array_cargos = []
                        cargo = data[0]
                        orden_cargo = data[1]
                        console.log(data);
                        for (let index = 0; index < orden_cargo.length; index++) {
                          const element = orden_cargo[index]['cargo_id'];
                          array_cargos.push(element)
                        }
                        msg = 'Editar cargo: '+cargo['cargo']
                        $('#title_cargo_modal').html(msg)
                        $('#cargo_id').val(cargo['id'])
                      
                        $('#select_orden_cargo_modal').val(array_cargos)
                        $('#select_orden_cargo_modal').trigger('change');
                        $('#myModal').modal('show')
                      }
                  });
                });
                $('#respuestas_orden_cargos').click(function (){
                  id = $('#cargo_id').val()
                  orden_cargos = $('#select_orden_cargo_modal').val()
                  console.log(orden_cargos);
                  
                  $.ajax({
                    type:'POST',
                    url:'cargos/save_orden_cargos',
                    data:{id: id, orden_cargos: orden_cargos},
                      success:function(data){ 
                        console.log(data);
                        
                        if(data.status == 'ok'){
                          $('#msg_save').show()
                          $('#msg_save').html('Registro almacenado de manera exitosa')
                        }
                      }
                  });
                })
                

            });
      </script>
@endsection