<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Paciente extends CI_Controller
{
    private $permisos = null;

    function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");

        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");

        $this->session->set_userdata("idmodulo", 8);

        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");

        if(sha1($usuario)==$token->usuario){

            if (count($token->modulos)>0) {

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

            if($this->permisos==null){ if($this->session->userdata("menu")) $this->permisos = $this->session->userdata("menu");}

        }else{
            redirect("login");
        }
    }
	
	public function index(){
	    
		$this->load->model("Paciente_model");
		$this->load->model("AlertaPronostico_model");
	    
	    $id = $this->input->post("id");
	    $this->Paciente_model->setemergencias_registro_id($id);
		$listar = $this->Paciente_model->listar();
		$listaralerta = $this->AlertaPronostico_model->listaralerta();

	    $data = array(
	        "id" => $id,
			"listar" => $listar,
			"listaralerta" => $listaralerta
	    );
		$this->load->view("emergencias/paciente", $data);
	}
	
	public function registrar() {
		$this->load->model("AlertaPronostico_model");
		
	    $id = $this->input->post("id");
		$listaralerta = $this->AlertaPronostico_model->listaralerta();
		
	    $data = array(
			"emergencias_registro_id" => $id,
			"listaralerta" => $listaralerta
	    );
	    
	    $this->load->view("emergencias/registrar", $data);
	}
	
	public function registrarAjax() {
	    
	    $this->load->model("Paciente_model");
	    
	    $id_paciente = $this->input->post("id");
	    $emergencias_registro_id = $this->input->post("emergencias_registro_id");
	    $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
	    $Documento_Numero = $this->input->post("Documento_Numero");
	    $apellidos = $this->input->post("apellidos");
	    $nombres = $this->input->post("nombres");
	    $edad = $this->input->post("edad");
	    $sexo = $this->input->post("sexo");
	    $gestante = ($this->input->post("gestante"))?1:0;
	    $peso = $this->input->post("peso");
	    $talla = $this->input->post("talla");
	    $fecha_inicio_sintomas = $this->input->post("fecha_inicio_sintomas");
	    $fecha_ingreso_hospital = $this->input->post("fecha_ingreso_hospital");
	    $fecha_ingreso_uci = $this->input->post("fecha_ingreso_uci");
	    $DM = ($this->input->post("DM"))?1:0;
	    $HTA = ($this->input->post("HTA"))?1:0;
	    $ERC = ($this->input->post("ERC"))?1:0;
	    $VIH = ($this->input->post("VIH"))?1:0;
	    $LES = ($this->input->post("LES"))?1:0;
	    $asma = ($this->input->post("asma"))?1:0;
	    $TBC = ($this->input->post("TBC"))?1:0;
	    $NM = ($this->input->post("NM"))?1:0;
	    $otros = $this->input->post("otros");
	    $EDAs = ($this->input->post("EDAs"))?1:0;
	    $EDAs_dias = $this->input->post("EDAs_dias");
	    $resfrio = ($this->input->post("resfrio"))?1:0;
	    $resfrio_dias = $this->input->post("resfrio_dias");
	    $vacunas = ($this->input->post("vacunas"))?1:0;
	    $vacunas_nombres = $this->input->post("vacunas_nombres");
	    $emergencia_horas = $this->input->post("emergencia_horas");
	    $emergencia_dias = $this->input->post("emergencia_dias");
	    $VMI = $this->input->post("VMI");
	    $VMI_horas = $this->input->post("VMI_horas");
	    $VMI_dias = $this->input->post("VMI_dias");
	    $dolor_articular = ($this->input->post("dolor_articular"))?1:0;
	    $dismunicion_fuerza_superior = ($this->input->post("dismunicion_fuerza_superior"))?1:0;
	    $dismunicion_fuerza_inferior = ($this->input->post("dismunicion_fuerza_inferior"))?1:0;
	    $dificultad_respiratoria = ($this->input->post("dificultad_respiratoria"))?1:0;
	    $dolor_extremidades = ($this->input->post("dolor_extremidades"))?1:0;
	    $dificultad_marcha = ($this->input->post("dificultad_marcha"))?1:0;
	    $cuadriplejia = ($this->input->post("cuadriplejia"))?1:0;
	    $escala_hughes = $this->input->post("escala_hughes");
	    $escala_glasgow = $this->input->post("escala_glasgow");
	    $uci_habitual = ($this->input->post("uci_habitual"))?1:0;
	    $uci_habitual_cama = $this->input->post("uci_habitual_cama");
	    $uci_contingencia = ($this->input->post("uci_contingencia"))?1:0;
	    $uci_contingencia_cama = $this->input->post("uci_contingencia_cama");
	    $PAS = $this->input->post("PAS");
	    $PAD = $this->input->post("PAD");
	    $FC = $this->input->post("FC");
	    $FR = $this->input->post("FR");
	    $SO2 = $this->input->post("SO2");
	    $FIO2 = $this->input->post("FIO2");
	    $T = $this->input->post("T");
	    $vasopresores_inotropicos = ($this->input->post("vasopresores_inotropicos"))?1:0;
	    $vasopresores_inotropicos_tipo = $this->input->post("vasopresores_inotropicos_tipo");
	    $ROT = $this->input->post("ROT");
	    $fuerza_muscular = $this->input->post("fuerza_muscular");
	    $glasgow = $this->input->post("glasgow");
	    $electromiografia = ($this->input->post("electromiografia"))?1:0;
	    $electromiografia_fecha = $this->input->post("electromiografia_fecha");
	    $electromiografia_conclusion_1 = $this->input->post("electromiografia_conclusion_1");
	    $electromiografia_conclusion_2 = $this->input->post("electromiografia_conclusion_2");
	    $electromiografia_velocidad = $this->input->post("electromiografia_velocidad");
	    $puncion_lumbar = ($this->input->post("puncion_lumbar"))?1:0;
	    $puncion_lumbar_fecha = $this->input->post("puncion_lumbar_fecha");
	    $puncion_lumbar_envio = ($this->input->post("puncion_lumbar_envio"))?1:0;
	    $tipificacion_viral = ($this->input->post("tipificacion_viral"))?1:0;
	    $tipificacion_viral_fecha = $this->input->post("tipificacion_viral_fecha");
	    $tipificacion_viral_envio = ($this->input->post("tipificacion_viral_envio"))?1:0;
	    $tipificacion_bacteriana = ($this->input->post("tipificacion_bacteriana"))?1:0;
	    $tipificacion_bacteriana_fecha = $this->input->post("tipificacion_bacteriana_fecha");
	    $tipificacion_bacteriana_envio = ($this->input->post("tipificacion_bacteriana_envio"))?1:0;
	    $isopado_orofaringia = ($this->input->post("isopado_orofaringia"))?1:0;
	    $isopado_orofaringia_fecha = $this->input->post("isopado_orofaringia_fecha");
	    $isopado_orofaringia_envio = ($this->input->post("isopado_orofaringia_envio"))?1:0;
	    $examen_heces = ($this->input->post("examen_heces"))?1:0;
	    $examen_heces_fecha = $this->input->post("examen_heces_fecha");
	    $examen_heces_envio = ($this->input->post("examen_heces_envio"))?1:0;
	    $Na = $this->input->post("Na");
	    $K = $this->input->post("K");
	    $Cl = $this->input->post("Cl");
	    $P = $this->input->post("P");
	    $Ca = $this->input->post("Ca");
	    $cie10_1 = $this->input->post("cie10_1");
	    $cie10_1_presuntivo = ($this->input->post("cie10_1_presuntivo"))?1:0;
	    $cie10_1_definitivo = ($this->input->post("cie10_1_definitivo"))?1:0;
	    $cie10_2 = $this->input->post("cie10_2");
	    $cie10_2_presuntivo = ($this->input->post("cie10_2_presuntivo"))?1:0;
	    $cie10_2_definitivo = ($this->input->post("cie10_2_definitivo"))?1:0;
	    $cie10_3 = $this->input->post("cie10_3");
	    $cie10_3_presuntivo = ($this->input->post("cie10_3_presuntivo"))?1:0;
	    $cie10_3_definitivo = ($this->input->post("cie10_3_definitivo"))?1:0;
	    $inmunoglobulina = ($this->input->post("inmunoglobulina"))?1:0;
	    $inmunoglobulina_frascos = $this->input->post("inmunoglobulina_frascos");
	    $inmunoglobulina_dias = $this->input->post("inmunoglobulina_dias");
	    $inmunoglobulina_reacciones = $this->input->post("inmunoglobulina_reacciones");
	    $plasmaferesis_albumina = ($this->input->post("plasmaferesis_albumina"))?1:0;
	    $plasmaferesis_albumina_frascos = $this->input->post("plasmaferesis_albumina_frascos");
	    $plasmaferesis_albumina_dias = $this->input->post("plasmaferesis_albumina_dias");
	    $plasmaferesis_albumina_reacciones = $this->input->post("plasmaferesis_albumina_reacciones");
	    $plasmaferesis_PFC = $this->input->post("plasmaferesis_PFC");
	    $plasmaferesis_PFC_frascos = $this->input->post("plasmaferesis_PFC_frascos");
	    $plasmaferesis_PFC_dias = $this->input->post("plasmaferesis_PFC_dias");
	    $plasmaferesis_PFC_reacciones = $this->input->post("plasmaferesis_PFC_reacciones");
	    $Apache_II = $this->input->post("Apache_II");
	    $SOFA = $this->input->post("SOFA");
	    $fecha_caf = $this->input->post("fecha_caf");
	    $fecha_intubacion = $this->input->post("fecha_intubacion");
	    $dias_uci = $this->input->post("dias_uci");
	    $dias_VMI = $this->input->post("dias_VMI");
	    $modo_ventilatorio = $this->input->post("modo_ventilatorio");
	    $modo_ventilatorio_fecha = $this->input->post("modo_ventilatorio_fecha");
	    $destete_horas = $this->input->post("destete_horas");
	    $destete_dias = $this->input->post("destete_dias");
	    $traqueostomia = ($this->input->post("traqueostomia"))?1:0;
	    $traqueostomia_fecha = $this->input->post("traqueostomia_fecha");
	    $fecha_extubacion = $this->input->post("fecha_extubacion");
	    $destino_alta_uci = $this->input->post("destino_alta_uci");
	    $condicion_paciente = $this->input->post("condicion_paciente");
	    	    
	    $fecha_inicio_sintomas = (strlen($fecha_inicio_sintomas) > 0)?formatearFechaParaBD($fecha_inicio_sintomas):'';
	    $fecha_ingreso_hospital = (strlen($fecha_ingreso_hospital) > 0)?formatearFechaParaBD($fecha_ingreso_hospital):'';
	    $fecha_ingreso_uci = (strlen($fecha_ingreso_uci) > 0)?formatearFechaParaBD($fecha_ingreso_uci):'';
	    $electromiografia_fecha = (strlen($electromiografia_fecha) > 0)?formatearFechaParaBD($electromiografia_fecha):'';
	    $puncion_lumbar_fecha = (strlen($puncion_lumbar_fecha) > 0)?formatearFechaParaBD($puncion_lumbar_fecha):'';
	    $tipificacion_viral_fecha = (strlen($tipificacion_viral_fecha) > 0)?formatearFechaParaBD($tipificacion_viral_fecha):'';
	    $tipificacion_bacteriana_fecha = (strlen($tipificacion_bacteriana_fecha) > 0)?formatearFechaParaBD($tipificacion_bacteriana_fecha):'';
	    $isopado_orofaringia_fecha = (strlen($isopado_orofaringia_fecha) > 0)?formatearFechaParaBD($isopado_orofaringia_fecha):'';
	    $examen_heces_fecha = (strlen($examen_heces_fecha) > 0)?formatearFechaParaBD($examen_heces_fecha):'';
	    $fecha_intubacion = (strlen($fecha_intubacion) > 0)?formatearFechaParaBD($fecha_intubacion):'';
	    $fecha_caf = (strlen($fecha_caf) > 0)?formatearFechaParaBD($fecha_caf):'';
	    $traqueostomia_fecha = (strlen($traqueostomia_fecha) > 0)?formatearFechaParaBD($traqueostomia_fecha):'';
	    $fecha_extubacion = (strlen($fecha_extubacion) > 0)?formatearFechaParaBD($fecha_extubacion):'';
	    $modo_ventilatorio_fecha = (strlen($modo_ventilatorio_fecha) > 0)?formatearFechaParaBD($modo_ventilatorio_fecha):''; 
	    
	    $this->Paciente_model->setemergencias_registro_id($emergencias_registro_id);
	    $this->Paciente_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
	    $this->Paciente_model->setDocumento_Numero($Documento_Numero);
	    $this->Paciente_model->setapellidos($apellidos);
	    $this->Paciente_model->setnombres($nombres);
	    $this->Paciente_model->setedad($edad);
	    $this->Paciente_model->setsexo($sexo);
	    $this->Paciente_model->setgestante($gestante);
	    $this->Paciente_model->setpeso($peso);
	    $this->Paciente_model->settalla($talla);
	    $this->Paciente_model->setfecha_inicio_sintomas($fecha_inicio_sintomas);
	    $this->Paciente_model->setfecha_ingreso_hospital($fecha_ingreso_hospital);
	    $this->Paciente_model->setfecha_ingreso_uci($fecha_ingreso_uci);
	    $this->Paciente_model->setDM($DM);
	    $this->Paciente_model->setHTA($HTA);
	    $this->Paciente_model->setERC($ERC);
	    $this->Paciente_model->setVIH($VIH);
	    $this->Paciente_model->setLES($LES);
	    $this->Paciente_model->setasma($asma);
	    $this->Paciente_model->setTBC($TBC);
	    $this->Paciente_model->setNM($NM);
	    $this->Paciente_model->setotros($otros);
	    $this->Paciente_model->setEDAs($EDAs);
	    $this->Paciente_model->setEDAs_dias($EDAs_dias);
	    $this->Paciente_model->setresfrio($resfrio);
	    $this->Paciente_model->setresfrio_dias($resfrio_dias);
	    $this->Paciente_model->setvacunas($vacunas);
	    $this->Paciente_model->setvacunas_nombres($vacunas_nombres);
	    $this->Paciente_model->setemergencia_horas($emergencia_horas);
	    $this->Paciente_model->setemergencia_dias($emergencia_dias);
	    $this->Paciente_model->setVMI($VMI);
	    $this->Paciente_model->setVMI_horas($VMI_horas);
	    $this->Paciente_model->setVMI_dias($VMI_dias);
	    $this->Paciente_model->setdolor_articular($dolor_articular);
	    $this->Paciente_model->setdismunicion_fuerza_superior($dismunicion_fuerza_superior);
	    $this->Paciente_model->setdismunicion_fuerza_inferior($dismunicion_fuerza_inferior);
	    $this->Paciente_model->setdificultad_respiratoria($dificultad_respiratoria);
	    $this->Paciente_model->setdolor_extremidades($dolor_extremidades);
	    $this->Paciente_model->setdificultad_marcha($dificultad_marcha);
	    $this->Paciente_model->setcuadriplejia($cuadriplejia);
	    $this->Paciente_model->setescala_hughes($escala_hughes);
	    $this->Paciente_model->setescala_glasgow($escala_glasgow);
	    $this->Paciente_model->setuci_habitual($uci_habitual);
	    $this->Paciente_model->setuci_habitual_cama($uci_habitual_cama);
	    $this->Paciente_model->setuci_contingencia($uci_contingencia);
	    $this->Paciente_model->setuci_contingencia_cama($uci_contingencia_cama);
	    $this->Paciente_model->setPAS($PAS);
	    $this->Paciente_model->setPAD($PAD);
	    $this->Paciente_model->setFC($FC);
	    $this->Paciente_model->setFR($FR);
	    $this->Paciente_model->setSO2($SO2);
	    $this->Paciente_model->setFIO2($FIO2);
	    $this->Paciente_model->setT($T);
	    $this->Paciente_model->setvasopresores_inotropicos($vasopresores_inotropicos);
	    $this->Paciente_model->setvasopresores_inotropicos_tipo($vasopresores_inotropicos_tipo);
	    $this->Paciente_model->setROT($ROT);
	    $this->Paciente_model->setfuerza_muscular($fuerza_muscular);
	    $this->Paciente_model->setglasgow($glasgow);
	    $this->Paciente_model->setelectromiografia($electromiografia);
	    $this->Paciente_model->setelectromiografia_fecha($electromiografia_fecha);
	    $this->Paciente_model->setelectromiografia_conclusion_1($electromiografia_conclusion_1);
	    $this->Paciente_model->setelectromiografia_conclusion_2($electromiografia_conclusion_2);
	    $this->Paciente_model->setelectromiografia_velocidad($electromiografia_velocidad);
	    $this->Paciente_model->setpuncion_lumbar($puncion_lumbar);
	    $this->Paciente_model->setpuncion_lumbar_fecha($puncion_lumbar_fecha);
	    $this->Paciente_model->setpuncion_lumbar_envio($puncion_lumbar_envio);
	    $this->Paciente_model->settipificacion_viral($tipificacion_viral);
	    $this->Paciente_model->settipificacion_viral_fecha($tipificacion_viral_fecha);
	    $this->Paciente_model->settipificacion_viral_envio($tipificacion_viral_envio);
	    $this->Paciente_model->settipificacion_bacteriana($tipificacion_bacteriana);
	    $this->Paciente_model->settipificacion_bacteriana_fecha($tipificacion_bacteriana_fecha);
	    $this->Paciente_model->settipificacion_bacteriana_envio($tipificacion_bacteriana_envio);
	    $this->Paciente_model->setisopado_orofaringia($isopado_orofaringia);
	    $this->Paciente_model->setisopado_orofaringia_fecha($isopado_orofaringia_fecha);
	    $this->Paciente_model->setisopado_orofaringia_envio($isopado_orofaringia_envio);
	    $this->Paciente_model->setexamen_heces($examen_heces);
	    $this->Paciente_model->setexamen_heces_fecha($examen_heces_fecha);
	    $this->Paciente_model->setexamen_heces_envio($examen_heces_envio);
	    $this->Paciente_model->setNa($Na);
	    $this->Paciente_model->setK($K);
	    $this->Paciente_model->setCl($Cl);
	    $this->Paciente_model->setP($P);
	    $this->Paciente_model->setCa($Ca);
	    $this->Paciente_model->setcie10_1($cie10_1);
	    $this->Paciente_model->setcie10_1_presuntivo($cie10_1_presuntivo);
	    $this->Paciente_model->setcie10_1_definitivo($cie10_1_definitivo);
	    $this->Paciente_model->setcie10_2($cie10_2);
	    $this->Paciente_model->setcie10_2_presuntivo($cie10_2_presuntivo);
	    $this->Paciente_model->setcie10_2_definitivo($cie10_2_definitivo);
	    $this->Paciente_model->setcie10_3($cie10_3);
	    $this->Paciente_model->setcie10_3_presuntivo($cie10_3_presuntivo);
	    $this->Paciente_model->setcie10_3_definitivo($cie10_3_definitivo);
	    $this->Paciente_model->setinmunoglobulina($inmunoglobulina);
	    $this->Paciente_model->setinmunoglobulina_frascos($inmunoglobulina_frascos);
	    $this->Paciente_model->setinmunoglobulina_dias($inmunoglobulina_dias);
	    $this->Paciente_model->setinmunoglobulina_reacciones($inmunoglobulina_reacciones);
	    $this->Paciente_model->setplasmaferesis_albumina($plasmaferesis_albumina);
	    $this->Paciente_model->setplasmaferesis_albumina_frascos($plasmaferesis_albumina_frascos);
	    $this->Paciente_model->setplasmaferesis_albumina_dias($plasmaferesis_albumina_dias);
	    $this->Paciente_model->setplasmaferesis_albumina_reacciones($plasmaferesis_albumina_reacciones);
	    $this->Paciente_model->setplasmaferesis_PFC($plasmaferesis_PFC);
	    $this->Paciente_model->setplasmaferesis_PFC_frascos($plasmaferesis_PFC_frascos);
	    $this->Paciente_model->setplasmaferesis_PFC_dias($plasmaferesis_PFC_dias);
	    $this->Paciente_model->setplasmaferesis_PFC_reacciones($plasmaferesis_PFC_reacciones);
	    $this->Paciente_model->setApache_II($Apache_II);
	    $this->Paciente_model->setSOFA($SOFA);
	    $this->Paciente_model->setfecha_caf($fecha_caf);
	    $this->Paciente_model->setfecha_intubacion($fecha_intubacion);
	    $this->Paciente_model->setdias_uci($dias_uci);
	    $this->Paciente_model->setdias_VMI($dias_VMI);
	    $this->Paciente_model->setmodo_ventilatorio($modo_ventilatorio);
	    $this->Paciente_model->setmodo_ventilatorio_fecha($modo_ventilatorio_fecha);
	    $this->Paciente_model->setdestete_horas($destete_horas);
	    $this->Paciente_model->setdestete_dias($destete_dias);
	    $this->Paciente_model->settraqueostomia($traqueostomia);
	    $this->Paciente_model->settraqueostomia_fecha($traqueostomia_fecha);
	    $this->Paciente_model->setfecha_extubacion($fecha_extubacion);
	    $this->Paciente_model->setdestino_alta_uci($destino_alta_uci);
	    $this->Paciente_model->setcondicion_paciente($condicion_paciente);
	    
	    if (strlen($Documento_Numero) < 1 or strlen($emergencias_registro_id) < 1) {
	        $data = array(
	            "status" => 500
	        );
	    } else {
	        
	        if ($id_paciente > 0) {
	            $this->Paciente_model->setId($id_paciente);
	            
	            if ($this->Paciente_model->actualizar()) {
	                $data = array(
	                    "status" => 200
	                );
	                
	            } else {
	                $data = array(
	                    "status" => 500
	                );
	            }
	        } else {
	            
	            $count = $this->Paciente_model->buscar();
	            
	            if ($count->num_rows() > 0) {
	                $data = array(
	                    "status" => 201
	                );
	            }
	            else {
	                
	                $id = $this->Paciente_model->registrar();
	                if ($id > 0) {
	                    $data = array(
	                        "status" => 200
	                    );
	                    
	                } else {
	                    $data = array(
	                        "status" => 500
	                    );
	                }
	                
	            }
	        }	

	    }
	    
	    echo json_encode($data);
    }
	
	public function editar() {
	    
		$this->load->model("Paciente_model");
		$this->load->model("AlertaPronostico_model");
	    $id_emergencias_registro_id = $this->input->post("id_emergencias_registro_id");
	    $id = $this->input->post("ID");
	    $this->Paciente_model->setemergencias_registro_id($id_emergencias_registro_id);
	    $this->Paciente_model->setId($id);
		$paciente = $this->Paciente_model->paciente();
		$listaralerta = $this->AlertaPronostico_model->listaralerta();

	    $data = array(
	        "emergencias_registro_id" => $id_emergencias_registro_id,
			"paciente" => $paciente->row(),
			"listaralerta" => $listaralerta
	    );
	    
	    $this->load->view("emergencias/editar", $data);
	    
	}
	
	public function eliminar() {
	    
	    $this->load->model("Paciente_model");
	    
	    $id = $this->input->post("id");
	    $this->Paciente_model->setId($id);
	    
	    if ($this->Paciente_model->eliminar() == 1){
	        echo json_encode(array("status"=>"200"));
	        
	    } else {
	        echo json_encode(array("status"=>"500"));
	    }
	}
	
	public function curl() {
	    
	    $tipo_documento = $this->input->post("type");
	    $documento = $this->input->post("document");
	    $handler = curl_init();
	    curl_setopt($handler, CURLOPT_URL, getenv("API_RENIEC_URL").$tipo_documento."/".$documento."/");
	    curl_setopt($handler, CURLOPT_HEADER, FALSE);
	    curl_setopt($handler, CURLOPT_HTTPHEADER,array("Authorization: ".getenv("API_RENIEC_TOKEN"),"Content-Type: application/json"));
	    curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
	    $data = curl_exec($handler);
	    $code = curl_getinfo ($handler, CURLINFO_HTTP_CODE);
	    
	    curl_close($handler);
	    
	    echo $data;
	    
	}
}