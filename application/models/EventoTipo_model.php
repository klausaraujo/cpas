<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoTipo_model extends CI_Model
{
    private $tipoEvento;
    public function setTipoEvento($data)
    {
        $this->tipoEvento = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Evento_Tipo_Codigo,Evento_Tipo_Nombre");
        $this->db->from("evento_tipo");
        
        return $this->db->get();
    }
    public function listaAsociado()
    {
        $this->db->select("evento_asociado_descripcion Nombre, evento_asociado_id Id");
        $this->db->from("evento_asociado");
        return $this->db->get();
    }
}