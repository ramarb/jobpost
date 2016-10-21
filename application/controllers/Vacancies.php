<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancies extends MY_Controller {


	private $_sort = 'date_added';
	private $order = 'DESC';
	private $keyword = '';

    public function __construct() {
        parent::__construct();
		
		$this->load->model('Users_model','users');
		$this->load->model('Vacancies_model','vacancies');
		$this->load->model('Miscellaneous_model','miscellaneous');
		



		
		if(strlen(trim($this->session->userdata('public_vacancy_keyword')))>0){
			$this->keyword = $this->session->userdata('public_vacancy_keyword');
		}
		
		
		
		$sort = $this->session->userdata('public_vacancy_sort');
		$order = $this->session->userdata('public_vacancy_order');;
		
		if(strlen(trim($sort))>0){
			$this->_sort = $sort;
		}
		
		if(strlen(trim($order))>0){
			$this->order = $order;
		}

    }
	
	public function index(){
		
		$this->mylist();

	}
		
	public function mylist($offset = 0){
		$vacancies = '';
		try{
			
			if((int)$offset == 0){
				$offset = (int)$this->uri->segment(3);
			}
			
			$this->load->library('pagination');
			
			$config = array();

            $this->keyword = $this->get_filters();

			$config['base_url'] = base_url('vacancies/mylist/');
			$config['total_rows'] = (int)$this->vacancies->read_by_public($this->keyword,5,0,true);
			$config['per_page'] = PUBLIC_LIST_LIMIT;
			$config = array_merge($this->miscellaneous->pagination_config(),$config);
			
			$this->pagination->initialize($config);

            $vacancies = $this->vacancies->read_by_public($this->keyword,PUBLIC_LIST_LIMIT,$offset,false,$this->_sort,$this->order);

		}catch(Exception $e){
            $this->set_alert_message('warning',$e->getMessage());
		}
		$data = array(
			'vacancies' => $vacancies,
			'pagination' => $this->pagination->create_links(),
		);

        $data['form_data'] = json_encode($this->keyword);

        $this->js_header = javascript(array('angular.min','constants'));
        $this->js_footer = javascript(array('public_vacancy'));

		$this->render('public/vacancy_list', $data);
	}
	
	public function search(){
		$keyword = $this->input->post('keyword');
		$this->session->set_userdata('public_vacancy_keyword',$keyword);
		$this->keyword = $keyword;
		redirect('vacancies');
	}	

	public function detail(){
        $vacancies_id = $this->uri->segment(3);
		$vacancy = $this->vacancies->read_row_by_public($vacancies_id);
		$data = array(
			'vacancy' => $vacancy,
            'vacancies_id' => $vacancies_id,
            'application_form' => $this->load->view($this->_unit.'/public/application_form',array('vacancies_id'=>$vacancies_id),true)
		);
		$this->render('public/vacancy_detail', $data);
	}

    public function apply(){
        $user_id = $this->user->id;
        $vacancies_id = $this->input->post('vacancies_id');
        try{
            $this->users->create_vacancy_applicant($user_id, $vacancies_id);

            $this->set_alert_message('Success','You have successfully applied to this Job',true);

            redirect('vacancies/detail/'.$vacancies_id);

        }catch (Exception $e){

            $this->set_alert_message('Error',$e->getMessage());
        }

        $this->detail();


    }

    public function filter(){

        if($this->input->post('do_clear') === '1'){
            $this->session->set_userdata('filter_provinces_id','');
            $this->session->set_userdata('filter_cities_id','');
            $this->session->set_userdata('filter_job_industries_id','');
            $this->session->set_userdata('filter_job_categories_id','');
        }else{
            $this->session->set_userdata('filter_provinces_id',$this->input->post('provinces_id'));
            $this->session->set_userdata('filter_cities_id',$this->input->post('cities_id'));
            $this->session->set_userdata('filter_job_industries_id',$this->input->post('job_industries_id'));
            $this->session->set_userdata('filter_job_categories_id',$this->input->post('job_categories_id'));
        }

        redirect('vacancies');
    }

    private function get_filters(){
        return array(
            'provinces_id'      => $this->session->userdata('filter_provinces_id'),
            'cities_id'         => $this->session->userdata('filter_cities_id'),
            'job_industries_id' => $this->session->userdata('filter_job_industries_id'),
            'job_categories_id' => $this->session->userdata('filter_job_categories_id'),
            'keyword'           => $this->session->userdata('public_vacancy_keyword')
        );
    }

}
