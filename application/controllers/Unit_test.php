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

        $this->load->model('Users_model', 'user');
        $this->load->model('Vacancies_model', 'vacancies');
        $this->load->model('Miscellaneous_model', 'miscellaneous');
        $this->load->model('Files_model','file');
    }

    public function file_upload(){
        $data = array(
            'index' => 'file',
            'move_to' => '6/images/thumb/'
        );

        if(isset($_FILES['file'])){
            $this->load->library('file_management',$data,'file');

            if(count($this->file->get_file_uploaded()) > 0){
                $this->file->move();
                p($this->file->get_result());
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
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function create_vacancy(){

        try{
            $this->user->create_vacancy_applicant_create(14,2);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function create_work_experience(){
        //
        $users_id = 3;
        $position = uniqid('position_');
        $year_from = '2000';
        $month_from = 'July';
        $year_to = '2014';
        $month_to = 'September';
        $is_present = 20000.50;
        $monthly_salary = 'fasdf';
        $company = 'BTP';
        $description = 'Bridge Technology Partners';

        try{
            $this->user->create_user_work_experience($users_id,$position,$year_from,$month_from,$year_to,$month_to,$is_present,$monthly_salary,$company,$description);
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
            $this->user->update_user_work_experience(1,$data);
            echo 'OK';
        }catch (Exception $e){
            die($e->getMessage());
        }

    }

    function delete_user_work_experience(){
        try{
            $this->user->delete_user_work_experience(3);
            echo 'OK';
        }catch (Exception $e){
            die($e->getMessage());
        }

    }


}