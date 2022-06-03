<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{

    public function agregarUsuario()
    {
        $usuario = $this->session->userdata("usuario_chat");
        
        $uid = $this->input - post("uid");
        $name = $this->input - post("name");
        $status = $this->input - post("status");
        $array = array(
            "uid" => $uid,
            "name" => $name,
            "status" => $status
        );
        $usuario[] = $array;
    }

    public function agregarMensaje()
    {
        $uid = $this->input->post("uid");
        
        $mensajes = $this->session->userdata("mensajes_chat" . $uid);
        
        if (count($mensajes) < 1) {
            $mensajes = array();
        }
        
        $mensaje = $this->input->post("mensaje");
        $nombre = $this->input->post("nombre");
        $hora = $this->input->post("hora");
        
        $mensaje = array(
            "nombre" => $nombre,
            "mensaje" => $mensaje,
            "hora" => $hora
        );
        
        $mensajes[] = $mensaje;
        
        $this->session->set_userdata("mensajes_chat" . $uid, $mensajes);
    }

    public function editarEstadoUsuario()
    {
        $uid = $this->input->post("uid");
        
        $mensajes = $this->session->userdata("mensajes_chat" . $uid);
        
        echo json_encode($mensajes);
    }
}