<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class EventoTipoEntidadAtencionOfertaMovil_model extends CI_Model
{
    private $id;
    private $Evento_Tipo_Entidad_Atencion_ID;
    private $Evento_Registro_Numero;
    private $Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setEvento_Tipo_Entidad_Atencion_ID($data)
    {
        $this->Evento_Tipo_Entidad_Atencion_ID = $this->db->escape_str($data);
    }
    public function setEvento_Registro_Numero($data)
    {
        $this->Evento_Registro_Numero = $this->db->escape_str($data);
    }
    public function setEvento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre($data)
    {
        $this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID id,Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre,Evento_Tipo_Entidad_Atencion_Nombre");
        $this->db->from("evento_tipo_entidad_atencion_oferta_movil om");
        $this->db->join("evento_tipo_entidad_atencion e","om.Evento_Tipo_Entidad_Atencion_ID=e.Evento_Tipo_Entidad_Atencion_ID");
        $this->db->where("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        return $this->db->get();
    }
    public function listaByEntidad()
    {
        $this->db->select("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID id,Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre,Evento_Tipo_Entidad_Atencion_Nombre");
        $this->db->from("evento_tipo_entidad_atencion_oferta_movil om");
        $this->db->join("evento_tipo_entidad_atencion e","om.Evento_Tipo_Entidad_Atencion_ID=e.Evento_Tipo_Entidad_Atencion_ID");
        $this->db->where("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->where("e.Evento_Tipo_Entidad_Atencion_ID",$this->Evento_Tipo_Entidad_Atencion_ID);
        return $this->db->get();
    }
    public function registrar()
    {
        $data = array(
            "Evento_Tipo_Entidad_Atencion_ID" => $this->Evento_Tipo_Entidad_Atencion_ID,
            "Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre" => $this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre,
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Usuario_Registro" => $this->session->userdata("idusuario"),
            "Fecha_Registro" => date("Y-m-d H:i:s")
        );
        if ($this->db->insert('evento_tipo_entidad_atencion_oferta_movil', $data))
            return  $this->db->insert_id();
        else
            return 0;
    }
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID", $this->id);
        $error = array();
        if ($this->db->delete('evento_tipo_entidad_atencion_oferta_movil'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
	public function existe()
    {
        $this->db->select("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID id,Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre,Evento_Tipo_Entidad_Atencion_Nombre");
        $this->db->from("evento_tipo_entidad_atencion_oferta_movil om");
        $this->db->join("evento_tipo_entidad_atencion e","om.Evento_Tipo_Entidad_Atencion_ID=e.Evento_Tipo_Entidad_Atencion_ID");
        $this->db->where("om.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->where("om.Evento_Tipo_Entidad_Atencion_ID",$this->Evento_Tipo_Entidad_Atencion_ID);
        $this->db->where("om.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre",$this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre);
        return $this->db->get();
    }
    public function datosDashBoard() {
        $this->db->select("COUNT(Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID) total");
        $this->db->select("IFNULL(SUM(CASE WHEN Genero = '2' THEN 1 END),0) mujeres");
        $this->db->select("IFNULL(SUM(CASE WHEN Genero = '1' THEN 1 END),0) hombres");
        $this->db->select("IFNULL(SUM(CASE WHEN Gestante = '1' THEN 1 END),0) gestantes");
        $this->db->select("IFNULL(SUM(CASE WHEN (Edad < 18 AND Edad>0) THEN 1 END),0) menor_edad");
        $this->db->select("IFNULL(SUM(CASE WHEN Edad > 64 THEN 1 END),0) adulto_mayor");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones efad");
        $this->db->join("evento_tipo_entidad_atencion_registro efa","efad.Evento_Tipo_Entidad_Atencion_Registro_ID=efa.Evento_Tipo_Entidad_Atencion_Registro_ID");
        $this->db->where("efa.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        return $this->db->get();
    }    
    public function graficoDashboard() {
        $this->db->select("registro.Evento_Tipo_Entidad_Atencion_Registro_ID As ID");
        $this->db->select("registro.Evento_Tipo_Entidad_Atencion_Registro_Descripcion As Actividad, Id_CIE10 As CIE10,Count(*) As Cantidad");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones_cie cie");
        $this->db->join("evento_tipo_entidad_atencion_registro_atenciones atenciones","atenciones.Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID=cie.Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID");
        $this->db->join("evento_tipo_entidad_atencion_registro registro","registro.Evento_Tipo_Entidad_Atencion_Registro_ID=atenciones.Evento_Tipo_Entidad_Atencion_Registro_ID");
        $this->db->where("cie.Estado","1");
        $this->db->where("atenciones.Estado","1");
        $this->db->where("registro.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->group_by("registro.Evento_Tipo_Entidad_Atencion_Registro_ID,registro.Evento_Tipo_Entidad_Atencion_Registro_Descripcion,cie.Id_CIE10");
        $this->db->order_by("Cantidad", "DESC");
        $this->db->limit(10);
        return $this->db->get();
    }
    public function pieDashboard() {
        $this->db->select("IFNULL(SUM(CASE WHEN a.Clasificacion = '1' THEN 1 END),0) rojo");
        $this->db->select("IFNULL(SUM(CASE WHEN a.Clasificacion = '2' THEN 1 END),0) amarillo");
        $this->db->select("IFNULL(SUM(CASE WHEN a.Clasificacion = '3' THEN 1 END),0) verde");
        $this->db->select("IFNULL(SUM(CASE WHEN a.Clasificacion = '4' THEN 1 END),0) fallecido");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones a");
        $this->db->join("evento_tipo_entidad_atencion_registro r","a.Evento_Tipo_Entidad_Atencion_Registro_ID=r.Evento_Tipo_Entidad_Atencion_Registro_ID");
        $this->db->where("a.Estado","1");
        $this->db->where("r.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        return $this->db->get();
    }
    public function linesDashboard() {
        $this->db->select("etea.evento_tipo_entidad_atencion_nombre Entidad");
        $this->db->select("eteaom.evento_tipo_entidad_atencion_oferta_movil_nombre Oferta_Movil");
        $this->db->select("DATE_FORMAT(eteara.fecha_hora_atencion,'%d/%m/%Y') Fecha,DATE_FORMAT(eteara.fecha_hora_atencion,'%Y-%m-%d') fecha_convertir,IFNULL(Count(*),0) Cantidad");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones eteara");
        $this->db->join("evento_tipo_entidad_atencion_registro etear","eteara.Evento_Tipo_Entidad_Atencion_Registro_ID=etear.Evento_Tipo_Entidad_Atencion_Registro_ID"); 
        $this->db->join("evento_tipo_entidad_atencion_oferta_movil eteaom","eteaom.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID=eteara.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID"); 
        $this->db->join("evento_tipo_entidad_atencion etea","etea.Evento_Tipo_Entidad_Atencion_ID=eteaom.Evento_Tipo_Entidad_Atencion_ID");
        $this->db->where("etear.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->group_by("etea.evento_tipo_entidad_atencion_nombre,eteaom.evento_tipo_entidad_atencion_oferta_movil_nombre,DATE_FORMAT(eteara.fecha_hora_atencion,'%d/%m/%Y')");
        $this->db->order_by("eteaom.evento_tipo_entidad_atencion_oferta_movil_nombre, DATE_FORMAT(eteara.fecha_hora_atencion,'%d/%m/%Y')");
       return $this->db->get();
    }
    public function polarChartDasboard() {
        $this->db->select("etea.evento_tipo_entidad_atencion_nombre AS Entidad, eteaom.evento_tipo_entidad_atencion_oferta_movil_nombre AS 'Oferta_Movil', IFNULL(COUNT(*),0) AS Cantidad");
        $this->db->from("evento_tipo_entidad_atencion_registro_atenciones  eteara");
        $this->db->join("evento_tipo_entidad_atencion_registro etear","eteara.Evento_Tipo_Entidad_Atencion_Registro_ID=etear.Evento_Tipo_Entidad_Atencion_Registro_ID");
        $this->db->join("evento_tipo_entidad_atencion_oferta_movil eteaom","eteaom.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID=eteara.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID");
        $this->db->join("evento_tipo_entidad_atencion etea","etea.Evento_Tipo_Entidad_Atencion_ID=eteaom.Evento_Tipo_Entidad_Atencion_ID");
        $this->db->where("etear.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->group_by("etear.evento_tipo_entidad_atencion_registro_id, etear.evento_tipo_entidad_atencion_Registro_descripcion, etea.evento_tipo_entidad_atencion_nombre, eteaom.evento_tipo_entidad_atencion_oferta_movil_nombre");
        return $this->db->get();
    }
}