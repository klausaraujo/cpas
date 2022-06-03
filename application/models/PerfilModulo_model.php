<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class PerfilModulo_model extends CI_Model
{
    private $Codigo_Perfil;
    private $idmodulorol;
    private $idmodulo;

    public function setCodigo_Perfil($data)
    {
        $this->Codigo_Perfil = $this->db->escape_str($data);
    }
    public function setIdmodulorol($data)
    {
        $this->idmodulorol = $this->db->escape_str($data);
    }
    public function setIdmodulo($data)
    {
        $this->idmodulo = $this->db->escape_str($data);
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
        $this->db->select("mr.*, mo.idmodulo idmodulo, mo.descripcion descripcion, pe.Descripcion_Perfil, pe.*");
        $this->db->from("modulo_rol mr");
        $this->db->join("modulo mo","mr.idmodulo = mo.idmodulo");
        $this->db->join("perfil pe","mr.Codigo_Perfil = pe.Codigo_Perfil");
        return $this->db->get();
    }    
    public function entidadesPorTipoAccion() {
        $this->db->select("COUNT(1) total");
        $this->db->from("tipo_accion_entidad");
        $this->db->where("Tipo_Accion_Codigo",$this->Tipo_Accion_Codigo);
        return $this->db->get();
    }
    public function obtenerCodigoMayor() {
        $this->db->select("MAX(CAST(idmodulorol AS UNSIGNED)) codigo");
        $this->db->from("modulo_rol");
        $this->db->where("idmodulo",$this->idmodulo);
        $rs = $this->db->get();
        return $rs->row()->codigo;
    }

    public function crear() {
        $data = array(
            "idmodulo" => $this->idmodulo,
            "Codigo_Perfil" => $this->Codigo_Perfil,
            "estado" => '1'
        );
        if($this->db->insert("modulo_rol", $data)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("idmodulo", $this->idmodulo, TRUE);
        //$this->db->where("Codigo_Perfil", $this->Codigo_Perfil);
        $this->db->where("idmodulorol", $this->idmodulorol);
        if ($this->db->update('modulo_rol')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        //$this->db->where("Tipo_Accion_Codigo", $this->Tipo_Accion_Codigo);
        $this->db->where("idmodulorol", $this->idmodulorol);
        if ($this->db->delete('modulo_rol')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    
}