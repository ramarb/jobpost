<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancies extends MY_Controller_Employer {


    private $_alert_message = '';
    private $_alert_type = '';

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

    }

	public function mylist(){
		
		$this->load->library('pagination');
		
		$config = array();
		
		$config['base_url'] = base_url($this->_role.'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/');
		$config['total_rows'] = (int)$this->vacancies->read_by_owner($this->user->id,0,0,true);
		
		$config = array_merge($config,$this->miscellaneous->pagination_config());
		
		$this->pagination->initialize($config);
		
		$vacancies = $this->vacancies->read_by_owner($this->user->id,LIST_LIMIT,(int)$this->uri->segment(4));
		$data = array(
			'vacancies' => $vacancies,
			'alert_message' => $this->_alert_message, 
			'alert_type' => $this->_alert_type,
			'pagination' => $this->pagination->create_links(),
			'role' => $this->_role
		);
		$this->render($this->_role . '/vacancy_list', $data);
        
	}
	
	public function create(){
		
		$this->render($this->_role . '/vacancy_create',array('alert_message' => $this->_alert_message, 'alert_type' => $this->_alert_type, 'role' => $this->_role));
	}
	
	public function edit($vacancy_id){
		$result = $this->vacancies->read_row($this->user->role_name, $this->user->id,$vacancy_id);
		
		foreach ($result as $key => $value) {
			if(isset($_POST[$key])){
				$result[$key] = $_POST[$key];	
			}
		}
		
		$data = array_merge(
			$result,
			array('alert_message' => $this->_alert_message, 'alert_type' => $this->_alert_type, 'role' => $this->_role)
		);
		
		$this->render($this->_role . '/vacancy_edit', $data);
	}
	
	
	
	public function validate_edit($vacancy_id){
		$this->validate('update', $vacancy_id);
	}
	
	public function validate_create(){
        $this->validate('insert');
    }
	
	private function vacancy_validation_conf(){
		return array(
            array(
                'field'   => 'industry',
                'label'   => 'Industry',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'category',
                'label'   => 'Category',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'company',
                'label'   => 'Company',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'title',
                'label'   => 'Title',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'description',
                'label'   => 'Description',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'province',
                'label'   => 'Province',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'city',
                'label'   => 'Town',
                'rules'   => 'required'
            )
        );
	}
	
	private function validate($type, $vacancy_id = 0){
		$config = $this->vacancy_validation_conf();

        $this->form_validation->set_rules($config);

        $result = $this->form_validation->run();

        if($result == false){
            $this->_alert_type = "Error";
            $this->_alert_message = validation_errors();
        }else{
        	
			switch ($type) {
				case 'insert':
					$this->insert();		
					break;
				case 'update':
					$this->update();
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
				$this->edit($vacancy_id);
				break;
			default:
				break;
		}
	}
	
	private function update(){
		$this->save_changes('update');
	}

	private function insert(){
		$this->save_changes('insert');
	}
	
	private function save_changes($type){
		$alert_message = 'Vacancy Saved...';
		try{
			
			switch ($type) {
				case 'insert':
					$this->vacancies->create($this->user->id,$this->input->post());		
					break;
				case 'update':
					$this->vacancies->update($this->user->role_name, $this->user->id, $this->input->post('vacancy_id'), $this->input->post());
					$alert_message = 'Vacancy Updated...';
					break;
				default:
					break;
			}
				
			$this->session->set_flashdata('alert_type','Success');
            $this->session->set_flashdata('alert_message',$alert_message);
			redirect($this->_role . '/vacancies/mylist');
		}catch(Exception $e){
			$this->_alert_type = "Error";
            $this->_alert_message = $e->getMessage();
		}
	}		

}