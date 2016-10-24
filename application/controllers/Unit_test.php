<?php
/**
 * Created by PhpStorm.
 * User: ramon
 * Date: 10/19/16
 * Time: 10:46 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_test extends MY_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Users_model', 'users');
        $this->load->model('Vacancies_model', 'vacancy');
        $this->load->model('Miscellaneous_model', 'miscellaneous');
        $this->load->model('Files_model','file');
    }

    public function index(){
        echo '<h1>Unit Test Controller</h1>';
    }

    public function file_upload(){
        $data = array(
            'index' => 'file',
            'move_to' => '6/images/thumb/'
        );

        if(isset($_FILES['file'])){
            $this->load->library('file_management',$data,'file_u');

            if(count($this->file_u->get_file_uploaded()) > 0){
                $this->file_u->move();
                p($this->file_u->get_result());
            }
        }

        $this->load->view('testing');
    }

    public function create_user_file(){


        $user_id = 3;
        $location = 'japan';
        $name = uniqid('files_name_');
        $size = '591';
        $type = 'mo ako';
        $file_type = USER_FILE_TYPE_COMPANY_LOGO;
        $file_state = 'Archive';

        try{
            $this->file->create_user_file($user_id, $location, $name, $size, $type, $file_type, $file_state);
            echo 'OK';
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function create_vacancy_applicant(){

        try{
            $this->users->create_vacancy_applicant_create(3,1);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function create_work_experience(){
        //
        $users_id = 14;
        $position = uniqid('position_');
        $year_from = '2000';
        $month_from = 'July';
        $year_to = '2014';
        $month_to = 'September';
        $is_present = 1;
        $monthly_salary = 20000.50;
        $company = 'BTP';
        $description = 'Bridge Technology Partners';

        try{
            $this->users->create_user_work_experience($users_id,$position,$year_from,$month_from,$year_to,$month_to,$is_present,$monthly_salary,$company,$description);
            echo 'OK';
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    function update_work_experience(){
        $data = array('users_id' => 2
                        ,'position' => 'Sitting'
                        ,'year_from' => '1995'
                        ,'month_from' => 'January'
                        ,'year_to' => '2000'
                        ,'month_to' => 'Feb'
                        ,'is_present' => 0
                        ,'monthly_salary' => 3000.00
                        ,'company' => 'Ratan'
                        ,'description' => 'Furniture'
        );
        try{
            $this->users->update_user_work_experience(1,$data);
            echo 'OK';
        }catch (Exception $e){
            die($e->getMessage());
        }

    }

    function delete_user_work_experience(){
        try{
            $this->users->delete_user_work_experience(17);
            echo 'OK';
        }catch (Exception $e){
            die($e->getMessage());
        }

    }

    function read_applicants_by_employer(){
        try{

            p($this->vacancy->read_vacancy_applicant_by_employer(2)->result());

        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    function read_files_by_type_owner(){
        try{
            p($this->file->read_files_by_type_owner('Company Logo',3)->result());
        }catch(Exception $e){
            die($e->getMessage());
        }

    }

    public function read_file_by_id($files_id = 12){
        try{
           $result = $this->file->read_file_by_id($files_id);
        }catch(Exception $e){
            die($e->getMessage());
        }

        return $result->row();
    }

    public function test_download_file(){

        $result = $this->read_file_by_id();

        $this->load->library('file_management',array(),'file_u');

        try{
            $this->file_u->download($result->location, $result->name, $result->type);
            die;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function update_vacancy_applicant_status(){
        try{
            $this->vacancy->update_vacancy_applicant_status(3,'in progress');
            echo "Ok";
        }catch(Exception $e){
            die($e->getMessage());
        }
    }


}