<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Contingencia_model extends CI_Model
{
    private $id;
	private $anio;
	private $tipo_plan;
	private $descripcion;
	private $fecha_inicio;
	private $fecha_termino;
	private $Codigo_Indicador;
    private $archivo; 
    private $contingencias_registro_id;
    private $titulo;
    private $resolplan;
    private $resolucion_file;
    private $fecha_publicacion;
    private $presupuesto;
    private $plan_file;
    private $contingencias_peligros_id_natural;
    private $contingencias_peligros_id_antropico;
    private $vigencia_inicio;
    private $vigencia_fin;
    private $calificacion;
    private $estado;
    private $condicion;  
    private $codigo_region; 
    private $codigo_disa; 
    private $codigo_red; 
    private $idevento; 
    private $codigo_institucion; 
    private $codigo_micro_red;
    private $codigo_renipress; 
    private $contingencias_peligros_detalle_id_natural;
    private $contingencias_peligros_detalle_items_id_natural;
    private $contingencias_peligros_detalle_id_antropico;
    private $contingencias_peligros_detalle_items_id_antropico;
    public function setCodigo_region($data){ $this->codigo_region = $this->db->escape_str($data); }
    public function setCodigo_disa($data){ $this->codigo_disa = $this->db->escape_str($data); }
    public function setCodigo_red($data){ $this->codigo_red = $this->db->escape_str($data); }
    public function setIdevento($data){ $this->idevento = $this->db->escape_str($data); }
    public function setCodigo_institucion($data){ $this->codigo_institucion = $this->db->escape_str($data); }
    public function setCodigo_micro_red($data){ $this->codigo_micro_red = $this->db->escape_str($data); }
    public function setCodigo_renipress($data){ $this->codigo_renipress = $this->db->escape_str($data); }
    public function setContingencias_peligros_detalle_id_natural($data){ $this->contingencias_peligros_detalle_id_natural = $this->db->escape_str($data); }
    public function setContingencias_peligros_detalle_items_id_natural($data){ $this->contingencias_peligros_detalle_items_id_natural = $this->db->escape_str($data); }
    public function setContingencias_peligros_detalle_id_antropico($data){ $this->contingencias_peligros_detalle_id_antropico = $this->db->escape_str($data); }
    public function setContingencias_peligros_detalle_items_id_antropico($data){ $this->contingencias_peligros_detalle_items_id_antropico = $this->db->escape_str($data); }
    public function setContingencias_registro_id($data){ $this->contingencias_registro_id = $this->db->escape_str($data); }
    public function setTitulo($data){ $this->titulo = $this->db->escape_str($data); }
    public function setResolPlan($data){ $this->resolplan = $this->db->escape_str($data); }
    public function setResolucion_file($data){ $this->resolucion_file = $this->db->escape_str($data); }
    public function setFecha_publicacion($data){ $this->fecha_publicacion = $this->db->escape_str($data); }
    public function setPresupuesto($data){ $this->presupuesto = $this->db->escape_str($data); }
    public function setPlan_file($data){ $this->plan_file = $this->db->escape_str($data); }
    public function setContingencias_peligros_id_natural($data){ $this->contingencias_peligros_id_natural = $this->db->escape_str($data); }
    public function setContingencias_peligros_id_antropico($data){ $this->contingencias_peligros_id_antropico = $this->db->escape_str($data); }
    public function setVigencia_inicio($data){ $this->vigencia_inicio = $this->db->escape_str($data); }
    public function setVigencia_fin($data){ $this->vigencia_fin = $this->db->escape_str($data); }
    public function setCalificacion($data){ $this->calificacion = $this->db->escape_str($data); }
    public function setEstado($data){ $this->estado = $this->db->escape_str($data); }
    public function setCondicion($data){ $this->condicion = $this->db->escape_str($data); }
    public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setAnio($data){ $this->anio = $this->db->escape_str($data); }
    public function setTipo_plan($data){ $this->tipo_plan = $this->db->escape_str($data); }
    public function setDescripcion($data){ $this->descripcion = $this->db->escape_str($data); }
    public function setCodigo_Indicador($data){ $this->Codigo_Indicador = $this->db->escape_str($data);}
    public function setFecha_inicio($data){ $this->fecha_inicio = $this->db->escape_str($data); }
    public function setFecha_termino($data){ $this->fecha_termino = $this->db->escape_str($data); }
    public function setArchivo($data){ $this->archivo = $this->db->escape_str($data); }
    public function setContingencias_estructura_cuestionario_id($data){ $this->contingencias_estructura_cuestionario_id = $this->db->escape_str($data); }
    public function setContingencias_registro_evaluacion_respuesta($data){ $this->contingencias_registro_evaluacion_respuesta = $this->db->escape_str($data); }
    public function setContingencias_registro_evaluacion_comentarios($data){ $this->contingencias_registro_evaluacion_comentarios = $this->db->escape_str($data); }
    public function listarPlanesContingencia(){
        $this->db->select("cr.contingencias_registro_id id, cr.titulo, cr.resolucion_numero resolplan, cr.presupuesto, cr.plan_file, if(contingencias_peligros_id_natural=0,'Antrópico', 'Natural') origen, DATE_FORMAT(cr.vigencia_inicio,'%d/%m/%Y') vigencia_inicio, DATE_FORMAT(cr.vigencia_fin,'%d/%m/%Y') vigencia_fin, ri.nombre_institucion institucion, re.Nombre_Region region, IF(cr.estado=1, 'Activo', 'Inactivo') estado, cr.resolucion_file, cr.calificacion, if(contingencias_peligros_id_natural=0,'2', '1') origen1");
        $this->db->select("cr.contingencias_peligros_id_natural, cr.contingencias_peligros_id_antropico, cr.contingencias_peligros_detalle_id_natural, cr.contingencias_peligros_detalle_items_id_natural, cr.contingencias_peligros_detalle_id_antropico, cr.contingencias_peligros_detalle_items_id_antropico, DATE_FORMAT(cr.fecha_publicacion,'%d/%m/%Y') fecha_publicacion");
        $this->db->select("cr.idevento, cr.codigo_institucion, cr.codigo_region, cr.codigo_disa, codigo_red, cr.codigo_micro_red, cr.codigo_renipress");
        $this->db->from("contingencias_registro cr, region re, renipress_institucion ri");
        $this->db->where("cr.codigo_region = re.Codigo_Region");
        $this->db->where("cr.codigo_institucion = ri.codigo_institucion");
        return $this->db->get();
    }
    public function listarContingenciaReporte(){
        $this->db->select("cr.contingencias_registro_id id, cr.titulo, cr.resolucion_numero resolplan, cr.presupuesto, cr.plan_file plan_file, if(contingencias_peligros_id_natural=0,'Antrópico', 'Natural') origen, DATE_FORMAT(cr.vigencia_inicio,'%d/%m/%Y') vigencia_inicio, DATE_FORMAT(cr.vigencia_fin,'%d/%m/%Y') vigencia_fin, ri.nombre_institucion institucion, re.Nombre_Region region, IF(cr.estado=1, 'Activo', 'Inactivo') estado, cr.resolucion_file resolucion_file, cr.calificacion, if(contingencias_peligros_id_natural=0,'2', '1') origen1");
        $this->db->select("cr.contingencias_peligros_id_natural, cr.contingencias_peligros_id_antropico, cr.contingencias_peligros_detalle_id_natural, cr.contingencias_peligros_detalle_items_id_natural, cr.contingencias_peligros_detalle_id_antropico, cr.contingencias_peligros_detalle_items_id_antropico, DATE_FORMAT(cr.fecha_publicacion,'%d/%m/%Y') fecha_publicacion");
        $this->db->select("cr.idevento, cr.codigo_institucion, cr.codigo_region, cr.codigo_disa, codigo_red, cr.codigo_micro_red, cr.codigo_renipress");
        $this->db->from("contingencias_registro cr, region re, renipress_institucion ri");
        $this->db->where("cr.codigo_region = re.Codigo_Region");
        $this->db->where("cr.codigo_institucion = ri.codigo_institucion");
        if ($this->codigo_institucion != "0") {
            $this->db->where("cr.codigo_institucion", $this->codigo_institucion);
        }
        if ($this->codigo_region != "0") {
            $this->db->where("cr.codigo_region", $this->codigo_region);
        }
        if ($this->codigo_disa != "0") {
            $this->db->where("cr.codigo_disa", $this->codigo_disa);
        }
        if ($this->codigo_red != "0") {
            $this->db->where("cr.codigo_red", $this->codigo_red);
        }
        if ($this->codigo_micro_red != "0") {
            $this->db->where("cr.codigo_micro_red", $this->codigo_micro_red);
        }
        if ($this->codigo_renipress != "0") {
            $this->db->where("cr.codigo_renipress", $this->codigo_renipress);
        }
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
            "titulo" => $this->titulo,
            "resolucion_numero" => $this->resolplan,
            "resolucion_file" => $this->resolucion_file,
            "fecha_publicacion" => $this->fecha_publicacion,
            "presupuesto" => $this->presupuesto,
            "plan_file" => $this->plan_file,
            "contingencias_peligros_id_natural" => $this->contingencias_peligros_id_natural,
            "contingencias_peligros_detalle_id_natural" => $this->contingencias_peligros_detalle_id_natural,
            "contingencias_peligros_detalle_items_id_natural" => $this->contingencias_peligros_detalle_items_id_natural,
            "contingencias_peligros_id_antropico" => $this->contingencias_peligros_id_antropico,
            "contingencias_peligros_detalle_id_antropico" => $this->contingencias_peligros_detalle_id_antropico,
            "contingencias_peligros_detalle_items_id_antropico" => $this->contingencias_peligros_detalle_items_id_antropico,
            "idevento" => $this->idevento,
            "codigo_institucion" => $this->codigo_institucion,
            "codigo_region" => $this->codigo_region,
            "codigo_disa" => $this->codigo_disa,
            "codigo_red" => $this->codigo_red,
            "codigo_micro_red" => $this->codigo_micro_red,
            "codigo_renipress" => $this->codigo_renipress,
            "calificacion" => $this->calificacion
        );
        if ($this->db->insert('contingencias_registro', $data))
            return $this->db->insert_id();
        else
            return false;
    }
    public function actualizar() {
        $this->db->set("titulo",$this->titulo, TRUE);
        $this->db->set("resolucion_numero",$this->resolplan, TRUE);
        $this->db->set("fecha_publicacion",$this->fecha_publicacion, TRUE);
        $this->db->set("presupuesto",$this->presupuesto, TRUE);
        $this->db->set("contingencias_peligros_id_natural",$this->contingencias_peligros_id_natural, TRUE);
        $this->db->set("contingencias_peligros_detalle_id_natural",$this->contingencias_peligros_detalle_id_natural, TRUE);
        $this->db->set("contingencias_peligros_detalle_items_id_natural",$this->contingencias_peligros_detalle_items_id_natural, TRUE);
        $this->db->set("contingencias_peligros_id_antropico",$this->contingencias_peligros_id_antropico, TRUE);
        $this->db->set("contingencias_peligros_detalle_id_antropico",$this->contingencias_peligros_detalle_id_antropico, TRUE);
        $this->db->set("contingencias_peligros_detalle_items_id_antropico",$this->contingencias_peligros_detalle_items_id_antropico, TRUE);
        $this->db->set("idevento",$this->idevento, TRUE);
        $this->db->set("codigo_institucion",$this->codigo_institucion, TRUE);
        $this->db->set("codigo_region",$this->codigo_region, TRUE);
        $this->db->set("codigo_disa",$this->codigo_disa, TRUE);
        $this->db->set("codigo_red",$this->codigo_red, TRUE);
        $this->db->set("codigo_micro_red",$this->codigo_micro_red, TRUE);
        $this->db->set("codigo_renipress",$this->codigo_renipress, TRUE);
        $this->db->set("calificacion",$this->calificacion, TRUE);
        $this->db->where("contingencias_registro_id", $this->id);
        if ($this->db->update('contingencias_registro'))
            return true;
        else
            return false;
    }
    public function registrarcuestionario() {
            $data = array(
                "contingencias_registro_id" => $this->contingencias_registro_id,
                "contingencias_estructura_cuestionario_id" => $this->contingencias_estructura_cuestionario_id,
                "contingencias_registro_evaluacion_respuesta" => $this->contingencias_registro_evaluacion_respuesta,
                "contingencias_registro_evaluacion_comentarios" => $this->contingencias_registro_evaluacion_comentarios,
                "estado" => "1"
            );
            if ($this->db->insert('contingencias_registro_evaluacion', $data))
                return $this->db->insert_id();
            else
                return false;
    }
    public function actualizarnota() {
        $this->db->set("calificacion",$this->calificacion, TRUE);
        $this->db->where("contingencias_registro_id", $this->contingencias_registro_id);
        if ($this->db->update('contingencias_registro'))
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
    public function informecabecera2() {
        $this->db->select("c.contingencias_registro_id as 'ID'");
        $this->db->select("c.titulo as 'titulo'");
        $this->db->select("IFNULL(c.resolucion_numero,'[No Aplica]') as 'resolplan'");
        $this->db->select("DATE_FORMAT(c.fecha_publicacion,'%d/%m/%Y') as 'fecha_publicacion'");
        $this->db->select("Format(c.presupuesto,2) as 'presupuesto'");
        $this->db->select("if(c.contingencias_peligros_id_natural=0,'Antrópico', 'Natural') as 'origen'");
        $this->db->select("IFNULL(e.descripcion,'[No Aplica]') as 'descripcion'");
        $this->db->select("IFNULL(institucion.nombre_institucion,'[No Aplica]') as 'institucion'");
        $this->db->select("IFNULL(region.Nombre_Region,'[No Aplica]') as 'region'");
        $this->db->select("IFNULL(disa.nombre_disa,'[No Aplica]') as 'disa'");
        $this->db->select("IFNULL(red.nombre_red,'[No Aplica]') as 'red'");
        $this->db->select("IFNULL(micro_red.nombre_micro_red,'[No Aplica]') as 'microred'");
        $this->db->select("IFNULL(ipress.nombre,'[No Aplica]') as 'ipress'");
        $this->db->select("c.calificacion");
        $this->db->select("CASE
                                WHEN c.calificacion BETWEEN 0 and 0 Then 'No Evaluado'
                                WHEN c.calificacion BETWEEN 1 and 50 THEN 'En Proceso'
                                WHEN c.calificacion BETWEEN 51 and 75 then 'Regular'
                                WHEN c.calificacion BETWEEN 75 and 100 then 'Bueno'
                            END As 'condicion'");
        $this->db->from("contingencias_registro as c");
        $this->db->join("contingencias_registro_eventos as e","e.idevento = c.idevento","left");
        $this->db->join("renipress_institucion as institucion","institucion.id_institucion=c.codigo_institucion","left");
        $this->db->join("renipress_disa disa","disa.codigo_region = c.codigo_region and disa.codigo_disa = c.codigo_disa","left");
        $this->db->join("renipress_red red","red.codigo_disa = c.codigo_disa and red.codigo_red= c.codigo_red","left");
        $this->db->join("renipress_micro_red micro_red","micro_red.codigo_disa = c.codigo_disa and micro_red.codigo_red=c.codigo_red and micro_red.codigo_micro_red=c.codigo_micro_red","left");
        $this->db->join("renipress as ipress","ipress.codigo_renipress = c.codigo_renipress","left");
        $this->db->join("region","region.Codigo_Region = c.codigo_region","left");
        $this->db->where("c.contingencias_registro_id",$this->id);
        $this->db->limit(1);
        return $this->db->get();
    }
    public function informecabecera() {
        $this->db->select("cr.contingencias_registro_id id,cr.titulo titulo, cr.resolucion_numero resolplan,DATE_FORMAT(cr.fecha_publicacion,'%d/%m/%Y') fecha_publicacion,cr.presupuesto,if(contingencias_peligros_id_natural=0,'Antrópico', 'Natural') origen,DATE_FORMAT(cr.vigencia_inicio,'%d/%m/%Y') vigencia_inicio, DATE_FORMAT(cr.vigencia_fin,'%d/%m/%Y') vigencia_fin,cr.idevento, cre.descripcion, ri.nombre_institucion institucion,re.Nombre_Region region,rd.nombre_disa disa,rr.nombre_red red,mr.nombre_micro_red microred,rp.nombre ipress,cr.calificacion");
        $this->db->from("contingencias_registro cr, region re, renipress_institucion ri, renipress_disa rd, renipress_red rr, renipress_micro_red mr, renipress rp, contingencias_registro_eventos cre");
        $this->db->where("cr.codigo_region = re.Codigo_Region");  
        $this->db->where("cr.codigo_institucion = ri.codigo_institucion");
		$this->db->where("cr.codigo_disa = rd.codigo_disa");        
        $this->db->where("cr.codigo_disa = rr.codigo_disa");
		$this->db->where("rd.codigo_disa = rr.codigo_disa");
        $this->db->where("cr.codigo_red = rr.codigo_red");        
        $this->db->where("rr.codigo_red = mr.codigo_red");
		$this->db->where("cr.codigo_micro_red = mr.codigo_micro_red");
		$this->db->where("rd.codigo_disa = mr.codigo_disa");
		$this->db->where("rr.codigo_red = rp.codigo_red");
		$this->db->where("mr.codigo_micro_red = rp.codigo_micro_red");
		$this->db->where("rd.codigo_disa = rp.codigo_disa");
        $this->db->where("cr.codigo_renipress = rp.codigo_renipress");
        $this->db->where("cr.idevento = cre.idevento");
        $this->db->where("cr.contingencias_registro_id",$this->id);
        $this->db->limit(1);
        return $this->db->get();
    }
    public function informecuestionario() {
        $this->db->select("cec.contingencias_estructura_cuestionario_id as Item, cec.contingencias_estructura_cuestionario_descripcion as Pregunta,IF(cre.contingencias_registro_evaluacion_respuesta=0,'NO','SI') as Respuesta, IF(cre.contingencias_registro_evaluacion_respuesta=0,0,contingencias_estructura_cuestionario_valoracion) as Puntaje,cre.contingencias_registro_evaluacion_comentarios as Comentarios");		
        $this->db->from("contingencias_registro_evaluacion cre, contingencias_estructura_cuestionario cec");        
		$this->db->where("cre.contingencias_estructura_cuestionario_id = cec.contingencias_estructura_cuestionario_id");
		$this->db->where("cre.contingencias_registro_id",$this->id);
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
    public function archivoResolucion(){
        $this->db->select("resolucion_file");
        $this->db->from("contingencias_registro");        
        $this->db->where("contingencias_registro_id", $this->id);
        return $this->db->get();
    }
    public function archivoPlan(){
        $this->db->select("plan_file");
        $this->db->from("contingencias_registro");        
        $this->db->where("contingencias_registro_id", $this->id);
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
    public function actualizarArchivoP(){
        $this->db->db_debug = FALSE;
        $this->db->set("plan_file" , $this->Archivo, TRUE);        
        $this->db->where("contingencias_registro_id", $this->id);
        $error = array();
        if ($this->db->update('contingencias_registro'))
            return 1;
            else {
                return 0;
            }

    }
    public function actualizarArchivoR(){
        $this->db->db_debug = FALSE;
        $this->db->set("resolucion_file" , $this->Archivo, TRUE);        
        $this->db->where("contingencias_registro_id", $this->id);
        $error = array();
        if ($this->db->update('contingencias_registro'))
            return 1;
            else {
                return 0;
            }
    }
    public function listarCuestionario() {
        $this->db->select("contingencias_estructura_cuestionario_id, contingencias_estructura_cuestionario_descripcion, contingencias_estructura_cuestionario_valoracion");
        $this->db->from("contingencias_estructura_cuestionario");
        $this->db->where("estado",'1');       
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
    public function listarTipevento() {
        $this->db->select("idevento, descripcion");
        $this->db->from("contingencias_registro_eventos");
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function listarInstitucion() {
        $this->db->select("codigo_institucion, nombre_institucion");
        $this->db->from("renipress_institucion");
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function listarRegion() {
        $this->db->select("codigo_region,nombre_region");
        $this->db->from("region");
        $this->db->where("Activo","1");
        return $this->db->get();
    }
    public function listarDISA() {
        $this->db->select("codigo_disa,nombre_disa");
        $this->db->from("renipress_disa");
        $this->db->where("codigo_region",$this->codigo_region);
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function listarRed() {
        $this->db->select("codigo_red,nombre_red");
        $this->db->from("renipress_red");
        $this->db->where("codigo_disa",$this->codigo_disa);
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function listarMicroRed() {
        $this->db->select("codigo_micro_red,nombre_micro_red");
        $this->db->from("renipress_micro_red");
        $this->db->where("codigo_red",$this->codigo_red);
        $this->db->where("codigo_disa",$this->codigo_disa);
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function listarIPRESS() {
        $this->db->select("codigo_renipress,nombre");
        $this->db->from("renipress");
        $this->db->where("codigo_institucion",$this->codigo_institucion);
        $this->db->where("codigo_region",$this->codigo_region);
        $this->db->where("codigo_disa",$this->codigo_disa);
        $this->db->where("codigo_red",$this->codigo_red);
        $this->db->where("codigo_micro_red",$this->codigo_micro_red);
        $this->db->where("estado","ACTIVADO");
        return $this->db->get();
    }
    public function listarPeligros() {
        $this->db->select("contingencias_peligros_detalle_id,contingencias_peligros_detalle_nombre");
        $this->db->from("contingencias_peligros_detalle");
        $this->db->where("contingencias_peligros_id",$this->contingencias_peligros_id_natural);
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function listarPeligrosItems() {
        $this->db->select("contingencias_peligros_detalle_items_id,contingencias_peligros_detalle_items_nombre");
        $this->db->from("contingencias_peligros_detalle_items");
        $this->db->where("contingencias_peligros_detalle_id",$this->contingencias_peligros_detalle_items_id_natural);
        $this->db->where("estado","1");
        return $this->db->get();
     }
}