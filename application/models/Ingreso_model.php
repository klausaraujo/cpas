<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Ingreso_model extends CI_Model
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
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerTipos()
    {
        $this->db->select("idtipoingreso id, descripcion");
        $this->db->from("inventarios_tipo_ingreso");
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
    public function obtenerLista()
    {
        $this->db->select("ti.descripcion tipo_ingreso, ia.nombre nombre_almacen, gi.*");
        $this->db->from("inventarios_guia_ingreso gi");
        $this->db->join("inventarios_tipo_ingreso ti","ti.idtipoingreso=gi.idtipoingreso");
        $this->db->join("inventarios_almacen ia","ia.idalmacen=gi.idalmacen");
        return $this->db->get();
    }
    public function obtenerDetalleLista()
    {
        $this->db->select("iar.idarticuloregistro, iar.estado estadoInventariado,lab.descripcion, lab.marca, lab.modelo, lab.clasificacion, iar.fecha_registro, iar.serie, iar.codigo_patrimonial_original, iar.codigo_patrimonial_actual, iar.condicion, lab.*");
        $this->db->from("inventarios_guia_ingreso_detalle iid");
        $this->db->join("inventarios_articulo_registro iar","iid.idarticuloregistro = iar.idarticuloregistro");
        $this->db->join("lista_articulos_busqueda lab","iar.idarticulo = lab.idarticulo");
        $this->db->where("iid.idingreso", $this->idIngreso);
        return $this->db->get();
    }
    public function obtenerGuia(){
        $this->db->select("ifnull(gi.numero_guia, 1) guia");
        $this->db->from("inventarios_guia_ingreso gi");
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
        if($this->db->insert("inventarios_guia_ingreso", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    
    public function anularIngreso()
    {
        $this->db->set("estado", 0, TRUE);
        $this->db->where("idingreso", $this->idIngreso);
        $error = array();
        if ($this->db->update('inventarios_guia_ingreso'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
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
        if ($this->db->delete('inventarios_guia_ingreso_detalle'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
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
            "operacion" => "I",
            "anio_ejecucion" => $this->anio,
            "numero_guia" => $this->idIngreso,
            "ubigeo" => $ubigeo,
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
            "idingreso" => $this->idIngreso,
            "idarticuloregistro" => $this->idArticulo,
            "estado" => 1
        );
        if($this->db->insert("inventarios_guia_ingreso_detalle", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }

    public function obtenerCabeceraReporte(){
        $this->db->select("g.idingreso as 'ID', g.anio_ejecucion as 'Anio', g.numero_guia as 'Numero', g.idtipoingreso,d.descripcion as 'Tipo_Ingreso', g.idalmacen,a.nombre as 'Almacen', DATE_FORMAT(g.fecha_emision,'%d/%m/%Y') As 'Emision', DATE_FORMAT(g.fecha_ingreso,'%d/%m/%Y') As 'ingreso', (case g.estado when '1' then 'Activo' When '2' Then 'Anulado' End) As 'Estado'");
        $this->db->from("inventarios_guia_ingreso g");
        $this->db->join("inventarios_tipo_ingreso d","g.idtipoingreso = d.idtipoingreso");
        $this->db->join("inventarios_almacen a","a.idalmacen=g.idalmacen");
        $this->db->where("g.idingreso", $this->idIngreso);
        return $this->db->get();
    }
    
    public function obtenerDetalleReporte(){
        $this->db->select("d.iddetalle,d.idingreso as 'ID',d.idarticuloregistro,IfNull(i.codigo_patrimonial_original,'[N/A]') as 'PAT01',IfNull(i.codigo_patrimonial_actual,'[N/A]') as 'PAT02',IfNull(i.serie,'[N/A]') as 'Serie',a.descripcion as 'Articulo',d.unidad as 'Cantidad',m.descripcion as 'Marca',a.modelo as 'Modelo',FORMAT(d.costo_unitario,2) as 'Costo',IfNull(d.observaciones,'[N/A]') as 'Observaciones',(case i.condicion when '1' then 'Operativo' when '2' then 'Inoperativo' end) as 'Condicion'");
        $this->db->from("inventarios_guia_ingreso_detalle d");
        $this->db->join("inventarios_articulo_registro i","i.idarticuloregistro=d.idarticuloregistro");
        $this->db->join("inventarios_articulo a","a.idarticulo = i.idarticulo");
        $this->db->join("inventarios_marca m","m.idmarca=a.idmarca");
        $this->db->where("d.idingreso", $this->idIngreso);
        return $this->db->get();
    }
    
    public function obtenerAnioDetalle(){
        $this->db->select("ifnull(d.anio_nombre_principal, '') anio_nombre_principal, ifnull(d.anio_nombre_secundario, '') anio_nombre_secundario");
        $this->db->from("inventarios_guia_ingreso g");
        $this->db->join("evento_secuencia d","g.anio_ejecucion = d.anio");
        $this->db->where("g.idingreso", $this->idIngreso);
        return $this->db->get();
    }
}