<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class TableroControl_model extends CI_Model
{
    private $id;
    private $Anio_Ejecucion;
    private $Codigo_Area;    
    private $Codigo_Indicador;
    private $Id_Actividad_POI;
    private $Codigo_Usuario;
    private $codigo_mes;
    private $Cantidad;
    private $Archivo;
    private $Activo;
    private $Codigo_Pliego;
    private $Codigo_Ejecutora;
    private $Codigo_Centro_Costos;
    private $Codigo_Sub_Centro_Costos;
    private $costo;
    private $Nombre_Archivo;
    private $Numero_Documento;
    private $Observaciones;
    private $Logro;
    public function setId($data){ $this->id = $this->db->escape_str($data);}
    public function setAnio_Ejecucion($data){ $this->Anio_Ejecucion = $this->db->escape_str($data);}
    public function setCodigo_Area($data){ $this->Codigo_Area = $this->db->escape_str($data);}
    public function setCodigo_Indicador($data){ $this->Codigo_Indicador = $this->db->escape_str($data);}
    public function setId_Actividad_POI($data){ $this->Id_Actividad_POI = $this->db->escape_str($data);}
    public function setCodigo_Usuario($data){ $this->Codigo_Usuario = $this->db->escape_str($data);}
    public function setCodigo_mes($data){ $this->codigo_mes = $this->db->escape_str($data);}
    public function setCantidad($data){ $this->Cantidad = $this->db->escape_str($data);}
    public function setArchivo($data){ $this->Archivo = $this->db->escape_str($data);}
    public function setActivo($data){$this->Activo = $this->db->escape_str($data);}
    public function setCodigo_Pliego($data){$this->Codigo_Pliego = $this->db->escape_str($data);}
    public function setCodigo_Ejecutora($data){$this->Codigo_Ejecutora = $this->db->escape_str($data);}
    public function setCodigo_Centro_Costos($data){$this->Codigo_Centro_Costos = $this->db->escape_str($data);}
    public function setCodigo_Sub_Centro_Costos($data){$this->Codigo_Sub_Centro_Costos = $this->db->escape_str($data);}
    public function setCosto($data){$this->costo = $this->db->escape_str($data);}
    public function setNombre_Archivo($data) {$this->Nombre_Archivo = $this->db->escape_str($data);}
    public function setNumero_Documento($data) {$this->Numero_Documento = $this->db->escape_str($data);}
    public function setObservaciones($data) {$this->Observaciones = $this->db->escape_str($data);}
    public function setLogro($data) {$this->Logro = $this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function insertar()
    {
        $data = array(
            "Anio_Ejecucion" => $this->Anio_Ejecucion,
            "Codigo_Area" => $this->Codigo_Area,
            "Id_Actividad_POI" => $this->Id_Actividad_POI,
            "Cantidad" => $this->Cantidad,
            "Archivo" => $this->Archivo,
            "codigo_mes" => $this->codigo_mes,
            "Codigo_Usuario" => $this->Codigo_Usuario,
            "Fecha_Creacion" => date("Y-m-d H:i:s"),
            "Activo" => $this->Activo,
            "costo" => $this->costo,
            "Nombre_Archivo" => $this->Nombre_Archivo,
            "Numero_Documento" => $this->Numero_Documento,
            "Observaciones" => $this->Observaciones,
            "Logros" => $this->Logro
        );
        if ($this->db->insert('tablero_control', $data))
            return $this->db->insert_id();
        else
            return 0;
    }
    public function lista()
    {
        $this->db->select("TC.Anio_Ejecucion,AP.Id_Actividad_POI,AP.Codigo_Actividad_POI,AP.descripcion_actividad,TA.Nombre_Area,TC.Nombre_Archivo,TC.Numero_Documento,TC.Observaciones,TC.Logros");
        $this->db->select("UM.nombre_unidad_medida,TM.nombre_mes,TC.Cantidad,AP.Codigo_Actividad_proyecto,AP.codigo_actividad,TC.costo");
        $this->db->select("AP.Codigo_Programa_presupuestal,AP.Codigo_Finalidad,TC.Archivo,TC.Activo,TA.Codigo_Area,TC.id_tablero_control id,UM.Codigo_Unidad_Medida,TM.codigo_mes,TC.Codigo_Area");
        $this->db->from("tablero_control TC");
        $this->db->join("tablero_actividad_poi AP","TC.anio_ejecucion=AP.anio_ejecucion And TC.Id_Actividad_POI = AP.Id_Actividad_POI");
        $this->db->join("tablero_unidad_medida UM","UM.codigo_unidad_medida=AP.codigo_unidad_medida");
        $this->db->join("tablero_mes TM","TM.codigo_mes = TC.codigo_mes");
        $this->db->join("tablero_area TA","TA.Codigo_Area = TC.codigo_Area and TA.anio_ejecucion=TC.anio_ejecucion");
        if ($this->session->userdata("idrol") != '01') {
            $this->db->where_in("TC.Codigo_Area", $this->Codigo_Area);
        }
        if($this->Codigo_Area){
            $this->db->where_in("TC.Codigo_Area", $this->Codigo_Area);
        }
        if($this->codigo_mes){
            $this->db->where_in("TC.codigo_mes", $this->codigo_mes);
        }
        $this->db->where("TC.Anio_Ejecucion", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function listaPorArea()
    {
        $this->db->select("TC.Anio_Ejecucion,AP.Id_Actividad_POI,AP.Codigo_Actividad_POI,AP.descripcion_actividad,TA.Nombre_Area,TC.Nombre_Archivo,TC.Numero_Documento,TC.Observaciones, TC.Logros");
        $this->db->select("UM.nombre_unidad_medida,TM.nombre_mes,TC.Cantidad,AP.Codigo_Actividad_proyecto,AP.codigo_actividad,TC.costo");
        $this->db->select("AP.Codigo_Programa_presupuestal,AP.Codigo_Finalidad,TC.Archivo,TC.Activo,TA.Codigo_Area,TC.id_tablero_control id,UM.Codigo_Unidad_Medida,TM.codigo_mes,TC.Codigo_Area");
        $this->db->from("tablero_control TC");
        $this->db->join("tablero_actividad_poi AP","TC.anio_ejecucion=AP.anio_ejecucion And TC.Id_Actividad_POI = AP.Id_Actividad_POI");
        $this->db->join("tablero_unidad_medida UM","UM.codigo_unidad_medida=AP.codigo_unidad_medida");
        $this->db->join("tablero_mes TM","TM.codigo_mes = TC.codigo_mes");
        $this->db->join("tablero_area TA","TA.Codigo_Area = TC.codigo_Area and TA.anio_ejecucion=TC.anio_ejecucion");
        $this->db->where("AP.Id_Actividad_POI", $this->Id_Actividad_POI);
        return $this->db->get();
    }
    public function grafico()
    {
        $this->db->select("Actividad_POI,P_I_Trim,P_II_Trim,P_III_Trim,P_IV_Trim,E_I_Trim,E_II_Trim,E_III_Trim,E_IV_Trim");
        $this->db->from("programacion_tablero_vs_ejecucion_trimestral");
        $this->db->where("Anio", $this->Anio_Ejecucion);
        $this->db->where("ID", $this->Id_Actividad_POI);
        $this->db->order_by("ID ASC");
        return $this->db->get();
    }
    public function obtenerGraficoAreas()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Area,Nombre_Area,Siglas_Area,Cantidad,Ejecutado,Costo,Invertido,P_Ejecutado,P_Invertido");
        $this->db->from("vista_tablero_control_05");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->order_by("Codigo_Area ASC");
        return $this->db->get();
    }
    public function graficoPorcentaje()
    {
        $this->db->select("Anio,ID,Actividad_POI, ROUND(coalesce((E_I_Trim * 100) / P_I_Trim,0),2) As I_Trim,ROUND(coalesce((E_II_Trim * 100) / P_II_Trim,0),2) As II_Trim");
        $this->db->select("ROUND(coalesce((E_III_Trim * 100) / P_III_Trim,0),2) As III_Trim,ROUND(coalesce((E_IV_Trim * 100) / P_IV_Trim,0),2) As IV_Trim");
        $this->db->from("programacion_tablero_vs_ejecucion_trimestral");
        $this->db->where("Anio", $this->Anio_Ejecucion);
        $this->db->where("ID", $this->Id_Actividad_POI);
        $this->db->order_by("ID ASC");
        return $this->db->get();
    }
    public function actualizar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Anio_Ejecucion" , $this->Anio_Ejecucion, TRUE);
        $this->db->set("Codigo_Area" , $this->Codigo_Area, TRUE);
        $this->db->set("Id_Actividad_POI" , $this->Id_Actividad_POI, TRUE);
        $this->db->set("Cantidad" , $this->Cantidad, TRUE);
        $this->db->set("codigo_mes" , $this->codigo_mes, TRUE);
        $this->db->set("Usuario_Actualizacion" , $this->Codigo_Usuario, TRUE);
        $this->db->set("Fecha_Actualizacion" , date("Y-m-d H:i:s"));
        $this->db->set("costo" , $this->costo);
        $this->db->set("Nombre_Archivo", $this->Nombre_Archivo);
        $this->db->set("Numero_Documento", $this->Numero_Documento);
        $this->db->set("Observaciones", $this->Observaciones);
        $this->db->set("Logros", $this->Logro);
        $this->db->where("id_tablero_control", $this->id);
        $error = array();
        if ($this->db->update('tablero_control'))
            return 1;
        else {
            return 0;
        }
    }
    public function actualizarArchivo(){
        $this->db->db_debug = FALSE;
        $this->db->set("Archivo" , $this->Archivo, TRUE);        
        $this->db->where("id_tablero_control", $this->id);
        $error = array();
        if ($this->db->update('tablero_control'))
            return 1;
            else {
                return 0;
            }
    }
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("id_tablero_control", $this->id);
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
        $this->db->set("Usuario_Actualizacion", $this->Codigo_Usuario, TRUE);
        $this->db->set("Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("id_tablero_control", $this->id);
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
        $this->db->set("Usuario_Actualizacion", $this->Codigo_Usuario, TRUE);
        $this->db->set("Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("id_tablero_control", $this->id);
        $error = array();
        if ($this->db->update('tablero_control'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function buscarPorIndicador()
    {
        $this->db->select("1");
        $this->db->from("tablero_control");
        $this->db->where("Codigo_Indicador", $this->Codigo_Indicador);
        return $this->db->get();
    }
    public function obtenerCantidadActividadPOI(){
        $this->db->select("count(*) as total");
        $this->db->from("tablero_actividad_poi");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Activo", "1");
        return $this->db->get();
    }
    public function obtenerUnidadesFuncionalesActivas(){
        $this->db->select("count(*) as total");
        $this->db->from("tablero_area");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Activo", "1");
        $this->db->where("Mostrar", "1");
        $this->db->where_not_in("Codigo_Area", "00");
        return $this->db->get();
    }
    public function obtenerActividadesPresupuestales(){
        $this->db->select("COUNT(DISTINCT Codigo_Actividad) as total");
        $this->db->from("tablero_actividad_poi");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Activo", "1");
        return $this->db->get();
    }
    public function obtenerCantidadProductos(){
        $this->db->select("COUNT(DISTINCT Codigo_Actividad_Proyecto) as total");
        $this->db->from("tablero_actividad_proyecto");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Activo", "1");
        return $this->db->get();
    }
    public function obtenerPlanEjecucionMensual(){
        $this->db->select("Anio_Ejecucion, Codigo_Actividad, Nombre_Actividad, Und_Med, P_ENE, E_ENE");
        $this->db->select("P_FEB, E_FEB, P_MAR, E_MAR, P_ABR, E_ABR, P_MAY, E_MAY, P_JUN, E_JUN, P_JUL");
        $this->db->select("E_JUL, P_AGO, E_AGO, P_SEP, E_SEP, P_OCT, E_OCT, P_NOV, E_NOV, P_DIC, E_DIC");
        $this->db->from("Ceplan_Ejecucion_Tablero_Mensual_Actividades ejec");
        $this->db->where("anio_ejecucion", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function buscarPorActividadPOI()
    {
        $this->db->select("1");
        $this->db->from("tablero_control");
        $this->db->where("Id_Actividad_POI", $this->Id_Actividad_POI);
        return $this->db->get();
    }
    public function buscarPorAnioIndicadorTarea()
    {
        $this->db->select("1");
        $this->db->from("tablero_control");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Codigo_Indicador", $this->Codigo_Indicador);
        $this->db->where("Codigo_Tarea", $this->Codigo_Tarea);
        return $this->db->get();
    }
    public function archivoTableroControl(){
        $this->db->select("Archivo");
        $this->db->from("tablero_control");        
        $this->db->where("id_tablero_control", $this->id);
        return $this->db->get();
    }
    public function graficoPorcentajeSemestral1(){
        $this->db->select("Anio,ID,Actividad_POI,P_ENE,E_ENE,P_FEB,E_FEB,P_MAR,E_MAR,P_ABR,E_ABR,P_MAY,E_MAY,P_JUN,E_JUN");
        $this->db->from("programacion_tablero_vs_ejecucion_semestre_01");
        $this->db->where("Anio", $this->Anio_Ejecucion);
        $this->db->where("ID", $this->Id_Actividad_POI);
        $this->db->order_by("ID ASC");
        return $this->db->get();                
    }    
    public function graficoPorcentajeSemestral2(){
        $this->db->select("Anio,ID,Actividad_POI,P_JUL,E_JUL,P_AGO,E_AGO,P_SEP,E_SEP,P_OCT,E_OCT,P_NOV,E_NOV,P_DIC,E_DIC");
        $this->db->from("programacion_tablero_vs_ejecucion_semestre_02");
        $this->db->where("Anio", $this->Anio_Ejecucion);
        $this->db->where("ID", $this->Id_Actividad_POI);
        $this->db->order_by("ID ASC");
        return $this->db->get();         
    }   
}