<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Tramite_model extends CI_Model
{
    private $id;
    public function setFuncioncomi($data){ $this->funcioncomi = $this->db->escape_str($data); }
    public function listarTramites(){
        $this->db->select("*");
        $this->db->from("listado_basico_documentos");
        return $this->db->get();
    }
    public function listarProcedencia(){
        $this->db->select("*");
        $this->db->from("documentos_procedencia");
        return $this->db->get();
    }
}