<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoFuente_model extends CI_Model
{
    private $Evento_Fuente_Codigo;
    private $Evento_Fuente_Descripcion;
    public function setEvento_Fuente_Codigo($data)
    {
        $this->Evento_Fuente_Codigo = $this->db->escape_str($data);
    }
    public function setEvento_Fuente_Descripcion($data)
    {
        $this->Evento_Fuente_Descripcion = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Evento_Fuente_Codigo,Evento_Fuente_Descripcion,Activo");
        $this->db->from("evento_fuente");
        $this->db->where("Activo = 1 ");
        
        return $this->db->get();
    }
    public function obtenerCodigoMayor() {
        $this->db->select("MAX(CAST(Evento_Fuente_Codigo AS UNSIGNED)) codigo");
        $this->db->from("evento_fuente");
        $rs = $this->db->get();
        return $rs->row()->codigo;
    }
    public function crear() {
        $data = array(
            "Evento_Fuente_Codigo" => $this->Evento_Fuente_Codigo,
            "Evento_Fuente_Descripcion" => $this->Evento_Fuente_Descripcion,
            "Activo" => "1"
        );
        if ($this->db->insert('evento_fuente', $data)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("Evento_Fuente_Descripcion", $this->Evento_Fuente_Descripcion, TRUE);
        $this->db->where("Evento_Fuente_Codigo", $this->Evento_Fuente_Codigo);
        if ($this->db->update('evento_fuente')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->set("Evento_Fuente_Descripcion", $this->Evento_Fuente_Descripcion, TRUE);
        $this->db->where("Evento_Fuente_Codigo", $this->Evento_Fuente_Codigo);
        if ($this->db->delete('evento_fuente')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function existePorTipoEventoYEvento() {
        $this->db->select("Evento_Tipo_Codigo");
        $this->db->from("evento_detalle");
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("Evento_Codigo", $this->evento);
        return $this->db->get();
    }       
}