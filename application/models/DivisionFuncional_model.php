<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class DivisionFuncional_model extends CI_Model
{
    private $anio;
    private $Codigo_Division_Funcional;
    private $Nombre_Division_Funcional;
    private $Activo;
    public function setAnio($data){$this->anio = $this->db->escape_str($data);}
    public function setCodigo_Division_Funcional($data){$this->Codigo_Division_Funcional = $this->db->escape_str($data);}
    public function setNombre_Division_Funcional($data){$this->Nombre_Division_Funcional = $this->db->escape_str($data);}
    public function setActivo($data){$this->Activo = $this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Division_Funcional,Nombre_Division_Funcional,Activo");
        $this->db->from("tablero_division_funcional");
        $this->db->where("Anio_Ejecucion", $this->anio);
        return $this->db->get();
    }
}