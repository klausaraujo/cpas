<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class ActividadProyecto_model extends CI_Model
{
    private $anio;
    private $Codigo_Actividad_Proyecto;
    private $Nombre_Actividad_Proyecto;
    private $Activo;
    public function setAnio($data){ $this->anio = $this->db->escape_str($data);}
    public function setCodigo_Actividad_Proyecto($data){ $this->Codigo_Actividad_Proyecto = $this->db->escape_str($data);}
    public function setNombre_Actividad_Proyecto($data){ $this->Nombre_Actividad_Proyecto = $this->db->escape_str($data);}
    public function setActivo($data){ $this->Activo = $this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Actividad_Proyecto,Nombre_Actividad_Proyecto,Activo");
        $this->db->from("tablero_actividad_proyecto");
        $this->db->where("Anio_Ejecucion", $this->anio);
        return $this->db->get();
    }
}