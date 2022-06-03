<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    private $permisos = null;
    
    function __construct() {

      parent::__construct();
    
      $token = $this->session->userdata("token");
    
      (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY"),false):redirect("login");
    
      $this->session->set_userdata("idmodulo", 18);
    
      ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
    
      if(sha1($usuario)==$token->usuario){
    
          if (count($token->modulos)>0) {
    
              $listaModulos = $token->modulos;
    
              $permanecer = false;
    
              foreach ($listaModulos as $row) :
              if ($row->idmodulo == 18 and $row->estado == 1)
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

    public function index() {

        $nivel = 1;
        $idmenu = 21;

        validarPermisos($nivel,$idmenu,$this->permisos);

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("Enfermedad_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
    
        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $pacientes = $this->Enfermedad_model->obtenerPacientes_New();
        $pacientesMasculinos = $this->Enfermedad_model->obtenerPacientesSexo("Masculino")->row();
        $pacientesFemeninos = $this->Enfermedad_model->obtenerPacientesSexo("Femenino")->row();
        $pacientesSCO = $this->Enfermedad_model->obtenerPacientesCriticos("SCO")->row();
        $pacientesSSO = $this->Enfermedad_model->obtenerPacientesCriticos("SSO")->row();
        $pacientesUCV = $this->Enfermedad_model->obtenerPacientesCriticos("UCV")->row();
        $pacientesUSV = $this->Enfermedad_model->obtenerPacientesCriticos("USV")->row();
        $totalPacientes = $this->Enfermedad_model->obtenerTotalPacientes()->row();
        $totalSospechosos = $this->Enfermedad_model->obtenerTotalPacientesSospechoso()->row();
        $totalNegativos = $this->Enfermedad_model->obtenerTotalPacientesNegativo()->row();
        $totalPositivos = $this->Enfermedad_model->obtenerTotalPacientesPositivo()->row();
        $grafico = $this->Enfermedad_model->obtenerReporteGrafica();
        $rsPaises = $this->EventoTipoEntidadAtencion_model->paises();
        $paises = $rsPaises->result();

        if ($pacientes->num_rows() > 0) {
            $pacientes = $pacientes->result();
        } else {
            $pacientes = array();
        }

        $graficoSexo = array(
            "VARONES" => $pacientesMasculinos->total,
            "MUJERES" => $pacientesFemeninos->total
        );

        $graficoCritico = array(
            "SALA_CON_OXIGENO" => $pacientesSCO->total,
            "SALA_SIN_OXIGENO" => $pacientesSSO->total,
            "UCI_CON_VM" => $pacientesUCV->total,
            "UCI_SIN_VM" => $pacientesUSV->total
        );

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result(),
            "tipodocumento" => $tipodocumento,
            "pacientes" => json_encode($pacientes),
            "grafico" => json_encode($grafico->result()),
            "totalPacientes" => $totalPacientes->total,
            "totalSospechosos" => $totalSospechosos->total,
            "totalNegativos" => $totalNegativos->total,
            "totalPositivos" => $totalPositivos->total,
            "graficoSexo" => json_encode($graficoSexo),
            "graficoCritico" => json_encode($graficoCritico),
            "paises" => json_encode($paises)
        );

        $this->load->view("enfermedad/dashboard", $data);
        
    }

    public function listaexamenesnew()
    {
        $this->load->model("Enfermedad_model");

        $listaexamenesnew = $this->Enfermedad_model->listaexamenesnew();
        
        echo json_encode(array("listaexamenesnew"=>$listaexamenesnew->result()));
        
    }

    public function listaexamenes_edit()
    {
        $this->load->model("Enfermedad_model");

        $id = $this->input->post("idpaciente");
        $this-> Enfermedad_model->setidpaciente($id);
        
        $listaexamenes_edit = $this->Enfermedad_model->listaexamenes_edit();
        $data = array(
          "listaexamenes_edit" => $listaexamenes_edit->result()
        );

        $data = array(
            "status" => 200,
            "data" => $data
        );

        echo json_encode($data);
    }

    public function reporte() {

        $nivel = 1;
        $idmenu = 23;

        validarPermisos($nivel,$idmenu,$this->permisos);

        $this->load->model("Enfermedad_model");
        $pacientes = $this->Enfermedad_model->obtenerReportePacientes();

        if ($pacientes->num_rows() > 0) {
            $pacientes = $pacientes->result();
        } else {
            $pacientes = array();
        }

        $data = array(
            "pacientes" => json_encode($pacientes),
        );

        $this->load->view("enfermedad/reporte", $data);
        
    }

    public function guardarPaciente() {
        $arrEnfermedad = [];
        $this->load->model("Enfermedad_model");
        
        $listae = $this->Enfermedad_model->listaexamenesnew();

        $this->Enfermedad_model->setidpaciente($this->input->post("id"));
        $this->Enfermedad_model->setidrenipress($this->input->post("idrenipress"));
        $this->Enfermedad_model->settipoDocumento(substr($this->input->post("tipoDocumento"),1));
        $this->Enfermedad_model->setnumeroDocumento($this->input->post("numeroDocumento"));
        $this->Enfermedad_model->setapellido($this->input->post("apellido"));
        $this->Enfermedad_model->setnombre($this->input->post("nombre"));
        $this->Enfermedad_model->setsexo($this->input->post("sexo"));
        $this->Enfermedad_model->setgestante($this->input->post("gestante"));
        $this->Enfermedad_model->setfechaNacimiento(formatearFechaParaBD(explode(" ", $this->input->post("fechaNacimiento"))[0]));
        $this->Enfermedad_model->setedad($this->input->post("edad"));
        $this->Enfermedad_model->setdomicilio($this->input->post("domicilio"));

        $this->Enfermedad_model->setnumero_historia($this->input->post("numero_historia"));
        $this->Enfermedad_model->setingreso_hospital(formatearFechaParaBD(explode(" ", $this->input->post("ingreso_hospital"))[0]));
        $this->Enfermedad_model->setingreso_uci(formatearFechaParaBD(explode(" ", $this->input->post("ingreso_uci"))[0]));
        $this->Enfermedad_model->setidpais($this->input->post("id_pais"));
        $this->Enfermedad_model->settelefono($this->input->post("telefono"));
        $this->Enfermedad_model->settalla($this->input->post("talla"));
        $this->Enfermedad_model->setpeso_ideal_vm($this->input->post("peso_ideal_vm"));
        $this->Enfermedad_model->setpeso_actual($this->input->post("peso_actual"));
        $this->Enfermedad_model->setimc($this->input->post("imc"));
        $this->Enfermedad_model->setapache($this->input->post("apache"));
        $this->Enfermedad_model->setsofa($this->input->post("sofa"));
        $this->Enfermedad_model->settiempo_emfermedad($this->input->post("tiempo_emfermedad"));        

        $this->Enfermedad_model->sethta($this->input->post("hta") == "on"? "1" : "0");
        $this->Enfermedad_model->setotras_enf_pulmonares($this->input->post("otras_enf_pulmonares") == "on"? "1" : "0");
        $this->Enfermedad_model->setcancer($this->input->post("cancer") == "on"? "1" : "0");
        $this->Enfermedad_model->setdiabetes_mellitus($this->input->post("diabetes_mellitus") == "on"? "1" : "0");
        $this->Enfermedad_model->setasma($this->input->post("asma") == "on"? "1" : "0");
        $this->Enfermedad_model->setacv_previo($this->input->post("acv_previo") == "on"? "1" : "0");
        $this->Enfermedad_model->setepoc_bronquiectasias($this->input->post("epoc_bronquiectasias") == "on"? "1" : "0");
        $this->Enfermedad_model->setfalla_cardiaca($this->input->post("falla_cardiaca") == "on"? "1" : "0");
        $this->Enfermedad_model->setfumador_cronico($this->input->post("fumador_cronico") == "on"? "1" : "0");
        $this->Enfermedad_model->setepid_fibrosis_pulmonar($this->input->post("epid_fibrosis_pulmonar") == "on"? "1" : "0");
        $this->Enfermedad_model->setenf_renal_cronica($this->input->post("enf_renal_cronica") == "on"? "1" : "0");
        $this->Enfermedad_model->setvih($this->input->post("vih") == "on"? "1" : "0");
        $this->Enfermedad_model->setviajes_pervios($this->input->post("viajes_pervios") == "on"? "1" : "0");
        $this->Enfermedad_model->setcontacto_personas_covid($this->input->post("contacto_personas_covid") == "on"? "1" : "0");
        $this->Enfermedad_model->setcontacto_extranjeros($this->input->post("contacto_extranjeros") == "on"? "1" : "0");
        $this->Enfermedad_model->setpersonal_salud($this->input->post("personal_salud") == "on"? "1" : "0");
        $this->Enfermedad_model->setrinorrea($this->input->post("rinorrea") == "on"? "1" : "0");
        $this->Enfermedad_model->settos_con_flema($this->input->post("tos_con_flema") == "on"? "1" : "0");
        $this->Enfermedad_model->setdisnea($this->input->post("disnea") == "on"? "1" : "0");
        $this->Enfermedad_model->setfiebre($this->input->post("fiebre") == "on"? "1" : "0");
        $this->Enfermedad_model->setfatiga($this->input->post("fatiga") == "on"? "1" : "0");
        $this->Enfermedad_model->setescalofrios($this->input->post("escalofrios") == "on"? "1" : "0");
        $this->Enfermedad_model->setcefalea($this->input->post("cefalea") == "on"? "1" : "0");
        $this->Enfermedad_model->sethemoptisis($this->input->post("hemoptisis") == "on"? "1" : "0");
        $this->Enfermedad_model->setdiarrea($this->input->post("diarrea") == "on"? "1" : "0");
        $this->Enfermedad_model->settos_seca($this->input->post("tos_seca") == "on"? "1" : "0");
        $this->Enfermedad_model->setmialgia_artralgia($this->input->post("mialgia_artralgia") == "on"? "1" : "0");
        $this->Enfermedad_model->setdolor_de_garganta($this->input->post("dolor_de_garganta") == "on"? "1" : "0");

        $this->Enfermedad_model->setpcr_rt_coronavirus($this->input->post("pcr_rt_coronavirus") == "on"? "1" : "0");
        $this->Enfermedad_model->setpcr_pt_influenza($this->input->post("pcr_pt_influenza") == "on"? "1" : "0");
        $this->Enfermedad_model->setprimer_cultivo_secresion($this->input->post("primer_cultivo_secresion") == "on"? "1" : "0");
        $this->Enfermedad_model->setfilmarray_respiratorio($this->input->post("filmarray_respiratorio") == "on"? "1" : "0");  
        $this->Enfermedad_model->setperdida_gusto($this->input->post("perdida_gusto") == "on"? "1" : "0"); 
        $this->Enfermedad_model->setperdida_olfato($this->input->post("perdida_olfato") == "on"? "1" : "0"); 
        $this->Enfermedad_model->sethemocultivo($this->input->post("hemocultivo") == "on"? "1" : "0");   
        $this->Enfermedad_model->setprueba_rapida($this->input->post("prueba_rapida") == "on"? "1" : "0");
        $this->Enfermedad_model->setprueba_rapida_igg($this->input->post("prueba_rapida_igg") == "on"? "1" : "0");
        $this->Enfermedad_model->setprueba_rapida_igm($this->input->post("prueba_rapida_igm") == "on"? "1" : "0");
        $this->Enfermedad_model->setotros_cultivos($this->input->post("otros_cultivos") == "on"? "1" : "0");
        
        $this->Enfermedad_model->setprocedencia_viajes($this->input->post("procedencia_viajes"));
        $this->Enfermedad_model->setprocedencia_extranjeros($this->input->post("procedencia_extranjeros"));
        $this->Enfermedad_model->setdisnea_dias($this->input->post("disnea_dias"));
        $this->Enfermedad_model->setfiebre_t_max($this->input->post("fiebre_t_max"));
        $this->Enfermedad_model->sethb($this->input->post("hb"));
        $this->Enfermedad_model->setldh($this->input->post("ldh"));
        $this->Enfermedad_model->setprocalcitonina($this->input->post("procalcitonina"));
        $this->Enfermedad_model->setleucocitos($this->input->post("leucocitos"));
        $this->Enfermedad_model->settgo($this->input->post("tgo"));
        $this->Enfermedad_model->setdimero_d($this->input->post("dimero_d"));
        $this->Enfermedad_model->setlinfocitos($this->input->post("linfocitos"));
        $this->Enfermedad_model->setcpk($this->input->post("cpk"));
        $this->Enfermedad_model->setplaquetas($this->input->post("plaquetas"));
        $this->Enfermedad_model->setbt($this->input->post("bt"));
        $this->Enfermedad_model->setcpk_mb($this->input->post("cpk_mb"));
        $this->Enfermedad_model->setcreatinina($this->input->post("creatinina"));
        $this->Enfermedad_model->setpcr($this->input->post("pcr"));
        $this->Enfermedad_model->settroponina_t($this->input->post("troponina_t"));
        $this->Enfermedad_model->settroponina_i($this->input->post("troponina_i"));

        $this->Enfermedad_model->setfalla_cardiovascular($this->input->post("falla_cardiovascular") == "on"? "1" : "0");
        $this->Enfermedad_model->setfalla_respiratorio($this->input->post("falla_respiratorio") == "on"? "1" : "0");
        $this->Enfermedad_model->setfalla_renal($this->input->post("falla_renal") == "on"? "1" : "0");
        $this->Enfermedad_model->setfalla_hepatico($this->input->post("falla_hepatico") == "on"? "1" : "0");
        $this->Enfermedad_model->setfalla_neurologico($this->input->post("falla_neurologico") == "on"? "1" : "0");
        $this->Enfermedad_model->setfalla_coagulacion($this->input->post("falla_coagulacion") == "on"? "1" : "0");
        $this->Enfermedad_model->setutilizacion_vmni($this->input->post("utilizacion_vmni") == "on"? "1" : "0");
        $this->Enfermedad_model->setutilizacion_canula($this->input->post("utilizacion_canula") == "on"? "1" : "0");

        $this->Enfermedad_model->setpcr_rt_coronavirus_resultado($this->input->post("pcr_rt_coronavirus_resultado"));
        $this->Enfermedad_model->setpcr_pt_influenza_resultado($this->input->post("pcr_pt_influenza_resultado"));
        $this->Enfermedad_model->setprimer_cultivo_secresion_resultado($this->input->post("primer_cultivo_secresion_resultado"));
        $this->Enfermedad_model->setfilmarray_respiratorio_resultado($this->input->post("filmarray_respiratorio_resultado"));
        $this->Enfermedad_model->sethemocultivo_resultado($this->input->post("hemocultivo_resultado"));
        $this->Enfermedad_model->setdestino($this->input->post("destino"));
        
        $this->Enfermedad_model->setotros_cultivos_resultado($this->input->post("otros_cultivos_resultado"));
               
        $this->Enfermedad_model->setingreso_hospital_pa($this->input->post("ingreso_hospital_pa"));
        $this->Enfermedad_model->setingreso_hospital_pam($this->input->post("ingreso_hospital_pam"));
        $this->Enfermedad_model->setingreso_hospital_fr($this->input->post("ingreso_hospital_fr"));
        $this->Enfermedad_model->setingreso_hospital_fc($this->input->post("ingreso_hospital_fc"));
        $this->Enfermedad_model->setingreso_hospital_t($this->input->post("ingreso_hospital_t"));
        $this->Enfermedad_model->setingreso_hospital_sat02($this->input->post("ingreso_hospital_sat02"));
        $this->Enfermedad_model->setingreso_hospital_fio2($this->input->post("ingreso_hospital_fio2"));
        $this->Enfermedad_model->setingreso_hospital_pa02_fio02($this->input->post("ingreso_hospital_pa02_fio02"));
        $this->Enfermedad_model->setingreso_hospital_glasgow($this->input->post("ingreso_hospital_glasgow"));
        $this->Enfermedad_model->setingreso_uci_pa($this->input->post("ingreso_uci_pa"));
        $this->Enfermedad_model->setingreso_uci_pam($this->input->post("ingreso_uci_pam"));
        $this->Enfermedad_model->setingreso_uci_fr($this->input->post("ingreso_uci_fr"));
        $this->Enfermedad_model->setingreso_uci_fc($this->input->post("ingreso_uci_fc"));
        $this->Enfermedad_model->setingreso_uci_t($this->input->post("ingreso_uci_t"));
        $this->Enfermedad_model->setingreso_uci_sat02($this->input->post("ingreso_uci_sat02"));
        $this->Enfermedad_model->setingreso_uci_fio2($this->input->post("ingreso_uci_fio2"));
        $this->Enfermedad_model->setingreso_uci_pa02_fio02($this->input->post("ingreso_uci_pa02_fio02"));
        $this->Enfermedad_model->setingreso_uci_glasgow($this->input->post("ingreso_uci_glasgow"));

        $this->Enfermedad_model->setutilizacion_vmni_horas($this->input->post("utilizacion_vmni_horas"));
        $this->Enfermedad_model->setutilizacion_canula_horas($this->input->post("utilizacion_canula_horas"));
        $this->Enfermedad_model->setesquema_prona_supina_horas01($this->input->post("esquema_prona_supina_horas01"));
        $this->Enfermedad_model->setesquema_prona_supina_horas02($this->input->post("esquema_prona_supina_horas02"));

        $this->Enfermedad_model->setpcr_rt_coronavirus_fecha(formatearFechaParaBD(explode(" ", $this->input->post("pcr_rt_coronavirus_fecha"))[0]));
        $this->Enfermedad_model->setpcr_pt_influenza_fecha(formatearFechaParaBD(explode(" ", $this->input->post("pcr_pt_influenza_fecha"))[0]));
        $this->Enfermedad_model->setprimer_cultivo_secresion_fecha(formatearFechaParaBD(explode(" ", $this->input->post("primer_cultivo_secresion_fecha"))[0]));
        $this->Enfermedad_model->setfilmarray_respiratorio_fecha(formatearFechaParaBD(explode(" ", $this->input->post("filmarray_respiratorio_fecha"))[0]));
        $this->Enfermedad_model->setprueba_rapida_fecha(formatearFechaParaBD(explode(" ", $this->input->post("prueba_rapida_fecha"))[0]));
        $this->Enfermedad_model->sethemocultivo_fecha(formatearFechaParaBD(explode(" ", $this->input->post("hemocultivo_fecha"))[0]));
        $this->Enfermedad_model->setotros_cultivos_fecha(formatearFechaParaBD(explode(" ", $this->input->post("otros_cultivos_fecha"))[0]));
        $this->Enfermedad_model->setfecha_intubacion(formatearFechaParaBD(explode(" ", $this->input->post("fecha_intubacion"))[0]));
        $this->Enfermedad_model->setfecha_ingreso_vm(formatearFechaParaBD(explode(" ", $this->input->post("fecha_ingreso_vm"))[0]));
        $this->Enfermedad_model->setfecha_primer_dia_prona(formatearFechaParaBD(explode(" ", $this->input->post("fecha_primer_dia_prona"))[0]));
        
        $this->Enfermedad_model->setdx_ards($this->input->post("dx_ards"));

        $this->Enfermedad_model->setuso_titular_peep($this->input->post("uso_titular_peep") == "on"? "1" : "0");
        $this->Enfermedad_model->setpv_tools($this->input->post("pv_tools") == "on"? "1" : "0");
        $this->Enfermedad_model->setopen_lung_tools($this->input->post("open_lung_tools") == "on"? "1" : "0");
        $this->Enfermedad_model->setpeep_in_view($this->input->post("peep_in_view") == "on"? "1" : "0");
        $this->Enfermedad_model->setotras($this->input->post("otras") == "on"? "1" : "0");
        $this->Enfermedad_model->setreclutamiento_alveolar($this->input->post("reclutamiento_alveolar") == "on"? "1" : "0");

        $this->Enfermedad_model->setotras($this->input->post("otras"));
        $this->Enfermedad_model->setpeep_maximo($this->input->post("peep_maximo"));
        $this->Enfermedad_model->setpo2_fio2_prepona($this->input->post("po2_fio2_prepona"));
        $this->Enfermedad_model->setpco2preprona($this->input->post("pco2preprona"));
        $this->Enfermedad_model->setpo2_fio2_prona_4_horas($this->input->post("po2_fio2_prona_4_horas"));
        $this->Enfermedad_model->setpo2_prona_4_horas($this->input->post("po2_prona_4_horas"));
        $this->Enfermedad_model->setpo2_fio2_supino_4_horas($this->input->post("po2_fio2_supino_4_horas"));
        $this->Enfermedad_model->setpco2_supono_4_horas($this->input->post("pco2_supono_4_horas"));

        $this->Enfermedad_model->setfecha_extubacion(formatearFechaParaBD(explode(" ", $this->input->post("fecha_extubacion"))[0]));
        $this->Enfermedad_model->setfecha_traqueostomia(formatearFechaParaBD(explode(" ", $this->input->post("fecha_traqueostomia"))[0]));
        $this->Enfermedad_model->setfecha_egreso_vm(formatearFechaParaBD(explode(" ", $this->input->post("fecha_egreso_vm"))[0]));
        $this->Enfermedad_model->setfecha_alta_uci(formatearFechaParaBD(explode(" ", $this->input->post("fecha_alta_uci"))[0]));
               
        $this->Enfermedad_model->sethidroxicloroquina($this->input->post("hidroxicloroquina") == "on"? "1" : "0");
        $this->Enfermedad_model->setcondicion_vivo($this->input->post("condicion_vivo") == "on"? "1" : "0");
        $this->Enfermedad_model->setcondicion_fallecido($this->input->post("condicion_fallecido") == "on"? "1" : "0");

        $this->Enfermedad_model->setpam($this->input->post("pam"));
        $this->Enfermedad_model->setgc($this->input->post("gc"));
        $this->Enfermedad_model->setic($this->input->post("ic"));
        $this->Enfermedad_model->setpvc($this->input->post("pvc"));
        $this->Enfermedad_model->setccs($this->input->post("ccs"));
        $this->Enfermedad_model->setvpp($this->input->post("vpp"));
        $this->Enfermedad_model->setsat02_venosa_central($this->input->post("sat02_venosa_central"));
        $this->Enfermedad_model->setlactato($this->input->post("lactato"));
        $this->Enfermedad_model->setvasopresor_inotropico($this->input->post("vasopresor_inotropico"));
        $this->Enfermedad_model->sethemodinamia_fevi($this->input->post("hemodinamia_fevi"));
        $this->Enfermedad_model->sethemodinamia_ic($this->input->post("hemodinamia_ic"));
        $this->Enfermedad_model->sethemodinamia_vci($this->input->post("hemodinamia_vci"));
        $this->Enfermedad_model->sethemodinamia_otros_hallazgos($this->input->post("hemodinamia_otros_hallazgos"));
        $this->Enfermedad_model->sethemodinamia_sedacion($this->input->post("hemodinamia_sedacion"));
        $this->Enfermedad_model->sethemodinamia_analgesia($this->input->post("hemodinamia_analgesia"));
        $this->Enfermedad_model->sethemodinamia_relajante($this->input->post("hemodinamia_relajante"));
        $this->Enfermedad_model->sethemodinamia_antibiotico($this->input->post("hemodinamia_antibiotico"));
        $this->Enfermedad_model->sethemodinamia_antiviral($this->input->post("hemodinamia_antiviral"));
        $this->Enfermedad_model->sethidroxicloroquina_dosis($this->input->post("hidroxicloroquina_dosis"));
        $this->Enfermedad_model->setdescripcion_rx_torax($this->input->post("descripcion_rx_torax"));

        $this-> Enfermedad_model->setestado(1);
        $id = $this->input->post("id");

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";
        
        if ($id) {
            if ($this->Enfermedad_model->actualizarPaciente()) {
                    
                    foreach ($listae->result() as $row) :
                        $data = $this->input->post("ex".strval($row->id_examen));
                        
                        $this->Enfermedad_model->setid_examen($row->id_examen);
                        $this->Enfermedad_model->setdia_1($data[0]);
                        $this->Enfermedad_model->setdia_2($data[1]);
                        $this->Enfermedad_model->setdia_3($data[2]);
                        $this->Enfermedad_model->setdia_5($data[3]);
                        $this->Enfermedad_model->setdia_7($data[4]);
                        $this->Enfermedad_model->updateExamenes();
                    endforeach;
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            $id_paciente = $this->Enfermedad_model->guardarPaciente();
            if ($id_paciente > 0) {
                
                    $this->Enfermedad_model->setidpaciente($id_paciente);
                    
                    foreach ($listae->result() as $row) :
                        $data = $this->input->post("ex".strval($row->id_examen));
                        
                        $this->Enfermedad_model->setid_examen($row->id_examen);
                        $this->Enfermedad_model->setdia_1($data[0]);
                        $this->Enfermedad_model->setdia_2($data[1]);
                        $this->Enfermedad_model->setdia_3($data[2]);
                        $this->Enfermedad_model->setdia_5($data[3]);
                        $this->Enfermedad_model->setdia_7($data[4]);
                        $this->Enfermedad_model->guardarExamenes();
                    endforeach;
                    
                $status = 200;
                $message = "Historial registrado exitosamente";
            }
            else 
                {
                    $status = 500;
                    $message = "Error al registrar, vuelva a intentar";
                }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
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

    public function obtenerRenipress()
    {
        $this->load->model("EntidadSalud_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $ubigeo = $departamento . $provincia . $distrito;
        
        $data = array();
        
        if (strlen($ubigeo) > 5) {
            
            $this->EntidadSalud_model->setCodigo_Ubigeo($ubigeo);
            
            $lista = $this->EntidadSalud_model->obtenerRenipress();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                $data[] = array(
                    "id_renipress" => $row->id_renipress,
                    "codigo_institucion" => $row->codigo_institucion,
                    "institucion" => $row->institucion,
                    "codigo_renipress" => $row->codigo_renipress,
                    "nombre" => $row->nombre,
                    "clasificacion" => $row->clasificacion,
                    "tipo" => $row->tipo,
                    "codigo_region" => $row->codigo_region,
                    "region" => $row->region,
                    "codigo_provincia" => $row->codigo_provincia,
                    "provincia" => $row->provincia,
                    "codigo_distrito" => $row->codigo_distrito,
                    "distrito" => $row->distrito,
                    "ubigeo" => $row->ubigeo
                );
                endforeach;
            }
        }
        
        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    public function actualizarEstadoPaciente() {
        $this->load->model("Enfermedad_model");
        $id = $this->input->post("idpaciente");
        $this-> Enfermedad_model->setidpaciente($id);
        $this-> Enfermedad_model->setfechaRegistro(formatearFechaParaBD(explode(" ", $this->input->post("fechaRegistro"))[0]));
        $this-> Enfermedad_model->setpositivo($this->input->post("positivo") == "on"? "1" : "0");
        $this-> Enfermedad_model->setsospechoso($this->input->post("sospechoso") == "on"? "1" : "0");
        $this-> Enfermedad_model->setnegativo($this->input->post("negativo") == "on"? "1" : "0");
        $this-> Enfermedad_model->setfechaMuestra(formatearFechaParaBD(explode(" ", $this->input->post("fechaMuestra"))[0]));
        $this-> Enfermedad_model->setcie10_1_codigo($this->input->post("cie10_1_codigo"));
        $this-> Enfermedad_model->setcie10_1_texto($this->input->post("cie10_1_texto"));
        $this-> Enfermedad_model->setcie10_2_codigo($this->input->post("cie10_2_codigo"));
        $this-> Enfermedad_model->setcie10_2_texto($this->input->post("cie10_2_texto"));
        $this-> Enfermedad_model->setcie10_3_codigo($this->input->post("cie10_3_codigo"));
        $this-> Enfermedad_model->setcie10_3_texto($this->input->post("cie10_3_texto"));
        $this-> Enfermedad_model->setsalaSinOxigeno($this->input->post("salaSinOxigeno") == "on"? "1" : "0");
        $this-> Enfermedad_model->setsalaConOxigeno($this->input->post("salaConOxigeno") == "on"? "1" : "0");
        $this-> Enfermedad_model->setUciSinVentilacion($this->input->post("UciSinVentilacion") == "on"? "1" : "0");
        $this-> Enfermedad_model->setUciConVentilacion($this->input->post("UciConVentilacion") == "on"? "1" : "0");
        $this-> Enfermedad_model->setevolucionFavorable($this->input->post("evolucionFavorable") == "on"? "1" : "0");
        $this-> Enfermedad_model->setEvolucionDesfavorable($this->input->post("EvolucionDesfavorable") == "on"? "1" : "0");
        $this-> Enfermedad_model->setdiasHospitalizacion($this->input->post("diasHospitalizacion"));
        $this-> Enfermedad_model->setdiasUci($this->input->post("diasUci"));
        $this-> Enfermedad_model->setestadoFallecido($this->input->post("estadoFallecido") == "on"? "1" : "0");
        $this-> Enfermedad_model->setestadoAlto($this->input->post("estadoAlto") == "on"? "1" : "0");
        $this-> Enfermedad_model->setestado(0);
        
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($id) {
            if ($this->Enfermedad_model->actualizarEstadoPaciente()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->Enfermedad_model->guardarPaciente()) {
                $status = 200;
                $message = "Historial registrado exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }
    
    public function obtenerHistorialPaciente(){
        $this->load->model("Enfermedad_model");
        $id = $this->input->post("idpaciente");
        $this->Enfermedad_model->setidpaciente($id);
        $historial = $this->Enfermedad_model->obtenerHistorialPaciente();
        if ($historial->num_rows() > 0) {
            $historial = $historial->result();
        } else {
            $historial = array();
        }

        $data = array(
            "lista" => $historial
        );

        echo json_encode($data);
    }

    public function eliminarHistorialPaciente(){
        $this->load->model("Enfermedad_model");
        $id = $this->input->post("idpaciente");
        $idHistorial = $this->input->post("idhistorial");
        $this->Enfermedad_model->setidpaciente($id);
        $this->Enfermedad_model->setidhistorial($idHistorial);
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idHistorial) {
            if ($this->Enfermedad_model->eliminarHistorialPaciente()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } 
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        echo json_encode($data);
    }

    public function eliminarPaciente(){
        $this->load->model("Enfermedad_model");
        $id = $this->input->post("idpaciente");
        $this->Enfermedad_model->setidpaciente($id);
        $status = 500;
        $message = "Error al actualizar, vuelva a intentar";

        if ($id) {
            if ($this->Enfermedad_model->eliminarPaciente_New()) {
                $status = 200;
                $message = "Información de Paciente actualizado exitosamente";
            }
        } 
        
        $data = array(
            "status" => $status,
            "message" => $message
        );
        echo json_encode($data);
    }
}
