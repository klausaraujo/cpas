<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Brigadista_model extends CI_Model
{
    private $id;
    private $apellidos;
    private $nombres;
    private $Tipo_Documento_Codigo;
    private $Tipo_Documento_Codigo_C;
    private $documento_numero;
    private $genero;
    private $fecha_nacimiento;
    private $edad;
    private $estado_civil;
    private $pasaporte;
    private $caducidad_pasaporte;
    private $foto;
    private $domicilio;
    private $ubigeo_domicilio;
    private $telefono_01;
    private $telefono_02;
    private $telefono_03;
    private $email;
    private $Categoria;
    private $contacto_emergencia;
    private $telefono_emergencia_01;
    private $telefono_emergencia_02;
    private $telefono_emergencia_03;
    private $parentesco;
    private $apellidos_contacto;
    private $nombres_contacto;
    private $idioma_ingles;
    private $idioma_quechua;
    private $idioma_aimara;
    private $idioma_otros;
    private $alergias;
    private $intervenciones_quirurgica;
    private $antecedentes_medicos;
    private $talla;
    private $imc;
    private $peso;
    private $grupo_sanguineo;
    private $vacuna_tetano;
    private $vacuna_fiebre_amarilla;
    private $vacuna_hepatitis_b;
    private $vacuna_influenza;
    private $vacuna_sarampion;
    private $vacuna_papiloma;
    private $vacunas_otras;
    private $usuario_registro;
    private $fecha_registro;
    private $usuario_actualizacion;
    private $fecha_actualizacion;
    private $talla_casaca;
    private $talla_calzado;
    private $talla_polo;
    private $talla_pantalon;
    private $Activo;
    private $brigadistas_banco_id;
    private $ididioma;
    private $idprofesion;
    private $numero_cci;
    private $tipo_certificacion;
    private $fecha_reconocimiento;
    private $resolucion;
    private $fecha_inicio;
    private $fecha_vencimiento;
    private $archivo;
    private $brigadistas_cursos_id;
    private $entidad;
    private $fecha_fin;
    private $horas;
    private $Evento_Registro_Numero;
    private $calificacion;
    private $lider;
    private $fuerza_tarea;
    private $acciones_realizadas;
    private $DIRESA;
    private $Red;
    private $MicroRed;
    private $CodEESS;
    private $oficina;
    private $condicion_laboral;
    private $cargo;
    private $telefono_institucional;
    private $email_institucional;
    private $brigadistas_profesiones_id;
    private $brigadistas_especialidad_id;
    private $brigadistas_certificacion_id;
    private $brigadistas_evento_id;
    private $brigadistas_clusters_id;
    private $brigadistas_sedes_id;
    private $observacion;
    private $idinstitucion;
    private $codigo_institucion;
    private $codigo_region;
    private $codigo_disa;
    private $codigo_red;
    private $codigo_micro_red;
    private $codigo_renipress;
    private $codigo_condicion;
    private $institucion;
    private $fecha_emision;
    private $tipo_capacitacion;
    private $nombre;
    private $tipo_inmunizacion;
    private $numero_dosis;
    private $fecha_vacuna;
    private $alergias_alimentarias;
    private $alergias_farmacologicas;
    private $idrenarhed;
    private $foto_renarhed;
    private $nivel;
    private $lectura;
    private $escritura;
    private $colegiatura;
    private $rne;
    private $idcertificacion;
    private $fecha_vigencia;
    private $idcarreras;
    private $idespecialidad;
    private $archivo_titulo;
    private $archivo_especialidad;
    private $archivo_adjunto;
    private $tarjeta_vacunas;
    private $idcapacitacion;
    private $idinmunizacion;
    private $idcomision;
    private $regioncomision;
    private $tipocomision;	
    private $tipoEventocomision;
    private $eventocomision;
    private $eventoDetallecomision;
    private $numeroEventocomision;
    private $descripcioncomision;
    private $fechaIniciocomision;
    private $fechaFincomision;
    private $fichaTecnicaComision;
    private $aniocomision;
    private $mescomision;
    private $idrenarhedcomi;
    private $apellidoscomi;
    private $nombrescomi;
    private $nro_documentocomi;
    private $funcioncomi;
    public function setId($data){ $this->id = $this->db->escape_str($data); }
    public function setApellidos($data){ $this->apellidos = $this->db->escape_str($data); }
    public function setNombres($data){ $this->nombres = $this->db->escape_str($data); }
    public function setTipo_Documento_Codigo($data){ $this->Tipo_Documento_Codigo = $this->db->escape_str($data); }
    public function setTipo_Documento_Codigo_C($data){ $this->Tipo_Documento_Codigo_C = $this->db->escape_str($data); }
    public function setDocumento_numero($data){ $this->documento_numero = $this->db->escape_str($data); }
    public function setGenero($data){ $this->genero = $this->db->escape_str($data); }
    public function setFecha_nacimiento($data){ $this->fecha_nacimiento = $this->db->escape_str($data); }
    public function setEdad($data){ $this->edad = $this->db->escape_str($data); }
    public function setEstado_civil($data){ $this->estado_civil = $this->db->escape_str($data); }
    public function setPasaporte($data){ $this->pasaporte = $this->db->escape_str($data); }
    public function setCaducidad_pasaporte($data){ $this->caducidad_pasaporte = $this->db->escape_str($data); }
    public function setFoto($data){ $this->foto = $this->db->escape_str($data); }
    public function setDomicilio($data){ $this->domicilio = $this->db->escape_str($data); }
    public function setUbigeo_domicilio($data){ $this->ubigeo_domicilio = $this->db->escape_str($data); }
    public function setTelefono_01($data){ $this->telefono_01 = $this->db->escape_str($data); }
    public function setTelefono_02($data){ $this->telefono_02 = $this->db->escape_str($data); }
    public function setTelefono_03($data){ $this->telefono_03 = $this->db->escape_str($data); }
    public function setEmail($data){ $this->email = $this->db->escape_str($data); }
    public function setCategoria($data){ $this->Categoria = $this->db->escape_str($data); }
    public function setContacto_emergencia($data){ $this->contacto_emergencia = $this->db->escape_str($data); }
    public function setTelefono_emergencia_01($data){ $this->telefono_emergencia_01 = $this->db->escape_str($data); }
    public function setTelefono_emergencia_02($data){ $this->telefono_emergencia_02 = $this->db->escape_str($data); }
    public function setTelefono_emergencia_03($data){ $this->telefono_emergencia_03 = $this->db->escape_str($data); }
    public function setParentesco($data){ $this->parentesco = $this->db->escape_str($data); }
    public function setApellidos_contacto($data){ $this->apellidos_contacto = $this->db->escape_str($data); }
    public function setNombres_contacto($data){ $this->nombres_contacto = $this->db->escape_str($data); }
    public function setIdioma_ingles($data){ $this->idioma_ingles = $this->db->escape_str($data); }
    public function setIdioma_quechua($data){ $this->idioma_quechua = $this->db->escape_str($data); }
    public function setIdioma_aimara($data){ $this->idioma_aimara = $this->db->escape_str($data); }
    public function setIdioma_otros($data){ $this->idioma_otros = $this->db->escape_str($data); }
    public function setAlergias($data){ $this->alergias = $this->db->escape_str($data); }
    public function setIntervenciones_quirurgica($data){ $this->intervenciones_quirurgica = $this->db->escape_str($data); }
    public function setAntecedentes_medicos($data){ $this->antecedentes_medicos = $this->db->escape_str($data); }
    public function setTalla($data){ $this->talla = $this->db->escape_str($data); }
    public function setImc($data){ $this->imc = $this->db->escape_str($data); }
    public function setPeso($data){ $this->peso = $this->db->escape_str($data); }
    public function setVacuna_tetano($data){ $this->vacuna_tetano = $this->db->escape_str($data); }
    public function setVacuna_fiebre_amarilla($data){ $this->vacuna_fiebre_amarilla = $this->db->escape_str($data); }
    public function setVacuna_hepatitis_b($data){ $this->vacuna_hepatitis_b = $this->db->escape_str($data); }
    public function setVacuna_influenza($data){ $this->vacuna_influenza = $this->db->escape_str($data); }
    public function setVacuna_sarampion($data){ $this->vacuna_sarampion = $this->db->escape_str($data); }
    public function setVacuna_papiloma($data){ $this->vacuna_papiloma = $this->db->escape_str($data); }
    public function setVacunas_otras($data){ $this->vacunas_otras = $this->db->escape_str($data); }
    public function setUsuario_registro($data){ $this->usuario_registro = $this->db->escape_str($data); }
    public function setFecha_registro($data){ $this->fecha_registro = $this->db->escape_str($data); }
    public function setUsuario_actualizacion($data){ $this->usuario_actualizacion = $this->db->escape_str($data); }
    public function setFecha_actualizacion($data){ $this->fecha_actualizacion = $this->db->escape_str($data); }
    public function setTalla_casaca($data){ $this->talla_casaca = $this->db->escape_str($data); }
    public function setTalla_calzado($data){ $this->talla_calzado = $this->db->escape_str($data); }
    public function setTalla_polo($data){ $this->talla_polo = $this->db->escape_str($data); }
    public function setTalla_pantalon($data){ $this->talla_pantalon = $this->db->escape_str($data); }
    public function setActivo($data){ $this->Activo = $this->db->escape_str($data); }
    public function setBrigadistas_banco_id($data){ $this->brigadistas_banco_id = $this->db->escape_str($data); }
    public function setIdidioma($data){ $this->ididioma = $this->db->escape_str($data); }
    public function setIdprofesion($data){ $this->idprofesion = $this->db->escape_str($data); }
    public function setNumero_cuenta($data){ $this->numero_cuenta = $this->db->escape_str($data); }
    public function setNumero_cci($data){ $this->numero_cci = $this->db->escape_str($data); }
    public function setGrupo_sanguineo($data){ $this->grupo_sanguineo = $this->db->escape_str($data); }
    public function setObservacion($data){ $this->observacion = $this->db->escape_str($data); }
    public function setIdinstitucion($data){ $this->idinstitucion = $this->db->escape_str($data); }
    public function setCodigo_institucion($data){ $this->codigo_institucion = $this->db->escape_str($data); }
    public function setCodigo_region($data){ $this->codigo_region = $this->db->escape_str($data); }
    public function setCodigo_disa($data){ $this->codigo_disa = $this->db->escape_str($data); }
    public function setCodigo_red($data){ $this->codigo_red = $this->db->escape_str($data); }
    public function setCodigo_micro_red($data){ $this->codigo_micro_red = $this->db->escape_str($data); }
    public function setCodigo_renipress($data){ $this->codigo_renipress = $this->db->escape_str($data); }
    public function setCodigo_condicion($data){ $this->codigo_condicion = $this->db->escape_str($data); }
    public function setInstitucion($data){ $this->institucion = $this->db->escape_str($data); }
    public function setFecha_emision($data){ $this->fecha_emision = $this->db->escape_str($data); }
    public function setTipo_capacitacion($data){ $this->tipo_capacitacion = $this->db->escape_str($data); }
    public function setNombre($data){ $this->nombre = $this->db->escape_str($data); }
    public function setTipo_inmunizacion($data){ $this->tipo_inmunizacion = $this->db->escape_str($data); }
    public function setNumero_dosis($data){ $this->numero_dosis = $this->db->escape_str($data); }
    public function setFecha_vacuna($data){ $this->fecha_vacuna = $this->db->escape_str($data); }
    public function setAlergias_alimentarias($data){ $this->alergias_alimentarias = $this->db->escape_str($data); }
    public function setAlergias_farmacologicas($data){ $this->alergias_farmacologicas = $this->db->escape_str($data); }
    public function setColegiatura($data){ $this->colegiatura = $this->db->escape_str($data); }
    public function setRne($data){ $this->rne = $this->db->escape_str($data); }
    public function setIdEspecialidad($data){ $this->idespecialidad = $this->db->escape_str($data); }
    public function setTipo_certificacion($data){ $this->tipo_certificacion = $this->db->escape_str($data); }
    public function setFecha_reconocimiento($data){ $this->fecha_reconocimiento = $this->db->escape_str($data); }
    public function setResolucion($data){ $this->resolucion = $this->db->escape_str($data); }
    public function setFecha_inicio($data){ $this->fecha_inicio = $this->db->escape_str($data); }
    public function setFecha_vencimiento($data){ $this->fecha_vencimiento = $this->db->escape_str($data); }
    public function setArchivo($data){ $this->archivo = $this->db->escape_str($data); }
    public function setBrigadistas_cursos_id($data){ $this->brigadistas_cursos_id = $this->db->escape_str($data); }
    public function setEntidad($data){ $this->entidad = $this->db->escape_str($data); }
    public function setFecha_fin($data){ $this->fecha_fin = $this->db->escape_str($data); }
    public function setHoras($data){ $this->horas = $this->db->escape_str($data); }
    public function setEvento_Registro_Numero($data){ $this->Evento_Registro_Numero = $this->db->escape_str($data); }
    public function setCalificacion($data){ $this->calificacion = $this->db->escape_str($data); }
    public function setLider($data){ $this->lider = $this->db->escape_str($data); }
    public function setFuerza_tarea($data){ $this->fuerza_tarea = $this->db->escape_str($data); }
    public function setAcciones_realizadas($data){ $this->acciones_realizadas = $this->db->escape_str($data); }
    public function setDIRESA($data){ $this->DIRESA = $this->db->escape_str($data); }
    public function setRed($data){ $this->Red = $this->db->escape_str($data); }
    public function setMicroRed($data){ $this->MicroRed = $this->db->escape_str($data); }
    public function setCodEESS($data){ $this->CodEESS = $this->db->escape_str($data); }
    public function setoficina($data){ $this->oficina = $this->db->escape_str($data); }
    public function setcondicion_laboral($data){ $this->condicion_laboral = $this->db->escape_str($data); }
    public function setcargo($data){ $this->cargo = $this->db->escape_str($data); }
    public function settelefono_institucional($data){ $this->telefono_institucional = $this->db->escape_str($data); }
    public function setemail_institucional($data){ $this->email_institucional = $this->db->escape_str($data); }
    public function setbrigadistas_profesiones_id($data){ $this->brigadistas_profesiones_id = $this->db->escape_str($data); }
    public function setbrigadistas_especialidad_id($data){ $this->brigadistas_especialidad_id = $this->db->escape_str($data); }
    public function setbrigadistas_certificacion_id($data){ $this->brigadistas_certificacion_id = $this->db->escape_str($data); }
    public function setbrigadistas_evento_id($data){ $this->brigadistas_evento_id = $this->db->escape_str($data); }
    public function setbrigadistas_clusters_id($data){ $this->brigadistas_clusters_id = $this->db->escape_str($data); }
    public function setbrigadistas_sedes_id($data){ $this->brigadistas_sedes_id = $this->db->escape_str($data); }
    public function setIdrenarhed($data){ $this->idrenarhed = $this->db->escape_str($data); }
    public function setFoto_renarhed($data){ $this->foto_renarhed = $this->db->escape_str($data); }
    public function setNivel($data){ $this->nivel = $this->db->escape_str($data); }
    public function setLectura($data){ $this->lectura = $this->db->escape_str($data); }
    public function setEscritura($data){ $this->escritura = $this->db->escape_str($data); } 
    public function setIdcertificacion($data){ $this->idcertificacion = $this->db->escape_str($data); }
    public function setFecha_vigencia($data){ $this->fecha_vigencia = $this->db->escape_str($data); }
    public function setIdcarreras($data){ $this->idcarreras = $this->db->escape_str($data); }
    public function setArchivo_titulo($data){ $this->archivo_titulo = $this->db->escape_str($data); }
    public function setArchivo_especialidad($data){ $this->archivo_especialidad = $this->db->escape_str($data); }
    public function setArchivo_adjunto($data){ $this->archivo_adjunto = $this->db->escape_str($data); }
    public function setTarjeta_vacunas($data){ $this->tarjeta_vacunas = $this->db->escape_str($data); }
    public function setIdcapacitacion($data){ $this->idcapacitacion = $this->db->escape_str($data); }
    public function setIdinmunizacion($data){ $this->idinmunizacion = $this->db->escape_str($data); }
    public function setIdcomision($data){ $this->idcomision = $this->db->escape_str($data); }
    public function setRegionComision($data){ $this->regioncomision = $this->db->escape_str($data); }
    public function setTipoComision($data){ $this->tipocomision = $this->db->escape_str($data); }
    public function setTipoEventoComision($data){ $this->tipoEventocomision = $this->db->escape_str($data); }
    public function setEventoComision($data){ $this->eventocomision = $this->db->escape_str($data); }
    public function setEventoDetalleComision($data){ $this->eventoDetallecomision = $this->db->escape_str($data); }
    public function setNumeroEventoComision($data){ $this->numeroEventocomision = $this->db->escape_str($data); }
    public function setDescripcionComision($data){ $this->descripcioncomision = $this->db->escape_str($data); }
    public function setFechaInicioComision($data){ $this->fechaIniciocomision = $this->db->escape_str($data); }
    public function setFechaFinComision($data){ $this->fechaFincomision = $this->db->escape_str($data); }
    public function setFichaTecnicaComision($data){ $this->fichaTecnicaComision = $this->db->escape_str($data); }
    public function setAnioComision($data){ $this->aniocomision = $this->db->escape_str($data); }
    public function setMesComision($data){ $this->mescomision = $this->db->escape_str($data); }
    public function setIdrenarhedcomi($data){ $this->idrenarhedcomi = $this->db->escape_str($data); }
    public function setApellidoscomi($data){ $this->apellidoscomi = $this->db->escape_str($data); }
    public function setNombrescomi($data){ $this-> nombrescomi= $this->db->escape_str($data); }
    public function setNro_Documentocomi($data){ $this->nro_documentocomi = $this->db->escape_str($data); }
    public function setFuncioncomi($data){ $this->funcioncomi = $this->db->escape_str($data); }
    public function listar(){
        $this->db->select("brigadista_id id,apellidos,nombres,Tipo_Documento_Codigo,documento_numero,genero,DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') fecha_nacimiento,foto");
        $this->db->select("edad,estado_civil,ubigeo_domicilio,telefono_01,telefono_02,email,contacto_emergencia");
        $this->db->select("telefono_emergencia_01,telefono_emergencia_02,alergias,intervenciones_quirurgica");
        $this->db->select("antecedentes_medicos,talla,peso,vacuna_tetano,vacuna_fiebre_amarilla,vacuna_hepatitis_b");
        $this->db->select("vacuna_influenza,vacuna_sarampion,vacuna_papiloma,vacunas_otras,talla_casaca");
        $this->db->select("talla_calzado,talla_polo,talla_pantalon,Activo,grupo_sanguineo");
        $this->db->from("brigadistas_registro");
        return $this->db->get();
    }
    public function brigadista(){
        $this->db->select("brigadista_id id,apellidos,nombres,Tipo_Documento_Codigo,documento_numero,genero,fecha_nacimiento,foto,idioma_ingles,idioma_quechua,idioma_aimara,idioma_otros");
        $this->db->select("edad,estado_civil,domicilio,ubigeo_domicilio,telefono_01,telefono_02,email,contacto_emergencia,parentesco,Categoria");
        $this->db->select("telefono_emergencia_01,telefono_emergencia_02,parentesco,alergias,intervenciones_quirurgica");
        $this->db->select("antecedentes_medicos,talla,peso,vacuna_tetano,vacuna_fiebre_amarilla,vacuna_hepatitis_b");
        $this->db->select("vacuna_influenza,vacuna_sarampion,vacuna_papiloma,vacunas_otras,talla_casaca,DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') f_nac");
        $this->db->select("talla_calzado,talla_polo,talla_pantalon,Activo,grupo_sanguineo,brigadistas_banco_id,numero_cuenta");
        $this->db->select("fn_departamento(SUBSTRING(ubigeo_domicilio,1,2)) departamento");
        $this->db->select("fn_provincia(SUBSTRING(ubigeo_domicilio,1,2),SUBSTRING(ubigeo_domicilio,3,2)) provincia");
        $this->db->select("fn_distrito(SUBSTRING(ubigeo_domicilio,1,2),SUBSTRING(ubigeo_domicilio,3,2),SUBSTRING(ubigeo_domicilio,5,2)) distrito");
        $this->db->from("brigadistas_registro");
        $this->db->where("brigadista_id",$this->id);
        return $this->db->get();
    }
    public function bancos() {
        $this->db->select("brigadistas_banco_id id,banco,Activo");
        $this->db->from("brigadistas_banco");
        $this->db->where("Activo","1");
        return $this->db->get();
    }
    public function existe(){
        $this->db->select("1");
        $this->db->from("brigadistas_registro");
        $this->db->where("documento_numero",$this->documento_numero);
        $rs =  $this->db->get();
        return $rs->num_rows();

    }
    public function foto(){
        $this->db->select("foto");
        $this->db->from("brigadistas_registro");
        $this->db->where("brigadista_id",$this->id);
        return $this->db->get();
    }
    public function registrar() {
        $data = array(
            "apellidos" => $this->apellidos, 
            "nombres" => $this->nombres,
            "tipo_documento" => $this->Tipo_Documento_Codigo, 
            "tipo_documento_contacto" => $this->Tipo_Documento_Codigo_C, 
            "numero_documento" => $this->documento_numero, 
            "sexo" => $this->genero, 
            "fecha_nacimiento" => $this->fecha_nacimiento,
            "edad" => $this->edad,
            "Categoria" => $this->Categoria, 
            "estado_civil" => $this->estado_civil,
            "pasaporte" => $this->pasaporte,
            "caducidad_pasaporte" => $this->caducidad_pasaporte,
            "domicilio" => $this->domicilio, 
            "ubigeo_domicilio" => $this->ubigeo_domicilio, 
            "telefono_1" => $this->telefono_01, 
            "telefono_2" => $this->telefono_02,
            "telefono_3" => $this->telefono_03,
            "email_personal" => $this->email, 
            "email_institucional" => $this->email_institucional,
            "idinstitucion" => $this->idinstitucion, 
            "apellidos_contacto" => $this->apellidos_contacto, 
            "nombres_contacto" => $this->nombres_contacto,
            "numero_documento_contacto" => $this->contacto_emergencia,
            "telefono_1_contacto" => $this->telefono_emergencia_01, 
            "telefono_2_contacto" => $this->telefono_emergencia_02, 
            "telefono_3_contacto" => $this->telefono_emergencia_03, 
            "parentesco_contacto" => $this->parentesco,
            "grupo_sanguineo" => $this->grupo_sanguineo,
            "talla" => $this->talla, 
            "imc" => $this->imc,
            "peso" => $this->peso,
            "usuario_registro" => $this->session->userdata("idusuario"),
            "fecha_registro" => date("Y-m-d H:i:s"),
            "estado" => "1",
            "idbanco" => $this->brigadistas_banco_id,
            "ididioma" => $this->ididioma,
            "numero_cuenta" => $this->numero_cuenta,
            "numero_cci" => $this->numero_cci,
            "observacion" => $this->observacion, 
        );
        if($this->db->insert("renarhed_registro", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("apellidos",$this->apellidos, TRUE);
        $this->db->set("nombres",$this->nombres, TRUE);
        $this->db->set("Tipo_Documento_Codigo",$this->Tipo_Documento_Codigo, TRUE);
        $this->db->set("Tipo_Documento_Codigo_C",$this->Tipo_Documento_Codigo_C, TRUE);
        $this->db->set("documento_numero",$this->documento_numero, TRUE);
        $this->db->set("genero",$this->genero, TRUE);
        $this->db->set("fecha_nacimiento",$this->fecha_nacimiento, TRUE);
        $this->db->set("edad",$this->edad, TRUE);
        $this->db->set("estado_civil",$this->estado_civil, TRUE);
        $this->db->set("pasaporte",$this->pasaporte, TRUE);
        $this->db->set("caducidad_pasaporte",$this->caducidad_pasaporte, TRUE);
        $this->db->set("domicilio",$this->domicilio, TRUE);
        $this->db->set("ubigeo_domicilio",$this->ubigeo_domicilio, TRUE);
        $this->db->set("telefono_01",$this->telefono_01, TRUE);
        $this->db->set("telefono_02",$this->telefono_02, TRUE);
        $this->db->set("telefono_03",$this->telefono_03, TRUE);
        $this->db->set("email",$this->email, TRUE);
        $this->db->set("email_institucional",$this->email_institucional, TRUE);
        $this->db->set("Categoria", $this->Categoria, TRUE);
        $this->db->set("contacto_emergencia",$this->contacto_emergencia, TRUE);
        $this->db->set("telefono_emergencia_01",$this->telefono_emergencia_01, TRUE);
        $this->db->set("telefono_emergencia_02",$this->telefono_emergencia_02, TRUE);
        $this->db->set("parentesco",$this->parentesco, TRUE);
        $this->db->set("apellidos_contacto",$this->apellidos_contacto, TRUE); 
        $this->db->set("nombres_contacto",$this->nombres_contacto, TRUE);    
        $this->db->set("grupo_sanguineo",$this->grupo_sanguineo, TRUE);
        $this->db->set("talla",$this->talla, TRUE);
        $this->db->set("imc",$this->imc, TRUE);
        $this->db->set("peso",$this->peso, TRUE);
        $this->db->set("usuario_actualizacion",$this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_actualizacion",date("Y-m-d H:i:s"), TRUE);
        $this->db->set("brigadistas_banco_id",$this->brigadistas_banco_id, TRUE);
        $this->db->set("ididioma",$this->ididioma, TRUE);
        $this->db->set("numero_cuenta",$this->numero_cuenta, TRUE);
        $this->db->set("observacion",$this->observacion, TRUE);
        $this->db->set("idinstitucion",$this->idinstitucion, TRUE);
        $this->db->where("brigadista_id", $this->id);
        if ($this->db->update('brigadistas_registro'))
            return true;
        else
            return false;
    }
    public function agregarFoto()
    {
        $this->db->db_debug = FALSE;
        
        $this->db->set("foto", $this->foto, TRUE);
        $this->db->where("brigadista_id", $this->id);
        $error = array();
        if ($this->db->update('brigadistas_registro'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function listaProfesiones() {
        $this->db->select("brigadistas_profesiones_id,profesion");
        $this->db->from("brigadistas_profesiones");
        $this->db->where("Activo","1");
        return $this->db->get();
    }
    public function listaEspecialidades() {
        $this->db->select("brigadistas_especialidad_id,especialidad");
        $this->db->from("brigadistas_especialidad");
        $this->db->where("brigadistas_profesiones_id",$this->brigadistas_profesiones_id);
        $this->db->where("Activo","1");
        
        return $this->db->get();
    }
    public function instituciones() {
        $this->db->select("idinstitucion id,nombre,estado");
        $this->db->from("renarhed_institucion");
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function profesionesBrigadista() {
        $this->db->select("de.brigadistas_detalle_especialidades_id,p.profesion,e.especialidad");
        $this->db->from("brigadistas_detalle_especialidades de");
        $this->db->join("brigadistas_especialidad e","e.brigadistas_especialidad_id = de.brigadistas_especialidad_id");
        $this->db->join("brigadistas_profesiones p","p.brigadistas_profesiones_id = e.brigadistas_profesiones_id");
        $this->db->where("brigadista_id", $this->id);
        return $this->db->get();
    }
    public function buscarEspecialidad() {
        $this->db->select("1");
        $this->db->from("brigadistas_detalle_especialidades");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("brigadistas_especialidad_id",$this->brigadistas_especialidad_id);
        return $this->db->get();
    }
    public function registrarEspecialidad() {
        $data = array(
            "brigadista_id" => $this->id,
            "brigadistas_especialidad_id" => $this->brigadistas_especialidad_id,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_detalle_especialidades', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarEspecialidad()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_detalle_especialidades_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_detalle_especialidades'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function archivoCertificacion(){
        $this->db->select("archivo");
        $this->db->from("brigadistas_certificacion");
        $this->db->where("brigadistas_certificacion_id", $this->id);
        return $this->db->get();
    }
    public function buscarCertificacion() {
        $this->db->select("1");
        $this->db->from("brigadistas_certificacion");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("tipo_certificacion",$this->tipo_certificacion);
        $this->db->where("fecha_reconocimiento",$this->fecha_reconocimiento);
        $this->db->where("resolucion",$this->resolucion);
        $this->db->where("fecha_inicio",$this->fecha_inicio);
        $this->db->where("fecha_vencimiento",$this->fecha_vencimiento);
        return $this->db->get();
    }
    public function listaCertificacion() {
        $this->db->select("brigadistas_certificacion_id as id,tipo_certificacion,DATE_FORMAT(fecha_reconocimiento,'%d/%m/%Y') fecha_reconocimiento");
        $this->db->select("resolucion,DATE_FORMAT(fecha_inicio,'%d/%m/%Y') fecha_inicio,DATE_FORMAT(fecha_vencimiento,'%d/%m/%Y') fecha_vencimiento,archivo");
        $this->db->from("brigadistas_certificacion");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function certificacion() {
        $this->db->select("brigadista_id,tipo_certificacion,DATE_FORMAT(fecha_reconocimiento,'%d/%m/%Y') fecha_reconocimiento");
        $this->db->select("resolucion,DATE_FORMAT(fecha_inicio,'%d/%m/%Y') fecha_inicio,DATE_FORMAT(fecha_vencimiento,'%d/%m/%Y') fecha_vencimiento,archivo");
        $this->db->from("brigadistas_certificacion");
        $this->db->where("brigadistas_certificacion_id",$this->id);
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function registrarCertificacion() {
        $data = array(
            "brigadista_id" => $this->id,
            "tipo_certificacion"=> $this->tipo_certificacion,
            "fecha_reconocimiento"=> $this->fecha_reconocimiento,
            "resolucion"=> $this->resolucion,
            "fecha_inicio"=> $this->fecha_inicio,
            "fecha_vencimiento"=> $this->fecha_vencimiento,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_certificacion', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarCertificacion()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_certificacion_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_certificacion'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function listaCursos() {
        $this->db->select("brigadistas_cursos_id,nombre_curso");
        $this->db->from("brigadistas_cursos");
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function buscarCapacitacion() {
        $this->db->select("1");
        $this->db->from("brigadistas_capacitaciones");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("brigadistas_cursos_id",$this->brigadistas_cursos_id);
        $this->db->where("entidad",$this->entidad);
        $this->db->where("fecha_inicio",$this->fecha_inicio);
        $this->db->where("fecha_fin",$this->fecha_fin);
        return $this->db->get();
    }
    public function listaCapacitacion() {
        $this->db->select("ca.brigadistas_capacitaciones_id id,cu.nombre_curso curso_capacitacion,DATE_FORMAT(ca.fecha_inicio,'%d/%m/%Y') fecha_inicio");
        $this->db->select("DATE_FORMAT(ca.fecha_fin,'%d/%m/%Y') fecha_fin,ca.horas,ca.entidad");
        $this->db->from("brigadistas_capacitaciones ca");
        $this->db->join("brigadistas_cursos cu","ca.brigadistas_cursos_id=cu.brigadistas_cursos_id");
        $this->db->where("ca.brigadista_id",$this->id);
        $this->db->where("ca.Activo",'1');
        return $this->db->get();
    }
     public function registrarCapacitacion() {
         $data = array(
            "brigadista_id" => $this->id,
            "brigadistas_cursos_id"=> $this->brigadistas_cursos_id,
            "entidad"=> $this->entidad,
            "fecha_inicio"=> $this->fecha_inicio,
            "fecha_fin"=> $this->fecha_fin,
            "horas" => $this->horas,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_capacitaciones', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarCapacitacion()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_capacitaciones_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_capacitaciones'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function listaEmergencia() {
        $this->db->select("calificacion,lider,fuerza_tarea,brigadistas_emergencias_id id,acciones_realizadas");
        $this->db->from("brigadistas_emergencias");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Activo",'1');
        return $this->db->get();
        
    }
    public function buscarEmergencia() {
        $this->db->select("1");
        $this->db->from("brigadistas_emergencias");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->where("calificacion",$this->calificacion);
        $this->db->where("lider",$this->lider);
        $this->db->where("fuerza_tarea",$this->fuerza_tarea);
        return $this->db->get();
    }
    public function registrarEmergencia() {
        $data = array(
            "brigadista_id" => $this->id,
            "Evento_Registro_Numero"=> $this->Evento_Registro_Numero,
            "calificacion"=> $this->calificacion,
            "lider"=> $this->lider,
            "fuerza_tarea"=> $this->fuerza_tarea,
            "acciones_realizadas" => $this->acciones_realizadas,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_emergencias', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarEmergencia()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_emergencias_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_emergencias'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
public function listaContingencias() {
        $this->db->select("calificacion,lider,fuerza_tarea,brigadistas_contingencias_id id");
        $this->db->from("brigadistas_contingencias");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function buscarContingencia() {
        $this->db->select("1");
        $this->db->from("brigadistas_contingencias");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Evento_Registro_Numero",$this->Evento_Registro_Numero);
        $this->db->where("calificacion",$this->calificacion);
        $this->db->where("lider",$this->lider);
        $this->db->where("fuerza_tarea",$this->fuerza_tarea);
        return $this->db->get();
    }
    public function registrarContingencia() {
        $data = array(
            "brigadista_id" => $this->id,
            "Evento_Registro_Numero"=> $this->Evento_Registro_Numero,
            "calificacion"=> $this->calificacion,
            "lider"=> $this->lider,
            "fuerza_tarea"=> $this->fuerza_tarea,
            "acciones_realizadas" => $this->acciones_realizadas,
            "Activo" => "1"
        );
        
        if ($this->db->insert('brigadistas_contingencias', $data))
            return $this->db->insert_id();
            else
                return 0;
                
    }
    public function eliminarContingencia()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_contingencias_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_contingencias'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function gradoestudios() {
        $this->db->select("be.especialidad,bp.profesion");
        $this->db->from("brigadistas_profesiones bp");
        $this->db->join("brigadistas_especialidad be","be.brigadistas_profesiones_id=bp.brigadistas_profesiones_id");
        $this->db->join("brigadistas_detalle_especialidades bde","bde.brigadistas_especialidad_id=be.brigadistas_especialidad_id");
        $this->db->where("bde.brigadista_id",$this->id);
        return $this->db->get();
    }
    public function informacionlaboral() {
        $this->db->select("be.especialidad,bp.profesion");
        $this->db->from("brigadistas_profesiones bp");
        $this->db->join("brigadistas_especialidad be","be.brigadistas_profesiones_id=bp.brigadistas_profesiones_id");
        $this->db->join("brigadistas_detalle_especialidades bde","bde.brigadistas_especialidad_id=be.brigadistas_especialidad_id");
        $this->db->where("bde.brigadista_id",$this->id);
        return $this->db->get();
    }
    public function certificaciones() {
        $this->db->select("tipo_certificacion,resolucion,DATE_FORMAT(fecha_reconocimiento,'%d/%m/%Y') fecha_reconocimiento,DATE_FORMAT(fecha_inicio,'%d/%m/%Y') fecha_inicio,DATE_FORMAT(fecha_vencimiento,'%d/%m/%Y') fecha_vencimiento");
        $this->db->from("brigadistas_certificacion");        
        $this->db->where("brigadista_id",$this->id);
        return $this->db->get();
    }
    public function emergencias() {
        $this->db->select("be.calificacion,be.lider,be.fuerza_tarea,be.brigadistas_emergencias_id id,be.acciones_realizadas,er.Evento_Descripcion,DATE_FORMAT(er.Evento_Fecha_Registro,'%d/%m/%Y %H:%i') Evento_Fecha_Registro");
        $this->db->select("e.Evento_Nombre evento,ed.Evento_Detalle_Nombre eventoDetalle");
        $this->db->from("brigadistas_emergencias be");
        $this->db->join("evento_registro er","be.Evento_Registro_Numero=er.Evento_Registro_Numero");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("be.Activo",'1');
        return $this->db->get();
    }
    public function contingencias() {
        $this->db->select("be.calificacion,be.lider,be.fuerza_tarea,be.brigadistas_contingencias_id id,be.acciones_realizadas,er.Evento_Descripcion,DATE_FORMAT(er.Evento_Fecha_Registro,'%d/%m/%Y %H:%i') Evento_Fecha_Registro");
        $this->db->select("e.Evento_Nombre evento,ed.Evento_Detalle_Nombre eventoDetalle");
        $this->db->from("brigadistas_contingencias be");
        $this->db->join("evento_registro er","be.Evento_Registro_Numero=er.Evento_Registro_Numero");
        $this->db->join("evento_tipo et", "er.evento_tipo_codigo=et.evento_tipo_codigo");
        $this->db->join("evento e", "e.evento_codigo=er.evento_codigo and et.evento_tipo_codigo=e.evento_tipo_codigo");
        $this->db->join("evento_detalle ed", "er.evento_detalle_codigo=ed.evento_detalle_codigo and et.evento_tipo_codigo=ed.evento_tipo_codigo and e.evento_codigo=ed.evento_codigo");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("be.Activo",'1');
        return $this->db->get();
    }
    public function listatrabajos() {
        $this->db->select("bl.brigadistas_laborales_id id,bd.brigadistas_diresa_nombre DIRESA,bl.Red,bl.MicroRed,bl.CodEESS,bl.condicion_laboral,bl.oficina");
        $this->db->select("bl.cargo,bl.telefono_institucional,bl.email_institucional");
        $this->db->from("brigadistas_laborales bl");
        $this->db->join("brigadistas_diresa bd","bl.brigadistas_diresa_id=bd.brigadistas_diresa_id");
        $this->db->where("bl.brigadista_id",$this->id);
        $this->db->where("bl.Activo",'1');
        return $this->db->get();
    }
    public function ultimoTrabajo() {
        $this->db->select("bd.brigadistas_diresa_nombre DIRESA");
        $this->db->select("bl.cargo,bl.telefono_institucional,bl.email_institucional");
        $this->db->from("brigadistas_laborales bl");
        $this->db->join("brigadistas_diresa bd","bl.brigadistas_diresa_id=bd.brigadistas_diresa_id");        
        $this->db->where("bl.brigadista_id",$this->id);
        $this->db->where("bl.Activo",'1');
        $this->db->order_by("bl.brigadistas_laborales_id", "DESC");
        $this->db->limit(1);
        return $this->db->get();
    }
    public function buscarTrabajo() {
        $this->db->select("1");
        $this->db->from("brigadistas_laborales");
        $this->db->where("brigadistas_diresa_id",$this->DIRESA);
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("Red",$this->Red);
        $this->db->where("MicroRed",$this->MicroRed);
        $this->db->where("CodEESS",$this->CodEESS);
        $this->db->where("condicion_laboral",$this->condicion_laboral);
        return $this->db->get();
    }
    public function registrarTrabajo() {
        $data = array(
            "brigadista_id" => $this->id,
            "brigadistas_diresa_id"=> $this->DIRESA,
            "Red"=> $this->Red,
            "MicroRed"=> $this->MicroRed,
            "CodEESS"=> $this->CodEESS,
            "condicion_laboral" => $this->condicion_laboral,
            "oficina" => $this->oficina,
            "cargo" => $this->cargo,
            "telefono_institucional" => $this->telefono_institucional,
            "email_institucional" => $this->email_institucional,
            "Activo" => "1"
        );
        if ($this->db->insert('brigadistas_laborales', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarTrabajo()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_laborales_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_laborales'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function diresa()
    {
        $this->db->select("brigadistas_diresa_id id, brigadistas_diresa_nombre nombre");
        $this->db->from("brigadistas_diresa");
        $this->db->where("Activo",'1');
        return $this->db->get();
    }
    public function profesionesBrigadistaId() {
        $this->db->select("p.brigadistas_profesiones_id id,p.profesion");
        $this->db->from("brigadistas_detalle_especialidades de");
        $this->db->join("brigadistas_especialidad e","e.brigadistas_especialidad_id = de.brigadistas_especialidad_id");
        $this->db->join("brigadistas_profesiones p","p.brigadistas_profesiones_id = e.brigadistas_profesiones_id");
        $this->db->where("brigadista_id", $this->id);
        $this->db->group_by("p.brigadistas_profesiones_id");
        return $this->db->get();
    }
    public function especialidadesProfesionesBrigadista() {
        $this->db->select("e.brigadistas_especialidad_id,e.especialidad");
        $this->db->from("brigadistas_detalle_especialidades de");
        $this->db->join("brigadistas_especialidad e","e.brigadistas_especialidad_id = de.brigadistas_especialidad_id");
        $this->db->join("brigadistas_profesiones p","p.brigadistas_profesiones_id = e.brigadistas_profesiones_id");
        $this->db->where("brigadista_id", $this->id);
        $this->db->where("p.brigadistas_profesiones_id", $this->brigadistas_profesiones_id);
        return $this->db->get();
    }
    public function listaCarnet() {
        $this->db->select("de.brigadistas_carnet_id id, de.fecha_emision,de.fecha_vencimiento,de.brigadistas_especialidad_id");
        $this->db->select("p.brigadistas_profesiones_id,p.profesion,e.brigadistas_especialidad_id,e.especialidad,b.tipo_certificacion");
        $this->db->select("DATE_FORMAT(de.fecha_emision,'%d/%m/%Y') fecha_emision,DATE_FORMAT(de.fecha_vencimiento,'%d/%m/%Y') fecha_vencimiento");
        $this->db->from("brigadistas_carnet de");
        $this->db->join("brigadistas_especialidad e","e.brigadistas_especialidad_id = de.brigadistas_especialidad_id");
        $this->db->join("brigadistas_profesiones p","p.brigadistas_profesiones_id = e.brigadistas_profesiones_id");
        $this->db->join("brigadistas_certificacion b","de.brigadistas_certificacion_id = b.brigadistas_certificacion_id","left");
        $this->db->where("de.brigadista_id", $this->id);
        return $this->db->get();
    }
    public function carnet() {
        $this->db->select("r.brigadista_id,r.apellidos,r.nombres,r.grupo_sanguineo,r.alergias,r.Categoria,r.documento_numero,DATE_FORMAT(r.fecha_nacimiento,'%d/%m/%Y') f_nac,r.parentesco,r.foto");
        $this->db->select("r.contacto_emergencia,r.telefono_emergencia_01,r.telefono_emergencia_02");
        $this->db->select("de.brigadistas_carnet_id id, de.fecha_emision,de.fecha_vencimiento,de.brigadistas_especialidad_id");
        $this->db->select("de.brigadistas_profesion_id,de.brigadistas_especialidad_id,b.tipo_certificacion");
        $this->db->from("brigadistas_registro r");
        $this->db->join("brigadistas_carnet de","de.brigadista_id = r.brigadista_id");
        $this->db->join("brigadistas_certificacion b","de.brigadistas_certificacion_id = b.brigadistas_certificacion_id","left");
        $this->db->where("de.brigadistas_carnet_id", $this->id);
        return $this->db->get();
    }
	public function profesionEspecialidad() {
		$this->db->select("p.brigadistas_profesiones_id,e.brigadistas_especialidad_id");
		$this->db->select("Case p.brigadistas_profesiones_id when  4 then e.especialidad 
		when 3 then concat_ws(' - ',p.profesion,e.especialidad) when 2 then concat_ws(' - ',p.profesion,e.especialidad) 
		when 1 then concat_ws(' - ',p.profesion,e.especialidad) end as 'Carrera'");
		$this->db->from("brigadistas_especialidad e");
		$this->db->join("brigadistas_profesiones p","e.brigadistas_profesiones_id = p.brigadistas_profesiones_id");
		$this->db->where("p.brigadistas_profesiones_id", $this->brigadistas_profesiones_id);
		$this->db->where("e.brigadistas_especialidad_id", $this->brigadistas_especialidad_id);
		return $this->db->get();
	}
    public function existeFotocheck(){
        $this->db->select("1");
        $this->db->from("brigadistas_carnet");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("brigadistas_certificacion_id",$this->brigadistas_certificacion_id);
        $this->db->where("brigadistas_profesion_id",$this->brigadistas_profesiones_id);
        $this->db->where("brigadistas_especialidad_id",$this->brigadistas_especialidad_id);
        $this->db->where("Activo","1");
        return $this->db->get();
    }
    public function registrarFotocheck() {
        $data = array(
            "brigadista_id" => $this->id,
            "brigadistas_certificacion_id" => $this->brigadistas_certificacion_id,
            "brigadistas_profesion_id" => $this->brigadistas_profesiones_id,
            "brigadistas_especialidad_id" => $this->brigadistas_especialidad_id,
            "fecha_emision" => $this->fecha_inicio,
            "fecha_vencimiento" => $this->fecha_vencimiento,
            "Activo" => 1
        );
        if ($this->db->insert('brigadistas_carnet', $data))
            return $this->db->insert_id();
        else
            return 0;
    }
    public function eliminarFotocheck()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_carnet_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_carnet'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function brigadistas_eventos() {
        $this->db->select("brigadistas_evento_id id,descripcion,descripcion_abreviada,fecha_inicio,fecha_fin");
        $this->db->from("brigadistas_eventos");
        $this->db->where("activo","1");
        return $this->db->get();
    }
    public function listaSedesBrigadista() {
        $this->db->select("sa.brigadistas_sedes_asignacion_id id,sa.brigadista_id,e.descripcion evento,c.descripcion cluster,s.descripcion sede");
        $this->db->from("brigadistas_sedes_asignacion sa");
        $this->db->join("brigadistas_sedes s","sa.brigadistas_evento_id=s.brigadistas_evento_id and sa.brigadistas_clusters_id=s.brigadistas_clusters_id and sa.brigadistas_sedes_id=s.brigadistas_sedes_id");
        $this->db->join("brigadistas_clusters c","sa.brigadistas_evento_id=c.brigadistas_evento_id and sa.brigadistas_clusters_id=c.brigadistas_clusters_id");
        $this->db->join("brigadistas_eventos e","sa.brigadistas_evento_id=e.brigadistas_evento_id");
        $this->db->where("sa.brigadista_id",$this->id);
        return $this->db->get();
    }
    public function existeSede() {
        $this->db->select("1");
        $this->db->from("brigadistas_sedes_asignacion");
        $this->db->where("brigadista_id",$this->id);
        $this->db->where("brigadistas_evento_id",$this->brigadistas_evento_id);
        $this->db->where("brigadistas_clusters_id",$this->brigadistas_clusters_id);
        $this->db->where("brigadistas_sedes_id",$this->brigadistas_sedes_id);
        $this->db->where("activo","1");
        return $this->db->get();
    }
    public function brigadistas_clusters() {
        $this->db->select("brigadistas_clusters_id id,descripcion ,descripcion_abreviada");
        $this->db->from("brigadistas_clusters");
        $this->db->where("brigadistas_evento_id", $this->id);
        $this->db->where("activo","1");
        return $this->db->get();
    }
    public function brigadistas_sedes() {
        
        $this->db->select("brigadistas_sedes_id id,descripcion,descripcion_abreviada"); 
        $this->db->from("brigadistas_sedes");
        $this->db->where("brigadistas_clusters_id", $this->id);
        $this->db->where("activo","1");
        return $this->db->get();
    }
    public function registrarSede() {
        
        $data = array(
            "brigadista_id" => $this->id,
            "brigadistas_evento_id" => $this->brigadistas_evento_id,
            "brigadistas_clusters_id" => $this->brigadistas_clusters_id,
            "brigadistas_sedes_id" => $this->brigadistas_sedes_id,
            "activo" => 1
        );
        if ($this->db->insert('brigadistas_sedes_asignacion', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarSede()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("brigadistas_sedes_asignacion_id", $this->id);
        $error = array();
        if ($this->db->delete('brigadistas_sedes_asignacion'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function existe_renarhed(){
        $this->db->select("1");
        $this->db->from("renarhed_registro");
        $this->db->where("numero_documento",$this->documento_numero);
        $rs =  $this->db->get();
        return $rs->num_rows();
    }
    public function agregarFotoRenarhed()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("foto", $this->foto_renarhed, TRUE);
        $this->db->where("idrenarhed", $this->idrenarhed);
        $error = array();
        if ($this->db->update('renarhed_registro'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function getBrigadista(){
        $this->db->select("*");
        $this->db->select("idrenarhed id");
        $this->db->from("renarhed_registro");
        $this->db->where("idrenarhed",$this->idrenarhed);
        return $this->db->get();
    }
    public function bancosnew() {
        $this->db->select("idbanco id,banco,estado");
        $this->db->from("renarhed_banco");
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function idiomas() {
        $this->db->select("ididioma id,idioma,estado");
        $this->db->from("renarhed_idiomas");
        $this->db->where("estado","1");
        return $this->db->get();
    }
     public function profesiones() {
        $this->db->select("idprofesion,profesion,estado");
        $this->db->from("renarhed_profesion");
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function Especialidades() {
        $this->db->select("idespecialidad,especialidad");
        $this->db->from("renarhed_especialidad");
        $this->db->where("idprofesion",$this->idprofesion);
        $this->db->where("estado","1");
        return $this->db->get();
        
    }
    public function listarRenarhed(){
        $this->db->select("*");
        $this->db->select("DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') fecha_nacimiento");
        $this->db->select("(case estado when '1' then 'Activo' when '0' then 'Anulado' end) AS 'Activo'");
        $this->db->select("(case sexo when '1' then 'MASCULINO' when '2' then 'FEMENINO' end) AS 'sexo'");
        $this->db->select("CONCAT(apellidos, ' ', nombres) AS concatenado_nombre");
        $this->db->from("renarhed_registro");
        return $this->db->get();
    }
    public function listarComisiones(){
        $this->db->select("UPPER(re.Nombre_Region) as Region,et.Evento_Tipo_Nombre as Tipo_Evento_Nombre,ev.Evento_Nombre as Evento_Nombre,ed.Evento_Detalle_Nombre as Evento_Detalle_Nombre, tipo as tipoe,rc.*");
        $this->db->select("CONCAT(YEAR(er.Evento_Fecha_Registro), ' - ', LPAD(er.Evento_Secuencia,5,'0')) as evento_sireed");
        $this->db->select("DATE_FORMAT(fecha_inicio,'%Y-%m-%d') fecha_inicio");
        $this->db->select("DATE_FORMAT(fecha_fin,'%Y-%m-%d') fecha_fin");
        $this->db->select("(case estado when '1' then 'Activo' when '0' then 'Anulado' end) AS 'estado'");       
        $this->db->select("(case tipo when '1' then 'EMERGENCIAS' when '2' then 'CONTINGENCIAS' end) AS 'tipo' ");   
        $this->db->from("renarhed_comisiones rc, region re, evento_tipo et, evento ev, evento_detalle ed, evento_registro er");
        $this->db->where("rc.codigo_region = re.Codigo_Region");
        $this->db->where("et.Evento_Tipo_Codigo = rc.codigo_tipo_evento");
        $this->db->where("ev.Evento_Codigo = rc.codigo_evento");
        $this->db->where("ev.Evento_Tipo_Codigo = rc.codigo_tipo_evento");
        $this->db->where("ed.Evento_Detalle_Codigo = rc.codigo_evento_detalle");
        $this->db->where("rc.codigo_evento = ed.Evento_Codigo");
        $this->db->where("rc.codigo_tipo_evento = ed.Evento_Tipo_Codigo");
        $this->db->where("rc.evento_registro_numero = er.evento_registro_numero");
        $this->db->order_by("rc.idcomision DESC");
        return $this->db->get();
    }
    public function listarComisionesRenarhed(){
        $this->db->select("rr.idrenarhed, rr.apellidos, rr.nombres, rr.numero_documento, rr.grupo_sanguineo");
        $this->db->from("renarhed_registro rr");
        return $this->db->get();
    }
    public function listaFuncionComision(){
        $this->db->select("f.idfuncion idfuncion, f.funcion nombfuncion");
        $this->db->where("f.estado = 1");
        $this->db->from("renarhed_funcion f");
        return $this->db->get();
    }
    public function anularcomision()
    {
        $this->db->set("estado", "0", TRUE);
        $this->db->set("Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        $this->db->where("idcomision", $this->idcomision);
        $error = array();
        if ($this->db->update('renarhed_comisiones'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function listarIdiomasPersonal(){ 
        $this->db->select("rip.ididiomas, ri.idioma as idioma");
        $this->db->select("(case rip.lectura when 1 then 'SI' when 0 then 'NO' end) AS 'lectura'");
        $this->db->select("(case rip.escritura when 1 then 'SI' when 0 then 'NO' end) AS 'escritura'");
        $this->db->select("(case rip.estado when 1 then 'Activo' when 0 then 'Anulado' end) AS 'Activo'");
        $this->db->select("(case rip.nivel when 1 then 'BÁSICO' when 2 then 'INTERMEDIO' when 3 then 'AVANZADO' when 4 then 'EXPERTO' end) AS 'nivel'");
        $this->db->from("renarhed_idiomas_personal rip");
        $this->db->join("renarhed_idiomas ri","rip.ididioma=ri.ididioma");
        $this->db->where("rip.idrenarhed", $this->idrenarhed);
        return $this->db->get();
    }
    public function listarCarrerasPersonal(){
        $this->db->select("rcp.idcarreras, rp.idprofesion,rp.profesion,rcp.idespecialidad,re.especialidad,rcp.colegiatura,rcp.rne,rcp.archivo_titulo,rcp.archivo_especialidad");
        $this->db->select("(case rcp.estado when '1' then 'Activo' when '0' then 'Anulado' end) AS 'Activo'");
        $this->db->from("renarhed_carreras_personal rcp");
        $this->db->join("renarhed_profesion rp","rcp.idprofesion=rp.idprofesion");
        $this->db->join("renarhed_especialidad re","rcp.idespecialidad=re.idespecialidad");
        $this->db->where("rcp.idrenarhed", $this->idrenarhed);
        return $this->db->get();
    }
    public function listarCertificadoPersonal(){
        $this->db->select("rctp.idcertificaciones,rinst.idinstitucion,rinst.nombre");
        $this->db->select("(case rctp.estado when '1' then 'Activo' when '0' then 'Anulado' end) AS 'Activo'");
        $this->db->select("DATE_FORMAT(rctp.fecha_inicio,'%d/%m/%Y') fecha_inicio");
        $this->db->select("DATE_FORMAT(rctp.fecha_vigencia,'%d/%m/%Y') fecha_vigencia");
        $this->db->from("renarhed_certificaciones_personal rctp");
        $this->db->join("renarhed_institucion rinst","rctp.idinstitucion=rinst.idinstitucion");
        $this->db->where("rctp.idrenarhed", $this->idrenarhed);
        return $this->db->get();
    }
    public function listarInmunizacionPersonal(){
            $this->db->select("*");
            $this->db->select("(case estado when '1' then 'Activo' when '0' then 'Anulado' end) AS 'Activo'");
            $this->db->select("(case tipo_inmunizacion when 1 then 'Tétanos, Difteri' when 2 then 'Hepatitis B' when 3 then 'Triple viral' when 4 then 'Influenza' when 5 then 'GRDAMAFiebre Amarilla' when 0 then 'Otros' end) AS 'tipo_inmunizacion'");
            $this->db->select("DATE_FORMAT(fecha_vacuna,'%d/%m/%Y') fecha_vacuna");
            $this->db->from("renarhed_inmunizaciones_personal");
            $this->db->where("idrenarhed", $this->idrenarhed);
            return $this->db->get();
    }
    public function listarCapacitacionPersonal(){
         $this->db->select("*");
         $this->db->select("(case estado when '1' then 'Activo' when '0' then 'Anulado' end) AS 'Activo'");
         $this->db->select("(case tipo_capacitacion when 1 then 'BLS' when 2 then 'PHTLS' when 3 then 'ACLS' when 4 then 'ATLS' when 5 then 'GRD' when 0 then 'OTROS' end) AS 'tipo_capacitacion'");
         $this->db->select("DATE_FORMAT(fecha_emision,'%d/%m/%Y') fecha_emision");
         $this->db->from("renarhed_capacitaciones_personal");
         $this->db->where("idrenarhed", $this->idrenarhed);
         return $this->db->get();
    }
    public function getEspecialidadesxProfesion() {
        $this->db->select("idespecialidad id,especialidad");
        $this->db->from("renarhed_especialidad");
        $this->db->where("idprofesion", $this->idrenarhed);
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function editarRenarhed() {
        $this->db->set("apellidos",$this->apellidos, TRUE);
        $this->db->set("nombres",$this->nombres, TRUE);
        $this->db->set("tipo_documento",$this->Tipo_Documento_Codigo, TRUE);
        $this->db->set("tipo_documento_contacto",$this->Tipo_Documento_Codigo_C, TRUE);
        $this->db->set("numero_documento",$this->documento_numero, TRUE);
        $this->db->set("sexo",$this->genero, TRUE);
        $this->db->set("fecha_nacimiento",$this->fecha_nacimiento, TRUE);
        $this->db->set("edad",$this->edad, TRUE);
        $this->db->set("estado_civil",$this->estado_civil, TRUE);
        $this->db->set("pasaporte",$this->pasaporte, TRUE);
        $this->db->set("caducidad_pasaporte",$this->caducidad_pasaporte, TRUE);
        $this->db->set("domicilio",$this->domicilio, TRUE);
        $this->db->set("ubigeo_domicilio",$this->ubigeo_domicilio, TRUE);
        $this->db->set("telefono_1",$this->telefono_01, TRUE);
        $this->db->set("telefono_2",$this->telefono_02, TRUE);
        $this->db->set("telefono_3",$this->telefono_03, TRUE);
        $this->db->set("email_personal",$this->email, TRUE);
        $this->db->set("email_institucional",$this->email_institucional, TRUE);
        $this->db->set("categoria", $this->Categoria, TRUE);
        $this->db->set("telefono_1_contacto",$this->telefono_emergencia_01, TRUE);
        $this->db->set("telefono_2_contacto",$this->telefono_emergencia_02, TRUE);
        $this->db->set("telefono_3_contacto",$this->telefono_emergencia_02, TRUE);
        $this->db->set("parentesco_contacto",$this->parentesco, TRUE);
        $this->db->set("apellidos_contacto",$this->apellidos_contacto, TRUE); 
        $this->db->set("nombres_contacto",$this->nombres_contacto, TRUE);    
        $this->db->set("grupo_sanguineo",$this->grupo_sanguineo, TRUE);
        $this->db->set("talla",$this->talla, TRUE);
        $this->db->set("imc",$this->imc, TRUE);
        $this->db->set("peso",$this->peso, TRUE);
        $this->db->set("usuario_actualizacion",$this->session->userdata("idusuario"), TRUE);
        $this->db->set("fecha_actualizacion",date("Y-m-d H:i:s"), TRUE);
        $this->db->set("idbanco",$this->brigadistas_banco_id, TRUE);
        $this->db->set("ididioma",$this->ididioma, TRUE);
        $this->db->set("numero_cuenta",$this->numero_cuenta, TRUE);
        $this->db->set("observacion",$this->observacion, TRUE);
        $this->db->set("idinstitucion",$this->idinstitucion, TRUE);
        $this->db->where("idrenarhed", $this->id);
        if ($this->db->update('renarhed_registro'))
            return true;
        else
            return false;
    }
    public function registrarAlergiaPersonal() {
        $data = array(
            "estado" => "1"
        );
        $this->db->where("idrenarhed", $this->idrenarhed);
        if ($this->db->update('renarhed_registro', $data))
        return true;
        else
            return false;
    }
    public function registrarAlergiaCampoPersonal() {
        $this->db->set("alergias_alimentarias",$this->alergias_alimentarias, TRUE);
        $this->db->set("alergias_farmacologicas",$this->alergias_farmacologicas, TRUE);
        $this->db->where("idrenarhed", $this->idrenarhed);
        if ($this->db->update('renarhed_registro'))
            return true;
        else
            return false;
    }
    public function registrarIdioma() {
        $data = array(
            "idrenarhed"=>$this->idrenarhed,
            "ididioma"=>$this->ididioma,
            "nivel"=>$this->nivel,
            "lectura"=>$this->lectura,
            "escritura"=>$this->escritura, 
            "estado" => 1
        );
        if ($this->db->insert('renarhed_idiomas_personal', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function eliminarIdiomaPersonal(){
        $this->db->db_debug = FALSE;
        $this->db->where("ididiomas", $this->id);
        $error = array();
        if($this->db->delete('renarhed_idiomas_personal'))
        return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminarCarreraPersonal(){
        $this->db->db_debug = FALSE;
        $this->db->where("idcarreras", $this->id);
        $error = array();
        if($this->db->delete('renarhed_carreras_personal'))
        return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminarCertificadoPersonal(){
        $this->db->db_debug = FALSE;
        $this->db->where("idcertificaciones", $this->id);
        $error = array();
        if($this->db->delete('renarhed_certificaciones_personal'))
        return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminarCapacitacionPersonal(){
        $this->db->db_debug = FALSE;
        $this->db->where("idcapacitacion", $this->id);
        $error = array();
        if($this->db->delete('renarhed_capacitaciones_personal'))
        return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function eliminarInmunizacionPersonal(){
        $this->db->db_debug = FALSE;
        $this->db->where("idinmunizacion", $this->id);
        $error = array();
        if($this->db->delete('renarhed_inmunizaciones_personal'))
        return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function registrarCarrera() {
        
        $data = array(
            "idrenarhed"=>$this->idrenarhed,
            "idprofesion"=>$this->idprofesion,
            "idespecialidad" => $this->idespecialidad,
            "colegiatura"=>$this->colegiatura,
            "rne"=>$this->rne,
            "estado" => 1
        );

        if ($this->db->insert('renarhed_carreras_personal', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function registrarCertificado() {
        $data = array(
            "idrenarhed"=>$this->idrenarhed,
            "idcertificacion"=>$this->idcertificacion,
            "idinstitucion"=>$this->idinstitucion,
            "fecha_inicio"=>$this->fecha_inicio,
            "fecha_vigencia"=>$this->fecha_vigencia,
            "archivo_adjunto" => $this->archivo,
            "estado" => 1
        );
        if ($this->db->insert('renarhed_certificaciones_personal', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function registrarLaboral() {
        $data = array(
            "idrenarhed"=>$this->idrenarhed,
            "codigo_institucion"=>$this->codigo_institucion,
            "codigo_region"=>$this->codigo_region,
            "codigo_disa"=>$this->codigo_disa,
            "codigo_red"=>$this->codigo_red,
            "codigo_micro_red"=>$this->codigo_micro_red,
            "codigo_renipress"=>$this->codigo_renipress,
            "codigo_condicion"=>$this->codigo_condicion,
            "estado" => 1
        );
        if ($this->db->insert('renarhed_laboral_personal', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function getInformacionLaboral() {
        $this->db->select("*");
        $this->db->from("renarhed_laboral_personal");
        $this->db->where("idrenarhed", $this->idrenarhed);
        $this->db->where("estado","1");
        return $this->db->get();
    }
    public function registrarCapacitacionPersonal() {
        $data = array(
            "idrenarhed"=>$this->idrenarhed,
            "tipo_capacitacion"=>$this->tipo_capacitacion,
            "nombre"=>$this->nombre,
            "institucion"=>$this->institucion,
            "horas"=>$this->horas,
            "fecha_emision"=>$this->fecha_emision,
            "estado" => 1
        );
        if ($this->db->insert('renarhed_capacitaciones_personal', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
     public function registrarInmunizacionPersonal() {
        $data = array(
            "idrenarhed"=>$this->idrenarhed,
            "tipo_inmunizacion"=>$this->tipo_inmunizacion,
            "nombre"=>$this->nombre,
            "numero_dosis"=>$this->numero_dosis,
            "fecha_vacuna"=>$this->fecha_vacuna,
            "estado" => 1
        );
        if ($this->db->insert('renarhed_inmunizaciones_personal', $data))
            return $this->db->insert_id();
            else
                return 0;
    }
    public function agregarFileCarreras()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("archivo_titulo", $this->archivo_titulo, TRUE);
        $this->db->set("archivo_especialidad", $this->archivo_especialidad, TRUE);
        $this->db->where("idcarreras", $this->idcarreras);
        $error = array();
        if ($this->db->update('renarhed_carreras_personal'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function agregarFileCertificaciones()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("archivo_adjunto", $this->archivo_adjunto, TRUE);
        $this->db->where("idcertificaciones", $this->idcertificaciones);
        $error = array();
        if ($this->db->update('renarhed_certificaciones_personal'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function agregarFileVacunaciones()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("tarjeta_vacunas", $this->tarjeta_vacunas, TRUE);
        $this->db->where("idrenarhed", $this->idrenarhed);
        $error = array();
        if ($this->db->update('renarhed_registro'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function agregarFileInmunizaciones()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("archivo_adjunto", $this->archivo_adjunto, TRUE);
        $this->db->where("idinmunizacion", $this->idinmunizacion);
        $error = array();
        if ($this->db->update('renarhed_inmunizaciones_personal'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function agregarFileCapacitaciones()
    {
        $this->db->db_debug = FALSE;
        $this->db->set("archivo_adjunto", $this->archivo_adjunto, TRUE);
        $this->db->where("idcapacitacion", $this->idcapacitacion);
        $error = array();
        if ($this->db->update('renarhed_capacitaciones_personal'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function totalResumenRegistros(){ 
        $this->db->select("*");
        $this->db->from("getresumenregistrosrenarhed"); 
        return $this->db->get();
    }
    public function registrarComision() {
        $data = array(
            "codigo_region" => $this->regioncomision,
            "tipo" => $this->tipocomision, 
            "codigo_tipo_evento" => $this->tipoEventocomision,
            "codigo_evento" => $this->eventocomision, 
            "codigo_evento_detalle" => $this->eventoDetallecomision, 
            "evento_registro_numero" => $this->numeroEventocomision,
            "descripcion" => $this->descripcioncomision,
            "fecha_inicio" => $this->fechaIniciocomision,
            "fecha_fin" => $this->fechaFincomision,
            "comision_anio" => $this->aniocomision,
            "comision_mes" => $this->mescomision,
            "archivo_adjunto" => $this->fichaTecnicaComision,
            "usuario_registro" => $this->session->userdata("idusuario"),
            "fecha_registro" => date("Y-m-d H:i:s"),
            "estado" => "1",
        );
        if($this->db->insert("renarhed_comisiones", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function actualizarComision()
    {
        $this->db->set("codigo_region", $this->regioncomision, TRUE);
        $this->db->set("tipo", $this->tipocomision, TRUE);
        $this->db->set("codigo_tipo_evento", $this->tipoEventocomision, TRUE);
        $this->db->set("codigo_evento", $this->eventocomision, TRUE);
        $this->db->set("codigo_evento_detalle", $this->eventoDetallecomision, TRUE);
        $this->db->set("evento_registro_numero", $this->numeroEventocomision, TRUE);
        $this->db->set("descripcion", $this->descripcioncomision, TRUE);
        $this->db->set("fecha_inicio", $this->fechaIniciocomision, TRUE);
        $this->db->set("fecha_fin", $this->fechaFincomision, TRUE);
        $this->db->set("comision_anio", $this->aniocomision, TRUE);
        $this->db->set("comision_mes", $this->mescomision, TRUE);
        $this->db->set("Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
        $this->db->set("Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
        if($this->fichaTecnicaComision){
            $this->db->set("archivo_adjunto", $this->fichaTecnicaComision, TRUE);
        }
        $this->db->where("idcomision", $this->idcomision);
        $error = array();
        if ($this->db->update('renarhed_comisiones'))
            return 1;
        else {
            $error = $this->db->error();
            return $error["code"];
        }
    }
    public function guardarDetalleComision()
    {
        $data = array(
            "idcomision" => $this->idcomision,
            "idrenarhed" => $this->idrenarhedcomi,
            "idfuncion" => $this->funcioncomi,
            "rendido" => 0,
            "estado" => 1
        );
        if($this->db->insert("renarhed_comisiones_detalle", $data)) {
            return $this->db->insert_id();
        }
        else {
            return 0;
        }
    }
    public function eliminarDetalleComision()
    {
        $this->db->db_debug = FALSE;
        $this->db->where("idcomision", $this->idcomision);
        $error = array();
        if ($this->db->delete('renarhed_comisiones_detalle'))
            return 1;
            else {
                $error = $this->db->error();
                return $error["code"];
            }
    }
    public function obtenerDetalleListaComisiones()
    {
        $this->db->select("rcd.idcomision, rr.idrenarhed, rr.apellidos, rr.nombres, rr.numero_documento, rf.funcion as funcionnomb, rf.idfuncion as idfuncion");
        $this->db->from("renarhed_comisiones_detalle rcd, renarhed_registro rr, renarhed_funcion rf");
        $this->db->where("rcd.idrenarhed = rr.idrenarhed");
        $this->db->where("rcd.idfuncion = rf.idfuncion");
        $this->db->where("rcd.idcomision", $this->idcomision);
        return $this->db->get();
    }
}