<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Ubigeo_model extends CI_Model
{
    private $Codigo_Departamento;
    private $Codigo_Provincia;
    private $Codigo_Distrito;
    public function setCodigo_Departamento($data)
    {
        $this->Codigo_Departamento = $this->db->escape_str($data);
    }
    public function setCodigo_Provincia($data)
    {
        $this->Codigo_Provincia = $this->db->escape_str($data);
    }
    public function setCodigo_Distrito($data)
    {
        $this->Codigo_Distrito = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerRegiones()
    {
        $this->db->select("Codigo_Region,UPPER(Nombre_Region) Nombre_Region");
        $this->db->from("region");
        $this->db->where("Activo =", "1");
        return $this->db->get();
    }
    public function departamentos()
    {
        $this->db->select("Codigo_Departamento,Codigo_Provincia,Codigo_Distrito,ubigeo,Nombre,Activo");
        $this->db->from("ubigeo");
        $this->db->where("Codigo_Departamento!=", "00");
        $this->db->where("Codigo_Provincia", "00");
        $this->db->where("Codigo_Distrito", "00");
        return $this->db->get();
    }
    public function provincias()
    {
        $this->db->select("Codigo_Departamento,Codigo_Provincia,Codigo_Distrito,ubigeo,Nombre,Activo");
        $this->db->from("ubigeo");
        $this->db->where("Codigo_Departamento", $this->Codigo_Departamento);
        $this->db->where("Codigo_Provincia!=", "00");
        $this->db->where("Codigo_Distrito", "00");
        return $this->db->get();
    }
    public function distritos()
    {
        $this->db->select("Codigo_Departamento,Codigo_Provincia,Codigo_Distrito,ubigeo,Nombre,Activo");
        $this->db->from("ubigeo");
        $this->db->where("Codigo_Departamento", $this->Codigo_Departamento);
        $this->db->where("Codigo_Provincia", $this->Codigo_Provincia);
        $this->db->where("Codigo_Distrito!=", "00");
        return $this->db->get();
    }
    public function ubigeo() {
        $this->db->select("fn_departamento(SUBSTRING(ubigeo,1,2)) departamento");
        $this->db->select("fn_provincia(SUBSTRING(ubigeo,1,2),SUBSTRING(ubigeo,3,2)) provincia");
        $this->db->select("Nombre distrito");
        $this->db->from("ubigeo");
        $this->db->where("Codigo_Departamento", $this->Codigo_Departamento);
        $this->db->where("Codigo_Provincia", $this->Codigo_Provincia);
        $this->db->where("Codigo_Distrito", $this->Codigo_Distrito);
        return $this->db->get();
    }
}