<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarea extends CI_Controller
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
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Indicador_model");
        $this->load->model("Tarea_model");

        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();

        if(empty($anio) or strlen($anio)<1) {
          $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
          $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->Indicador_model->setAnioEjecucion($anio);
        $this->Tarea_model->setAnioEjecucion($anio);

        $listaIndicador = $this->Indicador_model->listaCombo();
        $lista = $this->Tarea_model->lista();

        $data = array(
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "anio" => $anio,
            "listaIndicador" => $listaIndicador,
            "lista" => $lista
        );

        $this->load->view("tablero/gestionarTarea", $data);
    }

    public function registrar()
    {
        $this->load->model("Tarea_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Indicador = $this->input->post("Codigo_Indicador");
        $Nombre_Tarea = $this->input->post("Nombre_Tarea");
        $Costo_Tarea = $this->input->post("Costo_Tarea");
        $Duracion_Dias = $this->input->post("Duracion_Dias");
        $Fecha_Inicio = $this->input->post("Fecha_Inicio");
        $Fecha_Fin = $this->input->post("Fecha_Fin");
        $Activo = $this->input->post("Activo");



        if (strlen($Fecha_Inicio) > 0)
            $Fecha_Inicio = formatearFechaParaBD($Fecha_Inicio);
        if (strlen($Fecha_Fin) > 0)
            $Fecha_Fin = formatearFechaParaBD($Fecha_Fin);

        if (strlen($Costo_Tarea) > 0)
            $Costo_Tarea = str_replace(",", ".", $Costo_Tarea);

        $this->Tarea_model->setAnioEjecucion($Anio_Ejecucion);
        $this->Tarea_model->setCodigoIndicador($Codigo_Indicador);
        $this->Tarea_model->setNombreTarea($Nombre_Tarea);
        $this->Tarea_model->setCostoTarea($Costo_Tarea);
        $this->Tarea_model->setDuracionDias($Duracion_Dias);
        $this->Tarea_model->setFechaInicio($Fecha_Inicio);
        $this->Tarea_model->setFechaFin($Fecha_Fin);
        $this->Tarea_model->setActivo($Activo);

        $codigo = $this->Tarea_model->codigoByIndicador();

        if ($codigo < 100) {

            $numero = addCero($codigo);
            $this->Tarea_model->setCodigoTarea($numero);

            if ($this->Tarea_model->registrar()) {
                $this->session->set_flashdata('mensajeSuccess', 'Registro exitoso');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se completo la operaci&oacute;n, verifique nuevamente');
            }
        } else {
            $this->session->set_flashdata('mensajeWarning', 'No se completo la operaci&oacute;n, supero la cantidad de tareas para el indicador');
        }

        header('location:' . base_url() . 'tablero/tarea');
    }

    public function actualizar()
    {
        $this->load->model("Tarea_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Indicador = $this->input->post("Codigo_Indicador");
        $Codigo_Tarea = $this->input->post("Codigo_Tarea");
        $Nombre_Tarea = $this->input->post("Nombre_Tarea");
        $Costo_Tarea = $this->input->post("Costo_Tarea");
        $Duracion_Dias = $this->input->post("Duracion_Dias");
        $Fecha_Inicio = $this->input->post("Fecha_Inicio");
        $Fecha_Fin = $this->input->post("Fecha_Fin");
        $Activo = $this->input->post("Activo");

        if (strlen($Fecha_Inicio) > 0)
            $Fecha_Inicio = formatearFechaParaBD($Fecha_Inicio);
        if (strlen($Fecha_Fin) > 0)
            $Fecha_Fin = formatearFechaParaBD($Fecha_Fin);

        if (strlen($Costo_Tarea) > 0)
            $Costo_Tarea = str_replace(",", ".", $Costo_Tarea);

        $this->Tarea_model->setAnioEjecucion($Anio_Ejecucion);
        $this->Tarea_model->setCodigoIndicador($Codigo_Indicador);
        $this->Tarea_model->setCodigoTarea($Codigo_Tarea);

        $this->Tarea_model->setNombreTarea($Nombre_Tarea);
        $this->Tarea_model->setCostoTarea($Costo_Tarea);
        $this->Tarea_model->setDuracionDias($Duracion_Dias);
        $this->Tarea_model->setFechaInicio($Fecha_Inicio);
        $this->Tarea_model->setFechaFin($Fecha_Fin);
        $this->Tarea_model->setActivo($Activo);

        if ($this->Tarea_model->actualizar() > 0) {
            $this->session->set_flashdata('mensajeSuccess', 'Actualizaci&oacute;n exitosa');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se completo la operaci&oacute;n, verifique nuevamente');
        }

        header('location:' . base_url() . 'tablero/tarea');
    }

    public function eliminar()
    {
        $this->load->model("Tarea_model");
        $this->load->model("TableroControl_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Indicador = $this->input->post("Codigo_Indicador");
        $Codigo_Tarea = $this->input->post("Codigo_Tarea");

        $this->TableroControl_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->TableroControl_model->setCodigo_Indicador($Codigo_Indicador);
        $this->TableroControl_model->setCodigo_Tarea($Codigo_Tarea);

        $result = $this->TableroControl_model->buscarPorAnioIndicadorTarea();
        if ($result->num_rows() > 0) {

            $this->session->set_flashdata('mensajeWarning', 'No se completo la operaci&oacute;n, la tarea ya existe en uno o varios tableros de control');
        } else {

            $this->Tarea_model->setAnioEjecucion($Anio_Ejecucion);
            $this->Tarea_model->setCodigoIndicador($Codigo_Indicador);
            $this->Tarea_model->setCodigoTarea($Codigo_Tarea);

            $this->Tarea_model->eliminar();
            $this->session->set_flashdata('mensajeSuccess', 'Eliminaci&oacute;n exitosa');
        }

        header('location:' . base_url() . 'tablero/tarea');
    }
}
