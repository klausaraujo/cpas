<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Emergencia_model extends CI_Model
{
    private $id;
    private $titulo;
    private $resolucion;
	private $descripcion;
	private $region_codigos;
	private $region_nombres;
	private $archivo;
	private $dgos;
	private $digerd;
	private $cdc;
	private $digesa;
	private $estado;
    public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setTitulo($data){ $this->titulo = $this->db->escape_str($data); }
    public function setResolucion($data){ $this->resolucion = $this->db->escape_str($data); }
    public function setDescripcion($data){ $this->descripcion = $this->db->escape_str($data); }
    public function setRegionCodigos($data){ $this->region_codigos = $this->db->escape_str($data);}
    public function setRegionNombres($data){ $this->region_nombres = $this->db->escape_str($data); }
    public function setDgos($data){ $this->dgos = $this->db->escape_str($data); }
    public function setDigerd($data){ $this->digerd = $this->db->escape_str($data); }
    public function setCdc($data){ $this->cdc = $this->db->escape_str($data); }
    public function setDigesa($data){ $this->digesa = $this->db->escape_str($data); }
    public function setArchivo($data){ $this->archivo = $this->db->escape_str($data); }
    public function setEstado($data){ $this->estado = $this->db->escape_str($data); }
    public function listar(){
        $this->db->select("emergencias_registro_id id,titulo, resolucion,descripcion,DATE_FORMAT(fecha_registro,'%d/%m/%Y') fecha_registro");
        $this->db->select("dgos,digerd,cdc,digesa,archivo,estado, region_nombres, descripcion");
        $this->db->from("emergencias_registro");
        return $this->db->get();
    }
    public function registrar() {
        $data = array(
            "titulo" => $this->titulo,
            "resolucion" => $this->resolucion,
            "descripcion" => $this->descripcion,
            "region_codigos" => $this->region_codigos,
            "region_nombres" => $this->region_nombres,
            "archivo" => $this->archivo,
            "dgos" => $this->dgos,
            "digerd" => $this->digerd,
            "cdc" => $this->cdc,
            "digesa" => $this->digesa,            
            "usuario_registro" => $this->session->userdata("idusuario"),
            "fecha_registro" => date("Y-m-d H:i:s")
        );
        if ($this->db->insert('emergencias_registro', $data))
            return $this->db->insert_id();
        else
            return 0;
    }
    public function actualizar() {
        $this->db->set("titulo", $this->titulo, TRUE);
        $this->db->set("resolucion", $this->resolucion, TRUE);
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("region_codigos", $this->region_codigos, TRUE);
        $this->db->set("region_nombres", $this->region_nombres, TRUE);
        $this->db->set("archivo", $this->archivo, TRUE);
        $this->db->set("dgos", $this->dgos, TRUE);
        $this->db->set("digerd", $this->digerd, TRUE);
        $this->db->set("cdc", $this->cdc, TRUE);
        $this->db->set("digesa", $this->digesa, TRUE);
        $this->db->set("usuario_actualizacion",$this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_actualizacion",date("Y-m-d H:i:s"), TRUE);
        $this->db->where("emergencias_registro_id", $this->id);
        if ($this->db->update('emergencias_registro'))
            return true;
        else
            return false;
    }
    public function cerrar() {
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->set("usuario_cierre",$this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_cierre",date("Y-m-d H:i:s"), TRUE);
        $this->db->where("emergencias_registro_id", $this->id);
        echo $this->id;
        if ($this->db->update('emergencias_registro'))
            return true;
        else
            return false;
    }
    public function agregarArchivo()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("archivo", $this->archivo, TRUE);
        $this->db->where("emergencias_registro_id", $this->id);
        $error = array();
        if ($this->db->update('emergencias_registro'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function archivo(){
        $this->db->select("archivo");
        $this->db->from("emergencias_registro");
        $this->db->where("emergencias_registro_id",$this->id);
        return $this->db->get();
    }
    public function listarPacientes() {
        $this->db->select("emergencias_registro_id id,titulo, resolucion,descripcion,DATE_FORMAT(fecha_registro,'%d/%m/%Y') fecha_registro");
        $this->db->select("dgos,digerd,cdc,digesa,archivo,estado");
        $this->db->from("emergencias_registro_atenciones");
        $this->db->where("emergencias_registro_atenciones_id",$this->id);
        return $this->db->get();
    }
}