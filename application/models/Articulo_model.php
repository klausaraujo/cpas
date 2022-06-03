<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Articulo_model extends CI_Model
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
    private $costoInicial;
    private $ordenCompra;
    private $numPecosa;
    private $codigoSbn;
    private $tipoPresupuesto;
    private $observacion;
    private $caracteristica;
    private $estadoSubItems;
    private $idPadre;
    private $idHijo;
    private $fecCompra;
    private $anioFabricacion;
    private $codDigerd;
    private $idRegion;
    private $tipoHospital;
    private $valor;

    public function setFecCompra($data){
        $this->fecCompra = $this->db->escape_str($data);
    }
    public function setIdRegion($data){
        $this->idRegion = $this->db->escape_str($data);
    }
    public function setAnioFabricacion($data){
        $this->anioFabricacion = $this->db->escape_str($data);
    }
    public function setCodigoDigerd($data){
        $this->codDigerd = $this->db->escape_str($data);
    }
    public function setIdPadre($data){
        $this->idPadre = $this->db->escape_str($data);
    }
    public function setIdHijo($data){
        $this->idHijo = $this->db->escape_str($data);
    }
    public function setCostoInicial($data){
        $this->costoInicial = $this->db->escape_str($data);
    }
    public function setOrdenCompra($data){
        $this->ordenCompra = $this->db->escape_str($data);
    }
    public function setNumPecosa($data){
        $this->numPecosa = $this->db->escape_str($data);
    }
    public function setCodigoSbn($data){
        $this->codigoSbn = $this->db->escape_str($data);
    }
    public function setTipoPresupuesto($data){
        $this->tipoPresupuesto = $this->db->escape_str($data);
    }
    public function setObservacion($data){
        $this->observacion = $this->db->escape_str($data);
    }
    public function setCaracteristica($data){
        $this->caracteristica = $this->db->escape_str($data);
    }
    public function setEstadoSubItems($data){
        $this->estadoSubItems = $this->db->escape_str($data);
    }
    public function setSiga($data){
        $this->siga = $this->db->escape_str($data);
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
    public function setTipoHospital($data){
        $this->tipoHospital = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerArticulos()
    {
        $this->db->select("art.idarticulo,art.descripcion,art.idmarca,marca.descripcion marca,art.modelo, art.codigo_siga");
        $this->db->select("art.dimensiones,art.peso,art.idcolor,art.idclasificacion,clasi.descripcion clasificacion,art.imagen");
        $this->db->select("art.ficha,art.fecha_registro,art.usuario_registro,art.fecha_actualizacion,art.usuario_actualizacion,art.estado, art.idunidadmedida");
        $this->db->from("inventarios_articulo art");
        $this->db->join("inventarios_marca marca","marca.idmarca=art.idmarca");
        $this->db->join("inventarios_clasificacion clasi","clasi.idclasificacion=art.idclasificacion");
        $this->db->order_by("art.descripcion ASC");
        return $this->db->get();
    }
    public function obtenerArticulosSalida()
    {
        $this->db->select("ID idarticuloregistro, Estado estadoInventariado, Articulo descripcion");
        $this->db->select("Marca marca, Modelo modelo,Serie serie, PAT01 codigo_patrimonial_original"); 
        $this->db->select("PAT02 codigo_patrimonial_actual, Almacen almacen, Cantidad cantidad, Condicion condicion");
        $this->db->from("lista_articulos_inventariados_busqueda");
        $this->db->where("IDA", $this->idAlmacen);
        $this->db->order_by("Articulo ASC");
        return $this->db->get();
    }
    public function obtenerArticulosDashboard()
    {
        $this->db->select("*");
        $this->db->from("lista_articulos_inventariados_busqueda_dashboard_new");
        if($this->idClasificacion > 0){
            $this->db->where("idclasificacion", $this->idClasificacion);
        }
        $this->db->order_by("Articulo ASC");
        return $this->db->get();
    }

    public function obtenerUbicacion()
    {
        $this->db->select("*");
        if($this->idRegion){
            $this->db->where("Codigo_Departamento", $this->idRegion);
        }
        $this->db->from("lista_articulos_ubicacion");
        return $this->db->get();
    }

    public function obtenerStockPorArticulo()
    {
        $this->db->select("ID, Articulo,Marca,Modelo,Serie,PAT01,PAT02,Condicion,Clasificacion,Almacen as 'Ubicación'");
        $this->db->from("lista_articulos_inventariados_busqueda_dashboard");
        $this->db->where("IdArticulo", $this->idArticulo);
        $this->db->where("Cantidad > 0");
        $this->db->order_by("Articulo ASC");
        return $this->db->get();
    }
    public function obtenerTotalArticulosDashboard()
    {
        $this->db->select("IFNULL(sum(cantidad), 0) total");
        $this->db->from("lista_articulos_inventariados_busqueda_dashboard_new");
        if($this->idClasificacion > 0){
            $this->db->where("idclasificacion", $this->idClasificacion);
        }
        return $this->db->get();
    }
    public function obtenerArticulosInventariado()
    {
        $this->db->select("iar.idarticuloregistro, iar.estado estadoInventariado,lab.descripcion, lab.marca, lab.modelo, lab.clasificacion, iar.fecha_registro fecha_registro_articulo, iar.serie, iar.codigo_patrimonial_original, iar.codigo_patrimonial_actual, iar.condicion");
        $this->db->select("iar.costo_inicial,iar.orden,iar.pecosa,iar.codigo_activo,iar.clasificador,iar.observaciones,iar.caracteristicas,iar.subcomponentes,iar.fecha_compra, iar.anio_fabricacion, iar.codigo_digerd, lai.Serie serie_vista, lai.SBN sbn_vista, lai.Clasificador clasificador_vista, ith.descripcion tipohospital, iar.idtipohospital,lab.*");
        $this->db->from("inventarios_articulo_registro iar");
        $this->db->join("lista_articulos_busqueda lab","iar.idarticulo = lab.idarticulo");
        $this->db->join("lista_articulos_inventariados lai","lai.IdInventario = iar.idarticuloregistro");
        $this->db->join("inventarios_tipo_hospital ith","ith.idtipohospital = iar.idtipohospital","left");
        $this->db->order_by("lab.descripcion ASC");
        return $this->db->get();
    }
    public function obtenerArticulosComponentes()
    {
        $this->db->select("iar.idarticuloregistro, iar.estado estadoInventariado,lab.descripcion, lab.marca, lab.modelo, lab.clasificacion, iar.fecha_registro fecha_registro_articulo, iar.serie, iar.codigo_patrimonial_original, iar.codigo_patrimonial_actual, iar.condicion, iar.subcomponentes");
        $this->db->select("iar.costo_inicial,iar.orden,iar.pecosa,iar.codigo_activo,iar.clasificador,iar.observaciones,iar.caracteristicas,iar.subcomponentes, lab.*");
        $this->db->from("inventarios_articulo_registro iar");
        $this->db->join("lista_articulos_busqueda lab","iar.idarticulo = lab.idarticulo");
        $this->db->where("iar.subcomponentes", 1);
        $this->db->order_by("lab.descripcion ASC");
        return $this->db->get();
    }
    public function obtenerArticulosBusqueda()
    {
        $this->db->select("*");
        $this->db->from("lista_articulos_busqueda");
        return $this->db->get();
    }
    public function obtenerDependenciaComponente()
    {
        $this->db->select("iar.idarticuloregistro, iar.estado estadoInventariado,lab.descripcion, lab.marca, lab.modelo, lab.clasificacion, iar.fecha_registro fecha_registro_articulo, iar.serie, iar.codigo_patrimonial_original, iar.codigo_patrimonial_actual, iar.condicion, iar.subcomponentes, iar.idarticuloprincipal");
        $this->db->select("iar.costo_inicial,iar.orden,iar.pecosa,iar.codigo_activo,iar.clasificador,iar.observaciones,iar.caracteristicas,iar.subcomponentes, lab.*");
        $this->db->from("inventarios_articulo_registro iar");
        $this->db->join("lista_articulos_busqueda lab","iar.idarticulo = lab.idarticulo");
        $this->db->where("iar.subcomponentes", 0);
        if($this->idArticuloRegistro){
            $this->db->where("iar.idarticuloprincipal", $this->idArticuloRegistro);
        } else {
            $this->db->where("iar.idarticuloprincipal", 0);
        }
        $this->db->order_by("lab.descripcion ASC");
        return $this->db->get();
    }
    public function guardarArticulo()
    {
        $data = array(
            "descripcion" => $this->descripcion,
            "codigo_siga" => $this->siga,
            "idmarca" => $this->idMarca,
            "modelo" => $this->modelo,
            "dimensiones" => $this->dimensiones,
            "peso" => $this->peso,
            "idcolor" => $this->idColor,
            "idclasificacion" => $this->idClasificacion,
            "imagen" => $this->imagen,
            "idunidadmedida" => $this->medida,
            "ficha" => $this->ficha,
            "observaciones" => $this->observacion,
            "usuario_registro" => $this->usuarioRegistro,
            "usuario_actualizacion" => $this->usuarioRegistro,
            "estado" => $this->estado,
        );
        if($this->db->insert("inventarios_articulo", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function actualizarArticulo()
    {
        $this->db->set("descripcion", $this->descripcion, TRUE);
        $this->db->set("idmarca", $this->idMarca, TRUE);
        $this->db->set("codigo_siga", $this->siga, TRUE);
        $this->db->set("modelo", $this->modelo, TRUE);
        $this->db->set("dimensiones", $this->dimensiones, TRUE);
        $this->db->set("peso", $this->peso, TRUE);
        $this->db->set("idcolor", $this->idColor, TRUE);
        $this->db->set("idclasificacion", $this->idClasificacion, TRUE);
        $this->db->set("observaciones", $this->observacion, TRUE);
        if($this->imagen){
            $this->db->set("imagen", $this->imagen, TRUE);
        }
        if($this->ficha){
            $this->db->set("ficha", $this->ficha, TRUE);
        }
        $this->db->set("idunidadmedida", $this->medida, TRUE);
        $this->db->set("usuario_actualizacion", $this->usuarioRegistro, TRUE);
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->where("idarticulo", $this->idArticulo);
        $error = array();
        if ($this->db->update('inventarios_articulo'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function guardarArticuloInventariado()
    {
        if($this->estadoSubItems == 0){
            $valor = 0;
        }
        else 
            {$valor = null;
        }
        $data = array(
            "idarticulo" => $this->idArticulo,
            "serie" => $this->serie,
            "codigo_patrimonial_original" => $this->codigoPatrimonialOriginal,
            "codigo_patrimonial_actual" => $this->codigoPatrimonialActual,
            "fecha_registro" => $this->fechaRegistro,
            "condicion" => $this->condicion,
            "usuario_registro" => $this->usuarioRegistro,
            "estado" => $this->estado,
            "costo_inicial" => $this->costoInicial,
            "orden" => $this->ordenCompra,
            "pecosa" => $this->numPecosa,
            "codigo_activo" => $this->codigoSbn,
            "clasificador" => $this->tipoPresupuesto,
            "observaciones" => $this->observacion,
            "caracteristicas" => $this->caracteristica,
            "fecha_compra" => $this->fecCompra,
            "anio_fabricacion" => $this->anioFabricacion,
            "codigo_digerd" => $this->codDigerd,
            "subcomponentes" => $this->estadoSubItems,
            "idarticuloprincipal" => $valor,
            "idtipohospital" => $this->tipoHospital
        );
        if($this->db->insert("inventarios_articulo_registro", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function guardarArticuloComponente()
    {
        $data = array(
            "idarticuloregistroprincipal" => $this->idPadre,
            "idarticuloregistrosubcomponente" => $this->idHijo
        );
        if($this->db->insert("inventarios_articulo_registro_componentes", $data)) {
            $lastId =  $this->db->insert_id();
            $this->db->set("idarticuloprincipal", $this->idPadre, TRUE);
            $this->db->where("idarticuloregistro", $this->idHijo);

            if ($this->db->update('inventarios_articulo_registro'))
                return $lastId;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
        }
        else {
            return 0;
        }
    }
    public function eliminarArticuloComponente()
    {
        $this->db->set("idarticuloprincipal", 0, TRUE);
        $this->db->where("idarticuloregistro", $this->idHijo);
        if ($this->db->update('inventarios_articulo_registro'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminarComponente()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idarticuloregistroprincipal", $this->idPadre);
        $this->db->where("idarticuloregistrosubcomponente", $this->idHijo);
        $error = array();
        if ($this->db->delete('inventarios_articulo_registro_componentes'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function actualizarArticuloInventariado()
    {
        $this->db->set("serie", $this->serie, TRUE);
        $this->db->set("codigo_patrimonial_original", $this->codigoPatrimonialOriginal, TRUE);
        $this->db->set("codigo_patrimonial_actual", $this->codigoPatrimonialActual, TRUE);
        $this->db->set("fecha_registro", $this->fechaRegistro, TRUE);
        $this->db->set("condicion", $this->condicion, TRUE);
        $this->db->set("usuario_actualizacion", $this->usuarioRegistro, TRUE);
        $this->db->set("estado", $this->estado, TRUE);
        $this->db->set("costo_inicial", $this->costoInicial, TRUE);
        $this->db->set("orden", $this->ordenCompra, TRUE);
        $this->db->set("fecha_compra", $this->fecCompra, TRUE);
        $this->db->set("anio_fabricacion", $this->anioFabricacion, TRUE);
        $this->db->set("codigo_digerd", $this->codDigerd, TRUE);
        $this->db->set("pecosa", $this->numPecosa, TRUE);
        $this->db->set("codigo_activo", $this->codigoSbn, TRUE);
        $this->db->set("clasificador", $this->tipoPresupuesto, TRUE);
        $this->db->set("observaciones", $this->observacion, TRUE);
        $this->db->set("caracteristicas", $this->caracteristica, TRUE);
        $this->db->set("subcomponentes", $this->estadoSubItems, TRUE);
        $this->db->set("idtipohospital", $this->tipoHospital, TRUE);
        $this->db->where("idarticuloregistro", $this->idArticuloRegistro);
        $error = array();
        if ($this->db->update('inventarios_articulo_registro'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function obtenerReporteGeneral()
    {
        $this->db->distinct();
        $this->db->select("ID,SIGA,IdArticulo,Articulo,Marca,Modelo,Serie,PAT01,PAT02,Condicion,Costo,IDA,Almacen,Estado,idclasificacion,Clasificacion");
        $this->db->from("lista_articulos_inventariados_busqueda_is");
        if($this->idMarca){
            $this->db->where("idmarca", $this->idMarca);
        }
        if($this->idAlmacen){
            $this->db->where("IDA", $this->idAlmacen);
        }
        if($this->idClasificacion){
            $this->db->where("idclasificacion", $this->idClasificacion);
        }
        return $this->db->get();
    }
    public function obtenerReporteAsignados()
    {
        $this->db->select("*");
        $this->db->from("lista_articulos_inventariados_busqueda_dashboard");
        if($this->idMarca){
            $this->db->where("idmarca", $this->idMarca);
        }
        if($this->idAlmacen){
            $this->db->where("IDA", $this->idAlmacen);
        }
        if($this->idClasificacion){
            $this->db->where("idclasificacion", $this->idClasificacion);
        }
        $this->db->where("cantidad = 0");

        return $this->db->get();
    }
    public function obtenerReporteDisponibles()
    {
        $this->db->select("*");
        $this->db->from("lista_articulos_inventariados_busqueda_dashboard");
        if($this->idMarca){
            $this->db->where("idmarca", $this->idMarca);
        }
        if($this->idAlmacen){
            $this->db->where("IDA", $this->idAlmacen);
        }
        if($this->idClasificacion){
            $this->db->where("idclasificacion", $this->idClasificacion);
        }
        $this->db->where("cantidad > 0");
        return $this->db->get();
    }

    public function BuscarSerieInventario()
    {
        $this->db->select("serie");
        $this->db->from("inventarios_articulo_registro");
        $this->db->where("serie", $this->serie);
        $serie = $this->db->get();
        
        return $serie->num_rows();

    }

    public function BuscarCodBienInventario()
    {
        $this->db->select("codigo_patrimonial_original");
        $this->db->from("inventarios_articulo_registro");
        $this->db->where("codigo_patrimonial_original", $this->codigoPatrimonialOriginal);
        $codigoPatrimonialOriginal = $this->db->get();
        
        return $codigoPatrimonialOriginal->num_rows();
    }

    public function BuscarCodPatrimonialCompInventario()
    {
        $this->db->select("codigo_patrimonial_actual");
        $this->db->from("inventarios_articulo_registro");
        $this->db->where("codigo_patrimonial_actual", $this->codigoPatrimonialActual);
        $codigoPatrimonialActual = $this->db->get();
        
        return $codigoPatrimonialActual->num_rows();
    }

}