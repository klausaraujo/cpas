<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Indicador_model extends CI_Model
{
    private $id;
    private $Anio_Ejecucion;
    private $Nombre_Indicador;
    private $IdDimension;    
    private $Formula;    
    private $Justificacion;
    private $Comentarios;
    private $Ficha_Tecnica;
    private $Activo;
    private $idregistro;
    private $region;
    private $idejecutora;
    private $anio;
    private $mes;
    private $fecha_recepcion;
    private $idmatriz;
    private $valor;
    private $comentariosPPR;
    public function setId($data){$this->id = $this->db->escape_str($data);}
    public function setAnioEjecucion($data){$this->Anio_Ejecucion = $this->db->escape_str($data);}
    public function setNombre_Indicador($data){$this->Nombre_Indicador = $this->db->escape_str($data);}
    public function setIdDimension($data){$this->IdDimension = $this->db->escape_str($data);}
    public function setFormula($data){$this->Formula = $this->db->escape_str($data);}
    public function setJustificacion($data){$this->Justificacion = $this->db->escape_str($data);}
    public function setComentarios($data){$this->Comentarios = $this->db->escape_str($data);}
    public function setFicha_Tecnica($data){$this->Ficha_Tecnica = $this->db->escape_str($data);}
    public function setActivo($data){$this->Activo = $this->db->escape_str($data);}
    public function setRegion($data){$this->region = $this->db->escape_str($data);}
    public function setIdejecutora($data){$this->idejecutora = $this->db->escape_str($data);}
    public function setAnio($data){$this->anio = $this->db->escape_str($data);}
    public function setMes($data){$this->mes = $this->db->escape_str($data);}
    public function setFechaRecepcion($data){$this->fecha_recepcion = $this->db->escape_str($data);}
    public function setIdregistro($data){$this->idregistro = $this->db->escape_str($data);}
    public function setIdmatriz($data){$this->idmatriz = $this->db->escape_str($data);}
    public function setValor($data){$this->valor = $this->db->escape_str($data);}
    public function setComentariosPPR($data){$this->comentariosppr = $this->db->escape_str($data);}
    public function existe()
    {
        $this->db->select("1");
        $this->db->from("tablero_indicador");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function registrar()
    {
        $data = array(
            "Anio_Ejecucion" => $this->Anio_Ejecucion,
            "Nombre_Indicador" => $this->Nombre_Indicador,
            "IdDimension" => $this->IdDimension,
            "Formula" => $this->Formula,
            "Justificacion" => $this->Justificacion,
            "Comentarios" => $this->Comentarios,
            "Ficha_Tecnica" => $this->Ficha_Tecnica,
            "Activo" => $this->Activo
        );
        if ($this->db->insert('tablero_indicador', $data))
            return 1;
        else
            return 0;
    }
    public function lista()
    {
        $this->db->select("IdIndicador id,Anio_Ejecucion,Nombre_Indicador,Nombre_Dimension,i.IdDimension,Formula,Justificacion,Comentarios,Ficha_Tecnica,i.Activo");
        $this->db->from("tablero_indicador i");
        $this->db->join("tablero_dimension d","i.IdDimension=d.IdDimension");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function listaSimple()
    {
        $this->db->select("IdIndicador ID,Anio_Ejecucion,Nombre_Indicador");
        $this->db->from("tablero_indicador");
        $this->db->where("Activo", "1");
        return $this->db->get();
    }
    public function listaPorAnio()
    {
        $Anio_Ejecucion = $this->session->userdata("Anio_Ejecucion");
        $this->db->select("Anio_Ejecucion,Codigo_Indicador,Nombre_Indicador,Costo_Indicador,Duracion_Dias,Fecha_Inicio,Fecha_Fin,Activo");
        $this->db->from("indicador");
        $this->db->where("Anio_Ejecucion", $Anio_Ejecucion);
        return $this->db->get();
    }
    public function listaPorAnioSeteado()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Indicador,Nombre_Indicador,Costo_Indicador,Duracion_Dias,Fecha_Inicio,Fecha_Fin,Activo");
        $this->db->from("indicador");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        return $this->db->get();
    }
    public function listaCombo()
    {
        $this->db->select("IdIndicador id,Anio_Ejecucion,Nombre_Indicador,Costo_Indicador,Duracion_Dias,Fecha_Inicio,Fecha_Fin,Activo");
        $this->db->from("tablero_indicador");
        $this->db->where("Activo", "1");
        return $this->db->get();
    }
    public function codigoByIndicador()
    {
        $numero = "0";
        $this->db->select("MAX(Codigo_Indicador*1) AS numero");
        $this->db->from("indicador");
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            $numero = $row->numero + 1;
        } else {
            $numero = 1;
        }
        return $numero;
    }
    public function actualizar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Anio_Ejecucion" , $this->Anio_Ejecucion, TRUE);
        $this->db->set("Nombre_Indicador" , $this->Nombre_Indicador, TRUE);
        $this->db->set("IdDimension" , $this->IdDimension, TRUE);
        $this->db->set("Formula" , $this->Formula, TRUE);
        $this->db->set("Justificacion" , $this->Justificacion, TRUE);
        $this->db->set("Comentarios" , $this->Comentarios, TRUE);
        $this->db->set("Activo" , $this->Activo, TRUE);
        $this->db->where("IdIndicador", $this->id);
        $error = array();
        if ($this->db->update('tablero_indicador'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function actualizarFicha_Tecnica(){
        $this->db->db_debug = FALSE;
        $this->db->set("Ficha_Tecnica" , $this->Ficha_Tecnica, TRUE);
        $this->db->where("IdIndicador", $this->id);
        $error = array();
        if ($this->db->update('tablero_indicador'))
            return 1;
            else {
                return 0;
            }
    }
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("IdIndicador", $this->id);
        $error = array();
        if ($this->db->delete('tablero_indicador'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function fichaTecnica(){
        $this->db->select("Ficha_Tecnica");
        $this->db->from("tablero_indicador");
        $this->db->where("IdIndicador", $this->id);
        return $this->db->get();
    }
    public function listaIndicadores()
    {
        $this->db->select("ir.idregistro as ID, ie.nombre as nombre, UPPER(re.Nombre_region) as region, ir.anio_ejecucion as anio_ejecucion, tm.nombre_mes as nombre_mes, ir.codigo_mes as codigo_mes, ir.fecha_registro as fecha_registro, ir.codigo_region as codigo_region, ir.idejecutora as idejecutora");
        $this->db->select("(case ir.estado when '1' then 'Activo' when '0' then 'Anulado' end) AS 'estado'");
        $this->db->from("indicadores_registro ir, indicadores_ejecutora ie, region re, tablero_mes tm");
        $this->db->where("ir.idejecutora = ie.idejecutora");
        $this->db->where("ir.codigo_region = re.Codigo_Region");
        $this->db->where("ir.codigo_mes = tm.codigo_mes");
        return $this->db->get();
    }
    public function listaUnidadEjecutora()
    {
        $this->db->select("ie.idejecutora, ie.nombre");        
        $this->db->from("indicadores_ejecutora ie");
        $this->db->where("ie.codigo_region", $this->region);
        return $this->db->get();
    }
    public function listaindicadorcalcreg()
    {
        $this->db->select("ipp.producto_proyecto, ia.actividad, im.forma_calculo, (case im.accion when '1' then 'Numerador' when '2' then 'Denominador' end) AS accionnom, im.accion, im.idproductoproyecto, im.idactividad, im.idmatriz");        
        $this->db->from("indicadores_matriz im, indicadores_producto_proyecto ipp, indicadores_actividad ia");
        $this->db->where("im.idproductoproyecto = ipp.idproductoproyecto");
        $this->db->where("im.idactividad = ia.idactividad");
        $this->db->order_by("im.idproductoproyecto, im.idactividad, im.accion asc");
        return $this->db->get();
    }
    public function registrarIndicador()
    {
        $data = array(
            "codigo_region" => $this->region,
            "idejecutora" => $this->idejecutora,
            "anio_ejecucion" => $this->anio,
            "codigo_mes" => $this->mes,
            "fecha_registro" => $this->fecha_recepcion,
            "usuario_registro" => $this->session->userdata("idusuario"),
            "estado" => "1"
        );
        if ($this->db->insert('indicadores_registro', $data))
            return $this->db->insert_id();
        else
            return 0;
    }
    public function actualizarIndicador(){
        $this->db->db_debug = FALSE;
        $this->db->set("codigo_region" , $this->region, TRUE);
        $this->db->set("idejecutora" , $this->idejecutora, TRUE);
        $this->db->set("anio_ejecucion" , $this->anio, TRUE);
        $this->db->set("codigo_mes" , $this->mes, TRUE);
        $this->db->set("fecha_registro" , $this->fecha_recepcion, TRUE);
        $this->db->set("fecha_actualizacion" , $this->fecha_recepcion, TRUE);
        $this->db->set("usuario_actualizacion" , $this->session->userdata("idusuario"), TRUE);
        $this->db->where("idregistro", $this->idregistro);
        $error = array();
        if ($this->db->update('indicadores_registro'))
            return 1;
            else {
                return 0;
            }
    }
    public function cantIndMatriz() {
        $this->db->select("COUNT(1) cantmatriz");
        $this->db->from("indicadores_matriz");
        $this->db->where("estado=1");
        return $this->db->get();
    }
    public function registrarDetalleIndicador()
    {
        $data = array(
            "idregistro" => $this->idregistro,
            "idmatriz" => $this->idmatriz,
            "valor" => $this->valor,
            "comentarios" => $this->comentariosppr,
            "estado" => "1"
        );
        if ($this->db->insert('indicadores_registro_detalle', $data))
            return 1;
        else
            return 0;
    }
    public function anularindicador()
    {
        $this->db->set("estado", "0", TRUE);
        $this->db->set("usuario_anulacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_anulacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("idregistro", $this->idregistro);
        $error = array();
        if ($this->db->update('indicadores_registro'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminarDetalleIndicador()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idregistro", $this->idregistro);
        $error = array();
        if ($this->db->delete('indicadores_registro_detalle'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function obtenerDetalleIndicadores()
    {
        $this->db->select("ind.*");
        $this->db->from("indicadores_registro_detalle ind");
        $this->db->where("ind.idregistro", $this->idregistro);
        return $this->db->get();
    }
}