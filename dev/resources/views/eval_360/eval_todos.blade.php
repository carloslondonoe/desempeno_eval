@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />

<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<html lang="en" >
<head>
  <style>
    ul.sortable-list li:after {
    position: absolute;
    line-height: 22px;
    font-size: 18px;
    text-align: right;
    padding-right: 8px;
    content:"×";
    width: 20px;
    height: 100%;
    right: 0;
    color: #999;
}
  .card {
  border: 0 solid #edf2f9;
  border-radius: 0.375rem;
  -webkit-box-shadow: 0 7px 14px 0 rgba(59, 65, 94, 0.1), 0 3px 6px 0 rgba(0, 0, 0, 0.07);
  box-shadow: 0 7px 14px 0 rgba(59, 65, 94, 0.1), 0 3px 6px 0 rgba(0, 0, 0, 0.07);
}

.card-body {
  padding: 0.5rem;
  background-color: #f9fafd !important;
}

.card-header {
  padding: 1rem 1.25rem;
  background-color: #fff;
  border-bottom: 0 solid #edf2f9;
}

.dragableMultiselect {
  display: none;
}

.dragSortableItems .sortable-list {
  list-style: none;
  margin: 0;
  min-height: 20px;
  padding: 0px;
}
.dragSortableItems .sortable-item {
  background-color: #fff;
  border: 1px solid #ddd;
  display: block;
  margin-bottom: -1px;
  padding: 10px;
  cursor: move;
  position: relative;
  padding-left: 30px;
}
.dragSortableItems .sortable-item .icon-drag {
  color: #ccc;
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
}
.dragSortableItems .sortable-item .sortable-item-input {
  visibility: hidden;
  pointer-events: none;
  position: absolute;
}
.dragSortableItems .placeholder {
  border: 1px dashed #666;
  height: 45px;
  margin-bottom: 5px;
}
.dragSortableItems .fixed-panel {
  max-height: 500px;
  overflow-y: auto;
  padding-bottom: 1px;
}

.custom-scrollbar::-webkit-scrollbar {
  width: 7px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #888;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  border-radius: 5px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #555;
}
  </style>
  <meta charset="UTF-8">
  <title>CodePen - Sortable Drag &amp; Drop Multi-Select</title>

</head>
<body>
<!-- partial:index.partial.html -->
<!--div class="alert alert-info small"><i class="fa fa-comment"></i>&nbsp;&nbsp;Drag &amp; Drop fields from the left (Available Fields) over to the right side in the desired location on your dashboard.</div-->
<span name="el_validationErrorFields"></span>
<br />
<div class="row dragSortableItems">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Colaboradores - Cargo</div>
      <div class="card-body well">
        <ul id="in_available_fields" name="in_available_fields" class="custom-scrollbar in_available_fields sortable-list fixed-panel ui-sortable">
          @foreach($cargos_select as $cus)
          <li class="sortable-item allowPrimary allowSecondary allowExport" name="eval" data-fid='{{$cus->id}}'>{{$cus->cargo}}</li>
          @endforeach

        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <form id="form1" action="{{ route('evaluadoresfull') }}" method="POST" >
{!! csrf_field() !!}
    <div class="card primaryPanel">
      <div class="card-header"><i class="fa fa-star"></i>&nbsp;&nbsp;Confirmar Evaluadores 1</div>
      <div class="card-body well">
        <div class="alert alert-warning small">
          <center>No Fields Selected</center>
        </div>
        <ul name="in_primary_fields" id="in_primary_fields"  class="sortable-list primaryDropzone fixed-panel">
        @foreach($evaluadores as $eva)
        @if ($eva->evaluacion_t == 1)
        <li class="in_primary_fields sortable-item allowPrimary allowSecondary allowExport ui-sortable-handle" name="eval" data-fid='{{$eva->id}}'  style="position: relative; left: 0px; top: 0px;"> {{$eva->cargo}}</li>
        @endif
        @empty
        @endforelse
        </ul>
      </div>
    </div>
    <br />

    <div class="card secondaryPanel">
      <div class="card-header"><i class="fa fa-star-o"></i>&nbsp;&nbsp;Confirmar Evaluadores 2</div>
      <div class="card-body well">
        <div class="alert alert-warning small">
          <center>No Fields Selected</center>
        </div>
        <ul name="in_secondary_fields" id="in_secondary_fields"  class="sortable-list secondaryDropzone fixed-panel">
        @foreach($evaluadores as $eva)
        @if ($eva->evaluacion_t == 2)
        <li class="in_secondary_fields sortable-item allowPrimary allowSecondary allowExport ui-sortable-handle" name="eval" data-fid='{{$eva->id}}'  style="position: relative; left: 0px; top: 0px;"> {{$eva->cargo}}</li>
        @endif
        @empty
        @endforelse
        </ul>
      </div>
    </div>
    <br />
        <div class="card exportPanel">
      <div class="card-header"><i class="fa fa-download"></i>&nbsp;&nbsp;Confirmar Evaluadores 3</div>
      <div class="card-body well">
        <div class="alert alert-warning small">
          <center>No Fields Selected</center>
        </div>
        <ul name="in_export_fields" id="in_export_fields"  class="sortable-list exportDropzone fixed-panel">
        @foreach($evaluadores as $eva)
        @if ($eva->evaluacion_t == 3)
        <li class="in_export_fields sortable-item allowPrimary allowSecondary allowExport ui-sortable-handle" name="eval" data-fid='{{$eva->id}}'  style="position: relative; left: 0px; top: 0px;"> {{$eva->cargo}}</li>
        @endif
        @empty
        @endforelse
        </ul>

      </div>
    </div>
    <div class="col-md-12" style="text-align: center">
        <button type="button" id="guardar" class="btn btn-success">
            <span class="glyphicon glyphicon-cloud-download"></span>
            Confirmar Evaluadores
        </button>
    </div>
      </form>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>
        <div class="modal-body">
            <div id="msg_save"class="alert alert-success">
                Evaluadores Registrados de manera exitosa
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onClick="window.location.reload();" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
  </div>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
