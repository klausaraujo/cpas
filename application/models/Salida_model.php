<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Salida_model extends CI_Model
{
    private $fechaEmision;
    private $anio;
    private $idAlmacen;
    private $observaciones;
    private $idrenipress;
    private $renipress;
    private $idInstitucion;
    private $nombreSalud;
    private $tipoSalud;
    private $clasificacionSalud;
    private $regionSalud;
    private $numeroDocumento;
    private $nombreReceptor;
    private $usuarioRegistro;
    private $idSalida;
    private $idArticulo;
    private $tipoDesplazamiento;
    private $adjunto;
    private $coordenadaIpress;
    private $correlativoSireed;
    private $eventoSireed;
    private $coordenadaSireed;
    private $ubigeoSireed;
    public function setCoordenadaIpress($data){
        $this->coordenadaIpress = $this->db->escape_str($data);
    }
    public function setCorrelativoSireed($data){
        $this->correlativoSireed = $this->db->escape_str($data);
    }
    public function setNumeroSireed($data){
        $this->eventoSireed = $this->db->escape_str($data);
    }
    public function setCoordenadaSireed($data){
        $this->coordenadaSireed = $this->db->escape_str($data);
    }
    public function setUbigeoSireed($data){
        $this->ubigeoSireed = $this->db->escape_str($data);
    }
    public function setFechaEmision($data){
        $this->fechaEmision = $this->db->escape_str($data);
    }
    public function setTipoDesplazamiento($data){
        $this->tipoDesplazamiento = $this->db->escape_str($data);
    }
    public function setAdjunto($data){
        $this->adjunto = $this->db->escape_str($data);
    }
    public function setIdSalida($data){
        $this->idSalida = $this->db->escape_str($data);
    }
    public function setIdArticulo($data){
        $this->idArticulo = $this->db->escape_str($data);
    }
    public function setAnio($data){
        $this->anio = $this->db->escape_str($data);
    }
    public function setAlmacen($data){
        $this->idAlmacen = $this->db->escape_str($data);
    }
    public function setObservaciones($data){
        $this->observaciones = $this->db->escape_str($data);
    }
    public function setIdrenipress($data){
        $this->idrenipress = $this->db->escape_str($data);
    }
    public function setRenipress($data){
        $this->renipress = $this->db->escape_str($data);
    }
    public function setInstitucion($data){
        $this->idInstitucion = $this->db->escape_str($data);
    }
    public function setNombreSalud($data){
        $this->nombreSalud = $this->db->escape_str($data);
    }
    public function setTipoSalud($data){
        $this->tipoSalud = $this->db->escape_str($data);
    }
    public function setClasificacionSalud($data){
        $this->clasificacionSalud = $this->db->escape_str($data);
    }
    public function setRegionSalud($data){
        $this->regionSalud = $this->db->escape_str($data);
    }
    public function setNumeroDocumento($data){
        $this->numeroDocumento = $this->db->escape_str($data);
    }
    public function setNombreReceptor($data){
        $this->nombreReceptor = $this->db->escape_str($data);
    }
    public function setUsuarioRegistro($data){
        $this->usuarioRegistro = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerLista()
    {
        $this->db->select("td.descripcion tipo_desplazamiento, ia.nombre nombre_almacen, gi.*");
        $this->db->from("inventarios_guia_salida gi");
        $this->db->join("inventarios_tipo_desplazamiento td","td.idtipodesplazamiento=gi.idtipodesplazamiento");
        $this->db->join("inventarios_almacen ia","ia.idalmacen=gi.idalmacen");
        return $this->db->get();
    }
    public function obtenerGuia(){
        $this->db->select("ifnull(gi.numero_guia, 1) guia");
        $this->db->from("inventarios_guia_salida gi");
        $this->db->where("anio_ejecucion", $this->anio);
        $this->db->order_by("numero_guia DESC");
        $this->db->limit(1); 
        return $this->db->get();
    }
    public function obtenerDetalleSalida(){
        $this->db->select("laid.IdSalida idsalida,
        laid.IDArticuloRegistro idarticuloregistro,
        laid.Articulo descripcion,
        laid.Marca marca,
        laid.Modelo modelo,
        laid.Serie serie,
        laid.PAT01 codigo_patrimonial_original,
        laid.PAT02 codigo_patrimonial_actual,
        laid.Almacen almacen,
        laid.Condicion condicion,
        laid.Estado estadoInventariado");
        $this->db->from("lista_articulos_inventariados_detalle_guia_salida laid");
        $this->db->where("laid.IdSalida", $this->idSalida);
        return $this->db->get();
    }
    public function eliminarDetalleSalida()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idsalida", $this->idSalida);
        $this->db->where("idarticuloregistro", $this->idArticulo);
        $error = array();
        if ($this->db->delete('inventarios_guia_salida_detalle'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function actualizarSalida()
    {
        $this->db->set("idtipodesplazamiento", $this->tipoDesplazamiento, TRUE);
        $this->db->set("observaciones", $this->observaciones, TRUE);
        $this->db->set("usuario_actualizacion", $this->usuarioRegistro, TRUE);
        if($this->idAlmacen){
            $this->db->set("idalmacen", $this->idAlmacen, TRUE);
        }
        if($this->numeroDocumento){
            $this->db->set("dni_receptor", $this->numeroDocumento, TRUE);
            $this->db->set("nombre_receptor", $this->nombreReceptor, TRUE);
        }
        if($this->idrenipress){
            $this->db->set("id_renipress", $this->idrenipress, TRUE);
        }
        if($this->coordenadaIpress){
            $this->db->set("coordenadas_ipress", $this->coordenadaIpress, TRUE);
        }
        if($this->eventoSireed){
            $this->db->set("numero_sireed", $this->eventoSireed, TRUE);
        }
        if($this->coordenadaSireed){
            $this->db->set("coordenadas_sireed", $this->coordenadaSireed, TRUE);
        }
        if($this->ubigeoSireed){
            $this->db->set("ubigeo_sireed", $this->ubigeoSireed, TRUE);
        }
        if($this->correlativoSireed){
            $this->db->set("correlativo_sireed", $this->correlativoSireed, TRUE);
        }
        $this->db->where("idsalida", $this->idSalida);
        $error = array();
        if ($this->db->update('inventarios_guia_salida'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminarArticuloSalida()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idsalida", $this->idSalida);
        
        $error = array();
        
        if ($this->db->delete('inventarios_guia_salida_detalle'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function guardarSalida()
    {
        $guia = $this->obtenerGuia()->row()? $this->obtenerGuia()->row()->guia : 0;
        $data = array(
            "anio_ejecucion" => $this->anio,
            "numero_guia" => ($guia + 1),
            "fecha_emision" => $this->fechaEmision,
            "idtipodesplazamiento" => $this->tipoDesplazamiento,
            "idalmacen" => $this->idAlmacen,
            "id_renipress" => $this->idrenipress,
            "dni_receptor" => $this->numeroDocumento,
            "nombre_receptor" => $this->nombreReceptor,
            "fecha_salida" => $this->fechaEmision,
            "observaciones" => $this->observaciones,
            "coordenadas_ipress" => $this->coordenadaIpress,
            "numero_sireed" => $this->eventoSireed,
            "coordenadas_sireed" => $this->coordenadaSireed,
            "ubigeo_sireed" => $this->ubigeoSireed,
            "correlativo_sireed" => $this->correlativoSireed,
            "usuario_registro" => $this->usuarioRegistro,
            "estado" => 1
        );
        if($this->db->insert("inventarios_guia_salida", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function obtenerUbigeoAlmacen(){
        $this->db->select("ifnull(ia.ubigeo, '') ubigeo");
        $this->db->from("inventarios_almacen ia");
        $this->db->where("idalmacen", $this->idAlmacen);
        return $this->db->get();
    }
    public function guardarUbicacion()
    {
        $result = $this->obtenerUbigeoAlmacen();
        $ubigeo = $result->row()? $result->row()->ubigeo : 0;
        
        $data = array(
            "idarticuloregistro" => $this->idArticulo,
            "operacion" => "S",
            "anio_ejecucion" => $this->anio,
            "coordenadas" => $this->coordenadaSireed,
            "numero_guia" => $this->idSalida,
            "ubigeo" => $this->ubigeoSireed,
            "estado" => 1
        );
        if($this->db->insert("inventarios_articulo_ubicacion", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function guardarDetalle()
    {
        $data = array(
            "idsalida" => $this->idSalida,
            "idarticuloregistro" => $this->idArticulo,
            "estado" => 1
        );
        if($this->db->insert("inventarios_guia_salida_detalle", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function obtenerCabeceraReporte(){
        $this->db->select("g.idsalida as 'ID', g.anio_ejecucion as 'Anio', g.numero_guia as 'Numero', g.idtipodesplazamiento,d.descripcion as 'Tipo_Desplazamiento', g.idalmacen,a.nombre as 'Almacen',IfNull(g.id_renipress,0) as 'id_renipress', IfNull(r.nombre,'') as 'IPRESS', g.dni_receptor as 'DNI',g.nombre_receptor as 'Receptor', DATE_FORMAT(g.fecha_emision,'%d/%m/%Y') As 'Emision', DATE_FORMAT(g.fecha_salida,'%d/%m/%Y') As 'Salida', (case g.estado when '1' then 'Activo' When '2' Then 'Anulado' End) As 'Estado'");
        $this->db->from("inventarios_guia_salida g");
        $this->db->join("inventarios_tipo_desplazamiento d","g.idtipodesplazamiento = d.idtipodesplazamiento");
        $this->db->join("inventarios_almacen a","a.idalmacen=g.idalmacen");
        $this->db->join("renipress r","r.id_renipress=g.id_renipress","LEFT");
        $this->db->where("g.idsalida", $this->idSalida);
        return $this->db->get();
    }
    public function obtenerDetalleReporte(){
        $this->db->select("d.iddetalle,d.idsalida as 'ID',d.idarticuloregistro,IfNull(i.codigo_patrimonial_original,'[N/A]') as 'PAT01',IfNull(i.codigo_patrimonial_actual,'[N/A]') as 'PAT02',IfNull(i.serie,'[N/A]') as 'Serie',a.descripcion as 'Articulo',d.unidad * -1 as 'Cantidad',m.descripcion as 'Marca',a.modelo as 'Modelo',FORMAT(d.costo_unitario,2) as 'Costo',IfNull(d.observaciones,'[N/A]') as 'Observaciones',(case i.condicion when '1' then 'Operativo' when '2' then 'Inoperativo' end) as 'Condicion'");
        $this->db->from("inventarios_guia_salida_detalle d");
        $this->db->join("inventarios_articulo_registro i","i.idarticuloregistro=d.idarticuloregistro");
        $this->db->join("inventarios_articulo a","a.idarticulo = i.idarticulo");
        $this->db->join("inventarios_marca m","m.idmarca=a.idmarca");
        $this->db->where("d.idsalida", $this->idSalida);
        return $this->db->get();
    }
    public function obtenerAnioDetalle(){
        $this->db->select("ifnull(d.anio_nombre_principal, '') anio_nombre_principal, ifnull(d.anio_nombre_secundario, '') anio_nombre_secundario");
        $this->db->from("inventarios_guia_salida g");
        $this->db->join("evento_secuencia d","g.anio_ejecucion = d.anio");
        $this->db->where("g.idsalida", $this->idSalida);
        return $this->db->get();
    }
    public function guardarAdjunto(){
        if($this->adjunto){
            $this->db->set("salida_file", $this->adjunto, TRUE);
        }
        $this->db->set("usuario_actualizacion", $this->usuarioRegistro, TRUE);
        $this->db->where("idsalida", $this->idSalida);
        $error = array();
        if ($this->db->update('inventarios_guia_salida'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }  

    public function anularIngreso()
    {
        $this->db->set("estado", 0, TRUE);
        $this->db->where("idsalida", $this->idSalida);
        $error = array();
        if ($this->db->update('inventarios_guia_salida'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
}