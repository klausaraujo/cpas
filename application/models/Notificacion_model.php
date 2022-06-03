<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Notificacion_model extends CI_Model
{
    private $Data;
    private $Mensaje;
    private $Color;
    private $Topic;
    public function setData($data){$this->Data = $data;}
    public function setMensaje($data){$this->Mensaje = $data;}
    public function setColor($data){$this->Color = $data;}
    public function setTopic($data){$this->Topic = $data;}
    public function __construct()
    {
        parent::__construct();
    }
    public function enviarNotificacion()
    {
        $fields = array
        (
            'to' 	=> "/topics/".$this->Topic,
            'priority' 	=> "high",
            'notification'	=> $this->Mensaje,
            'data' => $this->Data,
            'color' => $this->Color,
        );
        $headers = array
        (
            'Authorization: key='.getenv('TOKEN_FIREBASE'),
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return $result;
    }
}