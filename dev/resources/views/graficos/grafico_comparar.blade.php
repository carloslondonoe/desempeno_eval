@extends('crudbooster::admin_template')
@section('content')

<style>
#table_ld, #table_weqp, #table_inova, #table_compe,#table_compets  {
    visibility: collapse;
}
.highcharts-credits {
    visibility: collapse !important
}
#cont_compe {
    overflow: initial !important;
}
#inic {
    text-align: center;
}
#datatable thead tr, #datatable tr:nth-child(even) {
  background: #f8f8f8;
}
#datatable tr:hover {
  background: #f1f7ff;
}

</style>
<script src="https://code.highcharts.com/modules/pattern-fill.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<form method="POST" action="{{ route('grafico_comparar') }}">
{!! csrf_field() !!}
<div class="col-md-2">
    <label for="">Seleccione año</label>
    <select name="ano" id="ano" class="form-control">
      <option value="0">Seleccione un año</option>

    </select>
</div>

<div class="col-md-2"  style="text-align: center">
    <label for="">Seleccione ciclo</label>
    <select name="ciclo" id="ciclo" class="form-control">
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
</div>

<div class="col-md-2">
    <label for="">Seleccione año</label>
    <select name="ano1" id="ano1" class="form-control">
      <option value="0">Seleccione un año</option>

    </select>
</div>

<div class="col-md-2"  style="text-align: center">
    <label for="">Seleccione ciclo</label>
    <select name="ciclo1" id="ciclo1" class="form-control">
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
</div>

<div class="col-md-2"  style="text-align: center">
    <label for="">Colaboradores con personal a cargo</label><br/>
    Si<input type="radio" name="acargo" id="acargo" value="Si">
    No<input type="radio" name="acargo" id="acargo" value="No" >
</div>

<div class="col-md-12">
    <br/>
</div>
<div class="col-md-12" style="text-align: center">
    <button type="submit" class="btn btn-success">
        <span class="glyphicon glyphicon-cloud-download"></span>
        Generar reporte comparativo
    </button>
</div>

<div class="col-md-12">
    <br/>
</div>
</form>

@if(($ciclo == '') AND ($ciclo1 == ''))
@else
</br>
<div class="content">
  <div id="inic"><h5><strong>DATOS A COMPARAR</strong></h5></div>
<div id="inic"><h5><strong>Personal a cargo: </strong>{{$acargo}}</h5></div>
<div id="inic"><h5><strong>Ciclo: </strong>{{$ciclo}}<strong> Año: </strong>{{$ano}}</h5></div>
<div id="inic"><h5><strong>Ciclo: </strong>{{$ciclo1}}<strong> Año: </strong>{{$ano1}}</h5></div>
</div>
</br>


<figure class="highcharts-figure">
  <div id="cont_compets"></div>
    <table id="table_compets">
    <thead>
      <tr>
        <th>INDICADORES Y COMPETENCIAS</th>
        <th>{{$ano1}} - {{$ciclo1}}</th>
        <th>{{$ano}} - {{$ciclo}}</th>


    </thead>
    <tbody>
      @foreach ($totales as $pts)
      <tr>
      <th>{{$pts->competencia}}</th><td>{{$pts->promedio1}}</td> <td>{{$pts->promedio2}}</td>
      </tr>
      @endforeach

    </tbody>
  </table>

</figure>

</br>
<figure class="highcharts-figure">
  <div id="cont_compe"></div>
    <table id="table_compe">
    <thead>
      <tr>
        <th>COMPETENCIAS</th>
        <th>{{$ano1}} - {{$ciclo1}}</th>
        <th>{{$ano}} - {{$ciclo}}</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($puntuacionfnl as $pt)
      <tr>
      <th>{{$pt->competencia}}</th><td>{{$pt->promedio1}}</td> <td>{{$pt->promedio2}}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
</figure>
</br>
<figure class="highcharts-figure">
  <div id="cont_ld"></div>
    <table id="table_ld">
    <thead>
      <tr>
        <th>COMPORTAMIENTOS</th>
        <th>{{$ano1}} - {{$ciclo1}}</th>
        <th>{{$ano}} - {{$ciclo}}</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($liderazgo as $ld)
      <tr>
      <th>{{$ld->competencia}}</th><td>{{$ld->promedio1}}</td> <td>{{$ld->promedio2}}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
</figure>

</br>
<figure class="highcharts-figure">
  <div id="cont_inova"></div>
    <table id="table_inova">
    <thead>
      <tr>
        <th>COMPORTAMIENTOS</th>
        <th>{{$ano1}} - {{$ciclo1}}</th>
        <th>{{$ano}} - {{$ciclo}}</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($innovacion as $inv)
      <tr>
      <th>{{$inv->competencia}}</th><td>{{$inv->promedio1}}</td> <td>{{$inv->promedio2}}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
