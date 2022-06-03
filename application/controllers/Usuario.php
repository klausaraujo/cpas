<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        
        if ($this->session->userdata("idrol")) {
            
            $idrol = $this->session->userdata("idrol");
            
            $permanecer = false;
            
            if($idrol==1 or $idrol==2 or $idrol==3) $permanecer = true;
            
            if ($permanecer == false)
                redirect('errores/accesoDenegado');
        } else {
            redirect("login");
        }
        
    }

    public function perfil()
    {
        
        $this->load->model("Usuario_model");        
        $this->load->view("perfil");
        
    }

    public function inbox()
    {
        
        $this->load->model("Usuario_model");  
        $id = $this->session->userdata("idusuario");
        $this->Usuario_model->setId($id);

        $lista = $this->Usuario_model->listaChat();
        if($lista->num_rows()>0){
            $listaUsuarios = $lista->result();
        }
        else {
            $listaUsuarios = array();
        }
        $data = array(
            "Codigo_Usuario_Registro" => $this->session->userdata("idusuario"),
            "uuid" => $this->session->userdata("uuid"),
            "listaDetalle" => json_encode($listaUsuarios),
            "lista" => $listaUsuarios
        );    
        $this->load->view("usuarios/inbox", $data);
        
    }

    public function password()
    {
        $this->load->model("Usuario_model");
        
        $actual = $this->input->post("old_password");
        $password = $this->input->post("password");
        $id = $this->session->userdata("usuario");

        $this->Usuario_model->setPassword($actual);
        $this->Usuario_model->setId($id);
        $status = 500;
        
        $message = 'Contrase&ntilde;a actual no coincide'+ $id;
        $validacion = $this->Usuario_model->validar_password();
        
        if($validacion==1){
            $this->Usuario_model->setPassword($password);
            $message = 'No se pudo actualizar la contrase&ntilde;a';
            if ($this->Usuario_model->password() == 1){
                $message = 'La contrase&ntilde;a ha sido actualizada';
                $status = 200;
            }
        }
        
        echo json_encode(array("status"=>$status,"message"=>$message));
    }

    public function editarImagen()
    {
        $this->load->model("Usuario_model");
        $idusuario = $this->session->userdata("idusuario");
        $avatar = $this->session->userdata("avatar");
        $path = getenv('PATH_IMG_IMAGEN');
        $estado = 0;
        $imagen = "";
        
        if($avatar!="user.jpg") unlink($path . $avatar); // delete image
        
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            
            
            if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/png") {
                
                $name = $idusuario.date("Ymdhis");
                $data = $_FILES["file"]['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $imagen = $name.'.'.$ext;
                $size = ((int) filesize($_FILES["file"]["tmp_name"]) / 1024);
                
                redim($_FILES["file"]["tmp_name"],$path.$name.'.'.$ext,400,400);
                $this->Usuario_model->setId($idusuario);
                $this->Usuario_model->setAvatar($name.'.'.$ext);
                if($this->Usuario_model->imagen()>0){
                    $status = 200;
                    $this->session->set_userdata("avatar",$name.'.'.$ext);
                }
                $mensaje = "Imagen actualizada";
                
            } else {
                $estado = - 3;
                $message = ERROR_IMAGEN_FORMATO;
            }
        }
        echo json_encode(array("status"=>$status,"estado"=>$estado,"imagen"=>$imagen,"mensaje"=>$mensaje));
    }
    
}