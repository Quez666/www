<?php


class Usuarios_model extends CI_Model{
	
	function ConsultarDatosUsuario($id_usuario){

		$query=$this->db->where('Id',$id_usuario);
		$query=$this->db->get('usuarios');
		return $query->row();
	}

}
?>