<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class TipoDocumento_model extends CI_Model
{
    public function lista()
    {
        $this->db->select("Tipo_Documento_Codigo,Tipo_Documento_Nombre,Tipo_Documento_Longitud,Activo");
        $this->db->from("tipo_documento");       
        return $this->db->get();
    }
}