<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller_Employer {


    public function __construct() {
        parent::__construct();

        $this->load->model('Users_model','users');
        $this->load->model('Files_model','file');

    }

    public function index(){

        $this->render($this->_role . '/home',array());
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

        $this->render($this->_role . '/user_edit', array());
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
                'field'   => 'name',
                'label'   => 'Company Name',
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
            $this->set_alert_message('Error',validation_errors());
        }else{
            $this->update();
        }

        $this->edit();
    }

    private function update(){
        if($this->upload_file(USER_FILE_TYPE_PROFILE_PHOTO,'profile_picture')){
            try{
                $this->users->update($this->input->post());
                /*".$this->db->escape($data['name']).",
                    ".$this->db->escape($data['description']).",
                    ".$this->db->escape($data['job_categories_id']).",
                    ".$this->db->escape($data['cities_id']).",
                    ".$this->db->escape($data['address']).",
                    ".$this->db->escape($data['contact_number']).",*/
                $this->users->create_company($this->user->id,array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'job_categories_id' => $this->input->post('category'),
                    'cities_id' => $this->input->post('city'),
                    'address' => $this->input->post('address'),
                    'contact_number' => $this->input->post('contact_number')
                ));

                $this->set_alert_message('Success','Changes Saved...',true);

                redirect($this->_role.'/account/edit');
            }catch(Exception $e){
                $this->set_alert_message('Error',$e->getMessage());
            }
        }
    }

    public function test(){
        $this->js_header = javascript(array_merge(array('angular.min'),$this->ng_materials()));
        $this->js_footer = javascript(array('test'));
        $this->main_ng_switch = 'Off';
        $this->css_header = css(array('angular-material.min'));
        $this->render('public/test',array());
    }


}
