<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class FarmaciaArticulo_model extends CI_Model
{
    private $idArticulo;
    private $idAlmacen;
    private $idArticuloRegistro;
    private $descripcion;
    private $idMarca;
    private $modelo;
    private $dimensiones;
    private $peso;
    private $idColor;
    private $idClasificacion;
    private $imagen;
    private $medida;
    private $ficha;
    private $usuarioRegistro;
    private $estado;
    private $serie;
    private $codigoPatrimonialOriginal;
    private $codigoPatrimonialActual;
    private $fechaRegistro;
    private $siga;
    private $condicion;
    private $idcategoria;
    private $idviaadministracion;
    private $idpresentacion;
    private $cantmin;
    private $cantmax;
    private $porcstock;
    private $indstock;
    private $vencimientoinicial;
    private $vencimientofinal;
    private $almacen;


    public function setSiga($data){
        $this->siga = $this->db->escape_str($data);
    }
    public function setIdCategoria($data){
        $this->idcategoria = $this->db->escape_str($data);
    }
    public function setIdAdministracion($data){
        $this->idviaadministracion = $this->db->escape_str($data);
    }
    public function setIdPresentacion($data){
        $this->idpresentacion = $this->db->escape_str($data);
    }
    public function setSerie($data){
        $this->serie = $this->db->escape_str($data);
    }
    public function setCodigoPatrimonialOriginal($data){
        $this->codigoPatrimonialOriginal = $this->db->escape_str($data);
    }
    public function setCodigoPatrimonialActual($data){
        $this->codigoPatrimonialActual = $this->db->escape_str($data);
    }
    public function setFechaRegistro($data){
        $this->fechaRegistro = $this->db->escape_str($data);
    }
    public function setCondicion($data){
        $this->condicion = $this->db->escape_str($data);
    }
    public function setId($data){
        $this->idArticulo= $this->db->escape_str($data);
    }
    public function setIdAlmacen($data){
        $this->idAlmacen= $this->db->escape_str($data);
    }
    public function setIdArticuloRegistro($data){
        $this->idArticuloRegistro= $this->db->escape_str($data);
    }
    public function setDescripcion($data){
        $this->descripcion = $this->db->escape_str($data);
    }
    public function setIdMarca($data){
        $this->idMarca = $this->db->escape_str($data);
    }
    public function setModelo($data){
        $this->modelo = $this->db->escape_str($data);
    }
    public function setDimensiones($data){
        $this->dimensiones = $this->db->escape_str($data);
    }
    public function setPeso($data){
        $this->peso = $this->db->escape_str($data);
    }
    public function setIdColor($data){
        $this->idColor = $this->db->escape_str($data);
    }
    public function setIdClasificacion($data){
        $this->idClasificacion = $this->db->escape_str($data);
    }
    public function setImagen($data){
        $this->imagen = $this->db->escape_str($data);
    }
    public function setMedida($data){
        $this->medida = $this->db->escape_str($data);
    }
    public function setFichaTecnica($data){
        $this->ficha = $this->db->escape_str($data);
    }
    public function setUsuarioRegistro($data){
        $this->usuarioRegistro = $this->db->escape_str($data);
    }
    public function setEstado($data){
        $this->estado = $this->db->escape_str($data);
    }
    public function setCantmin($data){
        $this->cantmin = $this->db->escape_str($data);
    }
    public function setCantmax($data){
        $this->cantmax = $this->db->escape_str($data);
    }
    public function setPorcstock($data){
        $this->porcstock = $this->db->escape_str($data);
    }
    public function setIndstock($data){
        $this->indstock = $this->db->escape_str($data);
    }
    public function setVencimientoinicial($data){
        $this->vencimientoinicial = $this->db->escape_str($data);
    }
    public function setVencimientofinal($data){
        $this->vencimientofinal = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerArticulos()
    {
        $this->db->select("art.*, cat.descripcion categoria, pr.descripcion presentacion, fav.descripcion administracion");
        $this->db->select("cat.idcategoria idcategoria, pr.idpresentacion idpresentacion, fav.idviaadministracion idviaadministracion ");
        $this->db->from("farmacia_articulo art");
        $this->db->join("farmacia_categoria cat","cat.idcategoria=art.idcategoria");
        $this->db->join("farmacia_presentacion pr","pr.idpresentacion=art.idpresentacion");
        $this->db->join("farmacia_via_administracion fav","fav.idviaadministracion=pr.idviaadministracion");
        $this->db->order_by("art.descripcion ASC");
        return $this->db->get();
    }
    public function guardarArticulo()
    {
        $data = array(
            "descripcion" => $this->descripcion,
            "codigo_siga" => $this->siga,
            "idcategoria" => $this->idcategoria,
            "idpresentacion" => $this->idpresentacion,
            "idunidadmedida" => $this->medida,
            "ficha" => $this->ficha,
            "usuario_registro" => $this->usuarioRegistro,
            "usuario_actualizacion" => $this->usuarioRegistro,
            "estado" => $this->estado,
            "cantmin" => $this->cantmin,
            "cantmax" => $this->cantmax,
            "porcstock" => $this->porcstock,
            "imagen" => $this->imagen
        );

        if($this->db->insert("farmacia_articulo", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function obtenerStockPorArticulo()
    {
        $this->db->select("idarticulo, codigo_siga as 'SIGA',descripcion as 'Articulo',categoria as 'Categoria',numero_lote as 'Lote',fecha_vencimiento as 'Expira',sum(cantidad) as 'Stock',almacen as 'Ubicacion'");
        $this->db->from("lista_articulos_farmacia_busqueda_dashboard");
        $this->db->where("idarticulo", $this->idArticulo);
        $this->db->group_by("codigo_siga,descripcion,categoria,numero_lote,fecha_vencimiento");
        $this->db->having("sum(cantidad)>0");
        return $this->db->get();
    }
    public function actualizarArticulo()
    {
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("codigo_siga", $this->siga, TRUE);
        $this->db->set("idcategoria", $this->idcategoria, TRUE);
        $this->db->set("idunidadmedida", $this->medida, TRUE);
        $this->db->set("idpresentacion", $this->idpresentacion, TRUE);
        $this->db->set("cantmin", $this->cantmin, TRUE);
        $this->db->set("cantmax", $this->cantmax, TRUE);
        $this->db->set("porcstock", $this->porcstock, TRUE);
        if($this->imagen){
            $this->db->set("imagen", $this->imagen, TRUE);
        }
        if($this->ficha){
            $this->db->set("ficha", $this->ficha, TRUE);
        }
        $this->db->set("usuario_actualizacion", $this->usuarioRegistro, TRUE);
        $this->db->set("estado", $this->estado, TRUE);

        $this->db->where("idarticulo", $this->idArticulo);

        $error = array();

        if ($this->db->update('farmacia_articulo'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function obtenerTotalArticulosDashboard(){
        $this->db->select("IFNULL(sum(cantidad), 0) total");
        $this->db->from("lista_articulos_farmacias_busqueda_dashboard_new");
        if($this->idcategoria > 0){
            $this->db->where("IdCategoria", $this->idcategoria);
        }
        return $this->db->get();
    }
    public function obtenerArticulosDashboard(){
        $this->db->select("*");
        $this->db->from("lista_articulos_farmacias_busqueda_dashboard_new");
        if($this->idcategoria > 0){
            $this->db->where("IdCategoria", $this->idcategoria);
        }
        $this->db->order_by("Articulo ASC");
        return $this->db->get();
    }
    public function obtenerArticulosInventariado()
    {
        $this->db->select("iar.idarticulo idarticuloregistro,iar.*");
        $this->db->from("lista_articulos_busqueda_farmacia iar");
        $this->db->order_by("iar.descripcion ASC");
        return $this->db->get();
    }

    public function obtenerArticulosSalida()
    {
        $this->db->select("laf.ID idarticuloregistro, laf.Estado estadoInventariado, laf.Articulo descripcion");
        $this->db->select("laf.*"); 
        $this->db->from("lista_articulos_farmacia_busqueda laf");
        $this->db->where("laf.idalmacen", $this->idAlmacen);
        $this->db->order_by("laf.Articulo ASC");
        return $this->db->get();
    }
    public function obtenerReporteGeneral(){
        $this->db->select("lafi.ID,lafi.SIGA,lafi.Articulo,lafi.Categoria,lafi.Presentacion,lafi.Via,lafi.Und_Med,lafi.Lote,lafi.Vencimiento,lafi.Stock,lafi.Almacen,lafi.Estado");
        $this->db->from("lista_articulos_farmacia_inventario_final lafi");
        if($this->idcategoria > 0){
            $this->db->where("IdCategoria", $this->idcategoria);
        }
        if($this->idviaadministracion > 0){
            $this->db->where("IdViaAdministracion", $this->idviaadministracion);
        }
        if($this->idpresentacion > 0){
            $this->db->where("IdPresentacion", $this->idpresentacion);
        }
        if($this->estado > 0){
            $this->db->where("IdEstado", $this->estado);
        }
        if($this->indstock == '1'){
            $this->db->where("lafi.Stock > 0");
        }
        if($this->indstock == '2'){
            $this->db->where("lafi.Stock <= 0");
        }
        if($this->vencimientoinicial > 0 and $this->vencimientofinal > 0){
            $this->db->where('lafi.Vencimiento >=', $this->vencimientoinicial);
            $this->db->where('lafi.Vencimiento <=', $this->vencimientofinal);
        }
        if($this->idAlmacen > 0){
            $this->db->where("lafi.IdAlmacen", $this->idAlmacen);
        }
        return $this->db->get();
    }
    public function obtenerDisponibilidad(){
        $this->db->select("codigo_siga as 'SIGA',descripcion as 'Articulo',categoria as 'Categoria',numero_lote as 'Lote',fecha_vencimiento as 'Expira',sum(cantidad) as 'Stock',almacen as 'Ubicacion'");
        $this->db->from("lista_articulos_farmacia_busqueda_dashboard");
        $this->db->group_by("codigo_siga,descripcion,categoria,numero_lote,fecha_vencimiento");
        $this->db->having("sum(cantidad)>0");
        return $this->db->get();
    }
}