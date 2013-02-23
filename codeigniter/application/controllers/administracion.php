<?php
/**
 * Created by JetBrains PhpStorm.
 * User: g3ck0
 * Date: 15/06/12
 * Time: 12:03 AM
 * To change this template use File | Settings | File Templates.
 */
class administracion  extends CI_Controller
{
    private $usuario;
    private $limit=20;
    private $terms = array();
    private $terms_uri = array();
    private $IP;
    function __construct()
    {
        parent::__construct();
        /*if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->usuario=$this->session->userdata('user_administracion');
        //TODO: Falta la asignación de la IP
        $this->IP='';*/
    }

    function index()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data='';
        if($this->input->post('login') !== FALSE)
        {
            $this->form_validation->set_rules('user_name', 'Usuario', 'required|xss_clean');
            $this->form_validation->set_rules('user_pass', 'Contraseña', 'required|xss_clean');
            if($this->form_validation->run())
            {
                $this->load->model('madministracion');
                if($this->madministracion->login($this->input->post('user_name'),$this->input->post('user_pass'),$this->input->ip_address()))
                {
                    $data=array(
                        'login_state_administracion'=>true,
                        'usuario'=>$this->input->post('user_name'),
                        'user_administracion'=>$this->madministracion->getUsuario()
                    );
                    /*$this->session->set_userdata('login_state', TRUE);
                    $this->session->set_userdata('Valores', $row['Id']);*/
                    $this->session->set_userdata($data);
                    redirect('administracion/listado');
                }
                else
                {
                    $data['Mensaje_Resultado']='Usuario o contraseña incorrecto.';
                    $display['content'] = $this->load->view('administracion/administracion_usuario',$data,TRUE);
                    //echo 'error de contraseña';
                    $this->load->view('inicio',$display);                }
            }
            else
            {
                $display['content'] = $this->load->view('administracion/administracion_usuario','',TRUE);
                $this->load->view('inicio',$display);
            }
        }
        else
        {
            if($this->session->userdata('login_state_administracion') == TRUE)
            {
                //$display['nav'] = $this->load->view('navigation','',TRUE);
                //$display['content'] = $this->load->view('usuario_inicio','',TRUE);
                $this->load->view('registro');
            }
            else{
                $display['content'] = $this->load->view('administracion/administracion_usuario',$data,TRUE);
                $this->load->view('inicio',$display);
            }
        }
    }
    function logout()
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->load->model('madministracion');
        $this->madministracion->salir($this->session->userdata('valores'),$this->input->ip_address());
        $this->session->unset_userdata('login_state_administracion');
        $this->session->unset_userdata('user_administracion');
        $this->session->sess_destroy();
        redirect("administracion/index");
    }
    function listado()
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->load->model('madministracion');
        $this->load->model('mmenu');
        $this->load->library('pagination');
        $display['nav'] = $this->mmenu->getMenuAdministracion();
        //$display['head']="<script type='text/javascript' src='".base_url()."js/facturacion_cancelar.js'></script>";
        $uri_segment = 3;
        // return third URI segment, if no third segment returns ''
        $offset = $this->uri->segment($uri_segment,'');
        // gets total URI segments
        $total_seg          = $this->uri->total_segments();
        // assign posted valued
        $data['Usuario'] = $this->input->post('Usuario');
        $data['FechaInicio'] = $this->input->post('FechaInicio');
        $data['FechaFin'] = $this->input->post('FechaFin');
        $data['Estatus'] = $this->input->post('Estatus');
        // set search params
        // enters here only when 'Search' button is pressed or through 'Paging'
        if($this->input->post('submit') !== FALSE || $total_seg>3){
            $default = array('Usuario','FechaInicio','FechaFin','Estatus');
            if($total_seg > 3)
            {
                // navigation from paging
                /**
                 *
                 * Convert URI segments into an associative array of key/value pairs
                 * But this array also contains the last redundant key value pair taking the page number as key.
                 * So, the last key value pair must be removed.
                 *
                 */
                $this->terms = $this->uri->uri_to_assoc(3,$default);
                //print_r($this->terms);
                /**
                 * Replacing all the 'unset' values in the associative array (with keys as in $default array) to null value
                 * and create a new array '$this->terms_uri' taking only the database keys we need to query,
                 **/
                for($i=0;$i<count($default);$i++){
                    if($this->terms[$default[$i]] == 'unset'){
                        $this->terms[$default[$i]] = '';
                        $this->terms_uri[$default[$i]] = 'unset';
                    }else{
                        $this->terms_uri[$default[$i]] = $this->terms[$default[$i]];
                    }
                }
                // When the page is navigated through paging, it enters the condition below
                if(($total_seg % 2) > 0){
                    // exclude the last array item (i.e. the array key for page number), prepare array for database query
                    $this->terms = array_slice($this->terms, 0 , (floor($total_seg/2)-1));
                    $offset = $this->uri->segment($total_seg, '');
                    $uri_segment = $total_seg;
                }

                // Convert associative array $this->terms_uri to segments to append to base_url
                $keys = $this->uri->assoc_to_uri($this->terms_uri);
                $query = $this->madministracion->get_search_pagedlist($this->terms,$this->limit, $offset);
                // set total_rows config data for pagination
                $config['total_rows'] = $this->madministracion->count_search($this->terms);
                $this->terms = array();								// resetting terms array
                $this->terms_uri = array();							// resetting terms_uri array
            }
            else
            {
                // navigation through POST search button
                $searchparams_uri = array();
                $searchparams=array();
                for($i=0;$i<count($default);$i++){
                    if($this->input->post($default[$i]) != ''){
                        $searchparams_uri[$default[$i]] = $this->input->post($default[$i]);
                        $data[$default[$i]] = $this->input->post($default[$i]);
                    }else{
                        $searchparams_uri[$default[$i]] = 'unset';
                        $data[$default[$i]] = '';
                    }
                }
                // Replace all the 'unset' values in an associative array to null value and create a new array '$searchparams' for database processing
                foreach($searchparams_uri as $k=>$v){
                    if($v != 'unset'){
                        $searchparams[$k] = $v;
                    }else{
                        $searchparams[$k] = '';
                    }
                }
                $query = $this->madministracion->get_search_pagedlist($searchparams,$this->limit, $offset);
                // turn associative array to segments to append to base_url
                $keys = $this->uri->assoc_to_uri($searchparams_uri);
                // set total_rows config data for pagination
                $config['total_rows'] = $this->madministracion->count_search($searchparams);
            }
        }
        else
        {
            $config['total_rows'] = $this->madministracion->get_total_usuarios();
            $query = $this->madministracion->get_usuarios($this->limit, $offset);
            $keys = "";
        }
        $config['base_url']   = site_url('administracion/listado/').'/'.$keys.'/';
        $config['per_page']   = $this->limit;    // if you change this you must also change the crud call below.
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        //$display['pagination'] = $this->pagination->create_links();
        $data['pagination'] = $this->pagination->create_links();
        // Handle the results like any other CI Database query.
        if ($query->num_rows() > 0)
        {
            // Build a basic table with the data using CI's table class.
            $this->load->library('table');
            $tmpl = array(
                'row_start' => '<tr class="odd">',
                'row_alt_start' => '<tr class="even">');
            $this->table->set_template($tmpl);
            $this->table->set_heading('RFC','Razón Social','Facturas','Estatus','Activar','Suspender','Eliminar','Contraseña','Produccion');

            // add each of the results to the table
            $Estatus=array('Pendiente','Activo','Suspendido');
            foreach($query->result_object() as $entry)
            {
                $this->table->add_row(
                    anchor('administracion/validacion/'.$entry->Id ,$entry->RFC),
                    '',
                    '',
                    $Estatus[$entry->Estatus],
                    $entry->Estatus==0?anchor('administracion/activar/'.$entry->Id.'/'.$entry->RFC,'Activar','class="activar"'):'',
                    $entry->Estatus==1?anchor('administracion/suspender/'.$entry->Id.'/'.$entry->RFC,'Suspender','class="suspender"'):
                        ($entry->Estatus==2?anchor('administracion/reactivar/'.$entry->Id.'/'.$entry->RFC,'Reactivar','class="reactivar"'):''),
                    $entry->Estatus==0?anchor('administracion/eliminar/'.$entry->Id.'/'.$entry->RFC,'Eliminar','class="eliminar"'):'',
                    anchor('administracion/resetpwd/'.$entry->Id.'/'.$entry->RFC,'Cambiar','class="resetpwd"'),
                    ($entry->Demo==1 && $entry->Estatus==1)?anchor('administracion/demo/'.$entry->Id.'/'.$entry->RFC,'Producción','class="demo"'):''
                );
            }
            $data['table'] = $this->table->generate();
        }
        else
        {
            // There is no content tell the user to build some.
            $data['table'] = 'No hay facturas emitidas.';
        }
        $data['titulo']='Facturas Emitidas';
        $display['head']="<script type='text/javascript' src='".base_url()."js/administracion.js'></script>";
        $display['content'] = $this->load->view('administracion/administracion_listado',$data,TRUE);
        $this->load->view('registro',$display);
    }
    function validacion($Cliente)
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $Cliente=intval($Cliente);
        $this->load->model('MConfiguracion');
        $this->load->model('mmenu');
        $data['informacion']=$this->MConfiguracion->get_Configuracion_Fiscal($Cliente);
        //$this->load->view('template',$data);
        $display['nav'] = $this->mmenu->getMenuAdministracion();
        $display['content'] = $this->load->view('administracion/administracion_validacion',$data, TRUE);
        $this->load->view('registro',$display);
    }
    function activar($usuario,$rfc)
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->load->model('madministracion');
        if($this->madministracion->activar($usuario,$rfc))
        {
            echo 'TRUE';
        }
        else
        {
            echo $this->madministracion->Error;
        }
    }
    function suspender($usuario,$rfc)
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->load->model('madministracion');
        if($this->madministracion->suspender($usuario,$rfc))
        {
            echo 'TRUE';
        }
        else
        {
            echo $this->madministracion->Error;
        }
    }
    function reactivar($usuario,$rfc)
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->load->model('madministracion');
        if($this->madministracion->reactivar($usuario,$rfc))
        {
            echo 'TRUE';
        }
        else
        {
            echo $this->madministracion->Error;
        }
    }
    function eliminar($usuario,$rfc)
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->load->model('madministracion');
        if($this->madministracion->eliminar($usuario,$rfc))
        {
            echo 'TRUE';
        }
        else
        {
            echo $this->madministracion->Error;
        }
    }
    function demo($usuario,$rfc)
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->load->model('madministracion');
        if($this->madministracion->demo($usuario,$rfc))
        {
            echo 'TRUE';
        }
        else
        {
            echo $this->madministracion->Error;
        }
    }
    function resetpwd($usuario,$rfc)
    {
        if($this->session->userdata('login_state_administracion')!=true)
            redirect("administracion/index");
        $this->load->model('madministracion');
        if($this->madministracion->resetpwd($usuario,$rfc))
        {
            echo 'TRUE';
        }
        else
        {
            echo $this->madministracion->Error;
        }
    }
    function qpwoesd()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        if($this->input->post('crear')!==FALSE)
        {
            // Rules Here
            $this->form_validation->set_rules('user_name', 'Usuario','required|min_length[5]|max_length[13]|xss_clean');
            $this->form_validation->set_rules('user_email', 'Email','required|xss_clean|min_length[3]|max_length[255]|valid_email');
            if ($this->form_validation->run() == FALSE)
            {
                $display['content'] = $this->load->view('administracion/administracion_crear','',TRUE);
                $this->load->view('inicio',$display);
            }
            else
            {
                $this->load->model('madministracion');
                $this->madministracion->crear($this->input->post('user_name'),$this->input->post('user_email'));
                redirect('administracion/index');
            }
        }
        else
        {
            $display['content'] = $this->load->view('administracion/administracion_crear','',TRUE);
            $this->load->view('inicio',$display);
        }
    }
}
