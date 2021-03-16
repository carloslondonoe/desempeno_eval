<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Planes de trabajo
Route::get('plan_trabajo/mis_planes', 'EvaluacionesController@mis_planes')->name('mis_planes');
Route::get('plan_trabajo/{autoevaluacion}', 'EvaluacionesController@plan_trabajo')->name('plan_trabajo');
Route::get('plan_trabajo_admin', 'EvaluacionesController@plan_trabajo_admin')->name('plan_trabajo_admin');
Route::get('plan_trabajo_admin/{user}', 'EvaluacionesController@plan_trabajo_admin_user')->name('plan_trabajo_admin_user');
Route::get('plan_trabajo_admin/seguimientos/{seguimeinto}', 'EvaluacionesController@plan_trabajo_admin_user_seguimiento')->name('plan_trabajo_admin_user_seguimiento');


Route::post('plan_trabajo/save', 'EvaluacionesController@save_plan_trabajo');
Route::post('plan_trabajo/update_seguimiento/{seguimiento}', 'EvaluacionesController@update_seguimiento');
Route::post('plan_trabajo/select_seguimiento/{seguimeinto}', 'EvaluacionesController@select_seguimiento')->name('select_seguimiento');
Route::post('plan_trabajo/delete_seguimiento/{seguimeinto}', 'EvaluacionesController@delete_seguimiento')->name('delete_seguimiento');

Route::post('plan_trabajo/close_plan/{seguimeinto}', 'EvaluacionesController@close_plan')->name('close_plan');

//Reporte General
Route::get('reporte_final/{valoracion}', 'EvaluacionesController@reporte_final')->name('reporte_final');

    //mails
Route::get('plan_trabajo/accept/{seguimiento}', 'EvaluacionesController@accept_plan_trabajo')->name('show_state_seguimiento');
Route::get('plan_trabajo/aceptar/{seguimiento}', 'EvaluacionesController@aceptar_seguimiento')->name('aceptar_plan_trabajo');
Route::get('plan_trabajo/rechazar/{seguimiento}', 'EvaluacionesController@rechazar_seguimiento')->name('rechazar_plan_trabajo');


//Activities
Route::post('plan_trabajo/save_activity', 'EvaluacionesController@save_activity')->name('save_activity');
Route::post('plan_trabajo/select_activities', 'EvaluacionesController@select_activities')->name('select_activities');
Route::post('plan_trabajo/close_activities', 'EvaluacionesController@close_activities')->name('close_activities');
Route::post('plan_trabajo/select_activity/{activity}', 'EvaluacionesController@select_activity')->name('select_activity');
Route::post('plan_trabajo/update_activity/{activity}', 'EvaluacionesController@update_activity')->name('update_activity');
Route::post('plan_trabajo/delete_activity/{activity}', 'EvaluacionesController@delete_activity')->name('delete_activity');


//Cargos
Route::get('cargos_config', 'CargosController@index')->name('cargosfull');;
Route::get('cargos/{cargo}', 'CargosController@show');
Route::post('cargos/search', 'CargosController@search');
Route::post('cargos/save_orden_cargos', 'CargosController@save_orden_cargos');

//Evaluaciones
//Route::get('evaluaciones', 'EvaluacionesController@show');
Route::get('evaluaciones_duracion', 'EvaluacionesController@duration_valuation')->name('evaluaciones_duracion');
Route::post('save_duration', 'EvaluacionesController@save_duration')->name('save_duration');

Route::get('autoevaluacion', 'EvaluacionesController@autoEvaluacion')->name('autoevaluacion');
Route::get('lista_autoevaluaciones', 'EvaluacionesController@lista_user_auto_auto_evaluaciones')->name('lista_autoevaluaciones');

Route::get('lista_autoevaluaciones_new', 'EvaluacionesController@lista_user_auto_auto_evaluaciones_new')->name('lista_autoevaluaciones_new');

Route::get('show_autoevaluacion/{autoevaluacion}', 'EvaluacionesController@show_autoevaluacion')->name('show_autoevaluacion');
Route::get('show_autoevaluaciones/{user}', 'EvaluacionesController@show_autoevaluaciones')->name('show_autoevaluaciones');


