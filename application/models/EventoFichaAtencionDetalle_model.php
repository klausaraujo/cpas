<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoFichaAtencionDetalle_model extends CI_Model
{
    private $id;
    private $Evento_Registro_Numero;
    private $Evento_Ficha_Atencion_ID;
    private $Evento_Ficha_Atencion_Detalle_Paciente;
    private $Tipo_Documento_Codigo;
    private $Evento_Ficha_Atencion_Detalle_DNI;
    private $Evento_Ficha_Atencion_Detalle_Edad;
    private $Evento_Ficha_Atencion_Detalle_Genero;
    private $Evento_Ficha_Atencion_Detalle_Gestante;
    private $Evento_Ficha_Atencion_Detalle_Personal_Salud;
    private $Evento_Ficha_Atencion_Detalle_Procedencia;
    private $Evento_Ficha_Atencion_Detalle_Clasificacion;
    private $Evento_Ficha_Atencion_Detalle_Inicio_Sintomas;
    private $Evento_Ficha_Atencion_Detalle_Diagnostico;
    private $Evento_Ficha_Atencion_Detalle_CIE10_Codigo;
    private $Evento_Ficha_Atencion_Detalle_Hora_Atencion;
    private $Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID;
    private $Evento_Ficha_Atencion_Detalle_Vacuna;
    private $Evento_Ficha_Atencion_Detalle_Quimioprofilaxis;
    private $Evento_Ficha_Atencion_Detalle_Medicamentos;
    private $Evento_Ficha_Atencion_Detalle_Destino;
    private $Evento_Ficha_Atencion_Detalle_Lugar_Traslado;
    private $Evento_Ficha_Atencion_Detalle_Responsable;
    private $Evento_Ficha_Atencion_Pais_Procedencia;
    private $Evento_Ficha_Atencion_Lugar_Residencia;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setEvento_Registro_Numero($data)
    {
        $this->Evento_Registro_Numero = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_ID($data)
    {
        $this->Evento_Ficha_Atencion_ID = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Paciente($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Paciente = $this->db->escape_str($data);
    }
    public function setTipo_Documento_Codigo($data)
    {
        $this->Tipo_Documento_Codigo = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_DNI($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_DNI = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Edad($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Edad = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Genero($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Genero = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Gestante($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Gestante = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Personal_Salud($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Personal_Salud = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Procedencia($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Procedencia = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Clasificacion($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Clasificacion = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Inicio_Sintomas($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Inicio_Sintomas = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Diagnostico($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Diagnostico = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_CIE10_Codigo($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_CIE10_Codigo = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Hora_Atencion($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Hora_Atencion = $this->db->escape_str($data);
    }
    public function setEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID($data)
    {
        $this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Vacuna($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Vacuna = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Quimioprofilaxis($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Quimioprofilaxis = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Medicamentos($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Medicamentos = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Destino($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Destino = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Lugar_Traslado($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Lugar_Traslado = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Detalle_Responsable($data)
    {
        $this->Evento_Ficha_Atencion_Detalle_Responsable = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Pais_Procedencia($data)
    {
        $this->Evento_Ficha_Atencion_Pais_Procedencia = $this->db->escape_str($data);
    }
    public function setEvento_Ficha_Atencion_Lugar_Residencia($data)
    {
        $this->Evento_Ficha_Atencion_Lugar_Residencia = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function ficha(){
		$this->db->select("e.Evento_Ficha_Atencion_ID,e.Evento_Ficha_Atencion_Usuario_Apertura");
		$this->db->select("DATE_FORMAT(e.Evento_Ficha_Atencion_Fecha,'%d/%m/%Y') AS Evento_Ficha_Atencion_Fecha,DATE_FORMAT(e.Evento_Ficha_Atencion_Hora_Cierre,'%H:%i') as Hora_Cierre");
		$this->db->select("e.Evento_Registro_Numero,e.Evento_Ficha_Atencion_Estado");
		$this->db->select("d.Evento_Ficha_Atencion_Detalle_ID id,d.Evento_Ficha_Atencion_Detalle_Paciente,d.Evento_Ficha_Atencion_Detalle_DNI,d.Evento_Ficha_Atencion_Detalle_Edad");
		$this->db->select("d.Evento_Ficha_Atencion_Detalle_Genero,d.Evento_Ficha_Atencion_Detalle_Gestante,d.Evento_Ficha_Atencion_Detalle_Personal_Salud,d.Evento_Ficha_Atencion_Detalle_Procedencia");
		$this->db->select("d.Evento_Ficha_Atencion_Detalle_Clasificacion,d.Evento_Ficha_Atencion_Detalle_Diagnostico,d.Evento_Ficha_Atencion_Detalle_CIE10_Codigo");
		$this->db->select("CONCAT(cie.Id_CIE10,' - ',cie.Descripcion_CIE10) Descripcion_CIE10,d.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID,a.Evento_Tipo_Entidad_Atencion_Nombre Entidad");
        $this->db->select("DATE_FORMAT(d.Evento_Ficha_Atencion_Detalle_Inicio_Sintomas,'%d/%m/%Y %H:%i') Evento_Ficha_Atencion_Detalle_Inicio_Sintomas");
        $this->db->select("DATE_FORMAT(d.Evento_Ficha_Atencion_Detalle_Hora_Atencion,'%H:%i') Evento_Ficha_Atencion_Detalle_Hora_Atencion,a.Evento_Tipo_Entidad_Atencion_ID");
		$this->db->select("d.Evento_Ficha_Atencion_Detalle_Vacuna,d.Evento_Ficha_Atencion_Detalle_Quimioprofilaxis,d.Evento_Ficha_Atencion_Detalle_Medicamentos,d.Evento_Ficha_Atencion_Detalle_Destino");
		$this->db->select("d.Evento_Ficha_Atencion_Detalle_Lugar_Traslado,d.Evento_Ficha_Atencion_Detalle_Responsable");
		$this->db->select("CONCAT(u.Apellidos,', ',u.Nombres) AS usuario,m.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre Oferta_Movil_Nombre,d.Tipo_Documento_Codigo");
		$this->db->select("d.Evento_Ficha_Atencion_Pais_Procedencia, p.nombre as pais,d.Evento_Ficha_Atencion_Lugar_Residencia");
        $this->db->from("evento_ficha_atencion e");
        $this->db->join("evento_ficha_atencion_detalle d","e.Evento_Ficha_Atencion_ID=d.Evento_Ficha_Atencion_ID");
        $this->db->join("cie10 cie","cie.Id_CIE10=d.Evento_Ficha_Atencion_Detalle_CIE10_Codigo","LEFT");
        $this->db->join("evento_tipo_entidad_atencion_oferta_movil m","m.Evento_Tipo_Entidad_Atencion_ID,m.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID=d.Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID");
        $this->db->join("evento_tipo_entidad_atencion a","m.Evento_Tipo_Entidad_Atencion_ID,m.Evento_Tipo_Entidad_Atencion_ID=a.Evento_Tipo_Entidad_Atencion_ID");
        $this->db->join("usuarios u","u.Codigo_Usuario = e.Evento_Ficha_Atencion_Usuario_Apertura");
        $this->db->join("pais p","d.Evento_Ficha_Atencion_Pais_Procedencia = p.id","LEFT");
        $this->db->where("e.Evento_Ficha_Atencion_ID",$this->Evento_Ficha_Atencion_ID);
        return $this->db->get();
    }
    public function listaByEvento_Registro_Numero(){
        $this->db->select("Evento_Ficha_Atencion_Detalle_ID id,Evento_Registro_Numero, Evento_Ficha_Atencion_ID,Evento_Ficha_Atencion_Detalle_Paciente,Evento_Ficha_Atencion_Detalle_DNI");
        $this->db->select("Evento_Ficha_Atencion_Detalle_Edad,Evento_Ficha_Atencion_Detalle_Genero,Evento_Ficha_Atencion_Detalle_Gestante,Evento_Ficha_Atencion_Detalle_Personal_Salud");
        $this->db->select("Evento_Ficha_Atencion_Detalle_Procedencia,Evento_Ficha_Atencion_Detalle_Clasificacion,Evento_Ficha_Atencion_Detalle_Inicio_Sintomas,Evento_Ficha_Atencion_Detalle_Diagnostico");
        $this->db->select("Evento_Ficha_Atencion_Detalle_CIE10_Codigo,Evento_Ficha_Atencion_Detalle_Hora_Atencion,Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID,Evento_Ficha_Atencion_Detalle_Vacuna");
        $this->db->select("Evento_Ficha_Atencion_Detalle_Quimioprofilaxis,Evento_Ficha_Atencion_Detalle_Medicamentos,Evento_Ficha_Atencion_Detalle_Destino,Evento_Ficha_Atencion_Detalle_Lugar_Traslado");
        $this->db->select("Evento_Ficha_Atencion_Detalle_Responsable");
        $this->db->from("evento_ficha_atencion_detalle");
        $this->db->where("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        return $this->db->get();
    }
    public function contarEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID(){
        $this->db->select("COUNT(1) AS total");
        $this->db->from("evento_ficha_atencion_detalle");
        $this->db->where("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID",$this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID);
        return $this->db->get();
    }
    public function contarByFicha(){
        $this->db->select("COUNT(1) AS total");
        $this->db->from("evento_ficha_atencion_detalle");
        $this->db->where("Evento_Ficha_Atencion_ID",$this->Evento_Ficha_Atencion_ID);
        return $this->db->get();
    }
    public function buscarIdFichaDNI(){
        $this->db->select("COUNT(1) AS total");
        $this->db->from("evento_ficha_atencion_detalle");
        $this->db->where("Evento_Ficha_Atencion_ID",$this->Evento_Ficha_Atencion_ID);
        $this->db->where("Evento_Ficha_Atencion_Detalle_DNI",$this->Evento_Ficha_Atencion_Detalle_DNI);
        return $this->db->get();
    }
    public function buscarIdFichaDNINotID(){
        $this->db->select("COUNT(1) AS total");
        $this->db->from("evento_ficha_atencion_detalle");
        $this->db->where("Evento_Ficha_Atencion_ID",$this->Evento_Ficha_Atencion_ID);
        $this->db->where("Evento_Ficha_Atencion_Detalle_DNI",$this->Evento_Ficha_Atencion_Detalle_DNI);
        $this->db->where("Evento_Ficha_Atencion_Detalle_ID!=",$this->id);
        return $this->db->get();
    }
    public function registrar(){
        $data = array(
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Evento_Ficha_Atencion_ID" => $this->Evento_Ficha_Atencion_ID,
            "Evento_Ficha_Atencion_Detalle_Paciente" => $this->Evento_Ficha_Atencion_Detalle_Paciente,
            "Tipo_Documento_Codigo" => $this->Tipo_Documento_Codigo,
            "Evento_Ficha_Atencion_Detalle_DNI" => $this->Evento_Ficha_Atencion_Detalle_DNI,
            "Evento_Ficha_Atencion_Detalle_Edad" => $this->Evento_Ficha_Atencion_Detalle_Edad,
            "Evento_Ficha_Atencion_Detalle_Genero" => $this->Evento_Ficha_Atencion_Detalle_Genero,
            "Evento_Ficha_Atencion_Detalle_Gestante" => $this->Evento_Ficha_Atencion_Detalle_Gestante,
            "Evento_Ficha_Atencion_Detalle_Personal_Salud" => $this->Evento_Ficha_Atencion_Detalle_Personal_Salud,
            "Evento_Ficha_Atencion_Detalle_Procedencia" => $this->Evento_Ficha_Atencion_Detalle_Procedencia,
            "Evento_Ficha_Atencion_Detalle_Clasificacion" => $this->Evento_Ficha_Atencion_Detalle_Clasificacion,
            "Evento_Ficha_Atencion_Detalle_Inicio_Sintomas" => $this->Evento_Ficha_Atencion_Detalle_Inicio_Sintomas,
            "Evento_Ficha_Atencion_Detalle_Diagnostico" => $this->Evento_Ficha_Atencion_Detalle_Diagnostico,
            "Evento_Ficha_Atencion_Detalle_CIE10_Codigo" => $this->Evento_Ficha_Atencion_Detalle_CIE10_Codigo,
            "Evento_Ficha_Atencion_Detalle_Hora_Atencion" => $this->Evento_Ficha_Atencion_Detalle_Hora_Atencion,
            "Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID" => $this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID,
            "Evento_Ficha_Atencion_Detalle_Vacuna" => $this->Evento_Ficha_Atencion_Detalle_Vacuna,
            "Evento_Ficha_Atencion_Detalle_Quimioprofilaxis" => $this->Evento_Ficha_Atencion_Detalle_Quimioprofilaxis,
            "Evento_Ficha_Atencion_Detalle_Medicamentos" => $this->Evento_Ficha_Atencion_Detalle_Medicamentos,
            "Evento_Ficha_Atencion_Detalle_Destino" => $this->Evento_Ficha_Atencion_Detalle_Destino,
            "Evento_Ficha_Atencion_Detalle_Lugar_Traslado" => $this->Evento_Ficha_Atencion_Detalle_Lugar_Traslado,
            "Evento_Ficha_Atencion_Detalle_Responsable" => $this->Evento_Ficha_Atencion_Detalle_Responsable,
            "Evento_Ficha_Atencion_Pais_Procedencia" => $this->Evento_Ficha_Atencion_Pais_Procedencia,
            "Evento_Ficha_Atencion_Lugar_Residencia" => $this->Evento_Ficha_Atencion_Lugar_Residencia,
            "Usuario_Registro" => $this->session->userdata("idusuario"),
            "Fecha_Registro" => date("Y-m-d H:i:s")
        );
        if ($this->db->insert('evento_ficha_atencion_detalle', $data))
            return true;
            else
                return false;
    }
    public function actualizar(){
            $this->db->set("Evento_Registro_Numero",$this->Evento_Registro_Numero);
            $this->db->set("Evento_Ficha_Atencion_ID",$this->Evento_Ficha_Atencion_ID);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Paciente",$this->Evento_Ficha_Atencion_Detalle_Paciente);
            $this->db->set("Tipo_Documento_Codigo",$this->Tipo_Documento_Codigo);
            $this->db->set("Evento_Ficha_Atencion_Detalle_DNI",$this->Evento_Ficha_Atencion_Detalle_DNI);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Edad",$this->Evento_Ficha_Atencion_Detalle_Edad);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Genero",$this->Evento_Ficha_Atencion_Detalle_Genero);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Gestante",$this->Evento_Ficha_Atencion_Detalle_Gestante);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Personal_Salud",$this->Evento_Ficha_Atencion_Detalle_Personal_Salud);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Procedencia",$this->Evento_Ficha_Atencion_Detalle_Procedencia);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Clasificacion",$this->Evento_Ficha_Atencion_Detalle_Clasificacion);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Inicio_Sintomas",$this->Evento_Ficha_Atencion_Detalle_Inicio_Sintomas);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Diagnostico",$this->Evento_Ficha_Atencion_Detalle_Diagnostico);
            $this->db->set("Evento_Ficha_Atencion_Detalle_CIE10_Codigo",$this->Evento_Ficha_Atencion_Detalle_CIE10_Codigo);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Hora_Atencion",$this->Evento_Ficha_Atencion_Detalle_Hora_Atencion);
            $this->db->set("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID",$this->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Vacuna",$this->Evento_Ficha_Atencion_Detalle_Vacuna);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Quimioprofilaxis",$this->Evento_Ficha_Atencion_Detalle_Quimioprofilaxis);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Medicamentos",$this->Evento_Ficha_Atencion_Detalle_Medicamentos);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Destino",$this->Evento_Ficha_Atencion_Detalle_Destino);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Lugar_Traslado",$this->Evento_Ficha_Atencion_Detalle_Lugar_Traslado);
            $this->db->set("Evento_Ficha_Atencion_Detalle_Responsable",$this->Evento_Ficha_Atencion_Detalle_Responsable);
            $this->db->set("Evento_Ficha_Atencion_Pais_Procedencia",$this->Evento_Ficha_Atencion_Pais_Procedencia);
            $this->db->set("Evento_Ficha_Atencion_Lugar_Residencia",$this->Evento_Ficha_Atencion_Lugar_Residencia);
            $this->db->set("Usuario_Registro",$this->session->userdata("idusuario"));
            $this->db->set("Fecha_Registro",date("Y-m-d H:i:s"));
            $this->db->where("Evento_Ficha_Atencion_Detalle_ID", $this->id);
            $error = array();
            if ($this->db->update('evento_ficha_atencion_detalle'))
                return 1;
                else {
                    $error = $this->db->error();
                    return $error["code"];
                }
    }
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("Evento_Ficha_Atencion_Detalle_ID", $this->id);
        $error = array();
        if ($this->db->delete('evento_ficha_atencion_detalle'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function exportar() {
        return $this->db->query("select `cie10`.`Id_CIE10` AS `Codigo`,concat_ws(' - ',`cie10`.`Id_CIE10`,`cie10`.`Descripcion_CIE10`) AS `Diagnostico` from `cie10` where char_length(`cie10`.`Id_CIE10`)In(3,4) and substr(`cie10`.`Id_CIE10`,1,1) <> '|'");   
    }
}