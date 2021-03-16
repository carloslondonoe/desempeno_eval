@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<h1>Formulario</h1>


<select class="js-example-basic-multiple form-control" name="states[]" multiple="multiple">
    <option value="AL">Alabama</option>
    <option value="WY">Wyoming</option>
</select>

<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endsection