Route::post('save_autoevaluacion', 'EvaluacionesController@save_autoevaluacion')->name('save_autoevaluacion');
Route::get('autoevaluaciones', 'EvaluacionesController@lista_auto_evalucione')->name('autoevaluaciones');

Route::get('calificar_autoevaluacion/{user}', 'EvaluacionesController@autoEvaluacionCoordinador')->name('calificar_autoevaluacion');
Route::post('autoevaluacion', 'EvaluacionesController@save_calificacion_coordinador')->name('save_calificacion_coordinador');

//Valoraciones
Route::get('valorar_evaluacion/{user}', 'ValoracionController@valoracion')->name('valorar_evaluacion');
Route::post('valorar_evaluacion', 'ValoracionController@save_valoracion')->name('valorar_evaluacion_save');
Route::get('valoraciones/report_excel', 'ValoracionController@report_excel')->name('valoraciones_report_excel');
Route::post('valoraciones/export_excel', 'ValoracionController@export_excel')->name('valoraciones_export_excel');

//Indicadore Maestro
Route::get('maestro_indicadores/report_excel', 'MaestroIndicadorController@report_excel')->name('maestro_indicadores_report_excel');
Route::post('maestro_indicadores/export_excel', 'MaestroIndicadorController@export_excel')->name('maestro_indicadores_export_excel');


// Reporte General
Route::get('reporte_general/report_excel', 'ReportesGeneralesController@report_excel')->name('reporte_general_report_excel');
Route::post('reporte_general/export_excel', 'ReportesGeneralesController@export_excel')->name('reporte_general_export_excel');
Route::get('reporte_general/report_excel_por_mes', 'ReportesGeneralesController@report_excel_por_mes')->name('reporte_general_report_excel_por_mes');
Route::post('reporte_general/report_excel_por_mes', 'ReportesGeneralesController@export_excel_por_ciclos')->name('reporte_general_export_excel_por_mes');
#Route::post('reporte_general/report_excel_por_mes', 'ReportesGeneralesController@export_excel_por_mes')->name('reporte_general_export_excel_por_mes');

//Nuevo Reporte de ciclos
Route::get('reporte_general/ciclos', 'ReportesGeneralCiclos@ciclos')->name('reporte_ciclos');
Route::post('reporte_general/cilos', 'ReportesGeneralCiclos@ciclos')->name('reporte_ciclos');
// Graphics
Route::get('reporte_general/reporte_grafico', 'ReportesGeneralesController@graphical_report')->name('reporte_general_reporte_grafico');
Route::get('reporte_general/reporte_grafico_comportamiento', 'ReportesGeneralesController@graphical_report_behavior')->name('reporte_general_graphical_report_behavior');
Route::get('reporte_general/reporte_grafico_view', 'ReportesGeneralesController@graphical_report_view')->name('reporte_grafico_view');


Route::get('reporte_general/reporte_grafico_cycle', 'ReportesGeneralesController@graphical_report_cycle')->name('reporte_general_reporte_grafico_cycle');
Route::get('reporte_general/reporte_grafico_comportamiento_cycle', 'ReportesGeneralesController@graphical_report_behavior_cycle')->name('reporte_general_graphical_report_behavior_cycle');



//temporal
Route::post('temporal_evaluacion', 'TemporalTablesController@save')->name('temporal_evaluacion');
Route::get('temporal_evaluacion', 'TemporalTablesController@index')->name('temporal_evaluacion');

Route::post('temporal_coordinador', 'TemporalTablesController@saveCoordinador')->name('temporal_coordinador');
Route::get('temporal_coordinador', 'TemporalTablesController@indexCoordinador')->name('temporal_coordinador');

Route::post('temporal_valoracion', 'TemporalTablesController@saveValoracion')->name('temporal_valoracion');
Route::get('temporal_valoracion', 'TemporalTablesController@indexValoracion')->name('temporal_valoracion');

//permisos
Route::get('permisos/create', 'PermisoSaldidasController@create')->name('permisos/create');
Route::get('cancelar_permiso/{id}/{jefe_id}', 'PermisoSaldidasController@cancelPermissions')->name('cancelar_permiso');
Route::get('aceptar_permiso/{id}/{jefe_id}', 'PermisoSaldidasController@acceptPermissions')->name('aceptar_permiso');

