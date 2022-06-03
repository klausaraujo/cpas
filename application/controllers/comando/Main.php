<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main extends CI_Controller
{

    private $_permisos = null;

    function __construct()
    {
        parent::__construct();
        
        $token = $this->session->userdata("token");
        
        (strlen($token)>0)?$token = JWT::decode($token, getenv("SECRET_SERVER_KEY")):redirect("login");
        
        $this->session->set_userdata("idmodulo", 20);
        
        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
        
        if (sha1($usuario)==$token->usuario) {

            if (count($token->modulos)>0) {

                $listaModulos = $token->modulos;
                
                $permanecer = false;

                foreach ($listaModulos as $row) :
                    if ($row->idmodulo == 20 and $row->estado == 1) {
                        $permanecer = true;
                    }
                endforeach;

                if ($permanecer == false) {
                    redirect('errores/accesoDenegado');
                }

            } else {
                redirect("login");
            }
            
            if ($this->_permisos==null) { 
                if ($this->session->userdata("menu")) {
                    $this->_permisos = $this->session->userdata("menu");
                }
            }
            
        } else {
            redirect("login");
        }
    }

    public function index()
    {
        
        $nivel = 1;
        $idmenu = 7;
        
        validarPermisos($nivel, $idmenu, $this->_permisos);
        
        $this->load->model("Comando_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AnioEjecucion_model");
        /*$this->load->model("EventoTipo_model");
        
        $this->load->model("AlertaPronostico_model");*/
        
         
        //$tipo = $this->EventoTipo_model->lista();
        //$lista = $this->Brigadista_model->listar();
          
        $lista = $this->Comando_model->listaComando();
        $regiones = $this->Ubigeo_model->obtenerRegiones();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        
        /*
        $diresa = $this->Brigadista_model->diresa();  
        $capacionones = $this->Brigadista_model->listaCursos();
        $profesiones = $this->Brigadista_model->listaProfesiones();
        
        $listaEventos = $this->Brigadista_model->brigadistas_eventos();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $totalResumenRegistros = $this->Brigadista_model->totalResumenRegistros()->row();*/

        $data = array(
            //"tipo" => $tipo->result(),
            "lista" => json_encode($lista->result()),    
            "regiones" => $regiones->result(),
            "listaAnioEjecucion" => $listaAnioEjecucion
        /*
            "listaProfesiones" => $profesiones,
            "listaCapacitaciones" => $capacionones,
            "diresa" => $diresa,
            "listaEventos" => $listaEventos,
            "listaralerta" => $listaralerta,
            "totalResumenRegistros" => $totalResumenRegistros*/
        );
        
        $this->load->view("comando/Main", $data);
    }
    
    public function cargarUnidadEjecutora()
    {
        $this->load->model("Indicador_model");
        
        $region = $this->input->post("region");
        $lista = $this->Indicador_model->setRegion($region);
        $lista = $this->Indicador_model->listaUnidadEjecutora();
        
        $data = array(
            "lista" => $lista->result()
        );
        echo json_encode($data);
    }

    public function cargaformreg()
    {
        $this->load->model("Indicador_model");
        
        //$region = $this->input->post("region");
        //$lista = $this->Indicador_model->setRegion($region);
        $listai = $this->Indicador_model->listaindicadorcalcreg();
        
        // $data = array(
        //     "listai" => $listai->result()
        // );
        echo json_encode($listai->result());
    }

    public function maincomisiones()
    {
        
        $nivel = 1;
        $idmenu = 29;
        
        validarPermisos($nivel, $idmenu, $this->_permisos);
        
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Brigadista_model");
        $this->load->model("EventoTipo_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("AlertaPronostico_model");
        
         
        $tipo = $this->EventoTipo_model->lista();
        //$lista = $this->Brigadista_model->listar();  
        $lista = $this->Brigadista_model->listarComisiones();
        
        $anioPredeterminado = $this->AnioEjecucion_model->obtenerAnioPredeterminado();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $diresa = $this->Brigadista_model->diresa();  
        $capacionones = $this->Brigadista_model->listaCursos();
        $profesiones = $this->Brigadista_model->listaProfesiones();
        $departamentos = $this->Ubigeo_model->departamentos();
        $regiones = $this->Ubigeo_model->obtenerRegiones();
        $listaEventos = $this->Brigadista_model->brigadistas_eventos();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        if (empty($anio) or strlen($anio) < 1) {
            $rsListaAnioEjecucion = $anioPredeterminado->row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $totalResumenRegistros = $this->Brigadista_model->totalResumenRegistros()->row();

        $data = array(
            "tipo" => $tipo->result(),
            "lista" => json_encode($lista->result()),
            "departamentos" => $departamentos,
            "regiones" => $regiones->result(),
            "listaProfesiones" => $profesiones,
            "listaCapacitaciones" => $capacionones,
            "diresa" => $diresa,
            "listaEventos" => $listaEventos,
            "listaralerta" => $listaralerta,
            "totalResumenRegistros" => $totalResumenRegistros,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "anio" => $anio
        );
        
        $this->load->view("brigadistas/Maincomisiones", $data);
    }

    public function obtenerListaComision(){
        $this->load->model("Brigadista_model");

        $listarComisiones = $this->Brigadista_model->listarComisiones();
        $detalle = array(
          "listarComisiones" => $listarComisiones->num_rows()? $listarComisiones->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtenerListaRenarhed(){
        $this->load->model("Brigadista_model");

        $listarComisionesRenarhed = $this->Brigadista_model->listarComisionesRenarhed();
        $detalle = array(
          "listarComisionesRenarhed" => $listarComisionesRenarhed->num_rows()? $listarComisionesRenarhed->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function listaSedesFiltro() {
        
        $this->load->model("Brigadista_model");
        $id = $this->input->post("id");
        $type = $this->input->post("type");
        $this->Brigadista_model->setId($id);
        
        $lista = array();
        
        if ($type == 1) {
            $lista = $this->Brigadista_model->brigadistas_clusters();
            $lista = $lista->result();
        } else {
            $lista = $this->Brigadista_model->brigadistas_sedes();
            $lista = $lista->result();
        }
        
        echo json_encode($lista);
        
    }

    public function listaEspecialidades()
    {

        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $this->Brigadista_model->setBrigadistas_profesiones_id($id);
        $especialidades = $this->Brigadista_model->listaEspecialidades();
        
        echo json_encode(array("especialidades"=>$especialidades->result()));
        
    }

    public function profesiones()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $this->Brigadista_model->setId($id);
        $profesiones = $this->Brigadista_model->profesionesBrigadista();
        
        echo json_encode(array("profesiones"=>$profesiones->result()));
        
    }

    public function registrarEspecialidad()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $brigadistas_especialidad_id = $this->input->post("brigadistas_especialidad_id");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setBrigadistas_especialidad_id($brigadistas_especialidad_id);
        
        $find = $this->Brigadista_model->buscarEspecialidad();        
        if ($find->num_rows()>0) {
            $status = 201;
        } else {
            $id = $this->Brigadista_model->registrarEspecialidad();
            if ($id>0) {
                $status = 200;
            }
        }
        
        echo json_encode(array("status"=>$status,"id"=>$id));
        
    }

    public function eliminarEspecialidad()
    {

        $this->load->model("Brigadista_model");

        $id = $this->input->post("id");

        $status = 500;
        $this->Brigadista_model->setId($id);
        if ($this->Brigadista_model->eliminarEspecialidad() == 1 ) {
            $this->session->set_flashdata('messageOK', 'Registro eliminado');
        } else {
            $this->session->set_flashdata('messageError', 'No se puede eliminar'); 
        }

        redirect('brigadistas');

    }

    public function anuindicadores()
    {
        $this->load->model("Indicador_model");

        $idregistro = $this->input->post("idregistro");

        $this->Indicador_model->setIdregistro($idregistro);
        //$file = $this->fileName($id);
        if ($this->Indicador_model->anularindicador() == 1) {
            //$this->deleteFile($file);
            $this->session->set_flashdata('mensajeWarning', 'Registro Anulado con éxito.');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo Anular el Registro.');
        }

        header("location:" . base_url() . "indicadoresppr/main");
    }

    public function nuevo() 
    {
        
        $nivel = 1;
        $idmenu = 8;
        
        validarPermisos($nivel, $idmenu, $this->_permisos);
        
        $this->load->model("Ubigeo_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("Brigadista_model");
        $this->load->model("AlertaPronostico_model");
        
        $departamentos = $this->Ubigeo_model->departamentos();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $bancos = $this->Brigadista_model->bancos();
        $idiomas = $this->Brigadista_model->idiomas();
        $bancosnew = $this->Brigadista_model->bancosnew();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "departamentos" => $departamentos->result(),
            "tipodocumento" => $tipodocumento,
            "listaBancos" => $bancos,
            "listaIdiomas" => $idiomas,
            "listaBancosnew" => $bancosnew,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("brigadistas/nuevo", $data);
        
    }

    public function registrar()
    {  
        
        $this->load->model("Brigadista_model");

        //$data  = $this->input->post(); var_dump($data);exit;
        $verif_foto = 1; //1 es Reniec, 2 es File
        $foto = $_FILES["file"];
        $verif_foto = (filesize($foto["tmp_name"]) > 0)  ? 2 : 1;//verificando si se cargó imagen con input file
        //var_dump($verif_foto);exit;
        $foto_str = $this->input->post('foto_dni_str');       

        $apellidos = $this->input->post("apellidos");
        $nombres = $this->input->post("nombres");
        $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
        $Tipo_Documento_Codigo_C = $this->input->post("Tipo_Documento_Codigo_C");
        $documento_numero = $this->input->post("documento_numero");
        $genero = $this->input->post("genero");
        $fecha_nacimiento = $this->input->post("fecha_nacimiento");
        $edad = $this->input->post("edad");
        $estado_civil = $this->input->post("estado_civil");
        $pasaporte = $this->input->post("pasaporte");
        $caducidad_pasaporte = $this->input->post("caducidad_pasaporte");
        
        //$foto = $_FILES["file"];
        //$dataFoto = $this->agregarFoto($foto);
        $domicilio = $this->input->post("domicilio");
        $telefono_01 = $this->input->post("telefono_01");
        $telefono_02 = $this->input->post("telefono_02");
        $telefono_03 = $this->input->post("telefono_03");
        $email = $this->input->post("email");
        $email_institucional = $this->input->post("email_institucional");
        $Categoria = $this->input->post("Categoria");
        $observacion = $this->input->post("observacion");
        $idinstitucion = $this->input->post("idinstitucion");
        
        
       // $idioma_ingles = ($this->input->post("idioma_ingles"))?$this->input->post("idioma_ingles"):0;
       // $idioma_quechua = ($this->input->post("idioma_quechua"))?$this->input->post("idioma_quechua"):0;
       // $idioma_aimara = ($this->input->post("idioma_aimara"))?$this->input->post("idioma_aimara"):0;
       // $idioma_otros = $this->input->post("idioma_otros");
        
        $contacto_emergencia = $this->input->post("contacto_emergencia");
        $telefono_emergencia_01 = $this->input->post("telefono_emergencia_01");
        $telefono_emergencia_02 = $this->input->post("telefono_emergencia_02");
        $telefono_emergencia_03 = $this->input->post("telefono_emergencia_03");
        $parentesco = $this->input->post("parentesco");

        $apellidos_contacto = $this->input->post("apellidos_contacto");
        $nombres_contacto = $this->input->post("nombres_contacto");


        $grupo_sanguineo = $this->input->post("grupo_sanguineo");
      //  $alergias = $this->input->post("alergias");
      //  $intervenciones_quirurgica = $this->input->post("intervenciones_quirurgica");
      //  $antecedentes_medicos = $this->input->post("antecedentes_medicos");
          $talla = $this->input->post("talla");
          $imc = $this->input->post("imc");
          $peso = $this->input->post("peso");
      //  $vacuna_tetano = ($this->input->post("vacuna_tetano"))?$this->input->post("vacuna_tetano"):0;
      //  $vacuna_fiebre_amarilla = ($this->input->post("vacuna_fiebre_amarilla"))?$this->input->post("vacuna_fiebre_amarilla"):0;
      //  $vacuna_hepatitis_b = ($this->input->post("vacuna_hepatitis_b"))?$this->input->post("vacuna_hepatitis_b"):0;
      //  $vacuna_influenza = ($this->input->post("vacuna_influenza"))?$this->input->post("vacuna_influenza"):0;
      //  $vacuna_sarampion = ($this->input->post("vacuna_sarampion"))?$this->input->post("vacuna_sarampion"):0;
      //  $vacuna_papiloma = ($this->input->post("vacuna_papiloma"))?$this->input->post("vacuna_papiloma"):0;
      //  $vacunas_otras = $this->input->post("vacunas_otras");
        $usuario_registro = $this->input->post("usuario_registro");
        $fecha_registro = $this->input->post("fecha_registro");
        
     //   $talla_casaca = $this->input->post("talla_casaca");
     //   $talla_calzado = $this->input->post("talla_calzado");
     //   $talla_polo = $this->input->post("talla_polo");
     //   $talla_pantalon = $this->input->post("talla_pantalon");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $brigadistas_banco_id = $this->input->post("brigadistas_banco_id");
        $ididioma = $this->input->post("ididioma");
        $numero_cuenta = $this->input->post("numero_cuenta");
        $numero_cci = $this->input->post("numero_cci");
        
        $ubigeo_domicilio = $departamento.$provincia.$distrito;
        
        $fecha_nacimiento = formatearFechaParaBD($fecha_nacimiento);
        
        $this->Brigadista_model->setApellidos($apellidos);
        $this->Brigadista_model->setNombres($nombres);
        $this->Brigadista_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
        $this->Brigadista_model->setTipo_Documento_Codigo_C($Tipo_Documento_Codigo_C);
        $this->Brigadista_model->setDocumento_numero($documento_numero);
        $this->Brigadista_model->setGenero($genero);
        $this->Brigadista_model->setFecha_nacimiento($fecha_nacimiento);
        $this->Brigadista_model->setEdad($edad);
        $this->Brigadista_model->setEstado_civil($estado_civil);
        $this->Brigadista_model->setPasaporte($pasaporte);
        $this->Brigadista_model->setCaducidad_pasaporte($caducidad_pasaporte);
        

        $this->Brigadista_model->setCategoria($Categoria);
        $this->Brigadista_model->setDomicilio($domicilio);
        $this->Brigadista_model->setUbigeo_domicilio($ubigeo_domicilio);
        $this->Brigadista_model->setTelefono_01($telefono_01);
        $this->Brigadista_model->setTelefono_02($telefono_02);
        $this->Brigadista_model->setTelefono_03($telefono_03);
        $this->Brigadista_model->setEmail($email);
        $this->Brigadista_model->setEmail_institucional($email_institucional);
     //   $this->Brigadista_model->setIdioma_ingles($idioma_ingles);
     //   $this->Brigadista_model->setIdioma_quechua($idioma_quechua);
     //   $this->Brigadista_model->setIdioma_aimara($idioma_aimara);
     //   $this->Brigadista_model->setIdioma_otros($idioma_otros);
        $this->Brigadista_model->setContacto_emergencia($contacto_emergencia);
        $this->Brigadista_model->setTelefono_emergencia_01($telefono_emergencia_01);
        $this->Brigadista_model->setTelefono_emergencia_02($telefono_emergencia_02);
        $this->Brigadista_model->setTelefono_emergencia_03($telefono_emergencia_03);
        $this->Brigadista_model->setParentesco($parentesco);
        $this->Brigadista_model->setApellidos_contacto($apellidos_contacto);
        $this->Brigadista_model->setNombres_contacto($nombres_contacto);
        
        $this->Brigadista_model->setObservacion($observacion);
        $this->Brigadista_model->setIdinstitucion($idinstitucion);

          $this->Brigadista_model->setGrupo_Sanguineo($grupo_sanguineo);
     //   $this->Brigadista_model->setAlergias($alergias);
     //   $this->Brigadista_model->setIntervenciones_quirurgica($intervenciones_quirurgica);
     //   $this->Brigadista_model->setAntecedentes_medicos($antecedentes_medicos);
          $this->Brigadista_model->setTalla($talla);
          $this->Brigadista_model->setImc($imc);
          $this->Brigadista_model->setPeso($peso);
     //   $this->Brigadista_model->setVacuna_tetano($vacuna_tetano);
     //   $this->Brigadista_model->setVacuna_fiebre_amarilla($vacuna_fiebre_amarilla);
     //   $this->Brigadista_model->setVacuna_hepatitis_b($vacuna_hepatitis_b);
     //   $this->Brigadista_model->setVacuna_influenza($vacuna_influenza);
     //   $this->Brigadista_model->setVacuna_sarampion($vacuna_sarampion);
     //   $this->Brigadista_model->setVacuna_papiloma($vacuna_papiloma);
      //  $this->Brigadista_model->setVacunas_otras($vacunas_otras);        
                
     //   $this->Brigadista_model->setTalla_casaca($talla_casaca);
     //   $this->Brigadista_model->setTalla_calzado($talla_calzado);
     //   $this->Brigadista_model->setTalla_polo($talla_polo);
     //   $this->Brigadista_model->setTalla_pantalon($talla_pantalon);
        
         $this->Brigadista_model->setBrigadistas_banco_id($brigadistas_banco_id);
         $this->Brigadista_model->setIdidioma($ididioma);
         $this->Brigadista_model->setNumero_cuenta($numero_cuenta);
         $this->Brigadista_model->setNumero_cci($numero_cci);

        $count = $this->Brigadista_model->existe_renarhed();
 
        
        if (strlen($apellidos)<1 or strlen($nombres)<1 or strlen($Tipo_Documento_Codigo)<1
            or strlen($documento_numero)<1 or strlen($genero)<1 or strlen($fecha_nacimiento)<1
        ) {
                $data = array(
                    "status" => 500
                );
        } else {
        //si esxiste un registro duplicado
            if ($count>0) {
                $data = array(
                    "status" => 201
                );
            } else {
                //tran begin
                $id = $this->Brigadista_model->registrar();
                 
                if ($id>0) {
                    if($verif_foto == 1){                        
                        $filename_foto = $this->agregarFotoReniec($foto_str);//recien creamos la foto en la carpeta
                        $this->Brigadista_model->setIdrenarhed($id);
                        $this->Brigadista_model->setFoto_renarhed($filename_foto);
                        $this->Brigadista_model->agregarFotoRenarhed();
                    }else{
                        $response_foto = $this->agregarFoto($foto); //recien movemos la foto a la carpeta
                        if ($response_foto["estado"] == 0){
                            $this->Brigadista_model->setIdrenarhed($id);
                            $this->Brigadista_model->setFoto_renarhed($response_foto["foto"]);
                            $this->Brigadista_model->agregarFotoRenarhed();
                        }                        
                    }
                   /* if ($dataFoto["estado"] == 0) {
                        $this->Brigadista_model->setId($id);
                        $this->Brigadista_model->setFoto($dataFoto["foto"]);
                        $this->Brigadista_model->agregarFoto();
                    }*/
                    //trans commit
                    $data = array(
                        "status" => 200
                    );
                    
                } else {
                    //trasn rollback
                    $data = array(
                        "status" => 500
                    );
                }
            }
       
        }
            
        echo json_encode($data);
    }

    public function edicion()
    {
        
        $this->load->model("Brigadista_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("AlertaPronostico_model");
        
        $id = $this->input->post("id");
        
        $this->Brigadista_model->setId($id);
        $brigadista = $this->Brigadista_model->brigadista();
        $bancos = $this->Brigadista_model->bancos();
        $bancosnew = $this->Brigadista_model->bancosnew();
        $brigadista = $brigadista->row();
        
        $departamento = substr($brigadista->ubigeo_domicilio, 0, 2);
        $provincia = substr($brigadista->ubigeo_domicilio, 2, 2);
        $distrito = substr($brigadista->ubigeo_domicilio, 4, 2);
        
        $this->Ubigeo_model->setCodigo_Departamento(substr($brigadista->ubigeo_domicilio, 0, 2));
        $this->Ubigeo_model->setCodigo_Provincia(substr($brigadista->ubigeo_domicilio, 2, 2));
        $departamentos = $this->Ubigeo_model->departamentos();
        $provincias = $this->Ubigeo_model->provincias();
        $distritos = $this->Ubigeo_model->distritos();
        
        $tipodocumento = $this->TipoDocumento_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
     
        $data = array(
            "brigadista" => $brigadista,
            "departamentos" => $departamentos->result(),
            "provincias" => $provincias->result(),
            "distritos" => $distritos->result(),
            "departamento" => $departamento,
            "provincia" => $provincia,
            "distrito" => $distrito,
            "tipodocumento" => $tipodocumento,
            "listaBancos" => $bancos,
            "listaBancosnew" => $bancosnew,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("brigadistas/editar", $data);
        
    }

    public function editar()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");

        $verif_foto = 0; //1 es Reniec, 2 es File, 0 no se ha modificado
        $foto = $_FILES["file"];
        $foto_str = $this->input->post('foto_dni_str'); 
        
        
        if(filesize($foto["tmp_name"]) == false && $foto_str ==""){
            $verif_foto = 0;
        }else if(filesize($foto["tmp_name"]) > 0){
            $verif_foto = 2;
        }else if($foto_str !=""){
            $verif_foto = 1;
        }
        //var_dump($verif_foto);exit;
         

        $apellidos = $this->input->post("apellidos");
        $nombres = $this->input->post("nombres");
        $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
        $documento_numero = $this->input->post("documento_numero");
        $Tipo_Documento_Codigo_C = $this->input->post("Tipo_Documento_Codigo_C");
        $genero = $this->input->post("genero");
        $fecha_nacimiento = $this->input->post("fecha_nacimiento");
        $edad = $this->input->post("edad");
        $estado_civil = $this->input->post("estado_civil");
        $pasaporte = $this->input->post("pasaporte");
        $caducidad_pasaporte = $this->input->post("caducidad_pasaporte");
        $caducidad_pasaporte = formatearFechaParaBD($caducidad_pasaporte);
        $observacion = $this->input->post("observacion");
        $idinstitucion = $this->input->post("idinstitucion");

        $domicilio = $this->input->post("domicilio");        
        $telefono_01 = $this->input->post("telefono_01");
        $telefono_02 = $this->input->post("telefono_02");
        $telefono_03 = $this->input->post("telefono_03");
        $email = $this->input->post("email");
        $email_institucional = $this->input->post("email_institucional");
        

        $Categoria = $this->input->post("Categoria");
        
     //   $idioma_ingles = ($this->input->post("idioma_ingles"))?$this->input->post("idioma_ingles"):0;
     //   $idioma_quechua = ($this->input->post("idioma_quechua"))?$this->input->post("idioma_quechua"):0;
     //   $idioma_aimara = ($this->input->post("idioma_aimara"))?$this->input->post("idioma_aimara"):0;
     //   $idioma_otros = $this->input->post("idioma_otros");
        
        
        $contacto_emergencia = $this->input->post("contacto_emergencia");
        $telefono_emergencia_01 = $this->input->post("telefono_emergencia_01");
        $telefono_emergencia_02 = $this->input->post("telefono_emergencia_02");
        $telefono_emergencia_03 = $this->input->post("telefono_emergencia_03");
        $parentesco = $this->input->post("parentesco");
        $apellidos_contacto = $this->input->post("apellidos_contacto");
        $nombres_contacto = $this->input->post("nombres_contacto");
        
        $grupo_sanguineo = $this->input->post("grupo_sanguineo");
        //$alergias = $this->input->post("alergias");
        //$intervenciones_quirurgica = $this->input->post("intervenciones_quirurgica");
        //$antecedentes_medicos = $this->input->post("antecedentes_medicos");
        $talla = $this->input->post("talla");
        $peso = $this->input->post("peso");
        $imc = $this->input->post("imc");
        //$vacuna_tetano = ($this->input->post("vacuna_tetano"))?$this->input->post("vacuna_tetano"):0;
        //$vacuna_fiebre_amarilla = ($this->input->post("vacuna_fiebre_amarilla"))?$this->input->post("vacuna_fiebre_amarilla"):0;
        //$vacuna_hepatitis_b = ($this->input->post("vacuna_hepatitis_b"))?$this->input->post("vacuna_hepatitis_b"):0;
        //$vacuna_influenza = ($this->input->post("vacuna_influenza"))?$this->input->post("vacuna_influenza"):0;
        //$vacuna_sarampion = ($this->input->post("vacuna_sarampion"))?$this->input->post("vacuna_sarampion"):0;
        //$vacuna_papiloma = ($this->input->post("vacuna_papiloma"))?$this->input->post("vacuna_papiloma"):0;
        //$vacunas_otras = $this->input->post("vacunas_otras");
                
        //$talla_casaca = $this->input->post("talla_casaca");
        //$talla_calzado = $this->input->post("talla_calzado");
        //$talla_polo = $this->input->post("talla_polo");
        //$talla_pantalon = $this->input->post("talla_pantalon");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $brigadistas_banco_id = $this->input->post("brigadistas_banco_id");
        $ididioma = $this->input->post("ididioma");
        $numero_cuenta = $this->input->post("numero_cuenta");
        $numero_cci = $this->input->post("numero_cci");
        
        $ubigeo_domicilio = $departamento.$provincia.$distrito;
        
        $fecha_nacimiento = formatearFechaParaBD($fecha_nacimiento);
                
        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setApellidos($apellidos);
        $this->Brigadista_model->setNombres($nombres);
        $this->Brigadista_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
        $this->Brigadista_model->setTipo_Documento_Codigo_C($Tipo_Documento_Codigo_C);
        $this->Brigadista_model->setDocumento_numero($documento_numero);
        $this->Brigadista_model->setGenero($genero);
        $this->Brigadista_model->setFecha_nacimiento($fecha_nacimiento);
        $this->Brigadista_model->setEdad($edad);
        $this->Brigadista_model->setPasaporte($pasaporte);
        $this->Brigadista_model->setCaducidad_pasaporte($caducidad_pasaporte);
        $this->Brigadista_model->setCategoria($Categoria);
        $this->Brigadista_model->setEstado_civil($estado_civil);
    

        $this->Brigadista_model->setDomicilio($domicilio);
        $this->Brigadista_model->setUbigeo_domicilio($ubigeo_domicilio);
        $this->Brigadista_model->setTelefono_01($telefono_01);
        $this->Brigadista_model->setTelefono_02($telefono_02);
        $this->Brigadista_model->setTelefono_03($telefono_03);
        $this->Brigadista_model->setEmail($email);
        $this->Brigadista_model->setEmail_institucional($email_institucional);
        //$this->Brigadista_model->setIdioma_ingles($idioma_ingles);
        //$this->Brigadista_model->setIdioma_quechua($idioma_quechua);
        //$this->Brigadista_model->setIdioma_aimara($idioma_aimara);
        //$this->Brigadista_model->setIdioma_otros($idioma_otros);
        $this->Brigadista_model->setContacto_emergencia($contacto_emergencia);
        $this->Brigadista_model->setTelefono_emergencia_01($telefono_emergencia_01);
        $this->Brigadista_model->setTelefono_emergencia_02($telefono_emergencia_02);
        $this->Brigadista_model->setTelefono_emergencia_03($telefono_emergencia_03);
        $this->Brigadista_model->setParentesco($parentesco);
        $this->Brigadista_model->setApellidos_contacto($apellidos_contacto);
        $this->Brigadista_model->setNombres_contacto($nombres_contacto);
        $this->Brigadista_model->setGrupo_Sanguineo($grupo_sanguineo);
        //$this->Brigadista_model->setAlergias($alergias);
        //$this->Brigadista_model->setIntervenciones_quirurgica($intervenciones_quirurgica);
        //$this->Brigadista_model->setAntecedentes_medicos($antecedentes_medicos);
        $this->Brigadista_model->setTalla($talla);
        $this->Brigadista_model->setPeso($peso);
        $this->Brigadista_model->setImc($imc);
        /*$this->Brigadista_model->setVacuna_tetano($vacuna_tetano);
        $this->Brigadista_model->setVacuna_fiebre_amarilla($vacuna_fiebre_amarilla);
        $this->Brigadista_model->setVacuna_hepatitis_b($vacuna_hepatitis_b);
        $this->Brigadista_model->setVacuna_influenza($vacuna_influenza);
        $this->Brigadista_model->setVacuna_sarampion($vacuna_sarampion);
        $this->Brigadista_model->setVacuna_papiloma($vacuna_papiloma);
        $this->Brigadista_model->setVacunas_otras($vacunas_otras);
        
        $this->Brigadista_model->setTalla_casaca($talla_casaca);
        $this->Brigadista_model->setTalla_calzado($talla_calzado);
        $this->Brigadista_model->setTalla_polo($talla_polo);
        $this->Brigadista_model->setTalla_pantalon($talla_pantalon);*/
        
        $this->Brigadista_model->setBrigadistas_banco_id($brigadistas_banco_id);
        $this->Brigadista_model->setIdidioma($ididioma);
        $this->Brigadista_model->setNumero_cuenta($numero_cuenta);
        $this->Brigadista_model->setNumero_cci($numero_cci);
        $this->Brigadista_model->setObservacion($observacion);
        $this->Brigadista_model->setIdinstitucion($idinstitucion);
        
        
        if (strlen($id)<1 or strlen($apellidos)<1 or strlen($nombres)<1 or strlen($Tipo_Documento_Codigo)<1
            or strlen($documento_numero)<1 or strlen($genero)<1 or strlen($fecha_nacimiento)<1
        ) {
                $data = array(
                    "status" => 500
                );
        } else {
            if ($this->Brigadista_model->editarRenarhed()) {      
                //actualizando o registrando nueva imagen
                $enviar_imagen = $this->input->post("enviar_imagen");
                if($verif_foto > 0){
                    if($verif_foto == 1){                        
                        $filename_foto = $this->editarFotoReniec($foto_str, $enviar_imagen);//recien creamos la foto en la carpeta
                        $this->Brigadista_model->setIdrenarhed($id);
                        $this->Brigadista_model->setFoto_renarhed($filename_foto);
                        $this->Brigadista_model->agregarFotoRenarhed();
                    }else{
                        
                        $foto = $_FILES["file"];
                        $response_foto =$this->editarFoto($id, $foto, $enviar_imagen); //recien movemos la foto a la carpeta
                        if ($response_foto["estado"] == 0){
                            $this->Brigadista_model->setIdrenarhed($id);
                            $this->Brigadista_model->setFoto_renarhed($response_foto["foto"]);
                            $this->Brigadista_model->agregarFotoRenarhed();
                        }                        
                    }
                }

                $data = array(
                    "status" => 200
                );
                
            } else {
                $data = array(
                    "status" => 500
                );
            }
        }
        echo json_encode($data);
    }

    public function agregarFoto($foto)
    {
        $path = getenv('PATH_IMG_BRIGADISTA');
        $estado = 0;
        $imagen = "";
        
        if (filesize($foto["tmp_name"]) > 0) {            
            
            if ($foto["type"] == "image/jpeg" || $foto["type"] == "image/jpg" || $foto["type"] == "image/png" || $foto["type"] == "image/svg") {
                
                $name = date("Ymdhis");
                
                $data = $foto['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $imagen = $name . '.' . $ext;
                redim($foto["tmp_name"], $path.$name.'.'.$ext, 375, 508);
                
            } else {
                $estado = - 3;
                $message = ERROR_IMAGEN_FORMATO;
            }
        } else {
            $estado = -1;
        }
        
        return array("estado"=>$estado,"foto"=>$imagen);
        
    }

    public function editarFoto($id,$foto,$image)
    {
        $path = getenv('PATH_IMG_BRIGADISTA');
        $estado = 0;
        $imagen = "";
              
        
        if (filesize($foto["tmp_name"]) > 0) {           
            
            if ($foto["type"] == "image/jpeg" || $foto["type"] == "image/jpg" || $foto["type"] == "image/png" || $foto["type"] == "image/svg") {
                if(file_exists($path . $image)) unlink($path . $image); // delete image  
                
                $name = date("Ymdhis");
                
                $data = $foto['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $imagen = $name . '.' . $ext;
                redim($foto["tmp_name"], $path.$name.'.'.$ext, 375, 508);
                
            } else {
                $estado = - 3;
                $message = ERROR_IMAGEN_FORMATO;
            }
        } else {
            $estado = -1;
        }
        
        return array("estado"=>$estado,"foto"=>$imagen);
        
    }

    public function cargarArchivoCertificado($file, $update, $id)
    {
        $path = getenv('PATH_DOC_CERTIFICADO');
        
        if (filesize($file["tmp_name"]) > 0) {
            
            $name = "certificado_".date("Ymdhis");
            $data = $_FILES["file"]['name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $fullName = $name . '.' . $ext;
            
            $allowedMimeTypes = array("pdf","doc","docx","PDF","DOC","DOCX");
            
            if (in_array($ext, $allowedMimeTypes)) {
                
                if (copy($_FILES["file"]["tmp_name"], $path . $fullName)) {
                    
                    if ($update) {
                        $file = $this->fileName($id);
                        $this->deleteFile($file);
                    }
                    
                    return $fullName;
                } else {
                    return false;
                }
            } else{
                return false;
            }
            
        } else{
            return false;
        }
    }


    

    private function deleteFile($file)
    {
        $path = getenv('PATH_DOC_CERTIFICADO');
        if (strlen($file)>0 ){
            unlink($path . $file);
        }
        
    }

    private function fileName($id)
    {
        $this->load->model("Brigadista_model");
        $this->Brigadista_model->setId($id);
        $rs = $this->Brigadista_model->archivoCertificacion();
        $file = "";
        if ($rs->num_rows()>0) {
            $archivo = $rs->row();
            $file = $archivo->archivo;
        }
        
        return $file;
    }

 

    public function registrarCertificacion()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $tipo_certificacion = $this->input->post("tipo_certificacion");
        $fecha_reconocimiento = $this->input->post("fecha_reconocimiento");
        $resolucion = $this->input->post("resolucion");
        $fecha_inicio = $this->input->post("fecha_inicio");
        $fecha_vencimiento = $this->input->post("fecha_vencimiento");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setTipo_certificacion($tipo_certificacion);
        $this->Brigadista_model->setFecha_reconocimiento(formatearFechaParaBD($fecha_reconocimiento));
        $this->Brigadista_model->setResolucion($resolucion);
        $this->Brigadista_model->setFecha_inicio(formatearFechaParaBD($fecha_inicio));
        $this->Brigadista_model->setFecha_vencimiento(formatearFechaParaBD($fecha_vencimiento));
        
        $archivo = "";
        if (filesize($_FILES["file"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivoCertificado($_FILES["file"], false, 0);
        }

        if ($archivo==false) {
            $archivo = "";
        }

        $this->Brigadista_model->setArchivo($archivo);
        
        $find = $this->Brigadista_model->buscarCertificacion();
        if ($find->num_rows()>0) {
            $status = 201;
        } else {
            $id = $this->Brigadista_model->registrarCertificacion();
            if ($id>0) {
                $status = 200;
            }
        }
        
        
        echo json_encode(array("status"=>$status,"id"=>$id, "archivo"=>$archivo));
        
    }

    public function eliminarCertificacion()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        if($this->Brigadista_model->eliminarCertificacion() == 1 ) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        else { $this->session->set_flashdata('messageError', 'No se puede eliminar'); }
        
        redirect('brigadistas');
        
    }

    

    public function listaCapacitacion()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $this->Brigadista_model->setId($id);
        $capacitaciones = $this->Brigadista_model->listaCapacitacion();
        
        echo json_encode(array("capacitaciones"=>$capacitaciones->result()));
        
    }

    public function registrarCapacitacion()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $brigadistas_cursos_id = $this->input->post("brigadistas_cursos_id");
        $entidad = $this->input->post("entidad");
        $fecha_inicio = $this->input->post("fecha_inicio");
        $fecha_fin = $this->input->post("fecha_fin");
        $horas = $this->input->post("duracion");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setBrigadistas_cursos_id($brigadistas_cursos_id);
        $this->Brigadista_model->setEntidad($entidad);
        $this->Brigadista_model->setFecha_inicio(formatearFechaParaBD($fecha_inicio));
        $this->Brigadista_model->setFecha_fin(formatearFechaParaBD($fecha_fin));
        $this->Brigadista_model->setHoras($horas);
                
        $find = $this->Brigadista_model->buscarCapacitacion();
        if ($find->num_rows()>0) {
            $status = 201;
        } else {
            $id = $this->Brigadista_model->registrarCapacitacion();
            if ($id>0) {
                $status = 200;
            }
        }

        echo json_encode(array("status"=>$status,"id"=>$id));
        
    }

    public function eliminarCapacitacion()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        if ($this->Brigadista_model->eliminarCapacitacion() == 1 ) {
            $this->session->set_flashdata('messageOK', 'Registro eliminado');
        } else { 
            $this->session->set_flashdata('messageError', 'No se puede eliminar'); 
        }
        
        redirect('brigadistas');
        
    }

    public function listaEmergencias()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $this->Brigadista_model->setId($id);
        $emergencias = $this->Brigadista_model->listaEmergencia();
        
        echo json_encode(array("emergencias"=>$emergencias->result()));
        
    }

    public function registrarEmergencia()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $lider = $this->input->post("lider");
        $fuerza_tarea = $this->input->post("fuerza_tarea");
        $calificacion = $this->input->post("calificacion");
        $acciones_realizadas = $this->input->post("acciones_realizadas");
        $idevento = $this->input->post("idevento");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setLider($lider);
        $this->Brigadista_model->setFuerza_tarea($fuerza_tarea);
        $this->Brigadista_model->setCalificacion($calificacion);
        $this->Brigadista_model->setAcciones_realizadas($acciones_realizadas);
        $this->Brigadista_model->setEvento_Registro_Numero($idevento);
        
        $find = $this->Brigadista_model->buscarEmergencia();
        if ($find->num_rows()>0) {
            $status = 201;
        } else {
            $id = $this->Brigadista_model->registrarEmergencia();
            if ($id>0) {
                $status = 200;
            }
        }

        echo json_encode(array("status"=>$status,"id"=>$id));
        
    }

    public function eliminarEmergencia()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        if ($this->Brigadista_model->eliminarEmergencia() == 1 ) {
            $this->session->set_flashdata('messageOK', 'Registro eliminado');
        } else { 
            $this->session->set_flashdata('messageError', 'No se puede eliminar'); 
        }
        
        redirect('brigadistas');
        
    }

    public function listaContingencias()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $this->Brigadista_model->setId($id);
        $contingencias = $this->Brigadista_model->listaContingencias();
        
        echo json_encode(array("contingencias"=>$contingencias->result()));
        
    }

    public function registrarContingencia()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $lider = $this->input->post("lider");
        $fuerza_tarea = $this->input->post("fuerza_tarea");
        $calificacion = $this->input->post("calificacion");
        $acciones_realizadas = $this->input->post("acciones_realizadas");
        $idevento = $this->input->post("idevento");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setLider($lider);
        $this->Brigadista_model->setFuerza_tarea($fuerza_tarea);
        $this->Brigadista_model->setCalificacion($calificacion);
        $this->Brigadista_model->setAcciones_realizadas($acciones_realizadas);
        $this->Brigadista_model->setEvento_Registro_Numero($idevento);
        
        $find = $this->Brigadista_model->buscarContingencia();
        if ($find->num_rows()>0) {
            $status = 201;
        } else {
            $id = $this->Brigadista_model->registrarContingencia();
            if ($id>0) {
                $status = 200;
            }
        }
        
        echo json_encode(array("status"=>$status,"id"=>$id));
        
    }

    public function eliminarContingencia()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        if ($this->Brigadista_model->eliminarContingencia() == 1 ) {
            $this->session->set_flashdata('messageOK', 'Registro eliminado');
        } else { 
            $this->session->set_flashdata('messageError', 'No se puede eliminar'); 
        }
        
        redirect('brigadistas');
        
    }
    
    public function listaTrabajos()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $this->Brigadista_model->setId($id);
        $trabajos = $this->Brigadista_model->listaTrabajos();
        
        echo json_encode(array("trabajos"=>$trabajos->result()));
        
    }

    public function registrarTrabajo()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("idBrigadistaTrabajo");
        $DIRESA = $this->input->post("DIRESA");
        $Red = $this->input->post("Red");
        $MicroRed = $this->input->post("MicroRed");
        $CodEESS = $this->input->post("CodEESS");
        $oficina = $this->input->post("oficina");
        $condicion_laboral = $this->input->post("condicion_laboral");
        $cargo = $this->input->post("cargo");
        $telefono_institucional = $this->input->post("telefono_institucional");
        $email_institucional = $this->input->post("email_institucional");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setDIRESA($DIRESA);
        $this->Brigadista_model->setRed($Red);
        $this->Brigadista_model->setMicroRed($MicroRed);
        $this->Brigadista_model->setCodEESS($CodEESS);
        $this->Brigadista_model->setoficina($oficina);
        $this->Brigadista_model->setcondicion_laboral($condicion_laboral);
        $this->Brigadista_model->setcargo($cargo);
        $this->Brigadista_model->settelefono_institucional($telefono_institucional);
        $this->Brigadista_model->setemail_institucional($email_institucional);
        
        $find = $this->Brigadista_model->buscarTrabajo();
        if ($find->num_rows()>0) {
            $status = 201;
        } else {
            $id = $this->Brigadista_model->registrarTrabajo();
            if ($id>0) {
                $status = 200;
            }
        }
        
        echo json_encode(array("status"=>$status,"id"=>$id));
        
    }

    public function eliminarTrabajo()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        if ($this->Brigadista_model->eliminarTrabajo() == 1 ) {
            $this->session->set_flashdata('messageOK', 'Registro eliminado');
        } else {
            $this->session->set_flashdata('messageError', 'No se puede eliminar');
        }
        
        redirect('brigadistas');
        
    }
    
    public function cargarProvincias()
    {
        $this->load->model("Ubigeo_model");
        
        $departamento = $this->input->post("departamento");
        
        $this->Ubigeo_model->setCodigo_Departamento($departamento);
        
        $lista = $this->Ubigeo_model->provincias();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
    }

    public function cargarDistritos()
    {
        $this->load->model("Ubigeo_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        
        $this->Ubigeo_model->setCodigo_Departamento($departamento);
        $this->Ubigeo_model->setCodigo_Provincia($provincia);
        
        $lista = $this->Ubigeo_model->distritos();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
    }

    public function foto()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $this->Brigadista_model->setId($id);
        
        $foto = $this->Brigadista_model->foto();
        $imagen = "";
        $status = 500;
        if ($foto->num_rows()>0) {
            $foto = $foto->row();
            $imagen = $foto->foto;
            $status = 200;
        }
        
        echo json_encode(array("status"=>$status,"imagen"=>$imagen));

    }

    public function eventosAjax()
    {
        $this->load->model("EventoRegistrar_model");
        
        $evento_tipo = $this->input->post("evento_tipo");
        $evento_fecha = $this->input->post("evento_fecha");
        
        $data = array();
        
        if (strlen($evento_tipo) > 0 and strlen($evento_fecha) > 9) {
            
            $this->EventoRegistrar_model->setTipoEvento($evento_tipo);
            $this->EventoRegistrar_model->setFechaEvento(formatearFechaParaBD($evento_fecha));
            
            $lista = $this->EventoRegistrar_model->listaTipoFecha();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :

                    switch ($row->Evento_Estado_Codigo) {
                    case 1:$estado = '<span class="label label-success">Monitoreo</span>'; break;
                    case 2:$estado = '<span class="label label-default">Cerrado</span>'; break;
                    case 3:$estado = '<span class="label label-danger">Anulado</span>'; break;
                    }
                    $data[] = array(
                        "id" => $row->id,
                        "evento" => $row->evento,
                        "eventoDetalle" => $row->eventoDetalle,
                        "fecha" => $row->fecha,
                        "ubigeo" => $row->ubigeo,
                        "Evento_Estado_Codigo" => $estado
                    );
                    endforeach;
            }
        }

        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    public function curl()
    {
        
        $tipo_documento = $this->input->post("type");
        $documento = $this->input->post("document");
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, getenv("API_RENIEC_URL").$tipo_documento."/".$documento."/");
        curl_setopt($handler, CURLOPT_HEADER, false);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array("Authorization: ".getenv("API_RENIEC_TOKEN"),"Content-Type: application/json"));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($handler);
        $code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
        
        curl_close($handler);
        
        echo $data;
        
    }

    public function ficha()
    {
        $this->load->library("pdf");
        $this->load->model("Brigadista_model");
        
        $data = $this->uri->segment(3, 0);
        
        $id = desencriptarBrigadista($data);
        
        $this->Brigadista_model->setId($id);
        $brigadista = $this->Brigadista_model->brigadista();
        $gradoestudios = $this->Brigadista_model->gradoestudios();
        $certificaciones = $this->Brigadista_model->certificaciones();
        $capacitaciones = $this->Brigadista_model->listaCapacitacion();
        $emergencias = $this->Brigadista_model->emergencias();
        $contingencias = $this->Brigadista_model->contingencias();
        $trabajos = $this->Brigadista_model->listatrabajos();
        
        $data = array(
            "brigadista" => $brigadista->row(),
            "gradoestudios" => $gradoestudios,
            "certificaciones" => $certificaciones,
            "capacitaciones" => $capacitaciones,
            "emergencias" => $emergencias,
            "contingencias" => $contingencias,
            "trabajos" => $trabajos
        );
        $html = $this->load->view("brigadistas/ficha", $data, true);
        $this->pdf->html2Pdf("P", "A4", $html, "Ficha Brigadista");
        
    }

    public function fotocheck()
    {
        $this->load->library("dom");
        $this->load->library("QRGenerator");
        $this->load->model("Brigadista_model");

        $id = $this->uri->segment(3,0);

        $this->Brigadista_model->setId($id);
        $carnet = $this->Brigadista_model->carnet();
        $carnet = $carnet->row();

        $grupo_sanguineo = $this->grupoSanguineo($carnet->grupo_sanguineo);

        $path = getenv('PATH_IMG_BRIGADISTA');

        $categoria = $this->tipoCategoria($carnet->Categoria);

		$this->Brigadista_model->setbrigadistas_profesiones_id($carnet->brigadistas_profesion_id);
		$this->Brigadista_model->setbrigadistas_especialidad_id($carnet->brigadistas_especialidad_id);
		$profesionEspecialidad = $this->Brigadista_model->profesionEspecialidad();
		$profesionEspecialidad = $profesionEspecialidad->row();

		$this->Brigadista_model->setId($carnet->brigadista_id);
		$trabajo = $this->Brigadista_model->ultimotrabajo();

		if ($trabajo->num_rows() > 0) {
		    $trabajo = $trabajo->row();
		    $trabajo = $trabajo->DIRESA;
		} else {
		    $trabajo ="";
		}
		
		$sedes = '';
		$sedeAsignada = $this->Brigadista_model->listaSedesBrigadista();

		if($sedeAsignada->num_rows() > 0) {
		    $n = 0;
		    foreach($sedeAsignada->result() as $row) {
		        if ($n == 0) {
		            $sedes = $row->cluster.' - '.$row->sede;
		        } else {
		            $sedes .= '|'.$row->cluster.' - '.$row->sede;
		        }
		        $n++;
		    }
		}

		$code = $carnet->documento_numero.'|'.$carnet->apellidos.'|'.$carnet->nombres.'|'.$carnet->f_nac.'|'.$categoria.'|'.$grupo_sanguineo.'|DIGERD|MINSA|'.$sedes;
		
		$size = 10;
		if (strlen($code) > 140) {
		    $size = 8;
		}
		if (strlen($code) > 180) {
		    $size = 7;
		}
		if (strlen($code) > 200) {
		    $size = 6;
		}
		if (strlen($code) > 220) {
		    $size = 5;
		}

        $fileName = $this->qrgenerator->generate($carnet->documento_numero, $code, $path, $size);

        $parentesco = $this->parentesco($carnet->parentesco);

        $tipoCertificado = "";
        if (strlen($carnet->tipo_certificacion) > 0) {
            $tipoCertificado = $this->tipoCertificacion($carnet->tipo_certificacion);
        }

        $data = array(
            "certificado" => $tipoCertificado,
            "carnet" => $carnet,
            "grupo_sanguineo" => $grupo_sanguineo,
            "parentesco" => $parentesco,
            "fileName" => $fileName,
			"profesionEspecialidad" => $profesionEspecialidad,
            "foto" => $carnet->foto,
            "categoria" => $categoria,
            "trabajo" => $trabajo
        );
        sleep(1);
        $html = $this->load->view("brigadistas/fotocheck", $data, true);
        $this->dom->generate("portrait", "carnet", $html, "Fotocheck Brigadista");
        
    }
    
    private function tipoCategoria($code) {
        
        $categoria = "[N/A]";
        switch ($code) {
            case "1": $categoria = "EQUIPO T&Eacute;CNICO"; break;
            case "2": $categoria = "BRIGADISTA"; break;
            case "3": $categoria = "EQUIPO M&Eacute;DICO DE EMERGENCIA"; break;
            case "4": $categoria = "BRIGADISTA / EMT"; break;
        }
        return $categoria;
    }
    
    private function grupoSanguineo($code) {
        $group_sanguineo = "[N/A]";
        switch($code) {
            case 1:$group_sanguineo = "O-";break;
            case 2:$group_sanguineo = "O+";break;
            case 3:$group_sanguineo = "A-";break;
            case 4:$group_sanguineo = "A+";break;
            case 5:$group_sanguineo = "B-";break;
            case 6:$group_sanguineo = "B+";break;
            case 7:$group_sanguineo = "AB-";break;
            case 8:$group_sanguineo = "AB+";break;            
        }
        return $group_sanguineo;
    }
    
    private function tipoCertificacion($code) {
        
        switch($code) {
            case 1:$tipo="BRIGADISTA";break;
            case 2:$tipo="E.M.T. I";break;
            case 3:$tipo="E.M.T. II";break;
            case 4:$tipo="E.M.T. III";break;
            case 5:$tipo="CELULA ESPECIALIZADA";break;
        }
        
        return $tipo;
    }
    
    private function parentesco($code) {
        $parentesco = "[N/A]";
        switch($code) {
            case 1:$parentesco="MADRE";break;
            case 2:$parentesco="PADRE";break;
            case 3:$parentesco="HIJO (A)";break;
            case 4:$parentesco="HERMANO (A)";break;
            case 5:$parentesco="PRIMO (A)";break;
            case 6:$parentesco="ABUELO (A)";break;
            case 7:$parentesco="CONYUGUE";break;
            case 8:$parentesco="AMIGO (A)";break;
            case 9:$parentesco="OTROS";break;
        }
        return $parentesco;
    }

    public function entidadesSaludAjax()
    {
        $this->load->model("EntidadSalud_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $ubigeo = $departamento . $provincia . $distrito;
        
        $data = array();
        
        if (strlen($ubigeo) > 5) {
            
            $this->EntidadSalud_model->setCodigo_Ubigeo($ubigeo);
            
            $lista = $this->EntidadSalud_model->lista();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                $data[] = array(
                    "CodEESS" => $row->CodEESS,
                    "Nombre" => $row->Nombre,
                    "Clasificacion" => $row->Clasificacion
                );
                endforeach;
            }
        }
        
        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    public function obtenerRenipress()
    {
        $this->load->model("EntidadSalud_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $ubigeo = $departamento . $provincia . $distrito;
        
        $data = array();
        
        if (strlen($ubigeo) > 5) {
            
            $this->EntidadSalud_model->setCodigo_Ubigeo($ubigeo);
            
            $lista = $this->EntidadSalud_model->obtenerRenipress();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                $data[] = array(
                    "id_renipress" => $row->id_renipress,
                    "codigo_institucion" => $row->codigo_institucion,
                    "institucion" => $row->institucion,
                    "codigo_renipress" => $row->codigo_renipress,
                    "nombre" => $row->nombre,
                    "clasificacion" => $row->clasificacion,
                    "tipo" => $row->tipo,
                    "codigo_region" => $row->codigo_region,
                    "region" => $row->region,
                    "codigo_provincia" => $row->codigo_provincia,
                    "provincia" => $row->provincia,
                    "codigo_distrito" => $row->codigo_distrito,
                    "distrito" => $row->distrito,
                    "ubigeo" => $row->ubigeo
                );
                endforeach;
            }
        }
        
        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    public function obtenerRenipressId()
    {
        $this->load->model("EntidadSalud_model");
        
        $idRenipress = $this->input->post("idRenipress");
        
        $data = array();
        
        if ($idRenipress > 0) {
            
            $this->EntidadSalud_model->setIdRenipress($idRenipress);
            
            $lista = $this->EntidadSalud_model->obtenerRenipressId();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                $data[] = array(
                    "id_renipress" => $row->id_renipress,
                    "codigo_institucion" => $row->codigo_institucion,
                    "institucion" => $row->institucion,
                    "codigo_renipress" => $row->codigo_renipress,
                    "nombre" => $row->nombre,
                    "clasificacion" => $row->clasificacion,
                    "tipo" => $row->tipo,
                    "codigo_region" => $row->codigo_region,
                    "region" => $row->region,
                    "codigo_provincia" => $row->codigo_provincia,
                    "provincia" => $row->provincia,
                    "codigo_distrito" => $row->codigo_distrito,
                    "distrito" => $row->distrito,
                    "ubigeo" => $row->ubigeo
                );
                endforeach;
            }
        }
        
        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    private function generateQRCode($document, $code) {
        
        $path = getenv('PATH_IMG_BRIGADISTA');

        $fileName = "qr_".$document.'.png';
        
        $pngAbsoluteFilePath = $path.$fileName;

        if (!file_exists($pngAbsoluteFilePath)) {
            QRcode::png($code, $pngAbsoluteFilePath, 0, 20);
        }
    }
    
    public function profesionesBrigadistaAjax() {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $this->Brigadista_model->setId($id);

        $profesiones = $this->Brigadista_model->profesionesBrigadistaId();        
        $certificaciones = $this->Brigadista_model->listaCertificacion();
        
        echo json_encode(array("profesiones"=>$profesiones->result(), "certificaciones"=>$certificaciones->result()));
    }
    
    public function especialidadesProfesionesBrigadistaAjax() {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        $brigadistas_profesiones_id = $this->input->post("brigadistas_profesiones_id");
        
        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setBrigadistas_profesiones_id($brigadistas_profesiones_id);
        $especialidades = $this->Brigadista_model->especialidadesProfesionesBrigadista();
        
        echo json_encode(array("especialidades"=>$especialidades->result()));
    }
    //listar
    public function listaFotocheck() {

        $this->load->model("Brigadista_model");

        $id = $this->input->post("id");

        $this->Brigadista_model->setId($id);
        $fotocheck = $this->Brigadista_model->listaCarnet();

        echo json_encode(array("fotocheck"=>$fotocheck->result()));

    }

    public function registrarFotocheck() {

        $this->load->model("Brigadista_model");

        $id = $this->input->post("id");
        $brigadistas_profesiones_id = $this->input->post("brigadistas_profesiones_id");
        $brigadistas_especialidad_id = $this->input->post("brigadistas_especialidad_id");
        $fecha_emision = $this->input->post("fecha_emision");
        $fecha_vencimiento = $this->input->post("fecha_vencimiento");
        $brigadistas_certificacion_id = $this->input->post("brigadistas_certificacion_id");

        $status = 500;

        $this->Brigadista_model->setId($id);
        $this->Brigadista_model->setbrigadistas_profesiones_id($brigadistas_profesiones_id);
        $this->Brigadista_model->setbrigadistas_especialidad_id($brigadistas_especialidad_id);
        $this->Brigadista_model->setFecha_inicio(formatearFechaParaBD($fecha_emision));
        $this->Brigadista_model->setFecha_vencimiento(formatearFechaParaBD($fecha_vencimiento));
        $this->Brigadista_model->setbrigadistas_certificacion_id($brigadistas_certificacion_id);

        $find = $this->Brigadista_model->existeFotocheck();
        if ($find->num_rows()>0) {
            $status = 201;
        } else {
            $id = $this->Brigadista_model->registrarFotocheck();
            if ($id>0) {
                $status = 200;
            }
        }

        echo json_encode(array("status"=>$status,"id"=>$id));
    }
    
    public function eliminarFotocheck()
    {

        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
 
        $status = 500;
        $this->Brigadista_model->setId($id);
        if($this->Brigadista_model->eliminarFotocheck() == 1 ) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        else { $this->session->set_flashdata('messageError', 'No se puede eliminar'); }

        redirect('brigadistas');

    }
    
    public function listaSedesBrigadista() {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $this->Brigadista_model->setId($id);
        $sedes = $this->Brigadista_model->listaSedesBrigadista();
        
        echo json_encode(array("sedes"=>$sedes->result()));

    }
    
    public function registrarSede() {
        
        $this->load->model("Brigadista_model");
        
        $idBrigadista = $this->input->post("id");
        $brigadistas_evento_id = $this->input->post("brigadistas_evento_id");
        $brigadistas_clusters_id = $this->input->post("brigadistas_clusters_id");
        $brigadistas_sedes_id = $this->input->post("brigadistas_sedes_id");
        $status = 500;
        
        $this->Brigadista_model->setId($idBrigadista);
        $this->Brigadista_model->setbrigadistas_evento_id($brigadistas_evento_id);
        $this->Brigadista_model->setbrigadistas_clusters_id($brigadistas_clusters_id);
        $this->Brigadista_model->setbrigadistas_sedes_id($brigadistas_sedes_id);
        
        $id = 0;
        $find = $this->Brigadista_model->existeSede();
        if ($find->num_rows()>0) {
            $status = 201;
        } else {
            $id = $this->Brigadista_model->registrarSede();
            if ($id>0) {
                $status = 200;
            }
        }
        
        echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idBrigadista));
    }
    
    public function eliminarSede()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Brigadista_model->setId($id);
        if($this->Brigadista_model->eliminarSede() == 1 ) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        else { $this->session->set_flashdata('messageError', 'No se puede eliminar'); }
        
        redirect('brigadistas');
        
    }
    //redireciones
    public function formNew() 
    {
        
        $nivel = 1;
        $idmenu = 8;
        
        validarPermisos($nivel, $idmenu, $this->_permisos);
        
        $this->load->model("Ubigeo_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("Brigadista_model");
        $this->load->model("AlertaPronostico_model");
        
        $departamentos = $this->Ubigeo_model->departamentos();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $bancos = $this->Brigadista_model->bancos();
        $bancosnew = $this->Brigadista_model->bancosnew();
        $idiomas = $this->Brigadista_model->idiomas();
        $instituciones = $this->Brigadista_model->instituciones();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "departamentos" => $departamentos->result(),
            "tipodocumento" => $tipodocumento,
            "listaBancos" => $bancos,
            "listaBancosnew" => $bancosnew,
            "listaIdiomas" => $idiomas,
            "listaInstituciones" => $instituciones->result(),
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("brigadistas/form-new", $data);
        
        
    }

    public function formAdditional() 
    {
        $this->load->model("Brigadista_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("Contingencia_model");

        $id = $this->input->post("id"); 
        $this->Brigadista_model->setIdRenarhed($id);

        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $idiomas = $this->Brigadista_model->idiomas();
        $profesiones = $this->Brigadista_model->profesiones();
       // $listaIdiomasPersonal = $this->Brigadista_model->listarIdiomasPersonal();
        //$listaCarrerasPersonal = $this->Brigadista_model->listarCarrerasPersonal();
        //$listaCertificadoPersonal = $this->Brigadista_model->listarCertificadoPersonal();
        $instituciones = $this->Brigadista_model->instituciones();
        //trayendo de contingencia 
        $listarInstitucion = $this->Contingencia_model->listarInstitucion();
        $listarRegion = $this->Contingencia_model->listarRegion();
        $listarDISA = $this->Contingencia_model->listarDISA();
        $listarRed = $this->Contingencia_model->listarRed();
        $listarMicroRed = $this->Contingencia_model->listarMicroRed();
        $listarIPRESS = $this->Contingencia_model->listarIPRESS();




        $path = base_url().'public/certificados/';       
        
        $data = array(
            "listaralerta" => $listaralerta,
            "listaIdiomas" => $idiomas->result(),
            "listaRProfesion" => $profesiones->result(),
            
            //"listaIdiomasPersonal" => json_encode($listaIdiomasPersonal->result()),
            //"listaCarrerasPersonal" => json_encode($listaCarrerasPersonal->result()),
            //"listaCertificadoPersonal" => json_encode($listaCertificadoPersonal->result()),
            "listaInstituciones" => $instituciones->result(),
            "listarInstitucion" => $listarInstitucion,
            "listarRegion" => $listarRegion,
            "listarDISA" => $listarDISA,
            "listarRed" => $listarRed,
            "listarMicroRed" => $listarMicroRed,
            "listarIPRESS" => $listarIPRESS,
            "id" => $id,
            "path_files" => $path,
            
        ); 
        $this->load->view("brigadistas/form-additional",$data);

    }    
 
    public function registrarIdioma() {
        
        $this->load->model("Brigadista_model");
        //realizando pruebas
        //var_dump($this->input->post());exit;
        $idrenarhed = $this->input->post("id");
        $ididioma   = $this->input->post("ididioma");
        $nivel      = $this->input->post("nivel");
        $lectura    = $this->input->post("lectura");
        $escritura  = $this->input->post("escritura");

        $status = 500;
        
        $this->Brigadista_model->setIdRenarhed($idrenarhed);
        $this->Brigadista_model->setIdidioma($ididioma);
        $this->Brigadista_model->setNivel($nivel);        
        $this->Brigadista_model->setLectura($lectura == "on"? "1" : "0");
        $this->Brigadista_model->setEscritura($escritura== "on"? "1" : "0");
        
        $id = 0;
        //$find = $this->Brigadista_model->existeIdioma();//1er caso
        //$find2 = $this->Brigadista_model->existeIdiomaPersonal();//2do caso
       // if ($find->num_rows()>0) {
          //  $status = 201;
        //} else {
            $id = $this->Brigadista_model->registrarIdioma();
            if ($id>0) {
                $status = 200;
            }
        //}      
        echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idrenarhed));
    }


    public function registrarCarrera() { 
        $this->load->model("Brigadista_model");
        //realizando pruebas
        //var_dump($this->input->post());exit;
        $idrenarhed = $this->input->post("id");
        $idespecialidad = $this->input->post("idespecialidad");
        $colegiatura   = $this->input->post("colegiatura");
        $rne      = $this->input->post("rne");
        $idprofesion   = $this->input->post("idprofesion");


        $status = 500;
        
        $this->Brigadista_model->setIdRenarhed($idrenarhed);
        $this->Brigadista_model->setIdEspecialidad($idespecialidad);
        $this->Brigadista_model->setColegiatura($colegiatura);      
        $this->Brigadista_model->setRne($rne);
        $this->Brigadista_model->setIdprofesion($idprofesion);
        
            
        $id = $this->Brigadista_model->registrarCarrera();
        if ($id>0) {
            $response  = $this->agregarFileCarrera(); 
            //if ($response["estado_t"] || $response["estado_e"]){
            if($response["status"]){
                $this->Brigadista_model->setIdcarreras($id); 
                $this->Brigadista_model->setArchivo_titulo($response["file_titulo"]);
                $this->Brigadista_model->setArchivo_especialidad($response["file_especialidad"]); 
                $this->Brigadista_model->agregarFileCarreras();
            } 
            //registro correctamente
            $status = 200;
        }    
        echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idrenarhed));
    }


    public function registrarCertificado() {
        
        $this->load->model("Brigadista_model");
        //realizando pruebas
        //var_dump($this->input->post());exit;
        $idrenarhed = $this->input->post("id");
        $idcertificacion   = $this->input->post("idcertificacion");
        $idinstitucion   = $this->input->post("idinstitucion");
        $fecha_inicio      = $this->input->post("fecha_inicio");
        $fecha_vigencia   = $this->input->post("fecha_vigencia");

        $status = 500;

        
        $this->Brigadista_model->setIdRenarhed($idrenarhed);
        $this->Brigadista_model->setIdcertificacion($idcertificacion);
        $this->Brigadista_model->setIdinstitucion($idinstitucion); 
        $this->Brigadista_model->setFecha_inicio($fecha_inicio);
        $this->Brigadista_model->setFecha_vigencia($fecha_vigencia);
        
        $id = 0;
       
            $id = $this->Brigadista_model->registrarCertificado();
            if ($id>0) {
                $response  = $this->agregarFileCertificado(); 
                //if ($response["estado_t"] || $response["estado_e"]){
                if($response["status"]){
                    $this->Brigadista_model->setArchivo_adjunto($response["file_certificado"]);
                    $this->Brigadista_model->agregarFileCertificaciones();
                } 
                //registro correctamente
                $status = 200;
            } 
        //}      
        echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idrenarhed));
    }


    public function registrarLaboral() {
        
        $this->load->model("Brigadista_model");
        //realizando pruebas
        //var_dump($this->input->post());exit;
        $idrenarhed = $this->input->post("id");
        
        

        $codigo_institucion   = $this->input->post("codigo_institucion");
        $codigo_region   = $this->input->post("codigo_region");
        $codigo_disa   = $this->input->post("codigo_disa");
        $codigo_red   = $this->input->post("codigo_red");
        $codigo_micro_red   = $this->input->post("codigo_micro_red");
        $codigo_renipress   = $this->input->post("codigo_renipress");
        $codigo_condicion   = $this->input->post("codigo_condicion");


        $status = 500;

        $this->Brigadista_model->setIdRenarhed($idrenarhed);
        $this->Brigadista_model->setCodigo_institucion($codigo_institucion);
        $this->Brigadista_model->setCodigo_region($codigo_region); 
        $this->Brigadista_model->setCodigo_disa($codigo_disa); 
        $this->Brigadista_model->setCodigo_red($codigo_red); 
        $this->Brigadista_model->setCodigo_micro_red($codigo_micro_red); 
        $this->Brigadista_model->setCodigo_renipress($codigo_renipress); 
        $this->Brigadista_model->setCodigo_condicion($codigo_condicion); 

        //preguntar si ya existe un registro en la tabla renarhed_laboral_personal
        //$find = $this->Brigadista_model->existeLaboral();//1er caso
        //si existe
        // if ($find->num_rows()>0) {
            //actuazliar
        //si no existe 
        $id = 0;
         
       
          //  $status = 201;
        //} else {
            $id = $this->Brigadista_model->registrarLaboral();
            if ($id>0) {
                $status = 200;
            }
        //}      
        echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idrenarhed));
    }


    public function registrarCapacitacionPersonal() {
        
        $this->load->model("Brigadista_model");
        //realizando pruebas
        //var_dump($_FILES);exit;
        $idrenarhed = $this->input->post("id");
        $tipo_capacitacion   = $this->input->post("tipo_capacitacion");
        $nombre   = $this->input->post("nombre");
        $institucion   = $this->input->post("institucion");
        $horas   = $this->input->post("horas");
        $fecha_emision   = $this->input->post("fecha_emision");
        


        $status = 500;

        $this->Brigadista_model->setIdRenarhed($idrenarhed);
        $this->Brigadista_model->setTipo_capacitacion($tipo_capacitacion);
        $this->Brigadista_model->setNombre($nombre);
        $this->Brigadista_model->setInstitucion($institucion);
        $this->Brigadista_model->setHoras($horas);
        $this->Brigadista_model->setFecha_emision($fecha_emision);

        $id = 0;
        //$find = $this->Brigadista_model->existeIdioma();//1er caso
        //$find2 = $this->Brigadista_model->existeIdiomaPersonal();//2do caso
       // if ($find->num_rows()>0) {
          //  $status = 201;
        //} else {
            $id = $this->Brigadista_model->registrarCapacitacionPersonal();
          
            if ($id>0) {
                $response  = $this->agregarFileCapacitacion(); 
                //if ($response["estado_t"] || $response["estado_e"]){
                if($response["status"]){
                    $this->Brigadista_model->setIdcapacitacion($id); 
                    $this->Brigadista_model->setArchivo_adjunto($response["file_capacitacion"]);
                    $this->Brigadista_model->agregarFileCapacitaciones();
                } 
                //registro correctamente
                $status = 200;
            }    

        //}      
        echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idrenarhed));
    }

    public function registrarInmunizacionPersonal() {
        
        $this->load->model("Brigadista_model");
        //realizando pruebas
        //var_dump($_FILES);exit;
        $idrenarhed = $this->input->post("id");
        $tipo_inmunizacion   = $this->input->post("tipo_inmunizacion");
        $nombre   = $this->input->post("nombre");
        $numero_dosis   = $this->input->post("numero_dosis");
        $fecha_vacuna   = $this->input->post("fecha_vacuna");
        
        $status = 500;

        $this->Brigadista_model->setIdRenarhed($idrenarhed);
        $this->Brigadista_model->setTipo_inmunizacion($tipo_inmunizacion);
        $this->Brigadista_model->setNombre($nombre);
        $this->Brigadista_model->setNumero_dosis($numero_dosis);
        $this->Brigadista_model->setFecha_vacuna($fecha_vacuna);
        
        $id = 0;
      
            $id = $this->Brigadista_model->registrarInmunizacionPersonal();
            
            if ($id>0) {
                $response  = $this->agregarFileInmunizacion(); 
                //if ($response["estado_t"] || $response["estado_e"]){
                if($response["status"]){
                    $this->Brigadista_model->setIdinmunizacion($id); 
                    $this->Brigadista_model->setArchivo_adjunto($response["file_inmunizacion"]);
                    $this->Brigadista_model->agregarFileInmunizaciones();
                } 
                //registro correctamente
                $status = 200;
            }    
         

        //}      
        echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idrenarhed));
    }

    public function registrarAlergiaPersonal() {
        
        $this->load->model("Brigadista_model");
        //realizando pruebas
        //var_dump($this->input->post());exit;
        $idrenarhed = $this->input->post("idrenaherd");
       
        $alergias_alimentarias   = $this->input->post("alergias_alimentarias");
        $alergias_farmacologicas   = $this->input->post("alergias_farmacologicas");
 
 
        $status = 500;

        $this->Brigadista_model->setIdRenarhed($idrenarhed); 
        $this->Brigadista_model->setAlergias_alimentarias($alergias_alimentarias); 
        $this->Brigadista_model->setAlergias_farmacologicas($alergias_farmacologicas); 
 
 
        $id = 0;

        $id = $this->Brigadista_model->registrarAlergiaPersonal();
            
            if ($id>0) {
                $response  = $this->agregarFileVacunacion(); 
                //if ($response["estado_t"] || $response["estado_e"]){
                if($response["status"]){
                  //  $this->Brigadista_model->setIdRenarhed($idrenarhed); 
                    $this->Brigadista_model->setTarjeta_vacunas($response["file_vacunacion"]);
                    $this->Brigadista_model->agregarFileVacunaciones();
                } 
                //registro correctamente
                $status = 200;
            }
        //}      
        echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idrenarhed));



    }

    public function registrarAlergiaCampoPersonal() {
        
        $this->load->model("Brigadista_model");
        //realizando pruebas
        //var_dump($this->input->post());exit;
        $idrenarhed = $this->input->post("idrenaherd");
       
        $alergias_alimentarias   = $this->input->post("alergias_alimentarias");
        $alergias_farmacologicas   = $this->input->post("alergias_farmacologicas");
 
 
        $status = 500;

        $this->Brigadista_model->setIdRenarhed($idrenarhed); 
        $this->Brigadista_model->setAlergias_alimentarias($alergias_alimentarias); 
        $this->Brigadista_model->setAlergias_farmacologicas($alergias_farmacologicas); 
 
 
        $id = 0;

             $id = $this->Brigadista_model->registrarAlergiaCampoPersonal();
             if ($id>0) {
                 $status = 200;
             } 
           echo json_encode(array("status"=>$status, "id"=>$id, "idBrigadista"=>$idrenarhed));
    }
    

   

    public function formEdit() 
    {
        
        $this->load->model("Brigadista_model");
        $this->load->model("Ubigeo_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("AlertaPronostico_model");
        
        //$id = 2;
        //$this->input->post("id");
        $id = $this->input->post("id"); 
        
        $this->Brigadista_model->setIdrenarhed($id);
        $brigadista = $this->Brigadista_model->getBrigadista();
        $bancos = $this->Brigadista_model->bancos();
        $bancosnew = $this->Brigadista_model->bancosnew();
        $brigadista = $brigadista->row();
        //var_dump($brigadista);exit;
        
        $departamento = substr($brigadista->ubigeo_domicilio, 0, 2);
        $provincia = substr($brigadista->ubigeo_domicilio, 2, 2);
        $distrito = substr($brigadista->ubigeo_domicilio, 4, 2);
        
        $this->Ubigeo_model->setCodigo_Departamento(substr($brigadista->ubigeo_domicilio, 0, 2));
        $this->Ubigeo_model->setCodigo_Provincia(substr($brigadista->ubigeo_domicilio, 2, 2));
        $departamentos = $this->Ubigeo_model->departamentos();
        $provincias = $this->Ubigeo_model->provincias();
        $distritos = $this->Ubigeo_model->distritos();
        
        $tipodocumento = $this->TipoDocumento_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $instituciones = $this->Brigadista_model->instituciones();
        $idiomas = $this->Brigadista_model->idiomas();
     
        $data = array(
            "brigadista" => $brigadista,
            "departamentos" => $departamentos->result(),
            "provincias" => $provincias->result(),
            "distritos" => $distritos->result(),
            "departamento" => $departamento,
            "provincia" => $provincia,
            "distrito" => $distrito,
            "tipodocumento" => $tipodocumento,
            "listaBancos" => $bancos,
            "listaBancosnew" => $bancosnew,
            "listaIdiomas" => $idiomas->result(),
            "listaralerta" => $listaralerta,
            "listaInstituciones" => $instituciones->result(),
        );
        
       // $this->load->view("brigadistas/editar", $data);
        
        $this->load->view("brigadistas/form-edit", $data);
        
        
    }


   




    public function agregarFotoReniec($foto_str){

        $image = base64_decode($foto_str); //decofidicando
        $image_name = date("Ymdhis"); //generando un nombre para la foto con la fecha y hora actual
        $filename = $image_name . '.' . 'jpg';  // asignando extension
        $path = getenv('PATH_IMG_BRIGADISTA'); 
        file_put_contents($path . $filename, $image); //creando la imagen en la ruta 

        return $filename;
    }

    public function editarFotoReniec($foto_str, $imagen_old)
    {
        $path = getenv('PATH_IMG_BRIGADISTA'); 
              
        if(file_exists($path . $imagen_old)) unlink($path . $imagen_old); // delete image 
        $image = base64_decode($foto_str); //decofidicando
        $image_name = date("Ymdhis"); //generando un nombre para la foto con la fecha y hora actual
        $filename = $image_name . '.' . 'jpg';  // asignando extension
        $path = getenv('PATH_IMG_BRIGADISTA'); 
        file_put_contents($path . $filename, $image); //creando la imagen en la ruta 

        return $filename;
        
    }

    public function cargarListaIdiomasAjax($idget = "") {
         

        $this->load->model("Brigadista_model");
        $id =$idget;// $this->input->post("id");
        //echo $id; exit();
        $this->Brigadista_model->setIdrenarhed($id);
        $listaIdiomasPersonal = $this->Brigadista_model->listarIdiomasPersonal();
        
        $rs = $listaIdiomasPersonal->result();
 
        
        echo json_encode(array("data" => $rs));
        
        
    }


    public function cargarListaCarrerasAjax($idget = "") {
         

        $this->load->model("Brigadista_model");
        $id =$idget;// $this->input->post("id");
       // echo $id; exit();
        $this->Brigadista_model->setIdrenarhed($id);
        $listaCarrerasPersonal = $this->Brigadista_model->listarCarrerasPersonal();
        //echo $listaCarrerasPersonal;exit;
        $rs = $listaCarrerasPersonal->result();
 
        
        echo json_encode(array("data" => $rs));
    }

    public function cargarListaCertificacionAjax($idget = "")
    {
        //echo $idget;exit;
        $this->load->model("Brigadista_model");
        
        $id =$idget;// $this->input->post("id");
        //$this->Brigadista_model->setId($id);
        $this->Brigadista_model->setIdrenarhed($id);
        $listaCertificadoPersonal = $this->Brigadista_model->listarCertificadoPersonal();
        //echo $listaCertificadoPersonal;exit;
        $rs = $listaCertificadoPersonal->result();
        
        echo json_encode(array("data" => $rs));
        
    }
      //lista
      public function cargarListaInmunizacionAjax($idget = "")
      {
          //echo $idget;exit;
          $this->load->model("Brigadista_model");
          
          $id =$idget;
          $this->Brigadista_model->setIdrenarhed($id);
          $listaInmunizacionPersonal = $this->Brigadista_model->listarInmunizacionPersonal();
          
          $rs = $listaInmunizacionPersonal->result();
          
          echo json_encode(array("data" => $rs));
          
      }

    public function cargarListaCapacitacionAjax($idget = "")
    {
        //echo $idget;exit;
        $this->load->model("Brigadista_model");
        
        $id =$idget;// $this->input->post("id");
        //$this->Brigadista_model->setId($id);
        $this->Brigadista_model->setIdrenarhed($id);
        $listaCapacitacionPersonal = $this->Brigadista_model->listarCapacitacionPersonal();
        //echo $listaCertificadoPersonal;exit;
        $rs = $listaCapacitacionPersonal->result();
        
        echo json_encode(array("data" => $rs));
        
    }
  

    public function getEspecialidadesxProfesion() {
         

        $this->load->model("Brigadista_model");
        $id_profesion = $this->input->post("id_profesion");
        //echo $id; exit();
        $this->Brigadista_model->setIdrenarhed($id_profesion);
        $listaEspecialidades = $this->Brigadista_model->getEspecialidadesxProfesion();
        
        $rs = $listaEspecialidades->result();
 
        
        echo json_encode($rs);
    }

    // Agregar File
    public function agregarFileCarrera()
    {
        
        $path = getenv('PATH_DOC_CERTIFICADO');
        
        $file_titulo ="";
        $file_especialidad = "";

        $estado_t = 0;
        $estado_e = 0;
        $message ="";
        if (filesize($_FILES["file_titulo"]["tmp_name"]) > 0 || filesize($_FILES["file_especialidad"]["tmp_name"]) > 0) {
            
            if ($_FILES["file_titulo"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                
                $data_titulo        = $_FILES["file_titulo"]['name'];
                $ext_titulo         = pathinfo($data_titulo, PATHINFO_EXTENSION);

                $file_titulo        = 'tit_'.$name . '.' . $ext_titulo; 

                copy($_FILES["file_titulo"]["tmp_name"], $path . $file_titulo); 
                
                $estado_t = 1;
                $message = EXITO_ARCHIVO;
            }
            
            if ($_FILES["file_especialidad"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                 
                $data_especialidad  = $_FILES["file_especialidad"]['name'];
                $ext_especialidad   = pathinfo($data_especialidad, PATHINFO_EXTENSION);

                $file_especialidad  = 'esp_'.$name . '.' . $ext_especialidad;

                copy($_FILES["file_especialidad"]["tmp_name"], $path . $file_especialidad); 
                
                $estado_e = 1;
                $message = EXITO_ARCHIVO;
            }
            if ($_FILES["file_especialidad"]["type"] != "application/pdf" && $_FILES["file_titulo"]["type"] != "application/pdf")  {
                $estado_t = 0;
                $estado_e = 0;
                $message = ERROR_ARCHIVO_FORMATO;
            }

         
        } // existe

        
       

        $status =  ($estado_t || $estado_e) ? 1 : 0;
        $response = array(
            "status" => $status,
            "estado_t" => $estado_t,
            "estado_e" => $estado_e,
            "file_titulo" => $file_titulo,
            "file_especialidad" => $file_especialidad,
            "message" => $message
        );
        return $response;
    }

    public function agregarFileCertificado()
    {
        
        $path = getenv('PATH_DOC_CERTIFICADO');
        
        $file_certificado="";

        $estado_t = 0;
        $estado_e = 0;
        $message ="";
        if (filesize($_FILES["file_certificado"]["tmp_name"]) > 0 ) {
            
            if ($_FILES["file_certificado"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                
                $data_certificado        = $_FILES["file_certificado"]['name'];
                $ext_certificado         = pathinfo($data_certificado, PATHINFO_EXTENSION);

                $file_certificado        = 'cert_'.$name . '.' . $ext_certificado; 

                copy($_FILES["file_certificado"]["tmp_name"], $path . $file_certificado); 
                
                $estado_t = 1;
                $message = EXITO_ARCHIVO;
            }
            
           
            if ($_FILES["file_certificado"]["type"] != "application/pdf")  {
                $estado_t = 0;
                $estado_e = 0;
                $message = ERROR_ARCHIVO_FORMATO;
            }

         
        } // existe

        

        $status =  ($estado_t || $estado_e) ? 1 : 0;
        $response = array(
            "status" => $status,
            "estado_t" => $estado_t,
            "estado_e" => $estado_e,
            "file_certificado" => $file_certificado,
            "message" => $message
        );
        return $response;
    }


    public function agregarFileCapacitacion()
    {
        
        $path = getenv('PATH_DOC_CERTIFICADO');
        
        $file_capacitacion="";

        $estado_t = 0;
        $estado_e = 0;
        $message ="";
        if (filesize($_FILES["file_capacitacion"]["tmp_name"]) > 0 ) {
            
            if ($_FILES["file_capacitacion"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                
                $data_capacitacion        = $_FILES["file_capacitacion"]['name'];
                $ext_capacitacion         = pathinfo($data_capacitacion, PATHINFO_EXTENSION);

                $file_capacitacion        = 'cap_'.$name . '.' . $ext_capacitacion; 

                copy($_FILES["file_capacitacion"]["tmp_name"], $path . $file_capacitacion); 
                
                $estado_t = 1;
                $message = EXITO_ARCHIVO;
            }
            
           
            if ($_FILES["file_capacitacion"]["type"] != "application/pdf")  {
                $estado_t = 0;
                $estado_e = 0;
                $message = ERROR_ARCHIVO_FORMATO;
            }

         
        } // existe

        

        $status =  ($estado_t || $estado_e) ? 1 : 0;
        $response = array(
            "status" => $status,
            "estado_t" => $estado_t,
            "estado_e" => $estado_e,
            "file_capacitacion" => $file_capacitacion,
            "message" => $message
        );
        return $response;
    }

    public function agregarFileVacunacion()
    {
        
        $path = getenv('PATH_DOC_CERTIFICADO');
        
        $file_vacunacion="";

        $estado_t = 0;
        $estado_e = 0;
        $message ="";
        if (filesize($_FILES["file_vacunacion"]["tmp_name"]) > 0 ) {
            
            if ($_FILES["file_vacunacion"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                
                $data_vacunacion       = $_FILES["file_vacunacion"]['name'];
                $ext_vacunacion         = pathinfo($data_vacunacion, PATHINFO_EXTENSION);

                $file_vacunacion        = 'tvac_'.$name . '.' . $ext_vacunacion; 

                copy($_FILES["file_vacunacion"]["tmp_name"], $path . $file_vacunacion); 
                
                $estado_t = 1;
                $message = EXITO_ARCHIVO;
            }
            
           
            if ($_FILES["file_vacunacion"]["type"] != "application/pdf")  {
                $estado_t = 0;
                $estado_e = 0;
                $message = ERROR_ARCHIVO_FORMATO;
            }

         
        } // existe

        

        $status =  ($estado_t || $estado_e) ? 1 : 0;
        $response = array(
            "status" => $status,
            "estado_t" => $estado_t,
            "estado_e" => $estado_e,
            "file_vacunacion" => $file_vacunacion,
            "message" => $message
        );
        return $response;
    }

    public function agregarFileInmunizacion()
    {
        
        $path = getenv('PATH_DOC_CERTIFICADO');
        
        $file_inmunizacion="";

        $estado_t = 0;
        $estado_e = 0;
        $message ="";
        if (filesize($_FILES["file_inmunizacion"]["tmp_name"]) > 0 ) {
            
            if ($_FILES["file_inmunizacion"]["type"] == "application/pdf") {
                
                $name = date("Ymdhis");
                
                $data_inmunizacion        = $_FILES["file_inmunizacion"]['name'];
                $ext_inmunizacion         = pathinfo($data_inmunizacion, PATHINFO_EXTENSION);

                $file_inmunizacion        = 'vac_'.$name . '.' . $ext_inmunizacion; 

                copy($_FILES["file_inmunizacion"]["tmp_name"], $path . $file_inmunizacion); 
                
                $estado_t = 1;
                $message = EXITO_ARCHIVO;
            }
            
           
            if ($_FILES["file_inmunizacion"]["type"] != "application/pdf")  {
                $estado_t = 0;
                $estado_e = 0;
                $message = ERROR_ARCHIVO_FORMATO;
            }

         
        } // existe

        

        $status =  ($estado_t || $estado_e) ? 1 : 0;
        $response = array(
            "status" => $status,
            "estado_t" => $estado_t,
            "estado_e" => $estado_e,
            "file_inmunizacion" => $file_inmunizacion,
            "message" => $message
        );
        return $response;
    }

    public function eliminarFileCarrera()
    {
        $this->load->model("EventoRegistroFile_model");
        $id = $this->input->post("Evento_Registro_File_Numero");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $files = $this->input->post("files");
        $path = getenv('PATH_DOC_CERTIFICADO');
        if (file_exists($path . $files))
            unlink($path . $files); // delete image
        
        $this->EventoRegistroFile_model->setId($id);
        $this->EventoRegistroFile_model->eliminar();
        
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($Evento_Registro_Numero);
        $this->EventoRegistrar_model->actualizarFecha();
        
        echo json_encode(array(
            "status" => 1
        ));
    }

     public function eliminarIdiomaPersonal(){
        $this->load->model("Brigadista_model");
        $id = $this->input->post("id_idioma");
    
        $status = 500;
        $msg="";
        $this->Brigadista_model->setId($id);
        
        if($this->Brigadista_model->eliminarIdiomaPersonal() == 1 ){
            $status = 200;
            $msg = "Registro eliminado";
            
        }
        else {
            $status = 201;
            $msg = "No se pudo eliminar";
             }

             echo json_encode(array(
                 "status"=>$status,
                 "msg"=>$msg,
                 ));

        
    }

    public function eliminarCarreraPersonal(){
        $this->load->model("Brigadista_model");
        $id = $this->input->post("id_carrera");
    
        $status = 500;
        $msg="";
        $this->Brigadista_model->setId($id);
        
        if($this->Brigadista_model->eliminarCarreraPersonal() == 1 ){
            $status = 200;
            $msg = "Registro eliminado";
            
        }
        else {
            $status = 201;
            $msg = "No se pudo eliminar";
             }

             echo json_encode(array(
                 "status"=>$status,
                 "msg"=>$msg,
                 ));

        
    }

    public function eliminarCertificadoPersonal(){
        $this->load->model("Brigadista_model");
        $id = $this->input->post("id_certificado");
    
        $status = 500;
        $msg="";
        $this->Brigadista_model->setId($id);
        
        if($this->Brigadista_model->eliminarCertificadoPersonal() == 1 ){
            $status = 200;
            $msg = "Registro eliminado";
            
        }
        else {
            $status = 201;
            $msg = "No se pudo eliminar";
             }

             echo json_encode(array(
                 "status"=>$status,
                 "msg"=>$msg,
                 ));

        
    }

    public function eliminarCapacitacionPersonal(){
        $this->load->model("Brigadista_model");
        $id = $this->input->post("id_capacitacion");
    
        $status = 500;
        $msg="";
        $this->Brigadista_model->setId($id);
        
        if($this->Brigadista_model->eliminarCapacitacionPersonal() == 1 ){
            $status = 200;
            $msg = "Registro eliminado";
            
        }
        else {
            $status = 201;
            $msg = "No se pudo eliminar";
             }

             echo json_encode(array(
                 "status"=>$status,
                 "msg"=>$msg,
                 ));

        
    }


    public function eliminarInmunizacionPersonal(){
        $this->load->model("Brigadista_model");
        $id = $this->input->post("id_inmunizacion");
    
        $status = 500;
        $msg="";
        $this->Brigadista_model->setId($id);
        
        if($this->Brigadista_model->eliminarInmunizacionPersonal() == 1 ){
            $status = 200;
            $msg = "Registro eliminado";
            
        }
        else {
            $status = 201;
            $msg = "No se pudo eliminar";
             }

             echo json_encode(array(
                 "status"=>$status,
                 "msg"=>$msg,
                 ));

        
    }

    public function guardarComision() {

        $this->load->model("Brigadista_model");
        
        $idcomision = $this->input->post("idcomision");
        $this->Brigadista_model->setIdcomision($idcomision);
        //$articulos = $this->input->post("articulos");

        $regioncomision = $this->input->post("region");
        $tipocomision = $this->input->post("tipo");
        $tipoEventocomision = $this->input->post("tipoEvento");
        $eventocomision = $this->input->post("evento");
        $eventoDetallecomision = $this->input->post("eventoDetalle");
        $numeroEventocomision = $this->input->post("idEvento");
        $descripcioncomision = $this->input->post("descripcion");
        $fechaIniciocomision = $this->input->post("fechaInicio");
        $fechaFincomision = $this->input->post("fechaFin");

        $aniocomision = substr($fechaIniciocomision, 0, 4);
        $mescomision = substr($fechaIniciocomision, 5, 7);
        
        // $this->Ingreso_model->setFechaEmision(formatearFechaParaBD(explode(" ", $this->input->post("fechaEmision"))[0]));
        
        $this->Brigadista_model->setRegionComision($regioncomision);
        $this->Brigadista_model->setTipoComision($tipocomision);
        $this->Brigadista_model->setTipoEventoComision($tipoEventocomision);
        $this->Brigadista_model->setEventoComision($eventocomision);
        $this->Brigadista_model->setEventoDetalleComision($eventoDetallecomision);
        $this->Brigadista_model->setNumeroEventoComision($numeroEventocomision);
        $this->Brigadista_model->setDescripcionComision($descripcioncomision);
        $this->Brigadista_model->setFechaInicioComision($fechaIniciocomision. ' ' .'00:00:00');
        $this->Brigadista_model->setFechaFinComision($fechaFincomision. ' ' .'00:00:00');
        $this->Brigadista_model->setAnioComision($aniocomision);
        $this->Brigadista_model->setMesComision($mescomision);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        $archivo = false;
        if (filesize($_FILES["ficha"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivoComision($_FILES["ficha"], false, 0);
        }

        if ($archivo != false) {
            $this->Brigadista_model->setFichaTecnicaComision($archivo);
        }

        /*
        if ($idcomision > 0) {
            if ($this->Brigadista_model->actualizarIngreso()) {
                $respuestaEliminar = $this->Brigadista_model->eliminarDetalleIngreso();
                if($respuestaEliminar && $this->guardarDetalle($idcomision, $articulos)){
                    $status = 200;
                    $message = "Historial registrado exitosamente";
                }
            }
        } else {*/
            $idcomision = $this->Brigadista_model->registrarComision();
            /*if ($idcomision) {
                if($this->guardarDetalle($idcomision, $articulos)){*/
                    $status = 200;
                    $message = "Comisión registrada exitosamente";
               /* }
            }
        }*/
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function guardarDetalleComision($idcomision, $articulos) {
        $this->Ingreso_model->setIngreso($idcomision);
        $articulos = explode("|", $articulos);
        foreach($articulos as $id):
            $this->Ingreso_model->setIdArticulo($id);
            $this->Ingreso_model->guardarDetalle();
        endforeach;

        return $idcomision;
    }

    public function cargarArchivoComision($file,$update,$id){
        $path = getenv('PATH_DOC_COMISION_BRIGADISTA');
        
        if (filesize($file["tmp_name"]) > 0) {
            $name = "comision_".date("Ymdhis");
            $data = $file['name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $fullName = $name . '.' . $ext;
            
            $allowedMimeTypes = array("pdf","doc","docx","PDF","DOC","DOCX");
            
            if(in_array( $ext, $allowedMimeTypes ) ){
                
                if (copy($file["tmp_name"], $path . $fullName)) {
                    
                    if($update){
                        $file = $this->fileName($id);
                        $this->deleteFile($file);
                    }
                    
                    return $fullName;
                } else {
                    return false;
                }
            }
            else{
                return false;
            }
            
        }else{
            return false;
        }
    }

    public function guardarIndicador() {

        $this->load->model("Indicador_model");
        
        $idregistro = $this->input->post("idregistro");
        $this->Indicador_model->setIdregistro($idregistro);

        $region = $this->input->post("region");
        $idejecutora = $this->input->post("idejecutora");
        $fecha_recepcion = $this->input->post("fecha_recepcion");
        $anio = $this->input->post("anio");
        $mes = $this->input->post("mes");
        
        // $this->Ingreso_model->setFechaEmision(formatearFechaParaBD(explode(" ", $this->input->post("fechaEmision"))[0]));
        
        $this->Indicador_model->setRegion($region);
        $this->Indicador_model->setIdejecutora($idejecutora);
        $this->Indicador_model->setAnio($anio);
        $this->Indicador_model->setMes($mes);
        $this->Indicador_model->setFechaRecepcion($fecha_recepcion. ' ' .'00:00:00');

        $cantIndmatriz = $this->Indicador_model->cantIndMatriz();
        $row = $cantIndmatriz->row();
        
        
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";
        
        if ($idregistro > 0) {
            $message = "3010";
            if ($this->Indicador_model->actualizarIndicador()) {
                $message = "3012";
                $respuestaEliminar = $this->Indicador_model->eliminarDetalleIndicador();
                $message = "3014";
                if($respuestaEliminar){
                    $message = "3016";
                    for($i=1;$i <= $row->cantmatriz;$i++){
                        $message = "3018";
                        $idmatriz = $i;
                        $valor = $this->input->post("matriz-".$i);
                        $comentarios = $this->input->post("comentarios-".$i);
                        $this->guardarDetalleIndicador($idregistro, $idmatriz, $valor, $comentarios);
                        $message = "3023";
                        }
                    $status = 200;
                    $message = "Detalle Actualizado exitosamente";
                }
            }
        } else {
            $idregistro = $this->Indicador_model->registrarIndicador();
            if ($idregistro) {                
                for($i=1;$i <= $row->cantmatriz;$i++){
                $idmatriz = $i;
                $valor = $this->input->post("matriz-".$i);
                $comentarios = $this->input->post("comentarios-".$i);
                $this->guardarDetalleIndicador($idregistro, $idmatriz, $valor, $comentarios);
                }
                $status = 200;
                $message = "Indicador registrado exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function guardarDetalleIndicador($idregistro,$idmatriz,$valor,$comentarios) {
        
        $this->load->model("Indicador_model");

        $this->Indicador_model->setIdregistro($idregistro);
        $this->Indicador_model->setIdmatriz($idmatriz);
        $this->Indicador_model->setValor($valor);        
        $this->Indicador_model->setComentariosPPR($comentarios);     
        
        $this->Indicador_model->registrarDetalleIndicador();

       // echo json_encode($data);
       //header("location:" . base_url() . "contingencia/main");

    }

    public function obtenerListaIndicadores(){
        
        $this->load->model("Indicador_model");

        $listarIndicadores = $this->Indicador_model->listaIndicadores();
        $detalle = array(
          "listarIndicadores" => $listarIndicadores->num_rows()? $listarIndicadores->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtenerDetalleIndicador(){
        $this->load->model("Indicador_model");
        $this->Indicador_model->setIdregistro($this->input->post("id"));
        
        $listadetalleindicador = $this->Indicador_model->obtenerDetalleIndicadores();
        $detalle = array(
            "listadetalleindicador" => $listadetalleindicador->num_rows()? $listadetalleindicador->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

}