<?php
/**
 * Created by PhpStorm.
 * User: ramon
 * Date: 10/24/16
 * Time: 11:24 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Experiences extends MY_Controller_Job_Seeker {

    private $crud_nav = '';


    public function __construct() {
        parent::__construct();

        $this->load->model('Users_model','users');
        $this->load->model('Files_model','file');
        $this->crud_nav = $this->load->view($this->_unit.'/'.$this->_role.'/crud_nav',array(),true);
    }

    public function index(){
        $this->mylist();
    }


    public function mylist(){
        $work_experiences = $this->users->read_user_work_experience($this->user->id);

        $this->render($this->_role.'/work_experience_list',array('work_experiences' => $work_experiences, 'crud_nav' => $this->crud_nav));
    }

    public function create(){
        $this->js_header = javascript(array('angular.min'));
        $this->js_footer = javascript(array('work_experiences'));
        $this->render($this->_role.'/work_experience_create',array('crud_nav' => $this->crud_nav));
    }

}