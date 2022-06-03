<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoRegistrarDaniosLesionados_model extends CI_Model
{
    private $id;
    private $Evento_Danios_Lesionados_ID;
    private $Evento_Registro_Numero;
    private $Evento_Danios_Lesionados_Fecha_Atencion;
    private $Tipo_Documento_Codigo;
    private $Lesionado_Documento_Numero;
    private $Lesionado_Apellidos;
    private $Lesionado_Nombres;
    private $Lesionado_Edad;
    private $Lesionado_Observaciones;
    private $Nivel_Gravedad_Codigo;
    private $Situacion_Codigo;
    private $Lesionado_CIE10_Codigo;
    private $Lesionado_Genero;
    private $Lesionado_Gestante;
    private $Lesionado_Entidad_Salud_Codigo;
    private $Lesionado_Personal_Salud;
    private $Lesionado_Entidad_Salud_Nombre;
    private $usuario;
    private $orden;
    private $Evento_Tipo_Entidad_Atencion_ID;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setEvento_Danios_Lesionados_ID($data)
    {
        $this->Evento_Danios_Lesionados_ID = $this->db->escape_str($data);
    }
    public function setEvento_Registro_Numero($data)
    {
        $this->Evento_Registro_Numero = $this->db->escape_str($data);
    }
    public function setEvento_Danios_Lesionados_Fecha_Atencion($data)
    {
        $this->Evento_Danios_Lesionados_Fecha_Atencion = $this->db->escape_str($data);
    }
    public function setEvento_Danios_Fuente($data)
    {
        $this->Evento_Danios_Fuente = $this->db->escape_str($data);
    }
    public function setTipo_Documento_Codigo($data)
    {
        $this->Tipo_Documento_Codigo = $this->db->escape_str($data);
    }
    public function setLesionado_Documento_Numero($data)
    {
        $this->Lesionado_Documento_Numero = $this->db->escape_str($data);
    }
    public function setLesionado_Apellidos($data)
    {
        $this->Lesionado_Apellidos = $this->db->escape_str($data);
    }
    public function setLesionado_Nombres($data)
    {
        $this->Lesionado_Nombres = $this->db->escape_str($data);
    }
    public function setLesionado_Edad($data)
    {
        $this->Lesionado_Edad = $this->db->escape_str($data);
    }
    public function setLesionado_Observaciones($data)
    {
        $this->Lesionado_Observaciones = $this->db->escape_str($data);
    }
    public function setNivel_Gravedad_Codigo($data)
    {
        $this->Nivel_Gravedad_Codigo = $this->db->escape_str($data);
    }
    public function setSituacion_Codigo($data)
    {
        $this->Situacion_Codigo = $this->db->escape_str($data);
    }
    public function setLesionado_CIE10_Codigo($data)
    {
        $this->Lesionado_CIE10_Codigo = $this->db->escape_str($data);
    }
    public function setLesionado_Genero($data)
    {
        $this->Lesionado_Genero = $this->db->escape_str($data);
    }
    public function setLesionado_Gestante($data)
    {
        $this->Lesionado_Gestante = $this->db->escape_str($data);
    }
    public function setLesionado_Entidad_Salud_Codigo($data)
    {
        $this->Lesionado_Entidad_Salud_Codigo = $this->db->escape_str($data);
    }
    public function setLesionado_Personal_Salud($data)
    {
        $this->Lesionado_Personal_Salud = $this->db->escape_str($data);
    }
    public function setLesionado_Entidad_Salud_Nombre($data)
    {
        $this->Lesionado_Entidad_Salud_Nombre = $this->db->escape_str($data);
    }
    public function setUsuario($data)
    {
        $this->usuario = $this->db->escape_str($data);
    }
    public function setOrden($data)
    {
        $this->orden = $this->db->escape_str($data);
    }
    public function setEvento_Tipo_Entidad_Atencion_ID($data)
    {
        $this->Evento_Tipo_Entidad_Atencion_ID = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function listaEnfermedades()
    {
        $this->db->select("Codigo,Descripcion,Diagnostico");
        $this->db->from("lista_enfermedades");
        return $this->db->get();
    }
    public function contar()
    {
        $this->db->select("Evento_Danios_Lesionados_ID,COUNT(1) lesionados");
        $this->db->from("evento_danios_lesionados");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->group_by("Evento_Danios_Lesionados_ID");
        return $this->db->get();
    }
    public function listar()
    {
        $this->db->select("edl.Evento_Registro_Numero,edl.Evento_Danios_Lesionados_ID,edl.Evento_Danios_Lesionados_Numero,edl.Evento_Danios_Lesionados_Fecha_Atencion,edl.Tipo_Documento_Codigo,edl.Lesionado_Documento_Numero,edl.Lesionado_Genero,edl.Lesionado_Gestante,edl.Lesionado_Apellidos,edl.Lesionado_Nombres,edl.Lesionado_Edad,edl.Lesionado_Observaciones,edl.Nivel_Gravedad_Codigo,edl.Situacion_Codigo,edl.Lesionado_CIE10_Codigo,edl.Lesionado_Entidad_Salud_Codigo,edl.Lesionado_Entidad_Salud_Nombre,edl.Lesionado_Personal_Salud,edl.Codigo_Usuario_Registro,edl.Fecha_Registro,edl.Codigo_Usuario_Actualizacion,edl.Fecha_Actualizacion,edl.ultimo,Nivel_Gravedad_Descripcion Gravedad,'' Situacion,le.Descripcion CIE");
        $this->db->from("evento_danios_lesionados edl");
        $this->db->join("nivel_gravedad ng", "ng.Nivel_Gravedad_Codigo=edl.Nivel_Gravedad_Codigo", 'LEFT');
        $this->db->join("lista_enfermedades le", "ng.Codigo=edl.Lesionado_CIE10_Codigo", 'LEFT');
        $this->db->where("Evento_Danios_Lesionados_ID", $this->Evento_Danios_Lesionados_ID);
        return $this->db->get();
    }
    public function registrar()
    {
        $data = array(
            "Evento_Danios_Lesionados_Fecha_Atencion" => $this->Evento_Danios_Lesionados_Fecha_Atencion,
            "Lesionado_Documento_Numero" => $this->Lesionado_Documento_Numero,
            "Lesionado_Apellidos" => strtoupper($this->Lesionado_Apellidos),
            "Lesionado_Nombres" => strtoupper($this->Lesionado_Nombres),
            "Lesionado_Edad" => $this->Lesionado_Edad,
            "Lesionado_Observaciones" => $this->Lesionado_Observaciones,
            "Nivel_Gravedad_Codigo" => $this->Nivel_Gravedad_Codigo,
            "Situacion_Codigo" => $this->Situacion_Codigo,
            "Lesionado_CIE10_Codigo" => $this->Lesionado_CIE10_Codigo,
            "Tipo_Documento_Codigo" => $this->Tipo_Documento_Codigo,
            "Evento_Danios_Lesionados_ID" => $this->Evento_Danios_Lesionados_ID,
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Lesionado_Genero" => $this->Lesionado_Genero,
            "Lesionado_Gestante" => $this->Lesionado_Gestante,
            "Lesionado_Entidad_Salud_Codigo" => $this->Lesionado_Entidad_Salud_Codigo,
            "Lesionado_Entidad_Salud_Nombre" => $this->Lesionado_Entidad_Salud_Nombre,
            "Lesionado_Personal_Salud" => $this->Lesionado_Personal_Salud,
            "Codigo_Usuario_Registro" => $this->session->userdata("idusuario"),
            "Evento_Tipo_Entidad_Atencion_ID" => $this->Evento_Tipo_Entidad_Atencion_ID
        );
        if ($this->db->insert('evento_danios_lesionados', $data))
            return true;
        else
            return false;
    }
    public function registrarApp()
    {
        $data = array(
            "Evento_Danios_Lesionados_Fecha_Atencion" => $this->Evento_Danios_Lesionados_Fecha_Atencion,
            "Lesionado_Documento_Numero" => $this->Lesionado_Documento_Numero,
            "Lesionado_Apellidos" => strtoupper($this->Lesionado_Apellidos),
            "Lesionado_Nombres" => strtoupper($this->Lesionado_Nombres),
            "Lesionado_Edad" => $this->Lesionado_Edad,
            "Lesionado_Observaciones" => $this->Lesionado_Observaciones,
            "Nivel_Gravedad_Codigo" => $this->Nivel_Gravedad_Codigo,
            "Situacion_Codigo" => $this->Situacion_Codigo,
            "Lesionado_CIE10_Codigo" => $this->Lesionado_CIE10_Codigo,
            "Tipo_Documento_Codigo" => $this->Tipo_Documento_Codigo,
            "Evento_Danios_Lesionados_ID" => $this->Evento_Danios_Lesionados_ID,
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Lesionado_Genero" => $this->Lesionado_Genero,
            "Lesionado_Gestante" => $this->Lesionado_Gestante,
            "Lesionado_Entidad_Salud_Codigo" => $this->Lesionado_Entidad_Salud_Codigo,
            "Lesionado_Entidad_Salud_Nombre" => $this->Lesionado_Entidad_Salud_Nombre,
            "Lesionado_Personal_Salud" => $this->Lesionado_Personal_Salud,
            "Codigo_Usuario_Registro" => $this->usuario,
            "Evento_Tipo_Entidad_Atencion_ID" => $this->Evento_Tipo_Entidad_Atencion_ID
        );
        if ($this->db->insert('evento_danios_lesionados', $data))
            return true;
        else
            return false;
    }
    public function clonar()
    {
        $this->db->select("Evento_Registro_Numero, Evento_Danios_Lesionados_ID, Evento_Danios_Lesionados_Numero, Evento_Danios_Lesionados_Fecha_Atencion, Tipo_Documento_Codigo, Lesionado_Documento_Numero, Lesionado_Genero, Lesionado_Gestante, Lesionado_Apellidos, Lesionado_Nombres, Lesionado_Edad, Lesionado_Observaciones, Nivel_Gravedad_Codigo, Situacion_Codigo, Lesionado_CIE10_Codigo, Lesionado_Entidad_Salud_Codigo, Lesionado_Entidad_Salud_Nombre, Lesionado_Personal_Salud, Codigo_Usuario_Registro, Fecha_Registro, Codigo_Usuario_Actualizacion, Fecha_Actualizacion, ultimo, Evento_Tipo_Entidad_Atencion_ID");
        $this->db->from("evento_danios_lesionados");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->where("Evento_Danios_Lesionados_ID", $this->Evento_Danios_Lesionados_ID);
        $query = $this->db->get();
        foreach ($query->result() as $row) :
            $eventoDaniosLesionados = ($this->Evento_Danios_Lesionados_ID + 1);
			$Lesionado_Edad = (strlen($row->Lesionado_Edad)>0)?$row->Lesionado_Edad:null;
            $data = array(
                "Evento_Danios_Lesionados_Fecha_Atencion" => $row->Evento_Danios_Lesionados_Fecha_Atencion,
                "Lesionado_Documento_Numero" => $row->Lesionado_Documento_Numero,
                "Lesionado_Apellidos" => strtoupper($row->Lesionado_Apellidos),
                "Lesionado_Nombres" => strtoupper($row->Lesionado_Nombres),
                "Lesionado_Edad" => $Lesionado_Edad,
                "Lesionado_Observaciones" => $row->Lesionado_Observaciones,
                "Nivel_Gravedad_Codigo" => $row->Nivel_Gravedad_Codigo,
                "Situacion_Codigo" => $row->Situacion_Codigo,
                "Lesionado_CIE10_Codigo" => $row->Lesionado_CIE10_Codigo,
                "Tipo_Documento_Codigo" => $row->Tipo_Documento_Codigo,
                "Evento_Danios_Lesionados_ID" => $eventoDaniosLesionados,
                "Evento_Registro_Numero" => $row->Evento_Registro_Numero,
                "Lesionado_Genero" => $row->Lesionado_Genero,
                "Lesionado_Gestante" => $row->Lesionado_Gestante,
                "Lesionado_Entidad_Salud_Codigo" => $row->Lesionado_Entidad_Salud_Codigo,
                "Lesionado_Entidad_Salud_Nombre" => $row->Lesionado_Entidad_Salud_Nombre,
                "Lesionado_Personal_Salud" => $row->Lesionado_Personal_Salud,
                "Codigo_Usuario_Registro" => $this->session->userdata("idusuario"),
                "Evento_Tipo_Entidad_Atencion_ID" => $row->Evento_Tipo_Entidad_Atencion_ID
            );
            $this->db->insert('evento_danios_lesionados', $data);
        endforeach
        ;
    }
    public function actualizar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Evento_Danios_Lesionados_Fecha_Atencion", $this->Evento_Danios_Lesionados_Fecha_Atencion, TRUE);
        $this->db->set("Lesionado_Documento_Numero", $this->Lesionado_Documento_Numero, TRUE);
        $this->db->set("Lesionado_Apellidos", strtoupper($this->Lesionado_Apellidos), TRUE);
        $this->db->set("Lesionado_Nombres", strtoupper($this->Lesionado_Nombres), TRUE);
		if(strlen($this->Lesionado_Edad)>0) $this->db->set("Lesionado_Edad", $this->Lesionado_Edad, TRUE);
        $this->db->set("Lesionado_Observaciones", $this->Lesionado_Observaciones, TRUE);
        $this->db->set("Nivel_Gravedad_Codigo", $this->Nivel_Gravedad_Codigo, TRUE);
        $this->db->set("Situacion_Codigo", $this->Situacion_Codigo, TRUE);
        $this->db->set("Lesionado_CIE10_Codigo", $this->Lesionado_CIE10_Codigo, TRUE);
        $this->db->set("Tipo_Documento_Codigo", $this->Tipo_Documento_Codigo, TRUE);
        $this->db->set("Lesionado_Genero", $this->Lesionado_Genero, TRUE);
        $this->db->set("Lesionado_Gestante", $this->Lesionado_Gestante, TRUE);
        $this->db->set("Lesionado_Entidad_Salud_Codigo", $this->Lesionado_Entidad_Salud_Codigo, TRUE);
        $this->db->set("Lesionado_Entidad_Salud_Nombre", $this->Lesionado_Entidad_Salud_Nombre, TRUE);
        $this->db->set("Lesionado_Personal_Salud", $this->Lesionado_Personal_Salud, TRUE);
        $this->db->set("Fecha_Actualizacion", date('Y-m-d h:i:s'), TRUE);
        $this->db->set("Codigo_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Evento_Tipo_Entidad_Atencion_ID", $this->Evento_Tipo_Entidad_Atencion_ID, TRUE);
        $this->db->where("Evento_Danios_Lesionados_Numero", $this->id);
        $error = array();
        if ($this->db->update('evento_danios_lesionados'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminar()
    {
        return $this->db->delete('evento_danios_lesionados', array(
            'Evento_Danios_Lesionados_ID' => $this->Evento_Danios_Lesionados_ID,
            'Evento_Registro_Numero' => $this->Evento_Registro_Numero
        ));
    }
    public function eliminarLesionado()
    {
        return $this->db->delete('evento_danios_lesionados', array(
            'Evento_Danios_Lesionados_Numero' => $this->id,
            'Evento_Registro_Numero' => $this->Evento_Registro_Numero
        ));
    }
    public function listaDaniosLesionados()
    {
        $this->db->select("edl.Evento_Registro_Numero,edl.Evento_Danios_Lesionados_ID,edl.Evento_Danios_Lesionados_Numero,edl.Evento_Danios_Lesionados_Fecha_Atencion,edl.Tipo_Documento_Codigo,edl.Lesionado_Documento_Numero,edl.Lesionado_Genero,edl.Lesionado_Gestante,edl.Lesionado_Apellidos,edl.Lesionado_Nombres,edl.Lesionado_Edad,edl.Lesionado_Observaciones,edl.Nivel_Gravedad_Codigo,edl.Situacion_Codigo,edl.Lesionado_CIE10_Codigo,edl.Lesionado_Entidad_Salud_Codigo,edl.Lesionado_Entidad_Salud_Nombre,edl.Lesionado_Personal_Salud,edl.Codigo_Usuario_Registro,edl.Fecha_Registro,edl.Codigo_Usuario_Actualizacion,edl.Fecha_Actualizacion,edl.ultimo,DATE_FORMAT(Evento_Danios_Lesionados_Fecha_Atencion,'%d/%m/%Y %H:%i') AS Fecha");
        $this->db->select("ng.Nivel_Gravedad_Descripcion Gravedad,s.Situacion_Descripcion Situacion,le.Descripcion CIE,edl.Evento_Tipo_Entidad_Atencion_ID");
        $this->db->from("evento_danios_lesionados edl");
        $this->db->join("tipo_documento td", "td.Tipo_Documento_Codigo=edl.Tipo_Documento_Codigo", "LEFT");
        $this->db->join("lista_enfermedades le", "le.Codigo=edl.Lesionado_CIE10_Codigo", 'LEFT');
        $this->db->join("situacion s", "s.Situacion_Codigo=edl.Situacion_Codigo", 'LEFT');
        $this->db->join("nivel_gravedad ng", "ng.Nivel_Gravedad_Codigo=edl.Nivel_Gravedad_Codigo", 'LEFT');
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->where("Evento_Danios_Lesionados_ID", $this->Evento_Danios_Lesionados_ID);
        return $this->db->get();
    }
    public function actualizarUltimo()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("ultimo", "0", TRUE);
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $error = array();
        if ($this->db->update('evento_danios_lesionados'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function actualizarUltimoAnterior()
    {
        $this->db->select("MAX(Evento_Danios_Lesionados_ID) maximo");
        $this->db->from("evento_danios_lesionados");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $maximo = $this->db->get();
        if($maximo->num_rows()>0){
            $maximo = $maximo->row();
            $maximo = $maximo->maximo;
            $this->db->db_debug = FALSE;
            $this->db->set("ultimo", "1", TRUE);
            $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
            $this->db->where("Evento_Danios_Lesionados_ID", $maximo);
            $error = array();
            if ($this->db->update('evento_danios_lesionados')){
                    $this->db->select("COUNT(1) total");
                    $this->db->from("evento_danios_lesionados");
                    $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
                    $this->db->where("Evento_Danios_Lesionados_ID", $maximo);
                    $rs = $this->db->get();
                    $row = $rs->row();
                return $row->total;
            }
            else {
                return -1;
            }
        }
        else {
            return 0;
        }
    }
    public function mujeres()
    {
        $this->db->select("COUNT(Evento_Danios_Lesionados_Numero) TOTAL");
        $this->db->from("evento_danios_lesionados");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->where("Lesionado_Genero", "2");
        $this->db->where("Situacion_Codigo!=","04");
        $this->db->group_by("Evento_Danios_Lesionados_ID");
        $this->db->order_by("Evento_Danios_Lesionados_ID", $this->orden);
        $this->db->limit(1);
        return $this->db->get();
    }
    public function gestantes()
    {
        $this->db->select("COUNT(Evento_Danios_Lesionados_Numero) TOTAL");
        $this->db->from("evento_danios_lesionados");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->where("Lesionado_Genero", "2");
        $this->db->where("Lesionado_Gestante", "1");
        $this->db->where("Situacion_Codigo!=","04");
        $this->db->group_by("Evento_Danios_Lesionados_ID");
        $this->db->order_by("Evento_Danios_Lesionados_ID", $this->orden);
        $this->db->limit(1);
        return $this->db->get();
    }
    public function menorEdad()
    {
        $this->db->select("COUNT(Evento_Danios_Lesionados_Numero) TOTAL");
        $this->db->from("evento_danios_lesionados");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->where("Lesionado_Edad<", "18");
        $this->db->where("Situacion_Codigo!=","04");
        $this->db->group_by("Evento_Danios_Lesionados_ID");
        $this->db->order_by("Evento_Danios_Lesionados_ID", $this->orden);
        $this->db->limit(1);
        return $this->db->get();
    }
    public function adultoMayor()
    {
        $this->db->select("COUNT(Evento_Danios_Lesionados_Numero) TOTAL");
        $this->db->from("evento_danios_lesionados");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->where("Lesionado_Edad>", "64");
        $this->db->where("Situacion_Codigo!=","04");
        $this->db->group_by("Evento_Danios_Lesionados_ID");
        $this->db->order_by("Evento_Danios_Lesionados_ID", $this->orden);
        $this->db->limit(1);
        return $this->db->get();
    }
    public function fallecidos()
    {
        $this->db->select("COUNT(Evento_Danios_Lesionados_Numero) TOTAL");
        $this->db->from("evento_danios_lesionados");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->where("Situacion_Codigo","04");
        $this->db->group_by("Evento_Danios_Lesionados_ID");
        $this->db->order_by("Evento_Danios_Lesionados_ID", $this->orden);
        $this->db->limit(1);
        return $this->db->get();
    }
    public function tabla2()
    {
        $this->db->select("edl.Lesionado_Nombres,edl.Lesionado_Apellidos,edl.Lesionado_Edad,.le.Descripcion CIE,edl.Lesionado_Genero");
        $this->db->select("edl.Lesionado_Entidad_Salud_Codigo,edl.Lesionado_Entidad_Salud_Nombre");
        $this->db->from("evento_danios_lesionados edl");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->join("lista_enfermedades le", "le.Codigo=edl.Lesionado_CIE10_Codigo", 'LEFT');
        if($this->orden=="ASC"){
          $this->db->where("edl.Evento_Danios_Lesionados_ID", $this->Evento_Danios_Lesionados_ID);
        }
        else{
          $this->db->where("edl.ultimo", "1");
        }
        $this->db->where("edl.Situacion_Codigo", "01");
        return $this->db->get();
    }
    public function consolidadoFallecidos()
    {
        $this->db->select("Lesionado_Nombres,Lesionado_Apellidos,Lesionado_Edad,Lesionado_Entidad_Salud_Codigo,Lesionado_Entidad_Salud_Nombre,Lesionado_Genero");
        $this->db->from("evento_danios_lesionados");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        if($this->orden=="ASC"){
          $this->db->where("Evento_Danios_Lesionados_ID", $this->Evento_Danios_Lesionados_ID);
        }
        else{
          $this->db->where("ultimo", "1");
        }
        $this->db->where("Situacion_Codigo", "04");
        return $this->db->get();
    }
    public function hospitalizadosReferidosObservados()
    {
        $situacion = array("02","03","06");
        $this->db->select("Lesionado_Nombres,Lesionado_Apellidos,Lesionado_Edad,Lesionado_Genero");
        $this->db->select("edl.Lesionado_Apellidos,edl.Lesionado_Nombres,edl.Lesionado_Edad,Nivel_Gravedad_Descripcion Gravedad");
        $this->db->select("edl.Situacion_Codigo,le.Descripcion CIE,edl.Lesionado_Entidad_Salud_Codigo,edl.Lesionado_Entidad_Salud_Nombre");
        $this->db->from("evento_danios_lesionados edl");
        $this->db->join("nivel_gravedad ng", "ng.Nivel_Gravedad_Codigo=edl.Nivel_Gravedad_Codigo", 'LEFT');
        $this->db->join("lista_enfermedades le", "le.Codigo=edl.Lesionado_CIE10_Codigo", 'LEFT');
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        if($this->orden=="ASC"){
            $this->db->where("Evento_Danios_Lesionados_ID", $this->Evento_Danios_Lesionados_ID);
        }
        else{
            $this->db->where("ultimo", "1");
        }
        $this->db->where_in("Situacion_Codigo", $situacion);
        $this->db->order_by("ng.Nivel_Gravedad_Codigo desc");
        return $this->db->get();
    }
    public function consolidadoDesaparecidos() {
        $this->db->select("Lesionado_Nombres,Lesionado_Apellidos,Lesionado_Edad,Lesionado_Genero");
        $this->db->from("evento_danios_lesionados");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        if($this->orden=="ASC"){
            $this->db->where("Evento_Danios_Lesionados_ID", $this->Evento_Danios_Lesionados_ID);
        }
        else{
            $this->db->where("ultimo", "1");
        }
        $this->db->where("Situacion_Codigo", "05");
        return $this->db->get();
    }
    public function lesionados()
    {
        $this->db->select("COUNT(1) total");
        $this->db->from("evento_danios_lesionados");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        if($this->orden=="ASC"){
          $this->db->where("Evento_Danios_Lesionados_ID", $this->Evento_Danios_Lesionados_ID);
        }
        else{
          $this->db->where("ultimo", "1");
        }
        return $this->db->get();
    }
}