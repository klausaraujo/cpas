<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoRegistroFile_model extends CI_Model
{
    private $id;
    private $Evento_Registro_Numero;
    private $file;
    private $descripcion;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setEvento_Registro_Numero($data)
    {
        $this->Evento_Registro_Numero = $this->db->escape_str($data);
    }
    public function setFile($data)
    {
        $this->file = $this->db->escape_str($data);
    }
    public function setDescripcion($data)
    {
        $this->descripcion = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar()
    {
        $data = array(
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "file" => $this->file,
            "Evento_Usuario_Registro" => $this->session->userdata("idusuario"),
            "Evento_Fecha_Registro" => date("Y-m-d H:i:s")
        );
        if ($this->db->insert('evento_registro_files', $data))
            return true;
        else
            return false;
    }
    public function editar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("file", $this->file, TRUE);
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("Evento_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Evento_Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("Evento_Registro_File_Numero", $this->id);
        $error = array();
        if ($this->db->update('evento_registro_files'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function descripcion()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("Evento_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Evento_Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("Evento_Registro_File_Numero", $this->id);
        $error = array();
        if ($this->db->update('evento_registro_files'))
            return true;
        else {
            return false;
        }
    }
    public function lista()
    {
        $this->db->select("Evento_Registro_Numero,Evento_Registro_File_Numero,descripcion,file,Evento_Fecha_Registro,Evento_Usuario_Registro,Evento_Fecha_Actualizacion,Evento_Usuario_Actualizacion");
        $this->db->from("evento_registro_files");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Registro_File_Numero", "ASC");
        return $this->db->get();
    }
    public function file()
    {
        $this->db->select("Evento_Registro_Numero,Evento_Registro_File_Numero,descripcion,file,Evento_Fecha_Registro,Evento_Usuario_Registro,Evento_Fecha_Actualizacion,Evento_Usuario_Actualizacion");
        $this->db->from("evento_registro_files");
        $this->db->where("Evento_Registro_File_Numero", $this->id);
        return $this->db->get();
    }
   public function eliminar()
    {
        return $this->db->delete('evento_registro_files', array(
            'Evento_Registro_File_Numero' => $this->id
        ));
    }
    public function buscarEvento() {
        $this->db->select("Evento_Registro_Numero,Evento_Latitud,Evento_Longitud");
        $this->db->from("evento_registro");
        $this->db->where("Evento_Secuencia", $this->id);
        return $this->db->get();
    }
}