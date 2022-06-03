<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class SuperEvento_model extends CI_Model
{
    private $id;
    private $Super_Evento_Registro_Titulo;
    private $Super_Evento_Registro_Fecha;
    private $Super_Evento_Registro_Nombre;
    private $Super_Evento_Registro_Descripcion;
    private $estado;
    public function setId($data) {
        $this->id = $this->db->escape_str($data);
    }
    public function setSuper_Evento_Registro_Titulo($data) {
        $this->Super_Evento_Registro_Titulo = $this->db->escape_str($data);
    }
    public function setSuper_Evento_Registro_Fecha($data) {
        $this->Super_Evento_Registro_Fecha = $this->db->escape_str($data);
    }
    public function setSuper_Evento_Registro_Nombre($data) {
        $this->Super_Evento_Registro_Nombre = $this->db->escape_str($data);
    }
    public function setSuper_Evento_Registro_Descripcion($data) {
        $this->Super_Evento_Registro_Descripcion = $this->db->escape_str($data);
    }
    public function setEstado($data) {
        $this->estado = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function listar()
    {
        $this->db->select("Super_Evento_Registro_Titulo,DATE_FORMAT(Super_Evento_Registro_Fecha_Registro,'%d/%m/%Y %H:%i') Super_Evento_Registro_Fecha_Registro,Super_Evento_Registro_Nombre");
        $this->db->select("Super_Evento_Registro_Descripcion, Super_Evento_Registro_ID id, estado");
        $this->db->from("Super_Evento_Registro");
        
        return $this->db->get();
    }
    public function crear() {
        $data = array(
            "Super_Evento_Registro_Titulo" => $this->Super_Evento_Registro_Titulo,
            "Super_Evento_Registro_Fecha_Registro" => $this->Super_Evento_Registro_Fecha,
            "Super_Evento_Registro_Nombre" => $this->Super_Evento_Registro_Nombre,
            "Super_Evento_Registro_Descripcion" => $this->Super_Evento_Registro_Descripcion,
            "Super_Evento_Registro_Usuario" => $this->session->userdata("idusuario"),
            "estado" => "1"
        );
        if($this->db->insert("Super_Evento_Registro", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("Super_Evento_Registro_Titulo", $this->Super_Evento_Registro_Titulo, TRUE);
        $this->db->set("Super_Evento_Registro_Fecha_Registro", $this->Super_Evento_Registro_Fecha, TRUE);
        $this->db->set("Super_Evento_Registro_Nombre", $this->Super_Evento_Registro_Nombre, TRUE);
        $this->db->set("Super_Evento_Registro_Descripcion", $this->Super_Evento_Registro_Descripcion, TRUE);
        $this->db->where("Super_Evento_Registro_ID", $this->id);
        
        if ($this->db->update('Super_Evento_Registro')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("Super_Evento_Registro_ID", $this->id);
        if ($this->db->delete('Super_Evento_Registro')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function cambiarEstado()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->set("Super_Evento_Registro_Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->set("Super_Evento_Registro_Usuario", $this->session->userdata("idusuario"), TRUE);
        $this->db->where("Super_Evento_Registro_ID", $this->id);
        $error = array();
        if ($this->db->update('Super_Evento_Registro'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function superEvento() {
        $this->db->select("Super_Evento_Registro_ID id");
        $this->db->select("DATE_FORMAT(Super_Evento_Registro_Fecha_Registro,'%Y') as E_ANIO,DATE_FORMAT(Super_Evento_Registro_Fecha_Registro,'%m') E_MES,DATE_FORMAT(Super_Evento_Registro_Fecha_Registro,'%d') E_DIA");
        $this->db->select("DATE_FORMAT(Super_Evento_Registro_Fecha_Registro,'%H') E_HORA,DATE_FORMAT(Super_Evento_Registro_Fecha_Registro,'%i') E_MINUTO,Super_Evento_Registro_Descripcion");
        $this->db->from("Super_Evento_Registro");
        return $this->db->get();
    }
}