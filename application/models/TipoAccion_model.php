<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class TipoAccion_model extends CI_Model
{
    private $Tipo_Accion_Codigo;
    private $Tipo_Accion_Descripcion;   
    public function setTipo_Accion_Codigo($data) {
        $this->Tipo_Accion_Codigo = $this->db->escape_str($data);
    }
    public function setTipo_Accion_Descripcion($data) {
        $this->Tipo_Accion_Descripcion = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function listar()
    {
        $this->db->select("Tipo_Accion_Codigo,Tipo_Accion_Descripcion,Activo");
        $this->db->from("tipo_accion");
        $this->db->where("Activo","1");        
        return $this->db->get();
    }   
    public function lista()
    {
        $this->db->select("Tipo_Accion_Codigo,Tipo_Accion_Descripcion,Activo");
        $this->db->from("tipo_accion");
        return $this->db->get();
    }
    public function obtenerCodigoMayor() {
        $this->db->select("MAX(CAST(Tipo_Accion_Codigo AS UNSIGNED)) codigo");
        $this->db->from("tipo_accion");
        $rs = $this->db->get();
        return $rs->row()->codigo;
    }   
    public function crear() {
        $data = array(
            "Tipo_Accion_Codigo" => $this->Tipo_Accion_Codigo,
            "Tipo_Accion_Descripcion" => $this->Tipo_Accion_Descripcion
        );
        if($this->db->insert("tipo_accion", $data)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("Tipo_Accion_Descripcion", $this->Tipo_Accion_Descripcion, TRUE);
        $this->db->where("Tipo_Accion_Codigo", $this->Tipo_Accion_Codigo);       
        if ($this->db->update('tipo_accion')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("Tipo_Accion_Codigo", $this->Tipo_Accion_Codigo);
        if ($this->db->delete('tipo_accion')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function listartipacciones() {
        $this->db->select("evento_avisos_tipo_accion_id codigoaccion,evento_avisos_tipo_accion_nombre nombre");
        $this->db->from("evento_avisos_tipo_accion");
        $this->db->where("estado","1");        
        return $this->db->get();
    }    
}