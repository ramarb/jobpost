<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller_Moderator {


    private $_sort = 'name';
	private $order = 'ASC';

    public function __construct() {
        parent::__construct();
		
		$this->load->model('Categories_model', 'categories');
		$this->load->model('Miscellaneous_model','miscellaneous');

		$sort = $this->session->userdata('category_sort');
		$order = $this->session->userdata('category_order');;
		
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
		$config['total_rows'] = (int)$this->categories->read(0,0,true);
		
		$config = array_merge($config,$this->miscellaneous->pagination_config());
		
		$this->pagination->initialize($config);
		
		$categories = $this->categories->read(LIST_LIMIT,$offset,false,$this->_sort, $this->order);
		
		$data = array(
			'categories' => $categories,
			'pagination' => $this->pagination->create_links(),
			'order' => $this->order,
			'sort' => $this->_sort,
			'role' => $this->_role
		);
		$this->render($this->_role . '/category_list', $data);
        
	}
	
	
	
	public function sort(){
		$sort = $this->uri->segment(4);
		$order = $this->uri->segment(5);
		
		if(strlen(trim($sort))>0){
			$this->_sort = $sort;
			$this->session->set_userdata('category_sort', $sort);
		}
		
		if(strlen(trim($order))>0){
			$this->order = $order;
			$this->session->set_userdata('category_order', $order);
		}
		
		$this->mylist(0);
		
	}
	
	public function create(){
		$data = array('industries' => $this->miscellaneous->read_industries());
		$this->render($this->_role . '/category_create',$data);
	}
	
	public function edit($category_id){
		$result = $this->categories->read_row($category_id);
		
		foreach ($result as $key => $value) {
			if(isset($_POST[$key])){
				$result[$key] = $_POST[$key];
			}
		}
		
		$data = array_merge(
			$result,
			array('industries' => $this->miscellaneous->read_industries())
		);
		
		$this->render($this->_role . '/category_edit', $data);
	}
	
	public function validate_edit($category_id){
		$this->validate('update', $category_id);
	}
	
	public function validate_create(){
        $this->validate('insert');
    }
	
	private function category_validation_conf(){
		
		return array(
            array(
                'field'   => 'category',
                'label'   => 'Category',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'industry_id',
                'label'   => 'Industry',
                'rules'   => 'required'
            )            
        );
	}
	
	private function validate($type, $category_id = 0){
		$config = $this->category_validation_conf();
		
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
					$this->save_changes('update');
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
				$this->edit($category_id);
				break;
			default:
				break;
		}
	}
	
	private function save_changes($type){
		$alert_message = 'Category Saved...';
		try{
			
			switch ($type) {
				case 'insert':
					$this->categories->create($this->input->post());		
					break;
				case 'update':
					$this->categories->update($this->input->post());
					$alert_message = 'Category Updated...';
					break;
				default:
					break;
			}
				
            $this->set_alert_message('Success',$alert_message,true);
			redirect($this->_role . '/categories/mylist');
		}catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
		}
	}	

}