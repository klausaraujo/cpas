<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    private $permisos = null;
    
    function __construct() {

      parent::__construct();
    
      $token = $this->session->userdata("token");
    
      (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY"),false):redirect("login");
    
      $this->session->set_userdata("idmodulo", 14);
    
      ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
    
      if(sha1($usuario)==$token->usuario){
    
          if (count($token->modulos)>0) {
    
              $listaModulos = $token->modulos;
    
              $permanecer = false;
    
              foreach ($listaModulos as $row) :
              if ($row->idmodulo == 14 and $row->estado == 1)
                  $permanecer = true;
                  endforeach
                  ;
    
                  if ($permanecer == false)
                      redirect('errores/accesoDenegado');
          } else {
              redirect("login");
          }

          if($this->permisos==null){ if($this->session->userdata("menu")) $this->permisos = $this->session->userdata("menu");}
    
      }else{
          redirect("login");
      }

    }

    public function index() {

        $nivel = 1;
        $idmenu = 16;

        validarPermisos($nivel,$idmenu,$this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("Clasificacion_model");
        $this->load->model("Articulo_model");
        $this->load->model("Inventario_model");

        $idClasificacion = $this->input->post("idClasificacion");
        
        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaClasificacion = $this->Clasificacion_model->obtenerLista();
        $resultTotal = $this->Articulo_model->obtenerTotalArticulosDashboard();
        $listaTipoHospital = $this->Inventario_model->obtenerListaTipoHospital();
        $resultClasificacionTotal = -1;
        if($idClasificacion > 0){
            $this->Articulo_model->setIdClasificacion($idClasificacion);
            $resultClasificacionTotal = $this->Articulo_model->obtenerTotalArticulosDashboard();    
            $resultClasificacionTotal = $resultClasificacionTotal->row()->total;    
        }

        $listaArticulos = $this->Articulo_model->obtenerArticulosDashboard();

        $resultTotal = $resultTotal->row();

        $data = array(
            "tipo" => $tipo->result(),
            "idClasificacion" => $idClasificacion,
            "totalClasificacion" => $resultClasificacionTotal,
            "total" => $resultTotal->total,
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "listaClasificacion" => $listaClasificacion->result(),
            "listaTipoHospital" => $listaTipoHospital->result(),
            "listaArticulos" => $listaArticulos->num_rows()? $listaArticulos->result() : array()
        );

        $this->load->view("inventario/principal", $data);
        
    }

    public function almacenes() {
        $this->load->model("Almacen_model");
        $this->load->model("Ubigeo_model");

        $listaAlmacenes = $this->Almacen_model->obtenerAlmacenes();
        $departamentos = $this->Ubigeo_model->departamentos();
        $data = array(
          "departamentos" => $departamentos->result(),
          "listaAlmacenes" => json_encode($listaAlmacenes->result())
        );

        $this->load->view("inventario/almacenes", $data);
    }

    public function obtenerAlmacenes(){
        $this->load->model("Almacen_model");

        $listaAlmacenes = $this->Almacen_model->obtenerAlmacenes();
        $detalle = array(
          "listaAlmacenes" => $listaAlmacenes->result()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtenerStock(){
        $this->load->model("Articulo_model");
        $idArticulo = $this->input->post("idArticulo");
        $this->Articulo_model->setId($idArticulo);
        $listaAlmacenes = $this->Articulo_model->obtenerStockPorArticulo();
        $detalle = array(
          "lista" => $listaAlmacenes->result()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function guardarAlmacen() {
        $this->load->model("Almacen_model");
        $idAlmacen = $this->input->post("id");
        $nombre = $this->input->post("nombre");
        $direccion = $this->input->post("direccion");
        $codigoUbigeo = $this->input->post("codigoUbigeo");
        $nombreUbigeo = $this->input->post("nombreUbigeo");
        $numeroDniTitular = $this->input->post("numeroDniTitular");
        $nombreTitular = $this->input->post("nombreTitular");
        $telefonoTitular = $this->input->post("telefonoTitular");
        $numeroDniSuplente = $this->input->post("numeroDniSuplente");
        $nombreSuplente = $this->input->post("nombreSuplente");
        $telefonoSuplente = $this->input->post("telefonoSuplente");
        $coordenadas = $this->input->post("ipressUbicacion");
        $estado = $this->input->post("estado");

        if ($estado) {
           $estado = 1;
        } else {
           $estado = 0;
        }
        
        $this->Almacen_model->setId($idAlmacen);
        $this->Almacen_model->setNombre($nombre);
        $this->Almacen_model->setDireccion($direccion);
        $this->Almacen_model->setUbigeo($codigoUbigeo);
        $this->Almacen_model->setNombreUbigeo($nombreUbigeo);
        $this->Almacen_model->setDniTitular($numeroDniTitular);
        $this->Almacen_model->setNombreTitular($nombreTitular);
        $this->Almacen_model->setTelefonoTitular($telefonoTitular);
        $this->Almacen_model->setDniSuplente($numeroDniSuplente);
        $this->Almacen_model->setNombreSuplente($nombreSuplente);
        $this->Almacen_model->setTelefonoSuplente($telefonoSuplente);
        $this->Almacen_model->setCoordenada($coordenadas);
        $this->Almacen_model->setEstado($estado);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idAlmacen > 0) {
            if ($this->Almacen_model->actualizarAlmacen()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->Almacen_model->guardarAlmacen()) {
                $status = 200;
                $message = "Historial registrado exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function marcas() {
        $this->load->model("Inventario_model");

        $listaMarcas = $this->Inventario_model->obtenerMarcas();
        $data = array(
          "listaMarcas" => json_encode($listaMarcas->result())
        );

        $this->load->view("inventario/marcas", $data);
    }

    public function obtenerMarcas(){
        $this->load->model("Inventario_model");

        $listaMarcas = $this->Inventario_model->obtenerMarcas();
        $detalle = array(
          "listaMarcas" => $listaMarcas->result()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function guardarMarca() {
        $this->load->model("Inventario_model");

        $nombre = $this->input->post("nombre");
        $fecha_registro = $this->input->post("fecha_registro");
        $id_marca = $this->input->post("id");
        $estado = $this->input->post("estado");
        if ($estado) {
            $estado = 1;
        } else {
            $estado = 0;
        }
        
        $this->Inventario_model->setDescripcion($nombre);
        $this->Inventario_model->setFechaRegistro($fecha_registro. ' ' .'00:00:00');
        // $this->Inventario_model->setFechaRegistro($fecha_registro);
        $this->Inventario_model->setEstado($estado);
        $this->Inventario_model->setIdMarca($id_marca);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($id_marca > 0) {
            if ($this->Inventario_model->actualizarMarca()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->Inventario_model->guardarMarca()) {
                $status = 200;
                $message = "Historial registrado exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }


    /** Inicio de Tipo Hospital */

    public function tipohospital() {
        $this->load->model("Inventario_model");

        $listatipoHospital = $this->Inventario_model->obtenerTipoHospital();
        $data = array(
          "listatipoHospital" => json_encode($listatipoHospital->result())
        );

        $this->load->view("inventario/tipohospital", $data);
    }

    public function obtenertipohospital(){
        $this->load->model("Inventario_model");

        $listatipoHospital = $this->Inventario_model->obtenerTipoHospital();
        $detalle = array(
          "listatipoHospital" => $listatipoHospital->result()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function guardartipohospital() {
        $this->load->model("Inventario_model");

        $nombre = $this->input->post("nombre");
        $fecha_registro = $this->input->post("fecha_registro");
        $fecha_baja = $this->input->post("fecha_baja");
        $id_tipohospital = $this->input->post("id");
        $estado = $this->input->post("estado");
        if ($estado) {
            $estado = 1;
        } else {
            $estado = 0;
        }
        
        $this->Inventario_model->setDescripcion($nombre);
        $this->Inventario_model->setFechaRegistro($fecha_registro. ' ' .'00:00:00');
        $this->Inventario_model->setEstado($estado);
        $this->Inventario_model->setid_tipohospital($id_tipohospital);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($id_tipohospital > 0) {
            if ($this->Inventario_model->actualizarTipoHospital()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->Inventario_model->guardarTipoHospital()) {
                $status = 200;
                $message = "Historial registrado exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    /** Fin Tipo de Hospital */

    public function articulos(){
        $this->load->model("Articulo_model");
        $this->load->model("Color_model");
        $this->load->model("Clasificacion_model");
        $this->load->model("Inventario_model");
        $this->load->model("Medida_model");

        $listaArticulos = $this->Articulo_model->obtenerArticulos();
        $listaMarcas = $this->Inventario_model->obtenerLista();
        $listaColor = $this->Color_model->obtenerLista();
        $listaClasificacion = $this->Clasificacion_model->obtenerLista();
        $listaMedida = $this->Medida_model->obtenerLista();

        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $data = array(
          "listaMarcas" => $listaMarcas->result(),
          "listaColor"  => $listaColor->result(),
          "listaClasificacion"  => $listaClasificacion->result(),
          "listaMedida"  => $listaMedida->result(),
          "listaArticulos" => json_encode($listaArticulos)
        );

        $this->load->view("inventario/articulos", $data);
    }

    public function mapa(){
        $this->load->model("Clasificacion_model");
        $this->load->model("Articulo_model");

        $listaClasificacion = $this->Clasificacion_model->obtenerLista();

        $data = array(
            "listaClasificacion" => $listaClasificacion->result(),
        );

        $this->load->view("inventario/mapa", $data);
    }

    public function obtenerMapa(){
        $this->load->model("Articulo_model");
        $this->Articulo_model->setIdRegion($this->input->post("idRegion"));

        $listaArticulos = $this->Articulo_model->obtenerUbicacion();
        $detalle = array(
            "lista" => $listaArticulos->num_rows()? $listaArticulos->result() : array()
        );
        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }
    
    public function articulosInventario(){
        $this->load->model("Articulo_model");
        $this->load->model("Color_model");
        $this->load->model("Clasificacion_model");
        $this->load->model("Inventario_model");
        $this->load->model("Medida_model");

        $listaArticulos = $this->Articulo_model->obtenerArticulosInventariado();
        $listaMarcas = $this->Inventario_model->obtenerLista();
        $listaColor = $this->Color_model->obtenerLista();
        $listaClasificacion = $this->Clasificacion_model->obtenerLista();
        $listaMedida = $this->Medida_model->obtenerLista();
        $listaTipoHospital = $this->Inventario_model->obtenerListaTipoHospital();

        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $data = array(
          "listaMarcas" => $listaMarcas->result(),
          "listaColor"  => $listaColor->result(),
          "listaClasificacion"  => $listaClasificacion->result(),
          "listaMedida"  => $listaMedida->result(),
          "listaTipoHospital" => $listaTipoHospital->result(),
          "listaArticulos" => json_encode($listaArticulos)
        );

        $this->load->view("inventario/articulosInventario", $data);
    }

    public function ingresos(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Articulo_model");
        $this->load->model("Ingreso_model");
        $this->load->model("Almacen_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaAlmacenes = $this->Almacen_model->obtenerAlmacenes();
        $listaTipoIngreso = $this->Ingreso_model->obtenerTipos();
        $listaIngresos = $this->Ingreso_model->obtenerLista();

        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $data = array(
          "listaAlmacenes" => $listaAlmacenes->num_rows()? $listaAlmacenes->result() : array(),
          "listaTipoIngreso" => $listaTipoIngreso->num_rows()? $listaTipoIngreso->result() : array(),
          "listaIngresos" => json_encode($listaIngresos->num_rows()? $listaIngresos->result() : array()),
          "listaAnioEjecucion" => $listaAnioEjecucion,
          "anio" => $anio
        );

        $this->load->view("inventario/ingresos", $data);
    }

    public function eventos() {

        $this->load->model("EventoRegistrar_model");
        
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $mes = $this->input->post("mes");
        
        $data = array();
        
        if (strlen($Anio_Ejecucion) > 0 and strlen($mes) > 0) {
            
            $this->EventoRegistrar_model->setAnio($Anio_Ejecucion);
            $this->EventoRegistrar_model->setMes($mes);
            
            $lista = $this->EventoRegistrar_model->listaEventosPorAnioYMes();
            
            if ($lista->num_rows() > 0) {
                $orden = 1;
                foreach ($lista->result() as $row) :
                
                switch ($row->Evento_Estado_Codigo) {
                    case 1:
                        $html = '<span class="label label-success">Monitoreo</span>';
                        break;
                    case 2:
                        $html = '<span class="label label-default">Cerrado</span>';
                        break;
                    case 3:
                        $html = '<span class="label label-danger">Anulado</span>';
                        break;
                }
                
                $data[] = array(
                    "evento" => $row->evento,
                    "fecha" => $row->fecha,
                    "ubigeo" => $row->Evento_Ubigeo,
                    "ubicacion" => $row->Evento_Ubigeo_Descripcion,
                    "estado" => $html,
                    "correlativo" => $row->ANIO." - ".addCeros5($row->Evento_Secuencia),
                    "orden" => $orden,
                    "seleccionar" => '<a href="'.base_url().'ofertamovil/fichas/lista/'.base64_encode($row->Evento_Registro_Numero).'">seleccionar</a>',
                    "id" => $row->Evento_Registro_Numero,
                    "tipo" => $row->tipoEvento,
                    "detalle" => $row->eventoDetalle,
                    "descripcion" => $row->Evento_Descripcion,
                    "coordenada" => $row->Evento_Coordenadas,
                    "tipoevento" => $row->tipoEventoCodigo,
                    "eventocodigo" => $row->eventoCodigo,
                    "eventodetalle" => $row->eventoDetalleCodigo
                );
                $orden++;
                endforeach ;
            }
        }
        
        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    public function obtenerRenipress()
    {
        $this->load->model("EntidadSalud_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $ubigeo = $departamento . $provincia . $distrito;
        
        $data = array();
        
        if (strlen($ubigeo) > 5) {
            
            $this->EntidadSalud_model->setCodigo_Ubigeo($ubigeo);
            
            $lista = $this->EntidadSalud_model->obtenerRenipress();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                $data[] = array(
                    "id_renipress" => $row->id_renipress,
                    "codigo_institucion" => $row->codigo_institucion,
                    "institucion" => $row->institucion,
                    "codigo_renipress" => $row->codigo_renipress,
                    "nombre" => $row->nombre,
                    "clasificacion" => $row->clasificacion,
                    "tipo" => $row->tipo,
                    "codigo_region" => $row->codigo_region,
                    "region" => $row->region,
                    "codigo_provincia" => $row->codigo_provincia,
                    "provincia" => $row->provincia,
                    "codigo_distrito" => $row->codigo_distrito,
                    "distrito" => $row->distrito,
                    "ubigeo" => $row->ubigeo,
                    "norte" => $row->norte,
                    "este" => $row->este
                );
                endforeach;
            }
        }
        
        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    public function obtenerRenipressId()
    {
        $this->load->model("EntidadSalud_model");
        
        $idRenipress = $this->input->post("idRenipress");
        
        $data = array();
        
        if ($idRenipress > 0) {
            
            $this->EntidadSalud_model->setIdRenipress($idRenipress);
            
            $lista = $this->EntidadSalud_model->obtenerRenipressId();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                $data[] = array(
                    "id_renipress" => $row->id_renipress,
                    "codigo_institucion" => $row->codigo_institucion,
                    "institucion" => $row->institucion,
                    "codigo_renipress" => $row->codigo_renipress,
                    "nombre" => $row->nombre,
                    "clasificacion" => $row->clasificacion,
                    "tipo" => $row->tipo,
                    "codigo_region" => $row->codigo_region,
                    "region" => $row->region,
                    "codigo_provincia" => $row->codigo_provincia,
                    "provincia" => $row->provincia,
                    "codigo_distrito" => $row->codigo_distrito,
                    "distrito" => $row->distrito,
                    "ubigeo" => $row->ubigeo
                );
                endforeach;
            }
        }
        
        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    public function salidas(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Articulo_model");
        $this->load->model("Ingreso_model");
        $this->load->model("Salida_model");
        $this->load->model("Almacen_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("Desplazamiento_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaAlmacenes = $this->Almacen_model->obtenerAlmacenes();
        $listaTipoIngreso = $this->Ingreso_model->obtenerTipos();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $listaDesplazamiento = $this->Desplazamiento_model->obtener();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaSalida = $this->Salida_model->obtenerLista();

        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $data = array(
          "listaAlmacenes" => $listaAlmacenes->num_rows()? $listaAlmacenes->result() : array(),
          "listaTipoIngreso" => $listaTipoIngreso->num_rows()? $listaTipoIngreso->result() : array(),
          "listaSalida" => json_encode($listaSalida->num_rows()? $listaSalida->result() : array()),
          "listaAnioEjecucion" => $listaAnioEjecucion,
          "listaDesplazamiento" => $listaDesplazamiento->result(),
          "anio" => $anio,
          "tipodocumento" => $tipodocumento,
          "departamentos" => $departamentos->result()
        );

        $this->load->view("inventario/salidas", $data);
    }


    public function componentes(){
        $this->load->model("Articulo_model");

        $listaArticulos = $this->Articulo_model->obtenerArticulosComponentes();

        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $data = array(
          "lista" => json_encode($listaArticulos)
        );

        $this->load->view("inventario/componentes", $data);
    }

    public function inventario(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Inventario_model");
        $this->load->model("Clasificacion_model");
        $this->load->model("Almacen_model");
        $this->load->model("Articulo_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaMarcas = $this->Inventario_model->obtenerLista();
        $listaClasificacion = $this->Clasificacion_model->obtenerLista();
        $listaAlmacenes = $this->Almacen_model->obtenerAlmacenes();
        $lista = $this->Articulo_model->obtenerReporteGeneral();
        $listaTipoHospital = $this->Inventario_model->obtenerListaTipoHospital();

        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $data = array(
          "lista" =>json_encode($lista->num_rows()? $lista->result() : array()),
          "listaMarcas" => $listaMarcas->num_rows()? $listaMarcas->result() : array(),
          "listaClasificacion" => $listaClasificacion->num_rows()? $listaClasificacion->result() : array(),
          "listaAlmacenes" => $listaAlmacenes->num_rows()? $listaAlmacenes->result() : array(),
          "listaAnioEjecucion" => $listaAnioEjecucion,
          "listaTipoHospital" => $listaTipoHospital->result(),
          "anio" => $anio
        );

        $this->load->view("inventario/inventario", $data);
    }
    public function disponibles(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Inventario_model");
        $this->load->model("Clasificacion_model");
        $this->load->model("Almacen_model");
        $this->load->model("Articulo_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaMarcas = $this->Inventario_model->obtenerLista();
        $listaClasificacion = $this->Clasificacion_model->obtenerLista();
        $listaAlmacenes = $this->Almacen_model->obtenerAlmacenes();
        $lista = $this->Articulo_model->obtenerReporteDisponibles();

        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $data = array(
          "lista" =>json_encode($lista->num_rows()? $lista->result() : array()),
          "listaMarcas" => $listaMarcas->num_rows()? $listaMarcas->result() : array(),
          "listaClasificacion" => $listaClasificacion->num_rows()? $listaClasificacion->result() : array(),
          "listaAlmacenes" => $listaAlmacenes->num_rows()? $listaAlmacenes->result() : array(),
          "listaAnioEjecucion" => $listaAnioEjecucion,
          "anio" => $anio
        );

        $this->load->view("inventario/disponibles", $data);
    }
    public function asignados(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Inventario_model");
        $this->load->model("Clasificacion_model");
        $this->load->model("Almacen_model");
        $this->load->model("Articulo_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaMarcas = $this->Inventario_model->obtenerLista();
        $listaClasificacion = $this->Clasificacion_model->obtenerLista();
        $listaAlmacenes = $this->Almacen_model->obtenerAlmacenes();
        $lista = $this->Articulo_model->obtenerReporteAsignados();

        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $data = array(
          "lista" =>json_encode($lista->num_rows()? $lista->result() : array()),
          "listaMarcas" => $listaMarcas->num_rows()? $listaMarcas->result() : array(),
          "listaClasificacion" => $listaClasificacion->num_rows()? $listaClasificacion->result() : array(),
          "listaAlmacenes" => $listaAlmacenes->num_rows()? $listaAlmacenes->result() : array(),
          "listaAnioEjecucion" => $listaAnioEjecucion,
          "anio" => $anio
        );

        $this->load->view("inventario/asignados", $data);
    }

    public function modelos() {
        $this->load->model("Inventario_model");

        $listaModelos = $this->Inventario_model->obtenerModelos();
        $listaComboMarca = $this->Inventario_model->obtenerLista();
        $data = array(
          "listaModelos" => json_encode($listaModelos->result()),
          "listaComboMarca" => $listaComboMarca->result(),
        );

        $this->load->view("inventario/modelos", $data);
    }
    
    public function obtenerModelos(){
        $this->load->model("Inventario_model");

        $listaModelos = $this->Inventario_model->obtenerModelos();
        $detalle = array(
          "listaModelos" => $listaModelos->result()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function guardarModelo() {
        $this->load->model("Inventario_model");

        $nombre = $this->input->post("nombre");
        $fecha_registro = $this->input->post("fecha_registro");
        $id_marca = $this->input->post("marca");
        $estado = $this->input->post("estado");
        $idmodelo = $this->input->post("idmodelo");
        if ($estado) {
            $estado = 1;
        } else {
            $estado = 0;
        }
        
        $this->Inventario_model->setDescripcion($nombre);
        $this->Inventario_model->setFechaRegistro($fecha_registro. ' ' .'00:00:00');
        // $this->Inventario_model->setFechaRegistro($fecha_registro);
        $this->Inventario_model->setEstado($estado);
        $this->Inventario_model->setIdMarca($id_marca);
        $this->Inventario_model->setIdModelo($idmodelo);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idmodelo > 0) {
            if ($this->Inventario_model->actualizarModelo()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->Inventario_model->guardarModelo()) {
                $status = 200;
                $message = "Historial registrado exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function obtenerListaInventarioModal(){
        $this->load->model("Articulo_model");

        $listaArticulosInv = $this->Articulo_model->obtenerArticulosInventariado();
       
        if ($listaArticulosInv->num_rows() > 0) {
            $listaArticulosInv = $listaArticulosInv->result();
        } else {
            $listaArticulosInv = array();
        }

        $data = array(
            "status" => 200,
            "data" => $listaArticulosInv
        );

        echo json_encode($data);
    }

    public function filesinventario()
    {
        $this->load->model("AlmacenRegistroFile_model");
        $this->load->model("AlertaPronostico_model");
                
        $idingreso = $this->input->post("idingreso");
        $this->AlmacenRegistroFile_model->setIdingreso($idingreso);
        $this->AlmacenRegistroFile_model->setId($idingreso);
        $lista = $this->AlmacenRegistroFile_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "idingreso" => $idingreso,
            "lista" => $lista,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("inventario/fileseventos_alm", $data);
    }

    public function agregarFile()
    {
        $this->load->model("AlmacenRegistroFile_model");
        $idingreso = $this->input->post("idingreso");
        $path = getenv('PATH_FILES_INVENTARIOS');
        $estado = 0;
        
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            
            if ($_FILES["file"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                
                $data = $_FILES["file"]['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $file = $name . '.' . $ext;
                copy($_FILES["file"]["tmp_name"], $path . $file);
                $this->AlmacenRegistroFile_model->setIdingreso($idingreso);
                $this->AlmacenRegistroFile_model->setFile($file);
                $this->AlmacenRegistroFile_model->registrar();
                
                $this->load->model("EventoRegistrar_model");
                $this->AlmacenRegistroFile_model->setIdingreso($idingreso);
                $this->AlmacenRegistroFile_model->actualizarFecha();
                
                $estado = 200;
                $message = EXITO_ARCHIVO;
            } else {
                $estado = - 3;
                $message = ERROR_ARCHIVO_FORMATO;
            }
        }
        $response = array(
            "status" => $estado,
            "message" => $message
        );
        echo json_encode($response);
    }

    public function editarFile()
    {
        $this->load->model("EventoRegistroFile_model");
        $id = $this->input->post("Evento_Registro_File_Numero");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $files = $this->input->post("files");
        $descripcion = $this->input->post("descripcion");
        $path = getenv('PATH_FILES_INVENTARIOS');
        $estado = 0;
        
        if (file_exists($path . $files))
            unlink($path . $files); 
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            
            if ($_FILES["file"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                $data = $_FILES["file"]['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $file = $name . '.' . $ext;
                
                copy($_FILES["file"]["tmp_name"], $path . $file);
                $this->EventoRegistroFile_model->setId($id);
                $this->EventoRegistroFile_model->setFile($name . '.' . $ext);
                $this->EventoRegistroFile_model->setDescripcion($descripcion);
                $this->EventoRegistroFile_model->editar();
                
                $this->load->model("EventoRegistrar_model");
                $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
                $this->EventoRegistrar_model->actualizarFecha();
                $estado = 200;
                $message = EXITO_ARCHIVO;
            } else {
                $estado = - 3;
                $message = ERROR_ARCHIVO_FORMATO;
            }
        }
        $response = array(
            "status" => $estado,
            "message" => $message
        );
        echo json_encode($response);
    }

    public function eliminarFile()
    {
        $this->load->model("AlmacenRegistroFile_model");
        //$idingreso = $this->input->post("idingreso");
        $idingreso = $this->input->post("idingreso");
        $files = $this->input->post("files");
        $path = getenv('PATH_FILES_INVENTARIOS');
        if (file_exists($path . $files))
            unlink($path . $files);        
        $this->AlmacenRegistroFile_model->setIdingreso($idingreso);
        $this->AlmacenRegistroFile_model->eliminar();
        
        $this->load->model("AlmacenRegistroFile_model");
        $this->AlmacenRegistroFile_model->setId($idingreso);
        $this->AlmacenRegistroFile_model->actualizarFecha();
        
        echo json_encode(array(
            "status" => 1
        ));
    }

    public function editarFileDescripcion()
    {
        $this->load->model("EventoRegistroFile_model");
        $id = $this->input->post("Evento_Registro_File_Numero");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $descripcion = $this->input->post("descripcion");
        
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $this->EventoRegistrar_model->actualizarFecha();
        
        $this->EventoRegistroFile_model->setId($id);
        $this->EventoRegistroFile_model->setDescripcion($descripcion);
        $this->EventoRegistroFile_model->descripcion();
        echo json_encode(array(
            "status" => 1
        ));
    }

    
    public function insumos(){
        $this->load->model("Articulo_model");

        $listaArticulos = $this->Articulo_model->obtenerArticulosComponentes();

        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $data = array(
          "lista" => json_encode($listaArticulos)
        );

        $this->load->view("inventario/insumos", $data);
    }

	
}
