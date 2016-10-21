<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller {



    public function __construct() {
        parent::__construct();
		
		$this->load->model('Users_model','users');
		




    }

	public function index(){
        $this->render('public/register',array());
	}

    public function validate_registration(){


        $config = array(
            array(
                'field'   => 'role_name',
                'label'   => 'Account Type',
                'rules'   => 'required'
            ),
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
            $this->set_alert_message('Error',validation_errors());
        }else{
            $this->create_user();
        }

        $this->index();
    }

    private function create_user(){
		try{
			$data = array_merge(array('user_state'=>'Pending Activation'), $this->input->post());
			$this->users->create($data);
            $this->set_alert_message('Success','Registration Successful, You may now login...',true);
			redirect('registration');
		}catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
		}
    }
}
