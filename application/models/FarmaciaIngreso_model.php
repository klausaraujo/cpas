<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class FarmaciaIngreso_model extends CI_Model
{
    private $idIngreso;   
    private $anio;   
    private $fechaEmision;
    private $tipoIngreso;
    private $idAlmacen;
    private $observaciones;
    private $usuario;
    private $fichaTecnica;
    private $idArticulo;
    public function setFechaEmision($data){
        $this->fechaEmision = $this->db->escape_str($data);
    }
    public function setIdArticulo($data){
        $this->idArticulo = $this->db->escape_str($data);
    }
    public function setAnio($data){
        $this->anio = $this->db->escape_str($data);
    }
    public function setTipoIngreso($data){
        $this->tipoIngreso = $this->db->escape_str($data);
    }
    public function setAlmacen($data){
        $this->idAlmacen = $this->db->escape_str($data);
    }
    public function setIngreso($data){
        $this->idIngreso = $this->db->escape_str($data);
    }
    public function setObservaciones($data){
        $this->observaciones = $this->db->escape_str($data);
    }
    public function setUsuarioRegistro($data){
        $this->usuario = $this->db->escape_str($data);
    }
    public function setFichaTecnica($data){
        $this->fichaTecnica = $this->db->escape_str($data);
    }
    public function setObservacionArticulo($data){
        $this->observacionArticulo = $this->db->escape_str($data);
    }
    public function setCostoUnitario($data){
        $this->costoUnitario = $this->db->escape_str($data);
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

    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerTipos()
    {
        $this->db->select("idtipoingreso id, descripcion");
        $this->db->from("farmacia_tipo_ingreso");
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
    public function obtenerLista()
    {
        $this->db->select("ti.descripcion tipo_ingreso, ia.nombre nombre_almacen, gi.*");
        $this->db->from("farmacia_guia_ingreso gi");
        $this->db->join("farmacia_tipo_ingreso ti","ti.idtipoingreso=gi.idtipoingreso");
        $this->db->join("farmacia_almacen ia","ia.idalmacen=gi.idalmacen");
        return $this->db->get();
    }
    public function obtenerDetalleLista()
    {
        $this->db->select("fid.idarticulo idarticuloregistro, iar.descripcion descripcion, fid.numero_lote lote, fid.cantidad cantidad, DATE_FORMAT(fid.fecha_vencimiento,'%d/%m/%Y') as vencimiento, fid.costo_unitario costo_unitario, iar.categoria categoria, iar.presentacion presentacion");
        $this->db->from("farmacia_guia_ingreso_detalle fid");
        $this->db->join("lista_articulos_busqueda_farmacia iar","fid.idarticulo = iar.idarticulo");
        $this->db->where("fid.idingreso", $this->idIngreso);
        return $this->db->get();
    }
    public function obtenerGuia(){
        $this->db->select("ifnull(gi.numero_guia, 1) guia");
        $this->db->from("farmacia_guia_ingreso gi");
        $this->db->where("anio_ejecucion", $this->anio);
        $this->db->order_by("numero_guia DESC");
        $this->db->limit(1); 
        return $this->db->get();
    }
    public function guardarIngreso()
    {
        $guia = $this->obtenerGuia()->row()? $this->obtenerGuia()->row()->guia : 0;
        $data = array(
            "anio_ejecucion" => $this->anio,
            "numero_guia" => ($guia + 1),
            "fecha_emision" => $this->fechaEmision,
            "idtipoingreso" => $this->tipoIngreso,
            "idalmacen" => $this->idAlmacen,
            "fecha_ingreso" => $this->fechaEmision,
            "observaciones" => $this->observaciones,
            "ingreso_file" => $this->fichaTecnica,
            "usuario_registro" => $this->usuario,
            "estado" => 1
        );
        if($this->db->insert("farmacia_guia_ingreso", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function actualizarIngreso()
    {
        $this->db->set("idtipoingreso", $this->tipoIngreso, TRUE);
        $this->db->set("observaciones", $this->observaciones, TRUE);
        if($this->fichaTecnica){
            $this->db->set("ingreso_file", $this->fichaTecnica, TRUE);
        }
        if($this->idAlmacen){
            $this->db->set("idalmacen", $this->idAlmacen, TRUE);
        }
        $this->db->where("idingreso", $this->idIngreso);
        $error = array();
        if ($this->db->update('inventarios_guia_ingreso'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminarDetalleIngreso()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idingreso", $this->idIngreso);
        $error = array();
        if ($this->db->delete('farmacia_guia_ingreso_detalle'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function guardarDetalle()
    {
        $data = array(
            "idingreso" => $this->idIngreso,
            "idarticulo" => $this->idArticulo,
            "observaciones" => $this->observacionArticulo,
            "costo_unitario" => $this->costoUnitario,
            "cantidad" => $this->cantidad,
            "numero_lote" => $this->lote,
            "fecha_vencimiento" => $this->vencimiento,
            "estado" => 1
        );
        if($this->db->insert("farmacia_guia_ingreso_detalle", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
}