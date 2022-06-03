<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    class EventoEntidadSalud_model extends CI_Model
    {
        private $id;
        private $Evento_Registro_Numero;
        private $fecha;
        private $Evento_Entidad_Estado;
        private $CodEESS;
        private $agua;
        private $desague;
        private $energia_electrica;
        private $conectividad;
        private $radio;
        private $fija;
        private $celular;
        private $internet;
        private $techos;
        private $paredes;
        private $pisos;
        private $cercos;
        private $otros_lugares;
        private $inundacion;
        private $colapso;
        private $caida;
        private $goteras;
        private $fisuras;
        private $otros_consecuencias;
        private $emergencia;
        private $banco;
        private $obstetrico;
        private $quirurgico;
        private $uci;
        private $diagnostico;
        private $esterilizacion;
        private $laboratorio;
        private $ambulancias;
        private $farmacia;
        private $consultorios;
        private $otros;
        private $recuperacion_operatividad;
        private $continuidad_operativa;
        private $lugar;
        private $observaciones;
        public function setId($data){$this->id = $this->db->escape_str($data);}
        public function setEvento_Registro_Numero($data){$this->Evento_Registro_Numero = $this->db->escape_str($data);}
        public function setfecha($data){$this->fecha = $this->db->escape_str($data);}
        public function setEvento_Entidad_Estado($data){$this->Evento_Entidad_Estado = $this->db->escape_str($data);}
        public function setCodEESS($data){$this->CodEESS = $this->db->escape_str($data);}
        public function setagua($data){$this->agua = $this->db->escape_str($data);}
        public function setdesague($data){$this->desague = $this->db->escape_str($data);}
        public function setenergia_electrica($data){$this->energia_electrica = $this->db->escape_str($data);}
        public function setconectividad($data){$this->conectividad = $this->db->escape_str($data);}
        public function setradio($data){$this->radio = $this->db->escape_str($data);}
        public function setfija($data){$this->fija = $this->db->escape_str($data);}
        public function setcelular($data){$this->celular = $this->db->escape_str($data);}
        public function setinternet($data){$this->internet = $this->db->escape_str($data);}
        public function settechos($data){$this->techos = $this->db->escape_str($data);}
        public function setparedes($data){$this->paredes = $this->db->escape_str($data);}
        public function setpisos($data){$this->pisos = $this->db->escape_str($data);}
        public function setcercos($data){$this->cercos = $this->db->escape_str($data);}
        public function setotros_lugares($data){$this->otros_lugares = $this->db->escape_str($data);}
        public function setinundacion($data){$this->inundacion = $this->db->escape_str($data);}
        public function setcolapso($data){$this->colapso = $this->db->escape_str($data);}
        public function setcaida($data){$this->caida = $this->db->escape_str($data);}
        public function setgoteras($data){$this->goteras = $this->db->escape_str($data);}
        public function setfisuras($data){$this->fisuras = $this->db->escape_str($data);}
        public function setotros_consecuencias($data){$this->otros_consecuencias = $this->db->escape_str($data);}
        public function setemergencia($data){$this->emergencia = $this->db->escape_str($data);}
        public function setbanco($data){$this->banco = $this->db->escape_str($data);}
        public function setobstetrico($data){$this->obstetrico = $this->db->escape_str($data);}
        public function setquirurgico($data){$this->quirurgico = $this->db->escape_str($data);}
        public function setuci($data){$this->uci = $this->db->escape_str($data);}
        public function setdiagnostico($data){$this->diagnostico = $this->db->escape_str($data);}
        public function setesterilizacion($data){$this->esterilizacion = $this->db->escape_str($data);}
        public function setlaboratorio($data){$this->laboratorio = $this->db->escape_str($data);}
        public function setambulancias($data){$this->ambulancias = $this->db->escape_str($data);}
        public function setfarmacia($data){$this->farmacia = $this->db->escape_str($data);}
        public function setconsultorios($data){$this->consultorios = $this->db->escape_str($data);}
        public function setotros($data){$this->otros = $this->db->escape_str($data);}
        public function setrecuperacion_operatividad($data){$this->recuperacion_operatividad = $this->db->escape_str($data);}
        public function setcontinuidad_operativa($data){$this->continuidad_operativa = $this->db->escape_str($data);}
        public function setlugar($data){$this->lugar = $this->db->escape_str($data);}
        public function setObservaciones($data){$this->observaciones = $this->db->escape_str($data);}
        public function __construct()
        {
            parent::__construct();
        }
        public function registrar(){
            $data = array(
                "Evento_Registro_Numero" => $this->Evento_Registro_Numero,
                "fecha"=>$this->fecha,
                "Evento_Entidad_Estado"=>$this->Evento_Entidad_Estado,
                "CodEESS"=>$this->CodEESS,
                "agua"=>$this->agua,
                "desague"=>$this->desague,
                "energia_electrica"=>$this->energia_electrica,
                "conectividad"=>$this->conectividad,
                "radio"=>$this->radio,
                "fija"=>$this->fija,
                "celular"=>$this->celular,
                "internet"=>$this->internet,
                "techos"=>$this->techos,
                "paredes"=>$this->paredes,
                "pisos"=>$this->pisos,
                "cercos"=>$this->cercos,
                "otros_lugares"=>$this->otros_lugares,
                "inundacion"=>$this->inundacion,
                "colapso"=>$this->colapso,
                "caida"=>$this->caida,
                "goteras"=>$this->goteras,
                "fisuras"=>$this->fisuras,
                "otros_consecuencias"=>$this->otros_consecuencias,
                "emergencia"=>$this->emergencia,
                "banco"=>$this->banco,
                "obstetrico"=>$this->obstetrico,
                "quirurgico"=>$this->quirurgico,
                "uci"=>$this->uci,
                "diagnostico"=>$this->diagnostico,
                "esterilizacion"=>$this->esterilizacion,
                "laboratorio"=>$this->laboratorio,
                "ambulancias"=>$this->ambulancias,
                "farmacia"=>$this->farmacia,
                "consultorios"=>$this->consultorios,
                "otros"=>$this->otros,
                "recuperacion_operatividad"=>$this->recuperacion_operatividad,
                "continuidad_operativa"=>$this->continuidad_operativa,
                "lugar"=>$this->lugar,
                "Codigo_Usuario_Registro" => $this->session->userdata("idusuario"),
                "Fecha_Registro"=> date("Y-m-d H:i:s"),
                "observaciones"=>$this->observaciones
            );
            if ($this->db->insert('evento_entidad_salud', $data))
                return true;
                else
                    return false;
        }
        public function editar(){
            $this->db->set("fecha", $this->fecha, TRUE);
            $this->db->set("Evento_Entidad_Estado", $this->Evento_Entidad_Estado, TRUE);
            $this->db->set("CodEESS", $this->CodEESS, TRUE);
            $this->db->set("agua", $this->agua, TRUE);
            $this->db->set("desague", $this->desague, TRUE);
            $this->db->set("energia_electrica", $this->energia_electrica, TRUE);
            $this->db->set("conectividad", $this->conectividad, TRUE);
            $this->db->set("radio", $this->radio, TRUE);
            $this->db->set("fija", $this->fija, TRUE);
            $this->db->set("celular", $this->celular, TRUE);
            $this->db->set("internet", $this->internet, TRUE);
            $this->db->set("techos", $this->techos, TRUE);
            $this->db->set("paredes", $this->paredes, TRUE);
            $this->db->set("pisos", $this->pisos, TRUE);
            $this->db->set("cercos", $this->cercos, TRUE);
            $this->db->set("otros_lugares", $this->otros_lugares, TRUE);
            $this->db->set("inundacion", $this->inundacion, TRUE);
            $this->db->set("colapso", $this->colapso, TRUE);
            $this->db->set("caida", $this->caida, TRUE);
            $this->db->set("goteras", $this->goteras, TRUE);
            $this->db->set("fisuras", $this->fisuras, TRUE);
            $this->db->set("otros_consecuencias", $this->otros_consecuencias, TRUE);
            $this->db->set("emergencia", $this->emergencia, TRUE);
            $this->db->set("banco", $this->banco, TRUE);
            $this->db->set("obstetrico", $this->obstetrico, TRUE);
            $this->db->set("quirurgico", $this->quirurgico, TRUE);
            $this->db->set("uci", $this->uci, TRUE);
            $this->db->set("diagnostico", $this->diagnostico, TRUE);
            $this->db->set("esterilizacion", $this->esterilizacion, TRUE);
            $this->db->set("laboratorio", $this->laboratorio, TRUE);
            $this->db->set("ambulancias", $this->ambulancias, TRUE);
            $this->db->set("farmacia", $this->farmacia, TRUE);
            $this->db->set("consultorios", $this->consultorios, TRUE);
            $this->db->set("otros", $this->otros, TRUE);
            $this->db->set("recuperacion_operatividad", $this->recuperacion_operatividad, TRUE);
            $this->db->set("continuidad_operativa", $this->continuidad_operativa, TRUE);
            $this->db->set("lugar", $this->lugar, TRUE);
            $this->db->set("Fecha_Actualizacion", date("Y-m-d H:i:s"), TRUE);
            $this->db->set("Codigo_Usuario_Actualizacion", $this->session->userdata("idusuario"), TRUE);
            $this->db->set("observaciones", $this->observaciones, TRUE);
            $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
            $this->db->where("Evento_Entidad_Salud", $this->id);
            if ($this->db->update('evento_entidad_salud'))
                return true;
                else {
                    return false;
                }
        }
        public function lista()
        {
            $this->db->select("ees.Evento_Entidad_Salud,ees.CodEESS,md.Nombre,DATE_FORMAT(fecha,'%d/%m/%Y %H:%i') as fechaEES,DATE_FORMAT(recuperacion_operatividad,'%d/%m/%Y') as fechaRO");
            $this->db->select("ees.Evento_Entidad_Estado,ees.agua,ees.desague,ees.energia_electrica,ees.conectividad,ees.radio,ees.fija,ees.celular,ees.internet,ees.techos");
            $this->db->select("ees.paredes,ees.pisos,ees.cercos,ees.otros_lugares,ees.inundacion,ees.colapso,ees.caida,ees.goteras,ees.fisuras,ees.otros_consecuencias,ees.emergencia");
            $this->db->select("ees.banco,ees.obstetrico,ees.quirurgico,ees.uci,ees.diagnostico,ees.esterilizacion,ees.laboratorio,ees.ambulancias,ees.farmacia,ees.consultorios,ees.otros");
            $this->db->select("ees.recuperacion_operatividad,ees.continuidad_operativa,ees.lugar,ees.Evento_Registro_Numero, ees.observaciones,DATE_FORMAT(er.Evento_Fecha, '%d/%m/%Y') Evento_Fecha");
            $this->db->from("evento_entidad_salud ees");
            $this->db->join("md_eess md","md.CodEESS=ees.CodEESS",'LEFT');
            $this->db->join("evento_registro er","er.Evento_Registro_Numero=ees.Evento_Registro_Numero");
            $this->db->where("ees.Evento_Registro_Numero", $this->Evento_Registro_Numero);

            return $this->db->get();
        }
        public function eliminar()
        {
            $this->db->db_debug = FALSE;
            $this->db->where("Evento_Entidad_Salud", $this->id);
            $error = array();
            if ($this->db->delete('evento_entidad_salud'))
                return 1;
                else {
                    $error = $this->db->error();
                    return $error["code"];
                }
        }
        public function totalOperativas() 
        {
            $this->db->select("COUNT(1) TOTAL");
            $this->db->from("evento_entidad_salud");
            $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
            $this->db->where("Evento_Entidad_Estado", "1");
            return $this->db->get();
        }        
        public function totalInoperativas()
        {
            $this->db->select("COUNT(1) TOTAL");
            $this->db->from("evento_entidad_salud");
            $this->db->where("Evento_Registro_Numero", $this->Evento_Registro_Numero);
            $this->db->where("Evento_Entidad_Estado", "2");
            return $this->db->get();
        }
        public function tablaInforme()
        {
            $this->db->select("eess.CodCategoria,eess.Nombre,ees.lugar,ees.Evento_Entidad_Estado");
            $this->db->select("fn_provincia(SUBSTRING(eess.CodUbigeo,1,2),SUBSTRING(eess.CodUbigeo,3,2)) provincia");
            $this->db->select("fn_distrito(SUBSTRING(eess.CodUbigeo,1,2),SUBSTRING(eess.CodUbigeo,3,2),SUBSTRING(eess.CodUbigeo,5,2)) distrito");
            $this->db->from("evento_entidad_salud ees");
            $this->db->join("md_eess eess","ees.CodEESS=eess.CodEESS");
            $this->db->where_in("ees.Evento_Registro_Numero", $this->Evento_Registro_Numero);
            return $this->db->get();
        }
        
        public function mapaIpress() {
            $estado = array("1","2");
            $this->db->select("er.Evento_Ubigeo_Descripcion,er.Evento_Coordenadas,ees.Evento_Entidad_salud,eess.Norte latitud,eess.Este longitud,eess.Nombre,eess.Direccion,ees.Evento_Entidad_Estado");
            $this->db->from("evento_entidad_salud ees");
            $this->db->join("md_eess eess","ees.CodEESS=eess.CodEESS"); 
            $this->db->join("evento_registro er","er.Evento_Registro_Numero=ees.Evento_Registro_Numero");
            $this->db->where_in("er.Evento_Estado_Codigo", $estado);
            return $this->db->get();
        }
        public function mapaIpressDetalle() {
            $this->db->select("fecha,Evento_Entidad_Estado,fisuras,otros_consecuencias,emergencia,banco,obstetrico");
            $this->db->select("CodEESS,agua,desague,energia_electrica,conectividad,radio,fija,celular,internet,techos,paredes,pisos,cercos,");
            $this->db->select("quirurgico,uci,diagnostico,esterilizacion,laboratorio,ambulancias,farmacia,consultorios,otros");
            $this->db->select("recuperacion_operatividad,continuidad_operativa,lugar,otros_lugares,inundacion,colapso,caida,goteras");
            $this->db->from("evento_entidad_salud");
            $this->db->where_in("Evento_Entidad_salud", $this->id);
            return $this->db->get();
        }
    }