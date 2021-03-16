<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Cambio Contraseña</title>
    <meta name='generator' content='CRUDBooster'/>
    <meta name='robots' content='noindex,nofollow'/>
    <link rel="shortcut icon" href="{{ CRUDBooster::getSetting('favicon')?asset(CRUDBooster::getSetting('favicon')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />


    <link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/css/main.css")}}'/>
    <style type="text/css">
      .lockscreen {
          background: {{ CRUDBooster::getSetting("login_background_color")?:'#dddddd'}} url('{{ CRUDBooster::getSetting("login_background_image")?asset(CRUDBooster::getSetting("login_background_image")):asset('vendor/crudbooster/assets/bg_blur3.jpg') }}');
          color: {{ CRUDBooster::getSetting("login_font_color")?:'#ffffff' }} !important;
          background-repeat: no-repeat;
          background-position: center;
          background-size: cover;
      }
    </style>
  </head>
  <body class="lockscreen">

    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="{{url('/')}}">
            <img title='{!!($appname == 'CRUDBooster')?"<b>CRUD</b>Booster":$appname!!}' src='{{ CRUDBooster::getSetting("logo")?asset(CRUDBooster::getSetting('logo')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}' style='max-width: 100%;max-height:170px'/>
        </a>
      </div>

      <div class="lockscreen-name"><h4>Hola, {{Session::get('admin_name')}} {{Session::get('admin_apellido')}}</h4></div>


      <div class="lockscreen-item">



        <form class="lockscreen-credentials" method='post' action="{{ route('contrasena') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="input-group">
            <input type="password" class="form-control" required name='password' placeholder="Contraseña" />
            <div class="input-group-btn">
              <button class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form>
      </div>


@if($newpassword == '')
<div class="text-center">
<h3>Ingresa tú nueva contreaseña</h3>
</div>

@else
<div class="text-center">
<h3>Cambio Exitoso</h3>
<h3><a style="color:white;" href="{{ url(config('crudbooster.ADMIN_PATH')) }}">Puedes al sitio haciendo clic aqui</a></h3>
</div>
@endif

</br>
      <div class='lockscreen-footer text-center'>
        Copyright &copy; {{date("Y")}}<br>
        All rights reserved
      </div>
    </div>

    <script src="{{asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

    <script src="{{asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
  </body>
</html>
