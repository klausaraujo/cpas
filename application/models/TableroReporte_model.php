<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class TableroReporte_model extends CI_Model
{
    private $Anio_Ejecucion;
    private $Codigo_Sector;
    private $Codigo_Pliego;
    private $Codigo_Ejecutora;
    private $Codigo_Centro_Costos;
    private $Codigo_Sub_Centro_Costos;
    private $Codigo_POI;
    private $Codigo_Objetivo_Estrategico;
    private $Codigo_Accion_Estrategica;
    private $Codigo_Programa_Presupuestal;
    private $Codigo_Finalidad;
    private $Codigo_Unidad_Medida;
    private $Codigo_Area;
    private $Codigo_Actividad_Proyecto;
    private $Codigo_Actividad;
    private $Codigo_Indicador;
    private $Codigo_Tarea;
    private $Codigo_Proceso;
    private $Enero;
    private $Febrero;
    private $Marzo;
    private $Abril;
    private $Mayo;
    private $Junio;
    private $Julio;
    private $Agosto;
    private $Septiembre;
    private $Octubre;
    private $Noviembre;
    private $Diciembre;
    private $Codigo_Usuario;
    private $Activo;
    public function setAnio_Ejecucion($data)
    {
        $this->Anio_Ejecucion = $this->db->escape_str($data);
    }
    public function setCodigo_Sector($data)
    {
        $this->Codigo_Sector = $this->db->escape_str($data);
    }
    public function setCodigo_Pliego($data)
    {
        $this->Codigo_Pliego = $this->db->escape_str($data);
    }
    public function setCodigo_Ejecutora($data)
    {
        $this->Codigo_Ejecutora = $this->db->escape_str($data);
    }
    public function setCodigo_Centro_Costos($data)
    {
        $this->Codigo_Centro_Costos = $this->db->escape_str($data);
    }
    public function setCodigo_Sub_Centro_Costos($data)
    {
        $this->Codigo_Sub_Centro_Costos = $this->db->escape_str($data);
    }
    public function setCodigo_POI($data)
    {
        $this->Codigo_POI = $this->db->escape_str($data);
    }
    public function setCodigo_Objetivo_Estrategico($data)
    {
        $this->Codigo_Objetivo_Estrategico = $this->db->escape_str($data);
    }
    public function setCodigo_Accion_Estrategica($data)
    {
        $this->Codigo_Accion_Estrategica = $this->db->escape_str($data);
    }
    public function setCodigo_Programa_Presupuestal($data)
    {
        $this->Codigo_Programa_Presupuestal = $this->db->escape_str($data);
    }
    public function setCodigo_Finalidad($data)
    {
        $this->Codigo_Finalidad = $this->db->escape_str($data);
    }
    public function setCodigo_Unidad_Medida($data)
    {
        $this->Codigo_Unidad_Medida = $this->db->escape_str($data);
    }
    public function setCodigo_Area($data)
    {
        $this->Codigo_Area = $this->db->escape_str($data);
    }
    public function setCodigo_Actividad_Proyecto($data)
    {
        $this->Codigo_Actividad_Proyecto = $this->db->escape_str($data);
    }

    public function setCodigo_Actividad($data)
    {
        $this->Codigo_Actividad = $this->db->escape_str($data);
    }
    public function setCodigo_Indicador($data)
    {
        $this->Codigo_Indicador = $this->db->escape_str($data);
    }
    public function setCodigo_Tarea($data)
    {
        $this->Codigo_Tarea = $this->db->escape_str($data);
    }
    public function setCodigo_Proceso($data)
    {
        $this->Codigo_Proceso = $this->db->escape_str($data);
    }
    public function setEnero($data)
    {
        $this->Enero = $this->db->escape_str($data);
    }
    public function setFebrero($data)
    {
        $this->Febrero = $this->db->escape_str($data);
    }
    public function setMarzo($data)
    {
        $this->Marzo = $this->db->escape_str($data);
    }
    public function setAbril($data)
    {
        $this->Abril = $this->db->escape_str($data);
    }
    public function setMayo($data)
    {
        $this->Mayo = $this->db->escape_str($data);
    }
    public function setJunio($data)
    {
        $this->Junio = $this->db->escape_str($data);
    }
    public function setJulio($data)
    {
        $this->Julio = $this->db->escape_str($data);
    }
    public function setAgosto($data)
    {
        $this->Agosto = $this->db->escape_str($data);
    }
    public function setSeptiembre($data)
    {
        $this->Septiembre = $this->db->escape_str($data);
    }
    public function setOctubre($data)
    {
        $this->Octubre = $this->db->escape_str($data);
    }
    public function setNoviembre($data)
    {
        $this->Noviembre = $this->db->escape_str($data);
    }
    public function setDiciembre($data)
    {
        $this->Diciembre = $this->db->escape_str($data);
    }
    public function setCodigo_Usuario($data)
    {
        $this->Codigo_Usuario = $this->db->escape_str($data);
    }
    public function setActivo($data)
    {
        $this->Activo = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function poivstablero()
    {
        $this->db->select("Codigo_Sub_Centro_Costos,Nombre_Sub_Centro_Costos,Codigo_Objetivo_Estrategico,Descripcion_Objetivo_Estrategico");
        $this->db->select("Codigo_Accion_Estrategica,Descripcion_Accion_Estrategica,Codigo_Programa_Presupuestal,Nombre_Programa_Presupuestal,Codigo_Unidad_Medida,Nombre_Unidad_Medida");
        $this->db->select("Activo,Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre,Total");
        $this->db->from("lista_detalle_poi");
        $this->db->where("Anio_Ejecucion",$this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function lista()
    {
        $this->db->select("Abreviatura_CC Costos,Abreviatura_SCC Costos2,Codigo_Finalidad,Nombre_Finalidad,Codigo_Area,Siglas_Area,Nombre_Area,Codigo_Actividad_Proyecto as Codigo_Producto");
        $this->db->select("Nombre_Actividad_Proyecto as Nombre_Producto,Codigo_Actividad,Nombre_Actividad");
        $this->db->select("Codigo_Indicador,Nombre_Indicador,Codigo_Tarea,Nombre_Tarea,Codigo_Proceso,Descripcion_Proceso,Total,Estado");
        $this->db->select("Activo,Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre,Nombre_Area");
        $this->db->from("Lista_Tablero_Detallada");
        $this->db->where("Lista_Tablero_Detallada.Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Lista_Tablero_Detallada.Codigo_Sector", $this->Codigo_Sector);
        $this->db->where("Lista_Tablero_Detallada.Codigo_Pliego", $this->Codigo_Pliego);
        $this->db->where("Lista_Tablero_Detallada.Codigo_Ejecutora", $this->Codigo_Ejecutora);
        $this->db->where("Lista_Tablero_Detallada.Codigo_Centro_Costos", $this->Codigo_Centro_Costos);
        $this->db->where("Lista_Tablero_Detallada.Codigo_Sub_Centro_Costos", $this->Codigo_Sub_Centro_Costos);
        $this->db->where("Lista_Tablero_Detallada.Codigo_Area", $this->Codigo_Area);
        return $this->db->get();
    }
    public function actualizar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Enero", $this->Enero, TRUE);
        $this->db->set("Febrero", $this->Febrero, TRUE);
        $this->db->set("Marzo", $this->Marzo, TRUE);
        $this->db->set("Abril", $this->Abril, TRUE);
        $this->db->set("Mayo", $this->Mayo, TRUE);
        $this->db->set("Junio", $this->Junio, TRUE);
        $this->db->set("Julio", $this->Julio, TRUE);
        $this->db->set("Agosto", $this->Agosto, TRUE);
        $this->db->set("Septiembre", $this->Septiembre, TRUE);
        $this->db->set("Octubre", $this->Octubre, TRUE);
        $this->db->set("Noviembre", $this->Noviembre, TRUE);
        $this->db->set("Diciembre", $this->Diciembre, TRUE);
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Codigo_Sector", $this->Codigo_Sector);
        $this->db->where("Codigo_Pliego", $this->Codigo_Pliego);
        $this->db->where("Codigo_Ejecutora", $this->Codigo_Ejecutora);
        $this->db->where("Codigo_Centro_Costos", $this->Codigo_Centro_Costos);
        $this->db->where("Codigo_Sub_Centro_Costos", $this->Codigo_Sub_Centro_Costos);
        $this->db->where("Codigo_POI", $this->Codigo_POI);
        $this->db->where("Codigo_Objetivo_Estrategico", $this->Codigo_Objetivo_Estrategico);
        $this->db->where("Codigo_Accion_Estrategica", $this->Codigo_Accion_Estrategica);
        $this->db->where("Codigo_Programa_Presupuestal", $this->Codigo_Programa_Presupuestal);
        $this->db->where("Codigo_Finalidad", $this->Codigo_Finalidad);
        $this->db->where("Codigo_Unidad_Medida", $this->Codigo_Unidad_Medida);
        $this->db->where("Codigo_Area", $this->Codigo_Area);
        $this->db->where("Codigo_Actividad_Proyecto", $this->Codigo_Actividad_Proyecto);
        $this->db->where("Codigo_Actividad", $this->Codigo_Actividad);
        $this->db->where("Codigo_Indicador", $this->Codigo_Indicador);
        $this->db->where("Codigo_Tarea", $this->Codigo_Tarea);
        $this->db->where("Codigo_Proceso", $this->Codigo_Proceso);
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        $error = array();
        if ($this->db->update('tablero_control'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Codigo_Sector", $this->Codigo_Sector);
        $this->db->where("Codigo_Pliego", $this->Codigo_Pliego);
        $this->db->where("Codigo_Ejecutora", $this->Codigo_Ejecutora);
        $this->db->where("Codigo_Centro_Costos", $this->Codigo_Centro_Costos);
        $this->db->where("Codigo_Sub_Centro_Costos", $this->Codigo_Sub_Centro_Costos);
        $this->db->where("Codigo_POI", $this->Codigo_POI);
        $this->db->where("Codigo_Objetivo_Estrategico", $this->Codigo_Objetivo_Estrategico);
        $this->db->where("Codigo_Accion_Estrategica", $this->Codigo_Accion_Estrategica);
        $this->db->where("Codigo_Programa_Presupuestal", $this->Codigo_Programa_Presupuestal);
        $this->db->where("Codigo_Finalidad", $this->Codigo_Finalidad);
        $this->db->where("Codigo_Unidad_Medida", $this->Codigo_Unidad_Medida);
        $this->db->where("Codigo_Area", $this->Codigo_Area);
        $this->db->where("Codigo_Actividad_Proyecto", $this->Codigo_Actividad_Proyecto);
        $this->db->where("Codigo_Actividad", $this->Codigo_Actividad);
        $this->db->where("Codigo_Indicador", $this->Codigo_Indicador);
        $this->db->where("Codigo_Tarea", $this->Codigo_Tarea);
        $this->db->where("Codigo_Proceso", $this->Codigo_Proceso);
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        $error = array();
        if ($this->db->delete('tablero_control'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function desactivar()
    {
        $this->db->set("Activo", "0", TRUE);
        $this->db->set("Codigo_Usuario", $this->Codigo_Usuario, TRUE);
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Codigo_Sector", $this->Codigo_Sector);
        $this->db->where("Codigo_Pliego", $this->Codigo_Pliego);
        $this->db->where("Codigo_Ejecutora", $this->Codigo_Ejecutora);
        $this->db->where("Codigo_Centro_Costos", $this->Codigo_Centro_Costos);
        $this->db->where("Codigo_Sub_Centro_Costos", $this->Codigo_Sub_Centro_Costos);
        $this->db->where("Codigo_POI", $this->Codigo_POI);
        $this->db->where("Codigo_Objetivo_Estrategico", $this->Codigo_Objetivo_Estrategico);
        $this->db->where("Codigo_Accion_Estrategica", $this->Codigo_Accion_Estrategica);
        $this->db->where("Codigo_Programa_Presupuestal", $this->Codigo_Programa_Presupuestal);
        $this->db->where("Codigo_Finalidad", $this->Codigo_Finalidad);
        $this->db->where("Codigo_Unidad_Medida", $this->Codigo_Unidad_Medida);
        $this->db->where("Codigo_Area", $this->Codigo_Area);
        $this->db->where("Codigo_Actividad_Proyecto", $this->Codigo_Actividad_Proyecto);
        $this->db->where("Codigo_Actividad", $this->Codigo_Actividad);
        $this->db->where("Codigo_Indicador", $this->Codigo_Indicador);
        $this->db->where("Codigo_Tarea", $this->Codigo_Tarea);
        $this->db->where("Codigo_Proceso", $this->Codigo_Proceso);
        $error = array();
        if ($this->db->update('tablero_control'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function activar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Activo", "1", TRUE);
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Codigo_Sector", $this->Codigo_Sector);
        $this->db->where("Codigo_Pliego", $this->Codigo_Pliego);
        $this->db->where("Codigo_Ejecutora", $this->Codigo_Ejecutora);
        $this->db->where("Codigo_Centro_Costos", $this->Codigo_Centro_Costos);
        $this->db->where("Codigo_Sub_Centro_Costos", $this->Codigo_Sub_Centro_Costos);
        $this->db->where("Codigo_POI", $this->Codigo_POI);
        $this->db->where("Codigo_Objetivo_Estrategico", $this->Codigo_Objetivo_Estrategico);
        $this->db->where("Codigo_Accion_Estrategica", $this->Codigo_Accion_Estrategica);
        $this->db->where("Codigo_Programa_Presupuestal", $this->Codigo_Programa_Presupuestal);
        $this->db->where("Codigo_Finalidad", $this->Codigo_Finalidad);
        $this->db->where("Codigo_Unidad_Medida", $this->Codigo_Unidad_Medida);
        $this->db->where("Codigo_Area", $this->Codigo_Area);
        $this->db->where("Codigo_Actividad_Proyecto", $this->Codigo_Actividad_Proyecto);
        $this->db->where("Codigo_Actividad", $this->Codigo_Actividad);
        $this->db->where("Codigo_Indicador", $this->Codigo_Indicador);
        $this->db->where("Codigo_Tarea", $this->Codigo_Tarea);
        $this->db->where("Codigo_Proceso", $this->Codigo_Proceso);
        $this->db->where("Codigo_Usuario", $this->Codigo_Usuario);
        $error = array();
        if ($this->db->update('tablero_control'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
}