Route::post('permisos', 'PermisoSaldidasController@store')->name('permisos_save');
Route::get('permisos', 'PermisoSaldidasController@index')->name('permisos');
Route::get('permisos/show/{user_id}', 'PermisoSaldidasController@show')->name('permisos_show');
Route::get('mis_permisos/show', 'PermisoSaldidasController@mis_permisos')->name('mis_permisos_show');
Route::get('permisos/show_permiso/{permiso_id}', 'PermisoSaldidasController@show_permiso')->name('permisos_show_permiso');

//Solicitudes
Route::get('solicitud/create', 'SolicitudesTiquetesController@create')->name('solicitudes_create');
Route::post('solicitudes_save', 'SolicitudesTiquetesController@store')->name('solicitudes_save');

Route::get('cancelar_solicitud/{id}/{jefe_id}', 'SolicitudesTiquetesController@cancelSolicitud')->name('cancelar_solicitud');
Route::get('aceptar_solicitud/{id}/{jefe_id}', 'SolicitudesTiquetesController@acceptSolicitud')->name('aceptar_solicitud');

Route::get('solicitudes', 'SolicitudesTiquetesController@index')->name('solicitudes');
Route::get('solicitudes/show/{user_id}', 'SolicitudesTiquetesController@show')->name('solicitudes_show');
Route::get('solicitudes/show_solicitud/{solicitud_id}', 'SolicitudesTiquetesController@show_solicitud')->name('solicitudes_show_solicitud');
Route::get('solicitudes/show', 'SolicitudesTiquetesController@mis_solicitudes')->name('mis_solicitudes_show');

//Reporte Grafico nuevo
Route::post('grafico/general', 'Reportesgraficoscontroller@competencias')->name('grafico_general');
Route::get('grafico/general', 'Reportesgraficoscontroller@competencias')->name('grafico_general');


//Graficos Comparativo
Route::get('grafico/comparativo', 'Reportesgraficoscomparar@comparar')->name('grafico_comparar');
Route::post('grafico/comparativo', 'Reportesgraficoscomparar@comparar')->name('grafico_comparar');


//Graficos Comparativo
Route::get('grafico/comparar_jefes', 'Reportejefecompara@comparar')->name('grafico_compararj');
Route::post('grafico/comparar_jefes', 'Reportejefecompara@comparar')->name('grafico_compararj');


//Graficos Comparativo full
Route::get('grafico/comparativo_full', 'Reportesgraficoscompararfull@compararfull')->name('grafico_comparar_full');
Route::post('grafico/comparativo_full', 'Reportesgraficoscompararfull@compararfull')->name('grafico_comparar_full');

//Reporte Grafico nuevo
Route::post('cambio/password', 'CambioPassword@password')->name('contrasena');
Route::get('cambio/password', 'CambioPassword@password')->name('contrasena');

//Reporte de viajes - Beatriz
Route::post('reporteviajes','Reporte_viajes@viajes')->name('viajes_r');
Route::get('reporteviajes','Reporte_viajes@viajes')->name('viajes');


//Solicitudes
Route::get('/solicitudesfull', function() {
    return view('solicitud');
});


//Evaluaciones para todos
Route::get('asignar_evaluadores', 'AdminEvalTodos@index')->name('evaluadoresfull');;
Route::post('asignar_evaluadores', 'AdminEvalTodos@index')->name('evaluadoresfull');;
//Route::get('evluadores/{evaluador}', 'AdminEvalTodos@show');
Route::get('evluadores{cargo}', 'AdminEvalTodos@show');
Route::post('evaluadores/search', 'AdminEvalTodos@search');
Route::post('evaluadores/save', 'AdminEvalTodos@save_evaluadores');

//Evaluaciones 360
Route::get('misevaluaciones','AdminEvalTodos@mis360')->name('miseval360');
Route::post('misevaluaciones','AdminEvalTodos@mis360')->name('miseval360');
Route::post('misevaluaciones','AdminEvalTodos@guardar')->name('guardarmiseval360');
Route::post('evaluacion360','AdminEvalTodos@realizar')->name('realizar360');
Route::get('evaluacion360','AdminEvalTodos@realizar')->name('realizar360');
Route::post('salvar360', 'AdminEvalTodos@salvar')->name('360salvar');
Route::post('guardarEvaluadores', 'AdminEvalTodos@guardarEvaluadores');

