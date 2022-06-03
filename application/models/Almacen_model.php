<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Almacen_model extends CI_Model
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
        $this->db->select("almacen.idalmacen,almacen.nombre,almacen.domicilio,almacen.ubigeo,almacen.dni_encargado_titular,almacen.nombre_encargado_titular,almacen.fono_encargado_titular,almacen.dni_encargado_suplente,almacen.nombre_encargado_suplente,almacen.coordenadas, almacen.fono_encargado_suplente,almacen.estado,region.Nombre as 'Region',provincia.Nombre as 'Provincia',distrito.Nombre as 'Distrito'");
        $this->db->from("inventarios_almacen almacen");
        $this->db->join("ubigeo region","region.codigo_departamento = IFNULL(LEFT(almacen.ubigeo,2),'00') and region.codigo_provincia='00' and region.codigo_distrito='00'");
        $this->db->join("ubigeo provincia","provincia.codigo_departamento=IFNULL(LEFT(almacen.ubigeo,2),'00') and provincia.codigo_provincia=
        IFNULL(SUBSTR(almacen.ubigeo,3,2),'00') and provincia.codigo_distrito='00'");
        $this->db->join("ubigeo distrito","distrito.codigo_departamento = IFNULL(LEFT(almacen.ubigeo,2),'00') and distrito.codigo_provincia=
        IFNULL(SUBSTR(almacen.ubigeo,3,2),'00') and distrito.codigo_distrito=IFNULL(RIGHT(almacen.ubigeo,2),'00')");
        $this->db->order_by("almacen.idalmacen ASC");
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
        if($this->db->insert("inventarios_almacen", $data)) {
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
        if ($this->db->update('inventarios_almacen'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
}