<script src="{{ asset ('js/script.js')}}"></script>
 
  

<script>
// On ready
$(document).ready(function() {
  $(".sortable-list li").click(function(e) {
    if ($(this).outerWidth() - 34 <= e.offsetX)
        $(this).remove();
        if ( $('.in_primary_fields').length == 0 ) {
  $('.primaryPanel').find('.alert').show();

}

if ( $('.in_secondary_fields').length == 0  ) {
  $('.secondaryPanel').find('.alert').show();
}

if ( $('.in_export_fields').length == 0  ) {
  $('.exportPanel').find('.alert').show();
}
});



if ( $('.in_primary_fields').length > 0 ) {
  $('.primaryPanel').find('.alert').hide();

}

if ( $('.in_secondary_fields').length >0 ) {
  $('.secondaryPanel').find('.alert').hide();
}

if ( $('.in_export_fields').length > 0 ) {
  $('.exportPanel').find('.alert').hide();
}
  $('#guardar').click(function() {
    var items = $("#in_primary_fields").sortable('toArray', {
    attribute: 'data-fid'
    });
    var items2 = $("#in_secondary_fields").sortable('toArray', {
    attribute: 'data-fid'
    });
    var items3 = $("#in_export_fields").sortable('toArray', {
    attribute: 'data-fid'
    });
    console.log(items3)
                $.ajax({
                    type:'POST',
                    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                    url:'guardarEvaluadores',
                    data:{items:items, items2:items2, items3:items3 },
                      success:function(data){ 
                         if (data.status=="ok") {
                          $('#myModal').modal('show')
                         }
                      }
                  });


  })
  // Set up our dropzone
  $('#in_available_fields').sortable({
    connectWith: '.sortable-list',
    placeholder: 'placeholder',
    start: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      checkFields()
    },
    stop: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass("panel-danger").addClass('panel-primary');
      }
  
    },
    change: function(event, ui) {
      checkFields();
    },
    update: function(event, ui) {
      checkFields();
    },
    out: function(event, ui) {
      checkFields();
    }
  }).disableSelection();

  // Enable dropzone for primary fields
  $('.primaryDropzone').sortable({
    connectWith: '.sortable-list',
    placeholder: 'placeholder',
    receive: function(event, ui) {
      // If we dont allow primary fields here, cancel
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(ui.placeholder).css('display', 'none');
        $(ui.sender).sortable("cancel");
      }
    },
    over: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(ui.placeholder).css('display', 'none');
      } else {
        $(ui.placeholder).css('display', '');
      }
    },
    start: function(event, ui) {
      checkFields()
    },
    change: function(event, ui) {
      checkFields();
    },
    update: function(event, ui) {
      checkFields();
    },
    out: function(event, ui) {
      checkFields();
    }
  }).disableSelection();

  // Enable dropzone for secondary fields
  $('.secondaryDropzone').sortable({
    connectWith: '.sortable-list',
    placeholder: 'placeholder',
    receive: function(event, ui) {
      // If we dont allow secondary fields here, cancel
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(ui.sender).sortable("cancel");
      }
    },
    over: function(event, ui) {
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(ui.placeholder).css('display', 'none');
      } else {
        $(ui.placeholder).css('display', '');
      }
      checkFields();
    },
    start: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      checkFields();
    },
    stop: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass("panel-danger").addClass('panel-primary');
      }
    },
    change: function(event, ui) {
      checkFields();
    },
    update: function(event, ui) {
      checkFields();
    },
    out: function(event, ui) {
      checkFields();
    }
  }).disableSelection();

  // Enable dropzone for export fields
  $('.exportDropzone').sortable({
    connectWith: '.sortable-list',
    placeholder: 'placeholder',
    receive: function(event, ui) {
      // If we dont allow export fields here, cancel
      if (!$(ui.item).hasClass("allowExport")) {
        $(ui.sender).sortable("cancel");
      }
      checkFields();
    },
    over: function(event, ui) {
      if (!$(ui.item).hasClass("allowExport")) {
        $(ui.placeholder).css('display', 'none');
      } else {
        $(ui.placeholder).css('display', '');
      }
      checkFields();
    },
    start: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      checkFields()
    },
    stop: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass("panel-danger").addClass('panel-primary');
      }
    },
    change: function(event, ui) {
      checkFields();
    },
    update: function(event, ui) {
      checkFields();
    },
    out: function(event, ui) {
      checkFields();
    }
  }).disableSelection();

});

// Checks to see if the fields section has fields selected. If not, shows a placeholder
function checkFields() {
  if ($('[name=in_primary_fields] li').length >= 1) {
    $('.primaryPanel').find('.alert').hide();



  } else {
    $('.primaryPanel').find('.alert').show();
  }

  if ($('[name=in_secondary_fields] li').length >= 1) {
    $('.secondaryPanel').find('.alert').hide();
  } else {
    $('.secondaryPanel').find('.alert').show();
  }

  if ($('[name=in_export_fields] li').length >= 1) {
    $('.exportPanel').find('.alert').hide();
  } else {
    $('.exportPanel').find('.alert').show();
  }
}


</script>
</body>
@endsection
