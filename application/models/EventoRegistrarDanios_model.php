<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoRegistrarDanios_model extends CI_Model
{
    private $id;
    private $Evento_Registro_Numero;
    private $Evento_Danios_Fecha;
    private $Evento_Danios_Fuente;
    private $Evento_Danios_Descripcion;
    private $Evento_Lesionados;
    private $Evento_Fallecidos;
    private $Evento_Desaparecidos;
    private $Evento_Viv_Inhabitables;
    private $Evento_Viv_Colapsadas;
    private $primero;
    private $ususario;
    private $Evento_nombre_f;
    private $Evento_institucion_f;
    private $Evento_telefono_f;
    private $Evento_correo_f;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setEvento_Registro_Numero($data)
    {
        $this->Evento_Registro_Numero = $this->db->escape_str($data);
    }
    public function setEvento_Danios_Fecha($data)
    {
        $this->Evento_Danios_Fecha = $this->db->escape_str($data);
    }
    public function setEvento_Danios_Fuente($data)
    {
        $this->Evento_Danios_Fuente = $this->db->escape_str($data);
    }
    public function setEvento_Danios_Descripcion($data)
    {
        $this->Evento_Danios_Descripcion = $this->db->escape_str($data);
    }
    public function setEvento_Lesionados($data)
    {
        $this->Evento_Lesionados = $this->db->escape_str($data);
    }
    public function setEvento_Fallecidos($data)
    {
        $this->Evento_Fallecidos = $this->db->escape_str($data);
    }
    public function setEvento_Desaparecidos($data)
    {
        $this->Evento_Desaparecidos = $this->db->escape_str($data);
    }
    public function setEvento_Viv_Inhabitables($data)
    {
        $this->Evento_Viv_Inhabitables = $this->db->escape_str($data);
    }
    public function setEvento_Viv_Colapsadas($data)
    {
        $this->Evento_Viv_Colapsadas = $this->db->escape_str($data);
    }
    public function setPrimero($data)
    {
        $this->primero = $this->db->escape_str($data);
    }
    public function setUsuario($data)
    {
        $this->usuario = $this->db->escape_str($data);
    }
    public function setEvento_nombre_f($data)
    {
        $this->Evento_nombre_f = $this->db->escape_str($data);
    }
    public function setEvento_institucion_f($data)
    {
        $this->Evento_institucion_f = $this->db->escape_str($data);
    }
    public function setEvento_telefono_f($data)
    {
        $this->Evento_telefono_f = $this->db->escape_str($data);
    }
    public function setEvento_correo_f($data)
    {
        $this->Evento_correo_f = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function contarDanios()
    {
        $this->db->select("COUNT(1) total");
        $this->db->from("evento_danios");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $query = $this->db->get();
        $row = $query->row();
        if ($row->total > 0)
            return 0;
        else
            return 1;
    }
    public function registrar()
    {
        $data = array(
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Evento_Danios_Fecha" => $this->Evento_Danios_Fecha,
            "Evento_Lesionados" => $this->Evento_Lesionados,
            "Evento_Fallecidos" => $this->Evento_Fallecidos,
            "Evento_Desaparecidos" => $this->Evento_Desaparecidos,
            "Evento_Viv_Inhabitables" => $this->Evento_Viv_Inhabitables,
            "Evento_Viv_Colapsadas" => $this->Evento_Viv_Colapsadas,
            "Primero" => $this->primero,
            "Codigo_Usuario_Registro" => $this->session->userdata("idusuario"),
            "Evento_Danios_Nombre" => $this->Evento_nombre_f,
            "Evento_Danios_Institucion" => $this->Evento_institucion_f,
            "Evento_Danios_Telefono" => $this->Evento_telefono_f,
            "Evento_Danios_Correo" => $this->Evento_correo_f
        );

        if ($this->db->insert('evento_danios', $data))
            return true;
        else
            return false;
    }

    public function registrarApp()
    {
        $data = array(
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Evento_Danios_Fecha" => $this->Evento_Danios_Fecha,
            "Evento_Danios_Fuente" => $this->Evento_Danios_Fuente,
            "Evento_Danios_Descripcion" => $this->Evento_Danios_Descripcion,
            "Evento_Lesionados" => $this->Evento_Lesionados,
            "Evento_Fallecidos" => $this->Evento_Fallecidos,
            "Evento_Desaparecidos" => $this->Evento_Desaparecidos,
            "Evento_Viv_Inhabitables" => $this->Evento_Viv_Inhabitables,
            "Evento_Viv_Colapsadas" => $this->Evento_Viv_Colapsadas,
            "Primero" => $this->primero,
            "Codigo_Usuario_Registro" => $this->usuario
        );
        if ($this->db->insert('evento_danios', $data))
            return true;
        else
            return false;
    }
    public function actualizar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Evento_Danios_Fecha", $this->Evento_Danios_Fecha, TRUE);
        $this->db->set("Evento_Lesionados", $this->Evento_Lesionados, TRUE);
        $this->db->set("Evento_Fallecidos", $this->Evento_Fallecidos, TRUE);
        $this->db->set("Evento_Desaparecidos", $this->Evento_Desaparecidos, TRUE);
        $this->db->set("Evento_Viv_Inhabitables", $this->Evento_Viv_Inhabitables, TRUE);
        $this->db->set("Evento_Viv_Colapsadas", $this->Evento_Viv_Colapsadas, TRUE);
        $this->db->set("Fecha_Actualizacion", date('Y-m-d h:i:s'), TRUE);
        $this->db->set("Codigo_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Evento_Danios_Nombre", $this->Evento_nombre_f, TRUE);
        $this->db->set("Evento_Danios_Institucion", $this->Evento_institucion_f, TRUE);
        $this->db->set("Evento_Danios_Telefono", $this->Evento_telefono_f, TRUE);
        $this->db->set("Evento_Danios_Correo", $this->Evento_correo_f, TRUE);
        $this->db->where("Evento_Danios_ID", $this->id);
        $error = array();
        if ($this->db->update('evento_danios'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminar()
    {
        return $this->db->delete('evento_danios', array(
            'Evento_Danios_ID' => $this->id,
            'Evento_Registro_Numero' => $this->Evento_Registro_Numero
        ));
    }
    public function actualizarEventoRegistro(){
        $this->db->select("Evento_Viv_Inhabitables,Evento_Viv_Colapsadas");
        $this->db->from("evento_danios");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Danios_ID", "DESC");
        $this->db->limit(1);
        $rs = $this->db->get();
        $total = 0;
        if($rs->num_rows()){
            $row = $rs->row();
            $total = $row->Evento_Viv_Inhabitables+$row->Evento_Viv_Colapsadas;
        }
        $this->db->db_debug = FALSE;
        $this->db->set("Cantidad_Danio", $total, TRUE);
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $error = array();
        $this->db->update('evento_registro');
    }
    public function listaEvento()
    {
        $this->db->select("Evento_Registro_Numero,ed.Evento_Danios_ID,ed.Evento_Danios_Fecha,ed.Evento_Danios_Fuente,ed.Evento_Danios_Descripcion,ed.Evento_Danios_Nombre,ed.Evento_Danios_Institucion,ed.Evento_Danios_Telefono,ed.Evento_Danios_Correo,ed.Evento_Lesionados,ed.Evento_Fallecidos,ed.Evento_Desaparecidos,ed.Evento_Viv_Afectadas,ed.Evento_Viv_Inhabitables,ed.Evento_Viv_Colapsadas,ed.Evento_Per_Afectadas,ed.Evento_Per_Damnificadas,ed.Codigo_Usuario_Registro,ed.Fecha_Registro,ed.Codigo_Usuario_Actualizacion,ed.Fecha_Actualizacion,ed.Primero,ed.Activo,DATE_FORMAT(Evento_Danios_Fecha,'%d/%m/%Y %H:%i') as fecha,CONCAT(Apellidos,', ',Nombres) usuario");
        $this->db->from("evento_danios ed");
        $this->db->join("usuarios u", "ed.Codigo_Usuario_Registro = u.Codigo_Usuario");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);

        return $this->db->get();
    }
    public function danio()
    {
        $this->db->select("DATE_FORMAT(Evento_Danios_Fecha,'%d/%m/%Y %H:%i') as fecha,CONCAT(Apellidos,', ',Nombres) usuario");
        $this->db->select("Evento_Lesionados,Evento_Fallecidos,Evento_Desaparecidos,Evento_Viv_Inhabitables Evento_Operativas,Evento_Viv_Colapsadas Evento_Inoperativas");
        $this->db->select("Evento_Danios_Fuente,Evento_Danios_Descripcion");
        $this->db->from("evento_danios ed");
        $this->db->from("usuarios u","u.Codigo_Usuario=ed.Codigo_Usuario_Registro");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Danios_ID", "ASC");
        $this->db->limit(1);
        return $this->db->get();
    }
    public function danioApp()
    {
        $this->db->select("DATE_FORMAT(Evento_Danios_Fecha,'%d/%m/%Y %H:%i') as fechaEvento,CONCAT(Apellidos,', ',Nombres) usuario");
        $this->db->select("Evento_Lesionados lesionados,Evento_Fallecidos fallecidos,Evento_Desaparecidos desaparecidos,Evento_Viv_Inhabitables inhabitables");
        $this->db->select("Evento_Viv_Colapsadas colapsadas,Evento_Danios_Fuente fuente,Evento_Danios_Descripcion descripcion");
        $this->db->from("evento_danios ed");
        $this->db->from("usuarios u","u.Codigo_Usuario=ed.Codigo_Usuario_Registro");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Danios_ID", "ASC");
        $this->db->limit(1);
        return $this->db->get();
    }
    public function actualizarUltimo()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("ultimo", "0", TRUE);        
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $error = array();
        if ($this->db->update('evento_danios'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function actualizarUltimoAnterior()
    {
        $this->db->select("Evento_Danios_ID id");
        $this->db->from("evento_danios");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Danios_ID", "DESC");
        $this->db->limit(1);
        $rs = $this->db->get();
        if($rs->num_rows()){
            $row = $rs->row();
            $this->db->db_debug = FALSE;
            $this->db->set("ultimo", "1", TRUE);
            $this->db->where("Evento_Danios_ID", $row->id);
            $error = array();
            if ($this->db->update('evento_danios'))
                return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
        }else return 0;
    }
    public function daniosInforme()
    {
        $this->db->select("Evento_Registro_Numero, Evento_Danios_ID, Evento_Danios_Fecha, Evento_Danios_Fuente, Evento_Danios_Descripcion, Evento_Lesionados, Evento_Fallecidos, Evento_Desaparecidos, Evento_Viv_Afectadas, Evento_Viv_Inhabitables, Evento_Viv_Colapsadas, Evento_Per_Afectadas, Evento_Per_Damnificadas, Codigo_Usuario_Registro, Fecha_Registro, Codigo_Usuario_Actualizacion, Fecha_Actualizacion, Primero, Activo");
        $this->db->from("evento_danios");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Danios_ID", "ASC");
        $this->db->limit(1);
        return $this->db->get();
    }
    public function daniosInformeFinal()
    {
        $this->db->select("Evento_Registro_Numero, Evento_Danios_ID, Evento_Danios_Fecha, Evento_Danios_Fuente, Evento_Danios_Descripcion, Evento_Lesionados, Evento_Fallecidos, Evento_Desaparecidos, Evento_Viv_Afectadas, Evento_Viv_Inhabitables, Evento_Viv_Colapsadas, Evento_Per_Afectadas, Evento_Per_Damnificadas, Codigo_Usuario_Registro, Fecha_Registro, Codigo_Usuario_Actualizacion, Fecha_Actualizacion, Primero, Activo");
        $this->db->from("evento_danios");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Danios_ID", "DESC");
        $this->db->limit(1);
        return $this->db->get();
    }
    public function datosDanios () {
        $this->db->select("Evento_Lesionados, Evento_Fallecidos, Evento_Desaparecidos");
        $this->db->select("Evento_Viv_Inhabitables operativas, Evento_Viv_Colapsadas inoperativas");
        $this->db->from("evento_danios");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        if ($this->primero == 1) {
            $this->db->where("primero", 1);
        } else{
            $this->db->where("ultimo", 1);
        }
        return $this->db->get();
    }
}