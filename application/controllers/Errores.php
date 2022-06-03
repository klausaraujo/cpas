<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Errores extends CI_Controller
{

    public function accesoDenegado()
    {
        $this->load->view("error/error500");
    }
}
