<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class TableroMes_model extends CI_Model
{
    private $id;
    private $nombre_mes;
    private $abreviatura_mes;
    private $activo;
    public function setId($data){$this->id = $this->db->escape_str($data);}
    public function setNombre_mes($data){$this->nombre_mes = $this->db->escape_str($data);}
    public function setAbreviatura_mes($data){$this->abreviatura_mes = $this->db->escape_str($data);}
    public function setActivo($data){$this->activo = $this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("codigo_mes id,nombre_mes,abreviatura_mes,activo");
        $this->db->from("tablero_mes");
        return $this->db->get();
    }
}