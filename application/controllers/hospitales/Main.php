<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    
    private $permisos = null;
    
    function __construct()
    {
        parent::__construct();
        
        $token = $this->session->userdata("token");
        
        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");
        
        $this->session->set_userdata("idmodulo", 9);
        
        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
        
        if(sha1($usuario)==$token->usuario){
            
            if (count($token->modulos)>0) {
                
                $listaModulos = $token->modulos;
                
                $permanecer = false;
                
                foreach ($listaModulos as $row) :
                if ($row->idmodulo == 9 and $row->estado == 1)
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
    
    public function index()
    {
        
        $nivel = 1;
        $idmenu = 9;
        
        validarPermisos($nivel,$idmenu,$this->permisos);
        
        $this->load->model("Hospital_model"); 
        $this->load->model("HospitalDemanda_model");
        $this->load->model("Ubigeo_model");
        $tipo = $this->input->post("type") ? $this->input->post("type") : 1;
        $hospitales = $this->Hospital_model->hospitalesSituaciones(); 
        $listaRegiones = $this->Ubigeo_model->obtenerRegiones(); 
        $listar = $this->HospitalDemanda_model->obtenerPorcentajesHospitales(); 
        $q_grafico = $this->HospitalDemanda_model->obtenerDataGraficoHospitales(); 
        if ($listar->num_rows() > 0) {  $datos = $listar->result(); } else {  $datos = array(); }
        if ($q_grafico->num_rows() > 0) {  $data_grafico = $q_grafico->result(); } else {  $data_grafico = array(); }        
        $data = Array(
            "lista" => json_encode($datos),
            "hospitales_data" =>$hospitales->result(),
            "listaRegiones_data" =>$listaRegiones->result(),
            "tipo" => $tipo,
            "data_grafico" => json_encode($data_grafico),
            );
        $this->load->view("hospitales/Main",$data);
    }
    
    public function nuevo() {
        
        $this->load->model("Hospital_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("Ubigeo_model");

        $tipo = $this->input->post("type");
        $hospitales = $this->Hospital_model->hospitalesSituaciones();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $listaRegiones = $this->Ubigeo_model->obtenerRegiones();
        
        $data = array(
            "hospitales" => $hospitales->result(),
            "listaRegiones" => $listaRegiones->result(),
            "listaralerta" => $listaralerta,
            "tipo" => $tipo
        );
        
        $this->load->view("hospitales/nuevo",$data);
        
    }
    
    public function edicion() {
        
        $this->load->model("Hospital_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("Ubigeo_model");
        $id = 1;//$this->input->post("id");
        $this->Hospital_model->setid($id);
        $hospitales = $this->Hospital_model->hospitalesSituaciones();
        $hospital = $this->Hospital_model->hospitalesSobreDemandaNew();
        $ocurrencias = $this->Hospital_model->listarOcurrencias();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $tipo = $this->Hospital_model->hospitalesSobreDemandaNewTipo();
        $listaRegiones = $this->Ubigeo_model->obtenerRegiones();
        
        $data = array(
            "hospitales" => $hospitales->result(),
            "hospital" => $hospital->row(),
            "listaRegiones" => $listaRegiones->result(),
            "ocurrencias" => $ocurrencias,
            "listaralerta" => $listaralerta,
            "tipo" => $tipo
        );
        
        $this->load->view("hospitales/editar",$data);
        
    }
    
    public function gestionar() {
        
        $this->load->model("Hospital_model");
        $this->load->model("AlertaPronostico_model");
        
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $id = $this->input->post("id");

        $hospitales_situaciones_nombre_id = $this->input->post("hospitales_situaciones_nombre_id");
        
        $dni_responsable_reporte = $this->input->post("dni_responsable_reporte");
        $responsable_reporte = $this->input->post("responsable_reporte");
        $cmp_responsable_reporte = $this->input->post("cmp_responsable_reporte");
        $rne_responsable_reporte = $this->input->post("rne_responsable_reporte");

        $dni_jefe_guardia = $this->input->post("dni_jefe_guardia");
        $jefe_guardia = $this->input->post("jefe_guardia");
        $cmp_jefe_guardia = $this->input->post("cmp_jefe_guardia");
        $rne_jefe_guardia = $this->input->post("rne_jefe_guardia");
        
        $telefono = $this->input->post("telefono");
        $fecha = $this->input->post("fecha");
        $hora = $this->input->post("hora");

        $usuario_registro = $this->input->post("usuario_registro");
        $fecha_registro = $this->input->post("fecha_registro");
        $usuario_actualizacion = $this->input->post("usuario_actualizacion");
        $fecha_actualizacion = $this->input->post("fecha_actualizacion");
        
        $nedocs_shock_trauma = $this->input->post("nedocs_shock_trauma");
        $nedocs_medicina = $this->input->post("nedocs_medicina");
        $nedocs_cirugia = $this->input->post("nedocs_cirugia");
        $nedocs_gineco_obstetricia = $this->input->post("nedocs_gineco_obstetricia");
        $nedocs_pedriatria = $this->input->post("nedocs_pedriatria");
        $nedocs_observacion_medicina = $this->input->post("nedocs_observacion_medicina");
        $nedocs_observacion_cirugia = $this->input->post("nedocs_observacion_cirugia");
        $nedocs_observacion_gineco_obstetricia = $this->input->post("nedocs_observacion_gineco_obstetricia");
        $nedocs_observacion_pediatria = $this->input->post("nedocs_observacion_pediatria");
        $nedocs_camas_emergencia_ocupadas_pasillos = $this->input->post("nedocs_camas_emergencia_ocupadas_pasillos");
        $nedocs_camas_emergencia_ocupadas_areas_contigencia = $this->input->post("nedocs_camas_emergencia_ocupadas_areas_contigencia");
        $nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres = $this->input->post("nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres");
        $nedocs_capacidad_expansion_emergencias_desastres = $this->input->post("nedocs_capacidad_expansion_emergencias_desastres");
        $nedocs_tiempo_espera_ensala_ultimo_paciente_llamado = $this->input->post("nedocs_tiempo_espera_ensala_ultimo_paciente_llamado");
        $nedocs_tiempo_espera_mas_largo_por_cama_de_internacion = $this->input->post("nedocs_tiempo_espera_mas_largo_por_cama_de_internacion");
        
        $nedocs_pacientes_espera_cama_internamiento = $this->input->post("nedocs_pacientes_espera_cama_internamiento");
        $nedocs_cantidad_total_pacientes_ventilacion = $this->input->post("nedocs_cantidad_total_pacientes_ventilacion");
        $nedocs_cantidad_total_camas_hospital = $this->input->post("nedocs_cantidad_total_camas_hospital");
        
        $nedocs_resultado = $this->input->post("nedocs_resultado");
        $emergencia_camas_ogti_shock_trauma = $this->input->post("emergencia_camas_ogti_shock_trauma");
        $emergencia_camas_ogti_medicina = $this->input->post("emergencia_camas_ogti_medicina");
        $emergencia_camas_ogti_cirugia = $this->input->post("emergencia_camas_ogti_cirugia");
        $emergencia_camas_ogti_gineco_obstetricia = $this->input->post("emergencia_camas_ogti_gineco_obstetricia");
        $emergencia_camas_ogti_pedriatria = $this->input->post("emergencia_camas_ogti_pedriatria");
        $emergencia_camas_ogti_observacion_medicina = $this->input->post("emergencia_camas_ogti_observacion_medicina");
        $emergencia_camas_ogti_observacion_cirugia = $this->input->post("emergencia_camas_ogti_observacion_cirugia");
        $emergencia_camas_ogti_observacion_gineco_obstetricia = $this->input->post("emergencia_camas_ogti_observacion_gineco_obstetricia");
        $emergencia_camas_ogti_observacion_pediatria = $this->input->post("emergencia_camas_ogti_observacion_pediatria");
        $emergencia_camas_pasillos_shock_trauma = $this->input->post("emergencia_camas_pasillos_shock_trauma");
        $emergencia_camas_pasillos_medicina = $this->input->post("emergencia_camas_pasillos_medicina");
        $emergencia_camas_pasillos_cirugia = $this->input->post("emergencia_camas_pasillos_cirugia");
        $emergencia_camas_pasillos_gineco_obstetricia = $this->input->post("emergencia_camas_pasillos_gineco_obstetricia");
        $emergencia_camas_pasillos_pedriatria = $this->input->post("emergencia_camas_pasillos_pedriatria");
        $emergencia_camas_pasillos_observacion_medicina = $this->input->post("emergencia_camas_pasillos_observacion_medicina");
        $emergencia_camas_pasillos_observacion_cirugia = $this->input->post("emergencia_camas_pasillos_observacion_cirugia");
        $emergencia_camas_pasillos_observacion_gineco_obstetricia = $this->input->post("emergencia_camas_pasillos_observacion_gineco_obstetricia");
        $emergencia_camas_pasillos_observacion_pediatria = $this->input->post("emergencia_camas_pasillos_observacion_pediatria");
        $emergencia_camas_contingencia_shock_trauma = $this->input->post("emergencia_camas_contingencia_shock_trauma");
        $emergencia_camas_contingencia_medicina = $this->input->post("emergencia_camas_contingencia_medicina");
        $emergencia_camas_contingencia_cirugia = $this->input->post("emergencia_camas_contingencia_cirugia");
        $emergencia_camas_contingencia_gineco_obstetricia = $this->input->post("emergencia_camas_contingencia_gineco_obstetricia");
        $emergencia_camas_contingencia_pedriatria = $this->input->post("emergencia_camas_contingencia_pedriatria");
        $emergencia_camas_contingencia_observacion_medicina = $this->input->post("emergencia_camas_contingencia_observacion_medicina");
        $emergencia_camas_contingencia_observacion_cirugia = $this->input->post("emergencia_camas_contingencia_observacion_cirugia");
        $emergencia_camas_contingencia_observacion_gineco_obstetricia = $this->input->post("emergencia_camas_contingencia_observacion_gineco_obstetricia");
        $emergencia_camas_contingencia_observacion_pediatria = $this->input->post("emergencia_camas_contingencia_observacion_pediatria");
        $emergencia_camas_expansion_shock_trauma = $this->input->post("emergencia_camas_expansion_shock_trauma");
        $emergencia_camas_expansion_medicina = $this->input->post("emergencia_camas_expansion_medicina");
        $emergencia_camas_expansion_cirugia = $this->input->post("emergencia_camas_expansion_cirugia");
        $emergencia_camas_expansion_gineco_obstetricia = $this->input->post("emergencia_camas_expansion_gineco_obstetricia");
        $emergencia_camas_expansion_pedriatria = $this->input->post("emergencia_camas_expansion_pedriatria");
        $emergencia_camas_expansion_observacion_medicina = $this->input->post("emergencia_camas_expansion_observacion_medicina");
        $emergencia_camas_expansion_observacion_cirugia = $this->input->post("emergencia_camas_expansion_observacion_cirugia");
        $emergencia_camas_expansion_observacion_gineco_obstetricia = $this->input->post("emergencia_camas_expansion_observacion_gineco_obstetricia");
        $emergencia_camas_expansion_observacion_pediatria = $this->input->post("emergencia_camas_expansion_observacion_pediatria");
        $emergencia_camas_desastres_shock_trauma = $this->input->post("emergencia_camas_desastres_shock_trauma");
        $emergencia_camas_desastres_medicina = $this->input->post("emergencia_camas_desastres_medicina");
        $emergencia_camas_desastres_cirugia = $this->input->post("emergencia_camas_desastres_cirugia");
        $emergencia_camas_desastres_gineco_obstetricia = $this->input->post("emergencia_camas_desastres_gineco_obstetricia");
        $emergencia_camas_desastres_pedriatria = $this->input->post("emergencia_camas_desastres_pedriatria");
        $emergencia_camas_desastres_observacion_medicina = $this->input->post("emergencia_camas_desastres_observacion_medicina");
        $emergencia_camas_desastres_observacion_cirugia = $this->input->post("emergencia_camas_desastres_observacion_cirugia");
        $emergencia_camas_desastres_observacion_gineco_obstetricia = $this->input->post("emergencia_camas_desastres_observacion_gineco_obstetricia");
        $emergencia_camas_desastres_observacion_pediatria = $this->input->post("emergencia_camas_desastres_observacion_pediatria");
        $pedriatria_camas_ogti_uci_pedriatrica = $this->input->post("pedriatria_camas_ogti_uci_pedriatrica");
        $pedriatria_camas_ogti_ucin_pedriatrica = $this->input->post("pedriatria_camas_ogti_ucin_pedriatrica");
        $pedriatria_camas_ogti_uci_neonato = $this->input->post("pedriatria_camas_ogti_uci_neonato");
        $pedriatria_camas_ogti_ucin_neonato = $this->input->post("pedriatria_camas_ogti_ucin_neonato");
        $pedriatria_camas_ocupadas_uci_pedriatrica = $this->input->post("pedriatria_camas_ocupadas_uci_pedriatrica");
        $pedriatria_camas_ocupadas_ucin_pedriatrica = $this->input->post("pedriatria_camas_ocupadas_ucin_pedriatrica");
        $pedriatria_camas_ocupadas_uci_neonato = $this->input->post("pedriatria_camas_ocupadas_uci_neonato");
        $pedriatria_camas_ocupadas_ucin_neonato = $this->input->post("pedriatria_camas_ocupadas_ucin_neonato");
        $pedriatria_camas_pasillos_uci_pedriatrica = $this->input->post("pedriatria_camas_pasillos_uci_pedriatrica");
        $pedriatria_camas_pasillos_ucin_pedriatrica = $this->input->post("pedriatria_camas_pasillos_ucin_pedriatrica");
        $pedriatria_camas_pasillos_uci_neonato = $this->input->post("pedriatria_camas_pasillos_uci_neonato");
        $pedriatria_camas_pasillos_ucin_neonato = $this->input->post("pedriatria_camas_pasillos_ucin_neonato");
        $pedriatria_camas_contigencia_uci_pedriatrica = $this->input->post("pedriatria_camas_contigencia_uci_pedriatrica");
        $pedriatria_camas_contigencia_ucin_pedriatrica = $this->input->post("pedriatria_camas_contigencia_ucin_pedriatrica");
        $pedriatria_camas_contigencia_uci_neonato = $this->input->post("pedriatria_camas_contigencia_uci_neonato");
        $pedriatria_camas_contigencia_ucin_neonato = $this->input->post("pedriatria_camas_contigencia_ucin_neonato");
        $pedriatria_camas_expansion_uci_pedriatrica = $this->input->post("pedriatria_camas_expansion_uci_pedriatrica");
        $pedriatria_camas_expansion_ucin_pedriatrica = $this->input->post("pedriatria_camas_expansion_ucin_pedriatrica");
        $pedriatria_camas_expansion_uci_neonato = $this->input->post("pedriatria_camas_expansion_uci_neonato");
        $pedriatria_camas_expansion_ucin_neonato = $this->input->post("pedriatria_camas_expansion_ucin_neonato");
        $gineco_obstetricia_camas_ogti_uci = $this->input->post("gineco_obstetricia_camas_ogti_uci");
        $gineco_obstetricia_camas_ogti_ucin = $this->input->post("gineco_obstetricia_camas_ogti_ucin");
        $gineco_obstetricia_camas_ocupadas_uci = $this->input->post("gineco_obstetricia_camas_ocupadas_uci");
        $gineco_obstetricia_camas_ocupadas_ucin = $this->input->post("gineco_obstetricia_camas_ocupadas_ucin");
        $gineco_obstetricia_camas_pasillos_uci = $this->input->post("gineco_obstetricia_camas_pasillos_uci");
        $gineco_obstetricia_camas_pasillos_ucin = $this->input->post("gineco_obstetricia_camas_pasillos_ucin");
        $gineco_obstetricia_camas_contingencia_uci = $this->input->post("gineco_obstetricia_camas_contingencia_uci");
        $gineco_obstetricia_camas_contingencia_ucin = $this->input->post("gineco_obstetricia_camas_contingencia_ucin");
        $gineco_obstetricia_camas_expansion_uci = $this->input->post("gineco_obstetricia_camas_expansion_uci");
        $gineco_obstetricia_camas_expansion_ucin = $this->input->post("gineco_obstetricia_camas_expansion_ucin");
        $sop_camas_disponibles_gineco_obstetrica = $this->input->post("sop_camas_disponibles_gineco_obstetrica");
        $sop_camas_disponibles_emergencia = $this->input->post("sop_camas_disponibles_emergencia");
        $sop_camas_requeridos_gineco_obstetrica = $this->input->post("sop_camas_requeridos_gineco_obstetrica");
        $sop_camas_requeridos_emergencia = $this->input->post("sop_camas_requeridos_emergencia");
        $sop_camas_portatiles_gineco_obstetrica = $this->input->post("sop_camas_portatiles_gineco_obstetrica");
        $sop_camas_portatiles_emergencia = $this->input->post("sop_camas_portatiles_emergencia");
        $sop_camas_expansion_gineco_obstetrica = $this->input->post("sop_camas_expansion_gineco_obstetrica");
        $sop_camas_expansion_emergencia = $this->input->post("sop_camas_expansion_emergencia");
        $personal_medico_programado_pediatria = $this->input->post("personal_medico_programado_pediatria");
        $personal_medico_programado_cirugia_pediatrica = $this->input->post("personal_medico_programado_cirugia_pediatrica");
        $personal_medico_programado_gineco_obstetricia = $this->input->post("personal_medico_programado_gineco_obstetricia");
        $personal_medico_programado_medicina_internista = $this->input->post("personal_medico_programado_medicina_internista");
        $personal_medico_programado_medicina_cardiologo = $this->input->post("personal_medico_programado_medicina_cardiologo");
        $personal_medico_programado_medicina_nefrologo = $this->input->post("personal_medico_programado_medicina_nefrologo");
        $personal_medico_programado_cirugia_general = $this->input->post("personal_medico_programado_cirugia_general");
        $personal_medico_programado_traumatologia = $this->input->post("personal_medico_programado_traumatologia");
        $personal_medico_programado_neurocirugia = $this->input->post("personal_medico_programado_neurocirugia");
        $personal_medico_programado_cirugia_torax = $this->input->post("personal_medico_programado_cirugia_torax");
        $personal_medico_programado_medicina_intensiva = $this->input->post("personal_medico_programado_medicina_intensiva");
        $personal_medico_programado_neonatologo = $this->input->post("personal_medico_programado_neonatologo");
        $personal_medico_programado_anestesiologo = $this->input->post("personal_medico_programado_anestesiologo");
        $personal_medico_requerido_pediatria = $this->input->post("personal_medico_requerido_pediatria");
        $personal_medico_requerido_cirugia_pediatrica = $this->input->post("personal_medico_requerido_cirugia_pediatrica");
        $personal_medico_requerido_gineco_obstetricia = $this->input->post("personal_medico_requerido_gineco_obstetricia");
        $personal_medico_requerido_medicina_internista = $this->input->post("personal_medico_requerido_medicina_internista");
        $personal_medico_requerido_medicina_cardiologo = $this->input->post("personal_medico_requerido_medicina_cardiologo");
        $personal_medico_requerido_medicina_nefrologo = $this->input->post("personal_medico_requerido_medicina_nefrologo");
        $personal_medico_requerido_cirugia_general = $this->input->post("personal_medico_requerido_cirugia_general");
        $personal_medico_requerido_traumatologia = $this->input->post("personal_medico_requerido_traumatologia");
        $personal_medico_requerido_neurocirugia = $this->input->post("personal_medico_requerido_neurocirugia");
        $personal_medico_requerido_cirugia_torax = $this->input->post("personal_medico_requerido_cirugia_torax");
        $personal_medico_requerido_medicina_intensiva = $this->input->post("personal_medico_requerido_medicina_intensiva");
        $personal_medico_requerido_neonatologo = $this->input->post("personal_medico_requerido_neonatologo");
        $personal_medico_requerido_anestesiologo = $this->input->post("personal_medico_requerido_anestesiologo");
        $personal_medico_reten_pediatria = $this->input->post("personal_medico_reten_pediatria");
        $personal_medico_reten_cirugia_pediatrica = $this->input->post("personal_medico_reten_cirugia_pediatrica");
        $personal_medico_reten_gineco_obstetricia = $this->input->post("personal_medico_reten_gineco_obstetricia");
        $personal_medico_reten_medicina_internista = $this->input->post("personal_medico_reten_medicina_internista");
        $personal_medico_reten_medicina_cardiologo = $this->input->post("personal_medico_reten_medicina_cardiologo");
        $personal_medico_reten_medicina_nefrologo = $this->input->post("personal_medico_reten_medicina_nefrologo");
        $personal_medico_reten_cirugia_general = $this->input->post("personal_medico_reten_cirugia_general");
        $personal_medico_reten_traumatologia = $this->input->post("personal_medico_reten_traumatologia");
        $personal_medico_reten_neurocirugia = $this->input->post("personal_medico_reten_neurocirugia");
        $personal_medico_reten_cirugia_torax = $this->input->post("personal_medico_reten_cirugia_torax");
        $personal_medico_reten_medicina_intensiva = $this->input->post("personal_medico_reten_medicina_intensiva");
        $personal_medico_reten_neonatologo = $this->input->post("personal_medico_reten_neonatologo");
        $personal_medico_reten_anestesiologo = $this->input->post("personal_medico_reten_anestesiologo");
        $personal_medico_portatiles_pediatria = $this->input->post("personal_medico_portatiles_pediatria");
        $personal_medico_portatiles_cirugia_pediatrica = $this->input->post("personal_medico_portatiles_cirugia_pediatrica");
        $personal_medico_portatiles_gineco_obstetricia = $this->input->post("personal_medico_portatiles_gineco_obstetricia");
        $personal_medico_portatiles_medicina_internista = $this->input->post("personal_medico_portatiles_medicina_internista");
        $personal_medico_portatiles_medicina_cardiologo = $this->input->post("personal_medico_portatiles_medicina_cardiologo");
        $personal_medico_portatiles_medicina_nefrologo = $this->input->post("personal_medico_portatiles_medicina_nefrologo");
        $personal_medico_portatiles_cirugia_general = $this->input->post("personal_medico_portatiles_cirugia_general");
        $personal_medico_portatiles_traumatologia = $this->input->post("personal_medico_portatiles_traumatologia");
        $personal_medico_portatiles_neurocirugia = $this->input->post("personal_medico_portatiles_neurocirugia");
        $personal_medico_portatiles_cirugia_torax = $this->input->post("personal_medico_portatiles_cirugia_torax");
        $personal_medico_portatiles_medicina_intensiva = $this->input->post("personal_medico_portatiles_medicina_intensiva");
        $personal_medico_portatiles_neonatologo = $this->input->post("personal_medico_portatiles_neonatologo");
        $personal_medico_portatiles_anestesiologo = $this->input->post("personal_medico_portatiles_anestesiologo");
        $personal_no_medico_programado_enfermeras = $this->input->post("personal_no_medico_programado_enfermeras");
        $personal_no_medico_programado_tecnologos = $this->input->post("personal_no_medico_programado_tecnologos");
        $personal_no_medico_programado_obtetrices = $this->input->post("personal_no_medico_programado_obtetrices");
        $personal_no_medico_programado_tecnicos = $this->input->post("personal_no_medico_programado_tecnicos");
        $personal_no_medico_programado_social = $this->input->post("personal_no_medico_programado_social");
        $personal_no_medico_requerido_enfermeras = $this->input->post("personal_no_medico_requerido_enfermeras");
        $personal_no_medico_requerido_tecnologos = $this->input->post("personal_no_medico_requerido_tecnologos");
        $personal_no_medico_requerido_obtetrices = $this->input->post("personal_no_medico_requerido_obtetrices");
        $personal_no_medico_requerido_tecnicos = $this->input->post("personal_no_medico_requerido_tecnicos");
        $personal_no_medico_requerido_social = $this->input->post("personal_no_medico_requerido_social");
        $personal_no_medico_reten_enfermeras = $this->input->post("personal_no_medico_reten_enfermeras");
        $personal_no_medico_reten_tecnologos = $this->input->post("personal_no_medico_reten_tecnologos");
        $personal_no_medico_reten_obtetrices = $this->input->post("personal_no_medico_reten_obtetrices");
        $personal_no_medico_reten_tecnicos = $this->input->post("personal_no_medico_reten_tecnicos");
        $personal_no_medico_reten_social = $this->input->post("personal_no_medico_reten_social");
        $personal_no_medico_portatiles_enfermeras = $this->input->post("personal_no_medico_portatiles_enfermeras");
        $personal_no_medico_portatiles_tecnologos = $this->input->post("personal_no_medico_portatiles_tecnologos");
        $personal_no_medico_portatiles_obtetrices = $this->input->post("personal_no_medico_portatiles_obtetrices");
        $personal_no_medico_portatiles_tecnicos = $this->input->post("personal_no_medico_portatiles_tecnicos");
        $personal_no_medico_portatiles_social = $this->input->post("personal_no_medico_portatiles_social");
        $banco_sangre_disponible_sangre = $this->input->post("banco_sangre_disponible_sangre");
        $banco_sangre_disponible_plasma = $this->input->post("banco_sangre_disponible_plasma");
        $banco_sangre_disponible_plaquetas = $this->input->post("banco_sangre_disponible_plaquetas");
        $banco_sangre_requerido_sangre = $this->input->post("banco_sangre_requerido_sangre");
        $banco_sangre_requerido_plasma = $this->input->post("banco_sangre_requerido_plasma");
        $banco_sangre_requerido_plaquetas = $this->input->post("banco_sangre_requerido_plaquetas");
        $banco_sangre_portatiles_sangre = $this->input->post("banco_sangre_portatiles_sangre");
        $banco_sangre_portatiles_plasma = $this->input->post("banco_sangre_portatiles_plasma");
        $banco_sangre_portatiles_plaquetas = $this->input->post("banco_sangre_portatiles_plaquetas");
        $ventiladores_registrados_trauma_shock_adulto = $this->input->post("ventiladores_registrados_trauma_shock_adulto");
        $ventiladores_registrados_trauma_shock_pediatrico = $this->input->post("ventiladores_registrados_trauma_shock_pediatrico");
        $ventiladores_registrados_uci_adultos = $this->input->post("ventiladores_registrados_uci_adultos");
        $ventiladores_registrados_uci_pedriatrica = $this->input->post("ventiladores_registrados_uci_pedriatrica");
        $ventiladores_registrados_uci_neonatologia = $this->input->post("ventiladores_registrados_uci_neonatologia");
        $ventiladores_registrados_sala_operaciones = $this->input->post("ventiladores_registrados_sala_operaciones");
        $ventiladores_registrados_ucin_adulto = $this->input->post("ventiladores_registrados_ucin_adulto");
        $ventiladores_registrados_ucin_pediatrico = $this->input->post("ventiladores_registrados_ucin_pediatrico");
        $ventiladores_registrados_ucin_neonato = $this->input->post("ventiladores_registrados_ucin_neonato");
        $ventiladores_registrados_uci_gineco_obstetricia = $this->input->post("ventiladores_registrados_uci_gineco_obstetricia");
        $ventiladores_registrados_ucin_gineco_obstetricia = $this->input->post("ventiladores_registrados_ucin_gineco_obstetricia");
        $ventiladores_operativos_trauma_shock_adulto = $this->input->post("ventiladores_operativos_trauma_shock_adulto");
        $ventiladores_operativos_trauma_shock_pediatrico = $this->input->post("ventiladores_operativos_trauma_shock_pediatrico");
        $ventiladores_operativos_uci_adultos = $this->input->post("ventiladores_operativos_uci_adultos");
        $ventiladores_operativos_uci_pedriatrica = $this->input->post("ventiladores_operativos_uci_pedriatrica");
        $ventiladores_operativos_uci_neonatologia = $this->input->post("ventiladores_operativos_uci_neonatologia");
        $ventiladores_operativos_sala_operaciones = $this->input->post("ventiladores_operativos_sala_operaciones");
        $ventiladores_operativos_ucin_adulto = $this->input->post("ventiladores_operativos_ucin_adulto");
        $ventiladores_operativos_ucin_pediatrico = $this->input->post("ventiladores_operativos_ucin_pediatrico");
        $ventiladores_operativos_ucin_neonato = $this->input->post("ventiladores_operativos_ucin_neonato");
        $ventiladores_operativos_uci_gineco_obstetricia = $this->input->post("ventiladores_operativos_uci_gineco_obstetricia");
        $ventiladores_operativos_ucin_gineco_obstetricia = $this->input->post("ventiladores_operativos_ucin_gineco_obstetricia");
        $ventiladores_disponibles_trauma_shock_adulto = $this->input->post("ventiladores_disponibles_trauma_shock_adulto");
        $ventiladores_disponibles_trauma_shock_pediatrico = $this->input->post("ventiladores_disponibles_trauma_shock_pediatrico");
        $ventiladores_disponibles_uci_adultos = $this->input->post("ventiladores_disponibles_uci_adultos");
        $ventiladores_disponibles_uci_pedriatrica = $this->input->post("ventiladores_disponibles_uci_pedriatrica");
        $ventiladores_disponibles_uci_neonatologia = $this->input->post("ventiladores_disponibles_uci_neonatologia");
        $ventiladores_disponibles_sala_operaciones = $this->input->post("ventiladores_disponibles_sala_operaciones");
        $ventiladores_disponibles_ucin_adulto = $this->input->post("ventiladores_disponibles_ucin_adulto");
        $ventiladores_disponibles_ucin_pediatrico = $this->input->post("ventiladores_disponibles_ucin_pediatrico");
        $ventiladores_disponibles_ucin_neonato = $this->input->post("ventiladores_disponibles_ucin_neonato");
        $ventiladores_disponibles_uci_gineco_obstetricia = $this->input->post("ventiladores_disponibles_uci_gineco_obstetricia");
        $ventiladores_disponibles_ucin_gineco_obstetricia = $this->input->post("ventiladores_disponibles_ucin_gineco_obstetricia");
        $ventiladores_alquilados_trauma_shock_adulto = $this->input->post("ventiladores_alquilados_trauma_shock_adulto");
        $ventiladores_alquilados_trauma_shock_pediatrico = $this->input->post("ventiladores_alquilados_trauma_shock_pediatrico");
        $ventiladores_alquilados_uci_adultos = $this->input->post("ventiladores_alquilados_uci_adultos");
        $ventiladores_alquilados_uci_pedriatrica = $this->input->post("ventiladores_alquilados_uci_pedriatrica");
        $ventiladores_alquilados_uci_neonatologia = $this->input->post("ventiladores_alquilados_uci_neonatologia");
        $ventiladores_alquilados_sala_operaciones = $this->input->post("ventiladores_alquilados_sala_operaciones");
        $ventiladores_alquilados_ucin_adulto = $this->input->post("ventiladores_alquilados_ucin_adulto");
        $ventiladores_alquilados_ucin_pediatrico = $this->input->post("ventiladores_alquilados_ucin_pediatrico");
        $ventiladores_alquilados_ucin_neonato = $this->input->post("ventiladores_alquilados_ucin_neonato");
        $ventiladores_alquilados_uci_gineco_obstetricia = $this->input->post("ventiladores_alquilados_uci_gineco_obstetricia");
        $ventiladores_alquilados_ucin_gineco_obstetricia = $this->input->post("ventiladores_alquilados_ucin_gineco_obstetricia");
        $ventiladores_brecha_trauma_shock_adulto = $this->input->post("ventiladores_brecha_trauma_shock_adulto");
        $ventiladores_brecha_trauma_shock_pediatrico = $this->input->post("ventiladores_brecha_trauma_shock_pediatrico");
        $ventiladores_brecha_uci_adultos = $this->input->post("ventiladores_brecha_uci_adultos");
        $ventiladores_brecha_uci_pedriatrica = $this->input->post("ventiladores_brecha_uci_pedriatrica");
        $ventiladores_brecha_uci_neonatologia = $this->input->post("ventiladores_brecha_uci_neonatologia");
        $ventiladores_brecha_sala_operaciones = $this->input->post("ventiladores_brecha_sala_operaciones");
        $ventiladores_brecha_ucin_adulto = $this->input->post("ventiladores_brecha_ucin_adulto");
        $ventiladores_brecha_ucin_pediatrico = $this->input->post("ventiladores_brecha_ucin_pediatrico");
        $ventiladores_brecha_ucin_neonato = $this->input->post("ventiladores_brecha_ucin_neonato");
        $ventiladores_brecha_uci_gineco_obstetricia = $this->input->post("ventiladores_brecha_uci_gineco_obstetricia");
        $ventiladores_brecha_ucin_gineco_obstetricia = $this->input->post("ventiladores_brecha_ucin_gineco_obstetricia");
        $ventiladores_portatiles_trauma_shock_adulto = $this->input->post("ventiladores_portatiles_trauma_shock_adulto");
        $ventiladores_portatiles_trauma_shock_pediatrico = $this->input->post("ventiladores_portatiles_trauma_shock_pediatrico");
        $ventiladores_portatiles_uci_adultos = $this->input->post("ventiladores_portatiles_uci_adultos");
        $ventiladores_portatiles_uci_pedriatrica = $this->input->post("ventiladores_portatiles_uci_pedriatrica");
        $ventiladores_portatiles_uci_neonatologia = $this->input->post("ventiladores_portatiles_uci_neonatologia");
        $ventiladores_portatiles_sala_operaciones = $this->input->post("ventiladores_portatiles_sala_operaciones");
        $ventiladores_portatiles_ucin_adulto = $this->input->post("ventiladores_portatiles_ucin_adulto");
        $ventiladores_portatiles_ucin_pediatrico = $this->input->post("ventiladores_portatiles_ucin_pediatrico");
        $ventiladores_portatiles_ucin_neonato = $this->input->post("ventiladores_portatiles_ucin_neonato");
        $ventiladores_portatiles_uci_gineco_obstetricia = $this->input->post("ventiladores_portatiles_uci_gineco_obstetricia");
        $ventiladores_portatiles_ucin_gineco_obstetricia = $this->input->post("ventiladores_portatiles_ucin_gineco_obstetricia");
        $ambulancias_tipo_i_registradas = $this->input->post("ambulancias_tipo_i_registradas");
        $ambulancias_tipo_i_operaivas = $this->input->post("ambulancias_tipo_i_operaivas");
        $ambulancias_tipo_i_radio = $this->input->post("ambulancias_tipo_i_radio");
        $ambulancias_tipo_ii_registradas = $this->input->post("ambulancias_tipo_ii_registradas");
        $ambulancias_tipo_ii_operaivas = $this->input->post("ambulancias_tipo_ii_operaivas");
        $ambulancias_tipo_ii_radio = $this->input->post("ambulancias_tipo_ii_radio");
        $ambulancias_tipo_iii_registradas = $this->input->post("ambulancias_tipo_iii_registradas");
        $ambulancias_tipo_iii_operaivas = $this->input->post("ambulancias_tipo_iii_operaivas");
        $ambulancias_tipo_iii_radio = $this->input->post("ambulancias_tipo_iii_radio");
        
        $ocurrencia = $this->input->post("ocurrencias");
        
        $this->Hospital_model->sethospitales_situaciones_nombre_id($hospitales_situaciones_nombre_id);

        $this->Hospital_model->setdni_responsable_reporte($dni_responsable_reporte);
        $this->Hospital_model->setresponsable_reporte(strtoupper($responsable_reporte));
        $this->Hospital_model->setcmp_responsable_reporte($cmp_responsable_reporte);
        $this->Hospital_model->setrne_responsable_reporte($rne_responsable_reporte);

        $this->Hospital_model->setdni_jefe_guardia($dni_jefe_guardia);
        $this->Hospital_model->setjefe_guardia(strtoupper($jefe_guardia));
        $this->Hospital_model->setcmp_jefe_guardia($cmp_jefe_guardia);
        $this->Hospital_model->setrne_jefe_guardia($rne_jefe_guardia);

        $this->Hospital_model->settelefono($telefono);
        $this->Hospital_model->setfecha(formatearFechaParaBD($fecha));
        $this->Hospital_model->sethora($hora);
        $this->Hospital_model->setusuario_registro($usuario_registro);
        $this->Hospital_model->setfecha_registro($fecha_registro);
        $this->Hospital_model->setusuario_actualizacion($usuario_actualizacion);
        $this->Hospital_model->setfecha_actualizacion($fecha_actualizacion);

        $this->Hospital_model->setnedocs_shock_trauma($nedocs_shock_trauma);
        $this->Hospital_model->setnedocs_medicina($nedocs_medicina);
        $this->Hospital_model->setnedocs_cirugia($nedocs_cirugia);
        $this->Hospital_model->setnedocs_gineco_obstetricia($nedocs_gineco_obstetricia);
        $this->Hospital_model->setnedocs_pedriatria($nedocs_pedriatria);
        $this->Hospital_model->setnedocs_observacion_medicina($nedocs_observacion_medicina);
        $this->Hospital_model->setnedocs_observacion_cirugia($nedocs_observacion_cirugia);
        $this->Hospital_model->setnedocs_observacion_gineco_obstetricia($nedocs_observacion_gineco_obstetricia);
        $this->Hospital_model->setnedocs_observacion_pediatria($nedocs_observacion_pediatria);
        $this->Hospital_model->setnedocs_camas_emergencia_ocupadas_pasillos($nedocs_camas_emergencia_ocupadas_pasillos);
        $this->Hospital_model->setnedocs_camas_emergencia_ocupadas_areas_contigencia($nedocs_camas_emergencia_ocupadas_areas_contigencia);
        $this->Hospital_model->setnedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres($nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres);
        $this->Hospital_model->setnedocs_capacidad_expansion_emergencias_desastres($nedocs_capacidad_expansion_emergencias_desastres);
        $this->Hospital_model->setnedocs_tiempo_espera_ensala_ultimo_paciente_llamado($nedocs_tiempo_espera_ensala_ultimo_paciente_llamado);
        $this->Hospital_model->setnedocs_tiempo_espera_mas_largo_por_cama_de_internacion($nedocs_tiempo_espera_mas_largo_por_cama_de_internacion);

        $this->Hospital_model->setnedocs_pacientes_espera_cama_internamiento($nedocs_pacientes_espera_cama_internamiento);
        $this->Hospital_model->setnedocs_cantidad_total_pacientes_ventilacion($nedocs_cantidad_total_pacientes_ventilacion);
        $this->Hospital_model->setnedocs_cantidad_total_camas_hospital($nedocs_cantidad_total_camas_hospital);

        $this->Hospital_model->setnedocs_resultado($nedocs_resultado);
        $this->Hospital_model->setemergencia_camas_ogti_shock_trauma($emergencia_camas_ogti_shock_trauma);
        $this->Hospital_model->setemergencia_camas_ogti_medicina($emergencia_camas_ogti_medicina);
        $this->Hospital_model->setemergencia_camas_ogti_cirugia($emergencia_camas_ogti_cirugia);
        $this->Hospital_model->setemergencia_camas_ogti_gineco_obstetricia($emergencia_camas_ogti_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_ogti_pedriatria($emergencia_camas_ogti_pedriatria);
        $this->Hospital_model->setemergencia_camas_ogti_observacion_medicina($emergencia_camas_ogti_observacion_medicina);
        $this->Hospital_model->setemergencia_camas_ogti_observacion_cirugia($emergencia_camas_ogti_observacion_cirugia);
        $this->Hospital_model->setemergencia_camas_ogti_observacion_gineco_obstetricia($emergencia_camas_ogti_observacion_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_ogti_observacion_pediatria($emergencia_camas_ogti_observacion_pediatria);
        $this->Hospital_model->setemergencia_camas_pasillos_shock_trauma($emergencia_camas_pasillos_shock_trauma);
        $this->Hospital_model->setemergencia_camas_pasillos_medicina($emergencia_camas_pasillos_medicina);
        $this->Hospital_model->setemergencia_camas_pasillos_cirugia($emergencia_camas_pasillos_cirugia);
        $this->Hospital_model->setemergencia_camas_pasillos_gineco_obstetricia($emergencia_camas_pasillos_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_pasillos_pedriatria($emergencia_camas_pasillos_pedriatria);
        $this->Hospital_model->setemergencia_camas_pasillos_observacion_medicina($emergencia_camas_pasillos_observacion_medicina);
        $this->Hospital_model->setemergencia_camas_pasillos_observacion_cirugia($emergencia_camas_pasillos_observacion_cirugia);
        $this->Hospital_model->setemergencia_camas_pasillos_observacion_gineco_obstetricia($emergencia_camas_pasillos_observacion_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_pasillos_observacion_pediatria($emergencia_camas_pasillos_observacion_pediatria);
        $this->Hospital_model->setemergencia_camas_contingencia_shock_trauma($emergencia_camas_contingencia_shock_trauma);
        $this->Hospital_model->setemergencia_camas_contingencia_medicina($emergencia_camas_contingencia_medicina);
        $this->Hospital_model->setemergencia_camas_contingencia_cirugia($emergencia_camas_contingencia_cirugia);
        $this->Hospital_model->setemergencia_camas_contingencia_gineco_obstetricia($emergencia_camas_contingencia_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_contingencia_pedriatria($emergencia_camas_contingencia_pedriatria);
        $this->Hospital_model->setemergencia_camas_contingencia_observacion_medicina($emergencia_camas_contingencia_observacion_medicina);
        $this->Hospital_model->setemergencia_camas_contingencia_observacion_cirugia($emergencia_camas_contingencia_observacion_cirugia);
        $this->Hospital_model->setemergencia_camas_contingencia_observacion_gineco_obstetricia($emergencia_camas_contingencia_observacion_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_contingencia_observacion_pediatria($emergencia_camas_contingencia_observacion_pediatria);
        $this->Hospital_model->setemergencia_camas_expansion_shock_trauma($emergencia_camas_expansion_shock_trauma);
        $this->Hospital_model->setemergencia_camas_expansion_medicina($emergencia_camas_expansion_medicina);
        $this->Hospital_model->setemergencia_camas_expansion_cirugia($emergencia_camas_expansion_cirugia);
        $this->Hospital_model->setemergencia_camas_expansion_gineco_obstetricia($emergencia_camas_expansion_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_expansion_pedriatria($emergencia_camas_expansion_pedriatria);
        $this->Hospital_model->setemergencia_camas_expansion_observacion_medicina($emergencia_camas_expansion_observacion_medicina);
        $this->Hospital_model->setemergencia_camas_expansion_observacion_cirugia($emergencia_camas_expansion_observacion_cirugia);
        $this->Hospital_model->setemergencia_camas_expansion_observacion_gineco_obstetricia($emergencia_camas_expansion_observacion_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_expansion_observacion_pediatria($emergencia_camas_expansion_observacion_pediatria);
        $this->Hospital_model->setemergencia_camas_desastres_shock_trauma($emergencia_camas_desastres_shock_trauma);
        $this->Hospital_model->setemergencia_camas_desastres_medicina($emergencia_camas_desastres_medicina);
        $this->Hospital_model->setemergencia_camas_desastres_cirugia($emergencia_camas_desastres_cirugia);
        $this->Hospital_model->setemergencia_camas_desastres_gineco_obstetricia($emergencia_camas_desastres_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_desastres_pedriatria($emergencia_camas_desastres_pedriatria);
        $this->Hospital_model->setemergencia_camas_desastres_observacion_medicina($emergencia_camas_desastres_observacion_medicina);
        $this->Hospital_model->setemergencia_camas_desastres_observacion_cirugia($emergencia_camas_desastres_observacion_cirugia);
        $this->Hospital_model->setemergencia_camas_desastres_observacion_gineco_obstetricia($emergencia_camas_desastres_observacion_gineco_obstetricia);
        $this->Hospital_model->setemergencia_camas_desastres_observacion_pediatria($emergencia_camas_desastres_observacion_pediatria);
        $this->Hospital_model->setpedriatria_camas_ogti_uci_pedriatrica($pedriatria_camas_ogti_uci_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_ogti_ucin_pedriatrica($pedriatria_camas_ogti_ucin_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_ogti_uci_neonato($pedriatria_camas_ogti_uci_neonato);
        $this->Hospital_model->setpedriatria_camas_ogti_ucin_neonato($pedriatria_camas_ogti_ucin_neonato);
        $this->Hospital_model->setpedriatria_camas_ocupadas_uci_pedriatrica($pedriatria_camas_ocupadas_uci_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_ocupadas_ucin_pedriatrica($pedriatria_camas_ocupadas_ucin_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_ocupadas_uci_neonato($pedriatria_camas_ocupadas_uci_neonato);
        $this->Hospital_model->setpedriatria_camas_ocupadas_ucin_neonato($pedriatria_camas_ocupadas_ucin_neonato);
        $this->Hospital_model->setpedriatria_camas_pasillos_uci_pedriatrica($pedriatria_camas_pasillos_uci_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_pasillos_ucin_pedriatrica($pedriatria_camas_pasillos_ucin_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_pasillos_uci_neonato($pedriatria_camas_pasillos_uci_neonato);
        $this->Hospital_model->setpedriatria_camas_pasillos_ucin_neonato($pedriatria_camas_pasillos_ucin_neonato);
        $this->Hospital_model->setpedriatria_camas_contigencia_uci_pedriatrica($pedriatria_camas_contigencia_uci_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_contigencia_ucin_pedriatrica($pedriatria_camas_contigencia_ucin_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_contigencia_uci_neonato($pedriatria_camas_contigencia_uci_neonato);
        $this->Hospital_model->setpedriatria_camas_contigencia_ucin_neonato($pedriatria_camas_contigencia_ucin_neonato);
        $this->Hospital_model->setpedriatria_camas_expansion_uci_pedriatrica($pedriatria_camas_expansion_uci_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_expansion_ucin_pedriatrica($pedriatria_camas_expansion_ucin_pedriatrica);
        $this->Hospital_model->setpedriatria_camas_expansion_uci_neonato($pedriatria_camas_expansion_uci_neonato);
        $this->Hospital_model->setpedriatria_camas_expansion_ucin_neonato($pedriatria_camas_expansion_ucin_neonato);
        $this->Hospital_model->setgineco_obstetricia_camas_ogti_uci($gineco_obstetricia_camas_ogti_uci);
        $this->Hospital_model->setgineco_obstetricia_camas_ogti_ucin($gineco_obstetricia_camas_ogti_ucin);
        $this->Hospital_model->setgineco_obstetricia_camas_ocupadas_uci($gineco_obstetricia_camas_ocupadas_uci);
        $this->Hospital_model->setgineco_obstetricia_camas_ocupadas_ucin($gineco_obstetricia_camas_ocupadas_ucin);
        $this->Hospital_model->setgineco_obstetricia_camas_pasillos_uci($gineco_obstetricia_camas_pasillos_uci);
        $this->Hospital_model->setgineco_obstetricia_camas_pasillos_ucin($gineco_obstetricia_camas_pasillos_ucin);
        $this->Hospital_model->setgineco_obstetricia_camas_contingencia_uci($gineco_obstetricia_camas_contingencia_uci);
        $this->Hospital_model->setgineco_obstetricia_camas_contingencia_ucin($gineco_obstetricia_camas_contingencia_ucin);
        $this->Hospital_model->setgineco_obstetricia_camas_expansion_uci($gineco_obstetricia_camas_expansion_uci);
        $this->Hospital_model->setgineco_obstetricia_camas_expansion_ucin($gineco_obstetricia_camas_expansion_ucin);
        $this->Hospital_model->setsop_camas_disponibles_gineco_obstetrica($sop_camas_disponibles_gineco_obstetrica);
        $this->Hospital_model->setsop_camas_disponibles_emergencia($sop_camas_disponibles_emergencia);
        $this->Hospital_model->setsop_camas_requeridos_gineco_obstetrica($sop_camas_requeridos_gineco_obstetrica);
        $this->Hospital_model->setsop_camas_requeridos_emergencia($sop_camas_requeridos_emergencia);
        $this->Hospital_model->setsop_camas_portatiles_gineco_obstetrica($sop_camas_portatiles_gineco_obstetrica);
        $this->Hospital_model->setsop_camas_portatiles_emergencia($sop_camas_portatiles_emergencia);
        $this->Hospital_model->setsop_camas_expansion_gineco_obstetrica($sop_camas_expansion_gineco_obstetrica);
        $this->Hospital_model->setsop_camas_expansion_emergencia($sop_camas_expansion_emergencia);
        $this->Hospital_model->setpersonal_medico_programado_pediatria($personal_medico_programado_pediatria);
        $this->Hospital_model->setpersonal_medico_programado_cirugia_pediatrica($personal_medico_programado_cirugia_pediatrica);
        $this->Hospital_model->setpersonal_medico_programado_gineco_obstetricia($personal_medico_programado_gineco_obstetricia);
        $this->Hospital_model->setpersonal_medico_programado_medicina_internista($personal_medico_programado_medicina_internista);
        $this->Hospital_model->setpersonal_medico_programado_medicina_cardiologo($personal_medico_programado_medicina_cardiologo);
        $this->Hospital_model->setpersonal_medico_programado_medicina_nefrologo($personal_medico_programado_medicina_nefrologo);
        $this->Hospital_model->setpersonal_medico_programado_cirugia_general($personal_medico_programado_cirugia_general);
        $this->Hospital_model->setpersonal_medico_programado_traumatologia($personal_medico_programado_traumatologia);
        $this->Hospital_model->setpersonal_medico_programado_neurocirugia($personal_medico_programado_neurocirugia);
        $this->Hospital_model->setpersonal_medico_programado_cirugia_torax($personal_medico_programado_cirugia_torax);
        $this->Hospital_model->setpersonal_medico_programado_medicina_intensiva($personal_medico_programado_medicina_intensiva);
        $this->Hospital_model->setpersonal_medico_programado_neonatologo($personal_medico_programado_neonatologo);
        $this->Hospital_model->setpersonal_medico_programado_anestesiologo($personal_medico_programado_anestesiologo);
        $this->Hospital_model->setpersonal_medico_requerido_pediatria($personal_medico_requerido_pediatria);
        $this->Hospital_model->setpersonal_medico_requerido_cirugia_pediatrica($personal_medico_requerido_cirugia_pediatrica);
        $this->Hospital_model->setpersonal_medico_requerido_gineco_obstetricia($personal_medico_requerido_gineco_obstetricia);
        $this->Hospital_model->setpersonal_medico_requerido_medicina_internista($personal_medico_requerido_medicina_internista);
        $this->Hospital_model->setpersonal_medico_requerido_medicina_cardiologo($personal_medico_requerido_medicina_cardiologo);
        $this->Hospital_model->setpersonal_medico_requerido_medicina_nefrologo($personal_medico_requerido_medicina_nefrologo);
        $this->Hospital_model->setpersonal_medico_requerido_cirugia_general($personal_medico_requerido_cirugia_general);
        $this->Hospital_model->setpersonal_medico_requerido_traumatologia($personal_medico_requerido_traumatologia);
        $this->Hospital_model->setpersonal_medico_requerido_neurocirugia($personal_medico_requerido_neurocirugia);
        $this->Hospital_model->setpersonal_medico_requerido_cirugia_torax($personal_medico_requerido_cirugia_torax);
        $this->Hospital_model->setpersonal_medico_requerido_medicina_intensiva($personal_medico_requerido_medicina_intensiva);
        $this->Hospital_model->setpersonal_medico_requerido_neonatologo($personal_medico_requerido_neonatologo);
        $this->Hospital_model->setpersonal_medico_requerido_anestesiologo($personal_medico_requerido_anestesiologo);
        $this->Hospital_model->setpersonal_medico_reten_pediatria($personal_medico_reten_pediatria);
        $this->Hospital_model->setpersonal_medico_reten_cirugia_pediatrica($personal_medico_reten_cirugia_pediatrica);
        $this->Hospital_model->setpersonal_medico_reten_gineco_obstetricia($personal_medico_reten_gineco_obstetricia);
        $this->Hospital_model->setpersonal_medico_reten_medicina_internista($personal_medico_reten_medicina_internista);
        $this->Hospital_model->setpersonal_medico_reten_medicina_cardiologo($personal_medico_reten_medicina_cardiologo);
        $this->Hospital_model->setpersonal_medico_reten_medicina_nefrologo($personal_medico_reten_medicina_nefrologo);
        $this->Hospital_model->setpersonal_medico_reten_cirugia_general($personal_medico_reten_cirugia_general);
        $this->Hospital_model->setpersonal_medico_reten_traumatologia($personal_medico_reten_traumatologia);
        $this->Hospital_model->setpersonal_medico_reten_neurocirugia($personal_medico_reten_neurocirugia);
        $this->Hospital_model->setpersonal_medico_reten_cirugia_torax($personal_medico_reten_cirugia_torax);
        $this->Hospital_model->setpersonal_medico_reten_medicina_intensiva($personal_medico_reten_medicina_intensiva);
        $this->Hospital_model->setpersonal_medico_reten_neonatologo($personal_medico_reten_neonatologo);
        $this->Hospital_model->setpersonal_medico_reten_anestesiologo($personal_medico_reten_anestesiologo);
        $this->Hospital_model->setpersonal_medico_portatiles_pediatria($personal_medico_portatiles_pediatria);
        $this->Hospital_model->setpersonal_medico_portatiles_cirugia_pediatrica($personal_medico_portatiles_cirugia_pediatrica);
        $this->Hospital_model->setpersonal_medico_portatiles_gineco_obstetricia($personal_medico_portatiles_gineco_obstetricia);
        $this->Hospital_model->setpersonal_medico_portatiles_medicina_internista($personal_medico_portatiles_medicina_internista);
        $this->Hospital_model->setpersonal_medico_portatiles_medicina_cardiologo($personal_medico_portatiles_medicina_cardiologo);
        $this->Hospital_model->setpersonal_medico_portatiles_medicina_nefrologo($personal_medico_portatiles_medicina_nefrologo);
        $this->Hospital_model->setpersonal_medico_portatiles_cirugia_general($personal_medico_portatiles_cirugia_general);
        $this->Hospital_model->setpersonal_medico_portatiles_traumatologia($personal_medico_portatiles_traumatologia);
        $this->Hospital_model->setpersonal_medico_portatiles_neurocirugia($personal_medico_portatiles_neurocirugia);
        $this->Hospital_model->setpersonal_medico_portatiles_cirugia_torax($personal_medico_portatiles_cirugia_torax);
        $this->Hospital_model->setpersonal_medico_portatiles_medicina_intensiva($personal_medico_portatiles_medicina_intensiva);
        $this->Hospital_model->setpersonal_medico_portatiles_neonatologo($personal_medico_portatiles_neonatologo);
        $this->Hospital_model->setpersonal_medico_portatiles_anestesiologo($personal_medico_portatiles_anestesiologo);
        $this->Hospital_model->setpersonal_no_medico_programado_enfermeras($personal_no_medico_programado_enfermeras);
        $this->Hospital_model->setpersonal_no_medico_programado_tecnologos($personal_no_medico_programado_tecnologos);
        $this->Hospital_model->setpersonal_no_medico_programado_obtetrices($personal_no_medico_programado_obtetrices);
        $this->Hospital_model->setpersonal_no_medico_programado_tecnicos($personal_no_medico_programado_tecnicos);
        $this->Hospital_model->setpersonal_no_medico_programado_social($personal_no_medico_programado_social);
        $this->Hospital_model->setpersonal_no_medico_requerido_enfermeras($personal_no_medico_requerido_enfermeras);
        $this->Hospital_model->setpersonal_no_medico_requerido_tecnologos($personal_no_medico_requerido_tecnologos);
        $this->Hospital_model->setpersonal_no_medico_requerido_obtetrices($personal_no_medico_requerido_obtetrices);
        $this->Hospital_model->setpersonal_no_medico_requerido_tecnicos($personal_no_medico_requerido_tecnicos);
        $this->Hospital_model->setpersonal_no_medico_requerido_social($personal_no_medico_requerido_social);
        $this->Hospital_model->setpersonal_no_medico_reten_enfermeras($personal_no_medico_reten_enfermeras);
        $this->Hospital_model->setpersonal_no_medico_reten_tecnologos($personal_no_medico_reten_tecnologos);
        $this->Hospital_model->setpersonal_no_medico_reten_obtetrices($personal_no_medico_reten_obtetrices);
        $this->Hospital_model->setpersonal_no_medico_reten_tecnicos($personal_no_medico_reten_tecnicos);
        $this->Hospital_model->setpersonal_no_medico_reten_social($personal_no_medico_reten_social);
        $this->Hospital_model->setpersonal_no_medico_portatiles_enfermeras($personal_no_medico_portatiles_enfermeras);
        $this->Hospital_model->setpersonal_no_medico_portatiles_tecnologos($personal_no_medico_portatiles_tecnologos);
        $this->Hospital_model->setpersonal_no_medico_portatiles_obtetrices($personal_no_medico_portatiles_obtetrices);
        $this->Hospital_model->setpersonal_no_medico_portatiles_tecnicos($personal_no_medico_portatiles_tecnicos);
        $this->Hospital_model->setpersonal_no_medico_portatiles_social($personal_no_medico_portatiles_social);
        $this->Hospital_model->setbanco_sangre_disponible_sangre($banco_sangre_disponible_sangre);
        $this->Hospital_model->setbanco_sangre_disponible_plasma($banco_sangre_disponible_plasma);
        $this->Hospital_model->setbanco_sangre_disponible_plaquetas($banco_sangre_disponible_plaquetas);
        $this->Hospital_model->setbanco_sangre_requerido_sangre($banco_sangre_requerido_sangre);
        $this->Hospital_model->setbanco_sangre_requerido_plasma($banco_sangre_requerido_plasma);
        $this->Hospital_model->setbanco_sangre_requerido_plaquetas($banco_sangre_requerido_plaquetas);
        $this->Hospital_model->setbanco_sangre_portatiles_sangre($banco_sangre_portatiles_sangre);
        $this->Hospital_model->setbanco_sangre_portatiles_plasma($banco_sangre_portatiles_plasma);
        $this->Hospital_model->setbanco_sangre_portatiles_plaquetas($banco_sangre_portatiles_plaquetas);
        $this->Hospital_model->setventiladores_registrados_trauma_shock_adulto($ventiladores_registrados_trauma_shock_adulto);
        $this->Hospital_model->setventiladores_registrados_trauma_shock_pediatrico($ventiladores_registrados_trauma_shock_pediatrico);
        $this->Hospital_model->setventiladores_registrados_uci_adultos($ventiladores_registrados_uci_adultos);
        $this->Hospital_model->setventiladores_registrados_uci_pedriatrica($ventiladores_registrados_uci_pedriatrica);
        $this->Hospital_model->setventiladores_registrados_uci_neonatologia($ventiladores_registrados_uci_neonatologia);
        $this->Hospital_model->setventiladores_registrados_sala_operaciones($ventiladores_registrados_sala_operaciones);
        $this->Hospital_model->setventiladores_registrados_ucin_adulto($ventiladores_registrados_ucin_adulto);
        $this->Hospital_model->setventiladores_registrados_ucin_pediatrico($ventiladores_registrados_ucin_pediatrico);
        $this->Hospital_model->setventiladores_registrados_ucin_neonato($ventiladores_registrados_ucin_neonato);
        $this->Hospital_model->setventiladores_registrados_uci_gineco_obstetricia($ventiladores_registrados_uci_gineco_obstetricia);
        $this->Hospital_model->setventiladores_registrados_ucin_gineco_obstetricia($ventiladores_registrados_ucin_gineco_obstetricia);
        $this->Hospital_model->setventiladores_operativos_trauma_shock_adulto($ventiladores_operativos_trauma_shock_adulto);
        $this->Hospital_model->setventiladores_operativos_trauma_shock_pediatrico($ventiladores_operativos_trauma_shock_pediatrico);
        $this->Hospital_model->setventiladores_operativos_uci_adultos($ventiladores_operativos_uci_adultos);
        $this->Hospital_model->setventiladores_operativos_uci_pedriatrica($ventiladores_operativos_uci_pedriatrica);
        $this->Hospital_model->setventiladores_operativos_uci_neonatologia($ventiladores_operativos_uci_neonatologia);
        $this->Hospital_model->setventiladores_operativos_sala_operaciones($ventiladores_operativos_sala_operaciones);
        $this->Hospital_model->setventiladores_operativos_ucin_adulto($ventiladores_operativos_ucin_adulto);
        $this->Hospital_model->setventiladores_operativos_ucin_pediatrico($ventiladores_operativos_ucin_pediatrico);
        $this->Hospital_model->setventiladores_operativos_ucin_neonato($ventiladores_operativos_ucin_neonato);
        $this->Hospital_model->setventiladores_operativos_uci_gineco_obstetricia($ventiladores_operativos_uci_gineco_obstetricia);
        $this->Hospital_model->setventiladores_operativos_ucin_gineco_obstetricia($ventiladores_operativos_ucin_gineco_obstetricia);
        $this->Hospital_model->setventiladores_disponibles_trauma_shock_adulto($ventiladores_disponibles_trauma_shock_adulto);
        $this->Hospital_model->setventiladores_disponibles_trauma_shock_pediatrico($ventiladores_disponibles_trauma_shock_pediatrico);
        $this->Hospital_model->setventiladores_disponibles_uci_adultos($ventiladores_disponibles_uci_adultos);
        $this->Hospital_model->setventiladores_disponibles_uci_pedriatrica($ventiladores_disponibles_uci_pedriatrica);
        $this->Hospital_model->setventiladores_disponibles_uci_neonatologia($ventiladores_disponibles_uci_neonatologia);
        $this->Hospital_model->setventiladores_disponibles_sala_operaciones($ventiladores_disponibles_sala_operaciones);
        $this->Hospital_model->setventiladores_disponibles_ucin_adulto($ventiladores_disponibles_ucin_adulto);
        $this->Hospital_model->setventiladores_disponibles_ucin_pediatrico($ventiladores_disponibles_ucin_pediatrico);
        $this->Hospital_model->setventiladores_disponibles_ucin_neonato($ventiladores_disponibles_ucin_neonato);
        $this->Hospital_model->setventiladores_disponibles_uci_gineco_obstetricia($ventiladores_disponibles_uci_gineco_obstetricia);
        $this->Hospital_model->setventiladores_disponibles_ucin_gineco_obstetricia($ventiladores_disponibles_ucin_gineco_obstetricia);
        $this->Hospital_model->setventiladores_alquilados_trauma_shock_adulto($ventiladores_alquilados_trauma_shock_adulto);
        $this->Hospital_model->setventiladores_alquilados_trauma_shock_pediatrico($ventiladores_alquilados_trauma_shock_pediatrico);
        $this->Hospital_model->setventiladores_alquilados_uci_adultos($ventiladores_alquilados_uci_adultos);
        $this->Hospital_model->setventiladores_alquilados_uci_pedriatrica($ventiladores_alquilados_uci_pedriatrica);
        $this->Hospital_model->setventiladores_alquilados_uci_neonatologia($ventiladores_alquilados_uci_neonatologia);
        $this->Hospital_model->setventiladores_alquilados_sala_operaciones($ventiladores_alquilados_sala_operaciones);
        $this->Hospital_model->setventiladores_alquilados_ucin_adulto($ventiladores_alquilados_ucin_adulto);
        $this->Hospital_model->setventiladores_alquilados_ucin_pediatrico($ventiladores_alquilados_ucin_pediatrico);
        $this->Hospital_model->setventiladores_alquilados_ucin_neonato($ventiladores_alquilados_ucin_neonato);
        $this->Hospital_model->setventiladores_alquilados_uci_gineco_obstetricia($ventiladores_alquilados_uci_gineco_obstetricia);
        $this->Hospital_model->setventiladores_alquilados_ucin_gineco_obstetricia($ventiladores_alquilados_ucin_gineco_obstetricia);
        $this->Hospital_model->setventiladores_brecha_trauma_shock_adulto($ventiladores_brecha_trauma_shock_adulto);
        $this->Hospital_model->setventiladores_brecha_trauma_shock_pediatrico($ventiladores_brecha_trauma_shock_pediatrico);
        $this->Hospital_model->setventiladores_brecha_uci_adultos($ventiladores_brecha_uci_adultos);
        $this->Hospital_model->setventiladores_brecha_uci_pedriatrica($ventiladores_brecha_uci_pedriatrica);
        $this->Hospital_model->setventiladores_brecha_uci_neonatologia($ventiladores_brecha_uci_neonatologia);
        $this->Hospital_model->setventiladores_brecha_sala_operaciones($ventiladores_brecha_sala_operaciones);
        $this->Hospital_model->setventiladores_brecha_ucin_adulto($ventiladores_brecha_ucin_adulto);
        $this->Hospital_model->setventiladores_brecha_ucin_pediatrico($ventiladores_brecha_ucin_pediatrico);
        $this->Hospital_model->setventiladores_brecha_ucin_neonato($ventiladores_brecha_ucin_neonato);
        $this->Hospital_model->setventiladores_brecha_uci_gineco_obstetricia($ventiladores_brecha_uci_gineco_obstetricia);
        $this->Hospital_model->setventiladores_brecha_ucin_gineco_obstetricia($ventiladores_brecha_ucin_gineco_obstetricia);
        $this->Hospital_model->setventiladores_portatiles_trauma_shock_adulto($ventiladores_portatiles_trauma_shock_adulto);
        $this->Hospital_model->setventiladores_portatiles_trauma_shock_pediatrico($ventiladores_portatiles_trauma_shock_pediatrico);
        $this->Hospital_model->setventiladores_portatiles_uci_adultos($ventiladores_portatiles_uci_adultos);
        $this->Hospital_model->setventiladores_portatiles_uci_pedriatrica($ventiladores_portatiles_uci_pedriatrica);
        $this->Hospital_model->setventiladores_portatiles_uci_neonatologia($ventiladores_portatiles_uci_neonatologia);
        $this->Hospital_model->setventiladores_portatiles_sala_operaciones($ventiladores_portatiles_sala_operaciones);
        $this->Hospital_model->setventiladores_portatiles_ucin_adulto($ventiladores_portatiles_ucin_adulto);
        $this->Hospital_model->setventiladores_portatiles_ucin_pediatrico($ventiladores_portatiles_ucin_pediatrico);
        $this->Hospital_model->setventiladores_portatiles_ucin_neonato($ventiladores_portatiles_ucin_neonato);
        $this->Hospital_model->setventiladores_portatiles_uci_gineco_obstetricia($ventiladores_portatiles_uci_gineco_obstetricia);
        $this->Hospital_model->setventiladores_portatiles_ucin_gineco_obstetricia($ventiladores_portatiles_ucin_gineco_obstetricia);
        $this->Hospital_model->setambulancias_tipo_i_registradas($ambulancias_tipo_i_registradas);
        $this->Hospital_model->setambulancias_tipo_i_operaivas($ambulancias_tipo_i_operaivas);
        $this->Hospital_model->setambulancias_tipo_i_radio($ambulancias_tipo_i_radio);
        $this->Hospital_model->setambulancias_tipo_ii_registradas($ambulancias_tipo_ii_registradas);
        $this->Hospital_model->setambulancias_tipo_ii_operaivas($ambulancias_tipo_ii_operaivas);
        $this->Hospital_model->setambulancias_tipo_ii_radio($ambulancias_tipo_ii_radio);
        $this->Hospital_model->setambulancias_tipo_iii_registradas($ambulancias_tipo_iii_registradas);
        $this->Hospital_model->setambulancias_tipo_iii_operaivas($ambulancias_tipo_iii_operaivas);
        $this->Hospital_model->setambulancias_tipo_iii_radio($ambulancias_tipo_iii_radio);        
        
        if($id>0){
            $count = 0;
        }
        else{
            $existe = $this->Hospital_model->existe();
            $this->Hospital_model->setfecha(formatearFechaParaBD($fecha)." ".$hora);
            $count = $existe->num_rows();
        }
        
        $this->Hospital_model->setid($id);
        
        $data = array(
            "listaralerta" => $listaralerta,
            "status" => 500,
            "message" => "Hubo un error en el proceso"
        );
        
        if($count>0){
            if($count>1) {
                $data = array(
                    "listaralerta" => $listaralerta,
                    "status" => 500,
                    "message" => "Las 2 horas ya han sido registradas"
                );
            }
            else {
                $existeRS = $existe->row();
                if($hora == $existeRS->hora) {
                    $data = array(
                        "listaralerta" => $listaralerta,
                        "status" => 500,
                        "message" => "La hora seleccionada ya ha sido registrada"
                    );
                }
                else {
                    if(strlen($hospitales_situaciones_nombre_id)<1 or strlen($responsable_reporte)<1 or strlen($jefe_guardia)<1 or strlen($fecha)<1 or strlen($hora)<1){
                        $data = array(
                            "listaralerta" => $listaralerta,
                            "status" => 500,
                            "message" => "Debe colocar los campos obligatorios"
                        );
                    }
                    else {
                        $message = "Hospital en emergencia registrado";
                        if($id>0) {$condicion = $this->Hospital_model->editar();$message = "Hospital en emergencia actualizado";
                        } else {
                            $id = $this->Hospital_model->registrar();
                            $condicion = false;
                            if ($id > 0) {
                                $condicion = true;
                            }
                        }
                        
                        if($condicion){
                            
                            $this->Hospital_model->setid($id);
                            $this->Hospital_model->eliminarOcurrencias();
                            if(strlen($ocurrencia) > 0) {
                                
                                $ocurrencias = explode("|||",$ocurrencia);
                                foreach($ocurrencias as $row):
                                    $ocurr = explode("||", $row);
                                
                                    $fecha =  explode(" ", $ocurr[0]);
                                    $fecha = formatearFechaParaBD($fecha[0])." ".$fecha[1].":00";
                                    $this->Hospital_model->sethospitales_situaciones_emergencia_fecha($fecha);
                                    $this->Hospital_model->sethospitales_situaciones_emergencia_ocurrencia($ocurr[1]);
                                    $this->Hospital_model->setid($id);
                                    $this->Hospital_model->registrarOcurrencia();
                                endforeach;
                            }
                            
                            $data = array(
                                "listaralerta" => $listaralerta,
                                "status" => 200,
                                "message" => $message
                            );
                            
                        }
                        else {
                            $data = array(
                                "listaralerta" => $listaralerta,
                                "status" => 500,
                                "message" => $message
                            );
                        }
                        
                    }
                    
                }
            }
        }
        else {
            $message = "Hospital en emergencia registrado";
            if($id>0) {$condicion = $this->Hospital_model->editar();$message = "Hospital en emergencia actualizado"; 
            } else {
                $id = $this->Hospital_model->registrar();
                $condicion = false;
                if ($id > 0) {
                    $condicion = true;
                }
            }

            if($condicion){
                $this->Hospital_model->setid($id);
                $this->Hospital_model->eliminarOcurrencias();
                if(strlen($ocurrencia) > 0) {
                    $ocurrencias = explode("|||",$ocurrencia);
                    foreach($ocurrencias as $row):
                    $ocurr = explode("||", $row);
                    
                    $fecha =  explode(" ", $ocurr[0]);
                    $fecha = formatearFechaParaBD($fecha[0])." ".$fecha[1].":00";
                    $this->Hospital_model->sethospitales_situaciones_emergencia_fecha($fecha);
                    $this->Hospital_model->sethospitales_situaciones_emergencia_ocurrencia($ocurr[1]);
                    $this->Hospital_model->setid($id);
                    $this->Hospital_model->registrarOcurrencia();
                    endforeach;
                }
                $data = array(
                    "listaralerta" => $listaralerta,
                    "status" => 200,
                    "message" => $message
                );
                
            }
            else {
                $data = array(
                    "listaralerta" => $listaralerta,
                    "status" => 500,
                    "message" => "Error en la operación"
                );
            }
            
        }
        
        echo json_encode($data);
    }

    public function gestionarDemanda() {
        
        $this->load->model("HospitalDemanda_model");
        $this->load->model("AlertaPronostico_model");

        $id = $this->input->post("id");
        $this->HospitalDemanda_model->setid($id);
        $this->HospitalDemanda_model->setipress($this->input->post("ipress")? $this->input->post("ipress") : 0);
        $this->HospitalDemanda_model->setregion($this->input->post("region")? $this->input->post("region"): "00");
        $this->HospitalDemanda_model->setemed_tipo_documento($this->input->post("emed_tipo_documento"));
        $this->HospitalDemanda_model->setdni_responsable_reporte($this->input->post("dni_responsable_reporte"));
        $this->HospitalDemanda_model->setresponsable_reporte($this->input->post("responsable_reporte"));
        $this->HospitalDemanda_model->setocupacion_responsable_reporte($this->input->post("ocupacion_responsable_reporte"));
        $this->HospitalDemanda_model->settelefono_responsable_reporte($this->input->post("telefono_responsable_reporte"));
        $this->HospitalDemanda_model->setsupervidor_tipo_documento($this->input->post("supervidor_tipo_documento"));
        $this->HospitalDemanda_model->setdni_jefe_guardia($this->input->post("dni_jefe_guardia"));
        $this->HospitalDemanda_model->setjefe_guardia($this->input->post("jefe_guardia"));
        $this->HospitalDemanda_model->setocupacion_jefe_guardia($this->input->post("ocupacion_jefe_guardia"));
        $this->HospitalDemanda_model->settelefono_jefe_guardia($this->input->post("telefono_jefe_guardia"));
        $this->HospitalDemanda_model->setatencionInterna($this->input->post("atencionInterna") == "on"? "1" : "0");
        $this->HospitalDemanda_model->setatencionExterna($this->input->post("atencionExterna") == "on"? "1" : "0");
        $this->HospitalDemanda_model->setfechaRegistro(formatearFechaParaBD(explode(" ", $this->input->post("fechaRegistro"))[0]));
        $this->HospitalDemanda_model->setHospitalizacion_convencionales_h($this->input->post("hospitalizacion_convencionales_h"));
        $this->HospitalDemanda_model->setHospitalizacion_convencionales_u($this->input->post("hospitalizacion_convencionales_u"));
        $this->HospitalDemanda_model->setHospitalizacion_convencionales_o($this->input->post("hospitalizacion_convencionales_o"));   
        $this->HospitalDemanda_model->setHospitalizacion_covid_o($this->input->post("hospitalizacion_covid_o"));
        $this->HospitalDemanda_model->setHospitalizacion_e_interna_o($this->input->post("hospitalizacion_e_interna_o"));
        $this->HospitalDemanda_model->setHospitalizacion_e_externa_o($this->input->post("hospitalizacion_e_externa_o"));
        $this->HospitalDemanda_model->setHospitalizacion_disponibles_momento($this->input->post("hospitalizacion_disponibles_momento"));
        $this->HospitalDemanda_model->setHospitalizacion_camas_01($this->input->post("hospitalizacion_camas_01"));
        $this->HospitalDemanda_model->setHospitalizacion_medicos_01($this->input->post("hospitalizacion_medicos_01"));
        $this->HospitalDemanda_model->setHospitalizacion_indicador_01($this->input->post("hospitalizacion_indicador_01"));
        $this->HospitalDemanda_model->setHospitalizacion_observaciones_01($this->input->post("hospitalizacion_observaciones_01"));
        $this->HospitalDemanda_model->setHospitalizacion_camas_02($this->input->post("hospitalizacion_camas_02"));
        $this->HospitalDemanda_model->setHospitalizacion_enfermeras_02($this->input->post("hospitalizacion_enfermeras_02"));
        $this->HospitalDemanda_model->setHospitalizacion_indicador_02($this->input->post("hospitalizacion_indicador_02"));
        $this->HospitalDemanda_model->setHospitalizacion_observaciones_02($this->input->post("hospitalizacion_observaciones_02"));
        $this->HospitalDemanda_model->setEmergencia_convencionales_o($this->input->post("emergencia_convencionales_o"));
        $this->HospitalDemanda_model->setEmergencia_covid_o($this->input->post("emergencia_covid_o"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_02_h($this->input->post("emergencia_e_externa_02_h"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_02_u($this->input->post("emergencia_e_externa_02_u"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_o_02($this->input->post("emergencia_e_externa_o_02"));
        $this->HospitalDemanda_model->setEmergencia_e_interna_o($this->input->post("emergencia_e_interna_o"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_o($this->input->post("emergencia_e_externa_o"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_03_h($this->input->post("emergencia_e_externa_03_h"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_03_u($this->input->post("emergencia_e_externa_03_u"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_o_03($this->input->post("emergencia_e_externa_o_03"));
        $this->HospitalDemanda_model->setEmergencia_pacientes_01($this->input->post("emergencia_pacientes_01"));
        $this->HospitalDemanda_model->setEmergencia_pacientes_02($this->input->post("emergencia_pacientes_02"));
        $this->HospitalDemanda_model->setEmergencia_camas_01($this->input->post("emergencia_camas_01"));
        $this->HospitalDemanda_model->setEmergencia_medicos_01($this->input->post("emergencia_medicos_01"));
        $this->HospitalDemanda_model->setEmergencia_indicador_01($this->input->post("emergencia_indicador_01"));
        $this->HospitalDemanda_model->setEmergencia_observaciones_01($this->input->post("emergencia_observaciones_01"));
        $this->HospitalDemanda_model->setEmergencia_camas_02($this->input->post("emergencia_camas_02"));
        $this->HospitalDemanda_model->setEmergencia_enfermeras_02($this->input->post("emergencia_enfermeras_02"));
        $this->HospitalDemanda_model->setEmergencia_indicador_02($this->input->post("emergencia_indicador_02"));
        $this->HospitalDemanda_model->setEmergencia_observaciones_02($this->input->post("emergencia_observaciones_02"));
        $this->HospitalDemanda_model->setEmergencia_espera_u_momento($this->input->post("emergencia_espera_u_momento"));
        $this->HospitalDemanda_model->setCriticos_convencionales_o($this->input->post("criticos_convencionales_o"));
        $this->HospitalDemanda_model->setCriticos_covid_o($this->input->post("criticos_covid_o"));
        $this->HospitalDemanda_model->setCriticos_e_interna_o($this->input->post("criticos_e_interna_o"));
        $this->HospitalDemanda_model->setCriticos_e_externa_o($this->input->post("criticos_e_externa_o"));
        $this->HospitalDemanda_model->setCriticos_espera_o($this->input->post("criticos_espera_o"));
        $this->HospitalDemanda_model->setCriticos_espera_u_momento($this->input->post("criticos_espera_u_momento"));
        $this->HospitalDemanda_model->setCriticos_espera_u_momento_o($this->input->post("criticos_espera_u_momento_o"));
        $this->HospitalDemanda_model->setCriticos_disponibles_momento($this->input->post("criticos_disponibles_momento"));
        $this->HospitalDemanda_model->setCriticos_camas_01($this->input->post("criticos_camas_01"));
        $this->HospitalDemanda_model->setCriticos_medicos_01($this->input->post("criticos_medicos_01"));
        $this->HospitalDemanda_model->setCriticos_indicador_01($this->input->post("criticos_indicador_01"));
        $this->HospitalDemanda_model->setCriticos_observaciones_01($this->input->post("criticos_observaciones_01"));
        $this->HospitalDemanda_model->setCriticos_camas_02($this->input->post("criticos_camas_02"));
        $this->HospitalDemanda_model->setCriticos_enfermeras_02($this->input->post("criticos_enfermeras_02"));
        $this->HospitalDemanda_model->setCriticos_indicador_02($this->input->post("criticos_indicador_02"));
        $this->HospitalDemanda_model->setCriticos_observaciones_02($this->input->post("criticos_indicador_02"));
        $this->HospitalDemanda_model->setPediatricos_convencionales_o($this->input->post("pediatricos_convencionales_o"));
        $this->HospitalDemanda_model->setPediatricos_covid_o($this->input->post("pediatricos_covid_o"));
        $this->HospitalDemanda_model->setPediatricos_e_interna_o($this->input->post("pediatricos_e_interna_o"));
        $this->HospitalDemanda_model->setPediatricos_e_externa_o($this->input->post("pediatricos_e_externa_o"));
        $this->HospitalDemanda_model->setPediatricos_espera_o($this->input->post("pediatricos_espera_o"));
        $this->HospitalDemanda_model->setPediatricos_paciente_01($this->input->post("pediatricos_paciente_01"));
        $this->HospitalDemanda_model->setPediatricos_paciente_01_o($this->input->post("pediatricos_paciente_01_o"));
        $this->HospitalDemanda_model->setPediatricos_disponibles_momento($this->input->post("pediatricos_disponibles_momento"));
        $this->HospitalDemanda_model->setPediatricos_camas_01($this->input->post("pediatricos_camas_01"));
        $this->HospitalDemanda_model->setPediatricos_medicos_01($this->input->post("pediatricos_medicos_01"));
        $this->HospitalDemanda_model->setPediatricos_indicador_01($this->input->post("pediatricos_indicador_01"));
        $this->HospitalDemanda_model->setPediatricos_observaciones_01($this->input->post("pediatricos_observaciones_01"));
        $this->HospitalDemanda_model->setPediatricos_camas_02($this->input->post("pediatricos_camas_02"));
        $this->HospitalDemanda_model->setPediatricos_enfermeras_02($this->input->post("pediatricos_enfermeras_02"));
        $this->HospitalDemanda_model->setPediatricos_indicador_02($this->input->post("pediatricos_indicador_02"));
        $this->HospitalDemanda_model->setPediatricos_observaciones_02($this->input->post("pediatricos_observaciones_02"));
        $this->HospitalDemanda_model->setHospitalizacion_covid_h($this->input->post("hospitalizacion_covid_h"));
        $this->HospitalDemanda_model->setHospitalizacion_covid_u($this->input->post("hospitalizacion_covid_u"));
        $this->HospitalDemanda_model->setHospitalizacion_e_interna_h($this->input->post("hospitalizacion_e_interna_h"));
        $this->HospitalDemanda_model->setHospitalizacion_e_interna_u($this->input->post("hospitalizacion_e_interna_u"));
        $this->HospitalDemanda_model->setHospitalizacion_e_externa_h($this->input->post("hospitalizacion_e_externa_h"));
        $this->HospitalDemanda_model->setHospitalizacion_e_externa_u($this->input->post("hospitalizacion_e_externa_u"));
        $this->HospitalDemanda_model->setHospitalizacion_total_h($this->input->post("hospitalizacion_total_h"));
        $this->HospitalDemanda_model->setHospitalizacion_total_u($this->input->post("hospitalizacion_total_u"));
        $this->HospitalDemanda_model->setHospitalizacion_disponibles($this->input->post("hospitalizacion_disponibles"));
        $this->HospitalDemanda_model->setHospitalizacion_porcentaje_01($this->input->post("hospitalizacion_porcentaje_01"));
        $this->HospitalDemanda_model->setHospitalizacion_sospechosos_h_covid($this->input->post("hospitalizacion_sospechosos_h_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_sospechosos_u_covid($this->input->post("hospitalizacion_sospechosos_u_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_e_interna_h_covid($this->input->post("hospitalizacion_e_interna_h_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_e_interna_u_covid($this->input->post("hospitalizacion_e_interna_u_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_e_externa_h_covid($this->input->post("hospitalizacion_e_externa_h_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_e_externa_u_covid($this->input->post("hospitalizacion_e_externa_u_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_total_h_covid($this->input->post("hospitalizacion_total_h_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_total_u_covid($this->input->post("hospitalizacion_total_u_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_disponibles_covid($this->input->post("hospitalizacion_disponibles_covid"));
        $this->HospitalDemanda_model->setHospitalizacion_porcentaje_02($this->input->post("hospitalizacion_porcentaje_02"));
        $this->HospitalDemanda_model->setEmergencia_convencionales_h($this->input->post("emergencia_convencionales_h"));
        $this->HospitalDemanda_model->setEmergencia_convencionales_u($this->input->post("emergencia_convencionales_u"));
        $this->HospitalDemanda_model->setEmergencia_covid_h($this->input->post("emergencia_covid_h"));
        $this->HospitalDemanda_model->setEmergencia_covid_u($this->input->post("emergencia_covid_u"));
        $this->HospitalDemanda_model->setEmergencia_e_interna_h($this->input->post("emergencia_e_interna_h"));
        $this->HospitalDemanda_model->setEmergencia_e_interna_u($this->input->post("emergencia_e_interna_u"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_h($this->input->post("emergencia_e_externa_h"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_u($this->input->post("emergencia_e_externa_u"));
        $this->HospitalDemanda_model->setEmergencia_espera_u($this->input->post("emergencia_espera_u"));
        $this->HospitalDemanda_model->setEmergencia_total_h($this->input->post("emergencia_total_h"));
        $this->HospitalDemanda_model->setEmergencia_total_u($this->input->post("emergencia_total_u"));
        $this->HospitalDemanda_model->setEmergencia_porcentaje_01($this->input->post("emergencia_porcentaje_01"));
        $this->HospitalDemanda_model->setEmergencia_disponibles($this->input->post("emergencia_disponibles"));
        $this->HospitalDemanda_model->setEmergencia_sospechosos_h_covid($this->input->post("emergencia_sospechosos_h_covid"));
        $this->HospitalDemanda_model->setEmergencia_sospechosos_u_covid($this->input->post("emergencia_sospechosos_u_covid"));
        $this->HospitalDemanda_model->setEmergencia_e_interna_h_covid($this->input->post("emergencia_e_interna_h_covid"));
        $this->HospitalDemanda_model->setEmergencia_e_interna_u_covid($this->input->post("emergencia_e_interna_u_covid"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_h_covid($this->input->post("emergencia_e_externa_h_covid"));
        $this->HospitalDemanda_model->setEmergencia_e_externa_u_covid($this->input->post("emergencia_e_externa_u_covid"));
        $this->HospitalDemanda_model->setEmergencia_espera_u_covid($this->input->post("emergencia_espera_u_covid"));
        $this->HospitalDemanda_model->setEmergencia_total_h_covid($this->input->post("emergencia_total_h_covid"));
        $this->HospitalDemanda_model->setEmergencia_total_u_covid($this->input->post("emergencia_total_u_covid"));
        $this->HospitalDemanda_model->setEmergencia_disponibles_covid($this->input->post("emergencia_disponibles_covid"));
        $this->HospitalDemanda_model->setEmergencia_porcentaje_02($this->input->post("emergencia_porcentaje_02"));
        $this->HospitalDemanda_model->setCriticos_convencionales_h($this->input->post("criticos_convencionales_h"));
        $this->HospitalDemanda_model->setCriticos_convencionales_u($this->input->post("criticos_convencionales_u"));
        $this->HospitalDemanda_model->setCriticos_covid_h($this->input->post("criticos_covid_h"));
        $this->HospitalDemanda_model->setCriticos_covid_u($this->input->post("criticos_covid_u"));
        $this->HospitalDemanda_model->setCriticos_e_interna_h($this->input->post("criticos_e_interna_h"));
        $this->HospitalDemanda_model->setCriticos_e_interna_u($this->input->post("criticos_e_interna_u"));
        $this->HospitalDemanda_model->setCriticos_e_externa_h($this->input->post("criticos_e_externa_h"));
        $this->HospitalDemanda_model->setCriticos_e_externa_u($this->input->post("criticos_e_externa_u"));
        $this->HospitalDemanda_model->setCriticos_espera_u($this->input->post("criticos_espera_u"));
        $this->HospitalDemanda_model->setCriticos_total_h($this->input->post("criticos_total_h"));
        $this->HospitalDemanda_model->setCriticos_total_u($this->input->post("criticos_total_u"));
        $this->HospitalDemanda_model->setCriticos_disponibles($this->input->post("criticos_disponibles"));
        $this->HospitalDemanda_model->setCriticos_porcentaje_01($this->input->post("criticos_porcentaje_01"));
        $this->HospitalDemanda_model->setCriticos_sospechosos_h_covid($this->input->post("criticos_sospechosos_h_covid"));
        $this->HospitalDemanda_model->setCriticos_sospechosos_u_covid($this->input->post("criticos_sospechosos_u_covid"));
        $this->HospitalDemanda_model->setCriticos_e_interna_h_covid($this->input->post("criticos_e_interna_h_covid"));
        $this->HospitalDemanda_model->setCriticos_e_interna_u_covid($this->input->post("criticos_e_interna_u_covid"));
        $this->HospitalDemanda_model->setCriticos_e_externa_h_covid($this->input->post("criticos_e_externa_h_covid"));
        $this->HospitalDemanda_model->setCriticos_e_externa_u_covid($this->input->post("criticos_e_externa_u_covid"));
        $this->HospitalDemanda_model->setCriticos_espera_u_covid($this->input->post("criticos_espera_u_covid"));
        $this->HospitalDemanda_model->setCriticos_total_h_covid($this->input->post("criticos_total_h_covid"));
        $this->HospitalDemanda_model->setCriticos_total_u_covid($this->input->post("criticos_total_u_covid"));
        $this->HospitalDemanda_model->setCriticos_disponibles_covid($this->input->post("criticos_disponibles_covid"));
        $this->HospitalDemanda_model->setCriticos_porcentaje_02($this->input->post("criticos_porcentaje_02"));
        $this->HospitalDemanda_model->setPediatricos_convencionales_h($this->input->post("pediatricos_convencionales_h"));
        $this->HospitalDemanda_model->setPediatricos_convencionales_u($this->input->post("pediatricos_convencionales_u"));
        $this->HospitalDemanda_model->setPediatricos_covid_h($this->input->post("pediatricos_covid_h"));
        $this->HospitalDemanda_model->setPediatricos_covid_u($this->input->post("pediatricos_covid_u"));
        $this->HospitalDemanda_model->setPediatricos_e_interna_h($this->input->post("pediatricos_e_interna_h"));
        $this->HospitalDemanda_model->setPediatricos_e_interna_u($this->input->post("pediatricos_e_interna_u"));
        $this->HospitalDemanda_model->setPediatricos_e_externa_h($this->input->post("pediatricos_e_externa_h"));
        $this->HospitalDemanda_model->setPediatricos_e_externa_u($this->input->post("pediatricos_e_externa_u"));
        $this->HospitalDemanda_model->setPediatricos_espera_u($this->input->post("pediatricos_espera_u"));
        $this->HospitalDemanda_model->setPediatricos_total_h($this->input->post("pediatricos_total_h"));
        $this->HospitalDemanda_model->setPediatricos_total_u($this->input->post("pediatricos_total_u"));
        $this->HospitalDemanda_model->setPediatricos_disponibles($this->input->post("pediatricos_disponibles"));
        $this->HospitalDemanda_model->setPediatricos_porcentaje_01($this->input->post("pediatricos_porcentaje_01"));
        $this->HospitalDemanda_model->setPediatricos_sospechosos_h_covid($this->input->post("pediatricos_sospechosos_h_covid"));
        $this->HospitalDemanda_model->setPediatricos_sospechosos_u_covid($this->input->post("pediatricos_sospechosos_u_covid"));
        $this->HospitalDemanda_model->setPediatricos_e_interna_h_covid($this->input->post("pediatricos_e_interna_h_covid"));
        $this->HospitalDemanda_model->setPediatricos_e_interna_u_covid($this->input->post("pediatricos_e_interna_u_covid"));
        $this->HospitalDemanda_model->setPediatricos_e_externa_h_covid($this->input->post("pediatricos_e_externa_h_covid"));
        $this->HospitalDemanda_model->setPediatricos_e_externa_u_covid($this->input->post("pediatricos_e_externa_u_covid"));
        $this->HospitalDemanda_model->setPediatricos_espera_u_covid($this->input->post("pediatricos_espera_u_covid"));
        $this->HospitalDemanda_model->setPediatricos_total_h_covid($this->input->post("pediatricos_total_h_covid"));
        $this->HospitalDemanda_model->setPediatricos_total_u_covid($this->input->post("pediatricos_total_u_covid"));
        $this->HospitalDemanda_model->setPediatricos_disponibles_covid($this->input->post("pediatricos_disponibles_covid"));
        $this->HospitalDemanda_model->setPediatricos_porcentaje_02($this->input->post("pediatricos_porcentaje_02"));
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($id > 0) {
            if ($this->HospitalDemanda_model->actualizar()) {
                $status = 200;
                $message = "Ficha de Evaluación Actualziada Exitosamente";
            }
        } else {
            if ($this->HospitalDemanda_model->registrar()) {
                $status = 200;
                $message = "Ficha de Evaluación Registrado Exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
               
        echo json_encode($data);
    }
    
    public function eliminar() {
        
        $this->load->model("Hospital_model");
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Hospital_model->setid($id);
        if($this->Hospital_model->eliminar() == 1 ) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        else { $this->session->set_flashdata('messageError', 'No se puede eliminar'); }
        
        redirect('hospitales');
        
    }
    
    public function reporte() {
        
        $this->load->model("Hospital_model");
        $this->load->model("HospitalDemanda_model");
        $this->load->model("AlertaPronostico_model");
        
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $datos = array();        
        
        $data = Array(
            "lista" => $datos,
            "listaralerta" => $listaralerta
            );
        
        $this->load->view("hospitales/reporte",$data);
        
    }

    public function obtenerReporte(){
        $this->load->model("HospitalDemanda_model");

        $this->HospitalDemanda_model->setfechaRegistro($this->input->post("fechaRegistro"));
        $tipoReporte = $this->input->post("reporte");

        if ($tipoReporte == 0) {
            $listaReporte = $this->HospitalDemanda_model->listarReporteLima();
        } else {
            $listaReporte = $this->HospitalDemanda_model->listarReporteRegion();
        }
       
        if ($listaReporte->num_rows() > 0) {
            $listaReporte = $listaReporte->result();
        } else {
            $listaReporte = array();
        }

        $detalle = array(
          "lista" => $listaReporte
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function curl()
    {
        
        $tipo_documento = $this->input->post("type");
        $documento = $this->input->post("document");
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, getenv("API_RENIEC_URL").$tipo_documento."/".$documento."/");
        curl_setopt($handler, CURLOPT_HEADER, false);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array("Authorization: ".getenv("API_RENIEC_TOKEN"),"Content-Type: application/json"));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
        
        curl_close($handler);
        
        echo $data;
        
    }

    public function obtenerGrafica(){
        $this->load->model("HospitalDemanda_model");

        $this->HospitalDemanda_model->setfechaRegistro($this->input->post("fechaRegistro"));
        $tipoReporte = $this->input->post("reporte");

        if ($tipoReporte == 0) {
            $listaReporte = $this->HospitalDemanda_model->listarGraficaLima();
        } else {
            $listaReporte = $this->HospitalDemanda_model->listarGraficaRegion();
        }
        
       
        if ($listaReporte->num_rows() > 0) {
            $listaReporte = $listaReporte->result();
        } else {
            $listaReporte = array();
        }

        $detalle = array(
          "lista" => $listaReporte
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function plantilla(){
        $nivel = 1;
        $idmenu = 9;
        
        validarPermisos($nivel,$idmenu,$this->permisos);
        
        $this->load->model("Hospital_model");
        $this->load->model("HospitalDemanda_model");
        $this->load->model("AlertaPronostico_model");
        
        $listar = $this->HospitalDemanda_model->listar();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
  
        if ($listar->num_rows() > 0) {
            $listar = $listar->result();
        } else {
            $listar = array();
        }

        $datos = array();

        $data = Array(
            "lista" => json_encode($listar),
            "listaralerta" => json_encode($listaralerta), 
            );

        $this->load->view("hospitales/plantilla",$data);
    }

    public function formLima(){

        $this->load->model("Hospital_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("Ubigeo_model");

        $tipo = $this->input->post("type");
        $hospitales = $this->Hospital_model->hospitalesSituaciones();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $listaRegiones = $this->Ubigeo_model->obtenerRegiones();
        
        $data = array(
            "hospitales" => $hospitales->result(),
            "listaRegiones" => $listaRegiones->result(),
            "listaralerta" => $listaralerta,
            "tipo" => $tipo,
        ); 

        $this->load->view("hospitales/form-lima",$data);
    }
    
    public function editarFicha(){

        $this->load->model("Hospital_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("Ubigeo_model"); 

        $id = $this->input->post("id");
        $this->Hospital_model->setid($id);
        $hospitales = $this->Hospital_model->hospitalesSituaciones();
        $hospital = $this->Hospital_model->hospitalesSobreDemandaNew();
        $ocurrencias = $this->Hospital_model->listarOcurrencias();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $tipo = 1;//$this->Hospital_model->hospitalesSobreDemandaNewTipo();
        $listaRegiones = $this->Ubigeo_model->obtenerRegiones();
        $data = array(
            "hospitales" => $hospitales->result(),
            "hospital" => $hospital->row(),
            "listaRegiones" => $listaRegiones->result(),
            "ocurrencias" => $ocurrencias,
            "listaralerta" => $listaralerta,
            "tipo" => $tipo
        );
        $this->load->view("hospitales/form-ficha-edit",$data);
    }    
    
}
