<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_model extends CI_Model
{
    private $id;
    private $anio;
    private $sector;
    private $pliego;
    private $ejecutora;
    private $centroCostos;
    private $subCentroCostos;
    private $Codigo_Usuario;
    private $Codigo_Sector;
    private $Codigo_Pliego;
    private $Codigo_Ejecutora;
    private $Codigo_Centro_Costos;
    private $Codigo_Sub_Centro_Costos;
    private $Nombre;
    private $Siglas;
    private $Estado;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setNombre($data)
    {
        $this->Nombre = $this->db->escape_str($data);
    }
    public function setEstado($data)
    {
        $this->Estado = $this->db->escape_str($data);
    }
    public function setSiglas($data)
    {
        $this->Siglas = $this->db->escape_str($data);
    }
    public function setAnio($data)
    {
        $this->anio = $this->db->escape_str($data);
    }
    public function setSector($data)
    {
        $this->sector = $this->db->escape_str($data);
    }
    public function setPliego($data)
    {
        $this->pliego = $this->db->escape_str($data);
    }
    public function setEjecutora($data)
    {
        $this->ejecutora = $this->db->escape_str($data);
    }
    public function setCentroCostos($data)
    {
        $this->centroCostos = $this->db->escape_str($data);
    }
    public function setSubCentroCostos($data)
    {
        $this->subCentroCostos = $this->db->escape_str($data);
    }
    public function setCodigo_Usuario($data)
    {
        $this->Codigo_Usuario = $this->db->escape_str($data);
    }
    public function setCodigo_Sector($data)
    {
        $this->Codigo_Sector = $this->db->escape_str($data);
    }
    public function setCodigo_Pliego($data)
    {
        $this->Codigo_Pliego = $this->db->escape_str($data);
    }
    public function setCodigo_Ejecutora($data)
    {
        $this->Codigo_Ejecutora = $this->db->escape_str($data);
    }
    public function setCodigo_Centro_Costos($data)
    {
        $this->Codigo_Centro_Costos = $this->db->escape_str($data);
    }
    public function setCodigo_Sub_Centro_Costos($data)
    {
        $this->Codigo_Sub_Centro_Costos = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Codigo_Pliego,Codigo_Ejecutora,Codigo_Centro_Costos,Codigo_Sub_Centro_Costos,Codigo_Area,Nombre_Area,Siglas_Area,Activo");
        $this->db->from("tablero_area");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where('mostrar', 1);
        $this->db->order_by("Orden ASC");
        return $this->db->get();
    }
    public function listar()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Codigo_Pliego,Codigo_Ejecutora,Codigo_Centro_Costos,Codigo_Sub_Centro_Costos,Codigo_Area,Nombre_Area,Siglas_Area,Activo");
        $this->db->from("tablero_area");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where('mostrar', 1);
        $this->db->order_by("Orden ASC");
        return $this->db->get();
    }
    public function listaCompleta()
    {
        $this->db->select("Anio_Ejecucion,Codigo_SectorCodigo_Pliego,Codigo_Ejecutora,Codigo_Centro_Costos,Codigo_Sub_Centro_Costos,Codigo_Area,Nombre_Area,Siglas_Area,Activo");
        $this->db->from("tablero_area");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where('mostrar', 1);
        $this->db->order_by("Orden ASC");
        return $this->db->get();
    }
    public function seleccionar()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Codigo_Pliego,Codigo_Ejecutora,Codigo_Centro_Costos,Codigo_Sub_Centro_Costos,Codigo_Area,Nombre_Area,Siglas_Area,Activo");
        $this->db->from("tablero_area");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where_in("Codigo_Area", $this->id);
        return $this->db->get();
    }
    public function areasByAnioByUsuario()
    {
        $this->db->select("a.Anio_Ejecucion,a.Codigo_Sector,a.Codigo_Pliego,a.Codigo_Ejecutora,a.Codigo_Centro_Costos,a.Codigo_Sub_Centro_Costos,a.Codigo_Area,a.Nombre_Area,a.Siglas_Area,a.Activo,Codigo_Usuario");
        $this->db->from("tablero_area a");
        $this->db->join("usuarios_areas u", "a.Codigo_Area=u.Codigo_Area AND u.Anio_Ejecucion=a.Anio_Ejecucion AND u.Codigo_Usuario=$this->Codigo_Usuario", "LEFT");
        $this->db->where("a.Anio_Ejecucion", $this->anio);
        $this->db->where("a.Codigo_Area!=", "00");
        $this->db->order_by("Orden ASC");
        return $this->db->get();
    }
    public function areasByAnioByUsuarioCompleto()
    {
        $this->db->select("a.Anio_Ejecucion,a.Codigo_Sector,a.Codigo_Pliego,a.Codigo_Ejecutora,a.Codigo_Centro_Costos,a.Codigo_Sub_Centro_Costos,a.Codigo_Area,a.Nombre_Area,a.Siglas_Area,a.Activo,Codigo_Usuario");
        $this->db->from("tablero_area a");
        $this->db->join("usuarios_areas u", "a.Codigo_Area=u.Codigo_Area AND u.Anio_Ejecucion=a.Anio_Ejecucion AND u.Codigo_Usuario=$this->Codigo_Usuario", "LEFT");
        $this->db->where("a.Anio_Ejecucion", $this->anio);
        $this->db->where("a.Codigo_Sector", $this->sector);
        $this->db->where("a.Codigo_Pliego", $this->pliego);
        $this->db->where("a.Codigo_Ejecutora", $this->ejecutora);
        $this->db->where("a.Codigo_Centro_Costos", $this->centroCostos);
        $this->db->where("a.Codigo_Sub_Centro_Costos", $this->subCentroCostos);
        $this->db->where("a.Codigo_Area!=", "00");
        $this->db->order_by("Orden ASC");
        return $this->db->get();
    }
    public function eliminarUsuarioAreas()
    {
        $this->db->where('Anio_Ejecucion', $this->anio);
        $this->db->where('Codigo_Usuario', $this->Codigo_Usuario);
        $this->db->delete('usuarios_areas');
    }
    public function registrarUsuariosAreas()
    {
        $data = array(
            "Anio_Ejecucion" => $this->anio,
            "Codigo_Usuario" => $this->Codigo_Usuario,
            "Codigo_Area" => $this->id,
            "Activo" => "1",
            "Codigo_Sector" => $this->Codigo_Sector,
            "Codigo_Pliego" => $this->Codigo_Pliego,
            "Codigo_Ejecutora" => $this->Codigo_Ejecutora,
            "Codigo_Centro_Costos" => $this->Codigo_Centro_Costos,
            "Codigo_Sub_Centro_Costos" => $this->Codigo_Sub_Centro_Costos
        );
        $this->db->insert("usuarios_areas", $data);
    }
    public function registrarAreas()
    {
        $data = array(
            "Anio_Ejecucion" => $this->anio,
            "Codigo_Area" => $this->id,
            "Codigo_Sector" => $this->Codigo_Sector,
            "Codigo_Pliego" => $this->Codigo_Pliego,
            "Codigo_Ejecutora" => $this->Codigo_Ejecutora,
            "Codigo_Centro_Costos" => $this->Codigo_Centro_Costos,
            "Codigo_Sub_Centro_Costos" => $this->Codigo_Sub_Centro_Costos,
            "Nombre_Area" => $this->Nombre,
            "Siglas_Area" => $this->Siglas,
            "Activo" => $this->Estado
        );
        $this->db->insert("tablero_area", $data);
    }
    public function actualizarAreas()
    {
        $this->db->set("Nombre_Area", $this->Nombre, TRUE);
        $this->db->set("Siglas_Area", $this->Siglas, TRUE);
        $this->db->set("Activo", $this->Estado, TRUE);
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_Sector", $this->Codigo_Sector);
        $this->db->where("Codigo_Pliego", $this->Codigo_Pliego);
        $this->db->where("Codigo_Ejecutora", $this->Codigo_Ejecutora);
        $this->db->where("Codigo_Centro_Costos", $this->Codigo_Centro_Costos);
        $this->db->where("Codigo_Sub_Centro_Costos", $this->Codigo_Sub_Centro_Costos);
        $this->db->where("Codigo_Area", $this->id);
        $error = array();
        if ($this->db->update('tablero_area'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
        $this->db->insert("usuarios_areas", $data);
    }
    
    public function listaAreasByUser2() {
        $this->db->select("area.Anio_Ejecucion AS Anio_Ejecucion, area.Codigo_Sector AS Codigo_Sector,	area.Codigo_Pliego AS Codigo_Pliego, area.Codigo_Ejecutora AS Codigo_Ejecutora,	area.Codigo_Centro_Costos AS Codigo_Centro_Costos, area.Codigo_Sub_Centro_Costos AS Codigo_Sub_Centro_Costos,	area.Codigo_Area AS Codigo_Area, tablero.Nombre_Area AS Nombre_Area, tablero.Siglas_Area AS Siglas_Area, tablero.Activo AS Activo");
        $this->db->from("tablero_area tablero");
        $this->db->join("usuarios_areas area ","area.Anio_Ejecucion = tablero.Anio_Ejecucion and area.Codigo_Sector=tablero.Codigo_Sector and area.Codigo_Pliego=tablero.Codigo_Pliego and area.Codigo_Ejecutora=tablero.Codigo_Ejecutora AND area.Codigo_Centro_Costos=tablero.Codigo_Centro_Costos and area.Codigo_Sub_Centro_Costos=tablero.Codigo_Sub_Centro_Costos and area.Codigo_Area = tablero.Codigo_Area");
        $idusuario =  $this->session->userdata("idusuario");        
        $this->db->where("area.Codigo_Usuario", $idusuario);
        $this->db->where("area.Anio_Ejecucion", $this->anio);
        
        return $this->db->get();
    }

    public function listaAreasByUser() {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Codigo_Pliego,Codigo_Ejecutora,Codigo_Centro_Costos,Codigo_Sub_Centro_Costos,Codigo_Area,Nombre_Area,Siglas_Area,Activo");
        $this->db->from("tablero_area");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_Area!=", "00");
        $this->db->where('mostrar', 1);
        $idrol =  $this->session->userdata("idrol");
        if($this->id != "00" and $idrol != "01") {
            $this->db->where_in("Codigo_Area", $this->id);
            $this->db->where_in("Anio_Ejecucion", $this->anio);
        }
        $this->db->order_by("Orden ASC");
        return $this->db->get();
    }
}