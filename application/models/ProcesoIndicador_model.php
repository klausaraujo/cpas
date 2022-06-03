<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class ProcesoIndicador_model extends CI_Model
{
    private $id;
    private $Anio_Ejecucion;
    private $Codigo_Indicador;
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
    private $Activo;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setAnio_Ejecucion($data)
    {
        $this->Anio_Ejecucion = $this->db->escape_str($data);
    }
    public function setCodigo_Indicador($data)
    {
        $this->Codigo_Indicador = $this->db->escape_str($data);
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
    public function setActivo($data)
    {
        $this->Activo = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function existe()
    {
        $this->db->select("1");
        $this->db->from("indicador_proceso");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Codigo_Proceso", $this->Codigo_Proceso);
        return $this->db->get();
    }
    public function existeNotId()
    {
        $this->db->select("1");
        $this->db->from("indicador_proceso");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Codigo_Proceso", $this->Codigo_Proceso);
        $this->db->where("idindicadorproceso!=", $this->id);
        return $this->db->get();
    }
    public function insertar()
    {
        $Codigo_Usuario = $this->session->userdata("idusuario");
        $data = array(
            "Anio_Ejecucion" => $this->Anio_Ejecucion,
            "Codigo_Indicador" => $this->Codigo_Indicador,
            "Codigo_Proceso" => $this->Codigo_Proceso,
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
            "Diciembre" => $this->Diciembre,
            "Usuario_Creacion" => $Codigo_Usuario,
            "Fecha_Creacion" => date("Y-m-d H:i:s"),
            "Activo" => "1"
        );
        if ($this->db->insert('indicador_proceso', $data))
            return 1;
        else
            return 0;
    }
    public function lista()
    {
        $this->db->select("IP.idindicadorproceso,IP.Anio_Ejecucion,IP.idindicadorproceso as ID,IP.Codigo_Proceso,P.descripcion_proceso As Proceso");
        $this->db->select("I.Codigo_Indicador,I.Nombre_Indicador as Indicador,UM.Nombre_Unidad_Medida As Unidad,A.Nombre_Area Area,Siglas_Area");
        $this->db->select("IP.Enero,IP.Febrero,IP.Marzo,IP.Abril,IP.Mayo,IP.Junio,IP.Julio,IP.Agosto,IP.Septiembre,IP.Octubre,IP.Noviembre,IP.Diciembre");
        $this->db->from("indicador_proceso IP");
        $this->db->join("proceso P","IP.Codigo_Proceso=P.Codigo_Proceso And IP.Anio_Ejecucion = P.Anio_Ejecucion");
        $this->db->join("indicador I","IP.Codigo_Indicador = I.Codigo_Indicador And IP.Anio_ejecucion = I.Anio_ejecucion");
        $this->db->join("unidad_medida UM","P.Codigo_Unidad_Medida = UM.Codigo_Unidad_Medida ");
        $this->db->join("area A","P.Codigo_Area = A.Codigo_Area and A.Anio_ejecucion=P.Anio_ejecucion");
        $this->db->where("IP.Anio_ejecucion",$this->Anio_Ejecucion);
        $this->db->order_by("idindicadorproceso","DESC");
        return $this->db->get();
    }
    public function listaAsignacion(){
        $this->db->select("TAP.Id_Actividad_POI As ID,TAP.anio_ejecucion as Anio,TAP.codigo_actividad_poi,TAPI.anio_ejecucion,CONCAT(TAP.codigo_actividad_poi, ' - ' ,TAP.descripcion_actividad) as Actividad_POI");
        $this->db->select("(TAP.Enero+TAP.Febrero+TAP.Marzo+TAP.Abril+TAP.Mayo+TAP.Junio+TAP.Julio+TAP.Agosto+TAP.Septiembre+TAP.Octubre+TAP.Noviembre+TAP.Diciembre) As CP");
        $this->db->select("TUM.nombre_unidad_medida as Unidad_Medida,COALESCE(TAPI.Idindicador,'NA') as IDI,COALESCE(TI.Nombre_Indicador,'NO_ASIGNADO') as Indicador");
        $this->db->from("tablero_actividad_poi TAP");
        $this->db->join("tablero_unidad_medida TUM","TUM.codigo_unidad_medida=TAP.codigo_unidad_medida");
        $this->db->join("tablero_indicador_actividad_poi TAPI","TAP.anio_ejecucion=TAPI.anio_ejecucion and TAP.Id_Actividad_POI=TAPI.Id_Actividad_POI","left");
        $this->db->join("tablero_indicador TI","TAPI.idindicador = TI.idindicador and TAPI.anio_ejecucion=TI.anio_ejecucion ","left");
        $this->db->where("TAP.Anio_ejecucion",$this->Anio_Ejecucion);        
        return $this->db->get();
    }
    public function procesoIndicador(){
      $this->db->select("idindicadorproceso, Anio_Ejecucion, Codigo_Indicador, Codigo_Proceso, Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre, Usuario_Creacion, Fecha_Creacion, Usuario_Actualizacion, Fecha_Actualizacion, Activo");
      $this->db->from("indicador_proceso");
      $this->db->where("idindicadorproceso",$this->id);
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
        $this->db->set("Codigo_Indicador", $this->Codigo_Indicador, TRUE);
        $this->db->where("idindicadorproceso", $this->id);
        $error = array();
        if ($this->db->update('indicador_proceso'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idindicadorproceso", $this->id);
        $error = array();
        if ($this->db->delete('indicador_proceso'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function areaYunidad(){
      $this->db->select("A.Nombre_Area Area,UM.Nombre_Unidad_Medida As Unidad");
      $this->db->from("proceso P");
      $this->db->join("unidad_medida UM","P.Codigo_Unidad_Medida = UM.Codigo_Unidad_Medida ");
      $this->db->join("area A","P.Codigo_Area = A.Codigo_Area");
      $this->db->where("P.Codigo_Proceso",$this->Codigo_Proceso);
      return $this->db->get();
    }
     public function indicadorPOI() {
        $this->db->select("td.Nombre_Indicador");
        $this->db->from("tablero_indicador_actividad_poi tiap");
        $this->db->join("tablero_indicador td","tiap.idindicador=td.IdIndicador");
        $this->db->where("tiap.Id_Actividad_POI",$this->id);
        return $this->db->get();
        
    }
}