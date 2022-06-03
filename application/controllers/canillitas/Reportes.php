<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reportes extends CI_Controller
{

    private $permisos = null;

    public function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");

        (strlen($token) > 0) ? $token = JWT::decode($token, getenv("SECRET_SERVER_KEY"), false) : redirect("login");

        $this->session->set_userdata("idmodulo", 1);

        ($this->session->userdata("idusuario")) ? $usuario = $this->session->userdata("idusuario") : redirect("login");

        if (sha1($usuario) == $token->usuario) {

            if (count($token->modulos) > 0) {

                $listaModulos = $token->modulos;

                $permanecer = false;

                foreach ($listaModulos as $row):
                    if ($row->idmodulo == 1 and $row->estado == 1) {
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

    public function index()
    {

        $nivel = 2;
        $menu = 2;
        validarPermisos($nivel, $menu, $this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AlertaPronostico_model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "listaralerta" => $listaralerta,
        );

        $this->load->view("eventos/reporte", $data);
    }

    public function cargarListaEventos()
    {
        $departamentos = $this->input->post("departamentos");
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        $nivel = $this->input->post("nivel");
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");

        $data = array();
        $result = array(
            "data" => $data,
            "vacio" => 0,
        );

        if (empty($departamentos)) {
            echo json_encode($result);
        } else {

            $this->load->model("EventoRegistrar_model");

            $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
            $this->EventoRegistrar_model->setEvento($evento);
            $this->EventoRegistrar_model->setUbigeo($departamentos);
            $this->EventoRegistrar_model->setNivelEmergencia($nivel);

            $fD = explode(" ", $desde);
            $desde = formatearFechaParaBD($fD[0]);

            $fH = explode(" ", $hasta);
            $hasta = formatearFechaParaBD($fH[0]);

            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);

            $lista = $this->EventoRegistrar_model->listaEventos();

            $n = 1;

            foreach ($lista->result() as $row):

                $data[] = array(
                    "numero" => $n,
                    "fecha" => $row->fecha,
                    "hora" => $row->hora,
                    "departamento" => $row->departamento,
                    "provincia" => $row->provincia,
                    "distrito" => $row->distrito,
                    "lesionados" => $row->Evento_Lesionados,
                    "fallecidos" => $row->Evento_Fallecidos,
                    "desaparecidos" => $row->Evento_Desaparecidos,
                    "vafectadas" => $row->Evento_Viv_Afectadas,
                    "vinhabilitadas" => $row->Evento_Viv_Inhabitables,
                    "vcolapsadas" => $row->Evento_Viv_Colapsadas,
                    "afectadas" => $row->Evento_Per_Afectadas,
                    "damnificadas" => $row->Evento_Per_Damnificadas,
                );
                $n++;
            endforeach
            ;

            $result = array(
                "data" => $data,
            );

            echo json_encode($result);
        }
    }

    public function vulnerable()
    {

        $nivel = 1;
        $menu = 3;
        validarPermisos($nivel, $menu, $this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AlertaPronostico_model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "listaralerta" => $listaralerta,
        );

        $this->load->view("eventos/poblacionVulnerable", $data);
    }

    public function indicadorcoe()
    {

           $nivel = 1;
           $menu = 13;
           validarPermisos($nivel,$menu,$this->permisos);

        $this->load->model("AnioEjecucion_model");
        $this->load->model("Evento_model");
        $this->load->model("Area_model");
        $this->load->model("TableroControl_model");
        $this->load->model("TableroMes_model");
        $this->load->model("AlertaPronostico_model");

        $anio = $this->input->post("Anio");
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->Evento_model->setAnio_Ejecucion($anio);

        $lgrafico = $this->Evento_model->obtenerIndicadorCoe();
        $lgraficoPorcentual = $this->Evento_model->obtenerPorcentajeCoe();

        if ($lgrafico->num_rows() > 0) {
            $grafico = $lgrafico->result();
        } else {
            $grafico = array();
        }
        if ($lgraficoPorcentual->num_rows() > 0) {
            $graficoPorcentual = $lgraficoPorcentual->result();
        } else {
            $graficoPorcentual = array();
        }

        $data = array(
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "anio" => $anio,
            "grafico" => json_encode($grafico),
            "graficoPorcentual" => json_encode($graficoPorcentual),
        );

        $this->load->view("eventos/reporteIndicadorcoe", $data);
    }

    public function movimientoevento()
    {

           $nivel = 1;
           $menu = 13;
           validarPermisos($nivel,$menu,$this->permisos);

        $this->load->model("AnioEjecucion_model");
        $this->load->model("Evento_model");
        $this->load->model("Area_model");

        $anio = $this->input->post("Anio");
        $mes = $this->input->post("Mes");
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        if(empty($mes)) {
            $mesPredeterminado = $this->AnioEjecucion_model->obtenerMes();
            $mes = $mesPredeterminado->row()->resultado;
        }

        $this->Evento_model->setAnio_Ejecucion($anio);
        $this->Evento_model->setMes($mes);
        $this->Evento_model->setNivel("0");

        $nivelGrafico = $this->Evento_model->obtenerEventoPorNivel();
        $regionGrafico = $this->Evento_model->obtenerEventoPorRegion();
        $this->Evento_model->setNivel("01");
        $regionUnoGrafico = $this->Evento_model->obtenerEventoPorRegionNivel();
        $this->Evento_model->setNivel("02");
        $regionDosGrafico = $this->Evento_model->obtenerEventoPorRegionNivel();
        $this->Evento_model->setNivel("03");
        $regionTresGrafico = $this->Evento_model->obtenerEventoPorRegionNivel();
             
        if ($nivelGrafico->num_rows() > 0) {
            $nivelGrafico = $nivelGrafico->result();
        } else {
            $nivelGrafico = array();
        }
        if ($regionGrafico->num_rows() > 0) {
            $regionGrafico = $regionGrafico->result();
        } else {
            $regionGrafico = array();
        }
        if ($regionUnoGrafico->num_rows() > 0) {
            $regionUnoGrafico = $regionUnoGrafico->result();
        } else {
            $regionUnoGrafico = array();
        }
        if ($regionDosGrafico->num_rows() > 0) {
            $regionDosGrafico = $regionDosGrafico->result();
        } else {
            $regionDosGrafico = array();
        }
        if ($regionTresGrafico->num_rows() > 0) {
            $regionTresGrafico = $regionTresGrafico->result();
        } else {
            $regionTresGrafico = array();
        }        

        $data = array(
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "anio" => $anio,
            "mes" => $mes,
            "nivelGrafico" => json_encode($nivelGrafico),
            "regionGrafico" => json_encode($regionGrafico),
            "regionUnoGrafico" => json_encode($regionUnoGrafico),
            "regionDosGrafico" => json_encode($regionDosGrafico),
            "regionTresGrafico" => json_encode($regionTresGrafico)
        );

        $this->load->view("eventos/reporteMovimientoEvento", $data);
    }

    public function movimientobrigadistas()
    {

        $nivel = 1;
        $menu = 13;
        validarPermisos($nivel,$menu,$this->permisos);

        $this->load->model("AnioEjecucion_model");
        $this->load->model("Evento_model");
        $this->load->model("Area_model");

        $anio = $this->input->post("Anio");
        $mes = $this->input->post("Mes");
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        if(empty($mes)) {
            $mesPredeterminado = $this->AnioEjecucion_model->obtenerMes();
            $mes = $mesPredeterminado->row()->resultado;
        }

        $this->Evento_model->setAnio_Ejecucion($anio);
        $this->Evento_model->setMes($mes);

        $lgrafico = $this->Evento_model->obtenerBrigadistasNacional();
        $lgraficoPorcentual = $this->Evento_model->obtenerBrigadistasMinsa();
        $lgraficoPorcentualDos = $this->Evento_model->obtenerBrigadistasRegional();

        if ($lgrafico->num_rows() > 0) {
            $grafico = $lgrafico->result();
        } else {
            $grafico = array();
        }
        if ($lgraficoPorcentual->num_rows() > 0) {
            $graficoPorcentual = $lgraficoPorcentual->result();
        } else {
            $graficoPorcentual = array();
        }

        if ($lgraficoPorcentual->num_rows() > 0) {
            $graficoPorcentualDos = $lgraficoPorcentualDos->result();
        } else {
            $graficoPorcentualDos = array();
        }
                

        $data = array(
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "anio" => $anio,
            "mes" => $mes,
            "grafico" => json_encode($grafico),
            "graficoRegion" => json_encode($graficoPorcentual),
            "graficoRegionDos" => json_encode($graficoPorcentualDos)
        );

        $this->load->view("eventos/reporteBrigadistas", $data);
    }

    public function asociado()
    {

           $nivel = 1;
           $menu = 13;
           validarPermisos($nivel,$menu,$this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
    
        $listaAsociado = $this->EventoTipo_model->listaAsociado();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();

        $data = array(
            "nivel" => $nivel->result(),
            "listaAsociado" => $listaAsociado->result()
        );


        $this->load->view("eventos/reporteAsociado", $data);
    }

    public function cargarListaEventosVulnerable()
    {
        $departamentos = $this->input->post("departamentos");
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        $nivel = $this->input->post("nivel");
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");

        $data = array();
        $result = array(
            "data" => $data,
            "vacio" => 0,
        );

        if (empty($departamentos)) {
            echo json_encode($result);
        } else {

            $this->load->model("EventoRegistrar_model");

            $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
            $this->EventoRegistrar_model->setEvento($evento);
            $this->EventoRegistrar_model->setUbigeo($departamentos);
            $this->EventoRegistrar_model->setNivelEmergencia($nivel);

            $fD = explode(" ", $desde);
            $desde = formatearFechaParaBD($fD[0]);

            $fH = explode(" ", $hasta);
            $hasta = formatearFechaParaBD($fH[0]);

            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);

            $lista = $this->EventoRegistrar_model->listaEventosVulnerable();

            $n = 1;

            foreach ($lista->result() as $row):

                $data[] = array(
                    "numero" => $n,
                    "fecha" => $row->fecha,
                    "hora" => $row->hora,
                    "departamento" => $row->departamento,
                    "provincia" => $row->provincia,
                    "distrito" => $row->distrito,
                    "mujeres" => $row->mujeres,
                    "gestantes" => $row->gestantes,
                    "menor_edad" => $row->menor_edad,
                    "adulto_mayor" => $row->adulto_mayor,
                );
                $n++;
            endforeach
            ;

            $result = array(
                "data" => $data,
            );

            echo json_encode($result);
        }
    }

    public function cargarListaEventosCoordenadas()
    {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("AlertaPronostico_model");

        $departamentos = $this->input->post("departamentos");
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        $nivel = $this->input->post("nivel");
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");

        $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
        $this->EventoRegistrar_model->setEvento($evento);
        $this->EventoRegistrar_model->setUbigeo($departamentos);
        $this->EventoRegistrar_model->setNivelEmergencia($nivel);

        $fD = explode(" ", $desde);
        $desde = formatearFechaParaBD($fD[0]);

        $fH = explode(" ", $hasta);
        $hasta = formatearFechaParaBD($fH[0]);

        $this->EventoRegistrar_model->setFechaInicio($desde);
        $this->EventoRegistrar_model->setFechaFin($hasta);
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $lista = $this->EventoRegistrar_model->listaEventosMapa();

        $data = array();
        foreach ($lista->result() as $row):

            $data[] = array(
                "Evento_Descripcion" => str_replace("\\r\\n", "<br />", $row->Evento_Descripcion),
                "Evento_Latitud" => $row->Evento_Latitud,
                "Evento_Longitud" => $row->Evento_Longitud,
                "departamento" => $row->departamento,
                "provincia" => $row->provincia,
                "distrito" => $row->distrito,
                "fecha" => $row->fecha,
                "listaralerta" => $listaralerta,
            );
        endforeach
        ;

        echo json_encode(array(
            "lista" => $data,
        ));
    }

    public function mapa()
    {
        $nivel = 2;
        $menu = 10;

        validarPermisos($nivel, $menu, $this->permisos);
        $this->load->model("AlertaPronostico_model");
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $data = array("listaralerta" => $listaralerta);
        $this->load->view("eventos/mapa", $data);
    }

    public function dataMapaAjax()
    {

        $this->load->model("EventoRegistrar_model");
        $this->load->model("AlertaPronostico_model");

        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");
        $departamento = $this->input->post("departamento");
        $tipo = $this->input->post("tipo");
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        if (strlen($desde) == 0) {
            $desde = date("Y-m-d");
        } else {
            $desde = formatearFechaParaBD($desde);
        }

        if (strlen($hasta) == 0) {
            $hasta = date("Y-m-d");
        } else {
            $hasta = formatearFechaParaBD($hasta);
        }

        $lista = array();
        if ($tipo == 1) {
            $this->EventoRegistrar_model->setUbigeo($departamento);
            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);
            $lista = $this->EventoRegistrar_model->listaEventosMapaDepartamento();
            $lista = $lista->result();
            $data = array("listaralerta" => $listaralerta);
        } else if ($tipo == 2) {
            $this->EventoRegistrar_model->setUbigeo($departamento);
            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);
            $lista = $this->EventoRegistrar_model->listaEventosMapaVulnerable();
            $lista = $lista->result();
            $data = array("listaralerta" => $listaralerta);
        } else if ($tipo == 3) {
            $this->EventoRegistrar_model->setUbigeo($departamento);
            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);
            $lista = $this->EventoRegistrar_model->listaEventosMapaEESS();
            $lista = $lista->result();
            $data = array("listaralerta" => $listaralerta);
        } else if ($tipo == 4) {
            $this->EventoRegistrar_model->setUbigeo($departamento);
            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);
            $lista = $this->EventoRegistrar_model->listaEventosMapaRecursos();
            $lista = $lista->result();
            $data = array("listaralerta" => $listaralerta);
        } else if ($tipo == 5) {
            $this->EventoRegistrar_model->setUbigeo($departamento);
            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);
            $lista = $this->EventoRegistrar_model->listaEventosMapaCIE10();
            $lista = $lista->result();
            $data = array("listaralerta" => $listaralerta);
        } else if ($tipo == 6) {
            $this->EventoRegistrar_model->setUbigeo($departamento);
            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);
            $lista = $this->EventoRegistrar_model->listaEventosRegion();
            $lista = $lista->result();
            $data = array("listaralerta" => $listaralerta);
        }
        echo json_encode($lista);

    }

    public function reporteEventos()
    {

        $nivel = 1;
        $menu = 3;
        validarPermisos($nivel, $menu, $this->permisos);

        $this->load->model("EventoRegistrar_model");
        $this->load->model("AlertaPronostico_model");

        $lista = $this->EventoRegistrar_model->listaDiferenciaEventosUsuario();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array("lista" => $lista, "listaralerta" => $listaralerta);

        $this->load->view("eventos/diferenciaEventosUsuario", $data);

    }

    public function listaDiferenciaEventosUsuarioAjax()
    {

        $this->load->model("EventoRegistrar_model");

        $usuario = $this->input->post("idusuario");

        $data = array();

        if (empty($usuario) || strlen($usuario) < 1) {
            echo json_encode(array("data" => $data));
        } else {

            $this->EventoRegistrar_model->setBusqueda($usuario);
            $lista = $this->EventoRegistrar_model->listaDiferenciaEventosUsuarioEventos();

            foreach ($lista->result() as $row):

                $rango = "Fuera de rango";
                if ($row->diferencia < 0) {
                    $horas = "Fecha incorrecta";
                } else {
                    $tiempo = seg_a_dhms($row->diferencia);
                    $horas = $tiempo["horas"];
                    if ($horas < 3) {
                        $rango = "Dentro de rango";
                    }

                }

                $data[] = array(
                    "eventoDetalle" => $row->evento,
                    "fecha_registro" => $row->fechaRegistro,
                    "fecha_evento" => $row->fecha,
                    "ubigeo" => $row->departamento . ', ' . $row->provincia . ', ' . $row->distrito,
                    "diferencia" => $horas,
                    "rango" => $rango,
                );

            endforeach;

            echo json_encode(array("data" => $data));
        }

    }

    public function mapaEventosMonitoreo()
    {

        $nivel = 1;
        $menu = 3;

        validarPermisos($nivel,$menu,$this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
        );

        $this->load->view("eventos/mapaEventosMonitoreo", $data);

    }

    public function mapaEventosCerrado()
    {

         $nivel = 1;
         $menu = 3;

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
        );
        $this->load->view("eventos/mapaEventosCerrado", $data);

    }

    public function mapaAcciones()
    {

        $nivel = 1;
        $menu = 3;

        validarPermisos($nivel, $menu, $this->permisos);

        $this->load->model("EventoAcciones_model");
        $this->load->model("AlertaPronostico_model");

        $mapaAcciones = $this->EventoAcciones_model->mapaAcciones();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array("cantidad" => $mapaAcciones->num_rows(), "registros" => json_encode($mapaAcciones->result()), "listaralerta" => $listaralerta);

        $this->load->view("eventos/mapaAcciones", $data);

    }

    public function infoWindowEventos()
    {

        $this->load->model("EventoRegistrar_model");
        $this->load->model("EventoAcciones_model");

        $id = $this->input->post("id");
        $estado = $this->input->post("estado");
        $this->EventoAcciones_model->setEvento_Registro_Numero($id);
        $this->EventoRegistrar_model->setId($id);
        $this->EventoRegistrar_model->setEstado($estado);

        $lista = $this->EventoRegistrar_model->infoWindow();
        $dataInforme = encriptarInforme($id, "ASC") . "|" . encriptarInforme($id, "DESC");
        $data = $lista->row();
        $datad = array();
        $listaAcciones = $this->EventoAcciones_model->mapaAccionesDetalle();

        foreach ($listaAcciones->result() as $row):
            $datad[] = array(
                "Tipo_Accion_Descripcion" => $row->Tipo_Accion_Descripcion,
                "Tipo_Accion_Entidad_Nombre" => $row->Tipo_Accion_Entidad_Nombre,
                "Evento_Acciones_Numero" => $row->Evento_Acciones_Numero,
                "Evento_Acciones_Descripcion" => $row->Evento_Acciones_Descripcion,
                "Evento_Acciones_Fecha" => $row->Evento_Acciones_Fecha,
                "brigadistas" => $row->brigadistas,
                "EMT" => $row->EMT,
                "PersonalSalud" => $row->PersonalSalud,
                "ambulancias" => $row->ambulancias,
                "medicamentos" => $row->medicamentos,
            );
        endforeach;

        $test = array(
            "Informe" => $dataInforme,
            "eventoTipo" => $data->eventoTipo,
            "evento" => $data->evento,
            "eventoDetalle" => $data->eventoDetalle,
            "fecha" => $data->fecha,
            "Evento_Secuencia" => $data->Evento_Secuencia,
            "Evento_Tipo_Codigo" => $data->Evento_Tipo_Codigo,
            "Evento_Descripcion" => $data->Evento_Descripcion,
            "Evento_Lesionados" => $data->Evento_Lesionados,
            "Evento_Fallecidos" => $data->Evento_Fallecidos,
            "Evento_Desaparecidos" => $data->Evento_Desaparecidos,
            "Evento_Viv_Inhabitables" => $data->Evento_Viv_Inhabitables,
            "Evento_Viv_Colapsadas" => $data->Evento_Viv_Colapsadas,
            "Evento_Ubigeo_Descripcion" => $data->Evento_Ubigeo_Descripcion,
            "Evento_Fuente_Descripcion" => $data->Evento_Fuente_Descripcion,
            "Evento_Nivel_Nombre" => $data->Evento_Nivel_Nombre,
            "ListaAcciones" => $datad,
        );

        echo json_encode($test);
    }

    public function mapaAccionesDetalle()

    {

        $this->load->model("EventoAcciones_model");
        $this->load->model("AlertaPronostico_model");

        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");

        $data = array();
        $length = 0;
        if (strlen($Evento_Registro_Numero) > 0) {
            $this->EventoAcciones_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $lista = $this->EventoAcciones_model->mapaAccionesDetalle();
            $listaralerta = $this->AlertaPronostico_model->listaralerta();

            foreach ($lista->result() as $row):

                $data[] = array(
                    "Tipo_Accion_Descripcion" => $row->Tipo_Accion_Descripcion,
                    "Tipo_Accion_Entidad_Nombre" => $row->Tipo_Accion_Entidad_Nombre,
                    "Evento_Acciones_Numero" => $row->Evento_Acciones_Numero,
                    "Evento_Acciones_Descripcion" => $row->Evento_Acciones_Descripcion,
                    "Evento_Acciones_Fecha" => $row->Evento_Acciones_Fecha,
                    "brigadistas" => $row->brigadistas,
                    "EMT" => $row->EMT,
                    "PersonalSalud" => $row->PersonalSalud,
                    "ambulancias" => $row->ambulancias,
                    "medicamentos" => $row->medicamentos,
                    "listaralerta" => $listaralerta,
                );

            endforeach;
        }

        $datos = array(
            "data" => $data,
        );

        echo json_encode($datos);

    }

    public function mapaIpress()
    {

         $nivel = 1;
         $menu = 3;

         validarPermisos($nivel,$menu,$this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
        );

        $this->load->view("eventos/mapaEventosIpress", $data);

    }

    public function buscarMapaIpress()
    {

        $nivel = 2;
        $menu = 10;

        validarPermisos($nivel, $menu, $this->permisos);

        $this->load->model("EventoEntidadSalud_model");
        $this->load->model("AlertaPronostico_model");

        $mapaIpress = $this->EventoEntidadSalud_model->mapaIpress();
        $result = $mapaIpress->result();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $datos = array();
        $n = 0;
        foreach ($result as $row):
            if (strlen($row->latitud) < 1) {$datos[] = $row;
                $n++;}

        endforeach;

        $data = array("cantidad" => $mapaIpress->num_rows(), "registros" => json_encode($result), "data" => $datos, "n" => $n, "listaralerta" => $listaralerta);

        $this->load->view("eventos/mapaEventosIpress", $data);

    }

    public function mapaIpressDetalle()
    {

        $this->load->model("EventoEntidadSalud_model");

        $id = $this->input->post("id");

        $data = array();
        $length = 0;
        if (strlen($id) > 0) {
            $this->EventoEntidadSalud_model->setId($id);
            $lista = $this->EventoEntidadSalud_model->mapaIpressDetalle();

            foreach ($lista->result() as $row):

                $data[] = array(
                    "fecha" => $row->fecha,
                    "Evento_Entidad_Estado" => $row->Evento_Entidad_Estado,
                    "CodEESS" => $row->CodEESS,
                    "agua" => $row->agua,
                    "desague" => $row->desague,
                    "energia_electrica" => $row->energia_electrica,
                    "conectividad" => $row->conectividad,
                    "radio" => $row->radio,
                    "fija" => $row->fija,
                    "celular" => $row->celular,
                    "internet" => $row->internet,
                    "techos" => $row->techos,
                    "paredes" => $row->paredes,
                    "pisos" => $row->pisos,
                    "cercos" => $row->cercos,
                    "otros_lugares" => $row->otros_lugares,
                    "inundacion" => $row->inundacion,
                    "colapso" => $row->colapso,
                    "caida" => $row->caida,
                    "goteras" => $row->goteras,
                    "fisuras" => $row->fisuras,
                    "otros_consecuencias" => $row->otros_consecuencias,
                    "emergencia" => $row->emergencia,
                    "banco" => $row->banco,
                    "obstetrico" => $row->obstetrico,
                    "quirurgico" => $row->quirurgico,
                    "uci" => $row->uci,
                    "diagnostico" => $row->diagnostico,
                    "esterilizacion" => $row->esterilizacion,
                    "laboratorio" => $row->laboratorio,
                    "ambulancias" => $row->ambulancias,
                    "farmacia" => $row->farmacia,
                    "consultorios" => $row->consultorios,
                    "otros" => $row->otros,
                    "recuperacion_operatividad" => $row->recuperacion_operatividad,
                    "continuidad_operativa" => $row->continuidad_operativa,
                    "lugar" => $row->lugar,
                );

            endforeach;
        }

        $datos = array(
            "data" => $data,
        );

        echo json_encode($datos);

    }

    public function consolidado()
    {

        $nivel = 1;
        $menu = 3;
        validarPermisos($nivel, $menu, $this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AlertaPronostico_model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "listaralerta" => $listaralerta,
        );

        $this->load->view("eventos/reporteConsolidado", $data);
    }

    public function consolidadoNacional()
    {

        $nivel = 1;
        $menu = 3;
        validarPermisos($nivel, $menu, $this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AlertaPronostico_model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "listaralerta" => $listaralerta,
        );

        $this->load->view("eventos/reporteNacional", $data);
    }

    public function consolidadoIPRESS()
    {

        $nivel = 1;
        $menu = 3;
        validarPermisos($nivel, $menu, $this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AlertaPronostico_model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "listaralerta" => $listaralerta,
        );

        $this->load->view("eventos/reporteIPRESS", $data);
    }

    public function listaEventosConsolidado()
    {
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        $detalle = $this->input->post("detalle");
        $nivel = $this->input->post("nivel");
        $eventoConsolidado = $this->input->post("eventoConsolidado");
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");
        $activar = $this->input->post("activar");

        $data = array();
        $result = array(
            "data" => $data,
            "vacio" => 0,
        );

        if ($activar < 1) {
            echo json_encode($result);
        } else {

            $this->load->model("EventoRegistrar_model");
            $this->load->model("EventoNivel_model");

            $eventoNivel = $this->EventoNivel_model->lista();
            $eventoNivel = $eventoNivel->result();

            $ubigeo = [$departamento, $provincia, $distrito];
            $this->EventoRegistrar_model->setUbigeo($ubigeo);

            $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
            $this->EventoRegistrar_model->setEvento($evento);
            $this->EventoRegistrar_model->setdetalle($detalle);
            $this->EventoRegistrar_model->setNivelEmergencia($nivel);
            $this->EventoRegistrar_model->setEventoConsolidado($eventoConsolidado);

            $fD = explode(" ", $desde);
            $desde = formatearFechaParaBD($fD[0]);

            $fH = explode(" ", $hasta);
            $hasta = formatearFechaParaBD($fH[0]);

            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);

            $lista = $this->EventoRegistrar_model->listaEventosGlobal();

            $n = 1;

            foreach ($lista->result() as $row):

                $totalLesionados = $row->total_lesionados;
                $totalEntidades = $row->total_entidades;

                $totalLesionados = explode("|", $totalLesionados);
                $totalEntidades = explode("|", $totalEntidades);

                $status = '<span class="label label-danger">Anulado</span>';
                $estado = "Anulado";
                switch ($row->Evento_Estado_Codigo) {
                    case 1:$status = '<span class="label label-success">Monitoreo</span>';
                        $estado = "Monitoreo";
                        break;
                    case 2:$status = '<span class="label label-default">Cerrado</span>';
                        $estado = "Cerrado";
                        break;
                }

                $tiempo = seg_a_dhms($row->diferencia);
                $horas = $tiempo["horas"];

                $dataInforme = encriptarInforme($row->Evento_Registro_Numero, "ASC") . "|" . encriptarInforme($row->Evento_Registro_Numero, "DESC");

                $data[] = array(
                    "numero" => $row->ANIO . " - " . addCeros5($row->Evento_Secuencia),
                    "fecha" => $row->fecha,
                    "hora" => $row->hora,
                    "evento" => $row->evento,
                    "detalle" => $row->detalle,
                    "hora2" => ($horas < 3) ? "S&iacute;" : "No",
                    "hora6" => ($horas < 7) ? "S&iacute;" : "No",
                    "fechaRegistro" => $row->fechaRegistro,
                    "horaRegistro" => $row->horaRegistro,
                    "departamento" => $row->departamento,
                    "provincia" => $row->provincia,
                    "distrito" => $row->distrito,
                    "latitud" => $row->Evento_Latitud,
                    "longitud" => $row->Evento_Longitud,
                    "nivel" => $this->buscarNivel($eventoNivel, $row->Evento_Nivel_Codigo),
                    "usuario" => $row->Usuario,
                    "cantidadAcciones" => $row->Cantidad_Acciones,
                    "lesionados" => $totalLesionados[0],
                    "fallecidos" => $totalLesionados[1],
                    "desaparecidos" => $totalLesionados[2],
                    "esoperativas" => $totalEntidades[0],
                    "esinoperativas" => $totalEntidades[1],
                    "status" => $status,
                    "estado" => $estado,
                    "EA_Celula_Especializada" => $row->EA_Celula_Especializada,
                    "brigadista_region" => $row->brigadista_region,
                    "brigadista_minsa" => $row->brigadista_minsa,
                    "brigadista_rescatista" => $row->brigadista_rescatista,
                    "brigadista_tactico" => $row->brigadista_tactico,
                    "emt_i" => $row->emt_i,
                    "emt_ii" => $row->emt_ii,
                    "emt_iii" => $row->emt_iii,
                    "MI_Oferta_Movil_i" => $row->MI_Oferta_Movil_i,
                    "MI_Oferta_Movil_ii" => $row->MI_Oferta_Movil_ii,
                    "MI_Oferta_Movil_iii" => $row->MI_Oferta_Movil_iii,
                    "MI_Hospital_Modular" => $row->MI_Hospital_Modular,
                    "MI_Banio_Quimico_Portatil" => $row->MI_Banio_Quimico_Portatil,
                    "PS_Minsa_Samu" => $row->PS_Minsa_Samu,
                    "PS_Salud_Minsa" => $row->PS_Salud_Minsa,
                    "PS_Essalud" => $row->PS_Essalud,
                    "PS_Municipalidades_Gores" => $row->PS_Municipalidades_Gores,
                    "PS_Voluntarios" => $row->PS_Voluntarios,
                    "PS_PNP_FFAA" => $row->PS_PNP_FFAA,
                    "A_Minsa_Samu" => $row->A_Minsa_Samu,
                    "A_Minsa" => $row->A_Minsa,
                    "A_Essalud" => $row->A_Essalud,
                    "A_Bomberos" => $row->A_Bomberos,
                    "A_Municipalidades_Gores" => $row->A_Municipalidades_Gores,
                    "A_PNP_FFAA" => $row->A_PNP_FFAA,
                    "A_Privadas" => $row->A_Privadas,
                    "Acciones_Descripcion" => str_replace("\\r\\n", "<br />", $row->Acciones_Descripcion),
                    "pdf" => '<span class="exportar" rel="' . $dataInforme . '"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>',
                );
                $n++;
            endforeach
            ;

            $result = array(
                "data" => $data,
            );

            echo json_encode($result);
        }
    }

    public function listaEventosConsolidadoIPRESS()
    {
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        $detalle = $this->input->post("detalle");
        $nivel = $this->input->post("nivel");
        $eventoConsolidado = $this->input->post("eventoConsolidado");
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");
        $activar = $this->input->post("activar");

        $data = array();
        $result = array(
            "data" => $data,
            "vacio" => 0,
        );

        if ($activar < 1) {
            echo json_encode($result);
        } else {

            $this->load->model("EventoRegistrar_model");
            $this->load->model("EventoNivel_model");

            $eventoNivel = $this->EventoNivel_model->lista();
            $eventoNivel = $eventoNivel->result();

            $ubigeo = [$departamento, $provincia, $distrito];
            $this->EventoRegistrar_model->setUbigeo($ubigeo);

            $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
            $this->EventoRegistrar_model->setEvento($evento);
            $this->EventoRegistrar_model->setdetalle($detalle);
            $this->EventoRegistrar_model->setNivelEmergencia($nivel);
            $this->EventoRegistrar_model->setEventoConsolidado($eventoConsolidado);

            $fD = explode(" ", $desde);
            $desde = formatearFechaParaBD($fD[0]);

            $fH = explode(" ", $hasta);
            $hasta = formatearFechaParaBD($fH[0]);

            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);

            $lista = $this->EventoRegistrar_model->listaEventosIPRESS();

            $n = 1;

            foreach ($lista->result() as $row):
 
                $data[] = array(
                    "INSTITUCION" => $row->INSTITUCION,
                    "ESTADO" => $row->ESTADO,
                    "SIREED" => $row->SIREED,
                    "RENIPRESS" => $row->RENIPRESS,
                    "CATEGORIA" => $row->CATEGORIA,
                    "NOMBRE" => $row->NOMBRE,
                    "REGION" => $row->REGION,
                    "PROVINCIA" => $row->PROVINCIA,
                    "DISTRITO" => $row->DISTRITO,
                    "UBIGEO" => $row->UBIGEO,
                    "DESCRIPCION" => $row->DESCRIPCION,
                    "TIPO_EVENTO" => $row->TIPO_EVENTO,
                    "FECHA_HORA" => $row->FECHA_HORA,
                    "RECUPERACION_OPER" => $row->RECUPERACION_OPER,
                    "FECHA_INFORME" => $row->FECHA_INFORME,
                    "CONTINGENCIA" => $row->CONTINGENCIA,
                );
                $n++;
            endforeach
            ;

            $result = array(
                "data" => $data,
            );

            echo json_encode($result);
        }
    }

    public function listaEventosConsolidadoNacional()
    {
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        $detalle = $this->input->post("detalle");
        $nivel = $this->input->post("nivel");
        $eventoConsolidado = $this->input->post("eventoConsolidado");
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");
        $activar = $this->input->post("activar");

        $data = array();
        $result = array(
            "data" => $data,
            "vacio" => 0,
        );

        if ($activar < 1) {
            echo json_encode($result);
        } else {

            $this->load->model("EventoRegistrar_model");
            $this->load->model("EventoNivel_model");

            $eventoNivel = $this->EventoNivel_model->lista();
            $eventoNivel = $eventoNivel->result();

            $ubigeo = [$departamento, $provincia, $distrito];
            $this->EventoRegistrar_model->setUbigeo($ubigeo);

            $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
            $this->EventoRegistrar_model->setEvento($evento);
            $this->EventoRegistrar_model->setdetalle($detalle);
            $this->EventoRegistrar_model->setNivelEmergencia($nivel);
            $this->EventoRegistrar_model->setEventoConsolidado($eventoConsolidado);

            $fD = explode(" ", $desde);
            $desde = formatearFechaParaBD($fD[0]);

            $fH = explode(" ", $hasta);
            $hasta = formatearFechaParaBD($fH[0]);

            $this->EventoRegistrar_model->setFechaInicio($desde);
            $this->EventoRegistrar_model->setFechaFin($hasta);

            $lista = $this->EventoRegistrar_model->listaEventosNacional();

            $n = 1;

            foreach ($lista->result() as $row):

                $data[] = array(
                    "Region" => $row->Region,
                    "Provincia" => $row->Provincia,
                    "Distrito" => $row->Distrito,
                    "Lesionados_01" => $row->Lesionados_01,
                    "Fallecidos_01" => $row->Fallecidos_01,
                    "Desaparecidos_01" => $row->Desaparecidos_01,
                    "Lesionados_02" => $row->Lesionados_02,
                    "Fallecidos_02" => $row->Fallecidos_02,
                    "Desaparecidos_02" => $row->Desaparecidos_02,
                    "IPRESS_AO" => $row->IPRESS_AO,
                    "IPRESS_AI" => $row->IPRESS_AI,
                    "ESSALUD_A" => $row->ESSALUD_A,
                    "Acciones" => $row->Acciones,
                    "Brigadistas_Region" => $row->Brigadistas_Region,
                    "Brigadistas_Minsa" => $row->Brigadistas_Minsa,
                    "psPersonal_Saludalud" => $row->Personal_Salud,
                    "Oferta_Movil_I" => $row->Oferta_Movil_I,
                    "Oferta_Movil_II" => $row->Oferta_Movil_II,
                    "Oferta_Movil_III" => $row->Oferta_Movil_III,
                    "Kit_Medicamentos" => $row->Kit_Medicamentos,
                    "Mochila_Emergencia" => $row->Mochila_Emergencia,
                );
                $n++;
            endforeach
            ;

            $result = array(
                "data" => $data,
            );

            echo json_encode($result);
        }
    }

    private function buscarNivel($lista, $codigo)
    {

        $nombre = "";
        foreach ($lista as $row):
            if ($row->Evento_Nivel_Codigo == $codigo) {
                $nombre = $row->Evento_Nivel_Nombre;
            }
        endforeach;

        return $nombre;

    }

}
