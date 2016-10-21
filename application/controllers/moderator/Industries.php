<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industries extends MY_Controller_Moderator {


    private $_sort = 'name';
	private $order = 'ASC';

    public function __construct() {
        parent::__construct();
		
		$this->load->model('industries_model','industries');
		$this->load->model('Industries_model', 'industries');
		$this->load->model('Miscellaneous_model','miscellaneous');

		$sort = $this->session->userdata('industry_sort');
		$order = $this->session->userdata('industry_order');;
		
		if(strlen(trim($sort))>0){
			$this->_sort = $sort;
		}
		
		if(strlen(trim($order))>0){
			$this->order = $order;
		}

    }

	public function mylist($offset=0){
		
		if((int)$offset == 0){
			$offset = (int)$this->uri->segment(4);
		}
		
		$this->load->library('pagination');
		
		$config = array();
		
		$config['base_url'] = base_url($this->_role.'/'.$this->uri->segment(2).'/mylist/');
		$config['total_rows'] = (int)$this->industries->read(0,0,true);
		
		$config = array_merge($config,$this->miscellaneous->pagination_config());
		
		$this->pagination->initialize($config);
		
		$industries = $this->industries->read(LIST_LIMIT,$offset,false,$this->_sort, $this->order);
		
		$data = array(
			'industries' => $industries,
			'pagination' => $this->pagination->create_links(),
			'order' => $this->order,
			'sort' => $this->_sort,
		);
		$this->render($this->_role . '/industry_list', $data);
        
	}
	
	
	
	public function sort(){
		$sort = $this->uri->segment(4);
		$order = $this->uri->segment(5);
		
		if(strlen(trim($sort))>0){
			$this->_sort = $sort;
			$this->session->set_userdata('industry_sort', $sort);
		}
		
		if(strlen(trim($order))>0){
			$this->order = $order;
			$this->session->set_userdata('industry_order', $order);
		}
		
		$this->mylist(0);
		
	}
	
	public function create(){
		$data = array(
			'alert_message' => $this->_alert_message, 
			'alert_type' => $this->_alert_type, 
			'role' => $this->_role
		);
		$this->render($this->_role . '/industry_create',$data);
	}
	
	public function edit($industry_id){
		$result = $this->industries->read_row($industry_id);
		
		foreach ($result as $key => $value) {
			if(isset($_POST[$key])){
				$result[$key] = $_POST[$key];
			}
		}

		$this->render($this->_role . '/industry_edit', $result);
	}
	
	public function validate_edit($industry_id){
		$this->validate('update', $industry_id);
	}
	
	public function validate_create(){
        $this->validate('insert');
    }
	
	private function industry_validation_conf(){
		
		return array(
            array(
                'field'   => 'industry',
                'label'   => 'Industry',
                'rules'   => 'required'
            )            
        );
	}
	
	private function validate($type, $industry_id = 0){
		$config = $this->industry_validation_conf();
		
        $this->form_validation->set_rules($config);

        $result = $this->form_validation->run();

        if($result == false){
            $this->set_alert_message('Error',validation_errors());
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
				$this->edit($industry_id);
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
		$alert_message = 'Industry Saved...';
		try{
			
			switch ($type) {
				case 'insert':
					$this->industries->create($this->input->post('industry'));		
					break;
				case 'update':
					$this->industries->update($this->input->post('industry_id'), $this->input->post('industry'));
					$alert_message = 'Industry Updated...';
					break;
				default:
					break;
			}
				
            $this->set_alert_message('Success',$alert_message,true);

			redirect($this->_role . '/industries/mylist');
		}catch(Exception $e){

            $this->set_alert_message('Error',$e->getMessage());
		}
	}	

}