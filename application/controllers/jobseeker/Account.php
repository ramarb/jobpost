<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller_Job_Seeker {

    public function __construct() {
        $this->controller = 'account';
        parent::__construct();
		
		$this->load->model('Users_model','users');
        $this->load->model('Files_model','file');
        $this->load->model('Vacancies_model','vacancies');

    }

	public function index(){

        try{
            $job_seeker = $this->users->read_row($this->user->id);
            $experiences = $this->users->read_user_work_experience($this->user->id);
            $this->js_variables['job_seeker'] = array('json'=>$job_seeker);
            $this->js_variables['experiences'] = 0;

            if($experiences->result_id->num_rows > 0){
                $this->js_variables['experiences'] = array('json'=>$experiences->result());
            }

            $this->js_footer = javascript(array('employer/talents'));
            $this->js_header = javascript(array('angular.min'));
        }catch (Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
        }

        $this->render($this->_role.'/home',array());
	}
	
	public function edit(){

        $result = $this->users->read_row($this->user->id);
        //p($result,1);
        $password = array(
            'password'=>'',
            'repeat_password'=>''
        );
        foreach ($result as $key => $value) {
            if(isset($_POST[$key])){
                if(in_array($key, array('password','repeat_password'))){
                    $password[$key] = $_POST[$key];
                }else{
                    $result[$key] = $_POST[$key];
                }
            }
        }

        $this->data = array_merge(
            $this->data,
            $result,
            $password
        );

        $this->render($this->_role . '/user_edit', $this->data);
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
            )
        );

        if($this->input->post('password') != ''){
            $password_config = array(
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
            $config = array_merge($config, $password_config);
        }

        $this->form_validation->set_rules($config);

        $result = $this->form_validation->run();

        if($result == false){
            $this->_alert_type = "Error";
            $this->_alert_message = validation_errors();
        }else{
            $this->update();
        }

        $this->edit();
    }
	
    private function update(){
        if($this->upload_file(USER_FILE_TYPE_PROFILE_PHOTO,'profile_picture')){
            try{
                $this->users->update($this->input->post());
                $this->set_alert_message('Success','Changes Saved...',true);
                redirect($this->_role.'/account/edit');
            }catch(Exception $e){
                $this->set_alert_message('Error',$e->getMessage());
            }
        }
    }

    public function my_resume(){

        $this->js_header = javascript(array('angular.min','constants'));
        $this->js_footer = javascript(array($this->_role.'/job_seeker'));

        $this->data['resumes'] = $this->file->read_files_by_type_owner('Resume',$this->user->id,1);

        $this->render($this->_role.'/resume',$this->data);
    }

    public function upload_resume(){

        if($this->upload_file(USER_FILE_TYPE_RESUME,'file')){
            redirect($this->_role.'/account/my_resume');
        }else{
            $this->my_resume();
        }
    }

    public function download_resume($id){
        $this->download_file($id);
    }

    public function job_applications(){
        try{
            $job_applications = $this->vacancies->read_vacancies_by_applicant($this->user->id);
        }catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
        }

        $this->js_footer = javascript(array($this->_role.'/applications'));
        $this->js_header = javascript(array('angular.min'));
        $this->js_variables['job_applications'] = array('json'=>$job_applications->result());
        $this->render($this->_role.'/applications',array('job_applications'=>$job_applications));

    }

}
