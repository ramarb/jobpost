<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {


    private $_alert_message = '';
    private $_alert_type = '';

    public function __construct() {
        parent::__construct();
		
		$this->load->model('Users_model','users');
		
        if($this->session->flashdata('alert_type')){
            $this->_alert_type = $this->session->flashdata('alert_type');
        }

        if($this->session->flashdata('alert_message')){
            $this->_alert_message = $this->session->flashdata('alert_message');
        }

    }

	public function index(){
		$this->redirect();
        $this->render('public/login',array('alert_message' => $this->_alert_message, 'alert_type' => $this->_alert_type));
	}

    public function validate_login(){


        $config = array(
            array(
                'field'   => 'email',
                'label'   => 'Email',
                'rules'   => 'required|valid_email'
            ),
            array(
                'field'   => 'password',
                'label'   => 'Password',
                'rules'   => 'required'
            ),
        );

        $this->form_validation->set_rules($config);

        $result = $this->form_validation->run();

        if($result == false){
            $this->_alert_type = "Error";
            $this->_alert_message = validation_errors();
        }else{
            $this->authenticate_user();
        }

        $this->index();
    }
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

    private function authenticate_user(){
		try{
			$this->users->authenticate($this->input->post());
			$this->session->set_flashdata('alert_type','Success');
            $this->session->set_flashdata('alert_message','Login Successful...');
			$this->redirect();
		}catch(Exception $e){
			$this->_alert_type = "Error";
            $this->_alert_message = $e->getMessage();
		}
    }
}
