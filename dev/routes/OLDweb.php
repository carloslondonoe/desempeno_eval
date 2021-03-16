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
Route::get('cargos_config', 'CargosController@index');
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
Route::get('solicitudes', 'SolicitudesTiquetesController@create')->name('solicitudes');
Route::post('solicitudes_save', 'SolicitudesTiquetesController@store')->name('solicitudes_save');
