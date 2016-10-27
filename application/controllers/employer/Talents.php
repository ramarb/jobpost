<?php
/**
 * Created by PhpStorm.
 * User: ramon
 * Date: 10/27/16
 * Time: 11:45 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Talents extends MY_Controller_Employer {


    public function __construct() {
        $this->controller = 'talents';
        parent::__construct();

        $this->load->model('Users_model','users');
        $this->load->model('Files_model','file');

    }

    public function index(){
        $job_seekers = $this->users->read_job_seekers();
        $this->js_variables['job_seekers'] = array('json'=>$job_seekers->result());

        $this->js_footer = javascript(array($this->_role.'/talents'));
        $this->js_header = javascript(array('angular.min'));

        $this->render($this->_role.'/talent_list',array());
    }

    public function detail($users_id){
        try{
            $job_seeker = $this->users->read_row($users_id);
            $experiences = $this->users->read_user_work_experience($users_id);
            $this->js_variables['job_seeker'] = array('json'=>$job_seeker);
            $this->js_variables['experiences'] = 0;

            if($experiences->result_id->num_rows > 0){
                $this->js_variables['experiences'] = array('json'=>$experiences->result());
            }

            $this->js_footer = javascript(array($this->_role.'/talents'));
            $this->js_header = javascript(array('angular.min'));
        }catch (Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
        }


        $this->render($this->_role.'/talent_detail',array());
    }
}