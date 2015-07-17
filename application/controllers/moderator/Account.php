<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller_Moderator {


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
		$data = array(
			'alert_message' => $this->_alert_message, 
			'alert_type' => $this->_alert_type,
			'role' => $this->_role
		);
        $this->render($this->_role . '/home',$data);
	}
	
	public function edit(){
		
	}

    public function validate_update_account(){


        $config = array(
            
            array(
                'field'   => 'first_name',
                'label'   => 'First Name',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'last_name',
                'label'   => 'Last Name',
                'rules'   => 'required'
            ),
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
            array(
                'field'   => 'repeat_password',
                'label'   => 'Repeat Password',
                'rules'   => 'required|matches[password]'
            )
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
	
	

    private function update(){
		try{
			$this->users->update($this->input->post());
			$this->session->set_flashdata('alert_type','Success');
            $this->session->set_flashdata('alert_message','Changes Saved...');
			redirect('registration');
		}catch(Exception $e){
			$this->_alert_type = "Error";
            $this->_alert_message = $e->getMessage();
		}
    }
}
