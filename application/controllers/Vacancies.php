<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancies extends MY_Controller {

	private $_alert_message = '';
    private $_alert_type = '';
	private $_sort = 'date_added';
	private $order = 'DESC';
	private $keyword = '';

    public function __construct() {
        parent::__construct();
		
		$this->load->model('Users_model','users');
		$this->load->model('Vacancies_model','vacancies');
		$this->load->model('Miscellaneous_model','miscellaneous');
		
        if($this->session->flashdata('alert_type')){
            $this->_alert_type = $this->session->flashdata('alert_type');
        }

        if($this->session->flashdata('alert_message')){
            $this->_alert_message = $this->session->flashdata('alert_message');
        }
		
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
		//read_by_public($keyword = '', $limit = 0, $offset = 0, $count = false, $sort = '', $order = ''){
		//p($this->vacancies->read_by_public('',10,0,false,$this->_sort,$this->order)->result());
		
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
			
			$config['base_url'] = base_url('vacancies/mylist/');
			$config['total_rows'] = (int)$this->vacancies->read_by_public($this->keyword,5,0,true);
			$config['per_page'] = PUBLIC_LIST_LIMIT;
			$config = array_merge($this->miscellaneous->pagination_config(),$config);
			
			$this->pagination->initialize($config);
			
			$vacancies = $this->vacancies->read_by_public($this->keyword,PUBLIC_LIST_LIMIT,$offset,false,$this->_sort,$this->order);
			
		}catch(Exception $e){
			$this->_alert_message = $e->getMessage();
			$this->_alert_type = 'warning';
		}
		$data = array(
			'vacancies' => $vacancies,
			'alert_message' => $this->_alert_message, 
			'alert_type' => $this->_alert_type,
			'pagination' => $this->pagination->create_links(),
		);
		$this->render('public/vacancy_list', $data);
	}
	
	public function search(){
		$keyword = $this->input->post('keyword');
		//p($keyword,1);
		$this->session->set_userdata('public_vacancy_keyword',$keyword);
		$this->keyword = $keyword;
		$this->mylist();
	}	

	public function detail(){
		$vacancy = $this->vacancies->read_row_by_public($this->uri->segment(3));
		$data = array(
			'vacancy' => $vacancy,
			'alert_message' => $this->_alert_message, 
			'alert_type' => $this->_alert_type
		);
		$this->render('public/vacancy_detail', $data);
	}
}
