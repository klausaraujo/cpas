<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class General extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function cargarSectores()
    {
        $this->load->model("Sector_model");
        
        $anio = $this->input->post("anio");
        
        $this->Sector_model->setAnio($anio);
        $lista = $this->Sector_model->lista();
        echo json_encode($lista->result());
    }

    public function cargarPliegos()
    {
        $this->load->model("Pliego_model");
        
        $anio = $this->input->post("anio");
        $sector = $this->input->post("sector");
        
        $this->Pliego_model->setAnio($anio);
        $this->Pliego_model->setSector($sector);
        $lista = $this->Pliego_model->lista();
        echo json_encode($lista->result());
    }

    public function cargarEjecutoras()
    {
        $this->load->model("Ejecutora_model");
        
        $anio = $this->input->post("anio");
        $sector = $this->input->post("sector");
        $pliego = $this->input->post("pliego");
        
        $this->Ejecutora_model->setAnio($anio);
        $this->Ejecutora_model->setSector($sector);
        $this->Ejecutora_model->setPliego($pliego);
        $lista = $this->Ejecutora_model->lista();
        echo json_encode($lista->result());
    }

    public function cargarCentroCostos()
    {
        $this->load->model("CentroCostos_model");
        
        $anio = $this->input->post("anio");
        $sector = $this->input->post("sector");
        $pliego = $this->input->post("pliego");
        $ejecutora = $this->input->post("ejecutora");
        
        $this->CentroCostos_model->setAnio($anio);
        $this->CentroCostos_model->setSector($sector);
        $this->CentroCostos_model->setPliego($pliego);
        $this->CentroCostos_model->setEjecutora($ejecutora);
        $lista = $this->CentroCostos_model->lista();
        echo json_encode($lista->result());
    }

    public function cargarSubCentroCostos()
    {
        $this->load->model("SubCentroCostos_model");
        
        $anio = $this->input->post("anio");
        $sector = $this->input->post("sector");
        $pliego = $this->input->post("pliego");
        $ejecutora = $this->input->post("ejecutora");
        $centroCostos = $this->input->post("centroCostos");
        
        $this->SubCentroCostos_model->setAnio($anio);
        $this->SubCentroCostos_model->setSector($sector);
        $this->SubCentroCostos_model->setPliego($pliego);
        $this->SubCentroCostos_model->setEjecutora($ejecutora);
        $this->SubCentroCostos_model->setCentroCostos($centroCostos);
        $lista = $this->SubCentroCostos_model->lista();
        echo json_encode($lista->result());
    }

    public function cargarProyectos()
    {
        $this->load->model("Proyecto_model");
        
        $anio = $this->input->post("anio");
        
        $this->Proyecto_model->setAnio($anio);
        $lista = $this->Proyecto_model->lista();
        echo json_encode($lista->result());
    }

    public function cargarActividades()
    {
        $this->load->model("Actividad_model");
        
        $anio = $this->input->post("anio");
        
        $this->Actividad_model->setAnio_Ejecucion($anio);
        $lista = $this->Actividad_model->lista();
        echo json_encode($lista->result());
    }

    public function cargarProgramasPresupuestales()
    {
        $this->load->model("ProgramaPresupuestal_model");
        
        $anio = $this->input->post("anio");
        
        $this->ProgramaPresupuestal_model->setAnio($anio);
        $lista = $this->ProgramaPresupuestal_model->lista();
        echo json_encode($lista->result());
    }

    public function cargarVariosPorAnio()
    {
        $this->load->model("Proceso_model");
        $this->load->model("ActividadProyecto_model");
        $this->load->model("Actividad_model");
        $this->load->model("Finalidad_model");
        
        $anio = $this->input->post("anio");
        
        $this->Proceso_model->setAnio_Ejecucion($anio);
        $cadenaPresupuestal = $this->Proceso_model->cadenaPresupuestal();
        
        $this->ActividadProyecto_model->setAnio($anio);
        $proyecto = $this->ActividadProyecto_model->lista();
        
        $this->Actividad_model->setAnio_Ejecucion($anio);
        $actividad = $this->Actividad_model->lista();
                
        $this->Finalidad_model->setAnio_Ejecucion($anio);
        $finalidad = $this->Finalidad_model->lista();
        
        $data = array(
            "proyecto" => $proyecto->result(),
            "actividad" => $actividad->result(),
            "finalidad" => $finalidad->result(),            
            "cadenaPresupuestal" => $cadenaPresupuestal
        );
        
        echo json_encode($data);
    }

    public function cargarAreas()
    {
        $this->load->model("Area_model");
        
        $anio = $this->input->post("anio");
        $sector = $this->input->post("sector");
        $pliego = $this->input->post("pliego");
        $ejecutora = $this->input->post("ejecutora");
        $centroCostos = $this->input->post("centroCostos");
        $subCentroCostos = $this->input->post("subCentroCostos");
        
        $this->Area_model->setAnio($anio);
        $this->Area_model->setSector($sector);
        $this->Area_model->setPliego($pliego);
        $this->Area_model->setEjecutora($ejecutora);
        $this->Area_model->setCentroCostos($centroCostos);
        $this->Area_model->setSubCentroCostos($subCentroCostos);
        
        $lista = $this->Area_model->listar();
        echo json_encode($lista->result());
    }

    public function cargarSelectUsuarioEditar()
    {
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Sector_model");
        $this->load->model("Pliego_model");
        $this->load->model("Ejecutora_model");
        $this->load->model("CentroCostos_model");
        $this->load->model("SubCentroCostos_model");
        
        $anio = $this->input->post("anio");
        $sector = $this->input->post("sector");
        $pliego = $this->input->post("pliego");
        $ejecutora = $this->input->post("ejecutora");
        $centroCostos = $this->input->post("centroCostos");
        
        $this->Sector_model->setAnio($anio);
        $listaSector = $this->Sector_model->lista();
        
        $this->Pliego_model->setAnio($anio);
        $this->Pliego_model->setSector($sector);
        $listaPliego = $this->Pliego_model->lista();
        
        $this->Ejecutora_model->setAnio($anio);
        $this->Ejecutora_model->setSector($sector);
        $this->Ejecutora_model->setPliego($pliego);
        $listaEjecutora = $this->Ejecutora_model->lista();
        
        $this->CentroCostos_model->setAnio($anio);
        $this->CentroCostos_model->setSector($sector);
        $this->CentroCostos_model->setPliego($pliego);
        $this->CentroCostos_model->setEjecutora($ejecutora);
        $listaCentroCostos = $this->CentroCostos_model->lista();
        
        $this->SubCentroCostos_model->setAnio($anio);
        $this->SubCentroCostos_model->setSector($sector);
        $this->SubCentroCostos_model->setPliego($pliego);
        $this->SubCentroCostos_model->setEjecutora($ejecutora);
        $this->SubCentroCostos_model->setCentroCostos($centroCostos);
        $listaSubCentroCostos = $this->SubCentroCostos_model->lista();
        
        $data = array(
            "sector" => $listaSector->result(),
            "pliego" => $listaPliego->result(),
            "ejecutora" => $listaEjecutora->result(),
            "centroCostos" => $listaCentroCostos->result(),
            "subCentroCostos" => $listaSubCentroCostos->result()
        );
        
        echo json_encode($data);
    }
}