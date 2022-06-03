<?php 

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Paciente_model extends CI_Model
{
    private $id;
    private $emergencias_registro_id;
    private $Tipo_Documento_Codigo;
    private $Documento_Numero;
    private $apellidos;
    private $nombres;
    private $edad;
    private $sexo;
    private $gestante;
    private $peso;
    private $talla;
    private $fecha_inicio_sintomas;
    private $fecha_ingreso_hospital;
    private $fecha_ingreso_uci;
    private $DM;
    private $HTA;
    private $ERC;
    private $VIH;
    private $LES;
    private $asma;
    private $TBC;
    private $NM;
    private $otros;
    private $EDAs;
    private $EDAs_dias;
    private $resfrio;
    private $resfrio_dias;
    private $vacunas;
    private $vacunas_nombres;
    private $emergencia_horas;
    private $emergencia_dias;
    private $VMI;
    private $VMI_horas;
    private $VMI_dias;
    private $dolor_articular;
    private $dismunicion_fuerza_superior;
    private $dismunicion_fuerza_inferior;
    private $dificultad_respiratoria;
    private $dolor_extremidades;
    private $dificultad_marcha;
    private $cuadriplejia;
    private $escala_hughes;
    private $escala_glasgow;
    private $uci_habitual;
    private $uci_habitual_cama;
    private $uci_contingencia;
    private $uci_contingencia_cama;
    private $PAS;
    private $PAD;
    private $FC;
    private $FR;
    private $SO2;
    private $FIO2;
    private $T;
    private $vasopresores_inotropicos;
    private $vasopresores_inotropicos_tipo;
    private $ROT;
    private $fuerza_muscular;
    private $glasgow;
    private $electromiografia;
    private $electromiografia_fecha;
    private $electromiografia_conclusion_1;
    private $electromiografia_conclusion_2;
    private $electromiografia_velocidad;
    private $puncion_lumbar;
    private $puncion_lumbar_fecha;
    private $puncion_lumbar_envio;
    private $tipificacion_viral;
    private $tipificacion_viral_fecha;
    private $tipificacion_viral_envio;
    private $tipificacion_bacteriana;
    private $tipificacion_bacteriana_fecha;
    private $tipificacion_bacteriana_envio;
    private $isopado_orofaringia;
    private $isopado_orofaringia_fecha;
    private $isopado_orofaringia_envio;
    private $examen_heces;
    private $examen_heces_fecha;
    private $examen_heces_envio;
    private $Na;
    private $K;
    private $Cl;
    private $P;
    private $Ca;
    private $cie10_1;
    private $cie10_1_presuntivo;
    private $cie10_1_definitivo;
    private $cie10_2;
    private $cie10_2_presuntivo;
    private $cie10_2_definitivo;
    private $cie10_3;
    private $cie10_3_presuntivo;
    private $cie10_3_definitivo;
    private $inmunoglobulina;
    private $inmunoglobulina_frascos;
    private $inmunoglobulina_dias;
    private $inmunoglobulina_reacciones;
    private $plasmaferesis_albumina;
    private $plasmaferesis_albumina_frascos;
    private $plasmaferesis_albumina_dias;
    private $plasmaferesis_albumina_reacciones;
    private $plasmaferesis_PFC;
    private $plasmaferesis_PFC_frascos;
    private $plasmaferesis_PFC_dias;
    private $plasmaferesis_PFC_reacciones;
    private $Apache_II;
    private $SOFA;
    private $fecha_caf;
    private $fecha_intubacion;
    private $dias_uci;
    private $dias_VMI;
    private $modo_ventilatorio;
    private $modo_ventilatorio_fecha;
    private $destete_horas;
    private $destete_dias;
    private $traqueostomia;
    private $traqueostomia_fecha;
    private $fecha_extubacion;
    private $destino_alta_uci;
    private $condicion_paciente;
    public function setId($data) { $this->id = $this->db->escape_str($data); }
    public function setemergencias_registro_id($data) { $this->emergencias_registro_id = $this->db->escape_str($data); }
    public function setTipo_Documento_Codigo($data) { $this->Tipo_Documento_Codigo = $this->db->escape_str($data); }
    public function setDocumento_Numero($data) { $this->Documento_Numero = $this->db->escape_str($data); }
    public function setapellidos($data) { $this->apellidos = $this->db->escape_str($data); }
    public function setnombres($data) { $this->nombres = $this->db->escape_str($data); }
    public function setedad($data) { $this->edad = $this->db->escape_str($data); }
    public function setsexo($data) { $this->sexo = $this->db->escape_str($data); }
    public function setgestante($data) { $this->gestante = $this->db->escape_str($data); }
    public function setpeso($data) { $this->peso = $this->db->escape_str($data); }
    public function settalla($data) { $this->talla = $this->db->escape_str($data); }
    public function setfecha_inicio_sintomas($data) { $this->fecha_inicio_sintomas = $this->db->escape_str($data); }
    public function setfecha_ingreso_hospital($data) { $this->fecha_ingreso_hospital = $this->db->escape_str($data); }
    public function setfecha_ingreso_uci($data) { $this->fecha_ingreso_uci = $this->db->escape_str($data); }
    public function setDM($data) { $this->DM = $this->db->escape_str($data); }
    public function setHTA($data) { $this->HTA = $this->db->escape_str($data); }
    public function setERC($data) { $this->ERC = $this->db->escape_str($data); }
    public function setVIH($data) { $this->VIH = $this->db->escape_str($data); }
    public function setLES($data) { $this->LES = $this->db->escape_str($data); }
    public function setasma($data) { $this->asma = $this->db->escape_str($data); }
    public function setTBC($data) { $this->TBC = $this->db->escape_str($data); }
    public function setNM($data) { $this->NM = $this->db->escape_str($data); }
    public function setotros($data) { $this->otros = $this->db->escape_str($data); }
    public function setEDAs($data) { $this->EDAs = $this->db->escape_str($data); }
    public function setEDAs_dias($data) { $this->EDAs_dias = $this->db->escape_str($data); }
    public function setresfrio($data) { $this->resfrio = $this->db->escape_str($data); }
    public function setresfrio_dias($data) { $this->resfrio_dias = $this->db->escape_str($data); }
    public function setvacunas($data) { $this->vacunas = $this->db->escape_str($data); }
    public function setvacunas_nombres($data) { $this->vacunas_nombres = $this->db->escape_str($data); }
    public function setemergencia_horas($data) { $this->emergencia_horas = $this->db->escape_str($data); }
    public function setemergencia_dias($data) { $this->emergencia_dias = $this->db->escape_str($data); }
    public function setVMI($data) { $this->VMI = $this->db->escape_str($data); }
    public function setVMI_horas($data) { $this->VMI_horas = $this->db->escape_str($data); }
    public function setVMI_dias($data) { $this->VMI_dias = $this->db->escape_str($data); }
    public function setdolor_articular($data) { $this->dolor_articular = $this->db->escape_str($data); }
    public function setdismunicion_fuerza_superior($data) { $this->dismunicion_fuerza_superior = $this->db->escape_str($data); }
    public function setdismunicion_fuerza_inferior($data) { $this->dismunicion_fuerza_inferior = $this->db->escape_str($data); }
    public function setdificultad_respiratoria($data) { $this->dificultad_respiratoria = $this->db->escape_str($data); }
    public function setdolor_extremidades($data) { $this->dolor_extremidades = $this->db->escape_str($data); }
    public function setdificultad_marcha($data) { $this->dificultad_marcha = $this->db->escape_str($data); }
    public function setcuadriplejia($data) { $this->cuadriplejia = $this->db->escape_str($data); }
    public function setescala_hughes($data) { $this->escala_hughes = $this->db->escape_str($data); }
    public function setescala_glasgow($data) { $this->escala_glasgow = $this->db->escape_str($data); }
    public function setuci_habitual($data) { $this->uci_habitual = $this->db->escape_str($data); }
    public function setuci_habitual_cama($data) { $this->uci_habitual_cama = $this->db->escape_str($data); }
    public function setuci_contingencia($data) { $this->uci_contingencia = $this->db->escape_str($data); }
    public function setuci_contingencia_cama($data) { $this->uci_contingencia_cama = $this->db->escape_str($data); }
    public function setPAS($data) { $this->PAS = $this->db->escape_str($data); }
    public function setPAD($data) { $this->PAD = $this->db->escape_str($data); }
    public function setFC($data) { $this->FC = $this->db->escape_str($data); }
    public function setFR($data) { $this->FR = $this->db->escape_str($data); }
    public function setSO2($data) { $this->SO2 = $this->db->escape_str($data); }
    public function setFIO2($data) { $this->FIO2 = $this->db->escape_str($data); }
    public function setT($data) { $this->T = $this->db->escape_str($data); }
    public function setvasopresores_inotropicos($data) { $this->vasopresores_inotropicos = $this->db->escape_str($data); }
    public function setvasopresores_inotropicos_tipo($data) { $this->vasopresores_inotropicos_tipo = $this->db->escape_str($data); }
    public function setROT($data) { $this->ROT = $this->db->escape_str($data); }
    public function setfuerza_muscular($data) { $this->fuerza_muscular = $this->db->escape_str($data); }
    public function setglasgow($data) { $this->glasgow = $this->db->escape_str($data); }
    public function setelectromiografia($data) { $this->electromiografia = $this->db->escape_str($data); }
    public function setelectromiografia_fecha($data) { $this->electromiografia_fecha = $this->db->escape_str($data); }
    public function setelectromiografia_conclusion_1($data) { $this->electromiografia_conclusion_1 = $this->db->escape_str($data); }
    public function setelectromiografia_conclusion_2($data) { $this->electromiografia_conclusion_2 = $this->db->escape_str($data); }
    public function setelectromiografia_velocidad($data) { $this->electromiografia_velocidad = $this->db->escape_str($data); }
    public function setpuncion_lumbar($data) { $this->puncion_lumbar = $this->db->escape_str($data); }
    public function setpuncion_lumbar_fecha($data) { $this->puncion_lumbar_fecha = $this->db->escape_str($data); }
    public function setpuncion_lumbar_envio($data) { $this->puncion_lumbar_envio = $this->db->escape_str($data); }
    public function settipificacion_viral($data) { $this->tipificacion_viral = $this->db->escape_str($data); }
    public function settipificacion_viral_fecha($data) { $this->tipificacion_viral_fecha = $this->db->escape_str($data); }
    public function settipificacion_viral_envio($data) { $this->tipificacion_viral_envio = $this->db->escape_str($data); }
    public function settipificacion_bacteriana($data) { $this->tipificacion_bacteriana = $this->db->escape_str($data); }
    public function settipificacion_bacteriana_fecha($data) { $this->tipificacion_bacteriana_fecha = $this->db->escape_str($data); }
    public function settipificacion_bacteriana_envio($data) { $this->tipificacion_bacteriana_envio = $this->db->escape_str($data); }
    public function setisopado_orofaringia($data) { $this->isopado_orofaringia = $this->db->escape_str($data); }
    public function setisopado_orofaringia_fecha($data) { $this->isopado_orofaringia_fecha = $this->db->escape_str($data); }
    public function setisopado_orofaringia_envio($data) { $this->isopado_orofaringia_envio = $this->db->escape_str($data); }
    public function setexamen_heces($data) { $this->examen_heces = $this->db->escape_str($data); }
    public function setexamen_heces_fecha($data) { $this->examen_heces_fecha = $this->db->escape_str($data); }
    public function setexamen_heces_envio($data) { $this->examen_heces_envio = $this->db->escape_str($data); }
    public function setNa($data) { $this->Na = $this->db->escape_str($data); }
    public function setK($data) { $this->K = $this->db->escape_str($data); }
    public function setCl($data) { $this->Cl = $this->db->escape_str($data); }
    public function setP($data) { $this->P = $this->db->escape_str($data); }
    public function setCa($data) { $this->Ca = $this->db->escape_str($data); }
    public function setcie10_1($data) { $this->cie10_1 = $this->db->escape_str($data); }
    public function setcie10_1_presuntivo($data) { $this->cie10_1_presuntivo = $this->db->escape_str($data); }
    public function setcie10_1_definitivo($data) { $this->cie10_1_definitivo = $this->db->escape_str($data); }
    public function setcie10_2($data) { $this->cie10_2 = $this->db->escape_str($data); }
    public function setcie10_2_presuntivo($data) { $this->cie10_2_presuntivo = $this->db->escape_str($data); }
    public function setcie10_2_definitivo($data) { $this->cie10_2_definitivo = $this->db->escape_str($data); }
    public function setcie10_3($data) { $this->cie10_3 = $this->db->escape_str($data); }
    public function setcie10_3_presuntivo($data) { $this->cie10_3_presuntivo = $this->db->escape_str($data); }
    public function setcie10_3_definitivo($data) { $this->cie10_3_definitivo = $this->db->escape_str($data); }
    public function setinmunoglobulina($data) { $this->inmunoglobulina = $this->db->escape_str($data); }
    public function setinmunoglobulina_frascos($data) { $this->inmunoglobulina_frascos = $this->db->escape_str($data); }
    public function setinmunoglobulina_dias($data) { $this->inmunoglobulina_dias = $this->db->escape_str($data); }
    public function setinmunoglobulina_reacciones($data) { $this->inmunoglobulina_reacciones = $this->db->escape_str($data); }
    public function setplasmaferesis_albumina($data) { $this->plasmaferesis_albumina = $this->db->escape_str($data); }
    public function setplasmaferesis_albumina_frascos($data) { $this->plasmaferesis_albumina_frascos = $this->db->escape_str($data); }
    public function setplasmaferesis_albumina_dias($data) { $this->plasmaferesis_albumina_dias = $this->db->escape_str($data); }
    public function setplasmaferesis_albumina_reacciones($data) { $this->plasmaferesis_albumina_reacciones = $this->db->escape_str($data); }
    public function setplasmaferesis_PFC($data) { $this->plasmaferesis_PFC = $this->db->escape_str($data); }
    public function setplasmaferesis_PFC_frascos($data) { $this->plasmaferesis_PFC_frascos = $this->db->escape_str($data); }
    public function setplasmaferesis_PFC_dias($data) { $this->plasmaferesis_PFC_dias = $this->db->escape_str($data); }
    public function setplasmaferesis_PFC_reacciones($data) { $this->plasmaferesis_PFC_reacciones = $this->db->escape_str($data); }
    public function setApache_II($data) { $this->Apache_II = $this->db->escape_str($data); }
    public function setSOFA($data) { $this->SOFA = $this->db->escape_str($data); }
    public function setfecha_caf($data) { $this->fecha_caf = $this->db->escape_str($data); }
    public function setfecha_intubacion($data) { $this->fecha_intubacion = $this->db->escape_str($data); }
    public function setdias_uci($data) { $this->dias_uci = $this->db->escape_str($data); }
    public function setdias_VMI($data) { $this->dias_VMI = $this->db->escape_str($data); }
    public function setmodo_ventilatorio($data) { $this->modo_ventilatorio = $this->db->escape_str($data); }
    public function setmodo_ventilatorio_fecha($data) { $this->modo_ventilatorio_fecha = $this->db->escape_str($data); }
    public function setdestete_horas($data) { $this->destete_horas = $this->db->escape_str($data); }
    public function setdestete_dias($data) { $this->destete_dias = $this->db->escape_str($data); }
    public function settraqueostomia($data) { $this->traqueostomia = $this->db->escape_str($data); }
    public function settraqueostomia_fecha($data) { $this->traqueostomia_fecha = $this->db->escape_str($data); }
    public function setfecha_extubacion($data) { $this->fecha_extubacion = $this->db->escape_str($data); }
    public function setdestino_alta_uci($data) { $this->destino_alta_uci = $this->db->escape_str($data); }
    public function setcondicion_paciente($data) { $this->condicion_paciente = $this->db->escape_str($data); }
    public function listar() {
        $this->db->select("emergencias_registro_atenciones.emergencias_registro_atenciones_id As ID");
        $this->db->select("emergencias_registro_atenciones.emergencias_registro_id as IDE");
        $this->db->select("emergencias_registro_atenciones.Tipo_Documento_Codigo");
        $this->db->select("tipo_documento.Tipo_Documento_Nombre As 'Tipo_Documento'");
        $this->db->select("emergencias_registro_atenciones.Documento_Numero as 'Num_Documento'");
        $this->db->select("emergencias_registro_atenciones.apellidos as Apellidos");
        $this->db->select("emergencias_registro_atenciones.nombres as Nombres");
        $this->db->select("emergencias_registro_atenciones.edad as Edad");
        $this->db->select("(case emergencias_registro_atenciones.sexo when '1' Then 'HOMBRE' when '2' then 'MUJER' end) As Genero");
        $this->db->select("(case emergencias_registro_atenciones.sexo when '1' Then '[--]' When '2' then ((case emergencias_registro_atenciones.gestante when '1' Then 'SI' when '0' then 'NO' end)) end) As Gestante");
        $this->db->select("emergencias_registro_atenciones.peso As Peso");
        $this->db->select("emergencias_registro_atenciones.talla As Talla");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.fecha_inicio_sintomas, '%d/%m/%Y') As 'Inicio_Sintomas'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.fecha_ingreso_hospital, '%d/%m/%Y') As 'Ingreso_Hospital'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.fecha_ingreso_uci, '%d/%m/%Y') As 'Ingreso_UCI'");
        $this->db->select("(case emergencias_registro_atenciones.DM when '1' Then 'SI' when '0' then 'NO' end) As DM");
        $this->db->select("(case emergencias_registro_atenciones.HTA when '1' Then 'SI' when '0' then 'NO' end) As HTA");
        $this->db->select("(case emergencias_registro_atenciones.ERC when '1' Then 'SI' when '0' then 'NO' end) As ERC");
        $this->db->select("(case emergencias_registro_atenciones.VIH when '1' Then 'SI' when '0' then 'NO' end) As VIH");
        $this->db->select("(case emergencias_registro_atenciones.LES when '1' Then 'SI' when '0' then 'NO' end) As LES");
        $this->db->select("(case emergencias_registro_atenciones.asma when '1' Then 'SI' when '0' then 'NO' end) As ASMA");
        $this->db->select("(case emergencias_registro_atenciones.TBC when '1' Then 'SI' when '0' then 'NO' end) As TBC");
        $this->db->select("(case emergencias_registro_atenciones.NM when '1' Then 'SI' when '0' then 'NO' end) As NM");
        $this->db->select("Upper(emergencias_registro_atenciones.Otros) As Otros");
        $this->db->select("(case emergencias_registro_atenciones.EDAs when '1' Then 'SI' when '0' then 'NO' end) As EDAs");
        $this->db->select("emergencias_registro_atenciones.EDAs_dias As 'Dias_EDAs'");
        $this->db->select("(case emergencias_registro_atenciones.resfrio when '1' Then 'SI' when '0' then 'NO' end) As Resfrio");
        $this->db->select("emergencias_registro_atenciones.resfrio_dias as 'Dias_Resfrio'");
        $this->db->select("(case emergencias_registro_atenciones.vacunas when '1' Then 'SI' when '0' then 'NO' end) As Vacunas");
        $this->db->select("emergencias_registro_atenciones.vacunas_nombres As 'Detalle_Vacunas'");
        $this->db->select("emergencias_registro_atenciones.emergencia_horas As 'Estancia_Horas'");
        $this->db->select("emergencias_registro_atenciones.emergencia_dias As 'Estancia_Dias'");
        $this->db->select("(case emergencias_registro_atenciones.VMI when '1' Then 'SI' when '0' then 'NO' end) As VMI");
        $this->db->select("emergencias_registro_atenciones.VMI_horas As 'VMI_Horas'");
        $this->db->select("emergencias_registro_atenciones.VMI_dias As 'VMI_Dias'");
        $this->db->select("(case emergencias_registro_atenciones.dolor_articular when '1' Then 'SI' when '0' then 'NO' end) As 'Dolor_Articular'");
        $this->db->select("(case emergencias_registro_atenciones.dismunicion_fuerza_superior when '1' Then 'SI' when '0' then 'NO' end) As 'DFM_Miembros_Superiores'");
        $this->db->select("(case emergencias_registro_atenciones.dismunicion_fuerza_inferior when '1' Then 'SI' when '0' then 'NO' end) As 'DFM_Miembros_Inferiores'");
        $this->db->select("(case emergencias_registro_atenciones.dificultad_respiratoria when '1' Then 'SI' when '0' then 'NO' end) As 'Dificultad_Respiratoria'");
        $this->db->select("(case emergencias_registro_atenciones.dolor_extremidades when '1' Then 'SI' when '0' then 'NO' end) As 'Dolor_Extremidades'");
        $this->db->select("(case emergencias_registro_atenciones.dificultad_marcha when '1' Then 'SI' when '0' then 'NO' end) As 'Dificultad_Marcha'");
        $this->db->select("(case emergencias_registro_atenciones.cuadriplejia when '1' Then 'SI' when '0' then 'NO' end) As 'Cuadriplejia'");
        $this->db->select("(case emergencias_registro_atenciones.escala_hughes
                            when '1' Then 'I. El paciente deambula en forma ilimitada,  tiene capacidad para correr y presenta signos menores de compromiso motor'
                            when '2' then 'II. Capacidad de caminar por lo menos 5 metros sin ayudas externas pero con incapacidad para correr'
                            when '3' then 'III. Capacidad de realizar marcha de por lo menos 5 metros con ayudas externas. (Caminador o asistencia de otra persona)'
                            when '4' then 'IV. Paciente en cama o en silla sin capacidad para realizar marcha'
                            when '5' then 'V. Apoyo ventilatorio permanente o por algunas horas al d�a'
                            when '6' then 'VI. Muerte' end) As 'Escala_Hughes'");
        $this->db->select("emergencias_registro_atenciones.escala_glasgow As Glasgow");
        $this->db->select("(case emergencias_registro_atenciones.uci_habitual when '1' Then 'SI' when '0' then 'NO' end) As 'UCI_Habitual'");
        $this->db->select("emergencias_registro_atenciones.uci_habitual_cama As 'Cama_UCIH'");
        $this->db->select("(case emergencias_registro_atenciones.uci_contingencia when '1' Then 'SI' when '0' then 'NO' end) As 'UCI_Contingencia'");
        $this->db->select("emergencias_registro_atenciones.uci_contingencia_cama As 'Cama_UCIC'");
        $this->db->select("concat_ws('/',  emergencias_registro_atenciones.PAS,  emergencias_registro_atenciones.PAD) As PA");
        $this->db->select("emergencias_registro_atenciones.FC");
        $this->db->select("emergencias_registro_atenciones.FR");
        $this->db->select("emergencias_registro_atenciones.SO2");
        $this->db->select("emergencias_registro_atenciones.FIO2");
        $this->db->select("concat_ws('�C',  emergencias_registro_atenciones.T) As T");
        $this->db->select("(case emergencias_registro_atenciones.vasopresores_inotropicos when '0' Then 'NO' When '1' Then 'SI' end) As 'Vasopresores_o_Inotropicos'");
        $this->db->select("IFNull((case emergencias_registro_atenciones.vasopresores_inotropicos_tipo
                            When '1' Then 'Noradrenalina'
                            When '2' Then 'Adrenalina'
                            When '3' Then 'Dopamina'
                            When '4' Then 'Vasopresina'
                            When '5' Then 'Dobutamina'
                            When '6' Then 'Desmedetomedina' end), '[N/A]') As 'Tipo_Vas_Inot'");
        $this->db->select("(case emergencias_registro_atenciones.ROT When '0' Then '[N/A]' When '1' Then 'Arreflexia' When '2' Then 'Iporeflexia' end) As ROT");
        $this->db->select("(case emergencias_registro_atenciones.fuerza_muscular  When '0' Then '[N/A]' When '1' Then 'Dismunuido' When '2' Then 'Consevado' end) As 'Fuerza_Muscular'");
        $this->db->select("emergencias_registro_atenciones.glasgow As 'Escala_Glasgow'");
        $this->db->select("(case emergencias_registro_atenciones.electromiografia When '0' Then 'NO' When '1' Then 'SI' end) As Electromiografia");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.electromiografia_fecha, '%d/%m/%Y') As 'Fecha_Elect'");
        $this->db->select("emergencias_registro_atenciones.electromiografia_conclusion_1 As 'Conclusion_1'");
        $this->db->select("emergencias_registro_atenciones.electromiografia_conclusion_2 As 'Conclusion_2'");
        $this->db->select("emergencias_registro_atenciones.electromiografia_velocidad as Velocidad");
        $this->db->select("(case emergencias_registro_atenciones.puncion_lumbar when '0' then 'NO' when '1' then 'SI' end) as 'Puncion_Lumbar'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.puncion_lumbar_fecha, '%d/%m/%Y') As 'Fecha_PL'");
        $this->db->select("(case emergencias_registro_atenciones.puncion_lumbar_envio when '0' then 'NO' when '1' then 'SI' end) as 'PL_Enviado'");
        $this->db->select("(case emergencias_registro_atenciones.tipificacion_viral when '0' then 'NO' when '1' then 'SI' end) as 'Tipificacion_Viral'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.tipificacion_viral_fecha, '%d/%m/%Y') As 'Fecha_TV'");
        $this->db->select("(case emergencias_registro_atenciones.tipificacion_viral_envio when '0' then 'NO' when '1' then 'SI' end) as 'TV_Enviado'");
        $this->db->select("(case emergencias_registro_atenciones.tipificacion_bacteriana when '0' then 'NO' when '1' then 'SI' end) as 'Tipifacion_Bacteriana'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.tipificacion_bacteriana_fecha, '%d/%m/%Y') As 'Fecha_PB'");
        $this->db->select("(case emergencias_registro_atenciones.tipificacion_bacteriana_envio when '0' then 'NO' when '1' then 'SI' end) as 'PB_Enviado'");
        $this->db->select("(case emergencias_registro_atenciones.isopado_orofaringia when '0' then 'NO' when '1' then 'SI' end) as 'Isopado_Orofaringia'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.isopado_orofaringia_fecha, '%d/%m/%Y') As 'Fecha_IO'");
        $this->db->select("(case emergencias_registro_atenciones.isopado_orofaringia_envio when '0' then 'NO' when '1' then 'SI' end) as 'IO_Enviado'");
        $this->db->select("(case emergencias_registro_atenciones.examen_heces when '0' then 'NO' when '1' then 'SI' end) as 'Examen_Heces'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.examen_heces_fecha, '%d/%m/%Y') As 'Fecha_EH'");
        $this->db->select("(case emergencias_registro_atenciones.examen_heces_envio when '0' then 'NO' when '1' then 'SI' end) as 'EH_Enviado'");
        $this->db->select("emergencias_registro_atenciones.Na");
        $this->db->select("emergencias_registro_atenciones.K");
        $this->db->select("emergencias_registro_atenciones.Cl");
        $this->db->select("emergencias_registro_atenciones.P");
        $this->db->select("emergencias_registro_atenciones.Ca");
        $this->db->select("emergencias_registro_atenciones.cie10_1 As 'CIE10A'");
        $this->db->select("(case emergencias_registro_atenciones.cie10_1_presuntivo When '0' Then 'NO' When '1' Then 'SI' end) As 'CIE10A_Presuntivo'");
        $this->db->select("(case emergencias_registro_atenciones.cie10_1_definitivo When '0' Then 'NO' When '1' Then 'SI' end) As 'CIE10A_Definitivo'");
        $this->db->select("emergencias_registro_atenciones.cie10_2 As 'CIE10B'");
        $this->db->select("(case emergencias_registro_atenciones.cie10_2_presuntivo When '0' Then 'NO' When '1' Then 'SI' end) As 'CIE10B_Presuntivo'");
        $this->db->select("(case emergencias_registro_atenciones.cie10_2_definitivo When '0' Then 'NO' When '1' Then 'SI' end) As 'CIE10B_Definitivo'");
        $this->db->select("emergencias_registro_atenciones.cie10_3 As 'CIE10C'");
        $this->db->select("(case emergencias_registro_atenciones.cie10_3_presuntivo When '0' Then 'NO' When '1' Then 'SI' end) As 'CIE10C_Presuntivo'");
        $this->db->select("(case emergencias_registro_atenciones.cie10_3_definitivo When '0' Then 'NO' When '1' Then 'SI' end) As 'CIE10C_Definitivo'");
        $this->db->select("(case emergencias_registro_atenciones.inmunoglobulina When '0' Then 'NO' When '1' Then 'SI' end) As 'Inmunoglobulina'");
        $this->db->select("emergencias_registro_atenciones.inmunoglobulina_frascos As 'I_Frascos'");
        $this->db->select("emergencias_registro_atenciones.inmunoglobulina_dias As 'I_Dias'");
        $this->db->select("emergencias_registro_atenciones.inmunoglobulina_reacciones As 'I_Reacciones_Adversas'");
        $this->db->select("(case emergencias_registro_atenciones.plasmaferesis_albumina When '0' Then 'NO' When '1' Then 'NO' end) As 'Plasmaferesis_Albunina'");
        $this->db->select("emergencias_registro_atenciones.plasmaferesis_albumina_frascos As 'P_A_Frascos'");
        $this->db->select("emergencias_registro_atenciones.plasmaferesis_albumina_dias As 'P_A_Dias'");
        $this->db->select("emergencias_registro_atenciones.plasmaferesis_albumina_reacciones As 'P_A_Reacciones_Adversas'");
        $this->db->select("IFNull ((case emergencias_registro_atenciones.plasmaferesis_PFC When '0' Then 'NO' When '1' Then 'SI' end), '[N/A]') As 'Plasmaferesis_PFC'");
        $this->db->select("emergencias_registro_atenciones.plasmaferesis_PFC_frascos As 'P_PFC_Frascos'");
        $this->db->select("emergencias_registro_atenciones.plasmaferesis_PFC_dias 'P_PFC_Dias'");
        $this->db->select("emergencias_registro_atenciones.plasmaferesis_PFC_reacciones 'P_PFC_Reacciones_Adversas'");
        $this->db->select("emergencias_registro_atenciones.Apache_II As 'Apache_II'");
        $this->db->select("emergencias_registro_atenciones.SOFA");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.fecha_caf, '%d/%m/%Y') As 'Fecha_CAF'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.fecha_intubacion, '%d/%m/%Y') As 'Fecha_Intubacion'");
        $this->db->select("emergencias_registro_atenciones.dias_uci As 'Dias_en_UCI'");
        $this->db->select("emergencias_registro_atenciones.dias_VMI As 'Dias_en_VMI'");
        $this->db->select("(case emergencias_registro_atenciones.modo_ventilatorio When '1' Then 'SIMV' When '2' Then 'CPAP' When '3' Then 'PCV' When '4' Then 'SIMV-V' When '5' Then 'SIMV-P' When '6' Then 'Otro' end) As 'Modo_Ventilatorio'");
        $this->db->select("emergencias_registro_atenciones.modo_ventilatorio_fecha");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.modo_ventilatorio_fecha, '%d/%m/%Y') As 'Fecha_Modo_Ventilatorio'");
        $this->db->select("emergencias_registro_atenciones.destete_horas As 'Horas_Destete'");
        $this->db->select("emergencias_registro_atenciones.destete_dias As 'Dias_Destete'");
        $this->db->select("(case emergencias_registro_atenciones.traqueostomia When '1' Then 'SI' When '0' Then 'NO' end) As Traqueostomia");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.traqueostomia_fecha, '%d/%m/%Y') As 'Fecha_Traqueostomia'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.fecha_extubacion, '%d/%m/%Y') As 'Fecha_Extubacion'");
        $this->db->select("IfNull((case emergencias_registro_atenciones.destino_alta_uci When '1' Then 'UCIN' When '2' Then 'Hospitalizacion' end), 'N/A') As 'Destino_Alta_UCI'");
        $this->db->select("(case emergencias_registro_atenciones.condicion_paciente When '1' Then 'Fallecido'  When '2' Then 'Recuperado' When '3' Then 'Curado' end) As 'Condicion_Paciente'");
        $this->db->select("DATE_FORMAT(emergencias_registro_atenciones.fecha_actualizacion, '%d/%m/%Y') As 'Ultima_Actualizacion'");
        $this->db->from("emergencias_registro_atenciones");
        $this->db->join("emergencias_registro","emergencias_registro.emergencias_registro_id=emergencias_registro_atenciones.emergencias_registro_id");
        $this->db->join("tipo_documento","tipo_documento.Tipo_Documento_Codigo=emergencias_registro_atenciones.Tipo_Documento_Codigo");
        $this->db->where("emergencias_registro_atenciones.emergencias_registro_id", $this->emergencias_registro_id);
        return $this->db->get();
    }
    public function paciente() {
        $this->db->select("emergencias_registro_atenciones_id id,emergencias_registro_id,Tipo_Documento_Codigo,Documento_Numero,apellidos,nombres,edad,sexo,gestante,peso,talla");
        $this->db->select("DATE_FORMAT(fecha_inicio_sintomas,'%d/%m/%Y') fecha_inicio_sintomas,DATE_FORMAT(fecha_ingreso_hospital,'%d/%m/%Y') fecha_ingreso_hospital,DATE_FORMAT(fecha_ingreso_uci,'%d/%m/%Y') fecha_ingreso_uci,DM,HTA,ERC,VIH,LES,asma,TBC,NM,otros,EDAs");
        $this->db->select("EDAs_dias,resfrio,resfrio_dias,vacunas,vacunas_nombres,emergencia_horas,emergencia_dias,VMI,VMI_horas,VMI_dias,dolor_articular,dismunicion_fuerza_superior");
        $this->db->select("dismunicion_fuerza_inferior,dificultad_respiratoria,dolor_extremidades,dificultad_marcha,cuadriplejia,escala_hughes,escala_glasgow,uci_habitual");
        $this->db->select("uci_habitual_cama,uci_contingencia,uci_contingencia_cama,PAS,PAD,FC,FR,SO2,FIO2,T,vasopresores_inotropicos,vasopresores_inotropicos_tipo");
        $this->db->select("ROT,fuerza_muscular,glasgow,electromiografia,DATE_FORMAT(electromiografia_fecha,'%d/%m/%Y') electromiografia_fecha,electromiografia_conclusion_1,electromiografia_conclusion_2");
        $this->db->select("electromiografia_velocidad,puncion_lumbar,DATE_FORMAT(puncion_lumbar_fecha,'%d/%m/%Y') puncion_lumbar_fecha,puncion_lumbar_envio,tipificacion_viral,DATE_FORMAT(tipificacion_viral_fecha,'%d/%m/%Y') tipificacion_viral_fecha");
        $this->db->select("tipificacion_viral_envio,tipificacion_bacteriana,DATE_FORMAT(tipificacion_bacteriana_fecha,'%d/%m/%Y') tipificacion_bacteriana_fecha,tipificacion_bacteriana_envio,isopado_orofaringia");
        $this->db->select("DATE_FORMAT(isopado_orofaringia_fecha,'%d/%m/%Y') isopado_orofaringia_fecha,isopado_orofaringia_envio,examen_heces,DATE_FORMAT(examen_heces_fecha,'%d/%m/%Y') examen_heces_fecha,examen_heces_envio,Na,K,Cl,P,Ca,cie10_1,cie10_1_presuntivo");
        $this->db->select("cie10_1_definitivo,cie10_2,cie10_2_presuntivo,cie10_2_definitivo,cie10_3,cie10_3_presuntivo,cie10_3_definitivo,inmunoglobulina");
        $this->db->select("inmunoglobulina_frascos,inmunoglobulina_dias,inmunoglobulina_reacciones,plasmaferesis_albumina,plasmaferesis_albumina_frascos");
        $this->db->select("plasmaferesis_albumina_dias,plasmaferesis_albumina_reacciones,plasmaferesis_PFC,plasmaferesis_PFC_frascos,plasmaferesis_PFC_dias");
        $this->db->select("plasmaferesis_PFC_reacciones,Apache_II,SOFA,DATE_FORMAT(fecha_caf,'%d/%m/%Y') fecha_caf,DATE_FORMAT(fecha_intubacion,'%d/%m/%Y') fecha_intubacion,dias_uci,dias_VMI,modo_ventilatorio,DATE_FORMAT(modo_ventilatorio_fecha,'%d/%m/%Y') modo_ventilatorio_fecha");
        $this->db->select("destete_horas,destete_dias,traqueostomia,DATE_FORMAT(traqueostomia_fecha,'%d/%m/%Y') traqueostomia_fecha,DATE_FORMAT(fecha_extubacion,'%d/%m/%Y') fecha_extubacion,destino_alta_uci,condicion_paciente");
        $this->db->from("emergencias_registro_atenciones");
        $this->db->where("emergencias_registro_id", $this->emergencias_registro_id);
        $this->db->where("emergencias_registro_atenciones_id", $this->id);
        return $this->db->get();
    }
    public function buscar() {
        $this->db->select("emergencias_registro_atenciones_id id");
        $this->db->from("emergencias_registro_atenciones");
        $this->db->where("emergencias_registro_id", $this->emergencias_registro_id);
        $this->db->where("Documento_Numero", $this->Documento_Numero);
        return $this->db->get();
    }
    public function registrar() {
        $data = array(
        "emergencias_registro_id" => $this->emergencias_registro_id,
        "Tipo_Documento_Codigo" => $this->Tipo_Documento_Codigo,
        "Documento_Numero" => $this->Documento_Numero,
        "apellidos" => $this->apellidos,
        "nombres" => $this->nombres,
        "edad" => $this->edad,
        "sexo" => $this->sexo,
        "gestante" => $this->gestante,
        "peso" => $this->peso,
        "talla"=> $this->talla,
        "fecha_inicio_sintomas" => $this->fecha_inicio_sintomas,
        "fecha_ingreso_hospital" => $this->fecha_ingreso_hospital,
        "fecha_ingreso_uci" => $this->fecha_ingreso_uci,
        "DM" => $this->DM,
        "HTA" => $this->HTA,
        "ERC" => $this->ERC,
        "VIH" => $this->VIH,
        "LES" => $this->LES,
        "asma" => $this->asma,
        "TBC" => $this->TBC,
        "NM" => $this->NM,
        "otros" => $this->otros,
        "EDAs" => $this->EDAs,
        "EDAs_dias" => $this->EDAs_dias,
        "resfrio" => $this->resfrio,
        "resfrio_dias" => $this->resfrio_dias,
        "vacunas" => $this->vacunas,
        "vacunas_nombres" => $this->vacunas_nombres,
        "emergencia_horas" => $this->emergencia_horas,
        "emergencia_dias" => $this->emergencia_dias,
        "VMI" => $this->VMI,
        "VMI_horas" => $this->VMI_horas,
        "VMI_dias" => $this->VMI_dias,
        "dolor_articular" => $this->dolor_articular,
        "dismunicion_fuerza_superior" => $this->dismunicion_fuerza_superior,
        "dismunicion_fuerza_inferior" => $this->dismunicion_fuerza_inferior,
        "dificultad_respiratoria" => $this->dificultad_respiratoria,
        "dolor_extremidades" => $this->dolor_extremidades,
        "dificultad_marcha" => $this->dificultad_marcha,
        "cuadriplejia" => $this->cuadriplejia,
        "escala_hughes" => $this->escala_hughes,
        "escala_glasgow" => $this->escala_glasgow,
        "uci_habitual" => $this->uci_habitual,
        "uci_habitual_cama" => $this->uci_habitual_cama,
        "uci_contingencia" => $this->uci_contingencia,
        "uci_contingencia_cama" => $this->uci_contingencia_cama,
        "PAS" => $this->PAS,
        "PAD" => $this->PAD,
        "FC" => $this->FC,
        "FR" => $this->FR,
        "SO2" => $this->SO2,
        "FIO2" => $this->FIO2,
        "T" => $this->T,
        "vasopresores_inotropicos" => $this->vasopresores_inotropicos,
        "vasopresores_inotropicos_tipo" => $this->vasopresores_inotropicos_tipo,            
        "ROT" => $this->ROT,
        "fuerza_muscular" => $this->fuerza_muscular,
        "glasgow" => $this->glasgow,
        "electromiografia" => $this->electromiografia,
        "electromiografia_fecha" => $this->electromiografia_fecha,
        "electromiografia_conclusion_1" => $this->electromiografia_conclusion_1,
        "electromiografia_conclusion_2" => $this->electromiografia_conclusion_2,
        "electromiografia_velocidad" => $this->electromiografia_velocidad,
        "puncion_lumbar" => $this->puncion_lumbar,
        "puncion_lumbar_fecha" => $this->puncion_lumbar_fecha,
        "puncion_lumbar_envio" => $this->puncion_lumbar_envio,
        "tipificacion_viral" => $this->tipificacion_viral,
        "tipificacion_viral_fecha" => $this->tipificacion_viral_fecha,
        "tipificacion_viral_envio" => $this->tipificacion_viral_envio,
        "tipificacion_bacteriana" => $this->tipificacion_bacteriana,
        "tipificacion_bacteriana_fecha" => $this->tipificacion_bacteriana_fecha,
        "tipificacion_bacteriana_envio" => $this->tipificacion_bacteriana_envio,
        "isopado_orofaringia" => $this->isopado_orofaringia,
        "isopado_orofaringia_fecha" => $this->isopado_orofaringia_fecha,
        "isopado_orofaringia_envio" => $this->isopado_orofaringia_envio,
        "examen_heces" => $this->examen_heces,
        "examen_heces_fecha" => $this->examen_heces_fecha,
        "examen_heces_envio" => $this->examen_heces_envio,
        "Na" => $this->Na,
        "K" => $this->K,
        "Cl" => $this->Cl,
        "P" => $this->P,
        "Ca" => $this->Ca,
        "cie10_1" => $this->cie10_1,
        "cie10_1_presuntivo" => $this->cie10_1_presuntivo,
        "cie10_1_definitivo" => $this->cie10_1_definitivo,
        "cie10_2" => $this->cie10_2,
        "cie10_2_presuntivo" => $this->cie10_2_presuntivo,
        "cie10_2_definitivo" => $this->cie10_2_definitivo,
        "cie10_3" => $this->cie10_3,
        "cie10_3_presuntivo" => $this->cie10_3_presuntivo,
        "cie10_3_definitivo" => $this->cie10_3_definitivo,
        "inmunoglobulina" => $this->inmunoglobulina,
        "inmunoglobulina_frascos" => $this->inmunoglobulina_frascos,
        "inmunoglobulina_dias" => $this->inmunoglobulina_dias,
        "inmunoglobulina_reacciones" => $this->inmunoglobulina_reacciones,
        "plasmaferesis_albumina" => $this->plasmaferesis_albumina,
        "plasmaferesis_albumina_frascos" => $this->plasmaferesis_albumina_frascos,
        "plasmaferesis_albumina_dias" => $this->plasmaferesis_albumina_dias,
        "plasmaferesis_albumina_reacciones" => $this->plasmaferesis_albumina_reacciones,
        "plasmaferesis_PFC" => $this->plasmaferesis_PFC,
        "plasmaferesis_PFC_frascos" => $this->plasmaferesis_PFC_frascos,
        "plasmaferesis_PFC_dias" => $this->plasmaferesis_PFC_dias,
        "plasmaferesis_PFC_reacciones" => $this->plasmaferesis_PFC_reacciones,
        "Apache_II" => $this->Apache_II,
        "SOFA" => $this->SOFA,
        "fecha_caf" => $this->fecha_caf,
        "fecha_intubacion" => $this->fecha_intubacion,
        "dias_uci" => $this->dias_uci,
        "dias_VMI" => $this->dias_VMI,
        "modo_ventilatorio" => $this->modo_ventilatorio,
        "modo_ventilatorio_fecha" => $this->modo_ventilatorio_fecha,
        "destete_horas" => $this->destete_horas,
        "destete_dias" => $this->destete_dias,
        "traqueostomia" => $this->traqueostomia,
        "traqueostomia_fecha" => $this->traqueostomia_fecha,
        "fecha_extubacion" => $this->fecha_extubacion,
        "destino_alta_uci" => $this->destino_alta_uci,
        "condicion_paciente" => $this->condicion_paciente,
        "usuario_registro" => $this->session->userdata("idusuario"),
        "fecha_registro" => date("Y-m-d H:i:s"),
        "estado_registro" => "1"
        );
        if ($this->db->insert('emergencias_registro_atenciones', $data))
            return $this->db->insert_id();
            else
                return 0;
        
    }
    public function actualizar() {
        $this->db->db_debug = FALSE;
        $this->db->set("emergencias_registro_id", $this->emergencias_registro_id, TRUE);
        $this->db->set("Tipo_Documento_Codigo", $this->Tipo_Documento_Codigo, TRUE);
        $this->db->set("Documento_Numero", $this->Documento_Numero, TRUE);
        $this->db->set("apellidos", $this->apellidos, TRUE);
        $this->db->set("nombres", $this->nombres, TRUE);
        $this->db->set("edad", $this->edad, TRUE);
        $this->db->set("sexo", $this->sexo, TRUE);
        $this->db->set("gestante", $this->gestante, TRUE);
        $this->db->set("peso", $this->peso, TRUE);
        $this->db->set("talla",$this->talla, TRUE);
        $this->db->set("fecha_inicio_sintomas", $this->fecha_inicio_sintomas, TRUE);
        $this->db->set("fecha_ingreso_hospital", $this->fecha_ingreso_hospital, TRUE);
        $this->db->set("fecha_ingreso_uci", $this->fecha_ingreso_uci, TRUE);
        $this->db->set("DM", $this->DM, TRUE);
        $this->db->set("HTA", $this->HTA, TRUE);
        $this->db->set("ERC", $this->ERC, TRUE);
        $this->db->set("VIH", $this->VIH, TRUE);
        $this->db->set("LES", $this->LES, TRUE);
        $this->db->set("asma", $this->asma, TRUE);
        $this->db->set("TBC", $this->TBC, TRUE);
        $this->db->set("NM", $this->NM, TRUE);
        $this->db->set("otros", $this->otros, TRUE);
        $this->db->set("EDAs", $this->EDAs, TRUE);
        $this->db->set("EDAs_dias", $this->EDAs_dias, TRUE);
        $this->db->set("resfrio", $this->resfrio, TRUE);
        $this->db->set("resfrio_dias", $this->resfrio_dias, TRUE);
        $this->db->set("vacunas", $this->vacunas, TRUE);
        $this->db->set("vacunas_nombres", $this->vacunas_nombres, TRUE);
        $this->db->set("emergencia_horas", $this->emergencia_horas, TRUE);
        $this->db->set("emergencia_dias", $this->emergencia_dias, TRUE);
        $this->db->set("VMI", $this->VMI, TRUE);
        $this->db->set("VMI_horas", $this->VMI_horas, TRUE);
        $this->db->set("VMI_dias", $this->VMI_dias, TRUE);
        $this->db->set("dolor_articular", $this->dolor_articular, TRUE);
        $this->db->set("dismunicion_fuerza_superior", $this->dismunicion_fuerza_superior, TRUE);
        $this->db->set("dismunicion_fuerza_inferior", $this->dismunicion_fuerza_inferior, TRUE);
        $this->db->set("dificultad_respiratoria", $this->dificultad_respiratoria, TRUE);
        $this->db->set("dolor_extremidades", $this->dolor_extremidades, TRUE);
        $this->db->set("dificultad_marcha", $this->dificultad_marcha, TRUE);
        $this->db->set("cuadriplejia", $this->cuadriplejia, TRUE);
        $this->db->set("escala_hughes", $this->escala_hughes, TRUE);
        $this->db->set("escala_glasgow", $this->escala_glasgow, TRUE);
        $this->db->set("uci_habitual", $this->uci_habitual, TRUE);
        $this->db->set("uci_habitual_cama", $this->uci_habitual_cama, TRUE);
        $this->db->set("uci_contingencia", $this->uci_contingencia, TRUE);
        $this->db->set("uci_contingencia_cama", $this->uci_contingencia_cama, TRUE);
        $this->db->set("PAS", $this->PAS, TRUE);
        $this->db->set("PAD", $this->PAD, TRUE);
        $this->db->set("FC", $this->FC, TRUE);
        $this->db->set("FR", $this->FR, TRUE);
        $this->db->set("SO2", $this->SO2, TRUE);
        $this->db->set("FIO2", $this->FIO2, TRUE);
        $this->db->set("T", $this->T, TRUE);
        $this->db->set("vasopresores_inotropicos", $this->vasopresores_inotropicos, TRUE);
        $this->db->set("vasopresores_inotropicos_tipo", $this->vasopresores_inotropicos_tipo, TRUE);
        $this->db->set("ROT", $this->ROT, TRUE);
        $this->db->set("fuerza_muscular", $this->fuerza_muscular, TRUE);
        $this->db->set("glasgow", $this->glasgow, TRUE);
        $this->db->set("electromiografia", $this->electromiografia, TRUE);
        $this->db->set("electromiografia_fecha", $this->electromiografia_fecha, TRUE);
        $this->db->set("electromiografia_conclusion_1", $this->electromiografia_conclusion_1, TRUE);
        $this->db->set("electromiografia_conclusion_2", $this->electromiografia_conclusion_2, TRUE);
        $this->db->set("electromiografia_velocidad", $this->electromiografia_velocidad, TRUE);
        $this->db->set("puncion_lumbar", $this->puncion_lumbar, TRUE);
        $this->db->set("puncion_lumbar_fecha", $this->puncion_lumbar_fecha, TRUE);
        $this->db->set("puncion_lumbar_envio", $this->puncion_lumbar_envio, TRUE);
        $this->db->set("tipificacion_viral", $this->tipificacion_viral, TRUE);
        $this->db->set("tipificacion_viral_fecha", $this->tipificacion_viral_fecha, TRUE);
        $this->db->set("tipificacion_viral_envio", $this->tipificacion_viral_envio, TRUE);
        $this->db->set("tipificacion_bacteriana", $this->tipificacion_bacteriana, TRUE);
        $this->db->set("tipificacion_bacteriana_fecha", $this->tipificacion_bacteriana_fecha, TRUE);
        $this->db->set("tipificacion_bacteriana_envio", $this->tipificacion_bacteriana_envio, TRUE);
        $this->db->set("isopado_orofaringia", $this->isopado_orofaringia, TRUE);
        $this->db->set("isopado_orofaringia_fecha", $this->isopado_orofaringia_fecha, TRUE);
        $this->db->set("isopado_orofaringia_envio", $this->isopado_orofaringia_envio, TRUE);
        $this->db->set("examen_heces", $this->examen_heces, TRUE);
        $this->db->set("examen_heces_fecha", $this->examen_heces_fecha, TRUE);
        $this->db->set("examen_heces_envio", $this->examen_heces_envio, TRUE);
        $this->db->set("Na", $this->Na, TRUE);
        $this->db->set("K", $this->K, TRUE);
        $this->db->set("Cl", $this->Cl, TRUE);
        $this->db->set("P", $this->P, TRUE);
        $this->db->set("Ca", $this->Ca, TRUE);
        $this->db->set("cie10_1", $this->cie10_1, TRUE);
        $this->db->set("cie10_1_presuntivo", $this->cie10_1_presuntivo, TRUE);
        $this->db->set("cie10_1_definitivo", $this->cie10_1_definitivo, TRUE);
        $this->db->set("cie10_2", $this->cie10_2, TRUE);
        $this->db->set("cie10_2_presuntivo", $this->cie10_2_presuntivo, TRUE);
        $this->db->set("cie10_2_definitivo", $this->cie10_2_definitivo, TRUE);
        $this->db->set("cie10_3", $this->cie10_3, TRUE);
        $this->db->set("cie10_3_presuntivo", $this->cie10_3_presuntivo, TRUE);
        $this->db->set("cie10_3_definitivo", $this->cie10_3_definitivo, TRUE);
        $this->db->set("inmunoglobulina", $this->inmunoglobulina, TRUE);
        $this->db->set("inmunoglobulina_frascos", $this->inmunoglobulina_frascos, TRUE);
        $this->db->set("inmunoglobulina_dias", $this->inmunoglobulina_dias, TRUE);
        $this->db->set("inmunoglobulina_reacciones", $this->inmunoglobulina_reacciones, TRUE);
        $this->db->set("plasmaferesis_albumina", $this->plasmaferesis_albumina, TRUE);
        $this->db->set("plasmaferesis_albumina_frascos", $this->plasmaferesis_albumina_frascos, TRUE);
        $this->db->set("plasmaferesis_albumina_dias", $this->plasmaferesis_albumina_dias, TRUE);
        $this->db->set("plasmaferesis_albumina_reacciones", $this->plasmaferesis_albumina_reacciones, TRUE);
        $this->db->set("plasmaferesis_PFC", $this->plasmaferesis_PFC, TRUE);
        $this->db->set("plasmaferesis_PFC_frascos", $this->plasmaferesis_PFC_frascos, TRUE);
        $this->db->set("plasmaferesis_PFC_dias", $this->plasmaferesis_PFC_dias, TRUE);
        $this->db->set("plasmaferesis_PFC_reacciones", $this->plasmaferesis_PFC_reacciones, TRUE);
        $this->db->set("Apache_II", $this->Apache_II, TRUE);
        $this->db->set("SOFA", $this->SOFA, TRUE);
        $this->db->set("fecha_caf", $this->fecha_caf, TRUE);
        $this->db->set("fecha_intubacion", $this->fecha_intubacion, TRUE);
        $this->db->set("dias_uci", $this->dias_uci, TRUE);
        $this->db->set("dias_VMI", $this->dias_VMI, TRUE);
        $this->db->set("modo_ventilatorio", $this->modo_ventilatorio, TRUE);
        $this->db->set("modo_ventilatorio_fecha", $this->modo_ventilatorio_fecha, TRUE);
        $this->db->set("destete_horas", $this->destete_horas, TRUE);
        $this->db->set("destete_dias", $this->destete_dias, TRUE);
        $this->db->set("traqueostomia", $this->traqueostomia, TRUE);
        $this->db->set("traqueostomia_fecha", $this->traqueostomia_fecha, TRUE);
        $this->db->set("fecha_extubacion", $this->fecha_extubacion, TRUE);
        $this->db->set("destino_alta_uci", $this->destino_alta_uci, TRUE);
        $this->db->set("condicion_paciente", $this->condicion_paciente, TRUE);
        $this->db->set("usuario_actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("emergencias_registro_atenciones_id", $this->id);
        if ($this->db->update('emergencias_registro_atenciones')) {
            return true;
        } else {
            return false;
        }
    }
    public function eliminar(){
        $this->db->db_debug = FALSE;
        $this->db->where("emergencias_registro_atenciones_id", $this->id);
        $error = array();
        if ($this->db->delete('emergencias_registro_atenciones'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }           
    }
}
?>