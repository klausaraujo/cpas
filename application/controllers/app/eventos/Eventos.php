<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Eventos extends CI_Controller
{
  public function __construct(){
        parent::__construct();
  }

  private function tokenIsExist($token)
    {
		$length = 0;
		$token_header = ["user","idrol","region","time"];
      if(!empty($token) and is_object($token)) {
          foreach ($token_header as $key) {
              if (array_key_exists($key, $token) and !empty($key))
                $length++;
          }
      }
		return $length;
    }

    private function validar_usuario($token)
    {
        $status = 404;
        $message = "No encontrado";
        $idusuario = "";
        $idrol = "";
        $region = "";
        $time = "";
        try{
          (strlen($token) > 0) ? $token = JWT::decode($token, getenv("SECRET_SERVER_KEY")) : $token = "";
            $length = $this->tokenIsExist($token);
            if($length==4){
              $idusuario = $token->user;
              $idrol = $token->idrol;
              $region = $token->region;
              $time = $token->time;
              if(empty($idusuario) or strlen($idusuario)!=4){
                $status = 401;
                $message = "Usuario invalido";
              }else if(empty($time) or !is_numeric($time)){
                $status = 401;
                $message = "Usuario invalido";
              }else{
                $time_difference = strtotime('now') - $time;
                if( $time_difference >= 3600 ){
                  $status = 401;
                  $message = "token expirado";
                }
                else{
                  $status = 202;
                  $message = "continuar";
                }
              }
            }else{
              $status = 403;
              $message = "Su sesion ha expirado";
            }
        }
        catch(Exception $e){
          $status = 500;
          $message = "Error en la aplicacion";
        }
        $respuesta["status"] = $status;
        $respuesta["message"] = $message;
        $respuesta["user"] = $idusuario;
        $respuesta["idrol"] = $idrol;
        $respuesta["region"] = $region;
        return $respuesta;
    }

    public function lista()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $idrol = $respuesta["idrol"];
        $region = $respuesta["region"];
        $lista = "";
        $total = 0;
        $paginas = 0;            
        $end = 0;
        $pagina = 0;
            if ($status == 202) {
            $pagina = $obj["pagina"];
            $start = ceil((intval($obj["pagina"])-1) * 10);
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setPagina($start);
            $this->EventoRegistrar_model->setIdrol($idrol);
            $this->EventoRegistrar_model->setRegion($region);
            $lista = $this->EventoRegistrar_model->listaPaginaApp();
            $total = $this->EventoRegistrar_model->totalApp();
            $total = $total->row();
            $total = $total->total;
            $paginas = ceil($total / 10);
            $lista = $lista->result();
        }
        $lista = $lista;
		if($paginas == $pagina) $end = 1;
        if($paginas == 0) $end = 1;
        $json = array(
            "message" => $message,
            "status" => $status,
            "token" => $token,
			"end" => $end,
            "total" => $total,
            "paginas" => $paginas,
            "lista" => $lista
        );
        echo json_encode($json);
    }

    public function busqueda()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $lista = "";
        if ($status == 202) {
            $busqueda = $obj["busqueda"];
            $this->load->model("EventoRegistrar_model");
            $this->EventoRegistrar_model->setBusqueda($busqueda);
            $lista = $this->EventoRegistrar_model->busqueda();
            $lista = $lista->result();        
        }
        $lista = $lista;
        $json = array(
            "message" => $message,
            "status" => $status,
            "token" => $token,
            "lista" => $lista
        );
        echo json_encode($json);
    }

     public function evento(){
		$json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $tipo = "";
        $nivel = "";
        $fuente = "";
        $departamentos = "";
        if ($status == 202) {
    			$this->load->model("EventoTipo_model");
    			$this->load->model("EventoNivel_model");
    			$this->load->model("EventoFuente_model");
    			$this->load->model("Ubigeo_model");
    			$tipo = $this->EventoTipo_model->lista();
    			$nivel = $this->EventoNivel_model->lista();
    			$fuente = $this->EventoFuente_model->lista();
    			$departamentos = $this->Ubigeo_model->departamentos();
    			$tipo = $tipo->result();
    			$nivel = $nivel->result();
    			$fuente = $fuente->result();
    			$departamentos = $departamentos->result();
		}
		$json= array(
			"tipoEvento" => $tipo,
			"eventoNivel" => $nivel,
			"eventoFuente" => $fuente,
			"ubigeo" => $departamentos
		);
		echo json_encode($json);
	 }

   public function cargarTipoEvento()
   {
     $this->load->model("EventoTipo_model");
     $lista = "";
   		$lista = $this->EventoTipo_model->lista();
   		$lista = $lista->result();
      echo json_encode($lista);
    }

    public function cargarEvento(){
        $this->load->model("Evento_model");
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $tipoEvento = $obj["Evento_Tipo_Codigo"];
        $lista = "";
        $lista = $this->Evento_model->setTipoEvento($tipoEvento);
        $lista = $this->Evento_model->listaTipo();
        $lista = $lista->result();
        echo json_encode($lista);
    }

    public function cargarEventoDetalle(){
        $this->load->model("EventoDetalle_model");
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $tipoEvento = $obj["Evento_Tipo_Codigo"];
        $evento = $obj["Evento_Codigo"];
        $lista = "";
        $this->EventoDetalle_model->setTipoEvento($tipoEvento);
        $this->EventoDetalle_model->setEvento($evento);
        $lista = $this->EventoDetalle_model->lista();
        $lista = $lista->result();
        echo json_encode($lista);
    }

    public function cargarProvincias()
    {
        $this->load->model("Ubigeo_model");
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $departamento = $obj["departamento"];
        $lista = "";
        $this->Ubigeo_model->setCodigo_Departamento($departamento);
        $lista = $this->Ubigeo_model->provincias();
        $lista = $lista->result();
        echo json_encode($lista);
    }

    public function cargarDistritos()
    {
        $this->load->model("Ubigeo_model");
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $departamento = $obj["departamento"];
        $provincia = $obj["provincia"];
        $lista = "";
        $this->Ubigeo_model->setCodigo_Departamento($departamento);
        $this->Ubigeo_model->setCodigo_Provincia($provincia);
        $lista = $this->Ubigeo_model->distritos();
        $lista = $lista->result();
        echo json_encode($lista);
    }

    public function registrar()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $tipoEvento = $obj["tipoEvento"];
        $detalle = $obj["eventoDetalle"];
        $evento = $obj["evento"];
        $fechaEvento = $obj["fechaEvento"];
        $nivelEmergencia = $obj["nivelEmergencia"];
        $fuenteInicial = $obj["fuenteInicial"];
        $latitud = $obj["latitud"];
        $longitud = $obj["longitud"];
        $departamento = $obj["departamento"];
        $provincia = $obj["provincia"];
        $distrito = $obj["distrito"];
        $descripcionGeneral = $obj["descripcionGeneral"];
        $latitudsismo = $obj["latitudsismo"];
        $longitudsismo = $obj["longitudsismo"];
        $referencia = $obj["referencia"];
        $profundidad = $obj["profundidad"];
        $magnitud = $obj["magnitud"];
        $intensidad = $obj["intensidad"];
        $lugar = $obj["lugar"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $idusuario = $respuesta["user"];
        $code = 0;
        $response = "Evento no registrado: ".$tipoEvento." - ".$latitud." , ".$intensidad;
        $status = 202;
        if ($status == 202) {
          $departamento = (strlen($departamento)>2)?substr($departamento,0,2):$departamento;
          $provincia = (strlen($provincia)>2)?substr($provincia,2,2):$provincia;
          $distrito = (strlen($distrito)>2)?substr($distrito,4,2):$distrito;
            $this->load->model("EventoRegistrar_model");
            $this->load->model("Ubigeo_model");
            $fechaEvento = str_replace("-","/",$fechaEvento);
            $fE = explode(" ", $fechaEvento);
            $fechaEvento = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00";
            $coordenadas = $latitud . ", " . $longitud;
            $ubigeo = $departamento . '' . $provincia . '' . $distrito;
            $secuencia = $this->EventoRegistrar_model->getSecuencia();
            $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
            $this->EventoRegistrar_model->setEvento($evento);
            $this->EventoRegistrar_model->setFechaEvento($fechaEvento);
            $this->EventoRegistrar_model->setDetalle($detalle);
            $this->EventoRegistrar_model->setNivelEmergencia($nivelEmergencia);
            $this->EventoRegistrar_model->setFuenteInicial($fuenteInicial);
            $this->EventoRegistrar_model->setReferencia($referencia);
            $this->EventoRegistrar_model->setCoordenadas($coordenadas);
            $this->EventoRegistrar_model->setLatitud($latitud);
            $this->EventoRegistrar_model->setLongitud($longitud);
            $this->EventoRegistrar_model->setUbigeo($ubigeo);
            $this->EventoRegistrar_model->setDescripcionGeneral($descripcionGeneral);
            $this->EventoRegistrar_model->setLatitudSismo($latitudsismo);
            $this->EventoRegistrar_model->setLongitudSismo($longitudsismo);
            $this->EventoRegistrar_model->setProfundidad($profundidad);
            $this->EventoRegistrar_model->setMagnitud($magnitud);
            $this->EventoRegistrar_model->setIntesidad($intensidad);
            $this->EventoRegistrar_model->setSecuencia($secuencia);
            $this->EventoRegistrar_model->setUsuario($idusuario);
            $this->EventoRegistrar_model->setLugar($lugar);            
            $this->Ubigeo_model->setCodigo_Departamento($departamento);
            $this->Ubigeo_model->setCodigo_Provincia($provincia);
            $this->Ubigeo_model->setCodigo_Distrito($distrito);
            $ubiegoDescripcion = $this->Ubigeo_model->ubigeo();
            $ubiegoDescripcion = $ubiegoDescripcion->row();            
            $ubiegoDescripcion = $ubiegoDescripcion->departamento.", ".$ubiegoDescripcion->provincia.", ".$ubiegoDescripcion->distrito;
            $this->EventoRegistrar_model->setUbigeoDescripcion($ubiegoDescripcion);
            $generatedId = $this->EventoRegistrar_model->registrarApp();
            if ($generatedId > 0) {
                $this->saveImage($generatedId,$latitud,$longitud,$evento);
                $code = 1;
                $response = "El evento ha sido registrado";
            }
        }
        $json = array(
            "message" => $message,
            "status" => $status,
            "token" => $token,
            "code" => $code,
            "response" => $response
        );
        echo json_encode($json);
    }

    public function danios()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $screen = 0;
        $danios = "";
        $Evento_Registro_Numero = "";
        if ($status == 202) {
            $this->load->model("EventoRegistrarDanios_model");
            $Evento_Registro_Numero = $obj["Evento_Registro_Numero"];
            if (strlen($Evento_Registro_Numero) < 1) {
                $status = $respuesta["status"];
            } else {
                $status = 200;
                $this->EventoRegistrarDanios_model->setEvento_Registro_Numero($Evento_Registro_Numero);
                $danios = $this->EventoRegistrarDanios_model->danioApp();
                if ($danios->num_rows() > 0)
                    $screen = 1;
                $danios = $danios->first_row();
            }
        }

        $json = array(
            "status" => $status,
            "message" => $message,
            "token" => $token,
            "danios" => $danios,
            "screen" => $screen,
            "Evento_Registro_Numero" => $Evento_Registro_Numero
        );
        echo json_encode($json);
    }

    public function registrarDanio()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $usuario = $respuesta["user"];
        $response = "";
        $Evento_Registro_Numero = "";
        $code = 0;
        if ($status == 202) {
            $this->load->model("EventoRegistrarDanios_model");
            $Evento_Registro_Numero = $obj["Evento_Registro_Numero"];
            $Evento_Danios_Fecha = $obj["fechaEvento"];
            $Evento_Danios_Fuente = $obj["fuente"];
            $Evento_Danios_Descripcion = $obj["descripcion"];
            $Evento_Lesionados = $obj["lesionados"];
            $Evento_Fallecidos = $obj["fallecidos"];
            $Evento_Desaparecidos = $obj["desaparecidos"];
            $Evento_Viv_Inhabitables = $obj["inhabitables"];
            $Evento_Viv_Colapsadas = $obj["colapsadas"];
            $Evento_Danios_Fecha = str_replace("-","/",$Evento_Danios_Fecha);
            $dateTime = $Evento_Danios_Fecha;
            $dateTime = explode(" ", $dateTime);
            $fecha = explode("/", $dateTime[0]);
            $Evento_Danios_Fecha = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0] . " " . $dateTime[1] . ":00";
            $this->EventoRegistrarDanios_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $this->EventoRegistrarDanios_model->setEvento_Danios_Fecha($Evento_Danios_Fecha);
            $this->EventoRegistrarDanios_model->setEvento_Danios_Fuente($Evento_Danios_Fuente);
            $this->EventoRegistrarDanios_model->setEvento_Danios_Descripcion($Evento_Danios_Descripcion);
            $this->EventoRegistrarDanios_model->setEvento_Lesionados($Evento_Lesionados);
            $this->EventoRegistrarDanios_model->setEvento_Fallecidos($Evento_Fallecidos);
            $this->EventoRegistrarDanios_model->setEvento_Desaparecidos($Evento_Desaparecidos);
            $this->EventoRegistrarDanios_model->setEvento_Viv_Inhabitables($Evento_Viv_Inhabitables);
            $this->EventoRegistrarDanios_model->setEvento_Viv_Colapsadas($Evento_Viv_Colapsadas);
            $this->EventoRegistrarDanios_model->setUsuario($usuario);
            $cantidad = $this->EventoRegistrarDanios_model->contarDanios();
            if ($cantidad > 0)
                $this->EventoRegistrarDanios_model->setPrimero('1');
            else
                $this->EventoRegistrarDanios_model->setPrimero('0');
            $status = 500;
            $response = "Error al registrar, vuelva a intentar";
            if ($this->EventoRegistrarDanios_model->registrarApp()) {
                $status = 202;
                $code = 1;
                $response = "Daño registrado exitosamente";
            }
        }
        $data = array(
            "status" => $status,
            "message" => $message,
            "token" => $token,
            "code" => $code,
            "response" => $response,
            "Evento_Registro_Numero" => $Evento_Registro_Numero
        );
        echo json_encode($data);
    }

    public function lesionados()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $total = 0;
        $Evento_Registro_Numero = "";
        $situacion = "";
        $nivelgravedad = "";
        $tipodocumento = "";
        if ($status == 202) {
            $this->load->model("EventoRegistrar_model");
            $this->load->model("Situacion_model");
            $this->load->model("NivelGravedad_model");
            $this->load->model("EventoRegistrarDaniosLesionados_model");
            $this->load->model("TipoDocumento_model");
            $Evento_Registro_Numero = $obj["Evento_Registro_Numero"];
            $status = 200;
            $situacion = $this->Situacion_model->lista();
            $situacion = $situacion->result();
            $nivelgravedad = $this->NivelGravedad_model->lista();
            $nivelgravedad = $nivelgravedad->result();
            $tipodocumento = $this->TipoDocumento_model->lista();
            $tipodocumento = $tipodocumento->result();
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $total = $this->EventoRegistrarDaniosLesionados_model->lesionados();
            $total = $total->row();
            $total = $total->total;
        }
        $json = array(
            "message" => $message,
            "status" => $status,
            "token" => $token,
            "total_lesionados" => $total,
            "situacion" => $situacion,
            "nivelgravedad" => $nivelgravedad,
            "tipodocumento" => $tipodocumento,
            "Evento_Registro_Numero" => $Evento_Registro_Numero
        );
        echo json_encode($json);
    }

    public function registrarLesionado()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $idusuario = $respuesta["user"];
        $Evento_Registro_Numero = "";
        $code = 1;
        $response="";
        if ($status == 202) {
            $this->load->model("EventoRegistrarDaniosLesionados_model");
            $Evento_Danios_Lesionados_Fecha_Atencion = $obj["Evento_Danios_Lesionados_Fecha_Atencion"];
            $Lesionado_Documento_Numero = $obj["Lesionado_Documento_Numero"];
            $Lesionado_Apellidos = $obj["Lesionado_Apellidos"];
            $Lesionado_Nombres = $obj["Lesionado_Nombres"];
            $Lesionado_Edad = $obj["Lesionado_Edad"];
            $Lesionado_Observaciones = $obj["Lesionado_Observaciones"];
            $Nivel_Gravedad_Codigo = $obj["Nivel_Gravedad_Codigo"];
            $Situacion_Codigo = $obj["Situacion_Codigo"];
            $Lesionado_CIE10_Codigo = $obj["Lesionado_CIE10_Codigo"];
            $Tipo_Documento_Codigo = $obj["Tipo_Documento_Codigo"];
            $Evento_Registro_Numero = $obj["Evento_Registro_Numero"];
            $Evento_Danios_Lesionados_ID = "0";
            $Lesionado_Genero = $obj["Lesionado_Genero"];
            $Lesionado_Gestante = $obj["Lesionado_Gestante"];
            $Lesionado_Entidad_Salud_Codigo = $obj["Lesionado_Entidad_Salud_Codigo"];
            $Lesionado_Entidad_Salud_Nombre = $obj["Lesionado_Entidad_Salud_Nombre"];
            $Lesionado_Personal_Salud = $obj["Lesionado_Personal_Salud"];
            $Lesionado_CIE10_Codigo = explode(" - ",$Lesionado_CIE10_Codigo);
            $Evento_Danios_Lesionados_Fecha_Atencion = str_replace("-","/",$Evento_Danios_Lesionados_Fecha_Atencion);
            $fE = explode(" ", $Evento_Danios_Lesionados_Fecha_Atencion);
            $fechaEventoAtencion = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00";
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_Fecha_Atencion($fechaEventoAtencion);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Documento_Numero($Lesionado_Documento_Numero);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Apellidos(strtoupper($Lesionado_Apellidos));
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Nombres(strtoupper($Lesionado_Nombres));
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Edad($Lesionado_Edad);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Observaciones($Lesionado_Observaciones);
            $this->EventoRegistrarDaniosLesionados_model->setNivel_Gravedad_Codigo($Nivel_Gravedad_Codigo);
            $this->EventoRegistrarDaniosLesionados_model->setSituacion_Codigo($Situacion_Codigo);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_CIE10_Codigo($Lesionado_CIE10_Codigo[0]);
            $this->EventoRegistrarDaniosLesionados_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $this->EventoRegistrarDaniosLesionados_model->setEvento_Danios_Lesionados_ID($Evento_Danios_Lesionados_ID);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Genero($Lesionado_Genero);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Gestante($Lesionado_Gestante);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Entidad_Salud_Codigo($Lesionado_Entidad_Salud_Codigo);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Entidad_Salud_Nombre($Lesionado_Entidad_Salud_Nombre);
            $this->EventoRegistrarDaniosLesionados_model->setLesionado_Personal_Salud($Lesionado_Personal_Salud);
            $this->EventoRegistrarDaniosLesionados_model->setUsuario($idusuario);
            if ($this->EventoRegistrarDaniosLesionados_model->registrarApp()) {
                $status = 200;
                $code = 1;
                $response = "Lesionado registrado";
            } else {
                $status = 500;
                $response = "Error al registrar lesionado";
            }
        }
        $data = array(
            "status" => $status,
            "message" => $message,
            "token" => $token,
            "code" => $code,
            "response" => $response,
            "Evento_Registro_Numero" => $Evento_Registro_Numero
        );
        echo json_encode($data);
    }

    public function listaEnfermedades()
    {
        $this->load->model("EventoDetalle_model");
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $listaEnfermedades = "";
        if ($status == 202) {
            $this->load->model("EventoRegistrarDaniosLesionados_model");
            $listaEnfermedades = $this->EventoRegistrarDaniosLesionados_model->listaEnfermedades();
            $listaEnfermedades = $listaEnfermedades->result();
        }
        echo json_encode($listaEnfermedades);
    }

    public function acciones()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $total = 0;
        $Evento_Registro_Numero = "";
        $screen = 0;
		$tipoaccion = "";
        if ($status == 202) {
            $this->load->model("EventoRegistrar_model");
            $this->load->model("EventoAcciones_model");
			$this->load->model("TipoAccion_model");
            $Evento_Registro_Numero = $obj["Evento_Registro_Numero"];
            if (strlen($Evento_Registro_Numero) < 1) {
                $status = $respuesta["status"];
            } else {
                $this->EventoAcciones_model->setEvento_Registro_Numero($Evento_Registro_Numero);
                $acciones = $this->EventoAcciones_model->accion();
				$this->EventoRegistrar_model->setId($Evento_Registro_Numero);
				$tipoaccion = $this->TipoAccion_model->listar();
				$tipoaccion = $tipoaccion->result();
                if ($acciones->num_rows() > 0)
                    $screen = 1;
                $accion = $acciones->first_row();
            }
        }
        $json = array(
            "message" => $message,
            "status" => $status,
            "token" => $token,
            "total" => $total,
            "accion" => $accion,
			"acciones"=> $acciones->result(),
            "screen" => $screen,
			"tipoaccion" => $tipoaccion,
            "Evento_Registro_Numero" => $Evento_Registro_Numero
        );
        echo json_encode($json);
    }

    public function listarAccionEntidad()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $lista = "";
        if ($status == 202) {
            $this->load->model("TipoAccionEntidad_model");
            $tipoAccionCodigo = $obj["Tipo_Accion_Codigo"];
            $this->TipoAccionEntidad_model->setTipo_Accion_Codigo($tipoAccionCodigo);
            $lista = $this->TipoAccionEntidad_model->listar();
            $lista = $lista->result();
        }
        echo json_encode($lista);
    }

    public function registrarAccion()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = $respuesta["status"];
        $idusuario = $respuesta["user"];
        $total = 0;
        $Evento_Registro_Numero = "";
		$code=0;
        if ($status == 202) {
            $this->load->model("EventoAcciones_model");
            $Evento_Registro_Numero = $obj["Evento_Registro_Numero"];
            $Evento_Acciones_Fecha = $obj["Evento_Acciones_Fecha"];
            $Tipo_Accion_Codigo = $obj["Tipo_Accion_Codigo"];
            $Tipo_Accion_Entidad_Codigo = $obj["Tipo_Accion_Entidad_Codigo"];
            $Evento_Acciones_Descripcion = $obj["Evento_Acciones_Descripcion"];
            $Evento_Acciones_Region = $obj["Evento_Acciones_Region"];
            $Evento_Acciones_Minsa = $obj["Evento_Acciones_Minsa"];
            $Evento_Acciones_Rescatisitas = $obj["Evento_Acciones_Rescatistas"];
            $Evento_Acciones_Medicos_Tacticos = $obj["Evento_Acciones_Medicos_Tacticos"];
            $Evento_Acciones_Emt_i = $obj["Evento_Acciones_Emt_i"];
            $Evento_Acciones_Emt_ii = $obj["Evento_Acciones_Emt_ii"];
            $Evento_Acciones_Emt_iii = $obj["Evento_Acciones_Emt_iii"];
            $Evento_Acciones_Celula_Especializada = $obj["Evento_Acciones_Celula_Especializada"];
            $Evento_Acciones_Minsa_Samu = $obj["Evento_Acciones_Minsa_Samu"];
            $Evento_Acciones_Salud_Minsa = $obj["Evento_Acciones_Salud_Minsa"];
            $Evento_Acciones_Essalud = $obj["Evento_Acciones_Essalud"];
            $Evento_Acciones_Municipalidades_Gores = $obj["Evento_Acciones_Municipalidades_Gores"];
            $Evento_Acciones_Voluntarios = $obj["Evento_Acciones_Voluntarios"];
            $Evento_Acciones_FFAA = $obj["Evento_Acciones_FFAA"];
            $Evento_Ambulancias_Minsa_Samu = $obj["Evento_Ambulancias_Minsa_Samu"];
            $Evento_Ambulancias_Minsa = $obj["Evento_Ambulancias_Minsa"];
            $Evento_Ambulancias_Essalud = $obj["Evento_Ambulancias_Essalud"];
            $Evento_Ambulancias_Bomberos = $obj["Evento_Ambulancias_Bomberos"];
            $Evento_Ambulancias_Municipalidades_Gores = $obj["Evento_Ambulancias_Municipalidades_Gores"];
            $Evento_Ambulancias_PNP_FFAA = $obj["Evento_Ambulancias_PNP_FFAA"];
            $Evento_Ambulancianas_Privadas = $obj["Evento_Ambulancianas_Privadas"];
            $Evento_Maletin_Emergencias_Desastres = $obj["Evento_Maletin_Emergencias_Desastres"];
            $Evento_Kit_Medicamentos_Insumos = $obj["Evento_Kit_Medicamentos_Insumos"];
            $Evento_Acciones_Equipo_Biomedicos = $obj["Evento_Acciones_Equipo_Biomedicos"];
            $Evento_Acciones_Puesto_Comando = $obj["Evento_Acciones_Puesto_Comando"];
            $Evento_Acciones_Ac_Victimas = $obj["Evento_Acciones_Ac_Victimas"];
            $Evento_Acciones_Oferta_Movil_i = $obj["Evento_Acciones_Oferta_Movil_i"];
            $Evento_Acciones_Oferta_Movil_ii = $obj["Evento_Acciones_Oferta_Movil_ii"];
            $Evento_Acciones_Oferta_Movil_iii = $obj["Evento_Acciones_Oferta_Movil_iii"];
            $Evento_Acciones_Hospital_Modular = $obj["Evento_Acciones_Hospital_Modular"];
            $Evento_Banio_Quimico_Portatil = $obj["Evento_Banio_Quimico_Portatil"];
            $Evento_Acciones_Fecha = str_replace("-","/",$Evento_Acciones_Fecha);
            $fE = explode(" ", $Evento_Acciones_Fecha);
            $Evento_Acciones_Fecha = formatearFechaParaBD($fE[0]) . " " . $fE[1] . ":00";
            $this->EventoAcciones_model->setEvento_Registro_Numero($Evento_Registro_Numero);
            $this->EventoAcciones_model->setEvento_Acciones_Fecha($Evento_Acciones_Fecha);
            $this->EventoAcciones_model->setTipo_Accion_Codigo($Tipo_Accion_Codigo);
            $this->EventoAcciones_model->setTipo_Accion_Entidad_Codigo($Tipo_Accion_Entidad_Codigo);
            $this->EventoAcciones_model->setEvento_Acciones_Descripcion($Evento_Acciones_Descripcion);
            $this->EventoAcciones_model->setEvento_Acciones_Region($Evento_Acciones_Region);
            $this->EventoAcciones_model->setEvento_Acciones_Minsa($Evento_Acciones_Minsa);
            $this->EventoAcciones_model->setEvento_Rescatistas($Evento_Acciones_Rescatisitas);
            $this->EventoAcciones_model->setEvento_Medicos_Tacticos($Evento_Acciones_Medicos_Tacticos);
            $this->EventoAcciones_model->setEvento_Acciones_Emt_i($Evento_Acciones_Emt_i);
            $this->EventoAcciones_model->setEvento_Acciones_Emt_ii($Evento_Acciones_Emt_ii);
            $this->EventoAcciones_model->setEvento_Acciones_Emt_iii($Evento_Acciones_Emt_iii);
            $this->EventoAcciones_model->setEvento_Acciones_Celula_Especializada($Evento_Acciones_Celula_Especializada);
            $this->EventoAcciones_model->setEvento_Acciones_Minsa_Samu($Evento_Acciones_Minsa_Samu);
            $this->EventoAcciones_model->setEvento_Acciones_Salud_Minsa($Evento_Acciones_Salud_Minsa);
            $this->EventoAcciones_model->setEvento_Acciones_Essalud($Evento_Acciones_Essalud);
            $this->EventoAcciones_model->setEvento_Acciones_Municipalidades_Gores($Evento_Acciones_Municipalidades_Gores);
            $this->EventoAcciones_model->setEvento_Acciones_Voluntarios($Evento_Acciones_Voluntarios);
            $this->EventoAcciones_model->setEvento_Acciones_PNP_FFAA($Evento_Acciones_FFAA);
            $this->EventoAcciones_model->setEvento_Ambulancias_Minsa_Samu($Evento_Ambulancias_Minsa_Samu);
            $this->EventoAcciones_model->setEvento_Ambulancias_Minsa($Evento_Ambulancias_Minsa);
            $this->EventoAcciones_model->setEvento_Ambulancias_Essalud($Evento_Ambulancias_Essalud);
            $this->EventoAcciones_model->setEvento_Ambulancias_Bomberos($Evento_Ambulancias_Bomberos);
            $this->EventoAcciones_model->setEvento_Ambulancias_Municipalidades_Gores($Evento_Ambulancias_Municipalidades_Gores);
            $this->EventoAcciones_model->setEvento_Ambulancias_PNP_FFAA($Evento_Ambulancias_PNP_FFAA);
            $this->EventoAcciones_model->setEvento_Ambulancianas_Privadas($Evento_Ambulancianas_Privadas);
            $this->EventoAcciones_model->setEvento_Maletin_Emergencias_Desastres($Evento_Maletin_Emergencias_Desastres);
            $this->EventoAcciones_model->setEvento_Kit_Medicamentos_Insumos($Evento_Kit_Medicamentos_Insumos);
            $this->EventoAcciones_model->setEvento_Acciones_Equipo_Biomedicos($Evento_Acciones_Equipo_Biomedicos);
            $this->EventoAcciones_model->setEvento_Acciones_Puesto_Comando($Evento_Acciones_Puesto_Comando);
            $this->EventoAcciones_model->setEvento_Acciones_Ac_Victimas($Evento_Acciones_Ac_Victimas);
            $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_i($Evento_Acciones_Oferta_Movil_i);
            $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_ii($Evento_Acciones_Oferta_Movil_ii);
            $this->EventoAcciones_model->setEvento_Acciones_Oferta_Movil_iii($Evento_Acciones_Oferta_Movil_iii);
            $this->EventoAcciones_model->setEvento_Acciones_Hospital_Modular($Evento_Acciones_Hospital_Modular);
            $this->EventoAcciones_model->setEvento_Banio_Quimico_Portatil($Evento_Banio_Quimico_Portatil);
            $this->EventoAcciones_model->setUsuario($idusuario);
            $status = 500;
            $message = "Error en el proceso";
            if ($this->EventoAcciones_model->registrarApp()) {
                $status = 200;
                $message = "Accion registrada";
				$code=1;
            }
        }
        $json = array(
            "message" => $message,
            "status" => $status,
            "token" => $token,			
            "code" => $code,
            "Evento_Registro_Numero" => $Evento_Registro_Numero
        );
        echo json_encode($json);
    }

    public function enviarCorreo()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $latitud = $obj["latitud"];
        $longitud = $obj["longitud"];
        $imagen = $obj["imagen"];

        $tipoEvento = $obj["tipoEvento"];
        $evento = $obj["evento"];
        $descripcion = $obj["descripcion"];
        $img = $imagen;
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $imagen = uniqid() . '.jpg';
        $file = getenv("PATH_IMG_APP") . $imagen;
        $success = file_put_contents($file, $data);
        $data = array(
            "latitud" => $latitud,
            "longitud" => $longitud,
            "tipoEvento" => $tipoEvento,
            "evento" => $evento,
            "descripcion" => $descripcion,
            "imagen" => $imagen
        );
        $html = $this->load->view("app/email", $data, true);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= getenv("CORREO_EVENTO_FROM") . "\r\n";
        $headers .= getenv("CORREO_EVENTO_FROM_BCC") . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        if (mail(getenv("CORREO_EVENTO_APP"), getenv("CORREO_EVENTO_ASUNTO"), $html, $headers)) {
            echo json_encode(array(
                "status" => 200,
                "message" => "El mensaje ha sido enviado"
            ));
        } else {

            echo json_encode(array(
                "status" => 500,
                "message" => "No se puedo enviar el mensaje"
            ));
        }
        ;
    }

    public function appTipoEvento()
    {
        $this->load->model("EventoTipo_model");
        $tipo = $this->EventoTipo_model->lista();
        $tipo = ($tipo->num_rows() > 0) ? $tipo->result() : "";
        echo json_encode($tipo);
    }

    public function appEvento()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $this->load->model("Evento_model");
        $tipoEvento = $obj["tipoEvento"];
        $lista = $this->Evento_model->setTipoEvento($tipoEvento);
        $lista = $this->Evento_model->listaTipo();
        $lista = ($lista->num_rows() > 0) ? $lista->result() : "";
        echo json_encode($lista);
    }
	
	public function curl() {
        $json = file_get_contents("php://input");
        $obj = json_decode($json, true);
        $token = $obj["token"];
        $respuesta = $this->validar_usuario($token);
        $message = $respuesta["message"];
        $status = 202;
        $respuesta["status"];
        $code=0;
        $gender = "";
        $lastname = "";
        $name = "";
        $age = "";
        $attributes = "";
        $url = "";
        if ($status == 202) {
            $tipo_documento = $obj["type"];
            $documento = $obj["document"];
            $url = getenv("API_RENIEC_URL").$tipo_documento."/".$documento."/";
            try{
            $handler = curl_init();
            curl_setopt($handler, CURLOPT_URL, getenv("API_RENIEC_URL").$tipo_documento."/".$documento."/");
            curl_setopt($handler, CURLOPT_HEADER, FALSE);
            curl_setopt($handler, CURLOPT_HTTPHEADER,array("Authorization: ".getenv("API_RENIEC_TOKEN"),"Content-Type: application/json"));
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
            $data = curl_exec($handler);
            $code = curl_getinfo ($handler, CURLINFO_HTTP_CODE);
            curl_close($handler);
                $status = 200;
                $code = 1;
            }
            catch(Exception $e) {
                $status = 500;
                $code = 0;
            }
            $data = json_decode($data);
            $attributes = $data->data;
            $datos = $attributes->attributes;
            $gender = $datos->sexo;
            $lastname = $datos->apellido_paterno." ".$datos->apellido_materno;
            $name = $datos->nombres;
            $age = $datos->edad_anios;
        }
        $json = array(
            "message" => $message,
            "status" => $status,
            "token" => $token,
            "code" => $code,
            "gender" => $gender,
            "lastname" => $lastname,
            "name" => $name,
            "age" => $age,
            "url" => $url
        );
        echo json_encode($json);
    }
    
    private function saveImage($evento,$latitud,$longitud,$eventoTipo) {        
        $url = "https://maps.googleapis.com/maps/api/staticmap?center=".trim($latitud).",".trim($longitud)."&markers=color:red|label:|".trim($latitud).",".trim($longitud)."&zoom=17&size=596x280&key=".getenv('MAP_KEY');
        $path = getenv('PATH_IMG');
        $img = $path.$evento."_gm.png";        
        file_put_contents($img, file_get_contents($url));        
        if ($eventoTipo == "26") {
            $url2 = "https://maps.googleapis.com/maps/api/staticmap?center=".trim($latitud).",".trim($longitud)."&markers=color:red|label:|".trim($latitud).",".trim($longitud)."&zoom=17&size=200x280&key=".getenv('MAP_KEY');
            $path = getenv('PATH_IMG');
            $img2 = $path.$evento."_gm_s.png";            
            file_put_contents($img2, file_get_contents($url2));
        }
    }    
}
