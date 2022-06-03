<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    private $permisos = null;
    
    function __construct() {

      parent::__construct();
    
      $token = $this->session->userdata("token");
    
      (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY"),false):redirect("login");
    
      $this->session->set_userdata("idmodulo", 19);
    
      ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
    
      if(sha1($usuario)==$token->usuario){
    
          if (count($token->modulos)>0) {
    
              $listaModulos = $token->modulos;
    
              $permanecer = false;
    
              foreach ($listaModulos as $row) :
              if ($row->idmodulo == 19 and $row->estado == 1)
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
         $idmenu = 24;

         validarPermisos($nivel,$idmenu,$this->permisos);

        $this->load->model("FarmaciaCategoria_model");
        $this->load->model("FarmaciaArticulo_model");

        $idCategoria = $this->input->post("idCategoria");
        
        $listaCategoria = $this->FarmaciaCategoria_model->obtenerLista();
        $resultTotal = $this->FarmaciaArticulo_model->obtenerTotalArticulosDashboard();
        $resultCategoriaTotal = -1;
        if($idCategoria > 0){
            $this->FarmaciaArticulo_model->setIdCategoria($idCategoria);
            $resultCategoriaTotal = $this->FarmaciaArticulo_model->obtenerTotalArticulosDashboard();    
            $resultCategoriaTotal = $resultCategoriaTotal->row()->total;    
        }

        $listaArticulos = $this->FarmaciaArticulo_model->obtenerArticulosDashboard();

        $resultTotal = $resultTotal->row();

        $data = array(
            "idCategoria" => $idCategoria,
            "totalCategoria" => $resultCategoriaTotal,
            "total" => $resultTotal->total,
            "listaCategoria" => $listaCategoria->result(),
            "listaArticulos" => $listaArticulos->num_rows()? $listaArticulos->result() : array()
        );

        $this->load->view("farmacia/principal", $data);
        
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

    public function obtenerStock(){
        $this->load->model("FarmaciaArticulo_model");
        $idArticulo = $this->input->post("idArticulo");
        $this->FarmaciaArticulo_model->setId($idArticulo);
        $listaAlmacenes = $this->FarmaciaArticulo_model->obtenerStockPorArticulo();
        $detalle = array(
          "lista" => $listaAlmacenes->result()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function almacenes() {
        $this->load->model("FarmaciaAlmacen_model");
        $this->load->model("Ubigeo_model");

        $listaAlmacenes = $this->FarmaciaAlmacen_model->obtenerAlmacenes();
        $departamentos = $this->Ubigeo_model->departamentos();
        $data = array(
          "departamentos" => $departamentos->result(),
          "listaAlmacenes" => json_encode($listaAlmacenes->result())
        );

        $this->load->view("farmacia/almacenes", $data);
    }

    public function obtenerAlmacenes(){
        $this->load->model("FarmaciaAlmacen_model");

        $listaAlmacenes = $this->FarmaciaAlmacen_model->obtenerAlmacenes();
        $detalle = array(
          "listaAlmacenes" => $listaAlmacenes->result()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function guardarAlmacen() {
        $this->load->model("FarmaciaAlmacen_model");
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
        $telefonoSuplente = $this->input->post("telefonoSuplente");
        $coordenadas = $this->input->post("ipressUbicacion");
        $estado = $this->input->post("estado");

        if ($estado) {
           $estado = 1;
        } else {
           $estado = 0;
        }
        
        $this->FarmaciaAlmacen_model->setId($idAlmacen);
        $this->FarmaciaAlmacen_model->setNombre($nombre);
        $this->FarmaciaAlmacen_model->setDireccion($direccion);
        $this->FarmaciaAlmacen_model->setUbigeo($codigoUbigeo);
        $this->FarmaciaAlmacen_model->setNombreUbigeo($nombreUbigeo);
        $this->FarmaciaAlmacen_model->setDniTitular($numeroDniTitular);
        $this->FarmaciaAlmacen_model->setNombreTitular($nombreTitular);
        $this->FarmaciaAlmacen_model->setTelefonoTitular($telefonoTitular);
        $this->FarmaciaAlmacen_model->setDniSuplente($numeroDniSuplente);
        $this->FarmaciaAlmacen_model->setNombreSuplente($nombreSuplente);
        $this->FarmaciaAlmacen_model->setTelefonoSuplente($telefonoSuplente);
        $this->FarmaciaAlmacen_model->setCoordenada($coordenadas);
        $this->FarmaciaAlmacen_model->setEstado($estado);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idAlmacen > 0) {
            if ($this->FarmaciaAlmacen_model->actualizarAlmacen()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->FarmaciaAlmacen_model->guardarAlmacen()) {
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

    public function obtenerPresentacion(){
        $this->load->model("FarmaciaPresentacion_model");
        $administracion = $this->input->post("administracion");
        $this->FarmaciaPresentacion_model->setId($administracion);

        $lista = $this->FarmaciaPresentacion_model->obtenerLista();
        $detalle = array(
          "lista" => $lista->result()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function articulos(){
        $this->load->model("FarmaciaArticulo_model");
        $this->load->model("FarmaciaCategoria_model");
        $this->load->model("FarmaciaViaAdministracion_model");
        $this->load->model("FarmaciaMedida_model");

        $listaArticulos = $this->FarmaciaArticulo_model->obtenerArticulos();
        $listaCategoria = $this->FarmaciaCategoria_model->obtenerLista();
        $listaViaAdministracion = $this->FarmaciaViaAdministracion_model->obtenerLista();
        $listaMedida = $this->FarmaciaMedida_model->obtenerLista();

        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $data = array(
          "listaCategoria" => $listaCategoria->result(),
          "listaViaAdministracion"=> $listaViaAdministracion->result(),
          "listaMedida"  => $listaMedida->result(),
          "listaArticulos" => json_encode($listaArticulos)
        );

        $this->load->view("farmacia/articulos", $data);
    }

    public function ingresos(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("FarmaciaIngreso_model");
        $this->load->model("FarmaciaAlmacen_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaAlmacenes = $this->FarmaciaAlmacen_model->obtenerAlmacenes();
        $listaTipoIngreso = $this->FarmaciaIngreso_model->obtenerTipos();
        $listaIngresos = $this->FarmaciaIngreso_model->obtenerLista();

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

        $this->load->view("farmacia/ingresos", $data);
    }
    
    public function salidas(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("FarmaciaIngreso_model");
        $this->load->model("FarmaciaSalida_model");
        $this->load->model("FarmaciaAlmacen_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("FarmaciaDesplazamiento_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaAlmacenes = $this->FarmaciaAlmacen_model->obtenerAlmacenes();
        $listaTipoIngreso = $this->FarmaciaIngreso_model->obtenerTipos();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $listaDesplazamiento = $this->FarmaciaDesplazamiento_model->obtener();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaSalida = $this->FarmaciaSalida_model->obtenerLista();

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

        $this->load->view("farmacia/salidas", $data);
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

    public function inventario(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("FarmaciaArticulo_model");
        $this->load->model("FarmaciaViaAdministracion_model");
        $this->load->model("FarmaciaCategoria_model");
        $this->load->model("FarmaciaAlmacen_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaCategoria = $this->FarmaciaCategoria_model->obtenerLista();
        $listaViaAdministracion = $this->FarmaciaViaAdministracion_model->obtenerLista();
        $lista = $this->FarmaciaArticulo_model->obtenerReporteGeneral();
        $listaAlmacenes = $this->FarmaciaAlmacen_model->obtenerAlmacenes();

        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $data = array(
          "listaAlmacenes" => $listaAlmacenes->num_rows()? $listaAlmacenes->result() : array(),
          "lista" =>json_encode($lista->num_rows()? $lista->result() : array()),
          "listaCategoria" => $listaCategoria->result(),
          "listaViaAdministracion"=> $listaViaAdministracion->result(),
          "listaAnioEjecucion" => $listaAnioEjecucion,
          "anio" => $anio
        );

        $this->load->view("farmacia/inventario", $data);
    }

    public function disponibles(){
        $this->load->model("AnioEjecucion_model");
        $this->load->model("FarmaciaArticulo_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $lista = $this->FarmaciaArticulo_model->obtenerDisponibilidad();

        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $data = array(
          "lista" =>json_encode($lista->num_rows()? $lista->result() : array()),
          "listaAnioEjecucion" => $listaAnioEjecucion,
          "anio" => $anio
        );

        $this->load->view("farmacia/disponibles", $data);
    }
}
