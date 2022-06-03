<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        
        $token = $this->session->userdata("token");
        
        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");
        
        $this->session->set_userdata("idmodulo", 5);
        
        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
        
        if(sha1($usuario)==$token->usuario){
            
            if (count($token->modulos)>0) {
                
                $listaModulos = $token->modulos;
                
                $permanecer = false;
                
                foreach ($listaModulos as $row) :
                if ($row->idmodulo == 5 and $row->estado == 1)
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
        $this->load->model("AlertaPronostico_model");
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $data = array("listaralerta" => $listaralerta);

        $this->load->view("tablas/Main", $data);
    }
    
    public function evento() {
        $this->load->model("EventoTipo_model");
        $this->load->model("Evento_model");
        $this->load->model("AlertaPronostico_model");

        $listaTipoEventos = $this->EventoTipo_model->lista();
        $lista = $this->Evento_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array("listaTipoEventos" => $listaTipoEventos, "lista" => $lista, "listaralerta" => $listaralerta);
        $this->load->view("tablas/Eventos", $data);
    }
    
    public function eventoGestionar() {
        $this->load->model("Evento_model");
        
        $Evento_Tipo_Codigo = $this->input->post("Codigo_Tipo_Evento");
        $Evento_Codigo = $this->input->post("Evento_Codigo");
        $Evento_Nombre = $this->input->post("Evento_Nombre");
        
        $isUpdate = true;
        if (strlen($Evento_Codigo) == 0) {
            $isUpdate = false;
        }
        
        $this->Evento_model->setEvento_Nombre(strtoupper($Evento_Nombre));
        
        if ($isUpdate) {
            $this->Evento_model->setEvento_Codigo($Evento_Codigo);
            $Evento_Tipo_Codigo = $this->input->post("Evento_Tipo_Codigo");
            $this->Evento_model->setTipoEvento($Evento_Tipo_Codigo);
            if($this->Evento_model->editar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El evento fue editado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo editar el evento');
            }
        } else {
            $this->Evento_model->setTipoEvento($Evento_Tipo_Codigo);
            $Evento_Codigo = $this->Evento_model->obtenerCodigoMayor() + 1;
            $Evento_Codigo = addCero($Evento_Codigo);
            $this->Evento_model->setEvento_Codigo($Evento_Codigo);
            if($this->Evento_model->crear() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'Se creo el evento');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo crear el evento');
            }
        }
        redirect("tablas/main/evento");
    }
    
    public function eventoEliminar() {
        $this->load->model("EventoDetalle_model");
        $this->load->model("Evento_model");
        
        $Evento_Tipo_Codigo = $this->input->post("Evento_Tipo_Codigo");
        $Evento_Codigo = $this->input->post("Evento_Codigo");
        
        $this->EventoDetalle_model->setTipoEvento($Evento_Tipo_Codigo);
        $this->EventoDetalle_model->setEvento($Evento_Codigo);
        $rsExisteEventosDetalle = $this->EventoDetalle_model->existePorTipoEventoYEvento();
        
        $existeEventosDetalle = false;
        if ( $rsExisteEventosDetalle->num_rows() > 0 ) {
            $existeEventosDetalle = true;
        }
        
        if ($existeEventosDetalle) {
           $this->session->set_flashdata('mensajeError', 'No se pudo eliminar, tiene detalle evento');
        } else {            
            $this->Evento_model->setTipoEvento($Evento_Tipo_Codigo);
            $this->Evento_model->setEvento_Codigo($Evento_Codigo);

            if($this->Evento_model->eliminar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El evento fue eliminado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo eliminar el evento');
            }
        }
        redirect("tablas/main/evento");        
        
    }
    
    public function eventoDetalle() {
        $this->load->model("EventoTipo_model");
        $this->load->model("EventoDetalle_model");
        $listaTipoEventos = $this->EventoTipo_model->lista();
        $lista = $this->EventoDetalle_model->listaEventosDetalle();
        
        $data = array("listaTipoEventos" => $listaTipoEventos, "lista" => $lista);
        $this->load->view("tablas/EventosDetalle", $data);
    }
    
    public function cargarEvento(){
        
        $this->load->model("Evento_model");
        
        $tipoEvento = $this->input->post("tipoEvento");
        
        $this->Evento_model->setTipoEvento($tipoEvento);
        $lista = $this->Evento_model->listaTipo();
        $lista = $lista->result();
        
        echo json_encode($lista);
    }
    
    public function eventoDetalleGestionar() {
        $this->load->model("EventoDetalle_model");
        
        $Evento_Tipo_Codigo = $this->input->post("Codigo_Tipo_Evento");
        $Evento_Codigo = $this->input->post("Codigo_Evento");
        $Evento_Detalle_Codigo = $this->input->post("Evento_Detalle_Codigo");
        $Evento_Detalle_Nombre = $this->input->post("Evento_Detalle_Nombre");
        
        $isUpdate = true;
        if (strlen($Evento_Detalle_Codigo) == 0) {
            $isUpdate = false;
        }
        
        $this->EventoDetalle_model->setEvento_Detalle_Nombre(strtoupper($Evento_Detalle_Nombre));
        
        if ($isUpdate) {
            $Evento_Tipo_Codigo = $this->input->post("Evento_Tipo_Codigo");
            $Evento_Codigo = $this->input->post("Evento_Codigo");
            $this->EventoDetalle_model->setTipoEvento($Evento_Tipo_Codigo);
            $this->EventoDetalle_model->setEvento($Evento_Codigo);
            $this->EventoDetalle_model->setEvento_Detalle_Codigo($Evento_Detalle_Codigo);
            if($this->EventoDetalle_model->editar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El evento detalle fue editado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo editar el evento detalle');
            }
        } else {
            $this->EventoDetalle_model->setTipoEvento($Evento_Tipo_Codigo);
            $this->EventoDetalle_model->setEvento($Evento_Codigo);
            $Evento_Detalle_Codigo = $this->EventoDetalle_model->obtenerCodigoMayor() + 1;
            $Evento_Detalle_Codigo = addCero($Evento_Detalle_Codigo);
            $this->EventoDetalle_model->setEvento_Detalle_Codigo($Evento_Detalle_Codigo);
            if($this->EventoDetalle_model->crear() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'Se creo el evento detalle');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo crear el evento detalle');
            }
        }
        redirect("tablas/main/eventoDetalle");
    }

    public function eventoDetalleEliminar() {
        $this->load->model("EventoDetalle_model");
        $this->load->model("EventoRegistrar_model");

        $Evento_Tipo_Codigo = $this->input->post("Evento_Tipo_Codigo");
        $Evento_Codigo = $this->input->post("Evento_Codigo");
        $Evento_Detalle_Codigo = $this->input->post("Evento_Detalle_Codigo");

        $this->EventoRegistrar_model->setTipoEvento($Evento_Tipo_Codigo);
        $this->EventoRegistrar_model->setEvento($Evento_Codigo);
        $this->EventoRegistrar_model->setDetalle($Evento_Detalle_Codigo);
        $rsExisteEventoRegistro = $this->EventoRegistrar_model->eventoRegistroByTipoEventoAndEventoAndDetalleEvento();

        $existeEventoRegistro = false;
        $row = $rsExisteEventoRegistro->row();
        if ( $row->total > 0 ) {
            $existeEventoRegistro = true;
        }

        if ($existeEventoRegistro) {
            $this->session->set_flashdata('mensajeError', 'No se pudo eliminar, tiene registro de eventos');
        } else {
            $this->EventoDetalle_model->setTipoEvento($Evento_Tipo_Codigo);
            $this->EventoDetalle_model->setEvento($Evento_Codigo);
            $this->EventoDetalle_model->setEvento_Detalle_Codigo($Evento_Detalle_Codigo);

            if($this->EventoDetalle_model->eliminar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El evento detalle fue eliminado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo eliminar el evento detalle');
            }
        }

        redirect("tablas/main/eventoDetalle");

    }
    
    public function eventoFuente() {
        $this->load->model("EventoFuente_model");
        $lista = $this->EventoFuente_model->lista();
        
        $data = array( "lista" => $lista);
        $this->load->view("tablas/Fuente", $data);
    }
    
    public function eventoFuenteGestionar() {
        $this->load->model("EventoFuente_model");
        
        $Evento_Fuente_Codigo = $this->input->post("Evento_Fuente_Codigo");
        $Evento_Fuente_Descripcion = $this->input->post("Evento_Fuente_Descripcion");
        
        $isUpdate = true;
        if (strlen($Evento_Fuente_Codigo) == 0) {
            $isUpdate = false;
        }
        
        $this->EventoFuente_model->setEvento_Fuente_Descripcion(strtoupper($Evento_Fuente_Descripcion));
        
        if ($isUpdate) {
            $this->EventoFuente_model->setEvento_Fuente_Codigo($Evento_Fuente_Codigo);
            if($this->EventoFuente_model->editar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El evento fuente fue editado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo editar el evento fuente');
            }
        } else {
            $Evento_Fuente_Codigo = $this->EventoFuente_model->obtenerCodigoMayor() + 1;
            $Evento_Fuente_Codigo = addCero($Evento_Fuente_Codigo);
            $this->EventoFuente_model->setEvento_Fuente_Codigo($Evento_Fuente_Codigo);
            if($this->EventoFuente_model->crear() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'Se creo el evento fuente');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo crear el evento fuente');
            }
        }
        redirect("tablas/main/eventoFuente");
    }

    public function eventoFuenteEliminar() {
        $this->load->model("EventoFuente_model");
        $this->load->model("EventoRegistrar_model");

        $Evento_Fuente_Codigo = $this->input->post("Evento_Fuente_Codigo");

        $this->EventoRegistrar_model->setFuenteInicial($Evento_Fuente_Codigo);
        $rsExisteEventoRegistro = $this->EventoRegistrar_model->eventoRegistroByEventoFuente();
        
        $existeEventoRegistro = false;
        $row = $rsExisteEventoRegistro->row();
        if ( $row->total > 0 ) {
            $existeEventoRegistro = true;
        }
        
        if ($existeEventoRegistro) {
            $this->session->set_flashdata('mensajeError', 'No se pudo eliminar, tiene registro de eventos');
        } else {
            $this->EventoFuente_model->setEvento_Fuente_Codigo($Evento_Fuente_Codigo);
            
            if($this->EventoFuente_model->eliminar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El evento detalle fue eliminado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo eliminar el evento detalle');
            }
        }
        
        redirect("tablas/main/eventoFuente");
        
    }
    
    public function tipoAccion() {
        $this->load->model("TipoAccion_model");
        $lista = $this->TipoAccion_model->lista();
        
        $data = array( "lista" => $lista);
        $this->load->view("tablas/tipoAccion", $data);
    }
    
    public function tipoAccionGestionar() {
        $this->load->model("TipoAccion_model");
        
        $Tipo_Accion_Codigo = $this->input->post("Tipo_Accion_Codigo");
        $Tipo_Accion_Descripcion = $this->input->post("Tipo_Accion_Descripcion");
        
        $isUpdate = true;
        if (strlen($Tipo_Accion_Codigo) == 0) {
            $isUpdate = false;
        }
        
        $this->TipoAccion_model->setTipo_Accion_Descripcion(strtoupper($Tipo_Accion_Descripcion));
        
        if ($isUpdate) {
            $this->TipoAccion_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
            if($this->TipoAccion_model->editar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El tipo acci&oacute;n fue editado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo editar el tipo acci&oacute;n');
            }
        } else {
            $Tipo_Accion_Codigo = $this->TipoAccion_model->obtenerCodigoMayor() + 1;
            $Tipo_Accion_Codigo = addCero($Tipo_Accion_Codigo);
            $this->TipoAccion_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
            if($this->TipoAccion_model->crear() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'Se creo el tipo acci&oacute;n');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo crear el tipo acci&oacute;n');
            }
        }
        redirect("tablas/main/tipoAccion");
    }

    public function tipoAccionEliminar() {
        $this->load->model("TipoAccionEntidad_model");
        $this->load->model("TipoAccionEntidad_model");

        $Tipo_Accion_Codigo = $this->input->post("Tipo_Accion_Codigo");

        $this->TipoAccionEntidad_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
        $rsExisteEntidades = $this->TipoAccionEntidad_model->entidadesPorTipoAccion();

        $existeEntidades = false;
        $row = $rsExisteEntidades->row();
        if ( $row->total > 0 ) {
            $existeEntidades = true;
        }

        if ($existeEntidades) {
            $this->session->set_flashdata('mensajeError', 'No se pudo eliminar, tiene registro(s) de tipo entidad atenci&oacute;n');
        } else {
            $this->TipoAccion_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);

            if($this->TipoAccion_model->eliminar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El evento detalle fue eliminado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo eliminar el evento detalle');
            }
        }

        redirect("tablas/main/tipoAccion");

    }

    public function tipoAccionEntidad() {
        $this->load->model("TipoAccionEntidad_model");
        $this->load->model("TipoAccion_model");
        $lista = $this->TipoAccionEntidad_model->lista();
        $tipoaccion = $this->TipoAccion_model->listar();
        
        $data = array( "lista" => $lista, "tipoaccion" => $tipoaccion);
        $this->load->view("tablas/tipoAccionEntidad", $data);
    }
    
    public function tipoAccionEntidadGestionar() {
        $this->load->model("TipoAccionEntidad_model");
        
        $Tipo_Accion_Codigo = $this->input->post("Tipo_Accion_Codigo");
        $Tipo_Accion_Entidad_Codigo = $this->input->post("Tipo_Accion_Entidad_Codigo");
        $Tipo_Accion_Entidad_Nombre = $this->input->post("Tipo_Accion_Entidad_Nombre");
        
        $isUpdate = true;
        if (strlen($Tipo_Accion_Entidad_Codigo) == 0) {
            $isUpdate = false;
        }
        
        $this->TipoAccionEntidad_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
        $this->TipoAccionEntidad_model->setTipo_Accion_Entidad_Nombre(strtoupper($Tipo_Accion_Entidad_Nombre));

        if ($isUpdate) {
            $this->TipoAccionEntidad_model->setTipo_Accion_Entidad_Codigo($Tipo_Accion_Entidad_Codigo);
            if($this->TipoAccionEntidad_model->editar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El tipo acci&oacute;n entidad fue editado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo editar el tipo acci&oacute;n entidad');
            }
        } else {
            $Tipo_Accion_Entidad_Codigo = $this->TipoAccionEntidad_model->obtenerCodigoMayor() + 1;
            $Tipo_Accion_Entidad_Codigo = addCero($Tipo_Accion_Entidad_Codigo);
            $this->TipoAccionEntidad_model->setTipo_Accion_Entidad_Codigo($Tipo_Accion_Entidad_Codigo);
            if($this->TipoAccionEntidad_model->crear() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'Se creo el tipo acci&oacute;n entidad');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo crear el tipo acci&oacute;n entidad');
            }
        }
        redirect("tablas/main/tipoAccionEntidad");
    }
    
    public function tipoAccionEntidadEliminar() {
        $this->load->model("TipoAccionEntidad_model");
        $this->load->model("EventoAcciones_model");
        
        $Tipo_Accion_Codigo = $this->input->post("Tipo_Accion_Codigo");
        $Tipo_Accion_Entidad_Codigo = $this->input->post("Tipo_Accion_Entidad_Codigo");
        
        $this->EventoAcciones_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
        $this->EventoAcciones_model->setTipo_Accion_Entidad_Codigo($Tipo_Accion_Entidad_Codigo);
        $rsExisteEventosAccion = $this->EventoAcciones_model->accionesPorTipoAccionEntidad();
        
        $existeEventosAccion = false;
        $row = $rsExisteEventosAccion->row();
        if ( $row->total > 0 ) {
            $existeEventosAccion = true;
        }

        if ($existeEventosAccion) {
            $this->session->set_flashdata('mensajeError', 'No se pudo eliminar, tiene registro(s) de acciones');
        } else {
            $this->TipoAccionEntidad_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
            $this->TipoAccionEntidad_model->setTipo_Accion_Entidad_Codigo($Tipo_Accion_Entidad_Codigo);
            
            if($this->TipoAccionEntidad_model->eliminar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El tipo acci&oacute;n entidad fue eliminado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo eliminar el tipo acci&oacute;n entidad');
            }
        }

        redirect("tablas/main/tipoAccionEntidad");
        
    }

    public function perfiles() {
        $this->load->model("Perfiles_model");
        $lista = $this->Perfiles_model->lista();
        
        $data = array( "lista" => $lista);
        $this->load->view("tablas/perfiles", $data);
    }
    
    public function perfilesGestionar() {
        $this->load->model("Perfiles_model");
        
        $Codigo_Perfil = $this->input->post("Codigo_Perfil");
        $Descripcion_Perfil = $this->input->post("Descripcion_Perfil");
        
        $isUpdate = true;
        if (strlen($Codigo_Perfil) == 0) {
            $isUpdate = false;
        }
        
        $this->Perfiles_model->setDescripcion_Perfil(strtoupper($Descripcion_Perfil));
        
        if ($isUpdate) {
            $this->Perfiles_model->setCodigo_Perfil($Codigo_Perfil);
            if($this->Perfiles_model->editar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El perfil fue editado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo editar el perfil');
            }
        } else {
            $Codigo_Perfil = $this->Perfiles_model->obtenerCodigoMayor() + 1;
            $Codigo_Perfil = addCero($Codigo_Perfil);
            $this->Perfiles_model->setCodigo_Perfil($Codigo_Perfil);
            if($this->Perfiles_model->crear() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'Se creo el perfil');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo crear el perfil');
            }
        }
        redirect("tablas/main/perfiles");
    }

    public function perfilesEliminar() {
        $this->load->model("Perfiles_model");
        //$this->load->model("Perfiles_model");

        $Codigo_Perfil = $this->input->post("Codigo_Perfil");

        $this->Perfiles_model->setCodigo_Perfil($Codigo_Perfil);
        $rsExisteEntidades = $this->Perfiles_model->moduloPorPerfil();

        $existeEntidades = false;
        $row = $rsExisteEntidades->row();
        if ( $row->total > 0 ) {
            $existeEntidades = true;
        }

        if ($existeEntidades) {
            $this->session->set_flashdata('mensajeError', 'No se pudo eliminar, tiene registro(s) de tipo Módulo por Perfil');
        } else {
            $this->Perfiles_model->setCodigo_Perfil($Codigo_Perfil);

            if($this->Perfiles_model->eliminar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'El perfil fue eliminado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo eliminar el perfil');
            }
        }

        redirect("tablas/main/perfiles");

    }

    public function perfilModulos() {
        $this->load->model("PerfilModulo_model");
        $this->load->model("Perfiles_model");
        $lista = $this->PerfilModulo_model->lista();
        $listarperfiles = $this->Perfiles_model->listar();
        $listarmodulos = $this->Perfiles_model->listarmodulos();
        
        $data = array( "lista" => $lista, "listarperfiles" => $listarperfiles, "listarmodulos" => $listarmodulos);
        $this->load->view("tablas/perfilModulos", $data);
    }
    
    public function perfilModulosGestionar() {
        $this->load->model("PerfilModulo_model");
        
        $idmodulo = $this->input->post("idmodulo");
        $Codigo_Perfil = $this->input->post("Codigo_Perfil");
        $idmodulorol = $this->input->post("idmodulorol");
        
        $isUpdate = true;
        if (strlen($idmodulorol) == 0) {
            $isUpdate = false;
        }
        
        $this->PerfilModulo_model->setIdmodulo($idmodulo);
        $this->PerfilModulo_model->setCodigo_Perfil(strtoupper($Codigo_Perfil));

        if ($isUpdate) {
            $this->PerfilModulo_model->setIdmodulorol($idmodulorol);
            if($this->PerfilModulo_model->editar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'La relación Perfil / Módulo fue editado');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo editar la relación Perfil / Módulo');
            }
        } else {
            //$Tipo_Accion_Entidad_Codigo = $this->PerfilModulo_model->obtenerCodigoMayor() + 1;
            //$Tipo_Accion_Entidad_Codigo = addCero($Tipo_Accion_Entidad_Codigo);
            $this->PerfilModulo_model->setIdmodulo($idmodulo);
            $this->PerfilModulo_model->setCodigo_Perfil($Codigo_Perfil);
            if($this->PerfilModulo_model->crear() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'Se creo la relación Perfil / Módulo');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo crear la relación Perfil / Módulo');
            }
        }
        redirect("tablas/main/perfilModulos");
    }
    
    public function perfilModulosEliminar() {
        $this->load->model("PerfilModulo_model");
        $this->load->model("EventoAcciones_model");
        
        $idmodulo = $this->input->post("idmodulo");
        $Codigo_Perfil = $this->input->post("Codigo_Perfil");
        $idmodulorol = $this->input->post("idmodulorol");
        
        $this->PerfilModulo_model->setIdmodulorol($idmodulorol);
        $this->PerfilModulo_model->setCodigo_Perfil($Codigo_Perfil);
        
        /*
        $rsExisteEventosAccion = $this->EventoAcciones_model->accionesPorTipoAccionEntidad();
        
        $existeEventosAccion = false;
        $row = $rsExisteEventosAccion->row();
        if ( $row->total > 0 ) {
            $existeEventosAccion = true;
        }
        

        if ($existeEventosAccion) {
            $this->session->set_flashdata('mensajeError', 'No se pudo eliminar, tiene registro(s) de acciones');
        } else { 
            $this->TipoAccionEntidad_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
            $this->TipoAccionEntidad_model->setTipo_Accion_Entidad_Codigo($Tipo_Accion_Entidad_Codigo);
            */
            if($this->PerfilModulo_model->eliminar() > 0) {
                $this->session->set_flashdata('mensajeSuccess', 'La relación Módulo / Perfil fue eliminada');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo eliminar la relación Módulo / Perfil');
            }
        //}

        redirect("tablas/main/perfilModulos");
        
    }

}