</figure>

</br>
<figure class="highcharts-figure">
  <div id="cont_weqp"></div>
    <table id="table_weqp">
    <thead>
      <tr>
        <th>COMPORTAMIENTOS</th>
        <th>{{$ano1}} - {{$ciclo1}}</th>
        <th>{{$ano}} - {{$ciclo}}</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($trabajoenequipo as $wt)
      <tr>
      <th>{{$wt->competencia}}</th><td>{{$wt->promedio1}}</td> <td>{{$wt->promedio2}}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
</figure>



@endif

<script>
$(document).ready(function () {
selectYear = document.getElementById("ano");
var d = new Date();
var n = d.getFullYear();
for(var i = n; i >= 2019; i--) {
    var opc = document.createElement("option");
    opc.text = i;
    opc.value = i;
    selectYear.add(opc)
}

});

</script>
<script>
$(document).ready(function () {
selectYear = document.getElementById("ano1");
var d = new Date();
var n = d.getFullYear();
for(var i = n; i >= 2019; i--) {
    var opc = document.createElement("option");
    opc.text = i;
    opc.value = i;
    selectYear.add(opc)
}

});

</script>

<script>
Highcharts.chart('cont_compe', {
  data: {
    table: 'table_compe'
  },
  chart: {
    type: 'column'
  },
  title: {
    text: 'COMPARATIVO COMPETENCIAS'
  },
  xAxis: {
    title: {
      text: 'COMPETENCIAS'
      }
    },
    yAxis: {
    allowDecimals: false,
    title: {
      text: 'PROMEDOS'
    }
  },
  plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:.1f}%'
        }
      }
    },

  tooltip: {
    formatter: function () {
      return '<b>' + this.series.name + '</b><br/>' +
        this.point.y +'%'+' ' + this.point.name.toLowerCase();
    }
  }
});
</script>


<script>
Highcharts.chart('cont_ld', {
  data: {
    table: 'table_ld'
  },
  chart: {
    type: 'column'
  },
  title: {
    text: 'COMPARATIVO LIDERAZGO'
  },
  xAxis: {
    title: {
      text: 'COMPORTAMIENTOS'
      }
    },
    yAxis: {
    allowDecimals: false,
    title: {
      text: 'PROMEDOS'
    }
  },
  plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:.1f}%'
        }
      }
    },

  tooltip: {
    formatter: function () {
      return '<b>' + this.series.name + '</b><br/>' +
        this.point.y +'%'+' ' + this.point.name.toLowerCase();
    }
  }
});
</script>

<script>
Highcharts.chart('cont_inova', {
  data: {
    table: 'table_inova'
  },
  chart: {
    type: 'column'
  },
  title: {
    text: 'COMPARATIVO INNOVACIÓN'
  },
  xAxis: {
    title: {
      text: 'COMPORTAMIENTOS'
      }
    },
    yAxis: {
    allowDecimals: false,
    title: {
      text: 'PROMEDOS'
    }
  },
  plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:.1f}%'
        }
      }
    },

  tooltip: {
    formatter: function () {
      return '<b>' + this.series.name + '</b><br/>' +
        this.point.y +'%'+' ' + this.point.name.toLowerCase();
    }
  }
});
</script>


<script>
Highcharts.chart('cont_weqp', {
  data: {
    table: 'table_weqp'
  },
  chart: {
    type: 'column'
  },
  title: {
    text: 'COMPARATIVO TRABAJO EN EQUIPO'
  },
  xAxis: {
    title: {
      text: 'COMPORTAMIENTOS'
      }
    },
    yAxis: {
    allowDecimals: false,
    title: {
      text: 'PROMEDOS'
    }
  },
  plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:.1f}%'
        }
      }
    },

  tooltip: {
    formatter: function () {
      return '<b>' + this.series.name + '</b><br/>' +
        this.point.y +'%'+' ' + this.point.name.toLowerCase();
    }
  }
});
</script>


<script>
Highcharts.chart('cont_compets', {
  data: {
    table: 'table_compets'
  },
  chart: {
    type: 'column'
  },
  title: {
    text: 'COMPARATIVO COMPETENCIAS Y INDICADORES'
  },
  xAxis: {
    title: {
      text: 'COMPORTAMIENTOS Y INDICADORES'
      }
    },
    yAxis: {
    allowDecimals: false,
    title: {
      text: 'PROMEDOS'
    }
  },
  plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:.1f}%'
        }
      }
    },

  tooltip: {
    formatter: function () {
      return '<b>' + this.series.name + '</b><br/>' +
        this.point.y +'%'+' ' + this.point.name.toLowerCase();
    }
  }
});
</script>



@endsection
