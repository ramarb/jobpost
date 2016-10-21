<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller_Moderator {

    public function __construct() {
        parent::__construct();
		
		$this->load->model('Users_model','users');

    }

	public function index(){

        $this->render($this->_role . '/home',$this->data);
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
            $this->set_alert_message('Success','Changes Saved',true);
			redirect('registration');
		}catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
		}
    }
}
