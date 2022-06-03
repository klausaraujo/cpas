<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';

$route['/'] = 'login/index';
$route['login'] = 'login/login';
$route['doLogin'] = 'login/doLogin';
$route['logout'] = 'login/logout';

/*         CANILLITAS     */
$route['canillitas'] = 'canillitas/main';


$route['eventos/nuevo'] = 'eventos/eventos/index';
$route['eventos/dashboard'] = 'eventos/eventos/dashboard';
$route['eventos/danios'] = 'eventos/eventos/danios';
$route['eventos/registraravisos'] = 'eventos/eventos/alertasPronosticosRegistrar';
$route['eventos/listaalertas'] = 'eventos/eventos/alertasPronosticos';
$route['eventos/listaalert'] = 'eventos/eventos/listaalert';
$route['eventos/listarejecutoras'] = 'eventos/eventos/listarejecutoras';
$route['eventos/regiones'] = 'eventos/eventos/listarregiones';
$route['eventos/eliminarAccionAviso'] = 'eventos/eventos/eliminarAccionAviso';
$route['eventos/eliminarRecomendacionAviso'] = 'eventos/eventos/eliminarRecomendacionAviso';

$route["eventos/reportes"] = 'eventos/reportes/index';
$route["eventos/grandes-eventos"] = 'eventos/eventos/grandesEventos';
$route["eventos/alertasPronosticos"] = 'eventos/eventos/alertasPronosticos';

/*         BRIGADISTAS         */
$route['brigadistas'] = 'brigadistas/main';
$route['brigadistas/curl'] = 'brigadistas/main/curl';
$route['brigadistas/nuevo'] = 'brigadistas/main/nuevo';
$route['brigadistas/edicion'] = 'brigadistas/main/edicion';
$route['brigadistas/registrar'] = 'brigadistas/main/registrar';
$route['brigadistas/editar'] = 'brigadistas/main/editar';
$route['brigadistas/foto'] = 'brigadistas/main/foto';
$route['brigadistas/registrarEspecialidad'] = 'brigadistas/main/registrarEspecialidad';
$route['brigadistas/listaEspecialidades'] = 'brigadistas/main/listaEspecialidades';
$route['brigadistas/eliminarEspecialidad'] = 'brigadistas/main/eliminarEspecialidad';
$route['brigadistas/registrarCertificacion'] = 'brigadistas/main/registrarCertificacion';
$route['brigadistas/listaCertificacion'] = 'brigadistas/main/listaCertificacion';
$route['brigadistas/eliminarCertificacion'] = 'brigadistas/main/eliminarCertificacion';
$route['brigadistas/registrarCapacitacion'] = 'brigadistas/main/registrarCapacitacion';
$route['brigadistas/listaCapacitacion'] = 'brigadistas/main/listaCapacitacion';
$route['brigadistas/eliminarCapacitacion'] = 'brigadistas/main/eliminarCapacitacion';
$route['brigadistas/eventosAjax'] = 'brigadistas/main/eventosAjax';
$route['brigadistas/registrarEmergencia'] = 'brigadistas/main/registrarEmergencia';
$route['brigadistas/listaEmergencias'] = 'brigadistas/main/listaEmergencias';
$route['brigadistas/eliminarEmergencia'] = 'brigadistas/main/eliminarEmergencia';
$route['brigadistas/registrarContingencia'] = 'brigadistas/main/registrarContingencia';
$route['brigadistas/listaContingencias'] = 'brigadistas/main/listaContingencias';
$route['brigadistas/eliminarContingencia'] = 'brigadistas/main/eliminarContingencia';
$route['brigadistas/registrarTrabajo'] = 'brigadistas/main/registrarTrabajo';
$route['brigadistas/listaTrabajos'] = 'brigadistas/main/listaTrabajos';
$route['brigadistas/eliminarTrabajo'] = 'brigadistas/main/eliminarTrabajo';
$route['brigadistas/profesiones'] = 'brigadistas/main/profesiones';
$route['brigadistas/ficha/(:any)'] = 'brigadistas/main/ficha';
$route['brigadistas/fotocheck/(:any)'] = 'brigadistas/main/fotocheck';
$route['brigadistas/cargarProvincias'] = 'brigadistas/main/cargarProvincias';
$route['brigadistas/cargarDistritos'] = 'brigadistas/main/cargarDistritos';
$route['brigadistas/entidadesSaludAjax'] = 'brigadistas/main/entidadesSaludAjax';
$route['brigadistas/listaFotocheck'] = 'brigadistas/main/listaFotocheck';
$route['brigadistas/profesionesBrigadistaAjax'] = 'brigadistas/main/profesionesBrigadistaAjax';
$route['brigadistas/especialidadesProfesionesBrigadistaAjax'] = 'brigadistas/main/especialidadesProfesionesBrigadistaAjax';
$route['brigadistas/registrarFotocheck'] = 'brigadistas/main/registrarFotocheck';
$route['brigadistas/eliminarFotocheck'] = 'brigadistas/main/eliminarFotocheck';

