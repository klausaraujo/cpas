<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class FarmaciaSalida_model extends CI_Model
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
    private $vencimiento;
    private $observacionArticulo;
    private $otrasactividadesdigerd;

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
    public function setObservacionArticulo($data){
        $this->observacionArticulo = $this->db->escape_str($data);
    }
    public function setCostoUnitario($data){
        $this->costoUnitario = $this->db->escape_str($data);
    }
    public function setCaja($data){
        $this->caja = $this->db->escape_str($data);
    }
    public function setCantidad($data){
        $this->cantidad = $this->db->escape_str($data);
    }
    public function setLote($data){
        $this->lote = $this->db->escape_str($data);
    }
    public function setVencimiento($data){
        $this->vencimiento = $this->db->escape_str($data);
    }
    public function setOtrasactividadesdigerd($data){
        $this->otrasactividadesdigerd = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerLista()
    {
        $this->db->select("td.descripcion tipo_desplazamiento, ia.nombre nombre_almacen, gi.*");
        $this->db->from("farmacia_guia_salida gi");
        $this->db->join("farmacia_tipo_desplazamiento td","td.idtipodesplazamiento=gi.idtipodesplazamiento");
        $this->db->join("farmacia_almacen ia","ia.idalmacen=gi.idalmacen");
        return $this->db->get();
    }
    public function obtenerGuia(){
        $this->db->select("ifnull(gi.numero_guia, 1) guia");
        $this->db->from("farmacia_guia_salida gi");
        $this->db->where("anio_ejecucion", $this->anio);
        $this->db->order_by("numero_guia DESC");
        $this->db->limit(1); 
        return $this->db->get();
    }
    public function obtenerDetalleSalida(){
        $this->db->select("laid.IdSalida idsalida,
        laid.idarticulo idarticuloregistro,
        laid.descripcion descripcion,
        laid.numero_lote Lote,
        laid.cantidad Cantidad,
        laid.fecha_vencimiento Vencimiento,
        laid.categoria Categoria,
        laid.presentacion Presentacion,
        laid.caja caja");
        $this->db->from("lista_articulos_farmacia_detalle_guia_salida laid");
        $this->db->where("laid.IdSalida", $this->idSalida);
        return $this->db->get();
    }
    public function eliminarDetalleSalida()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idsalida", $this->idSalida);
        $this->db->where("idarticuloregistro", $this->idArticulo);
        $error = array();
        if ($this->db->delete('farmacia_guia_salida_detalle'))
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
        if($this->otrasactividadesdigerd){
            $this->db->set("otrasactividadesdigerd", $this->otrasactividadesdigerd, TRUE);
        }
        $this->db->where("idsalida", $this->idSalida);

        $error = array();
        if ($this->db->update('farmacia_guia_salida'))
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
        
        if ($this->db->delete('farmacia_guia_salida_detalle'))
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
            "otrasactividadesdigerd" => $this->otrasactividadesdigerd,
            "estado" => 1
        );
        if($this->db->insert("farmacia_guia_salida", $data)) {
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
            "idarticulo" => $this->idArticulo,
            "observaciones" => $this->observacionArticulo,
            "costo_unitario" => $this->costoUnitario,
            "cantidad" => $this->cantidad,
            "numero_lote" => $this->lote,
            "fecha_vencimiento" => $this->vencimiento,
            "caja" => $this->caja,
            "estado" => 1
        );
        if($this->db->insert("farmacia_guia_salida_detalle", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function obtenerCabeceraReporte(){
        $this->db->select("g.idsalida as 'ID', IfNull(g.otrasactividadesdigerd,'') as 'otrasactividadesdigerd', g.anio_ejecucion as 'Anio', g.numero_guia as 'Numero', g.idtipodesplazamiento,d.descripcion as 'Tipo_Desplazamiento', g.idalmacen,a.nombre as 'Almacen',IfNull(g.id_renipress,0) as 'id_renipress', IfNull(r.nombre,'') as 'IPRESS', g.dni_receptor as 'DNI',g.nombre_receptor as 'Receptor', DATE_FORMAT(g.fecha_emision,'%d/%m/%Y') As 'Emision', DATE_FORMAT(g.fecha_salida,'%d/%m/%Y') As 'Salida', (case g.estado when '1' then 'Activo' When '2' Then 'Anulado' End) As 'Estado'");
        $this->db->from("farmacia_guia_salida g");
        $this->db->join("farmacia_tipo_desplazamiento d","g.idtipodesplazamiento = d.idtipodesplazamiento");
        $this->db->join("farmacia_almacen a","a.idalmacen=g.idalmacen");
        $this->db->join("renipress r","r.id_renipress=g.id_renipress","LEFT");
        $this->db->where("g.idsalida", $this->idSalida);
        return $this->db->get();
    }
    public function obtenerDetalleReporte(){
        $this->db->select("d.iddetalle,
        d.idsalida as ID,
        a.codigo_siga as siga,
        d.idarticulo idarticuloregistro,
        DATE_FORMAT(d.fecha_vencimiento,'%d/%m/%Y') fecha_vencimiento,
        d.caja caja,
        d.numero_lote numero_lote,
        a.descripcion as Articulo,
        m.descripcion as Presentacion,
        FORMAT(d.costo_unitario,2) as Costo,
        (d.cantidad * d.costo_unitario) as sub_total,
        d.cantidad as cantidad,
        d.costo_unitario as costo_unitario,
        IfNull(d.observaciones,'[N/A]') as 'Observaciones',
        (case a.estado when '1' then 'Operativo' when '2' then 'Inoperativo' end) as 'Condicion'");
        $this->db->from("farmacia_guia_salida_detalle d");
        $this->db->join("farmacia_articulo a","a.idarticulo = d.idarticulo");
        $this->db->join("farmacia_presentacion m","m.idpresentacion=a.idpresentacion");
        $this->db->where("d.idsalida", $this->idSalida);
        return $this->db->get();
    }
    public function obtenerAnioDetalle(){
        $this->db->select("ifnull(d.anio_nombre_principal, '') anio_nombre_principal, ifnull(d.anio_nombre_secundario, '') anio_nombre_secundario");
        $this->db->from("farmacia_guia_salida g");
        $this->db->join("evento_secuencia d","g.anio_ejecucion = d.anio");
        $this->db->where("g.idsalida", $this->idSalida);
        return $this->db->get();
    }
    public function guardarAdjunto(){
        if($this->adjunto){
            $this->db->set("ingreso_file", $this->adjunto, TRUE);
        }
        $this->db->set("usuario_actualizacion", $this->usuarioRegistro, TRUE);
        $this->db->where("idsalida", $this->idSalida);
        $error = array();
        if ($this->db->update('farmacia_guia_salida'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
}