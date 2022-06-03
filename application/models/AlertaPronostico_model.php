<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class AlertaPronostico_model extends CI_Model
{
    private $id;
    private $titulo;
    private $descripcion_general;
    private $fuente;
    private $nivel_peligro;
    private $tipo_aviso;
    private $estado_alerta;
    private $fech_inicio;
    private $fech_fin;
    private $anioaviso;
    private $archivo;
    private $avisonumero;
    private $idaccion;
    private $departamento;
    private $ejecutora;
    private $lsaccion;
    private $fech_accion;
    private $descripcion_accion;
    private $num_sireed;
    private $anio_sireed;
    private $idrecomendacion;
    private $lsrecomendacion;
    private $descripcion_recomendacion;
    private $anio;
    private $mes;
    public function setId($data) {
        $this->id = $this->db->escape_str($data);
    }
    public function setTitulo($data) {
        $this->titulo = $this->db->escape_str($data);
    }
    public function setDescripcion_General($data) {
        $this->descripcion_general = $this->db->escape_str($data);
    }    
    public function setFuente($data) {
        $this->fuente = $this->db->escape_str($data);
    }
    public function setNivel_Peligro($data) {
        $this->nivel_peligro = $this->db->escape_str($data);
    }
    public function setTipo_Aviso($data) {
        $this->tipo_aviso = $this->db->escape_str($data);
    }
    public function setEstado_Alerta($data) {
        $this->estado_alerta = $this->db->escape_str($data);
    }
    public function setFech_Inicio($data) {
        $this->fech_inicio = $this->db->escape_str($data);
    }
    public function setFech_Fin($data) {
        $this->fech_fin = $this->db->escape_str($data);
    }    
    public function setAnioAviso($data) {
        $this->anioaviso = $this->db->escape_str($data);
    }  
    public function setEnlace_Url($data) {
        $this->enlace_url = $this->db->escape_str($data);
    }
    public function setEstado($data) {
        $this->estado = $this->db->escape_str($data);
    }
    public function setArchivo($data){ $this->archivo = $this->db->escape_str($data);}
    public function setImagenMapa($data){ $this->imagenmapa = $this->db->escape_str($data);}
    public function setAvisonumero($data){ $this->avisonumero = $this->db->escape_str($data); }
    public function setAnio($data){ $this->anio = $this->db->escape_str($data); }
    public function setMes($data){ $this->mes = $this->db->escape_str($data); }
    public function setIdAccion($data){ $this->idaccion = $this->db->escape_str($data);}
    public function setDepartamento($data){ $this->departamento = $this->db->escape_str($data);}
    public function setEjecutora($data){ $this->ejecutora = $this->db->escape_str($data);}
    public function setLsaccion($data){ $this->lsaccion = $this->db->escape_str($data);}
    public function setFechAccion($data){ $this->fech_accion = $this->db->escape_str($data);}
    public function setDescripcion_Accion($data){ $this->descripcion_accion = $this->db->escape_str($data);}
    public function setNum_Sireed($data){ $this->num_sireed = $this->db->escape_str($data);}
    public function setAnio_Sireed($data){ $this->anio_sireed = $this->db->escape_str($data);}
    public function setIdRecomendacion($data){ $this->idrecomendacion = $this->db->escape_str($data);}
    public function setLsrecomendacion($data){ $this->lsrecomendacion = $this->db->escape_str($data);}
    public function setDescripcion_Recomendacion($data){ $this->descripcion_recomendacion = $this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function listar()
    {
        $this->db->select("evento_avisos_numero, titulo,descripcion_general, DATE_FORMAT(fecha_inicio,'%d/%m/%Y %H:%i') fecha_inicio, DATE_FORMAT(fecha_fin,'%d/%m/%Y %H:%i') fecha_fin");
        $this->db->select("fuente, nivel_peligro, nivel_peligro nivel_peligro1, IF(tipo_aviso = 0,'METEOROLOGICO','HIDROLOGICO') tipo_aviso1, tipo_aviso, evento_avisos_id id, enlace_url, archivo_adjunto as archivo, archivo_mapa as imagenmapa, evento_avisos_anio");
        $this->db->from("evento_avisos");
        $this->db->where("YEAR(fecha_inicio)",$this->anio);
        $this->db->order_by("evento_avisos_numero", "DESC");
        return $this->db->get();
    }
    public function buscarmapa()
    {
        $this->db->select("evento_avisos_numero, titulo,descripcion_general, DATE_FORMAT(fecha_inicio,'%d/%m/%Y %H:%i') fecha_inicio, DATE_FORMAT(fecha_fin,'%d/%m/%Y %H:%i') fecha_fin");
        $this->db->select("fuente, nivel_peligro, tipo_aviso, evento_avisos_id id, enlace_url, archivo_adjunto as archivo, archivo_mapa as imagenmapa, evento_avisos_anio");
        $this->db->from("evento_avisos");
        $this->db->where("evento_avisos_id", $this->imagenmapa);
        return $this->db->get();
    }
    public function listaralerta()
    {
        $this->db->select("evento_avisos_numero, titulo, descripcion_general, archivo_mapa, DATE_FORMAT(fecha_inicio,'%d/%m/%Y %H:%i') fecha_inicio, DATE_FORMAT(fecha_fin,'%d/%m/%Y %H:%i') fecha_fin");
        $this->db->select("fuente, nivel_peligro, nivel_peligro nivel_peligro1, IF(tipo_aviso = 0,'METEOROLOGICO','HIDROLOGICO') tipo_aviso, evento_avisos_id id, enlace_url, archivo_adjunto as archivo, evento_avisos_anio");
        $this->db->from("evento_avisos");
        $this->db->where("sysdate() <= fecha_fin");
        $this->db->where("estado = 1");
        $this->db->order_by("evento_avisos_numero", "DESC");
        return $this->db->get();
    }
    public function crear() {
        $data = array(
            "evento_avisos_numero" => $this->avisonumero,
            "titulo" => $this->titulo,
            "descripcion_general" => $this->descripcion_general,
            "fuente" => $this->fuente,
            "nivel_peligro" => $this->nivel_peligro,
            "tipo_aviso" => $this->tipo_aviso,
            "fecha_inicio" => $this->fech_inicio,
            "fecha_fin" => $this->fech_fin,
            "evento_avisos_anio" => $this->anioaviso,
            "enlace_url" => $this->enlace_url,
            "fecha_registro" => date("Y-m-d H:i:s"),
            "usuario_registro" => $this->session->userdata("idusuario"),
            "estado" => "1"
        );
        if($this->db->insert("evento_avisos", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function crear2() {
        $data = array(
            "evento_avisos_numero" => $this->avisonumero,
            "titulo" => $this->titulo,
            "descripcion_general" => $this->descripcion_general,
            "fuente" => $this->fuente,
            "nivel_peligro" => $this->nivel_peligro,
            "tipo_aviso" => $this->tipo_aviso,
            "fecha_inicio" => $this->fech_inicio,
            "fecha_fin" => $this->fech_fin,
            "evento_avisos_anio" => $this->anioaviso,
            "enlace_url" => $this->enlace_url,
            "fecha_registro" => date("Y-m-d H:i:s"),
            "usuario_registro" => $this->session->userdata("idusuario"),
            "estado" => "1"
        );
        if($this->db->insert("evento_avisos", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function crearaccion() {
        $data = array(
            "evento_avisos_id" => $this->idaccion,
            "codigo_departamento" => $this->departamento,
            "codigo_renipress" => $this->ejecutora,
            "evento_avisos_tipo_accion_id" => $this->lsaccion,
            "evento_avisos_monitoreo_fecha" => $this->fech_accion,
            "evento_avisos_monitoreo_descripcion" => $this->descripcion_accion,
            "evento_avisos_monitoreo_sireed" => $this->num_sireed,
            "evento_avisos_monitoreo_sireed_anio" => $this->anio_sireed,
            "estado" => "1"
        );
        if($this->db->insert("evento_avisos_monitoreo", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function crearrecomendacion() {
        $data = array(
            "evento_avisos_id" => $this->idrecomendacion,
            "evento_avisos_direccion" => $this->lsrecomendacion,
            "evento_avisos_recomendacion" => $this->descripcion_recomendacion,
            "estado" => "1"
        );
        if($this->db->insert("evento_avisos_recomendaciones", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function archivoAlertaPronostico(){
        $this->db->select("archivo_adjunto");
        $this->db->from("evento_avisos");        
        $this->db->where("evento_avisos_id", $this->id);
        return $this->db->get();
    }
    public function editar() {
        $this->db->set("titulo", $this->titulo, TRUE);
        $this->db->set("descripcion_general", $this->descripcion_general, TRUE);
        $this->db->set("fuente", $this->fuente, TRUE);
        $this->db->set("nivel_peligro", $this->nivel_peligro, TRUE);
        $this->db->set("tipo_aviso", $this->tipo_aviso, TRUE);
        $this->db->set("fecha_inicio", $this->fech_inicio, TRUE);
        $this->db->set("fecha_fin", $this->fech_fin, TRUE);
        $this->db->set("evento_avisos_anio", $this->anioaviso, TRUE);
        $this->db->set("enlace_url", $this->enlace_url, TRUE);
        $this->db->set("archivo_adjunto", $this->archivo, TRUE);
        $this->db->set("usuario_actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("evento_avisos_id", $this->id);
        if ($this->db->update('evento_avisos')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("Super_Evento_Registro_ID", $this->id);
        
        if ($this->db->delete('super_evento_registro')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function getAvisoNumero()
    {
        $this->db->select("MAX(numero_aviso) numero_aviso");
        $this->db->from("evento_secuencia");
        $this->db->where("anio", date("Y"));
        $avisonumero = $this->db->get();
        $avisonumero = $avisonumero->row();
        $avisonumero = $avisonumero->numero_aviso;
        $incremento = $avisonumero + 1;
        $this->db->db_debug = FALSE;
        $this->db->set("numero_aviso", $incremento, TRUE);
        $this->db->where("anio", date("Y"));
        $this->db->update('evento_secuencia');
        return $avisonumero;
    }
    public function cambiarEstado()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->set("fecha_actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->set("usuario_actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_anulacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->set("usuario_anulacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->where("evento_avisos_id", $this->id);
        $error = array();
        if ($this->db->update('evento_avisos'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function cerrarAlerta()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->set("fecha_actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->set("usuario_actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_cierre", date("Y-m-d H:i:s"), TRUE);
        $this->db->set("usuario_cierre", $this->session->userdata("idusuario"), TRUE);        
        $this->db->where("evento_avisos_id", $this->id);
        $error = array();
        if ($this->db->update('evento_avisos'))
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
        $this->db->from("super_evento_registro");
        return $this->db->get();
    }
    public function agregarFoto()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("archivo_mapa", $this->imagenmapa, TRUE);
        $this->db->where("evento_avisos_id", $this->id);
        $error = array();
        if ($this->db->update('evento_avisos'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function listaEjecutoras() {
        $this->db->select("codigo_renipress, nombre, codigo_ue");
        $this->db->from("renipress");
        $this->db->where("codigo_region",$this->departamento);
        $this->db->where("codigo_ue>","0");
        $this->db->order_by("ubigeo", "ASC");
        return $this->db->get();
    }
    public function listarregiones() {
        $this->db->select("e.evento_avisos_id, e.codigo_departamento,u.nombre");
        $this->db->from("evento_avisos_ubigeo e, ubigeo u");
        $this->db->where("e.codigo_departamento=u.Codigo_Departamento");
        $this->db->where("u.Codigo_Provincia","00");
        $this->db->where("u.Codigo_Distrito","00");
        $this->db->where("e.evento_avisos_id",$this->id);
        $this->db->group_by("e.codigo_departamento");
        return $this->db->get();
    }
    public function listaAccionesAlertas() {
        $this->db->select("u.nombre as 'Region',r.nombre as 'IPRESS',eata.evento_avisos_tipo_accion_nombre as 'Tipo_Accion'");
        $this->db->select("eam.evento_avisos_monitoreo_fecha as 'Fecha'");
        $this->db->select("CONCAT_WS(' - ',eam.evento_avisos_monitoreo_sireed,eam.evento_avisos_monitoreo_sireed_anio) as 'Sireed', eam.evento_avisos_monitoreo_id ");
        $this->db->from("evento_avisos_monitoreo eam,renipress r,evento_avisos_tipo_accion eata,ubigeo u");
        $this->db->where("eam.codigo_departamento=u.codigo_departamento");
        $this->db->where("u.Codigo_Provincia","00");
        $this->db->where("u.Codigo_Distrito","00");
        $this->db->where("eam.codigo_renipress=r.codigo_renipress");
        $this->db->where("eam.evento_avisos_tipo_accion_id=eata.evento_avisos_tipo_accion_id");
        $this->db->where("eam.evento_avisos_id",$this->id);
        return $this->db->get();
    }
    public function listaRecomendacionesAlertas($type) {
        $this->db->select("IF(er.evento_avisos_direccion = 1,'LOS ESPACIOS DE MONITOREO','LOS ESTABLECIMIENTOS DE SALUD') iddireccion, er.evento_avisos_recomendacion descripcion, evento_avisos_recomndaciones_id");
        $this->db->from("evento_avisos_recomendaciones er");
        $this->db->where("er.evento_avisos_id",$this->id);
        $this->db->where("er.evento_avisos_direccion",$type);
        return $this->db->get();
    }
    public function listaRecomendacionesAlertasFront() {
        $this->db->select("IF(er.evento_avisos_direccion = 1,'LOS ESPACIOS DE MONITOREO','LOS ESTABLECIMIENTOS DE SALUD') iddireccion, er.evento_avisos_recomendacion descripcion, evento_avisos_recomndaciones_id");
        $this->db->from("evento_avisos_recomendaciones er");
        $this->db->where("er.evento_avisos_id",$this->id);
        return $this->db->get();
    }
    public function informealertas()
    {
        $this->db->select("evento_avisos_numero, titulo, descripcion_general, archivo_mapa, DATE_FORMAT(fecha_registro,'%d/%m/%Y %H:%i') fecha_registro, DATE_FORMAT(fecha_inicio,'%d/%m/%Y %H:%i') fecha_inicio, DATE_FORMAT(fecha_fin,'%d/%m/%Y %H:%i') fecha_fin");
        $this->db->select("fuente, nivel_peligro, IF(tipo_aviso = 0,'METEOROLOGICO','HIDROLOGICO') tipo_aviso1, tipo_aviso, evento_avisos_id id, enlace_url, archivo_adjunto as archivo, evento_avisos_anio, (TIMESTAMPDIFF(HOUR, fecha_inicio,fecha_fin)) horas");
        $this->db->from("evento_avisos");
        $this->db->where("evento_avisos_id",$this->id);
        return $this->db->get();
    }
    public function eliminarAccionAviso()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_avisos_monitoreo_id", $this->idaccion);
        $error = array();
        if ($this->db->delete('evento_avisos_monitoreo'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function eliminarRecomendacionAviso()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_avisos_recomndaciones_id", $this->idrecomendacion);
        $error = array();
        if ($this->db->delete('evento_avisos_recomendaciones'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
}