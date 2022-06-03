<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EntidadSalud_model extends CI_Model
{
    private $Codigo_Ubigeo;
    private $idRenipress;
    public function setCodigo_Ubigeo($data)
    {
        $this->Codigo_Ubigeo = $this->db->escape_str($data);
    }
    public function setIdRenipress($data)
    {
        $this->idRenipress = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("CodEESS, CodInstitucion, Nombre, Clasificacion, Tipo, CodUbigeo, Direccion, CodDISA, CodRED, CodMICRORED, CodUE, CodCategoria, Telefono, TipoDocCat, NroDocCat, Horario, InicioActividad, Responsable, Estado, Situacion, Condicion, Inspeccion, Norte, Este, Cota");
        $this->db->from("md_eess");
        $this->db->where("CodUbigeo", $this->Codigo_Ubigeo);
        return $this->db->get();
    }
    public function obtenerRenipress()
    {
        $this->db->select("id_renipress, codigo_institucion, institucion, codigo_renipress, nombre, clasificacion, tipo, codigo_region, region, codigo_provincia, provincia, codigo_distrito, distrito, ubigeo, norte, este");
        $this->db->from("renipress");
        $this->db->where("ubigeo", $this->Codigo_Ubigeo);
        return $this->db->get();
    }
    public function obtenerRenipressId()
    {
        $this->db->select("id_renipress, codigo_institucion, institucion, codigo_renipress, nombre, clasificacion, tipo, codigo_region, region, codigo_provincia, provincia, codigo_distrito, distrito, ubigeo");
        $this->db->from("renipress");
        $this->db->where("id_renipress", $this->idRenipress);
        return $this->db->get();
    }
}