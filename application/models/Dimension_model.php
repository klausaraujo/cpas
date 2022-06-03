<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Dimension_model extends CI_Model
{
    private $id;
    private $Nombre_Dimension;
    private $Activo;
    public function setId($data){$this->id = $this->db->escape_str($data);}
    public function setNombre_Dimension($data){$this->Nombre_Dimension = $this->db->escape_str($data);}
    public function setActivo($data){$this->Activo = $this->db->escape_str($data);}
    public function listar(){
        $this->db->select("IdDimension id,Nombre_Dimension,Activo");
        $this->db->from("tablero_dimension");
        $this->db->where("Activo","1");
        return $this->db->get();   
    }
}