<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller
{
    private $permisos = null;

    function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");
        
        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");

        $this->session->set_userdata("idmodulo", 10);

        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");

        if(sha1($usuario)==$token->usuario){

            if (count($token->modulos)>0) {

                $listaModulos = $token->modulos;

                $permanecer = false;

                foreach ($listaModulos as $row) :
                if ($row->idmodulo == 10 and $row->estado == 1)
                    $permanecer = true;
                    endforeach;

                    if ($permanecer == false)
                        redirect('errores/accesoDenegado');
            } else {
                redirect("login");
            }

            if($this->permisos==null){ if($this->session->userdata("menu")) $this->permisos = $this->session->userdata("menu");}

        }else{
            redirect("login");
        }
    }
    
    public function index()
    {
        
        $nivel = 1;
        $idmenu = 11;
        
        validarPermisos($nivel,$idmenu,$this->permisos);
        
        $this->load->model("AnioEjecucion_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        $this->load->model("AlertaPronostico_model");

        $primero = 0;
        
        $lista = $this->EventoRegistrar_model->listaEventosOfertaMovil();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        
        if ($lista->num_rows() > 0) {
            foreach($lista->result() as $row):
            if ($row->prioridad == "1") {
                $primero = $row->Evento_Registro_Numero;
            }            
            endforeach;
            
            if ($primero == 0) {
                $primero = $lista->last_row()->Evento_Registro_Numero;
            }
            
        } 
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($primero);
        $datosDashBoard = $this->EventoTipoEntidadAtencionOfertaMovil_model->datosDashBoard();
        $grafico = $this->EventoTipoEntidadAtencionOfertaMovil_model->graficoDashboard();
        $pie = $this->EventoTipoEntidadAtencionOfertaMovil_model->pieDashboard();
        $lines = $this->EventoTipoEntidadAtencionOfertaMovil_model->linesDashboard();
        $polar = $this->EventoTipoEntidadAtencionOfertaMovil_model->polarChartDasboard();
        
        $labelCie = array();
        $dataCie = array();
        $i=0;
        if($grafico->num_rows()>0){
            foreach($grafico->result() as $row):
                $labelCie[$i]=$row->CIE10;
                $dataCie[$i]=$row->Cantidad;
                $i++;
            endforeach;
        }
        
        $labelPie = array();
        $dataPie = array();
        
        if($pie->num_rows()>0){
            $row = $pie->row();
            $labelPie[0]="I-ROJO";
            $dataPie[0]=$row->rojo;
            $labelPie[1]="II-AMARILLO";
            $dataPie[1]=$row->amarillo;
            $labelPie[2]="III y IV - VERDE";
            $dataPie[2]=$row->verde;
            $labelPie[3]="0 - FALLECIDO";
            $dataPie[3]=$row->fallecido;
        }

        $array_oferta = array();
        $array_fecha = array();
        $array_cantidad = array();

        $cantidadLines = array();        
        $fechas_total = array();
        
        $i = 0;
        $j = 0;
        if ($lines->num_rows() > 0) {
            $mayorFecha = date("Y-m-d", strtotime("1970-01-01"));
            foreach($lines->result() as $row):
            if (strtotime($row->fecha_convertir) > strtotime($mayorFecha)) {
                $mayorFecha = $row->fecha_convertir;
            }
            endforeach;
            
            $anterior = $lines->first_row()->Oferta_Movil;
            foreach($lines->result() as $row):
                if ($anterior != $row->Oferta_Movil) {
                    $anterior = $row->Oferta_Movil;
                    $i++;   
                }
                $array_oferta[$i] = $row->Oferta_Movil;
                $array_fecha[$i][$j] = $row->Fecha;
                $array_cantidad[$i][$j] = $row->Cantidad;
                $j++;
            endforeach;

            $mayorFecha = date("Y-m-d",strtotime($mayorFecha."+ 1 days")); 
            $fecha_actual = $mayorFecha;
            for($a=15;$a>=1;$a--) {
                $fechas_total[] = date("d/m/Y",strtotime($fecha_actual."- ".$a." days")); 
            }
            
            for($b=0;$b<count($array_oferta);$b++) {
                if (count($array_fecha[$b]) == 1) {
                    array_push($array_fecha[$b],"01/01/1969");
                }
                for($c=0;$c<count($fechas_total);$c++) {
                    $position = $this->buscarFecha($array_fecha[$b], $fechas_total[$c]);
                    if ($position > -1) {
                        $cantidadLines[$b][$c] = intval($array_cantidad[$b][$position]);
                    } else {
                        $cantidadLines[$b][$c] = null;
                    }
                    
                }
            }
            
        }
        
        $labelPolar = array();
        $dataPolar = array();
        $j=0;
        if($grafico->num_rows()>0){
            foreach($polar->result() as $row):
            $labelPolar[$j]=$row->Entidad." - ".$row->Oferta_Movil;
            $dataPolar[$j]=$row->Cantidad;
            $j++;
            endforeach;
        }
        
        $data = array(
            "lista" => $lista,
            "datosDashBoard" => $datosDashBoard->row(),
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "labelCie" => $labelCie,
            "dataCie" => $dataCie,
            "labelPie" => $labelPie,
            "dataPie" => $dataPie,
            "ofertaMovilLines" => $array_oferta,
            "fechaLines" => $fechas_total,
            "cantidadLines" => $cantidadLines,
            "labelPolar" => $labelPolar,
            "dataPolar" => $dataPolar,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("ofertamovil/Main", $data);
    }
    
    private function buscarFecha($fechas,$fecha) {
        $position = array_search($fecha, $fechas);
        if ($position === false) {
            return -1;
        } else {
            return $position;
        }
        
    }
    
    public function consolidado() {
        $this->load->model("Atenciones_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("AlertaPronostico_model");

        $primero = 0;
        $lista = $this->EventoRegistrar_model->listaEventosOfertaMovil();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $fecha_inicial = $this->input->post("fecha_inicial");
        $fecha_final = $this->input->post("fecha_final");

        if ($this->input->post("evento")) {
            $id = $this->input->post("evento");
            $this->Atenciones_model->setId($id);
            $primero = $id;
        }        
        else {

            if ($lista->num_rows() > 0) {
                foreach($lista->result() as $row):
                if ($row->prioridad == "1") {
                    $primero = $row->id;
                }
                endforeach;
                
                if ($primero == 0) {
                    $primero = $lista->last_row()->id;
                }

            }
            $this->Atenciones_model->setId($primero);
        }
        
        $this->Atenciones_model->setFechainicial($fecha_inicial);
        $this->Atenciones_model->setFechafinal($fecha_final);
        
        $atenciones = $this->Atenciones_model->lista();

        $data = Array(
            "primero" => $primero,
            "lista" => $lista,
            "atenciones" => $atenciones,
            "listaralerta" => $listaralerta
        );

        $this->load->view("ofertamovil/consolidado", $data);
    }
    
    public function recargarDataDashboard() {
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        
        $id = $this->input->post("id");
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($id);
        $datosDashBoard = $this->EventoTipoEntidadAtencionOfertaMovil_model->datosDashBoard();
        $db = $datosDashBoard->row();
        
        $grafico = $this->EventoTipoEntidadAtencionOfertaMovil_model->graficoDashboard();
        $pie = $this->EventoTipoEntidadAtencionOfertaMovil_model->pieDashboard();
        $lines = $this->EventoTipoEntidadAtencionOfertaMovil_model->linesDashboard();
        $polar = $this->EventoTipoEntidadAtencionOfertaMovil_model->polarChartDasboard();
        
        $labelCie = array();
        $dataCie = array();
        $i=0;
        if($grafico->num_rows()>0){
            foreach($grafico->result() as $row):
            $labelCie[$i]=$row->CIE10;
            $dataCie[$i]=$row->Cantidad;
            $i++;
            endforeach;
        }
        
        $labelPie = array();
        $dataPie = array();

        if($pie->num_rows()>0){
            $row = $pie->row();
            $labelPie[0]="I-ROJO";
            $dataPie[0]=$row->rojo;
            $labelPie[1]="II-AMARILLO";
            $dataPie[1]=$row->amarillo;
            $labelPie[2]="III y IV - VERDE";
            $dataPie[2]=$row->verde;
            $labelPie[3]="0 - FALLECIDO";
            $dataPie[3]=$row->fallecido;
        }
        
        
        $array_oferta = array();
        $array_fecha = array();
        $array_cantidad = array();
        
        $cantidadLines = array();
        
        $i = 0;
        $j = 0;
        
        $fechas_total = array();
        if ($lines->num_rows() > 0) {
            $mayorFecha = date("Y-m-d", strtotime("1970-01-01"));
            foreach($lines->result() as $row):
                if (strtotime($row->fecha_convertir) > strtotime($mayorFecha)) {
                    $mayorFecha = $row->fecha_convertir;
                }
            endforeach;
            $anterior = $lines->first_row()->Oferta_Movil;
            foreach($lines->result() as $row):
            if ($anterior != $row->Oferta_Movil) {
                $anterior = $row->Oferta_Movil;
                $i++;
            }
            $array_oferta[$i] = $row->Oferta_Movil;
            $array_fecha[$i][$j] = $row->Fecha;
            $array_cantidad[$i][$j] = $row->Cantidad;
            $j++;
            endforeach;
            
            $mayorFecha = date("Y-m-d",strtotime($mayorFecha."+ 1 days"));

            $fecha_actual = $mayorFecha;
            for($a=15;$a>=1;$a--) {
                $fechas_total[] = date("d/m/Y",strtotime($fecha_actual."- ".$a." days"));
            }
            
            for($b=0;$b<count($array_oferta);$b++) {
                if (count($array_fecha[$b]) == 1) {
                    array_push($array_fecha[$b],"01/01/1969");
                }
                for($c=0;$c<count($fechas_total);$c++) {
                    $position = $this->buscarFecha($array_fecha[$b], $fechas_total[$c]);
                    if ($position > -1) {
                        $cantidadLines[$b][$c] = intval($array_cantidad[$b][$position]);
                    } else {
                        $cantidadLines[$b][$c] = null;
                    }
                    
                }
            }
            
        }

        $labelPolar = array();
        $dataPolar = array();
        $j=0;
        if($grafico->num_rows()>0){
            foreach($polar->result() as $row):
            $labelPolar[$j]=$row->Entidad." - ".$row->Oferta_Movil;
            $dataPolar[$j]=$row->Cantidad;
            $j++;
            endforeach;
        }

        $data = array(
            "t_total" => $db->total,
            "t_hombres" => $db->hombres,
            "t_hombres" => $db->hombres,
            "t_mujeres" => $db->mujeres,
            "t_gestantes" => $db->gestantes,
            "t_adulto_mayor" => $db->adulto_mayor,
            "t_menor_edad" => $db->menor_edad,
            "labelCie" => $labelCie,
            "dataCie" => $dataCie,
            "labelPie" => $labelPie,
            "dataPie" => $dataPie,
            "status" => 200,
            "ofertaMovilLines" => $array_oferta,
            "fechaLines" => $fechas_total,
            "cantidadLines" => $cantidadLines,
            "labelPolar" => $labelPolar,
            "dataPolar" => $dataPolar
        );
        
        echo json_encode($data);
        
    }
    
    public function nuevo() {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Brigadista_model");
        $this->load->model("Atenciones_model");
        $this->load->model("AlertaPronostico_model");

        $lista = $this->EventoRegistrar_model->listaEventosOfertaMovil();
        $medicamentos = $this->Atenciones_model->medicamentos();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $profesiones = $this->Brigadista_model->listaProfesiones();
        $rsPaises = $this->EventoTipoEntidadAtencion_model->paises();
        $paises = $rsPaises->result();
        $rsProfesionales = $this->EventoTipoEntidadAtencion_model->profesionales();
        $profesionales = $rsProfesionales->result();
        
        $data = array(
            "lista" => $lista,
            "tipodocumento" => $tipodocumento,
            "listaProfesiones" => $profesiones,
            "paises" => json_encode($paises),
            "medicamentos" => $medicamentos,
            "listaralerta" => $listaralerta,
            "profesionales" => json_encode($profesionales)
        );
        
        $this->load->view("ofertamovil/nuevo", $data);
    }
    
    public function editar() {
        $this->load->model("EventoRegistrar_model");
        $this->load->model("TipoDocumento_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("Brigadista_model");
        $this->load->model("Atenciones_model");
        $this->load->model("AlertaPronostico_model");

        $lista = $this->EventoRegistrar_model->listaEventosOfertaMovil();
        $medicamentos = $this->Atenciones_model->medicamentos();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        
        $profesiones = $this->Brigadista_model->listaProfesiones();
        $rsPaises = $this->EventoTipoEntidadAtencion_model->paises();
        $paises = $rsPaises->result();
        $id = $this->uri->segment(4,0);
        $id = base64_decode($id);
        $this->Atenciones_model->setId($id);
        $atencion = $this->Atenciones_model->atencion();
        $rsProfesionales = $this->EventoTipoEntidadAtencion_model->profesionales();
        $profesionales = $rsProfesionales->result();
        
        $atencion = $atencion->row();

        $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Registro_Profesionales_ID($atencion->evento_tipo_entidad_atencion_registro_profesionales_id);
        $profesional = $this->Atenciones_model->profesional();
        $tratamientos = $this->Atenciones_model->tratamientos();
        
        $cie10_Codigo1 = "";
        $cie10_Texto1 = "";
        $cie10_Codigo2 = "";
        $cie10_Texto2 = "";
        $cie10_Codigo3 = "";
        $cie10_Texto3 = "";

        $cie10 = $this->Atenciones_model->cie10();
        
        $i = 0;
        foreach($cie10->result() as $row):
        
        if ($i == 0) {
            $cie10_Codigo1 = $row->Id_CIE10;
            $cie10_Texto1 = $row->cie10_descripcion;
        }
        if ($i == 1) {
            $cie10_Codigo2 = $row->Id_CIE10;
            $cie10_Texto2 = $row->cie10_descripcion;
        }
        if ($i == 2){
            $cie10_Codigo3 = $row->Id_CIE10;
            $cie10_Texto3 = $row->cie10_descripcion;            
        }

        $i++;
        endforeach;
        
        $data = array(
            "lista" => $lista,
            "tipodocumento" => $tipodocumento,
            "listaProfesiones" => $profesiones,
            "paises" => json_encode($paises),
            "medicamentos" => $medicamentos,
            "atencion" => $atencion,
            "profesional" => $profesional->row(),
            "cie10_Codigo1" => $cie10_Codigo1,
            "cie10_Texto1" => $cie10_Texto1,
            "cie10_Codigo2" => $cie10_Codigo2,
            "cie10_Texto2" => $cie10_Texto2,
            "cie10_Codigo3" => $cie10_Codigo3,
            "cie10_Texto3" => $cie10_Texto3,
            "tratamientos" => $tratamientos,
            "listaralerta" => $listaralerta,
            "profesionales" => json_encode($profesionales)
        );
        
        $this->load->view("ofertamovil/editar", $data);
    }
    
    public function listaEspecialidades()
    {
        
        $this->load->model("Brigadista_model");
        
        $id = $this->input->post("id");
        
        $this->Brigadista_model->setBrigadistas_profesiones_id($id);
        $especialidades = $this->Brigadista_model->listaEspecialidades();
        
        echo json_encode(array("especialidades"=>$especialidades->result()));
        
    }
    
    public function buscarProfesional()
    {
        
        $this->load->model("Atenciones_model");
        
        $Documento_Numero = $this->input->post("document");
        $tipo = $this->input->post("type");
        
        
        $this->Atenciones_model->setTipo_Documento_Numero($Documento_Numero);
        $profesional = $this->Atenciones_model->buscarProfesional();
        
        $Nombre = "";
        $profesion = "";
        $Colegiatura = "";
        $brigadistas_especialidad_id = "";
        $profesion = "";
        $RNE = "";
        $ID ="";
        
        if ($profesional->num_rows() > 0) {
            $rs = $profesional->row();
            $Nombre = $rs->Nombre;
            $Colegiatura = $rs->Colegiatura;
            $brigadistas_especialidad_id = $rs->brigadistas_especialidad_id;
            $RNE = $rs->RNE;
            $profesion = $rs->profesion;
            $ID = $rs->id;
            
        } else {
            $data = $this->consultarReniec($tipo, $Documento_Numero);            
            $data = json_decode($data, true);
            $Nombre = $data["data"]["attributes"]["nombres"].", ".$data["data"]["attributes"]["apellido_paterno"]." ".$data["data"]["attributes"]["apellido_materno"];
        }
       
        echo json_encode(array("Nombre"=>$Nombre,"profesion"=>$profesion,"Colegiatura"=>$Colegiatura,"brigadistas_especialidad_id"=>$brigadistas_especialidad_id,"RNE"=>$RNE,"profesion"=>$profesion,"id"=>$ID));
        
    }

    public function buscarProfesional2()
    {
        
        $this->load->model("Atenciones_model");
        
        $Documento_Numero = $this->input->post("document");
        $tipo = $this->input->post("type");        
        $this->Atenciones_model->setTipo_Documento_Numero($Documento_Numero);
        $profesional = $this->Atenciones_model->buscarProfesional2();
        
        $Nombre = "";
        $profesion = "";
        $Colegiatura = "";
        $brigadistas_especialidad_id = "";
        $profesion = "";
        $RNE = "";
        $ID ="";
        $Documento_Numero1 ="";
        
        if ($profesional->num_rows() > 0) {
            $rs = $profesional->row();
            $Nombre = $rs->Nombre;
            $Colegiatura = $rs->Colegiatura;
            $brigadistas_especialidad_id = $rs->brigadistas_especialidad_id;
            $RNE = $rs->RNE;
            $profesion = $rs->profesion;
            $ID = $rs->id;
            $Documento_Numero1 = $rs->Documento_Numero1;
            
        }
       
        echo json_encode(array("Documento_Numero1"=>$Documento_Numero1, "Nombre"=>$Nombre,"profesion"=>$profesion,"Colegiatura"=>$Colegiatura,"brigadistas_especialidad_id"=>$brigadistas_especialidad_id,"RNE"=>$RNE,"profesion"=>$profesion,"id"=>$ID));
        
    }
        
    public function listaEventosOfertaMovilAjax() {
        
        $this->load->model("EventoRegistrar_model");
        $lista = $this->EventoRegistrar_model->listaEventosOfertaMovil();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
        
    }

    public function lista()
    {

      $nivel = 1;
      $idmenu = 11;

      validarPermisos($nivel,$idmenu,$this->permisos);      
      
        $this->load->model("AnioEjecucion_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("EventoTipoEntidadAtencion_model");      

        $lista = $this->EventoRegistrar_model->listaPorOfertaMovil();
        $rs = $this->EventoTipoEntidadAtencion_model->lista();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();

        $datos = array();

  		if($lista->num_rows()>0){
  			$orden = 1;
  			foreach($lista->result() as $row):

  				$datos[] = array(
  					"evento" => $row->evento,
  					"fecha" => $row->fecha,
  					"Evento_Estado_Codigo" => $row->Evento_Estado_Codigo,
  					"Evento_Registro_Numero" => $row->Evento_Registro_Numero,
  					"ubigeo" => $row->ubigeo,
  					"orden" => $orden,
  				    "total" => $row->total,
  					"codigo" => $row->ANIO." - ".addCeros5($row->Evento_Secuencia)
  				);
  			$orden++;

  			endforeach;

  		}

        $data = array(
            "lista" => $datos,
            "listaEntidadAtencion" => $rs->result(),
            "listaAnioEjecucion" => $listaAnioEjecucion
        );

        $this->load->view("ofertamovil/listaEventosFicha", $data);
    }
    
    public function listaAjax()
    {
        
        $this->load->model("EventoRegistrar_model");
        
        $lista = $this->EventoRegistrar_model->listaPorAtencion();
        $datos = array();
        if($lista->num_rows()>0){
            $orden = 1;
            foreach($lista->result() as $row):
            
            switch ($row->Evento_Estado_Codigo) {
                case 1:
                    $html = '<span class="label label-success">Monitoreo</span>';
                    break;
                case 2:
                    $html = '<span class="label label-default">Cerrado</span>';
                    break;
                case 3:
                    $html = '<span class="label label-danger">Anulado</span>';
                    break;
            }
            
            $editar = '<div class="pull-right"><i class="fa fa-trash actionDelete" aria-hidden="true"></i></div>';
            $eliminar = '<div class="pull-right"><i class="fa fa-pencil-square-o actionEdit" aria-hidden="true"></i></div>';

            $datos[] = array(
                "evento" => $row->evento,
                "fecha" => $row->fecha,
                "estado" => $html,
                "Evento_Registro_Numero" => $row->Evento_Registro_Numero,
                "ubicacion" => $row->ubigeo,
                "orden" => $orden,
                "correlativo" => $row->ANIO." - ".addCeros5($row->Evento_Secuencia),
                "Evento_Registro_Numero" => $row->Evento_Registro_Numero,
                "tipo" => $row->tipoEvento,
                "detalle" => $row->eventoDetalle,
                "descripcion" => $row->Evento_Descripcion,
                "id" => $row->id,
                "editar" => $editar,
                "eliminar" => $eliminar,
                "descripcionAtencion" => $row->descripcionAtencion
            );
            $orden++;            
            endforeach;
            
        }
        
        echo json_encode(array("data" => $datos));

    }
    
    public function gestionarAtencionEvento() {

        $status = 500;
        
        $id = $this->input->post("id");
        $Registro_Evento_Numero = $this->input->post("Registro_Evento_Numero");
        $descripcion = $this->input->post("descripcion");
        
        if (strlen($Registro_Evento_Numero) >  0 and strlen($descripcion) > 0) {            
            
            if(strlen($id) == 0 or $id==0) {
                $status = $this->registrarAtencion($Registro_Evento_Numero, $descripcion);
            } else {
                $status = $this->actualizarAtencion($Registro_Evento_Numero, $descripcion, $id);
            }           
            
        }     

        echo json_encode(array("status" => $status));
        
    }
    
    public function eliminarAtencion() {
        $status = 500;        
        $id = $this->input->post("id");
        $this->load->model("EventoRegistrar_model");
        $this->EventoRegistrar_model->setId($id);
        if ($this->EventoRegistrar_model->eliminarAtencion()) {
            $status = 200;
        }
        echo json_encode(array("status" => $status));        
    }
    
    private function registrarAtencion($Registro_Evento_Numero, $descripcion) {
        
        $this->load->model("EventoRegistrar_model");
        $status = 500;
        
        $this->EventoRegistrar_model->setId($Registro_Evento_Numero);
        $this->EventoRegistrar_model->setDescripcionGeneral($descripcion);
    
        if ($this->EventoRegistrar_model->existeAtencionRegistro()) {
            $status = 201;
        } else {
            if ($this->EventoRegistrar_model->registrarAtencionRegistro() > 0) {
                $status = 200;
            }
            
        }
        
        return $status;
    
    }
    
    private function actualizarAtencion($Registro_Evento_Numero, $descripcion, $id) {
        
        $this->load->model("EventoRegistrar_model");
        $status = 500;
        
        $this->EventoRegistrar_model->setId($id);
        $this->EventoRegistrar_model->setIdrol($Registro_Evento_Numero);
        $this->EventoRegistrar_model->setDescripcionGeneral($descripcion);
        
        if ($this->EventoRegistrar_model->existeAtencionRegistroDiferenteId()) {
            $status = 201;
        } else {
            if ($this->EventoRegistrar_model->editarAtencionRegistro() > 0) {
                $status = 200;
            }
            
        }
        
        return $status;
        
    }
    
    public function eventosAjax() {

        $this->load->model("EventoRegistrar_model");
        
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $mes = $this->input->post("mes");
        
        $data = array();
        
        if (strlen($Anio_Ejecucion) > 0 and strlen($mes) > 0) {
            
            $this->EventoRegistrar_model->setAnio($Anio_Ejecucion);
            $this->EventoRegistrar_model->setMes($mes);
            
            $lista = $this->EventoRegistrar_model->listaEventosPorAnioYMes();
            
            if ($lista->num_rows() > 0) {
                $orden = 1;
                foreach ($lista->result() as $row) :
                
                switch ($row->Evento_Estado_Codigo) {
                    case 1:
                        $html = '<span class="label label-success">Monitoreo</span>';
                        break;
                    case 2:
                        $html = '<span class="label label-default">Cerrado</span>';
                        break;
                    case 3:
                        $html = '<span class="label label-danger">Anulado</span>';
                        break;
                }
                
                $data[] = array(
                    "evento" => $row->evento,
                    "fecha" => $row->fecha,
                    "ubicacion" => $row->ubigeo,
                    "estado" => $html,
                    "correlativo" => $row->ANIO." - ".addCeros5($row->Evento_Secuencia),
                    "orden" => $orden,
                    "seleccionar" => '<a href="'.base_url().'ofertamovil/fichas/lista/'.base64_encode($row->Evento_Registro_Numero).'">seleccionar</a>',
                    "id" => $row->Evento_Registro_Numero,
                    "tipo" => $row->tipoEvento,
                    "detalle" => $row->eventoDetalle,
                    "descripcion" => $row->Evento_Descripcion
                );
                $orden++;
                endforeach ;
            }
        }
        
        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);
    }

    public function EventoTipoEntidadAtencionOfertaMovilListaEvento(){
        
        $this->load->model("Atenciones_model");
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        
        $id = $this->input->post("id");
        
        $this->Atenciones_model->setId($id);
        $data = $this->Atenciones_model->EventoOfertaMovil();
        
        $Evento_Registro_Numero = $data->row()->Evento_Registro_Numero;
        
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $rs = $this->EventoTipoEntidadAtencionOfertaMovil_model->lista();
        
        echo json_encode(array("lista"=>$rs->result()));
        
    }
    
    public function EventoTipoEntidadAtencionOfertaMovilLista(){
        
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $rs = $this->EventoTipoEntidadAtencionOfertaMovil_model->lista();
        
        echo json_encode(array("lista"=>$rs->result()));
        
    }
    
    public function EventoTipoEntidadAtencionOfertaMovilRegistrar(){
        
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Tipo_Entidad_Atencion_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_ID");
        $Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre = $this->input->post("Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre");
        
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Tipo_Entidad_Atencion_ID($Evento_Tipo_Entidad_Atencion_ID);
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre($Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre);
        
        $id = 0;
        $data = array();
        $result = $this->EventoTipoEntidadAtencionOfertaMovil_model->existe();
        if($result->num_rows()>0)
            $data=array("status"=>409,"id"=>$id);
            else {
                $id = $this->EventoTipoEntidadAtencionOfertaMovil_model->registrar();
                $data=array("status"=>200,"id"=>$id);
            }
            echo json_encode($data);
            
    }
    
    public function eventoTipoEntidadAtencionOfertaMovilEliminar(){
        
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        $this->load->model("EventoFichaAtencionDetalle_model");
        
        $id = $this->input->post("id");
        
        $this->EventoFichaAtencionDetalle_model->setEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID($id);
        $rs = $this->EventoFichaAtencionDetalle_model->contarEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID();
        
        $rsRow = $rs->row();
        $total = $rsRow->total;
        
        if($total>0){
            $this->session->set_flashdata('messageError', 'No se puede eliminar, existen registros en atenciones');
        }
        else{
            $this->EventoTipoEntidadAtencionOfertaMovil_model->setId($id);
            if($this->EventoTipoEntidadAtencionOfertaMovil_model->eliminar()==1) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        }
        
        redirect('ofertamovil');
    }

    public function EliminarRe(){
        
        $this->load->model("Atenciones_model");
        
        $id = $this->input->post("id");
        
        $this->Atenciones_model->setId($id);
        
        if($this->Atenciones_model->eliminar_atenciones_cie()==1 && $this->Atenciones_model->eliminar_atenciones_tratamiento()==1 && $this->Atenciones_model->eliminar_registro_atenciones()==1) 
        $this->session->set_flashdata('messageOK', 'Registro eliminado');
        
        else $this->session->set_flashdata('messageError', 'No se puede eliminar, existen registros en atenciones'); 
                
        redirect('ofertamovil/main/consolidado');
    }

    public function curl() {

        $tipo_documento = $this->input->post("type");
        $documento = $this->input->post("document");
        $data = $this->consultarReniec($tipo_documento, $documento);
        echo $data;
        
    }
    public function consultarReniec($tipo_documento, $documento) {
        
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, getenv("API_RENIEC_URL").$tipo_documento."/".$documento."/");
        curl_setopt($handler, CURLOPT_HEADER, FALSE);
        curl_setopt($handler, CURLOPT_HTTPHEADER,array("Authorization: ".getenv("API_RENIEC_TOKEN"),"Content-Type: application/json"));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($handler);
        $code = curl_getinfo ($handler, CURLINFO_HTTP_CODE);
        
        curl_close($handler);
        
        return $data;
    }

    private function formatearFechaHora($fecha_hora) {
        
        $fh = explode(" ",$fecha_hora);
        $fecha = formatearFechaParaBD($fh[0]);
        $hora = $fh[1];
        return $fecha." ".$hora;
        
    }
    
    public function registrarEventoAtencion() {
        
        $this->load->model("Atenciones_model");
        
        $Evento_Tipo_Entidad_Atencion_Registro_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_Registro_ID");
        $Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID");
        $PreHospitalario = ($this->input->post("PreHospitalario"))?"1":"0";
        $PreHospitalario_Entidad = $this->input->post("PreHospitalario_Entidad");
        $PMA_Oferta_Movil = ($this->input->post("PMA_Oferta_Movil"))?"1":"0";
        $Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID");
        $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
        $Tipo_Documento_Numero = $this->input->post("Tipo_Documento_Numero");
        $Paciente = $this->input->post("Paciente");
        $Nacimiento = $this->input->post("Nacimiento");
        $Edad = $this->input->post("Edad");
        $Genero = $this->input->post("Genero");
        $Gestante = $this->input->post("Gestante");
        $Discapacidad = $this->input->post("Discapacidad");
        $Discapacidad_Tipo = $this->input->post("Discapacidad_Tipo");
        $Apoderado = $this->input->post("Apoderado");
        $Pais_Procedencia = $this->input->post("Pais_Procedencia");
        $Lugar_Residencia = $this->input->post("Lugar_Residencia");
        $Enfermedad_Dias = $this->input->post("Enfermedad_Dias");
        $Enfermedad_Meses = $this->input->post("Enfermedad_Meses");
        $Fecha_Hora_Sintomas = $this->input->post("Fecha_Hora_Sintomas");
        $Fecha_Hora_Atencion = $this->input->post("Fecha_Hora_Atencion");
        $PAS = $this->input->post("PAS");
        $PAD = $this->input->post("PAD");
        $FC = $this->input->post("FC");
        $FR = $this->input->post("FR");
        $SO2 = $this->input->post("SO2");
        $FIO2 = $this->input->post("FIO2");
        $Dificultad_Respiratoria = $this->input->post("Dificultad_Respiratoria");
        $Tos = $this->input->post("Tos");
        $Rinorrea = $this->input->post("Rinorrea");
        
        $alteracion_conciencia = $this->input->post("alteracion_conciencia");
        $dolor_pecho = $this->input->post("dolor_pecho");
        
        $Fiebre = $this->input->post("Fiebre");
        $Nauseas = $this->input->post("Nauseas");
        $Vomitos = $this->input->post("Vomitos");
        $Dolor_Abdominal = $this->input->post("Dolor_Abdominal");
        $Diarrea = $this->input->post("Diarrea");
        $Otros = $this->input->post("Otros");
        $Vac_Influenza = $this->input->post("Vac_Influenza");
        $Vac_Fiebre = $this->input->post("Vac_Fiebre");
        $Vac_Sarampion = $this->input->post("Vac_Sarampion");
        $Vac_Hepatitis = $this->input->post("Vac_Hepatitis");
        $Vac_Tetanos = $this->input->post("Vac_Tetanos");
        $Vac_Otros = $this->input->post("Vac_Otros");
        $Vac_Otros_Detalle = $this->input->post("Vac_Otros_Detalle");
        $Lab_Fecha_Toma = $this->input->post("Lab_Fecha_Toma");
        $Lab_Fecha_Envio = $this->input->post("Lab_Fecha_Envio");
        $Lab_Fecha_Recepcion = $this->input->post("Lab_Fecha_Recepcion");
        $Lab_Resultados = $this->input->post("Lab_Resultados");
        $Destino = $this->input->post("Destino");
        $Lugar_Referencia = $this->input->post("Lugar_Referencia");
        $Responsable_Traslado = $this->input->post("Responsable_Traslado");
        $Condicion_Alta = $this->input->post("Condicion_Alta");
        $Tipo_Discapacidad = $this->input->post("Tipo_Discapacidad");
        
        $cie10_1_codigo = $this->input->post("cie10_1_codigo");
        $cie10_1_texto = $this->input->post("cie10_1_texto");
        $cie10_2_codigo = $this->input->post("cie10_2_codigo");
        $cie10_2_texto = $this->input->post("cie10_2_texto");
        $cie10_3_codigo = $this->input->post("cie10_3_codigo");
        $cie10_3_texto = $this->input->post("cie10_3_texto");
        $ObservacionesAtencion = $this->input->post("Observaciones");

        $dx1_covid_01=$this->input->post("dx1_covid_01");
        $dx1_covid_02=$this->input->post("dx1_covid_02");
        $dx1_covid_03=$this->input->post("dx1_covid_03");
        $dx2_insuficiencia=$this->input->post("dx2_insuficiencia");
        $dx2_neumonia=$this->input->post("dx2_neumonia");
        $dx2_faringitis=$this->input->post("dx2_faringitis");
        $dx2_shock=$this->input->post("dx2_shock");
        $dx3_hta=$this->input->post("dx3_hta");
        $dx3_dm=$this->input->post("dx3_dm");
        $dx3_obesidad=$this->input->post("dx3_obesidad");
        $dx3_insuficiencia_renal=$this->input->post("dx3_insuficiencia_renal");
        $dx3_otros=$this->input->post("dx3_otros");
        $aislamiento=$this->input->post("aislamiento");
        $hospitalizacion=$this->input->post("hospitalizacion");
        $area_interna_01=$this->input->post("area_interna_01");
        $area_externa_01=$this->input->post("area_externa_01");
        $shock_trauma=$this->input->post("shock_trauma");
        $uci=$this->input->post("uci");
        $area_interna_02=$this->input->post("area_interna_02");
        $area_externa_02=$this->input->post("area_externa_02");
        $observacion=$this->input->post("observacion");
        $area_interna_03=$this->input->post("area_interna_03");
        $area_externa_03=$this->input->post("area_externa_03");
        
        $dataTratamiento = ($this->input->post("dataTratamiento"))?$this->input->post("dataTratamiento"):array();
        
        $Clasificacion = $this->input->post("Clasificacion");
        
        if(strlen($Nacimiento) > 0) {
            $Nacimiento = formatearFechaParaBD($Nacimiento);
        }
        if(strlen($Fecha_Hora_Sintomas) > 0) {
            $Fecha_Hora_Sintomas = $this->formatearFechaHora($Fecha_Hora_Sintomas);
        }
        if(strlen($Fecha_Hora_Atencion) > 0) {
            $Fecha_Hora_Atencion = $this->formatearFechaHora($Fecha_Hora_Atencion);
        }
        
        if(strlen($Lab_Fecha_Toma) > 0) {
            $Lab_Fecha_Toma = $this->formatearFechaHora($Lab_Fecha_Toma);
        }
        if(strlen($Lab_Fecha_Envio) > 0) {
            $Lab_Fecha_Envio = $this->formatearFechaHora($Lab_Fecha_Envio);
        }
        if(strlen($Lab_Fecha_Recepcion) > 0) {
            $Lab_Fecha_Recepcion = $this->formatearFechaHora($Lab_Fecha_Recepcion);
        }

        $Documento_Numero = $this->input->post("Documento_Numero");
        $Nombre = $this->input->post("Nombre");
        $Colegiatura = $this->input->post("Colegiatura");
        $brigadistas_especialidad_id = $this->input->post("brigadistas_especialidad_id");
        $RNE = $this->input->post("RNE");
        
        $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Registro_ID($Evento_Tipo_Entidad_Atencion_Registro_ID);

        if (strlen($Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID) > 0) {

            $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Registro_Profesionales_ID($Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID);
        } else {

            $this->Atenciones_model->setDocumento_Numero($Documento_Numero);
            $this->Atenciones_model->setNombre(strtoupper($Nombre));
            $this->Atenciones_model->setColegiatura($Colegiatura);
            $this->Atenciones_model->setbrigadistas_especialidad_id($brigadistas_especialidad_id);
            $this->Atenciones_model->setRNE($RNE);
            $Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID = $this->Atenciones_model->registrarProfesional();
            $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Registro_Profesionales_ID($Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID);
        }

        $this->Atenciones_model->setPreHospitalario($PreHospitalario);
        $this->Atenciones_model->setPreHospitalario_Entidad($PreHospitalario_Entidad);
        $this->Atenciones_model->setPMA_Oferta_Movil($PMA_Oferta_Movil);
        $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID($Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID);
        $this->Atenciones_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
        $this->Atenciones_model->setTipo_Documento_Numero($Tipo_Documento_Numero);
        $this->Atenciones_model->setPaciente($Paciente);
        $this->Atenciones_model->setNacimiento($Nacimiento);
        $this->Atenciones_model->setEdad($Edad);
        $this->Atenciones_model->setGenero($Genero);
        $this->Atenciones_model->setGestante($Gestante);
        $this->Atenciones_model->setDiscapacidad($Discapacidad);
        $this->Atenciones_model->setDiscapacidad_Tipo($Discapacidad_Tipo);
        $this->Atenciones_model->setApoderado($Apoderado);
        $this->Atenciones_model->setPais_Procedencia($Pais_Procedencia);
        $this->Atenciones_model->setLugar_Residencia($Lugar_Residencia);
        $this->Atenciones_model->setEnfermedad_Dias($Enfermedad_Dias);
        $this->Atenciones_model->setEnfermedad_Meses($Enfermedad_Meses);
        $this->Atenciones_model->setFecha_Hora_Sintomas($Fecha_Hora_Sintomas);
        $this->Atenciones_model->setFecha_Hora_Atencion($Fecha_Hora_Atencion);
        $this->Atenciones_model->setPAS($PAS);
        $this->Atenciones_model->setPAD($PAD);
        $this->Atenciones_model->setFC($FC);
        $this->Atenciones_model->setFR($FR);
        $this->Atenciones_model->setSO2($SO2);
        $this->Atenciones_model->setFIO2($FIO2);
        $this->Atenciones_model->setDificultad_Respiratoria($Dificultad_Respiratoria);
        $this->Atenciones_model->setTos($Tos);
        $this->Atenciones_model->setRinorrea($Rinorrea);
        $this->Atenciones_model->setFiebre($Fiebre);

        $this->Atenciones_model->setAlteracion_conciencia($alteracion_conciencia);
        $this->Atenciones_model->setDolor_pecho($dolor_pecho);

        $this->Atenciones_model->setNauseas($Nauseas);
        $this->Atenciones_model->setVomitos($Vomitos);
        $this->Atenciones_model->setDolor_Abdominal($Dolor_Abdominal);
        $this->Atenciones_model->setDiarrea($Diarrea);
        $this->Atenciones_model->setOtros($Otros);
        $this->Atenciones_model->setVac_Influenza($Vac_Influenza);
        $this->Atenciones_model->setVac_Fiebre($Vac_Fiebre);
        $this->Atenciones_model->setVac_Sarampion($Vac_Sarampion);
        $this->Atenciones_model->setVac_Hepatitis($Vac_Hepatitis);
        $this->Atenciones_model->setVac_Tetanos($Vac_Tetanos);
        $this->Atenciones_model->setVac_Otros($Vac_Otros);
        $this->Atenciones_model->setVac_Otros_Detalle($Vac_Otros_Detalle);
        $this->Atenciones_model->setLab_Fecha_Toma($Lab_Fecha_Toma);
        $this->Atenciones_model->setLab_Fecha_Envio($Lab_Fecha_Envio);
        $this->Atenciones_model->setLab_Fecha_Recepcion($Lab_Fecha_Recepcion);
        $this->Atenciones_model->setLab_Resultados($Lab_Resultados);
        $this->Atenciones_model->setDestino($Destino);
        $this->Atenciones_model->setLugar_Referencia($Lugar_Referencia);
        $this->Atenciones_model->setResponsable_Traslado($Responsable_Traslado);
        $this->Atenciones_model->setCondicion_Alta($Condicion_Alta);
        $this->Atenciones_model->setClasificacion($Clasificacion);
        $this->Atenciones_model->setTipo_Discapacidad($Tipo_Discapacidad);
        $this->Atenciones_model->setObservacionesAtencion($ObservacionesAtencion);

        $this->Atenciones_model->setDx1_covid_01($dx1_covid_01);
        $this->Atenciones_model->setDx1_covid_02($dx1_covid_02);
        $this->Atenciones_model->setDx1_covid_03($dx1_covid_03);

        $this->Atenciones_model->setDx2_insuficiencia($dx2_insuficiencia);
        $this->Atenciones_model->setDx2_neumonia($dx2_neumonia);
        $this->Atenciones_model->setDx2_faringitis($dx2_faringitis);
        $this->Atenciones_model->setDx2_shock($dx2_shock);

        $this->Atenciones_model->setDx3_hta($dx3_hta);
        $this->Atenciones_model->setDx3_dm($dx3_dm);
        $this->Atenciones_model->setDx3_obesidad($dx3_obesidad);
        $this->Atenciones_model->setDx3_insuficiencia_renal($dx3_insuficiencia_renal);
        $this->Atenciones_model->setDx3_otros($dx3_otros);

        $this->Atenciones_model->setAislamiento($aislamiento);

        $this->Atenciones_model->setHospitalizacion($hospitalizacion);
        $this->Atenciones_model->setArea_interna_01($area_interna_01);
        $this->Atenciones_model->setArea_externa_01($area_externa_01);

        $this->Atenciones_model->setShock_trauma($shock_trauma);

        $this->Atenciones_model->setUci($uci);
        
        $this->Atenciones_model->setArea_interna_02($area_interna_02);
        $this->Atenciones_model->setArea_externa_02($area_externa_02);

        $this->Atenciones_model->setObservacion($observacion);
        $this->Atenciones_model->setArea_interna_03($area_interna_03);
        $this->Atenciones_model->setArea_externa_03($area_externa_01);

        $status = 500;

        $id = $this->Atenciones_model->registrar();

        if ($id > 0) {
            $status = 200;            
            $this->Atenciones_model->setId($id);
            if (strlen($cie10_1_codigo) > 0) {
                $this->Atenciones_model->setId_CIE10($cie10_1_codigo);
                $this->Atenciones_model->setTexto_CIE10($cie10_1_texto);
                $this->Atenciones_model->registrarCie10();
            }
            if (strlen($cie10_2_codigo) > 0) {
                $this->Atenciones_model->setId_CIE10($cie10_2_codigo);
                $this->Atenciones_model->setTexto_CIE10($cie10_2_texto);
                $this->Atenciones_model->registrarCie10();
            }
            if (strlen($cie10_3_codigo) > 0) {
                $this->Atenciones_model->setId_CIE10($cie10_3_codigo);
                $this->Atenciones_model->setTexto_CIE10($cie10_3_texto);
                $this->Atenciones_model->registrarCie10();
            }
        }
        
        if (count($dataTratamiento) > 0) {
            
            foreach($dataTratamiento as $row):
            $data = explode("||", $row);
            $Evento_Tipo_Entidad_Atencion_Registro_Medicamentos_ID = $data[0];
            $Total = $data[3];
            $Cantidad = $data[4];
            $Frecuencia = $data[5];
            $Via = $data[6];
            $Observaciones = $data[7];            
            
            $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Registro_Medicamentos_ID($Evento_Tipo_Entidad_Atencion_Registro_Medicamentos_ID);
            $this->Atenciones_model->setTotal($Total);
            $this->Atenciones_model->setCantidad($Cantidad);
            $this->Atenciones_model->setFrecuencia($Frecuencia);
            $this->Atenciones_model->setVia($Via);
            $this->Atenciones_model->setObservaciones($Observaciones);
            
            $this->Atenciones_model->registrarTratamiento();
            
            endforeach;
        }
        echo json_encode(array("status" => $status));

    }
    
    public function actualizarEventoAtencion() {
        
        $this->load->model("Atenciones_model");
        
        $Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID");
        $Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID");
        $PreHospitalario = ($this->input->post("PreHospitalario"))?"1":"0";
        $PreHospitalario_Entidad = $this->input->post("PreHospitalario_Entidad");
        $PMA_Oferta_Movil = ($this->input->post("PMA_Oferta_Movil"))?"1":"0";
        $Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID");
        $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
        $Tipo_Documento_Numero = $this->input->post("Tipo_Documento_Numero");
        $Paciente = $this->input->post("Paciente");
        $Nacimiento = $this->input->post("Nacimiento");
        $Edad = $this->input->post("Edad");
        $Genero = $this->input->post("Genero");
        $Gestante = $this->input->post("Gestante");
        $Discapacidad = $this->input->post("Discapacidad");
        $Discapacidad_Tipo = $this->input->post("Discapacidad_Tipo");
        $Apoderado = $this->input->post("Apoderado");
        $Pais_Procedencia = $this->input->post("Pais_Procedencia");
        $Lugar_Residencia = $this->input->post("Lugar_Residencia");
        $Enfermedad_Dias = $this->input->post("Enfermedad_Dias");
        $Enfermedad_Meses = $this->input->post("Enfermedad_Meses");
        $Fecha_Hora_Sintomas = $this->input->post("Fecha_Hora_Sintomas");
        $Fecha_Hora_Atencion = $this->input->post("Fecha_Hora_Atencion");
        $PAS = $this->input->post("PAS");
        $PAD = $this->input->post("PAD");
        $FC = $this->input->post("FC");
        $FR = $this->input->post("FR");
        $SO2 = $this->input->post("SO2");
        $FIO2 = $this->input->post("FIO2");
        $Dificultad_Respiratoria = $this->input->post("Dificultad_Respiratoria");
        $Tos = $this->input->post("Tos");
        $Rinorrea = $this->input->post("Rinorrea");
        $Fiebre = $this->input->post("Fiebre");

        $alteracion_conciencia = $this->input->post("alteracion_conciencia");
        $dolor_pecho = $this->input->post("dolor_pecho");        

        $Nauseas = $this->input->post("Nauseas");
        $Vomitos = $this->input->post("Vomitos");
        $Dolor_Abdominal = $this->input->post("Dolor_Abdominal");
        $Diarrea = $this->input->post("Diarrea");
        $Otros = $this->input->post("Otros");
        $Vac_Influenza = $this->input->post("Vac_Influenza");
        $Vac_Fiebre = $this->input->post("Vac_Fiebre");
        $Vac_Sarampion = $this->input->post("Vac_Sarampion");
        $Vac_Hepatitis = $this->input->post("Vac_Hepatitis");
        $Vac_Tetanos = $this->input->post("Vac_Tetanos");
        $Vac_Otros = $this->input->post("Vac_Otros");
        $Vac_Otros_Detalle = $this->input->post("Vac_Otros_Detalle");
        $Lab_Fecha_Toma = $this->input->post("Lab_Fecha_Toma");
        $Lab_Fecha_Envio = $this->input->post("Lab_Fecha_Envio");
        $Lab_Fecha_Recepcion = $this->input->post("Lab_Fecha_Recepcion");
        $Lab_Resultados = $this->input->post("Lab_Resultados");
        $Destino = $this->input->post("Destino");
        $Lugar_Referencia = $this->input->post("Lugar_Referencia");
        $Responsable_Traslado = $this->input->post("Responsable_Traslado");
        $Condicion_Alta = $this->input->post("Condicion_Alta");
        $Tipo_Discapacidad = $this->input->post("Tipo_Discapacidad");
        
        $cie10_1_codigo = $this->input->post("cie10_1_codigo");
        $cie10_1_texto = $this->input->post("cie10_1_texto");
        $cie10_2_codigo = $this->input->post("cie10_2_codigo");
        $cie10_2_texto = $this->input->post("cie10_2_texto");
        $cie10_3_codigo = $this->input->post("cie10_3_codigo");
        $cie10_3_texto = $this->input->post("cie10_3_texto");
        $ObservacionesAtencion = $this->input->post("Observaciones");
        
        $dx1_covid_01=$this->input->post("dx1_covid_01");
        $dx1_covid_02=$this->input->post("dx1_covid_02");
        $dx1_covid_03=$this->input->post("dx1_covid_03");
        $dx2_insuficiencia=$this->input->post("dx2_insuficiencia");
        $dx2_neumonia=$this->input->post("dx2_neumonia");
        $dx2_faringitis=$this->input->post("dx2_faringitis");
        $dx2_shock=$this->input->post("dx2_shock");
        $dx3_hta=$this->input->post("dx3_hta");
        $dx3_dm=$this->input->post("dx3_dm");
        $dx3_obesidad=$this->input->post("dx3_obesidad");
        $dx3_insuficiencia_renal=$this->input->post("dx3_insuficiencia_renal");
        $dx3_otros=$this->input->post("dx3_otros");
        $aislamiento=$this->input->post("aislamiento");
        $hospitalizacion=$this->input->post("hospitalizacion");
        $area_interna_01=$this->input->post("area_interna_01");
        $area_externa_01=$this->input->post("area_externa_01");
        $shock_trauma=$this->input->post("shock_trauma");
        $uci=$this->input->post("uci");
        $area_interna_02=$this->input->post("area_interna_02");
        $area_externa_02=$this->input->post("area_externa_02");
        $observacion=$this->input->post("observacion");
        $area_interna_03=$this->input->post("area_interna_03");
        $area_externa_03=$this->input->post("area_externa_03");

        $dataTratamiento = ($this->input->post("dataTratamiento"))?$this->input->post("dataTratamiento"):array();
        
        $Clasificacion = $this->input->post("Clasificacion");
        
        if(strlen($Nacimiento) > 0) {
            $Nacimiento = formatearFechaParaBD($Nacimiento);
        }
        if(strlen($Fecha_Hora_Sintomas) > 0) {
            $Fecha_Hora_Sintomas = $this->formatearFechaHora($Fecha_Hora_Sintomas);
        }
        if(strlen($Fecha_Hora_Atencion) > 0) {
            $Fecha_Hora_Atencion = $this->formatearFechaHora($Fecha_Hora_Atencion);
        }
        
        if(strlen($Lab_Fecha_Toma) > 0) {
            $Lab_Fecha_Toma = $this->formatearFechaHora($Lab_Fecha_Toma);
        }
        if(strlen($Lab_Fecha_Envio) > 0) {
            $Lab_Fecha_Envio = $this->formatearFechaHora($Lab_Fecha_Envio);
        }
        if(strlen($Lab_Fecha_Recepcion) > 0) {
            $Lab_Fecha_Recepcion = $this->formatearFechaHora($Lab_Fecha_Recepcion);
        }
        
        $Documento_Numero = $this->input->post("Documento_Numero");
        $Nombre = $this->input->post("Nombre");
        $Colegiatura = $this->input->post("Colegiatura");
        $brigadistas_especialidad_id = $this->input->post("brigadistas_especialidad_id");
        $RNE = $this->input->post("RNE");
        
        $this->Atenciones_model->setId($Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID);
        
        $this->Atenciones_model->eliminarTratamientos();
        $this->Atenciones_model->eliminarCIE10();
        
        if (strlen($Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID) > 0) {
            
            $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Registro_Profesionales_ID($Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID);
        } else {
            
            $this->Atenciones_model->setDocumento_Numero($Documento_Numero);
            $this->Atenciones_model->setNombre(strtoupper($Nombre));
            $this->Atenciones_model->setColegiatura($Colegiatura);
            $this->Atenciones_model->setbrigadistas_especialidad_id($brigadistas_especialidad_id);
            $this->Atenciones_model->setRNE($RNE);
            $Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID = $this->Atenciones_model->registrarProfesional();
            $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Registro_Profesionales_ID($Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID);
        }
        
        $this->Atenciones_model->setPreHospitalario($PreHospitalario);
        $this->Atenciones_model->setPreHospitalario_Entidad($PreHospitalario_Entidad);
        $this->Atenciones_model->setPMA_Oferta_Movil($PMA_Oferta_Movil);
        $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID($Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID);
        $this->Atenciones_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
        $this->Atenciones_model->setTipo_Documento_Numero($Tipo_Documento_Numero);
        $this->Atenciones_model->setPaciente($Paciente);
        $this->Atenciones_model->setNacimiento($Nacimiento);
        $this->Atenciones_model->setEdad($Edad);
        $this->Atenciones_model->setGenero($Genero);
        $this->Atenciones_model->setGestante($Gestante);
        $this->Atenciones_model->setDiscapacidad($Discapacidad);
        $this->Atenciones_model->setDiscapacidad_Tipo($Discapacidad_Tipo);
        $this->Atenciones_model->setApoderado($Apoderado);
        $this->Atenciones_model->setPais_Procedencia($Pais_Procedencia);
        $this->Atenciones_model->setLugar_Residencia($Lugar_Residencia);
        $this->Atenciones_model->setEnfermedad_Dias($Enfermedad_Dias);
        $this->Atenciones_model->setEnfermedad_Meses($Enfermedad_Meses);
        $this->Atenciones_model->setFecha_Hora_Sintomas($Fecha_Hora_Sintomas);
        $this->Atenciones_model->setFecha_Hora_Atencion($Fecha_Hora_Atencion);
        $this->Atenciones_model->setPAS($PAS);
        $this->Atenciones_model->setPAD($PAD);
        $this->Atenciones_model->setFC($FC);
        $this->Atenciones_model->setFR($FR);
        $this->Atenciones_model->setSO2($SO2);
        $this->Atenciones_model->setFIO2($FIO2);
        $this->Atenciones_model->setDificultad_Respiratoria($Dificultad_Respiratoria);
        $this->Atenciones_model->setTos($Tos);
        $this->Atenciones_model->setRinorrea($Rinorrea);
        $this->Atenciones_model->setFiebre($Fiebre);

        $this->Atenciones_model->setAlteracion_conciencia($alteracion_conciencia);
        $this->Atenciones_model->setDolor_pecho($dolor_pecho);        

        $this->Atenciones_model->setNauseas($Nauseas);
        $this->Atenciones_model->setVomitos($Vomitos);
        $this->Atenciones_model->setDolor_Abdominal($Dolor_Abdominal);
        $this->Atenciones_model->setDiarrea($Diarrea);
        $this->Atenciones_model->setOtros($Otros);
        $this->Atenciones_model->setVac_Influenza($Vac_Influenza);
        $this->Atenciones_model->setVac_Fiebre($Vac_Fiebre);
        $this->Atenciones_model->setVac_Sarampion($Vac_Sarampion);
        $this->Atenciones_model->setVac_Hepatitis($Vac_Hepatitis);
        $this->Atenciones_model->setVac_Tetanos($Vac_Tetanos);
        $this->Atenciones_model->setVac_Otros($Vac_Otros);
        $this->Atenciones_model->setVac_Otros_Detalle($Vac_Otros_Detalle);
        $this->Atenciones_model->setLab_Fecha_Toma($Lab_Fecha_Toma);
        $this->Atenciones_model->setLab_Fecha_Envio($Lab_Fecha_Envio);
        $this->Atenciones_model->setLab_Fecha_Recepcion($Lab_Fecha_Recepcion);
        $this->Atenciones_model->setLab_Resultados($Lab_Resultados);
        $this->Atenciones_model->setDestino($Destino);
        $this->Atenciones_model->setLugar_Referencia($Lugar_Referencia);
        $this->Atenciones_model->setResponsable_Traslado($Responsable_Traslado);
        $this->Atenciones_model->setCondicion_Alta($Condicion_Alta);
        $this->Atenciones_model->setClasificacion($Clasificacion);
        $this->Atenciones_model->setTipo_Discapacidad($Tipo_Discapacidad);
        $this->Atenciones_model->setObservacionesAtencion($ObservacionesAtencion);

        $this->Atenciones_model->setDx1_covid_01($dx1_covid_01);
        $this->Atenciones_model->setDx1_covid_02($dx1_covid_02);
        $this->Atenciones_model->setDx1_covid_03($dx1_covid_03);

        $this->Atenciones_model->setDx2_insuficiencia($dx2_insuficiencia);
        $this->Atenciones_model->setDx2_neumonia($dx2_neumonia);
        $this->Atenciones_model->setDx2_faringitis($dx2_faringitis);
        $this->Atenciones_model->setDx2_shock($dx2_shock);

        $this->Atenciones_model->setDx3_hta($dx3_hta);
        $this->Atenciones_model->setDx3_dm($dx3_dm);
        $this->Atenciones_model->setDx3_obesidad($dx3_obesidad);
        $this->Atenciones_model->setDx3_insuficiencia_renal($dx3_insuficiencia_renal);
        $this->Atenciones_model->setDx3_otros($dx3_otros);

        $this->Atenciones_model->setAislamiento($aislamiento);

        $this->Atenciones_model->setHospitalizacion($hospitalizacion);
        $this->Atenciones_model->setArea_interna_01($area_interna_01);
        $this->Atenciones_model->setArea_externa_01($area_externa_01);

        $this->Atenciones_model->setShock_trauma($shock_trauma);

        $this->Atenciones_model->setUci($uci);
        
        $this->Atenciones_model->setArea_interna_02($area_interna_02);
        $this->Atenciones_model->setArea_externa_02($area_externa_02);

        $this->Atenciones_model->setObservacion($observacion);
        $this->Atenciones_model->setArea_interna_03($area_interna_03);
        $this->Atenciones_model->setArea_externa_03($area_externa_01);
        
        $status = 500;
        
        $id = $this->Atenciones_model->actualizar();
        
        if ($id > 0) {
            $status = 200;
            $this->Atenciones_model->setId($id);
            if (strlen($cie10_1_codigo) > 0) {
                $this->Atenciones_model->setId_CIE10($cie10_1_codigo);
                $this->Atenciones_model->setTexto_CIE10($cie10_1_texto);
                $this->Atenciones_model->registrarCie10();
            }
            if (strlen($cie10_2_codigo) > 0) {
                $this->Atenciones_model->setId_CIE10($cie10_2_codigo);
                $this->Atenciones_model->setTexto_CIE10($cie10_2_texto);
                $this->Atenciones_model->registrarCie10();
            }
            if (strlen($cie10_3_codigo) > 0) {
                $this->Atenciones_model->setId_CIE10($cie10_3_codigo);
                $this->Atenciones_model->setTexto_CIE10($cie10_3_texto);
                $this->Atenciones_model->registrarCie10();
            }
        }

        if (count($dataTratamiento) > 0) {
            
            foreach($dataTratamiento as $row):
            $data = explode("||", $row);
            $Evento_Tipo_Entidad_Atencion_Registro_Medicamentos_ID = $data[0];
            $Total = $data[3];
            $Cantidad = $data[4];
            $Frecuencia = $data[5];
            $Via = $data[6];
            $Observaciones = $data[7];
            
            $this->Atenciones_model->setEvento_Tipo_Entidad_Atencion_Registro_Medicamentos_ID($Evento_Tipo_Entidad_Atencion_Registro_Medicamentos_ID);
            $this->Atenciones_model->setTotal($Total);
            $this->Atenciones_model->setCantidad($Cantidad);
            $this->Atenciones_model->setFrecuencia($Frecuencia);
            $this->Atenciones_model->setVia($Via);
            $this->Atenciones_model->setObservaciones($Observaciones);
            
            $this->Atenciones_model->registrarTratamiento();
            
            endforeach;
        }
        echo json_encode(array("status" => $status));
        
    }

}
