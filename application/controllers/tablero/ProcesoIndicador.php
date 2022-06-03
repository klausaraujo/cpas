<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProcesoIndicador extends CI_Controller
{

  private $permisos = null;

    function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");

        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");

        $this->session->set_userdata("idmodulo", 3);

        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");

        if(sha1($usuario)==$token->usuario){

            if (count($token->modulos)>0) {

                $listaModulos = $token->modulos;

                $permanecer = false;

                foreach ($listaModulos as $row) :
                if ($row->idmodulo == 3 and $row->estado == 1)
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


    function index(){

      $nivel = 2;
      $idmenu = 12;

      validarPermisos($nivel,$idmenu,$this->permisos);

      $this->load->model("AnioEjecucion_model");
      $this->load->model("ProcesoIndicador_model");

      $anio = $this->input->post("Anio");
      $listaAnioEjecucion = $this->AnioEjecucion_model->lista();

      if(empty($anio) or strlen($anio)<1) {
        $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
        $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
      }

      $this->ProcesoIndicador_model->setAnio_Ejecucion($anio);
      $lista = $this->ProcesoIndicador_model->lista();

      $data = array(
        "lista" => $lista,
        "listaAnioEjecucion" => $listaAnioEjecucion,
        "anio" => $anio
      );
      $this->load->view("tablero/procesoIndicador",$data);

    }

    function registrar(){

       $this->load->model("ProcesoIndicador_model");

       $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
       $Codigo_Proceso = $this->input->post("Codigo_Proceso");
       $Codigo_Indicador = $this->input->post("Codigo_Indicador");
       $Enero = $this->input->post("enero");
       $Febrero = $this->input->post("febrero");
       $Marzo = $this->input->post("marzo");
       $Abril = $this->input->post("abril");
       $Mayo = $this->input->post("mayo");
       $Junio = $this->input->post("junio");
       $Julio = $this->input->post("julio");
       $Agosto = $this->input->post("agosto");
       $Septiembre = $this->input->post("septiembre");
       $Octubre = $this->input->post("octubre");
       $Noviembre = $this->input->post("noviembre");
       $Diciembre = $this->input->post("diciembre");

       $total = $Enero+$Febrero+$Marzo+$Abril+$Mayo+$Junio+$Julio+$Agosto+$Septiembre+$Octubre+$Noviembre+$Diciembre;

        $this->ProcesoIndicador_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->ProcesoIndicador_model->setCodigo_Indicador($Codigo_Indicador);
        $this->ProcesoIndicador_model->setCodigo_Proceso($Codigo_Proceso);
        $this->ProcesoIndicador_model->setEnero($Enero);
        $this->ProcesoIndicador_model->setFebrero($Febrero);
        $this->ProcesoIndicador_model->setMarzo($Marzo);
        $this->ProcesoIndicador_model->setAbril($Abril);
        $this->ProcesoIndicador_model->setMayo($Mayo);
        $this->ProcesoIndicador_model->setJunio($Junio);
        $this->ProcesoIndicador_model->setJulio($Julio);
        $this->ProcesoIndicador_model->setAgosto($Agosto);
        $this->ProcesoIndicador_model->setSeptiembre($Septiembre);
        $this->ProcesoIndicador_model->setOctubre($Octubre);
        $this->ProcesoIndicador_model->setNoviembre($Noviembre);
        $this->ProcesoIndicador_model->setDiciembre($Diciembre);

        $existe = $this->ProcesoIndicador_model->existe();

        if ($existe->num_rows() > 0) {

            $this->session->set_flashdata('mensajeError', 'Ya existe un proceso con ese proceso');
        }
        else if($total<0){
            $this->session->set_flashdata('mensajeError', 'Ingrese montos validos');
        }
        else {
          if($this->ProcesoIndicador_model->insertar()>0){
            $this->session->set_flashdata('mensajeSuccess', 'Registro insertado');
          }
          else{
            $this->session->set_flashdata('mensajeError', 'Error al intentar registrar, vuelva a intentar');
          }
        }
        header("location:" . base_url() . "tablero/procesoIndicador");

    }

    function actualizar(){

       $this->load->model("ProcesoIndicador_model");

       $id = $this->input->post("idindicadorproceso");
       $Anio_Ejecucion = $this->input->post("hAnio_EJecucion");
       $Codigo_Proceso = $this->input->post("hCodigo_Proceso");
       $Codigo_Indicador = $this->input->post("Codigo_Indicador");
       $Enero = $this->input->post("enero");
       $Febrero = $this->input->post("febrero");
       $Marzo = $this->input->post("marzo");
       $Abril = $this->input->post("abril");
       $Mayo = $this->input->post("mayo");
       $Junio = $this->input->post("junio");
       $Julio = $this->input->post("julio");
       $Agosto = $this->input->post("agosto");
       $Septiembre = $this->input->post("septiembre");
       $Octubre = $this->input->post("octubre");
       $Noviembre = $this->input->post("noviembre");
       $Diciembre = $this->input->post("diciembre");

        $this->ProcesoIndicador_model->setId($id);
        $this->ProcesoIndicador_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->ProcesoIndicador_model->setCodigo_Proceso($Codigo_Proceso);
        $this->ProcesoIndicador_model->setCodigo_Indicador($Codigo_Indicador);
        $this->ProcesoIndicador_model->setEnero($Enero);
        $this->ProcesoIndicador_model->setFebrero($Febrero);
        $this->ProcesoIndicador_model->setMarzo($Marzo);
        $this->ProcesoIndicador_model->setAbril($Abril);
        $this->ProcesoIndicador_model->setMayo($Mayo);
        $this->ProcesoIndicador_model->setJunio($Junio);
        $this->ProcesoIndicador_model->setJulio($Julio);
        $this->ProcesoIndicador_model->setAgosto($Agosto);
        $this->ProcesoIndicador_model->setSeptiembre($Septiembre);
        $this->ProcesoIndicador_model->setOctubre($Octubre);
        $this->ProcesoIndicador_model->setNoviembre($Noviembre);
        $this->ProcesoIndicador_model->setDiciembre($Diciembre);

        $existe = $this->ProcesoIndicador_model->existeNotId();

        if ($existe->num_rows() > 0) {

            $this->session->set_flashdata('mensajeError', 'Ya existe un proceso con ese indicador');
            header("location:" . base_url() . "tablero/procesoIndicador");
        } else {
          if($this->ProcesoIndicador_model->actualizar()>0){
            $this->session->set_flashdata('mensajeSuccess', 'Registro insertado');
          }
          else{
            $this->session->set_flashdata('mensajeError', 'Error al intentar registrar, vuelva a intentar');
          }
          header("location:" . base_url() . "tablero/procesoIndicador");
        }

    }

    public function eliminar(){

      $this->load->model("ProcesoIndicador_model");

      $id = $this->input->post("idindicadorproceso");

      $this->ProcesoIndicador_model->setId($id);
      if($this->ProcesoIndicador_model->eliminar()){
        $this->session->set_flashdata('mensajeSuccess', 'Registro eliminado');
      }
      else{
        $this->session->set_flashdata('mensajeError', 'Error al intentar eliminar, vuelva a intentar');
      }
      header("location:" . base_url() . "tablero/procesoIndicador");

    }

    function cargarDataProcesoIndicador(){


      $this->load->model("Indicador_model");
      $this->load->model("Proceso_model");
      $this->load->model("ProcesoIndicador_model");

      $id = $this->input->post("idindicadorproceso");

      $this->ProcesoIndicador_model->setId($id);
      $registro = $this->ProcesoIndicador_model->procesoIndicador();
      $row = $registro->row();

      $this->Indicador_model->setAnioEjecucion($row->Anio_Ejecucion);
      $listaIndicadores = $this->Indicador_model->listaPorAnioSeteado();

      $this->Proceso_model->setAnio_Ejecucion($row->Anio_Ejecucion);
      $listaProcesos = $this->Proceso_model->listaPorAnio();

      $listaIndicadores = $listaIndicadores->result();
      $listaProcesos = $listaProcesos->result();

      echo json_encode(array("registro"=>$registro->row(),"indicadores"=>$listaIndicadores,"procesos"=>$listaProcesos));

    }

    function cargarProcesoIndicador(){

      $anio = $this->input->post("anio");

      $this->load->model("Indicador_model");
      $this->load->model("Proceso_model");

      $this->Indicador_model->setAnioEjecucion($anio);
      $listaIndicadores = $this->Indicador_model->listaPorAnioSeteado();

      $this->Proceso_model->setAnio_Ejecucion($anio);
      $listaProcesos = $this->Proceso_model->listaPorAnio();

      if($listaIndicadores->num_rows()<=0) $listaIndicadores = array();
      else $listaIndicadores = $listaIndicadores->result();
      if($listaProcesos->num_rows()<=0) $listaProcesos = array();
      else $listaProcesos = $listaProcesos->result();

      echo json_encode(array("indicadores"=>$listaIndicadores,"procesos"=>$listaProcesos));

    }

    function areaYunidad(){

        $this->load->model("ProcesoIndicador_model");

      $id = $this->input->post("Codigo_Proceso");

      $this->ProcesoIndicador_model->setCodigo_Proceso($id);
      $rs = $this->ProcesoIndicador_model->areaYunidad();
      $row = $rs->row();

      echo json_encode(array("datos"=>$row));
    }
    
    public function asignacion(){
        
        $this->load->model("ProcesoIndicador_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Indicador_model");
        $this->load->model("AlertaPronostico_model");
        $anio = $this->input->post("Anio");

        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
          }

        $listaIndicador = $this->Indicador_model->listaSimple();
        $this->ProcesoIndicador_model->setAnio_Ejecucion($anio);
        $listaAsignacion = $this->ProcesoIndicador_model->listaAsignacion();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        
        $data = array(
            "listaIndicador"=>$listaIndicador,
            "lista"=>$listaAsignacion,
            "listaralerta" => $listaralerta,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "anio" => $anio,
        );
        
        $this->load->view("tablero/asignacionIndicadorActividadPOI",$data);
        
    }
    
    public function asignarIndicadorActividadPOIAjax(){
        
        $this->load->model("Proceso_model");
        
        $Id_Actividad_POI = $this->input->post("Id_Actividad_POI");
        $IdIndicador = $this->input->post("IdIndicador");
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        
        $this->Proceso_model->setId($Id_Actividad_POI);
        $this->Proceso_model->setIndicador($IdIndicador);
        $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
        
        if($this->Proceso_model->asignarIndicador()){
            $this->session->set_flashdata('mensajeSuccess', 'Indicador asignado exitosamente');
            echo json_encode(array("status"=>"0"));
        }
        else{
            $this->session->set_flashdata('mensajeError', 'Error al intentar asignar');
            echo json_encode(array("status"=>"-1"));
        }
        
    }
        
    public function quitarIndicadorActividadPOIAjax(){
            
        $this->load->model("Proceso_model");
        
        $Id_Actividad_POI = $this->input->post("Id_Actividad_POI");
        $IdIndicador = $this->input->post("IdIndicador");
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        
        $this->Proceso_model->setId($Id_Actividad_POI);
        $this->Proceso_model->setIndicador($IdIndicador);
        $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
        
        if($this->Proceso_model->eliminarIndicador()==1){
            $this->session->set_flashdata('mensajeSuccess', 'Indicador quitado exitosamente');
            echo json_encode(array("status"=>"0"));
        }
        else{
            $this->session->set_flashdata('mensajeError', 'Error al intentar quitar');
            echo json_encode(array("status"=>"-1"));
        }
        
    }
    
    public function enlazar() {
        
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Area_model");
        $this->load->model("Proceso_model");
        $this->load->model("AlertaPronostico_model");
        
        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        
        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }
        
        $this->Area_model->setAnio($anio);
        $this->Area_model->setId($this->session->userdata("Codigo_Area"));
        $listaAreasByUser = $this->Area_model->listaAreasByUser();
        
        $this->Proceso_model->setAnio_Ejecucion($anio);
        $rsListaActividadPoi = $this->Proceso_model->proceso();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
           // "lista" => $lista,
            "listaAreasByUser" => $listaAreasByUser,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaActividadesPOI" => $rsListaActividadPoi,
            "anio" => $anio,
            "listaralerta" => $listaralerta
        );
        $this->load->view("tablero/enlazar",$data);
        
    }

    public function areas() {
        
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Area_model");
        $this->load->model("Proceso_model");
        $this->load->model("AlertaPronostico_model");
        
        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        
        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }
        
        $this->Area_model->setAnio($anio);
        $this->Area_model->setId($this->session->userdata("Codigo_Area"));
        $listaAreasByUser = $this->Area_model->listaAreasByUser();
        
        $this->Proceso_model->setAnio_Ejecucion($anio);
        $rsListaActividadPoi = $this->Proceso_model->proceso();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $Codigo_Usuario = $this->session->userdata("idusuario");

        $data = array(
            "listaAreasByUser" => $listaAreasByUser,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaActividadesPOI" => $rsListaActividadPoi,
            "anio" => $anio,
            "Codigo_Usuario" => $Codigo_Usuario,
            "listaralerta" => $listaralerta
        );
        $this->load->view("tablero/mantenimientoAreas",$data);
    }

    public function registrarAreas() {
        
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Area_model");
        
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Sector = $this->input->post("Codigo_Sector");
        $Codigo_Pliego = $this->input->post("Codigo_Pliego");
        $Codigo_Ejecutora = $this->input->post("Codigo_Ejecutora");
        $Codigo_Centro_Costos = $this->input->post("Codigo_Centro_Costos");
        $Codigo_Sub_Centro_Costos = $this->input->post("Codigo_Sub_Centro_Costos");
        $Codigo_Area = $this->input->post("Codigo_Area");
        $Codigo_Area_Incrementable = $this->input->post("Codigo_Area_Incrementable");
        $Siglas_Area = $this->input->post("Siglas_Area");
        $Nombre_Area = $this->input->post("Nombre_Area");
        $Area_Estado = $this->input->post("Area_Estado");
        $Codigo_Usuario = $this->session->userdata("idusuario");
        
        $this->Area_model->setAnio($Anio_Ejecucion);
        $this->Area_model->setCodigo_Usuario($Codigo_Usuario);
        $this->Area_model->setCodigo_Sector($Codigo_Sector);
        $this->Area_model->setCodigo_Pliego($Codigo_Pliego);
        $this->Area_model->setCodigo_Ejecutora($Codigo_Ejecutora);
        $this->Area_model->setCodigo_Centro_Costos($Codigo_Centro_Costos);
        $this->Area_model->setCodigo_Sub_Centro_Costos($Codigo_Sub_Centro_Costos);
        $this->Area_model->setId($Codigo_Area);
        $this->Area_model->setSiglas($Siglas_Area);
        $this->Area_model->setNombre($Nombre_Area);
        $this->Area_model->setEstado($Area_Estado);
        $listaAreas;
        if ($Codigo_Area) {
            $listaAreas = $this->Area_model->actualizarAreas();
        } else {
            $this->Area_model->setId($Codigo_Area_Incrementable);
            $listaAreas = $this->Area_model->registrarAreas();
        }

        echo json_encode($listaAreas);
    }
    
    public function recargarCombosEnlace() {
        
        $this->load->model("Area_model");
        $this->load->model("Proceso_model");
        $Anio_Ejecucion = $this->input->post("anio");
        
        if (strlen($Anio_Ejecucion)) {
            
            $this->Area_model->setAnio($Anio_Ejecucion);
            $this->Area_model->setId($this->session->userdata("Codigo_Area"));
            $listaAreasByUser = $this->Area_model->listaAreasByUser();

            $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
            $rsListaActividadPoi = $this->Proceso_model->proceso();

            echo json_encode(array("listaAreas" => $listaAreasByUser->result(), "listaActividadesPOI" => $rsListaActividadPoi->result()));
            
        } else {
            
        }
        
    }
    
    public function listarEnlace() {
        
        $this->load->model("Proceso_model");
        
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Area = $this->input->post("Codigo_Area");
        $Codigo_Actividad_POI = $this->input->post("Codigo_Actividad_POI");
        
        $data = array();
        
        if(strlen($Anio_Ejecucion) > 0 && strlen($Codigo_Area) > 0) {
            
            $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
            $this->Proceso_model->setCodigo_Area($Codigo_Area);
            
            $rs = $this->Proceso_model->listarEnlace();
            
            foreach($rs->result() as $row):
            
                $data[] = array(
                    "Anio_Ejecucion" => $row->Anio_Ejecucion,
                    "Nombre_Area" => $row->Nombre_Area,
                    "Descripcion_Actividad" => $row->Descripcion_Actividad,
                    "Codigo_Area" => $row->Codigo_Area,
                    "Codigo_Actividad_POI" => $row->Codigo_Actividad_POI,
                    "Id_Actividad_POI" => $row->Id_Actividad_POI,
                    "eliminar" => '<button class="btn btn-danger btn-circle delete" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>'
                ); 
            
            endforeach;
            
        }
        
        $result = array(
            "data" => $data
        );
        
        echo json_encode($result);
        
    }
    
    public function registrarEnlace() {
        
        $Anio_Ejecucion = $this->input->post("Anio");
        $Codigo_Area = $this->input->post("Codigo_Area");
        $cboActividadPOI = $this->input->post("cboActividadPOI");
                
        if (strlen($Anio_Ejecucion) > 0 and strlen($Codigo_Area) > 0 and strlen($cboActividadPOI) > 0) {
            
            $this->load->model("Proceso_model");
            
            $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
            $this->Proceso_model->setCodigo_Actividad_POI($cboActividadPOI);
            $this->Proceso_model->setCodigo_Area($Codigo_Area);
            
            $cantidad = $this->Proceso_model->buscarEnlace();
            
            if($cantidad->num_rows() > 0) {
                echo json_encode(array("status" => 201));
                
            } else {
                if($this->Proceso_model->registrarEnlace()) {
                    echo json_encode(array("status" => 200));                    
                } else {                    
                    echo json_encode(array("final" => 1, "status" => 500));
                }
            }
            
            
        } else {
            
            echo json_encode(array("final" => 2,"status" => 500));
            
        }
    }    

    public function eliminarEnlace(){
        
        $this->load->model("Proceso_model");
        
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Area = $this->input->post("Codigo_Area");
        $Id_Actividad_POI = $this->input->post("Id_Actividad_POI");
        
        $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->Proceso_model->setCodigo_Area($Codigo_Area);
        $this->Proceso_model->setCodigo_Actividad_POI($Id_Actividad_POI);

        if($this->Proceso_model->eliminarEnlace()){
            $this->session->set_flashdata('mensajeSuccess', 'Registro eliminado');
        }
        else{
            $this->session->set_flashdata('mensajeError', 'Error al intentar eliminar, vuelva a intentar');
        }
        header("location:" . base_url() . "tablero/procesoIndicador/enlazar");
        
    }

    public function enlaceReporte() {

        $this->load->model("AnioEjecucion_model");
        $this->load->model("Area_model");
        $this->load->model("AlertaPronostico_model");

        $anio = $this->input->post("Anio");
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->Area_model->setAnio($anio);
        $this->Area_model->setId($this->session->userdata("Codigo_Area"));
        $listaAreasByUser = $this->Area_model->listaAreasByUser();

        $data = array(
            "listaAreasByUser" => $listaAreasByUser,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "anio" => $anio,
            "listaralerta" => $listaralerta
        );
        $this->load->view("tablero/reportes/enlaceReporte",$data);
    }

    public function enlaceReporteEjecucion() {

        $this->load->model("AnioEjecucion_model");
        $this->load->model("Area_model");
        $this->load->model("AlertaPronostico_model");

        $anio = $this->input->post("Anio");
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->Area_model->setAnio($anio);
        $this->Area_model->setId($this->session->userdata("Codigo_Area"));
        $listaAreasByUser = $this->Area_model->listaAreasByUser();

        $data = array(
            "listaAreasByUser" => $listaAreasByUser,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "anio" => $anio,
            "listaralerta" => $listaralerta
        );
        $this->load->view("tablero/reportes/enlaceReporteNuevo",$data);
    }
    
    public function cargarReporteEnlace() {        
        
        $this->load->model("Proceso_model");
        
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Area = $this->input->post("Codigo_Area");
        $Id_Actividad_POI = $this->input->post("Id_Actividad_POI");
        
        $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->Proceso_model->setCodigo_Area($Codigo_Area);
        $this->Proceso_model->setCodigo_Actividad_POI($Id_Actividad_POI);
        
        $lgrafico1 = $this->Proceso_model->programacionTableroEjecucionSemestreArea01();
        $lgrafico2 = $this->Proceso_model->programacionTableroEjecucionSemestreArea02();
        
        ($lgrafico1->num_rows()>0)? $grafico1 = $lgrafico1->result():$grafico1 = array();
        ($lgrafico2->num_rows()>0)? $grafico2 = $lgrafico2->result():$grafico2 = array();
        
        echo json_encode(array('grafico1' => $grafico1, 'grafico2' => $grafico2));
        
    }
    
    public function cargarListarEnlace() {
        
        $this->load->model("TableroControl_model");
        
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Area = $this->input->post("Codigo_Area");
        $Id_Actividad_POI = $this->input->post("Id_Actividad_POI");
        
        $this->TableroControl_model->setAnio_Ejecucion($Anio_Ejecucion);        
        $this->TableroControl_model->setCodigo_Area($Codigo_Area);
        $this->TableroControl_model->setId_Actividad_POI($Id_Actividad_POI);
        
        $rs = $this->TableroControl_model->listaPorArea();
        
        $data = array();
        
        if($rs->num_rows() > 0) {
            foreach($rs->result() as $row) {
                
                $archivo = '';
                if (strlen($row->Archivo)>0) {
                    $archivo = '<a href="'.base_url().'public/tablero/'.$row->Archivo.'" target="_blank" class="btn btn-default btn-circle"><i class="fa fa-file-code-o" aria-hidden="true"></i></a>';
                }
                $estado = '<span class="badge badge-warning">ANULADO</span>';

                if ($row->Activo=="1") {
  					$estado = '<span class="badge badge-success">ACTIVO</span>';
                }
                
                $data[] = array(
                    "Anio_Ejecucion" => $row->Anio_Ejecucion,
                    "Id_Actividad_POI" => $row->Codigo_Actividad_POI,
                    "descripcion_actividad" => $row->descripcion_actividad,
                    "Nombre_Area" => $row->Nombre_Area,
                    "nombre_unidad_medida" => $row->nombre_unidad_medida,
                    "nombre_mes" => $row->nombre_mes,
                    "Cantidad" => $row->Cantidad,
                    "Codigo_Actividad_proyecto" => $row->Codigo_Actividad_proyecto,
                    "codigo_actividad" => $row->codigo_actividad,
                    "Codigo_Programa_presupuestal" => $row->Codigo_Programa_presupuestal,
                    "Codigo_Finalidad" => $row->Codigo_Finalidad,
                    "Archivo" => $archivo,
                    "Nombre_Archivo" => $row->Nombre_Archivo,
                    "Numero_Documento" => $row->Numero_Documento,
                    "Observaciones" => $row->Observaciones,
                    "Logro" => $row->Logros,
                    "estado" => $estado
                );
            }
            
        }
        
        echo json_encode(array("data" => $data));
        
    }

    public function cargarReporteEnlaceSinTarea() {
        
        $this->load->model("Proceso_model");
        
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Area = $this->input->post("Codigo_Area");        
        $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->Proceso_model->setCodigo_Area($Codigo_Area);
        
        $lgrafico1 = $this->Proceso_model->programacionTableroEjecucionSemestreArea01SinTarea();
        $lgrafico2 = $this->Proceso_model->programacionTableroEjecucionSemestreArea02SinTarea();
        
        ($lgrafico1->num_rows()>0)? $grafico1 = $lgrafico1->result():$grafico1 = array();
        ($lgrafico2->num_rows()>0)? $grafico2 = $lgrafico2->result():$grafico2 = array();
        
        echo json_encode(array('grafico1' => $grafico1, 'grafico2' => $grafico2));
        
    }
}
