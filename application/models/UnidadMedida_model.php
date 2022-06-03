<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class UnidadMedida_model extends CI_Model
{
    private $id;
    private $Id_Actividad_POI;
    public function setId($data){$this->id = $this->db->escape_str($data);}
    public function setId_Actividad_POI($data){$this->Id_Actividad_POI = $this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Codigo_Unidad_Medida,Nombre_Unidad_Medida,Activo");
        $this->db->from("tablero_unidad_medida");
        return $this->db->get();
    }
    public function listaIdActividadPOI()
    {
        $this->db->select("um.Codigo_Unidad_Medida,um.Nombre_Unidad_Medida,um.Activo,ap.Codigo_Actividad_Proyecto,tacp.Nombre_Actividad_Proyecto,ap.Codigo_Actividad,ap.Codigo_Finalidad");
        $this->db->from("tablero_unidad_medida um");
        $this->db->join("tablero_actividad_poi ap","um.Codigo_Unidad_Medida=ap.Codigo_Unidad_Medida");
        $this->db->join("tablero_actividad_proyecto tacp","tacp.Codigo_Actividad_Proyecto=ap.Codigo_Actividad_Proyecto");
        $this->db->where("Id_Actividad_POI", $this->Id_Actividad_POI);
        return $this->db->get();
    }
    public function seleccionar()
    {
        $this->db->select("Codigo_Unidad_Medida,Nombre_Unidad_Medida,Activo");
        $this->db->from("tablero_unidad_medida");
        $this->db->where("Codigo_Unidad_Medida", $this->id);
        return $this->db->get();
    }
}