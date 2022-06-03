<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Atenciones_model extends CI_Model
{
    private $id;
    private $evento_tipo_entidad_atencion_registro_id;
    private $PreHospitalario;
    private $PreHospitalario_Entidad;
    private $PMA_Oferta_Movil;
    private $Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID;
    private $Tipo_Documento_Codigo;
    private $Tipo_Documento_Numero;
    private $Paciente;
    private $Nacimiento;
    private $Edad;
    private $Genero;
    private $Gestante;
    private $Discapacidad;
    private $Discapacidad_Tipo;
    private $Apoderado;
    private $Pais_Procedencia;
    private $Lugar_Residencia;
    private $Enfermedad_Dias;
    private $Enfermedad_Meses;
    private $Fecha_Hora_Sintomas;
    private $Fecha_Hora_Atencion;
    private $PAS;
    private $PAD;
    private $FC;
    private $FR;
    private $SO2;
    private $FIO2;
    private $Dificultad_Respiratoria;
    private $Tos;
    private $Rinorrea;
    private $Fiebre;
    private $alteracion_conciencia;
    private $dolor_pecho;
    private $Nauseas;
    private $Vomitos;
    private $Dolor_Abdominal;
    private $Diarrea;
    private $Otros;
    private $Vac_Influenza;
    private $Vac_Fiebre;
    private $Vac_Sarampion;
    private $Vac_Hepatitis;
    private $Vac_Tetanos;
    private $Vac_Otros;
    private $Vac_Otros_Detalle;
    private $Lab_Fecha_Toma;
    private $Lab_Fecha_Envio;
    private $Lab_Fecha_Recepcion;
    private $Lab_Resultados;
    private $Destino;
    private $Lugar_Referencia;
    private $Responsable_Traslado;
    private $Condicion_Alta;
    private $Clasificacion;
    private $Tipo_Discapacidad;
    private $ObservacionesAtencion;
    private $evento_tipo_entidad_atencion_registro_profesionales_id;
    private $Documento_Numero;
    private $brigadistas_especialidad_id;
    private $Nombre;
    private $Colegiatura;
    private $RNE;
    private $evento_tipo_entidad_atencion_registro_atenciones_cie_ID;
    private $Id_CIE10;
    private $Texto_CIE10;
    private $evento_tipo_entidad_atencion_registro_atenciones_tratamiento_id;
    private $evento_tipo_entidad_atencion_registro_medicamentos_id;
    private $Total;
    private $Cantidad;
    private $Frecuencia;
    private $Via;
    private $Observaciones;
    Private $dx1_covid_01;
    Private $dx1_covid_02;
    Private $dx1_covid_03;
    Private $dx2_insuficiencia;
    Private $dx2_neumonia;
    Private $dx2_faringitis;
    Private $dx2_shock;
    Private $dx3_hta;
    Private $dx3_dm;
    Private $dx3_obesidad;
    Private $dx3_insuficiencia_renal;
    Private $dx3_otros;
    Private $aislamiento;
    Private $hospitalizacion;
    Private $area_interna_01;
    Private $area_externa_01;
    Private $shock_trauma;
    Private $uci;
    Private $area_interna_02;
    Private $area_externa_02;
    Private $observacion;
    Private $area_interna_03;
    Private $area_externa_03;
    private $Fechainicial;
    private $Fechafinal;
    public function setId($data) { $this->id = $this->db->escape_str($data); }
    public function setevento_tipo_entidad_atencion_registro_id($data) { $this->evento_tipo_entidad_atencion_registro_id = $this->db->escape_str($data); }
    public function setPreHospitalario($data) { $this->PreHospitalario = $this->db->escape_str($data); }
    public function setPreHospitalario_Entidad($data) { $this->PreHospitalario_Entidad = $this->db->escape_str($data); }
    public function setPMA_Oferta_Movil($data) { $this->PMA_Oferta_Movil = $this->db->escape_str($data); }
    public function setEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID($data) { $this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = $this->db->escape_str($data); }
    public function setTipo_Documento_Codigo($data) { $this->Tipo_Documento_Codigo = $this->db->escape_str($data); }
    public function setTipo_Documento_Numero($data) { $this->Tipo_Documento_Numero = $this->db->escape_str($data); }
    public function setPaciente($data) { $this->Paciente = $this->db->escape_str($data); }
    public function setNacimiento($data) { $this->Nacimiento = $this->db->escape_str($data); }
    public function setEdad($data) { $this->Edad = $this->db->escape_str($data); }
    public function setGenero($data) { $this->Genero = $this->db->escape_str($data); }
    public function setGestante($data) { $this->Gestante = $this->db->escape_str($data); }
    public function setDiscapacidad($data) { $this->Discapacidad = $this->db->escape_str($data); }
    public function setDiscapacidad_Tipo($data) { $this->Discapacidad_Tipo = $this->db->escape_str($data); }
    public function setApoderado($data) { $this->Apoderado = $this->db->escape_str($data); }
    public function setPais_Procedencia($data) { $this->Pais_Procedencia = $this->db->escape_str($data); }
    public function setLugar_Residencia($data) { $this->Lugar_Residencia = $this->db->escape_str($data); }
    public function setEnfermedad_Dias($data) { $this->Enfermedad_Dias = $this->db->escape_str($data); }
    public function setEnfermedad_Meses($data) { $this->Enfermedad_Meses = $this->db->escape_str($data); }
    public function setFecha_Hora_Sintomas($data) { $this->Fecha_Hora_Sintomas = $this->db->escape_str($data); }
    public function setFecha_Hora_Atencion($data) { $this->Fecha_Hora_Atencion = $this->db->escape_str($data); }
    public function setPAS($data) { $this->PAS = $this->db->escape_str($data); }
    public function setPAD($data) { $this->PAD = $this->db->escape_str($data); }
    public function setFC($data) { $this->FC = $this->db->escape_str($data); }
    public function setFR($data) { $this->FR = $this->db->escape_str($data); }
    public function setSO2($data) { $this->SO2 = $this->db->escape_str($data); }
    public function setFIO2($data) { $this->FIO2 = $this->db->escape_str($data); }
    public function setDificultad_Respiratoria($data) { $this->Dificultad_Respiratoria = $this->db->escape_str($data); }
    public function setTos($data) { $this->Tos = $this->db->escape_str($data); }
    public function setRinorrea($data) { $this->Rinorrea = $this->db->escape_str($data); }
    public function setFiebre($data) { $this->Fiebre = $this->db->escape_str($data); }
    public function setAlteracion_conciencia($data) { $this->alteracion_conciencia = $this->db->escape_str($data); }
    public function setDolor_pecho($data) { $this->dolor_pecho = $this->db->escape_str($data); }
    public function setNauseas($data) { $this->Nauseas = $this->db->escape_str($data); }
    public function setVomitos($data) { $this->Vomitos = $this->db->escape_str($data); }
    public function setDolor_Abdominal($data) { $this->Dolor_Abdominal = $this->db->escape_str($data); }
    public function setDiarrea($data) { $this->Diarrea = $this->db->escape_str($data); }
    public function setOtros($data) { $this->Otros = $this->db->escape_str($data); }
    public function setVac_Influenza($data) { $this->Vac_Influenza = $this->db->escape_str($data); }
    public function setVac_Fiebre($data) { $this->Vac_Fiebre = $this->db->escape_str($data); }
    public function setVac_Sarampion($data) { $this->Vac_Sarampion = $this->db->escape_str($data); }
    public function setVac_Hepatitis($data) { $this->Vac_Hepatitis = $this->db->escape_str($data); }
    public function setVac_Tetanos($data) { $this->Vac_Tetanos = $this->db->escape_str($data); }
    public function setVac_Otros($data) { $this->Vac_Otros = $this->db->escape_str($data); }
    public function setVac_Otros_Detalle($data) { $this->Vac_Otros_Detalle = $this->db->escape_str($data); }
    public function setLab_Fecha_Toma($data) { $this->Lab_Fecha_Toma = $this->db->escape_str($data); }
    public function setLab_Fecha_Envio($data) { $this->Lab_Fecha_Envio = $this->db->escape_str($data); }
    public function setLab_Fecha_Recepcion($data) { $this->Lab_Fecha_Recepcion = $this->db->escape_str($data); }
    public function setLab_Resultados($data) { $this->Lab_Resultados = $this->db->escape_str($data); }
    public function setDestino($data) { $this->Destino = $this->db->escape_str($data); }
    public function setLugar_Referencia($data) { $this->Lugar_Referencia = $this->db->escape_str($data); }
    public function setResponsable_Traslado($data) { $this->Responsable_Traslado = $this->db->escape_str($data); }
    public function setCondicion_Alta($data) { $this->Condicion_Alta = $this->db->escape_str($data); }
    public function setClasificacion($data) { $this->Clasificacion = $this->db->escape_str($data); }
    public function setTipo_Discapacidad($data) { $this->Tipo_Discapacidad = $this->db->escape_str($data); }
    public function setObservacionesAtencion($data) { $this->ObservacionesAtencion = $this->db->escape_str($data); }    
    public function setevento_tipo_entidad_atencion_registro_profesionales_id($data) { $this->evento_tipo_entidad_atencion_registro_profesionales_id = $this->db->escape_str($data); }
    public function setDocumento_Numero($data) { $this->Documento_Numero = $this->db->escape_str($data); }
    public function setbrigadistas_especialidad_id($data) { $this->brigadistas_especialidad_id = $this->db->escape_str($data); }
    public function setNombre($data) { $this->Nombre = $this->db->escape_str($data); }
    public function setColegiatura($data) { $this->Colegiatura = $this->db->escape_str($data); }
    public function setRNE($data) { $this->RNE = $this->db->escape_str($data); }
    public function setevento_tipo_entidad_atencion_registro_atenciones_cie_ID($data) { $this->evento_tipo_entidad_atencion_registro_atenciones_cie_ID = $this->db->escape_str($data); }
    public function setId_CIE10($data) { $this->Id_CIE10 = $this->db->escape_str($data); }
    public function setTexto_CIE10($data) { $this->Texto_CIE10 = $this->db->escape_str($data); }
    public function setevento_tipo_entidad_atencion_registro_atenciones_tratamiento_id($data) { $this->evento_tipo_entidad_atencion_registro_atenciones_tratamiento_id =$this->db->escape_str($data); }
    public function setevento_tipo_entidad_atencion_registro_medicamentos_id($data) { $this->evento_tipo_entidad_atencion_registro_medicamentos_id =$this->db->escape_str($data); }
    public function setTotal($data) { $this->Total =$this->db->escape_str($data); }
    public function setCantidad($data) { $this->Cantidad =$this->db->escape_str($data); }
    public function setFrecuencia($data) { $this->Frecuencia =$this->db->escape_str($data); }
    public function setVia($data) { $this->Via =$this->db->escape_str($data); }
    public function setObservaciones($data) { $this->Observaciones =$this->db->escape_str($data); }
    public function setDx1_covid_01($data) { $this->dx1_covid_01 =$this->db->escape_str($data); }
    public function setDx1_covid_02($data) { $this->dx1_covid_02 =$this->db->escape_str($data); }
    public function setDx1_covid_03($data) { $this->dx1_covid_03 =$this->db->escape_str($data); }
    public function setDx2_insuficiencia($data) { $this->dx2_insuficiencia =$this->db->escape_str($data); }
    public function setDx2_neumonia($data) { $this->dx2_neumonia =$this->db->escape_str($data); }
    public function setDx2_faringitis($data) { $this->dx2_faringitis =$this->db->escape_str($data); }
    public function setDx2_shock($data) { $this->dx2_shock =$this->db->escape_str($data); }
    public function setDx3_hta($data) { $this->dx3_hta =$this->db->escape_str($data); }
    public function setDx3_dm($data) { $this->dx3_dm =$this->db->escape_str($data); }
    public function setDx3_obesidad($data) { $this->dx3_obesidad =$this->db->escape_str($data); }
    public function setDx3_insuficiencia_renal($data) { $this->dx3_insuficiencia_renal =$this->db->escape_str($data); }
    public function setDx3_otros($data) { $this->dx3_otros =$this->db->escape_str($data); }
    public function setAislamiento($data) { $this->aislamiento =$this->db->escape_str($data); }
    public function setHospitalizacion($data) { $this->hospitalizacion =$this->db->escape_str($data); }
    public function setArea_interna_01($data) { $this->area_interna_01 =$this->db->escape_str($data); }
    public function setArea_externa_01($data) { $this->area_externa_01 =$this->db->escape_str($data); }
    public function setShock_trauma($data) { $this->shock_trauma =$this->db->escape_str($data); }
    public function setUci($data) { $this->uci =$this->db->escape_str($data); }
    public function setArea_interna_02($data) { $this->area_interna_02 =$this->db->escape_str($data); }
    public function setArea_externa_02($data) { $this->area_externa_02 =$this->db->escape_str($data); }
    public function setObservacion($data) { $this->observacion =$this->db->escape_str($data); }
    public function setArea_interna_03($data) { $this->area_interna_03 =$this->db->escape_str($data); }
    public function setArea_externa_03($data) { $this->area_externa_03 =$this->db->escape_str($data); }
    public function setFechainicial($data) { $this->Fechainicial = $this->db->escape_str($data); }
    public function setFechafinal($data) { $this->Fechafinal = $this->db->escape_str($data); }
    public function __construct()
    {
        parent::__construct();
    }
    public function medicamentos() {
        $this->db->select("evento_tipo_entidad_atencion_registro_medicamentos_id id, evento_tipo_entidad_atencion_registro_medicamentos_Descripcion descripcion");
        $this->db->select("'Unidad' unidad");
        $this->db->from("evento_tipo_entidad_atencion_registro_medicamentos");
        $this->db->where("estado", "1");
        return $this->db->get();
    }
     public function lista() {
        $this->db->select("DATE_FORMAT(eteara.Fecha_Hora_Atencion,'%d/%m/%Y') As 'F_Atencion'");
        $this->db->select("eteara.Paciente");
        $this->db->select("eteara.Edad");
        $this->db->select("Case eteara.Clasificacion
                            When '1' Then 'I-ROJO'
                            When '2' Then 'II-AMARILLO'
                            When '3' Then 'III y IV - VERDE'
                            When '4' Then '0 - FALLECIDO' End As 'Clasificacion'");
        $this->db->select("GROUP_CONCAT(cie.cie10_descripcion SEPARATOR ' | ') As 'Diagnosticos'");
        $this->db->select("concat_ws('-',etea.evento_tipo_entidad_atencion_nombre,eteaom.evento_tipo_entidad_atencion_oferta_movil_nombre) As 'PMA_Oferta_Movil'");
        $this->db->select("pais.nombre as 'Pais'"); 
        $this->db->select("eteara.evento_tipo_entidad_atencion_registro_atenciones_id As ID");
        $this->db->select("eteara.evento_tipo_entidad_atencion_registro_id As IDR");
        $this->db->select("eteara.evento_tipo_entidad_atencion_registro_profesionales_id As IDP");
        $this->db->select("etearp.Nombre As 'Medico'");
        $this->db->select("Case eteara.PreHospitalario When '1' Then 'SI' When '0' Then 'NO' End As 'PreHospitalario'");
        $this->db->select("Case eteara.PreHospitalario_Entidad
                            When '0' Then '[N/A]'
                            When '1' Then 'SAMU'
                            When '2' Then 'ESSALUD'
                            When '3' Then 'BOMBEROS'
                            When '4' Then 'FF.AA.'
                            When '5' Then 'PNP'
                            When '6' Then 'OTROS' End As 'Entidad'");
        $this->db->select("Case eteara.PMA_Oferta_Movil When '1' Then 'SI' When '0' Then 'NO' End As 'Atencion_PMA'");
        $this->db->select("tipo_documento.Tipo_Documento_Nombre As 'Tipo_Documento'");
        $this->db->select("eteara.Tipo_Documento_Numero As 'Num_Documento'");
        $this->db->select("DATE_FORMAT(eteara.Nacimiento,'%d/%m/%Y') As 'F_Nacimiento'");
        $this->db->select("Case eteara.Genero when '1' Then 'HOMBRE' when '2' then 'MUJER' End As Genero");
        $this->db->select("case eteara.Genero when '1' Then '[--]' When '2' then (Case eteara.Gestante when '1' Then 'SI' when '0' then 'NO' End) End As Gestante");
        $this->db->select("Case eteara.Discapacidad When '1' Then 'SI' When '0' Then 'NO' End As Discapacidad");
        $this->db->select("Case eteara.Discapacidad_Tipo
                            When '0' Then '[N/A]'
                            When '1' Then 'INTELECTUAL'
                            When '2' Then 'VISUAL'
                            When '3' Then 'AUDITIVA'
                            When '4' Then 'MOTORA' End As 'T_Discapacidad'");
        $this->db->select("eteara.Apoderado");
        $this->db->select("eteara.Lugar_Residencia as 'Residencia'");
        $this->db->select("eteara.Enfermedad_Dias As 'Dias'");
        $this->db->select("eteara.Enfermedad_Meses As 'Meses'");
        $this->db->select("DATE_FORMAT(eteara.Fecha_Hora_Sintomas,'%d/%m/%Y') As 'F_Sintomas'");
        $this->db->select("DATE_FORMAT(eteara.Fecha_Hora_Sintomas,'%H:%i') As 'H_Sintomas'");
        $this->db->select("DATE_FORMAT(eteara.Fecha_Hora_Atencion,'%H:%i') As 'H_Atencion'");
        $this->db->select("concat_ws('/',eteara.PAS,eteara.PAD) As 'PA'");
        $this->db->select("eteara.FC");
        $this->db->select("eteara.FR");
        $this->db->select("eteara.SO2");
        $this->db->select("eteara.FIO2");
        $this->db->select("Case eteara.Dificultad_Respiratoria When '1' Then 'SI' When '0' Then 'NO' End As 'Dif_Respiratoria'");
        $this->db->select("Case eteara.Tos When '1' Then 'SI' When '0' Then 'NO' End As 'Tos'");
        $this->db->select("Case eteara.Rinorrea When '1' Then 'SI' When '0' Then 'NO' End As 'Rinorrea'");
        $this->db->select("Case eteara.Fiebre When '1' Then 'SI' When '0' Then 'NO' End As 'Fiebre'");
        $this->db->select("Case eteara.Nauseas When '1' Then 'SI' When '0' Then 'NO' End As 'Nauseas'");
        $this->db->select("Case alteracion_conciencia When '1' Then 'SI' When '0' Then 'NO' End As 'alteracion_conciencia'");
        $this->db->select("Case eteara.dolor_pecho When '1' Then 'SI' When '0' Then 'NO' End As 'dolor_pecho'");
        $this->db->select("Case eteara.Vomitos When '1' Then 'SI' When '0' Then 'NO' End As Vomitos");
        $this->db->select("Case eteara.Dolor_Abdominal When '1' Then 'SI' When '0' Then 'NO' End As 'D_Abdominal'");
        $this->db->select("Case eteara.Diarrea When '1' Then 'SI' When '0' Then 'NO' End As 'Diarrea'");
        $this->db->select("eteara.Otros");
        $this->db->select("Case eteara.Vac_Influenza When '1' Then 'SI' When '0' Then 'NO' End As 'V_Influenza'");
        $this->db->select("Case eteara.Vac_Fiebre When '1' Then 'SI' When '0' Then 'NO' End As  'V_Fiebre'");
        $this->db->select("Case eteara.Vac_Sarampion When '1' Then 'SI' When '0' Then 'NO' End As 'V_Sarampion'");
        $this->db->select("Case eteara.Vac_Hepatitis When '1' Then 'SI' When '0' Then 'NO' End As 'V_Hepatitis'");
        $this->db->select("Case eteara.Vac_Tetanos When '1' Then 'SI' When '0' Then 'NO' End As 'V_Tetanos'");
        $this->db->select("Case eteara.Vac_Otros When '1' Then 'SI' When '0' Then 'NO' End As 'OtrasVacunas'");
        $this->db->select("eteara.Vac_Otros_Detalle As 'Detalle'");
        $this->db->select("DATE_FORMAT(eteara.Lab_Fecha_Toma,'%d/%m/%Y') As 'F_Toma'");
        $this->db->select("DATE_FORMAT(eteara.Lab_Fecha_Envio,'%d/%m/%Y') As 'F_Envio'");
        $this->db->select("DATE_FORMAT(eteara.Lab_Fecha_Recepcion,'%d/%m/%Y') As 'F_Recepcion'");
        $this->db->select("eteara.Lab_Resultados As 'Resultados'");
        $this->db->select("Case eteara.Destino
                            When '0' Then '[N/A]'
                            When '1' Then 'CASA'
                            When '2' Then 'REFERIDO'
                            When '3' Then 'RETIRO VOLUNTARIO'
                            When '4' Then 'FUGA'
                            When '5' Then 'FALLECIDO' end As 'Destino'");
        $this->db->select("eteara.Lugar_Referencia As 'Lugar_Traslado'");
        $this->db->select("eteara.Responsable_Traslado As 'Responsable'");
        $this->db->select("Case eteara.Condicion_Alta
                            When '1' Then '[N/A]'
                            When '2' Then 'CURADO'
                            When '3' Then 'ESTABLE'
                            When '4' Then 'FALLECIDO' End As 'Condicion'");
        $this->db->select("eteara.Observaciones");
        $this->db->select("oferta.Indicaciones");
        $this->db->select("Case eteara.dx1_covid_01 When '1' Then 'SI' When '0' Then 'NO' End As 'dx1_covid_01'");
        $this->db->select("Case eteara.dx1_covid_02 When '1' Then 'SI' When '0' Then 'NO' End As 'dx1_covid_02'");
        $this->db->select("Case eteara.dx1_covid_03 When '1' Then 'SI' When '0' Then 'NO' End As 'dx1_covid_03'");
        $this->db->select("Case eteara.dx2_insuficiencia When '1' Then 'SI' When '0' Then 'NO' End As 'dx2_insuficiencia'");
        $this->db->select("Case eteara.dx2_neumonia When '1' Then 'SI' When '0' Then 'NO' End As 'dx2_neumonia'");
        $this->db->select("Case eteara.dx2_faringitis When '1' Then 'SI' When '0' Then 'NO' End As 'dx2_faringitis'");
        $this->db->select("Case eteara.dx2_shock When '1' Then 'SI' When '0' Then 'NO' End As 'dx2_shock'");
        $this->db->select("Case eteara.dx3_hta When '1' Then 'SI' When '0' Then 'NO' End As 'dx3_hta'");
        $this->db->select("Case eteara.dx3_dm When '1' Then 'SI' When '0' Then 'NO' End As 'dx3_dm'");
        $this->db->select("Case eteara.dx3_obesidad When '1' Then 'SI' When '0' Then 'NO' End As 'dx3_obesidad'");
        $this->db->select("Case eteara.dx3_insuficiencia_renal When '1' Then 'SI' When '0' Then 'NO' End As 'dx3_insuficiencia_renal'");
        $this->db->select("Case eteara.dx3_otros When '1' Then 'SI' When '0' Then 'NO' End As 'dx3_otros'");
        $this->db->select("Case eteara.aislamiento When '1' Then 'SI' When '0' Then 'NO' End As 'aislamiento'");
        $this->db->select("Case eteara.hospitalizacion When '1' Then 'SI' When '0' Then 'NO' End As 'hospitalizacion'");
        $this->db->select("Case eteara.area_interna_01 When '1' Then 'SI' When '0' Then 'NO' End As 'area_interna_01'");
        $this->db->select("Case eteara.area_externa_01 When '1' Then 'SI' When '0' Then 'NO' End As 'area_externa_01'");
        $this->db->select("Case eteara.shock_trauma When '1' Then 'SI' When '0' Then 'NO' End As 'shock_trauma'");
        $this->db->select("Case eteara.uci When '1' Then 'SI' When '0' Then 'NO' End As 'uci'");
        $this->db->select("Case eteara.area_interna_02 When '1' Then 'SI' When '0' Then 'NO' End As 'area_interna_02'");
        $this->db->select("Case eteara.area_externa_02 When '1' Then 'SI' When '0' Then 'NO' End As 'area_externa_02'");
        $this->db->select("Case eteara.observacion When '1' Then 'SI' When '0' Then 'NO' End As 'observacion'");
        $this->db->select("Case eteara.area_interna_03 When '1' Then 'SI' When '0' Then 'NO' End As 'area_interna_03'");
        $this->db->select("Case eteara.area_externa_03 When '1' Then 'SI' When '0' Then 'NO' End As 'area_externa_03'");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones eteara");
        $this->db->join("evento_tipo_entidad_atencion_oferta_movil eteaom","eteaom.evento_tipo_entidad_atencion_oferta_movil_id = eteara.evento_tipo_entidad_atencion_oferta_movil_id","left");
        $this->db->join("evento_tipo_entidad_atencion etea","etea.Evento_Tipo_Entidad_Atencion_ID = eteaom.evento_tipo_entidad_atencion_id","left");
        $this->db->join("tipo_documento","tipo_documento.Tipo_Documento_Codigo = eteara.Tipo_Documento_Codigo","left");
        $this->db->join("pais","pais.id=eteara.Pais_Procedencia","left");
        $this->db->join("evento_tipo_entidad_atencion_registro_atenciones_cie cie","eteara.evento_tipo_entidad_atencion_registro_atenciones_id=cie.evento_tipo_entidad_atencion_registro_atenciones_id","left");
        $this->db->join("evento_tipo_entidad_atencion_registro_profesionales etearp","etearp.evento_tipo_entidad_atencion_registro_profesionales_id=eteara.evento_tipo_entidad_atencion_registro_profesionales_id","left");
        $this->db->join("oferta_movil_tratamientos_final oferta","oferta.evento_tipo_entidad_atencion_registro_atenciones_id=eteara.evento_tipo_entidad_atencion_registro_atenciones_id","left");
        if ($this->id != 0) {
            $this->db->where("eteara.Evento_Tipo_Entidad_Atencion_Registro_ID",$this->id);
        }
        $this->db->where("DATE_FORMAT(eteara.Fecha_Hora_Atencion,'%d/%m/%Y') >= ", $this->Fechainicial);
        $this->db->where("DATE_FORMAT(eteara.Fecha_Hora_Atencion,'%d/%m/%Y') <= ", $this->Fechafinal);
        $this->db->group_by("eteara.evento_tipo_entidad_atencion_registro_atenciones_id");
        return $this->db->get();
    }
    public function atencion() {
        $this->db->select("r.evento_tipo_entidad_atencion_registro_id,PreHospitalario,PreHospitalario_Entidad,PMA_Oferta_Movil,Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID");
        $this->db->select("Tipo_Documento_Codigo,Tipo_Documento_Numero,Paciente,DATE_FORMAT(Nacimiento,'%d/%m/%Y') Nacimiento,Edad,Genero,Gestante,Discapacidad,Discapacidad_Tipo,Apoderado,Pais_Procedencia");
        $this->db->select("Lugar_Residencia,Enfermedad_Dias,Enfermedad_Meses,DATE_FORMAT(Fecha_Hora_Sintomas,'%d/%m/%Y %H:%i') Fecha_Hora_Sintomas");
        $this->db->select("DATE_FORMAT(Fecha_Hora_Atencion,'%d/%m/%Y %H:%i') Fecha_Hora_Atencion,PAS,PAD,FC,FR,SO2,FIO2,Dificultad_Respiratoria,Tos,Rinorrea,alteracion_conciencia,dolor_pecho");
        $this->db->select("dx1_covid_01,dx1_covid_02,dx1_covid_03,dx2_insuficiencia,dx2_neumonia,dx2_faringitis,dx2_shock,dx3_hta,dx3_dm,dx3_obesidad,dx3_insuficiencia_renal,dx3_otros,aislamiento,hospitalizacion,area_interna_01,area_externa_01,shock_trauma,uci,area_interna_02,area_externa_02,observacion,area_interna_03,area_externa_03");
        $this->db->select("Vomitos,Fiebre,Nauseas,Dolor_Abdominal,Diarrea,Otros,Vac_Influenza,Vac_Fiebre,Vac_Sarampion,Vac_Hepatitis,Vac_Tetanos,Vac_Otros,Vac_Otros_Detalle");
        $this->db->select("DATE_FORMAT(Lab_Fecha_Toma,'%d/%m/%Y %H:%i') Lab_Fecha_Toma,DATE_FORMAT(Lab_Fecha_Envio,'%d/%m/%Y %H:%i') Lab_Fecha_Envio,DATE_FORMAT(Lab_Fecha_Recepcion,'%d/%m/%Y %H:%i') Lab_Fecha_Recepcion");
        $this->db->select("Lab_Resultados,Destino,Lugar_Referencia,Responsable_Traslado,Condicion_Alta,Clasificacion,e.Observaciones");
        $this->db->select("evento_tipo_entidad_atencion_registro_profesionales_id,evento_tipo_entidad_atencion_registro_atenciones_id id");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones e");
        $this->db->join("evento_tipo_entidad_atencion_registro r","e.evento_tipo_entidad_atencion_registro_id=r.evento_tipo_entidad_atencion_registro_id");
        $this->db->where("e.evento_tipo_entidad_atencion_registro_atenciones_id", $this->id);
        return $this->db->get();
    }
    public function registrar() {
        $data = array(
            "evento_tipo_entidad_atencion_registro_id" => $this->evento_tipo_entidad_atencion_registro_id,
            "evento_tipo_entidad_atencion_registro_profesionales_id" => $this->evento_tipo_entidad_atencion_registro_profesionales_id,
            "PreHospitalario" => $this->PreHospitalario,
            "PreHospitalario_Entidad" => $this->PreHospitalario_Entidad,
            "PMA_Oferta_Movil" => $this->PMA_Oferta_Movil,
            "Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID" => $this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID,
            "Tipo_Documento_Codigo" => $this->Tipo_Documento_Codigo,
            "Tipo_Documento_Numero" => $this->Tipo_Documento_Numero,
            "Paciente" => $this->Paciente,
            "Nacimiento" => $this->Nacimiento,
            "Edad" => $this->Edad,
            "Genero" => $this->Genero,
            "Gestante" => $this->Gestante,
            "Discapacidad" => $this->Discapacidad,
            "Discapacidad_Tipo" => $this->Discapacidad_Tipo,
            "Apoderado" => $this->Apoderado,
            "Pais_Procedencia" => $this->Pais_Procedencia,
            "Lugar_Residencia" => $this->Lugar_Residencia,
            "Enfermedad_Dias" => $this->Enfermedad_Dias,
            "Enfermedad_Meses" => $this->Enfermedad_Meses,
            "Fecha_Hora_Sintomas" => $this->Fecha_Hora_Sintomas,
            "Fecha_Hora_Atencion" => $this->Fecha_Hora_Atencion,
            "PAS" => $this->PAS,
            "PAD" => $this->PAD,
            "FC" => $this->FC,
            "FR" => $this->FR,
            "SO2" => $this->SO2,
            "FIO2" => $this->FIO2,
            "Dificultad_Respiratoria" => $this->Dificultad_Respiratoria,
            "Tos" => $this->Tos,
            "Rinorrea" => $this->Rinorrea,
            "Fiebre" => $this->Fiebre,
            "alteracion_conciencia" => $this->alteracion_conciencia,
            "dolor_pecho" => $this->dolor_pecho,
            "Nauseas" => $this->Nauseas,
            "Vomitos" => $this->Vomitos,
            "Dolor_Abdominal" => $this->Dolor_Abdominal,
            "Diarrea" => $this->Diarrea,
            "Otros" => $this->Otros,
            "Vac_Influenza" => $this->Vac_Influenza,
            "Vac_Fiebre" => $this->Vac_Fiebre,
            "Vac_Sarampion" => $this->Vac_Sarampion,
            "Vac_Hepatitis" => $this->Vac_Hepatitis,
            "Vac_Tetanos" => $this->Vac_Tetanos,
            "Vac_Otros" => $this->Vac_Otros,
            "Vac_Otros_Detalle" => $this->Vac_Otros_Detalle,
            "Lab_Fecha_Toma" => $this->Lab_Fecha_Toma,
            "Lab_Fecha_Envio" => $this->Lab_Fecha_Envio,
            "Lab_Fecha_Recepcion" => $this->Lab_Fecha_Recepcion,
            "Lab_Resultados" => $this->Lab_Resultados,
            "Destino" => $this->Destino,
            "Lugar_Referencia" => $this->Lugar_Referencia,
            "Responsable_Traslado" => $this->Responsable_Traslado,
            "Condicion_Alta" => $this->Condicion_Alta,
            "Clasificacion" => $this->Clasificacion,
            "Discapacidad_Tipo" => $this->Tipo_Discapacidad,
            "dx1_covid_01" => $this->dx1_covid_01,
            "dx1_covid_02" => $this->dx1_covid_02,
            "dx1_covid_03" => $this->dx1_covid_03,
            "dx2_insuficiencia" => $this->dx2_insuficiencia,
            "dx2_neumonia" => $this->dx2_neumonia,
            "dx2_faringitis" => $this->dx2_faringitis,
            "dx2_shock" => $this->dx2_shock,
            "dx3_hta" => $this->dx3_hta,
            "dx3_dm" => $this->dx3_dm,
            "dx3_obesidad" => $this->dx3_obesidad,
            "dx3_insuficiencia_renal" => $this->dx3_insuficiencia_renal,
            "dx3_otros" => $this->dx3_otros,
            "aislamiento" => $this->aislamiento,
            "hospitalizacion" => $this->hospitalizacion,
            "area_interna_01" => $this->area_interna_01,
            "area_externa_01" => $this->area_externa_01,
            "shock_trauma" => $this->shock_trauma,
            "uci" => $this->uci,
            "area_interna_02" => $this->area_interna_02,
            "area_externa_02" => $this->area_externa_02,
            "observacion" => $this->observacion,
            "area_interna_03" => $this->area_interna_03,
            "area_externa_03" => $this->area_externa_03
        );
        if ($this->db->insert('evento_tipo_entidad_atencion_registro_atenciones', $data))
            return $this->db->insert_id();
        else
            return 0;
    }
    public function actualizar() {
        $this->db->set("evento_tipo_entidad_atencion_registro_profesionales_id" , $this->evento_tipo_entidad_atencion_registro_profesionales_id, TRUE);
        $this->db->set("PreHospitalario" , $this->PreHospitalario, TRUE);
        $this->db->set("PreHospitalario_Entidad" , $this->PreHospitalario_Entidad, TRUE);
        $this->db->set("PMA_Oferta_Movil" , $this->PMA_Oferta_Movil, TRUE);
        $this->db->set("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID" , $this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID, TRUE);
        $this->db->set("Tipo_Documento_Codigo" , $this->Tipo_Documento_Codigo, TRUE);
        $this->db->set("Tipo_Documento_Numero" , $this->Tipo_Documento_Numero, TRUE);
        $this->db->set("Paciente" , $this->Paciente, TRUE);
        $this->db->set("Nacimiento" , $this->Nacimiento, TRUE);
        $this->db->set("Edad" , $this->Edad, TRUE);
        $this->db->set("Genero" , $this->Genero, TRUE);
        $this->db->set("Gestante" , $this->Gestante, TRUE);
        $this->db->set("Discapacidad" , $this->Discapacidad, TRUE);
        $this->db->set("Discapacidad_Tipo" , $this->Discapacidad_Tipo, TRUE);
        $this->db->set("Apoderado" , $this->Apoderado, TRUE);
        $this->db->set("Pais_Procedencia" , $this->Pais_Procedencia, TRUE);
        $this->db->set("Lugar_Residencia" , $this->Lugar_Residencia, TRUE);
        $this->db->set("Enfermedad_Dias" , $this->Enfermedad_Dias, TRUE);
        $this->db->set("Enfermedad_Meses" , $this->Enfermedad_Meses, TRUE);
        $this->db->set("Fecha_Hora_Sintomas" , $this->Fecha_Hora_Sintomas, TRUE);
        $this->db->set("Fecha_Hora_Atencion" , $this->Fecha_Hora_Atencion, TRUE);
        $this->db->set("PAS" , $this->PAS, TRUE);
        $this->db->set("PAD" , $this->PAD, TRUE);
        $this->db->set("FC" , $this->FC, TRUE);
        $this->db->set("FR" , $this->FR, TRUE);
        $this->db->set("SO2" , $this->SO2, TRUE);
        $this->db->set("FIO2" , $this->FIO2, TRUE);
        $this->db->set("Dificultad_Respiratoria" , $this->Dificultad_Respiratoria, TRUE);
        $this->db->set("Tos" , $this->Tos, TRUE);
        $this->db->set("Rinorrea" , $this->Rinorrea, TRUE);
        $this->db->set("alteracion_conciencia" , $this->alteracion_conciencia, TRUE);
        $this->db->set("dolor_pecho" , $this->dolor_pecho, TRUE);
        $this->db->set("Fiebre" , $this->Fiebre, TRUE);
        $this->db->set("Nauseas" , $this->Nauseas, TRUE);
        $this->db->set("Vomitos" , $this->Vomitos, TRUE);
        $this->db->set("Dolor_Abdominal" , $this->Dolor_Abdominal, TRUE);
        $this->db->set("Diarrea" , $this->Diarrea, TRUE);
        $this->db->set("Otros" , $this->Otros, TRUE);
        $this->db->set("Vac_Influenza" , $this->Vac_Influenza, TRUE);
        $this->db->set("Vac_Fiebre" , $this->Vac_Fiebre, TRUE);
        $this->db->set("Vac_Sarampion" , $this->Vac_Sarampion, TRUE);
        $this->db->set("Vac_Hepatitis" , $this->Vac_Hepatitis, TRUE);
        $this->db->set("Vac_Tetanos" , $this->Vac_Tetanos, TRUE);
        $this->db->set("Vac_Otros" , $this->Vac_Otros, TRUE);
        $this->db->set("Vac_Otros_Detalle" , $this->Vac_Otros_Detalle, TRUE);
        $this->db->set("Lab_Fecha_Toma" , $this->Lab_Fecha_Toma, TRUE);
        $this->db->set("Lab_Fecha_Envio" , $this->Lab_Fecha_Envio, TRUE);
        $this->db->set("Lab_Fecha_Recepcion" , $this->Lab_Fecha_Recepcion, TRUE);
        $this->db->set("Lab_Resultados" , $this->Lab_Resultados, TRUE);
        $this->db->set("Destino" , $this->Destino, TRUE);
        $this->db->set("Lugar_Referencia" , $this->Lugar_Referencia, TRUE);
        $this->db->set("Responsable_Traslado" , $this->Responsable_Traslado, TRUE);
        $this->db->set("Condicion_Alta" , $this->Condicion_Alta, TRUE);
        $this->db->set("Clasificacion" , $this->Clasificacion, TRUE);
        $this->db->set("Discapacidad_Tipo", $this->Tipo_Discapacidad, TRUE);
        $this->db->set("Observaciones", $this->ObservacionesAtencion, TRUE);
        $this->db->set("dx1_covid_01", $this->dx1_covid_01, TRUE);
        $this->db->set("dx1_covid_02", $this->dx1_covid_02, TRUE);
        $this->db->set("dx1_covid_03", $this->dx1_covid_03, TRUE);
        $this->db->set("dx2_insuficiencia", $this->dx2_insuficiencia, TRUE);
        $this->db->set("dx2_neumonia", $this->dx2_neumonia, TRUE);
        $this->db->set("dx2_faringitis", $this->dx2_faringitis, TRUE);
        $this->db->set("dx2_shock", $this->dx2_shock, TRUE);
        $this->db->set("dx3_hta", $this->dx3_hta, TRUE);
        $this->db->set("dx3_dm", $this->dx3_dm, TRUE);
        $this->db->set("dx3_obesidad", $this->dx3_obesidad, TRUE);
        $this->db->set("dx3_insuficiencia_renal", $this->dx3_insuficiencia_renal, TRUE);
        $this->db->set("dx3_otros", $this->dx3_otros, TRUE);
        $this->db->set("aislamiento", $this->aislamiento, TRUE);
        $this->db->set("hospitalizacion", $this->hospitalizacion, TRUE);
        $this->db->set("area_interna_01", $this->area_interna_01, TRUE);
        $this->db->set("area_externa_01", $this->area_externa_01, TRUE);
        $this->db->set("shock_trauma", $this->shock_trauma, TRUE);
        $this->db->set("uci", $this->uci, TRUE);
        $this->db->set("area_interna_02", $this->area_interna_02, TRUE);
        $this->db->set("area_externa_02", $this->area_externa_02, TRUE);
        $this->db->set("observacion", $this->observacion, TRUE);
        $this->db->set("area_interna_03", $this->area_interna_03, TRUE);
        $this->db->set("area_externa_03", $this->area_externa_03, TRUE);
        $this->db->where("evento_tipo_entidad_atencion_registro_atenciones_id", $this->id);
        if ($this->db->update('evento_tipo_entidad_atencion_registro_atenciones'))
            return $this->id;
        else
            return 0;
    }
    public function registrarProfesional() {
        $data = array(
            "Tipo_Documento_Codigo" => "01",
            "Documento_Numero" => $this->Documento_Numero,
            "Nombre" => $this->Nombre,
            "Colegiatura" => $this->Colegiatura,
            "brigadistas_especialidad_id" => $this->brigadistas_especialidad_id,
            "RNE" => $this->RNE,
            "estado" => "1"
        );
        if ($this->db->insert('evento_tipo_entidad_atencion_registro_profesionales', $data))
            return $this->db->insert_id();
        else 
            return 0;
    }
    public function buscarProfesional() {
        $this->db->select("a.evento_tipo_entidad_atencion_registro_profesionales_id id,a.Tipo_Documento_Codigo,a.Documento_Numero,a.brigadistas_especialidad_id,a.Nombre,Colegiatura,a.RNE,p.brigadistas_profesiones_id profesion");
        $this->db->from("evento_tipo_entidad_atencion_registro_profesionales a");
        $this->db->join("brigadistas_especialidad e","a.brigadistas_especialidad_id=e.brigadistas_especialidad_id");
        $this->db->join("brigadistas_profesiones p","p.brigadistas_profesiones_id=e.brigadistas_profesiones_id");
        $this->db->where("estado", "1");
        $this->db->where("Documento_Numero", $this->Tipo_Documento_Numero);
        return $this->db->get();
    }
    public function buscarProfesional2() {
        $this->db->select("a.evento_tipo_entidad_atencion_registro_profesionales_id id,a.Tipo_Documento_Codigo,a.Documento_Numero Documento_Numero1,a.brigadistas_especialidad_id,a.Nombre,Colegiatura,a.RNE,p.brigadistas_profesiones_id profesion");
        $this->db->from("evento_tipo_entidad_atencion_registro_profesionales a");
        $this->db->join("brigadistas_especialidad e","a.brigadistas_especialidad_id=e.brigadistas_especialidad_id");
        $this->db->join("brigadistas_profesiones p","p.brigadistas_profesiones_id=e.brigadistas_profesiones_id");
        $this->db->where("estado", "1");
        $this->db->where("a.evento_tipo_entidad_atencion_registro_profesionales_id", $this->Tipo_Documento_Numero);
        return $this->db->get();
    }
    public function registrarCie10() {
        $data = array(
            "evento_tipo_entidad_atencion_registro_atenciones_id" => $this->id,
            "Id_CIE10" => $this->Id_CIE10,
            "cie10_descripcion" => $this->Texto_CIE10,
            "estado" => "1"
        );
        if ($this->db->insert('evento_tipo_entidad_atencion_registro_atenciones_cie', $data))
            return $this->db->insert_id();
            else
                return 0;        
    }
    public function registrarTratamiento() {
        $data = array(
            "evento_tipo_entidad_atencion_registro_atenciones_id" => $this->id,
            "evento_tipo_entidad_atencion_registro_medicamentos_id" => $this->evento_tipo_entidad_atencion_registro_medicamentos_id,
            "Total" => $this->Total,
            "Cantidad" => $this->Cantidad,
            "Frecuencia" => $this->Frecuencia,
            "Via" => $this->Via,
            "Observaciones" => $this->Observaciones,
            "estado" => "1" 
        );
        if ($this->db->insert('evento_tipo_entidad_atencion_registro_atenciones_tratamiento', $data))
            return $this->db->insert_id();
        else
            return 0;
    }
    public function EventoOfertaMovil() {
        $this->db->select("Evento_Registro_Numero");
        $this->db->from("evento_tipo_entidad_atencion_registro");
        $this->db->where("evento_tipo_entidad_atencion_registro_id", $this->id);
        return $this->db->get();
    }
    public function profesional() {
        $this->db->select("p.evento_tipo_entidad_atencion_registro_profesionales_id id,p.Tipo_Documento_Codigo,p.Documento_Numero");
        $this->db->select("p.brigadistas_especialidad_id,p.Nombre,p.Colegiatura,p.RNE,e.brigadistas_profesiones_id");
        $this->db->from("evento_tipo_entidad_atencion_registro_profesionales p");
        $this->db->join("brigadistas_especialidad e","p.brigadistas_especialidad_id=e.brigadistas_especialidad_id");
        $this->db->where("p.evento_tipo_entidad_atencion_registro_profesionales_id", $this->evento_tipo_entidad_atencion_registro_profesionales_id);
        return $this->db->get();
    }
    public function cie10() {
        $this->db->select("Id_CIE10, cie10_descripcion");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones_cie");
        $this->db->where("evento_tipo_entidad_atencion_registro_atenciones_id", $this->id);
        $this->db->order_by("evento_tipo_entidad_atencion_registro_atenciones_cie_ID","ASC");
        return $this->db->get();
    }
    public function eliminarTratamientos() {
        return $this->db->delete('evento_tipo_entidad_atencion_registro_atenciones_tratamiento', array(
            'evento_tipo_entidad_atencion_registro_atenciones_id' => $this->id
        ));
    }
    public function eliminarCIE10() {
        return $this->db->delete('evento_tipo_entidad_atencion_registro_atenciones_cie', array(
            'evento_tipo_entidad_atencion_registro_atenciones_id' => $this->id
        ));
    }
    public function tratamientos() {
        $this->db->select("etearat.Total,etearat.Cantidad,etearat.Frecuencia,etearat.Via,etearat.Observaciones");
        $this->db->select("
            CASE WHEN Frecuencia = '0' THEN '[N/A]' 
                 WHEN Frecuencia = '1' THEN 'C/4H' 
                 WHEN Frecuencia = '2' THEN 'C/6H' 
                 WHEN Frecuencia = '3' THEN 'C/8H' 
                 WHEN Frecuencia = '4' THEN 'C/12H' 
                 WHEN Frecuencia = '5' THEN 'C/24H' END frecuencia_descripcion");
        $this->db->select("
               CASE WHEN Via = '0' THEN '[N/A]'
                    WHEN Via = '1' THEN 'Oral'
                    WHEN Via = '2' THEN 'Sublingual'
                    WHEN Via = '3' THEN 'Topica'
                    WHEN Via = '4' THEN 'Transdermica'
                    WHEN Via = '5' THEN 'Oftalmica'
                    WHEN Via = '6' THEN 'Otica'
                    WHEN Via = '7' THEN 'Intranasal'
                    WHEN Via = '8' THEN 'Inhalatoria'
                    WHEN Via = '9' THEN 'Rectal'
                    WHEN Via = '10' THEN 'Vaginal'
                    WHEN Via = '11' THEN 'Parental'
                    WHEN Via = '12' THEN 'Intravenosa'
                    WHEN Via = '13' THEN 'Intramuscular'
                    WHEN Via = '14' THEN 'Subcutanea' END via_descripcion");
        $this->db->select("etearm.evento_tipo_entidad_atencion_registro_medicamentos_Descripcion descripcion,etearm.evento_tipo_entidad_atencion_registro_medicamentos_id medicamentoID");
        $this->db->select("CASE WHEN evento_tipo_entidad_atencion_registro_medicamentos_Unidad='1' THEN 'Unidad' ELSE '' END unidad");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones_tratamiento etearat");
        $this->db->join("evento_tipo_entidad_atencion_registro_medicamentos etearm","etearm.evento_tipo_entidad_atencion_registro_medicamentos_id = etearat.evento_tipo_entidad_atencion_registro_medicamentos_id");        
        $this->db->where("evento_tipo_entidad_atencion_registro_atenciones_id",$this->id);
        $this->db->order_by("evento_tipo_entidad_atencion_registro_atenciones_tratamiento_id","DESC");
        return $this->db->get();
    }
    public function eliminar_registro_atenciones() {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_tipo_entidad_atencion_registro_atenciones_id", $this->id);
        if ($this->db->delete('evento_tipo_entidad_atencion_registro_atenciones')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar_atenciones_cie() {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_tipo_entidad_atencion_registro_atenciones_id", $this->id);
        
        if ($this->db->delete('evento_tipo_entidad_atencion_registro_atenciones_cie')) {
            return 1;
        }
        else {
            return 0;
        }
    }
   public function eliminar_atenciones_tratamiento() {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_tipo_entidad_atencion_registro_atenciones_id", $this->id);
        if ($this->db->delete('evento_tipo_entidad_atencion_registro_atenciones_tratamiento')) {
            return 1;
        }
        else {
            return 0;
        }
    }
}