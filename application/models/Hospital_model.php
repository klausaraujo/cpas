<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Hospital_model extends CI_Model
{
    private $id;
    private $hospitales_situaciones_nombre_id;
    private $hospitales_situaciones_nombre;
    private $dni_responsable_reporte;
    private $responsable_reporte;
    private $cmp_responsable_reporte;
    private $rne_responsable_reporte;
    private $dni_jefe_guardia;
    private $jefe_guardia;
    private $cmp_jefe_guardia;
    private $rne_jefe_guardia;
    private $telefono;
    private $fecha;
    private $hora;
    private $usuario_registro;
    private $fecha_registro;
    private $usuario_actualizacion;
    private $fecha_actualizacion;
    private $nedocs_shock_trauma;
    private $nedocs_medicina;
    private $nedocs_cirugia;
    private $nedocs_gineco_obstetricia;
    private $nedocs_pedriatria;
    private $nedocs_observacion_medicina;
    private $nedocs_observacion_cirugia;
    private $nedocs_observacion_gineco_obstetricia;
    private $nedocs_observacion_pediatria;
    private $nedocs_camas_emergencia_ocupadas_pasillos;
    private $nedocs_camas_emergencia_ocupadas_areas_contigencia;
    private $nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres;
    private $nedocs_capacidad_expansion_emergencias_desastres;
    private $nedocs_tiempo_espera_ensala_ultimo_paciente_llamado;
    private $nedocs_tiempo_espera_mas_largo_por_cama_de_internacion;
    private $nedocs_pacientes_espera_cama_internamiento;
    private $nedocs_cantidad_total_pacientes_ventilacion;
    private $nedocs_cantidad_total_camas_hospital;
    private $nedocs_resultado;
    private $emergencia_camas_ogti_shock_trauma;
    private $emergencia_camas_ogti_medicina;
    private $emergencia_camas_ogti_cirugia;
    private $emergencia_camas_ogti_gineco_obstetricia;
    private $emergencia_camas_ogti_pedriatria;
    private $emergencia_camas_ogti_observacion_medicina;
    private $emergencia_camas_ogti_observacion_cirugia;
    private $emergencia_camas_ogti_observacion_gineco_obstetricia;
    private $emergencia_camas_ogti_observacion_pediatria;
    private $emergencia_camas_pasillos_shock_trauma;
    private $emergencia_camas_pasillos_medicina;
    private $emergencia_camas_pasillos_cirugia;
    private $emergencia_camas_pasillos_gineco_obstetricia;
    private $emergencia_camas_pasillos_pedriatria;
    private $emergencia_camas_pasillos_observacion_medicina;
    private $emergencia_camas_pasillos_observacion_cirugia;
    private $emergencia_camas_pasillos_observacion_gineco_obstetricia;
    private $emergencia_camas_pasillos_observacion_pediatria;
    private $emergencia_camas_contingencia_shock_trauma;
    private $emergencia_camas_contingencia_medicina;
    private $emergencia_camas_contingencia_cirugia;
    private $emergencia_camas_contingencia_gineco_obstetricia;
    private $emergencia_camas_contingencia_pedriatria;
    private $emergencia_camas_contingencia_observacion_medicina;
    private $emergencia_camas_contingencia_observacion_cirugia;
    private $emergencia_camas_contingencia_observacion_gineco_obstetricia;
    private $emergencia_camas_contingencia_observacion_pediatria;
    private $emergencia_camas_expansion_shock_trauma;
    private $emergencia_camas_expansion_medicina;
    private $emergencia_camas_expansion_cirugia;
    private $emergencia_camas_expansion_gineco_obstetricia;
    private $emergencia_camas_expansion_pedriatria;
    private $emergencia_camas_expansion_observacion_medicina;
    private $emergencia_camas_expansion_observacion_cirugia;
    private $emergencia_camas_expansion_observacion_gineco_obstetricia;
    private $emergencia_camas_expansion_observacion_pediatria;
    private $emergencia_camas_desastres_shock_trauma;
    private $emergencia_camas_desastres_medicina;
    private $emergencia_camas_desastres_cirugia;
    private $emergencia_camas_desastres_gineco_obstetricia;
    private $emergencia_camas_desastres_pedriatria;
    private $emergencia_camas_desastres_observacion_medicina;
    private $emergencia_camas_desastres_observacion_cirugia;
    private $emergencia_camas_desastres_observacion_gineco_obstetricia;
    private $emergencia_camas_desastres_observacion_pediatria;
    private $pedriatria_camas_ogti_uci_pedriatrica;
    private $pedriatria_camas_ogti_ucin_pedriatrica;
    private $pedriatria_camas_ogti_uci_neonato;
    private $pedriatria_camas_ogti_ucin_neonato;
    private $pedriatria_camas_ocupadas_uci_pedriatrica;
    private $pedriatria_camas_ocupadas_ucin_pedriatrica;
    private $pedriatria_camas_ocupadas_uci_neonato;
    private $pedriatria_camas_ocupadas_ucin_neonato;
    private $pedriatria_camas_pasillos_uci_pedriatrica;
    private $pedriatria_camas_pasillos_ucin_pedriatrica;
    private $pedriatria_camas_pasillos_uci_neonato;
    private $pedriatria_camas_pasillos_ucin_neonato;
    private $pedriatria_camas_contigencia_uci_pedriatrica;
    private $pedriatria_camas_contigencia_ucin_pedriatrica;
    private $pedriatria_camas_contigencia_uci_neonato;
    private $pedriatria_camas_contigencia_ucin_neonato;
    private $pedriatria_camas_expansion_uci_pedriatrica;
    private $pedriatria_camas_expansion_ucin_pedriatrica;
    private $pedriatria_camas_expansion_uci_neonato;
    private $pedriatria_camas_expansion_ucin_neonato;
    private $gineco_obstetricia_camas_ogti_uci;
    private $gineco_obstetricia_camas_ogti_ucin;
    private $gineco_obstetricia_camas_ocupadas_uci;
    private $gineco_obstetricia_camas_ocupadas_ucin;
    private $gineco_obstetricia_camas_pasillos_uci;
    private $gineco_obstetricia_camas_pasillos_ucin;
    private $gineco_obstetricia_camas_contingencia_uci;
    private $gineco_obstetricia_camas_contingencia_ucin;
    private $gineco_obstetricia_camas_expansion_uci;
    private $gineco_obstetricia_camas_expansion_ucin;
    private $sop_camas_disponibles_gineco_obstetrica;
    private $sop_camas_disponibles_emergencia;
    private $sop_camas_requeridos_gineco_obstetrica;
    private $sop_camas_requeridos_emergencia;
    private $sop_camas_portatiles_gineco_obstetrica;
    private $sop_camas_portatiles_emergencia;
    private $sop_camas_expansion_gineco_obstetrica;
    private $sop_camas_expansion_emergencia;
    private $personal_medico_programado_pediatria;
    private $personal_medico_programado_cirugia_pediatrica;
    private $personal_medico_programado_gineco_obstetricia;
    private $personal_medico_programado_medicina_internista;
    private $personal_medico_programado_medicina_cardiologo;
    private $personal_medico_programado_medicina_nefrologo;
    private $personal_medico_programado_cirugia_general;
    private $personal_medico_programado_traumatologia;
    private $personal_medico_programado_neurocirugia;
    private $personal_medico_programado_cirugia_torax;
    private $personal_medico_programado_medicina_intensiva;
    private $personal_medico_programado_neonatologo;
    private $personal_medico_programado_anestesiologo;
    private $personal_medico_requerido_pediatria;
    private $personal_medico_requerido_cirugia_pediatrica;
    private $personal_medico_requerido_gineco_obstetricia;
    private $personal_medico_requerido_medicina_internista;
    private $personal_medico_requerido_medicina_cardiologo;
    private $personal_medico_requerido_medicina_nefrologo;
    private $personal_medico_requerido_cirugia_general;
    private $personal_medico_requerido_traumatologia;
    private $personal_medico_requerido_neurocirugia;
    private $personal_medico_requerido_cirugia_torax;
    private $personal_medico_requerido_medicina_intensiva;
    private $personal_medico_requerido_neonatologo;
    private $personal_medico_requerido_anestesiologo;
    private $personal_medico_reten_pediatria;
    private $personal_medico_reten_cirugia_pediatrica;
    private $personal_medico_reten_gineco_obstetricia;
    private $personal_medico_reten_medicina_internista;
    private $personal_medico_reten_medicina_cardiologo;
    private $personal_medico_reten_medicina_nefrologo;
    private $personal_medico_reten_cirugia_general;
    private $personal_medico_reten_traumatologia;
    private $personal_medico_reten_neurocirugia;
    private $personal_medico_reten_cirugia_torax;
    private $personal_medico_reten_medicina_intensiva;
    private $personal_medico_reten_neonatologo;
    private $personal_medico_reten_anestesiologo;
    private $personal_medico_portatiles_pediatria;
    private $personal_medico_portatiles_cirugia_pediatrica;
    private $personal_medico_portatiles_gineco_obstetricia;
    private $personal_medico_portatiles_medicina_internista;
    private $personal_medico_portatiles_medicina_cardiologo;
    private $personal_medico_portatiles_medicina_nefrologo;
    private $personal_medico_portatiles_cirugia_general;
    private $personal_medico_portatiles_traumatologia;
    private $personal_medico_portatiles_neurocirugia;
    private $personal_medico_portatiles_cirugia_torax;
    private $personal_medico_portatiles_medicina_intensiva;
    private $personal_medico_portatiles_neonatologo;
    private $personal_medico_portatiles_anestesiologo;
    private $personal_no_medico_programado_enfermeras;
    private $personal_no_medico_programado_tecnologos;
    private $personal_no_medico_programado_obtetrices;
    private $personal_no_medico_programado_tecnicos;
    private $personal_no_medico_programado_social;
    private $personal_no_medico_requerido_enfermeras;
    private $personal_no_medico_requerido_tecnologos;
    private $personal_no_medico_requerido_obtetrices;
    private $personal_no_medico_requerido_tecnicos;
    private $personal_no_medico_requerido_social;
    private $personal_no_medico_reten_enfermeras;
    private $personal_no_medico_reten_tecnologos;
    private $personal_no_medico_reten_obtetrices;
    private $personal_no_medico_reten_tecnicos;
    private $personal_no_medico_reten_social;
    private $personal_no_medico_portatiles_enfermeras;
    private $personal_no_medico_portatiles_tecnologos;
    private $personal_no_medico_portatiles_obtetrices;
    private $personal_no_medico_portatiles_tecnicos;
    private $personal_no_medico_portatiles_social;
    private $banco_sangre_disponible_sangre;
    private $banco_sangre_disponible_plasma;
    private $banco_sangre_disponible_plaquetas;
    private $banco_sangre_requerido_sangre;
    private $banco_sangre_requerido_plasma;
    private $banco_sangre_requerido_plaquetas;
    private $banco_sangre_portatiles_sangre;
    private $banco_sangre_portatiles_plasma;
    private $banco_sangre_portatiles_plaquetas;
    private $ventiladores_registrados_trauma_shock_adulto;
    private $ventiladores_registrados_trauma_shock_pediatrico;
    private $ventiladores_registrados_uci_adultos;
    private $ventiladores_registrados_uci_pedriatrica;
    private $ventiladores_registrados_uci_neonatologia;
    private $ventiladores_registrados_sala_operaciones;
    private $ventiladores_registrados_ucin_adulto;
    private $ventiladores_registrados_ucin_pediatrico;
    private $ventiladores_registrados_ucin_neonato;
    private $ventiladores_registrados_uci_gineco_obstetricia;
    private $ventiladores_registrados_ucin_gineco_obstetricia;
    private $ventiladores_operativos_trauma_shock_adulto;
    private $ventiladores_operativos_trauma_shock_pediatrico;
    private $ventiladores_operativos_uci_adultos;
    private $ventiladores_operativos_uci_pedriatrica;
    private $ventiladores_operativos_uci_neonatologia;
    private $ventiladores_operativos_sala_operaciones;
    private $ventiladores_operativos_ucin_adulto;
    private $ventiladores_operativos_ucin_pediatrico;
    private $ventiladores_operativos_ucin_neonato;
    private $ventiladores_operativos_uci_gineco_obstetricia;
    private $ventiladores_operativos_ucin_gineco_obstetricia;
    private $ventiladores_disponibles_trauma_shock_adulto;
    private $ventiladores_disponibles_trauma_shock_pediatrico;
    private $ventiladores_disponibles_uci_adultos;
    private $ventiladores_disponibles_uci_pedriatrica;
    private $ventiladores_disponibles_uci_neonatologia;
    private $ventiladores_disponibles_sala_operaciones;
    private $ventiladores_disponibles_ucin_adulto;
    private $ventiladores_disponibles_ucin_pediatrico;
    private $ventiladores_disponibles_ucin_neonato;
    private $ventiladores_disponibles_uci_gineco_obstetricia;
    private $ventiladores_disponibles_ucin_gineco_obstetricia;
    private $ventiladores_alquilados_trauma_shock_adulto;
    private $ventiladores_alquilados_trauma_shock_pediatrico;
    private $ventiladores_alquilados_uci_adultos;
    private $ventiladores_alquilados_uci_pedriatrica;
    private $ventiladores_alquilados_uci_neonatologia;
    private $ventiladores_alquilados_sala_operaciones;
    private $ventiladores_alquilados_ucin_adulto;
    private $ventiladores_alquilados_ucin_pediatrico;
    private $ventiladores_alquilados_ucin_neonato;
    private $ventiladores_alquilados_uci_gineco_obstetricia;
    private $ventiladores_alquilados_ucin_gineco_obstetricia;
    private $ventiladores_brecha_trauma_shock_adulto;
    private $ventiladores_brecha_trauma_shock_pediatrico;
    private $ventiladores_brecha_uci_adultos;
    private $ventiladores_brecha_uci_pedriatrica;
    private $ventiladores_brecha_uci_neonatologia;
    private $ventiladores_brecha_sala_operaciones;
    private $ventiladores_brecha_ucin_adulto;
    private $ventiladores_brecha_ucin_pediatrico;
    private $ventiladores_brecha_ucin_neonato;
    private $ventiladores_brecha_uci_gineco_obstetricia;
    private $ventiladores_brecha_ucin_gineco_obstetricia;
    private $ventiladores_portatiles_trauma_shock_adulto;
    private $ventiladores_portatiles_trauma_shock_pediatrico;
    private $ventiladores_portatiles_uci_adultos;
    private $ventiladores_portatiles_uci_pedriatrica;
    private $ventiladores_portatiles_uci_neonatologia;
    private $ventiladores_portatiles_sala_operaciones;
    private $ventiladores_portatiles_ucin_adulto;
    private $ventiladores_portatiles_ucin_pediatrico;
    private $ventiladores_portatiles_ucin_neonato;
    private $ventiladores_portatiles_uci_gineco_obstetricia;
    private $ventiladores_portatiles_ucin_gineco_obstetricia;
    private $ambulancias_tipo_i_registradas;
    private $ambulancias_tipo_i_operaivas;
    private $ambulancias_tipo_i_radio;
    private $ambulancias_tipo_ii_registradas;
    private $ambulancias_tipo_ii_operaivas;
    private $ambulancias_tipo_ii_radio;
    private $ambulancias_tipo_iii_registradas;
    private $ambulancias_tipo_iii_operaivas;
    private $ambulancias_tipo_iii_radio;    
    private $hospitales_situaciones_emergencia_fecha;
    private $hospitales_situaciones_emergencia_ocurrencia;
    public function setid($data){ $this->id = $this->db->escape_str($data); }
    public function sethospitales_situaciones_nombre_id($data){ $this->hospitales_situaciones_nombre_id = $this->db->escape_str($data); }
    public function sethospitales_situaciones_nombre($data){ $this->hospitales_situaciones_nombre = $this->db->escape_str($data); }
    public function setdni_responsable_reporte($data){ $this->dni_responsable_reporte = $this->db->escape_str($data); }
    public function setresponsable_reporte($data){ $this->responsable_reporte = $this->db->escape_str($data); }
    public function setcmp_responsable_reporte($data){ $this->cmp_responsable_reporte = $this->db->escape_str($data); }
    public function setrne_responsable_reporte($data){ $this->rne_responsable_reporte = $this->db->escape_str($data); }
    public function setdni_jefe_guardia($data){ $this->dni_jefe_guardia = $this->db->escape_str($data); }
    public function setjefe_guardia($data){ $this->jefe_guardia = $this->db->escape_str($data); }
    public function setcmp_jefe_guardia($data){ $this->cmp_jefe_guardia = $this->db->escape_str($data); }
    public function setrne_jefe_guardia($data){ $this->rne_jefe_guardia = $this->db->escape_str($data); }
    public function settelefono($data){ $this->telefono = $this->db->escape_str($data); }
    public function setfecha($data){ $this->fecha = $this->db->escape_str($data); }
    public function sethora($data){ $this->hora = $this->db->escape_str($data); }
    public function setusuario_registro($data){ $this->usuario_registro = $this->db->escape_str($data); }
    public function setfecha_registro($data){ $this->fecha_registro = $this->db->escape_str($data); }
    public function setusuario_actualizacion($data){ $this->usuario_actualizacion = $this->db->escape_str($data); }
    public function setfecha_actualizacion($data){ $this->fecha_actualizacion = $this->db->escape_str($data); }
    public function setnedocs_shock_trauma($data){$this->nedocs_shock_trauma=$this->db->escape_str($data);}
    public function setnedocs_medicina($data){$this->nedocs_medicina=$this->db->escape_str($data);}
    public function setnedocs_cirugia($data){$this->nedocs_cirugia=$this->db->escape_str($data);}
    public function setnedocs_gineco_obstetricia($data){$this->nedocs_gineco_obstetricia=$this->db->escape_str($data);}
    public function setnedocs_pedriatria($data){$this->nedocs_pedriatria=$this->db->escape_str($data);}
    public function setnedocs_observacion_medicina($data){$this->nedocs_observacion_medicina=$this->db->escape_str($data);}
    public function setnedocs_observacion_cirugia($data){$this->nedocs_observacion_cirugia=$this->db->escape_str($data);}
    public function setnedocs_observacion_gineco_obstetricia($data){$this->nedocs_observacion_gineco_obstetricia=$this->db->escape_str($data);}
    public function setnedocs_observacion_pediatria($data){$this->nedocs_observacion_pediatria=$this->db->escape_str($data);}
    public function setnedocs_camas_emergencia_ocupadas_pasillos($data){$this->nedocs_camas_emergencia_ocupadas_pasillos=$this->db->escape_str($data);}
    public function setnedocs_camas_emergencia_ocupadas_areas_contigencia($data){$this->nedocs_camas_emergencia_ocupadas_areas_contigencia=$this->db->escape_str($data);}
    public function setnedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres($data){$this->nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres=$this->db->escape_str($data);}
    public function setnedocs_capacidad_expansion_emergencias_desastres($data){$this->nedocs_capacidad_expansion_emergencias_desastres=$this->db->escape_str($data);}
    public function setnedocs_tiempo_espera_ensala_ultimo_paciente_llamado($data){$this->nedocs_tiempo_espera_ensala_ultimo_paciente_llamado=$this->db->escape_str($data);}
    public function setnedocs_tiempo_espera_mas_largo_por_cama_de_internacion($data){$this->nedocs_tiempo_espera_mas_largo_por_cama_de_internacion=$this->db->escape_str($data);}
    public function setnedocs_pacientes_espera_cama_internamiento($data){$this->nedocs_pacientes_espera_cama_internamiento=$this->db->escape_str($data);}
    public function setnedocs_cantidad_total_pacientes_ventilacion($data){$this->nedocs_cantidad_total_pacientes_ventilacion=$this->db->escape_str($data);}
    public function setnedocs_cantidad_total_camas_hospital($data){$this->nedocs_cantidad_total_camas_hospital=$this->db->escape_str($data);}
    public function setnedocs_resultado($data){$this->nedocs_resultado=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_shock_trauma($data){$this->emergencia_camas_ogti_shock_trauma=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_medicina($data){$this->emergencia_camas_ogti_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_cirugia($data){$this->emergencia_camas_ogti_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_gineco_obstetricia($data){$this->emergencia_camas_ogti_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_pedriatria($data){$this->emergencia_camas_ogti_pedriatria=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_observacion_medicina($data){$this->emergencia_camas_ogti_observacion_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_observacion_cirugia($data){$this->emergencia_camas_ogti_observacion_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_observacion_gineco_obstetricia($data){$this->emergencia_camas_ogti_observacion_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_ogti_observacion_pediatria($data){$this->emergencia_camas_ogti_observacion_pediatria=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_shock_trauma($data){$this->emergencia_camas_pasillos_shock_trauma=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_medicina($data){$this->emergencia_camas_pasillos_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_cirugia($data){$this->emergencia_camas_pasillos_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_gineco_obstetricia($data){$this->emergencia_camas_pasillos_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_pedriatria($data){$this->emergencia_camas_pasillos_pedriatria=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_observacion_medicina($data){$this->emergencia_camas_pasillos_observacion_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_observacion_cirugia($data){$this->emergencia_camas_pasillos_observacion_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_observacion_gineco_obstetricia($data){$this->emergencia_camas_pasillos_observacion_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_pasillos_observacion_pediatria($data){$this->emergencia_camas_pasillos_observacion_pediatria=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_shock_trauma($data){$this->emergencia_camas_contingencia_shock_trauma=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_medicina($data){$this->emergencia_camas_contingencia_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_cirugia($data){$this->emergencia_camas_contingencia_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_gineco_obstetricia($data){$this->emergencia_camas_contingencia_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_pedriatria($data){$this->emergencia_camas_contingencia_pedriatria=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_observacion_medicina($data){$this->emergencia_camas_contingencia_observacion_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_observacion_cirugia($data){$this->emergencia_camas_contingencia_observacion_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_observacion_gineco_obstetricia($data){$this->emergencia_camas_contingencia_observacion_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_contingencia_observacion_pediatria($data){$this->emergencia_camas_contingencia_observacion_pediatria=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_shock_trauma($data){$this->emergencia_camas_expansion_shock_trauma=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_medicina($data){$this->emergencia_camas_expansion_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_cirugia($data){$this->emergencia_camas_expansion_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_gineco_obstetricia($data){$this->emergencia_camas_expansion_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_pedriatria($data){$this->emergencia_camas_expansion_pedriatria=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_observacion_medicina($data){$this->emergencia_camas_expansion_observacion_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_observacion_cirugia($data){$this->emergencia_camas_expansion_observacion_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_observacion_gineco_obstetricia($data){$this->emergencia_camas_expansion_observacion_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_expansion_observacion_pediatria($data){$this->emergencia_camas_expansion_observacion_pediatria=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_shock_trauma($data){$this->emergencia_camas_desastres_shock_trauma=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_medicina($data){$this->emergencia_camas_desastres_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_cirugia($data){$this->emergencia_camas_desastres_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_gineco_obstetricia($data){$this->emergencia_camas_desastres_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_pedriatria($data){$this->emergencia_camas_desastres_pedriatria=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_observacion_medicina($data){$this->emergencia_camas_desastres_observacion_medicina=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_observacion_cirugia($data){$this->emergencia_camas_desastres_observacion_cirugia=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_observacion_gineco_obstetricia($data){$this->emergencia_camas_desastres_observacion_gineco_obstetricia=$this->db->escape_str($data);}
    public function setemergencia_camas_desastres_observacion_pediatria($data){$this->emergencia_camas_desastres_observacion_pediatria=$this->db->escape_str($data);}
    public function setpedriatria_camas_ogti_uci_pedriatrica($data){$this->pedriatria_camas_ogti_uci_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_ogti_ucin_pedriatrica($data){$this->pedriatria_camas_ogti_ucin_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_ogti_uci_neonato($data){$this->pedriatria_camas_ogti_uci_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_ogti_ucin_neonato($data){$this->pedriatria_camas_ogti_ucin_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_ocupadas_uci_pedriatrica($data){$this->pedriatria_camas_ocupadas_uci_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_ocupadas_ucin_pedriatrica($data){$this->pedriatria_camas_ocupadas_ucin_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_ocupadas_uci_neonato($data){$this->pedriatria_camas_ocupadas_uci_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_ocupadas_ucin_neonato($data){$this->pedriatria_camas_ocupadas_ucin_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_pasillos_uci_pedriatrica($data){$this->pedriatria_camas_pasillos_uci_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_pasillos_ucin_pedriatrica($data){$this->pedriatria_camas_pasillos_ucin_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_pasillos_uci_neonato($data){$this->pedriatria_camas_pasillos_uci_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_pasillos_ucin_neonato($data){$this->pedriatria_camas_pasillos_ucin_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_contigencia_uci_pedriatrica($data){$this->pedriatria_camas_contigencia_uci_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_contigencia_ucin_pedriatrica($data){$this->pedriatria_camas_contigencia_ucin_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_contigencia_uci_neonato($data){$this->pedriatria_camas_contigencia_uci_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_contigencia_ucin_neonato($data){$this->pedriatria_camas_contigencia_ucin_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_expansion_uci_pedriatrica($data){$this->pedriatria_camas_expansion_uci_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_expansion_ucin_pedriatrica($data){$this->pedriatria_camas_expansion_ucin_pedriatrica=$this->db->escape_str($data);}
    public function setpedriatria_camas_expansion_uci_neonato($data){$this->pedriatria_camas_expansion_uci_neonato=$this->db->escape_str($data);}
    public function setpedriatria_camas_expansion_ucin_neonato($data){$this->pedriatria_camas_expansion_ucin_neonato=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_ogti_uci($data){$this->gineco_obstetricia_camas_ogti_uci=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_ogti_ucin($data){$this->gineco_obstetricia_camas_ogti_ucin=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_ocupadas_uci($data){$this->gineco_obstetricia_camas_ocupadas_uci=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_ocupadas_ucin($data){$this->gineco_obstetricia_camas_ocupadas_ucin=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_pasillos_uci($data){$this->gineco_obstetricia_camas_pasillos_uci=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_pasillos_ucin($data){$this->gineco_obstetricia_camas_pasillos_ucin=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_contingencia_uci($data){$this->gineco_obstetricia_camas_contingencia_uci=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_contingencia_ucin($data){$this->gineco_obstetricia_camas_contingencia_ucin=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_expansion_uci($data){$this->gineco_obstetricia_camas_expansion_uci=$this->db->escape_str($data);}
    public function setgineco_obstetricia_camas_expansion_ucin($data){$this->gineco_obstetricia_camas_expansion_ucin=$this->db->escape_str($data);}
    public function setsop_camas_disponibles_gineco_obstetrica($data){$this->sop_camas_disponibles_gineco_obstetrica=$this->db->escape_str($data);}
    public function setsop_camas_disponibles_emergencia($data){$this->sop_camas_disponibles_emergencia=$this->db->escape_str($data);}
    public function setsop_camas_requeridos_gineco_obstetrica($data){$this->sop_camas_requeridos_gineco_obstetrica=$this->db->escape_str($data);}
    public function setsop_camas_requeridos_emergencia($data){$this->sop_camas_requeridos_emergencia=$this->db->escape_str($data);}
    public function setsop_camas_portatiles_gineco_obstetrica($data){$this->sop_camas_portatiles_gineco_obstetrica=$this->db->escape_str($data);}
    public function setsop_camas_portatiles_emergencia($data){$this->sop_camas_portatiles_emergencia=$this->db->escape_str($data);}
    public function setsop_camas_expansion_gineco_obstetrica($data){$this->sop_camas_expansion_gineco_obstetrica=$this->db->escape_str($data);}
    public function setsop_camas_expansion_emergencia($data){$this->sop_camas_expansion_emergencia=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_pediatria($data){$this->personal_medico_programado_pediatria=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_cirugia_pediatrica($data){$this->personal_medico_programado_cirugia_pediatrica=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_gineco_obstetricia($data){$this->personal_medico_programado_gineco_obstetricia=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_medicina_internista($data){$this->personal_medico_programado_medicina_internista=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_medicina_cardiologo($data){$this->personal_medico_programado_medicina_cardiologo=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_medicina_nefrologo($data){$this->personal_medico_programado_medicina_nefrologo=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_cirugia_general($data){$this->personal_medico_programado_cirugia_general=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_traumatologia($data){$this->personal_medico_programado_traumatologia=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_neurocirugia($data){$this->personal_medico_programado_neurocirugia=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_cirugia_torax($data){$this->personal_medico_programado_cirugia_torax=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_medicina_intensiva($data){$this->personal_medico_programado_medicina_intensiva=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_neonatologo($data){$this->personal_medico_programado_neonatologo=$this->db->escape_str($data);}
    public function setpersonal_medico_programado_anestesiologo($data){$this->personal_medico_programado_anestesiologo=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_pediatria($data){$this->personal_medico_requerido_pediatria=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_cirugia_pediatrica($data){$this->personal_medico_requerido_cirugia_pediatrica=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_gineco_obstetricia($data){$this->personal_medico_requerido_gineco_obstetricia=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_medicina_internista($data){$this->personal_medico_requerido_medicina_internista=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_medicina_cardiologo($data){$this->personal_medico_requerido_medicina_cardiologo=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_medicina_nefrologo($data){$this->personal_medico_requerido_medicina_nefrologo=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_cirugia_general($data){$this->personal_medico_requerido_cirugia_general=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_traumatologia($data){$this->personal_medico_requerido_traumatologia=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_neurocirugia($data){$this->personal_medico_requerido_neurocirugia=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_cirugia_torax($data){$this->personal_medico_requerido_cirugia_torax=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_medicina_intensiva($data){$this->personal_medico_requerido_medicina_intensiva=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_neonatologo($data){$this->personal_medico_requerido_neonatologo=$this->db->escape_str($data);}
    public function setpersonal_medico_requerido_anestesiologo($data){$this->personal_medico_requerido_anestesiologo=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_pediatria($data){$this->personal_medico_reten_pediatria=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_cirugia_pediatrica($data){$this->personal_medico_reten_cirugia_pediatrica=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_gineco_obstetricia($data){$this->personal_medico_reten_gineco_obstetricia=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_medicina_internista($data){$this->personal_medico_reten_medicina_internista=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_medicina_cardiologo($data){$this->personal_medico_reten_medicina_cardiologo=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_medicina_nefrologo($data){$this->personal_medico_reten_medicina_nefrologo=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_cirugia_general($data){$this->personal_medico_reten_cirugia_general=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_traumatologia($data){$this->personal_medico_reten_traumatologia=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_neurocirugia($data){$this->personal_medico_reten_neurocirugia=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_cirugia_torax($data){$this->personal_medico_reten_cirugia_torax=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_medicina_intensiva($data){$this->personal_medico_reten_medicina_intensiva=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_neonatologo($data){$this->personal_medico_reten_neonatologo=$this->db->escape_str($data);}
    public function setpersonal_medico_reten_anestesiologo($data){$this->personal_medico_reten_anestesiologo=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_pediatria($data){$this->personal_medico_portatiles_pediatria=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_cirugia_pediatrica($data){$this->personal_medico_portatiles_cirugia_pediatrica=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_gineco_obstetricia($data){$this->personal_medico_portatiles_gineco_obstetricia=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_medicina_internista($data){$this->personal_medico_portatiles_medicina_internista=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_medicina_cardiologo($data){$this->personal_medico_portatiles_medicina_cardiologo=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_medicina_nefrologo($data){$this->personal_medico_portatiles_medicina_nefrologo=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_cirugia_general($data){$this->personal_medico_portatiles_cirugia_general=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_traumatologia($data){$this->personal_medico_portatiles_traumatologia=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_neurocirugia($data){$this->personal_medico_portatiles_neurocirugia=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_cirugia_torax($data){$this->personal_medico_portatiles_cirugia_torax=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_medicina_intensiva($data){$this->personal_medico_portatiles_medicina_intensiva=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_neonatologo($data){$this->personal_medico_portatiles_neonatologo=$this->db->escape_str($data);}
    public function setpersonal_medico_portatiles_anestesiologo($data){$this->personal_medico_portatiles_anestesiologo=$this->db->escape_str($data);}
    public function setpersonal_no_medico_programado_enfermeras($data){$this->personal_no_medico_programado_enfermeras=$this->db->escape_str($data);}
    public function setpersonal_no_medico_programado_tecnologos($data){$this->personal_no_medico_programado_tecnologos=$this->db->escape_str($data);}
    public function setpersonal_no_medico_programado_obtetrices($data){$this->personal_no_medico_programado_obtetrices=$this->db->escape_str($data);}
    public function setpersonal_no_medico_programado_tecnicos($data){$this->personal_no_medico_programado_tecnicos=$this->db->escape_str($data);}
    public function setpersonal_no_medico_programado_social($data){$this->personal_no_medico_programado_social=$this->db->escape_str($data);}
    public function setpersonal_no_medico_requerido_enfermeras($data){$this->personal_no_medico_requerido_enfermeras=$this->db->escape_str($data);}
    public function setpersonal_no_medico_requerido_tecnologos($data){$this->personal_no_medico_requerido_tecnologos=$this->db->escape_str($data);}
    public function setpersonal_no_medico_requerido_obtetrices($data){$this->personal_no_medico_requerido_obtetrices=$this->db->escape_str($data);}
    public function setpersonal_no_medico_requerido_tecnicos($data){$this->personal_no_medico_requerido_tecnicos=$this->db->escape_str($data);}
    public function setpersonal_no_medico_requerido_social($data){$this->personal_no_medico_requerido_social=$this->db->escape_str($data);}
    public function setpersonal_no_medico_reten_enfermeras($data){$this->personal_no_medico_reten_enfermeras=$this->db->escape_str($data);}
    public function setpersonal_no_medico_reten_tecnologos($data){$this->personal_no_medico_reten_tecnologos=$this->db->escape_str($data);}
    public function setpersonal_no_medico_reten_obtetrices($data){$this->personal_no_medico_reten_obtetrices=$this->db->escape_str($data);}
    public function setpersonal_no_medico_reten_tecnicos($data){$this->personal_no_medico_reten_tecnicos=$this->db->escape_str($data);}
    public function setpersonal_no_medico_reten_social($data){$this->personal_no_medico_reten_social=$this->db->escape_str($data);}
    public function setpersonal_no_medico_portatiles_enfermeras($data){$this->personal_no_medico_portatiles_enfermeras=$this->db->escape_str($data);}
    public function setpersonal_no_medico_portatiles_tecnologos($data){$this->personal_no_medico_portatiles_tecnologos=$this->db->escape_str($data);}
    public function setpersonal_no_medico_portatiles_obtetrices($data){$this->personal_no_medico_portatiles_obtetrices=$this->db->escape_str($data);}
    public function setpersonal_no_medico_portatiles_tecnicos($data){$this->personal_no_medico_portatiles_tecnicos=$this->db->escape_str($data);}
    public function setpersonal_no_medico_portatiles_social($data){$this->personal_no_medico_portatiles_social=$this->db->escape_str($data);}
    public function setbanco_sangre_disponible_sangre($data){$this->banco_sangre_disponible_sangre=$this->db->escape_str($data);}
    public function setbanco_sangre_disponible_plasma($data){$this->banco_sangre_disponible_plasma=$this->db->escape_str($data);}
    public function setbanco_sangre_disponible_plaquetas($data){$this->banco_sangre_disponible_plaquetas=$this->db->escape_str($data);}
    public function setbanco_sangre_requerido_sangre($data){$this->banco_sangre_requerido_sangre=$this->db->escape_str($data);}
    public function setbanco_sangre_requerido_plasma($data){$this->banco_sangre_requerido_plasma=$this->db->escape_str($data);}
    public function setbanco_sangre_requerido_plaquetas($data){$this->banco_sangre_requerido_plaquetas=$this->db->escape_str($data);}
    public function setbanco_sangre_portatiles_sangre($data){$this->banco_sangre_portatiles_sangre=$this->db->escape_str($data);}
    public function setbanco_sangre_portatiles_plasma($data){$this->banco_sangre_portatiles_plasma=$this->db->escape_str($data);}
    public function setbanco_sangre_portatiles_plaquetas($data){$this->banco_sangre_portatiles_plaquetas=$this->db->escape_str($data);}
    public function setventiladores_registrados_trauma_shock_adulto($data){$this->ventiladores_registrados_trauma_shock_adulto=$this->db->escape_str($data);}
    public function setventiladores_registrados_trauma_shock_pediatrico($data){$this->ventiladores_registrados_trauma_shock_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_registrados_uci_adultos($data){$this->ventiladores_registrados_uci_adultos=$this->db->escape_str($data);}
    public function setventiladores_registrados_uci_pedriatrica($data){$this->ventiladores_registrados_uci_pedriatrica=$this->db->escape_str($data);}
    public function setventiladores_registrados_uci_neonatologia($data){$this->ventiladores_registrados_uci_neonatologia=$this->db->escape_str($data);}
    public function setventiladores_registrados_sala_operaciones($data){$this->ventiladores_registrados_sala_operaciones=$this->db->escape_str($data);}
    public function setventiladores_registrados_ucin_adulto($data){$this->ventiladores_registrados_ucin_adulto=$this->db->escape_str($data);}
    public function setventiladores_registrados_ucin_pediatrico($data){$this->ventiladores_registrados_ucin_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_registrados_ucin_neonato($data){$this->ventiladores_registrados_ucin_neonato=$this->db->escape_str($data);}
    public function setventiladores_registrados_uci_gineco_obstetricia($data){$this->ventiladores_registrados_uci_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_registrados_ucin_gineco_obstetricia($data){$this->ventiladores_registrados_ucin_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_operativos_trauma_shock_adulto($data){$this->ventiladores_operativos_trauma_shock_adulto=$this->db->escape_str($data);}
    public function setventiladores_operativos_trauma_shock_pediatrico($data){$this->ventiladores_operativos_trauma_shock_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_operativos_uci_adultos($data){$this->ventiladores_operativos_uci_adultos=$this->db->escape_str($data);}
    public function setventiladores_operativos_uci_pedriatrica($data){$this->ventiladores_operativos_uci_pedriatrica=$this->db->escape_str($data);}
    public function setventiladores_operativos_uci_neonatologia($data){$this->ventiladores_operativos_uci_neonatologia=$this->db->escape_str($data);}
    public function setventiladores_operativos_sala_operaciones($data){$this->ventiladores_operativos_sala_operaciones=$this->db->escape_str($data);}
    public function setventiladores_operativos_ucin_adulto($data){$this->ventiladores_operativos_ucin_adulto=$this->db->escape_str($data);}
    public function setventiladores_operativos_ucin_pediatrico($data){$this->ventiladores_operativos_ucin_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_operativos_ucin_neonato($data){$this->ventiladores_operativos_ucin_neonato=$this->db->escape_str($data);}
    public function setventiladores_operativos_uci_gineco_obstetricia($data){$this->ventiladores_operativos_uci_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_operativos_ucin_gineco_obstetricia($data){$this->ventiladores_operativos_ucin_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_disponibles_trauma_shock_adulto($data){$this->ventiladores_disponibles_trauma_shock_adulto=$this->db->escape_str($data);}
    public function setventiladores_disponibles_trauma_shock_pediatrico($data){$this->ventiladores_disponibles_trauma_shock_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_disponibles_uci_adultos($data){$this->ventiladores_disponibles_uci_adultos=$this->db->escape_str($data);}
    public function setventiladores_disponibles_uci_pedriatrica($data){$this->ventiladores_disponibles_uci_pedriatrica=$this->db->escape_str($data);}
    public function setventiladores_disponibles_uci_neonatologia($data){$this->ventiladores_disponibles_uci_neonatologia=$this->db->escape_str($data);}
    public function setventiladores_disponibles_sala_operaciones($data){$this->ventiladores_disponibles_sala_operaciones=$this->db->escape_str($data);}
    public function setventiladores_disponibles_ucin_adulto($data){$this->ventiladores_disponibles_ucin_adulto=$this->db->escape_str($data);}
    public function setventiladores_disponibles_ucin_pediatrico($data){$this->ventiladores_disponibles_ucin_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_disponibles_ucin_neonato($data){$this->ventiladores_disponibles_ucin_neonato=$this->db->escape_str($data);}
    public function setventiladores_disponibles_uci_gineco_obstetricia($data){$this->ventiladores_disponibles_uci_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_disponibles_ucin_gineco_obstetricia($data){$this->ventiladores_disponibles_ucin_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_alquilados_trauma_shock_adulto($data){$this->ventiladores_alquilados_trauma_shock_adulto=$this->db->escape_str($data);}
    public function setventiladores_alquilados_trauma_shock_pediatrico($data){$this->ventiladores_alquilados_trauma_shock_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_alquilados_uci_adultos($data){$this->ventiladores_alquilados_uci_adultos=$this->db->escape_str($data);}
    public function setventiladores_alquilados_uci_pedriatrica($data){$this->ventiladores_alquilados_uci_pedriatrica=$this->db->escape_str($data);}
    public function setventiladores_alquilados_uci_neonatologia($data){$this->ventiladores_alquilados_uci_neonatologia=$this->db->escape_str($data);}
    public function setventiladores_alquilados_sala_operaciones($data){$this->ventiladores_alquilados_sala_operaciones=$this->db->escape_str($data);}
    public function setventiladores_alquilados_ucin_adulto($data){$this->ventiladores_alquilados_ucin_adulto=$this->db->escape_str($data);}
    public function setventiladores_alquilados_ucin_pediatrico($data){$this->ventiladores_alquilados_ucin_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_alquilados_ucin_neonato($data){$this->ventiladores_alquilados_ucin_neonato=$this->db->escape_str($data);}
    public function setventiladores_alquilados_uci_gineco_obstetricia($data){$this->ventiladores_alquilados_uci_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_alquilados_ucin_gineco_obstetricia($data){$this->ventiladores_alquilados_ucin_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_brecha_trauma_shock_adulto($data){$this->ventiladores_brecha_trauma_shock_adulto=$this->db->escape_str($data);}
    public function setventiladores_brecha_trauma_shock_pediatrico($data){$this->ventiladores_brecha_trauma_shock_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_brecha_uci_adultos($data){$this->ventiladores_brecha_uci_adultos=$this->db->escape_str($data);}
    public function setventiladores_brecha_uci_pedriatrica($data){$this->ventiladores_brecha_uci_pedriatrica=$this->db->escape_str($data);}
    public function setventiladores_brecha_uci_neonatologia($data){$this->ventiladores_brecha_uci_neonatologia=$this->db->escape_str($data);}
    public function setventiladores_brecha_sala_operaciones($data){$this->ventiladores_brecha_sala_operaciones=$this->db->escape_str($data);}
    public function setventiladores_brecha_ucin_adulto($data){$this->ventiladores_brecha_ucin_adulto=$this->db->escape_str($data);}
    public function setventiladores_brecha_ucin_pediatrico($data){$this->ventiladores_brecha_ucin_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_brecha_ucin_neonato($data){$this->ventiladores_brecha_ucin_neonato=$this->db->escape_str($data);}
    public function setventiladores_brecha_uci_gineco_obstetricia($data){$this->ventiladores_brecha_uci_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_brecha_ucin_gineco_obstetricia($data){$this->ventiladores_brecha_ucin_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_portatiles_trauma_shock_adulto($data){$this->ventiladores_portatiles_trauma_shock_adulto=$this->db->escape_str($data);}
    public function setventiladores_portatiles_trauma_shock_pediatrico($data){$this->ventiladores_portatiles_trauma_shock_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_portatiles_uci_adultos($data){$this->ventiladores_portatiles_uci_adultos=$this->db->escape_str($data);}
    public function setventiladores_portatiles_uci_pedriatrica($data){$this->ventiladores_portatiles_uci_pedriatrica=$this->db->escape_str($data);}
    public function setventiladores_portatiles_uci_neonatologia($data){$this->ventiladores_portatiles_uci_neonatologia=$this->db->escape_str($data);}
    public function setventiladores_portatiles_sala_operaciones($data){$this->ventiladores_portatiles_sala_operaciones=$this->db->escape_str($data);}
    public function setventiladores_portatiles_ucin_adulto($data){$this->ventiladores_portatiles_ucin_adulto=$this->db->escape_str($data);}
    public function setventiladores_portatiles_ucin_pediatrico($data){$this->ventiladores_portatiles_ucin_pediatrico=$this->db->escape_str($data);}
    public function setventiladores_portatiles_ucin_neonato($data){$this->ventiladores_portatiles_ucin_neonato=$this->db->escape_str($data);}
    public function setventiladores_portatiles_uci_gineco_obstetricia($data){$this->ventiladores_portatiles_uci_gineco_obstetricia=$this->db->escape_str($data);}
    public function setventiladores_portatiles_ucin_gineco_obstetricia($data){$this->ventiladores_portatiles_ucin_gineco_obstetricia=$this->db->escape_str($data);}
    public function setambulancias_tipo_i_registradas($data){$this->ambulancias_tipo_i_registradas=$this->db->escape_str($data);}
    public function setambulancias_tipo_i_operaivas($data){$this->ambulancias_tipo_i_operaivas=$this->db->escape_str($data);}
    public function setambulancias_tipo_i_radio($data){$this->ambulancias_tipo_i_radio=$this->db->escape_str($data);}
    public function setambulancias_tipo_ii_registradas($data){$this->ambulancias_tipo_ii_registradas=$this->db->escape_str($data);}
    public function setambulancias_tipo_ii_operaivas($data){$this->ambulancias_tipo_ii_operaivas=$this->db->escape_str($data);}
    public function setambulancias_tipo_ii_radio($data){$this->ambulancias_tipo_ii_radio=$this->db->escape_str($data);}
    public function setambulancias_tipo_iii_registradas($data){$this->ambulancias_tipo_iii_registradas=$this->db->escape_str($data);}
    public function setambulancias_tipo_iii_operaivas($data){$this->ambulancias_tipo_iii_operaivas=$this->db->escape_str($data);}
    public function setambulancias_tipo_iii_radio($data){$this->ambulancias_tipo_iii_radio=$this->db->escape_str($data);}   
    public function sethospitales_situaciones_emergencia_fecha($data) {$this->hospitales_situaciones_emergencia_fecha = $this->db->escape_str($data); }
    public function sethospitales_situaciones_emergencia_ocurrencia($data) {$this->hospitales_situaciones_emergencia_ocurrencia = $this->db->escape_str($data); }
    public function setocurrencia($data) {$this->ocurrencia = $this->db->escape_str($data); }
    public function listar(){
        $this->db->select("e.hospitales_situaciones_emergencia_id id,e.responsable_reporte,e.jefe_guardia,e.telefono,n.hospitales_situaciones_nombre hospital_nombre");
        $this->db->select("e.hospitales_situaciones_nombre_id hospital_id,DATE_FORMAT(e.fecha,'%d/%m/%Y') fecha,e.hora,e.Activo");
        $this->db->from("hospitales_situaciones_emergencia e");
        $this->db->join("hospitales_situaciones_nombre n","e.hospitales_situaciones_nombre_id=n.hospitales_situaciones_nombre_id");
        $this->db->where("e.Activo","1");
        $this->db->order_by("fecha");
        return $this->db->get();
    }
    public function hospital(){
        $this->db->select("hospitales_situaciones_emergencia_id id");
        $this->db->select("hospitales_situaciones_nombre_id");
        $this->db->select("dni_responsable_reporte");
        $this->db->select("responsable_reporte");
        $this->db->select("cmp_responsable_reporte");
        $this->db->select("rne_responsable_reporte");
        $this->db->select("dni_jefe_guardia");
        $this->db->select("jefe_guardia");
        $this->db->select("cmp_jefe_guardia");
        $this->db->select("rne_jefe_guardia");
        $this->db->select("telefono");
        $this->db->select("DATE_FORMAT(fecha,'%d/%m/%Y') fecha");
        $this->db->select("hora");
        $this->db->select("nedocs_shock_trauma");
        $this->db->select("nedocs_medicina");
        $this->db->select("nedocs_cirugia");
        $this->db->select("nedocs_gineco_obstetricia");
        $this->db->select("nedocs_pedriatria");
        $this->db->select("nedocs_observacion_medicina");
        $this->db->select("nedocs_observacion_cirugia");
        $this->db->select("nedocs_observacion_gineco_obstetricia");
        $this->db->select("nedocs_observacion_pediatria");
        $this->db->select("nedocs_camas_emergencia_ocupadas_pasillos");
        $this->db->select("nedocs_camas_emergencia_ocupadas_areas_contigencia");
        $this->db->select("nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres");
        $this->db->select("nedocs_capacidad_expansion_emergencias_desastres");
        $this->db->select("nedocs_tiempo_espera_ensala_ultimo_paciente_llamado");
        $this->db->select("nedocs_tiempo_espera_mas_largo_por_cama_de_internacion");
        $this->db->select("nedocs_pacientes_espera_cama_internamiento");
        $this->db->select("nedocs_cantidad_total_pacientes_ventilacion");
        $this->db->select("nedocs_cantidad_total_camas_hospital");
        $this->db->select("nedocs_resultado");
        $this->db->select("emergencia_camas_ogti_shock_trauma");
        $this->db->select("emergencia_camas_ogti_medicina");
        $this->db->select("emergencia_camas_ogti_cirugia");
        $this->db->select("emergencia_camas_ogti_gineco_obstetricia");
        $this->db->select("emergencia_camas_ogti_pedriatria");
        $this->db->select("emergencia_camas_ogti_observacion_medicina");
        $this->db->select("emergencia_camas_ogti_observacion_cirugia");
        $this->db->select("emergencia_camas_ogti_observacion_gineco_obstetricia");
        $this->db->select("emergencia_camas_ogti_observacion_pediatria");
        $this->db->select("emergencia_camas_pasillos_shock_trauma");
        $this->db->select("emergencia_camas_pasillos_medicina");
        $this->db->select("emergencia_camas_pasillos_cirugia");
        $this->db->select("emergencia_camas_pasillos_gineco_obstetricia");
        $this->db->select("emergencia_camas_pasillos_pedriatria");
        $this->db->select("emergencia_camas_pasillos_observacion_medicina");
        $this->db->select("emergencia_camas_pasillos_observacion_cirugia");
        $this->db->select("emergencia_camas_pasillos_observacion_gineco_obstetricia");
        $this->db->select("emergencia_camas_pasillos_observacion_pediatria");
        $this->db->select("emergencia_camas_contingencia_shock_trauma");
        $this->db->select("emergencia_camas_contingencia_medicina");
        $this->db->select("emergencia_camas_contingencia_cirugia");
        $this->db->select("emergencia_camas_contingencia_gineco_obstetricia");
        $this->db->select("emergencia_camas_contingencia_pedriatria");
        $this->db->select("emergencia_camas_contingencia_observacion_medicina");
        $this->db->select("emergencia_camas_contingencia_observacion_cirugia");
        $this->db->select("emergencia_camas_contingencia_observacion_gineco_obstetricia");
        $this->db->select("emergencia_camas_contingencia_observacion_pediatria");
        $this->db->select("emergencia_camas_expansion_shock_trauma");
        $this->db->select("emergencia_camas_expansion_medicina");
        $this->db->select("emergencia_camas_expansion_cirugia");
        $this->db->select("emergencia_camas_expansion_gineco_obstetricia");
        $this->db->select("emergencia_camas_expansion_pedriatria");
        $this->db->select("emergencia_camas_expansion_observacion_medicina");
        $this->db->select("emergencia_camas_expansion_observacion_cirugia");
        $this->db->select("emergencia_camas_expansion_observacion_gineco_obstetricia");
        $this->db->select("emergencia_camas_expansion_observacion_pediatria");
        $this->db->select("emergencia_camas_desastres_shock_trauma");
        $this->db->select("emergencia_camas_desastres_medicina");
        $this->db->select("emergencia_camas_desastres_cirugia");
        $this->db->select("emergencia_camas_desastres_gineco_obstetricia");
        $this->db->select("emergencia_camas_desastres_pedriatria");
        $this->db->select("emergencia_camas_desastres_observacion_medicina");
        $this->db->select("emergencia_camas_desastres_observacion_cirugia");
        $this->db->select("emergencia_camas_desastres_observacion_gineco_obstetricia");
        $this->db->select("emergencia_camas_desastres_observacion_pediatria");
        $this->db->select("pedriatria_camas_ogti_uci_pedriatrica");
        $this->db->select("pedriatria_camas_ogti_ucin_pedriatrica");
        $this->db->select("pedriatria_camas_ogti_uci_neonato");
        $this->db->select("pedriatria_camas_ogti_ucin_neonato");
        $this->db->select("pedriatria_camas_ocupadas_uci_pedriatrica");
        $this->db->select("pedriatria_camas_ocupadas_ucin_pedriatrica");
        $this->db->select("pedriatria_camas_ocupadas_uci_neonato");
        $this->db->select("pedriatria_camas_ocupadas_ucin_neonato");
        $this->db->select("pedriatria_camas_pasillos_uci_pedriatrica");
        $this->db->select("pedriatria_camas_pasillos_ucin_pedriatrica");
        $this->db->select("pedriatria_camas_pasillos_uci_neonato");
        $this->db->select("pedriatria_camas_pasillos_ucin_neonato");
        $this->db->select("pedriatria_camas_contigencia_uci_pedriatrica");
        $this->db->select("pedriatria_camas_contigencia_ucin_pedriatrica");
        $this->db->select("pedriatria_camas_contigencia_uci_neonato");
        $this->db->select("pedriatria_camas_contigencia_ucin_neonato");
        $this->db->select("pedriatria_camas_expansion_uci_pedriatrica");
        $this->db->select("pedriatria_camas_expansion_ucin_pedriatrica");
        $this->db->select("pedriatria_camas_expansion_uci_neonato");
        $this->db->select("pedriatria_camas_expansion_ucin_neonato");
        $this->db->select("gineco_obstetricia_camas_ogti_uci");
        $this->db->select("gineco_obstetricia_camas_ogti_ucin");
        $this->db->select("gineco_obstetricia_camas_ocupadas_uci");
        $this->db->select("gineco_obstetricia_camas_ocupadas_ucin");
        $this->db->select("gineco_obstetricia_camas_pasillos_uci");
        $this->db->select("gineco_obstetricia_camas_pasillos_ucin");
        $this->db->select("gineco_obstetricia_camas_contingencia_uci");
        $this->db->select("gineco_obstetricia_camas_contingencia_ucin");
        $this->db->select("gineco_obstetricia_camas_expansion_uci");
        $this->db->select("gineco_obstetricia_camas_expansion_ucin");
        $this->db->select("sop_camas_disponibles_gineco_obstetrica");
        $this->db->select("sop_camas_disponibles_emergencia");
        $this->db->select("sop_camas_requeridos_gineco_obstetrica");
        $this->db->select("sop_camas_requeridos_emergencia");
        $this->db->select("sop_camas_portatiles_gineco_obstetrica");
        $this->db->select("sop_camas_portatiles_emergencia");
        $this->db->select("sop_camas_expansion_gineco_obstetrica");
        $this->db->select("sop_camas_expansion_emergencia");
        $this->db->select("personal_medico_programado_pediatria");
        $this->db->select("personal_medico_programado_cirugia_pediatrica");
        $this->db->select("personal_medico_programado_gineco_obstetricia");
        $this->db->select("personal_medico_programado_medicina_internista");
        $this->db->select("personal_medico_programado_medicina_cardiologo");
        $this->db->select("personal_medico_programado_medicina_nefrologo");
        $this->db->select("personal_medico_programado_cirugia_general");
        $this->db->select("personal_medico_programado_traumatologia");
        $this->db->select("personal_medico_programado_neurocirugia");
        $this->db->select("personal_medico_programado_cirugia_torax");
        $this->db->select("personal_medico_programado_medicina_intensiva");
        $this->db->select("personal_medico_programado_neonatologo");
        $this->db->select("personal_medico_programado_anestesiologo");
        $this->db->select("personal_medico_requerido_pediatria");
        $this->db->select("personal_medico_requerido_cirugia_pediatrica");
        $this->db->select("personal_medico_requerido_gineco_obstetricia");
        $this->db->select("personal_medico_requerido_medicina_internista");
        $this->db->select("personal_medico_requerido_medicina_cardiologo");
        $this->db->select("personal_medico_requerido_medicina_nefrologo");
        $this->db->select("personal_medico_requerido_cirugia_general");
        $this->db->select("personal_medico_requerido_traumatologia");
        $this->db->select("personal_medico_requerido_neurocirugia");
        $this->db->select("personal_medico_requerido_cirugia_torax");
        $this->db->select("personal_medico_requerido_medicina_intensiva");
        $this->db->select("personal_medico_requerido_neonatologo");
        $this->db->select("personal_medico_requerido_anestesiologo");
        $this->db->select("personal_medico_reten_pediatria");
        $this->db->select("personal_medico_reten_cirugia_pediatrica");
        $this->db->select("personal_medico_reten_gineco_obstetricia");
        $this->db->select("personal_medico_reten_medicina_internista");
        $this->db->select("personal_medico_reten_medicina_cardiologo");
        $this->db->select("personal_medico_reten_medicina_nefrologo");
        $this->db->select("personal_medico_reten_cirugia_general");
        $this->db->select("personal_medico_reten_traumatologia");
        $this->db->select("personal_medico_reten_neurocirugia");
        $this->db->select("personal_medico_reten_cirugia_torax");
        $this->db->select("personal_medico_reten_medicina_intensiva");
        $this->db->select("personal_medico_reten_neonatologo");
        $this->db->select("personal_medico_reten_anestesiologo");
        $this->db->select("personal_medico_portatiles_pediatria");
        $this->db->select("personal_medico_portatiles_cirugia_pediatrica");
        $this->db->select("personal_medico_portatiles_gineco_obstetricia");
        $this->db->select("personal_medico_portatiles_medicina_internista");
        $this->db->select("personal_medico_portatiles_medicina_cardiologo");
        $this->db->select("personal_medico_portatiles_medicina_nefrologo");
        $this->db->select("personal_medico_portatiles_cirugia_general");
        $this->db->select("personal_medico_portatiles_traumatologia");
        $this->db->select("personal_medico_portatiles_neurocirugia");
        $this->db->select("personal_medico_portatiles_cirugia_torax");
        $this->db->select("personal_medico_portatiles_medicina_intensiva");
        $this->db->select("personal_medico_portatiles_neonatologo");
        $this->db->select("personal_medico_portatiles_anestesiologo");
        $this->db->select("personal_no_medico_programado_enfermeras");
        $this->db->select("personal_no_medico_programado_tecnologos");
        $this->db->select("personal_no_medico_programado_obtetrices");
        $this->db->select("personal_no_medico_programado_tecnicos");
        $this->db->select("personal_no_medico_programado_social");
        $this->db->select("personal_no_medico_requerido_enfermeras");
        $this->db->select("personal_no_medico_requerido_tecnologos");
        $this->db->select("personal_no_medico_requerido_obtetrices");
        $this->db->select("personal_no_medico_requerido_tecnicos");
        $this->db->select("personal_no_medico_requerido_social");
        $this->db->select("personal_no_medico_reten_enfermeras");
        $this->db->select("personal_no_medico_reten_tecnologos");
        $this->db->select("personal_no_medico_reten_obtetrices");
        $this->db->select("personal_no_medico_reten_tecnicos");
        $this->db->select("personal_no_medico_reten_social");
        $this->db->select("personal_no_medico_portatiles_enfermeras");
        $this->db->select("personal_no_medico_portatiles_tecnologos");
        $this->db->select("personal_no_medico_portatiles_obtetrices");
        $this->db->select("personal_no_medico_portatiles_tecnicos");
        $this->db->select("personal_no_medico_portatiles_social");
        $this->db->select("banco_sangre_disponible_sangre");
        $this->db->select("banco_sangre_disponible_plasma");
        $this->db->select("banco_sangre_disponible_plaquetas");
        $this->db->select("banco_sangre_requerido_sangre");
        $this->db->select("banco_sangre_requerido_plasma");
        $this->db->select("banco_sangre_requerido_plaquetas");
        $this->db->select("banco_sangre_portatiles_sangre");
        $this->db->select("banco_sangre_portatiles_plasma");
        $this->db->select("banco_sangre_portatiles_plaquetas");
        $this->db->select("ventiladores_registrados_trauma_shock_adulto");
        $this->db->select("ventiladores_registrados_trauma_shock_pediatrico");
        $this->db->select("ventiladores_registrados_uci_adultos");
        $this->db->select("ventiladores_registrados_uci_pedriatrica");
        $this->db->select("ventiladores_registrados_uci_neonatologia");
        $this->db->select("ventiladores_registrados_sala_operaciones");
        $this->db->select("ventiladores_registrados_ucin_adulto");
        $this->db->select("ventiladores_registrados_ucin_pediatrico");
        $this->db->select("ventiladores_registrados_ucin_neonato");
        $this->db->select("ventiladores_registrados_uci_gineco_obstetricia");
        $this->db->select("ventiladores_registrados_ucin_gineco_obstetricia");
        $this->db->select("ventiladores_operativos_trauma_shock_adulto");
        $this->db->select("ventiladores_operativos_trauma_shock_pediatrico");
        $this->db->select("ventiladores_operativos_uci_adultos");
        $this->db->select("ventiladores_operativos_uci_pedriatrica");
        $this->db->select("ventiladores_operativos_uci_neonatologia");
        $this->db->select("ventiladores_operativos_sala_operaciones");
        $this->db->select("ventiladores_operativos_ucin_adulto");
        $this->db->select("ventiladores_operativos_ucin_pediatrico");
        $this->db->select("ventiladores_operativos_ucin_neonato");
        $this->db->select("ventiladores_operativos_uci_gineco_obstetricia");
        $this->db->select("ventiladores_operativos_ucin_gineco_obstetricia");
        $this->db->select("ventiladores_disponibles_trauma_shock_adulto");
        $this->db->select("ventiladores_disponibles_trauma_shock_pediatrico");
        $this->db->select("ventiladores_disponibles_uci_adultos");
        $this->db->select("ventiladores_disponibles_uci_pedriatrica");
        $this->db->select("ventiladores_disponibles_uci_neonatologia");
        $this->db->select("ventiladores_disponibles_sala_operaciones");
        $this->db->select("ventiladores_disponibles_ucin_adulto");
        $this->db->select("ventiladores_disponibles_ucin_pediatrico");
        $this->db->select("ventiladores_disponibles_ucin_neonato");
        $this->db->select("ventiladores_disponibles_uci_gineco_obstetricia");
        $this->db->select("ventiladores_disponibles_ucin_gineco_obstetricia");
        $this->db->select("ventiladores_alquilados_trauma_shock_adulto");
        $this->db->select("ventiladores_alquilados_trauma_shock_pediatrico");
        $this->db->select("ventiladores_alquilados_uci_adultos");
        $this->db->select("ventiladores_alquilados_uci_pedriatrica");
        $this->db->select("ventiladores_alquilados_uci_neonatologia");
        $this->db->select("ventiladores_alquilados_sala_operaciones");
        $this->db->select("ventiladores_alquilados_ucin_adulto");
        $this->db->select("ventiladores_alquilados_ucin_pediatrico");
        $this->db->select("ventiladores_alquilados_ucin_neonato");
        $this->db->select("ventiladores_alquilados_uci_gineco_obstetricia");
        $this->db->select("ventiladores_alquilados_ucin_gineco_obstetricia");
        $this->db->select("ventiladores_brecha_trauma_shock_adulto");
        $this->db->select("ventiladores_brecha_trauma_shock_pediatrico");
        $this->db->select("ventiladores_brecha_uci_adultos");
        $this->db->select("ventiladores_brecha_uci_pedriatrica");
        $this->db->select("ventiladores_brecha_uci_neonatologia");
        $this->db->select("ventiladores_brecha_sala_operaciones");
        $this->db->select("ventiladores_brecha_ucin_adulto");
        $this->db->select("ventiladores_brecha_ucin_pediatrico");
        $this->db->select("ventiladores_brecha_ucin_neonato");
        $this->db->select("ventiladores_brecha_uci_gineco_obstetricia");
        $this->db->select("ventiladores_brecha_ucin_gineco_obstetricia");
        $this->db->select("ventiladores_portatiles_trauma_shock_adulto");
        $this->db->select("ventiladores_portatiles_trauma_shock_pediatrico");
        $this->db->select("ventiladores_portatiles_uci_adultos");
        $this->db->select("ventiladores_portatiles_uci_pedriatrica");
        $this->db->select("ventiladores_portatiles_uci_neonatologia");
        $this->db->select("ventiladores_portatiles_sala_operaciones");
        $this->db->select("ventiladores_portatiles_ucin_adulto");
        $this->db->select("ventiladores_portatiles_ucin_pediatrico");
        $this->db->select("ventiladores_portatiles_ucin_neonato");
        $this->db->select("ventiladores_portatiles_uci_gineco_obstetricia");
        $this->db->select("ventiladores_portatiles_ucin_gineco_obstetricia");
        $this->db->select("ambulancias_tipo_i_registradas");
        $this->db->select("ambulancias_tipo_i_operaivas");
        $this->db->select("ambulancias_tipo_i_radio");
        $this->db->select("ambulancias_tipo_ii_registradas");
        $this->db->select("ambulancias_tipo_ii_operaivas");
        $this->db->select("ambulancias_tipo_ii_radio");
        $this->db->select("ambulancias_tipo_iii_registradas");
        $this->db->select("ambulancias_tipo_iii_operaivas");
        $this->db->select("ambulancias_tipo_iii_radio");
        $this->db->from("hospitales_situaciones_emergencia");
        $this->db->where("hospitales_situaciones_emergencia_id",$this->id);
        return $this->db->get();
    }
    public function hospitalesSobreDemandaNew() {
        $this->db->select("IF(hsn.hospitales_situaciones_nombre_id>0,1,0) tipo, hsn.idsobredemanda id, DATE_FORMAT(hsn.fecha_reporte,'%d/%m/%Y') fecha, hsn.*");
        $this->db->from("hospitales_sobredemanda_new hsn");
        $this->db->where("idsobredemanda", $this->id);
        return $this->db->get();
    }
    public function listarOcurrencias() {
        $this->db->select("DATE_FORMAT(hospitales_situaciones_emergencia_fecha,'%d/%m/%Y %H:%i') fecha, hospitales_situaciones_emergencia_ocurrencia ocurrencia");
        $this->db->from("hospitales_situaciones_emergencia_ocurrencias");
        $this->db->where("hospitales_situaciones_emergencia_id",$this->id);
        return $this->db->get();
    }
    public function hospitalesSituaciones() {
        $this->db->select("hospitales_situaciones_nombre_id id,hospitales_situaciones_nombre");
        $this->db->from("hospitales_situaciones_nombre");
        $this->db->where("Activo","1");
        $this->db->where("covid","1");
        return $this->db->get();
    }
    public function hospitalesSobreDemandaNewTipo() {
        $this->db->select("IF(hsn.hospitales_situaciones_nombre_id>0,1,0) tipo");
        $this->db->from("hospitales_sobredemanda_new hsn");
        $this->db->where("idsobredemanda", $this->id);
        return $this->db->get();
    }
    public function existe(){
        $this->db->select("hora");
        $this->db->from("hospitales_situaciones_emergencia");
        $this->db->where("hospitales_situaciones_nombre_id",$this->hospitales_situaciones_nombre_id);
        $this->db->where("DATE(fecha)",$this->fecha);
        return $this->db->get();
    }
    public function registrar() {
        $data = array(
            "hospitales_situaciones_nombre_id" => $this->hospitales_situaciones_nombre_id,
            "dni_responsable_reporte" => $this->dni_responsable_reporte,
            "responsable_reporte" => $this->responsable_reporte,
            "cmp_responsable_reporte" => $this->cmp_responsable_reporte,
            "rne_responsable_reporte" => $this->rne_responsable_reporte,
            "dni_jefe_guardia" => $this->dni_jefe_guardia,
            "jefe_guardia" => $this->jefe_guardia,
            "cmp_jefe_guardia" => $this->cmp_jefe_guardia,
            "rne_jefe_guardia" => $this->rne_jefe_guardia,
            "telefono" => $this->telefono,
            "fecha" => $this->fecha,
            "hora" => $this->hora,
            "usuario_registro" => $this->session->userdata("idusuario"),
            "fecha_registro" => date("Y-m-d H:i:s"),
            "usuario_actualizacion" => $this->usuario_actualizacion,
            "fecha_actualizacion" => $this->fecha_actualizacion,
            "nedocs_shock_trauma" => $this->nedocs_shock_trauma,
            "nedocs_medicina" => $this->nedocs_medicina,
            "nedocs_cirugia" => $this->nedocs_cirugia,
            "nedocs_gineco_obstetricia" => $this->nedocs_gineco_obstetricia,
            "nedocs_pedriatria" => $this->nedocs_pedriatria,
            "nedocs_observacion_medicina" => $this->nedocs_observacion_medicina,
            "nedocs_observacion_cirugia" => $this->nedocs_observacion_cirugia,
            "nedocs_observacion_gineco_obstetricia" => $this->nedocs_observacion_gineco_obstetricia,
            "nedocs_observacion_pediatria" => $this->nedocs_observacion_pediatria,
            "nedocs_camas_emergencia_ocupadas_pasillos" => $this->nedocs_camas_emergencia_ocupadas_pasillos,
            "nedocs_camas_emergencia_ocupadas_areas_contigencia" => $this->nedocs_camas_emergencia_ocupadas_areas_contigencia,
            "nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres" => $this->nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres,
            "nedocs_capacidad_expansion_emergencias_desastres" => $this->nedocs_capacidad_expansion_emergencias_desastres,
            "nedocs_tiempo_espera_ensala_ultimo_paciente_llamado" => $this->nedocs_tiempo_espera_ensala_ultimo_paciente_llamado,
            "nedocs_tiempo_espera_mas_largo_por_cama_de_internacion" => $this->nedocs_tiempo_espera_mas_largo_por_cama_de_internacion,
            "nedocs_pacientes_espera_cama_internamiento" => $this->nedocs_pacientes_espera_cama_internamiento,
            "nedocs_cantidad_total_pacientes_ventilacion" => $this->nedocs_cantidad_total_pacientes_ventilacion,
            "nedocs_cantidad_total_camas_hospital" => $this->nedocs_cantidad_total_camas_hospital,
            "nedocs_resultado" => $this->nedocs_resultado,
            "emergencia_camas_ogti_shock_trauma" => $this->emergencia_camas_ogti_shock_trauma,
            "emergencia_camas_ogti_medicina" => $this->emergencia_camas_ogti_medicina,
            "emergencia_camas_ogti_cirugia" => $this->emergencia_camas_ogti_cirugia,
            "emergencia_camas_ogti_gineco_obstetricia" => $this->emergencia_camas_ogti_gineco_obstetricia,
            "emergencia_camas_ogti_pedriatria" => $this->emergencia_camas_ogti_pedriatria,
            "emergencia_camas_ogti_observacion_medicina" => $this->emergencia_camas_ogti_observacion_medicina,
            "emergencia_camas_ogti_observacion_cirugia" => $this->emergencia_camas_ogti_observacion_cirugia,
            "emergencia_camas_ogti_observacion_gineco_obstetricia" => $this->emergencia_camas_ogti_observacion_gineco_obstetricia,
            "emergencia_camas_ogti_observacion_pediatria" => $this->emergencia_camas_ogti_observacion_pediatria,
            "emergencia_camas_pasillos_shock_trauma" => $this->emergencia_camas_pasillos_shock_trauma,
            "emergencia_camas_pasillos_medicina" => $this->emergencia_camas_pasillos_medicina,
            "emergencia_camas_pasillos_cirugia" => $this->emergencia_camas_pasillos_cirugia,
            "emergencia_camas_pasillos_gineco_obstetricia" => $this->emergencia_camas_pasillos_gineco_obstetricia,
            "emergencia_camas_pasillos_pedriatria" => $this->emergencia_camas_pasillos_pedriatria,
            "emergencia_camas_pasillos_observacion_medicina" => $this->emergencia_camas_pasillos_observacion_medicina,
            "emergencia_camas_pasillos_observacion_cirugia" => $this->emergencia_camas_pasillos_observacion_cirugia,
            "emergencia_camas_pasillos_observacion_gineco_obstetricia" => $this->emergencia_camas_pasillos_observacion_gineco_obstetricia,
            "emergencia_camas_pasillos_observacion_pediatria" => $this->emergencia_camas_pasillos_observacion_pediatria,
            "emergencia_camas_contingencia_shock_trauma" => $this->emergencia_camas_contingencia_shock_trauma,
            "emergencia_camas_contingencia_medicina" => $this->emergencia_camas_contingencia_medicina,
            "emergencia_camas_contingencia_cirugia" => $this->emergencia_camas_contingencia_cirugia,
            "emergencia_camas_contingencia_gineco_obstetricia" => $this->emergencia_camas_contingencia_gineco_obstetricia,
            "emergencia_camas_contingencia_pedriatria" => $this->emergencia_camas_contingencia_pedriatria,
            "emergencia_camas_contingencia_observacion_medicina" => $this->emergencia_camas_contingencia_observacion_medicina,
            "emergencia_camas_contingencia_observacion_cirugia" => $this->emergencia_camas_contingencia_observacion_cirugia,
            "emergencia_camas_contingencia_observacion_gineco_obstetricia" => $this->emergencia_camas_contingencia_observacion_gineco_obstetricia,
            "emergencia_camas_contingencia_observacion_pediatria" => $this->emergencia_camas_contingencia_observacion_pediatria,
            "emergencia_camas_expansion_shock_trauma" => $this->emergencia_camas_expansion_shock_trauma,
            "emergencia_camas_expansion_medicina" => $this->emergencia_camas_expansion_medicina,
            "emergencia_camas_expansion_cirugia" => $this->emergencia_camas_expansion_cirugia,
            "emergencia_camas_expansion_gineco_obstetricia" => $this->emergencia_camas_expansion_gineco_obstetricia,
            "emergencia_camas_expansion_pedriatria" => $this->emergencia_camas_expansion_pedriatria,
            "emergencia_camas_expansion_observacion_medicina" => $this->emergencia_camas_expansion_observacion_medicina,
            "emergencia_camas_expansion_observacion_cirugia" => $this->emergencia_camas_expansion_observacion_cirugia,
            "emergencia_camas_expansion_observacion_gineco_obstetricia" => $this->emergencia_camas_expansion_observacion_gineco_obstetricia,
            "emergencia_camas_expansion_observacion_pediatria" => $this->emergencia_camas_expansion_observacion_pediatria,
            "emergencia_camas_desastres_shock_trauma" => $this->emergencia_camas_desastres_shock_trauma,
            "emergencia_camas_desastres_medicina" => $this->emergencia_camas_desastres_medicina,
            "emergencia_camas_desastres_cirugia" => $this->emergencia_camas_desastres_cirugia,
            "emergencia_camas_desastres_gineco_obstetricia" => $this->emergencia_camas_desastres_gineco_obstetricia,
            "emergencia_camas_desastres_pedriatria" => $this->emergencia_camas_desastres_pedriatria,
            "emergencia_camas_desastres_observacion_medicina" => $this->emergencia_camas_desastres_observacion_medicina,
            "emergencia_camas_desastres_observacion_cirugia" => $this->emergencia_camas_desastres_observacion_cirugia,
            "emergencia_camas_desastres_observacion_gineco_obstetricia" => $this->emergencia_camas_desastres_observacion_gineco_obstetricia,
            "emergencia_camas_desastres_observacion_pediatria" => $this->emergencia_camas_desastres_observacion_pediatria,
            "pedriatria_camas_ogti_uci_pedriatrica" => $this->pedriatria_camas_ogti_uci_pedriatrica,
            "pedriatria_camas_ogti_ucin_pedriatrica" => $this->pedriatria_camas_ogti_ucin_pedriatrica,
            "pedriatria_camas_ogti_uci_neonato" => $this->pedriatria_camas_ogti_uci_neonato,
            "pedriatria_camas_ogti_ucin_neonato" => $this->pedriatria_camas_ogti_ucin_neonato,
            "pedriatria_camas_ocupadas_uci_pedriatrica" => $this->pedriatria_camas_ocupadas_uci_pedriatrica,
            "pedriatria_camas_ocupadas_ucin_pedriatrica" => $this->pedriatria_camas_ocupadas_ucin_pedriatrica,
            "pedriatria_camas_ocupadas_uci_neonato" => $this->pedriatria_camas_ocupadas_uci_neonato,
            "pedriatria_camas_ocupadas_ucin_neonato" => $this->pedriatria_camas_ocupadas_ucin_neonato,
            "pedriatria_camas_pasillos_uci_pedriatrica" => $this->pedriatria_camas_pasillos_uci_pedriatrica,
            "pedriatria_camas_pasillos_ucin_pedriatrica" => $this->pedriatria_camas_pasillos_ucin_pedriatrica,
            "pedriatria_camas_pasillos_uci_neonato" => $this->pedriatria_camas_pasillos_uci_neonato,
            "pedriatria_camas_pasillos_ucin_neonato" => $this->pedriatria_camas_pasillos_ucin_neonato,
            "pedriatria_camas_contigencia_uci_pedriatrica" => $this->pedriatria_camas_contigencia_uci_pedriatrica,
            "pedriatria_camas_contigencia_ucin_pedriatrica" => $this->pedriatria_camas_contigencia_ucin_pedriatrica,
            "pedriatria_camas_contigencia_uci_neonato" => $this->pedriatria_camas_contigencia_uci_neonato,
            "pedriatria_camas_contigencia_ucin_neonato" => $this->pedriatria_camas_contigencia_ucin_neonato,
            "pedriatria_camas_expansion_uci_pedriatrica" => $this->pedriatria_camas_expansion_uci_pedriatrica,
            "pedriatria_camas_expansion_ucin_pedriatrica" => $this->pedriatria_camas_expansion_ucin_pedriatrica,
            "pedriatria_camas_expansion_uci_neonato" => $this->pedriatria_camas_expansion_uci_neonato,
            "pedriatria_camas_expansion_ucin_neonato" => $this->pedriatria_camas_expansion_ucin_neonato,
            "gineco_obstetricia_camas_ogti_uci" => $this->gineco_obstetricia_camas_ogti_uci,
            "gineco_obstetricia_camas_ogti_ucin" => $this->gineco_obstetricia_camas_ogti_ucin,
            "gineco_obstetricia_camas_ocupadas_uci" => $this->gineco_obstetricia_camas_ocupadas_uci,
            "gineco_obstetricia_camas_ocupadas_ucin" => $this->gineco_obstetricia_camas_ocupadas_ucin,
            "gineco_obstetricia_camas_pasillos_uci" => $this->gineco_obstetricia_camas_pasillos_uci,
            "gineco_obstetricia_camas_pasillos_ucin" => $this->gineco_obstetricia_camas_pasillos_ucin,
            "gineco_obstetricia_camas_contingencia_uci" => $this->gineco_obstetricia_camas_contingencia_uci,
            "gineco_obstetricia_camas_contingencia_ucin" => $this->gineco_obstetricia_camas_contingencia_ucin,
            "gineco_obstetricia_camas_expansion_uci" => $this->gineco_obstetricia_camas_expansion_uci,
            "gineco_obstetricia_camas_expansion_ucin" => $this->gineco_obstetricia_camas_expansion_ucin,
            "sop_camas_disponibles_gineco_obstetrica" => $this->sop_camas_disponibles_gineco_obstetrica,
            "sop_camas_disponibles_emergencia" => $this->sop_camas_disponibles_emergencia,
            "sop_camas_requeridos_gineco_obstetrica" => $this->sop_camas_requeridos_gineco_obstetrica,
            "sop_camas_requeridos_emergencia" => $this->sop_camas_requeridos_emergencia,
            "sop_camas_portatiles_gineco_obstetrica" => $this->sop_camas_portatiles_gineco_obstetrica,
            "sop_camas_portatiles_emergencia" => $this->sop_camas_portatiles_emergencia,
            "sop_camas_expansion_gineco_obstetrica" => $this->sop_camas_expansion_gineco_obstetrica,
            "sop_camas_expansion_emergencia" => $this->sop_camas_expansion_emergencia,
            "personal_medico_programado_pediatria" => $this->personal_medico_programado_pediatria,
            "personal_medico_programado_cirugia_pediatrica" => $this->personal_medico_programado_cirugia_pediatrica,
            "personal_medico_programado_gineco_obstetricia" => $this->personal_medico_programado_gineco_obstetricia,
            "personal_medico_programado_medicina_internista" => $this->personal_medico_programado_medicina_internista,
            "personal_medico_programado_medicina_cardiologo" => $this->personal_medico_programado_medicina_cardiologo,
            "personal_medico_programado_medicina_nefrologo" => $this->personal_medico_programado_medicina_nefrologo,
            "personal_medico_programado_cirugia_general" => $this->personal_medico_programado_cirugia_general,
            "personal_medico_programado_traumatologia" => $this->personal_medico_programado_traumatologia,
            "personal_medico_programado_neurocirugia" => $this->personal_medico_programado_neurocirugia,
            "personal_medico_programado_cirugia_torax" => $this->personal_medico_programado_cirugia_torax,
            "personal_medico_programado_medicina_intensiva" => $this->personal_medico_programado_medicina_intensiva,
            "personal_medico_programado_neonatologo" => $this->personal_medico_programado_neonatologo,
            "personal_medico_programado_anestesiologo" => $this->personal_medico_programado_anestesiologo,
            "personal_medico_requerido_pediatria" => $this->personal_medico_requerido_pediatria,
            "personal_medico_requerido_cirugia_pediatrica" => $this->personal_medico_requerido_cirugia_pediatrica,
            "personal_medico_requerido_gineco_obstetricia" => $this->personal_medico_requerido_gineco_obstetricia,
            "personal_medico_requerido_medicina_internista" => $this->personal_medico_requerido_medicina_internista,
            "personal_medico_requerido_medicina_cardiologo" => $this->personal_medico_requerido_medicina_cardiologo,
            "personal_medico_requerido_medicina_nefrologo" => $this->personal_medico_requerido_medicina_nefrologo,
            "personal_medico_requerido_cirugia_general" => $this->personal_medico_requerido_cirugia_general,
            "personal_medico_requerido_traumatologia" => $this->personal_medico_requerido_traumatologia,
            "personal_medico_requerido_neurocirugia" => $this->personal_medico_requerido_neurocirugia,
            "personal_medico_requerido_cirugia_torax" => $this->personal_medico_requerido_cirugia_torax,
            "personal_medico_requerido_medicina_intensiva" => $this->personal_medico_requerido_medicina_intensiva,
            "personal_medico_requerido_neonatologo" => $this->personal_medico_requerido_neonatologo,
            "personal_medico_requerido_anestesiologo" => $this->personal_medico_requerido_anestesiologo,
            "personal_medico_reten_pediatria" => $this->personal_medico_reten_pediatria,
            "personal_medico_reten_cirugia_pediatrica" => $this->personal_medico_reten_cirugia_pediatrica,
            "personal_medico_reten_gineco_obstetricia" => $this->personal_medico_reten_gineco_obstetricia,
            "personal_medico_reten_medicina_internista" => $this->personal_medico_reten_medicina_internista,
            "personal_medico_reten_medicina_cardiologo" => $this->personal_medico_reten_medicina_cardiologo,
            "personal_medico_reten_medicina_nefrologo" => $this->personal_medico_reten_medicina_nefrologo,
            "personal_medico_reten_cirugia_general" => $this->personal_medico_reten_cirugia_general,
            "personal_medico_reten_traumatologia" => $this->personal_medico_reten_traumatologia,
            "personal_medico_reten_neurocirugia" => $this->personal_medico_reten_neurocirugia,
            "personal_medico_reten_cirugia_torax" => $this->personal_medico_reten_cirugia_torax,
            "personal_medico_reten_medicina_intensiva" => $this->personal_medico_reten_medicina_intensiva,
            "personal_medico_reten_neonatologo" => $this->personal_medico_reten_neonatologo,
            "personal_medico_reten_anestesiologo" => $this->personal_medico_reten_anestesiologo,
            "personal_medico_portatiles_pediatria" => $this->personal_medico_portatiles_pediatria,
            "personal_medico_portatiles_cirugia_pediatrica" => $this->personal_medico_portatiles_cirugia_pediatrica,
            "personal_medico_portatiles_gineco_obstetricia" => $this->personal_medico_portatiles_gineco_obstetricia,
            "personal_medico_portatiles_medicina_internista" => $this->personal_medico_portatiles_medicina_internista,
            "personal_medico_portatiles_medicina_cardiologo" => $this->personal_medico_portatiles_medicina_cardiologo,
            "personal_medico_portatiles_medicina_nefrologo" => $this->personal_medico_portatiles_medicina_nefrologo,
            "personal_medico_portatiles_cirugia_general" => $this->personal_medico_portatiles_cirugia_general,
            "personal_medico_portatiles_traumatologia" => $this->personal_medico_portatiles_traumatologia,
            "personal_medico_portatiles_neurocirugia" => $this->personal_medico_portatiles_neurocirugia,
            "personal_medico_portatiles_cirugia_torax" => $this->personal_medico_portatiles_cirugia_torax,
            "personal_medico_portatiles_medicina_intensiva" => $this->personal_medico_portatiles_medicina_intensiva,
            "personal_medico_portatiles_neonatologo" => $this->personal_medico_portatiles_neonatologo,
            "personal_medico_portatiles_anestesiologo" => $this->personal_medico_portatiles_anestesiologo,
            "personal_no_medico_programado_enfermeras" => $this->personal_no_medico_programado_enfermeras,
            "personal_no_medico_programado_tecnologos" => $this->personal_no_medico_programado_tecnologos,
            "personal_no_medico_programado_obtetrices" => $this->personal_no_medico_programado_obtetrices,
            "personal_no_medico_programado_tecnicos" => $this->personal_no_medico_programado_tecnicos,
            "personal_no_medico_programado_social" => $this->personal_no_medico_programado_social,
            "personal_no_medico_requerido_enfermeras" => $this->personal_no_medico_requerido_enfermeras,
            "personal_no_medico_requerido_tecnologos" => $this->personal_no_medico_requerido_tecnologos,
            "personal_no_medico_requerido_obtetrices" => $this->personal_no_medico_requerido_obtetrices,
            "personal_no_medico_requerido_tecnicos" => $this->personal_no_medico_requerido_tecnicos,
            "personal_no_medico_requerido_social" => $this->personal_no_medico_requerido_social,
            "personal_no_medico_reten_enfermeras" => $this->personal_no_medico_reten_enfermeras,
            "personal_no_medico_reten_tecnologos" => $this->personal_no_medico_reten_tecnologos,
            "personal_no_medico_reten_obtetrices" => $this->personal_no_medico_reten_obtetrices,
            "personal_no_medico_reten_tecnicos" => $this->personal_no_medico_reten_tecnicos,
            "personal_no_medico_reten_social" => $this->personal_no_medico_reten_social,
            "personal_no_medico_portatiles_enfermeras" => $this->personal_no_medico_portatiles_enfermeras,
            "personal_no_medico_portatiles_tecnologos" => $this->personal_no_medico_portatiles_tecnologos,
            "personal_no_medico_portatiles_obtetrices" => $this->personal_no_medico_portatiles_obtetrices,
            "personal_no_medico_portatiles_tecnicos" => $this->personal_no_medico_portatiles_tecnicos,
            "personal_no_medico_portatiles_social" => $this->personal_no_medico_portatiles_social,
            "banco_sangre_disponible_sangre" => $this->banco_sangre_disponible_sangre,
            "banco_sangre_disponible_plasma" => $this->banco_sangre_disponible_plasma,
            "banco_sangre_disponible_plaquetas" => $this->banco_sangre_disponible_plaquetas,
            "banco_sangre_requerido_sangre" => $this->banco_sangre_requerido_sangre,
            "banco_sangre_requerido_plasma" => $this->banco_sangre_requerido_plasma,
            "banco_sangre_requerido_plaquetas" => $this->banco_sangre_requerido_plaquetas,
            "banco_sangre_portatiles_sangre" => $this->banco_sangre_portatiles_sangre,
            "banco_sangre_portatiles_plasma" => $this->banco_sangre_portatiles_plasma,
            "banco_sangre_portatiles_plaquetas" => $this->banco_sangre_portatiles_plaquetas,
            "ventiladores_registrados_trauma_shock_adulto" => $this->ventiladores_registrados_trauma_shock_adulto,
            "ventiladores_registrados_trauma_shock_pediatrico" => $this->ventiladores_registrados_trauma_shock_pediatrico,
            "ventiladores_registrados_uci_adultos" => $this->ventiladores_registrados_uci_adultos,
            "ventiladores_registrados_uci_pedriatrica" => $this->ventiladores_registrados_uci_pedriatrica,
            "ventiladores_registrados_uci_neonatologia" => $this->ventiladores_registrados_uci_neonatologia,
            "ventiladores_registrados_sala_operaciones" => $this->ventiladores_registrados_sala_operaciones,
            "ventiladores_registrados_ucin_adulto" => $this->ventiladores_registrados_ucin_adulto,
            "ventiladores_registrados_ucin_pediatrico" => $this->ventiladores_registrados_ucin_pediatrico,
            "ventiladores_registrados_ucin_neonato" => $this->ventiladores_registrados_ucin_neonato,
            "ventiladores_registrados_uci_gineco_obstetricia" => $this->ventiladores_registrados_uci_gineco_obstetricia,
            "ventiladores_registrados_ucin_gineco_obstetricia" => $this->ventiladores_registrados_ucin_gineco_obstetricia,
            "ventiladores_operativos_trauma_shock_adulto" => $this->ventiladores_operativos_trauma_shock_adulto,
            "ventiladores_operativos_trauma_shock_pediatrico" => $this->ventiladores_operativos_trauma_shock_pediatrico,
            "ventiladores_operativos_uci_adultos" => $this->ventiladores_operativos_uci_adultos,
            "ventiladores_operativos_uci_pedriatrica" => $this->ventiladores_operativos_uci_pedriatrica,
            "ventiladores_operativos_uci_neonatologia" => $this->ventiladores_operativos_uci_neonatologia,
            "ventiladores_operativos_sala_operaciones" => $this->ventiladores_operativos_sala_operaciones,
            "ventiladores_operativos_ucin_adulto" => $this->ventiladores_operativos_ucin_adulto,
            "ventiladores_operativos_ucin_pediatrico" => $this->ventiladores_operativos_ucin_pediatrico,
            "ventiladores_operativos_ucin_neonato" => $this->ventiladores_operativos_ucin_neonato,
            "ventiladores_operativos_uci_gineco_obstetricia" => $this->ventiladores_operativos_uci_gineco_obstetricia,
            "ventiladores_operativos_ucin_gineco_obstetricia" => $this->ventiladores_operativos_ucin_gineco_obstetricia,
            "ventiladores_disponibles_trauma_shock_adulto" => $this->ventiladores_disponibles_trauma_shock_adulto,
            "ventiladores_disponibles_trauma_shock_pediatrico" => $this->ventiladores_disponibles_trauma_shock_pediatrico,
            "ventiladores_disponibles_uci_adultos" => $this->ventiladores_disponibles_uci_adultos,
            "ventiladores_disponibles_uci_pedriatrica" => $this->ventiladores_disponibles_uci_pedriatrica,
            "ventiladores_disponibles_uci_neonatologia" => $this->ventiladores_disponibles_uci_neonatologia,
            "ventiladores_disponibles_sala_operaciones" => $this->ventiladores_disponibles_sala_operaciones,
            "ventiladores_disponibles_ucin_adulto" => $this->ventiladores_disponibles_ucin_adulto,
            "ventiladores_disponibles_ucin_pediatrico" => $this->ventiladores_disponibles_ucin_pediatrico,
            "ventiladores_disponibles_ucin_neonato" => $this->ventiladores_disponibles_ucin_neonato,
            "ventiladores_disponibles_uci_gineco_obstetricia" => $this->ventiladores_disponibles_uci_gineco_obstetricia,
            "ventiladores_disponibles_ucin_gineco_obstetricia" => $this->ventiladores_disponibles_ucin_gineco_obstetricia,
            "ventiladores_alquilados_trauma_shock_adulto" => $this->ventiladores_alquilados_trauma_shock_adulto,
            "ventiladores_alquilados_trauma_shock_pediatrico" => $this->ventiladores_alquilados_trauma_shock_pediatrico,
            "ventiladores_alquilados_uci_adultos" => $this->ventiladores_alquilados_uci_adultos,
            "ventiladores_alquilados_uci_pedriatrica" => $this->ventiladores_alquilados_uci_pedriatrica,
            "ventiladores_alquilados_uci_neonatologia" => $this->ventiladores_alquilados_uci_neonatologia,
            "ventiladores_alquilados_sala_operaciones" => $this->ventiladores_alquilados_sala_operaciones,
            "ventiladores_alquilados_ucin_adulto" => $this->ventiladores_alquilados_ucin_adulto,
            "ventiladores_alquilados_ucin_pediatrico" => $this->ventiladores_alquilados_ucin_pediatrico,
            "ventiladores_alquilados_ucin_neonato" => $this->ventiladores_alquilados_ucin_neonato,
            "ventiladores_alquilados_uci_gineco_obstetricia" => $this->ventiladores_alquilados_uci_gineco_obstetricia,
            "ventiladores_alquilados_ucin_gineco_obstetricia" => $this->ventiladores_alquilados_ucin_gineco_obstetricia,
            "ventiladores_brecha_trauma_shock_adulto" => $this->ventiladores_brecha_trauma_shock_adulto,
            "ventiladores_brecha_trauma_shock_pediatrico" => $this->ventiladores_brecha_trauma_shock_pediatrico,
            "ventiladores_brecha_uci_adultos" => $this->ventiladores_brecha_uci_adultos,
            "ventiladores_brecha_uci_pedriatrica" => $this->ventiladores_brecha_uci_pedriatrica,
            "ventiladores_brecha_uci_neonatologia" => $this->ventiladores_brecha_uci_neonatologia,
            "ventiladores_brecha_sala_operaciones" => $this->ventiladores_brecha_sala_operaciones,
            "ventiladores_brecha_ucin_adulto" => $this->ventiladores_brecha_ucin_adulto,
            "ventiladores_brecha_ucin_pediatrico" => $this->ventiladores_brecha_ucin_pediatrico,
            "ventiladores_brecha_ucin_neonato" => $this->ventiladores_brecha_ucin_neonato,
            "ventiladores_brecha_uci_gineco_obstetricia" => $this->ventiladores_brecha_uci_gineco_obstetricia,
            "ventiladores_brecha_ucin_gineco_obstetricia" => $this->ventiladores_brecha_ucin_gineco_obstetricia,
            "ventiladores_portatiles_trauma_shock_adulto" => $this->ventiladores_portatiles_trauma_shock_adulto,
            "ventiladores_portatiles_trauma_shock_pediatrico" => $this->ventiladores_portatiles_trauma_shock_pediatrico,
            "ventiladores_portatiles_uci_adultos" => $this->ventiladores_portatiles_uci_adultos,
            "ventiladores_portatiles_uci_pedriatrica" => $this->ventiladores_portatiles_uci_pedriatrica,
            "ventiladores_portatiles_uci_neonatologia" => $this->ventiladores_portatiles_uci_neonatologia,
            "ventiladores_portatiles_sala_operaciones" => $this->ventiladores_portatiles_sala_operaciones,
            "ventiladores_portatiles_ucin_adulto" => $this->ventiladores_portatiles_ucin_adulto,
            "ventiladores_portatiles_ucin_pediatrico" => $this->ventiladores_portatiles_ucin_pediatrico,
            "ventiladores_portatiles_ucin_neonato" => $this->ventiladores_portatiles_ucin_neonato,
            "ventiladores_portatiles_uci_gineco_obstetricia" => $this->ventiladores_portatiles_uci_gineco_obstetricia,
            "ventiladores_portatiles_ucin_gineco_obstetricia" => $this->ventiladores_portatiles_ucin_gineco_obstetricia,
            "ambulancias_tipo_i_registradas" => $this->ambulancias_tipo_i_registradas,
            "ambulancias_tipo_i_operaivas" => $this->ambulancias_tipo_i_operaivas,
            "ambulancias_tipo_i_radio" => $this->ambulancias_tipo_i_radio,
            "ambulancias_tipo_ii_registradas" => $this->ambulancias_tipo_ii_registradas,
            "ambulancias_tipo_ii_operaivas" => $this->ambulancias_tipo_ii_operaivas,
            "ambulancias_tipo_ii_radio" => $this->ambulancias_tipo_ii_radio,
            "ambulancias_tipo_iii_registradas" => $this->ambulancias_tipo_iii_registradas,
            "ambulancias_tipo_iii_operaivas" => $this->ambulancias_tipo_iii_operaivas,
            "ambulancias_tipo_iii_radio" => $this->ambulancias_tipo_iii_radio,                        
            "Activo" => "1"
        );
        if ($this->db->insert('hospitales_situaciones_emergencia', $data))
            return $this->db->insert_id();
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
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("hospitales_situaciones_emergencia_id", $this->id);
        $error = array();
        if ($this->db->delete('hospitales_situaciones_emergencia'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function registrarOcurrencia() {
        $data = array(
            "hospitales_situaciones_emergencia_id" => $this->id,
            "hospitales_situaciones_emergencia_fecha" => $this->hospitales_situaciones_emergencia_fecha,
            "hospitales_situaciones_emergencia_ocurrencia" => $this->hospitales_situaciones_emergencia_ocurrencia,
            "estado" => '1'
        );
        if ($this->db->insert('hospitales_situaciones_emergencia_ocurrencias', $data)) {
            return true;
        } else {
            return false;
        }
    }
    public function eliminarOcurrencia()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("hospitales_situaciones_emergencia_ocurrencias_id", $this->id);
        $error = array();
        if ($this->db->delete('hospitales_situaciones_emergencia_ocurrencias'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function eliminarOcurrencias()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("hospitales_situaciones_emergencia_id", $this->id);
        $error = array();
        if ($this->db->delete('hospitales_situaciones_emergencia_ocurrencias'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
}