<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Actividad_model extends CI_Model
{
    private $Anio_Ejecucion;
    private $Codigo_Actividad;
    private $Nombre_Actividad;
    private $Activo;
    public function setAnio_Ejecucion($data){$this->Anio_Ejecucion = $this->db->escape_str($data);}
    public function setCodigo_Actividad($data){$this->Codigo_Actividad = $this->db->escape_str($data);}
    public function setNombre_Actividad($data){$this->Nombre_Actividad = $this->db->escape_str($data);}
    public function setActivo($data){$this->Activo = $this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Actividad,Nombre_Actividad,Activo");
        $this->db->from("tablero_actividad");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        return $this->db->get();
    }
}