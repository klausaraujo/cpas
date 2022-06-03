<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Asignacion_model extends CI_Model
{
    private $evento;
    private $id;
    private $articulo;
    private $descripcion;
    private $presentacion;
    private $profesion;
    private $especialidad;
    private $fuente;
    private $cantidad;
    private $prioridad;
    public function setevento($data){$this->evento = $this->db->escape_str($data);}
    public function setid($data){$this->id = $this->db->escape_str($data);}
    public function setarticulo($data){$this->articulo = $this->db->escape_str($data);}
    public function setdescripcion($data){$this->descripcion = $this->db->escape_str($data);}
    public function setpresentacion($data){$this->presentacion = $this->db->escape_str($data);}
    public function setprofesion($data){$this->profesion = $this->db->escape_str($data);}
    public function setespecialidad($data){$this->especialidad = $this->db->escape_str($data);}
    public function setfuente($data){$this->fuente = $this->db->escape_str($data);}
    public function setcantidad($data){$this->cantidad = $this->db->escape_str($data);}
    public function setprioridad($data){$this->prioridad = $this->db->escape_str($data);}
    public function listaMedicamentosPresentacion() {
        $this->db->select("evento_medicamentos_presentacion_id id,evento_medicamentos_presentacion");
        $this->db->from("evento_medicamentos_presentacion");
        $this->db->where("estado", '1');
        
        return $this->db->get();
    }
    public function eventoMedicamentos() {
        $this->db->select("m.evento_medicamentos_id id,m.evento_medicamentos_articulo articulo,mp.evento_medicamentos_presentacion presentacion,m.evento_medicamentos_cantidad cantidad,m.evento_medicamentos_prioridad prioridad");
        $this->db->from("evento_medicamentos m");
        $this->db->join("evento_medicamentos_presentacion mp","mp.evento_medicamentos_presentacion_id=m.evento_medicamentos_presentacion_id","left");
        $this->db->where("m.estado", '1');
        $this->db->where_in("m.evento_registro_numero", $this->id);
        return $this->db->get();
    }
    public function eventoEquipos() {
        $this->db->select("evento_equipos_id id,evento_equipos_descripcion descripcion,evento_equipos_fuente fuente,evento_equipos_cantidad cantidad,evento_equipos_prioridad prioridad");
        $this->db->from("evento_equipos");
        $this->db->where("estado", '1');
        $this->db->where_in("evento_registro_numero", $this->id);
        return $this->db->get();
    }
    public function eventoRecursos() {
        $this->db->select("evento_recursos_humanos_id id,evento_recursos_humanos_profesion profesion,evento_recursos_humanos_especialidad especialidad,evento_recursos_humanos_cantidad cantidad, evento_recursos_humanos_prioridad prioridad");
        $this->db->from("evento_recursos_humanos");
        $this->db->where("estado", '1');
        $this->db->where_in("evento_registro_numero", $this->id);
        return $this->db->get();
    }
    public function buscarMedicamento() {
        $this->db->select("1");
        $this->db->from("evento_medicamentos");
        $this->db->where("evento_registro_numero",$this->evento);
        $this->db->where("evento_medicamentos_articulo",$this->articulo);
        $this->db->where("evento_medicamentos_presentacion_id",$this->presentacion);
        $this->db->where("evento_medicamentos_cantidad",$this->cantidad);
        $this->db->where("evento_medicamentos_prioridad",$this->prioridad);
        return $this->db->get();
    }
    public function registrarMedicamento() {
        $data = array(
            "evento_registro_numero" => $this->evento,
            "evento_medicamentos_articulo" => $this->articulo,
            "evento_medicamentos_presentacion_id" => $this->presentacion,
            "evento_medicamentos_cantidad" => $this->cantidad,
            "evento_medicamentos_prioridad" => $this->prioridad,
            "estado" => "1"
        );
        if ($this->db->insert('evento_medicamentos', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function buscarEquipo() {
        $this->db->select("1");
        $this->db->from("evento_equipos");
        $this->db->where("evento_registro_numero",$this->evento);
        $this->db->where("evento_equipos_descripcion",$this->descripcion);
        $this->db->where("evento_equipos_fuente",$this->fuente);
        $this->db->where("evento_equipos_cantidad",$this->cantidad);
        $this->db->where("evento_equipos_prioridad",$this->prioridad);
        return $this->db->get();   
    }
    public function registrarEquipo() {
        $data = array(
            "evento_registro_numero" => $this->evento,
            "evento_equipos_descripcion" => $this->descripcion,
            "evento_equipos_fuente" => $this->fuente,
            "evento_equipos_cantidad" => $this->cantidad,
            "evento_equipos_prioridad" => $this->prioridad,
            "estado" => "1"
        );
        if ($this->db->insert('evento_equipos', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function buscarRecurso() {
        $this->db->select("1");
        $this->db->from("evento_recursos_humanos");
        $this->db->where("evento_registro_numero",$this->evento);
        $this->db->where("evento_recursos_humanos_profesion",$this->profesion);
        $this->db->where("evento_recursos_humanos_especialidad",$this->especialidad);
        $this->db->where("evento_recursos_humanos_cantidad",$this->cantidad);
        $this->db->where("evento_recursos_humanos_prioridad",$this->prioridad);
        return $this->db->get();
    }
    public function registrarRecurso() {
        $data = array(
            "evento_registro_numero" => $this->evento,
            "evento_recursos_humanos_profesion" => $this->profesion,
            "evento_recursos_humanos_especialidad" => $this->especialidad,
            "evento_recursos_humanos_cantidad" => $this->cantidad,
            "evento_recursos_humanos_prioridad" => $this->prioridad,
            "estado" => "1"
        );
        
        if ($this->db->insert('evento_recursos_humanos', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarMedicamento() {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_medicamentos_id", $this->id);
        $error = array();
        if ($this->db->delete('evento_medicamentos'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function eliminarEquipo() {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_equipos_id", $this->id);
        $error = array();
        if ($this->db->delete('evento_equipos'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function eliminarRecurso() {
        $this->db->db_debug = FALSE;
        $this->db->where("evento_recursos_humanos_id", $this->id);
        $error = array();
        if ($this->db->delete('evento_recursos_humanos'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
}