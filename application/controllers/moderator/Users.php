<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller_Moderator {


    private $_alert_message = '';
    private $_alert_type = '';
	private $_sort = 'date_added';
	private $order = 'DESC';

    public function __construct() {
        parent::__construct();
		
		$this->load->model('Users_model','users');
		$this->load->model('Miscellaneous_model','miscellaneous');
		
        if($this->session->flashdata('alert_type')){
            $this->_alert_type = $this->session->flashdata('alert_type');
        }

        if($this->session->flashdata('alert_message')){
            $this->_alert_message = $this->session->flashdata('alert_message');
        }
		
		$sort = $this->session->userdata('user_sort');
		$order = $this->session->userdata('user_order');;
		
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
		$config['total_rows'] = (int)$this->users->read(0,0,true);
		
		$config = array_merge($config,$this->miscellaneous->pagination_config());
		
		$this->pagination->initialize($config);
		
		$users = $this->users->read(LIST_LIMIT,$offset,false,$this->_sort, $this->order);
		
		$data = array(
			'users' => $users,
			'alert_message' => $this->_alert_message, 
			'alert_type' => $this->_alert_type,
			'pagination' => $this->pagination->create_links(),
			'order' => $this->order,
			'sort' => $this->_sort,
			'role' => $this->_role
		);
		$this->render($this->_role . '/user_list', $data);
        
	}
	
	
	
	public function sort(){
		$sort = $this->uri->segment(4);
		$order = $this->uri->segment(5);
		
		if(strlen(trim($sort))>0){
			$this->_sort = $sort;
			$this->session->set_userdata('user_sort', $sort);
		}
		
		if(strlen(trim($order))>0){
			$this->order = $order;
			$this->session->set_userdata('user_order', $order);
		}
		
		$this->mylist(0);
		
	}
	
	public function create(){
		$data = array(
			'alert_message' => $this->_alert_message, 
			'alert_type' => $this->_alert_type, 
			'role' => $this->_role, 
			'roles'=>$this->miscellaneous->read_roles(),
			'user_states'=>$this->miscellaneous->read_user_states()
		);
		$this->render($this->_role . '/user_create',$data);
	}
	
	public function edit($user_id){
		$result = $this->users->read_row($user_id);
		$password = array(
			'password'=>'',
			'repeat_password'=>''
		);
		foreach ($result as $key => $value) {
			if(isset($_POST[$key])){
				if(in_array($key, array('password','repeat_password'))){
					$password[$key] = $_POST[$key];
				}else{
					$result[$key] = $_POST[$key];	
				}
					
			}
		}
		
		$data = array_merge(
			$result,
			array('alert_message' => $this->_alert_message, 'alert_type' => $this->_alert_type, 'role' => $this->_role,'roles'=>$this->miscellaneous->read_roles(),
			'user_states'=>$this->miscellaneous->read_user_states()),
			$password
		);
		
		$this->render($this->_role . '/user_edit', $data);
	}
	
	public function validate_edit($user_id){
		$this->validate('update', $user_id);
	}
	
	public function validate_create(){
        $this->validate('insert');
    }
	
	private function user_validation_conf(){
		
		return array(
            array(
                'field'   => 'role_name',
                'label'   => 'Account Type',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'user_state',
                'label'   => 'Status',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'first_name',
                'label'   => 'First Name',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'last_name',
                'label'   => 'Last Name',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'email',
                'label'   => 'Email',
                'rules'   => 'required|valid_email'
            )
        );
	}
	
	private function validate($type, $user_id = 0){
		$config = $this->user_validation_conf();
		if($type=='insert' || strlen(trim($this->input->post('password'))) || strlen(trim($this->input->post('repeat_password')))){
			$config = array_merge(
				$config,
				array(
					array(
		                'field'   => 'password',
		                'label'   => 'Password',
		                'rules'   => 'required'
		            ),
		            array(
		                'field'   => 'repeat_password',
		                'label'   => 'Repeat Password',
		                'rules'   => 'required|matches[password]'
		            )
				)
			);
		}
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
				$this->edit($user_id);
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
		$alert_message = 'User Saved...';
		try{
			
			switch ($type) {
				case 'insert':
					$this->users->create($this->input->post());		
					break;
				case 'update':
					$this->users->update($this->input->post());
					$alert_message = 'User Updated...';
					break;
				default:
					break;
			}
				
			$this->session->set_flashdata('alert_type','Success');
            $this->session->set_flashdata('alert_message',$alert_message);
			redirect($this->_role . '/users/mylist');
		}catch(Exception $e){
			$this->_alert_type = "Error";
            $this->_alert_message = $e->getMessage();
		}
	}	

}