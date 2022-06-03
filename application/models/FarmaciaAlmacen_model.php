<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class FarmaciaAlmacen_model extends CI_Model
{
    private $idAlmacen;
    private $nombre;
    private $direccion;
    private $codigoUbigeo;
    private $nombreUbigeo;
    private $numeroDniTitular;
    private $nombreTitular;
    private $telefonoTitular;
    private $numeroDniSuplente;
    private $nombreSuplente;
    private $telefonoSuplente;
    private $estado;
    private $coordenadas;
    public function setCoordenada($data){
        $this->coordenadas= $this->db->escape_str($data);
    }
    public function setId($data){
        $this->idAlmacen= $this->db->escape_str($data);
    }
    public function setNombre($data){
        $this->nombre= $this->db->escape_str($data);
    }
    public function setDireccion($data){
        $this->direccion= $this->db->escape_str($data);
    }
    public function setUbigeo($data){
        $this->codigoUbigeo= $this->db->escape_str($data);
    }
    public function setNombreUbigeo($data){
        $this->nombreUbigeo= $this->db->escape_str($data);
    }
    public function setDniTitular($data){
        $this->numeroDniTitular= $this->db->escape_str($data);
    }
    public function setNombreTitular($data){
        $this->nombreTitular= $this->db->escape_str($data);
    }
    public function setTelefonoTitular($data){
        $this->telefonoTitular= $this->db->escape_str($data);
    }
    public function setDniSuplente($data){
        $this->numeroDniSuplente= $this->db->escape_str($data);
    }
    public function setNombreSuplente($data){
        $this->nombreSuplente= $this->db->escape_str($data);
    }
    public function setTelefonoSuplente($data){
        $this->telefonoSuplente= $this->db->escape_str($data);
    }
    public function setEstado($data){
        $this->estado= $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerAlmacenes()
    {
        $this->db->select("almacen.idalmacen,almacen.nombre,almacen.domicilio,almacen.ubigeo,almacen.dni_encargado_titular,almacen.nombre_encargado_titular,almacen.fono_encargado_titular,almacen.dni_encargado_suplente,almacen.nombre_encargado_suplente,almacen.fono_encargado_suplente,almacen.estado, Region.Nombre as 'Region',Provincia.Nombre as 'Provincia',Distrito.Nombre as 'Distrito', almacen.coordenadas");
        $this->db->from("farmacia_almacen almacen");
        $this->db->join("ubigeo Region","Region.Codigo_Departamento = IFNULL(LEFT(Almacen.ubigeo,2),'00') and region.Codigo_Provincia='00' and region.codigo_distrito='00'");
        $this->db->join("ubigeo Provincia","Provincia.Codigo_Departamento=IFNULL(LEFT(Almacen.ubigeo,2),'00') and Provincia.Codigo_Provincia=
        IFNULL(SUBSTR(Almacen.ubigeo,3,2),'00') and Provincia.Codigo_Distrito='00'");
        $this->db->join("ubigeo Distrito","Distrito.Codigo_Departamento = IFNULL(LEFT(Almacen.ubigeo,2),'00') and Distrito.Codigo_Provincia=
        IFNULL(SUBSTR(Almacen.ubigeo,3,2),'00') and Distrito.Codigo_Distrito=IFNULL(RIGHT(Almacen.ubigeo,2),'00')");
        $this->db->order_by("nombre ASC");
        return $this->db->get();
    }
    public function guardarAlmacen()
    {
        $data = array(
            "nombre" => $this->nombre,
            "domicilio" => $this->direccion,
            "ubigeo" => $this->codigoUbigeo,
            "dni_encargado_titular" => $this->numeroDniTitular,
            "nombre_encargado_titular" => $this->nombreTitular,
            "fono_encargado_titular" => $this->telefonoTitular,
            "dni_encargado_suplente" => $this->numeroDniSuplente,
            "nombre_encargado_suplente" => $this->nombreSuplente,
            "fono_encargado_suplente" => $this->telefonoSuplente,
            "coordenadas" => $this->coordenadas,
            "estado" => $this->estado
        );
        if($this->db->insert("farmacia_almacen", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function actualizarAlmacen()
    {
        $this->db->set("nombre", $this->nombre, TRUE);
        $this->db->set("domicilio", $this->direccion, TRUE);
        $this->db->set("ubigeo", $this->codigoUbigeo, TRUE);
        $this->db->set("dni_encargado_titular", $this->numeroDniTitular, TRUE);
        $this->db->set("nombre_encargado_titular", $this->nombreTitular, TRUE);
        $this->db->set("fono_encargado_titular", $this->telefonoTitular, TRUE);
        $this->db->set("dni_encargado_suplente", $this->numeroDniSuplente, TRUE);
        $this->db->set("nombre_encargado_suplente", $this->nombreSuplente, TRUE);
        $this->db->set("fono_encargado_suplente", $this->telefonoSuplente, TRUE);
        $this->db->set("estado", $this->estado, TRUE);
        if($this->coordenadas){
            $this->db->set("coordenadas", $this->coordenadas, TRUE);
        }
        $this->db->where("idAlmacen", $this->idAlmacen);
        $error = array();
        if ($this->db->update('farmacia_almacen'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
}