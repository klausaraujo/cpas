<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class AlmacenRegistroFile_model extends CI_Model
{
    private $id;
    private $idingreso;
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
    public function setIdingreso($data)
    {
        $this->idingreso = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar()
    {
        $data = array(
            "idingreso" => $this->idingreso,
            "file" => $this->file,
            "inventarios_file_Usuario_Registro" => $this->session->userdata("idusuario"),
            "inventarios_file_Fecha_Registro" => date("Y-m-d H:i:s")
        );
        if ($this->db->insert('inventarios_registro_file_numero', $data))
            return true;
        else
            return false;
    }
    public function editar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("file", $this->file, TRUE);
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("inventarios_file_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("inventarios_file_Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("inventarios_file_Registro_File_Numero", $this->idingreso);
        $error = array();
        if ($this->db->update('inventarios_file_Registro_File_Numero'))
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
        $this->db->set("inventarios_file_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("inventarios_file_Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("inventarios_file_Registro_File_Numero", $this->idingreso);
        $error = array();
        if ($this->db->update('inventarios_registro_file_numero'))
            return true;
        else {
            return false;
        }
    }
    public function lista()
    {
        $this->db->select("idingreso,inventarios_registro_file_numero,descripcion,file,inventarios_file_Fecha_Registro,inventarios_file_Usuario_Registro,inventarios_file_Fecha_Actualizacion,inventarios_file_Usuario_Actualizacion");
        $this->db->from("inventarios_ingresos_registro_files");
        $this->db->where_in("idingreso", $this->idingreso);
        $this->db->order_by("inventarios_registro_file_numero", "ASC");
        return $this->db->get();
    }
    public function file()
    {
        $this->db->select("Evento_Registro_Numero,Evento_Registro_File_Numero,descripcion,file,Evento_Fecha_Registro,Evento_Usuario_Registro,Evento_Fecha_Actualizacion,Evento_Usuario_Actualizacion");
        $this->db->from("evento_registro_files");
        $this->db->where("Evento_Registro_File_Numero", $this->idingreso);
        return $this->db->get();
    }
   public function eliminar()
    {
        return $this->db->delete('inventarios_ingresos_registro_files', array(
            'idingreso' => $this->idingreso
        ));
    }
    public function buscarEvento() {
        $this->db->select("Evento_Registro_Numero,Evento_Latitud,Evento_Longitud");
        $this->db->from("evento_registro");
        $this->db->where("Evento_Secuencia", $this->id);
        return $this->db->get();
    }
}