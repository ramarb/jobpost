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
    private $fields = array(
        'position' => '',
        'company' => '',
        'year_from' => '',
        'month_from' => 'January',
        'year_to' => '',
        'month_to' => 'Present',
        'description' => '',
    );

    public function __construct() {
        $this->controller = 'experiences';
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
        $this->js_header = javascript(array('angular.min'));
        $this->js_footer = javascript(array('work_experiences'));
        $this->render($this->_role.'/work_experience_list',array('work_experiences' => $work_experiences, 'crud_nav' => $this->crud_nav));
    }

    public function create(){
        $this->js_header = javascript(array('angular.min'));
        $this->js_footer = javascript(array('work_experiences'));

        $fields = $this->fields;

        $post = $this->input->post();

        if(is_array($post) === true && count($post) > 1){
            $fields = $post;
        }

        $this->data['form_data'] = set_form_json_data($fields);

        $this->render($this->_role.'/work_experience_create',array('crud_nav' => $this->crud_nav));
    }

    public function edit($id){
        try{
            $result = $this->users->read_user_work_experience_by_id($this->user->id, $id);
        }catch (Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
        }

        $fields = $this->fields;

        if($result->result_id->num_rows > 0){
            $fields = $result->row_array();
            if($fields['is_present'] == 1){
                $fields['month_to'] = 'Present';
            }
        }else{

        }

        $post = $this->input->post();

        if(is_array($post) === true && count($post) > 1){
            $fields = $post;
        }

        $this->js_header = javascript(array('angular.min'));
        $this->js_footer = javascript(array('work_experiences'));

        $this->data['form_data'] = set_form_json_data($fields);
        $this->data['id'] = $id;
        $this->render($this->_role . '/work_experience_edit', array());
    }

    public function validate_edit($id){
        $this->validate('update', $id);
    }

    public function validate_create(){
        $this->validate('insert');
    }

    private function user_validation_conf(){

        return array(
            array(
                'field'   => 'position',
                'label'   => 'Position',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'company',
                'label'   => 'Company',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'month_from',
                'label'   => 'Month From',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'year_from',
                'label'   => 'Year From',
                'rules'   => 'required'
            )
        );
    }

    private function validate($type, $id = 0){
        $config = $this->user_validation_conf();

        $this->form_validation->set_rules($config);

        $result = $this->form_validation->run();

        if($result == false){
            $this->set_alert_message('Error',validation_errors());


        }else{

            switch ($type) {
                case 'insert':
                    $this->save_changes('insert');
                    break;
                case 'update':
                    $this->save_changes('update', $id);
                    break;
                default:
                    break;
            }
        }

        switch ($type) {
            case 'insert':
                $this->create();
                break;
            case 'update':
                $this->edit($id);
                break;
            default:
                break;
        }
    }

    private function save_changes($type){
        $alert_message = 'User Saved...';
        try{

            switch ($type) {
                case 'insert':
                    //create_user_work_experience($users_id,$position,$year_from,$month_from,$year_to,$month_to,$is_present,$monthly_salary,$company,$description){
                    $users_id = $this->user->id;
                    $position = $this->input->post('position');
                    $year_from = $this->input->post('year_from');
                    $month_from = $this->input->post('month_from');
                    $year_to = $this->input->post('year_to');
                    $month_to = $this->input->post('month_to');
                    $is_present = 0;
                    if($month_to === 'Present'){
                        $year_to = '';
                        $month_to = '';
                        $is_present = 1;
                    }

                    $monthly_salary = '';
                    $company = $this->input->post('company');
                    $description = $this->input->post('description');

                    $this->users->create_user_work_experience($users_id,$position,$year_from,$month_from,$year_to,$month_to,$is_present,$monthly_salary,$company,$description);

                    break;
                case 'update':
                    $this->users->update_user_work_experience($this->user->id, $this->input->post());
                    $alert_message = 'User Updated...';
                    break;
                default:
                    break;
            }

            $this->set_alert_message('Success',$alert_message,true);
            redirect($this->_role . '/'.$this->controller.'/mylist');

        }catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage());

        }
    }

    public function delete($id){
        try{
            $this->users->delete_user_work_experience_by_owner($this->user->id, $id);
            $this->set_alert_message('Success','Work Experience successfully deleted',true);
            redirect($this->_role.'/'.$this->controller.'/');
        }catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
            $this->mylist();
        }

    }

    /**
     * @param $id
     */
    public function set_primary($id){
        $out = array('message'=>'Error');
        try{
            $this->users->set_primary_work_experience($this->user->id,$id);
            $out = array('message'=>'Success');
        }catch (Exception $e){
            $this->set_alert_message('Error',$e->getMessage(),true);
        }

        echo json_encode($out);
    }

}