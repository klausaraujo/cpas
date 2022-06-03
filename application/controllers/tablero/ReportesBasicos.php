<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportesBasicos extends CI_Controller
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

    public function indicadores()
    {
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Vista_model");
        $this->load->model("AlertaPronostico_model");


        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        
        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->Vista_model->setAnio($anio);
        $lista = $this->Vista_model->reporteIndicadores();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        if($lista->num_rows()>0){
            $grafico = $lista->result();
        }
        else $grafico = array();
        
        $data = array(
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "lista" => $lista,
            "anio" => $anio,
            "listaralerta" => $listaralerta,
            "grafico" => json_encode($grafico)
        );

        $this->load->view("tablero/reportes/Indicadores", $data);
    }

    public function indicadoresAnioAjax()
    {
        $this->load->model("Indicador_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $this->Indicador_model->setAnioEjecucion($Anio_Ejecucion);
        $listaIndicadores = $this->Indicador_model->listaPorAnio();
        echo json_encode($listaIndicadores->result());
    }

    public function indicadoresAjax()
    {
        $this->load->model("Vista_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Activar = $this->input->post("Activar");
        $Codigo_Indicador = $this->input->post("Codigo_Indicador");

        $data = array();

        if ($Activar == 0) {
            echo "";
        } else {

            $i = 1;
            if (strlen($Anio_Ejecucion) == 0)
                $Anio_Ejecucion = $this->session->userdata("Anio_Ejecucion");

            $this->Vista_model->setAnio($Anio_Ejecucion);
            $this->Vista_model->setCodigo_Indicador($Codigo_Indicador);
            $lista = $this->Vista_model->reporteIndicadores();

            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                    $data[] = array(
                        "numero" => $i,
                        "Anio_Ejecucion" => $row->Anio_Ejecucion,
                        "Nombre_Indicador" => $row->Codigo_Indicador . ' - ' . $row->Nombre_Indicador,
                        "Cantidad_Programada" => $row->Cantidad_Programada,
                        "Cantidad_Ejecutada" => $row->Cantidad_Ejecutada,
                        "Porcentaje_Avance" => round($row->Porcentaje_Avance, 2, PHP_ROUND_HALF_UP),
                        "Codigo_Indicador" => $row->Codigo_Indicador
                    );
                    $i ++;
                endforeach
                ;
            }
        }

        $result = array(
            "data" => $data
        );
        echo json_encode($result);
    }

    public function procesos()
    {
        
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Proceso_model");
        $this->load->model("TableroControl_model");
        $this->load->model("AlertaPronostico_model");
        
        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }
        
        $this->Proceso_model->setAnio_Ejecucion($anio);
        $rsListaActividadPoi = $this->Proceso_model->proceso();
        
        $this->TableroControl_model->setAnio_Ejecucion($anio);
        
        $firstActividadPOI = $rsListaActividadPoi->first_row();
        $this->TableroControl_model->setId_Actividad_POI($firstActividadPOI->Id_Actividad_POI);
        
        $lgrafico1 = $this->TableroControl_model->graficoPorcentajeSemestral1();
        $lgrafico2 = $this->TableroControl_model->graficoPorcentajeSemestral2();
        
        ($lgrafico1->num_rows()>0)? $grafico1 = $lgrafico1->result():$grafico1 = array();
        ($lgrafico2->num_rows()>0)? $grafico2 = $lgrafico2->result():$grafico2 = array();
                
        $data = array(
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaActividadPoi" => $rsListaActividadPoi,
            "firstActividadPOI" => $firstActividadPOI->Id_Actividad_POI,
            "anio" => $anio,
            "grafico1" => json_encode($grafico1),
            "grafico2" => json_encode($grafico2),
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("tablero/reportes/procesos", $data);
    }

    public function filtroProcesoAjax()
    {
        $this->load->model("proceso_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");

        $Codio_Area = $this->session->userdata("Codigo_Area");

        $this->proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->proceso_model->setCodigo_Area($Codio_Area);

        $listaProcesos = $this->proceso_model->reporteListaProcesoFiltro();

        echo json_encode($listaProcesos->result());
    }

    public function procesosAjax()
    {
        $this->load->model("Vista_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Activar = $this->input->post("Activar");
        $Codigo_Proceso = $this->input->post("Codigo_Proceso");

        $data = array();

        if ($Activar == 0) {
            echo "";
        } else {

            $i = 1;

            $Codio_Area = $this->session->userdata("Codigo_Area");

            $this->Vista_model->setAnio($Anio_Ejecucion);
            $this->Vista_model->setArea($Codio_Area);
            $this->Vista_model->setCodigo_Proceso($Codigo_Proceso);
            $lista = $this->Vista_model->reporteProcesos();

            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                    $data[] = array(
                        "numero" => $i,
                        "Anio_Ejecucion" => $row->Anio_Ejecucion,
                        "Descripcion_Proceso" => $row->Codigo_Proceso . ' - ' . $row->Descripcion_Proceso,
                        "Costo_Programado" => $row->Costo_Programado,
                        "Cantidad_Programada" => $row->Cantidad_Programada,
                        "Siglas_Area" => $row->Siglas_Area
                    );
                    $i ++;
                endforeach
                ;
            }
        }

        $result = array(
            "data" => $data
        );
        echo json_encode($result);
    }

    public function poivstablero()
    {
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Proceso_model");
        $this->load->model("TableroControl_model");
        $this->load->model("AlertaPronostico_model");
        
        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }
        
        $this->Proceso_model->setAnio_Ejecucion($anio);
        $rsListaActividadPoi = $this->Proceso_model->proceso();
        
        $this->TableroControl_model->setAnio_Ejecucion($anio);
        
        $firstActividadPOI = $rsListaActividadPoi->first_row();
        $this->TableroControl_model->setId_Actividad_POI($firstActividadPOI->Id_Actividad_POI);
        
        $lgrafico = $this->TableroControl_model->graficoPorcentaje();
        
        if($lgrafico->num_rows()>0){
            $grafico = $lgrafico->result();
        }
        else $grafico = array();
        
        $data = array(
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaActividadPoi" => $rsListaActividadPoi,
            "firstActividadPOI" => $firstActividadPOI->Id_Actividad_POI,
            "anio" => $anio,
            "listaralerta" => $listaralerta,
            "grafico" => json_encode($grafico)
        );
        
        $this->load->view("tablero/reportes/poivstablero", $data);
    }

    public function actividadpoi(){

        $this->load->model("AnioEjecucion_model");
        $this->load->model("Proceso_model");
        $this->load->model("TableroControl_model");
        $this->load->model("AlertaPronostico_model");
        
        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        
        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }
        
        $this->Proceso_model->setAnio_Ejecucion($anio);
        $rsListaActividadPoi = $this->Proceso_model->proceso();
        
        $this->TableroControl_model->setAnio_Ejecucion($anio);
        
        $firstActividadPOI = $rsListaActividadPoi->first_row();
        $this->TableroControl_model->setId_Actividad_POI($firstActividadPOI->Id_Actividad_POI);
        
        $lgrafico = $this->TableroControl_model->grafico();
        
        if($lgrafico->num_rows()>0){
            $grafico = $lgrafico->result();
        }
        else $grafico = array();

      $data = array(
          "listaAnioEjecucion" => $listaAnioEjecucion,
          "listaActividadPoi" => $rsListaActividadPoi,
          "firstActividadPOI" => $firstActividadPOI->Id_Actividad_POI,
          "anio" => $anio,
          "listaralerta" => $listaralerta,
          "grafico" => json_encode($grafico)
      );

      return $this->load->view("tablero/reportes/actividadPOI",$data);

    }

    public function areasByAnio(){

      $this->load->model("Area_model");
      $anio = $this->input->post("anio");
      $this->Area_model->setAnio($anio);
      $lista = $this->Area_model->lista();
      $data = array("lista"=>$lista->result());
      echo json_encode($data);

    }

    public function actividadpoiAjax(){
          $this->load->model("Vista_model");

          $anio = $this->input->post("anio");
          $area = $this->input->post("area");

          $data = array();

        if ($anio>0 or $area>0) {

                $this->Vista_model->setAnio($anio);
                $this->Vista_model->setArea($area);
                $lista = $this->Vista_model->reporteActividadPOI();

                  $n=1;
                  foreach($lista->result() as $row):

                    $data[] = array(
                      "numero"=>$n,
                      "Unidad_Medida"=>$row->Nombre_Unidad_Medida,
                      "pEnero"=>$row->pEnero,"eEnero"=>$row->eEnero,
                      "pFebrero"=>$row->pFebrero,"eFebrero"=>$row->eFebrero,
                      "pMarzo"=>$row->pMarzo,"eMarzo"=>$row->eMarzo,
                      "pAbril"=>$row->pAbril,"eAbril"=>$row->eAbril,
                      "pMayo"=>$row->pMayo,"eMayo"=>$row->eMayo,
                      "pJunio"=>$row->pJunio,"eJunio"=>$row->eJunio,
                      "pJulio"=>$row->pJulio,"eJulio"=>$row->eJulio,
                      "pAgosto"=>$row->pAgosto,"eAgosto"=>$row->eAgosto,
                      "pSeptiembre"=>$row->pSeptiembre,"eSeptiembre"=>$row->eSeptiembre,
                      "pOctubre"=>$row->pOctubre,"eOctubre"=>$row->eOctubre,
                      "pNoviembre"=>$row->pNoviembre,"eNoviembre"=>$row->eNoviembre,
                      "pDiciembre"=>$row->pDiciembre,"eDiciembre"=>$row->eDiciembre,
                      "Descripcion_Proceso"=>$row->Descripcion_Proceso
                    );
                  $n++;
                  endforeach;

            }

                  $result = array(
                       "data" => $data
                   );
                   echo json_encode($result);

    }
    
}
