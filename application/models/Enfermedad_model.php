<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Enfermedad_model extends CI_Model
{
    private $idrenipress;
    private $tipoDocumento;
    private $numeroDocumento;
    private $apellido;
    private $nombre;
    private $sexo;
    private $gestante;
    private $fechaNacimiento;
    private $edad;
    private $domicilio;
    private $numero_historia;
    private $ingreso_hospital;
    private $ingreso_uci;
    private $idpais;
    private $ubigeo;
    private $telefono;
    private $talla;
    private $peso_ideal_vm;
    private $peso_actual;
    private $imc;
    private $apache;
    private $sofa;
    private $tiempo_emfermedad;
    private $idpaciente;
    private $id_examen;
    private $dia_1;
    private $dia_2;
    private $dia_3;
    private $dia_5;
    private $dia_7;
    private $estadoFallecido;
    private $estadoAlto;
    private $idhistorial;
    private $estado;
    private $hta;
    private $otras_enf_pulmonares;
    private $cancer;
    private $diabetes_mellitus;
    private $asma;
    private $acv_previo;
    private $epoc_bronquiectasias;
    private $falla_cardiaca;
    private $fumador_cronico;
    private $epid_fibrosis_pulmonar;
    private $enf_renal_cronica;
    private $vih;
    private $viajes_pervios;
    private $procedencia_viajes;
    private $contacto_personas_covid;
    private $contacto_extranjeros;
    private $procedencia_extranjeros;
    private $personal_salud;
    private $rinorrea;
    private $tos_con_flema;
    private $disnea;
    private $disnea_dias;
    private $fiebre;
    private $fiebre_t_max;
    private $fatiga;
    private $escalofrios;
    private $cefalea;
    private $hemoptisis;
    private $diarrea;
    private $tos_seca;
    private $mialgia_artralgia;
    private $dolor_de_garganta;
    private $hb;
    private $ldh;
    private $procalcitonina;
    private $leucocitos;
    private $tgo;
    private $dimero_d;
    private $linfocitos;
    private $cpk;
    private $plaquetas;
    private $bt;
    private $cpk_mb;
    private $creatinina;
    private $pcr;
    private $troponina_t;
    private $troponina_i;
    private $pcr_rt_coronavirus;
    private $pcr_rt_coronavirus_fecha;
    private $pcr_rt_coronavirus_resultado;
    private $pcr_pt_influenza;
    private $pcr_pt_influenza_fecha;
    private $pcr_pt_influenza_resultado;
    private $primer_cultivo_secresion;
    private $primer_cultivo_secresion_fecha;
    private $primer_cultivo_secresion_resultado;
    private $filmarray_respiratorio;
    private $filmarray_respiratorio_fecha;
    private $filmarray_respiratorio_resultado;
    private $prueba_rapida;
    private $prueba_rapida_fecha;
    private $prueba_rapida_igg;
    private $prueba_rapida_igm;
    private $perdida_gusto;
    private $perdida_olfato;
    private $hemocultivo;
    private $hemocultivo_fecha;
    private $hemocultivo_resultado;
    private $destino;
    private $otros_cultivos;
    private $otros_cultivos_fecha;
    private $otros_cultivos_resultado;
    private $ingreso_hospital_pa;
    private $ingreso_hospital_pam;
    private $ingreso_hospital_fr;
    private $ingreso_hospital_fc;
    private $ingreso_hospital_t;
    private $ingreso_hospital_sat02;
    private $ingreso_hospital_fio2;
    private $ingreso_hospital_pa02_fio02;
    private $ingreso_hospital_glasgow;
    private $ingreso_uci_pa;
    private $ingreso_uci_pam;
    private $ingreso_uci_fr;
    private $ingreso_uci_fc;
    private $ingreso_uci_t;
    private $ingreso_uci_sat02;
    private $ingreso_uci_fio2;
    private $ingreso_uci_pa02_fio02;
    private $ingreso_uci_glasgow;
    private $falla_cardiovascular;
    private $falla_respiratorio;
    private $falla_renal;
    private $falla_hepatico;
    private $falla_neurologico;
    private $falla_coagulacion;
    private $utilizacion_vmni;
    private $utilizacion_vmni_horas;
    private $utilizacion_canula;
    private $utilizacion_canula_horas;
    private $fecha_intubacion;
    private $fecha_ingreso_vm;
    private $fecha_primer_dia_prona;
    private $dx_ards;
    private $esquema_prona_supina_horas01;
    private $esquema_prona_supina_horas02;
    private $uso_titular_peep;
    private $pv_tools;
    private $open_lung_tools;
    private $peep_in_view;
    private $otras;
    private $reclutamiento_alveolar;
    private $peep_maximo;
    private $po2_fio2_prepona;
    private $pco2preprona;
    private $po2_fio2_prona_4_horas;
    private $po2_prona_4_horas;
    private $po2_fio2_supino_4_horas;
    private $pco2_supono_4_horas;
    private $pam;
    private $gc;
    private $ic;
    private $pvc;
    private $ccs;
    private $vpp;
    private $sat02_venosa_central;
    private $lactato;
    private $vasopresor_inotropico;
    private $hemodinamia_fevi;
    private $hemodinamia_ic;
    private $hemodinamia_vci;
    private $hemodinamia_otros_hallazgos;
    private $hemodinamia_sedacion;
    private $hemodinamia_analgesia;
    private $hemodinamia_relajante;
    private $hemodinamia_antibiotico;
    private $hemodinamia_antiviral;
    private $hidroxicloroquina;
    private $hidroxicloroquina_dosis;
    private $descripcion_rx_torax;
    private $fecha_extubacion;
    private $fecha_traqueostomia;
    private $fecha_egreso_vm;
    private $fecha_alta_uci;
    private $condicion_vivo;
    private $condicion_fallecido;
    public function setidpaciente($data){
        $this->idpaciente = $this->db->escape_str($data);
    }
    public function setidHistorial($data){
        $this->idhistorial = $this->db->escape_str($data);
    }
    public function setfechaRegistro($data){
        $this->fechaRegistro = $this->db->escape_str($data);
    }
    public function setpositivo($data){
        $this->positivo = $this->db->escape_str($data);
    }
    public function setsospechoso($data){
        $this->sospechoso = $this->db->escape_str($data);
    }
    public function setnegativo($data){
        $this->negativo = $this->db->escape_str($data);
    }
    public function setfechaMuestra($data){
        $this->fechaMuestra = $this->db->escape_str($data);
    }
    public function setcie10_1_codigo($data){
        $this->cie10_1_codigo = $this->db->escape_str($data);
    }
    public function setcie10_1_texto($data){
        $this->cie10_1_texto = $this->db->escape_str($data);
    }
    public function setcie10_2_codigo($data){
        $this->cie10_2_codigo = $this->db->escape_str($data);
    }
    public function setcie10_2_texto($data){
        $this->cie10_2_texto = $this->db->escape_str($data);
    }
    public function setcie10_3_codigo($data){
        $this->cie10_3_codigo = $this->db->escape_str($data);
    }
    public function setcie10_3_texto($data){
        $this->cie10_3_texto = $this->db->escape_str($data);
    }
    public function setsalaSinOxigeno($data){
        $this->salaSinOxigeno = $this->db->escape_str($data);
    }
    public function setsalaConOxigeno($data){
        $this->salaConOxigeno = $this->db->escape_str($data);
    }
    public function setUciSinVentilacion($data){
        $this->UciSinVentilacion = $this->db->escape_str($data);
    }
    public function setUciConVentilacion($data){
        $this->UciConVentilacion = $this->db->escape_str($data);
    }
    public function setevolucionFavorable($data){
        $this->evolucionFavorable = $this->db->escape_str($data);
    }
    public function setEvolucionDesfavorable($data){
        $this->EvolucionDesfavorable = $this->db->escape_str($data);
    }
    public function setdiasHospitalizacion($data){
        $this->diasHospitalizacion = $this->db->escape_str($data);
    }
    public function setdiasUci($data){
        $this->diasUci = $this->db->escape_str($data);
    }
    public function setestadoFallecido($data){
        $this->estadoFallecido = $this->db->escape_str($data);
    }
    public function setestadoAlto($data){
        $this->estadoAlto = $this->db->escape_str($data);
    }
    public function setidrenipress($data){
        $this->idrenipress = $this->db->escape_str($data);
    }
    public function settipoDocumento($data){
        $this->tipoDocumento = $this->db->escape_str($data);
    }
    public function setnumeroDocumento($data){
        $this->numeroDocumento = $this->db->escape_str($data);
    }
    public function setapellido($data){
        $this->apellido = $this->db->escape_str($data);
    }
    public function setnombre($data){
        $this->nombre = $this->db->escape_str($data);
    }
    public function setsexo($data){
        $this->sexo = $this->db->escape_str($data);
    }
    public function setgestante($data){
        $this->gestante = $this->db->escape_str($data);
    }
    public function setfechaNacimiento($data){
        $this->fechaNacimiento = $this->db->escape_str($data);
    }
    public function setedad($data){
        $this->edad = $this->db->escape_str($data);
    }
    public function setdomicilio($data){
        $this->domicilio = $this->db->escape_str($data);
    }
    public function setnumero_historia($data){ $this->numero_historia= $this->db->escape_str($data); }
    public function setingreso_hospital($data){ $this->ingreso_hospital= $this->db->escape_str($data); }
    public function setingreso_uci($data){ $this->ingreso_uci= $this->db->escape_str($data); }
    public function setidpais($data){ $this->idpais= $this->db->escape_str($data); }
    public function setubigeo($data){ $this->ubigeo= $this->db->escape_str($data); }
    public function settelefono($data){ $this->telefono= $this->db->escape_str($data); }
    public function settalla($data){ $this->talla= $this->db->escape_str($data); }
    public function setpeso_ideal_vm($data){ $this->peso_ideal_vm= $this->db->escape_str($data); }
    public function setpeso_actual($data){ $this->peso_actual= $this->db->escape_str($data); }
    public function setimc($data){ $this->imc= $this->db->escape_str($data); }
    public function setapache($data){ $this->apache= $this->db->escape_str($data); }
    public function setsofa($data){ $this->sofa= $this->db->escape_str($data); }
    public function settiempo_emfermedad($data){ $this->tiempo_emfermedad= $this->db->escape_str($data); }
    public function sethta($data){ $this->hta= $this->db->escape_str($data); }
    public function setotras_enf_pulmonares($data){ $this->otras_enf_pulmonares= $this->db->escape_str($data); }
    public function setcancer($data){ $this->cancer= $this->db->escape_str($data); }
    public function setdiabetes_mellitus($data){ $this->diabetes_mellitus= $this->db->escape_str($data); }
    public function setasma($data){ $this->asma= $this->db->escape_str($data); }
    public function setacv_previo($data){ $this->acv_previo= $this->db->escape_str($data); }
    public function setepoc_bronquiectasias($data){ $this->epoc_bronquiectasias= $this->db->escape_str($data); }
    public function setfalla_cardiaca($data){ $this->falla_cardiaca= $this->db->escape_str($data); }
    public function setfumador_cronico($data){ $this->fumador_cronico= $this->db->escape_str($data); }
    public function setepid_fibrosis_pulmonar($data){ $this->epid_fibrosis_pulmonar= $this->db->escape_str($data); }
    public function setenf_renal_cronica($data){ $this->enf_renal_cronica= $this->db->escape_str($data); }
    public function setvih($data){ $this->vih= $this->db->escape_str($data); }
    public function setviajes_pervios($data){ $this->viajes_pervios= $this->db->escape_str($data); }
    public function setprocedencia_viajes($data){ $this->procedencia_viajes= $this->db->escape_str($data); }
    public function setcontacto_personas_covid($data){ $this->contacto_personas_covid= $this->db->escape_str($data); }
    public function setcontacto_extranjeros($data){ $this->contacto_extranjeros= $this->db->escape_str($data); }
    public function setprocedencia_extranjeros($data){ $this->procedencia_extranjeros= $this->db->escape_str($data); }
    public function setpersonal_salud($data){ $this->personal_salud= $this->db->escape_str($data); }
    public function setrinorrea($data){ $this->rinorrea= $this->db->escape_str($data); }
    public function settos_con_flema($data){ $this->tos_con_flema= $this->db->escape_str($data); }
    public function setdisnea($data){ $this->disnea= $this->db->escape_str($data); }
    public function setdisnea_dias($data){ $this->disnea_dias= $this->db->escape_str($data); }
    public function setfiebre($data){ $this->fiebre= $this->db->escape_str($data); }
    public function setfiebre_t_max($data){ $this->fiebre_t_max= $this->db->escape_str($data); }
    public function setfatiga($data){ $this->fatiga= $this->db->escape_str($data); }
    public function setescalofrios($data){ $this->escalofrios= $this->db->escape_str($data); }
    public function setcefalea($data){ $this->cefalea= $this->db->escape_str($data); }
    public function sethemoptisis($data){ $this->hemoptisis= $this->db->escape_str($data); }
    public function setdiarrea($data){ $this->diarrea= $this->db->escape_str($data); }
    public function settos_seca($data){ $this->tos_seca= $this->db->escape_str($data); }
    public function setmialgia_artralgia($data){ $this->mialgia_artralgia= $this->db->escape_str($data); }
    public function setdolor_de_garganta($data){ $this->dolor_de_garganta= $this->db->escape_str($data); }
    public function sethb($data){ $this->hb= $this->db->escape_str($data); }
    public function setldh($data){ $this->ldh= $this->db->escape_str($data); }
    public function setprocalcitonina($data){ $this->procalcitonina= $this->db->escape_str($data); }
    public function setleucocitos($data){ $this->leucocitos= $this->db->escape_str($data); }
    public function settgo($data){ $this->tgo= $this->db->escape_str($data); }
    public function setdimero_d($data){ $this->dimero_d= $this->db->escape_str($data); }
    public function setlinfocitos($data){ $this->linfocitos= $this->db->escape_str($data); }
    public function setcpk($data){ $this->cpk= $this->db->escape_str($data); }
    public function setplaquetas($data){ $this->plaquetas= $this->db->escape_str($data); }
    public function setbt($data){ $this->bt= $this->db->escape_str($data); }
    public function setcpk_mb($data){ $this->cpk_mb= $this->db->escape_str($data); }
    public function setcreatinina($data){ $this->creatinina= $this->db->escape_str($data); }
    public function setpcr($data){ $this->pcr= $this->db->escape_str($data); }
    public function settroponina_t($data){ $this->troponina_t= $this->db->escape_str($data); }
    public function settroponina_i($data){ $this->troponina_i= $this->db->escape_str($data); }
    public function setpcr_rt_coronavirus($data){ $this->pcr_rt_coronavirus= $this->db->escape_str($data); }
    public function setpcr_rt_coronavirus_fecha($data){ $this->pcr_rt_coronavirus_fecha= $this->db->escape_str($data); }
    public function setpcr_rt_coronavirus_resultado($data){ $this->pcr_rt_coronavirus_resultado= $this->db->escape_str($data); }
    public function setpcr_pt_influenza($data){ $this->pcr_pt_influenza= $this->db->escape_str($data); }
    public function setpcr_pt_influenza_fecha($data){ $this->pcr_pt_influenza_fecha= $this->db->escape_str($data); }
    public function setpcr_pt_influenza_resultado($data){ $this->pcr_pt_influenza_resultado= $this->db->escape_str($data); }
    public function setprimer_cultivo_secresion($data){ $this->primer_cultivo_secresion= $this->db->escape_str($data); }
    public function setprimer_cultivo_secresion_fecha($data){ $this->primer_cultivo_secresion_fecha= $this->db->escape_str($data); }
    public function setprimer_cultivo_secresion_resultado($data){ $this->primer_cultivo_secresion_resultado= $this->db->escape_str($data); }
    public function setfilmarray_respiratorio($data){ $this->filmarray_respiratorio= $this->db->escape_str($data); }
    public function setfilmarray_respiratorio_fecha($data){ $this->filmarray_respiratorio_fecha= $this->db->escape_str($data); }
    public function setfilmarray_respiratorio_resultado($data){ $this->filmarray_respiratorio_resultado= $this->db->escape_str($data); }
    public function setprueba_rapida($data){ $this->prueba_rapida= $this->db->escape_str($data); }
    public function setprueba_rapida_fecha($data){ $this->prueba_rapida_fecha= $this->db->escape_str($data); }
    public function setprueba_rapida_igg($data){ $this->prueba_rapida_igg= $this->db->escape_str($data); }
    public function setprueba_rapida_igm($data){ $this->prueba_rapida_igm= $this->db->escape_str($data); }
    public function setperdida_gusto($data){ $this->perdida_gusto= $this->db->escape_str($data); }
    public function setperdida_olfato($data){ $this->perdida_olfato= $this->db->escape_str($data); }
    public function sethemocultivo($data){ $this->hemocultivo= $this->db->escape_str($data); }
    public function sethemocultivo_fecha($data){ $this->hemocultivo_fecha= $this->db->escape_str($data); }
    public function sethemocultivo_resultado($data){ $this->hemocultivo_resultado= $this->db->escape_str($data); }
    public function setdestino($data){ $this->destino= $this->db->escape_str($data); }
    public function setotros_cultivos($data){ $this->otros_cultivos= $this->db->escape_str($data); }
    public function setotros_cultivos_fecha($data){ $this->otros_cultivos_fecha= $this->db->escape_str($data); }
    public function setotros_cultivos_resultado($data){ $this->otros_cultivos_resultado= $this->db->escape_str($data); }
    public function setingreso_hospital_pa($data){ $this->ingreso_hospital_pa= $this->db->escape_str($data); }
    public function setingreso_hospital_pam($data){ $this->ingreso_hospital_pam= $this->db->escape_str($data); }
    public function setingreso_hospital_fr($data){ $this->ingreso_hospital_fr= $this->db->escape_str($data); }
    public function setingreso_hospital_fc($data){ $this->ingreso_hospital_fc= $this->db->escape_str($data); }
    public function setingreso_hospital_t($data){ $this->ingreso_hospital_t= $this->db->escape_str($data); }
    public function setingreso_hospital_sat02($data){ $this->ingreso_hospital_sat02= $this->db->escape_str($data); }
    public function setingreso_hospital_fio2($data){ $this->ingreso_hospital_fio2= $this->db->escape_str($data); }
    public function setingreso_hospital_pa02_fio02($data){ $this->ingreso_hospital_pa02_fio02= $this->db->escape_str($data); }
    public function setingreso_hospital_glasgow($data){ $this->ingreso_hospital_glasgow= $this->db->escape_str($data); }
    public function setingreso_uci_pa($data){ $this->ingreso_uci_pa= $this->db->escape_str($data); }
    public function setingreso_uci_pam($data){ $this->ingreso_uci_pam= $this->db->escape_str($data); }
    public function setingreso_uci_fr($data){ $this->ingreso_uci_fr= $this->db->escape_str($data); }
    public function setingreso_uci_fc($data){ $this->ingreso_uci_fc= $this->db->escape_str($data); }
    public function setingreso_uci_t($data){ $this->ingreso_uci_t= $this->db->escape_str($data); }
    public function setingreso_uci_sat02($data){ $this->ingreso_uci_sat02= $this->db->escape_str($data); }
    public function setingreso_uci_fio2($data){ $this->ingreso_uci_fio2= $this->db->escape_str($data); }
    public function setingreso_uci_pa02_fio02($data){ $this->ingreso_uci_pa02_fio02= $this->db->escape_str($data); }
    public function setingreso_uci_glasgow($data){ $this->ingreso_uci_glasgow= $this->db->escape_str($data); }
    public function setfalla_cardiovascular($data){ $this->falla_cardiovascular= $this->db->escape_str($data); }
    public function setfalla_respiratorio($data){ $this->falla_respiratorio= $this->db->escape_str($data); }
    public function setfalla_renal($data){ $this->falla_renal= $this->db->escape_str($data); }
    public function setfalla_hepatico($data){ $this->falla_hepatico= $this->db->escape_str($data); }
    public function setfalla_neurologico($data){ $this->falla_neurologico= $this->db->escape_str($data); }
    public function setfalla_coagulacion($data){ $this->falla_coagulacion= $this->db->escape_str($data); }
    public function setutilizacion_vmni($data){ $this->utilizacion_vmni= $this->db->escape_str($data); }
    public function setutilizacion_vmni_horas($data){ $this->utilizacion_vmni_horas= $this->db->escape_str($data); }
    public function setutilizacion_canula($data){ $this->utilizacion_canula= $this->db->escape_str($data); }
    public function setutilizacion_canula_horas($data){ $this->utilizacion_canula_horas= $this->db->escape_str($data); }
    public function setfecha_intubacion($data){ $this->fecha_intubacion= $this->db->escape_str($data); }
    public function setfecha_ingreso_vm($data){ $this->fecha_ingreso_vm= $this->db->escape_str($data); }
    public function setfecha_primer_dia_prona($data){ $this->fecha_primer_dia_prona= $this->db->escape_str($data); }
    public function setdx_ards($data){ $this->dx_ards= $this->db->escape_str($data); }
    public function setesquema_prona_supina_horas01($data){ $this->esquema_prona_supina_horas01= $this->db->escape_str($data); }
    public function setesquema_prona_supina_horas02($data){ $this->esquema_prona_supina_horas02= $this->db->escape_str($data); }
    public function setuso_titular_peep($data){ $this->uso_titular_peep= $this->db->escape_str($data); }
    public function setpv_tools($data){ $this->pv_tools= $this->db->escape_str($data); }
    public function setopen_lung_tools($data){ $this->open_lung_tools= $this->db->escape_str($data); }
    public function setpeep_in_view($data){ $this->peep_in_view= $this->db->escape_str($data); }
    public function setotras($data){ $this->otras= $this->db->escape_str($data); }
    public function setreclutamiento_alveolar($data){ $this->reclutamiento_alveolar= $this->db->escape_str($data); }
    public function setpeep_maximo($data){ $this->peep_maximo= $this->db->escape_str($data); }
    public function setpo2_fio2_prepona($data){ $this->po2_fio2_prepona= $this->db->escape_str($data); }
    public function setpco2preprona($data){ $this->pco2preprona= $this->db->escape_str($data); }
    public function setpo2_fio2_prona_4_horas($data){ $this->po2_fio2_prona_4_horas= $this->db->escape_str($data); }
    public function setpo2_prona_4_horas($data){ $this->po2_prona_4_horas= $this->db->escape_str($data); }
    public function setpo2_fio2_supino_4_horas($data){ $this->po2_fio2_supino_4_horas= $this->db->escape_str($data); }
    public function setpco2_supono_4_horas($data){ $this->pco2_supono_4_horas= $this->db->escape_str($data); }
    public function setpam($data){ $this->pam= $this->db->escape_str($data); }
    public function setgc($data){ $this->gc= $this->db->escape_str($data); }
    public function setic($data){ $this->ic= $this->db->escape_str($data); }
    public function setpvc($data){ $this->pvc= $this->db->escape_str($data); }
    public function setccs($data){ $this->ccs= $this->db->escape_str($data); }
    public function setvpp($data){ $this->vpp= $this->db->escape_str($data); }
    public function setsat02_venosa_central($data){ $this->sat02_venosa_central= $this->db->escape_str($data); }
    public function setlactato($data){ $this->lactato= $this->db->escape_str($data); }
    public function setvasopresor_inotropico($data){ $this->vasopresor_inotropico= $this->db->escape_str($data); }
    public function sethemodinamia_fevi($data){ $this->hemodinamia_fevi= $this->db->escape_str($data); }
    public function sethemodinamia_ic($data){ $this->hemodinamia_ic= $this->db->escape_str($data); }
    public function sethemodinamia_vci($data){ $this->hemodinamia_vci= $this->db->escape_str($data); }
    public function sethemodinamia_otros_hallazgos($data){ $this->hemodinamia_otros_hallazgos= $this->db->escape_str($data); }
    public function sethemodinamia_sedacion($data){ $this->hemodinamia_sedacion= $this->db->escape_str($data); }
    public function sethemodinamia_analgesia($data){ $this->hemodinamia_analgesia= $this->db->escape_str($data); }
    public function sethemodinamia_relajante($data){ $this->hemodinamia_relajante= $this->db->escape_str($data); }
    public function sethemodinamia_antibiotico($data){ $this->hemodinamia_antibiotico= $this->db->escape_str($data); }
    public function sethemodinamia_antiviral($data){ $this->hemodinamia_antiviral= $this->db->escape_str($data); }
    public function sethidroxicloroquina($data){ $this->hidroxicloroquina= $this->db->escape_str($data); }
    public function sethidroxicloroquina_dosis($data){ $this->hidroxicloroquina_dosis= $this->db->escape_str($data); }
    public function setdescripcion_rx_torax($data){ $this->descripcion_rx_torax= $this->db->escape_str($data); }
    public function setfecha_extubacion($data){ $this->fecha_extubacion= $this->db->escape_str($data); }
    public function setfecha_traqueostomia($data){ $this->fecha_traqueostomia= $this->db->escape_str($data); }
    public function setfecha_egreso_vm($data){ $this->fecha_egreso_vm= $this->db->escape_str($data); }
    public function setfecha_alta_uci($data){ $this->fecha_alta_uci= $this->db->escape_str($data); }
    public function setcondicion_vivo($data){ $this->condicion_vivo= $this->db->escape_str($data); }
    public function setcondicion_fallecido($data){ $this->condicion_fallecido= $this->db->escape_str($data); }
    public function setid_examen($data){ $this->id_examen= $this->db->escape_str($data); }
    public function setdia_1($data){ $this->dia_1= $this->db->escape_str($data); }
    public function setdia_2($data){ $this->dia_2= $this->db->escape_str($data); }
    public function setdia_3($data){ $this->dia_3= $this->db->escape_str($data); }
    public function setdia_5($data){ $this->dia_5= $this->db->escape_str($data); }
    public function setdia_7($data){ $this->dia_7= $this->db->escape_str($data); }
    public function setestado($data){
        $this->estado = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerPacientes_New()
    {
        $this->db->select("
        cdn.id_paciente,cdn.id_renipress,concat_ws(',',cdn.apellidos, cdn.nombres) as 'Paciente',
        (Case cdn.sexo when '1' then 'Masculino' when '2' then 'Femenino' End) as 'Sexo',cdn.edad as 'Edad',
        DATE_FORMAT(cdn.ingreso_hospital,'%d/%m/%Y') as 'Ingreso_Hospital',
        DATE_FORMAT(cdn.ingreso_uci,'%d/%m/%Y') as 'Ingreso_UCI',
        DATE_FORMAT(cdn.pcr_rt_coronavirus_fecha,'%d/%m/%Y') as 'pcr_rt_coronavirus_fecha_',
        DATE_FORMAT(cdn.pcr_pt_influenza_fecha,'%d/%m/%Y') as 'pcr_pt_influenza_fecha_',
        DATE_FORMAT(cdn.primer_cultivo_secresion_fecha,'%d/%m/%Y') as 'primer_cultivo_secresion_fecha_',
        DATE_FORMAT(cdn.prueba_rapida_fecha,'%d/%m/%Y') as 'prueba_rapida_fecha_',
        DATE_FORMAT(cdn.hemocultivo_fecha,'%d/%m/%Y') as 'hemocultivo_fecha_',
        DATE_FORMAT(cdn.filmarray_respiratorio_fecha,'%d/%m/%Y') as 'filmarray_respiratorio_fecha_',
        DATE_FORMAT(cdn.otros_cultivos_fecha,'%d/%m/%Y') as 'otros_cultivos_fecha_',
        DATE_FORMAT(cdn.fecha_intubacion,'%d/%m/%Y') as 'fecha_intubacion_',
        DATE_FORMAT(cdn.fecha_ingreso_vm,'%d/%m/%Y') as 'fecha_ingreso_vm_',
        DATE_FORMAT(cdn.fecha_primer_dia_prona,'%d/%m/%Y') as 'fecha_primer_dia_prona_',
        DATE_FORMAT(cdn.fecha_extubacion,'%d/%m/%Y') as 'fecha_extubacion_',
        DATE_FORMAT(cdn.fecha_traqueostomia,'%d/%m/%Y') as 'fecha_traqueostomia_',
        DATE_FORMAT(cdn.fecha_egreso_vm,'%d/%m/%Y') as 'fecha_egreso_vm_',
        DATE_FORMAT(cdn.fecha_alta_uci,'%d/%m/%Y') as 'fecha_alta_uci_',
        (case cdn.activo when '1' then 'Activo' when '0' then 'Inactivo' End) as 'Estado', cdn.telefono as 'Telef_Tabla', cdn.*, rnp.*, ps.nombre pais");
        $this->db->from("covid_paciente_new cdn, renipress rnp");
        $this->db->where("cdn.id_renipress = rnp.id_renipress");
        $this->db->join("pais as ps","ps.id = cdn.idpais","left");
        $this->db->order_by("cdn.id_paciente DESC");
        return $this->db->get();
    }
    public function obtenerPacientes()
    {
        $this->db->select("*");
        $this->db->from("lista_pacientes_basica");
        $this->db->order_by("Hospitalizacion DESC");
        return $this->db->get();
    }
    public function listaexamenesnew()
    {
        $this->db->select("*");
        $this->db->from("covid_examenes");
        $this->db->order_by("id_examen ASC");
        $this->db->where("activo", 1);
        return $this->db->get();
    }
    public function listaexamenes_edit()
    {
        $this->db->select("ce.descripcion, cpne.*");
        $this->db->from("covid_paciente_new_examenes cpne, covid_examenes ce");
        $this->db->where("cpne.id_examen = ce.id_examen");
        $this->db->where("id_paciente", $this->idpaciente);
        $this->db->order_by("id_examen ASC");
        return $this->db->get();
    }
    public function obtenerPacientesSexo($tipo)
    {
        $this->db->select("count(*) total");
        $this->db->from("lista_pacientes_basica");
        $this->db->where("Sexo", $tipo);
        return $this->db->get();
    }
    public function obtenerPacientesCriticos($tipo)
    {
        $this->db->select("count(*) total");
        $this->db->from("lista_pacientes_estados_criticos");
        $this->db->where($tipo, "SI");
        return $this->db->get();
    }
    public function obtenerReportePacientes()
    {
        $this->db->select("*");
        $this->db->from("lista_pacientes_reporte");
        return $this->db->get();
    }
    public function guardarPaciente()
    {
        $data = array(
            "id_renipress" => $this->idrenipress,
            "id_documento" => $this->tipoDocumento,
            "numero_documento" => $this->numeroDocumento,
            "apellidos" => $this->apellido,
            "nombres" => $this->nombre,
            "sexo" => $this->sexo,
            "gestante" => $this->gestante,
            "nacimiento" => $this->fechaNacimiento,
            "edad" => $this->edad,
            "domicilio" => $this->domicilio,
            "numero_historia" => $this->numero_historia,
            "ingreso_hospital" => $this->ingreso_hospital,
            "ingreso_uci" => $this->ingreso_uci,
            "idpais" => $this->idpais,
            "ubigeo" => $this->ubigeo,
            "telefono" => $this->telefono,
            "talla" => $this->talla,
            "peso_ideal_vm" => $this->peso_ideal_vm,
            "peso_actual" => $this->peso_actual,
            "imc" => $this->imc,
            "apache" => $this->apache,
            "sofa" => $this->sofa,
            "tiempo_emfermedad" => $this->tiempo_emfermedad,                        
            "hta" => $this->hta,
            "otras_enf_pulmonares" => $this->otras_enf_pulmonares,
            "cancer" => $this->cancer,
            "diabetes_mellitus" => $this->diabetes_mellitus,
            "asma" => $this->asma,
            "acv_previo" => $this->acv_previo,
            "epoc_bronquiectasias" => $this->epoc_bronquiectasias,
            "falla_cardiaca" => $this->falla_cardiaca,
            "fumador_cronico" => $this->fumador_cronico,
            "epid_fibrosis_pulmonar" => $this->epid_fibrosis_pulmonar,
            "enf_renal_cronica" => $this->enf_renal_cronica,
            "vih" => $this->vih,
            "viajes_pervios" => $this->viajes_pervios,
            "procedencia_viajes" => $this->procedencia_viajes,
            "contacto_personas_covid" => $this->contacto_personas_covid,
            "contacto_extranjeros" => $this->contacto_extranjeros,
            "procedencia_extranjeros" => $this->procedencia_extranjeros,
            "personal_salud" => $this->personal_salud,
            "rinorrea" => $this->rinorrea,
            "tos_con_flema" => $this->tos_con_flema,
            "disnea" => $this->disnea,
            "disnea_dias" => $this->disnea_dias,
            "fiebre" => $this->fiebre,
            "fiebre_t_max" => $this->fiebre_t_max,
            "fatiga" => $this->fatiga,
            "escalofrios" => $this->escalofrios,
            "cefalea" => $this->cefalea,
            "hemoptisis" => $this->hemoptisis,
            "diarrea" => $this->diarrea,
            "tos_seca" => $this->tos_seca,
            "mialgia_artralgia" => $this->mialgia_artralgia,
            "dolor_de_garganta" => $this->dolor_de_garganta,
            "hb" => $this->hb,
            "ldh" => $this->ldh,
            "procalcitonina" => $this->procalcitonina,
            "leucocitos" => $this->leucocitos,
            "tgo" => $this->tgo,
            "dimero_d" => $this->dimero_d,
            "linfocitos" => $this->linfocitos,
            "cpk" => $this->cpk,
            "plaquetas" => $this->plaquetas,
            "bt" => $this->bt,
            "cpk_mb" => $this->cpk_mb,
            "creatinina" => $this->creatinina,
            "pcr" => $this->pcr,
            "troponina_t" => $this->troponina_t,
            "troponina_i" => $this->troponina_i,
            "pcr_rt_coronavirus" => $this->pcr_rt_coronavirus,
            "pcr_rt_coronavirus_fecha" => $this->pcr_rt_coronavirus_fecha,
            "pcr_rt_coronavirus_resultado" => $this->pcr_rt_coronavirus_resultado,
            "pcr_pt_influenza" => $this->pcr_pt_influenza,
            "pcr_pt_influenza_fecha" => $this->pcr_pt_influenza_fecha,
            "pcr_pt_influenza_resultado" => $this->pcr_pt_influenza_resultado,
            "primer_cultivo_secresion" => $this->primer_cultivo_secresion,
            "primer_cultivo_secresion_fecha" => $this->primer_cultivo_secresion_fecha,
            "primer_cultivo_secresion_resultado" => $this->primer_cultivo_secresion_resultado,
            "filmarray_respiratorio" => $this->filmarray_respiratorio,
            "filmarray_respiratorio_fecha" => $this->filmarray_respiratorio_fecha,
            "filmarray_respiratorio_resultado" => $this->filmarray_respiratorio_resultado,
            "prueba_rapida" => $this->prueba_rapida,
            "prueba_rapida_fecha" => $this->prueba_rapida_fecha,
            "prueba_rapida_igg" => $this->prueba_rapida_igg,
            "prueba_rapida_igm" => $this->prueba_rapida_igm,
            "perdida_gusto" => $this->perdida_gusto,
            "perdida_olfato" => $this->perdida_olfato,
            "hemocultivo" => $this->hemocultivo,
            "hemocultivo_fecha" => $this->hemocultivo_fecha,
            "hemocultivo_resultado" => $this->hemocultivo_resultado,
            "destino" => $this->destino,
            "otros_cultivos" => $this->otros_cultivos,
            "otros_cultivos_fecha" => $this->otros_cultivos_fecha,
            "otros_cultivos_resultado" => $this->otros_cultivos_resultado,
            "ingreso_hospital_pa" => $this->ingreso_hospital_pa,
            "ingreso_hospital_pam" => $this->ingreso_hospital_pam,
            "ingreso_hospital_fr" => $this->ingreso_hospital_fr,
            "ingreso_hospital_fc" => $this->ingreso_hospital_fc,
            "ingreso_hospital_t" => $this->ingreso_hospital_t,
            "ingreso_hospital_sat02" => $this->ingreso_hospital_sat02,
            "ingreso_hospital_fio2" => $this->ingreso_hospital_fio2,
            "ingreso_hospital_pa02_fio02" => $this->ingreso_hospital_pa02_fio02,
            "ingreso_hospital_glasgow" => $this->ingreso_hospital_glasgow,
            "ingreso_uci_pa" => $this->ingreso_uci_pa,
            "ingreso_uci_pam" => $this->ingreso_uci_pam,
            "ingreso_uci_fr" => $this->ingreso_uci_fr,
            "ingreso_uci_fc" => $this->ingreso_uci_fc,
            "ingreso_uci_t" => $this->ingreso_uci_t,
            "ingreso_uci_sat02" => $this->ingreso_uci_sat02,
            "ingreso_uci_fio2" => $this->ingreso_uci_fio2,
            "ingreso_uci_pa02_fio02" => $this->ingreso_uci_pa02_fio02,
            "ingreso_uci_glasgow" => $this->ingreso_uci_glasgow,
            "falla_cardiovascular" => $this->falla_cardiovascular,
            "falla_respiratorio" => $this->falla_respiratorio,
            "falla_renal" => $this->falla_renal,
            "falla_hepatico" => $this->falla_hepatico,
            "falla_neurologico" => $this->falla_neurologico,
            "falla_coagulacion" => $this->falla_coagulacion,
            "utilizacion_vmni" => $this->utilizacion_vmni,
            "utilizacion_vmni_horas" => $this->utilizacion_vmni_horas,
            "utilizacion_canula" => $this->utilizacion_canula,
            "utilizacion_canula_horas" => $this->utilizacion_canula_horas,
            "fecha_intubacion" => $this->fecha_intubacion,
            "fecha_ingreso_vm" => $this->fecha_ingreso_vm,
            "fecha_primer_dia_prona" => $this->fecha_primer_dia_prona,
            "dx_ards" => $this->dx_ards,
            "esquema_prona_supina_horas01" => $this->esquema_prona_supina_horas01,
            "esquema_prona_supina_horas02" => $this->esquema_prona_supina_horas02,
            "uso_titular_peep" => $this->uso_titular_peep,
            "pv_tools" => $this->pv_tools,
            "open_lung_tools" => $this->open_lung_tools,
            "peep_in_view" => $this->peep_in_view,
            "otras" => $this->otras,
            "reclutamiento_alveolar" => $this->reclutamiento_alveolar,
            "peep_maximo" => $this->peep_maximo,
            "po2_fio2_prepona" => $this->po2_fio2_prepona,
            "pco2preprona" => $this->pco2preprona,
            "po2_fio2_prona_4_horas" => $this->po2_fio2_prona_4_horas,
            "po2_prona_4_horas" => $this->po2_prona_4_horas,
            "po2_fio2_supino_4_horas" => $this->po2_fio2_supino_4_horas,
            "pco2_supono_4_horas" => $this->pco2_supono_4_horas,
            "pam" => $this->pam,
            "gc" => $this->gc,
            "ic" => $this->ic,
            "pvc" => $this->pvc,
            "ccs" => $this->ccs,
            "vpp" => $this->vpp,
            "sat02_venosa_central" => $this->sat02_venosa_central,
            "lactato" => $this->lactato,
            "vasopresor_inotropico" => $this->vasopresor_inotropico,
            "hemodinamia_fevi" => $this->hemodinamia_fevi,
            "hemodinamia_ic" => $this->hemodinamia_ic,
            "hemodinamia_vci" => $this->hemodinamia_vci,
            "hemodinamia_otros_hallazgos" => $this->hemodinamia_otros_hallazgos,
            "hemodinamia_sedacion" => $this->hemodinamia_sedacion,
            "hemodinamia_analgesia" => $this->hemodinamia_analgesia,
            "hemodinamia_relajante" => $this->hemodinamia_relajante,
            "hemodinamia_antibiotico" => $this->hemodinamia_antibiotico,
            "hemodinamia_antiviral" => $this->hemodinamia_antiviral,
            "hidroxicloroquina" => $this->hidroxicloroquina,
            "hidroxicloroquina_dosis" => $this->hidroxicloroquina_dosis,
            "descripcion_rx_torax" => $this->descripcion_rx_torax,
            "fecha_extubacion" => $this->fecha_extubacion,
            "fecha_traqueostomia" => $this->fecha_traqueostomia,
            "fecha_egreso_vm" => $this->fecha_egreso_vm,
            "fecha_alta_uci" => $this->fecha_alta_uci,
            "condicion_vivo" => $this->condicion_vivo,
            "condicion_fallecido" => $this->condicion_fallecido,
            "activo" => $this->estado,
        );
        if($this->db->insert("covid_paciente_new", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function guardarExamenes()
    {
        $data = array(
            "id_paciente" => $this->idpaciente,
            "id_examen" => $this->id_examen,
            "dia_1" => $this->dia_1,
            "dia_2" => $this->dia_2,
            "dia_3" => $this->dia_3,
            "dia_5" => $this->dia_5,
            "dia_7" => $this->dia_7,
            "activo" => 1,
        );
        if($this->db->insert("covid_paciente_new_examenes", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function updateExamenes()
    {
        $this->db->set("dia_1", $this->dia_1, TRUE);
        $this->db->set("dia_2", $this->dia_2, TRUE);
        $this->db->set("dia_3", $this->dia_3, TRUE);
        $this->db->set("dia_5", $this->dia_5, TRUE);
        $this->db->set("dia_7", $this->dia_7, TRUE);
        $this->db->where("id_paciente", $this->idpaciente);
        $this->db->where("id_examen", $this->id_examen);
        if($this->db->update('covid_paciente_new_examenes')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function actualizarPaciente()
    {
        $this->db->set("id_renipress", $this->idrenipress, TRUE);
        $this->db->set("id_documento", $this->tipoDocumento, TRUE);
        $this->db->set("numero_documento", $this->numeroDocumento, TRUE);
        $this->db->set("apellidos", $this->apellido, TRUE);
        $this->db->set("nombres", $this->nombre, TRUE);
        $this->db->set("sexo", $this->sexo, TRUE);
        $this->db->set("gestante", $this->gestante, TRUE);
        $this->db->set("nacimiento", $this->fechaNacimiento, TRUE);
        $this->db->set("edad", $this->edad, TRUE);
        $this->db->set("domicilio", $this->domicilio, TRUE);
        $this->db->set("numero_historia", $this->numero_historia, TRUE);
        $this->db->set("ingreso_hospital", $this->ingreso_hospital, TRUE);
        $this->db->set("ingreso_uci", $this->ingreso_uci, TRUE);
        $this->db->set("idpais", $this->idpais, TRUE);
        $this->db->set("ubigeo", $this->ubigeo, TRUE);
        $this->db->set("telefono", $this->telefono, TRUE);
        $this->db->set("talla", $this->talla, TRUE);
        $this->db->set("peso_ideal_vm", $this->peso_ideal_vm, TRUE);
        $this->db->set("peso_actual", $this->peso_actual, TRUE);
        $this->db->set("imc", $this->imc, TRUE);
        $this->db->set("apache", $this->apache, TRUE);
        $this->db->set("sofa", $this->sofa, TRUE);
        $this->db->set("tiempo_emfermedad", $this->tiempo_emfermedad, TRUE);
        $this->db->set("hta", $this->hta, TRUE);
        $this->db->set("otras_enf_pulmonares", $this->otras_enf_pulmonares, TRUE);
        $this->db->set("cancer", $this->cancer, TRUE);
        $this->db->set("diabetes_mellitus", $this->diabetes_mellitus, TRUE);
        $this->db->set("asma", $this->asma, TRUE);
        $this->db->set("acv_previo", $this->acv_previo, TRUE);
        $this->db->set("epoc_bronquiectasias", $this->epoc_bronquiectasias, TRUE);
        $this->db->set("falla_cardiaca", $this->falla_cardiaca, TRUE);
        $this->db->set("fumador_cronico", $this->fumador_cronico, TRUE);
        $this->db->set("epid_fibrosis_pulmonar", $this->epid_fibrosis_pulmonar, TRUE);
        $this->db->set("enf_renal_cronica", $this->enf_renal_cronica, TRUE);
        $this->db->set("vih", $this->vih, TRUE);
        $this->db->set("viajes_pervios", $this->viajes_pervios, TRUE);
        $this->db->set("contacto_personas_covid", $this->contacto_personas_covid, TRUE);
        $this->db->set("contacto_extranjeros", $this->contacto_extranjeros, TRUE);
        $this->db->set("personal_salud", $this->personal_salud, TRUE);
        $this->db->set("rinorrea", $this->rinorrea, TRUE);
        $this->db->set("tos_con_flema", $this->tos_con_flema, TRUE);
        $this->db->set("disnea", $this->disnea, TRUE);
        $this->db->set("fiebre", $this->fiebre, TRUE);
        $this->db->set("fatiga", $this->fatiga, TRUE);
        $this->db->set("escalofrios", $this->escalofrios, TRUE);
        $this->db->set("cefalea", $this->cefalea, TRUE);
        $this->db->set("hemoptisis", $this->hemoptisis, TRUE);
        $this->db->set("diarrea", $this->diarrea, TRUE);
        $this->db->set("tos_seca", $this->tos_seca, TRUE);
        $this->db->set("mialgia_artralgia", $this->mialgia_artralgia, TRUE);
        $this->db->set("dolor_de_garganta", $this->dolor_de_garganta, TRUE);
        $this->db->set("pcr_rt_coronavirus", $this->pcr_rt_coronavirus, TRUE);
        $this->db->set("pcr_pt_influenza", $this->pcr_pt_influenza, TRUE);
        $this->db->set("primer_cultivo_secresion", $this->primer_cultivo_secresion, TRUE);
        $this->db->set("filmarray_respiratorio", $this->filmarray_respiratorio, TRUE);
        $this->db->set("prueba_rapida", $this->prueba_rapida, TRUE);
        $this->db->set("prueba_rapida_igg", $this->prueba_rapida_igg, TRUE);
        $this->db->set("prueba_rapida_igm", $this->prueba_rapida_igm, TRUE);
        $this->db->set("perdida_gusto", $this->perdida_gusto, TRUE);
        $this->db->set("perdida_olfato", $this->perdida_olfato, TRUE);
        $this->db->set("hemocultivo", $this->hemocultivo, TRUE);
        $this->db->set("otros_cultivos", $this->otros_cultivos, TRUE);
        $this->db->set("falla_cardiovascular", $this->falla_cardiovascular, TRUE);
        $this->db->set("falla_respiratorio", $this->falla_respiratorio, TRUE);
        $this->db->set("falla_renal", $this->falla_renal, TRUE);
        $this->db->set("falla_hepatico", $this->falla_hepatico, TRUE);
        $this->db->set("falla_neurologico", $this->falla_neurologico, TRUE);
        $this->db->set("falla_coagulacion", $this->falla_coagulacion, TRUE);
        $this->db->set("utilizacion_vmni", $this->utilizacion_vmni, TRUE);
        $this->db->set("utilizacion_canula", $this->utilizacion_canula, TRUE);
        $this->db->set("uso_titular_peep", $this->uso_titular_peep, TRUE);
        $this->db->set("pv_tools", $this->pv_tools, TRUE);
        $this->db->set("open_lung_tools", $this->open_lung_tools, TRUE);
        $this->db->set("peep_in_view", $this->peep_in_view, TRUE);
        $this->db->set("reclutamiento_alveolar", $this->reclutamiento_alveolar, TRUE);
        $this->db->set("hidroxicloroquina", $this->hidroxicloroquina, TRUE);
        $this->db->set("condicion_vivo", $this->condicion_vivo, TRUE);
        $this->db->set("condicion_fallecido", $this->condicion_fallecido, TRUE);
        $this->db->set("procedencia_viajes", $this->procedencia_viajes, TRUE);
        $this->db->set("procedencia_extranjeros", $this->procedencia_extranjeros, TRUE);
        $this->db->set("disnea_dias", $this->disnea_dias, TRUE);
        $this->db->set("fiebre_t_max", $this->fiebre_t_max, TRUE);
        $this->db->set("hb", $this->hb, TRUE);
        $this->db->set("ldh", $this->ldh, TRUE);
        $this->db->set("procalcitonina", $this->procalcitonina, TRUE);
        $this->db->set("leucocitos", $this->leucocitos, TRUE);
        $this->db->set("tgo", $this->tgo, TRUE);
        $this->db->set("dimero_d", $this->dimero_d, TRUE);
        $this->db->set("linfocitos", $this->linfocitos, TRUE);
        $this->db->set("cpk", $this->cpk, TRUE);
        $this->db->set("plaquetas", $this->plaquetas, TRUE);
        $this->db->set("bt", $this->bt, TRUE);
        $this->db->set("cpk_mb", $this->cpk_mb, TRUE);
        $this->db->set("creatinina", $this->creatinina, TRUE);
        $this->db->set("pcr", $this->pcr, TRUE);
        $this->db->set("troponina_t", $this->troponina_t, TRUE);
        $this->db->set("troponina_i", $this->troponina_i, TRUE);
        $this->db->set("pcr_rt_coronavirus_resultado", $this->pcr_rt_coronavirus_resultado, TRUE);
        $this->db->set("pcr_pt_influenza_resultado", $this->pcr_pt_influenza_resultado, TRUE);
        $this->db->set("primer_cultivo_secresion_resultado", $this->primer_cultivo_secresion_resultado, TRUE);
        $this->db->set("filmarray_respiratorio_resultado", $this->filmarray_respiratorio_resultado, TRUE);
        $this->db->set("hemocultivo_resultado", $this->hemocultivo_resultado, TRUE);
        $this->db->set("destino", $this->destino, TRUE);
        $this->db->set("otros_cultivos_resultado", $this->otros_cultivos_resultado, TRUE);
        $this->db->set("ingreso_hospital_pa", $this->ingreso_hospital_pa, TRUE);
        $this->db->set("ingreso_hospital_pam", $this->ingreso_hospital_pam, TRUE);
        $this->db->set("ingreso_hospital_fr", $this->ingreso_hospital_fr, TRUE);
        $this->db->set("ingreso_hospital_fc", $this->ingreso_hospital_fc, TRUE);
        $this->db->set("ingreso_hospital_t", $this->ingreso_hospital_t, TRUE);
        $this->db->set("ingreso_hospital_sat02", $this->ingreso_hospital_sat02, TRUE);
        $this->db->set("ingreso_hospital_fio2", $this->ingreso_hospital_fio2, TRUE);
        $this->db->set("ingreso_hospital_pa02_fio02", $this->ingreso_hospital_pa02_fio02, TRUE);
        $this->db->set("ingreso_hospital_glasgow", $this->ingreso_hospital_glasgow, TRUE);
        $this->db->set("ingreso_uci_pa", $this->ingreso_uci_pa, TRUE);
        $this->db->set("ingreso_uci_pam", $this->ingreso_uci_pam, TRUE);
        $this->db->set("ingreso_uci_fr", $this->ingreso_uci_fr, TRUE);
        $this->db->set("ingreso_uci_fc", $this->ingreso_uci_fc, TRUE);
        $this->db->set("ingreso_uci_t", $this->ingreso_uci_t, TRUE);
        $this->db->set("ingreso_uci_sat02", $this->ingreso_uci_sat02, TRUE);
        $this->db->set("ingreso_uci_fio2", $this->ingreso_uci_fio2, TRUE);
        $this->db->set("ingreso_uci_pa02_fio02", $this->ingreso_uci_pa02_fio02, TRUE);
        $this->db->set("ingreso_uci_glasgow", $this->ingreso_uci_glasgow, TRUE);
        $this->db->set("utilizacion_vmni_horas", $this->utilizacion_vmni_horas, TRUE);
        $this->db->set("utilizacion_canula_horas", $this->utilizacion_canula_horas, TRUE);
        $this->db->set("dx_ards", $this->dx_ards, TRUE);
        $this->db->set("esquema_prona_supina_horas01", $this->esquema_prona_supina_horas01, TRUE);
        $this->db->set("esquema_prona_supina_horas02", $this->esquema_prona_supina_horas02, TRUE);
        $this->db->set("otras", $this->otras, TRUE);
        $this->db->set("peep_maximo", $this->peep_maximo, TRUE);
        $this->db->set("po2_fio2_prepona", $this->po2_fio2_prepona, TRUE);
        $this->db->set("pco2preprona", $this->pco2preprona, TRUE);
        $this->db->set("po2_fio2_prona_4_horas", $this->po2_fio2_prona_4_horas, TRUE);
        $this->db->set("po2_prona_4_horas", $this->po2_prona_4_horas, TRUE);
        $this->db->set("po2_fio2_supino_4_horas", $this->po2_fio2_supino_4_horas, TRUE);
        $this->db->set("pco2_supono_4_horas", $this->pco2_supono_4_horas, TRUE);
        $this->db->set("pam", $this->pam, TRUE);
        $this->db->set("gc", $this->gc, TRUE);
        $this->db->set("ic", $this->ic, TRUE);
        $this->db->set("pvc", $this->pvc, TRUE);
        $this->db->set("ccs", $this->ccs, TRUE);
        $this->db->set("vpp", $this->vpp, TRUE);
        $this->db->set("sat02_venosa_central", $this->sat02_venosa_central, TRUE);
        $this->db->set("lactato", $this->lactato, TRUE);
        $this->db->set("vasopresor_inotropico", $this->vasopresor_inotropico, TRUE);
        $this->db->set("hemodinamia_fevi", $this->hemodinamia_fevi, TRUE);
        $this->db->set("hemodinamia_ic", $this->hemodinamia_ic, TRUE);
        $this->db->set("hemodinamia_vci", $this->hemodinamia_vci, TRUE);
        $this->db->set("hemodinamia_otros_hallazgos", $this->hemodinamia_otros_hallazgos, TRUE);
        $this->db->set("hemodinamia_sedacion", $this->hemodinamia_sedacion, TRUE);
        $this->db->set("hemodinamia_analgesia", $this->hemodinamia_analgesia, TRUE);
        $this->db->set("hemodinamia_relajante", $this->hemodinamia_relajante, TRUE);
        $this->db->set("hemodinamia_antibiotico", $this->hemodinamia_antibiotico, TRUE);
        $this->db->set("hemodinamia_antiviral", $this->hemodinamia_antiviral, TRUE);
        $this->db->set("hidroxicloroquina_dosis", $this->hidroxicloroquina_dosis, TRUE);
        $this->db->set("descripcion_rx_torax", $this->descripcion_rx_torax, TRUE);
        $this->db->set("pcr_rt_coronavirus_fecha", $this->pcr_rt_coronavirus_fecha, TRUE);
        $this->db->set("pcr_pt_influenza_fecha", $this->pcr_pt_influenza_fecha, TRUE);
        $this->db->set("primer_cultivo_secresion_fecha", $this->primer_cultivo_secresion_fecha, TRUE);
        $this->db->set("filmarray_respiratorio_fecha", $this->filmarray_respiratorio_fecha, TRUE);
        $this->db->set("prueba_rapida_fecha", $this->prueba_rapida_fecha, TRUE);
        $this->db->set("hemocultivo_fecha", $this->hemocultivo_fecha, TRUE);
        $this->db->set("otros_cultivos_fecha", $this->otros_cultivos_fecha, TRUE);
        $this->db->set("fecha_intubacion", $this->fecha_intubacion, TRUE);
        $this->db->set("fecha_ingreso_vm", $this->fecha_ingreso_vm, TRUE);
        $this->db->set("fecha_primer_dia_prona", $this->fecha_primer_dia_prona, TRUE);
        $this->db->set("fecha_extubacion", $this->fecha_extubacion, TRUE);
        $this->db->set("fecha_traqueostomia", $this->fecha_traqueostomia, TRUE);
        $this->db->set("fecha_egreso_vm", $this->fecha_egreso_vm, TRUE);
        $this->db->set("fecha_alta_uci", $this->fecha_alta_uci, TRUE);
        $this->db->set("activo", $this->estado, TRUE);
        $this->db->where("id_paciente", $this->idpaciente );
        if($this->db->update('covid_paciente_new')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function actualizarEstadoPaciente()
    {
        $data = array(
            "id_paciente" => $this->idpaciente,
            "fecha" => $this->fechaRegistro,
            "positivo" => $this->positivo,
            "sospechoso" => $this->sospechoso,
            "negativo" => $this->negativo,
            "fecha_muestra" => $this->fechaMuestra,
            "id_cie_10_1" => $this->cie10_1_codigo,
            "cie_10_1_descripcion" => $this->cie10_1_texto,
            "id_cie_10_2" => $this->cie10_2_codigo,
            "cie_10_2_descripcion" => $this->cie10_2_texto,
            "id_cie_10_3" => $this->cie10_3_codigo,
            "cie_10_3_descripcion" => $this->cie10_3_texto,
            "sala_con_oxigeno" => $this->salaSinOxigeno,
            "sala_sin_oxigeno" => $this->salaConOxigeno,
            "uci_con_ventilacion" => $this->UciSinVentilacion,
            "uci_sin_ventilacion" => $this->UciConVentilacion,
            "favorable" => $this->evolucionFavorable,
            "desfavorable" => $this->EvolucionDesfavorable,
            "fallecido" => $this->estadoFallecido,
            "alta" => $this->estadoAlto,
            "activo" => 0,
        );
        if($this->db->insert("covid_paciente_historial", $data)) {
            $id = $this->db->insert_id();
            $this->db->set("activo", 0, TRUE);
            $this->db->where("id_paciente", $this->idpaciente );
            $this->db->update('covid_paciente_historial');
            $this->db->set("activo", 1, TRUE);
            $this->db->where("id_paciente", $this->idpaciente );
            $this->db->order_by("fecha", "DESC");
            $this->db->limit(1);
            $this->db->update('covid_paciente_historial');
            return $id;
        }
        else {
            return 0;
        }
    }
    public function obtenerTotalPacientes(){
        $this->db->select("ifnull(count(*), 0) total");
        $this->db->from("covid_paciente_new");
        $this->db->where("activo", "1");
        return $this->db->get();
    }
    public function obtenerTotalPacientesSospechoso(){
        $this->db->select("ifnull(count(*), 0) total");
        $this->db->from("covid_paciente_new");
        $this->db->where("pcr_rt_coronavirus", "1");
        $this->db->where("activo", "1");
        return $this->db->get();
    }
    public function obtenerTotalPacientesNegativo(){
        $this->db->select("ifnull(count(*), 0) total");
        $this->db->from("covid_paciente_new");
        $this->db->where("condicion_vivo", "1");
        $this->db->where("activo", "1");
        return $this->db->get();
    }
    public function obtenerTotalPacientesPositivo(){
        $this->db->select("ifnull(count(*), 0) total");
        $this->db->from("covid_paciente_new");
        $this->db->where("condicion_fallecido", "1");
        $this->db->where("activo", "1");
        return $this->db->get();
    }
    public function obtenerHistorialPaciente(){
        $this->db->select("*");
        $this->db->from("lista_historiales_paciente");
        $this->db->where("id_paciente", $this->idpaciente);
        return $this->db->get();
    }
    public function obtenerReporteGrafica(){
        $this->db->select("*");
        $this->db->from("lista_paciente_casos_fecha");
        return $this->db->get();
    }
    public function eliminarHistorialPaciente(){
        $this->db->db_debug = FALSE;
        $this->db->where("id_historial", $this->idhistorial);
        if ($this->db->delete('covid_paciente_historial')) {
            $this->db->set("activo", 0, TRUE);
            $this->db->where("id_paciente", $this->idpaciente );
            $this->db->update('covid_paciente_historial');
            $this->db->set("activo", 1, TRUE);
            $this->db->where("id_paciente", $this->idpaciente );
            $this->db->order_by("fecha", "DESC");
            $this->db->limit(1);
            $this->db->update('covid_paciente_historial');
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminarPaciente(){
        $this->db->db_debug = FALSE;
        $this->db->where("id_paciente", $this->idpaciente);
        if ($this->db->delete('covid_paciente_historial')) {
            $this->db->db_debug = FALSE;
            $this->db->where("id_paciente", $this->idpaciente);
            $this->db->delete('covid_paciente');
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminarPaciente_New(){
        $this->db->set("activo", 0, TRUE);
        $this->db->where("id_paciente", $this->idpaciente );
        if($this->db->update('covid_paciente_new')) {
            return 1;
        }
        else {
            return 0;
        }
    }
}