/*     RUTAS DE   BRIGADISTAS         */
$route['brigadistas/formAdditional'] = 'brigadistas/main/formAdditional';
$route['brigadistas/registrarIdioma'] = 'brigadistas/main/registrarIdioma';
$route['brigadistas/registrarCarrera'] = 'brigadistas/main/registrarCarrera';
$route['brigadistas/registrarCertificado'] = 'brigadistas/main/registrarCertificado';
$route['brigadistas/registrarLaboral'] = 'brigadistas/main/registrarLaboral';
$route['brigadistas/registrarInmunizacionPersonal'] = 'brigadistas/main/registrarInmunizacionPersonal';
$route['brigadistas/registrarAlergiaPersonal'] = 'brigadistas/main/registrarAlergiaPersonal';
$route['brigadistas/registrarAlergiaCampoPersonal'] = 'brigadistas/main/registrarAlergiaCampoPersonal';
$route['brigadistas/registrarCapacitacionPersonal'] = 'brigadistas/main/registrarCapacitacionPersonal';
$route['brigadistas/form-new'] = 'brigadistas/main/formNew';
$route['brigadistas/formEdit'] = 'brigadistas/main/formEdit';
$route['brigadistas/comisiones'] = 'brigadistas/main/maincomisiones';
$route['brigadistas/anucomisiones'] = 'brigadistas/main/anucomisiones';

/*         FRIAJE         */
$route['friaje'] = 'friaje/main';
$route['friaje/registrar'] = 'friaje/main/registrar';
$route['friaje/editar'] = 'friaje/main/editar';
$route['friaje/indicadoresAjax'] = 'friaje/main/indicadoresAjax';

/*         HOSPITALES         */
$route['hospitales'] = 'hospitales/main';
$route['hospitales/plantilla'] = 'hospitales/main/plantilla';
$route['hospitales/form-lima'] = 'hospitales/main/formLima';
$route['hospitales/editarficha'] = 'hospitales/main/editarFicha';

$route['hospitales/nuevo'] = 'hospitales/main/nuevo';
$route['hospitales/gestionar'] = 'hospitales/main/gestionar';
$route['hospitales/edicion'] = 'hospitales/main/edicion';
$route['hospitales/eliminar'] = 'hospitales/main/eliminar';
$route['hospitales/reporte'] = 'hospitales/main/reporte';

/*         METAS         */
$route['metas'] = 'metas/main';
//MAPAs
$route['metas/mapa1'] = 'metas/main/mapa1';
$route['metas/mapa2'] = 'metas/main/mapa2';
$route['metas/mapa3'] = 'metas/main/mapa3';

/*         TABLAS         */
$route['tablas'] = 'tablas/main';
$route['tablas/main/evento-gestionar'] = 'tablas/main/eventoGestionar';
$route['tablas/main/evento-eliminar'] = 'tablas/main/eventoEliminar';
$route['tablas/main/evento-detalle'] = 'tablas/main/eventoDetalle';
$route['tablas/main/evento-detalle-gestionar'] = 'tablas/main/eventoDetalleGestionar';
$route['tablas/main/evento-detalle-eliminar'] = 'tablas/main/eventoDetalleEliminar';
$route['tablas/main/evento-fuente'] = 'tablas/main/eventoFuente';
$route['tablas/main/evento-fuente-gestionar'] = 'tablas/main/eventoFuenteGestionar';
$route['tablas/main/evento-fuente-eliminar'] = 'tablas/main/eventoFuenteEliminar';
$route['tablas/main/tipo-accion'] = 'tablas/main/tipoAccion';
$route['tablas/main/tipo-accion-gestionar'] = 'tablas/main/tipoAccionGestionar';
$route['tablas/main/tipo-accion-eliminar'] = 'tablas/main/tipoAccionEliminar';
$route['tablas/main/tipo-accion-entidad'] = 'tablas/main/tipoAccionEntidad';
$route['tablas/main/tipo-accion-entidad-gestionar'] = 'tablas/main/tipoAccionEntidadGestionar';
$route['tablas/main/tipo-accion-entidad-eliminar'] = 'tablas/main/tipoAccionEntidadEliminar';
$route['tablas/main/perfiles'] = 'tablas/main/perfiles';
$route['tablas/main/perfiles-gestionar'] = 'tablas/main/perfilesGestionar';
$route['tablas/main/perfiles-eliminar'] = 'tablas/main/perfilesEliminar';
$route['tablas/main/perfilesModulo'] = 'tablas/main/perfilModulos';
$route['tablas/main/perfiles-modulo-gestionar'] = 'tablas/main/perfilModulosGestionar';
$route['tablas/main/perfiles-modulo-eliminar'] = 'tablas/main/perfilModulosEliminar';

