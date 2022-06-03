<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Vista_model extends CI_Model
{
    private $anio;
    private $sector;
    private $pliego;
    private $ejecutora;
    private $funcion;
    private $divisionFuncional;
    private $grupoFuncional;
    private $programaPresupuestal;
    private $actividadProyecto;
    private $actividad;
    private $secuenciaFuncional;
    private $finalidad;
    private $meta;
    private $area;
    private $fuenteFinanciamiento;
    private $rubro;
    private $tipoTransaccion;
    private $generica;
    private $subGenerica;
    private $subGenericaDetalle;
    private $especifica;
    private $especificaDetalle;
    private $monto;
    private $Codigo_Indicador;
    private $Codigo_Proceso;
    public function setAnio($data)
    {
        $this->anio = $this->db->escape_str($data);
    }
    public function setSector($data)
    {
        $this->sector = $this->db->escape_str($data);
    }
    public function setPliego($data)
    {
        $this->pliego = $this->db->escape_str($data);
    }
    public function setEjecutora($data)
    {
        $this->ejecutora = $this->db->escape_str($data);
    }
    public function setFuncion($data)
    {
        $this->funcion = $this->db->escape_str($data);
    }
    public function setDivisionFuncional($data)
    {
        $this->divisionFuncional = $this->db->escape_str($data);
    }
    public function setGrupoFuncional($data)
    {
        $this->grupoFuncional = $this->db->escape_str($data);
    }
    public function setProgramaPresupuestal($data)
    {
        $this->programaPresupuestal = $this->db->escape_str($data);
    }
    public function setActividadProyecto($data)
    {
        $this->actividadProyecto = $this->db->escape_str($data);
    }
    public function setActividad($data)
    {
        $this->actividad = $this->db->escape_str($data);
    }
    public function setSecuenciaFuncional($data)
    {
        $this->secuenciaFuncional = $this->db->escape_str($data);
    }
    public function setFinalidad($data)
    {
        $this->finalidad = $this->db->escape_str($data);
    }
    public function setMeta($data)
    {
        $this->meta = $this->db->escape_str($data);
    }
    public function setArea($data)
    {
        $this->area = $this->db->escape_str($data);
    }
    public function setFuenteFinanciamiento($data)
    {
        $this->fuenteFinanciamiento = $this->db->escape_str($data);
    }
    public function setRubro($data)
    {
        $this->rubro = $this->db->escape_str($data);
    }
    public function setTipoTransaccion($data)
    {
        $this->tipoTransaccion = $this->db->escape_str($data);
    }
    public function setGenerica($data)
    {
        $this->generica = $this->db->escape_str($data);
    }
    public function setSubGenerica($data)
    {
        $this->subGenerica = $this->db->escape_str($data);
    }
    public function setSubGenericaDetalle($data)
    {
        $this->subGenericaDetalle = $this->db->escape_str($data);
    }
    public function setEspecifica($data)
    {
        $this->especifica = $this->db->escape_str($data);
    }
    public function setEspecificaDetalle($data)
    {
        $this->especificaDetalle = $this->db->escape_str($data);
    }
    public function setMonto($data)
    {
        $this->monto = $this->db->escape_str($data);
    }
    public function setCodigo_Indicador($data)
    {
        $this->Codigo_Indicador = $this->db->escape_str($data);
    }
    public function setCodigo_Proceso($data)
    {
        $this->Codigo_Proceso = $this->db->escape_str($data);
    }
    public function reporteIndicadores()
    {
        $this->db->select("ID,Anio,Indicador,Dimension,SUM(P_I_Trim) as P_I_Trim,SUM(E_I_Trim) as E_I_Trim,SUM(P_II_Trim) as P_II_Trim,SUM(E_II_Trim) as E_II_Trim");
        $this->db->select("SUM(P_III_Trim) as P_III_Trim,SUM(E_III_Trim) as E_III_Trim,SUM(P_IV_Trim) as P_IV_Trim,SUM(E_IV_Trim) as E_IV_Trim");
        $this->db->from("ejecucion_tablero_indicadores_resumen");
        $this->db->where("Anio", $this->anio);
        $this->db->group_by("ID,Anio,Indicador,Dimension");
        return $this->db->get();
    }
    public function reporteProcesos()
    {
        $this->db->select("Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Codigo_Programa_Presupuestal, Codigo_Unidad_Medida, Codigo_Area, Codigo_Actividad_Proyecto, Codigo_Actividad, Codigo_Proceso, Descripcion_Proceso, Costo_Programado, Cantidad_Programada, Siglas_Area, Nombre_Area");
        $this->db->from("lista_procesos_cantidades_2");
        $this->db->where("Anio_Ejecucion", $this->anio);
        if (strlen($this->Codigo_Proceso) > 0)
            $this->db->where("Codigo_Proceso", $this->Codigo_Proceso);

        if ($this->session->userdata("idrol") != "01") {
            $this->db->where_in("Codigo_Area", $this->area);
        }
        return $this->db->get();
    }
    public function reporteActividadPOI(){
      $this->db->select("Nombre_Unidad_Medida,P_Ene pEnero, E_Ene eEnero, P_Fec pFebrero, E_Feb eFebrero, P_Mar pMarzo, E_Mar eMarzo");
      $this->db->select("P_Abr pAbril, E_Abr eAbril, P_May pMayo, E_May eMayo, P_Jun pJunio, E_Jun eJunio, P_Jul pJulio, E_Jul eJulio");
      $this->db->select("P_Ago pAgosto, E_Ago eAgosto, P_Sep pSeptiembre, E_Sep eSeptiembre, P_Oct pOctubre, E_Oct eOctubre");
      $this->db->select("P_Nov pNoviembre, E_Nov eNoviembre, P_Dic pDiciembre, E_Dic eDiciembre,Descripcion_Proceso");
      $this->db->from("lista_procesos_programacion_mensual_ejecucion");
      $this->db->where("Anio_Ejecucion",$this->anio);
      $this->db->where("Codigo_Area",$this->area);
      return $this->db->get();
    }
}