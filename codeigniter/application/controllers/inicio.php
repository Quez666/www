<?php
/**
 * Created by JetBrains PhpStorm.
 * User: g3ck0
 * Date: 30/03/12
 * Time: 05:06 PM
 * To change this template use File | Settings | File Templates.
 */
class Inicio extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Just in case the Database is not called in the config
        $this->load->database();

        // Load the URL helper so redirects work.
        $this->load->helper('url');


        // Enable the output profiler so you can see the db queries run.
        $this->output->enable_profiler(TRUE);
    }
    function index()
    {
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data='';
        if($this->input->post('login') !== FALSE)
        {
            $this->form_validation->set_rules('user_name', 'Usuario', 'required|xss_clean');
            $this->form_validation->set_rules('user_pass', 'Contraseña', 'required|xss_clean');
            if($this->form_validation->run())
            {
                $this->load->model('minicio');
                if($this->minicio->login($this->input->post('user_name'),$this->input->post('user_pass'),$this->input->ip_address()))
                {
                    $data=array(
                        'login_state'=>true,
                        'usuario'=>$this->input->post('user_name'),
                        'valores'=>$this->minicio->Usuario()
                    );
                    /*$this->session->set_userdata('login_state', TRUE);
                    $this->session->set_userdata('Valores', $row['Id']);*/
                    $this->session->set_userdata($data);
                    redirect('/');
                }
                else
                {
                    $data['Mensaje_Resultado']='Usuario o contraseña incorrecto.';
                    $display['content'] = $this->load->view('usuario_inicio',$data,TRUE);
                    //echo 'error de contraseña';
                    $this->load->view('inicio',$display);                }
            }
            else
            {
                $display['content'] = $this->load->view('usuario_inicio','',TRUE);
                $this->load->view('inicio',$display);
            }
        }
        else
        {
            print_r($this->session->userdata('usuario'));
            if($this->session->userdata('login_state') == TRUE)
            {
                echo 'hola';
                $display['nav'] = $this->load->view('navigation','',TRUE);
                //$display['content'] = $this->load->view('usuario_inicio','',TRUE);
                $this->load->view('registro',$display);
            }
            else{
                echo 'adios';
                $display['content'] = $this->load->view('usuario_inicio',$data,TRUE);
                $this->load->view('inicio',$display);
            }
        }
    }
    function logout()
    {
        if($this->session->userdata('login_state')!=true)
            redirect("/");
        $this->load->model('minicio');
        $this->minicio->salir($this->session->userdata('valores'),$this->input->ip_address());
        $this->session->unset_userdata('login_state');
        $this->session->unset_userdata('Valores');
        $this->session->sess_destroy();
        redirect("/");
    }
}
