<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class EventoAcciones_model extends CI_Model
{
    private $id;
    private $Evento_Registro_Numero;
    private $Evento_Acciones_Fecha;
    private $Tipo_Accion_Codigo;
    private $Tipo_Accion_Entidad_Codigo;
    private $Evento_Acciones_Region;
    private $Evento_Acciones_Minsa;
    private $Evento_Acciones_Emt_i;
    private $Evento_Acciones_Emt_ii;
    private $Evento_Acciones_Emt_iii;
    private $Evento_Acciones_Celula_Especializada;
    private $Evento_Acciones_Minsa_Samu;
    private $Evento_Acciones_Salud_Minsa;
    private $Evento_Acciones_Essalud;
    private $Evento_Acciones_Municipalidades_Gores;
    private $Evento_Acciones_Voluntarios;
    private $Evento_Ambulancias_Minsa_Samu;
    private $Evento_Ambulancias_Minsa;
    private $Evento_Ambulancias_Essalud;
    private $Evento_Ambulancias_Bomberos;
    private $Evento_Ambulancias_Municipalidades_Gores;
    private $Evento_Ambulancias_PNP_FFAA;
    private $Evento_Ambulancianas_Privadas;
    private $Evento_Maletin_Emergencias_Desastres;
    private $Evento_Kit_Medicamentos_Insumos;
    private $Evento_Acciones_Equipo_Biomedicos;
    private $Evento_Acciones_Puesto_Comando;
    private $Evento_Acciones_Ac_Victimas;
    private $Evento_Acciones_Oferta_Movil_i;
    private $Evento_Acciones_Oferta_Movil_ii;
    private $Evento_Acciones_Oferta_Movil_iii;
    private $Evento_Acciones_Hospital_Modular;
    private $Evento_Banio_Quimico_Portatil;
    private $ususario;
    private $Evento_Rescatistas;
    private $Evento_Medicos_Tacticos;
    private $Evento_Acciones_PNP_FFAA;
    private $Equipo_Tecnico_Movilizado_Diresa;
    private $Equipo_Tecnico_Movilizado_Red;
    private $Equipo_Tecnico_Movilizado_Diris;
    private $Equipo_Tecnico_Movilizado_Ipress;
    private $Equipo_Tecnico_Movilizado_Digerd;
    private $Equipo_Tecnico_Movilizado_Minsa;
    private $Equipo_Tecnico_Movilizado_Otros;
    private $Evento_Acciones_Personal_Emt_i;
    private $Evento_Acciones_Personal_Emt_ii;
    private $Evento_Acciones_Personal_Emt_iii;
    private $Evento_Acciones_Mochilas_Emergencia;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setEvento_Registro_Numero($data)
    {
        $this->Evento_Registro_Numero = $this->db->escape_str($data);
    }
    public function setEvento_Acciones_Fecha($data)
    {
        $this->Evento_Acciones_Fecha = $this->db->escape_str($data);
    }
    public function setTipo_Accion_Codigo($data)
    {
        $this->Tipo_Accion_Codigo = $this->db->escape_str($data);
    }
    public function setTipo_Accion_Entidad_Codigo($data)
    {
        $this->Tipo_Accion_Entidad_Codigo = $this->db->escape_str($data);
    }
    public function setEvento_Acciones_Descripcion($data)
    {
        $this->Evento_Acciones_Descripcion = $this->db->escape_str($data);
    }
    public function setUsuario($data)
    {
        $this->usuario = $this->db->escape_str($data);
    }
    public function setEvento_Acciones_Region($data){$this->Evento_Acciones_Region = $this->db->escape_str($data);}
    public function setEvento_Acciones_Minsa($data){$this->Evento_Acciones_Minsa = $this->db->escape_str($data);}
    public function setEvento_Acciones_Emt_i($data){$this->Evento_Acciones_Emt_i = $this->db->escape_str($data);}
    public function setEvento_Acciones_Emt_ii($data){$this->Evento_Acciones_Emt_ii = $this->db->escape_str($data);}
    public function setEvento_Acciones_Emt_iii($data){$this->Evento_Acciones_Emt_iii = $this->db->escape_str($data);}
    public function setEvento_Acciones_Celula_Especializada($data){$this->Evento_Acciones_Celula_Especializada = $this->db->escape_str($data);}
    public function setEvento_Acciones_Minsa_Samu($data){$this->Evento_Acciones_Minsa_Samu = $this->db->escape_str($data);}
    public function setEvento_Acciones_Salud_Minsa($data){$this->Evento_Acciones_Salud_Minsa = $this->db->escape_str($data);}
    public function setEvento_Acciones_Essalud($data){$this->Evento_Acciones_Essalud = $this->db->escape_str($data);}
    public function setEvento_Acciones_Municipalidades_Gores($data){$this->Evento_Acciones_Municipalidades_Gores = $this->db->escape_str($data);}
    public function setEvento_Acciones_Voluntarios($data){$this->Evento_Acciones_Voluntarios = $this->db->escape_str($data);}
    public function setEvento_Ambulancias_Minsa_Samu($data){$this->Evento_Ambulancias_Minsa_Samu = $this->db->escape_str($data);}
    public function setEvento_Ambulancias_Minsa($data){$this->Evento_Ambulancias_Minsa = $this->db->escape_str($data);}
    public function setEvento_Ambulancias_Essalud($data){$this->Evento_Ambulancias_Essalud = $this->db->escape_str($data);}
    public function setEvento_Ambulancias_Bomberos($data){$this->Evento_Ambulancias_Bomberos = $this->db->escape_str($data);}
    public function setEvento_Ambulancias_Municipalidades_Gores($data){$this->Evento_Ambulancias_Municipalidades_Gores = $this->db->escape_str($data);}
    public function setEvento_Ambulancias_PNP_FFAA($data){$this->Evento_Ambulancias_PNP_FFAA = $this->db->escape_str($data);}
    public function setEvento_Ambulancianas_Privadas($data){$this->Evento_Ambulancianas_Privadas = $this->db->escape_str($data);}
    public function setEvento_Maletin_Emergencias_Desastres($data){$this->Evento_Maletin_Emergencias_Desastres = $this->db->escape_str($data);}
    public function setEvento_Kit_Medicamentos_Insumos($data){$this->Evento_Kit_Medicamentos_Insumos = $this->db->escape_str($data);}
    public function setEvento_Acciones_Equipo_Biomedicos($data){$this->Evento_Acciones_Equipo_Biomedicos = $this->db->escape_str($data);}
    public function setEvento_Acciones_Puesto_Comando($data){$this->Evento_Acciones_Puesto_Comando = $this->db->escape_str($data);}
    public function setEvento_Acciones_Ac_Victimas($data){$this->Evento_Acciones_Ac_Victimas = $this->db->escape_str($data);}
    public function setEvento_Acciones_Oferta_Movil_i($data){$this->Evento_Acciones_Oferta_Movil_i = $this->db->escape_str($data);}
    public function setEvento_Acciones_Oferta_Movil_ii($data){$this->Evento_Acciones_Oferta_Movil_ii = $this->db->escape_str($data);}
    public function setEvento_Acciones_Oferta_Movil_iii($data){$this->Evento_Acciones_Oferta_Movil_iii = $this->db->escape_str($data);}
    public function setEvento_Acciones_Hospital_Modular($data){$this->Evento_Acciones_Hospital_Modular = $this->db->escape_str($data);}
    public function setEvento_Banio_Quimico_Portatil($data){$this->Evento_Banio_Quimico_Portatil = $this->db->escape_str($data);}
    public function setEvento_Rescatistas($data){$this->Evento_Rescatistas = $this->db->escape_str($data);}
    public function setEvento_Medicos_Tacticos($data){$this->Evento_Medicos_Tacticos = $this->db->escape_str($data);}
    public function setEvento_Acciones_PNP_FFAA($data){$this->Evento_Acciones_PNP_FFAA = $this->db->escape_str($data);}
    public function setEquipo_Tecnico_Movilizado_Diresa($data) { $this->Equipo_Tecnico_Movilizado_Diresa = $this->db->escape_str($data); }
    public function setEquipo_Tecnico_Movilizado_Red($data) { $this->Equipo_Tecnico_Movilizado_Red = $this->db->escape_str($data); }
    public function setEquipo_Tecnico_Movilizado_Diris($data) { $this->Equipo_Tecnico_Movilizado_Diris = $this->db->escape_str($data); }
    public function setEquipo_Tecnico_Movilizado_Ipress($data) { $this->Equipo_Tecnico_Movilizado_Ipress = $this->db->escape_str($data); }
    public function setEquipo_Tecnico_Movilizado_Digerd($data) { $this->Equipo_Tecnico_Movilizado_Digerd = $this->db->escape_str($data); }
    public function setEquipo_Tecnico_Movilizado_Minsa($data) { $this->Equipo_Tecnico_Movilizado_Minsa = $this->db->escape_str($data); }
    public function setEquipo_Tecnico_Movilizado_Otros($data) { $this->Equipo_Tecnico_Movilizado_Otros = $this->db->escape_str($data); }
    public function setEvento_Acciones_Personal_Emt_i($data) { $this->Evento_Acciones_Personal_Emt_i = $this->db->escape_str($data); }
    public function setEvento_Acciones_Personal_Emt_ii($data) { $this->Evento_Acciones_Personal_Emt_ii = $this->db->escape_str($data); }
    public function setEvento_Acciones_Personal_Emt_iii($data) { $this->Evento_Acciones_Personal_Emt_iii = $this->db->escape_str($data); }
    public function setEvento_Acciones_Mochilas_Emergencia($data) { $this->Evento_Acciones_Mochilas_Emergencia = $this->db->escape_str($data); }
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar()
    {
        $data = array(
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Evento_Acciones_Fecha" => $this->Evento_Acciones_Fecha,
            "Tipo_Accion_Codigo" => $this->Tipo_Accion_Codigo,
            "Tipo_Accion_Entidad_Codigo" => $this->Tipo_Accion_Entidad_Codigo,
            "Evento_Acciones_Descripcion" => $this->Evento_Acciones_Descripcion,
            "Evento_Acciones_Region" => $this->Evento_Acciones_Region,
            "Evento_Acciones_Minsa" => $this->Evento_Acciones_Minsa,
            "Evento_Acciones_Emt_i" => $this->Evento_Acciones_Emt_i,
            "Evento_Acciones_Emt_ii" => $this->Evento_Acciones_Emt_ii,
            "Evento_Acciones_Emt_iii" => $this->Evento_Acciones_Emt_iii,
            "Evento_Acciones_Celula_Especializada" => $this->Evento_Acciones_Celula_Especializada,
            "Evento_Acciones_Minsa_Samu" => $this->Evento_Acciones_Minsa_Samu,
            "Evento_Acciones_Salud_Minsa" => $this->Evento_Acciones_Salud_Minsa,
            "Evento_Acciones_Essalud" => $this->Evento_Acciones_Essalud,
            "Evento_Acciones_Municipalidades_Gores" => $this->Evento_Acciones_Municipalidades_Gores,
            "Evento_Acciones_Voluntarios" => $this->Evento_Acciones_Voluntarios,
            "Evento_Ambulancias_Minsa_Samu" => $this->Evento_Ambulancias_Minsa_Samu,
            "Evento_Ambulancias_Minsa" => $this->Evento_Ambulancias_Minsa,
            "Evento_Ambulancias_Essalud" => $this->Evento_Ambulancias_Essalud,
            "Evento_Ambulancias_Bomberos" => $this->Evento_Ambulancias_Bomberos,
            "Evento_Ambulancias_Municipalidades_Gores" => $this->Evento_Ambulancias_Municipalidades_Gores,
            "Evento_Ambulancias_PNP_FFAA" => $this->Evento_Ambulancias_PNP_FFAA,
            "Evento_Ambulancianas_Privadas" => $this->Evento_Ambulancianas_Privadas,
            "Evento_Maletin_Emergencias_Desastres" => $this->Evento_Maletin_Emergencias_Desastres,
            "Evento_Kit_Medicamentos_Insumos" => $this->Evento_Kit_Medicamentos_Insumos,
            "Evento_Acciones_Equipo_Biomedicos" => $this->Evento_Acciones_Equipo_Biomedicos,
            "Evento_Acciones_Puesto_Comando" => $this->Evento_Acciones_Puesto_Comando,
            "Evento_Acciones_Ac_Victimas" => $this->Evento_Acciones_Ac_Victimas,
            "Evento_Acciones_Oferta_Movil_i" => $this->Evento_Acciones_Oferta_Movil_i,
            "Evento_Acciones_Oferta_Movil_ii" => $this->Evento_Acciones_Oferta_Movil_ii,
            "Evento_Acciones_Oferta_Movil_iii" => $this->Evento_Acciones_Oferta_Movil_iii,
            "Evento_Acciones_Hospital_Modular" => $this->Evento_Acciones_Hospital_Modular,
            "Evento_Banio_Quimico_Portatil" => $this->Evento_Banio_Quimico_Portatil,
            "Codigo_Usuario_Registro" => $this->session->userdata("idusuario"),
            "Evento_Rescatistas" => $this->Evento_Rescatistas,
            "Evento_Medicos_Tacticos" => $this->Evento_Medicos_Tacticos,
            "Evento_Acciones_PNP_FFAA" => $this->Evento_Acciones_PNP_FFAA,
            "Equipo_Tecnico_Movilizado_Diresa" => $this->Equipo_Tecnico_Movilizado_Diresa,
            "Equipo_Tecnico_Movilizado_Red" => $this->Equipo_Tecnico_Movilizado_Red,
            "Equipo_Tecnico_Movilizado_Diris" => $this->Equipo_Tecnico_Movilizado_Diris,
            "Equipo_Tecnico_Movilizado_Ipress" => $this->Equipo_Tecnico_Movilizado_Ipress,
            "Equipo_Tecnico_Movilizado_Digerd" => $this->Equipo_Tecnico_Movilizado_Digerd,
            "Equipo_Tecnico_Movilizado_Minsa" => $this->Equipo_Tecnico_Movilizado_Minsa,
            "Equipo_Tecnico_Movilizado_Otros" => $this->Equipo_Tecnico_Movilizado_Otros,
            "Evento_Acciones_Personal_Emt_i" => $this->Evento_Acciones_Personal_Emt_i,
            "Evento_Acciones_Personal_Emt_ii" => $this->Evento_Acciones_Personal_Emt_ii,
            "Evento_Acciones_Personal_Emt_iii" => $this->Evento_Acciones_Personal_Emt_iii,
            "Evento_Acciones_Mochilas_Emergencia" => $this->Evento_Acciones_Mochilas_Emergencia
        );
        if ($this->db->insert('evento_acciones', $data))
            return true;
        else
            return false;
    }
    public function registrarApp()
    {
        $data = array(
            "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
            "Evento_Acciones_Fecha" => $this->Evento_Acciones_Fecha,
            "Tipo_Accion_Codigo" => $this->Tipo_Accion_Codigo,
            "Tipo_Accion_Entidad_Codigo" => $this->Tipo_Accion_Entidad_Codigo,
            "Evento_Acciones_Descripcion" => $this->Evento_Acciones_Descripcion,
            "Evento_Acciones_Region" => $this->Evento_Acciones_Region,
            "Evento_Acciones_Minsa" => $this->Evento_Acciones_Minsa,
            "Evento_Acciones_Emt_i" => $this->Evento_Acciones_Emt_i,
            "Evento_Acciones_Emt_ii" => $this->Evento_Acciones_Emt_ii,
            "Evento_Acciones_Emt_iii" => $this->Evento_Acciones_Emt_iii,
            "Evento_Acciones_Celula_Especializada" => $this->Evento_Acciones_Celula_Especializada,
            "Evento_Acciones_Minsa_Samu" => $this->Evento_Acciones_Minsa_Samu,
            "Evento_Acciones_Salud_Minsa" => $this->Evento_Acciones_Salud_Minsa,
            "Evento_Acciones_Essalud" => $this->Evento_Acciones_Essalud,
            "Evento_Acciones_Municipalidades_Gores" => $this->Evento_Acciones_Municipalidades_Gores,
            "Evento_Acciones_Voluntarios" => $this->Evento_Acciones_Voluntarios,
            "Evento_Ambulancias_Minsa_Samu" => $this->Evento_Ambulancias_Minsa_Samu,
            "Evento_Ambulancias_Minsa" => $this->Evento_Ambulancias_Minsa,
            "Evento_Ambulancias_Essalud" => $this->Evento_Ambulancias_Essalud,
            "Evento_Ambulancias_Bomberos" => $this->Evento_Ambulancias_Bomberos,
            "Evento_Ambulancias_Municipalidades_Gores" => $this->Evento_Ambulancias_Municipalidades_Gores,
            "Evento_Ambulancias_PNP_FFAA" => $this->Evento_Ambulancias_PNP_FFAA,
            "Evento_Ambulancianas_Privadas" => $this->Evento_Ambulancianas_Privadas,
            "Evento_Maletin_Emergencias_Desastres" => $this->Evento_Maletin_Emergencias_Desastres,
            "Evento_Kit_Medicamentos_Insumos" => $this->Evento_Kit_Medicamentos_Insumos,
            "Evento_Acciones_Equipo_Biomedicos" => $this->Evento_Acciones_Equipo_Biomedicos,
            "Evento_Acciones_Puesto_Comando" => $this->Evento_Acciones_Puesto_Comando,
            "Evento_Acciones_Ac_Victimas" => $this->Evento_Acciones_Ac_Victimas,
            "Evento_Acciones_Oferta_Movil_i" => $this->Evento_Acciones_Oferta_Movil_i,
            "Evento_Acciones_Oferta_Movil_ii" => $this->Evento_Acciones_Oferta_Movil_ii,
            "Evento_Acciones_Oferta_Movil_iii" => $this->Evento_Acciones_Oferta_Movil_iii,
            "Evento_Acciones_Hospital_Modular" => $this->Evento_Acciones_Hospital_Modular,
            "Evento_Banio_Quimico_Portatil" => $this->Evento_Banio_Quimico_Portatil,
            "Codigo_Usuario_Registro" => $this->usuario,
            "Evento_Rescatistas" => $this->Evento_Rescatistas,
            "Evento_Medicos_Tacticos" => $this->Evento_Medicos_Tacticos,
            "Evento_Acciones_PNP_FFAA" => $this->Evento_Acciones_PNP_FFAA,
            "Evento_Acciones_Personal_Emt_i" => $this->Evento_Acciones_Personal_Emt_i,
            "Evento_Acciones_Personal_Emt_ii" => $this->Evento_Acciones_Personal_Emt_ii,
            "Evento_Acciones_Personal_Emt_iii" => $this->Evento_Acciones_Personal_Emt_iii,
            "Evento_Acciones_Mochilas_Emergencia" => $this->Evento_Acciones_Mochilas_Emergencia
        );
        if ($this->db->insert('evento_acciones', $data))
            return true;
        else
            return false;
    }
    public function actualizar()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("Evento_Acciones_Fecha", $this->Evento_Acciones_Fecha, TRUE);
        $this->db->set("Tipo_Accion_Codigo", $this->Tipo_Accion_Codigo, TRUE);
        $this->db->set("Tipo_Accion_Entidad_Codigo", $this->Tipo_Accion_Entidad_Codigo, TRUE);
        $this->db->set("Evento_Acciones_Region", $this->Evento_Acciones_Region, TRUE);
        $this->db->set("Evento_Acciones_Minsa", $this->Evento_Acciones_Minsa, TRUE);
        $this->db->set("Evento_Acciones_Emt_i", $this->Evento_Acciones_Emt_i, TRUE);
        $this->db->set("Evento_Acciones_Emt_ii", $this->Evento_Acciones_Emt_ii, TRUE);
        $this->db->set("Evento_Acciones_Emt_iii", $this->Evento_Acciones_Emt_iii, TRUE);
        $this->db->set("Evento_Acciones_Celula_Especializada", $this->Evento_Acciones_Celula_Especializada, TRUE);
        $this->db->set("Evento_Acciones_Minsa_Samu", $this->Evento_Acciones_Minsa_Samu, TRUE);
        $this->db->set("Evento_Acciones_Salud_Minsa", $this->Evento_Acciones_Salud_Minsa, TRUE);
        $this->db->set("Evento_Acciones_Essalud", $this->Evento_Acciones_Essalud, TRUE);
        $this->db->set("Evento_Acciones_Municipalidades_Gores", $this->Evento_Acciones_Municipalidades_Gores, TRUE);
        $this->db->set("Evento_Acciones_Voluntarios", $this->Evento_Acciones_Voluntarios, TRUE);
        $this->db->set("Evento_Ambulancias_Minsa_Samu", $this->Evento_Ambulancias_Minsa_Samu, TRUE);
        $this->db->set("Evento_Ambulancias_Minsa", $this->Evento_Ambulancias_Minsa, TRUE);
        $this->db->set("Evento_Ambulancias_Essalud", $this->Evento_Ambulancias_Essalud, TRUE);
        $this->db->set("Evento_Ambulancias_Bomberos", $this->Evento_Ambulancias_Bomberos, TRUE);
        $this->db->set("Evento_Ambulancias_Municipalidades_Gores", $this->Evento_Ambulancias_Municipalidades_Gores, TRUE);
        $this->db->set("Evento_Ambulancias_PNP_FFAA", $this->Evento_Ambulancias_PNP_FFAA, TRUE);
        $this->db->set("Evento_Ambulancianas_Privadas", $this->Evento_Ambulancianas_Privadas, TRUE);
        $this->db->set("Evento_Maletin_Emergencias_Desastres", $this->Evento_Maletin_Emergencias_Desastres, TRUE);
        $this->db->set("Evento_Kit_Medicamentos_Insumos", $this->Evento_Kit_Medicamentos_Insumos, TRUE);
        $this->db->set("Evento_Acciones_Equipo_Biomedicos", $this->Evento_Acciones_Equipo_Biomedicos, TRUE);
        $this->db->set("Evento_Acciones_Puesto_Comando", $this->Evento_Acciones_Puesto_Comando, TRUE);
        $this->db->set("Evento_Acciones_Ac_Victimas", $this->Evento_Acciones_Ac_Victimas, TRUE);
        $this->db->set("Evento_Acciones_Oferta_Movil_i", $this->Evento_Acciones_Oferta_Movil_i, TRUE);
        $this->db->set("Evento_Acciones_Oferta_Movil_ii", $this->Evento_Acciones_Oferta_Movil_ii, TRUE);
        $this->db->set("Evento_Acciones_Oferta_Movil_iii", $this->Evento_Acciones_Oferta_Movil_iii, TRUE);
        $this->db->set("Evento_Acciones_Hospital_Modular", $this->Evento_Acciones_Hospital_Modular, TRUE);
        $this->db->set("Evento_Banio_Quimico_Portatil", $this->Evento_Banio_Quimico_Portatil, TRUE);
        $this->db->set("Evento_Acciones_Descripcion", $this->Evento_Acciones_Descripcion, TRUE);
        $this->db->set("Codigo_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Equipo_Tecnico_Movilizado_Diresa", $this->Equipo_Tecnico_Movilizado_Diresa, TRUE);
        $this->db->set("Equipo_Tecnico_Movilizado_Red", $this->Equipo_Tecnico_Movilizado_Red, TRUE);
        $this->db->set("Equipo_Tecnico_Movilizado_Diris", $this->Equipo_Tecnico_Movilizado_Diris, TRUE);
        $this->db->set("Equipo_Tecnico_Movilizado_Ipress", $this->Equipo_Tecnico_Movilizado_Ipress, TRUE);
        $this->db->set("Equipo_Tecnico_Movilizado_Digerd", $this->Equipo_Tecnico_Movilizado_Digerd, TRUE);
        $this->db->set("Equipo_Tecnico_Movilizado_Minsa", $this->Equipo_Tecnico_Movilizado_Minsa, TRUE);
        $this->db->set("Equipo_Tecnico_Movilizado_Otros", $this->Equipo_Tecnico_Movilizado_Otros, TRUE);
        $this->db->set("Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("Evento_Acciones_Numero", $this->id);
        $this->db->set("Evento_Rescatistas",$this->Evento_Rescatistas, TRUE);
        $this->db->set("Evento_Medicos_Tacticos",$this->Evento_Medicos_Tacticos, TRUE);
        $this->db->set("Evento_Acciones_PNP_FFAA",$this->Evento_Acciones_PNP_FFAA, TRUE);
        $this->db->set("Evento_Acciones_Personal_Emt_i", $this->Evento_Acciones_Personal_Emt_i, TRUE);
        $this->db->set("Evento_Acciones_Personal_Emt_ii", $this->Evento_Acciones_Personal_Emt_ii, TRUE);
        $this->db->set("Evento_Acciones_Personal_Emt_iii", $this->Evento_Acciones_Personal_Emt_iii, TRUE);
        $this->db->set("Evento_Acciones_Mochilas_Emergencia", $this->Evento_Acciones_Mochilas_Emergencia, TRUE);
        $error = array();
        if ($this->db->update('evento_acciones'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function lista()
    {
        $this->db->select("Tipo_Accion_Descripcion,Tipo_Accion_Entidad_Nombre,ea.*,DATE_FORMAT(Evento_Acciones_Fecha,'%d/%m/%Y %H:%i') as Evento_Acciones_Fecha");
        $this->db->select("(Evento_Acciones_Region+Evento_Acciones_Minsa+Evento_Rescatistas+Evento_Medicos_Tacticos) brigadistas");
        $this->db->select("(Evento_Acciones_Emt_i+Evento_Acciones_Emt_ii+Evento_Acciones_Emt_iii+Evento_Acciones_Celula_Especializada) EMT");
        $this->db->select("(Evento_Acciones_Minsa_Samu+Evento_Acciones_Salud_Minsa+Evento_Acciones_Essalud+Evento_Acciones_Municipalidades_Gores+Evento_Acciones_Voluntarios+Evento_Acciones_PNP_FFAA+Evento_Acciones_Personal_Emt_i+Evento_Acciones_Personal_Emt_ii+Evento_Acciones_Personal_Emt_iii) PersonalSalud");
        $this->db->select("(Evento_Ambulancias_Minsa_Samu+Evento_Ambulancias_Minsa+Evento_Ambulancias_Essalud+Evento_Ambulancias_Bomberos+Evento_Ambulancias_Municipalidades_Gores+Evento_Ambulancias_PNP_FFAA+Evento_Ambulancianas_Privadas) ambulancias");
        $this->db->select("(Evento_Maletin_Emergencias_Desastres+Evento_Kit_Medicamentos_Insumos+Evento_Acciones_Equipo_Biomedicos+Evento_Acciones_Puesto_Comando+Evento_Acciones_Ac_Victimas+Evento_Acciones_Oferta_Movil_i+Evento_Acciones_Oferta_Movil_ii+Evento_Acciones_Oferta_Movil_iii+Evento_Acciones_Hospital_Modular+Evento_Banio_Quimico_Portatil+Evento_Acciones_Mochilas_Emergencia) medicamentos");
        $this->db->select("(Equipo_Tecnico_Movilizado_Diresa+Equipo_Tecnico_Movilizado_Red+Equipo_Tecnico_Movilizado_Diris+Equipo_Tecnico_Movilizado_Ipress+Equipo_Tecnico_Movilizado_Digerd+Equipo_Tecnico_Movilizado_Minsa+Equipo_Tecnico_Movilizado_Otros) Equipo_Tecnico");
        $this->db->from("evento_acciones ea");
        $this->db->join("tipo_accion ta", "ta.Tipo_Accion_Codigo=ea.Tipo_Accion_Codigo");
        $this->db->join("tipo_accion_entidad tae", "tae.Tipo_Accion_Codigo=ta.Tipo_Accion_Codigo AND ea.Tipo_Accion_Entidad_Codigo=tae.Tipo_Accion_Entidad_Codigo");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        return $this->db->get();
    }
    public function eliminar()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("Evento_Acciones_Numero", $this->id);
        $error = array();
        if ($this->db->delete('evento_acciones'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function accion()
    {
        $this->db->select("Tipo_Accion_Descripcion,Tipo_Accion_Entidad_Nombre,DATE_FORMAT(Evento_Acciones_Fecha,'%d/%m/%Y %H:%i') as Evento_Acciones_Fecha");
        $this->db->select("(Evento_Acciones_Region+Evento_Acciones_Minsa+Evento_Rescatistas+Evento_Medicos_Tacticos) brigadistas");
        $this->db->select("(Evento_Acciones_Emt_i+Evento_Acciones_Emt_ii+Evento_Acciones_Emt_iii+Evento_Acciones_Celula_Especializada) EMT");
        $this->db->select("(Evento_Acciones_Minsa_Samu+Evento_Acciones_Salud_Minsa+Evento_Acciones_Essalud+Evento_Acciones_Municipalidades_Gores+Evento_Acciones_Voluntarios+Evento_Acciones_PNP_FFAA) PersonalSalud");
        $this->db->select("(Evento_Ambulancias_Minsa_Samu+Evento_Ambulancias_Minsa+Evento_Ambulancias_Essalud+Evento_Ambulancias_Bomberos+Evento_Ambulancias_Municipalidades_Gores+Evento_Ambulancias_PNP_FFAA+Evento_Ambulancianas_Privadas) ambulancias");
        $this->db->select("(Evento_Maletin_Emergencias_Desastres+Evento_Kit_Medicamentos_Insumos+Evento_Acciones_Equipo_Biomedicos+Evento_Acciones_Puesto_Comando+Evento_Acciones_Ac_Victimas+Evento_Acciones_Oferta_Movil_i+Evento_Acciones_Oferta_Movil_ii+Evento_Acciones_Oferta_Movil_iii+Evento_Acciones_Hospital_Modular+Evento_Banio_Quimico_Portatil) medicamentos");
        $this->db->select("(Equipo_Tecnico_Movilizado_Diresa+Equipo_Tecnico_Movilizado_Red+Equipo_Tecnico_Movilizado_Diris+Equipo_Tecnico_Movilizado_Ipress+Equipo_Tecnico_Movilizado_Digerd+Equipo_Tecnico_Movilizado_Minsa+Equipo_Tecnico_Movilizado_Otros) equipotecnicogeneral");
        $this->db->from("evento_acciones ea");
        $this->db->join("tipo_accion ta", "ta.Tipo_Accion_Codigo=ea.Tipo_Accion_Codigo");
        $this->db->join("tipo_accion_entidad tae", "tae.Tipo_Accion_Codigo=ta.Tipo_Accion_Codigo AND ea.Tipo_Accion_Entidad_Codigo=tae.Tipo_Accion_Entidad_Codigo");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Acciones_Numero", "ASC");
        return $this->db->get();
    }
    public function totalesInforme(){
        $this->db->select("SUM(Evento_Acciones_Region+Evento_Acciones_Minsa+Evento_Rescatistas+Evento_Medicos_Tacticos) brigadistas");
        $this->db->select("SUM(Evento_Acciones_Emt_i+Evento_Acciones_Emt_ii+Evento_Acciones_Emt_iii+Evento_Acciones_Celula_Especializada) emt");
        $this->db->select("SUM(Evento_Acciones_Minsa_Samu+Evento_Acciones_Salud_Minsa+Evento_Acciones_Essalud+Evento_Acciones_Municipalidades_Gores+Evento_Acciones_Voluntarios+Evento_Acciones_PNP_FFAA) personalSalud");
        $this->db->select("SUM(Evento_Ambulancias_Minsa_Samu+Evento_Ambulancias_Minsa+Evento_Ambulancias_Essalud+Evento_Ambulancias_Bomberos+Evento_Ambulancias_Municipalidades_Gores+Evento_Ambulancias_PNP_FFAA+Evento_Ambulancianas_Privadas) ambulancias");
        $this->db->select("SUM(Evento_Maletin_Emergencias_Desastres+Evento_Kit_Medicamentos_Insumos+Evento_Acciones_Equipo_Biomedicos+Evento_Acciones_Puesto_Comando+Evento_Acciones_Ac_Victimas+Evento_Acciones_Oferta_Movil_i+Evento_Acciones_Oferta_Movil_ii+Evento_Acciones_Oferta_Movil_iii+Evento_Acciones_Hospital_Modular+Evento_Banio_Quimico_Portatil) medicamentosInsumos");
        $this->db->select("SUM(Equipo_Tecnico_Movilizado_Diresa+Equipo_Tecnico_Movilizado_Red+Equipo_Tecnico_Movilizado_Diris+Equipo_Tecnico_Movilizado_Ipress+Equipo_Tecnico_Movilizado_Digerd+Equipo_Tecnico_Movilizado_Minsa+Equipo_Tecnico_Movilizado_Otros) equipotecnicogeneral");
        $this->db->select("SUM(Evento_Acciones_Region) brigadistas_regionales");
        $this->db->select("SUM(Evento_Acciones_Minsa) brigadistas_minsa");
        $this->db->select("SUM(Evento_Rescatistas) rescatistas");
        $this->db->select("SUM(Evento_Medicos_Tacticos) medicos_tacticos");
        $this->db->select("SUM(Evento_Acciones_Emt_i) emt_i");
        $this->db->select("SUM(Evento_Acciones_Emt_ii) emt_ii");
        $this->db->select("SUM(Evento_Acciones_Emt_iii) emt_iii");
        $this->db->select("SUM(Evento_Acciones_Celula_Especializada) celula_especializada");
        $this->db->select("SUM(Evento_Acciones_Minsa_Samu) Personal_Minsa_Samu");
        $this->db->select("SUM(Evento_Acciones_Salud_Minsa) Personal_Salud_Minsa");
        $this->db->select("SUM(Evento_Acciones_Essalud) Personal_Essalud");
        $this->db->select("SUM(Evento_Acciones_Municipalidades_Gores) Personal_Municipalidades_Gores");
        $this->db->select("SUM(Evento_Acciones_Voluntarios) Personal_Voluntarios");
        $this->db->select("SUM(Evento_Acciones_PNP_FFAA) Personal_PNP_FFAA");
        $this->db->select("SUM(Evento_Ambulancias_Minsa_Samu) Ambulancias_Minsa_Samu");
        $this->db->select("SUM(Evento_Ambulancias_Minsa) Ambulancias_Minsa");
        $this->db->select("SUM(Evento_Ambulancias_Essalud) Ambulancias_Essalud");
        $this->db->select("SUM(Evento_Ambulancias_Bomberos) Ambulancias_Bomberos");
        $this->db->select("SUM(Evento_Ambulancias_Municipalidades_Gores) Ambulancias_Municipalidades_Gores");
        $this->db->select("SUM(Evento_Ambulancias_PNP_FFAA) Ambulancias_PNP_FFAA");
        $this->db->select("SUM(Evento_Ambulancianas_Privadas) Ambulancianas_Privadas");
        $this->db->select("SUM(Evento_Maletin_Emergencias_Desastres) MI_Emergencias_Desastres");
        $this->db->select("SUM(Evento_Kit_Medicamentos_Insumos) MI_Kit_Medicamentos_Insumos");
        $this->db->select("SUM(Evento_Acciones_Equipo_Biomedicos) MI_Equipo_Biomedicos");
        $this->db->select("SUM(Evento_Acciones_Puesto_Comando) MI_Puesto_Comando");
        $this->db->select("SUM(Evento_Acciones_Ac_Victimas) MI_Ac_Victimas");
        $this->db->select("SUM(Evento_Acciones_Oferta_Movil_i) MI_Oferta_Movil_i");
        $this->db->select("SUM(Evento_Acciones_Oferta_Movil_ii) MI_Oferta_Movil_ii");
        $this->db->select("SUM(Evento_Acciones_Oferta_Movil_iii) MI_Oferta_Movil_iii");
        $this->db->select("SUM(Evento_Acciones_Hospital_Modular) MI_Hospital_Modular");
        $this->db->select("SUM(Evento_Banio_Quimico_Portatil) MI_Banio_Quimico_Portatil");
        $this->db->select("SUM(Equipo_Tecnico_Movilizado_Diresa) Total_Equipo_Tecnico_Movilizado_Diresa");
        $this->db->select("SUM(Equipo_Tecnico_Movilizado_Red) Total_Equipo_Tecnico_Movilizado_Red");
        $this->db->select("SUM(Equipo_Tecnico_Movilizado_Diris) Total_Equipo_Tecnico_Movilizado_Diris");
        $this->db->select("SUM(Equipo_Tecnico_Movilizado_Ipress) Total_Equipo_Tecnico_Movilizado_Ipress");
        $this->db->select("SUM(Equipo_Tecnico_Movilizado_Digerd) Total_Equipo_Tecnico_Movilizado_Digerd");
        $this->db->select("SUM(Equipo_Tecnico_Movilizado_Minsa) Total_Equipo_Tecnico_Movilizado_Minsa");
        $this->db->select("SUM(Equipo_Tecnico_Movilizado_Otros) Total_Equipo_Tecnico_Movilizado_Otros");
        $this->db->from("evento_acciones");
        $this->db->where_in("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        return $this->db->get();
    }
    public function accionesInforme(){
        $this->db->select("DATE_FORMAT(ec.Evento_Acciones_Fecha,'%d') DIA,DATE_FORMAT(ec.Evento_Acciones_Fecha,'%c') MES, DATE_FORMAT(ec.Evento_Acciones_Fecha,'%Y') as ANIO,DATE_FORMAT(ec.Evento_Acciones_Fecha,'%H:%i') as HORA, ec.Evento_Acciones_Descripcion descripcion, ta.Tipo_Accion_Descripcion TIPOACCION, tae.Tipo_Accion_Entidad_Nombre ENTIDAD");
        $this->db->from("evento_acciones ec, tipo_accion ta, tipo_accion_entidad tae");
        $this->db->where("ec.Tipo_Accion_Codigo = ta.Tipo_Accion_Codigo");
        $this->db->where("ec.Tipo_Accion_Entidad_Codigo = tae.Tipo_Accion_Entidad_Codigo");
        $this->db->where("ta.Tipo_Accion_Codigo = tae.Tipo_Accion_Codigo");
        $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Acciones_Fecha","DESC");
        return $this->db->get();
    }
    public function mapaAcciones()
    {
        $this->db->select("ea.Evento_Registro_Numero,er.Evento_Coordenadas,Evento_Nivel_Codigo,er.Evento_Tipo_Codigo");
        $this->db->select("SUM(Evento_Acciones_Region+Evento_Acciones_Minsa+Evento_Rescatistas+Evento_Medicos_Tacticos) brigadistas");        
        $this->db->select("SUM(Evento_Acciones_Emt_i+Evento_Acciones_Emt_ii+Evento_Acciones_Emt_iii+Evento_Acciones_Celula_Especializada) EMT");        
        $this->db->select("SUM(Evento_Acciones_Minsa_Samu+Evento_Acciones_Salud_Minsa+Evento_Acciones_Essalud+Evento_Acciones_Municipalidades_Gores+Evento_Acciones_Voluntarios+Evento_Acciones_PNP_FFAA) PersonalSalud");        
        $this->db->select("SUM(Evento_Ambulancias_Minsa_Samu+Evento_Ambulancias_Minsa+Evento_Ambulancias_Essalud+Evento_Ambulancias_Bomberos+Evento_Ambulancias_Municipalidades_Gores+Evento_Ambulancias_PNP_FFAA+Evento_Ambulancianas_Privadas) ambulancias");
        $this->db->select("SUM(Evento_Maletin_Emergencias_Desastres+Evento_Kit_Medicamentos_Insumos+Evento_Acciones_Equipo_Biomedicos+Evento_Acciones_Puesto_Comando+Evento_Acciones_Ac_Victimas+Evento_Acciones_Oferta_Movil_i+Evento_Acciones_Oferta_Movil_ii+Evento_Acciones_Oferta_Movil_iii+Evento_Acciones_Hospital_Modular+Evento_Banio_Quimico_Portatil) medicamentos");
        $this->db->from("evento_acciones ea");
        $this->db->join("evento_registro er","ea.Evento_Registro_Numero=er.Evento_Registro_Numero");
        $this->db->group_by("ea.Evento_Registro_Numero");
        return $this->db->get();
    }
    public function mapaAccionesDetalle() {
        $estados = array("1","2");
        $this->db->select("Tipo_Accion_Descripcion,Tipo_Accion_Entidad_Nombre");
        $this->db->select("ea.Evento_Acciones_Numero,ea.Evento_Acciones_Descripcion,DATE_FORMAT(ea.Evento_Acciones_Fecha,'%d/%m/%Y %H:%i') Evento_Acciones_Fecha");
        $this->db->select("(ea.Evento_Acciones_Region+ea.Evento_Acciones_Minsa+Evento_Rescatistas+Evento_Medicos_Tacticos) brigadistas");
        $this->db->select("(ea.Evento_Acciones_Emt_i+ea.Evento_Acciones_Emt_ii+ea.Evento_Acciones_Emt_iii+ea.Evento_Acciones_Celula_Especializada) EMT");
        $this->db->select("(ea.Evento_Acciones_Minsa_Samu+ea.Evento_Acciones_Salud_Minsa+ea.Evento_Acciones_Essalud+ea.Evento_Acciones_Municipalidades_Gores+ea.Evento_Acciones_Voluntarios+Evento_Acciones_PNP_FFAA) PersonalSalud");
        $this->db->select("(ea.Evento_Ambulancias_Minsa_Samu+ea.Evento_Ambulancias_Minsa+ea.Evento_Ambulancias_Essalud+ea.Evento_Ambulancias_Bomberos+ea.Evento_Ambulancias_Municipalidades_Gores+ea.Evento_Ambulancias_PNP_FFAA+ea.Evento_Ambulancianas_Privadas) ambulancias");
        $this->db->select("(ea.Evento_Maletin_Emergencias_Desastres+ea.Evento_Kit_Medicamentos_Insumos+ea.Evento_Acciones_Equipo_Biomedicos+ea.Evento_Acciones_Puesto_Comando+ea.Evento_Acciones_Ac_Victimas+ea.Evento_Acciones_Oferta_Movil_i+ea.Evento_Acciones_Oferta_Movil_ii+ea.Evento_Acciones_Oferta_Movil_iii+ea.Evento_Acciones_Hospital_Modular+ea.Evento_Banio_Quimico_Portatil) medicamentos");
        $this->db->from("evento_acciones ea");
        $this->db->join("tipo_accion ta", "ta.Tipo_Accion_Codigo=ea.Tipo_Accion_Codigo");
        $this->db->join("tipo_accion_entidad tae", "tae.Tipo_Accion_Codigo=ta.Tipo_Accion_Codigo AND ea.Tipo_Accion_Entidad_Codigo=tae.Tipo_Accion_Entidad_Codigo");
        $this->db->join("evento_registro er","er.Evento_Registro_Numero=ea.Evento_Registro_Numero");
        $this->db->where("ea.Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->where_in("er.Evento_Estado_Codigo",$estados);
        return $this->db->get();
    }
    public function equiposTecnicosFecha() {
        $this->db->select("Equipo_Tecnico_Movilizado_Diresa,Equipo_Tecnico_Movilizado_Red,Equipo_Tecnico_Movilizado_Diris,Equipo_Tecnico_Movilizado_Ipress");
        $this->db->select("Equipo_Tecnico_Movilizado_Digerd,Equipo_Tecnico_Movilizado_Minsa,,Equipo_Tecnico_Movilizado_Otros,DATE_FORMAT(Evento_Acciones_Fecha,'%d/%m/%Y %H:%i') Fecha_Registro_F");
        $this->db->from("evento_acciones");
        $this->db->where_in("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->order_by("Evento_Acciones_Fecha","DESC");
        return $this->db->get();
    }    
    public function accionesPorTipoAccionEntidad() {
        $this->db->select("COUNT(1) total");
        $this->db->from("evento_acciones");
        $this->db->where("Tipo_Accion_Entidad_Codigo",$this->Tipo_Accion_Entidad_Codigo);
        $this->db->where("Tipo_Accion_Codigo",$this->Tipo_Accion_Codigo);   
        return $this->db->get();
    }
}