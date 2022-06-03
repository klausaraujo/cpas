<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Evento_model extends CI_Model
{
    private $tipoEvento;
    private $Evento_Codigo;
    private $Evento_Nombre;
    private $Anio_Ejecucion;
    private $Mes;
    private $Nivel;
    public function setTipoEvento($data)
    {
        $this->tipoEvento = $this->db->escape_str($data);
    }
    public function setAnio_Ejecucion($data)
    {
        $this->Anio_Ejecucion = $this->db->escape_str($data);
    }
    public function setMes($data)
    {
        $this->Mes = $this->db->escape_str($data);
    }
    public function setNivel($data)
    {
        $this->Nivel = $this->db->escape_str($data);
    }
    public function setEvento_Codigo($data)
    {
        $this->Evento_Codigo = $this->db->escape_str($data);
    }
    public function setEvento_Nombre($data)
    {
        $this->Evento_Nombre = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function listaTipo()
    {
        $this->db->select("Evento_Tipo_Codigo,Evento_Codigo,Evento_Nombre");
        $this->db->from("evento");
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        return $this->db->get();
    }
    public function lista()
    {
        $this->db->select("evento_tipo.Evento_Tipo_Codigo,evento_tipo.Evento_Tipo_Nombre,evento.Evento_Codigo,evento.Evento_Nombre");
        $this->db->from("evento");
        $this->db->join("evento_tipo","evento_tipo.Evento_Tipo_Codigo=evento.Evento_Tipo_Codigo");
        return $this->db->get();
    }
    public function obtenerIndicadorCoe(){
        $this->db->select("anio Anio_Ejecucion, Indicador");
        $this->db->select("Enero R_ENE, Febrero R_FEB, MArzo R_MAR, Abril R_ABR, Mayo R_MAY, Junio R_JUN, Julio R_JUL");
        $this->db->select("Agosto R_AGO, Septimbre R_SEP, Octubre R_OCT, Noviembre R_NOV, Diciembre R_DIC");
        $this->db->from("coe_eventos_indicador_agrupado");
        $this->db->where("anio", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function obtenerBrigadistasNacional(){
        $this->db->select("*");
        $this->db->from("coe_indicador_brigadistas_global");
        $this->db->where("anio", $this->Anio_Ejecucion);
        $this->db->where("numero", $this->Mes);
        return $this->db->get();
    }
    public function obtenerBrigadistasMinsa(){
        $this->db->select("*");
        $this->db->from("coe_indicador_brigadistas_minsa_regiones_reportar");
        $this->db->where("anio", $this->Anio_Ejecucion);
        $this->db->where("numero", $this->Mes);
        return $this->db->get();
    }
    public function obtenerBrigadistasRegional(){
        $this->db->select("*");
        $this->db->from("coe_indicador_brigadistas_regionales_regiones_reportar");
        $this->db->where("anio", $this->Anio_Ejecucion);
        $this->db->where("numero", $this->Mes);
        return $this->db->get();
    }
    public function obtenerPorcentajeCoe(){
        $this->db->select("anio Anio_Ejecucion, Indicador");
        $this->db->select("Enero R_ENE, Febrero R_FEB, Marzo R_MAR, Abril R_ABR, Mayo R_MAY, Junio R_JUN, Julio R_JUL");
        $this->db->select("Agosto R_AGO, Septimbre R_SEP, Octubre R_OCT, Noviembre R_NOV, Diciembre R_DIC");
        $this->db->from("coe_eventos_indicador_agrupado_porcentual");
        $this->db->where("anio", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function obtenerEventoPorNivel(){
        $this->db->select("*");
        $this->db->from("coe_eventos_indicador_niveles");
        $this->db->where("anio", $this->Anio_Ejecucion);
        $this->db->where("numero", $this->Mes);
        $this->db->order_by("Nivel", "ASC");
        return $this->db->get();
    }
    public function obtenerEventoPorRegion(){
        $this->db->select("*");
        $this->db->from("coe_eventos_indicador_eventos_regiones_final_reportar");
        $this->db->where("anio", $this->Anio_Ejecucion);
        $this->db->where("numero", $this->Mes);
        $this->db->order_by("numero", "ASC");
        return $this->db->get();
    }
    public function obtenerEventoPorRegionNivel(){
        $this->db->select("*");
        $this->db->from("coe_eventos_indicador_eventos_regiones_nivel_reportar");
        $this->db->where("anio", $this->Anio_Ejecucion);
        $this->db->where("numero", $this->Mes);
        $this->db->order_by("numero", "ASC");
        if ($this->Nivel != "0") {
            $this->db->where("nivel",$this->Nivel);
        }
        return $this->db->get();
    }
    public function obtenerCodigoMayor() {
        $this->db->select("MAX(CAST(Evento_Codigo AS UNSIGNED)) codigo");
        $this->db->from("evento");
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $rs = $this->db->get();
        return $rs->row()->codigo;
    }
    public function crear() {
        $data = array(
            "Evento_Tipo_Codigo" => $this->tipoEvento,
            "Evento_Codigo" => $this->Evento_Codigo,
            "Evento_Nombre" => $this->Evento_Nombre
        );
        if ($this->db->insert('evento', $data)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("Evento_Nombre", $this->Evento_Nombre, TRUE);
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("Evento_Codigo", $this->Evento_Codigo);
        if ($this->db->update('evento')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("Evento_Tipo_Codigo", $this->tipoEvento);
        $this->db->where("Evento_Codigo", $this->Evento_Codigo);
        if ($this->db->delete('evento')) {
            return 1;
        }
        else {
            return 0;
        }
    }
}