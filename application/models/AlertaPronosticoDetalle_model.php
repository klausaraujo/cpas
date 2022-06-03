<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class AlertaPronosticoDetalle_model extends CI_Model
{
    private $id;
    private $avisos_ID;
    private $codigo_departamento;
    private $codigo_provincia;
    public function setId($data) {
        $this->id = $this->db->escape_str($data);
    }
    public function setavisos_ID($data) {
        $this->avisos_ID = $this->db->escape_str($data);
    }
    public function setcodigo_Departamento($data) {
        $this->codigo_departamento = $this->db->escape_str($data);
    }
    public function setcodigo_Provincia($data) {
        $this->codigo_provincia = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function listar()
    {
        $this->db->select("Super_Evento_Registro_Titulo,Super_Evento_Registro_Fecha,Super_Evento_Registro_Nombre");
        $this->db->select("Super_Evento_Registro_Descripcion, Super_Evento_Registro_ID id");
        $this->db->from("super_evento_registro_detalle");
        $this->db->where("activo","1");
        return $this->db->get();
    }
    public function filtrosEventosById() {
        $this->db->select("evento_avisos.evento_avisos_id,evento_avisos.evento_avisos_numero,evento_avisos.evento_avisos_anio,concat_ws('',evento_avisos_ubigeo.codigo_departamento,evento_avisos_ubigeo.codigo_provincia,'00') as 'Ubigeo',evento_avisos_ubigeo.codigo_departamento,ubigeo_departamento.Nombre as 'Region',evento_avisos_ubigeo.codigo_provincia,ubigeo_provincia.Nombre as 'Provincia'");
        $this->db->from("evento_avisos");
        $this->db->join("evento_avisos_ubigeo","evento_avisos_ubigeo.evento_avisos_id=evento_avisos.evento_avisos_id");
        $this->db->join("ubigeo_departamento","ubigeo_departamento.Codigo_Departamento= evento_avisos_ubigeo.codigo_departamento ");
        $this->db->join("ubigeo_provincia","ubigeo_provincia.Codigo_Departamento=evento_avisos_ubigeo.codigo_departamento and evento_avisos_ubigeo.codigo_provincia=ubigeo_provincia.Codigo_Provincia");
        $this->db->where("evento_avisos.evento_avisos_id", $this->avisos_ID);
        return $this->db->get();
    }
    public function regionesprovincias() {
        $this->db->select("eau.evento_avisos_id as 'ID',ud.nombre as 'Region', GROUP_CONCAT(up.nombre order by up.codigo_departamento,up.codigo_provincia SEPARATOR ', ') as 'Provincias'");
        $this->db->from("evento_avisos_ubigeo as eau, ubigeo_provincia as up,ubigeo_departamento as ud");
        $this->db->where("eau.codigo_departamento=up.codigo_departamento and eau.codigo_provincia=up.codigo_provincia and eau.codigo_departamento=ud.codigo_departamento");
        $this->db->where("eau.evento_avisos_id", $this->avisos_ID);
        $this->db->group_by("eau.evento_avisos_id ,ud.nombre");
        $this->db->order_by("eau.evento_avisos_id");
        return $this->db->get();
    }
    public function idEventoBySuperEventoId() {
        $this->db->select("Evento_Registro_Numero");
        $this->db->from("Super_Evento_Registro_Detalle");
        $this->db->where_in("super_evento_registro_ID", $this->Super_Evento_Registro_ID);
        return $this->db->get();
    }
        public function registrar() {
    $data = array(
            "Evento_Avisos_ID" => $this->id,
            "Codigo_Departamento" => $this->codigo_departamento,
            "Codigo_Provincia" => $this->codigo_provincia,
            "estado" => "1"
        );
        if($this->db->insert("evento_avisos_ubigeo", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_avisos_id",  $this->id);
        if ($this->db->delete('evento_avisos_ubigeo')) {
            return 1;
        }
        else {
            return 0;
        }
    }
}