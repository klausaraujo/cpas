<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoDetalle_model extends CI_Model
{
    private $Evento_Detalle_Codigo;
    private $Evento_Detalle_Nombre;
    private $tipoEvento;
    private $evento;
    public function setEvento_Detalle_Codigo($data)
    {
        $this->Evento_Detalle_Codigo = $this->db->escape_str($data);
    }
    public function setEvento_Detalle_Nombre($data)
    {
        $this->Evento_Detalle_Nombre = $this->db->escape_str($data);
    }
    public function setTipoEvento($data)
    {
        $this->tipoEvento = $this->db->escape_str($data);
    }
    public function setEvento($data)
    {
        $this->evento = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Evento_Tipo_Codigo,Evento_Codigo,Evento_Detalle_Codigo,Evento_Detalle_Nombre,Activo");
        $this->db->from("evento_detalle");
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("Evento_Codigo", $this->evento);
        return $this->db->get();
    }
    public function listaEventosDetalle() {
        $this->db->select("ed.Evento_Tipo_Codigo,ed.Evento_Codigo,ed.Evento_Detalle_Codigo,ed.Evento_Detalle_Nombre,e.Evento_Nombre,et.Evento_Tipo_Nombre,ed.Activo");
        $this->db->from("evento_detalle ed");
        $this->db->join("evento e","e.Evento_Tipo_Codigo=ed.Evento_Tipo_Codigo and e.Evento_Codigo=ed.Evento_Codigo");
        $this->db->join("evento_tipo et","et.Evento_Tipo_Codigo=e.Evento_Tipo_Codigo");
        return $this->db->get();
    }
    public function obtenerCodigoMayor() {
        $this->db->select("MAX(CAST(Evento_Detalle_Codigo AS UNSIGNED)) codigo");
        $this->db->from("evento_detalle");
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("Evento_Codigo", $this->evento);
        $rs = $this->db->get();
        return $rs->row()->codigo;
    }
    public function crear() {
        $data = array(
            "Evento_Tipo_Codigo" => $this->tipoEvento,
            "Evento_Codigo" => $this->evento,
            "Evento_Detalle_Codigo" => $this->Evento_Detalle_Codigo,
            "Evento_Detalle_Nombre" => $this->Evento_Detalle_Nombre
        );
        if ($this->db->insert('evento_detalle', $data)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("Evento_Detalle_Nombre", $this->Evento_Detalle_Nombre, TRUE);
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("Evento_Codigo", $this->evento);
        $this->db->where("Evento_Detalle_Codigo", $this->Evento_Detalle_Codigo);
        if ($this->db->update('evento_detalle')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("Evento_Codigo", $this->evento);
        $this->db->where("Evento_Detalle_Codigo", $this->Evento_Detalle_Codigo);
        if ($this->db->delete('evento_detalle')) {
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