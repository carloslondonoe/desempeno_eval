@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">


<div class="card box-body table-responsive no-padding">
        <table class="table table-hover table-striped table-bordered">
                <thead>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Planes de trabajo</th>
                </thead>
                <tbody>
                        @foreach ($users as $user)
                        <tr>
                                <td> {{ $user->apellido  }} </td>
                                <td>{{$user->name}}</td>
                                <td> {{$user->cargo->cargo}} </td>
                                <td>
                                    <a href="{{ route('plan_trabajo_admin_user', $user) }}" class="btn btn-primary">Planes de trabajo</a>
                                </td>
                        </tr>
                        @endforeach

                </tbody>
        </table>
</div>

@endsection