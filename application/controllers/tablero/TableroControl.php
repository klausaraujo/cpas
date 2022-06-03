<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TableroControl extends CI_Controller
{

    private $permisos = null;

    public function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");

        (strlen($token) > 0) ? $token = JWT::decode($token, getenv("SECRET_SERVER_KEY")) : redirect("login");

        $this->session->set_userdata("idmodulo", 3);

        ($this->session->userdata("idusuario")) ? $usuario = $this->session->userdata("idusuario") : redirect("login");

        if (sha1($usuario) == $token->usuario) {

            if (count($token->modulos) > 0) {

                $listaModulos = $token->modulos;

                $permanecer = false;

                foreach ($listaModulos as $row):
                    if ($row->idmodulo == 3 and $row->estado == 1) {
                        $permanecer = true;
                    }

                endforeach
                ;

                if ($permanecer == false) {
                    redirect('errores/accesoDenegado');
                }

            } else {
                redirect("login");
            }

            if ($this->permisos == null) {if ($this->session->userdata("menu")) {
                $this->permisos = $this->session->userdata("menu");
            }
            }

        } else {
            redirect("login");
        }
    }

    public function obtenerFiltro(){
        $nivel = 1;
        $idmenu = 4;

        validarPermisos($nivel, $idmenu, $this->permisos);
        
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Proceso_model");
        $this->load->model("Area_model");
        $this->load->model("TableroControl_model");
        $this->load->model("TableroMes_model");
        $this->load->model("AlertaPronostico_model");

        $anio = $this->input->post("Anio");
        $mes = $this->input->post("mes");
        $area = $this->input->post("Codigo_Area");

        $this->TableroControl_model->setAnio_Ejecucion($anio);
        $this->TableroControl_model->setCodigo_mes($mes);
        $this->TableroControl_model->setCodigo_Area($area);
        $data = $this->TableroControl_model->lista();

        if ($data->num_rows() > 0) {
            $response = $data->result();
        } else {
            $response = array();
        }

        echo json_encode($response);
    }

    public function gestionar()
    {

        $nivel = 1;
        $idmenu = 4;

        validarPermisos($nivel, $idmenu, $this->permisos);

        $this->load->model("AnioEjecucion_model");
        $this->load->model("Proceso_model");
        $this->load->model("Area_model");
        $this->load->model("TableroControl_model");
        $this->load->model("TableroMes_model");
        $this->load->model("AlertaPronostico_model");
       
        $anio = $this->input->post("Anio");
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $this->TableroControl_model->setAnio_Ejecucion($anio);
        
        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->Area_model->setAnio($anio);
        $this->Area_model->setId($this->session->userdata("Codigo_Area"));
        $listaAreasByUser = $this->Area_model->listaAreasByUser2();
        $rsListaAreas = $listaAreasByUser;
        $this->Proceso_model->setAnio_Ejecucion($anio);
        $rsListaActividadPoi = $this->Proceso_model->proceso();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $this->TableroControl_model->setAnio_Ejecucion($anio);
        $this->TableroControl_model->setCodigo_Pliego($this->session->userdata("Codigo_Pliego"));
        $this->TableroControl_model->setCodigo_Ejecutora($this->session->userdata("Codigo_Ejecutora"));
        $this->TableroControl_model->setCodigo_Centro_Costos($this->session->userdata("Codigo_Centro_Costos"));
        $this->TableroControl_model->setCodigo_Sub_Centro_Costos($this->session->userdata("Codigo_Sub_Centro_Costos"));
        $this->TableroControl_model->setCodigo_Area($this->session->userdata("Codigo_Area"));
        $this->TableroControl_model->setAnio_Ejecucion($anio);
        $listaGraficoAreas = $this->TableroControl_model->obtenerGraficoAreas();

        $rsListaMeses = $this->TableroMes_model->lista();

        $firstActividadPOI = $rsListaActividadPoi->first_row();

        $lgrafico = $this->TableroControl_model->obtenerPlanEjecucionMensual();
        $listaTablero = $this->TableroControl_model->lista();

        $row = $this->TableroControl_model->obtenerCantidadActividadPOI();
        $totalActividadPoi = $row->row();
        $row = $this->TableroControl_model->obtenerUnidadesFuncionalesActivas();
        $totalUnidadesFuncionales = $row->row();
        $row = $this->TableroControl_model->obtenerActividadesPresupuestales();
        $totalActividadPresupuestal = $row->row();
        $row = $this->TableroControl_model->obtenerCantidadProductos();
        $totalProductos = $row->row();

        if ($lgrafico->num_rows() > 0) {
            $grafico = $lgrafico->result();
        } else {
            $grafico = array();
        }

        $data = array(
            "listaTablero" => $listaTablero,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaAreas" => $rsListaAreas,
            "listaActividadPoi" => $rsListaActividadPoi,
            "listaMeses" => $rsListaMeses,
            "anio" => $anio,
            "grafico" => json_encode($grafico),
            "listaAreasByUser" => $listaAreasByUser,
            "listaralerta" => $listaralerta,
            "totalActividadPoi" => $totalActividadPoi->total,
            "totalUnidadesFuncionales" => $totalUnidadesFuncionales->total,
            "totalActividadPresupuestal" => $totalActividadPresupuestal->total,
            "totalProductos" => $totalProductos->total,
            "listaGraficoAreas" => $listaGraficoAreas,
            "dataGraficoAreas" => json_encode($listaGraficoAreas->result()),
            
        );

        $this->load->view("tablero/gestionarTablero", $data);
    }

    public function grafficReport()
    {

        $this->load->model("TableroControl_model");
        $anio = $this->input->post("anio");
        $IdActividadPOI = $this->input->post("cboActividadPOI");

        $this->TableroControl_model->setId_Actividad_POI($IdActividadPOI);
        $this->TableroControl_model->setAnio_Ejecucion($anio);
        $lgrafico = $this->TableroControl_model->grafico();

        if ($lgrafico->num_rows() > 0) {
            $grafico = $lgrafico->result();
        } else {
            $grafico = array();
        }

        echo json_encode($grafico);

    }

    public function grafficReportPorcentaje()
    {

        $this->load->model("TableroControl_model");
        $anio = $this->input->post("anio");
        $IdActividadPOI = $this->input->post("cboActividadPOI");

        $this->TableroControl_model->setId_Actividad_POI($IdActividadPOI);
        $this->TableroControl_model->setAnio_Ejecucion($anio);
        $lgrafico = $this->TableroControl_model->graficoPorcentaje();

        if ($lgrafico->num_rows() > 0) {
            $grafico = $lgrafico->result();
        } else {
            $grafico = array();
        }

        echo json_encode($grafico);

    }

    public function grafficReportMensual()
    {

        $this->load->model("TableroControl_model");
        $anio = $this->input->post("anio");
        $IdActividadPOI = $this->input->post("cboActividadPOI");

        $this->TableroControl_model->setId_Actividad_POI($IdActividadPOI);
        $this->TableroControl_model->setAnio_Ejecucion($anio);

        $lgrafico1 = $this->TableroControl_model->graficoPorcentajeSemestral1();
        $lgrafico2 = $this->TableroControl_model->graficoPorcentajeSemestral2();

        ($lgrafico1->num_rows() > 0) ? $grafico1 = $lgrafico1->result() : $grafico1 = array();
        ($lgrafico2->num_rows() > 0) ? $grafico2 = $lgrafico2->result() : $grafico2 = array();

        $graficos = array("grafico1" => $grafico1, "grafico2" => $grafico2);

        echo json_encode($graficos);

    }

    public function cargarActividadPoiAnio()
    {

        $this->load->model("Proceso_model");

        $Anio_Ejecucion = $this->input->post("anio");

        $data = array();

        $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
        $rsLista = $this->Proceso_model->proceso();

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->result();
        }

        echo json_encode($data);

    }

    public function cargarActividadPorArea()
    {

        $this->load->model("Proceso_model");

        $Anio_Ejecucion = $this->input->post("anio");
        $Area_Ejecucion = $this->input->post("area");

        $data = array();

        $this->Proceso_model->setCodigo_Area($Area_Ejecucion);
        $this->Proceso_model->setAnio_Ejecucion($Anio_Ejecucion);
        $rsLista = $this->Proceso_model->procesoArea();

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->result();
        }

        echo json_encode($data);

    }

    public function cargarUnidadMedida()
    {

        $this->load->model("UnidadMedida_model");
        $this->load->model("ProcesoIndicador_model");

        $Id_Actividad_POI = $this->input->post("Id_Actividad_POI");

        $data = array();

        $this->UnidadMedida_model->setId_Actividad_POI($Id_Actividad_POI);
        $rsLista = $this->UnidadMedida_model->listaIdActividadPOI();

        $this->ProcesoIndicador_model->setId($Id_Actividad_POI);
        $rs = $this->ProcesoIndicador_model->indicadorPOI();

        $indicador = "NO ASIGNADO";
        if ($rs->num_rows() > 0) {
            $row = $rs->row();
            $indicador = $row->Nombre_Indicador;
        }

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->row();
        }

        echo json_encode(array("data" => $data, "indicador" => $indicador));

    }

    public function registrar()
    {
        $this->load->model("TableroControl_model");
        $this->load->model("Notificacion_model");
        $Nombre_Area = $this->input->post("Nombre_Area");
        $Nombre_Actividad_POI = $this->input->post("Nombre_Actividad_POI");
        $Nombre_Medida = $this->input->post("Nombre_Medida");
        $Nombre_Indicador = $this->input->post("Nombre_Indicador");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Area = $this->input->post("Codigo_Area");
        $Id_Actividad_POI = $this->input->post("Id_Actividad_POI");
        $cantidad = $this->input->post("cantidad");
        $codigo_mes = $this->input->post("codigo_mes");
        $indicador = $this->input->post("indicador");
        $costo = $this->input->post("costo");

        $Nombre_Archivo = $this->input->post("Nombre_Archivo");
        $Numero_Documento = $this->input->post("Numero_Documento");
        $Observaciones = $this->input->post("Observaciones");
        $Logro = $this->input->post("Logro");
        $nombreProyecto = $this->input->post("nombreProyecto");
        $proyecto = $this->input->post("proyecto");

        $archivo = false;

        $Codigo_Usuario = $this->session->userdata("idusuario");

        $this->TableroControl_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->TableroControl_model->setCodigo_Area($Codigo_Area);
        $this->TableroControl_model->setId_Actividad_POI($Id_Actividad_POI);
        $this->TableroControl_model->setCodigo_Usuario($Codigo_Usuario);
        $this->TableroControl_model->setCantidad($cantidad);
        $this->TableroControl_model->setCodigo_mes($codigo_mes);
        $this->TableroControl_model->setActivo("1");
        $this->TableroControl_model->setCosto($costo);
        $this->TableroControl_model->setNombre_Archivo($Nombre_Archivo);
        $this->TableroControl_model->setNumero_Documento($Numero_Documento);
        $this->TableroControl_model->setObservaciones($Observaciones);
        $this->TableroControl_model->setLogro($Logro);

        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            $archivo = $this->cargarArchivoTableroControl($_FILES["file"], false, 0);
        }

        if ($archivo == false) {
            $archivo = "";
        }

        $this->TableroControl_model->setArchivo($archivo);
        $generateId = $this->TableroControl_model->insertar();
        if ($generateId > 0) {
            $this->session->set_flashdata('mensajeSuccess', 'Información registrado con exito');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo registrar la información.');
        }


        $msg = array
            (
            'message' => 'here is a message. message',
            'title' => "SE HA REGISTRADO UN NUEVO INFORME EN EL TABLERO DE CONTROL - ÁREA: {$Nombre_Area}",
            'subtitle' => 'This is a subtitle. subtitle',
            'body' => "AVISO DEL TABLERO DE CONTROL N° {$generateId}",
        );

        $data = array
            (
            '1-Año_Ejecucion' => $Anio_Ejecucion,
            '2-Area_o_Unidad_Operativa' => $Nombre_Area,
            '3-Actividad_POI' => $Nombre_Actividad_POI,
            '4-Unidad_de_Medida' => $Nombre_Medida,
            '5-Indicador' => $Nombre_Indicador,
            '6-Producto'  => "{$proyecto} - {$nombreProyecto}",
            '7-Logro_Obtenido' => $Logro,
            'notification' => $msg,
        );


        $this->Notificacion_model->setData($data);
        $this->Notificacion_model->setMensaje($msg);
        $this->Notificacion_model->setColor("#cc3300");
        $this->Notificacion_model->setTopic("sireedTablero");
        $this->Notificacion_model->enviarNotificacion();

        header("location:" . base_url() . "tablero/gestionar");

    }

    public function cargarArchivoTableroControl($file, $update, $id)
    {
        $path = getenv('PATH_DOC_TABLERO');

        if (filesize($file["tmp_name"]) > 0) {

            $name = "tablero_" . date("Ymdhis");
            $data = $_FILES["file"]['name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $fullName = $name . '.' . $ext;

            $allowedMimeTypes = array("pdf", "doc", "docx", "PDF", "DOC", "DOCX");

            if (in_array($ext, $allowedMimeTypes)) {

                if (copy($_FILES["file"]["tmp_name"], $path . $fullName)) {

                    if ($update) {
                        $file = $this->fileName($id);
                        $this->deleteFile($file);
                    }

                    return $fullName;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    private function fileName($id)
    {
        $this->load->model("TableroControl_model");
        $this->TableroControl_model->setId($id);
        $rs = $this->TableroControl_model->archivoTableroControl();
        $file = "";
        if ($rs->num_rows() > 0) {
            $archivo = $rs->row();
            $file = $archivo->Archivo;
        }

        return $file;
    }

    private function deleteFile($file)
    {
        $path = getenv('PATH_DOC_TABLERO');
        if (strlen($file) > 0) {
            unlink($path . $file);
        }

    }

    public function actualizar()
    {
        $this->load->model("TableroControl_model");

        $id = $this->input->post("id");
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Area = $this->input->post("Codigo_Area");
        $Id_Actividad_POI = $this->input->post("Id_Actividad_POI");
        $cantidad = $this->input->post("cantidad");
        $codigo_mes = $this->input->post("codigo_mes");
        $costo = $this->input->post("costo");

        $Nombre_Archivo = $this->input->post("Nombre_Archivo");
        $Numero_Documento = $this->input->post("Numero_Documento");
        $Observaciones = $this->input->post("Observaciones");
        $Logro = $this->input->post("Logro");

        $archivo = false;

        $Codigo_Usuario = $this->session->userdata("idusuario");

        $this->TableroControl_model->setAnio_Ejecucion($Anio_Ejecucion);
        $this->TableroControl_model->setCodigo_Area($Codigo_Area);
        $this->TableroControl_model->setId_Actividad_POI($Id_Actividad_POI);
        $this->TableroControl_model->setCodigo_Usuario($Codigo_Usuario);
        $this->TableroControl_model->setCantidad($cantidad);
        $this->TableroControl_model->setCodigo_mes($codigo_mes);
        $this->TableroControl_model->setActivo("1");
        $this->TableroControl_model->setCosto($costo);
        $this->TableroControl_model->setNombre_Archivo($Nombre_Archivo);
        $this->TableroControl_model->setNumero_Documento($Numero_Documento);
        $this->TableroControl_model->setObservaciones($Observaciones);
        $this->TableroControl_model->setLogro($Logro);

        $this->TableroControl_model->setId($id);

        $archivo = "";
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            $archivo = $this->cargarArchivoTableroControl($_FILES["file"], true, $id);
        }

        if ($archivo == false) {
            $archivo = "";
        }

        if (strlen($archivo) > 1) {
            $this->TableroControl_model->setArchivo($archivo);
            $this->TableroControl_model->actualizarArchivo();
        }

        if ($this->TableroControl_model->actualizar() == 1) {
            $this->session->set_flashdata('mensajeSuccess', 'Registro actualizado con exito');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo actualizar el Registro');
        }

        header("location:" . base_url() . "tablero/gestionar");
    }

    public function eliminar()
    {
        $this->load->model("TableroControl_model");

        $id = $this->input->post("id");

        $this->TableroControl_model->setId($id);
        $file = $this->fileName($id);
        if ($this->TableroControl_model->eliminar() == 1) {
            $this->deleteFile($file);
            $this->session->set_flashdata('mensajeWarning', 'Registro eliminado con exito');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo eliminar el Registro');
        }

        header("location:" . base_url() . "tablero/gestionar");
    }

    public function desactivar()
    {
        $this->load->model("TableroControl_model");

        $id = $this->input->post("id");

        $Codigo_Usuario = $this->session->userdata("idusuario");

        $this->TableroControl_model->setId($id);
        $this->TableroControl_model->setCodigo_Usuario($Codigo_Usuario);

        if ($this->TableroControl_model->desactivar() == 1) {
            $this->session->set_flashdata('mensajeSuccess', 'Registro desactivado con exito');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo desactivar el Registro');
        }

        header("location:" . base_url() . "tablero/gestionar");
    }

    public function activar()
    {
        $this->load->model("TableroControl_model");

        $id = $this->input->post("id");

        $Codigo_Usuario = $this->session->userdata("idusuario");

        $this->TableroControl_model->setId($id);
        $this->TableroControl_model->setCodigo_Usuario($Codigo_Usuario);

        if ($this->TableroControl_model->activar() == 1) {
            $this->session->set_flashdata('mensajeSuccess', 'Registro activado con exito');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo activar el Registro');
        }

        header("location:" . base_url() . "tablero/gestionar");
    }

    public function filterAreaByYear()
    {

        $this->load->model("Area_model");

        $year = $this->input->post("year");
        $this->Area_model->setAnio($year);
        $rsListaAreas = $this->Area_model->listaAreasByUser2();
        echo json_encode(array("areas" => $rsListaAreas->result()));

    }

}
