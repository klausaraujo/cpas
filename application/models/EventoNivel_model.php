<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoNivel_model extends CI_Model
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
        $this->db->select("Evento_Nivel_Codigo,Evento_Nivel_Nombre,Activo");
        $this->db->from("evento_nivel");
        return $this->db->get();
    }
}