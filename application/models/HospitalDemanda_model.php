<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class HospitalDemanda_model extends CI_Model
{
    private $id;
    private $ipress;
    private $region;
    private $emed_tipo_documento;
    private $dni_responsable_reporte;
    private $responsable_reporte;
    private $ocupacion_responsable_reporte;
    private $telefono_responsable_reporte;
    private $supervidor_tipo_documento;
    private $dni_jefe_guardia;
    private $jefe_guardia;
    private $ocupacion_jefe_guardia;
    private $telefono_jefe_guardia;
    private $atencionInterna;
    private $atencionExterna;
    private $camaHospitalizado;
    private $camaHospitalizadoInterna;
    private $camaHospitalizadoExterna;
    private $camaHospitalizadoTotal;
    private $camaUci;
    private $camaUciInterna;
    private $camaUciExterna;
    private $camaUciTotal;
    private $camaUciPedriatico;
    private $camaUciPedriaticoInterna;
    private $camaUciPedriaticoExterna;
    private $camaUciPedriaticoTotal;
    private $camaUciTotalSuma;
    private $fechaRegistro;
    private $tipoReporte;
    private $hospitalizacion_convencionales_h;
    private $hospitalizacion_convencionales_u;
    private $hospitalizacion_convencionales_o;
    private $hospitalizacion_covid_o;
    private $hospitalizacion_e_interna_o;
    private $hospitalizacion_e_externa_o;
    private $hospitalizacion_disponibles_momento;
    private $hospitalizacion_camas_01;
    private $hospitalizacion_medicos_01;
    private $hospitalizacion_indicador_01;
    private $hospitalizacion_observaciones_01;
    private $hospitalizacion_camas_02;
    private $hospitalizacion_enfermeras_02;
    private $hospitalizacion_indicador_02;
    private $hospitalizacion_observaciones_02;
    private $emergencia_convencionales_o;
    private $emergencia_covid_o;
    private $emergencia_e_externa_02_h;
    private $emergencia_e_externa_02_u;
    private $emergencia_e_externa_o_02;
    private $emergencia_e_interna_o;
    private $emergencia_e_externa_o;
    private $emergencia_e_externa_03_h;
    private $emergencia_e_externa_03_u;
    private $emergencia_e_externa_o_03;
    private $emergencia_pacientes_01;
    private $emergencia_pacientes_02;
    private $emergencia_camas_01;
    private $emergencia_medicos_01;
    private $emergencia_indicador_01;
    private $emergencia_observaciones_01;
    private $emergencia_camas_02;
    private $emergencia_enfermeras_02;
    private $emergencia_indicador_02;
    private $emergencia_observaciones_02;
    private $emergencia_espera_u_momento;
    private $criticos_convencionales_o;
    private $criticos_covid_o;
    private $criticos_e_interna_o;
    private $criticos_e_externa_o;
    private $criticos_espera_o;
    private $criticos_espera_u_momento;
    private $criticos_espera_u_momento_o;
    private $criticos_disponibles_momento;
    private $criticos_camas_01;
    private $criticos_medicos_01;
    private $criticos_indicador_01;
    private $criticos_observaciones_01;
    private $criticos_camas_02;
    private $criticos_enfermeras_02;
    private $criticos_indicador_02;
    private $criticos_observaciones_02;
    private $pediatricos_convencionales_o;
    private $pediatricos_covid_o;
    private $pediatricos_e_interna_o;
    private $pediatricos_e_externa_o;
    private $pediatricos_espera_o;
    private $pediatricos_paciente_01;
    private $pediatricos_paciente_01_o;
    private $pediatricos_disponibles_momento;
    private $pediatricos_camas_01;
    private $pediatricos_medicos_01;
    private $pediatricos_indicador_01;
    private $pediatricos_observaciones_01;
    private $pediatricos_camas_02;
    private $pediatricos_enfermeras_02;
    private $pediatricos_indicador_02;
    private $pediatricos_observaciones_02;
    private $hospitalizacion_covid_h;
    private $hospitalizacion_covid_u;
    private $hospitalizacion_e_interna_h;
    private $hospitalizacion_e_interna_u;
    private $hospitalizacion_e_externa_h;
    private $hospitalizacion_e_externa_u;
    private $hospitalizacion_total_h;
    private $hospitalizacion_total_u;
    private $hospitalizacion_disponibles;
    private $hospitalizacion_porcentaje_01;
    private $hospitalizacion_sospechosos_h_covid;
    private $hospitalizacion_sospechosos_u_covid;
    private $hospitalizacion_e_interna_h_covid;
    private $hospitalizacion_e_interna_u_covid;
    private $hospitalizacion_e_externa_h_covid;
    private $hospitalizacion_e_externa_u_covid;
    private $hospitalizacion_total_h_covid;
    private $hospitalizacion_total_u_covid;
    private $hospitalizacion_disponibles_covid;
    private $hospitalizacion_porcentaje_02;
    private $emergencia_convencionales_h;
    private $emergencia_convencionales_u;
    private $emergencia_covid_h;
    private $emergencia_covid_u;
    private $emergencia_e_interna_h;
    private $emergencia_e_interna_u;
    private $emergencia_e_externa_h;
    private $emergencia_e_externa_u;
    private $emergencia_espera_u;
    private $emergencia_total_h;
    private $emergencia_total_u;
    private $emergencia_porcentaje_01;
    private $emergencia_disponibles;
    private $emergencia_sospechosos_h_covid;
    private $emergencia_sospechosos_u_covid;
    private $emergencia_e_interna_h_covid;
    private $emergencia_e_interna_u_covid;
    private $emergencia_e_externa_h_covid;
    private $emergencia_e_externa_u_covid;
    private $emergencia_espera_u_covid;
    private $emergencia_total_h_covid;
    private $emergencia_total_u_covid;
    private $emergencia_disponibles_covid;
    private $emergencia_porcentaje_02;
    private $criticos_convencionales_h;
    private $criticos_convencionales_u;
    private $criticos_covid_h;
    private $criticos_covid_u;
    private $criticos_e_interna_h;
    private $criticos_e_interna_u;
    private $criticos_e_externa_h;
    private $criticos_e_externa_u;
    private $criticos_espera_u;
    private $criticos_total_h;
    private $criticos_total_u;
    private $criticos_disponibles;
    private $criticos_porcentaje_01;
    private $criticos_sospechosos_h_covid;
    private $criticos_sospechosos_u_covid;
    private $criticos_e_interna_h_covid;
    private $criticos_e_interna_u_covid;
    private $criticos_e_externa_h_covid;
    private $criticos_e_externa_u_covid;
    private $criticos_espera_u_covid;
    private $criticos_total_h_covid;
    private $criticos_total_u_covid;
    private $criticos_disponibles_covid;
    private $criticos_porcentaje_02;
    private $pediatricos_convencionales_h;
    private $pediatricos_convencionales_u;
    private $pediatricos_covid_h;
    private $pediatricos_covid_u;
    private $pediatricos_e_interna_h;
    private $pediatricos_e_interna_u;
    private $pediatricos_e_externa_h;
    private $pediatricos_e_externa_u;
    private $pediatricos_espera_u;
    private $pediatricos_total_h;
    private $pediatricos_total_u;
    private $pediatricos_disponibles;
    private $pediatricos_porcentaje_01;
    private $pediatricos_sospechosos_h_covid;
    private $pediatricos_sospechosos_u_covid;
    private $pediatricos_e_interna_h_covid;
    private $pediatricos_e_interna_u_covid;
    private $pediatricos_e_externa_h_covid;
    private $pediatricos_e_externa_u_covid;
    private $pediatricos_espera_u_covid;
    private $pediatricos_total_h_covid;
    private $pediatricos_total_u_covid;
    private $pediatricos_disponibles_covid;
    private $pediatricos_porcentaje_02;    
    public function setid($data){ $this->id = $this->db->escape_str($data); }
    public function setipress($data){ $this->ipress = $this->db->escape_str($data); }
    public function settipoReporte($data){ $this->tipoReporte = $this->db->escape_str($data); }
    public function setregion($data){ $this->region = $this->db->escape_str($data); }
    public function setemed_tipo_documento($data){ $this->emed_tipo_documento = $this->db->escape_str($data); }
    public function setdni_responsable_reporte($data){ $this->dni_responsable_reporte = $this->db->escape_str($data); }
    public function setresponsable_reporte($data){ $this->responsable_reporte = $this->db->escape_str($data); }
    public function setocupacion_responsable_reporte($data){ $this->ocupacion_responsable_reporte = $this->db->escape_str($data); }
    public function settelefono_responsable_reporte($data){ $this->telefono_responsable_reporte = $this->db->escape_str($data); }
    public function setsupervidor_tipo_documento($data){ $this->supervidor_tipo_documento = $this->db->escape_str($data); }
    public function setdni_jefe_guardia($data){ $this->dni_jefe_guardia = $this->db->escape_str($data); }
    public function setjefe_guardia($data){ $this->jefe_guardia = $this->db->escape_str($data); }
    public function setocupacion_jefe_guardia($data){ $this->ocupacion_jefe_guardia = $this->db->escape_str($data); }
    public function settelefono_jefe_guardia($data){ $this->telefono_jefe_guardia = $this->db->escape_str($data); }
    public function setatencionInterna($data){ $this->atencionInterna = $this->db->escape_str($data); }
    public function setatencionExterna($data){ $this->atencionExterna = $this->db->escape_str($data); }
    public function setcamaHospitalizado($data){ $this->camaHospitalizado = $this->db->escape_str($data); }
    public function setcamaHospitalizadoInterna($data){ $this->camaHospitalizadoInterna = $this->db->escape_str($data); }
    public function setcamaHospitalizadoExterna($data){ $this->camaHospitalizadoExterna = $this->db->escape_str($data); }
    public function setcamaHospitalizadoTotal($data){ $this->camaHospitalizadoTotal = $this->db->escape_str($data); }
    public function setcamaUci($data){ $this->camaUci = $this->db->escape_str($data); }
    public function setcamaUciInterna($data){ $this->camaUciInterna = $this->db->escape_str($data); }
    public function setcamaUciExterna($data){ $this->camaUciExterna = $this->db->escape_str($data); }
    public function setcamaUciTotal($data){ $this->camaUciTotal = $this->db->escape_str($data); }
    public function setcamaUciPedriatico($data){ $this->camaUciPedriatico = $this->db->escape_str($data); }
    public function setcamaUciPedriaticoInterna($data){ $this->camaUciPedriaticoInterna = $this->db->escape_str($data); }
    public function setcamaUciPedriaticoExterna($data){ $this->camaUciPedriaticoExterna = $this->db->escape_str($data); }
    public function setcamaUciPedriaticoTotal($data){ $this->camaUciPedriaticoTotal = $this->db->escape_str($data); }
    public function setcamaUciTotalSuma($data){ $this->camaUciTotalSuma = $this->db->escape_str($data); }
    public function setfechaRegistro($data){ $this->fechaRegistro = $this->db->escape_str($data); }
    public function setHospitalizacion_convencionales_h($data){ $this->hospitalizacion_convencionales_h = $this->db->escape_str($data); }
    public function setHospitalizacion_convencionales_u($data){ $this->hospitalizacion_convencionales_u = $this->db->escape_str($data); }
    public function setHospitalizacion_convencionales_o($data){ $this->hospitalizacion_convencionales_o = $this->db->escape_str($data); }
    public function setHospitalizacion_covid_o($data){ $this->hospitalizacion_covid_o = $this->db->escape_str($data); }
    public function setHospitalizacion_e_interna_o($data){ $this->hospitalizacion_e_interna_o = $this->db->escape_str($data); }
    public function setHospitalizacion_e_externa_o($data){ $this->hospitalizacion_e_externa_o = $this->db->escape_str($data); }
    public function setHospitalizacion_disponibles_momento($data){ $this->hospitalizacion_disponibles_momento = $this->db->escape_str($data); }
    public function setHospitalizacion_camas_01($data){ $this->hospitalizacion_camas_01 = $this->db->escape_str($data); }
    public function setHospitalizacion_medicos_01($data){ $this->hospitalizacion_medicos_01 = $this->db->escape_str($data); }
    public function setHospitalizacion_indicador_01($data){ $this->hospitalizacion_indicador_01 = $this->db->escape_str($data); }
    public function setHospitalizacion_observaciones_01($data){ $this->hospitalizacion_observaciones_01 = $this->db->escape_str($data); }
    public function setHospitalizacion_camas_02($data){ $this->hospitalizacion_camas_02 = $this->db->escape_str($data); }
    public function setHospitalizacion_enfermeras_02($data){ $this->hospitalizacion_enfermeras_02 = $this->db->escape_str($data); }
    public function setHospitalizacion_indicador_02($data){ $this->hospitalizacion_indicador_02 = $this->db->escape_str($data); }
    public function setHospitalizacion_observaciones_02($data){ $this->hospitalizacion_observaciones_02 = $this->db->escape_str($data); }
    public function setEmergencia_convencionales_o($data){ $this->emergencia_convencionales_o = $this->db->escape_str($data); }
    public function setEmergencia_covid_o($data){ $this->emergencia_covid_o = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_02_h($data){ $this->emergencia_e_externa_02_h = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_02_u($data){ $this->emergencia_e_externa_02_u = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_o_02($data){ $this->emergencia_e_externa_o_02 = $this->db->escape_str($data); }
    public function setEmergencia_e_interna_o($data){ $this->emergencia_e_interna_o = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_o($data){ $this->emergencia_e_externa_o = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_03_h($data){ $this->emergencia_e_externa_03_h = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_03_u($data){ $this->emergencia_e_externa_03_u = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_o_03($data){ $this->emergencia_e_externa_o_03 = $this->db->escape_str($data); }
    public function setEmergencia_pacientes_01($data){ $this->emergencia_pacientes_01 = $this->db->escape_str($data); }
    public function setEmergencia_pacientes_02($data){ $this->emergencia_pacientes_02 = $this->db->escape_str($data); }
    public function setEmergencia_camas_01($data){ $this->emergencia_camas_01 = $this->db->escape_str($data); }
    public function setEmergencia_medicos_01($data){ $this->emergencia_medicos_01 = $this->db->escape_str($data); }
    public function setEmergencia_indicador_01($data){ $this->emergencia_indicador_01 = $this->db->escape_str($data); }
    public function setEmergencia_observaciones_01($data){ $this->emergencia_observaciones_01 = $this->db->escape_str($data); }
    public function setEmergencia_camas_02($data){ $this->emergencia_camas_02 = $this->db->escape_str($data); }
    public function setEmergencia_enfermeras_02($data){ $this->emergencia_enfermeras_02 = $this->db->escape_str($data); }
    public function setEmergencia_indicador_02($data){ $this->emergencia_indicador_02 = $this->db->escape_str($data); }
    public function setEmergencia_observaciones_02($data){ $this->emergencia_observaciones_02= $this->db->escape_str($data); }
    public function setEmergencia_espera_u_momento($data){ $this->emergencia_espera_u_momento= $this->db->escape_str($data); }
    public function setCriticos_convencionales_o($data){ $this->criticos_convencionales_o = $this->db->escape_str($data); }
    public function setCriticos_covid_o($data){ $this->criticos_covid_o = $this->db->escape_str($data); }
    public function setCriticos_e_interna_o($data){ $this->criticos_e_interna_o = $this->db->escape_str($data); }
    public function setCriticos_e_externa_o($data){ $this->criticos_e_externa_o = $this->db->escape_str($data); }
    public function setCriticos_espera_o($data){ $this->criticos_espera_o = $this->db->escape_str($data); }
    public function setCriticos_espera_u_momento($data){ $this->criticos_espera_u_momento = $this->db->escape_str($data); }
    public function setCriticos_espera_u_momento_o($data){ $this->criticos_espera_u_momento_o = $this->db->escape_str($data); }
    public function setCriticos_disponibles_momento($data){ $this->criticos_disponibles_momento = $this->db->escape_str($data); }
    public function setCriticos_camas_01($data){ $this->criticos_camas_01 = $this->db->escape_str($data); }
    public function setCriticos_medicos_01($data){ $this->criticos_medicos_01 = $this->db->escape_str($data); }
    public function setCriticos_indicador_01($data){ $this->criticos_indicador_01 = $this->db->escape_str($data); }
    public function setCriticos_observaciones_01($data){ $this->criticos_observaciones_01 = $this->db->escape_str($data); }
    public function setCriticos_camas_02($data){ $this->criticos_camas_02 = $this->db->escape_str($data); }
    public function setCriticos_enfermeras_02($data){ $this->criticos_enfermeras_02 = $this->db->escape_str($data); }
    public function setCriticos_indicador_02($data){ $this->criticos_indicador_02 = $this->db->escape_str($data); }
    public function setCriticos_observaciones_02($data){ $this->criticos_observaciones_02 = $this->db->escape_str($data); }
    public function setPediatricos_convencionales_o($data){ $this->pediatricos_convencionales_o = $this->db->escape_str($data); }
    public function setPediatricos_covid_o($data){ $this->pediatricos_covid_o = $this->db->escape_str($data); }
    public function setPediatricos_e_interna_o($data){ $this->pediatricos_e_interna_o = $this->db->escape_str($data); }
    public function setPediatricos_e_externa_o($data){ $this->pediatricos_e_externa_o = $this->db->escape_str($data); }
    public function setPediatricos_espera_o($data){ $this->pediatricos_e_externa_o = $this->db->escape_str($data); }
    public function setPediatricos_paciente_01($data){ $this->pediatricos_paciente_01 = $this->db->escape_str($data); }
    public function setPediatricos_paciente_01_o($data){ $this->pediatricos_paciente_01_o = $this->db->escape_str($data); }
    public function setPediatricos_disponibles_momento($data){ $this->pediatricos_disponibles_momento = $this->db->escape_str($data); }
    public function setPediatricos_camas_01($data){ $this->pediatricos_camas_01 = $this->db->escape_str($data); }
    public function setPediatricos_medicos_01($data){ $this->pediatricos_medicos_01 = $this->db->escape_str($data); }
    public function setPediatricos_indicador_01($data){ $this->pediatricos_indicador_01 = $this->db->escape_str($data); }
    public function setPediatricos_observaciones_01($data){ $this->pediatricos_observaciones_01 = $this->db->escape_str($data); }
    public function setPediatricos_camas_02($data){ $this->pediatricos_camas_02 = $this->db->escape_str($data); }
    public function setPediatricos_enfermeras_02($data){ $this->pediatricos_enfermeras_02 = $this->db->escape_str($data); }
    public function setPediatricos_indicador_02($data){ $this->pediatricos_indicador_02 = $this->db->escape_str($data); }
    public function setPediatricos_observaciones_02($data){ $this->pediatricos_observaciones_02 = $this->db->escape_str($data); }
    public function setHospitalizacion_covid_h($data){ $this->hospitalizacion_covid_h = $this->db->escape_str($data); }
    public function setHospitalizacion_covid_u($data){ $this->hospitalizacion_covid_u = $this->db->escape_str($data); }
    public function setHospitalizacion_e_interna_h($data){ $this->hospitalizacion_e_interna_h = $this->db->escape_str($data); }
    public function setHospitalizacion_e_interna_u($data){ $this->hospitalizacion_e_interna_u = $this->db->escape_str($data); }
    public function setHospitalizacion_e_externa_h($data){ $this->hospitalizacion_e_externa_h = $this->db->escape_str($data); }
    public function setHospitalizacion_e_externa_u($data){ $this->hospitalizacion_e_externa_u = $this->db->escape_str($data); }
    public function setHospitalizacion_total_h($data){ $this->hospitalizacion_total_h = $this->db->escape_str($data); }
    public function setHospitalizacion_total_u($data){ $this->hospitalizacion_total_u = $this->db->escape_str($data); }
    public function setHospitalizacion_disponibles($data){ $this->hospitalizacion_disponibles = $this->db->escape_str($data); }
    public function setHospitalizacion_porcentaje_01($data){ $this->hospitalizacion_porcentaje_01 = $this->db->escape_str($data); }
    public function setHospitalizacion_sospechosos_h_covid($data){ $this->hospitalizacion_sospechosos_h_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_sospechosos_u_covid($data){ $this->hospitalizacion_sospechosos_u_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_e_interna_h_covid($data){ $this->hospitalizacion_e_interna_h_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_e_interna_u_covid($data){ $this->hospitalizacion_e_interna_u_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_e_externa_h_covid($data){ $this->hospitalizacion_e_externa_h_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_e_externa_u_covid($data){ $this->hospitalizacion_e_externa_u_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_total_h_covid($data){ $this->hospitalizacion_total_h_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_total_u_covid($data){ $this->hospitalizacion_total_u_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_disponibles_covid($data){ $this->hospitalizacion_disponibles_covid = $this->db->escape_str($data); }
    public function setHospitalizacion_porcentaje_02($data){ $this->hospitalizacion_porcentaje_02 = $this->db->escape_str($data); }
    public function setEmergencia_convencionales_h($data){ $this->emergencia_convencionales_h = $this->db->escape_str($data); }
    public function setEmergencia_convencionales_u($data){ $this->emergencia_convencionales_u = $this->db->escape_str($data); }
    public function setEmergencia_covid_h($data){ $this->emergencia_covid_h = $this->db->escape_str($data); }
    public function setEmergencia_covid_u($data){ $this->emergencia_covid_u = $this->db->escape_str($data); }
    public function setEmergencia_e_interna_h($data){ $this->emergencia_e_interna_h = $this->db->escape_str($data); }
    public function setEmergencia_e_interna_u($data){ $this->emergencia_e_interna_u = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_h($data){ $this->emergencia_e_externa_h = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_u($data){ $this->emergencia_e_externa_u = $this->db->escape_str($data); }
    public function setEmergencia_espera_u($data){ $this->emergencia_espera_u = $this->db->escape_str($data); }
    public function setEmergencia_total_h($data){ $this->emergencia_total_h = $this->db->escape_str($data); }
    public function setEmergencia_total_u($data){ $this->emergencia_total_u = $this->db->escape_str($data); }
    public function setEmergencia_porcentaje_01($data){ $this->emergencia_porcentaje_01 = $this->db->escape_str($data); }
    public function setEmergencia_disponibles($data){ $this->emergencia_disponibles = $this->db->escape_str($data); }
    public function setEmergencia_sospechosos_h_covid($data){ $this->emergencia_sospechosos_h_covid = $this->db->escape_str($data); }
    public function setEmergencia_sospechosos_u_covid($data){ $this->emergencia_sospechosos_u_covid = $this->db->escape_str($data); }
    public function setEmergencia_e_interna_h_covid($data){ $this->emergencia_e_interna_h_covid = $this->db->escape_str($data); }
    public function setEmergencia_e_interna_u_covid($data){ $this->emergencia_e_interna_u_covid = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_h_covid($data){ $this->emergencia_e_externa_h_covid = $this->db->escape_str($data); }
    public function setEmergencia_e_externa_u_covid($data){ $this->emergencia_e_externa_u_covid = $this->db->escape_str($data); }
    public function setEmergencia_espera_u_covid($data){ $this->emergencia_espera_u_covid = $this->db->escape_str($data); }
    public function setEmergencia_total_h_covid($data){ $this->emergencia_total_h_covid = $this->db->escape_str($data); }
    public function setEmergencia_total_u_covid($data){ $this->emergencia_total_u_covid = $this->db->escape_str($data); }
    public function setEmergencia_disponibles_covid($data){ $this->emergencia_disponibles_covid = $this->db->escape_str($data); }
    public function setEmergencia_porcentaje_02($data){ $this->emergencia_porcentaje_02 = $this->db->escape_str($data); }
    public function setCriticos_convencionales_h($data){ $this->criticos_convencionales_h = $this->db->escape_str($data); }
    public function setCriticos_convencionales_u($data){ $this->criticos_convencionales_u = $this->db->escape_str($data); }
    public function setCriticos_covid_h($data){ $this->criticos_covid_h = $this->db->escape_str($data); }
    public function setCriticos_covid_u($data){ $this->criticos_covid_u = $this->db->escape_str($data); }
    public function setCriticos_e_interna_h($data){ $this->criticos_e_interna_h = $this->db->escape_str($data); }
    public function setCriticos_e_interna_u($data){ $this->criticos_e_interna_u = $this->db->escape_str($data); }
    public function setCriticos_e_externa_h($data){ $this->criticos_e_externa_h = $this->db->escape_str($data); }
    public function setCriticos_e_externa_u($data){ $this->criticos_e_externa_u = $this->db->escape_str($data); }
    public function setCriticos_espera_u($data){ $this->criticos_espera_u = $this->db->escape_str($data); }
    public function setCriticos_total_h($data){ $this->criticos_total_h = $this->db->escape_str($data); }
    public function setCriticos_total_u($data){ $this->criticos_total_u = $this->db->escape_str($data); }
    public function setCriticos_disponibles($data){ $this->criticos_disponibles = $this->db->escape_str($data); }
    public function setCriticos_porcentaje_01($data){ $this->criticos_porcentaje_01 = $this->db->escape_str($data); }
    public function setCriticos_sospechosos_h_covid($data){ $this->criticos_sospechosos_h_covid = $this->db->escape_str($data); }
    public function setCriticos_sospechosos_u_covid($data){ $this->criticos_sospechosos_u_covid = $this->db->escape_str($data); }
    public function setCriticos_e_interna_h_covid($data){ $this->criticos_e_interna_h_covid = $this->db->escape_str($data); }
    public function setCriticos_e_interna_u_covid($data){ $this->criticos_e_interna_u_covid = $this->db->escape_str($data); }
    public function setCriticos_e_externa_h_covid($data){ $this->criticos_e_externa_h_covid = $this->db->escape_str($data); }
    public function setCriticos_e_externa_u_covid($data){ $this->criticos_e_externa_u_covid = $this->db->escape_str($data); }
    public function setCriticos_espera_u_covid($data){ $this->criticos_espera_u_covid = $this->db->escape_str($data); }
    public function setCriticos_total_h_covid($data){ $this->criticos_total_h_covid = $this->db->escape_str($data); }
    public function setCriticos_total_u_covid($data){ $this->criticos_total_u_covid = $this->db->escape_str($data); }
    public function setCriticos_disponibles_covid($data){ $this->criticos_disponibles_covid = $this->db->escape_str($data); }
    public function setCriticos_porcentaje_02($data){ $this->criticos_porcentaje_02 = $this->db->escape_str($data); }
    public function setPediatricos_convencionales_h($data){ $this->pediatricos_convencionales_h = $this->db->escape_str($data); }
    public function setPediatricos_convencionales_u($data){ $this->pediatricos_convencionales_u = $this->db->escape_str($data); }
    public function setPediatricos_covid_h($data){ $this->pediatricos_covid_h = $this->db->escape_str($data); }
    public function setPediatricos_covid_u($data){ $this->pediatricos_covid_u = $this->db->escape_str($data); }
    public function setPediatricos_e_interna_h($data){ $this->pediatricos_e_interna_h = $this->db->escape_str($data); }
    public function setPediatricos_e_interna_u($data){ $this->pediatricos_e_interna_u = $this->db->escape_str($data); }
    public function setPediatricos_e_externa_h($data){ $this->pediatricos_e_externa_h = $this->db->escape_str($data); }
    public function setPediatricos_e_externa_u($data){ $this->pediatricos_e_externa_u = $this->db->escape_str($data); }
    public function setPediatricos_espera_u($data){ $this->pediatricos_espera_u = $this->db->escape_str($data); }
    public function setPediatricos_total_h($data){ $this->pediatricos_total_h = $this->db->escape_str($data); }
    public function setPediatricos_total_u($data){ $this->pediatricos_total_u = $this->db->escape_str($data); }
    public function setPediatricos_disponibles($data){ $this->pediatricos_disponibles = $this->db->escape_str($data); }
    public function setPediatricos_porcentaje_01($data){ $this->pediatricos_porcentaje_01 = $this->db->escape_str($data); }
    public function setPediatricos_sospechosos_h_covid($data){ $this->pediatricos_sospechosos_h_covid = $this->db->escape_str($data); }
    public function setPediatricos_sospechosos_u_covid($data){ $this->pediatricos_sospechosos_u_covid = $this->db->escape_str($data); }
    public function setPediatricos_e_interna_h_covid($data){ $this->pediatricos_e_interna_h_covid = $this->db->escape_str($data); }
    public function setPediatricos_e_interna_u_covid($data){ $this->pediatricos_e_interna_u_covid = $this->db->escape_str($data); }
    public function setPediatricos_e_externa_h_covid($data){ $this->pediatricos_e_externa_h_covid = $this->db->escape_str($data); }
    public function setPediatricos_e_externa_u_covid($data){ $this->pediatricos_e_externa_u_covid = $this->db->escape_str($data); }
    public function setPediatricos_espera_u_covid($data){ $this->pediatricos_espera_u_covid = $this->db->escape_str($data); }
    public function setPediatricos_total_h_covid($data){ $this->pediatricos_total_h_covid = $this->db->escape_str($data); }
    public function setPediatricos_total_u_covid($data){ $this->pediatricos_total_u_covid = $this->db->escape_str($data); }
    public function setPediatricos_disponibles_covid($data){ $this->pediatricos_disponibles_covid = $this->db->escape_str($data); }
    public function setPediatricos_porcentaje_02($data){ $this->pediatricos_porcentaje_02 = $this->db->escape_str($data); }
    public function registrar() {
        $data = array(
            "hospitales_situaciones_nombre_id" => $this->ipress,
            "codigo_region" => $this->region,
            "emed_tipo_documento" => $this->emed_tipo_documento,
            "emed_dni" => $this->dni_responsable_reporte,
            "emed_nombre" => $this->responsable_reporte,
            "emed_ocupacion" => $this->ocupacion_responsable_reporte,
            "emed_telefono" => $this->telefono_responsable_reporte,
            "supervidor_tipo_documento" => $this->supervidor_tipo_documento,
            "supervisor_dni" => $this->dni_jefe_guardia,
            "supervisor_nombre" => $this->jefe_guardia,
            "supervisor_ocupacion" => $this->ocupacion_jefe_guardia,
            "supervisor_telefono" => $this->telefono_jefe_guardia,
            "fecha_reporte" => $this->fechaRegistro,
            "hospitalizacion_convencionales_h" => $this->hospitalizacion_convencionales_h,
            "hospitalizacion_convencionales_u" => $this->hospitalizacion_convencionales_u,
            "hospitalizacion_convencionales_o" => $this->hospitalizacion_convencionales_o,
            "hospitalizacion_covid_o" => $this->hospitalizacion_covid_o,
            "hospitalizacion_e_interna_o" => $this->hospitalizacion_e_interna_o,
            "hospitalizacion_e_externa_o" => $this->hospitalizacion_e_externa_o,
            "hospitalizacion_disponibles_momento" => $this->hospitalizacion_disponibles_momento,
            "hospitalizacion_camas_01" => $this->hospitalizacion_camas_01,
            "hospitalizacion_medicos_01" => $this->hospitalizacion_medicos_01,
            "hospitalizacion_indicador_01" => $this->hospitalizacion_indicador_01,
            "hospitalizacion_observaciones_01" => $this->hospitalizacion_observaciones_01,
            "hospitalizacion_camas_02" => $this->hospitalizacion_camas_02,
            "hospitalizacion_enfermeras_02" => $this->hospitalizacion_enfermeras_02,
            "hospitalizacion_indicador_02" => $this->hospitalizacion_indicador_02,
            "hospitalizacion_observaciones_02" => $this->hospitalizacion_observaciones_02,
            "emergencia_convencionales_o" => $this->emergencia_convencionales_o,
            "emergencia_covid_o" => $this->emergencia_covid_o,
            "emergencia_e_externa_02_h" => $this->emergencia_e_externa_02_h,
            "emergencia_e_externa_02_u" => $this->emergencia_e_externa_02_u,
            "emergencia_e_externa_o_02" => $this->emergencia_e_externa_o_02,
            "emergencia_e_interna_o" => $this->emergencia_e_interna_o,
            "emergencia_e_externa_o" => $this->emergencia_e_externa_o,
            "emergencia_e_externa_03_h" => $this->emergencia_e_externa_03_h,
            "emergencia_e_externa_03_u" => $this->emergencia_e_externa_03_u,
            "emergencia_e_externa_o_03" => $this->emergencia_e_externa_o_03,
            "emergencia_pacientes_01" => $this->emergencia_pacientes_01,
            "emergencia_pacientes_02" => $this->emergencia_pacientes_02,
            "emergencia_camas_01" => $this->emergencia_camas_01,
            "emergencia_medicos_01" => $this->emergencia_medicos_01,
            "emergencia_indicador_01" => $this->emergencia_indicador_01,
            "emergencia_observaciones_01" => $this->emergencia_observaciones_01,
            "emergencia_camas_02" => $this->emergencia_camas_02,
            "emergencia_enfermeras_02" => $this->emergencia_enfermeras_02,
            "emergencia_indicador_02" => $this->emergencia_indicador_02,
            "emergencia_observaciones_02" => $this->emergencia_observaciones_02,
            "emergencia_observaciones_02" => $this->emergencia_observaciones_02,
            "emergencia_espera_u_momento" => $this->emergencia_espera_u_momento,
            "criticos_convencionales_o" => $this->criticos_convencionales_o,
            "criticos_covid_o" => $this->criticos_covid_o,
            "criticos_e_interna_o" => $this->criticos_e_interna_o,
            "criticos_e_externa_o" => $this->criticos_e_externa_o,
            "criticos_espera_o" => $this->criticos_espera_o,
            "criticos_espera_u_momento" => $this->criticos_espera_u_momento,
            "criticos_espera_u_momento_o" => $this->criticos_espera_u_momento_o,
            "criticos_disponibles_momento" => $this->criticos_disponibles_momento,
            "criticos_camas_01" => $this->criticos_camas_01,
            "criticos_medicos_01" => $this->criticos_medicos_01,
            "criticos_indicador_01" => $this->criticos_indicador_01,
            "criticos_observaciones_01" => $this->criticos_observaciones_01,
            "criticos_camas_02" => $this->criticos_camas_02,
            "criticos_enfermeras_02" => $this->criticos_enfermeras_02,
            "criticos_indicador_02" => $this->criticos_indicador_02,
            "criticos_observaciones_02" => $this->criticos_observaciones_02,
            "pediatricos_convencionales_o" => $this->pediatricos_convencionales_o,
            "pediatricos_covid_o" => $this->pediatricos_covid_o,
            "pediatricos_e_interna_o" => $this->pediatricos_e_interna_o,
            "pediatricos_e_externa_o" => $this->pediatricos_e_externa_o,
            "pediatricos_espera_o" => $this->pediatricos_espera_o,
            "pediatricos_paciente_01" => $this->pediatricos_paciente_01,
            "pediatricos_paciente_01_o" => $this->pediatricos_paciente_01_o,
            "pediatricos_disponibles_momento" => $this->pediatricos_disponibles_momento,
            "pediatricos_camas_01" => $this->pediatricos_camas_01,
            "pediatricos_medicos_01" => $this->pediatricos_medicos_01,
            "pediatricos_indicador_01" => $this->pediatricos_indicador_01,
            "pediatricos_observaciones_01" => $this->pediatricos_observaciones_01,
            "pediatricos_camas_02" => $this->pediatricos_camas_02,
            "pediatricos_enfermeras_02" => $this->pediatricos_enfermeras_02,
            "pediatricos_indicador_02" => $this->pediatricos_indicador_02,
            "pediatricos_observaciones_02" => $this->pediatricos_observaciones_02,
            "hospitalizacion_covid_h" => $this->hospitalizacion_covid_h,
            "hospitalizacion_covid_u" => $this->hospitalizacion_covid_u,
            "hospitalizacion_e_interna_h" => $this->hospitalizacion_e_interna_h,
            "hospitalizacion_e_interna_u" => $this->hospitalizacion_e_interna_u,
            "hospitalizacion_e_externa_h" => $this->hospitalizacion_e_externa_h,
            "hospitalizacion_e_externa_u" => $this->hospitalizacion_e_externa_u,
            "hospitalizacion_total_h" => $this->hospitalizacion_total_h,
            "hospitalizacion_total_u" => $this->hospitalizacion_total_u,
            "hospitalizacion_disponibles" => $this->hospitalizacion_disponibles,
            "hospitalizacion_porcentaje_01" => $this->hospitalizacion_porcentaje_01,
            "hospitalizacion_sospechosos_h_covid" => $this->hospitalizacion_sospechosos_h_covid,
            "hospitalizacion_sospechosos_u_covid" => $this->hospitalizacion_sospechosos_u_covid,
            "hospitalizacion_e_interna_h_covid" => $this->hospitalizacion_e_interna_h_covid,
            "hospitalizacion_e_interna_u_covid" => $this->hospitalizacion_e_interna_u_covid,
            "hospitalizacion_e_externa_h_covid" => $this->hospitalizacion_e_externa_h_covid,
            "hospitalizacion_e_externa_u_covid" => $this->hospitalizacion_e_externa_u_covid,
            "hospitalizacion_total_h_covid" => $this->hospitalizacion_total_h_covid,
            "hospitalizacion_total_u_covid" => $this->hospitalizacion_total_u_covid,
            "hospitalizacion_disponibles_covid" => $this->hospitalizacion_disponibles_covid,
            "hospitalizacion_porcentaje_02" => $this->hospitalizacion_porcentaje_02,
            "emergencia_convencionales_h" => $this->emergencia_convencionales_h,
            "emergencia_convencionales_u" => $this->emergencia_convencionales_u,
            "emergencia_covid_h" => $this->emergencia_covid_h,
            "emergencia_covid_u" => $this->emergencia_covid_u,
            "emergencia_e_interna_h" => $this->emergencia_e_interna_h,
            "emergencia_e_interna_u" => $this->emergencia_e_interna_u,
            "emergencia_e_externa_h" => $this->emergencia_e_externa_h,
            "emergencia_e_externa_u" => $this->emergencia_e_externa_u,
            "emergencia_espera_u" => $this->emergencia_espera_u,
            "emergencia_total_h" => $this->emergencia_total_h,
            "emergencia_total_u" => $this->emergencia_total_u,
            "emergencia_porcentaje_01" => $this->emergencia_porcentaje_01,
            "emergencia_disponibles" => $this->emergencia_disponibles,
            "emergencia_sospechosos_h_covid" => $this->emergencia_sospechosos_h_covid,
            "emergencia_sospechosos_u_covid" => $this->emergencia_sospechosos_u_covid,
            "emergencia_e_interna_h_covid" => $this->emergencia_e_interna_h_covid,
            "emergencia_e_interna_u_covid" => $this->emergencia_e_interna_u_covid,
            "emergencia_e_externa_h_covid" => $this->emergencia_e_externa_h_covid,
            "emergencia_e_externa_u_covid" => $this->emergencia_e_externa_u_covid,
            "emergencia_espera_u_covid" => $this->emergencia_espera_u_covid,
            "emergencia_total_h_covid" => $this->emergencia_total_h_covid,
            "emergencia_total_u_covid" => $this->emergencia_total_u_covid,
            "emergencia_disponibles_covid" => $this->emergencia_disponibles_covid,
            "emergencia_porcentaje_02" => $this->emergencia_porcentaje_02,
            "criticos_convencionales_h" => $this->criticos_convencionales_h,
            "criticos_convencionales_u" => $this->criticos_convencionales_u,
            "criticos_covid_h" => $this->criticos_covid_h,
            "criticos_covid_u" => $this->criticos_covid_u,
            "criticos_e_interna_h" => $this->criticos_e_interna_h,
            "criticos_e_interna_u" => $this->criticos_e_interna_u,
            "criticos_e_externa_h" => $this->criticos_e_externa_h,
            "criticos_e_externa_u" => $this->criticos_e_externa_u,
            "criticos_espera_u" => $this->criticos_espera_u,
            "criticos_total_h" => $this->criticos_total_h,
            "criticos_total_u" => $this->criticos_total_u,
            "criticos_disponibles" => $this->criticos_disponibles,
            "criticos_porcentaje_01" => $this->criticos_porcentaje_01,
            "criticos_sospechosos_h_covid" => $this->criticos_sospechosos_h_covid,
            "criticos_sospechosos_u_covid" => $this->criticos_sospechosos_u_covid,
            "criticos_e_interna_h_covid" => $this->criticos_e_interna_h_covid,
            "criticos_e_interna_u_covid" => $this->criticos_e_interna_u_covid,
            "criticos_e_externa_h_covid" => $this->criticos_e_externa_h_covid,
            "criticos_e_externa_u_covid" => $this->criticos_e_externa_u_covid,
            "criticos_espera_u_covid" => $this->criticos_espera_u_covid,
            "criticos_total_h_covid" => $this->criticos_total_h_covid,
            "criticos_total_u_covid" => $this->criticos_total_u_covid,
            "criticos_disponibles_covid" => $this->criticos_disponibles_covid,
            "criticos_porcentaje_02" => $this->criticos_porcentaje_02,
            "pediatricos_convencionales_h" => $this->pediatricos_convencionales_h,
            "pediatricos_convencionales_u" => $this->pediatricos_convencionales_u,
            "pediatricos_covid_h" => $this->pediatricos_covid_h,
            "pediatricos_covid_u" => $this->pediatricos_covid_u,
            "pediatricos_e_interna_h" => $this->pediatricos_e_interna_h,
            "pediatricos_e_interna_u" => $this->pediatricos_e_interna_u,
            "pediatricos_e_externa_h" => $this->pediatricos_e_externa_h,
            "pediatricos_e_externa_u" => $this->pediatricos_e_externa_u,
            "pediatricos_espera_u" => $this->pediatricos_espera_u,
            "pediatricos_total_h" => $this->pediatricos_total_h,
            "pediatricos_total_u" => $this->pediatricos_total_u,
            "pediatricos_disponibles" => $this->pediatricos_disponibles,
            "pediatricos_porcentaje_01" => $this->pediatricos_porcentaje_01,
            "pediatricos_sospechosos_h_covid" => $this->pediatricos_sospechosos_h_covid,
            "pediatricos_sospechosos_u_covid" => $this->pediatricos_sospechosos_u_covid,
            "pediatricos_e_interna_h_covid" => $this->pediatricos_e_interna_h_covid,
            "pediatricos_e_interna_u_covid" => $this->pediatricos_e_interna_u_covid,
            "pediatricos_e_externa_h_covid" => $this->pediatricos_e_externa_h_covid,
            "pediatricos_e_externa_u_covid" => $this->pediatricos_e_externa_u_covid,
            "pediatricos_espera_u_covid" => $this->pediatricos_espera_u_covid,
            "pediatricos_total_h_covid" => $this->pediatricos_total_h_covid,
            "pediatricos_total_u_covid" => $this->pediatricos_total_u_covid,
            "pediatricos_disponibles_covid" => $this->pediatricos_disponibles_covid,
            "pediatricos_porcentaje_02" => $this->pediatricos_porcentaje_02,
            "estado" => "1"
        );
        if ($this->db->insert('hospitales_sobredemanda_new', $data))
            return $this->db->insert_id();
            else
                return false;
    }
    public function actualizar() {
        $this->db->set("hospitales_situaciones_nombre_id",$this->ipress, TRUE);
        $this->db->set("codigo_region",$this->region, TRUE);
        $this->db->set("emed_tipo_documento",$this->emed_tipo_documento, TRUE);
        $this->db->set("emed_dni",$this->dni_responsable_reporte, TRUE);
        $this->db->set("emed_nombre",$this->responsable_reporte, TRUE);
        $this->db->set("emed_ocupacion",$this->ocupacion_responsable_reporte, TRUE);
        $this->db->set("emed_telefono",$this->telefono_responsable_reporte, TRUE);
        $this->db->set("supervidor_tipo_documento",$this->supervidor_tipo_documento, TRUE);
        $this->db->set("supervisor_dni",$this->dni_jefe_guardia, TRUE);
        $this->db->set("supervisor_nombre",$this->jefe_guardia, TRUE);
        $this->db->set("supervisor_ocupacion",$this->ocupacion_jefe_guardia, TRUE);
        $this->db->set("supervisor_telefono",$this->telefono_jefe_guardia, TRUE);
        $this->db->set("fecha_reporte",$this->fechaRegistro, TRUE);
        $this->db->set("hospitalizacion_convencionales_h",$this->hospitalizacion_convencionales_h, TRUE);
        $this->db->set("hospitalizacion_convencionales_u",$this->hospitalizacion_convencionales_u, TRUE);
        $this->db->set("hospitalizacion_covid_h",$this->hospitalizacion_covid_h, TRUE);
        $this->db->set("hospitalizacion_covid_u",$this->hospitalizacion_covid_u, TRUE);
        $this->db->set("hospitalizacion_e_interna_h",$this->hospitalizacion_e_interna_h, TRUE);
        $this->db->set("hospitalizacion_e_interna_u",$this->hospitalizacion_e_interna_u, TRUE);
        $this->db->set("hospitalizacion_e_externa_h",$this->hospitalizacion_e_externa_h, TRUE);
        $this->db->set("hospitalizacion_e_externa_u",$this->hospitalizacion_e_externa_u, TRUE);
        $this->db->set("hospitalizacion_total_h",$this->hospitalizacion_total_h, TRUE);
        $this->db->set("hospitalizacion_total_u",$this->hospitalizacion_total_u, TRUE);
        $this->db->set("hospitalizacion_disponibles",$this->hospitalizacion_disponibles, TRUE);
        $this->db->set("hospitalizacion_porcentaje_01",$this->hospitalizacion_porcentaje_01, TRUE);
        $this->db->set("hospitalizacion_sospechosos_h_covid",$this->hospitalizacion_sospechosos_h_covid, TRUE);
        $this->db->set("hospitalizacion_sospechosos_u_covid",$this->hospitalizacion_sospechosos_u_covid, TRUE);
        $this->db->set("hospitalizacion_e_interna_h_covid",$this->hospitalizacion_e_interna_h_covid, TRUE);
        $this->db->set("hospitalizacion_e_interna_u_covid",$this->hospitalizacion_e_interna_u_covid, TRUE);
        $this->db->set("hospitalizacion_e_externa_h_covid",$this->hospitalizacion_e_externa_h_covid, TRUE);
        $this->db->set("hospitalizacion_e_externa_u_covid",$this->hospitalizacion_e_externa_u_covid, TRUE);
        $this->db->set("hospitalizacion_total_h_covid",$this->hospitalizacion_total_h_covid, TRUE);
        $this->db->set("hospitalizacion_total_u_covid",$this->hospitalizacion_total_u_covid, TRUE);
        $this->db->set("hospitalizacion_disponibles_covid",$this->hospitalizacion_disponibles_covid, TRUE);
        $this->db->set("hospitalizacion_porcentaje_02",$this->hospitalizacion_porcentaje_02, TRUE);
        $this->db->set("emergencia_convencionales_h",$this->emergencia_convencionales_h, TRUE);
        $this->db->set("emergencia_convencionales_u",$this->emergencia_convencionales_u, TRUE);
        $this->db->set("emergencia_covid_h",$this->emergencia_covid_h, TRUE);
        $this->db->set("emergencia_covid_u",$this->emergencia_covid_u, TRUE);
        $this->db->set("emergencia_e_interna_h",$this->emergencia_e_interna_h, TRUE);
        $this->db->set("emergencia_e_interna_u",$this->emergencia_e_interna_u, TRUE);
        $this->db->set("emergencia_e_externa_h",$this->emergencia_e_externa_h, TRUE);
        $this->db->set("emergencia_e_externa_u",$this->emergencia_e_externa_u, TRUE);
        $this->db->set("emergencia_espera_u",$this->emergencia_espera_u, TRUE);
        $this->db->set("emergencia_total_h",$this->emergencia_total_h, TRUE);
        $this->db->set("emergencia_total_u",$this->emergencia_total_u, TRUE);
        $this->db->set("emergencia_porcentaje_01",$this->emergencia_porcentaje_01, TRUE);
        $this->db->set("emergencia_disponibles",$this->emergencia_disponibles, TRUE);
        $this->db->set("emergencia_sospechosos_h_covid",$this->emergencia_sospechosos_h_covid, TRUE);
        $this->db->set("emergencia_sospechosos_u_covid",$this->emergencia_sospechosos_u_covid, TRUE);
        $this->db->set("emergencia_e_interna_h_covid",$this->emergencia_e_interna_h_covid, TRUE);
        $this->db->set("emergencia_e_interna_u_covid",$this->emergencia_e_interna_u_covid, TRUE);
        $this->db->set("emergencia_e_externa_h_covid",$this->emergencia_e_externa_h_covid, TRUE);
        $this->db->set("emergencia_e_externa_u_covid",$this->emergencia_e_externa_u_covid, TRUE);
        $this->db->set("emergencia_espera_u_covid",$this->emergencia_espera_u_covid, TRUE);
        $this->db->set("emergencia_total_h_covid",$this->emergencia_total_h_covid, TRUE);
        $this->db->set("emergencia_total_u_covid",$this->emergencia_total_u_covid, TRUE);
        $this->db->set("emergencia_disponibles_covid",$this->emergencia_disponibles_covid, TRUE);
        $this->db->set("emergencia_porcentaje_02",$this->emergencia_porcentaje_02, TRUE);
        $this->db->set("criticos_convencionales_h",$this->criticos_convencionales_h, TRUE);
        $this->db->set("criticos_convencionales_u",$this->criticos_convencionales_u, TRUE);
        $this->db->set("criticos_covid_h",$this->criticos_covid_h, TRUE);
        $this->db->set("criticos_covid_u",$this->criticos_covid_u, TRUE);
        $this->db->set("criticos_e_interna_h",$this->criticos_e_interna_h, TRUE);
        $this->db->set("criticos_e_interna_u",$this->criticos_e_interna_u, TRUE);
        $this->db->set("criticos_e_externa_h",$this->criticos_e_externa_h, TRUE);
        $this->db->set("criticos_e_externa_u",$this->criticos_e_externa_u, TRUE);
        $this->db->set("criticos_espera_u",$this->criticos_espera_u, TRUE);
        $this->db->set("criticos_total_h",$this->criticos_total_h, TRUE);
        $this->db->set("criticos_total_u",$this->criticos_total_u, TRUE);
        $this->db->set("criticos_disponibles",$this->criticos_disponibles, TRUE);
        $this->db->set("criticos_porcentaje_01",$this->criticos_porcentaje_01, TRUE);
        $this->db->set("criticos_sospechosos_h_covid",$this->criticos_sospechosos_h_covid, TRUE);
        $this->db->set("criticos_sospechosos_u_covid",$this->criticos_sospechosos_u_covid, TRUE);
        $this->db->set("criticos_e_interna_h_covid",$this->criticos_e_interna_h_covid, TRUE);
        $this->db->set("criticos_e_interna_u_covid",$this->criticos_e_interna_u_covid, TRUE);
        $this->db->set("criticos_e_externa_h_covid",$this->criticos_e_externa_h_covid, TRUE);
        $this->db->set("criticos_e_externa_u_covid",$this->criticos_e_externa_u_covid, TRUE);
        $this->db->set("criticos_espera_u_covid",$this->criticos_espera_u_covid, TRUE);
        $this->db->set("criticos_total_h_covid",$this->criticos_total_h_covid, TRUE);
        $this->db->set("criticos_total_u_covid",$this->criticos_total_u_covid, TRUE);
        $this->db->set("criticos_disponibles_covid",$this->criticos_disponibles_covid, TRUE);
        $this->db->set("criticos_porcentaje_02",$this->criticos_porcentaje_02, TRUE);
        $this->db->set("pediatricos_convencionales_h",$this->pediatricos_convencionales_h, TRUE);
        $this->db->set("pediatricos_convencionales_u",$this->pediatricos_convencionales_u, TRUE);
        $this->db->set("pediatricos_covid_h",$this->pediatricos_covid_h, TRUE);
        $this->db->set("pediatricos_covid_u",$this->pediatricos_covid_u, TRUE);
        $this->db->set("pediatricos_e_interna_h",$this->pediatricos_e_interna_h, TRUE);
        $this->db->set("pediatricos_e_interna_u",$this->pediatricos_e_interna_u, TRUE);
        $this->db->set("pediatricos_e_externa_h",$this->pediatricos_e_externa_h, TRUE);
        $this->db->set("pediatricos_e_externa_u",$this->pediatricos_e_externa_u, TRUE);
        $this->db->set("pediatricos_espera_u",$this->pediatricos_espera_u, TRUE);
        $this->db->set("pediatricos_total_h",$this->pediatricos_total_h, TRUE);
        $this->db->set("pediatricos_total_u",$this->pediatricos_total_u, TRUE);
        $this->db->set("pediatricos_disponibles",$this->pediatricos_disponibles, TRUE);
        $this->db->set("pediatricos_porcentaje_01",$this->pediatricos_porcentaje_01, TRUE);
        $this->db->set("pediatricos_sospechosos_h_covid",$this->pediatricos_sospechosos_h_covid, TRUE);
        $this->db->set("pediatricos_sospechosos_u_covid",$this->pediatricos_sospechosos_u_covid, TRUE);
        $this->db->set("pediatricos_e_interna_h_covid",$this->pediatricos_e_interna_h_covid, TRUE);
        $this->db->set("pediatricos_e_interna_u_covid",$this->pediatricos_e_interna_u_covid, TRUE);
        $this->db->set("pediatricos_e_externa_h_covid",$this->pediatricos_e_externa_h_covid, TRUE);
        $this->db->set("pediatricos_e_externa_u_covid",$this->pediatricos_e_externa_u_covid, TRUE);
        $this->db->set("pediatricos_espera_u_covid",$this->pediatricos_espera_u_covid, TRUE);
        $this->db->set("pediatricos_total_h_covid",$this->pediatricos_total_h_covid, TRUE);
        $this->db->set("pediatricos_total_u_covid",$this->pediatricos_total_u_covid, TRUE);
        $this->db->set("pediatricos_disponibles_covid",$this->pediatricos_disponibles_covid, TRUE);
        $this->db->set("pediatricos_porcentaje_02",$this->pediatricos_porcentaje_02, TRUE);
        $this->db->set("hospitalizacion_convencionales_o",$this->hospitalizacion_convencionales_o, TRUE);
        $this->db->set("hospitalizacion_covid_o",$this->hospitalizacion_covid_o, TRUE);
        $this->db->set("hospitalizacion_e_interna_o",$this->hospitalizacion_e_interna_o, TRUE);
        $this->db->set("hospitalizacion_e_externa_o",$this->hospitalizacion_e_externa_o, TRUE);
        $this->db->set("hospitalizacion_disponibles_momento",$this->hospitalizacion_disponibles_momento, TRUE);
        $this->db->set("hospitalizacion_camas_01",$this->hospitalizacion_camas_01, TRUE);
        $this->db->set("hospitalizacion_medicos_01",$this->hospitalizacion_medicos_01, TRUE);
        $this->db->set("hospitalizacion_indicador_01",$this->hospitalizacion_indicador_01, TRUE);
        $this->db->set("hospitalizacion_observaciones_01",$this->hospitalizacion_observaciones_01, TRUE);
        $this->db->set("hospitalizacion_camas_02",$this->hospitalizacion_camas_02, TRUE);
        $this->db->set("hospitalizacion_enfermeras_02",$this->hospitalizacion_enfermeras_02, TRUE);
        $this->db->set("hospitalizacion_indicador_02",$this->hospitalizacion_indicador_02, TRUE);
        $this->db->set("hospitalizacion_observaciones_02",$this->hospitalizacion_observaciones_02, TRUE);
        $this->db->set("emergencia_convencionales_o",$this->emergencia_convencionales_o, TRUE);   
        $this->db->set("emergencia_covid_o",$this->emergencia_covid_o, TRUE);   
        $this->db->set("emergencia_e_externa_02_h",$this->emergencia_e_externa_02_h, TRUE);   
        $this->db->set("emergencia_e_externa_02_u",$this->emergencia_e_externa_02_u, TRUE); 
        $this->db->set("emergencia_e_externa_o_02",$this->emergencia_e_externa_o_02, TRUE); 
        $this->db->set("emergencia_e_interna_o",$this->emergencia_e_interna_o, TRUE); 
        $this->db->set("emergencia_e_externa_o",$this->emergencia_e_externa_o, TRUE); 
        $this->db->set("emergencia_e_externa_03_h",$this->emergencia_e_externa_03_h, TRUE);
        $this->db->set("emergencia_e_externa_03_u",$this->emergencia_e_externa_03_u, TRUE);
        $this->db->set("emergencia_e_externa_o_03",$this->emergencia_e_externa_o_03, TRUE);
        $this->db->set("emergencia_pacientes_01",$this->emergencia_pacientes_01, TRUE);
        $this->db->set("emergencia_pacientes_02",$this->emergencia_pacientes_02, TRUE);
        $this->db->set("emergencia_camas_01",$this->emergencia_camas_01, TRUE);
        $this->db->set("emergencia_medicos_01",$this->emergencia_medicos_01, TRUE);
        $this->db->set("emergencia_indicador_01",$this->emergencia_indicador_01, TRUE);
        $this->db->set("emergencia_observaciones_01",$this->emergencia_observaciones_01, TRUE);
        $this->db->set("emergencia_camas_02",$this->emergencia_camas_02, TRUE);
        $this->db->set("emergencia_enfermeras_02",$this->emergencia_enfermeras_02, TRUE);
        $this->db->set("emergencia_indicador_02",$this->emergencia_indicador_02, TRUE);
        $this->db->set("emergencia_observaciones_02",$this->emergencia_observaciones_02, TRUE);
        $this->db->set("emergencia_espera_u_momento",$this->emergencia_espera_u_momento, TRUE);
        $this->db->set("criticos_convencionales_o",$this->criticos_convencionales_o, TRUE);
        $this->db->set("criticos_covid_o",$this->criticos_covid_o, TRUE);
        $this->db->set("criticos_e_interna_o",$this->criticos_e_interna_o, TRUE);
        $this->db->set("criticos_e_externa_o",$this->criticos_e_externa_o, TRUE);
        $this->db->set("criticos_espera_o",$this->criticos_espera_o, TRUE);
        $this->db->set("criticos_espera_u_momento",$this->criticos_espera_u_momento, TRUE);
        $this->db->set("criticos_espera_u_momento_o",$this->criticos_espera_u_momento_o, TRUE);
        $this->db->set("criticos_disponibles_momento",$this->criticos_disponibles_momento, TRUE);
        $this->db->set("criticos_camas_01",$this->criticos_camas_01, TRUE);
        $this->db->set("criticos_medicos_01",$this->criticos_medicos_01, TRUE);
        $this->db->set("criticos_indicador_01",$this->criticos_indicador_01, TRUE);
        $this->db->set("criticos_observaciones_01",$this->criticos_observaciones_01, TRUE);
        $this->db->set("criticos_camas_02",$this->criticos_camas_02, TRUE);
        $this->db->set("criticos_enfermeras_02",$this->criticos_enfermeras_02, TRUE);
        $this->db->set("criticos_indicador_02",$this->criticos_indicador_02, TRUE);
        $this->db->set("criticos_observaciones_02",$this->criticos_observaciones_02, TRUE);
        $this->db->set("pediatricos_convencionales_o",$this->pediatricos_convencionales_o, TRUE);
        $this->db->set("pediatricos_covid_o",$this->pediatricos_covid_o, TRUE);
        $this->db->set("pediatricos_e_interna_o",$this->pediatricos_e_interna_o, TRUE);
         $this->db->set("pediatricos_e_externa_o",$this->pediatricos_e_externa_o, TRUE);
         $this->db->set("pediatricos_espera_o",$this->pediatricos_espera_o, TRUE);
         $this->db->set("pediatricos_paciente_01",$this->pediatricos_paciente_01, TRUE);
         $this->db->set("pediatricos_paciente_01_o",$this->pediatricos_paciente_01_o, TRUE);
         $this->db->set("pediatricos_disponibles_momento",$this->pediatricos_disponibles_momento, TRUE);
         $this->db->set("pediatricos_camas_01",$this->pediatricos_camas_01, TRUE);
         $this->db->set("pediatricos_medicos_01",$this->pediatricos_medicos_01, TRUE);
         $this->db->set("pediatricos_indicador_01",$this->pediatricos_indicador_01, TRUE);
         $this->db->set("pediatricos_observaciones_01",$this->pediatricos_observaciones_01, TRUE);
         $this->db->set("pediatricos_camas_02",$this->pediatricos_camas_02, TRUE);
         $this->db->set("pediatricos_enfermeras_02",$this->pediatricos_enfermeras_02, TRUE);
         $this->db->set("pediatricos_indicador_02",$this->pediatricos_indicador_02, TRUE);
         $this->db->set("pediatricos_observaciones_02",$this->pediatricos_observaciones_02, TRUE);
        $this->db->where("idsobredemanda", $this->id);
        if ($this->db->update('hospitales_sobredemanda_new'))
            return true;
            else
                return false;
    }
    public function editar() {
        $this->db->set("dni_responsable_reporte",$this->dni_responsable_reporte, TRUE);
        $this->db->set("responsable_reporte",$this->responsable_reporte, TRUE);
        $this->db->set("cmp_responsable_reporte",$this->cmp_responsable_reporte, TRUE);
        $this->db->set("rne_responsable_reporte",$this->rne_responsable_reporte, TRUE);
        $this->db->set("dni_jefe_guardia",$this->dni_jefe_guardia, TRUE);
        $this->db->set("jefe_guardia",$this->jefe_guardia, TRUE);
        $this->db->set("cmp_jefe_guardia",$this->cmp_jefe_guardia, TRUE);
        $this->db->set("rne_jefe_guardia",$this->rne_jefe_guardia, TRUE);
        $this->db->set("telefono",$this->telefono, TRUE);
        $this->db->set("nedocs_shock_trauma",$this->nedocs_shock_trauma, TRUE);
        $this->db->set("nedocs_medicina",$this->nedocs_medicina, TRUE);
        $this->db->set("nedocs_cirugia",$this->nedocs_cirugia, TRUE);
        $this->db->set("nedocs_gineco_obstetricia",$this->nedocs_gineco_obstetricia, TRUE);
        $this->db->set("nedocs_pedriatria",$this->nedocs_pedriatria, TRUE);
        $this->db->set("nedocs_observacion_medicina",$this->nedocs_observacion_medicina, TRUE);
        $this->db->set("nedocs_observacion_cirugia",$this->nedocs_observacion_cirugia, TRUE);
        $this->db->set("nedocs_observacion_gineco_obstetricia",$this->nedocs_observacion_gineco_obstetricia, TRUE);
        $this->db->set("nedocs_observacion_pediatria",$this->nedocs_observacion_pediatria, TRUE);
        $this->db->set("nedocs_camas_emergencia_ocupadas_pasillos",$this->nedocs_camas_emergencia_ocupadas_pasillos, TRUE);
        $this->db->set("nedocs_camas_emergencia_ocupadas_areas_contigencia",$this->nedocs_camas_emergencia_ocupadas_areas_contigencia, TRUE);
        $this->db->set("nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres",$this->nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres, TRUE);
        $this->db->set("nedocs_capacidad_expansion_emergencias_desastres",$this->nedocs_capacidad_expansion_emergencias_desastres, TRUE);
        $this->db->set("nedocs_tiempo_espera_ensala_ultimo_paciente_llamado",$this->nedocs_tiempo_espera_ensala_ultimo_paciente_llamado, TRUE);
        $this->db->set("nedocs_tiempo_espera_mas_largo_por_cama_de_internacion",$this->nedocs_tiempo_espera_mas_largo_por_cama_de_internacion, TRUE);
        $this->db->set("nedocs_pacientes_espera_cama_internamiento",$this->nedocs_pacientes_espera_cama_internamiento, TRUE);
        $this->db->set("nedocs_cantidad_total_pacientes_ventilacion",$this->nedocs_cantidad_total_pacientes_ventilacion, TRUE);
        $this->db->set("nedocs_cantidad_total_camas_hospital",$this->nedocs_cantidad_total_camas_hospital, TRUE);
        $this->db->set("nedocs_resultado",$this->nedocs_resultado, TRUE);
        $this->db->set("emergencia_camas_ogti_shock_trauma",$this->emergencia_camas_ogti_shock_trauma, TRUE);
        $this->db->set("emergencia_camas_ogti_medicina",$this->emergencia_camas_ogti_medicina, TRUE);
        $this->db->set("emergencia_camas_ogti_cirugia",$this->emergencia_camas_ogti_cirugia, TRUE);
        $this->db->set("emergencia_camas_ogti_gineco_obstetricia",$this->emergencia_camas_ogti_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_ogti_pedriatria",$this->emergencia_camas_ogti_pedriatria, TRUE);
        $this->db->set("emergencia_camas_ogti_observacion_medicina",$this->emergencia_camas_ogti_observacion_medicina, TRUE);
        $this->db->set("emergencia_camas_ogti_observacion_cirugia",$this->emergencia_camas_ogti_observacion_cirugia, TRUE);
        $this->db->set("emergencia_camas_ogti_observacion_gineco_obstetricia",$this->emergencia_camas_ogti_observacion_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_ogti_observacion_pediatria",$this->emergencia_camas_ogti_observacion_pediatria, TRUE);
        $this->db->set("emergencia_camas_pasillos_shock_trauma",$this->emergencia_camas_pasillos_shock_trauma, TRUE);
        $this->db->set("emergencia_camas_pasillos_medicina",$this->emergencia_camas_pasillos_medicina, TRUE);
        $this->db->set("emergencia_camas_pasillos_cirugia",$this->emergencia_camas_pasillos_cirugia, TRUE);
        $this->db->set("emergencia_camas_pasillos_gineco_obstetricia",$this->emergencia_camas_pasillos_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_pasillos_pedriatria",$this->emergencia_camas_pasillos_pedriatria, TRUE);
        $this->db->set("emergencia_camas_pasillos_observacion_medicina",$this->emergencia_camas_pasillos_observacion_medicina, TRUE);
        $this->db->set("emergencia_camas_pasillos_observacion_cirugia",$this->emergencia_camas_pasillos_observacion_cirugia, TRUE);
        $this->db->set("emergencia_camas_pasillos_observacion_gineco_obstetricia",$this->emergencia_camas_pasillos_observacion_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_pasillos_observacion_pediatria",$this->emergencia_camas_pasillos_observacion_pediatria, TRUE);
        $this->db->set("emergencia_camas_contingencia_shock_trauma",$this->emergencia_camas_contingencia_shock_trauma, TRUE);
        $this->db->set("emergencia_camas_contingencia_medicina",$this->emergencia_camas_contingencia_medicina, TRUE);
        $this->db->set("emergencia_camas_contingencia_cirugia",$this->emergencia_camas_contingencia_cirugia, TRUE);
        $this->db->set("emergencia_camas_contingencia_gineco_obstetricia",$this->emergencia_camas_contingencia_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_contingencia_pedriatria",$this->emergencia_camas_contingencia_pedriatria, TRUE);
        $this->db->set("emergencia_camas_contingencia_observacion_medicina",$this->emergencia_camas_contingencia_observacion_medicina, TRUE);
        $this->db->set("emergencia_camas_contingencia_observacion_cirugia",$this->emergencia_camas_contingencia_observacion_cirugia, TRUE);
        $this->db->set("emergencia_camas_contingencia_observacion_gineco_obstetricia",$this->emergencia_camas_contingencia_observacion_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_contingencia_observacion_pediatria",$this->emergencia_camas_contingencia_observacion_pediatria, TRUE);
        $this->db->set("emergencia_camas_expansion_shock_trauma",$this->emergencia_camas_expansion_shock_trauma, TRUE);
        $this->db->set("emergencia_camas_expansion_medicina",$this->emergencia_camas_expansion_medicina, TRUE);
        $this->db->set("emergencia_camas_expansion_cirugia",$this->emergencia_camas_expansion_cirugia, TRUE);
        $this->db->set("emergencia_camas_expansion_gineco_obstetricia",$this->emergencia_camas_expansion_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_expansion_pedriatria",$this->emergencia_camas_expansion_pedriatria, TRUE);
        $this->db->set("emergencia_camas_expansion_observacion_medicina",$this->emergencia_camas_expansion_observacion_medicina, TRUE);
        $this->db->set("emergencia_camas_expansion_observacion_cirugia",$this->emergencia_camas_expansion_observacion_cirugia, TRUE);
        $this->db->set("emergencia_camas_expansion_observacion_gineco_obstetricia",$this->emergencia_camas_expansion_observacion_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_expansion_observacion_pediatria",$this->emergencia_camas_expansion_observacion_pediatria, TRUE);
        $this->db->set("emergencia_camas_desastres_shock_trauma",$this->emergencia_camas_desastres_shock_trauma, TRUE);
        $this->db->set("emergencia_camas_desastres_medicina",$this->emergencia_camas_desastres_medicina, TRUE);
        $this->db->set("emergencia_camas_desastres_cirugia",$this->emergencia_camas_desastres_cirugia, TRUE);
        $this->db->set("emergencia_camas_desastres_gineco_obstetricia",$this->emergencia_camas_desastres_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_desastres_pedriatria",$this->emergencia_camas_desastres_pedriatria, TRUE);
        $this->db->set("emergencia_camas_desastres_observacion_medicina",$this->emergencia_camas_desastres_observacion_medicina, TRUE);
        $this->db->set("emergencia_camas_desastres_observacion_cirugia",$this->emergencia_camas_desastres_observacion_cirugia, TRUE);
        $this->db->set("emergencia_camas_desastres_observacion_gineco_obstetricia",$this->emergencia_camas_desastres_observacion_gineco_obstetricia, TRUE);
        $this->db->set("emergencia_camas_desastres_observacion_pediatria",$this->emergencia_camas_desastres_observacion_pediatria, TRUE);
        $this->db->set("pedriatria_camas_ogti_uci_pedriatrica",$this->pedriatria_camas_ogti_uci_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_ogti_ucin_pedriatrica",$this->pedriatria_camas_ogti_ucin_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_ogti_uci_neonato",$this->pedriatria_camas_ogti_uci_neonato, TRUE);
        $this->db->set("pedriatria_camas_ogti_ucin_neonato",$this->pedriatria_camas_ogti_ucin_neonato, TRUE);
        $this->db->set("pedriatria_camas_ocupadas_uci_pedriatrica",$this->pedriatria_camas_ocupadas_uci_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_ocupadas_ucin_pedriatrica",$this->pedriatria_camas_ocupadas_ucin_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_ocupadas_uci_neonato",$this->pedriatria_camas_ocupadas_uci_neonato, TRUE);
        $this->db->set("pedriatria_camas_ocupadas_ucin_neonato",$this->pedriatria_camas_ocupadas_ucin_neonato, TRUE);
        $this->db->set("pedriatria_camas_pasillos_uci_pedriatrica",$this->pedriatria_camas_pasillos_uci_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_pasillos_ucin_pedriatrica",$this->pedriatria_camas_pasillos_ucin_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_pasillos_uci_neonato",$this->pedriatria_camas_pasillos_uci_neonato, TRUE);
        $this->db->set("pedriatria_camas_pasillos_ucin_neonato",$this->pedriatria_camas_pasillos_ucin_neonato, TRUE);
        $this->db->set("pedriatria_camas_contigencia_uci_pedriatrica",$this->pedriatria_camas_contigencia_uci_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_contigencia_ucin_pedriatrica",$this->pedriatria_camas_contigencia_ucin_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_contigencia_uci_neonato",$this->pedriatria_camas_contigencia_uci_neonato, TRUE);
        $this->db->set("pedriatria_camas_contigencia_ucin_neonato",$this->pedriatria_camas_contigencia_ucin_neonato, TRUE);
        $this->db->set("pedriatria_camas_expansion_uci_pedriatrica",$this->pedriatria_camas_expansion_uci_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_expansion_ucin_pedriatrica",$this->pedriatria_camas_expansion_ucin_pedriatrica, TRUE);
        $this->db->set("pedriatria_camas_expansion_uci_neonato",$this->pedriatria_camas_expansion_uci_neonato, TRUE);
        $this->db->set("pedriatria_camas_expansion_ucin_neonato",$this->pedriatria_camas_expansion_ucin_neonato, TRUE);
        $this->db->set("gineco_obstetricia_camas_ogti_uci",$this->gineco_obstetricia_camas_ogti_uci, TRUE);
        $this->db->set("gineco_obstetricia_camas_ogti_ucin",$this->gineco_obstetricia_camas_ogti_ucin, TRUE);
        $this->db->set("gineco_obstetricia_camas_ocupadas_uci",$this->gineco_obstetricia_camas_ocupadas_uci, TRUE);
        $this->db->set("gineco_obstetricia_camas_ocupadas_ucin",$this->gineco_obstetricia_camas_ocupadas_ucin, TRUE);
        $this->db->set("gineco_obstetricia_camas_pasillos_uci",$this->gineco_obstetricia_camas_pasillos_uci, TRUE);
        $this->db->set("gineco_obstetricia_camas_pasillos_ucin",$this->gineco_obstetricia_camas_pasillos_ucin, TRUE);
        $this->db->set("gineco_obstetricia_camas_contingencia_uci",$this->gineco_obstetricia_camas_contingencia_uci, TRUE);
        $this->db->set("gineco_obstetricia_camas_contingencia_ucin",$this->gineco_obstetricia_camas_contingencia_ucin, TRUE);
        $this->db->set("gineco_obstetricia_camas_expansion_uci",$this->gineco_obstetricia_camas_expansion_uci, TRUE);
        $this->db->set("gineco_obstetricia_camas_expansion_ucin",$this->gineco_obstetricia_camas_expansion_ucin, TRUE);
        $this->db->set("sop_camas_disponibles_gineco_obstetrica",$this->sop_camas_disponibles_gineco_obstetrica, TRUE);
        $this->db->set("sop_camas_disponibles_emergencia",$this->sop_camas_disponibles_emergencia, TRUE);
        $this->db->set("sop_camas_requeridos_gineco_obstetrica",$this->sop_camas_requeridos_gineco_obstetrica, TRUE);
        $this->db->set("sop_camas_requeridos_emergencia",$this->sop_camas_requeridos_emergencia, TRUE);
        $this->db->set("sop_camas_portatiles_gineco_obstetrica",$this->sop_camas_portatiles_gineco_obstetrica, TRUE);
        $this->db->set("sop_camas_portatiles_emergencia",$this->sop_camas_portatiles_emergencia, TRUE);
        $this->db->set("sop_camas_expansion_gineco_obstetrica",$this->sop_camas_expansion_gineco_obstetrica, TRUE);
        $this->db->set("sop_camas_expansion_emergencia",$this->sop_camas_expansion_emergencia, TRUE);
        $this->db->set("personal_medico_programado_pediatria",$this->personal_medico_programado_pediatria, TRUE);
        $this->db->set("personal_medico_programado_cirugia_pediatrica",$this->personal_medico_programado_cirugia_pediatrica, TRUE);
        $this->db->set("personal_medico_programado_gineco_obstetricia",$this->personal_medico_programado_gineco_obstetricia, TRUE);
        $this->db->set("personal_medico_programado_medicina_internista",$this->personal_medico_programado_medicina_internista, TRUE);
        $this->db->set("personal_medico_programado_medicina_cardiologo",$this->personal_medico_programado_medicina_cardiologo, TRUE);
        $this->db->set("personal_medico_programado_medicina_nefrologo",$this->personal_medico_programado_medicina_nefrologo, TRUE);
        $this->db->set("personal_medico_programado_cirugia_general",$this->personal_medico_programado_cirugia_general, TRUE);
        $this->db->set("personal_medico_programado_traumatologia",$this->personal_medico_programado_traumatologia, TRUE);
        $this->db->set("personal_medico_programado_neurocirugia",$this->personal_medico_programado_neurocirugia, TRUE);
        $this->db->set("personal_medico_programado_cirugia_torax",$this->personal_medico_programado_cirugia_torax, TRUE);
        $this->db->set("personal_medico_programado_medicina_intensiva",$this->personal_medico_programado_medicina_intensiva, TRUE);
        $this->db->set("personal_medico_programado_neonatologo",$this->personal_medico_programado_neonatologo, TRUE);
        $this->db->set("personal_medico_programado_anestesiologo",$this->personal_medico_programado_anestesiologo, TRUE);
        $this->db->set("personal_medico_requerido_pediatria",$this->personal_medico_requerido_pediatria, TRUE);
        $this->db->set("personal_medico_requerido_cirugia_pediatrica",$this->personal_medico_requerido_cirugia_pediatrica, TRUE);
        $this->db->set("personal_medico_requerido_gineco_obstetricia",$this->personal_medico_requerido_gineco_obstetricia, TRUE);
        $this->db->set("personal_medico_requerido_medicina_internista",$this->personal_medico_requerido_medicina_internista, TRUE);
        $this->db->set("personal_medico_requerido_medicina_cardiologo",$this->personal_medico_requerido_medicina_cardiologo, TRUE);
        $this->db->set("personal_medico_requerido_medicina_nefrologo",$this->personal_medico_requerido_medicina_nefrologo, TRUE);
        $this->db->set("personal_medico_requerido_cirugia_general",$this->personal_medico_requerido_cirugia_general, TRUE);
        $this->db->set("personal_medico_requerido_traumatologia",$this->personal_medico_requerido_traumatologia, TRUE);
        $this->db->set("personal_medico_requerido_neurocirugia",$this->personal_medico_requerido_neurocirugia, TRUE);
        $this->db->set("personal_medico_requerido_cirugia_torax",$this->personal_medico_requerido_cirugia_torax, TRUE);
        $this->db->set("personal_medico_requerido_medicina_intensiva",$this->personal_medico_requerido_medicina_intensiva, TRUE);
        $this->db->set("personal_medico_requerido_neonatologo",$this->personal_medico_requerido_neonatologo, TRUE);
        $this->db->set("personal_medico_requerido_anestesiologo",$this->personal_medico_requerido_anestesiologo, TRUE);
        $this->db->set("personal_medico_reten_pediatria",$this->personal_medico_reten_pediatria, TRUE);
        $this->db->set("personal_medico_reten_cirugia_pediatrica",$this->personal_medico_reten_cirugia_pediatrica, TRUE);
        $this->db->set("personal_medico_reten_gineco_obstetricia",$this->personal_medico_reten_gineco_obstetricia, TRUE);
        $this->db->set("personal_medico_reten_medicina_internista",$this->personal_medico_reten_medicina_internista, TRUE);
        $this->db->set("personal_medico_reten_medicina_cardiologo",$this->personal_medico_reten_medicina_cardiologo, TRUE);
        $this->db->set("personal_medico_reten_medicina_nefrologo",$this->personal_medico_reten_medicina_nefrologo, TRUE);
        $this->db->set("personal_medico_reten_cirugia_general",$this->personal_medico_reten_cirugia_general, TRUE);
        $this->db->set("personal_medico_reten_traumatologia",$this->personal_medico_reten_traumatologia, TRUE);
        $this->db->set("personal_medico_reten_neurocirugia",$this->personal_medico_reten_neurocirugia, TRUE);
        $this->db->set("personal_medico_reten_cirugia_torax",$this->personal_medico_reten_cirugia_torax, TRUE);
        $this->db->set("personal_medico_reten_medicina_intensiva",$this->personal_medico_reten_medicina_intensiva, TRUE);
        $this->db->set("personal_medico_reten_neonatologo",$this->personal_medico_reten_neonatologo, TRUE);
        $this->db->set("personal_medico_reten_anestesiologo",$this->personal_medico_reten_anestesiologo, TRUE);
        $this->db->set("personal_medico_portatiles_pediatria",$this->personal_medico_portatiles_pediatria, TRUE);
        $this->db->set("personal_medico_portatiles_cirugia_pediatrica",$this->personal_medico_portatiles_cirugia_pediatrica, TRUE);
        $this->db->set("personal_medico_portatiles_gineco_obstetricia",$this->personal_medico_portatiles_gineco_obstetricia, TRUE);
        $this->db->set("personal_medico_portatiles_medicina_internista",$this->personal_medico_portatiles_medicina_internista, TRUE);
        $this->db->set("personal_medico_portatiles_medicina_cardiologo",$this->personal_medico_portatiles_medicina_cardiologo, TRUE);
        $this->db->set("personal_medico_portatiles_medicina_nefrologo",$this->personal_medico_portatiles_medicina_nefrologo, TRUE);
        $this->db->set("personal_medico_portatiles_cirugia_general",$this->personal_medico_portatiles_cirugia_general, TRUE);
        $this->db->set("personal_medico_portatiles_traumatologia",$this->personal_medico_portatiles_traumatologia, TRUE);
        $this->db->set("personal_medico_portatiles_neurocirugia",$this->personal_medico_portatiles_neurocirugia, TRUE);
        $this->db->set("personal_medico_portatiles_cirugia_torax",$this->personal_medico_portatiles_cirugia_torax, TRUE);
        $this->db->set("personal_medico_portatiles_medicina_intensiva",$this->personal_medico_portatiles_medicina_intensiva, TRUE);
        $this->db->set("personal_medico_portatiles_neonatologo",$this->personal_medico_portatiles_neonatologo, TRUE);
        $this->db->set("personal_medico_portatiles_anestesiologo",$this->personal_medico_portatiles_anestesiologo, TRUE);
        $this->db->set("personal_no_medico_programado_enfermeras",$this->personal_no_medico_programado_enfermeras, TRUE);
        $this->db->set("personal_no_medico_programado_tecnologos",$this->personal_no_medico_programado_tecnologos, TRUE);
        $this->db->set("personal_no_medico_programado_obtetrices",$this->personal_no_medico_programado_obtetrices, TRUE);
        $this->db->set("personal_no_medico_programado_tecnicos",$this->personal_no_medico_programado_tecnicos, TRUE);
        $this->db->set("personal_no_medico_programado_social",$this->personal_no_medico_programado_social, TRUE);
        $this->db->set("personal_no_medico_requerido_enfermeras",$this->personal_no_medico_requerido_enfermeras, TRUE);
        $this->db->set("personal_no_medico_requerido_tecnologos",$this->personal_no_medico_requerido_tecnologos, TRUE);
        $this->db->set("personal_no_medico_requerido_obtetrices",$this->personal_no_medico_requerido_obtetrices, TRUE);
        $this->db->set("personal_no_medico_requerido_tecnicos",$this->personal_no_medico_requerido_tecnicos, TRUE);
        $this->db->set("personal_no_medico_requerido_social",$this->personal_no_medico_requerido_social, TRUE);
        $this->db->set("personal_no_medico_reten_enfermeras",$this->personal_no_medico_reten_enfermeras, TRUE);
        $this->db->set("personal_no_medico_reten_tecnologos",$this->personal_no_medico_reten_tecnologos, TRUE);
        $this->db->set("personal_no_medico_reten_obtetrices",$this->personal_no_medico_reten_obtetrices, TRUE);
        $this->db->set("personal_no_medico_reten_tecnicos",$this->personal_no_medico_reten_tecnicos, TRUE);
        $this->db->set("personal_no_medico_reten_social",$this->personal_no_medico_reten_social, TRUE);
        $this->db->set("personal_no_medico_portatiles_enfermeras",$this->personal_no_medico_portatiles_enfermeras, TRUE);
        $this->db->set("personal_no_medico_portatiles_tecnologos",$this->personal_no_medico_portatiles_tecnologos, TRUE);
        $this->db->set("personal_no_medico_portatiles_obtetrices",$this->personal_no_medico_portatiles_obtetrices, TRUE);
        $this->db->set("personal_no_medico_portatiles_tecnicos",$this->personal_no_medico_portatiles_tecnicos, TRUE);
        $this->db->set("personal_no_medico_portatiles_social",$this->personal_no_medico_portatiles_social, TRUE);
        $this->db->set("banco_sangre_disponible_sangre",$this->banco_sangre_disponible_sangre, TRUE);
        $this->db->set("banco_sangre_disponible_plasma",$this->banco_sangre_disponible_plasma, TRUE);
        $this->db->set("banco_sangre_disponible_plaquetas",$this->banco_sangre_disponible_plaquetas, TRUE);
        $this->db->set("banco_sangre_requerido_sangre",$this->banco_sangre_requerido_sangre, TRUE);
        $this->db->set("banco_sangre_requerido_plasma",$this->banco_sangre_requerido_plasma, TRUE);
        $this->db->set("banco_sangre_requerido_plaquetas",$this->banco_sangre_requerido_plaquetas, TRUE);
        $this->db->set("banco_sangre_portatiles_sangre",$this->banco_sangre_portatiles_sangre, TRUE);
        $this->db->set("banco_sangre_portatiles_plasma",$this->banco_sangre_portatiles_plasma, TRUE);
        $this->db->set("banco_sangre_portatiles_plaquetas",$this->banco_sangre_portatiles_plaquetas, TRUE);
        $this->db->set("ventiladores_registrados_trauma_shock_adulto",$this->ventiladores_registrados_trauma_shock_adulto, TRUE);
        $this->db->set("ventiladores_registrados_trauma_shock_pediatrico",$this->ventiladores_registrados_trauma_shock_pediatrico, TRUE);
        $this->db->set("ventiladores_registrados_uci_adultos",$this->ventiladores_registrados_uci_adultos, TRUE);
        $this->db->set("ventiladores_registrados_uci_pedriatrica",$this->ventiladores_registrados_uci_pedriatrica, TRUE);
        $this->db->set("ventiladores_registrados_uci_neonatologia",$this->ventiladores_registrados_uci_neonatologia, TRUE);
        $this->db->set("ventiladores_registrados_sala_operaciones",$this->ventiladores_registrados_sala_operaciones, TRUE);
        $this->db->set("ventiladores_registrados_ucin_adulto",$this->ventiladores_registrados_ucin_adulto, TRUE);
        $this->db->set("ventiladores_registrados_ucin_pediatrico",$this->ventiladores_registrados_ucin_pediatrico, TRUE);
        $this->db->set("ventiladores_registrados_ucin_neonato",$this->ventiladores_registrados_ucin_neonato, TRUE);
        $this->db->set("ventiladores_registrados_uci_gineco_obstetricia",$this->ventiladores_registrados_uci_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_registrados_ucin_gineco_obstetricia",$this->ventiladores_registrados_ucin_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_operativos_trauma_shock_adulto",$this->ventiladores_operativos_trauma_shock_adulto, TRUE);
        $this->db->set("ventiladores_operativos_trauma_shock_pediatrico",$this->ventiladores_operativos_trauma_shock_pediatrico, TRUE);
        $this->db->set("ventiladores_operativos_uci_adultos",$this->ventiladores_operativos_uci_adultos, TRUE);
        $this->db->set("ventiladores_operativos_uci_pedriatrica",$this->ventiladores_operativos_uci_pedriatrica, TRUE);
        $this->db->set("ventiladores_operativos_uci_neonatologia",$this->ventiladores_operativos_uci_neonatologia, TRUE);
        $this->db->set("ventiladores_operativos_sala_operaciones",$this->ventiladores_operativos_sala_operaciones, TRUE);
        $this->db->set("ventiladores_operativos_ucin_adulto",$this->ventiladores_operativos_ucin_adulto, TRUE);
        $this->db->set("ventiladores_operativos_ucin_pediatrico",$this->ventiladores_operativos_ucin_pediatrico, TRUE);
        $this->db->set("ventiladores_operativos_ucin_neonato",$this->ventiladores_operativos_ucin_neonato, TRUE);
        $this->db->set("ventiladores_operativos_uci_gineco_obstetricia",$this->ventiladores_operativos_uci_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_operativos_ucin_gineco_obstetricia",$this->ventiladores_operativos_ucin_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_disponibles_trauma_shock_adulto",$this->ventiladores_disponibles_trauma_shock_adulto, TRUE);
        $this->db->set("ventiladores_disponibles_trauma_shock_pediatrico",$this->ventiladores_disponibles_trauma_shock_pediatrico, TRUE);
        $this->db->set("ventiladores_disponibles_uci_adultos",$this->ventiladores_disponibles_uci_adultos, TRUE);
        $this->db->set("ventiladores_disponibles_uci_pedriatrica",$this->ventiladores_disponibles_uci_pedriatrica, TRUE);
        $this->db->set("ventiladores_disponibles_uci_neonatologia",$this->ventiladores_disponibles_uci_neonatologia, TRUE);
        $this->db->set("ventiladores_disponibles_sala_operaciones",$this->ventiladores_disponibles_sala_operaciones, TRUE);
        $this->db->set("ventiladores_disponibles_ucin_adulto",$this->ventiladores_disponibles_ucin_adulto, TRUE);
        $this->db->set("ventiladores_disponibles_ucin_pediatrico",$this->ventiladores_disponibles_ucin_pediatrico, TRUE);
        $this->db->set("ventiladores_disponibles_ucin_neonato",$this->ventiladores_disponibles_ucin_neonato, TRUE);
        $this->db->set("ventiladores_disponibles_uci_gineco_obstetricia",$this->ventiladores_disponibles_uci_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_disponibles_ucin_gineco_obstetricia",$this->ventiladores_disponibles_ucin_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_alquilados_trauma_shock_adulto",$this->ventiladores_alquilados_trauma_shock_adulto, TRUE);
        $this->db->set("ventiladores_alquilados_trauma_shock_pediatrico",$this->ventiladores_alquilados_trauma_shock_pediatrico, TRUE);
        $this->db->set("ventiladores_alquilados_uci_adultos",$this->ventiladores_alquilados_uci_adultos, TRUE);
        $this->db->set("ventiladores_alquilados_uci_pedriatrica",$this->ventiladores_alquilados_uci_pedriatrica, TRUE);
        $this->db->set("ventiladores_alquilados_uci_neonatologia",$this->ventiladores_alquilados_uci_neonatologia, TRUE);
        $this->db->set("ventiladores_alquilados_sala_operaciones",$this->ventiladores_alquilados_sala_operaciones, TRUE);
        $this->db->set("ventiladores_alquilados_ucin_adulto",$this->ventiladores_alquilados_ucin_adulto, TRUE);
        $this->db->set("ventiladores_alquilados_ucin_pediatrico",$this->ventiladores_alquilados_ucin_pediatrico, TRUE);
        $this->db->set("ventiladores_alquilados_ucin_neonato",$this->ventiladores_alquilados_ucin_neonato, TRUE);
        $this->db->set("ventiladores_alquilados_uci_gineco_obstetricia",$this->ventiladores_alquilados_uci_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_alquilados_ucin_gineco_obstetricia",$this->ventiladores_alquilados_ucin_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_brecha_trauma_shock_adulto",$this->ventiladores_brecha_trauma_shock_adulto, TRUE);
        $this->db->set("ventiladores_brecha_trauma_shock_pediatrico",$this->ventiladores_brecha_trauma_shock_pediatrico, TRUE);
        $this->db->set("ventiladores_brecha_uci_adultos",$this->ventiladores_brecha_uci_adultos, TRUE);
        $this->db->set("ventiladores_brecha_uci_pedriatrica",$this->ventiladores_brecha_uci_pedriatrica, TRUE);
        $this->db->set("ventiladores_brecha_uci_neonatologia",$this->ventiladores_brecha_uci_neonatologia, TRUE);
        $this->db->set("ventiladores_brecha_sala_operaciones",$this->ventiladores_brecha_sala_operaciones, TRUE);
        $this->db->set("ventiladores_brecha_ucin_adulto",$this->ventiladores_brecha_ucin_adulto, TRUE);
        $this->db->set("ventiladores_brecha_ucin_pediatrico",$this->ventiladores_brecha_ucin_pediatrico, TRUE);
        $this->db->set("ventiladores_brecha_ucin_neonato",$this->ventiladores_brecha_ucin_neonato, TRUE);
        $this->db->set("ventiladores_brecha_uci_gineco_obstetricia",$this->ventiladores_brecha_uci_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_brecha_ucin_gineco_obstetricia",$this->ventiladores_brecha_ucin_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_portatiles_trauma_shock_adulto",$this->ventiladores_portatiles_trauma_shock_adulto, TRUE);
        $this->db->set("ventiladores_portatiles_trauma_shock_pediatrico",$this->ventiladores_portatiles_trauma_shock_pediatrico, TRUE);
        $this->db->set("ventiladores_portatiles_uci_adultos",$this->ventiladores_portatiles_uci_adultos, TRUE);
        $this->db->set("ventiladores_portatiles_uci_pedriatrica",$this->ventiladores_portatiles_uci_pedriatrica, TRUE);
        $this->db->set("ventiladores_portatiles_uci_neonatologia",$this->ventiladores_portatiles_uci_neonatologia, TRUE);
        $this->db->set("ventiladores_portatiles_sala_operaciones",$this->ventiladores_portatiles_sala_operaciones, TRUE);
        $this->db->set("ventiladores_portatiles_ucin_adulto",$this->ventiladores_portatiles_ucin_adulto, TRUE);
        $this->db->set("ventiladores_portatiles_ucin_pediatrico",$this->ventiladores_portatiles_ucin_pediatrico, TRUE);
        $this->db->set("ventiladores_portatiles_ucin_neonato",$this->ventiladores_portatiles_ucin_neonato, TRUE);
        $this->db->set("ventiladores_portatiles_uci_gineco_obstetricia",$this->ventiladores_portatiles_uci_gineco_obstetricia, TRUE);
        $this->db->set("ventiladores_portatiles_ucin_gineco_obstetricia",$this->ventiladores_portatiles_ucin_gineco_obstetricia, TRUE);
        $this->db->set("ambulancias_tipo_i_registradas",$this->ambulancias_tipo_i_registradas, TRUE);
        $this->db->set("ambulancias_tipo_i_operaivas",$this->ambulancias_tipo_i_operaivas, TRUE);
        $this->db->set("ambulancias_tipo_i_radio",$this->ambulancias_tipo_i_radio, TRUE);
        $this->db->set("ambulancias_tipo_ii_registradas",$this->ambulancias_tipo_ii_registradas, TRUE);
        $this->db->set("ambulancias_tipo_ii_operaivas",$this->ambulancias_tipo_ii_operaivas, TRUE);
        $this->db->set("ambulancias_tipo_ii_radio",$this->ambulancias_tipo_ii_radio, TRUE);
        $this->db->set("ambulancias_tipo_iii_registradas",$this->ambulancias_tipo_iii_registradas, TRUE);
        $this->db->set("ambulancias_tipo_iii_operaivas",$this->ambulancias_tipo_iii_operaivas, TRUE);
        $this->db->set("ambulancias_tipo_iii_radio",$this->ambulancias_tipo_iii_radio, TRUE);        
        $this->db->set("usuario_actualizacion",$this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_actualizacion",date("Y-m-d H:i:s"), TRUE);
        $this->db->where("hospitales_situaciones_emergencia_id", $this->id);
        if ($this->db->update('hospitales_situaciones_emergencia'))
            return true;
            else
                return false;
    }
    public function listar(){
        $this->db->select("ID idsobredemanda,e.Encargado_EMED responsable_reporte,e.Supervisor jefe_guardia,e.supervisor_telefono telefono,e.Hospital hospital_nombre");
        $this->db->select("e.hospitales_situaciones_nombre_id hospital_id,e.Fecha fecha, e.estado Activo, e.Region");
        $this->db->from("lista_items_hospitales_sobredemanda_new e");
        return $this->db->get();
    }
    public function listarReporteLima(){
        $this->db->select("*");
        $this->db->from("lista_items_hospitales_sobredemanda_reporte_lima_new");
        $this->db->where("Fecha", $this->fechaRegistro);
        return $this->db->get();
    }
    public function listarReporteRegion(){
        $this->db->select("*");
        $this->db->from("lista_items_hospitales_sobredemanda_reporte_regiones_new");
        $this->db->where("Fecha", $this->fechaRegistro);
        return $this->db->get();
    }
    public function listarGraficaLima(){
        $this->db->select("Hospital,Hospitalizacion_01 As 'Hospitalizacion',Hospitalizacion_02 As 'Hospitalizacion COVID-19',Emergencia_01 As 'Emergencia',Emergencia_02 As 'Emergencia COVID-19',Criticos_01 As 'UCI Adultos',Criticos_02 as 'UCI Adultos COVID-19',Pediatricos_01 as 'UCI Pediatrico',Pediatricos_02 As 'UCI Pediatrico COVID-19' ");
        $this->db->from("lista_items_hospitales_sobredemanda_reporte_lima_new");
        $this->db->where("fecha", $this->fechaRegistro);
        return $this->db->get();
    }
    public function listarGraficaRegion(){
        $this->db->select("Region,Hospitalizacion_01 As 'Hospitalizacion',Hospitalizacion_02 As 'Hospitalizacion COVID-19',Emergencia_01 As 'Emergencia',Emergencia_02 As 'Emergencia COVID-19',Criticos_01 As 'UCI Adultos',Criticos_02 as 'UCI Adultos COVID-19',Pediatricos_01 as 'UCI Pediatrico',Pediatricos_02 As 'UCI Pediatrico COVID-19' ");
        $this->db->from("lista_items_hospitales_sobredemanda_reporte_regiones_new");
        $this->db->where("fecha", $this->fechaRegistro);
        return $this->db->get();
    }
    public function obtenerPorcentajesHospitales()
    {
        $this->db->select("*");
        $this->db->from("sobredemanda_new_porcentajes");
        $this->db->order_by("ID desc");
        return $this->db->get();
    }
    public function obtenerDataGraficoHospitales()
    {
        $this->db->select("*");
        $this->db->from("sobredemanda_new_porcentajes_top_inicial");
        $this->db->order_by("hospitales_situaciones_nombre_id desc");
        return $this->db->get();
    }
}