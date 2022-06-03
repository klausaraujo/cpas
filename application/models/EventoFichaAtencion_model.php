<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoFichaAtencion_model extends CI_Model
{
    private $id;
    private $Evento_Ficha_Atencion_Fecha;
    private $Evento_Ficha_Atencion_Hora_Cierre;
    private $Evento_Ficha_Atencion_Usuario_Apertura;
    private  $Evento_Registro_Numero;
    private $Evento_Ficha_Atencion_Estado;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Fecha($data)
    {
        $this->Evento_Ficha_Atencion_Fecha = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Hora_Cierre($data)
    {
        $this->Evento_Ficha_Atencion_Hora_Cierre = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Usuario_Apertura($data)
    {
        $this->Evento_Ficha_Atencion_Usuario_Apertura = $this->db->escape_str($data);
    }
    public function setEvento_Registro_Numero($data)
    {
        $this->Evento_Registro_Numero = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Estado($data)
    {
        $this->Evento_Ficha_Atencion_Estado = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar()
    {
        $data = array(
            "Evento_Ficha_Atencion_Usuario_Apertura" => $this->session->userdata("idusuario"),
            "Evento_Ficha_Atencion_Fecha" => $this->Evento_Ficha_Atencion_Fecha,
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Evento_Ficha_Atencion_Estado" => 1
        );
        
        if ($this->db->insert('evento_ficha_atencion', $data))
            return true;
        else
           return false;
    }
    public function editar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Evento_Ficha_Atencion_Fecha", "CONCAT(DATE(Evento_Ficha_Atencion_Fecha),' ','$this->Evento_Ficha_Atencion_Hora_Cierre')", FALSE);
        $this->db->where("Evento_Ficha_Atencion_ID", $this->id);
        $this->db->where("Evento_Ficha_Atencion_Estado", 1);
        $error = array();
        if ($this->db->update('evento_ficha_atencion')){
            return 1;}
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function existe()
    {
        $this->db->select("Evento_Ficha_Atencion_ID");
        $this->db->from("evento_ficha_atencion");
        $this->db->where("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->where("DATE(Evento_Ficha_Atencion_Fecha)",$this->Evento_Ficha_Atencion_Fecha);
        $this->db->where("Evento_Ficha_Atencion_Estado","1");
        return $this->db->get();
    }
    public function eventoFichaAtencion(){
        $this->db->select("Evento_Ficha_Atencion_ID id,DATE_FORMAT(Evento_Ficha_Atencion_Fecha,'%Y-%m-%d') Evento_Ficha_Atencion_Fecha,Evento_Ficha_Atencion_Estado");
        $this->db->from("evento_ficha_atencion");
        $this->db->where("Evento_Ficha_Atencion_ID",$this->id);
        $this->db->where("Evento_Ficha_Atencion_Estado","1");
        return $this->db->get();
    }
    public function lista()
    {
        $this->db->select("e.Evento_Ficha_Atencion_ID id,e.Evento_Ficha_Atencion_Fecha,DATE_FORMAT(e.Evento_Ficha_Atencion_Hora_Cierre,'%H:%i:%s') Evento_Ficha_Atencion_Hora_Cierre,e.Evento_Ficha_Atencion_Estado");
        $this->db->select("COUNT(ed.Evento_Ficha_Atencion_Detalle_ID) Numero_Atenciones");
        $this->db->select("CONCAT(Nombres,' ',Apellidos) usuario");
        $this->db->from("evento_ficha_atencion e");
        $this->db->join("usuarios u","e.Evento_Ficha_Atencion_Usuario_Apertura=u.Codigo_Usuario");
        $this->db->join("evento_ficha_atencion_detalle ed","e.Evento_Ficha_Atencion_ID=ed.Evento_Ficha_Atencion_ID","left");
        $this->db->where("e.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->group_by("e.Evento_Ficha_Atencion_ID,e.Evento_Ficha_Atencion_Fecha,e.Evento_Ficha_Atencion_Hora_Cierre");
        return $this->db->get();
    }
    public function cerrar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Evento_Ficha_Atencion_Hora_Cierre", "CONCAT(DATE(Evento_Ficha_Atencion_Fecha),' ','$this->Evento_Ficha_Atencion_Hora_Cierre')", FALSE);
        $this->db->set("Evento_Ficha_Atencion_Estado", "2", TRUE);
        $this->db->set("Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("Evento_Ficha_Atencion_ID", $this->id);
        $error = array();
        if ($this->db->update('evento_ficha_atencion'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }    
    public function abrir()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Evento_Ficha_Atencion_Hora_Cierre", null, TRUE);
        $this->db->set("Evento_Ficha_Atencion_Estado", "1", TRUE);
        $this->db->set("Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("Evento_Ficha_Atencion_ID", $this->id);
        $error = array();
        if ($this->db->update('evento_ficha_atencion'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function eliminar()
    {
        return $this->db->delete('evento_ficha_atencion', array('Evento_Ficha_Atencion_ID' => $this->id));
    }
    public function listaCantidadesAtencionesOfertaMovil() {
        $this->db->select("Evento_Tipo_Entidad_Atencion_Nombre AS Entidad, Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre AS Oferta_Movil ,COUNT(1) AS Atenciones");        
        $this->db->select("SUM(IF(Evento_Ficha_Atencion_Detalle_ID IS NULL,0,1)) Atenciones");
        $this->db->from("evento_tipo_entidad_atencion ea");
        $this->db->join("evento_tipo_entidad_atencion_oferta_movil aom","ON ea.Evento_Tipo_Entidad_Atencion_ID = aom.Evento_Tipo_Entidad_Atencion_ID");
        $this->db->join("evento_ficha_atencion_detalle ad","ad.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = aom.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID","LEFT");
        $this->db->join("evento_ficha_atencion a","a.Evento_Ficha_Atencion_ID = ad.Evento_Ficha_Atencion_ID AND ad.Evento_Ficha_Atencion_ID=$this->id","LEFT");
        $this->db->join("lista_enfermedades le","ad.Evento_Ficha_Atencion_Detalle_CIE10_Codigo = le.Codigo","LEFT");
        $this->db->where("aom.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->group_by("Evento_Tipo_Entidad_Atencion_Nombre,Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre");
        return $this->db->get();
    }
    public function listarCantidadesAtencionesDiagnosticos() {
        $this->db->select("CIE10,CIE10_Descripcion,Count(1) AS Cantidad");
        $this->db->from("Lista_Atenciones_Eventos");
        $this->db->where("Evento_Ficha_Atencion_ID",$this->id);
        $this->db->group_by("CIE10,CIE10_Descripcion");
        return $this->db->get();
    }
}