/*         TABLERO         */
$route['tablero'] = 'tablero/main';
$route['tablero'] = 'tablero/main';
$route['tablero/gestionar'] = 'tablero/tableroControl/gestionar';
$route['tablero/registrar'] = 'tablero/tableroControl/registrar';
$route['tablero/actualizar'] = 'tablero/tableroControl/actualizar';
$route['tablero/eliminar'] = 'tablero/tableroControl/eliminar';
$route['tablero/desactivar'] = 'tablero/tableroControl/desactivar';
$route['tablero/activar'] = 'tablero/tableroControl/activar';

$route['tablero/indicador'] = 'tablero/indicador/index';
$route['tablero/tarea'] = 'tablero/tarea/index';

$route['tablero/reportes/indicadores'] = 'tablero/reportesbasicos/indicadores';
$route['tablero/reportes/procesos'] = 'tablero/reportesbasicos/procesos';
$route['tablero/reportes/poivstablero'] = 'tablero/reportesbasicos/poivstablero';

$route['tablero/proceso'] = 'tablero/proceso/index';
$route['tablero/procesoIndicador/v2/enlaceReporte'] = 'tablero/procesoIndicador/enlaceReporteEjecucion';

//AJAX
$route['tablero/listarCombos'] = 'tablero/tableroControl/listarCombos';

/*         EMERGENCIAS         */
$route['emergencias'] = 'emergencias/main';
$route['emergencias/registrar'] = 'emergencias/main/registrar';
$route['emergencias/cerrar'] = 'emergencias/main/cerrar';
$route['emergencias/registrarAjax'] = 'emergencias/paciente/registrarAjax';
$route['emergencias/curl'] = 'emergencias/paciente/curl';

/*         USUARIOS         */
$route['usuarios'] = 'usuarios/main';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*          OFERTA MOVIL            */
$route['ofertamovil'] = 'ofertamovil/main/index';

/*          MAPAS            */
$route['mapas'] = 'mapas/main';

/*         CONTINGENCIA         */
$route['contingencia'] = 'contingencia/main';
//$route['contingencia/reportecontingencia'] = 'contingencia/reporte';
$route['contingencia/registrar'] = 'contingencia/main/registrar';
$route['contingencia/actualizar'] = 'contingencia/main/actualizar';
$route['contingencia/registrarcuestionario'] = 'contingencia/main/registrarcuestionario';
//$route['friaje/indicadoresAjax'] = 'friaje/main/indicadoresAjax';

/**         INVENTARIO       */
$route['inventario'] = 'inventario/main';
$route['inventario/almacenes'] = 'inventario/main/almacenes';
$route['inventario/marcas'] = 'inventario/main/marcas';
$route['inventario/articulos'] = 'inventario/main/articulos';
$route['inventario/articulosInventario'] = 'inventario/main/articulosInventario';
$route['inventario/ingresos'] = 'inventario/main/ingresos';
$route['inventario/salidas'] = 'inventario/main/salidas';
$route['inventario/inventario'] = 'inventario/main/inventario';
$route['inventario/disponibles'] = 'inventario/main/disponibles';
$route['inventario/asignados'] = 'inventario/main/asignados';
$route['inventario/mapa'] = 'inventario/main/mapa';
$route['inventario/componentes'] = 'inventario/main/componentes';
$route['inventario/tipohospital'] = 'inventario/main/tipohospital';
$route['inventario/modelos'] = 'inventario/main/modelos';
$route['inventario/files'] = 'inventario/main/files';
$route['inventario/insumos'] = 'inventario/main/insumos';

/**         FARMACIA       */
$route['farmacia'] = 'farmacia/main';
$route['farmacia/almacenes'] = 'farmacia/main/almacenes';
$route['farmacia/articulos'] = 'farmacia/main/articulos';
$route['farmacia/ingresos'] = 'farmacia/main/ingresos';
$route['farmacia/salidas'] = 'farmacia/main/salidas';
$route['farmacia/inventario'] = 'farmacia/main/inventario';
$route['farmacia/disponibles'] = 'farmacia/main/disponibles';

/**         ENFERMEDAD */
$route['coronavirus'] = 'enfermedad/main';
$route['coronavirus/reporte'] = 'enfermedad/main/reporte';

/**         INDICADORES PPR */
$route['indicadoresppr'] = 'indicadoresppr/main';
$route['indicadoresppr/anuindicadores'] = 'indicadoresppr/main/anuindicadores';

/**         TRAMITE DCUMENTARIO         **/
$route['tramite'] = 'tramite/main';
$route['tramite'] = 'tramite/main';

/**         ALERTAS PRONOSTICOS         **/
$route["alertasPronosticos"] = 'alertas/main';
