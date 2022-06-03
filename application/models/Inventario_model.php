<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Inventario_model extends CI_Model
{
    private $descripcion;
    private $fecha_registro;
    private $estado;
    private $id_marca;
    private $id_tipohospital;
    private $idmodelo;
    public function setDescripcion($data)
    {
        $this->descripcion = $this->db->escape_str($data);
    }
    public function setFechaRegistro($data)
    {
        $this->fecha_registro = $this->db->escape_str($data);
    }
    public function setEstado($data)
    {
        $this->estado = $this->db->escape_str($data);
    }
    public function setIdMarca($data)
    {
        $this->id_marca = $this->db->escape_str($data);
    }
    public function setid_tipohospital($data)
    {
        $this->id_tipohospital = $this->db->escape_str($data);
    }
    public function setIdModelo($data)
    {
        $this->idmodelo = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerAlmacenes()
    {
        $this->db->select("idalmacen, nombre, domicilio, ubigeo, nombre_encargado_titular, nombre_encargado_suplente, estado");
        $this->db->from("inventarios_almacen");
        $this->db->order_by("nombre ASC");
        return $this->db->get();
    }
    public function obtenerMarcas()
    {
        $this->db->select("idmarca, descripcion, fecha_registro, estado");
        $this->db->from("inventarios_marca");
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
    public function obtenerLista()
    {
        $this->db->select("idmarca, descripcion");
        $this->db->from("inventarios_marca");
        $this->db->where("estado", 1);
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
    public function guardarMarca()
    {
        $data = array(
            "descripcion" => $this->descripcion,
            "fecha_registro" => $this->fecha_registro,
            "estado" => $this->estado
        );

        if($this->db->insert("inventarios_marca", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function actualizarMarca()
    {
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("fecha_registro", $this->fecha_registro, TRUE);
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->where("idmarca", $this->id_marca);
        $error = array();
        if ($this->db->update('inventarios_marca'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }

    public function obtenerListaTipoHospital()
    {
        $this->db->select("idtipohospital, descripcion");
        $this->db->from("inventarios_tipo_hospital");
        $this->db->where("estado", 1);
        $this->db->order_by("idtipohospital ASC");
        return $this->db->get();
    }

    public function obtenerTipoHospital()
    {
        $this->db->select("idtipohospital, descripcion, fecha_registro, fecha_baja, estado");
        $this->db->from("inventarios_tipo_hospital");
        $this->db->order_by("idtipohospital ASC");
        return $this->db->get();
    }

    public function guardarTipoHospital()
    {
        $data = array(
            "descripcion" => $this->descripcion,
            "fecha_registro" => $this->fecha_registro,
            "estado" => $this->estado
        );

        if($this->db->insert("inventarios_tipo_hospital", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function actualizarTipoHospital()
    {
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("fecha_registro", $this->fecha_registro, TRUE);
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->where("idtipohospital", $this->id_tipohospital);
        $error = array();
        if ($this->db->update('inventarios_marca'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }

    public function obtenerModelos()
    {
        $this->db->select("imo.*, ima.descripcion as descmarca");
        $this->db->from("inventarios_modelo imo, inventarios_marca ima");
        $this->db->where("imo.idmarca = ima.idmarca");
        $this->db->order_by("idmodelo ASC");
        return $this->db->get();
    }

    public function guardarModelo()
    {
        $data = array(
            "descripcion" => $this->descripcion,
            "idmarca" => $this->id_marca,
            "fecha_registro" => $this->fecha_registro,
            "estado" => $this->estado
        );

        if($this->db->insert("inventarios_modelo", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function actualizarModelo()
    {
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("idmarca", $this->id_marca, TRUE);
        $this->db->set("fecha_registro", $this->fecha_registro, TRUE);
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->where("idmodelo", $this->idmodelo);
        $error = array();
        if ($this->db->update('inventarios_modelo'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }

}