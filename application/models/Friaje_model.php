<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Friaje_model extends CI_Model
{
    private $id;
	private $anio;
	private $tipo_plan;
	private $descripcion;
	private $fecha_inicio;
	private $fecha_termino;
	private $Codigo_Indicador;
	private $archivo; 
    public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setAnio($data){ $this->anio = $this->db->escape_str($data); }
    public function setTipo_plan($data){ $this->tipo_plan = $this->db->escape_str($data); }
    public function setDescripcion($data){ $this->descripcion = $this->db->escape_str($data); }
    public function setCodigo_Indicador($data){ $this->Codigo_Indicador = $this->db->escape_str($data);}
    public function setFecha_inicio($data){ $this->fecha_inicio = $this->db->escape_str($data); }
    public function setFecha_termino($data){ $this->fecha_termino = $this->db->escape_str($data); }
    public function setArchivo($data){ $this->archivo = $this->db->escape_str($data); }
    public function listar(){
        $this->db->select("planes_registro_id id,planes_registro_anio_ejecucion anio_ejecucion,planes_registro_tipo,DATE_FORMAT(planes_fecha_inicio,'%d/%m/%Y') planes_fecha_inicio");
        $this->db->select("DATE_FORMAT(planes_fecha_fin,'%d/%m/%Y') planes_fecha_fin,planes_descripcion,planes_archivo,Activo");
        $this->db->from("planes_registro");
        $this->db->where("planes_registro_anio_ejecucion",$this->anio);
        return $this->db->get();
    }
    public function bancos() {
        $this->db->select("brigadistas_banco_id id,banco,Activo");
        $this->db->from("brigadistas_banco");
        $this->db->where("Activo","1");
        return $this->db->get();
    }
    public function existe(){
        
        $this->db->select("1");
        $this->db->from("brigadistas_registro");
        $this->db->where("documento_numero",$this->documento_numero);
        $rs =  $this->db->get();
        return $rs->num_rows();
    }
    public function foto(){
        $this->db->select("foto");
        $this->db->from("brigadistas_registro");
        $this->db->where("brigadista_id",$this->id);
        return $this->db->get();
    }
    public function registrar() {
        $data = array(
            "apellidos" => $this->apellidos,
            "nombres" => $this->nombres,
            "Tipo_Documento_Codigo" => $this->Tipo_Documento_Codigo,
            "documento_numero" => $this->documento_numero,
            "genero" => $this->genero,
            "fecha_nacimiento" => $this->fecha_nacimiento,
            "edad" => $this->edad,
            "estado_civil" => $this->estado_civil,
            "domicilio" => $this->domicilio,
            "ubigeo_domicilio" => $this->ubigeo_domicilio,
            "telefono_01" => $this->telefono_01,
            "telefono_02" => $this->telefono_02,
            "email" => $this->email,
            "contacto_emergencia" => $this->contacto_emergencia,
            "telefono_emergencia_01" => $this->telefono_emergencia_01,
            "telefono_emergencia_02" => $this->telefono_emergencia_02,
            "idioma_ingles" => $this->idioma_ingles,
            "idioma_quechua" => $this->idioma_quechua,
            "idioma_aimara" => $this->idioma_aimara,
            "idioma_otros" => $this->idioma_otros,
            "grupo_sanguineo" => $this->grupo_sanguineo,
            "alergias" => $this->alergias,
            "intervenciones_quirurgica" => $this->intervenciones_quirurgica,
            "antecedentes_medicos" => $this->antecedentes_medicos,
            "talla" => $this->talla,
            "peso" => $this->peso,
            "vacuna_tetano" => $this->vacuna_tetano,
            "vacuna_fiebre_amarilla" => $this->vacuna_fiebre_amarilla,
            "vacuna_hepatitis_b" => $this->vacuna_hepatitis_b,
            "vacuna_influenza" => $this->vacuna_influenza,
            "vacuna_sarampion" => $this->vacuna_sarampion,
            "vacuna_papiloma" => $this->vacuna_papiloma,
            "vacunas_otras" => $this->vacunas_otras,
            "usuario_registro" => $this->session->userdata("idusuario"),
            "fecha_registro" => date("Y-m-d H:i:s"),
            "talla_casaca" => $this->talla_casaca,
            "talla_calzado" => $this->talla_calzado,
            "talla_polo" => $this->talla_polo,
            "talla_pantalon" => $this->talla_pantalon,
            "Activo" => "1",
            "brigadistas_banco_id" => $this->brigadistas_banco_id,
            "numero_cuenta" => $this->numero_cuenta
        );
        if ($this->db->insert('brigadistas_registro', $data))
            return $this->db->insert_id();
        else
            return false;
    }
    public function editar() {
        $this->db->set("apellidos",$this->apellidos, TRUE);
        $this->db->set("nombres",$this->nombres, TRUE);
        $this->db->set("Tipo_Documento_Codigo",$this->Tipo_Documento_Codigo, TRUE);
        $this->db->set("documento_numero",$this->documento_numero, TRUE);
        $this->db->set("genero",$this->genero, TRUE);
        $this->db->set("fecha_nacimiento",$this->fecha_nacimiento, TRUE);
        $this->db->set("edad",$this->edad, TRUE);
        $this->db->set("estado_civil",$this->estado_civil, TRUE);
        $this->db->set("domicilio",$this->domicilio, TRUE);
        $this->db->set("ubigeo_domicilio",$this->ubigeo_domicilio, TRUE);
        $this->db->set("telefono_01",$this->telefono_01, TRUE);
        $this->db->set("telefono_02",$this->telefono_02, TRUE);
        $this->db->set("email",$this->email, TRUE);
        $this->db->set("contacto_emergencia",$this->contacto_emergencia, TRUE);
        $this->db->set("telefono_emergencia_01",$this->telefono_emergencia_01, TRUE);
        $this->db->set("telefono_emergencia_02",$this->telefono_emergencia_02, TRUE);
        $this->db->set("idioma_ingles",$this->idioma_ingles, TRUE);
        $this->db->set("idioma_quechua",$this->idioma_quechua, TRUE);
        $this->db->set("idioma_aimara",$this->idioma_aimara, TRUE);
        $this->db->set("idioma_otros",$this->idioma_otros, TRUE);
        $this->db->set("grupo_sanguineo",$this->grupo_sanguineo, TRUE);
        $this->db->set("alergias",$this->alergias, TRUE);
        $this->db->set("intervenciones_quirurgica",$this->intervenciones_quirurgica, TRUE);
        $this->db->set("antecedentes_medicos",$this->antecedentes_medicos, TRUE);
        $this->db->set("talla",$this->talla, TRUE);
        $this->db->set("peso",$this->peso, TRUE);
        $this->db->set("vacuna_tetano",$this->vacuna_tetano, TRUE);
        $this->db->set("vacuna_fiebre_amarilla",$this->vacuna_fiebre_amarilla, TRUE);
        $this->db->set("vacuna_hepatitis_b",$this->vacuna_hepatitis_b, TRUE);
        $this->db->set("vacuna_influenza",$this->vacuna_influenza, TRUE);
        $this->db->set("vacuna_sarampion",$this->vacuna_sarampion, TRUE);
        $this->db->set("vacuna_papiloma",$this->vacuna_papiloma, TRUE);
        $this->db->set("vacunas_otras",$this->vacunas_otras, TRUE);
        $this->db->set("usuario_actualizacion",$this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_actualizacion",date("Y-m-d H:i:s"), TRUE);
        $this->db->set("talla_casaca",$this->talla_casaca, TRUE);
        $this->db->set("talla_calzado",$this->talla_calzado, TRUE);
        $this->db->set("talla_polo",$this->talla_polo, TRUE);
        $this->db->set("talla_pantalon",$this->talla_pantalon, TRUE);   
        $this->db->set("brigadistas_banco_id",$this->brigadistas_banco_id, TRUE);
        $this->db->set("numero_cuenta",$this->numero_cuenta, TRUE);
        $this->db->where("brigadista_id", $this->id);
        if ($this->db->update('brigadistas_registro'))
            return true;
        else
            return false;
    }
    public function agregarFoto()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("foto", $this->foto, TRUE);
        $this->db->where("brigadista_id", $this->id);
        $error = array();
        if ($this->db->update('brigadistas_registro'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function listaProfesiones() {
        $this->db->select("brigadistas_profesiones_id,profesion");
        $this->db->from("brigadistas_profesiones");
        $this->db->where("Activo","1");
        return $this->db->get();
    }
    public function listaEspecialidades() {
        $this->db->select("brigadistas_especialidad_id,especialidad");
        $this->db->from("brigadistas_especialidad");
        $this->db->where("brigadistas_profesiones_id",$this->brigadistas_profesiones_id);
        $this->db->where("Activo","1");
        return $this->db->get();
    }
    public function profesionesBrigadista() {
        $this->db->select("de.brigadistas_detalle_especialidades_id,p.profesion,e.especialidad");
        $this->db->from("brigadistas_detalle_especialidades de");
        $this->db->join("brigadistas_especialidad e","e.brigadistas_especialidad_id = de.brigadistas_especialidad_id");
        $this->db->join("brigadistas_profesiones p","p.brigadistas_profesiones_id = e.brigadistas_profesiones_id");
        $this->db->where("brigadista_id", $this->id);
        return $this->db->get();
    }
    public function buscarEspecialidad() {
        $this->db->select("1");
        $this->db->from("brigadistas_detalle_especialidades");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("brigadistas_especialidad_id",$this->brigadistas_especialidad_id);
        return $this->db->get();
    }
    public function registrarEspecialidad() {
        $data = array(
            "brigadista_id" => $this->id,
            "brigadistas_especialidad_id" => $this->brigadistas_especialidad_id,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_detalle_especialidades', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarEspecialidad()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_detalle_especialidades_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_detalle_especialidades'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function archivoCertificacion(){
        $this->db->select("archivo");
        $this->db->from("brigadistas_certificacion");
        $this->db->where("brigadistas_certificacion_id", $this->id);
        return $this->db->get();
    }
    public function buscarCertificacion() {
        $this->db->select("1");
        $this->db->from("brigadistas_certificacion");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("tipo_certificacion",$this->tipo_certificacion);
        $this->db->where("fecha_reconocimiento",$this->fecha_reconocimiento);
        $this->db->where("resolucion",$this->resolucion);
        $this->db->where("fecha_inicio",$this->fecha_inicio);
        $this->db->where("fecha_vencimiento",$this->fecha_vencimiento);
        return $this->db->get();
    }
    public function listaCertificacion() {
        $this->db->select("brigadistas_certificacion_id as id,tipo_certificacion,DATE_FORMAT(fecha_reconocimiento,'%d/%m/%Y') fecha_reconocimiento");
        $this->db->select("resolucion,DATE_FORMAT(fecha_inicio,'%d/%m/%Y') fecha_inicio,DATE_FORMAT(fecha_vencimiento,'%d/%m/%Y') fecha_vencimiento,archivo");
        $this->db->from("brigadistas_certificacion");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function registrarCertificacion() {
        $data = array(
            "brigadista_id" => $this->id,
            "tipo_certificacion"=> $this->tipo_certificacion,
            "fecha_reconocimiento"=> $this->fecha_reconocimiento,
            "resolucion"=> $this->resolucion,
            "fecha_inicio"=> $this->fecha_inicio,
            "fecha_vencimiento"=> $this->fecha_vencimiento,
            "archivo" => $this->archivo,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_certificacion', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarCertificacion()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_certificacion_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_certificacion'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function listaCursos() {
        $this->db->select("brigadistas_cursos_id,nombre_curso");
        $this->db->from("brigadistas_cursos");
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function buscarCapacitacion() {
        $this->db->select("1");
        $this->db->from("brigadistas_capacitaciones");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("brigadistas_cursos_id",$this->brigadistas_cursos_id);
        $this->db->where("entidad",$this->entidad);
        $this->db->where("fecha_inicio",$this->fecha_inicio);
        $this->db->where("fecha_fin",$this->fecha_fin);
        return $this->db->get();
    }
    public function listaCapacitacion() {
        $this->db->select("ca.brigadistas_capacitaciones_id id,cu.nombre_curso curso_capacitacion,DATE_FORMAT(ca.fecha_inicio,'%d/%m/%Y') fecha_inicio");
        $this->db->select("DATE_FORMAT(ca.fecha_fin,'%d/%m/%Y') fecha_fin,ca.horas,ca.entidad");
        $this->db->from("brigadistas_capacitaciones ca");
        $this->db->join("brigadistas_cursos cu","ca.brigadistas_cursos_id=cu.brigadistas_cursos_id");
        $this->db->where("ca.brigadista_id",$this->id);
        $this->db->where("ca.Activo",'1');
        return $this->db->get();
    }
    public function registrarCapacitacion() {
        $data = array(
            "brigadista_id" => $this->id,
            "brigadistas_cursos_id"=> $this->brigadistas_cursos_id,
            "entidad"=> $this->entidad,
            "fecha_inicio"=> $this->fecha_inicio,
            "fecha_fin"=> $this->fecha_fin,
            "horas" => $this->horas,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_capacitaciones', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarCapacitacion()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_capacitaciones_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_capacitaciones'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function listaEmergencia() {
        $this->db->select("calificacion,lider,fuerza_tarea,brigadistas_emergencias_id id,acciones_realizadas");
        $this->db->from("brigadistas_emergencias");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function buscarEmergencia() {
        $this->db->select("1");
        $this->db->from("brigadistas_emergencias");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->where("calificacion",$this->calificacion);
        $this->db->where("lider",$this->lider);
        $this->db->where("fuerza_tarea",$this->fuerza_tarea);
        return $this->db->get();
    }
    public function registrarEmergencia() {
        $data = array(
            "brigadista_id" => $this->id,
            "Evento_Registro_Numero"=> $this->Evento_Registro_Numero,
            "calificacion"=> $this->calificacion,
            "lider"=> $this->lider,
            "fuerza_tarea"=> $this->fuerza_tarea,
            "acciones_realizadas" => $this->acciones_realizadas,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_emergencias', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarEmergencia()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_emergencias_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_emergencias'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function listaContingencias() {
        $this->db->select("calificacion,lider,fuerza_tarea,brigadistas_contingencias_id id");
        $this->db->from("brigadistas_contingencias");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function buscarContingencia() {
        $this->db->select("1");
        $this->db->from("brigadistas_contingencias");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->where("calificacion",$this->calificacion);
        $this->db->where("lider",$this->lider);
        $this->db->where("fuerza_tarea",$this->fuerza_tarea);
        return $this->db->get();
    }
    public function registrarContingencia() {
        $data = array(
            "brigadista_id" => $this->id,
            "Evento_Registro_Numero"=> $this->Evento_Registro_Numero,
            "calificacion"=> $this->calificacion,
            "lider"=> $this->lider,
            "fuerza_tarea"=> $this->fuerza_tarea,
            "acciones_realizadas" => $this->acciones_realizadas,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_contingencias', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarContingencia()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_contingencias_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_contingencias'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function gradoestudios() {
        $this->db->select("be.especialidad,bp.profesion");
        $this->db->from("brigadistas_profesiones bp");
        $this->db->join("brigadistas_especialidad be","be.brigadistas_profesiones_id=bp.brigadistas_profesiones_id");
        $this->db->join("brigadistas_detalle_especialidades bde","bde.brigadistas_especialidad_id=be.brigadistas_especialidad_id");
        $this->db->where("bde.brigadista_id",$this->id);
        return $this->db->get();
    }
    public function informacionlaboral() {
        $this->db->select("be.especialidad,bp.profesion");
        $this->db->from("brigadistas_profesiones bp");
        $this->db->join("brigadistas_especialidad be","be.brigadistas_profesiones_id=bp.brigadistas_profesiones_id");
        $this->db->join("brigadistas_detalle_especialidades bde","bde.brigadistas_especialidad_id=be.brigadistas_especialidad_id");
        $this->db->where("bde.brigadista_id",$this->id);
        return $this->db->get();
    }
    public function certificaciones() {
        $this->db->select("tipo_certificacion,resolucion,DATE_FORMAT(fecha_reconocimiento,'%d/%m/%Y') fecha_reconocimiento,DATE_FORMAT(fecha_inicio,'%d/%m/%Y') fecha_inicio,DATE_FORMAT(fecha_vencimiento,'%d/%m/%Y') fecha_vencimiento");
        $this->db->from("brigadistas_certificacion");        
        $this->db->where("brigadista_id",$this->id);
        return $this->db->get();
    }
    public function emergencias() {
        $this->db->select("be.calificacion,be.lider,be.fuerza_tarea,be.brigadistas_emergencias_id id,be.acciones_realizadas,er.Evento_Descripcion,DATE_FORMAT(er.Evento_Fecha_Registro,'%d/%m/%Y %H:%i') Evento_Fecha_Registro");
        $this->db->select("e.Evento_Nombre evento,ed.Evento_Detalle_Nombre eventoDetalle");
        $this->db->from("brigadistas_emergencias be");
        $this->db->join("evento_registro er","be.Evento_Registro_Numero=er.Evento_Registro_Numero");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("be.Activo",'1');
        return $this->db->get();
    }
    public function contingencias() {
        $this->db->select("be.calificacion,be.lider,be.fuerza_tarea,be.brigadistas_contingencias_id id,be.acciones_realizadas,er.Evento_Descripcion,DATE_FORMAT(er.Evento_Fecha_Registro,'%d/%m/%Y %H:%i') Evento_Fecha_Registro");
        $this->db->select("e.Evento_Nombre evento,ed.Evento_Detalle_Nombre eventoDetalle");
        $this->db->from("brigadistas_contingencias be");
        $this->db->join("evento_registro er","be.Evento_Registro_Numero=er.Evento_Registro_Numero");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("be.Activo",'1');
        return $this->db->get();
    }
}