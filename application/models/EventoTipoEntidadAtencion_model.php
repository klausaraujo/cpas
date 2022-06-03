<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoTipoEntidadAtencion_model extends CI_Model
{
   private $id;
    private $Evento_Tipo_Entidad_Atencion_Nombre;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setEvento_Tipo_Entidad_Atencion_Nombre($data)
    {
        $this->Evento_Tipo_Entidad_Atencion_Nombre = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Evento_Tipo_Entidad_Atencion_ID id,Evento_Tipo_Entidad_Atencion_Nombre");
        $this->db->from("evento_tipo_entidad_atencion");
        return $this->db->get();
    }
    public function paises() {
        $this->db->select("id, nombre name");
        $this->db->from("pais");
        return $this->db->get();
    }
    public function profesionales() {
        $this->db->select("evento_tipo_entidad_atencion_registro_profesionales_id id, nombre name");
        $this->db->from("evento_tipo_entidad_atencion_registro_profesionales");
        return $this->db->get();
    }
}