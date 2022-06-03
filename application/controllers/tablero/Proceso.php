<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proceso extends CI_Controller
{

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

        }else{
            redirect("login");
        }
    }

    public function index()
    {
        $this->load->model("Proceso_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("UnidadMedida_model");
        $this->load->model("AlertaPronostico_model");

        $anio = $this->input->post("Anio");

        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        if(empty($anio) or strlen($anio)<1) {
          $rsListaAnioEjecucion = $anioPredeterminado->row();
          $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $listaUnidadMedida = $this->UnidadMedida_model->lista();

        $this->Proceso_model->setAnio_Ejecucion($anio);
        $lista = $this->Proceso_model->lista();        

        $data = array(
            "lista" => $lista,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaUnidadMedida" => $listaUnidadMedida,
            "anio" => $anio,
            "listaralerta" => $listaralerta
        );

        $this->load->view("tablero/gestionarProceso", $data);
    }

    public function registrar()
    {
        $this->load->model("Proceso_model");

        $cboAnio = $this->input->post("cboAnio");
        $cboSector = $this->input->post("cboSector");
        $cboPliego = $this->input->post("cboPliego");
        $cboEjecutora = $this->input->post("cboEjecutora");
        $cboCentroCostos = $this->input->post("cboCentroCostos");
        $cboSubCentroCostos = $this->input->post("cboSubCentroCostos");
        $cboProgramaPresupuestal = $this->input->post("cboProgramaPresupuestal");
        $cbActividadProyecto = $this->input->post("cbActividadProyecto");
        $cboActividad = $this->input->post("cboActividad");
        $cboFinalidad = $this->input->post("cboFinalidad");
        $cboUnidadMedida = $this->input->post("cboUnidadMedida");
        $Costo_Programado = $this->input->post("Costo_Programa");
        
        $enero = $this->input->post("enero");
        $febrero = $this->input->post("febrero");
        $marzo = $this->input->post("marzo");
        $abril = $this->input->post("abril");
        $mayo = $this->input->post("mayo");
        $junio = $this->input->post("junio");
        $julio = $this->input->post("julio");
        $agosto = $this->input->post("agosto");
        $septiembre = $this->input->post("septiembre");
        $octubre = $this->input->post("octubre");
        $noviembre = $this->input->post("noviembre");
        $diciembre = $this->input->post("diciembre");
        
        (strlen($enero)<1)?$enero=0:$enero=$enero;
        (strlen($febrero)<1)?$febrero=0:$febrero=$febrero;
        (strlen($marzo)<1)?$marzo=0:$marzo=$marzo;
        (strlen($abril)<1)?$abril=0:$abril=$abril;
        (strlen($mayo)<1)?$mayo=0:$mayo=$mayo;
        (strlen($junio)<1)?$junio=0:$junio=$junio;
        (strlen($julio)<1)?$julio=0:$julio=$julio;
        (strlen($agosto)<1)?$agosto=0:$agosto=$agosto;
        (strlen($septiembre)<1)?$septiembre=0:$septiembre=$septiembre;
        (strlen($octubre)<1)?$octubre=0:$octubre=$octubre;
        (strlen($noviembre)<1)?$noviembre=0:$noviembre=$noviembre;
        (strlen($diciembre)<1)?$diciembre=0:$diciembre=$diciembre;
        
        $Nombre = $this->input->post("Nombre");

        if (strlen($Costo_Programado) > 0)
            $Costo_Programado = str_replace(",", ".", $Costo_Programado);
        
        (strlen($Costo_Programado)<1)?$Costo_Programado=0:$Costo_Programado=$Costo_Programado;

        $this->Proceso_model->setAnio_Ejecucion($cboAnio);
        $this->Proceso_model->setCodigo_Sector($cboSector);
        $this->Proceso_model->setCodigo_Pliego($cboPliego);
        $this->Proceso_model->setCodigo_Ejecutora($cboEjecutora);
        $this->Proceso_model->setCodigo_Centro_Costos($cboCentroCostos);
        $this->Proceso_model->setCodigo_Sub_Centro_Costos($cboSubCentroCostos);
        $this->Proceso_model->setCodigo_Programa_Presupuestal($cboProgramaPresupuestal);
        $this->Proceso_model->setCodigo_Actividad_Proyecto($cbActividadProyecto);
        $this->Proceso_model->setCodigo_Actividad($cboActividad);
        $this->Proceso_model->setCodigo_Finalidad($cboFinalidad);
        $this->Proceso_model->setCodigo_Unidad_Medida($cboUnidadMedida);
        $this->Proceso_model->setCosto_Programado($Costo_Programado);
        $this->Proceso_model->setDescripcion_Actividad($Nombre);
        
        $this->Proceso_model->setEnero($enero);
        $this->Proceso_model->setFebrero($febrero);
        $this->Proceso_model->setMarzo($marzo);
        $this->Proceso_model->setAbril($abril);
        $this->Proceso_model->setMayo($mayo);
        $this->Proceso_model->setJunio($junio);
        $this->Proceso_model->setJulio($julio);
        $this->Proceso_model->setAgosto($agosto);
        $this->Proceso_model->setSeptiembre($septiembre);
        $this->Proceso_model->setOctubre($octubre);
        $this->Proceso_model->setNoviembre($noviembre);
        $this->Proceso_model->setDiciembre($diciembre);

        $codigo = $this->Proceso_model->codigoByActividadPOI();

        if ($codigo < 100) {

            $numero = addCeros($codigo);
            $this->Proceso_model->setCodigo_Actividad_POI($numero);

            if ($this->Proceso_model->registrar()) {
                $this->session->set_flashdata('mensajeSuccess', 'Registro exitoso');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se completo la operaci&oacute;n, verifique nuevamente');
            }
        } else {
            $this->session->set_flashdata('mensajeWarning', 'No se completo la operaci&oacute;n, supero la cantidad de indicadores');
        }

        header('location:' . base_url() . 'tablero/proceso');
    }

    public function actualizar()
    {
        $this->load->model("Proceso_model");
        
        $id = $this->input->post("id");
        $cboAnio = $this->input->post("cboAnio");
        $cboSector = $this->input->post("cboSector");
        $cboPliego = $this->input->post("cboPliego");
        $cboEjecutora = $this->input->post("cboEjecutora");
        $cboCentroCostos = $this->input->post("cboCentroCostos");
        $cboSubCentroCostos = $this->input->post("cboSubCentroCostos");
        $cboProgramaPresupuestal = $this->input->post("cboProgramaPresupuestal");
        $cbActividadProyecto = $this->input->post("cbActividadProyecto");
        $cboActividad = $this->input->post("cboActividad");
        $cboFinalidad = $this->input->post("cboFinalidad");
        $cboUnidadMedida = $this->input->post("cboUnidadMedida");
        $Costo_Programado = $this->input->post("Costo_Programa");
        
        $enero = $this->input->post("enero");
        $febrero = $this->input->post("febrero");
        $marzo = $this->input->post("marzo");
        $abril = $this->input->post("abril");
        $mayo = $this->input->post("mayo");
        $junio = $this->input->post("junio");
        $julio = $this->input->post("julio");
        $agosto = $this->input->post("agosto");
        $septiembre = $this->input->post("septiembre");
        $octubre = $this->input->post("octubre");
        $noviembre = $this->input->post("noviembre");
        $diciembre = $this->input->post("diciembre");
        
        (strlen($enero)<1)?$enero=0:$enero=$enero;
        (strlen($febrero)<1)?$febrero=0:$febrero=$febrero;
        (strlen($marzo)<1)?$marzo=0:$marzo=$marzo;
        (strlen($abril)<1)?$abril=0:$abril=$abril;
        (strlen($mayo)<1)?$mayo=0:$mayo=$mayo;
        (strlen($junio)<1)?$junio=0:$junio=$junio;
        (strlen($julio)<1)?$julio=0:$julio=$julio;
        (strlen($agosto)<1)?$agosto=0:$agosto=$agosto;
        (strlen($septiembre)<1)?$septiembre=0:$septiembre=$septiembre;
        (strlen($octubre)<1)?$octubre=0:$octubre=$octubre;
        (strlen($noviembre)<1)?$noviembre=0:$noviembre=$noviembre;
        (strlen($diciembre)<1)?$diciembre=0:$diciembre=$diciembre;
        
        $Nombre = $this->input->post("Nombre");
        
        if (strlen($Costo_Programado) > 0)
            $Costo_Programado = str_replace(",", ".", $Costo_Programado);
            
        (strlen($Costo_Programado)<1)?$Costo_Programado=0:$Costo_Programado=$Costo_Programado;
            
        $this->Proceso_model->setId($id);
        $this->Proceso_model->setAnio_Ejecucion($cboAnio);
        $this->Proceso_model->setCodigo_Sector($cboSector);
        $this->Proceso_model->setCodigo_Pliego($cboPliego);
        $this->Proceso_model->setCodigo_Ejecutora($cboEjecutora);
        $this->Proceso_model->setCodigo_Centro_Costos($cboCentroCostos);
        $this->Proceso_model->setCodigo_Sub_Centro_Costos($cboSubCentroCostos);
        $this->Proceso_model->setCodigo_Programa_Presupuestal($cboProgramaPresupuestal);
        $this->Proceso_model->setCodigo_Actividad_Proyecto($cbActividadProyecto);
        $this->Proceso_model->setCodigo_Actividad($cboActividad);
        $this->Proceso_model->setCodigo_Finalidad($cboFinalidad);
        $this->Proceso_model->setCodigo_Unidad_Medida($cboUnidadMedida);
        $this->Proceso_model->setCosto_Programado($Costo_Programado);
        $this->Proceso_model->setDescripcion_Actividad($Nombre);
        
        $this->Proceso_model->setEnero($enero);
        $this->Proceso_model->setFebrero($febrero);
        $this->Proceso_model->setMarzo($marzo);
        $this->Proceso_model->setAbril($abril);
        $this->Proceso_model->setMayo($mayo);
        $this->Proceso_model->setJunio($junio);
        $this->Proceso_model->setJulio($julio);
        $this->Proceso_model->setAgosto($agosto);
        $this->Proceso_model->setSeptiembre($septiembre);
        $this->Proceso_model->setOctubre($octubre);
        $this->Proceso_model->setNoviembre($noviembre);
        $this->Proceso_model->setDiciembre($diciembre);

        if ($this->Proceso_model->actualizar() > 0) {
            $this->session->set_flashdata('mensajeSuccess', 'Actualizaci&oacute;n exitosa');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se completo la operaci&oacute;n, verifique nuevamente');
        }

        header('location:' . base_url() . 'tablero/proceso');
    }

    public function eliminar()
    {
        $this->load->model("Proceso_model");
        $this->load->model("TableroControl_model");

        $id = $this->input->post("id");

        $this->TableroControl_model->setId_Actividad_POI($id);

        $result = $this->TableroControl_model->buscarPorActividadPOI();
        if ($result->num_rows() > 0) {

            $this->session->set_flashdata('mensajeWarning', 'No se completo la operaci&oacute;n, la actividad existe en uno o varios tableros de control');
        } else {

            $this->Proceso_model->setId($id);
            $this->Proceso_model->eliminar();
            $this->session->set_flashdata('mensajeSuccess', 'Eliminaci&oacute;n exitosa');
        }

        header('location:' . base_url() . 'tablero/proceso');
    }
    
}
