<?php
/**
 * Created by JetBrains PhpStorm.
 * User: g3ck0
 * Date: 26/03/12
 * Time: 10:25 PM
 * To change this template use File | Settings | File Templates.
 */
class registro extends CI_Controller
{
    var $DatoFiscal=array("Nombre","Ap_Paterno","Ap_Materno","Telefono","Calle","NoExterior","NoInterior","Colonia",
        "CP","Estado","Municipio","Pais","ContactoNombre","ContactoEmail","ContactoTelefono","ContactoPuesto");
    var $usuario=array("RFC",'email','preguntasecreta','respuestasecreta',"tipoEmisor");
    function __construct()
    {
        parent::__construct();
        // Just in case the Database is not called in the config
        $this->load->database();

        // Load the URL helper so redirects work.
        $this->load->helper('url');

        // this is used for the CRUD
        $this->load->model('crud');
        //$this->crud->use_table('Usuarios');
        $this->crud->use_table($this->MDB->usuarios);
        // Enable the output profiler so you can see the db queries run.
        //$this->output->enable_profiler(TRUE);
    }

    /**
     * _unique_title
     *
     * This is a callback function for the form validation library. It checks
     * to make sure that a title is unique before saving a NEW entry.
     *
     * @param string $rfc
     * @access public
     * @return boolean
     */
    public function _unique_rfc($rfc = '')
    {
        // set the search criteria
        $criteria = array('RFC' => $rfc);
        // Check to see if the criteria is unique.
        if($this->crud->is_entry_unique($criteria))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('_unique_rfc', 'El RFC indicado ya esta en uso.');
            return FALSE;
        }
    }
    function _isRFC($rfc='')
    {
        $pattern ="/[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?/";
        if(preg_match($pattern,$rfc))
        {
            return TRUE;
        }else
        {
            $this->form_validation->set_message('_isRFC', 'No es un RFC válido.');
            return FALSE;
        }
    }

    public function _unique_email($email = '')
    {
        // set the search criteria
        $criteria = array('email' => $email);
        // Check to see if the criteria is unique.
        if($this->crud->is_entry_unique($criteria))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('_unique_email', 'El Email indicado ya esta en uso.');
            return FALSE;
        }
    }
    function _agregar($valor='')
    {
        $result=FALSE;
        $databaseusuario=array();
        foreach($this->usuario as $field){
            if(isset($_POST[$field])) $databaseusuario=array_merge($databaseusuario,array($field=>$_POST[$field]));
        }
        $databaseinformacion=array();
        foreach($this->DatoFiscal as $field){
            if($field=='Pais')
            {
                $databaseinformacion=array_merge($databaseinformacion,array($field=>'México'));
            }
            else
            if(isset($_POST[$field])) $databaseinformacion=array_merge($databaseinformacion,array($field=>$_POST[$field]));
        }
        $this->load->model('MRegistro');
        //$result=$this->MRegistro->registro($this->input->post('rfc'),$this->input->post('email'),$this->input->post('nombre'));
        $result= $this->MRegistro->registro($databaseusuario,$databaseinformacion);
        if($result == FALSE){
            $this->form_validation->set_message('_agregar', 'Error al agregar el registro.');
        }
        return $result;
    }
    public function add()
    {
        // Load Helpers as needed.
        //$this->load->helper(array('form', 'url','random_password'));
        $this->load->helper(array('form', 'url'));

        // Load Libraries as needed.
        $this->load->library('form_validation');

        // Rules Here
        $this->form_validation->set_rules('RFC', 'RFC',
            'required|min_length[12]|max_length[13]|callback__unique_rfc|xss_clean|callback__isRFC');
        $this->form_validation->set_rules('email', 'Email',
            'required|max_length[50]|valid_email|xss_clean|callback__unique_email');
        $this->form_validation->set_rules('Nombre', 'Nombre', 'required|xss_clean|min_length[3]|max_length[255]|callback__isControl');
        $this->form_validation->set_rules('Calle', 'Calle', 'required|xss_clean|min_length[3]|max_length[255]|callback__isControl');
        $this->form_validation->set_rules('NoInterior', 'No. Interior',
            'xss_clean|max_length[50]|callback__isControl');
        $this->form_validation->set_rules('NoExterior', 'No. Exterior',
            'required|xss_clean|min_length[1]|max_length[50]|callback__isControl');
        $this->form_validation->set_rules('Colonia', 'Colonia',
            'required|xss_clean|min_length[3]|max_length[255]|callback__isControl');
        $this->form_validation->set_rules('CP', 'C.P.', 'required|xss_clean|integer|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('Estado', 'Estado', 'required|xss_clean|min_length[3]|max_length[255]|callback__isControl');
        $this->form_validation->set_rules('Municipio', 'Municipio',
            'required|xss_clean|min_length[3]|max_length[255]|callback__isControl');
        //$this->form_validation->set_rules('Pais', 'pais', 'required|xss_clean|min_length[3]|max_length[50]|callback__isControl');
        $this->form_validation->set_rules('ContactoNombre', 'Contacto Nombre',
            'required|xss_clean|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('ContactoEmail', 'Contacto Email',
            'required|xss_clean|min_length[3]|max_length[255]|valid_email');
        $this->form_validation->set_rules('ContactoTelefono', 'Contacto Telefono',
            'required|xss_clean|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('ContactoPuesto', 'Contacto Puesto',
            'required|xss_clean|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('preguntasecreta', 'Pregunta Secreta',
            'required|xss_clean|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('respuestasecreta', 'Respuesta',
            'required|xss_clean|min_length[3]|max_length[100]');
        if($this->input->post('tipoemisor')==2){
            $this->form_validation->set_rules('Ap_Paterno', 'Ap. Paterno',
                'required|xss_clean|min_length[3]|max_length[255]|callback__isControl');
            $this->form_validation->set_rules('Ap_Materno', 'Ap. Materno',
                'required|xss_clean|min_length[3]|max_length[255]|callback__isControl');
            $this->form_validation->set_rules('Telefono', 'Telefono',
                'required|xss_clean|min_length[3]|max_length[255]|callback__isControl');
        }
        // Check to see if form passed validation rules
        if ($this->form_validation->run() == FALSE)
        {
            $database=array();
            foreach($this->usuario as $field){
                if(isset($_POST[$field])) $database=array_merge($database,array($field=>$_POST[$field]));
            }
            $databaseinformacion=array();
            foreach($this->usuario as $field){
                if(isset($_POST[$field])) $database=array_merge($database,array($field=>$_POST[$field]));
            }
            // Load the form as a var
            $data['informacion']=$database;
            $display['head']=$this->load->view('registro_head','',true);
            $display['content'] = $this->load->view('registro_add',$data,TRUE);

            // Display the page
            $this->load->view('inicio', $display);
        }
        else
        {
            //echo 'paso la primera validacion';
            $this->form_validation->set_rules('hdnerror', 'Error', 'callback__agregar');
            //echo 'se asigno la regla<br/>';
            if ($this->form_validation->run())
            {
                // Return to the index.
                // TODO: Falta la opcion de enviar el email.
                redirect('registro/exito');
                //echo '<br/>si paso la prueba';
            }
            else{
                $display['head']=$this->load->view('registro_head','',true);
                $display['content'] = $this->load->view('registro_add','',TRUE);
                // Display the page
                $this->load->view('inicio', $display);
            }
        }
    }
    function restart_password()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('mconfiguracion');
        $data['Mensaje_Resultado']='';
        $bRefrescar=true;
        if($this->input->post('submit') !== FALSE)
        {
            $this->form_validation->set_rules('user_name', 'Usuario',
                'required|min_length[12]|max_length[13]|xss_clean|');
            if ($this->form_validation->run() != FALSE)
            {
                $criteria=array(
                    'RFC'=>$this->input->post('user_name'),
                    'Estatus'=>1,
                    'preguntasecreta !='=>'',
                    'respuestasecreta !='=>''
                );
                $query=$this->crud->retrieve($criteria);
                if($query->num_rows() > 0)
                {
                    //le voy a poner un nombre que nada que ver con lo que significara para tratar de evitar intrusiones
                    $row=$query->row_array();
                    $data['lista']=$this->input->post('user_name');
                    $data['pregunta']=$row['preguntasecreta'];
                    $display['content'] = $this->load->view('registro_pregunta',$data,TRUE);
                    $this->load->view('inicio', $display);
                    $bRefrescar=false;
                }
                else
                {
                    $data['Mensaje_Resultado']='Error al recuperar el usuario.';
                }
            }
        }
        if($bRefrescar==true)
        {
            $display['content'] = $this->load->view('registro_recuperar',$data,TRUE);
            $this->load->view('inicio', $display);
        }
    }
    function contestar()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('mconfiguracion');
        $data['Mensaje_Resultado']='';
        $bRefrescar=true;
        if($this->input->post('submit') !== FALSE)
        {
            /*
            $criteria=array(
                'RFC'=>xss_clean($this->input->post('lista')),
                'Estatus'=>1,
                'preguntasecreta'=>xss_clean($this->input->post('pregunta')),
                'respuestasecreta '=>md5($this->input->post('respuesta'))
            );
            //print_r($criteria);
            $query=$this->crud->retrieve($criteria);
            //print_r($query);
                        if($query->num_rows() > 0)
            {
                $pwd=get_random_password(8, 15, true, false,true);
                $registro=$query->
                $bRefrescar=false;
            }*/
            $this->load->model('MRegistro');
            if($this->MRegistro->reset_password($this->input->post('lista'),$this->input->post('pregunta'),$this->input->post('respuesta')))
            {
                $bRefrescar=false;
            }
            else
            {
                $data['Mensaje_Resultado']='No se pudo reestablecer la contraseña';
            }
        }
        if($bRefrescar==true)
        {
            $data['lista']=$this->input->post('lista');
            $data['pregunta']=$this->input->post('pregunta');
            $display['content'] = $this->load->view('registro_pregunta',$data,TRUE);
            $this->load->view('inicio', $display);
        }
        else{
            redirect("/");
        }
    }
    function exito(){
        $display['content']=$this->load->view('registro_exito','',true);
        $this->load->view('inicio',$display);
    }
    function _isControl($Control='')
    {
        $separador="|";
        $exist=strpos($Control,$separador);
        if(is_bool($exist))
        {
            return TRUE;
        }else
        {
            $this->form_validation->set_message('_isControl', 'No se permite el uso del caracter "|".');
            return FALSE;
        }
    }
}
