<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class SuperEventoDetalle_model extends CI_Model
{
    private $id;
    private $Super_Evento_Registro_ID;
    private $Evento_Registro_Numero;
    public function setId($data) {
        $this->id = $this->db->escape_str($data);
    }
    public function setSuper_Evento_Registro_ID($data) {
        $this->Super_Evento_Registro_ID = $this->db->escape_str($data);
    }
    public function setEvento_Registro_Numero($data) {
        $this->Evento_Registro_Numero = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function listar()
    {
        $this->db->select("Super_Evento_Registro_Titulo,Super_Evento_Registro_Fecha,Super_Evento_Registro_Nombre");
        $this->db->select("Super_Evento_Registro_Descripcion, Super_Evento_Registro_ID id");
        $this->db->from("Super_Evento_Registro_Detalle");
        $this->db->where("activo","1");
        return $this->db->get();
    }
    public function filtrosEventosById() {
        $this->db->select("Evento_Coordenadas,Evento_Secuencia,er.Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
        $this->db->select("DATE_FORMAT(Evento_Fecha_Registro,'%Y') ANIO,et.Evento_Tipo_Nombre tipoEvento, er.Evento_Descripcion");
        $this->db->select("Evento_Ubigeo_Descripcion ubigeo,Evento_Estado_Codigo");
        $this->db->from("evento_registro er");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
        $this->db->join("Super_Evento_Registro_Detalle sed", "sed.Evento_Registro_Numero=er.Evento_Registro_Numero");
        $this->db->join("Super_Evento_Registro se", "se.Super_Evento_Registro_ID=sed.Super_Evento_Registro_ID");
        $this->db->where_in("se.Super_Evento_Registro_ID", $this->Super_Evento_Registro_ID);
        return $this->db->get();
    }
    public function idEventoBySuperEventoId() {
        $this->db->select("Evento_Registro_Numero");
        $this->db->from("Super_Evento_Registro_Detalle");
        $this->db->where_in("Super_Evento_Registro_ID", $this->Super_Evento_Registro_ID);
        return $this->db->get();
    }
    public function registrar() {
        $data = array(
            "Super_Evento_Registro_ID" => $this->Super_Evento_Registro_ID,
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "estado" => "1"
        );
        if($this->db->insert("Super_Evento_Registro_Detalle", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("Super_Evento_Registro_ID", $this->Super_Evento_Registro_ID);
        if ($this->db->delete('Super_Evento_Registro_Detalle')) {
            return 1;
        }
        else {
            return 0;
        }
    }
}