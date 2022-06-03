<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Eventos extends CI_Controller
{

    private $permisos = null;

    function __construct()
    {
        parent::__construct();
        
        $token = $this->session->userdata("token");
        
        (strlen($token) > 0) ? $token = JWT::decode($token, getenv("SECRET_SERVER_KEY")) : redirect("login");
        
        $this->session->set_userdata("idmodulo", 1);
        
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
        $idmenu = 1;
        
        validarPermisos($nivel, $idmenu, $this->permisos);
        
        $this->setearMes();
        
        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("EventoFuente_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("EventoAsociado_Model");

        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $fuente = $this->EventoFuente_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $eventoasociado = $this->EventoAsociado_Model->listaeasociado();

        $departamentos = $this->Ubigeo_model->departamentos();
        
        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "fuente" => $fuente->result(),
            "departamentos" => $departamentos->result(),
            "listaralerta" => $listaralerta,
            "eventoasociado" => $eventoasociado->result()
        );
        
        $this->load->view("eventos/registroEvento", $data);
    }

    public function editar()
    {
        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("EventoFuente_model");
        $this->load->model("Evento_model");
        $this->load->model("EventoDetalle_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("EventoAsociado_Model");
        
        $this->setearMes();
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $eventoregistro = $this->EventoRegistrar_model->evento();
        $eventoregistro = $eventoregistro->row();
        
        $this->Evento_model->setTipoEvento($eventoregistro->Evento_Tipo_Codigo);
        $evento = $this->Evento_model->listaTipo();
        
        $this->EventoDetalle_model->setTipoEvento($eventoregistro->Evento_Tipo_Codigo);
        $this->EventoDetalle_model->setEvento($eventoregistro->Evento_Codigo);
        $eventodetalle = $this->EventoDetalle_model->lista();
        
        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $fuente = $this->EventoFuente_model->lista();
        
        $this->Ubigeo_model->setCodigo_Departamento(substr($eventoregistro->Evento_Ubigeo, 0, 2));
        $this->Ubigeo_model->setCodigo_Provincia(substr($eventoregistro->Evento_Ubigeo, 2, 2));
        $departamentos = $this->Ubigeo_model->departamentos();
        $provincias = $this->Ubigeo_model->provincias();
        $distritos = $this->Ubigeo_model->distritos();
        
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $eventoasociado = $this->EventoAsociado_Model->listaeasociado();

        $data = array(
            "eventoregistro" => $eventoregistro,
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "fuente" => $fuente->result(),
            
            "evento" => $evento->result(),
            "eventodetalle" => $eventodetalle->result(),
            
            "departamentos" => $departamentos->result(),
            "provincias" => $provincias->result(),
            "distritos" => $distritos->result(),

            "listaralerta" => $listaralerta,
            "eventoasociado" => $eventoasociado->result()
        );
        
        $this->load->view("eventos/edicionEvento", $data);
    }

    public function cambiarEstado()
    {
        $this->setearMes();
        
        $this->load->model("EventoRegistrar_model");
        
        $Evento_Estado_Codigo = $this->input->post("Evento_Estado_Codigo");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $idrol = $this->session->userdata("idrol");
        if ($Evento_Estado_Codigo == EVENTO_ESTADO_CERRADO and $idrol == ROL_USUARIO_REGION) {
            header("location:" . base_url() . "eventos/eventos/lista");
        } else {
            
            $this->EventoRegistrar_model->setEstado($Evento_Estado_Codigo);
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            
            if ($this->EventoRegistrar_model->cambiarEstado() > 0) {
                $this->session->set_flashdata('messageOK', 'El evento ha sido actualizado');
            } else {
                $this->session->set_flashdata('messageError', 'Error al actualizar el evento');
            }
            header("location:" . base_url() . "eventos/eventos/lista");
        }
    }

    public function modificarEvento()
    {
        $this->setearMes();
        
        $this->load->model("EventoRegistrar_model");
        
        $Evento_Estado_Codigo = $this->input->post("Evento_Estado_Codigo");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $idrol = $this->session->userdata("idrol");
            
        $this->EventoRegistrar_model->setEstado($Evento_Estado_Codigo);
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        
        if ($this->EventoRegistrar_model->eliminarEvento() > 0) {
            $this->session->set_flashdata('messageOK', 'El evento ha sido eliminado');
        } else {
            $this->session->set_flashdata('messageError', 'Error al eliminado el evento');
        }
        header("location:" . base_url() . "eventos/eventos/lista");
    }

    public function cargarEvento()
    {
        $this->load->model("Evento_model");
        
        $tipoEvento = $this->input->post("tipoEvento");
        $lista = $this->Evento_model->setTipoEvento($tipoEvento);
        $lista = $this->Evento_model->listaTipo();
        
        $data = array(
            "lista" => $lista->result()
        );
        echo json_encode($data);
    }

    public function cargarEventoDetalle()
    {
        $this->load->model("EventoDetalle_model");
        
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        
        $lista = $this->EventoDetalle_model->setTipoEvento($tipoEvento);
        $lista = $this->EventoDetalle_model->setEvento($evento);
        
        $lista = $this->EventoDetalle_model->lista();
        
        $data = array(
            "lista" => $lista->result()
        );

        echo json_encode($data);
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

    public function editarFoto($id,$foto,$image)
    {
        $path = getenv('PATH_DOC_AVISOS');
        $estado = 0;
        $imagen = "";
              
        
        if (filesize($foto["tmp_name"]) > 0) {           
            
            if ($foto["type"] == "image/jpeg" || $foto["type"] == "image/jpg" || $foto["type"] == "image/png" || $foto["type"] == "image/svg") {
                if(file_exists($path . $image)) unlink($path . $image); 

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

    public function registrar()
    {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("Notificacion_model");
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $tipoEvento = $this->input->post("tipoEvento");
        $detalle = $this->input->post("eventoDetalle");
        $evento = $this->input->post("evento");
        $referencia = $this->input->post("referencia");
        $fechaEvento = $this->input->post("fechaEvento");
        $nombreFecha = $this->input->post("fechaEvento");
        $nivelEmergencia = $this->input->post("nivelEmergencia");
        $fuenteInicial = $this->input->post("fuenteInicial");
        $latitud = $this->input->post("latitud");
        $longitud = $this->input->post("longitud");
        $latitudsismo = $this->input->post("latitudsismo");
        $longitudsismo = $this->input->post("longitudsismo");
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        $descripcionGeneral = $this->input->post("descripcionGeneral");
        $profundidad = $this->input->post("profundidad");
        $magnitud = $this->input->post("magnitud");
        $intensidad = $this->input->post("intensidad");
        $lugar = $this->input->post("lugar");
        $consolidado = $this->input->post("evento_consolidado");
        $zoom = $this->input->post("zoom");

        $nombreTipoEvento = $this->input->post("nombreTipoEvento");
        $nombreEvento = $this->input->post("nombreEvento");
        $nombreEventoDetalle = $this->input->post("nombreEventoDetalle");
        $nombreNivelEmergencia = $this->input->post("nombreNivelEmergencia");
        $nombreFuenteInicial = $this->input->post("nombreFuenteInicial");
        
        $ubigeoDescripcion = $this->input->post("hDepartamento") . ", " . $this->input->post("hProvincia") . ", " . $this->input->post("hDistrito");
        
        $fE = explode(" ", $fechaEvento);
        
        $fechaEvento = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00";
        $ExtAnio = explode("-", $fechaEvento);
        $anio = $ExtAnio[0];
        
        $coordenadas = $latitud . ", " . $longitud;
        $ubigeo = $departamento . '' . $provincia . '' . $distrito;
        
        $eventoAsociado = $this->input->post("eventoAsociado");

        $this->EventoRegistrar_model->setAnio($anio);

        $secuencia = $this->EventoRegistrar_model->getSecuencia();
        
        $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
        $this->EventoRegistrar_model->setEvento($evento);
        $this->EventoRegistrar_model->setFechaEvento($fechaEvento);
        $this->EventoRegistrar_model->setDetalle($detalle);
        $this->EventoRegistrar_model->setNivelEmergencia($nivelEmergencia);
        $this->EventoRegistrar_model->setFuenteInicial($fuenteInicial);
        $this->EventoRegistrar_model->setReferencia($referencia);
        $this->EventoRegistrar_model->setCoordenadas($coordenadas);
        $this->EventoRegistrar_model->setLatitud($latitud);
        $this->EventoRegistrar_model->setLongitud($longitud);
        $this->EventoRegistrar_model->setLatitudSismo($latitudsismo);
        $this->EventoRegistrar_model->setLongitudSismo($longitudsismo);
        $this->EventoRegistrar_model->setUbigeo($ubigeo);
        $this->EventoRegistrar_model->setUbigeoDescripcion($ubigeoDescripcion);
        $this->EventoRegistrar_model->setDescripcionGeneral($descripcionGeneral);
        $this->EventoRegistrar_model->setProfundidad($profundidad);
        $this->EventoRegistrar_model->setMagnitud($magnitud);
        $this->EventoRegistrar_model->setIntesidad($intensidad);
        $this->EventoRegistrar_model->setSecuencia($secuencia);
        $this->EventoRegistrar_model->setLugar($lugar);
        $this->EventoRegistrar_model->setConsolidado($consolidado);
        $this->EventoRegistrar_model->setZoom($zoom);
        $this->EventoRegistrar_model->setEventoAsociado($eventoAsociado);

        if ($Evento_Registro_Numero > 0) {
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            if ($this->EventoRegistrar_model->editar() > 0) {
                $this->saveImage($Evento_Registro_Numero, $latitud, $longitud, $zoom, $evento);
                $data = array(
                    "status" => 200
                );
            } else
                $data = array(
                    "status" => 500
                );
        } else {
            $generateId = $this->EventoRegistrar_model->registrar();
            $msg = array
            (
                'message' 	=> 'here is a message. message',
                'title'		=> "SE HA REGISTRADO EL EVENTO SIREED NÚMERO: {$generateId}",
                'subtitle'	=> 'This is a subtitle. subtitle',
                'body'	=> "Evento {$secuencia}, {$nombreEvento} - Fuente: {$nombreFuenteInicial}",
            );

            $dataInforme = base_url()."eventos/eventos/informe/".encriptarInforme($generateId,"ASC")."-".base_url()."eventos/eventos/informe/".encriptarInforme($generateId,"DESC");
            $data = array
            (
                '1-Tipo_de_Evento'    => $nombreTipoEvento,
                '2-Evento_producido'  => $nombreEvento,
                '3-Detalle_del_evento'=> $nombreEventoDetalle,
                '4-Lugar'             => $ubigeoDescripcion,
                '5-Fecha_y_hora'      => "{$nombreFecha}",
                '6-Fuente_inicial'    => $nombreFuenteInicial,
                '7-Nivel_de_evento'   => $nombreNivelEmergencia,
                '8-Descripción'       => $descripcionGeneral,
                'Latitud'           => "{$latitud}",
                'Longitud'           => "{$longitud}",
                'url'               => "{$dataInforme}",
                'notification'      => $msg,
            );

            $this->Notificacion_model->setData($data);
            $this->Notificacion_model->setMensaje($msg);
            $this->Notificacion_model->setColor("#cc3300");
            $this->Notificacion_model->setTopic("sireed");
            $this->Notificacion_model->enviarNotificacion();
            if ($generateId > 0) {
                $this->saveImage($generateId, $latitud, $longitud, $zoom, $evento);
                $data = array(
                    "status" => 200
                );
            } else
                $data = array(
                    "status" => 500
                );
        }
        
        echo json_encode($data);
    }

    public function lista()
    {
        $nivel = 1;
        $idmenu = 2;
        
        validarPermisos($nivel, $idmenu, $this->permisos);
        
        $anio = $this->input->post('anio');
        $mes = $this->input->post('mes');
        
        if (strlen($anio) < 1 or strlen($mes) < 1) {
            $anio = date('Y');
            $mes = $this->session->userdata('mes');
            if (strlen($mes) > 0) {
                $this->session->set_userdata('mes', $mes);
            } else {
                $mes = date('m');
            }
        } else {
            $this->session->set_userdata('mes', $mes);
        }
        
        $this->load->model("EventoRegistrar_model");
        $this->load->model("Asignacion_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("AlertaPronostico_model");
        
        $this->EventoRegistrar_model->setAnio($anio);
        $this->EventoRegistrar_model->setMes($mes);
        $lista = $this->EventoRegistrar_model->lista();
        $rs = $this->EventoTipoEntidadAtencion_model->lista();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $medicamentos = $this->Asignacion_model->listaMedicamentosPresentacion();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        
        $datos = array();
        
        if ($lista->num_rows() > 0) {
            $orden = 1;
            foreach ($lista->result() as $row) :
                
                $datos[] = array(
                    "evento" => $row->evento,
                    "fecha" => $row->fecha,
                    "nivel" => $row->nivel,
                    "Evento_Estado_Codigo" => $row->Evento_Estado_Codigo,
                    "Evento_Registro_Numero" => $row->Evento_Registro_Numero,
                    "ubigeo" => $row->ubigeo,
                    "Evento_Coordenadas" => $row->Evento_Coordenadas,
                    "orden" => $orden,
                    "danios" => $row->danios,
                    "lesionados" => $row->lesionados,
                    "acciones" => $row->acciones,
                    "salud" => $row->salud,
                    "codigo" => $row->ANIO . " - " . addCeros5($row->Evento_Secuencia)
                );
                $orden ++;
            endforeach
            ;
        }
        
        $data = array(
            "lista" => $datos,
            "listaEntidadAtencion" => $rs->result(),
            "medicamentos" => $medicamentos,
            "anio" => $anio,
            "mes" => $mes,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaralerta" => $listaralerta            
        );
        
        $this->load->view("eventos/listaEventos", $data);
    }

    public function setearMes()
    {
        $mes = $this->session->userdata('mes');
        if (strlen($mes) > 0) {
            $this->session->set_userdata('mes', $mes);
        } else {
            $this->session->set_userdata('mes', date('m'));
        }
    }

    public function danios()
    {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("EventoRegistrarDanios_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Asignacion_model");
        $this->load->model("AlertaPronostico_model");
        
        $this->setearMes();
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        if (strlen($Evento_Registro_Numero) < 1)
            redirect('eventos/eventos/lista');
        
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $danios = $this->EventoRegistrar_model->danios();
        
        $this->EventoRegistrarDanios_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $historial = $this->EventoRegistrarDanios_model->listaEvento();
        
        $tipoEntidadAtencion = $this->EventoTipoEntidadAtencion_model->lista();
        $medicamentos = $this->Asignacion_model->listaMedicamentosPresentacion();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "danios" => $danios->row(),
            "historial" => $historial,
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "listaEntidadAtencion" => $tipoEntidadAtencion->result(),
            "medicamentos" => $medicamentos,
            "listaralerta" => $listaralerta            
        );
        
        $this->load->view("eventos/danios", $data);
    }

    public function registrarDanio()
    {
        $this->load->model("EventoRegistrarDanios_model");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Danios_Fecha = $this->input->post("fechaEvento");
        $Evento_Lesionados = $this->input->post("lesionados");
        $Evento_Fallecidos = $this->input->post("fallecidos");
        $Evento_Desaparecidos = $this->input->post("desaparecidos");
        $Evento_Viv_Inhabitables = $this->input->post("inhabitables");
        $Evento_Viv_Colapsadas = $this->input->post("colapsadas");
        $Evento_nombre_f = $this->input->post("nombre_f");
        $Evento_institucion_f = $this->input->post("institucion_f");
        $Evento_telefono_f = $this->input->post("telefono_f");
        $Evento_correo_f = $this->input->post("correo_f");
        
        $dateTime = $Evento_Danios_Fecha;
        $dateTime = explode(" ", $dateTime);
        $fecha = explode("/", $dateTime[0]);
        $Evento_Danios_Fecha = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0] . " " . $dateTime[1] . ":00";
        
        $this->EventoRegistrarDanios_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoRegistrarDanios_model->setEvento_Danios_Fecha($Evento_Danios_Fecha);
        $this->EventoRegistrarDanios_model->setEvento_Lesionados($Evento_Lesionados);
        $this->EventoRegistrarDanios_model->setEvento_Fallecidos($Evento_Fallecidos);
        $this->EventoRegistrarDanios_model->setEvento_Desaparecidos($Evento_Desaparecidos);
        $this->EventoRegistrarDanios_model->setEvento_Viv_Inhabitables($Evento_Viv_Inhabitables);
        $this->EventoRegistrarDanios_model->setEvento_Viv_Colapsadas($Evento_Viv_Colapsadas);
        $this->EventoRegistrarDanios_model->setEvento_nombre_f($Evento_nombre_f);
        $this->EventoRegistrarDanios_model->setEvento_institucion_f($Evento_institucion_f);
        $this->EventoRegistrarDanios_model->setEvento_telefono_f($Evento_telefono_f);
        $this->EventoRegistrarDanios_model->setEvento_correo_f($Evento_correo_f);
        
        $cantidad = $this->EventoRegistrarDanios_model->contarDanios();
        
        if ($cantidad > 0)
            $this->EventoRegistrarDanios_model->setPrimero('1');
        else
            $this->EventoRegistrarDanios_model->setPrimero('0');
        
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";
        
        $this->EventoRegistrarDanios_model->actualizarUltimo();
        
        if ($this->EventoRegistrarDanios_model->registrar()) {
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Historial registrado exitosamente";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function actualizarDanio()
    {
        $this->load->model("EventoRegistrarDanios_model");
        
        $danioID = $this->input->post("danioID");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Danios_Fecha = $this->input->post("fechaEvento");
        $Evento_Lesionados = $this->input->post("lesionados");
        $Evento_Fallecidos = $this->input->post("fallecidos");
        $Evento_Desaparecidos = $this->input->post("desaparecidos");
        $Evento_Viv_Inhabitables = $this->input->post("inhabitables");
        $Evento_Viv_Colapsadas = $this->input->post("colapsadas");
        $ultimo = $this->input->post("dUltimo");
        $Evento_nombre_f = $this->input->post("nombre_f");
        $Evento_institucion_f = $this->input->post("institucion_f");
        $Evento_telefono_f = $this->input->post("telefono_f");
        $Evento_correo_f = $this->input->post("correo_f");        
        
        $dateTime = $Evento_Danios_Fecha;
        $dateTime = explode(" ", $dateTime);
        $fecha = explode("/", $dateTime[0]);
        $Evento_Danios_Fecha = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0] . " " . $dateTime[1] . ":00";
        
        $this->EventoRegistrarDanios_model->setId($danioID);
        $this->EventoRegistrarDanios_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoRegistrarDanios_model->setEvento_Danios_Fecha($Evento_Danios_Fecha);
        $this->EventoRegistrarDanios_model->setEvento_Lesionados($Evento_Lesionados);
        $this->EventoRegistrarDanios_model->setEvento_Fallecidos($Evento_Fallecidos);
        $this->EventoRegistrarDanios_model->setEvento_Desaparecidos($Evento_Desaparecidos);
        $this->EventoRegistrarDanios_model->setEvento_Viv_Inhabitables($Evento_Viv_Inhabitables);
        $this->EventoRegistrarDanios_model->setEvento_Viv_Colapsadas($Evento_Viv_Colapsadas);
        $this->EventoRegistrarDanios_model->setEvento_nombre_f($Evento_nombre_f);
        $this->EventoRegistrarDanios_model->setEvento_institucion_f($Evento_institucion_f);
        $this->EventoRegistrarDanios_model->setEvento_telefono_f($Evento_telefono_f);
        $this->EventoRegistrarDanios_model->setEvento_correo_f($Evento_correo_f);
        
        $status = 500;
        $message = "Error al actualizar, vuelva a intentar";
        
        if ($this->EventoRegistrarDanios_model->actualizar()) {
            if ($ultimo > 0) {
                $this->load->model("EventoRegistrar_model");
                $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
                $this->EventoRegistrar_model->setSecuencia($Evento_Viv_Inhabitables + $Evento_Viv_Colapsadas);
                $this->EventoRegistrar_model->actualizarCantidadDanios();
            }
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Historial actualizado exitosamente";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function eliminarDanio()
    {
        $this->load->model("EventoRegistrarDanios_model");
        
        $danioID = $this->input->post("danioID");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $this->EventoRegistrarDanios_model->setId($danioID);
        $this->EventoRegistrarDanios_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        
        $status = 500;
        $message = "Error al eliminar, vuelva a intentar";
        
        if ($this->EventoRegistrarDanios_model->eliminar()) {
            $this->EventoRegistrarDanios_model->actualizarUltimoAnterior();
            $this->EventoRegistrarDanios_model->actualizarEventoRegistro();
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Historial eliminado exitosamente";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function lesionados()
    {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("Situacion_model");
        $this->load->model("NivelGravedad_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("EventoRegistrarDaniosLesionados_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Asignacion_model");
        $this->load->model("AlertaPronostico_model");
        
        $this->setearMes();
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        if (strlen($Evento_Registro_Numero) < 1)
            redirect('eventos/eventos/lista');
        
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $danios = $this->EventoRegistrar_model->danios();
        
        $situacion = $this->Situacion_model->lista();
        $nivelgravedad = $this->NivelGravedad_model->lista();
        $tipodocumento = $this->TipoDocumento_model->lista();
        
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $contar = $this->EventoRegistrarDaniosLesionados_model->contar();
        
        $departamentos = $this->Ubigeo_model->departamentos();
        $tipoEntidadAtencion = $this->EventoTipoEntidadAtencion_model->lista();
        $medicamentos = $this->Asignacion_model->listaMedicamentosPresentacion();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        
        $data = array(
            "danios" => $danios->row(),
            "contar" => $contar,
            "situacion" => $situacion,
            "nivelgravedad" => $nivelgravedad,
            "tipodocumento" => $tipodocumento,
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "departamentos" => $departamentos->result(),
            "listaEntidadAtencion" => $tipoEntidadAtencion->result(),
            "medicamentos" => $medicamentos,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("eventos/lesionados", $data);
    }

    public function entidadesSaludAjax()
    {
        $this->load->model("EntidadSalud_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $ubigeo = $departamento . $provincia . $distrito;
        
        $data = array();
        
        if (strlen($ubigeo) > 5) {
            
            $this->EntidadSalud_model->setCodigo_Ubigeo($ubigeo);
            
            $lista = $this->EntidadSalud_model->lista();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                    $data[] = array(
                        "CodEESS" => $row->CodEESS,
                        "Nombre" => $row->Nombre,
                        "Clasificacion" => $row->Clasificacion
                    );
                endforeach
                ;
            }
        }
        
        $datos = Array(
            "data" => $data
        );
        echo json_encode($datos);
    }

    public function entidadesSaludAPI()
    {
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");

        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, getenv("API_RENIPRESS_URL") . $tipo_documento . "/" . $documento . "/");
        curl_setopt($handler, CURLOPT_HEADER, FALSE);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
            "Authorization: " . getenv("API_RENIEC_TOKEN"),
            "Content-Type: application/json"
        ));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
        
        curl_close($handler);
        
        echo $data;
        
        /*
        $this->load->model("EntidadSalud_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $ubigeo = $departamento . $provincia . $distrito;
        
        $data = array();
        
        if (strlen($ubigeo) > 5) {
            
            $this->EntidadSalud_model->setCodigo_Ubigeo($ubigeo);
            
            $lista = $this->EntidadSalud_model->lista();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                    $data[] = array(
                        "CodEESS" => $row->CodEESS,
                        "Nombre" => $row->Nombre,
                        "Clasificacion" => $row->Clasificacion
                    );
                endforeach
                ;
            }
        }
        
        $datos = Array(
            "data" => $data
        );
        echo json_encode($datos);*/
    }

    public function agregarLesionadosHistorial()
    {
        $this->load->model("EventoRegistrarDaniosLesionados_model");
        $this->load->model("EventoRegistrar_model");
        
        $listado = $this->input->post("lesionados");
        
        $n = 0;
        $i = 0;
        
        foreach ($listado as $rows) :
            
            $row = $rows[0];
            $fE = explode(" ", $row["Evento_Danios_Lesionados_Fecha_Atencion"]);
            $fechaEventoAtencion = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00";
            
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_Fecha_Atencion($fechaEventoAtencion);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Documento_Numero($row["Lesionado_Documento_Numero"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Apellidos($row["Lesionado_Apellidos"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Nombres($row["Lesionado_Nombres"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Edad($row["Lesionado_Edad"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Observaciones($row["Lesionado_Observaciones"]);
            $this->EventoRegistrarDaniosLesionados_model->setNivel_Gravedad_Codigo($row["Nivel_Gravedad_Codigo"]);
            $this->EventoRegistrarDaniosLesionados_model->setSituacion_Codigo($row["Situacion_Codigo"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_CIE10_Codigo($row["Lesionado_CIE10_Codigo"]);
            $this->EventoRegistrarDaniosLesionados_model->setTipo_Documento_Codigo($row["Tipo_Documento_Codigo"]);
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($row["Evento_Registro_Numero"]);
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_ID($row["Evento_Danios_Lesionados_ID"]);
            $this->EventoRegistrarDaniosLesionados_model->setId($row["Evento_Danios_Lesionados_Numero"]);
            
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Genero($row["Lesionado_Genero"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Gestante($row["Lesionado_Gestante"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Entidad_Salud_Codigo($row["Lesionado_Entidad_Salud_Codigo"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Entidad_Salud_Nombre($row["Lesionado_Entidad_Salud_Nombre"]);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Personal_Salud($row["Lesionado_Personal_Salud"]);
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Tipo_Entidad_Atencion_ID($row["Evento_Tipo_Entidad_Atencion_ID"]);
            if ($row["activarEditar"] == 1) {
                if ($row["Evento_Danios_Lesionados_Numero"] > 0) {
                    if ($this->EventoRegistrarDaniosLesionados_model->actualizar())
                        $n ++;
                } else {
                    if ($this->EventoRegistrarDaniosLesionados_model->registrar()) {
                        $n ++;
                        $i ++;
                    }
                }
            }
        endforeach
        ;
        
        if ($i > 0) {
            $this->EventoRegistrar_model->setId($row["Evento_Registro_Numero"]);
            $this->EventoRegistrar_model->setSecuencia($i);
            $this->EventoRegistrar_model->agregarCantidadLesionados();
        }
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $this->EventoRegistrar_model->actualizarFecha();
        
        $data = array(
            "total" => $n,
            "status" => 200,
            "message" => "Los lesionados han sido procesados"
        );
        
        echo json_encode($data);
    }

    public function clonarHistorialLesionados()
    {
        $this->load->model("EventoRegistrarDaniosLesionados_model");
        
        $Evento_Danios_Lesionados_ID = $this->input->post("Evento_Danios_Lesionados_ID");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_ID($Evento_Danios_Lesionados_ID);
        
        $status = 0;
        $message = "No se puedo copiar el historial";
        
        if ($this->EventoRegistrarDaniosLesionados_model->actualizarUltimo() > 0) {
            $this->EventoRegistrarDaniosLesionados_model->clonar();
            $status = 200;
            $message = "El historial ha sido copiado";
        }
        
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $this->EventoRegistrar_model->actualizarFecha();
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function listaDaniosLesionados()
    {
        $this->load->model("EventoRegistrarDaniosLesionados_model");
        
        $Evento_Danios_Lesionados_ID = $this->input->post("Evento_Danios_Lesionados_ID");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_ID($Evento_Danios_Lesionados_ID);
        
        $lesionados = $this->EventoRegistrarDaniosLesionados_model->listaDaniosLesionados();
        
        $data = array(
            "status" => 200,
            "lesionados" => $lesionados->result()
        );
        
        echo json_encode($data);
    }

    public function eliminarDanioLesionadoPaciente()
    {
        $this->load->model("EventoRegistrarDaniosLesionados_model");
        $this->load->model("EventoRegistrar_model");
        
        $Evento_Danios_Lesionados_Numero = $this->input->post("Evento_Danios_Lesionados_ID");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $CANTIDAD_HISTORIAL = $this->input->post("CANTIDAD_HISTORIAL");
        $this->EventoRegistrarDaniosLesionados_model->setId($Evento_Danios_Lesionados_Numero);
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        
        $status = 500;
        $message = "Error al eliminar, vuelva a intentar";
        
        if ($this->EventoRegistrarDaniosLesionados_model->eliminarLesionado()) {
            $status = 200;
            $message = "Lesionado eliminado exitosamente";
            
            if ($CANTIDAD_HISTORIAL < 2) {
                
                $this->EventoRegistrar_model->setSecuencia(- 1);
                $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
                $this->EventoRegistrar_model->agregarCantidadLesionados();
            }
            
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function eliminarDanioLesionado()
    {
        $this->load->model("EventoRegistrarDaniosLesionados_model");
        $this->load->model("EventoRegistrar_model");
        
        $Evento_Danios_Lesionados_ID = $this->input->post("Evento_Danios_Lesionados_ID");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_ID($Evento_Danios_Lesionados_ID);
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        
        $status = 500;
        $message = "Error al eliminar, vuelva a intentar";
        
        if ($this->EventoRegistrarDaniosLesionados_model->eliminar()) {
            $status = 200;
            $message = "Historial eliminado exitosamente";
            $afectados = $this->EventoRegistrarDaniosLesionados_model->actualizarUltimoAnterior();
            $this->EventoRegistrar_model->setSecuencia($afectados);
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarCantidadLesionados();
            
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function acciones()
    {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("TipoAccion_model");
        $this->load->model("EventoAcciones_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Asignacion_model");
        $this->load->model("AlertaPronostico_model");
        
        $this->setearMes();
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        if (strlen($Evento_Registro_Numero) < 1)
            redirect('eventos/eventos/lista');
        
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $danios = $this->EventoRegistrar_model->danios();

        $tipoaccion = $this->TipoAccion_model->listar();
        
        $this->EventoAcciones_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $lista = $this->EventoAcciones_model->lista();
        
        $tipoEntidadAtencion = $this->EventoTipoEntidadAtencion_model->lista();
        $medicamentos = $this->Asignacion_model->listaMedicamentosPresentacion();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        
        $data = array(
            "danios" => $danios->row(),
            "tipoaccion" => $tipoaccion,
            "lista" => $lista,
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "listaEntidadAtencion" => $tipoEntidadAtencion->result(),
            "medicamentos" => $medicamentos,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("eventos/acciones", $data);
    }

    public function listarAccionEntidad()
    {
        $this->load->model("TipoAccionEntidad_model");
        
        $Tipo_Accion_Codigo = $this->input->post("Tipo_Accion_Codigo");
        
        $this->TipoAccionEntidad_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
        
        $lista = $this->TipoAccionEntidad_model->listar();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
    }

    public function registrarAccion()
    {
        $this->load->model("EventoAcciones_model");
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Acciones_Fecha = $this->input->post("Evento_Acciones_Fecha");
        $Tipo_Accion_Codigo = $this->input->post("Tipo_Accion_Codigo");
        $Tipo_Accion_Entidad_Codigo = $this->input->post("Tipo_Accion_Entidad_Codigo");
        $Evento_Acciones_Descripcion = $this->input->post("Evento_Acciones_Descripcion");
        
        $Evento_Acciones_Region = $this->input->post("Evento_Acciones_Region");
        $Evento_Acciones_Minsa = $this->input->post("Evento_Acciones_Minsa");
        
        $Evento_Acciones_Emt_i = $this->input->post("Evento_Acciones_Emt_i");
        $Evento_Acciones_Emt_ii = $this->input->post("Evento_Acciones_Emt_ii");
        $Evento_Acciones_Emt_iii = $this->input->post("Evento_Acciones_Emt_iii");
        $Evento_Acciones_Celula_Especializada = $this->input->post("Evento_Acciones_Celula_Especializada");
        
        $Evento_Acciones_Minsa_Samu = $this->input->post("Evento_Acciones_Minsa_Samu");
        $Evento_Acciones_Salud_Minsa = $this->input->post("Evento_Acciones_Salud_Minsa");
        $Evento_Acciones_Essalud = $this->input->post("Evento_Acciones_Essalud");
        $Evento_Acciones_Municipalidades_Gores = $this->input->post("Evento_Acciones_Municipalidades_Gores");
        $Evento_Acciones_Voluntarios = $this->input->post("Evento_Acciones_Voluntarios");
        
        $Evento_Ambulancias_Minsa_Samu = $this->input->post("Evento_Ambulancias_Minsa_Samu");
        $Evento_Ambulancias_Minsa = $this->input->post("Evento_Ambulancias_Minsa");
        $Evento_Ambulancias_Essalud = $this->input->post("Evento_Ambulancias_Essalud");
        $Evento_Ambulancias_Bomberos = $this->input->post("Evento_Ambulancias_Bomberos");
        $Evento_Ambulancias_Municipalidades_Gores = $this->input->post("Evento_Ambulancias_Municipalidades_Gores");
        $Evento_Ambulancias_PNP_FFAA = $this->input->post("Evento_Ambulancias_PNP_FFAA");
        $Evento_Ambulancianas_Privadas = $this->input->post("Evento_Ambulancianas_Privadas");
        
        $Evento_Maletin_Emergencias_Desastres = $this->input->post("Evento_Maletin_Emergencias_Desastres");
        $Evento_Kit_Medicamentos_Insumos = $this->input->post("Evento_Kit_Medicamentos_Insumos");
        $Evento_Acciones_Equipo_Biomedicos = $this->input->post("Evento_Acciones_Equipo_Biomedicos");
        $Evento_Acciones_Puesto_Comando = $this->input->post("Evento_Acciones_Puesto_Comando");
        $Evento_Acciones_Ac_Victimas = $this->input->post("Evento_Acciones_Ac_Victimas");
        $Evento_Acciones_Oferta_Movil_i = $this->input->post("Evento_Acciones_Oferta_Movil_i");
        $Evento_Acciones_Oferta_Movil_ii = $this->input->post("Evento_Acciones_Oferta_Movil_ii");
        $Evento_Acciones_Oferta_Movil_iii = $this->input->post("Evento_Acciones_Oferta_Movil_iii");
        $Evento_Acciones_Hospital_Modular = $this->input->post("Evento_Acciones_Hospital_Modular");
        $Evento_Banio_Quimico_Portatil = $this->input->post("Evento_Banio_Quimico_Portatil");
        
        $Evento_Acciones_Medicamentos = $this->input->post("Evento_Acciones_Medicamentos");
        
        $Evento_Rescatistas = $this->input->post("Evento_Rescatistas");
        $Evento_Medicos_Tacticos = $this->input->post("Evento_Medicos_Tacticos");
        $Evento_Acciones_PNP_FFAA = $this->input->post("Evento_Acciones_PNP_FFAA");
        
        $Equipo_Tecnico_Movilizado_Diresa = $this->input->post("Equipo_Tecnico_Movilizado_Diresa");
        $Equipo_Tecnico_Movilizado_Red = $this->input->post("Equipo_Tecnico_Movilizado_Red");
        $Equipo_Tecnico_Movilizado_Diris = $this->input->post("Equipo_Tecnico_Movilizado_Diris");
        $Equipo_Tecnico_Movilizado_Ipress = $this->input->post("Equipo_Tecnico_Movilizado_Ipress");
        $Equipo_Tecnico_Movilizado_Digerd = $this->input->post("Equipo_Tecnico_Movilizado_Digerd");
        $Equipo_Tecnico_Movilizado_Minsa = $this->input->post("Equipo_Tecnico_Movilizado_Minsa");
        $Equipo_Tecnico_Movilizado_Otros = $this->input->post("Equipo_Tecnico_Movilizado_Otros");
        
        $Evento_Acciones_Personal_Emt_i = $this->input->post("Evento_Acciones_Personal_Emt_i");
        $Evento_Acciones_Personal_Emt_ii = $this->input->post("Evento_Acciones_Personal_Emt_ii");
        $Evento_Acciones_Personal_Emt_iii = $this->input->post("Evento_Acciones_Personal_Emt_iii");
        $Evento_Acciones_Mochilas_Emergencia = $this->input->post("Evento_Acciones_Mochilas_Emergencia");
        
        $fE = explode(" ", $Evento_Acciones_Fecha);
        $Evento_Acciones_Fecha = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00";
        
        $this->EventoAcciones_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoAcciones_model->setEvento_Acciones_Fecha($Evento_Acciones_Fecha);
        $this->EventoAcciones_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
        $this->EventoAcciones_model->setTipo_Accion_Entidad_Codigo($Tipo_Accion_Entidad_Codigo);
        $this->EventoAcciones_model->setEvento_Acciones_Descripcion($Evento_Acciones_Descripcion);
        
        $this->EventoAcciones_model->setEvento_Acciones_Region($Evento_Acciones_Region);
        $this->EventoAcciones_model->setEvento_Acciones_Minsa($Evento_Acciones_Minsa);
        
        $this->EventoAcciones_model->setEvento_Acciones_Emt_i($Evento_Acciones_Emt_i);
        $this->EventoAcciones_model->setEvento_Acciones_Emt_ii($Evento_Acciones_Emt_ii);
        $this->EventoAcciones_model->setEvento_Acciones_Emt_iii($Evento_Acciones_Emt_iii);
        $this->EventoAcciones_model->setEvento_Acciones_Celula_Especializada($Evento_Acciones_Celula_Especializada);
        
        $this->EventoAcciones_model->setEvento_Acciones_Minsa_Samu($Evento_Acciones_Minsa_Samu);
        $this->EventoAcciones_model->setEvento_Acciones_Salud_Minsa($Evento_Acciones_Salud_Minsa);
        $this->EventoAcciones_model->setEvento_Acciones_Essalud($Evento_Acciones_Essalud);
        $this->EventoAcciones_model->setEvento_Acciones_Municipalidades_Gores($Evento_Acciones_Municipalidades_Gores);
        $this->EventoAcciones_model->setEvento_Acciones_Voluntarios($Evento_Acciones_Voluntarios);
        
        $this->EventoAcciones_model->setEvento_Ambulancias_Minsa_Samu($Evento_Ambulancias_Minsa_Samu);
        $this->EventoAcciones_model->setEvento_Ambulancias_Minsa($Evento_Ambulancias_Minsa);
        $this->EventoAcciones_model->setEvento_Ambulancias_Essalud($Evento_Ambulancias_Essalud);
        $this->EventoAcciones_model->setEvento_Ambulancias_Bomberos($Evento_Ambulancias_Bomberos);
        $this->EventoAcciones_model->setEvento_Ambulancias_Municipalidades_Gores($Evento_Ambulancias_Municipalidades_Gores);
        $this->EventoAcciones_model->setEvento_Ambulancias_PNP_FFAA($Evento_Ambulancias_PNP_FFAA);
        $this->EventoAcciones_model->setEvento_Ambulancianas_Privadas($Evento_Ambulancianas_Privadas);
        
        $this->EventoAcciones_model->setEvento_Maletin_Emergencias_Desastres($Evento_Maletin_Emergencias_Desastres);
        $this->EventoAcciones_model->setEvento_Kit_Medicamentos_Insumos($Evento_Kit_Medicamentos_Insumos);
        $this->EventoAcciones_model->setEvento_Acciones_Equipo_Biomedicos($Evento_Acciones_Equipo_Biomedicos);
        $this->EventoAcciones_model->setEvento_Acciones_Puesto_Comando($Evento_Acciones_Puesto_Comando);
        $this->EventoAcciones_model->setEvento_Acciones_Ac_Victimas($Evento_Acciones_Ac_Victimas);
        $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_i($Evento_Acciones_Oferta_Movil_i);
        $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_ii($Evento_Acciones_Oferta_Movil_ii);
        $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_iii($Evento_Acciones_Oferta_Movil_iii);
        $this->EventoAcciones_model->setEvento_Acciones_Hospital_Modular($Evento_Acciones_Hospital_Modular);
        $this->EventoAcciones_model->setEvento_Banio_Quimico_Portatil($Evento_Banio_Quimico_Portatil);
        
        $this->EventoAcciones_model->setEvento_Rescatistas($Evento_Rescatistas);
        $this->EventoAcciones_model->setEvento_Medicos_Tacticos($Evento_Medicos_Tacticos);
        $this->EventoAcciones_model->setEvento_Acciones_PNP_FFAA($Evento_Acciones_PNP_FFAA);
        
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Diresa($Equipo_Tecnico_Movilizado_Diresa);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Red($Equipo_Tecnico_Movilizado_Red);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Diris($Equipo_Tecnico_Movilizado_Diris);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Ipress($Equipo_Tecnico_Movilizado_Ipress);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Digerd($Equipo_Tecnico_Movilizado_Digerd);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Minsa($Equipo_Tecnico_Movilizado_Minsa);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Otros($Equipo_Tecnico_Movilizado_Otros);
        
        $this->EventoAcciones_model->setEvento_Acciones_Personal_Emt_i($Evento_Acciones_Personal_Emt_i);
        $this->EventoAcciones_model->setEvento_Acciones_Personal_Emt_ii($Evento_Acciones_Personal_Emt_ii);
        $this->EventoAcciones_model->setEvento_Acciones_Personal_Emt_iii($Evento_Acciones_Personal_Emt_iii);
        $this->EventoAcciones_model->setEvento_Acciones_Mochilas_Emergencia($Evento_Acciones_Mochilas_Emergencia);
        
        $status = 500;
        $message = "Error en el proceso";
        if ($this->EventoAcciones_model->registrar()) {
            
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Registro exitoso";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function editarAccion()
    {
        $this->load->model("EventoAcciones_model");
        
        $id = $this->input->post("id");
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Acciones_Fecha = $this->input->post("Evento_Acciones_Fecha");
        $Tipo_Accion_Codigo = $this->input->post("Tipo_Accion_Codigo");
        $Tipo_Accion_Entidad_Codigo = $this->input->post("Tipo_Accion_Entidad_Codigo");
        $Evento_Acciones_Descripcion = $this->input->post("Evento_Acciones_Descripcion");
        $Evento_Acciones_Region = $this->input->post("Evento_Acciones_Region");
        $Evento_Acciones_Minsa = $this->input->post("Evento_Acciones_Minsa");
        
        $Evento_Acciones_Emt_i = $this->input->post("Evento_Acciones_Emt_i");
        $Evento_Acciones_Emt_ii = $this->input->post("Evento_Acciones_Emt_ii");
        $Evento_Acciones_Emt_iii = $this->input->post("Evento_Acciones_Emt_iii");
        $Evento_Acciones_Celula_Especializada = $this->input->post("Evento_Acciones_Celula_Especializada");
        
        $Evento_Acciones_Minsa_Samu = $this->input->post("Evento_Acciones_Minsa_Samu");
        $Evento_Acciones_Salud_Minsa = $this->input->post("Evento_Acciones_Salud_Minsa");
        $Evento_Acciones_Essalud = $this->input->post("Evento_Acciones_Essalud");
        $Evento_Acciones_Municipalidades_Gores = $this->input->post("Evento_Acciones_Municipalidades_Gores");
        $Evento_Acciones_Voluntarios = $this->input->post("Evento_Acciones_Voluntarios");
        
        $Evento_Ambulancias_Minsa_Samu = $this->input->post("Evento_Ambulancias_Minsa_Samu");
        $Evento_Ambulancias_Minsa = $this->input->post("Evento_Ambulancias_Minsa");
        $Evento_Ambulancias_Essalud = $this->input->post("Evento_Ambulancias_Essalud");
        $Evento_Ambulancias_Bomberos = $this->input->post("Evento_Ambulancias_Bomberos");
        $Evento_Ambulancias_Municipalidades_Gores = $this->input->post("Evento_Ambulancias_Municipalidades_Gores");
        $Evento_Ambulancias_PNP_FFAA = $this->input->post("Evento_Ambulancias_PNP_FFAA");
        $Evento_Ambulancianas_Privadas = $this->input->post("Evento_Ambulancianas_Privadas");
        
        $Evento_Maletin_Emergencias_Desastres = $this->input->post("Evento_Maletin_Emergencias_Desastres");
        $Evento_Kit_Medicamentos_Insumos = $this->input->post("Evento_Kit_Medicamentos_Insumos");
        $Evento_Acciones_Equipo_Biomedicos = $this->input->post("Evento_Acciones_Equipo_Biomedicos");
        $Evento_Acciones_Puesto_Comando = $this->input->post("Evento_Acciones_Puesto_Comando");
        $Evento_Acciones_Ac_Victimas = $this->input->post("Evento_Acciones_Ac_Victimas");
        $Evento_Acciones_Oferta_Movil_i = $this->input->post("Evento_Acciones_Oferta_Movil_i");
        $Evento_Acciones_Oferta_Movil_ii = $this->input->post("Evento_Acciones_Oferta_Movil_ii");
        $Evento_Acciones_Oferta_Movil_iii = $this->input->post("Evento_Acciones_Oferta_Movil_iii");
        $Evento_Acciones_Hospital_Modular = $this->input->post("Evento_Acciones_Hospital_Modular");
        $Evento_Banio_Quimico_Portatil = $this->input->post("Evento_Banio_Quimico_Portatil");
        
        $Evento_Rescatistas = $this->input->post("Evento_Rescatistas");
        $Evento_Medicos_Tacticos = $this->input->post("Evento_Medicos_Tacticos");
        $Evento_Acciones_PNP_FFAA = $this->input->post("Evento_Acciones_PNP_FFAA");
        
        $Equipo_Tecnico_Movilizado_Diresa = $this->input->post("Equipo_Tecnico_Movilizado_Diresa");
        $Equipo_Tecnico_Movilizado_Red = $this->input->post("Equipo_Tecnico_Movilizado_Red");
        $Equipo_Tecnico_Movilizado_Diris = $this->input->post("Equipo_Tecnico_Movilizado_Diris");
        $Equipo_Tecnico_Movilizado_Ipress = $this->input->post("Equipo_Tecnico_Movilizado_Ipress");
        $Equipo_Tecnico_Movilizado_Digerd = $this->input->post("Equipo_Tecnico_Movilizado_Digerd");
        $Equipo_Tecnico_Movilizado_Minsa = $this->input->post("Equipo_Tecnico_Movilizado_Minsa");
        $Equipo_Tecnico_Movilizado_Otros = $this->input->post("Equipo_Tecnico_Movilizado_Otros");
        
        $Evento_Acciones_Personal_Emt_i = $this->input->post("Evento_Acciones_Personal_Emt_i");
        $Evento_Acciones_Personal_Emt_ii = $this->input->post("Evento_Acciones_Personal_Emt_ii");
        $Evento_Acciones_Personal_Emt_iii = $this->input->post("Evento_Acciones_Personal_Emt_iii");
        $Evento_Acciones_Mochilas_Emergencia = $this->input->post("Evento_Acciones_Mochilas_Emergencia");

        $fE = explode(" ", $Evento_Acciones_Fecha);
        $Evento_Acciones_Fecha = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00";
        
        $this->EventoAcciones_model->setId($id);
        
        $this->EventoAcciones_model->setEvento_Acciones_Fecha($Evento_Acciones_Fecha);
        $this->EventoAcciones_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
        $this->EventoAcciones_model->setTipo_Accion_Entidad_Codigo($Tipo_Accion_Entidad_Codigo);
        $this->EventoAcciones_model->setEvento_Acciones_Descripcion($Evento_Acciones_Descripcion);
        
        $this->EventoAcciones_model->setEvento_Acciones_Region($Evento_Acciones_Region);
        $this->EventoAcciones_model->setEvento_Acciones_Minsa($Evento_Acciones_Minsa);
        
        $this->EventoAcciones_model->setEvento_Acciones_Emt_i($Evento_Acciones_Emt_i);
        $this->EventoAcciones_model->setEvento_Acciones_Emt_ii($Evento_Acciones_Emt_ii);
        $this->EventoAcciones_model->setEvento_Acciones_Emt_iii($Evento_Acciones_Emt_iii);
        $this->EventoAcciones_model->setEvento_Acciones_Celula_Especializada($Evento_Acciones_Celula_Especializada);
        
        $this->EventoAcciones_model->setEvento_Acciones_Minsa_Samu($Evento_Acciones_Minsa_Samu);
        $this->EventoAcciones_model->setEvento_Acciones_Salud_Minsa($Evento_Acciones_Salud_Minsa);
        $this->EventoAcciones_model->setEvento_Acciones_Essalud($Evento_Acciones_Essalud);
        $this->EventoAcciones_model->setEvento_Acciones_Municipalidades_Gores($Evento_Acciones_Municipalidades_Gores);
        $this->EventoAcciones_model->setEvento_Acciones_Voluntarios($Evento_Acciones_Voluntarios);
        
        $this->EventoAcciones_model->setEvento_Ambulancias_Minsa_Samu($Evento_Ambulancias_Minsa_Samu);
        $this->EventoAcciones_model->setEvento_Ambulancias_Minsa($Evento_Ambulancias_Minsa);
        $this->EventoAcciones_model->setEvento_Ambulancias_Essalud($Evento_Ambulancias_Essalud);
        $this->EventoAcciones_model->setEvento_Ambulancias_Bomberos($Evento_Ambulancias_Bomberos);
        $this->EventoAcciones_model->setEvento_Ambulancias_Municipalidades_Gores($Evento_Ambulancias_Municipalidades_Gores);
        $this->EventoAcciones_model->setEvento_Ambulancias_PNP_FFAA($Evento_Ambulancias_PNP_FFAA);
        $this->EventoAcciones_model->setEvento_Ambulancianas_Privadas($Evento_Ambulancianas_Privadas);
        
        $this->EventoAcciones_model->setEvento_Maletin_Emergencias_Desastres($Evento_Maletin_Emergencias_Desastres);
        $this->EventoAcciones_model->setEvento_Kit_Medicamentos_Insumos($Evento_Kit_Medicamentos_Insumos);
        $this->EventoAcciones_model->setEvento_Acciones_Equipo_Biomedicos($Evento_Acciones_Equipo_Biomedicos);
        $this->EventoAcciones_model->setEvento_Acciones_Puesto_Comando($Evento_Acciones_Puesto_Comando);
        $this->EventoAcciones_model->setEvento_Acciones_Ac_Victimas($Evento_Acciones_Ac_Victimas);
        $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_i($Evento_Acciones_Oferta_Movil_i);
        $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_ii($Evento_Acciones_Oferta_Movil_ii);
        $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_iii($Evento_Acciones_Oferta_Movil_iii);
        $this->EventoAcciones_model->setEvento_Acciones_Hospital_Modular($Evento_Acciones_Hospital_Modular);
        $this->EventoAcciones_model->setEvento_Banio_Quimico_Portatil($Evento_Banio_Quimico_Portatil);
        
        $this->EventoAcciones_model->setEvento_Rescatistas($Evento_Rescatistas);
        $this->EventoAcciones_model->setEvento_Medicos_Tacticos($Evento_Medicos_Tacticos);
        $this->EventoAcciones_model->setEvento_Acciones_PNP_FFAA($Evento_Acciones_PNP_FFAA);
        
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Diresa($Equipo_Tecnico_Movilizado_Diresa);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Red($Equipo_Tecnico_Movilizado_Red);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Diris($Equipo_Tecnico_Movilizado_Diris);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Ipress($Equipo_Tecnico_Movilizado_Ipress);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Digerd($Equipo_Tecnico_Movilizado_Digerd);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Minsa($Equipo_Tecnico_Movilizado_Minsa);
        $this->EventoAcciones_model->setEquipo_Tecnico_Movilizado_Otros($Equipo_Tecnico_Movilizado_Otros);
        
        $this->EventoAcciones_model->setEvento_Acciones_Personal_Emt_i($Evento_Acciones_Personal_Emt_i);
        $this->EventoAcciones_model->setEvento_Acciones_Personal_Emt_ii($Evento_Acciones_Personal_Emt_ii);
        $this->EventoAcciones_model->setEvento_Acciones_Personal_Emt_iii($Evento_Acciones_Personal_Emt_iii);
        $this->EventoAcciones_model->setEvento_Acciones_Mochilas_Emergencia($Evento_Acciones_Mochilas_Emergencia);

        $status = 500;
        $message = "Error en el proceso";
        if ($this->EventoAcciones_model->actualizar()) {
            
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Actualizaci&oacute;n exitosa";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function eliminarAccion()
    {
        $this->load->model("EventoAcciones_model");
        
        $id = $this->input->post("idEliminar");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $this->EventoAcciones_model->setId($id);
        
        $status = 500;
        $message = "Error al eliminar, vuelva a intentar";
        
        if ($this->EventoAcciones_model->eliminar()) {
            
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Historial eliminado exitosamente";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function imagenes()
    {
        $this->load->model("EventoRegistroImagen_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("EventoRegistrarDanios_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Asignacion_model");
        
        $this->setearMes();
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $this->EventoRegistroImagen_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
		$danios = $this->EventoRegistrar_model->danios();
        $lista = $this->EventoRegistroImagen_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $tipoEntidadAtencion = $this->EventoTipoEntidadAtencion_model->lista();
        $medicamentos = $this->Asignacion_model->listaMedicamentosPresentacion();		
        
        $rowDanios = $danios->row();
        
        $this->Ubigeo_model->setCodigo_Departamento($rowDanios->COD_DEPA);
        $this->Ubigeo_model->setCodigo_Provincia($rowDanios->COD_PROV);
        
        $departamentos = $this->Ubigeo_model->departamentos();
        $provincias = $this->Ubigeo_model->provincias();
        $distritos = $this->Ubigeo_model->distritos();

        $data = array(
            "danios" => $danios->row(),
            "departamentos" => $departamentos->result(),
            "provincias" => $provincias->result(),
            "distritos" => $distritos->result(),
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "lista" => $lista,
            "listaralerta" => $listaralerta,
            "listaEntidadAtencion" => $tipoEntidadAtencion->result(),
            "medicamentos" => $medicamentos
        );
        
        $this->load->view("eventos/imagenes", $data);
    }

    public function agregarImagen()
    {
        $this->load->model("EventoRegistroImagen_model");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $path = getenv('PATH_IMG');
        $estado = 0;
        
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            
            if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/png") {
                
                $name = date("Ymdhis");
                
                $data = $_FILES["file"]['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $imagen = $name . '.' . $ext;
                redim($_FILES["file"]["tmp_name"], $path . $name . '.' . $ext, 1600, 1200);
                $this->EventoRegistroImagen_model->setEvento_Registro_Numero($Evento_Registro_Numero);
                $this->EventoRegistroImagen_model->setImagen($imagen);
                $this->EventoRegistroImagen_model->registrar();
                
                $this->load->model("EventoRegistrar_model");
                $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
                $this->EventoRegistrar_model->actualizarFecha();
                
                $estado = 200;
                $message = EXITO_IMAGEN;
            } else {
                $estado = - 3;
                $message = ERROR_IMAGEN_FORMATO;
            }
        }
        $response = array(
            "status" => $estado,
            "message" => $message
        );
        echo json_encode($response);
    }

    public function editarImagen()
    {
        $this->load->model("EventoRegistroImagen_model");
        $id = $this->input->post("Evento_Registro_Imagen_Numero");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $imagen = $this->input->post("imagen");
        $descripcion = $this->input->post("descripcion");
        $path = getenv('PATH_IMG');
        $estado = 0;
        
        if (file_exists($path . $imagen))
            unlink($path . $imagen); 
        
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            
            if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/png") {
                
                $name = date("Ymdhis");
                $data = $_FILES["file"]['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                
                $size = ((int) filesize($_FILES["file"]["tmp_name"]) / 1024);
                
                redim($_FILES["file"]["tmp_name"], $path . $name . '.' . $ext, 1600, 1200);
                $this->EventoRegistroImagen_model->setId($id);
                $this->EventoRegistroImagen_model->setImagen($name . '.' . $ext);
                $this->EventoRegistroImagen_model->setDescripcion($descripcion);
                $this->EventoRegistroImagen_model->editar();
                
                $this->load->model("EventoRegistrar_model");
                $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
                $this->EventoRegistrar_model->actualizarFecha();
                $estado = 200;
                $message = EXITO_IMAGEN;
            } else {
                $estado = - 3;
                $message = ERROR_IMAGEN_FORMATO;
            }
        } 
        $response = array(
            "status" => $estado,
            "message" => $message
        );
        echo json_encode($response);
    }

    public function eliminarImagen()
    {
        $this->load->model("EventoRegistroImagen_model");
        $id = $this->input->post("Evento_Registro_Imagen_Numero");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $imagen = $this->input->post("imagen");
        $path = getenv('PATH_IMG');
        if (file_exists($path . $imagen))
            unlink($path . $imagen);
        
        $this->EventoRegistroImagen_model->setId($id);
        $this->EventoRegistroImagen_model->eliminar();
        
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $this->EventoRegistrar_model->actualizarFecha();
        
        echo json_encode(array(
            "status" => 1
        ));
    }

    public function editarImagenDescripcion()
    {
        $this->load->model("EventoRegistroImagen_model");
        $id = $this->input->post("Evento_Registro_Imagen_Numero");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $descripcion = $this->input->post("descripcion");
        
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $this->EventoRegistrar_model->actualizarFecha();
        
        $this->EventoRegistroImagen_model->setId($id);
        $this->EventoRegistroImagen_model->setDescripcion($descripcion);
        $this->EventoRegistroImagen_model->descripcion();
        echo json_encode(array(
            "status" => 1
        ));
    }

    public function entidadSalud()
    {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("EventoEntidadSalud_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Asignacion_model");
        $this->load->model("AlertaPronostico_model");

        $this->setearMes();
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        if (strlen($Evento_Registro_Numero) < 1)
            redirect('eventos/eventos/lista');
        
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $danios = $this->EventoRegistrar_model->danios();
        
        $this->EventoEntidadSalud_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $lista = $this->EventoEntidadSalud_model->lista();
        
        $rowDanios = $danios->row();
        
        $this->Ubigeo_model->setCodigo_Departamento($rowDanios->COD_DEPA);
        $this->Ubigeo_model->setCodigo_Provincia($rowDanios->COD_PROV);
        
        $departamentos = $this->Ubigeo_model->departamentos();
        $provincias = $this->Ubigeo_model->provincias();
        $distritos = $this->Ubigeo_model->distritos();
        
        $tipoEntidadAtencion = $this->EventoTipoEntidadAtencion_model->lista();
        $medicamentos = $this->Asignacion_model->listaMedicamentosPresentacion();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "danios" => $rowDanios,
            "lista" => $lista,
            "departamentos" => $departamentos->result(),
            "provincias" => $provincias->result(),
            "distritos" => $distritos->result(),
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "listaEntidadAtencion" => $tipoEntidadAtencion->result(),
            "medicamentos" => $medicamentos,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("eventos/entidadSalud", $data);
    }

    public function registrarEntidadSalud()
    {
        $this->load->model("EventoEntidadSalud_model");
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $fecha = $this->input->post("fecha");
        $Evento_Entidad_Estado = $this->input->post("Evento_Entidad_Estado");
        $CodEESS = $this->input->post("CodEESS");
        $agua = $this->input->post("agua");
        $desague = $this->input->post("desague");
        $energia_electrica = $this->input->post("energia_electrica");
        $conectividad = $this->input->post("conectividad");
        $radio = $this->input->post("radio");
        $fija = $this->input->post("fija");
        $celular = $this->input->post("celular");
        $internet = $this->input->post("internet");
        $techos = ($this->input->post("techos")) ? $this->input->post("techos") : "0";
        $paredes = ($this->input->post("paredes")) ? $this->input->post("paredes") : "0";
        $pisos = ($this->input->post("pisos")) ? $this->input->post("pisos") : "0";
        $cercos = ($this->input->post("cercos")) ? $this->input->post("cercos") : "0";
        $otros_lugares = ($this->input->post("otros_lugares")) ? $this->input->post("otros_lugares") : "0";
        $inundacion = ($this->input->post("inundacion")) ? $this->input->post("inundacion") : "0";
        $colapso = ($this->input->post("colapso")) ? $this->input->post("colapso") : "0";
        $caida = ($this->input->post("caida")) ? $this->input->post("caida") : "0";
        $goteras = ($this->input->post("goteras")) ? $this->input->post("goteras") : "0";
        $fisuras = ($this->input->post("fisuras")) ? $this->input->post("fisuras") : "0";
        $otros_consecuencias = ($this->input->post("otros_consecuencias")) ? $this->input->post("otros_consecuencias") : "0";
        $emergencia = ($this->input->post("emergencia")) ? $this->input->post("emergencia") : "0";
        $banco = ($this->input->post("banco")) ? $this->input->post("banco") : "0";
        $obstetrico = ($this->input->post("obstetrico")) ? $this->input->post("obstetrico") : "0";
        $quirurgico = ($this->input->post("quirurgico")) ? $this->input->post("quirurgico") : "0";
        $uci = ($this->input->post("uci")) ? $this->input->post("uci") : "0";
        $diagnostico = ($this->input->post("diagnostico")) ? $this->input->post("diagnostico") : "0";
        $esterilizacion = ($this->input->post("esterilizacion")) ? $this->input->post("esterilizacion") : "0";
        $laboratorio = ($this->input->post("laboratorio")) ? $this->input->post("laboratorio") : "0";
        $ambulancias = ($this->input->post("ambulancias")) ? $this->input->post("ambulancias") : "0";
        $farmacia = ($this->input->post("farmacia")) ? $this->input->post("farmacia") : "0";
        $consultorios = ($this->input->post("consultorios")) ? $this->input->post("consultorios") : "0";
        $otros = ($this->input->post("otros")) ? $this->input->post("otros") : "0";
        $recuperacion_operatividad = $this->input->post("recuperacion_operatividad");
        $continuidad_operativa = ($this->input->post("continuidad_operativa")) ? $this->input->post("continuidad_operativa") : "0";
        $lugar = $this->input->post("lugar");
        $Codigo_Usuario_Registro = $this->input->post("Codigo_Usuario_Registro");
        $Fecha_Registro = $this->input->post("Fecha_Registro");
        $Codigo_Usuario_Actualizacion = $this->input->post("Codigo_Usuario_Actualizacion");
        $Fecha_Actualizacion = $this->input->post("Fecha_Actualizacion");
        $observaciones = $this->input->post("observaciones");
        
        $fE = explode(" ", $fecha);
        $fecha = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00";
        
        if (strlen($recuperacion_operatividad) > 0) {
            
            $recuperacion_operatividad = formatearFechaParaBD($recuperacion_operatividad);
        }
        
        $this->EventoEntidadSalud_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoEntidadSalud_model->setfecha($fecha);
        $this->EventoEntidadSalud_model->setEvento_Entidad_Estado($Evento_Entidad_Estado);
        $this->EventoEntidadSalud_model->setCodEESS($CodEESS);
        $this->EventoEntidadSalud_model->setagua($agua);
        $this->EventoEntidadSalud_model->setdesague($desague);
        $this->EventoEntidadSalud_model->setenergia_electrica($energia_electrica);
        $this->EventoEntidadSalud_model->setconectividad($conectividad);
        $this->EventoEntidadSalud_model->setradio($radio);
        $this->EventoEntidadSalud_model->setfija($fija);
        $this->EventoEntidadSalud_model->setcelular($celular);
        $this->EventoEntidadSalud_model->setinternet($internet);
        $this->EventoEntidadSalud_model->settechos($techos);
        $this->EventoEntidadSalud_model->setparedes($paredes);
        $this->EventoEntidadSalud_model->setpisos($pisos);
        $this->EventoEntidadSalud_model->setcercos($cercos);
        $this->EventoEntidadSalud_model->setotros_lugares($otros_lugares);
        $this->EventoEntidadSalud_model->setinundacion($inundacion);
        $this->EventoEntidadSalud_model->setcolapso($colapso);
        $this->EventoEntidadSalud_model->setcaida($caida);
        $this->EventoEntidadSalud_model->setgoteras($goteras);
        $this->EventoEntidadSalud_model->setfisuras($fisuras);
        $this->EventoEntidadSalud_model->setotros_consecuencias($otros_consecuencias);
        $this->EventoEntidadSalud_model->setemergencia($emergencia);
        $this->EventoEntidadSalud_model->setbanco($banco);
        $this->EventoEntidadSalud_model->setobstetrico($obstetrico);
        $this->EventoEntidadSalud_model->setquirurgico($quirurgico);
        $this->EventoEntidadSalud_model->setuci($uci);
        $this->EventoEntidadSalud_model->setdiagnostico($diagnostico);
        $this->EventoEntidadSalud_model->setesterilizacion($esterilizacion);
        $this->EventoEntidadSalud_model->setlaboratorio($laboratorio);
        $this->EventoEntidadSalud_model->setambulancias($ambulancias);
        $this->EventoEntidadSalud_model->setfarmacia($farmacia);
        $this->EventoEntidadSalud_model->setconsultorios($consultorios);
        $this->EventoEntidadSalud_model->setotros($otros);
        $this->EventoEntidadSalud_model->setrecuperacion_operatividad($recuperacion_operatividad);
        $this->EventoEntidadSalud_model->setcontinuidad_operativa($continuidad_operativa);
        $this->EventoEntidadSalud_model->setlugar($lugar);
        $this->EventoEntidadSalud_model->setObservaciones($observaciones);
        
        $status = 500;
        $message = "Error en el proceso";
        if ($this->EventoEntidadSalud_model->registrar()) {
            
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Registro exitoso";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function editarEntidadSalud()
    {
        $this->load->model("EventoEntidadSalud_model");
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $id = $this->input->post("id");
        $fecha = $this->input->post("fecha");
        $Evento_Entidad_Estado = $this->input->post("Evento_Entidad_Estado");
        $CodEESS = $this->input->post("CodEESS");
        $agua = $this->input->post("agua");
        $desague = $this->input->post("desague");
        $energia_electrica = $this->input->post("energia_electrica");
        $conectividad = $this->input->post("conectividad");
        $radio = $this->input->post("radio");
        $fija = $this->input->post("fija");
        $celular = $this->input->post("celular");
        $internet = $this->input->post("internet");
        $techos = ($this->input->post("techos")) ? $this->input->post("techos") : "0";
        $paredes = ($this->input->post("paredes")) ? $this->input->post("paredes") : "0";
        $pisos = ($this->input->post("pisos")) ? $this->input->post("pisos") : "0";
        $cercos = ($this->input->post("cercos")) ? $this->input->post("cercos") : "0";
        $otros_lugares = ($this->input->post("otros_lugares")) ? $this->input->post("otros_lugares") : "0";
        $inundacion = ($this->input->post("inundacion")) ? $this->input->post("inundacion") : "0";
        $colapso = ($this->input->post("colapso")) ? $this->input->post("colapso") : "0";
        $caida = ($this->input->post("caida")) ? $this->input->post("caida") : "0";
        $goteras = ($this->input->post("goteras")) ? $this->input->post("goteras") : "0";
        $fisuras = ($this->input->post("fisuras")) ? $this->input->post("fisuras") : "0";
        $otros_consecuencias = ($this->input->post("otros_consecuencias")) ? $this->input->post("otros_consecuencias") : "0";
        $emergencia = ($this->input->post("emergencia")) ? $this->input->post("emergencia") : "0";
        $banco = ($this->input->post("banco")) ? $this->input->post("banco") : "0";
        $obstetrico = ($this->input->post("obstetrico")) ? $this->input->post("obstetrico") : "0";
        $quirurgico = ($this->input->post("quirurgico")) ? $this->input->post("quirurgico") : "0";
        $uci = ($this->input->post("uci")) ? $this->input->post("uci") : "0";
        $diagnostico = ($this->input->post("diagnostico")) ? $this->input->post("diagnostico") : "0";
        $esterilizacion = ($this->input->post("esterilizacion")) ? $this->input->post("esterilizacion") : "0";
        $laboratorio = ($this->input->post("laboratorio")) ? $this->input->post("laboratorio") : "0";
        $ambulancias = ($this->input->post("ambulancias")) ? $this->input->post("ambulancias") : "0";
        $farmacia = ($this->input->post("farmacia")) ? $this->input->post("farmacia") : "0";
        $consultorios = ($this->input->post("consultorios")) ? $this->input->post("consultorios") : "0";
        $otros = ($this->input->post("otros")) ? $this->input->post("otros") : "0";
        $recuperacion_operatividad = $this->input->post("recuperacion_operatividad");
        $continuidad_operativa = ($this->input->post("continuidad_operativa")) ? $this->input->post("continuidad_operativa") : "0";
        $lugar = $this->input->post("lugar");
        $Codigo_Usuario_Registro = $this->input->post("Codigo_Usuario_Registro");
        $Fecha_Registro = $this->input->post("Fecha_Registro");
        $Codigo_Usuario_Actualizacion = $this->input->post("Codigo_Usuario_Actualizacion");
        $Fecha_Actualizacion = $this->input->post("Fecha_Actualizacion");
        
        $fE = explode(" ", $fecha);
        $fecha = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00:00:00";
        
        if (strlen($recuperacion_operatividad) > 0) {
            $recuperacion_operatividad = formatearFechaParaBD($recuperacion_operatividad);
        }
        
        $this->EventoEntidadSalud_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoEntidadSalud_model->setId($id);
        $this->EventoEntidadSalud_model->setfecha($fecha);
        $this->EventoEntidadSalud_model->setEvento_Entidad_Estado($Evento_Entidad_Estado);
        $this->EventoEntidadSalud_model->setCodEESS($CodEESS);
        $this->EventoEntidadSalud_model->setagua($agua);
        $this->EventoEntidadSalud_model->setdesague($desague);
        $this->EventoEntidadSalud_model->setenergia_electrica($energia_electrica);
        $this->EventoEntidadSalud_model->setconectividad($conectividad);
        $this->EventoEntidadSalud_model->setradio($radio);
        $this->EventoEntidadSalud_model->setfija($fija);
        $this->EventoEntidadSalud_model->setcelular($celular);
        $this->EventoEntidadSalud_model->setinternet($internet);
        $this->EventoEntidadSalud_model->settechos($techos);
        $this->EventoEntidadSalud_model->setparedes($paredes);
        $this->EventoEntidadSalud_model->setpisos($pisos);
        $this->EventoEntidadSalud_model->setcercos($cercos);
        $this->EventoEntidadSalud_model->setotros_lugares($otros_lugares);
        $this->EventoEntidadSalud_model->setinundacion($inundacion);
        $this->EventoEntidadSalud_model->setcolapso($colapso);
        $this->EventoEntidadSalud_model->setcaida($caida);
        $this->EventoEntidadSalud_model->setgoteras($goteras);
        $this->EventoEntidadSalud_model->setfisuras($fisuras);
        $this->EventoEntidadSalud_model->setotros_consecuencias($otros_consecuencias);
        $this->EventoEntidadSalud_model->setemergencia($emergencia);
        $this->EventoEntidadSalud_model->setbanco($banco);
        $this->EventoEntidadSalud_model->setobstetrico($obstetrico);
        $this->EventoEntidadSalud_model->setquirurgico($quirurgico);
        $this->EventoEntidadSalud_model->setuci($uci);
        $this->EventoEntidadSalud_model->setdiagnostico($diagnostico);
        $this->EventoEntidadSalud_model->setesterilizacion($esterilizacion);
        $this->EventoEntidadSalud_model->setlaboratorio($laboratorio);
        $this->EventoEntidadSalud_model->setambulancias($ambulancias);
        $this->EventoEntidadSalud_model->setfarmacia($farmacia);
        $this->EventoEntidadSalud_model->setconsultorios($consultorios);
        $this->EventoEntidadSalud_model->setotros($otros);
        $this->EventoEntidadSalud_model->setrecuperacion_operatividad($recuperacion_operatividad);
        $this->EventoEntidadSalud_model->setcontinuidad_operativa($continuidad_operativa);
        $this->EventoEntidadSalud_model->setlugar($lugar);
        
        $status = 500;
        $message = "Error en el proceso";
        if ($this->EventoEntidadSalud_model->editar()) {
            
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Registro exitoso";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function eliminarEntidadSalud()
    {
        $this->load->model("EventoEntidadSalud_model");
        
        $id = $this->input->post("idEliminar");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $this->EventoEntidadSalud_model->setId($id);
        
        $status = 500;
        $message = "Error al eliminar, vuelva a intentar";
        
        if ($this->EventoEntidadSalud_model->eliminar()) {
            
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $this->EventoRegistrar_model->actualizarFecha();
            $status = 200;
            $message = "Entidad eliminada exitosamente";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        
        echo json_encode($data);
    }

    public function informe()
    {
        $this->load->library("dom");
        
        $this->load->model("EventoRegistrar_model");
        $this->load->model("EventoRegistrarDanios_model");
        $this->load->model("EventoRegistrarDaniosLesionados_model");
        $this->load->model("EventoAcciones_model");
        $this->load->model("EventoRegistroImagen_model");
        $this->load->model("EventoEntidadSalud_model");
        $this->load->model("Asignacion_model");
        
        $data = $this->uri->segment(4, 0);
        
        $array = desencriptarInforme($data);
        $Evento_Registro_Numero = $array[0];
        $orden = $array[1];
        
        if (strlen($Evento_Registro_Numero) < 1)
            redirect('eventos/eventos/lista');
        
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $evento = $this->EventoRegistrar_model->eventoInforme();
        
        $this->EventoRegistrarDanios_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoRegistrarDanios_model->setPrimero(0);
        if ($orden == "ASC") {
            $this->EventoRegistrarDanios_model->setPrimero(1);
        }
        
        $danios = $this->EventoRegistrarDanios_model->datosDanios();
        if ($danios->num_rows() == 0) {
            $lesionados = 0;
            $fallecidos = 0;
            $desaparecidos = 0;
            $totalIPRESSOperativas = 0;
            $totalIPRESSInoperativas = 0;
        } else {
            $danios = $danios->row();
            $lesionados = $danios->Evento_Lesionados;
            $fallecidos = $danios->Evento_Fallecidos;
            $desaparecidos = $danios->Evento_Desaparecidos;
            $totalIPRESSOperativas = $danios->operativas;
            $totalIPRESSInoperativas = $danios->inoperativas;
        }
        
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoRegistrarDaniosLesionados_model->setOrden($orden);
        $totalMujeres = $this->EventoRegistrarDaniosLesionados_model->mujeres();
        $totalGestantes = $this->EventoRegistrarDaniosLesionados_model->gestantes();
        $totalMenorEdad = $this->EventoRegistrarDaniosLesionados_model->menorEdad();
        $totalAdultoMayor = $this->EventoRegistrarDaniosLesionados_model->adultoMayor();

        if ($totalMujeres->num_rows() == 0) {
            $totalMujeres = 0;
        } else {
            $totalMujeres = $totalMujeres->row();
            $totalMujeres = $totalMujeres->TOTAL;
        }
        
        if ($totalGestantes->num_rows() == 0) {
            $totalGestantes = 0;
        } else {
            $totalGestantes = $totalGestantes->row();
            $totalGestantes = $totalGestantes->TOTAL;
        }
        
        if ($totalMenorEdad->num_rows() == 0) {
            $totalMenorEdad = 0;
        } else {
            $totalMenorEdad = $totalMenorEdad->row();
            $totalMenorEdad = $totalMenorEdad->TOTAL;
        }
        
        if ($totalAdultoMayor->num_rows() == 0) {
            $totalAdultoMayor = 0;
        } else {
            $totalAdultoMayor = $totalAdultoMayor->row();
            $totalAdultoMayor = $totalAdultoMayor->TOTAL;
        }
    
        $this->EventoAcciones_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $accionesTotales = $this->EventoAcciones_model->totalesInforme();
        
        if ($accionesTotales->num_rows() == 0) {
            $brigadistas = 0;
            $emt = 0;
            $personalSalud = 0;
            $ambulancias = 0;
            $medicamentosInsumos = 0;
            $equipotecnicogeneral = 0;
            
            $brigadistas_regionales = 0;
            $brigadistas_minsa = 0;
            $rescatistas = 0;
            $medicos_tacticos = 0;
            $emt_i = 0;
            $emt_ii = 0;
            $emt_iii = 0;
            $celula_especializada = 0;
            
            $Personal_Minsa_Samu = 0;
            $Personal_Salud_Minsa = 0;
            $Personal_Essalud = 0;
            $Personal_Municipalidades_Gores = 0;
            $Personal_Voluntarios = 0;
            $Personal_PNP_FFAA = 0;
            
            $Ambulancias_Minsa_Samu = 0;
            $Ambulancias_Minsa = 0;
            $Ambulancias_Essalud = 0;
            $Ambulancias_Bomberos = 0;
            $Ambulancias_Municipalidades_Gores = 0;
            $Ambulancias_PNP_FFAA = 0;
            $Ambulancianas_Privadas = 0;
            
            $MI_Emergencias_Desastres = 0;
            $MI_Kit_Medicamentos_Insumos = 0;
            $MI_Equipo_Biomedicos = 0;
            $MI_Puesto_Comando = 0;
            $MI_Ac_Victimas = 0;
            $MI_Oferta_Movil_i = 0;
            $MI_Oferta_Movil_ii = 0;
            $MI_Oferta_Movil_iii = 0;
            $MI_Hospital_Modular = 0;
            $MI_Banio_Quimico_Portatil = 0;

            $Total_Equipo_Tecnico_Movilizado_Diresa = 0;
            $Total_Equipo_Tecnico_Movilizado_Red = 0;
            $Total_Equipo_Tecnico_Movilizado_Diris = 0;
            $Total_Equipo_Tecnico_Movilizado_Ipress = 0;
            $Total_Equipo_Tecnico_Movilizado_Digerd = 0;
            $Total_Equipo_Tecnico_Movilizado_Minsa = 0;
            $Total_Equipo_Tecnico_Movilizado_Otros = 0;

        } else {
            $accionesTotales = $accionesTotales->row();
            $brigadistas = ($accionesTotales->brigadistas > 0) ? $accionesTotales->brigadistas : 0;
            $emt = ($accionesTotales->emt > 0) ? $accionesTotales->emt : 0;
            $personalSalud = ($accionesTotales->personalSalud > 0) ? $accionesTotales->personalSalud : 0;
            $ambulancias = ($accionesTotales->ambulancias > 0) ? $accionesTotales->ambulancias : 0;
            $medicamentosInsumos = ($accionesTotales->medicamentosInsumos > 0) ? $accionesTotales->medicamentosInsumos : 0;
            $equipotecnicogeneral= ($accionesTotales->equipotecnicogeneral > 0) ? $accionesTotales->equipotecnicogeneral : 0;

            $brigadistas_regionales = ($accionesTotales->brigadistas_regionales > 0) ? $accionesTotales->brigadistas_regionales : 0;
            $brigadistas_minsa = ($accionesTotales->brigadistas_minsa > 0) ? $accionesTotales->brigadistas_minsa : 0;
            $rescatistas = ($accionesTotales->rescatistas > 0) ? $accionesTotales->rescatistas : 0;
            $medicos_tacticos = ($accionesTotales->medicos_tacticos > 0) ? $accionesTotales->medicos_tacticos : 0;
            $emt_i = ($accionesTotales->emt_i > 0) ? $accionesTotales->emt_i : 0;
            $emt_ii = ($accionesTotales->emt_ii > 0) ? $accionesTotales->emt_ii : 0;
            $emt_iii = ($accionesTotales->emt_iii > 0) ? $accionesTotales->emt_iii : 0;
            $celula_especializada = ($accionesTotales->celula_especializada > 0) ? $accionesTotales->celula_especializada : 0;
            
            $Personal_Minsa_Samu = ($accionesTotales->Personal_Minsa_Samu > 0) ? $accionesTotales->Personal_Minsa_Samu : 0;
            $Personal_Salud_Minsa = ($accionesTotales->Personal_Salud_Minsa > 0) ? $accionesTotales->Personal_Salud_Minsa : 0;
            $Personal_Essalud = ($accionesTotales->Personal_Essalud > 0) ? $accionesTotales->Personal_Essalud : 0;
            $Personal_Municipalidades_Gores = ($accionesTotales->Personal_Municipalidades_Gores > 0) ? $accionesTotales->Personal_Municipalidades_Gores : 0;
            $Personal_Voluntarios = ($accionesTotales->Personal_Voluntarios > 0) ? $accionesTotales->Personal_Voluntarios : 0;
            $Personal_PNP_FFAA = ($accionesTotales->Personal_PNP_FFAA > 0) ? $accionesTotales->Personal_PNP_FFAA : 0;
            $Ambulancias_Minsa_Samu = ($accionesTotales->Ambulancias_Minsa_Samu > 0) ? $accionesTotales->Ambulancias_Minsa_Samu : 0;
            $Ambulancias_Minsa = ($accionesTotales->Ambulancias_Minsa > 0) ? $accionesTotales->Ambulancias_Minsa : 0;
            $Ambulancias_Essalud = ($accionesTotales->Ambulancias_Essalud > 0) ? $accionesTotales->Ambulancias_Essalud : 0;
            $Ambulancias_Bomberos = ($accionesTotales->Ambulancias_Bomberos > 0) ? $accionesTotales->Ambulancias_Bomberos : 0;
            $Ambulancias_Municipalidades_Gores = ($accionesTotales->Ambulancias_Municipalidades_Gores > 0) ? $accionesTotales->Ambulancias_Municipalidades_Gores : 0;
            $Ambulancias_PNP_FFAA = ($accionesTotales->Ambulancias_PNP_FFAA > 0) ? $accionesTotales->Ambulancias_PNP_FFAA : 0;
            $Ambulancianas_Privadas = ($accionesTotales->Ambulancianas_Privadas > 0) ? $accionesTotales->Ambulancianas_Privadas : 0;
            $MI_Emergencias_Desastres = ($accionesTotales->MI_Emergencias_Desastres > 0) ? $accionesTotales->MI_Emergencias_Desastres : 0;
            $MI_Kit_Medicamentos_Insumos = ($accionesTotales->MI_Kit_Medicamentos_Insumos > 0) ? $accionesTotales->MI_Kit_Medicamentos_Insumos : 0;
            $MI_Equipo_Biomedicos = ($accionesTotales->MI_Equipo_Biomedicos > 0) ? $accionesTotales->MI_Equipo_Biomedicos : 0;
            $MI_Puesto_Comando = ($accionesTotales->MI_Puesto_Comando > 0) ? $accionesTotales->MI_Puesto_Comando : 0;
            $MI_Ac_Victimas = ($accionesTotales->MI_Ac_Victimas > 0) ? $accionesTotales->MI_Ac_Victimas : 0;
            $MI_Oferta_Movil_i = ($accionesTotales->MI_Oferta_Movil_i > 0) ? $accionesTotales->MI_Oferta_Movil_i : 0;
            $MI_Oferta_Movil_ii = ($accionesTotales->MI_Oferta_Movil_ii > 0) ? $accionesTotales->MI_Oferta_Movil_ii : 0;
            $MI_Oferta_Movil_iii = ($accionesTotales->MI_Oferta_Movil_iii > 0) ? $accionesTotales->MI_Oferta_Movil_iii : 0;
            $MI_Hospital_Modular = ($accionesTotales->MI_Hospital_Modular > 0) ? $accionesTotales->MI_Hospital_Modular : 0;
            $MI_Banio_Quimico_Portatil = ($accionesTotales->MI_Banio_Quimico_Portatil > 0) ? $accionesTotales->MI_Banio_Quimico_Portatil : 0;
       
            $Total_Equipo_Tecnico_Movilizado_Diresa = ($accionesTotales->Total_Equipo_Tecnico_Movilizado_Diresa > 0) ? $accionesTotales->Total_Equipo_Tecnico_Movilizado_Diresa : 0;
            $Total_Equipo_Tecnico_Movilizado_Red = ($accionesTotales->Total_Equipo_Tecnico_Movilizado_Red > 0) ? $accionesTotales->Total_Equipo_Tecnico_Movilizado_Red : 0;
            $Total_Equipo_Tecnico_Movilizado_Diris = ($accionesTotales->Total_Equipo_Tecnico_Movilizado_Diris > 0) ? $accionesTotales->Total_Equipo_Tecnico_Movilizado_Diris : 0;
            $Total_Equipo_Tecnico_Movilizado_Ipress = ($accionesTotales->Total_Equipo_Tecnico_Movilizado_Ipress > 0) ? $accionesTotales->Total_Equipo_Tecnico_Movilizado_Ipress : 0;
            $Total_Equipo_Tecnico_Movilizado_Digerd = ($accionesTotales->Total_Equipo_Tecnico_Movilizado_Digerd > 0) ? $accionesTotales->Total_Equipo_Tecnico_Movilizado_Digerd : 0;
            $Total_Equipo_Tecnico_Movilizado_Minsa = ($accionesTotales->Total_Equipo_Tecnico_Movilizado_Minsa > 0) ? $accionesTotales->Total_Equipo_Tecnico_Movilizado_Minsa : 0;
            $Total_Equipo_Tecnico_Movilizado_Otros = ($accionesTotales->Total_Equipo_Tecnico_Movilizado_Otros > 0) ? $accionesTotales->Total_Equipo_Tecnico_Movilizado_Otros : 0;
                
        }
        
        $accionesDescripcion = $this->EventoAcciones_model->accionesInforme();
        
        $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_ID(0);
        $tabla2 = $this->EventoRegistrarDaniosLesionados_model->tabla2();
        $consolidadoFallecidos = $this->EventoRegistrarDaniosLesionados_model->consolidadoFallecidos();
        $hospitalizadosReferidosObservados = $this->EventoRegistrarDaniosLesionados_model->hospitalizadosReferidosObservados();
        $consolidadoDesaparecidos = $this->EventoRegistrarDaniosLesionados_model->consolidadoDesaparecidos();
        
        $this->EventoRegistroImagen_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $imagenes = $this->EventoRegistroImagen_model->lista();
        $this->EventoEntidadSalud_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $tablaInforme = $this->EventoEntidadSalud_model->tablaInforme();
        
        $IPRESSOperativas = array();
        $IPRESSInoperativas = array();
        
        foreach ($tablaInforme->result() as $row) :
            
            if ($row->Evento_Entidad_Estado == "1") {
                $IPRESSOperativas[] = $row;
            } else {
                $IPRESSInoperativas[] = $row;
            }
        endforeach
        ;
        $evento = $evento->row();
        $this->EventoRegistrar_model->setUsuario($evento->Evento_Usuario_Registro);
        $usuarioR = $this->EventoRegistrar_model->usuariosEvento();
        $this->EventoRegistrar_model->setUsuario($evento->Evento_Usuario_Actualizacion);
        $usuarioA = $this->EventoRegistrar_model->usuariosEvento();
        
        $usuario_creacion = "";
        $usuario_actualizacion = "";
      
        if ($usuarioR->num_rows() > 0) {
            $usuarioR = $usuarioR->row();
            $usuario_creacion = "CREADO POR: " . $usuarioR->usuario;
        }
        if ($usuarioA->num_rows() > 0) {
            $usuarioA = $usuarioA->row();
            $usuario_actualizacion = "ACTUALIZADO POR: " . $usuarioA->usuario;
        }
        
        $Equipos_Tecnicos = $this->EventoAcciones_model->equiposTecnicosFecha();
        
        $this->Asignacion_model->setid($Evento_Registro_Numero);
        $eventomedicamentos = $this->Asignacion_model->eventoMedicamentos();
        $eventoequipos = $this->Asignacion_model->eventoEquipos();
        $eventorecursos = $this->Asignacion_model->eventoRecursos();
        
        $data = array(
            "evento" => $evento,
            "lesionados" => $lesionados,
            "fallecidos" => $fallecidos,
            "desaparecidos" => $desaparecidos,
            "totalMujeres" => $totalMujeres,
            "totalGestantes" => $totalGestantes,
            "totalMenorEdad" => $totalMenorEdad,
            "totalAdultoMayor" => $totalAdultoMayor,
            /*"totalFallecidos" => $totalFallecidos,*/
            "totalIPRESSOperativas" => $totalIPRESSOperativas,
            "totalIPRESSInoperativas" => $totalIPRESSInoperativas,
            "brigadistas" => $brigadistas,
            "emt" => $emt,
            "personalSalud" => $personalSalud,
            "ambulancias" => $ambulancias,
            "medicamentosInsumos" => $medicamentosInsumos,
            "equipotecnicogeneral" => $equipotecnicogeneral,
            "accionesDescripcion" => $accionesDescripcion,
            "tabla2" => $tabla2,
            "consolidadoFallecidos" => $consolidadoFallecidos,
            "hospitalizadosReferidosObservados" => $hospitalizadosReferidosObservados,
            "consolidadoDesaparecidos" => $consolidadoDesaparecidos,
            "imagenes" => $imagenes,
            "IPRESSOperativas" => $IPRESSOperativas,
            "IPRESSInoperativas" => $IPRESSInoperativas,
            "orden" => $orden,
            "usuario_creacion" => $usuario_creacion,
            "usuario_actualizacion" => $usuario_actualizacion,
            "brigadistas_regionales" => $brigadistas_regionales,
            "brigadistas_minsa" => $brigadistas_minsa,
            "rescatistas" => $rescatistas,
            "medicos_tacticos" => $medicos_tacticos,
            "emt_i" => $emt_i,
            "emt_ii" => $emt_ii,
            "emt_iii" => $emt_iii,
            "celula_especializada" => $celula_especializada,
            "Personal_Minsa_Samu" => $Personal_Minsa_Samu,
            "Personal_Salud_Minsa" => $Personal_Salud_Minsa,
            "Personal_Essalud" => $Personal_Essalud,
            "Personal_Municipalidades_Gores" => $Personal_Municipalidades_Gores,
            "Personal_Voluntarios" => $Personal_Voluntarios,
            "Personal_PNP_FFAA" => $Personal_PNP_FFAA,
            "Ambulancias_Minsa_Samu" => $Ambulancias_Minsa_Samu,
            "Ambulancias_Minsa" => $Ambulancias_Minsa,
            "Ambulancias_Essalud" => $Ambulancias_Essalud,
            "Ambulancias_Bomberos" => $Ambulancias_Bomberos,
            "Ambulancias_Municipalidades_Gores" => $Ambulancias_Municipalidades_Gores,
            "Ambulancias_PNP_FFAA" => $Ambulancias_PNP_FFAA,
            "Ambulancianas_Privadas" => $Ambulancianas_Privadas,
            "MI_Emergencias_Desastres" => $MI_Emergencias_Desastres,
            "MI_Kit_Medicamentos_Insumos" => $MI_Kit_Medicamentos_Insumos,
            "MI_Equipo_Biomedicos" => $MI_Equipo_Biomedicos,
            "MI_Puesto_Comando" => $MI_Puesto_Comando,
            "MI_Ac_Victimas" => $MI_Ac_Victimas,
            "MI_Oferta_Movil_i" => $MI_Oferta_Movil_i,
            "MI_Oferta_Movil_ii" => $MI_Oferta_Movil_ii,
            "MI_Oferta_Movil_iii" => $MI_Oferta_Movil_iii,
            "MI_Hospital_Modular" => $MI_Hospital_Modular,
            "MI_Banio_Quimico_Portatil" => $MI_Banio_Quimico_Portatil,
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "Equipos_Tecnicos" => $Equipos_Tecnicos,
            "eventomedicamentos" => $eventomedicamentos,
            "eventoequipos" => $eventoequipos,
            "eventorecursos" => $eventorecursos,
            "Total_Equipo_Tecnico_Movilizado_Diresa" => $Total_Equipo_Tecnico_Movilizado_Diresa,
            "Total_Equipo_Tecnico_Movilizado_Red" => $Total_Equipo_Tecnico_Movilizado_Red,
            "Total_Equipo_Tecnico_Movilizado_Diris" => $Total_Equipo_Tecnico_Movilizado_Diris,
            "Total_Equipo_Tecnico_Movilizado_Ipress" => $Total_Equipo_Tecnico_Movilizado_Ipress,
            "Total_Equipo_Tecnico_Movilizado_Digerd" => $Total_Equipo_Tecnico_Movilizado_Digerd,
            "Total_Equipo_Tecnico_Movilizado_Minsa" => $Total_Equipo_Tecnico_Movilizado_Minsa,
            "Total_Equipo_Tecnico_Movilizado_Otros" => $Total_Equipo_Tecnico_Movilizado_Otros
        );
        
        $vista = "eventos/informeFinal";
        
        if ($orden == "ASC") {
            $vista = "eventos/informe";
        }
        
        $html = $this->load->view($vista, $data, true);
        $this->dom->generate("portrait", "informe", $html, "Informe");
    }

    public function curl()
    {
        $tipo_documento = $this->input->post("type");
        $documento = $this->input->post("document");
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, getenv("API_RENIEC_URL") . $tipo_documento . "/" . $documento . "/");
        curl_setopt($handler, CURLOPT_HEADER, FALSE);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
            "Authorization: " . getenv("API_RENIEC_TOKEN"),
            "Content-Type: application/json"
        ));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
        
        curl_close($handler);
        
        echo $data;
    }

    private function saveImage($evento, $latitud, $longitud, $zoom, $eventoTipo)
    {
        $url = "https://maps.googleapis.com/maps/api/staticmap?language=es&center=" . trim($latitud) . "," . trim($longitud) . "&markers=color:red|label:|" . trim($latitud) . "," . trim($longitud) . "&zoom=" . $zoom . "&size=596x280&key=" . getenv('MAP_KEY');
        $path = getenv('PATH_IMG');
        $img = $path . $evento . "_gm.png";
        
        file_put_contents($img, file_get_contents($url));
        
        if ($eventoTipo == "26") {
            $url2 = "https://maps.googleapis.com/maps/api/staticmap?center=" . trim($latitud) . "," . trim($longitud) . "&markers=color:red|label:|" . trim($latitud) . "," . trim($longitud) . "&zoom=17&size=200x280&key=" . getenv('MAP_KEY');
            
            $img2 = $path . $evento . "_gm_s.png";
            
            file_put_contents($img2, file_get_contents($url2));
            
            $url3 = "https://maps.googleapis.com/maps/api/staticmap?center=" . trim($latitud) . "," . trim($longitud) . "&markers=color:red|label:|" . trim($latitud) . "," . trim($longitud) . "&zoom=4&size=200x280&key=" . getenv('MAP_KEY');
            
            $img3 = $path . $evento . "_gm_s_p.png";
            
            file_put_contents($img3, file_get_contents($url3));
        }
    }
    
    private function saveImageMultipleCoordenadas($evento, $latitud, $longitud, $zoom, $coordenadas)
    {
        $url = "https://maps.googleapis.com/maps/api/staticmap?language=es&center=" . trim($latitud) . "," . trim($longitud) . "&markers=color:red|label:" . $coordenadas . "&size=500x500&key=" . getenv('MAP_KEY');
        $path = getenv('PATH_IMG');
        $img = $path . $evento . "_gm.png";
        
        file_put_contents($img, file_get_contents($url));
    }

    public function listarAsignaciones()
    {
        $this->load->model("Asignacion_model");
        
        $id = $this->input->post("id");
        
        $this->Asignacion_model->setId($id);
        
        $eventoMedicamentos = $this->Asignacion_model->eventoMedicamentos();
        $eventoEquipos = $this->Asignacion_model->eventoEquipos();
        $eventoRecursos = $this->Asignacion_model->eventoRecursos();
        
        $data = array(
            "eventoMedicamentos" => $eventoMedicamentos->result(),
            "eventoEquipos" => $eventoEquipos->result(),
            "eventoRecursos" => $eventoRecursos->result()
        );
        
        echo json_encode($data);
    }

    public function registrarMedicamento()
    {
        $this->load->model("Asignacion_model");
        
        $evento = $this->input->post("id");
        $articulo = $this->input->post("evento_medicamentos_articulo");
        $presentacion = $this->input->post("evento_medicamentos_presentacion_id");
        $cantidad = $this->input->post("evento_medicamentos_cantidad");
        $prioridad = $this->input->post("evento_medicamentos_prioridad");
        
        $this->Asignacion_model->setevento($evento);
        $this->Asignacion_model->setarticulo(strtoupper($articulo));
        $this->Asignacion_model->setpresentacion($presentacion);
        $this->Asignacion_model->setcantidad($cantidad);
        $this->Asignacion_model->setprioridad($prioridad);
        $id = 0;
        $find = $this->Asignacion_model->buscarMedicamento();
        if ($find->num_rows() > 0) {
            $status = 201;
        } else {
            $id = $this->Asignacion_model->registrarMedicamento();
            if ($id > 0) {
                $status = 200;
            }
        }
        
        echo json_encode(array(
            "status" => $status,
            "id" => $id
        ));
    }

    public function registrarEquipo()
    {
        $this->load->model("Asignacion_model");
        
        $evento = $this->input->post("id");
        $descripcion = $this->input->post("evento_equipos_descripcion");
        $fuente = $this->input->post("evento_equipos_fuente");
        $cantidad = $this->input->post("evento_equipos_cantidad");
        $prioridad = $this->input->post("evento_equipos_prioridad");
        
        $this->Asignacion_model->setevento($evento);
        $this->Asignacion_model->setdescripcion(strtoupper($descripcion));
        $this->Asignacion_model->setfuente(strtoupper($fuente));
        $this->Asignacion_model->setcantidad($cantidad);
        $this->Asignacion_model->setprioridad($prioridad);
        $id = 0;
        $find = $this->Asignacion_model->buscarEquipo();
        if ($find->num_rows() > 0) {
            $status = 201;
        } else {
            $id = $this->Asignacion_model->registrarEquipo();
            if ($id > 0) {
                $status = 200;
            }
        }
        
        echo json_encode(array(
            "status" => $status,
            "id" => $id
        ));
    }

    public function registrarRecurso()
    {
        $this->load->model("Asignacion_model");
        
        $evento = $this->input->post("id");
        $profesion = $this->input->post("evento_recursos_humanos_profesion");
        $especialidad = $this->input->post("evento_recursos_humanos_especialidad");
        $cantidad = $this->input->post("evento_recursos_humanos_cantidad");
        $prioridad = $this->input->post("evento_recursos_humanos_prioridad");
        
        $this->Asignacion_model->setevento($evento);
        $this->Asignacion_model->setprofesion(strtoupper($profesion));
        $this->Asignacion_model->setespecialidad(strtoupper($especialidad));
        $this->Asignacion_model->setcantidad($cantidad);
        $this->Asignacion_model->setprioridad($prioridad);
        $id = 0;
        $find = $this->Asignacion_model->buscarRecurso();
        if ($find->num_rows() > 0) {
            $status = 201;
        } else {
            $id = $this->Asignacion_model->registrarRecurso();
            if ($id > 0) {
                $status = 200;
            }
        }
        
        echo json_encode(array(
            "status" => $status,
            "id" => $id
        ));
    }

    public function eliminarMedicamento()
    {
        $this->load->model("Asignacion_model");
        
        $this->setearMes();
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Asignacion_model->setid($id);
        if ($this->Asignacion_model->eliminarMedicamento() == 1) {
            $status = 200;
            $this->session->set_flashdata('messageOK', 'Registro eliminado');
        } else {
            $this->session->set_flashdata('messageError', 'No se puede eliminar');
        }
        
        echo json_encode(array("status" => $status));
    }

    public function eliminarEquipo()
    {
        $this->load->model("Asignacion_model");
        
        $this->setearMes();
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Asignacion_model->setid($id);
        if ($this->Asignacion_model->eliminarEquipo() == 1) {
            $status = 200;
            $this->session->set_flashdata('messageOK', 'Registro eliminado');
        } else {
            $this->session->set_flashdata('messageError', 'No se puede eliminar');
        }
        
        echo json_encode(array("status" => $status));
    }

    public function eliminarRecurso()
    {
        $this->load->model("Asignacion_model");
        
        $this->setearMes();
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Asignacion_model->setid($id);
        if ($this->Asignacion_model->eliminarRecurso() == 1) {
            $status = 200;
            $this->session->set_flashdata('messageOK', 'Registro eliminado');
        } else {
            $this->session->set_flashdata('messageError', 'No se puede eliminar');
        }
        
        echo json_encode(array("status" => $status));
    }
    
    public function EventoTipoEntidadAtencionOfertaMovilLista(){
        
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $rs = $this->EventoTipoEntidadAtencionOfertaMovil_model->lista();
        
        echo json_encode(array("lista"=>$rs->result()));
        
    }

    public function EventoTipoEntidadAtencionOfertaMovilRegistrar(){
        
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Tipo_Entidad_Atencion_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_ID");
        $Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre = $this->input->post("Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre");
        
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Tipo_Entidad_Atencion_ID($Evento_Tipo_Entidad_Atencion_ID);
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre($Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre);
        
        $id = 0;
        $data = array();
        $result = $this->EventoTipoEntidadAtencionOfertaMovil_model->existe();
        if($result->num_rows()>0)
            $data=array("status"=>409,"id"=>$id);
            else {
                $id = $this->EventoTipoEntidadAtencionOfertaMovil_model->registrar();
                $data=array("status"=>200,"id"=>$id);
            }
            echo json_encode($data);
            
    }

    public function eventoTipoEntidadAtencionOfertaMovilEliminar(){
        
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        $this->load->model("EventoFichaAtencionDetalle_model");
        
        $id = $this->input->post("id");
        
        $this->EventoFichaAtencionDetalle_model->setEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID($id);
        $rs = $this->EventoFichaAtencionDetalle_model->contarEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID();
        
        $rsRow = $rs->row();
        $total = $rsRow->total;
        
        if($total>0){
            $this->session->set_flashdata('messageError', 'No se puede eliminar, existen registros en atenciones');
        }
        else{
            $this->EventoTipoEntidadAtencionOfertaMovil_model->setId($id);
            if($this->EventoTipoEntidadAtencionOfertaMovil_model->eliminar()==1) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        }
        
        echo json_encode(array("status" => 200));
    }
    
    public function EventosAsociadosLista(){
        
        $this->load->model("EventoAsociado_Model");

        $eventoasociado = $this->EventoAsociado_Model->listaeasociadomodal();

        echo json_encode(array("listaeasociado"=>$eventoasociado->result()));
        
    }

    public function EventoAsociadoRegistrar(){
        
        $this->load->model("EventoAsociado_Model");
        $Evento_Asociado_Descripcion = $this->input->post("Evento_Asociado_Descripcion");
        
        $this->EventoAsociado_Model->setEvento_Asociado_Descripcion($Evento_Asociado_Descripcion);
        
        $id = 0;
        $data = array();
                $id = $this->EventoAsociado_Model->registrar();
                $data=array("status"=>200,"id"=>$id);
                echo json_encode($data);            
    }
   
    public function eventoAsociadoEliminar(){
        
        $this->load->model("EventoAsociado_Model");

        
        $id = $this->input->post("id");
        
        $this->EventoAsociado_Model->setEvento_Asociado_ID($id);
        $this->EventoAsociado_Model->setEstado(2);
        
        $rs = $this->EventoAsociado_Model->contarEvento_Asociados();
        
        $rsRow = $rs->row();
        $total = $rsRow->total;
        
        if($total>0){
            $this->session->set_flashdata('messageError', 'No se puede Realizar la Anulación debido a que el Evento ya se encuentra Asociado.');
            echo json_encode(array("status" => 200));
        }
        else{
        if($this->EventoAsociado_Model->cambiarEstado()==1) $this->session->set_flashdata('messageOK', 'Evento Anulado');
        echo json_encode(array("status" => 200));
        }
        
    }

    public function eventoAsociadoActivar(){
        
        $this->load->model("EventoAsociado_Model");
        
        $id = $this->input->post("id");
        
        $this->EventoAsociado_Model->setEvento_Asociado_ID($id);
        $this->EventoAsociado_Model->setEstado(1);
        
        if($this->EventoAsociado_Model->cambiarEstado()==1) $this->session->set_flashdata('messageOK', 'Evento Reactivado');
        
        echo json_encode(array("status" => 200));
    }

    public function eventoAsociadoDesactivar(){
        
        $this->load->model("EventoAsociado_Model");
        
        $id = $this->input->post("id");
        
        $this->EventoAsociado_Model->setEvento_Asociado_ID($id);
        $this->EventoAsociado_Model->setEstado(0);
        
        if($this->EventoAsociado_Model->cambiarEstado()==1) $this->session->set_flashdata('messageOK', 'Evento Desactivado');
        
        echo json_encode(array("status" => 200));
    }    
    
    public function grandesEventos() {
        
        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("SuperEvento_model");
        $this->load->model("AlertaPronostico_model");
        
        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        
        $listar = $this->SuperEvento_model->listar();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
       
        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listar" => $listar,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("eventos/grandesEventos", $data);
        
    }

    public function alertasPronosticos() {
        
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
        
        $this->load->view("eventos/alertasPronosticos", $data);
        
    }

    public function alertasNuevosPronosticos() {
        
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
        
        $this->load->view("eventos/alertasPronosticosv2", $data);
        
    }
    
    public function listaalert()
    {

        $anio = $this->input->post('anio');

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("TipoAccion_model");
        
        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $this->AlertaPronostico_model->setAnio($anio);
        $listar = $this->AlertaPronostico_model->listar();
        $listartipacciones = $this->TipoAccion_model->listartipacciones();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
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
        
        $this->load->view("eventos/alertasPronosticos", $data);
    }

    public function filtroEventos() {

        $this->load->model("EventoRegistrar_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $nivelEmergencia = $this->input->post("nivelEmergencia");
        
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");
        
        $data = array();
        
        if (strlen($provincia) > 0 and strlen($distrito) > 0 and strlen($desde) and strlen($hasta)) {
            
            $this->EventoRegistrar_model->setDepartamento($departamento);
            $this->EventoRegistrar_model->setProvincia($provincia);
            $this->EventoRegistrar_model->setDistrito($distrito);
            
            $this->EventoRegistrar_model->setNivelEmergencia($nivelEmergencia);
            
            $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
            $this->EventoRegistrar_model->setEvento($evento);
            
            $this->EventoRegistrar_model->setFechaInicio(formatearFechaParaBD($desde));
            $this->EventoRegistrar_model->setFechaFin(formatearFechaParaBD($hasta));
            
            $this->EventoRegistrar_model->setEstado(array("1","2"));
            $filtrosEvento = $this->EventoRegistrar_model->filtrosEvento();
            
            if ($filtrosEvento->num_rows() > 0) {
                foreach ($filtrosEvento->result() as $row) :

                    $status = ($row->Evento_Estado_Codigo == "1") ? '<span class="label label-success">Monitoreo</span>' : '<span class="label label-default">Cerrado</span>';
                
                    $data[] = array(
                        "Numero" => $row->ANIO . " - " . addCeros5($row->Evento_Secuencia),
                        "TipoEvento" => $row->tipoEvento,
                        "Evento" => $row->evento,
                        "Ubigeo" => $row->ubigeo,
                        "Coordenadas" => $row->Evento_Coordenadas,
                        "Evento_Registro_Numero" => $row->Evento_Registro_Numero,
                        "status" => $status
                    );
                endforeach ;
            }

        }

        $datos = array(
            "data" => $data
        );
        
        echo json_encode($datos);
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

    public function filtroDepartamento() {
        
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

    public function filtroIpressRegion() {
        
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

    public function filtroTipoAccion() {
        
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

        //}

        $datos = array(
            "data" => $data
        );
        
        echo json_encode($datos);

    }

    public function grandesEventosRegistrar() {

        $this->load->model("SuperEvento_model");
        
        $id = $this->input->post("id");

        $Super_Evento_Registro_Titulo = $this->input->post("Super_Evento_Registro_Titulo");
        $Super_Evento_Registro_Nombre = $this->input->post("Super_Evento_Registro_Nombre");
        $Super_Evento_Registro_Descripcion = $this->input->post("Super_Evento_Registro_Descripcion");
        $eventos = $this->input->post("eventos");
        
        $fecha = $this->input->post("fecha");
        $hora = $this->input->post("hora");
        
        $zoom = $this->input->post("zoom");
        $coordenadas = $this->input->post("coordenadas");
        $latitud = $this->input->post("latitud");
        $longitud = $this->input->post("longitud");
        
        $Super_Evento_Registro_Fecha = formatearFechaParaBD($fecha).' '.$hora.':00';

        $this->SuperEvento_model->setSuper_Evento_Registro_Titulo($Super_Evento_Registro_Titulo);
        $this->SuperEvento_model->setSuper_Evento_Registro_Fecha($Super_Evento_Registro_Fecha);
        $this->SuperEvento_model->setSuper_Evento_Registro_Nombre($Super_Evento_Registro_Nombre);
        $this->SuperEvento_model->setSuper_Evento_Registro_Descripcion($Super_Evento_Registro_Descripcion);
        
        if (strlen($id) > 0) {
            $this->editarSuperEvento($id,$eventos,$zoom,$coordenadas,$latitud,$longitud);
        } else {
            $this->crearSuperEvento($eventos,$zoom,$coordenadas,$latitud,$longitud);     
        }
    }

    public function cargarMapa()
    {
        $this->load->model("AlertaPronostico_model");
        
        $mapaaviso = $this->input->post("id");
        
        $this->AlertaPronostico_model->setImagenMapa($mapaaviso);
        
        $lista = $this->AlertaPronostico_model->buscarMapa();
        
        $data = array(
            "lista" => $lista->result()
        );
        
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
                // $this->Notificacion_model->enviarNotificacion();
            }

            echo json_encode(array("status" => 200));
        }
    }

    public function cargarArchivoAviso($file,$update,$id){
        $path = getenv('PATH_DOC_AVISOS');
        
        if (filesize($file["tmp_name"]) > 0) {
            
                $name = "avisos_".date("Ymdhis");
                $data = $_FILES["file"]['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $fullName = $name . '.' . $ext;

                $allowedMimeTypes = array("pdf","doc","docx","PDF","DOC","DOCX");
                                
                if(in_array( $ext, $allowedMimeTypes ) ){
                
                    if (copy($_FILES["file"]["tmp_name"], $path . $fullName)) {    
                        
                        if($update){
                            $file = $this->fileName($id);
                            $this->deleteFile($file);
                        }
                        
                        return $fullName;
                    } else {
                        return false;
                    }
                }
                else{
                    return false;
                }

        }else{
            return false;
        }
    }
    
    private function fileName($id){
        $this->load->model("AlertaPronostico_model");
        $this->AlertaPronostico_model->setId($id);
        $rs = $this->AlertaPronostico_model->archivoAlertaPronostico();
        $file = "";
        if($rs->num_rows()>0){
            $archivo = $rs->row();
            $file = $archivo->Archivo;
        }
        
        return $file;
    }
    
    private function deleteFile($file){
        $path = getenv('PATH_DOC_AVISOS');
        if(strlen($file)>0){
            unlink($path . $file);
        }
        
    }

    private function crearAlertaPronostico($eventos) {
        $alertapro = $this->AlertaPronostico_model->crear();
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

            $this->session->set_flashdata('messageOK', 'Registro Insertado');
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo registrar');
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

    private function crearSuperEvento($eventos,$zoom,$coordenadas,$latitud,$longitud) {
        $superEvento = $this->SuperEvento_model->crear();
        if ( $superEvento > 0 ) {
            $this->load->model("SuperEventoDetalle_model");
            
            $eventos = explode("|", $eventos);
            foreach($eventos as $id):
            $this->SuperEventoDetalle_model->setSuper_Evento_Registro_ID($superEvento);
            $this->SuperEventoDetalle_model->setEvento_Registro_Numero($id);
            $this->SuperEventoDetalle_model->registrar();
            endforeach;
            
            $this->session->set_flashdata('messageOK', 'Registro insertado');
            $this->saveImageMultipleCoordenadas("supereventos/".$superEvento, $latitud, $longitud, $zoom, $coordenadas);
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo registrar');
        }
        
        echo json_encode(array("status" => 200));
    }

    private function editarSuperEvento($idSuperEvento,$eventos,$zoom,$coordenadas,$latitud,$longitud) {
        $this->SuperEvento_model->setId($idSuperEvento);
        $superEvento = $this->SuperEvento_model->editar();

        if ( $superEvento > 0 ) {
            $this->load->model("SuperEventoDetalle_model");
            
            $eventos = explode("|", $eventos);
            $this->SuperEventoDetalle_model->setSuper_Evento_Registro_ID($idSuperEvento);
            $this->SuperEventoDetalle_model->eliminar();

            foreach($eventos as $id):
                $this->SuperEventoDetalle_model->setEvento_Registro_Numero($id);
                $this->SuperEventoDetalle_model->registrar();
            endforeach;

            $this->session->set_flashdata('messageOK', 'Registro editado');
            $this->saveImageMultipleCoordenadas("supereventos/".$idSuperEvento, $latitud, $longitud, $zoom, $coordenadas);
        } else {
            $this->session->set_flashdata('messageError', 'No se pudo editar');
        }

        echo json_encode(array("status" => 200));

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

    public function informesuperevento()
    {
        $this->load->library("dom");
        
        $this->load->model("SuperEvento_model");
        $this->load->model("SuperEventoDetalle_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("EventoRegistrarDanios_model");
        $this->load->model("EventoRegistrarDaniosLesionados_model");
        $this->load->model("EventoAcciones_model");
        $this->load->model("EventoRegistroImagen_model");
        $this->load->model("EventoEntidadSalud_model");
        $this->load->model("Asignacion_model");
        
        $data = $this->uri->segment(4, 0);
        
        $array = desencriptarInforme($data);
        $SuperEvento_Registro_ID = $array[0];
        $orden = $array[1];
        
        if (strlen($SuperEvento_Registro_ID) < 1) {
            redirect('eventos/eventos/grandesEventos');
        }            
        
        $this->SuperEvento_model->setId($SuperEvento_Registro_ID);
        $evento = $this->SuperEvento_model->superEvento();
        
        $this->SuperEventoDetalle_model->setSuper_Evento_Registro_ID($SuperEvento_Registro_ID);
        $ids = $this->SuperEventoDetalle_model->idEventoBySuperEventoId();
        
        $Evento_Registro_Numero = array();
        foreach($ids->result() as $row):
            $Evento_Registro_Numero[] = $row->Evento_Registro_Numero;
        endforeach;
            
            $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
            $listar = $this->EventoRegistrar_model->eventoInforme();
            
            $this->EventoRegistrarDanios_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $this->EventoRegistrarDanios_model->setPrimero(0);
            if ($orden == "ASC") {
                $this->EventoRegistrarDanios_model->setPrimero(1);
            }
            
            $danios = $this->EventoRegistrarDanios_model->datosDanios();

            if ($danios->num_rows() == 0) {
                $lesionados = 0;
                $fallecidos = 0;
                $desaparecidos = 0;
                $totalIPRESSOperativas = 0;
                $totalIPRESSInoperativas = 0;
            } else {
                $danios = $danios->row();
                $lesionados = $danios->Evento_Lesionados;
                $fallecidos = $danios->Evento_Fallecidos;
                $desaparecidos = $danios->Evento_Desaparecidos;
                $totalIPRESSOperativas = $danios->operativas;
                $totalIPRESSInoperativas = $danios->inoperativas;
            }
            
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $this->EventoRegistrarDaniosLesionados_model->setOrden($orden);
            $totalMujeres = $this->EventoRegistrarDaniosLesionados_model->mujeres();
            $totalGestantes = $this->EventoRegistrarDaniosLesionados_model->gestantes();
            $totalMenorEdad = $this->EventoRegistrarDaniosLesionados_model->menorEdad();
            $totalAdultoMayor = $this->EventoRegistrarDaniosLesionados_model->adultoMayor();
            
            if ($totalMujeres->num_rows() == 0) {
                $totalMujeres = 0;
            } else {
                $totalMujeres = $totalMujeres->row();
                $totalMujeres = $totalMujeres->TOTAL;
            }
            
            if ($totalGestantes->num_rows() == 0) {
                $totalGestantes = 0;
            } else {
                $totalGestantes = $totalGestantes->row();
                $totalGestantes = $totalGestantes->TOTAL;
            }
            
            if ($totalMenorEdad->num_rows() == 0) {
                $totalMenorEdad = 0;
            } else {
                $totalMenorEdad = $totalMenorEdad->row();
                $totalMenorEdad = $totalMenorEdad->TOTAL;
            }
            
            if ($totalAdultoMayor->num_rows() == 0) {
                $totalAdultoMayor = 0;
            } else {
                $totalAdultoMayor = $totalAdultoMayor->row();
                $totalAdultoMayor = $totalAdultoMayor->TOTAL;
            }

            $this->EventoAcciones_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $accionesTotales = $this->EventoAcciones_model->totalesInforme();
            
            if ($accionesTotales->num_rows() == 0) {
                $brigadistas = 0;
                $emt = 0;
                $personalSalud = 0;
                $ambulancias = 0;
                $medicamentosInsumos = 0;
                $equipotecnicogeneral = 0;
                
                $brigadistas_regionales = 0;
                $brigadistas_minsa = 0;
                $rescatistas = 0;
                $medicos_tacticos = 0;
                $emt_i = 0;
                $emt_ii = 0;
                $emt_iii = 0;
                $celula_especializada = 0;
                
                $Personal_Minsa_Samu = 0;
                $Personal_Salud_Minsa = 0;
                $Personal_Essalud = 0;
                $Personal_Municipalidades_Gores = 0;
                $Personal_Voluntarios = 0;
                $Personal_PNP_FFAA = 0;
                
                $Ambulancias_Minsa_Samu = 0;
                $Ambulancias_Minsa = 0;
                $Ambulancias_Essalud = 0;
                $Ambulancias_Bomberos = 0;
                $Ambulancias_Municipalidades_Gores = 0;
                $Ambulancias_PNP_FFAA = 0;
                $Ambulancianas_Privadas = 0;
                
                $MI_Emergencias_Desastres = 0;
                $MI_Kit_Medicamentos_Insumos = 0;
                $MI_Equipo_Biomedicos = 0;
                $MI_Puesto_Comando = 0;
                $MI_Ac_Victimas = 0;
                $MI_Oferta_Movil_i = 0;
                $MI_Oferta_Movil_ii = 0;
                $MI_Oferta_Movil_iii = 0;
                $MI_Hospital_Modular = 0;
                $MI_Banio_Quimico_Portatil = 0;
            } else {
                $accionesTotales = $accionesTotales->row();
                $brigadistas = ($accionesTotales->brigadistas > 0) ? $accionesTotales->brigadistas : 0;
                $emt = ($accionesTotales->emt > 0) ? $accionesTotales->emt : 0;
                $personalSalud = ($accionesTotales->personalSalud > 0) ? $accionesTotales->personalSalud : 0;
                $ambulancias = ($accionesTotales->ambulancias > 0) ? $accionesTotales->ambulancias : 0;
                $medicamentosInsumos = ($accionesTotales->medicamentosInsumos > 0) ? $accionesTotales->medicamentosInsumos : 0;
                $equipotecnicogeneral= ($accionesTotales->equipotecnicogeneral > 0) ? $accionesTotales->equipotecnicogeneral : 0;
                
                $brigadistas_regionales = ($accionesTotales->brigadistas_regionales > 0) ? $accionesTotales->brigadistas_regionales : 0;
                $brigadistas_minsa = ($accionesTotales->brigadistas_minsa > 0) ? $accionesTotales->brigadistas_minsa : 0;
                $rescatistas = ($accionesTotales->rescatistas > 0) ? $accionesTotales->rescatistas : 0;
                $medicos_tacticos = ($accionesTotales->medicos_tacticos > 0) ? $accionesTotales->medicos_tacticos : 0;
                $emt_i = ($accionesTotales->emt_i > 0) ? $accionesTotales->emt_i : 0;
                $emt_ii = ($accionesTotales->emt_ii > 0) ? $accionesTotales->emt_ii : 0;
                $emt_iii = ($accionesTotales->emt_iii > 0) ? $accionesTotales->emt_iii : 0;
                $celula_especializada = ($accionesTotales->celula_especializada > 0) ? $accionesTotales->celula_especializada : 0;
                
                $Personal_Minsa_Samu = ($accionesTotales->Personal_Minsa_Samu > 0) ? $accionesTotales->Personal_Minsa_Samu : 0;
                $Personal_Salud_Minsa = ($accionesTotales->Personal_Salud_Minsa > 0) ? $accionesTotales->Personal_Salud_Minsa : 0;
                $Personal_Essalud = ($accionesTotales->Personal_Essalud > 0) ? $accionesTotales->Personal_Essalud : 0;
                $Personal_Municipalidades_Gores = ($accionesTotales->Personal_Municipalidades_Gores > 0) ? $accionesTotales->Personal_Municipalidades_Gores : 0;
                $Personal_Voluntarios = ($accionesTotales->Personal_Voluntarios > 0) ? $accionesTotales->Personal_Voluntarios : 0;
                $Personal_PNP_FFAA = ($accionesTotales->Personal_PNP_FFAA > 0) ? $accionesTotales->Personal_PNP_FFAA : 0;
                $Ambulancias_Minsa_Samu = ($accionesTotales->Ambulancias_Minsa_Samu > 0) ? $accionesTotales->Ambulancias_Minsa_Samu : 0;
                $Ambulancias_Minsa = ($accionesTotales->Ambulancias_Minsa > 0) ? $accionesTotales->Ambulancias_Minsa : 0;
                $Ambulancias_Essalud = ($accionesTotales->Ambulancias_Essalud > 0) ? $accionesTotales->Ambulancias_Essalud : 0;
                $Ambulancias_Bomberos = ($accionesTotales->Ambulancias_Bomberos > 0) ? $accionesTotales->Ambulancias_Bomberos : 0;
                $Ambulancias_Municipalidades_Gores = ($accionesTotales->Ambulancias_Municipalidades_Gores > 0) ? $accionesTotales->Ambulancias_Municipalidades_Gores : 0;
                $Ambulancias_PNP_FFAA = ($accionesTotales->Ambulancias_PNP_FFAA > 0) ? $accionesTotales->Ambulancias_PNP_FFAA : 0;
                $Ambulancianas_Privadas = ($accionesTotales->Ambulancianas_Privadas > 0) ? $accionesTotales->Ambulancianas_Privadas : 0;
                $MI_Emergencias_Desastres = ($accionesTotales->MI_Emergencias_Desastres > 0) ? $accionesTotales->MI_Emergencias_Desastres : 0;
                $MI_Kit_Medicamentos_Insumos = ($accionesTotales->MI_Kit_Medicamentos_Insumos > 0) ? $accionesTotales->MI_Kit_Medicamentos_Insumos : 0;
                $MI_Equipo_Biomedicos = ($accionesTotales->MI_Equipo_Biomedicos > 0) ? $accionesTotales->MI_Equipo_Biomedicos : 0;
                $MI_Puesto_Comando = ($accionesTotales->MI_Puesto_Comando > 0) ? $accionesTotales->MI_Puesto_Comando : 0;
                $MI_Ac_Victimas = ($accionesTotales->MI_Ac_Victimas > 0) ? $accionesTotales->MI_Ac_Victimas : 0;
                $MI_Oferta_Movil_i = ($accionesTotales->MI_Oferta_Movil_i > 0) ? $accionesTotales->MI_Oferta_Movil_i : 0;
                $MI_Oferta_Movil_ii = ($accionesTotales->MI_Oferta_Movil_ii > 0) ? $accionesTotales->MI_Oferta_Movil_ii : 0;
                $MI_Oferta_Movil_iii = ($accionesTotales->MI_Oferta_Movil_iii > 0) ? $accionesTotales->MI_Oferta_Movil_iii : 0;
                $MI_Hospital_Modular = ($accionesTotales->MI_Hospital_Modular > 0) ? $accionesTotales->MI_Hospital_Modular : 0;
                $MI_Banio_Quimico_Portatil = ($accionesTotales->MI_Banio_Quimico_Portatil > 0) ? $accionesTotales->MI_Banio_Quimico_Portatil : 0;
            }
            
            $accionesDescripcion = $this->EventoAcciones_model->accionesInforme();
            
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_ID(0);
            $tabla2 = $this->EventoRegistrarDaniosLesionados_model->tabla2();
            $consolidadoFallecidos = $this->EventoRegistrarDaniosLesionados_model->consolidadoFallecidos();
            $hospitalizadosReferidosObservados = $this->EventoRegistrarDaniosLesionados_model->hospitalizadosReferidosObservados();
            $consolidadoDesaparecidos = $this->EventoRegistrarDaniosLesionados_model->consolidadoDesaparecidos();
            
            $this->EventoRegistroImagen_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $imagenes = $this->EventoRegistroImagen_model->lista();
            $this->EventoEntidadSalud_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $tablaInforme = $this->EventoEntidadSalud_model->tablaInforme();
            
            $IPRESSOperativas = array();
            $IPRESSInoperativas = array();
            
            foreach ($tablaInforme->result() as $row) :
            
            if ($row->Evento_Entidad_Estado == "1") {
                $IPRESSOperativas[] = $row;
            } else {
                $IPRESSInoperativas[] = $row;
            }
            endforeach
            ;

            $Equipos_Tecnicos = $this->EventoAcciones_model->equiposTecnicosFecha();
            
            $this->Asignacion_model->setid($Evento_Registro_Numero);
            $eventomedicamentos = $this->Asignacion_model->eventoMedicamentos();
            $eventoequipos = $this->Asignacion_model->eventoEquipos();
            $eventorecursos = $this->Asignacion_model->eventoRecursos();
            
            $data = array(
                "evento" => $evento->row(),
                "listaEventos" => $listar,
                "lesionados" => $lesionados,
                "fallecidos" => $fallecidos,
                "desaparecidos" => $desaparecidos,
                "totalMujeres" => $totalMujeres,
                "totalGestantes" => $totalGestantes,
                "totalMenorEdad" => $totalMenorEdad,
                "totalAdultoMayor" => $totalAdultoMayor,
                "totalIPRESSOperativas" => $totalIPRESSOperativas,
                "totalIPRESSInoperativas" => $totalIPRESSInoperativas,
                "brigadistas" => $brigadistas,
                "emt" => $emt,
                "personalSalud" => $personalSalud,
                "ambulancias" => $ambulancias,
                "medicamentosInsumos" => $medicamentosInsumos,
                "equipotecnicogeneral" => $equipotecnicogeneral,
                "accionesDescripcion" => $accionesDescripcion,
                "tabla2" => $tabla2,
                "consolidadoFallecidos" => $consolidadoFallecidos,
                "hospitalizadosReferidosObservados" => $hospitalizadosReferidosObservados,
                "consolidadoDesaparecidos" => $consolidadoDesaparecidos,
                "imagenes" => $imagenes,
                "IPRESSOperativas" => $IPRESSOperativas,
                "IPRESSInoperativas" => $IPRESSInoperativas,
                "orden" => $orden,
                "brigadistas_regionales" => $brigadistas_regionales,
                "brigadistas_minsa" => $brigadistas_minsa,
                "rescatistas" => $rescatistas,
                "medicos_tacticos" => $medicos_tacticos,
                "emt_i" => $emt_i,
                "emt_ii" => $emt_ii,
                "emt_iii" => $emt_iii,
                "celula_especializada" => $celula_especializada,
                "Personal_Minsa_Samu" => $Personal_Minsa_Samu,
                "Personal_Salud_Minsa" => $Personal_Salud_Minsa,
                "Personal_Essalud" => $Personal_Essalud,
                "Personal_Municipalidades_Gores" => $Personal_Municipalidades_Gores,
                "Personal_Voluntarios" => $Personal_Voluntarios,
                "Personal_PNP_FFAA" => $Personal_PNP_FFAA,
                "Ambulancias_Minsa_Samu" => $Ambulancias_Minsa_Samu,
                "Ambulancias_Minsa" => $Ambulancias_Minsa,
                "Ambulancias_Essalud" => $Ambulancias_Essalud,
                "Ambulancias_Bomberos" => $Ambulancias_Bomberos,
                "Ambulancias_Municipalidades_Gores" => $Ambulancias_Municipalidades_Gores,
                "Ambulancias_PNP_FFAA" => $Ambulancias_PNP_FFAA,
                "Ambulancianas_Privadas" => $Ambulancianas_Privadas,
                "MI_Emergencias_Desastres" => $MI_Emergencias_Desastres,
                "MI_Kit_Medicamentos_Insumos" => $MI_Kit_Medicamentos_Insumos,
                "MI_Equipo_Biomedicos" => $MI_Equipo_Biomedicos,
                "MI_Puesto_Comando" => $MI_Puesto_Comando,
                "MI_Ac_Victimas" => $MI_Ac_Victimas,
                "MI_Oferta_Movil_i" => $MI_Oferta_Movil_i,
                "MI_Oferta_Movil_ii" => $MI_Oferta_Movil_ii,
                "MI_Oferta_Movil_iii" => $MI_Oferta_Movil_iii,
                "MI_Hospital_Modular" => $MI_Hospital_Modular,
                "MI_Banio_Quimico_Portatil" => $MI_Banio_Quimico_Portatil,
                "Evento_Registro_Numero" => $Evento_Registro_Numero,
                "Equipos_Tecnicos" => $Equipos_Tecnicos,
                "eventomedicamentos" => $eventomedicamentos,
                "eventoequipos" => $eventoequipos,
                "eventorecursos" => $eventorecursos
            );
            
            $vista = "eventos/informeSuperEventoFinal";
            
            if ($orden == "ASC") {
                $vista = "eventos/informeSuperEvento";
            }
            $html = $this->load->view($vista, $data, true);
            $this->dom->generate("portrait", "informe", $html, "Informe");
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

    public function cambiarEstadoSuperEvento()
    {
        
        $this->load->model("SuperEvento_model");
        
        $Evento_Estado_Codigo = $this->input->post("Evento_Estado_Codigo");
        $Super_Evento_Registro_ID = $this->input->post("Super_Evento_Registro_ID");

        $this->SuperEvento_model->setEstado($Evento_Estado_Codigo);
        $this->SuperEvento_model->setId($Super_Evento_Registro_ID);
            
            if ($this->SuperEvento_model->cambiarEstado() > 0) {
                $this->session->set_flashdata('messageOK', 'El super evento ha sido actualizado');
            } else {
                $this->session->set_flashdata('messageError', 'Error al actualizar el super evento');
            }
            header("location:" . base_url() . "eventos/eventos/grandesEventos");
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
        $fech_accion = formatearFechaParaBD($fecha_accion).' '.$hora_accion.':00';
        
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

    public function listarregiones()
    {
        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
        
        $this->AlertaPronostico_model->setId($id);
        $listarregiones = $this->AlertaPronostico_model->listarregiones();
        
        echo json_encode(array("listarregiones"=>$listarregiones->result()));
        
    }

    public function listarejecutoras()
    {
        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
        
        $this->AlertaPronostico_model->setDepartamento($id);
        $listaejecutoras = $this->AlertaPronostico_model->listaEjecutoras();
        
        echo json_encode(array("listarejecutoras"=>$listaejecutoras->result()));
        
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

    public function eliminarAccionAviso()
    {

        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
 
        $status = 500;
        $this->AlertaPronostico_model->setIdAccion($id);
        if($this->AlertaPronostico_model->eliminarAccionAviso() == 1 ) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        else { $this->session->set_flashdata('messageError', 'No se puede eliminar'); }

        redirect('eventos/listaalertas');

    }
    
    public function eliminarRecomendacionAviso()
    {

        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
 
        $status = 500;
        $this->AlertaPronostico_model->setIdRecomendacion($id);
        if($this->AlertaPronostico_model->eliminarRecomendacionAviso() == 1 ) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        else { $this->session->set_flashdata('messageError', 'No se puede eliminar'); }

        redirect('eventos/listaalertas');

    }
    
    public function dashboard()
    {
        $nivel = 1;
        $idmenu = 2;
        
        validarPermisos($nivel, $idmenu, $this->permisos);
        
        $anio = $this->input->post('anio');
        $mes = $this->input->post('mes');
        
        if (strlen($anio) < 1 or strlen($mes) < 1) {
            $anio = date('Y');
            $mes = $this->session->userdata('mes');
            if (strlen($mes) > 0) {
                $this->session->set_userdata('mes', $mes);
            } else {
                $mes = date('m');
            }
        } else {
            $this->session->set_userdata('mes', $mes);
        }
        
        $this->load->model("EventoRegistrar_model");
        $this->load->model("Asignacion_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("AlertaPronostico_model");
        
        $this->EventoRegistrar_model->setAnio($anio);
        $this->EventoRegistrar_model->setMes($mes);
        $lista = $this->EventoRegistrar_model->lista();
        $rs = $this->EventoTipoEntidadAtencion_model->lista();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $medicamentos = $this->Asignacion_model->listaMedicamentosPresentacion();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        
        $datos = array();
        
        if ($lista->num_rows() > 0) {
            $orden = 1;
            foreach ($lista->result() as $row) :
                
                $datos[] = array(
                    "evento" => $row->evento,
                    "fecha" => $row->fecha,
                    "Evento_Estado_Codigo" => $row->Evento_Estado_Codigo,
                    "Evento_Registro_Numero" => $row->Evento_Registro_Numero,
                    "ubigeo" => $row->ubigeo,
                    "Evento_Coordenadas" => $row->Evento_Coordenadas,
                    "orden" => $orden,
                    "danios" => $row->danios,
                    "lesionados" => $row->lesionados,
                    "acciones" => $row->acciones,
                    "salud" => $row->salud,
                    "codigo" => $row->ANIO . " - " . addCeros5($row->Evento_Secuencia)
                );
                $orden ++;
            endforeach
            ;
        }
        
        $data = array(
            "lista" => $datos,
            "listaEntidadAtencion" => $rs->result(),
            "medicamentos" => $medicamentos,
            "anio" => $anio,
            "mes" => $mes,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaralerta" => $listaralerta            
        );
        
        $this->load->view("eventos/dashboardEventos", $data);
    }

    public function fileseventos()
    {
        $this->load->model("EventoRegistroFile_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Asignacion_model");
        
        $this->setearMes();
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $this->EventoRegistroFile_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
		$danios = $this->EventoRegistrar_model->danios();
        $lista = $this->EventoRegistroFile_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
		        
        $tipoEntidadAtencion = $this->EventoTipoEntidadAtencion_model->lista();
        $medicamentos = $this->Asignacion_model->listaMedicamentosPresentacion();

        $rowDanios = $danios->row();
        
        $this->Ubigeo_model->setCodigo_Departamento($rowDanios->COD_DEPA);
        $this->Ubigeo_model->setCodigo_Provincia($rowDanios->COD_PROV);
        
        $departamentos = $this->Ubigeo_model->departamentos();
        $provincias = $this->Ubigeo_model->provincias();
        $distritos = $this->Ubigeo_model->distritos();

        $data = array(
            "danios" => $danios->row(),
            "departamentos" => $departamentos->result(),
            "provincias" => $provincias->result(),
            "distritos" => $distritos->result(),
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "lista" => $lista,
            "listaEntidadAtencion" => $tipoEntidadAtencion->result(),
            "medicamentos" => $medicamentos,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("eventos/fileseventos", $data);
    }

    public function agregarFile()
    {
        $this->load->model("EventoRegistroFile_model");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $path = getenv('PATH_FILES');
        $estado = 0;
        
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            
            if ($_FILES["file"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                
                $data = $_FILES["file"]['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $file = $name . '.' . $ext;
                copy($_FILES["file"]["tmp_name"], $path . $file);
                $this->EventoRegistroFile_model->setEvento_Registro_Numero($Evento_Registro_Numero);
                $this->EventoRegistroFile_model->setFile($file);
                $this->EventoRegistroFile_model->registrar();
                
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

    public function editarFile()
    {
        $this->load->model("EventoRegistroFile_model");
        $id = $this->input->post("Evento_Registro_File_Numero");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $files = $this->input->post("files");
        $descripcion = $this->input->post("descripcion");
        $path = getenv('PATH_FILES');
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
        $this->load->model("EventoRegistroFile_model");
        $id = $this->input->post("Evento_Registro_File_Numero");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $files = $this->input->post("files");
        $path = getenv('PATH_FILES');
        if (file_exists($path . $files))
            unlink($path . $files);        
        $this->EventoRegistroFile_model->setId($id);
        $this->EventoRegistroFile_model->eliminar();
        
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $this->EventoRegistrar_model->actualizarFecha();
        
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
}
