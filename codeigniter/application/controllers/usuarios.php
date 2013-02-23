<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
    //$data=array('joder'=>$joder,'mensaje'=>$mensaje,'destinatario'=>$destinatario);

	public function saludar($mensaje,$destinatario)
	{
		//$data=array('mensaje'=>$mensaje,'destinatario'=>$destinatario);
		$this->load->database();
		$this->load->model('usuarios_model');
		$info_usuario=$this->usuarios_model->ConsultarDatosUsuario($destinatario);
	    $data['destinatario']=$info_usuario->Nombre;
	    $data['mensaje']=$mensaje;
	    $this->load->view('saludo',$data);
	}
}

