<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Proceso_model extends CI_Model
{
    private $id;
    private $Codigo_Actividad_POI;
    private $indicador;
    private $Anio_Ejecucion;
    private $Codigo_Sector;
    private $Codigo_Pliego;
    private $Codigo_Ejecutora;
    private $Codigo_Centro_Costos;
    private $Codigo_Sub_Centro_Costos;
    private $Codigo_Programa_Presupuestal;
    private $Codigo_Unidad_Medida;
    private $Codigo_Finalidad;
    private $Codigo_Actividad_Proyecto;
    private $Codigo_Actividad;
    private $Cantidad_Programada;
    private $Descripcion_Actividad;
    private $Costo_Programado;
    private $Codigo_Area;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setCodigo_Actividad_POI($data)
    {
        $this->Codigo_Actividad_POI = $this->db->escape_str($data);
    }
    public function setIndicador($data)
    {
        $this->indicador = $this->db->escape_str($data);
    }
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
    public function setCodigo_Programa_Presupuestal($data)
    {
        $this->Codigo_Programa_Presupuestal = $this->db->escape_str($data);
    }
    public function setCodigo_Unidad_Medida($data)
    {
        $this->Codigo_Unidad_Medida = $this->db->escape_str($data);
    }
    public function setCodigo_Finalidad($data)
    {
        $this->Codigo_Finalidad = $this->db->escape_str($data);
    }
    public function setCodigo_Actividad_Proyecto($data)
    {
        $this->Codigo_Actividad_Proyecto = $this->db->escape_str($data);
    }
    public function setCodigo_Actividad($data)
    {
        $this->Codigo_Actividad = $this->db->escape_str($data);
    }
    public function setCosto_Programado($data)
    {
        $this->Costo_Programado = $this->db->escape_str($data);
    }
    public function setCantidad_Programada($data)
    {
        $this->Cantidad_Programada = $this->db->escape_str($data);
    }
    public function setDescripcion_Actividad($data)
    {
        $this->Descripcion_Actividad = $this->db->escape_str($data);
    }
    public function setCodigo_Area($data)
    {
        $this->Codigo_Area = $this->db->escape_str($data);
    }
    public function setEnero($data){$this->Enero=$this->db->escape_str($data);}
    public function setFebrero($data){$this->Febrero=$this->db->escape_str($data);}
    public function setMarzo($data){$this->Marzo=$this->db->escape_str($data);}
    public function setAbril($data){$this->Abril=$this->db->escape_str($data);}
    public function setMayo($data){$this->Mayo=$this->db->escape_str($data);}
    public function setJunio($data){$this->Junio=$this->db->escape_str($data);}
    public function setJulio($data){$this->Julio=$this->db->escape_str($data);}
    public function setAgosto($data){$this->Agosto=$this->db->escape_str($data);}
    public function setSeptiembre($data){$this->Septiembre=$this->db->escape_str($data);}
    public function setOctubre($data){$this->Octubre=$this->db->escape_str($data);}
    public function setNoviembre($data){$this->Noviembre=$this->db->escape_str($data);}
    public function setDiciembre($data){$this->Diciembre=$this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("TAP.Id_Actividad_POI As ID,TAP.anio_ejecucion as Anio,CONCAT(TAP.codigo_actividad_poi, ' - ' ,TAP.descripcion_actividad) as Actividad_POI");
        $this->db->select("TAP.Codigo_Actividad_Proyecto as 'Proyecto',TAP.Codigo_Actividad as 'Actividad'");
        $this->db->select("(TAP.Enero+TAP.Febrero+TAP.MArzo+TAP.Abril+TAP.MAyo+TAP.Junio+TAP.Julio+TAP.Agosto+TAP.Septiembre+TAP.Octubre+TAP.Noviembre+TAP.Diciembre) As Cantidad");
        $this->db->select("TAP.Costo_Programado as Costo,TUM.nombre_unidad_medida as Unidad_Medida");
        $this->db->select("TAP.Codigo_Sector,TAP.Codigo_Pliego,TAP.Codigo_Ejecutora,TAP.Codigo_Centro_Costos,TAP.Codigo_Sub_Centro_Costos,TAP.Codigo_Programa_Presupuestal,TAP.Codigo_Finalidad");
        $this->db->select("TAP.Codigo_Unidad_Medida,TAP.Codigo_Actividad_Proyecto,TAP.Codigo_Actividad,TAP.Codigo_Actividad_POI");
        $this->db->select("TAP.Enero,TAP.Febrero,TAP.Marzo,TAP.Abril,TAP.Mayo,TAP.Junio,TAP.Julio,TAP.Agosto,TAP.Septiembre,TAP.Octubre,TAP.Noviembre,TAP.Diciembre,TAP.Activo");
        $this->db->from("tablero_actividad_poi TAP"); 
        $this->db->join("tablero_unidad_medida TUM","TUM.codigo_unidad_medida=TAP.codigo_unidad_medida");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function proceso()
    {
        $this->db->select("Id_Actividad_POI,Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Codigo_Programa_Presupuestal, Codigo_Finalidad, Codigo_Unidad_Medida, Codigo_Actividad_Proyecto, Codigo_Actividad, Codigo_Actividad_POI, Descripcion_Actividad, Costo_Programado, Activo");
        $this->db->from("tablero_actividad_poi");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);

        return $this->db->get();
    }
    public function procesoArea()
    {
        $this->db->select("p.Id_Actividad_POI,p.Anio_Ejecucion, p.Codigo_Sector, p.Codigo_Pliego, p.Codigo_Ejecutora, p.Codigo_Centro_Costos, p.Codigo_Sub_Centro_Costos, p.Codigo_Programa_Presupuestal, p.Codigo_Finalidad, p.Codigo_Unidad_Medida, p.Codigo_Actividad_Proyecto, p.Codigo_Actividad, p.Codigo_Actividad_POI, p.Descripcion_Actividad, p.Costo_Programado, p.Activo");
        $this->db->from("tablero_area_actividad_poi t");
        $this->db->join("tablero_actividad_poi p","p.Id_Actividad_POI=t.Id_Actividad_POI");
        $this->db->where("t.Anio_Ejecucion",$this->Anio_Ejecucion);
        $this->db->where("t.Codigo_Area",$this->Codigo_Area);

        return $this->db->get();
    }
    public function codigoByActividadPOI()
    {
        $numero = "0";
        $this->db->select("MAX(Codigo_Actividad_POI*1) AS numero");
        $this->db->from("tablero_actividad_poi");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {

            $row = $result->row();
            $numero = $row->numero + 1;
        } else {
            $numero = 1;
        }
        return $numero;
    }
    public function registrar()
    {
        $data = array(
            "Codigo_Actividad_POI" => $this->Codigo_Actividad_POI,
            "Anio_Ejecucion" => $this->Anio_Ejecucion,
            "Codigo_Sector" => $this->Codigo_Sector,
            "Codigo_Pliego" => $this->Codigo_Pliego,
            "Codigo_Ejecutora" => $this->Codigo_Ejecutora,
            "Codigo_Centro_Costos" => $this->Codigo_Centro_Costos,
            "Codigo_Sub_Centro_Costos" => $this->Codigo_Sub_Centro_Costos,
            "Codigo_Programa_Presupuestal" => $this->Codigo_Programa_Presupuestal,
            "Codigo_Unidad_Medida" => $this->Codigo_Unidad_Medida,
            "Codigo_Finalidad" => $this->Codigo_Finalidad,
            "Codigo_Actividad_Proyecto" => $this->Codigo_Actividad_Proyecto,
            "Codigo_Actividad" => $this->Codigo_Actividad,
            "Costo_Programado" => $this->Costo_Programado,
            "Descripcion_Actividad" => $this->Descripcion_Actividad,
            "Enero" => $this->Enero,
            "Febrero" => $this->Febrero,
            "Marzo" => $this->Marzo,
            "Abril" => $this->Abril,
            "Mayo" => $this->Mayo,
            "Junio" => $this->Junio,
            "Julio" => $this->Julio,
            "Agosto" => $this->Agosto,
            "Septiembre" => $this->Septiembre,
            "Octubre" => $this->Octubre,
            "Noviembre" => $this->Noviembre,
            "Diciembre" => $this->Diciembre            
        );
        if ($this->db->insert("tablero_actividad_poi", $data))
            return true;
        else
            return false;
    }
    public function actualizar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Codigo_Sector", $this->Codigo_Sector, TRUE);
        $this->db->set("Codigo_Pliego", $this->Codigo_Pliego, TRUE);
        $this->db->set("Codigo_Ejecutora", $this->Codigo_Ejecutora, TRUE);
        $this->db->set("Codigo_Centro_Costos", $this->Codigo_Centro_Costos, TRUE);
        $this->db->set("Codigo_Sub_Centro_Costos", $this->Codigo_Sub_Centro_Costos, TRUE);
        $this->db->set("Codigo_Programa_Presupuestal", $this->Codigo_Programa_Presupuestal, TRUE);
        $this->db->set("Codigo_Unidad_Medida", $this->Codigo_Unidad_Medida, TRUE);
        $this->db->set("Codigo_Finalidad", $this->Codigo_Finalidad, TRUE);
        $this->db->set("Codigo_Actividad_Proyecto", $this->Codigo_Actividad_Proyecto, TRUE);
        $this->db->set("Codigo_Actividad", $this->Codigo_Actividad, TRUE);
        $this->db->set("Descripcion_Actividad", $this->Descripcion_Actividad, TRUE);
        $this->db->set("Costo_Programado", $this->Costo_Programado, TRUE);
        $this->db->set("Enero", $this->Enero);
        $this->db->set("Febrero", $this->Febrero);
        $this->db->set("Marzo", $this->Marzo);
        $this->db->set("Abril", $this->Abril);
        $this->db->set("Mayo", $this->Mayo);
        $this->db->set("Junio", $this->Junio);
        $this->db->set("Julio", $this->Julio);
        $this->db->set("Agosto", $this->Agosto);
        $this->db->set("Septiembre", $this->Septiembre);
        $this->db->set("Octubre", $this->Octubre);
        $this->db->set("Noviembre", $this->Noviembre);
        $this->db->set("Diciembre", $this->Diciembre);
        $this->db->where("Id_Actividad_POI", $this->id);
        $error = array();
        if ($this->db->update('tablero_actividad_poi'))
            return 1;
        else {
            $error = $this->db->error();
          return $error["code"];
        }
    }
    public function nombresCodigos()
    {
        $this->db->select("Nombre_Sector,Nombre_Pliego,Nombre_Pliego,Nombre_Ejecutora,Nombre_Centro_Costos,Nombre_Sub_Centro_Costos,Nombre_Programa_Presupuestal,Nombre_Unidad_Medida");
        $this->db->select("Nombre_Area,Nombre_Actividad_Proyecto,Nombre_Actividad");
        $this->db->from("proceso p");
        $this->db->join("sector", "p.Codigo_Sector = sector.Codigo_Sector");
        $this->db->join("pliego", "p.Codigo_Pliego = pliego.Codigo_Pliego");
        $this->db->join("ejecutora", "p.Codigo_Ejecutora = ejecutora.Codigo_Ejecutora");
        $this->db->join("centro_costos", "p.Codigo_Centro_Costos = centro_costos.Codigo_Centro_Costos");
        $this->db->join("sub_centro_costos", "p.Codigo_Sub_Centro_Costos = sub_centro_costos.Codigo_Sub_Centro_Costos");
        $this->db->join("programa_presupuestal", "p.Codigo_Programa_Presupuestal = programa_presupuestal.Codigo_Programa_Presupuestal");
        $this->db->join("unidad_medida", "p.Codigo_Unidad_Medida = unidad_medida.Codigo_Unidad_Medida");
        $this->db->join("area", "p.Codigo_Area = area.Codigo_Area");
        $this->db->join("actividad_proyecto", "p.Codigo_Actividad_Proyecto = actividad_proyecto.Codigo_Actividad_Proyecto");
        $this->db->join("actividad", "p.Codigo_Actividad = actividad.Codigo_Actividad");
        $this->db->where("p.Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("p.Codigo_Sector", $this->Codigo_Sector);
        $this->db->where("p.Codigo_Pliego", $this->Codigo_Pliego);
        $this->db->where("p.Codigo_Ejecutora", $this->Codigo_Ejecutora);
        $this->db->where("p.Codigo_Centro_Costos", $this->Codigo_Centro_Costos);
        $this->db->where("p.Codigo_Sub_Centro_Costos", $this->Codigo_Sub_Centro_Costos);
        $this->db->where("p.Codigo_Programa_Presupuestal", $this->Codigo_Programa_Presupuestal);
        $this->db->where("p.Codigo_Unidad_Medida", $this->Codigo_Unidad_Medida);
        $this->db->where("p.Codigo_Area", $this->Codigo_Area);
        $this->db->where("p.Codigo_Actividad_Proyecto", $this->Codigo_Actividad_Proyecto);
        $this->db->where("p.Codigo_Actividad", $this->Codigo_Actividad);
        $this->db->where("p.Codigo_Proceso", $this->Codigo_Proceso);
        return $this->db->get();
    }
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("Id_Actividad_POI", $this->id);
        $error = array();
        if ($this->db->delete('tablero_actividad_poi'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function reporteListaProcesoFiltro()
    {
        $this->db->select("Codigo_Proceso,Descripcion_Proceso");
        $this->db->from("proceso");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        if ($this->session->userdata("idrol") != "01") {
            $this->db->where_in("Codigo_Area", $this->Codigo_Area);
        }
        return $this->db->get();
    }
    public function listaPorAnio()
    {
        $this->db->select("Codigo_Proceso,Descripcion_Proceso");
        $this->db->from("proceso");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function asignarIndicador()
    {
        $data = array(
            "Id_Actividad_POI" => $this->id,
            "Anio_Ejecucion" => $this->Anio_Ejecucion,
            "idindicador" => $this->indicador);
        if ($this->db->insert("tablero_indicador_actividad_poi", $data))
            return true;
        else
            return false;
    }
    public function eliminarIndicador()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("Id_Actividad_POI", $this->id);
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("idindicador", $this->indicador);
        $error = array();
        if ($this->db->delete('tablero_indicador_actividad_poi'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function cadenaPresupuestal()
    {
        $array = array();
        $this->db->select("Nombre_Sector,Nombre_Pliego,Nombre_Ejecutora,Nombre_Centro_Costos,Nombre_Sub_Centro_Costos");
        $this->db->from("tablero_sub_centro_costos tscc");
        $this->db->join("tablero_centro_costos tcc","tscc.Codigo_Centro_Costos=tcc.Codigo_Centro_Costos AND tscc.Codigo_Ejecutora=tcc.Codigo_Ejecutora AND tscc.Codigo_Pliego=tcc.Codigo_Pliego AND tscc.Codigo_Sector=tcc.Codigo_Sector AND tscc.Anio_Ejecucion=tcc.Anio_Ejecucion");
        $this->db->join("tablero_ejecutora te","tcc.Codigo_Ejecutora=te.Codigo_Ejecutora AND te.Codigo_Pliego=tcc.Codigo_Pliego AND te.Codigo_Sector=tcc.Codigo_Sector AND te.Anio_Ejecucion=tcc.Anio_Ejecucion");
        $this->db->join("tablero_pliego tp","te.Codigo_Pliego=tp.Codigo_Pliego AND te.Codigo_Sector=tcc.Codigo_Sector AND te.Anio_Ejecucion=tp.Anio_Ejecucion");
        $this->db->join("tablero_sector ts","tp.Codigo_Sector=ts.Codigo_Sector AND ts.Anio_Ejecucion=tscc.Anio_Ejecucion");
        $this->db->where("tscc.Anio_Ejecucion",$this->Anio_Ejecucion);
        $cadena = $this->db->get();
        $this->db->select("Nombre_Programa_Presupuestal");
        $this->db->from("tablero_programa_presupuestal");
        $this->db->where("Anio_Ejecucion",$this->Anio_Ejecucion);
        $programa = $this->db->get();
        $array = array("cadena"=>$cadena->row(),"programa"=>$programa->row());
        return $array;
    }
    public function listarEnlace() {
        $this->db->select("p.Codigo_Actividad_POI,t.Anio_Ejecucion,t.Codigo_Area,t.Id_Actividad_POI,a.Nombre_Area,p.Descripcion_Actividad");
        $this->db->from("tablero_area_actividad_poi t");
        $this->db->join("tablero_area a","t.Codigo_Area=a.Codigo_Area");
        $this->db->join("tablero_actividad_poi p","p.Id_Actividad_POI=t.Id_Actividad_POI");
        $this->db->where("t.Anio_Ejecucion",$this->Anio_Ejecucion);
        $this->db->where("t.Codigo_Area",$this->Codigo_Area);
        $this->db->where("a.Anio_Ejecucion",$this->Anio_Ejecucion);
        $this->db->group_by(array("t.Anio_Ejecucion","t.Codigo_Area","t.Id_Actividad_POI"));
        return $this->db->get();
    }
    public function buscarEnlace() {
        $this->db->select("Anio_Ejecucion,Codigo_Area,Id_Actividad_POI");
        $this->db->from("tablero_area_actividad_poi");
        $this->db->where("Anio_Ejecucion",$this->Anio_Ejecucion);
        $this->db->where("Codigo_Area",$this->Codigo_Area);
        $this->db->where("Id_Actividad_POI",$this->Codigo_Actividad_POI);
        $this->db->group_by(array("Anio_Ejecucion","Codigo_Area","Id_Actividad_POI"));
        return $this->db->get();
    }
    public function registrarEnlace() {
        $data = array(
            "Id_Actividad_POI" => $this->Codigo_Actividad_POI,
            "Anio_Ejecucion" => $this->Anio_Ejecucion,
            "Codigo_Area" => $this->Codigo_Area
        );
        if ($this->db->insert("tablero_area_actividad_poi", $data))
            return true;
        else
            return false;
    }
    public function eliminarEnlace()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Codigo_Area", $this->Codigo_Area);
        $this->db->where("Id_Actividad_POI", $this->Codigo_Actividad_POI);
        $error = array();
        if ($this->db->delete('tablero_area_actividad_poi'))
            return true;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function programacionTableroEjecucionSemestreArea01() {
        $this->db->select("Anio,codigo_area,ID,Actividad_POI,P_ENE,E_ENE,P_FEB,E_FEB,P_MAR,E_MAR,P_ABR,E_ABR,P_MAY,E_MAY,P_JUN,E_JUN");
        $this->db->from("programacion_tablero_vs_ejecucion_semestre_01_area");
        $this->db->where("Anio", $this->Anio_Ejecucion);
        $this->db->where("codigo_area", $this->Codigo_Area);
        $this->db->where("ID", $this->Codigo_Actividad_POI);
        $this->db->order_by("ID ASC");
        return $this->db->get(); 
    }
    public function programacionTableroEjecucionSemestreArea02() {
        $this->db->select("Anio,codigo_area,ID,Actividad_POI,P_JUL,E_JUL,P_AGO,E_AGO,P_SEP,E_SEP,P_OCT,E_OCT,P_NOV,E_NOV,P_DIC,E_DIC");
        $this->db->from("programacion_tablero_vs_ejecucion_semestre_02_area");
        $this->db->where("Anio", $this->Anio_Ejecucion);
        $this->db->where("codigo_area", $this->Codigo_Area);
        $this->db->where("ID", $this->Codigo_Actividad_POI);
        $this->db->order_by("ID ASC");
        return $this->db->get();
    }
    public function programacionTableroEjecucionSemestreArea01SinTarea() {
        $this->db->select("Anio,codigo_area,ID,Actividad_POI,P_ENE,E_ENE,P_FEB,E_FEB,P_MAR,E_MAR,P_ABR,E_ABR,P_MAY,E_MAY,P_JUN,E_JUN");
        $this->db->from("programacion_tablero_vs_ejecucion_semestre_01_area");
        $this->db->where("Anio", $this->Anio_Ejecucion);
        $this->db->where("codigo_area", $this->Codigo_Area);
        $this->db->order_by("ID ASC");
        return $this->db->get(); 
    }
    public function programacionTableroEjecucionSemestreArea02SinTarea() {
        $this->db->select("Anio,codigo_area,ID,Actividad_POI,P_JUL,E_JUL,P_AGO,E_AGO,P_SEP,E_SEP,P_OCT,E_OCT,P_NOV,E_NOV,P_DIC,E_DIC");
        $this->db->from("programacion_tablero_vs_ejecucion_semestre_02_area");
        $this->db->where("Anio", $this->Anio_Ejecucion);
        $this->db->where("codigo_area", $this->Codigo_Area);
        $this->db->order_by("ID ASC");
        return $this->db->get();
    }
}