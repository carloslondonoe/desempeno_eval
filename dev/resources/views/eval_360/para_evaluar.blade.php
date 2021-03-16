
@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

<div class="card box-body table-responsive no-padding" style="text-align:center !important">

    <h2>Usuarios a evaluar en 360</h2>

    <table class="table table-hover table-striped table-bordered">
        <thead>
          <th style="text-align: center">Usuaio a evaluar</th>
          <th style="text-align: center">Tipo de evaluacion</th>
        </thead>
        @foreach($misevaluaciones as $mv)
        <tr>
          <th scope="row">{{$mv->usuario}}</th>
          <td>{{$mv->evaluacion}}</td>
          <td><a href="/evaluacion360?evl={{$mv->evl}}" class="btn btn-warning">Evaluar</a></td>

        </tr>

        @endforeach
        <tbody>
        </tbody>
    </table>
</div>
@endsection
