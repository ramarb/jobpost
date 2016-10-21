<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller_Job_Seeker {

    public function __construct() {
        parent::__construct();
		
		$this->load->model('Users_model','users');
        $this->load->model('Files_model','file');

    }

	public function index(){

        $this->render($this->_role . '/home',$this->data);
	}
	
	public function edit(){

        $result = $this->users->read_row($this->user->id);

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
		try{
			$this->users->update($this->input->post());
			$this->session->set_flashdata('alert_type','Success');
            $this->session->set_flashdata('alert_message','Changes Saved...');

            $this->set_alert_message('Success','Changes Saved...',true);

			redirect($this->_role.'/account/edit');
		}catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
		}
    }

    public function my_resume(){

        $this->js_header = javascript(array('angular.min','constants'));
        $this->js_footer = javascript(array('job_seeker'));

        $this->data['resumes'] = $this->file->read_files_by_type_owner('Resume',$this->user->id,1);

        $this->render($this->_role.'/resume',$this->data);
    }

    public function upload_resume(){
        $data = array(
            'index' => 'file',
            'move_to' => $this->user->id . '/files/'
        );

        if(isset($_FILES['file'])){

            $this->load->library('file_management',$data,'file_upload');

            if(count($this->file_upload->get_file_uploaded()) > 0){
                $this->file_upload->move();
                $result = $this->file_upload->get_result();

                if((int)$result['error'] > 0){
                    $error_message = '';
                    foreach($result['error_message'] as $message){
                        $error_message .= $message.'<br />';
                    }

                    $this->set_alert_message('Error',$error_message);
                }else{

                    $data = $result['data'];
                    try{

                        $this->file->create_user_file($this->user->id, $data['location'], $data['name'], $data['size'], $data['type'], USER_FILE_TYPE_RESUME, 'Active');

                        $this->set_alert_message('Success','Changes Saved',true);

                        redirect($this->_role.'/account/my_resume');
                    }catch (Exception $e){
                        $this->set_alert_message('Error',$e->getMessage());
                    }
                }

                $this->my_resume();
            }
        }

    }
}
