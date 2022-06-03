<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller
{

    private $permisos = null;

    function __construct()
    {
        parent::__construct();
        
        $token = $this->session->userdata("token");
        
        (strlen($token) > 0) ? $token = JWT::decode($token, getenv("SECRET_SERVER_KEY")) : redirect("login");
        
        $this->session->set_userdata("idmodulo", 20);
        
        ($this->session->userdata("idusuario")) ? $usuario = $this->session->userdata("idusuario") : redirect("login");
        
        if (sha1($usuario) == $token->usuario) {
            
            if (count($token->modulos) > 0) {
                
                $listaModulos = $token->modulos;
                
                $permanecer = false;
                
                foreach ($listaModulos as $row) :
                    if ($row->idmodulo == 1 and $row->estado == 1)
                        $permanecer = true;
                endforeach
                ;
                
                if ($permanecer == false)
                    redirect('errores/accesoDenegado');
            } else {
                redirect("login");
            }
            
            if ($this->permisos == null) {
                if ($this->session->userdata("menu"))
                    $this->permisos = $this->session->userdata("menu");
            }
        } else {
            redirect("login");
        }
    }

    public function index()
    {
        $nivel = 1;
        $idmenu = 20;
        
        validarPermisos($nivel, $idmenu, $this->permisos);
        
        $anio = $this->input->post('anio');

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("TipoAccion_model");

        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        if(empty($anio) or strlen($anio)<1) {
          $rsListaAnioEjecucion = $anioPredeterminado->row();
          $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->AlertaPronostico_model->setAnio($anio);
        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listartipacciones = $this->TipoAccion_model->listartipacciones();
        
        $listar = $this->AlertaPronostico_model->listar();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listar" => $listar,
            "listaralerta" => $listaralerta,
            "listartipacciones" => $listartipacciones->result(),
            "anio" => $anio
        );
        
        $this->load->view("alertas/alertasPronosticosv2", $data);
    }

    public function cambiarEstadoAlertaPronostico()
    {
        
        $this->load->model("AlertaPronostico_model");
        
        $Evento_Estado_Codigo = $this->input->post("Evento_Estado_Codigo");
        $id = $this->input->post("id");

        $this->AlertaPronostico_model->setEstado($Evento_Estado_Codigo);
        $this->AlertaPronostico_model->setId($id);
            
            if ($this->AlertaPronostico_model->cambiarEstado() > 0) {
                $this->session->set_flashdata('messageOK', 'La Alerta ha sido actualizado');
            } else {
                $this->session->set_flashdata('messageError', 'Error al actualizar la alerta');
            }
            header("location:" . base_url() . "alertasPronosticos");
    }

    public function cerrarAlertaPronostico()
    {
        
        $this->load->model("AlertaPronostico_model");
        
        $Evento_Estado_Codigo = $this->input->post("Evento_Estado_Codigo");
        $id = $this->input->post("id");

        $this->AlertaPronostico_model->setEstado($Evento_Estado_Codigo);
        $this->AlertaPronostico_model->setId($id);
            
            if ($this->AlertaPronostico_model->cerrarAlerta() > 0) {
                $this->session->set_flashdata('messageOK', 'La Alerta ha sido actualizada');
            } else {
                $this->session->set_flashdata('messageError', 'Error al actualizar la alerta');
            }
            header("location:" . base_url() . "alertasPronosticos");
    }

    public function filtroUbigeo() {
        
        $this->load->model("EventoRegistrar_model");
        
        $departamento = $this->input->post("departamento");
        $data = array();
            
            $this->EventoRegistrar_model->setDepartamento($departamento);
           
            $filtrosUbigeo = $this->EventoRegistrar_model->filtrosUbigeo();
            
            if ($filtrosUbigeo->num_rows() > 0) {
                foreach ($filtrosUbigeo->result() as $row) :
                
                    $data[] = array(
                        "Ubigeo" => $row->ubigeo,
                        "Region" => $row->region,
                        "Provincia" => $row->provincia,
                        "codigo_departamento" => $row->codigo_departamento,
                        "codigo_provincia" => $row->codigo_provincia
                    );
                endforeach ;
            }

        $datos = array(
            "data" => $data
        );
        
        echo json_encode($datos);

    }

    public function filtrarAlertaPronosticoDetalle() {
        
        $this->load->model("AlertaPronosticoDetalle_model");
        
        $id = $this->input->post("id");

        $this->AlertaPronosticoDetalle_model->setavisos_ID($id);
        $filtrosEvento = $this->AlertaPronosticoDetalle_model->filtrosEventosById();

        $datos = array(
            "lista" => $filtrosEvento->result()
        );
        
        echo json_encode($datos);
        
    }

    public function listarejecutoras()
    {
        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
        
        $this->AlertaPronostico_model->setDepartamento($id);
        $listaejecutoras = $this->AlertaPronostico_model->listaEjecutoras();
        
        echo json_encode(array("listarejecutoras"=>$listaejecutoras->result()));
        
    }

    public function listarregiones()
    {
        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
        
        $this->AlertaPronostico_model->setId($id);
        $listarregiones = $this->AlertaPronostico_model->listarregiones();
        
        echo json_encode(array("listarregiones"=>$listarregiones->result()));
        
    }

    public function listaAccionesAlertas()
    {
        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
        
        $this->AlertaPronostico_model->setId($id);
        $listaAccionesAlertas = $this->AlertaPronostico_model->listaAccionesAlertas();
        
        echo json_encode(array("listaAccionesAlertas"=>$listaAccionesAlertas->result()));
        
    }

    public function listaRecomendacionesAlertas()
    {
        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
        
        $this->AlertaPronostico_model->setId($id);
        $listaRecomendacionesAlertas = $this->AlertaPronostico_model->listaRecomendacionesAlertasFront();
        
        echo json_encode(array("listaRecomendacionesAlertas"=>$listaRecomendacionesAlertas->result()));
        
    }

    public function informesalertaavisos()
    {
        $this->load->library("dom");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("AlertaPronosticoDetalle_model");

        $data = $this->uri->segment(4, 0);

        $array = desencriptarInforme($data);
        $id = $array[0];
        $orden = $array[1];
        

        if (strlen($id) < 1) {
            redirect('eventos/eventos/grandesEventos');
        }
            
        
        $this->AlertaPronostico_model->setId($id);
        $this->AlertaPronosticoDetalle_model->setavisos_ID($id);
        
        $alerta = $this->AlertaPronostico_model->informealertas();
        $recomendacionesEspacios = $this->AlertaPronostico_model->listaRecomendacionesAlertas(1);
        $recomendacionesSalud = $this->AlertaPronostico_model->listaRecomendacionesAlertas(2);
        $ubigeos = $this->AlertaPronosticoDetalle_model->filtrosEventosById();
        $ubigeos1 = $this->AlertaPronosticoDetalle_model->regionesprovincias();

            $data = array(
                "alerta" => $alerta->row(),
                "recomendacionesEspacios" => $recomendacionesEspacios,
                "recomendacionesSalud" => $recomendacionesSalud,
                "ubigeos" => $ubigeos,
                "ubigeos1" => $ubigeos1
            );
            
            $vista = "eventos/informeAlertaPronostico";
            
            if ($orden == "ASC") {
                $vista = "eventos/informeAlertaPronostico";
            }
            $html = $this->load->view($vista, $data, true);
            $this->dom->generate("portrait", "informe", $html, "Informe_Avisos");
    }

    public function agregarFoto($foto)
    {
        $path = getenv('PATH_DOC_AVISOS');
        $estado = 0;
        $imagen = "";
        
        if (filesize($foto["tmp_name"]) > 0) {            
            
            if ($foto["type"] == "image/jpeg" || $foto["type"] == "image/jpg" || $foto["type"] == "image/png" || $foto["type"] == "image/svg") {
                
                $name = date("Ymdhis");
                
                $data = $foto['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $imagen = $name . '.' . $ext;
                redim($foto["tmp_name"], $path.$name.'.'.$ext, 375, 508);
                
            } else {
                $estado = - 3;
                $message = ERROR_IMAGEN_FORMATO;
            }
        } else {
            $estado = -1;
        }
        
        return array("estado"=>$estado,"foto"=>$imagen);
        
    }

    public function registrarmapa()
    {
        
        $this->load->model("AlertaPronostico_model");

        $foto = $_FILES["file"];
        $dataFoto = $this->agregarFoto($foto);
        $id = $this->input->post("id");
        
                    if ($dataFoto["estado"] == 0) {
                        $this->AlertaPronostico_model->setId($id);
                        $this->AlertaPronostico_model->setImagenMapa($dataFoto["foto"]);
                        $this->AlertaPronostico_model->agregarFoto();
                    }
                    $data = array(
                        "status" => 200
                    );
                    $this->session->set_flashdata('messageOK', 'El Mapa ha sido cargado exitosamente');    
                    echo json_encode($data);
    }

    public function alertasPronosticosRegistrar() {
        $this->load->model("AlertaPronostico_model");
        $this->load->model("Notificacion_model");
        $id = $this->input->post("id");
        
        $secuencia = null;

        if(strlen($id) > 0){ 

        }
        else{
        $secuencia = $this->AlertaPronostico_model->getAvisoNumero();
        }
        
        $titulo = $this->input->post("titulo");
        $descripcion_general = $this->input->post("descripcion_general");
        $fuente = $this->input->post("fuente");
        $nivel_peligro = $this->input->post("nivel_peligro");
        $tipo_aviso = $this->input->post("tipo_aviso");
        $nombre_aviso = $this->input->post("nombre_aviso");
        $enlace_url = $this->input->post("enlace_url");
        $fecha_inicio = $this->input->post("fecha_inicio");
        $hora_inicio = $this->input->post("hora_inicio");
        $fecha_fin = $this->input->post("fecha_fin");
        $hora_fin = $this->input->post("hora_fin");
        $listaUbicacion = $this->input->post("listaUbicacion");
               
        $eventos = $this->input->post("eventos");
        $anioaviso = $fecha_inicio;
        $fech_inicio = $fecha_inicio.' '.$hora_inicio.':00';
        $fech_fin = $fecha_fin.' '.$hora_fin.':00';
        $this->AlertaPronostico_model->setId($id);
        $this->AlertaPronostico_model->setTitulo($titulo);
        $this->AlertaPronostico_model->setDescripcion_General($descripcion_general);
        $this->AlertaPronostico_model->setFuente($fuente);
        $this->AlertaPronostico_model->setNivel_Peligro($nivel_peligro);
        $this->AlertaPronostico_model->setTipo_Aviso($tipo_aviso);
        $this->AlertaPronostico_model->setEnlace_Url($enlace_url);
        $this->AlertaPronostico_model->setFech_Inicio($fech_inicio);
        $this->AlertaPronostico_model->setFech_Fin($fech_fin);
        $this->AlertaPronostico_model->setAnioAviso($anioaviso);

        $this->AlertaPronostico_model->setAvisoNumero($secuencia);

        if (strlen($id) > 0) {
            $this->editarAlertaPronostico($id,$eventos);
        } else {
            
            $generateId = $this->crearAlertaPronostico2($eventos);
            if($generateId > 0){
                if ($nombre_aviso == "METEOROLOGICO") {
                    $msg = array(
                        'message' 	=> 'here is a message. message',
                        'title'		=> "SE HA REGISTRADO EL AVISO METEOROLÓGICO {$titulo}",
                        'subtitle'	=> 'This is a subtitle. subtitle',
                        'body'	=> "AVISO METEOROLÓGICO {$generateId} - COE SALUD",
                    );
                    $this->Notificacion_model->setTopic("sireedMetereologico");
                } 
                else {
                    $msg = array(
                        'message' 	=> 'here is a message. message',
                        'title'		=> "SE HA REGISTRADO EL AVISO HIDROLÓGICO {$titulo}",
                        'subtitle'	=> 'This is a subtitle. subtitle',
                        'body'	=> "AVISO HIDROLÓGICO {$generateId} - COE SALUD",
                    );
                    $this->Notificacion_model->setTopic("sireedHidrologico");
                }
    
                $data = array
                (
                    '1-Titulo' 	    => $titulo,
                    '2-Descripción'	=> $descripcion_general,
                    '3-Fuente'	    => $fuente,
                    '4-Nivel'	    => "Nivel {$nivel_peligro}",
                    '5-Fecha_inicio'  => $fech_inicio,
                    '6-Fecha_fin'     => $fech_fin,
                    '7-Tipo_Aviso'    => $nombre_aviso,
                    '9-Regiones_alertadas' => $listaUbicacion,
                    'notification'  => $msg,
                );
    
                $this->Notificacion_model->setData($data);
                $this->Notificacion_model->setMensaje($msg);
                $this->Notificacion_model->setColor("#cc3300");
                $this->Notificacion_model->enviarNotificacion();
            }

            echo json_encode(array("status" => 200));
        }
    }

    public function alertasPronosticosRegistrarAccion() {
        
        $this->load->model("AlertaPronostico_model");
        
        $idaccion = $this->input->post("idaccion");        
        $departamento = $this->input->post("departamento");
        $ejecutora = $this->input->post("ejecutora");
        $lsaccion = $this->input->post("lsaccion");
        $fecha_accion = $this->input->post("fecha_accion");
        $hora_accion = $this->input->post("hora_accion");
        $descripcion_accion = $this->input->post("descripcion_accion");
        $num_sireed = $this->input->post("num_sireed");
        $anio_sireed = $this->input->post("anio_sireed");

        $aniosireedaccion = AniosParaBD($anio_sireed);
        $fech_accion = $fecha_accion.' '.$hora_accion.':00';
        
        $num_sireedf = substr($num_sireed, 7, 10);
        
        $this->AlertaPronostico_model->setIdAccion($idaccion);
        $this->AlertaPronostico_model->setDepartamento($departamento);
        $this->AlertaPronostico_model->setEjecutora($ejecutora);
        $this->AlertaPronostico_model->setLsaccion($lsaccion);
        $this->AlertaPronostico_model->setFechAccion($fech_accion);
        $this->AlertaPronostico_model->setDescripcion_Accion($descripcion_accion);
        $this->AlertaPronostico_model->setNum_Sireed($num_sireedf);
        $this->AlertaPronostico_model->setAnio_Sireed($aniosireedaccion);

        $alertapro = $this->AlertaPronostico_model->crearaccion();
        
        echo json_encode(array("status" => 200,"id"=>$alertapro));

    }

    public function alertasPronosticosRegistrarRecomendacion() {
        
        $this->load->model("AlertaPronostico_model");
        
        $idrecomendacion = $this->input->post("idrecomendacion");        
        $lsrecomendacion = $this->input->post("lsrecomendacion");
        $descripcion_recomendacion = $this->input->post("descripcion_recomendacion");
        
        $this->AlertaPronostico_model->setIdRecomendacion($idrecomendacion);
        $this->AlertaPronostico_model->setLsrecomendacion($lsrecomendacion);
        $this->AlertaPronostico_model->setDescripcion_Recomendacion($descripcion_recomendacion);
        
        $alertapro = $this->AlertaPronostico_model->crearrecomendacion();
        
        echo json_encode(array("status" => 200,"id"=>$alertapro));
    }

    public function filtrarSuperEventosDetallePorSuperEvento() {
        
        $this->load->model("SuperEventoDetalle_model");
        
        $id = $this->input->post("Super_Evento_Registro_ID");

        $this->SuperEventoDetalle_model->setSuper_Evento_Registro_ID($id);
        $filtrosEvento = $this->SuperEventoDetalle_model->filtrosEventosById();

        $datos = array(
            "lista" => $filtrosEvento->result()
        );
        
        echo json_encode($datos);
        
    }
     
    public function listaEventosOfertaMovilAjax() {
        
        $this->load->model("EventoRegistrar_model");
        $lista = $this->EventoRegistrar_model->listaEventosOfertaMovil();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
        
    }

    public function listaAjax()
    {
        
        $this->load->model("EventoRegistrar_model");
        
        $lista = $this->EventoRegistrar_model->listaPorAtencion();
        $datos = array();
        if($lista->num_rows()>0){
            $orden = 1;
            foreach($lista->result() as $row):
            
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
            
            $editar = '<div class="pull-right"><i class="fa fa-trash actionDelete" aria-hidden="true"></i></div>';
            $eliminar = '<div class="pull-right"><i class="fa fa-pencil-square-o actionEdit" aria-hidden="true"></i></div>';

            $datos[] = array(
                "evento" => $row->evento,
                "fecha" => $row->fecha,
                "estado" => $html,
                "Evento_Registro_Numero" => $row->Evento_Registro_Numero,
                "ubicacion" => $row->ubigeo,
                "orden" => $orden,
                "correlativo" => $row->ANIO." - ".addCeros5($row->Evento_Secuencia),
                "Evento_Registro_Numero" => $row->Evento_Registro_Numero,
                "tipo" => $row->tipoEvento,
                "detalle" => $row->eventoDetalle,
                "descripcion" => $row->Evento_Descripcion,
                "id" => $row->id,
                "editar" => $editar,
                "eliminar" => $eliminar,
                "descripcionAtencion" => $row->descripcionAtencion
            );
            $orden++;            
            endforeach;
            
        }
        
        echo json_encode(array("data" => $datos));

    }

    public function gestionarAtencionEvento() {

        $status = 500;
        
        $id = $this->input->post("id");
        $Registro_Evento_Numero = $this->input->post("Registro_Evento_Numero");
        $descripcion = $this->input->post("descripcion");
        
        if (strlen($Registro_Evento_Numero) >  0 and strlen($descripcion) > 0) {            
            
            if(strlen($id) == 0 or $id==0) {
                $status = $this->registrarAtencion($Registro_Evento_Numero, $descripcion);
            } else {
                $status = $this->actualizarAtencion($Registro_Evento_Numero, $descripcion, $id);
            }           
            
        }     

        echo json_encode(array("status" => $status));
        
    }

    public function recargarDataDashboard() {
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        
        $id = $this->input->post("id");
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($id);
        $datosDashBoard = $this->EventoTipoEntidadAtencionOfertaMovil_model->datosDashBoard();
        $db = $datosDashBoard->row();
        
        $grafico = $this->EventoTipoEntidadAtencionOfertaMovil_model->graficoDashboard();
        $pie = $this->EventoTipoEntidadAtencionOfertaMovil_model->pieDashboard();
        $lines = $this->EventoTipoEntidadAtencionOfertaMovil_model->linesDashboard();
        $polar = $this->EventoTipoEntidadAtencionOfertaMovil_model->polarChartDasboard();
        
        $labelCie = array();
        $dataCie = array();
        $i=0;
        if($grafico->num_rows()>0){
            foreach($grafico->result() as $row):
            $labelCie[$i]=$row->CIE10;
            $dataCie[$i]=$row->Cantidad;
            $i++;
            endforeach;
        }
        
        $labelPie = array();
        $dataPie = array();

        if($pie->num_rows()>0){
            $row = $pie->row();
            $labelPie[0]="I-ROJO";
            $dataPie[0]=$row->rojo;
            $labelPie[1]="II-AMARILLO";
            $dataPie[1]=$row->amarillo;
            $labelPie[2]="III y IV - VERDE";
            $dataPie[2]=$row->verde;
            $labelPie[3]="0 - FALLECIDO";
            $dataPie[3]=$row->fallecido;
        }
        
        
        $array_oferta = array();
        $array_fecha = array();
        $array_cantidad = array();
        
        $cantidadLines = array();
        
        $i = 0;
        $j = 0;
        
        $fechas_total = array();
        if ($lines->num_rows() > 0) {
            $mayorFecha = date("Y-m-d", strtotime("1970-01-01"));
            foreach($lines->result() as $row):
                if (strtotime($row->fecha_convertir) > strtotime($mayorFecha)) {
                    $mayorFecha = $row->fecha_convertir;
                }
            endforeach;
            $anterior = $lines->first_row()->Oferta_Movil;
            foreach($lines->result() as $row):
            if ($anterior != $row->Oferta_Movil) {
                $anterior = $row->Oferta_Movil;
                $i++;
            }
            $array_oferta[$i] = $row->Oferta_Movil;
            $array_fecha[$i][$j] = $row->Fecha;
            $array_cantidad[$i][$j] = $row->Cantidad;
            $j++;
            endforeach;
            
            $mayorFecha = date("Y-m-d",strtotime($mayorFecha."+ 1 days"));

            $fecha_actual = $mayorFecha;
            for($a=15;$a>=1;$a--) {
                $fechas_total[] = date("d/m/Y",strtotime($fecha_actual."- ".$a." days"));
            }
            
            for($b=0;$b<count($array_oferta);$b++) {
                if (count($array_fecha[$b]) == 1) {
                    array_push($array_fecha[$b],"01/01/1969");
                }
                for($c=0;$c<count($fechas_total);$c++) {
                    $position = $this->buscarFecha($array_fecha[$b], $fechas_total[$c]);
                    if ($position > -1) {
                        $cantidadLines[$b][$c] = intval($array_cantidad[$b][$position]);
                    } else {
                        $cantidadLines[$b][$c] = null;
                    }
                    
                }
            }
            
        }

        $labelPolar = array();
        $dataPolar = array();
        $j=0;
        if($grafico->num_rows()>0){
            foreach($polar->result() as $row):
            $labelPolar[$j]=$row->Entidad." - ".$row->Oferta_Movil;
            $dataPolar[$j]=$row->Cantidad;
            $j++;
            endforeach;
        }

        $data = array(
            "t_total" => $db->total,
            "t_hombres" => $db->hombres,
            "t_hombres" => $db->hombres,
            "t_mujeres" => $db->mujeres,
            "t_gestantes" => $db->gestantes,
            "t_adulto_mayor" => $db->adulto_mayor,
            "t_menor_edad" => $db->menor_edad,
            "labelCie" => $labelCie,
            "dataCie" => $dataCie,
            "labelPie" => $labelPie,
            "dataPie" => $dataPie,
            "status" => 200,
            "ofertaMovilLines" => $array_oferta,
            "fechaLines" => $fechas_total,
            "cantidadLines" => $cantidadLines,
            "labelPolar" => $labelPolar,
            "dataPolar" => $dataPolar
        );
        
        echo json_encode($data);
        
    }

    public function eliminarAtencion() {
        $status = 500;        
        $id = $this->input->post("id");
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($id);
        if ($this->EventoRegistrar_model->eliminarAtencion()) {
            $status = 200;
        }
        echo json_encode(array("status" => $status));        
    }

    public function nuevo() {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Brigadista_model");
        $this->load->model("Atenciones_model");
        $this->load->model("AlertaPronostico_model");

        $lista = $this->EventoRegistrar_model->listaEventosOfertaMovil();
        $medicamentos = $this->Atenciones_model->medicamentos();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $profesiones = $this->Brigadista_model->listaProfesiones();
        $rsPaises = $this->EventoTipoEntidadAtencion_model->paises();
        $paises = $rsPaises->result();
        $rsProfesionales = $this->EventoTipoEntidadAtencion_model->profesionales();
        $profesionales = $rsProfesionales->result();
        
        $data = array(
            "lista" => $lista,
            "tipodocumento" => $tipodocumento,
            "listaProfesiones" => $profesiones,
            "paises" => json_encode($paises),
            "medicamentos" => $medicamentos,
            "listaralerta" => $listaralerta,
            "profesionales" => json_encode($profesionales)
        );
        
        $this->load->view("ofertamovil/nuevo", $data);
    }

    public function consolidado() {
        $this->load->model("Atenciones_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("AlertaPronostico_model");

        $primero = 0;
        $lista = $this->EventoRegistrar_model->listaEventosOfertaMovil();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $fecha_inicial = $this->input->post("fecha_inicial");
        $fecha_final = $this->input->post("fecha_final");

        if ($this->input->post("evento")) {
            $id = $this->input->post("evento");
            $this->Atenciones_model->setId($id);
            $primero = $id;
        }        
        else {

            if ($lista->num_rows() > 0) {
                foreach($lista->result() as $row):
                if ($row->prioridad == "1") {
                    $primero = $row->id;
                }
                endforeach;
                
                if ($primero == 0) {
                    $primero = $lista->last_row()->id;
                }

            }
            $this->Atenciones_model->setId($primero);
        }
        
        $this->Atenciones_model->setFechainicial($fecha_inicial);
        $this->Atenciones_model->setFechafinal($fecha_final);
        
        $atenciones = $this->Atenciones_model->lista();

        $data = Array(
            "primero" => $primero,
            "lista" => $lista,
            "atenciones" => $atenciones,
            "listaralerta" => $listaralerta
        );

        $this->load->view("ofertamovil/consolidado", $data);
    }
    
    public function eventosAjax() {

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
                    "ubicacion" => $row->ubigeo,
                    "estado" => $html,
                    "correlativo" => $row->ANIO." - ".addCeros5($row->Evento_Secuencia),
                    "orden" => $orden,
                    "seleccionar" => '<a href="'.base_url().'ofertamovil/fichas/lista/'.base64_encode($row->Evento_Registro_Numero).'">seleccionar</a>',
                    "id" => $row->Evento_Registro_Numero,
                    "tipo" => $row->tipoEvento,
                    "detalle" => $row->eventoDetalle,
                    "descripcion" => $row->Evento_Descripcion
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

    private function editarAlertaPronostico($idAlertaPronos,$eventos) {
        $this->AlertaPronostico_model->setId($idAlertaPronos);
        $idAlertaPronostico = $this->AlertaPronostico_model->editar();
        
        if ( $idAlertaPronostico > 0 ) {
            $this->load->model("AlertaPronosticoDetalle_model");
            
            $eventos = explode("|", $eventos);
            $this->AlertaPronosticoDetalle_model->setId($idAlertaPronos);
            $this->AlertaPronosticoDetalle_model->eliminar();
            
            foreach($eventos as $id):
                $departamento = substr($id, 0, 2);
                $provincia = substr($id, 2, 2);
                $this->AlertaPronosticoDetalle_model->setId($idAlertaPronos);
                $this->AlertaPronosticoDetalle_model->setcodigo_Departamento($id);
                $this->AlertaPronosticoDetalle_model->setcodigo_Provincia($provincia);
                $this->AlertaPronosticoDetalle_model->registrar();
            endforeach;
            
            $this->session->set_flashdata('messageOK', 'Registro editado');
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo editar');
        }

        echo json_encode(array("status" => 200));

    }

    private function crearAlertaPronostico2($eventos) {
        $alertapro = $this->AlertaPronostico_model->crear2();
        if ( $alertapro > 0 ) 
        {
            $this->load->model("AlertaPronosticoDetalle_model");
            
            $eventos = explode("|", $eventos);
            foreach($eventos as $id):
                $departamento = substr($id, 0, 2);
                $provincia = substr($id, 2, 2);
            $this->AlertaPronosticoDetalle_model->setId($alertapro);
            $this->AlertaPronosticoDetalle_model->setcodigo_Departamento($id);
            $this->AlertaPronosticoDetalle_model->setcodigo_Provincia($provincia);
            $this->AlertaPronosticoDetalle_model->registrar();
            endforeach;

            $this->session->set_flashdata('messageOK', 'Aviso Registrado Correctamente');
            return $alertapro;
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo registrar el Aviso.');
            return 0;
        }

    }

    private function registrarAtencion($Registro_Evento_Numero, $descripcion) {
        
        $this->load->model("EventoRegistrar_model");
        $status = 500;
        
        $this->EventoRegistrar_model->setId($Registro_Evento_Numero);
        $this->EventoRegistrar_model->setDescripcionGeneral($descripcion);
    
        if ($this->EventoRegistrar_model->existeAtencionRegistro()) {
            $status = 201;
        } else {
            if ($this->EventoRegistrar_model->registrarAtencionRegistro() > 0) {
                $status = 200;
            }
            
        }
        
        return $status;
    
    }
    
    private function actualizarAtencion($Registro_Evento_Numero, $descripcion, $id) {
        
        $this->load->model("EventoRegistrar_model");
        $status = 500;
        
        $this->EventoRegistrar_model->setId($id);
        $this->EventoRegistrar_model->setIdrol($Registro_Evento_Numero);
        $this->EventoRegistrar_model->setDescripcionGeneral($descripcion);
        
        if ($this->EventoRegistrar_model->existeAtencionRegistroDiferenteId()) {
            $status = 201;
        } else {
            if ($this->EventoRegistrar_model->editarAtencionRegistro() > 0) {
                $status = 200;
            }
            
        }
        
        return $status;
        
    }
    
    private function buscarFecha($fechas,$fecha) {
        $position = array_search($fecha, $fechas);
        if ($position === false) {
            return -1;
        } else {
            return $position;
        }
        
    }
}
