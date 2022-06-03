<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class TipoAccionEntidad_model extends CI_Model
{
    private $Tipo_Accion_Codigo;
    private $Tipo_Accion_Entidad_Codigo;
    private $Tipo_Accion_Entidad_Nombre;
    public function setTipo_Accion_Codigo($data)
    {
        $this->Tipo_Accion_Codigo = $this->db->escape_str($data);
    }
    public function setTipo_Accion_Entidad_Codigo($data)
    {
        $this->Tipo_Accion_Entidad_Codigo = $this->db->escape_str($data);
    }
    public function setTipo_Accion_Entidad_Nombre($data)
    {
        $this->Tipo_Accion_Entidad_Nombre = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function listar()
    {
        $this->db->select("Tipo_Accion_Codigo,Tipo_Accion_Entidad_Codigo,Tipo_Accion_Entidad_Nombre,Activo");
        $this->db->from("tipo_accion_entidad");
        $this->db->where("Tipo_Accion_Codigo", $this->Tipo_Accion_Codigo);
        return $this->db->get();
    }
     public function lista()
    {
        $this->db->select("tae.Tipo_Accion_Codigo,tae.Tipo_Accion_Entidad_Codigo,tae.Tipo_Accion_Entidad_Nombre,ta.Tipo_Accion_Descripcion,tae.Activo");
        $this->db->from("tipo_accion_entidad tae");
        $this->db->join("tipo_accion ta","tae.Tipo_Accion_Codigo = ta.Tipo_Accion_Codigo");
        return $this->db->get();
    }    
    public function entidadesPorTipoAccion() {
        $this->db->select("COUNT(1) total");
        $this->db->from("tipo_accion_entidad");
        $this->db->where("Tipo_Accion_Codigo",$this->Tipo_Accion_Codigo);
        return $this->db->get();
    }
    public function obtenerCodigoMayor() {
        $this->db->select("MAX(CAST(Tipo_Accion_Entidad_Codigo AS UNSIGNED)) codigo");
        $this->db->from("tipo_accion_entidad");
        $this->db->where("Tipo_Accion_Codigo",$this->Tipo_Accion_Codigo);
        $rs = $this->db->get();
        return $rs->row()->codigo;
    }
    public function crear() {
        $data = array(
            "Tipo_Accion_Codigo" => $this->Tipo_Accion_Codigo,
            "Tipo_Accion_Entidad_Codigo" => $this->Tipo_Accion_Entidad_Codigo,
            "Tipo_Accion_Entidad_Nombre" => $this->Tipo_Accion_Entidad_Nombre
        );
        if($this->db->insert("tipo_accion_entidad", $data)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("Tipo_Accion_Entidad_Nombre", $this->Tipo_Accion_Entidad_Nombre, TRUE);
        $this->db->where("Tipo_Accion_Codigo", $this->Tipo_Accion_Codigo);
        $this->db->where("Tipo_Accion_Entidad_Codigo", $this->Tipo_Accion_Entidad_Codigo);
        if ($this->db->update('tipo_accion_entidad')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("Tipo_Accion_Codigo", $this->Tipo_Accion_Codigo);
        $this->db->where("Tipo_Accion_Entidad_Codigo", $this->Tipo_Accion_Entidad_Codigo);
        if ($this->db->delete('tipo_accion_entidad')) {
            return 1;
        }
        else {
            return 0;
        }
    }
}