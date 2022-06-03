<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoRegistrar_model extends CI_Model
{
    private $id;
    private $secuencia;
    private $tipoEvento;
    private $evento;
    private $fechaEvento;
    private $detalle;
    private $coordenadas;
    private $nivelEmergencia;
    private $fuenteInicial;
    private $referencia;
    private $latitud;
    private $longitud;
    private $latitudsismo;
    private $longitudsismo;
    private $ubigeo;
    private $ubigeoDescripcion;
    private $descripcionGeneral;
    private $profundidad;
    private $magnitud;
    private $intensidad;
    private $estado;
    private $fechaInicio;
    private $fechaFin;
    private $pagina;
    private $busqueda;
    private $idrol;
    private $region;
    private $usuario;
    private $lugar;
    private $consolidado;
    private $zoom;
    private $anio;
    private $mes;
    private $departamento;
    private $provincia;
    private $distrito;
    private $ocurrencia;
    private $eventoConsolidado;
    private $eventoAsociado;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setSecuencia($data)
    {
        $this->secuencia = $this->db->escape_str($data);
    }
    public function setTipoEvento($data)
    {
        $this->tipoEvento = $this->db->escape_str($data);
    }
    public function setEvento($data)
    {
        $this->evento = $this->db->escape_str($data);
    }
    public function setFechaEvento($data)
    {
        $this->fechaEvento = $this->db->escape_str($data);
    }
    public function setDetalle($data)
    {
        $this->detalle = $this->db->escape_str($data);
    }
    public function setCoordenadas($data)
    {
        $this->coordenadas = $this->db->escape_str($data);
    }
    public function setNivelEmergencia($data)
    {
        $this->nivelEmergencia = $this->db->escape_str($data);
    }
    public function setFuenteInicial($data)
    {
        $this->fuenteInicial = $this->db->escape_str($data);
    }
    public function setReferencia($data)
    {
        $this->referencia = $this->db->escape_str($data);
    }
    public function setLatitud($data)
    {
        $this->latitud = $this->db->escape_str($data);
    }
    public function setLongitud($data)
    {
        $this->longitud = $this->db->escape_str($data);
    }
    public function setLatitudSismo($data)
    {
        $this->latitudsismo = $this->db->escape_str($data);
    }
    public function setLongitudSismo($data)
    {
        $this->longitudsismo = $this->db->escape_str($data);
    }
    public function setUbigeo($data)
    {
        $this->ubigeo = $this->db->escape_str($data);
    }
      public function setUbigeoDescripcion($data)
      {
          $this->ubigeoDescripcion = $this->db->escape_str($data);
      }
    public function setDescripcionGeneral($data)
    {
        $this->descripcionGeneral = $this->db->escape_str($data);
    }
    public function setProfundidad($data)
    {
        $this->profundidad = $this->db->escape_str($data);
    }

    public function setMagnitud($data)
    {
        $this->magnitud = $this->db->escape_str($data);
    }
    public function setIntesidad($data)
    {
        $this->intensidad = $this->db->escape_str($data);
    }
    public function setEstado($data)
    {
        $this->estado = $this->db->escape_str($data);
    }
    public function setFechaInicio($data)
    {
        $this->fechaInicio = $this->db->escape_str($data);
    }
    public function setFechaFin($data)
    {
        $this->fechaFin = $this->db->escape_str($data);
    }
    public function setPagina($data)
    {
        $this->pagina = $this->db->escape_str($data);
    }
    public function setBusqueda($data)
    {
        $this->busqueda = $this->db->escape_str($data);
    }
    public function setIdrol($data)
    {
        $this->idrol = $this->db->escape_str($data);
    }
    public function setRegion($data)
    {
        $this->region = $this->db->escape_str($data);
    }
    public function setUsuario($data)
    {
        $this->usuario = $this->db->escape_str($data);
    }
   public function setLugar($data)
    {
        $this->lugar = $this->db->escape_str($data);
    }
    public function setConsolidado($data)
    {
        $this->consolidado = $this->db->escape_str($data);
    }
    public function setZoom($data)
    {
        $this->zoom = $this->db->escape_str($data);
    }    
    public function setAnio($data)
    {
        $this->anio = $this->db->escape_str($data);
    }
    public function setMes($data)
    {
        $this->mes = $this->db->escape_str($data);
    }
    public function setDepartamento($data)
    {
        $this->departamento = $this->db->escape_str($data);
    }
    public function setProvincia($data)
    {
        $this->provincia = $this->db->escape_str($data);
    }
    public function setDistrito($data)
    {
        $this->distrito = $this->db->escape_str($data);
    }
    public function setOcurrencia($data)
    {
        $this->ocurrencia = $this->db->escape_str($data);
    }
    public function setEventoConsolidado($data)
    {
        $this->eventoConsolidado = $this->db->escape_str($data);
    }
    public function setEventoAsociado($data)
    {
        $this->eventoAsociado = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function getSecuencia()
    {
        $this->db->select("MAX(numero) numero");
        $this->db->from("evento_secuencia");
        $this->db->where("anio", $this->anio);

        $secuencia = $this->db->get();
        $secuencia = $secuencia->row();
        $secuencia = $secuencia->numero;
        $incremento = $secuencia + 1;
        $this->db->db_debug = FALSE;
        $this->db->set("numero", $incremento, TRUE);
        $this->db->where("anio", $this->anio);
        $this->db->update('evento_secuencia');
        return $secuencia;
    }
    public function registrar()
    {
        $data = array(
            "Evento_Tipo_Codigo" => $this->tipoEvento,
            "Evento_Codigo" => $this->evento,
            "Evento_Fecha" => $this->fechaEvento,
            "Evento_Detalle_Codigo" => $this->detalle,
            "Evento_Nivel_Codigo" => $this->nivelEmergencia,
            "Evento_Fuente_Codigo" => $this->fuenteInicial,
            "Evento_Descripcion" => $this->descripcionGeneral,
            "Evento_Referencia" => $this->referencia,
            "Evento_Coordenadas" => $this->coordenadas,
            "Evento_Latitud" => $this->latitud,
            "Evento_Longitud" => $this->longitud,
            "Evento_Latitud_Sismo" => $this->latitudsismo,
            "Evento_Longitud_Sismo" => $this->longitudsismo,
            "Evento_Ubigeo" => $this->ubigeo,
            "Evento_Ubigeo_Descripcion" => $this->ubigeoDescripcion,
            "Evento_Profundidad" => $this->profundidad,
            "Evento_Magnitud" => $this->magnitud,
            "Evento_Intensidad" => $this->intensidad,
            "Evento_Estado_Codigo" => "1",
            "Evento_Usuario_Registro" => $this->session->userdata("idusuario"),
            "Evento_Secuencia" => $this->secuencia,
            "Evento_Lugar" => $this->lugar,
            "Evento_Fecha_Registro" => date("Y-m-d H:i:s"),
            "Evento_Fecha_Actualizacion" => date("Y-m-d H:i:s"),
            "evento_consolidado" => $this->consolidado,
            "zoom" => $this->zoom,
            "evento_asociado_id" => $this->eventoAsociado,
        );
        if ($this->db->insert('evento_registro', $data))
            return $this->db->insert_id();
        else
            return 0;
    }
    public function registrarApp()
    {
        $data = array(
            "Evento_Tipo_Codigo" => $this->tipoEvento,
            "Evento_Codigo" => $this->evento,
            "Evento_Fecha" => $this->fechaEvento,
            "Evento_Detalle_Codigo" => $this->detalle,
            "Evento_Nivel_Codigo" => $this->nivelEmergencia,
            "Evento_Fuente_Codigo" => $this->fuenteInicial,
            "Evento_Descripcion" => $this->descripcionGeneral,
            "Evento_Referencia" => $this->referencia,
            "Evento_Coordenadas" => $this->coordenadas,
            "Evento_Latitud" => $this->latitud,
            "Evento_Longitud" => $this->longitud,
            "Evento_Latitud_Sismo" => $this->latitudsismo,
            "Evento_Longitud_Sismo" => $this->longitudsismo,
            "Evento_Ubigeo" => $this->ubigeo,
            "Evento_Ubigeo_Descripcion" => $this->ubigeoDescripcion,
            "Evento_Profundidad" => $this->profundidad,
            "Evento_Magnitud" => $this->magnitud,
            "Evento_Intensidad" => $this->intensidad,
            "Evento_Estado_Codigo" => "1",
            "Evento_Usuario_Registro" => $this->usuario,
            "Evento_Secuencia" => $this->secuencia,
            "Evento_Lugar" => $this->lugar,
            "Evento_Fecha_Registro" => date("Y-m-d H:i:s"),
            "Evento_Fecha_Actualizacion" => date("Y-m-d H:i:s")
        );
        if ($this->db->insert('evento_registro', $data))
            return $this->db->insert_id();
        else
            return 0;
    }
    public function editar()
    {
        $this->db->set("Evento_Tipo_Codigo", $this->tipoEvento, TRUE);
        $this->db->set("Evento_Codigo", $this->evento, TRUE);
        $this->db->set("Evento_Fecha", $this->fechaEvento, TRUE);
        $this->db->set("Evento_Detalle_Codigo", $this->detalle, TRUE);
        $this->db->set("Evento_Nivel_Codigo", $this->nivelEmergencia, TRUE);
        $this->db->set("Evento_Fuente_Codigo", $this->fuenteInicial, TRUE);
        $this->db->set("Evento_Descripcion", $this->descripcionGeneral, TRUE);
        $this->db->set("Evento_Referencia", $this->referencia, TRUE);
        $this->db->set("Evento_Coordenadas", $this->coordenadas, TRUE);
        $this->db->set("Evento_Latitud", $this->latitud, TRUE);
        $this->db->set("Evento_Longitud", $this->longitud, TRUE);
        $this->db->set("Evento_Latitud_Sismo", $this->latitudsismo, TRUE);
        $this->db->set("Evento_Longitud_Sismo", $this->longitudsismo, TRUE);
        $this->db->set("Evento_Ubigeo", $this->ubigeo, TRUE);
        $this->db->set("Evento_Profundidad", $this->profundidad, TRUE);
        $this->db->set("Evento_Magnitud", $this->magnitud, TRUE);
        $this->db->set("Evento_Intensidad", $this->intensidad, TRUE);
        $this->db->set("Evento_Ubigeo_Descripcion", $this->ubigeoDescripcion, TRUE);
        $this->db->set("Evento_Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->set("Evento_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Evento_Lugar", $this->lugar, TRUE);
        $this->db->set("evento_consolidado", $this->consolidado, TRUE);
        $this->db->set("zoom", $this->zoom, TRUE);
        $this->db->set("evento_asociado_id", $this->eventoAsociado, TRUE);
        $this->db->where("Evento_Registro_Numero", $this->id);
        if ($this->db->update('evento_registro'))
            return $this->id;
        else {
            return 0;
        }
    }
    public function eliminarEvento(){
        $this->db->db_debug = FALSE;
        $this->db->where("Evento_Registro_Numero", $this->id);
        $this->db->delete('evento_danios', array('Evento_Registro_Numero' => $this->id)); 
        $this->db->delete('evento_danios_lesionados', array('Evento_Registro_Numero' => $this->id)); 
        $this->db->delete('evento_entidad_salud', array('Evento_Registro_Numero' => $this->id)); 
        $this->db->delete('evento_equipos', array('Evento_Registro_Numero' => $this->id)); 
        $this->db->delete('evento_medicamentos', array('Evento_Registro_Numero' => $this->id)); 
        $this->db->delete('evento_recursos_humanos', array('Evento_Registro_Numero' => $this->id)); 
        $this->db->delete('evento_registro', array('Evento_Registro_Numero' => $this->id)); 
        $this->db->delete('evento_registro_files', array('Evento_Registro_Numero' => $this->id)); 
        if ($this->db->delete('evento_registro_imagen', array('Evento_Registro_Numero' => $this->id))) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function cambiarEstado()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Evento_Estado_Codigo", $this->estado, TRUE);
        $estado = $this->estado;
        if ($estado == "2") {
            $this->db->set("Evento_Fecha_Cierre", date("Y-m-d H:i:s"), TRUE);
            $this->db->set("Evento_Usuario_Cierre", $this->session->userdata("idusuario"), TRUE);
        } else if ($estado == "3") {
            $this->db->set("Evento_Fecha_Anulacion", date("Y-m-d H:i:s"), TRUE);
            $this->db->set("Evento_Usuario_Anulacion", $this->session->userdata("idusuario"), TRUE);
        } else {
            $this->db->set("Evento_Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
            $this->db->set("Evento_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        }
        $this->db->where("Evento_Registro_Numero", $this->id);
        $error = array();
        if ($this->db->update('evento_registro'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function evento()
    {
        $this->db->select("Evento_Registro_Numero, Evento_Secuencia, Evento_Tipo_Codigo, Evento_Codigo, Evento_Detalle_Codigo, Evento_Nivel_Codigo, Evento_Fuente_Codigo, Evento_Descripcion, Evento_Ubigeo, Evento_Ubigeo_Descripcion, Evento_Coordenadas, Evento_Fecha, Evento_Fecha_Registro, Evento_Usuario_Registro, Evento_Fecha_Actualizacion, Evento_Usuario_Actualizacion, Evento_Fecha_Cierre, Evento_Usuario_Cierre, Evento_Fecha_Anulacion, Evento_Usuario_Anulacion, Evento_Latitud, Evento_Longitud, Evento_Latitud_Sismo, Evento_Longitud_Sismo, Evento_Profundidad, Evento_Magnitud, Evento_Intensidad, Evento_Referencia, Evento_Lugar, Cantidad_Danio, Cantidad_Lesionado, Cantidad_Acciones, Cantidad_EESS, Evento_Estado_Codigo,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as Evento_Formateado,evento_consolidado, zoom, evento_asociado_id");
        $this->db->from("evento_registro er");
        $this->db->where("Evento_Registro_Numero", $this->id);
        return $this->db->get();
    }
    public function lista()
    {
        $estados = array("1","2","3");
        $idrol = $this->session->userdata("idrol");
        $codigoRegion = $this->session->userdata("Codigo_Region");
        $this->db->select("Evento_Coordenadas,Evento_Secuencia,Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha, en.Evento_Nivel_Nombre_Corto nivel");
        $this->db->select("Cantidad_Danio danios");
        $this->db->select("Cantidad_Lesionado lesionados");
        $this->db->select("Cantidad_Acciones acciones");
        $this->db->select("Cantidad_EESS salud");
        $this->db->select("DATE_FORMAT(Evento_Fecha,'%Y') ANIO");
        $this->db->select("Evento_Ubigeo_Descripcion ubigeo,Evento_Estado_Codigo");
        $this->db->from("evento_registro er");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
        $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
        if($idrol=="02" or $idrol=="03"){
          $this->db->where("SUBSTRING(Evento_Ubigeo,1,2)",$codigoRegion);
        }
        $this->db->where("YEAR(er.Evento_Fecha)",$this->anio);
        if ($this->mes != 0) {
            $this->db->where("MONTH(er.Evento_Fecha)",$this->mes);
        }        
        $this->db->where_in("er.Evento_Estado_Codigo", $estados);
        $this->db->order_by("er.Evento_Fecha", "DESC");
        return $this->db->get();
    }
    public function listaPagina()
    {
        $estados = array("1","2");
        $this->db->select("Evento_Coordenadas,Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
        $this->db->select("fn_departamento(SUBSTRING(Evento_Ubigeo,1,2)) departamento");
        $this->db->select("fn_provincia(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2)) provincia");
        $this->db->select("fn_distrito(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2),SUBSTRING(Evento_Ubigeo,5,2)) distrito,Evento_Estado_Codigo");
        $this->db->from("evento_registro er");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
        $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
        $this->db->where_in("er.Evento_Estado_Codigo", $estados);
        $this->db->order_by("er.Evento_Registro_Numero", "DESC");
        $this->db->limit(10,$this->pagina);
        return $this->db->get();
    }
    public function total()
    {
        $estados = array("1","2");
        $this->db->select("COUNT(1) total");
        $this->db->from("evento_registro");
        $this->db->where_in("Evento_Estado_Codigo", $estados);
        return $this->db->get();
    }
    public function listaPaginaApp()
    {
        $idrol = $this->idrol;
        $codigoRegion = $this->region;
        $estados = array("1","2");
        $this->db->select("Evento_Coordenadas,Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',1) departamento");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',2) provincia");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',3) distrito,Evento_Estado_Codigo");
        $this->db->from("evento_registro er");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
        $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
        if($idrol=="03"){
          $this->db->where("SUBSTRING(Evento_Ubigeo,1,2)",$codigoRegion);
        }
        $this->db->where_in("er.Evento_Estado_Codigo", $estados);
        $this->db->order_by("er.Evento_Fecha", "DESC");
        $this->db->limit(10,$this->pagina);
        return $this->db->get();
    }
    public function totalApp()
    {
        $idrol = $this->idrol;
        $codigoRegion = $this->region;
        $estados = array("1","2");
        $this->db->select("COUNT(1) total");
        $this->db->from("evento_registro");
        if($idrol=="03"){
          $this->db->where("SUBSTRING(Evento_Ubigeo,1,2)",$codigoRegion);
        }
        $this->db->where_in("Evento_Estado_Codigo", $estados);
        return $this->db->get();
    }
    public function busqueda()
    {
        $estados = array("1","2");
        $this->db->select("Evento_Coordenadas,Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
        $this->db->select("fn_departamento(SUBSTRING(Evento_Ubigeo,1,2)) departamento");
        $this->db->select("fn_provincia(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2)) provincia");
        $this->db->select("fn_distrito(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2),SUBSTRING(Evento_Ubigeo,5,2)) distrito,Evento_Estado_Codigo");
        $this->db->from("evento_registro er");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
        $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
        $this->db->where_in("er.Evento_Estado_Codigo", $estados);
        $this->db->like('Evento_Detalle_Nombre', $this->busqueda);
        $this->db->order_by("er.Evento_Registro_Numero", "DESC");
        $this->db->limit(10,0);
        return $this->db->get();
    }
    public function danios()
    {
        $this->db->select("Evento_Registro_Numero,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha,er.Evento_Descripcion,ed.Evento_Detalle_Nombre,et.Evento_Tipo_Nombre,e.Evento_Nombre");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',1) departamento");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',2) provincia");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',3) distrito");
        $this->db->select("SUBSTRING(Evento_Ubigeo,1,2) COD_DEPA,SUBSTRING(Evento_Ubigeo,3,2) COD_PROV,SUBSTRING(Evento_Ubigeo,5,2) COD_DIST, DATE_FORMAT(er.Evento_Fecha_Registro,'%Y') ANIO, er.Evento_Secuencia");
        $this->db->from("evento_registro er");
        $this->db->join("evento_tipo et", "et.Evento_Tipo_Codigo=er.Evento_Tipo_Codigo");
        $this->db->join("evento e", "e.Evento_Codigo=er.Evento_Codigo AND et.Evento_Tipo_Codigo=e.Evento_Tipo_Codigo");
        $this->db->join("evento_detalle ed", "et.Evento_Tipo_Codigo=ed.Evento_Tipo_Codigo AND ed.Evento_Detalle_Codigo=er.Evento_Detalle_Codigo AND et.Evento_Tipo_Codigo=et.Evento_Tipo_Codigo AND ed.Evento_Codigo=e.Evento_Codigo");
        $this->db->where("Evento_Registro_Numero", $this->id);
        return $this->db->get();
    }
    public function listaEventos()
    {
        $estados = array("1","2");
        $this->db->select("er.Evento_Registro_Numero,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y') as fecha,DATE_FORMAT(Evento_Fecha,'%H:%i') as hora");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',1) departamento");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',2) provincia");
        $this->db->select("SPLIT_STRING(Evento_Ubigeo_Descripcion,',',3) distrito");
        $this->db->select("IFNULL(ed.Evento_Lesionados,0) Evento_Lesionados,IFNULL(ed.Evento_Fallecidos,0) Evento_Fallecidos,IFNULL(ed.Evento_Desaparecidos,0) Evento_Desaparecidos");
        $this->db->select("IFNULL(ed.Evento_Viv_Afectadas,0) Evento_Viv_Afectadas,IFNULL(ed.Evento_Viv_Inhabitables,0) Evento_Viv_Inhabitables");
        $this->db->select("IFNULL(ed.Evento_Viv_Colapsadas,0) Evento_Viv_Colapsadas,IFNULL(ed.Evento_Per_Afectadas,0) Evento_Per_Afectadas,IFNULL(ed.Evento_Per_Damnificadas,0) Evento_Per_Damnificadas");
        $this->db->from("evento_registro er");
        $this->db->join("evento_danios ed", "ed.Evento_Registro_Numero=er.Evento_Registro_Numero AND ed.ultimo='1'","LEFT");
        $this->db->where_in("SUBSTRING(er.Evento_Ubigeo,1,2)", $this->ubigeo);
        if ($this->nivelEmergencia != "0")
            $this->db->where("er.Evento_Nivel_Codigo", $this->nivelEmergencia);
        $this->db->where("er.Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("er.Evento_Codigo", $this->evento);
        $this->db->where("date(er.Evento_Fecha)>=", $this->fechaInicio);
        $this->db->where("date(er.Evento_Fecha)<=", $this->fechaFin);
        $this->db->where_in("Evento_Estado_Codigo", $estados);
        return $this->db->get();
    }
    public function listaEventosMapa()
    {
        $estados = array("1","2");
        $this->db->select("Evento_Descripcion,Evento_Latitud,Evento_Longitud,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
        $this->db->select("fn_departamento(SUBSTRING(Evento_Ubigeo,1,2)) departamento");
        $this->db->select("fn_provincia(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2)) provincia");
        $this->db->select("fn_distrito(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2),SUBSTRING(Evento_Ubigeo,5,2)) distrito");
        $this->db->from("evento_registro");
        $this->db->where_in("SUBSTRING(Evento_Ubigeo,1,2)", $this->ubigeo);
        if ($this->nivelEmergencia != "0")
            $this->db->where("Evento_Nivel_Codigo", $this->nivelEmergencia);
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("Evento_Codigo", $this->evento);
        $this->db->where("date(Evento_Fecha)>=", $this->fechaInicio);
        $this->db->where("date(Evento_Fecha)<=", $this->fechaFin);
        $this->db->where_in("Evento_Estado_Codigo", $estados);
        return $this->db->get();
    }
    public function listaEventosVulnerable()
    {
        $this->db->select("er.Evento_Registro_Numero,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y') as fecha,DATE_FORMAT(Evento_Fecha,'%H:%i') as hora");
        $this->db->select("fn_departamento(SUBSTRING(Evento_Ubigeo,1,2)) departamento");
        $this->db->select("fn_provincia(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2)) provincia");
        $this->db->select("fn_distrito(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2),SUBSTRING(Evento_Ubigeo,5,2)) distrito");
        $this->db->select("IFNULL(SUM(CASE WHEN Lesionado_Genero = '2' THEN 1 END),0) mujeres");
        $this->db->select("IFNULL(SUM(CASE WHEN Lesionado_Gestante = '1' THEN 1 END),0) gestantes");
        $this->db->select("IFNULL(SUM(CASE WHEN (Lesionado_Edad < 18 AND Lesionado_Edad>0) THEN 1 END),0) menor_edad");
        $this->db->select("IFNULL(SUM(CASE WHEN Lesionado_Edad > 64 THEN 1 END),0) adulto_mayor");
        $this->db->from("evento_registro er");
        $this->db->join("evento_danios_lesionados edl", "edl.Evento_Registro_Numero=er.Evento_Registro_Numero AND edl.ultimo='1'");
        $this->db->where_in("SUBSTRING(er.Evento_Ubigeo,1,2)", $this->ubigeo);
        if ($this->nivelEmergencia != "0")
            $this->db->where("er.Evento_Nivel_Codigo", $this->nivelEmergencia);
        $this->db->where("er.Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("er.Evento_Codigo", $this->evento);
        $this->db->where("date(er.Evento_Fecha)>=", $this->fechaInicio);
        $this->db->where("date(er.Evento_Fecha)<=", $this->fechaFin);
        $this->db->group_by("er.Evento_Registro_Numero");

        return $this->db->get();
    }
    public function eventoInforme()
    {
        $this->db->select("DATE_FORMAT(Evento_Fecha,'%Y') as E_ANIO,DATE_FORMAT(Evento_Fecha,'%m') E_MES,DATE_FORMAT(Evento_Fecha,'%d') E_DIA");
        $this->db->select("DATE_FORMAT(Evento_Fecha,'%H') E_HORA,DATE_FORMAT(Evento_Fecha,'%i') E_MINUTO");
        $this->db->select("Evento_Nombre evento,Evento_Detalle_Nombre,DATE_FORMAT(Evento_Fecha_Actualizacion,'%Y') as ANIO,Evento_Lugar");
        $this->db->select("DATE_FORMAT(Evento_Fecha_Actualizacion,'%d') DIA,DATE_FORMAT(Evento_Fecha_Actualizacion,'%m') MES,DATE_FORMAT(Evento_Fecha_Actualizacion,'%H') HORA,DATE_FORMAT(Evento_Fecha_Actualizacion,'%i') MINUTO");
        $this->db->select("fn_departamento(SUBSTRING(Evento_Ubigeo,1,2)) departamento");
        $this->db->select("fn_provincia(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2)) provincia");
        $this->db->select("fn_distrito(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2),SUBSTRING(Evento_Ubigeo,5,2)) distrito,Evento_Estado_Codigo");
        $this->db->select("Evento_Latitud_Sismo,Evento_Longitud_Sismo,Evento_Profundidad,Evento_Magnitud,Evento_Intensidad,Evento_Referencia");
        $this->db->select("er.Evento_Tipo_Codigo,er.Evento_Codigo");
        $this->db->select("er.Evento_Descripcion,er.Evento_Secuencia,er.Evento_Nivel_Codigo");
        $this->db->select("Evento_Latitud,Evento_Longitud");
        $this->db->select("er.Evento_Usuario_Registro,er.Evento_Usuario_Actualizacion");
        $this->db->select("DATE_FORMAT(er.Evento_Fecha_Registro, '%d/%m/%Y %H:%i') fecha_registro");
        $this->db->select("DATE_FORMAT(er.Evento_Fecha_Actualizacion, '%d/%m/%Y %H:%i') fecha_actualizacion");
        $this->db->select("es.anio_nombre_principal as anio_principal");
        $this->db->select("es.anio_nombre_secundario as anio_secundario");
        $this->db->from("evento_registro er");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
        $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
        $this->db->join("evento_secuencia es", "es.anio=DATE_FORMAT(er.Evento_Fecha,'%Y')");
        $this->db->where_in("er.Evento_Registro_Numero", $this->id);
        return $this->db->get();
    }
    public function usuariosEvento() {
        $this->db->select("Codigo_Usuario,CONCAT(Nombres,', ',Apellidos) usuario");
        $this->db->from("usuarios");
        $this->db->where("Codigo_Usuario", $this->usuario);
        
        return $this->db->get();
        
    }
    public function listaEventosMapaDepartamento()
    {
        $Evento_Estado_Codigo = array("1","2");
        $this->db->select("et.Evento_Tipo_Codigo,er.Evento_Codigo,Evento_Tipo_Nombre tipoEvento,Evento_Nombre evento,COUNT(Evento_Registro_Numero) total");
        $this->db->from("evento_registro er");
        $this->db->join("evento_tipo et","et.Evento_Tipo_Codigo=er.Evento_Tipo_Codigo");
        $this->db->join("evento e","e.Evento_Codigo=er.Evento_Codigo AND et.Evento_Tipo_Codigo=e.Evento_Tipo_Codigo");
        $this->db->where_in("SUBSTRING(Evento_Ubigeo,1,2)", $this->ubigeo);
        $this->db->where("date(Evento_Fecha)>=", $this->fechaInicio);
        $this->db->where("date(Evento_Fecha)<=", $this->fechaFin);
        $this->db->group_by("et.Evento_Tipo_Codigo,er.Evento_Codigo");
        $this->db->where_in("Evento_Estado_Codigo", $Evento_Estado_Codigo);
        return $this->db->get();
    }
    public function listaEventosMapaVulnerable()
    {
        $Evento_Estado_Codigo = array("1","2");
        $this->db->select("IFNULL(SUM(CASE WHEN Lesionado_Genero = '2' THEN 1 END),0) mujeres");
        $this->db->select("IFNULL(SUM(CASE WHEN Lesionado_Gestante = '1' THEN 1 END),0) gestantes");
        $this->db->select("IFNULL(SUM(CASE WHEN (Lesionado_Edad < 18 AND Lesionado_Edad>0) THEN 1 END),0) menor_edad");
        $this->db->select("IFNULL(SUM(CASE WHEN Lesionado_Edad > 64 THEN 1 END),0) adulto_mayor");
        $this->db->from("evento_registro er");
        $this->db->join("evento_danios_lesionados edl", "edl.Evento_Registro_Numero=er.Evento_Registro_Numero AND edl.ultimo='1'");
        $this->db->where_in("SUBSTRING(er.Evento_Ubigeo,1,2)", $this->ubigeo);
        $this->db->where("date(er.Evento_Fecha)>=", $this->fechaInicio);
        $this->db->where("date(er.Evento_Fecha)<=", $this->fechaFin);
        $this->db->where_in("Evento_Estado_Codigo", $Evento_Estado_Codigo);
        return $this->db->get();
    }
    public function listaEventosMapaEESS()
    {
        $Evento_Estado_Codigo = array("1","2");
        $this->db->select("IFNULL(SUM(CASE WHEN eet.Evento_Entidad_Estado = '1' THEN 1 END),0) operativas");
        $this->db->select("IFNULL(SUM(CASE WHEN eet.Evento_Entidad_Estado = '2' THEN 1 END),0) inoperativas");
        $this->db->from("evento_registro er");
        $this->db->join("evento_entidad_salud eet","eet.Evento_Registro_Numero=er.Evento_Registro_Numero");
        $this->db->where_in("SUBSTRING(Evento_Ubigeo,1,2)", $this->ubigeo);
        $this->db->where("date(Evento_Fecha)>=", $this->fechaInicio);
        $this->db->where("date(Evento_Fecha)<=", $this->fechaFin);
        $this->db->where_in("Evento_Estado_Codigo", $Evento_Estado_Codigo);
        return $this->db->get();
    }
    public function listaEventosMapaRecursos()
    {
        $Evento_Estado_Codigo = array("1","2");
        $this->db->select("IFNULL(SUM(Evento_Acciones_Region+Evento_Acciones_Minsa),0) brigadistas");
        $this->db->select("IFNULL(SUM(Evento_Acciones_Emt_i+Evento_Acciones_Emt_ii+Evento_Acciones_Emt_iii+Evento_Acciones_Celula_Especializada),0) eme");
        $this->db->select("IFNULL(SUM(Evento_Acciones_Minsa_Samu+Evento_Acciones_Salud_Minsa+Evento_Acciones_Essalud+Evento_Acciones_Municipalidades_Gores+Evento_Acciones_Voluntarios),0) personal_salud");
        $this->db->select("IFNULL(SUM(Evento_Ambulancias_Minsa_Samu+Evento_Ambulancias_Minsa+Evento_Ambulancias_Essalud+Evento_Ambulancias_Bomberos+Evento_Ambulancias_Municipalidades_Gores+Evento_Ambulancias_PNP_FFAA+Evento_Ambulancianas_Privadas),0) ambulancias");
        $this->db->from("evento_registro er");
        $this->db->join("evento_acciones ea","ea.Evento_Registro_Numero=er.Evento_Registro_Numero");
        $this->db->where_in("SUBSTRING(Evento_Ubigeo,1,2)", $this->ubigeo);
        $this->db->where("date(Evento_Fecha)>=", $this->fechaInicio);
        $this->db->where("date(Evento_Fecha)<=", $this->fechaFin);
        $this->db->where_in("Evento_Estado_Codigo", $Evento_Estado_Codigo);
        return $this->db->get();
    }
    public function listaEventosMapaCIE10()
    {
        $Evento_Estado_Codigo = array("1","2");
        $this->db->select("le.Codigo cie,le.Descripcion descripcion,IFNULL(COUNT(edl.Lesionado_CIE10_Codigo),0) cantidad");
        $this->db->from("evento_registro er");
        $this->db->join("evento_danios_lesionados edl", "edl.Evento_Registro_Numero=er.Evento_Registro_Numero AND edl.ultimo='1'");
        $this->db->join("lista_enfermedades le", "le.Codigo=edl.Lesionado_CIE10_Codigo");
        $this->db->where_in("SUBSTRING(Evento_Ubigeo,1,2)", $this->ubigeo);
        $this->db->where("date(Evento_Fecha)>=", $this->fechaInicio);
        $this->db->where("date(Evento_Fecha)<=", $this->fechaFin);
        $this->db->group_by("le.Codigo");
        $this->db->where_in("Evento_Estado_Codigo", $Evento_Estado_Codigo);
        return $this->db->get();
    }
    public function listaEventosRegion(){
      $Evento_Estado_Codigo = array("1","2");
      $this->db->select("IFNULL(SUM(CASE WHEN Situacion_Codigo = '01' THEN 1 END),0) ALTA");
      $this->db->select("IFNULL(SUM(CASE WHEN Situacion_Codigo = '02' THEN 1 END),0) HOSPITALIZADO");
      $this->db->select("IFNULL(SUM(CASE WHEN Situacion_Codigo = '03' THEN 1 END),0) REFERIDO");
      $this->db->select("IFNULL(SUM(CASE WHEN Situacion_Codigo = '04' THEN 1 END),0) FALLECIDO");
      $this->db->select("IFNULL(SUM(CASE WHEN Situacion_Codigo = '05' THEN 1 END),0) DESAPARECIDO");
      $this->db->select("IFNULL(SUM(CASE WHEN Situacion_Codigo = '06' THEN 1 END),0) OBSERVACION");
      $this->db->select("IFNULL(SUM(CASE WHEN Situacion_Codigo = '07' THEN 1 END),0) EVACUACION");
      $this->db->from("evento_registro er");
      $this->db->join("evento_danios_lesionados ea","ea.Evento_Registro_Numero=er.Evento_Registro_Numero AND ultimo='1'");
      $this->db->where_in("SUBSTRING(Evento_Ubigeo,1,2)", $this->ubigeo);
      $this->db->where("date(Evento_Fecha)>=", $this->fechaInicio);
      $this->db->where("date(Evento_Fecha)<=", $this->fechaFin);
      $this->db->where_in("Evento_Estado_Codigo", $Evento_Estado_Codigo);
      return $this->db->get();
    }
    public function listaDiferenciaEventosUsuario(){
    $this->db->select("Codigo_Usuario,Apellidos,Nombres,Usuario,IFNULL(COUNT(Evento_Registro_Numero),0) total");
    $this->db->from("usuarios");
    $this->db->join("evento_registro","usuarios.Codigo_Usuario=evento_registro.Evento_Usuario_Registro AND Evento_Estado_Codigo in('1','2')","LEFT");
    $this->db->group_by("Codigo_Usuario");
    return $this->db->get();
  }
  public function listaDiferenciaEventosUsuarioEventos(){
      $estados = array("1","2");
      $this->db->select("Evento_Registro_Numero,e.Evento_Nombre evento");
      $this->db->select("DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha,DATE_FORMAT(Evento_Fecha_Registro,'%d/%m/%Y %H:%i') as fechaRegistro");
      $this->db->select("TIMESTAMPDIFF(SECOND,Evento_Fecha,Evento_Fecha_Registro) diferencia");
      $this->db->select("fn_departamento(SUBSTRING(Evento_Ubigeo,1,2)) departamento");
      $this->db->select("fn_provincia(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2)) provincia");
      $this->db->select("fn_distrito(SUBSTRING(Evento_Ubigeo,1,2),SUBSTRING(Evento_Ubigeo,3,2),SUBSTRING(Evento_Ubigeo,5,2)) distrito");
      $this->db->from("evento_registro er");
      $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
      $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
      $this->db->where_in("er.Evento_Estado_Codigo", $estados);
      $this->db->where_in("er.Evento_Usuario_Registro", $this->busqueda);
      $this->db->order_by("er.Evento_Fecha", "DESC");
      return $this->db->get();
  }
public function agregarCantidadLesionados(){
      $this->db->db_debug = FALSE;
      $this->db->set("Cantidad_Lesionado", "Cantidad_Lesionado+$this->secuencia", FALSE);
      $this->db->where("Evento_Registro_Numero", $this->id);
      if($this->db->update('evento_registro'))
        return true;
      else {
          return false;
      }
  }
public function actualizarCantidadLesionados(){
      $this->db->db_debug = FALSE;
      $this->db->set("Cantidad_Lesionado", $this->secuencia, TRUE);
      $this->db->where("Evento_Registro_Numero", $this->id);
      if($this->db->update('evento_registro'))
          return true;
          else {
              return false;
          }
  }
public function actualizarCantidadDanios(){
      $this->db->db_debug = FALSE;
      $this->db->set("Cantidad_Danio", $this->secuencia, TRUE);
      $this->db->where("Evento_Registro_Numero", $this->id);
      if($this->db->update('evento_registro'))
          return true;
          else {
              return false;
          }
  }
public function mapaEvento() {
      $this->db->select("Evento_Registro_Numero,Evento_Nivel_Codigo,Evento_Coordenadas,Evento_Tipo_Codigo");
      $this->db->from("evento_registro");
      $this->db->where("Evento_Estado_Codigo",$this->estado);
      return $this->db->get();
  }
public function infoWindow() {
      $idrol = $this->session->userdata("idrol");
      $codigoRegion = $this->session->userdata("Codigo_Region");
      $this->db->select("Evento_Tipo_Nombre eventoTipo,Evento_Nombre evento,Evento_Secuencia, Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha,er.Evento_Tipo_Codigo");
      $this->db->select("Evento_Descripcion,Evento_Lesionados,Evento_Fallecidos,Evento_Desaparecidos,Evento_Viv_Inhabitables,Evento_Viv_Colapsadas,Evento_Ubigeo_Descripcion");
      $this->db->select("ef.Evento_Fuente_Descripcion, en.Evento_Nivel_Nombre");
      $this->db->from("evento_registro er");
      $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
      $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
      $this->db->join("evento_fuente ef", "er.Evento_Fuente_Codigo = ef.Evento_Fuente_Codigo");
      $this->db->join("evento_nivel en", "er.Evento_Nivel_Codigo = en.Evento_Nivel_Codigo");
      $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
      $this->db->join("evento_danios eda","eda.Evento_Registro_Numero = er.Evento_Registro_Numero AND eda.ultimo='1'","LEFT");
      $this->db->where("er.Evento_Registro_Numero", $this->id);
      $this->db->order_by("er.Evento_Fecha", "DESC");
      return $this->db->get();
  }
public function actualizarFecha()
  {
      $this->db->set("Evento_Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
      $this->db->set("Evento_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
      $this->db->where("Evento_Registro_Numero", $this->id);
      if ($this->db->update('evento_registro'))
        return true;
      else {
          return false;
      }
  }
  public function listaTipoFecha() {
      $estados = array("1","2","3");
      $idrol = $this->session->userdata("idrol");
      $codigoRegion = $this->session->userdata("Codigo_Region");
      $this->db->select("Evento_Registro_Numero id,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
      $this->db->select("Evento_Ubigeo_Descripcion ubigeo,Evento_Estado_Codigo");
      $this->db->from("evento_registro er");
      $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
      $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
      $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
      $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
      $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
      $this->db->where_in("er.evento_tipo_codigo", $this->tipoEvento);
      $this->db->where_in("date(er.Evento_Fecha)", $this->fechaEvento);
      $this->db->where_in("er.Evento_Estado_Codigo", $estados);
      return $this->db->get();
  }
  public function listaEventosGlobal()
  {
      $estados = array("1","2");
      $this->db->select("er.Evento_Registro_Numero,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y') as fecha,DATE_FORMAT(Evento_Fecha,'%H:%i') as hora,er.Cantidad_Acciones,e.Evento_Nombre evento, ed.Evento_Detalle_Nombre detalle");
      $this->db->select("DATE_FORMAT(Evento_Fecha_Registro,'%d/%m/%Y') as fechaRegistro,DATE_FORMAT(Evento_Fecha_Registro,'%H:%i') as horaRegistro,er.Evento_Nivel_Codigo");
      $this->db->select("DATE_FORMAT(Evento_Fecha_Registro,'%Y') ANIO, er.Evento_Secuencia,er.Evento_Latitud,er.Evento_Longitud");
      $this->db->select("TIMESTAMPDIFF(SECOND,er.Evento_Fecha,er.Evento_Fecha_Registro) diferencia");
      $this->db->select("total_lesionados(er.Evento_Registro_Numero) total_lesionados,total_entidades(er.Evento_Registro_Numero) total_entidades,u.Usuario");
      $this->db->select("SPLIT_STRING(er.Evento_Ubigeo_Descripcion,',',1) departamento");
      $this->db->select("SPLIT_STRING(er.Evento_Ubigeo_Descripcion,',',2) provincia");
      $this->db->select("SPLIT_STRING(er.Evento_Ubigeo_Descripcion,',',3) distrito");
      $this->db->select("total_lesionados(er.Evento_Registro_Numero) total_lesionados,total_entidades(er.Evento_Registro_Numero) total_entidades,er.Evento_Estado_Codigo");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Region),0) brigadista_region");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Minsa),0) brigadista_minsa");
      $this->db->select("IFNULL(SUM(ea.Evento_Rescatistas),0) brigadista_rescatista");
      $this->db->select("IFNULL(SUM(ea.Evento_Medicos_Tacticos),0) brigadista_tactico");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Emt_i),0) emt_i");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Emt_ii),0) emt_ii");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Emt_iii),0) emt_iii");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Oferta_Movil_i),0) MI_Oferta_Movil_i");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Oferta_Movil_ii),0) MI_Oferta_Movil_ii");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Oferta_Movil_iii),0) MI_Oferta_Movil_iii");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Hospital_Modular),0) MI_Hospital_Modular");
      $this->db->select("IFNULL(SUM(ea.Evento_Banio_Quimico_Portatil),0) MI_Banio_Quimico_Portatil");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Celula_Especializada),0) EA_Celula_Especializada");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Minsa_Samu),0) PS_Minsa_Samu");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Salud_Minsa),0) PS_Salud_Minsa");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Essalud),0) PS_Essalud");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Municipalidades_Gores),0) PS_Municipalidades_Gores");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_Voluntarios),0) PS_Voluntarios");
      $this->db->select("IFNULL(SUM(ea.Evento_Acciones_PNP_FFAA),0) PS_PNP_FFAA");
      $this->db->select("IFNULL(SUM(ea.Evento_Ambulancias_Minsa_Samu),0) A_Minsa_Samu");
      $this->db->select("IFNULL(SUM(ea.Evento_Ambulancias_Minsa),0) A_Minsa");
      $this->db->select("IFNULL(SUM(ea.Evento_Ambulancias_Essalud),0) A_Essalud");
      $this->db->select("IFNULL(SUM(ea.Evento_Ambulancias_Bomberos),0) A_Bomberos");
      $this->db->select("IFNULL(SUM(ea.Evento_Ambulancias_Municipalidades_Gores),0) A_Municipalidades_Gores");
      $this->db->select("IFNULL(SUM(ea.Evento_Ambulancias_PNP_FFAA),0) A_PNP_FFAA");
      $this->db->select("IFNULL(SUM(ea.Evento_Ambulancianas_Privadas),0) A_Privadas");
      $this->db->select("GROUP_CONCAT(ea.Evento_Acciones_Descripcion SEPARATOR '|') Acciones_Descripcion");
      $this->db->from("evento_registro er");
      $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
      $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
      $this->db->join("usuarios u","u.Codigo_Usuario=er.Evento_Usuario_Registro");
      $this->db->join("evento_detalle ed", "ed.Evento_Detalle_Codigo=er.Evento_Detalle_Codigo and ed.Evento_Tipo_Codigo = e.Evento_Tipo_Codigo and ed.Evento_Codigo = er.Evento_Codigo");
      $this->db->join("evento_acciones ea","ea.Evento_Registro_Numero=er.Evento_Registro_Numero","left");
      $datosUbigeo = $this->ubigeo;
      if ($datosUbigeo[0] != "0") {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,1,2)", $datosUbigeo[0]);
      }
      if ($datosUbigeo[1] != "0") {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,3,2)", $datosUbigeo[1]);
      }
      if ($datosUbigeo[2] != "0") {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,5,2)", $datosUbigeo[2]);
      }
      if ($this->nivelEmergencia != "0") {
          $this->db->where("er.Evento_Nivel_Codigo", $this->nivelEmergencia);
      }
      if ($this->tipoEvento != "0") {
          $this->db->where("er.Evento_Tipo_Codigo", $this->tipoEvento);
      }
      if ($this->evento != "0") {
          $this->db->where("er.Evento_Codigo", $this->evento);
      }
      if ($this->detalle != "0") {
        $this->db->where("er.Evento_Detalle_Codigo", $this->detalle);
      }
      if ($this->eventoConsolidado != "99") {
        $this->db->where("er.Evento_Consolidado", $this->eventoConsolidado);
      }
      $this->db->where("date(er.Evento_Fecha)>=", $this->fechaInicio);
      $this->db->where("date(er.Evento_Fecha)<=", $this->fechaFin);
      $this->db->where_in("er.Evento_Estado_Codigo", $estados);
      $this->db->group_by("er.Evento_Registro_Numero");
      return $this->db->get();
  }
  public function listaEventosNacional()
  {
      $estados = array("1","2");
    $this->db->select("departamento.Nombre as Region,provincia.nombre as Provincia,distrito.nombre as Distrito");
    $this->db->select("IFNULL(lesionados.Lesionados_01,0) As Lesionados_01");
    $this->db->select("IFNULL(fallecidos.Fallecidos_01,0) As Fallecidos_01");
    $this->db->select("IFNULL(desaparecidos.Desaparecidos_01,0) As Desaparecidos_01");
    $this->db->select("IFNULL(lesionados2.Lesionados_02,0) As Lesionados_02");
    $this->db->select("IFNULL(fallecidos2.Fallecidos_02,0) As Fallecidos_02");
    $this->db->select("IFNULL(desaparecidos2.Desaparecidos_02,0) As Desaparecidos_02");
    $this->db->select("IFNULL(entidad.IPRESS_AO,0) as IPRESS_AO");
    $this->db->select("IFNULL(entidad2.IPRESS_AI,0) as IPRESS_AI");
    $this->db->select("IFNULL(entidad3.ESSALUD_A,0) as ESSALUD_A");
    $this->db->select("IFNULL(acciones.Acciones,'-->> Sin Acciones Registradas') As Acciones");
    $this->db->select("IFNULL(brigadistas.Brigadistas_Region,0) As Brigadistas_Region");
    $this->db->select("IFNULL(brigadistas.Brigadistas_Minsa,0) As Brigadistas_Minsa");
    $this->db->select("IFNULL(brigadistas.Personal_Salud,0) as Personal_Salud");
    $this->db->select("IFNULL(brigadistas.Oferta_Movil_I,0) as Oferta_Movil_I");
    $this->db->select("IFNULL(brigadistas.Oferta_Movil_II,0) as Oferta_Movil_II");
    $this->db->select("IFNULL(brigadistas.Oferta_Movil_III,0) as Oferta_Movil_III");
    $this->db->select("IFNULL(brigadistas.Kit_Medicamentos,0) as Kit_Medicamentos");
    $this->db->select("IFNULL(brigadistas.Mochila_Emergencia,0) as Mochila_Emergencia");
    $this->db->from("ubigeo_departamento as departamento");
    $this->db->join("evento_registro as evento", "left(evento.evento_ubigeo,2)=departamento.codigo_departamento");
    $this->db->join("ubigeo_provincia as provincia", "provincia.codigo_departamento=left(evento.evento_ubigeo,2) and provincia.codigo_provincia=SUBSTRING(evento.evento_ubigeo,3,2)");
    $this->db->join("ubigeo_distrito as distrito", "distrito.codigo_departamento=left(evento.evento_ubigeo,2) and distrito.codigo_provincia=SUBSTRING(evento.evento_ubigeo,3,2) and distrito.codigo_distrito=RIGHT(evento.evento_ubigeo,2)");
    $this->db->join("(select evento_registro_numero,IFNULL(sum(ultimo),0) as 'Lesionados_01' from evento_danios_lesionados 
                where ultimo=1 and Situacion_Codigo in('01','02','03','06','07') and lesionado_personal_salud='0'
                group by evento_registro_numero) as lesionados", "lesionados.evento_registro_numero=evento.evento_registro_numero","left");
    $this->db->join("(select evento_registro_numero,IFNULL(sum(ultimo),0) as 'Fallecidos_01' from evento_danios_lesionados 
                where ultimo=1 and Situacion_Codigo ='04' and lesionado_personal_salud='0'
                group by evento_registro_numero) as fallecidos", "fallecidos.evento_registro_numero=evento.evento_registro_numero","left");			
    $this->db->join("(select evento_registro_numero,IFNULL(sum(ultimo),0) as 'Desaparecidos_01' from evento_danios_lesionados 
                where ultimo=1 and Situacion_Codigo ='05' and lesionado_personal_salud='0'
                group by evento_registro_numero) as desaparecidos", "desaparecidos.evento_registro_numero=evento.evento_registro_numero","left");	
    $this->db->join("(select evento_registro_numero,IFNULL(sum(ultimo),0) as 'Lesionados_02' from evento_danios_lesionados 
                where ultimo=1 and Situacion_Codigo in('01','02','03','06','07') and lesionado_personal_salud='1'
                group by evento_registro_numero) as lesionados2", "lesionados2.evento_registro_numero=evento.evento_registro_numero","left");
    $this->db->join("(select evento_registro_numero,IFNULL(sum(ultimo),0) as 'Fallecidos_02' from evento_danios_lesionados 
                where ultimo=1 and Situacion_Codigo ='04' and lesionado_personal_salud='1'
                group by evento_registro_numero) as fallecidos2", "fallecidos2.evento_registro_numero=evento.evento_registro_numero","left");			
    $this->db->join("(select evento_registro_numero,IFNULL(sum(ultimo),0) as 'Desaparecidos_02' from evento_danios_lesionados 
                where ultimo=1 and Situacion_Codigo ='05' and lesionado_personal_salud='1'
                group by evento_registro_numero) as desaparecidos2", "desaparecidos2.evento_registro_numero=evento.evento_registro_numero","left");	
    $this->db->join("(SELECT evento_registro_numero,Count(CodEESS) as 'IPRESS_AO' from evento_entidad_salud where Evento_Entidad_Estado=1 GROUP By evento_registro_numero) entidad", "entidad.evento_registro_numero=evento.evento_registro_numero","left");
    $this->db->join("(SELECT evento_registro_numero,Count(CodEESS) as 'IPRESS_AI' from evento_entidad_salud where Evento_Entidad_Estado=2 GROUP By evento_registro_numero) entidad2", "entidad2.evento_registro_numero=evento.evento_registro_numero","left");
    $this->db->join("(SELECT evento_entidad_salud.evento_registro_numero,Count(evento_entidad_salud.CodEESS) as 'ESSALUD_A' from evento_entidad_salud inner join md_eess on md_eess.CodEESS=evento_entidad_salud.CodEESS where evento_entidad_salud.Evento_Entidad_Estado in(1,2) and md_eess.CodInstitucion=1 GROUP By evento_entidad_salud.evento_registro_numero) entidad3", "entidad3.evento_registro_numero=evento.evento_registro_numero","left");
    $this->db->join("(SELECT left(evento_registro.evento_ubigeo,2) as Codigo_Departamento,SUBSTRING(evento_registro.evento_ubigeo,3,2) as Codigo_Provincia,
    RIGHT(evento_registro.evento_ubigeo,2) as Codigo_Distrito, GROUP_CONCAT(UPPER(concat_ws('','-->> ',evento_acciones.evento_acciones_descripcion)) SEPARATOR '\n') as 'Acciones' 
    FROM tipo_accion_entidad inner join tipo_accion on tipo_accion.tipo_accion_codigo=tipo_accion_entidad.Tipo_Accion_Codigo left join evento_acciones on evento_acciones.tipo_accion_codigo=tipo_accion.Tipo_Accion_Codigo and evento_acciones.Tipo_Accion_Entidad_Codigo=tipo_accion_entidad.Tipo_Accion_Entidad_Codigo 
    left join evento_registro on evento_registro.evento_registro_numero=evento_acciones.evento_registro_numero Group by left(evento_registro.evento_ubigeo,2),SUBSTRING(evento_registro.evento_ubigeo,3,2),RIGHT(evento_registro.evento_ubigeo,2)) as acciones", "acciones.codigo_departamento=departamento.codigo_departamento and acciones.codigo_departamento=provincia.codigo_departamento and acciones.codigo_provincia=provincia.codigo_provincia and acciones.codigo_departamento=distrito.codigo_departamento and acciones.codigo_provincia=distrito.codigo_provincia and acciones.codigo_distrito=distrito.codigo_distrito","left");
    $this->db->join("(select evento_registro_numero,IFNULL(sum(Evento_Acciones_Region),0) as 'Brigadistas_Region',IFNULL(sum(Evento_Acciones_Minsa),0) as 'Brigadistas_Minsa',IFNULL(Sum(Evento_Acciones_Minsa_Samu+Evento_Acciones_Salud_Minsa),0) As 'Personal_Salud',IFNULL(SUM(Evento_Kit_Medicamentos_Insumos),0) As 'Kit_Medicamentos',IFNULL(SUM(Evento_Acciones_Oferta_Movil_i),0) As 'Oferta_Movil_I',IFNULL(SUM(Evento_Acciones_Oferta_Movil_ii),0) As 'Oferta_Movil_II',IFNULL(SUM(Evento_Acciones_Oferta_Movil_iii),0) As 'Oferta_Movil_III',IFNULL(SUM(Evento_Acciones_Mochilas_Emergencia),0) As 'Mochila_Emergencia' from evento_acciones group by evento_registro_numero) as brigadistas", "brigadistas.evento_registro_numero=evento.evento_registro_numero","left");
    $datosUbigeo = $this->ubigeo;
if ($datosUbigeo[0] != "0") {
    $this->db->where("left(evento.evento_ubigeo,2)", $datosUbigeo[0]);
}
if ($datosUbigeo[1] != "0") {
    $this->db->where("SUBSTRING(evento.evento_ubigeo,3,2)", $datosUbigeo[1]);
}
if ($datosUbigeo[2] != "0") {
    $this->db->where("SUBSTRING(evento.evento_ubigeo,5,2)", $datosUbigeo[2]);
}

if ($this->nivelEmergencia != "0") {
    $this->db->where("evento_registro.Evento_Nivel_Codigo", $this->nivelEmergencia);
}
if ($this->tipoEvento != "0") {
    $this->db->where("evento_registro.Evento_Tipo_Codigo", $this->tipoEvento);
}
if ($this->evento != "0") {
    $this->db->where("er.Evento_Codigo", $this->evento);
}
if ($this->detalle != "0") {
  $this->db->where("er.Evento_Detalle_Codigo", $this->detalle);
}
if ($this->eventoConsolidado != "99") {
  $this->db->where("evento_registro.Evento_Consolidado", $this->eventoConsolidado);
}
$this->db->where("Evento_Fecha>=", $this->fechaInicio);
$this->db->where("Evento_Fecha<=", $this->fechaFin);
$this->db->group_by("departamento.Nombre,provincia.nombre,distrito.nombre,acciones.Acciones");
return $this->db->get();
  }
  public function listaEventosIPRESS()
  {
      $estados = array("1","2");
$this->db->select("ri.nombre_institucion as 'INSTITUCION', CASE ees.Evento_Entidad_Estado When '1' Then 'AFECTADO_OPERATIVO' When '2' Then 'AFECTADO_INOPERATIVO' End As 'ESTADO', er.Evento_Secuencia as 'SIREED', ees.CodEESS as 'RENIPRESS', re.categoria as 'CATEGORIA', re.nombre as 'NOMBRE', re.region as 'REGION', re.provincia as 'PROVINCIA', re.distrito as 'DISTRITO', re.ubigeo as 'UBIGEO', UPPER(er.evento_descripcion) as 'DESCRIPCION', e.evento_nombre as 'TIPO_EVENTO', er.Evento_Fecha as 'FECHA_HORA', DATE_FORMAT(ees.recuperacion_operatividad, '%d/%m/%Y') as 'RECUPERACION_OPER', DATE_FORMAT(er.Evento_Fecha_Actualizacion, '%d/%m/%Y') as 'FECHA_INFORME', ees.lugar as 'CONTINGENCIA'");
$this->db->from("evento_entidad_salud as ees, evento_registro as er, renipress as re, renipress_institucion as ri, evento as e");
$this->db->where("ees.Evento_Registro_Numero = er.Evento_Registro_Numero");
$this->db->where("ees.CodEESS = re.codigo_renipress ");
$this->db->where("re.codigo_institucion = ri.codigo_institucion");
$this->db->where("e.Evento_Tipo_Codigo = er.Evento_Tipo_Codigo");
$this->db->where("er.evento_codigo = e.evento_codigo");
$datosUbigeo = $this->ubigeo;
if ($datosUbigeo[0] != "0") {
    $this->db->where("SUBSTRING(re.codigo_region,1,2)", $datosUbigeo[0]);
}
if ($datosUbigeo[1] != "0") {
    $this->db->where("SUBSTRING(re.codigo_provincia,1,2)", $datosUbigeo[1]);
}
if ($datosUbigeo[2] != "0") {
    $this->db->where("SUBSTRING(re.codigo_distrito,1,2)", $datosUbigeo[2]);
}
if ($this->nivelEmergencia != "0") {
    $this->db->where("er.Evento_Nivel_Codigo", $this->nivelEmergencia);
}
if ($this->tipoEvento != "0") {
    $this->db->where("er.Evento_Tipo_Codigo", $this->tipoEvento);
}
if ($this->evento != "0") {
    $this->db->where("er.Evento_Codigo", $this->evento);
}
if ($this->detalle != "0") {
  $this->db->where("er.Evento_Detalle_Codigo", $this->detalle);
}
if ($this->eventoConsolidado != "99") {
  $this->db->where("er.Evento_Consolidado", $this->eventoConsolidado);
}
$this->db->where("date(er.Evento_Fecha)>=", $this->fechaInicio);
$this->db->where("date(er.Evento_Fecha)<=", $this->fechaFin);
return $this->db->get();
  }
  public function listaPorOfertaMovil()
  {
      $estados = array("1","2");
      $idrol = $this->session->userdata("idrol");
      $codigoRegion = $this->session->userdata("Codigo_Region");
      $this->db->select("Evento_Coordenadas,Evento_Secuencia,er.Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
      $this->db->select("DATE_FORMAT(Evento_Fecha_Registro,'%Y') ANIO,et.Evento_Tipo_Nombre tipoEvento, er.Evento_Descripcion");
      $this->db->select("Evento_Ubigeo_Descripcion ubigeo,Evento_Estado_Codigo,COUNT(efa.Evento_Ficha_Atencion_ID) total");
      $this->db->from("evento_registro er");
      $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
      $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
      $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
      $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
      $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
      $this->db->join("evento_ficha_atencion efa", "efa.Evento_Registro_Numero=er.Evento_Registro_Numero");
      if($idrol=="02" or $idrol=="03"){
          $this->db->where("SUBSTRING(Evento_Ubigeo,1,2)",$codigoRegion);
      }
      $this->db->where_in("er.Evento_Estado_Codigo", $estados);
      $this->db->group_by("er.Evento_Registro_Numero");
      $this->db->order_by("er.Evento_Fecha", "DESC");
      return $this->db->get();
  }
  public function listaEventosPorAnioYMes() {
      $estados = array("1","2");
      $idrol = $this->session->userdata("idrol");
      $codigoRegion = $this->session->userdata("Codigo_Region");
      $this->db->select("Evento_Coordenadas,Evento_Ubigeo, Evento_Ubigeo_Descripcion, Evento_Secuencia,er.Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
      $this->db->select("DATE_FORMAT(Evento_Fecha_Registro,'%Y') ANIO,er.Evento_Descripcion,et.Evento_Tipo_Nombre tipoEvento");
      $this->db->select("er.Evento_Tipo_Codigo tipoEventoCodigo, er.Evento_Detalle_Codigo eventoDetalleCodigo, er.Evento_Codigo eventoCodigo");
      $this->db->select("Evento_Ubigeo_Descripcion ubigeo,Evento_Estado_Codigo");
      $this->db->from("evento_registro er");
      $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
      $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
      $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
      $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
      $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
      if($idrol=="02" or $idrol=="03"){
          $this->db->where("SUBSTRING(Evento_Ubigeo,1,2)",$codigoRegion);
      }
      $this->db->where_in("er.Evento_Estado_Codigo", $estados);
      $this->db->where("YEAR(er.Evento_Fecha)", $this->anio);
      $this->db->where("MONTH(er.Evento_Fecha)", $this->mes);
      $this->db->group_by("er.Evento_Registro_Numero");
      $this->db->order_by("er.Evento_Fecha", "DESC");
      return $this->db->get();
  }
  public function listaEventosOfertaMovil() {
      $this->db->select("Evento_Tipo_Entidad_Atencion_Registro_ID id, Evento_Registro_Numero");
      $this->db->select("Evento_Tipo_Entidad_Atencion_Registro_Descripcion descripcion,Evento_Tipo_Entidad_Atencion_Registro_Prioridad prioridad");
      $this->db->from("evento_tipo_entidad_atencion_registro");
      $this->db->where_in("estado",array("1","2"));
      return $this->db->get();
  }
  public function listaPorAtencion() {
          $estados = array("1","2");
          $idrol = $this->session->userdata("idrol");
          $codigoRegion = $this->session->userdata("Codigo_Region");
          $this->db->select("Evento_Coordenadas,Evento_Secuencia,er.Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
          $this->db->select("DATE_FORMAT(Evento_Fecha_Registro,'%Y') ANIO,et.Evento_Tipo_Nombre tipoEvento, er.Evento_Descripcion");
          $this->db->select("Evento_Ubigeo_Descripcion ubigeo,Evento_Estado_Codigo,efa.Evento_Tipo_Entidad_Atencion_Registro_ID id,efa.Evento_Tipo_Entidad_Atencion_Registro_Descripcion descripcionAtencion");
          $this->db->from("evento_registro er");
          $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
          $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
          $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
          $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
          $this->db->join("evento_fuente ef", "ef.evento_fuente_codigo=er.evento_fuente_codigo");
          $this->db->join("evento_tipo_entidad_atencion_registro efa", "efa.Evento_Registro_Numero=er.Evento_Registro_Numero");
          if($idrol=="02" or $idrol=="03"){
              $this->db->where("SUBSTRING(Evento_Ubigeo,1,2)",$codigoRegion);
          }
          $this->db->where_in("er.Evento_Estado_Codigo", $estados);
          $this->db->group_by("er.Evento_Registro_Numero");
          $this->db->order_by("er.Evento_Fecha", "DESC");
          return $this->db->get();
  }
  public function registrarAtencionRegistro() {
      $data = array(         
          "Evento_Tipo_Entidad_Atencion_Registro_Descripcion" => $this->descripcionGeneral,
          "Evento_Registro_Numero" => $this->id,
          "Evento_Tipo_Entidad_Atencion_Registro_Prioridad" => 0
      );
      if ($this->db->insert('evento_tipo_entidad_atencion_registro', $data))
          return $this->db->insert_id();
      else
          return 0;
  }
  public function editarAtencionRegistro() {
      $this->db->set("Evento_Tipo_Entidad_Atencion_Registro_Descripcion", $this->descripcionGeneral, TRUE);
      $this->db->set("Evento_Registro_Numero", $this->idrol, TRUE);    
      $this->db->where("Evento_Tipo_Entidad_Atencion_Registro_ID", $this->id);
      if ($this->db->update('evento_tipo_entidad_atencion_registro'))
          return $this->id;
      else
          return 0;
  }
  public function existeAtencionRegistro() {
      $this->db->select("Evento_Registro_Numero");
      $this->db->from("evento_tipo_entidad_atencion_registro");
      $this->db->where("Evento_Registro_Numero",$this->id);
      $condicion = false;
      $cantidad = $this->db->get();
      if($cantidad->num_rows() > 0) {
          $condicion = true;
      }
      return $condicion;
  }
  public function existeAtencionRegistroDiferenteId() {
      $this->db->select("Evento_Registro_Numero");
      $this->db->from("evento_tipo_entidad_atencion_registro");
      $this->db->where("Evento_Registro_Numero",$this->idrol);
      $this->db->where("Evento_Tipo_Entidad_Atencion_Registro_ID!=",$this->id);
      $condicion = false;
      $cantidad = $this->db->get();
      if($cantidad->num_rows() > 0) {
          $condicion = true;
      }
      return $condicion;
  }
  public function eliminarAtencion()
  {
      $this->db->db_debug = FALSE;
      $this->db->where("Evento_Tipo_Entidad_Atencion_Registro_ID", $this->id);
      if ($this->db->delete('evento_tipo_entidad_atencion_registro'))
        return true;
      else {
        return false;
      }
  }
  public function eventoRegistroByTipoEventoAndEventoAndDetalleEvento() {
      $this->db->select("COUNT(1) as total");
      $this->db->from("evento_registro");
      $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
      $this->db->where("Evento_Codigo", $this->evento);
      $this->db->where("Evento_Detalle_Codigo", $this->detalle);
      return $this->db->get();
  }
  public function eventoRegistroByEventoFuente() {
      $this->db->select("COUNT(1) as total");
      $this->db->from("evento_registro");
      $this->db->where("Evento_Fuente_Codigo", $this->fuenteInicial);
      return $this->db->get();
  }
  public function mapaEventosFiltro() {
      $this->db->select("er.Evento_Registro_Numero,er.Evento_Nivel_Codigo,er.Evento_Coordenadas,er.Evento_Tipo_Codigo, ef.Evento_Fuente_Descripcion, en.Evento_Nivel_Nombre, er.Evento_Codigo");
      $this->db->from("evento_registro er");
      $this->db->join("evento_fuente ef", "er.Evento_Fuente_Codigo = ef.Evento_Fuente_Codigo");
      $this->db->join("evento_nivel en", "er.Evento_Nivel_Codigo = en.Evento_Nivel_Codigo");
      if ($this->departamento>0) {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,1,2)",$this->departamento);
      }
      if ($this->provincia>0) {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,3,2)",$this->provincia);
      }
      if ($this->distrito>0) {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,5,2)",$this->distrito);
      }
      if ($this->tipoEvento>0) {
          $this->db->where("er.Evento_Tipo_Codigo",$this->tipoEvento);
      }
      if ($this->evento>0) {
          $this->db->where("er.Evento_Codigo",$this->evento);
      }
      if ($this->nivelEmergencia>0) {
          $this->db->where("er.Evento_Nivel_Codigo",$this->nivelEmergencia);
      }
      if ($this->eventoConsolidado>0) {
          $this->db->where("er.evento_consolidado",$this->eventoConsolidado);
      }
      $this->db->where("DATE(Evento_Fecha) >=",$this->fechaInicio);
      $this->db->where("DATE(Evento_Fecha) <=",$this->fechaFin);
      $this->db->where_in("Evento_Estado_Codigo",$this->ocurrencia);
      return $this->db->get();
  }
  public function mapaEventosAsociadoFiltro() {
    $this->db->select("er.Evento_Registro_Numero,er.Evento_Nivel_Codigo,er.Evento_Coordenadas,er.Evento_Tipo_Codigo, ef.Evento_Fuente_Descripcion, en.Evento_Nivel_Nombre, er.Evento_Codigo");
    $this->db->from("evento_registro er");
    $this->db->join("evento_fuente ef", "er.Evento_Fuente_Codigo = ef.Evento_Fuente_Codigo");
    $this->db->join("evento_nivel en", "er.Evento_Nivel_Codigo = en.Evento_Nivel_Codigo");
    $this->db->join("evento_asociado eas", "er.evento_asociado_id = eas.evento_asociado_id");
    if ($this->departamento>0) {
        $this->db->where("eas.evento_asociado_id",$this->departamento);
    }
    return $this->db->get();
}
public function mapaIpressFiltro() {
    $this->db->select("er.Evento_Registro_Numero,er.Evento_Nivel_Codigo,er.Evento_Coordenadas,er.Evento_Tipo_Codigo, ef.Evento_Fuente_Descripcion, en.Evento_Nivel_Nombre");
    $this->db->select("ees.Evento_Entidad_salud,eess.Norte latitud,eess.Este longitud,eess.Nombre,eess.Direccion,ees.Evento_Entidad_Estado");
    $this->db->from("evento_entidad_salud ees");
    $this->db->join("renipress eess","ees.CodEESS=eess.codigo_renipress");
    $this->db->join("evento_registro er","er.Evento_Registro_Numero=ees.Evento_Registro_Numero");
    $this->db->join("evento_fuente ef", "er.Evento_Fuente_Codigo = ef.Evento_Fuente_Codigo");
    $this->db->join("evento_nivel en", "er.Evento_Nivel_Codigo = en.Evento_Nivel_Codigo");
    if ($this->departamento>0) {
        $this->db->where("SUBSTRING(er.Evento_Ubigeo,1,2)",$this->departamento);
    }
    if ($this->provincia>0) {
        $this->db->where("SUBSTRING(er.Evento_Ubigeo,3,2)",$this->provincia);
    }
    if ($this->distrito>0) {
        $this->db->where("SUBSTRING(er.Evento_Ubigeo,5,2)",$this->distrito);
    }
    if ($this->tipoEvento>0) {
        $this->db->where("er.Evento_Tipo_Codigo",$this->tipoEvento);
    }
    if ($this->evento>0) {
        $this->db->where("er.Evento_Codigo",$this->evento);
    }
    if ($this->nivelEmergencia>0) {
        $this->db->where("er.Evento_Nivel_Codigo",$this->nivelEmergencia);
    }
    if ($this->eventoConsolidado>0) {
        $this->db->where("er.evento_consolidado",$this->eventoConsolidado);
    }
    $this->db->where("DATE(Evento_Fecha) >=",$this->fechaInicio);
    $this->db->where("DATE(Evento_Fecha) <=",$this->fechaFin);
    $this->db->where_in("Evento_Estado_Codigo",$this->ocurrencia);
    return $this->db->get(); 
}
  public function filtrosEvento() {
      $estados = array("1","2");
      $idrol = $this->session->userdata("idrol");
      $codigoRegion = $this->session->userdata("Codigo_Region");
      $this->db->select("Evento_Coordenadas,Evento_Secuencia,er.Evento_Registro_Numero,Evento_Nombre evento,Evento_Detalle_Nombre eventoDetalle,DATE_FORMAT(Evento_Fecha,'%d/%m/%Y %H:%i') as fecha");
      $this->db->select("DATE_FORMAT(Evento_Fecha_Registro,'%Y') ANIO,et.Evento_Tipo_Nombre tipoEvento, er.Evento_Descripcion");
      $this->db->select("Evento_Ubigeo_Descripcion ubigeo,Evento_Estado_Codigo");
      $this->db->from("evento_registro er");
      $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
      $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
      $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
      $this->db->join("evento_nivel en", "en.evento_nivel_codigo=er.evento_nivel_codigo");
      if ($this->departamento>0) {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,1,2)",$this->departamento);
      }
      if ($this->provincia>0) {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,3,2)",$this->provincia);
      }
      if ($this->distrito>0) {
          $this->db->where("SUBSTRING(er.Evento_Ubigeo,5,2)",$this->distrito);
      }
      if ($this->tipoEvento>0) {
          $this->db->where("er.Evento_Tipo_Codigo",$this->tipoEvento);
      }
      if ($this->evento>0) {
          $this->db->where("er.Evento_Codigo",$this->evento);
      }
      if ($this->nivelEmergencia>0) {
          $this->db->where("er.Evento_Nivel_Codigo",$this->nivelEmergencia);
      }
      $this->db->where("DATE(er.Evento_Fecha) >=",$this->fechaInicio);
      $this->db->where("DATE(er.Evento_Fecha) <=",$this->fechaFin);
      $this->db->where_in("er.Evento_Estado_Codigo", $estados);
      return $this->db->get();
  }
  public function filtrosUbigeo() {
    $this->db->select("concat_ws('',ubigeo_departamento.codigo_departamento,ubigeo_provincia.Codigo_Provincia,'00') as 'ubigeo'");
    $this->db->select("ubigeo_departamento.codigo_departamento as codigo_departamento,ubigeo_departamento.nombre as 'region'");
    $this->db->select("ubigeo_provincia.Codigo_Provincia as codigo_provincia ,ubigeo_provincia.Nombre as 'provincia'");
    $this->db->from("ubigeo_departamento");
    $this->db->join("ubigeo_provincia", "ubigeo_provincia.Codigo_Departamento=ubigeo_departamento.Codigo_Departamento");
    if ($this->departamento>0) {
        $this->db->where("ubigeo_departamento.Codigo_Departamento",$this->departamento);
    }
    return $this->db->get();
}
}