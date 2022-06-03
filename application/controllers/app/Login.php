<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function doLogin()
    {
        $this->load->model("usuario_model");
        $this->load->model("menu_model");
		$json = file_get_contents("php://input");
		$obj = json_decode($json,true);
		$usuario = $obj["user"];
		$pass = $obj["password"];
        $this->usuario_model->setUsuario($usuario);
        $this->usuario_model->setPassword($pass);
        $this->usuario_model->setAnio_Ejecucion(date("Y"));
        $result = $this->usuario_model->iniciar();
        $message = "";
        $status = "0";
        $token = "";
        $user = "";
        if ($result->num_rows() > 0) {
            $row = $result->row();
                $message = "Bienvenido " . $row->usuario;
                $data_token["user"] = $row->idusuario;
                $data_token["idrol"] = $row->idrol;
                $data_token["region"] = $row->Codigo_Region;
                $data_token["time"] = time();
                $token = JWT::encode($data_token,getenv("SECRET_SERVER_KEY"));
                $user = $row->usuario;
                $status = "1";
        } else {
            $message = "Usuario o clave incorrecta";
        }
        $json = array(
            "message" => $message,
            "status" => $status,
            "token" => $token,
            "user" => $user
        );
        echo json_encode($json);
    }
}