<?php
/**
 * Created by JetBrains PhpStorm.
 * User: g3ck0
 * Date: 22/05/12
 * Time: 12:12 AM
 * To change this template use File | Settings | File Templates.
 */
class minicio extends CI_Model
{
    var $usuario=0;
    function __construct()
    {
        $this->usuario=-1;
    }
    function Usuario()
    {
        return $this->usuario;
    }
    function login($username,$pwd)
    {
        // this is used for the CRUD
	log_message('debug', 'Mlogin Intento de hacer login.');
        $this->load->model('crud');
        //$this->crud->use_table('Usuarios');
        $this->crud->use_table($this->MDB->usuarios);
        $result=false;
        $criteria=array(
            'RFC' => $username,
            'password' => md5($pwd),
            'Estatus' => '1'
        );
        //if($this->crud->count_results($criteria)>0)
        $query=$this->crud->retrieve($criteria);
        if($query->num_rows() > 0)
        {
	log_message('debug', 'Mlogin tuvo éxito.');
            $result=true;
            $row=$query->row_array();
            $this->usuario=$row['Id'];
            $this->load->model('mbitacora');
            $this->mbitacora->InicioSesion($this->usuario,'');
        }
	log_message('debug', 'Salida de login.');
        return $result;
    }
    function salir($usuario,$IP)
    {
	log_message('debug', 'Salida del sistema.');
        $this->load->model('mbitacora');
        $this->mbitacora->CerrarSesion($usuario,$IP);
    }
}
