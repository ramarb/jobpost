<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancies extends MY_Controller_Employer {


    public function __construct() {
        parent::__construct();
		
		$this->load->model('Users_model','users');
		$this->load->model('Vacancies_model','vacancies');
		$this->load->model('Miscellaneous_model','miscellaneous');


		
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
			'pagination' => $this->pagination->create_links(),
			'role' => $this->_role
		);
		$this->render($this->_role . '/vacancy_list', $data);
        
	}
	
	public function create($error=0){

        if($error === 0){
            try{
                $result = $this->users->read_row($this->user->id);
                $result['description'] = '';
                $this->data = array_merge($result,$this->data);
            }catch (Exception $e){
                $this->set_alert_message('Error',$e->getMessage());
            }
        }

		$this->render($this->_role . '/vacancy_create',$this->data);
	}
	
	public function edit($vacancy_id){
		$result = $this->vacancies->read_row($this->user->role_name, $this->user->id,$vacancy_id);
		
		foreach ($result as $key => $value) {
			if(isset($_POST[$key])){
				$result[$key] = $_POST[$key];	
			}
		}
		
		$data = $result;
		
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
                $this->data = array_merge($this->input->post(),$this->data);
                $this->create(1);
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
				
            $this->set_alert_message('Success',$alert_message,true);

			redirect($this->_role . '/vacancies/mylist');
		}catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage());
		}
	}

    public function applicants(){
        try{
            $this->js_header = javascript(array('angular.min'));
            $this->js_footer = javascript(array('vacancy_employer'));
            $result = $this->vacancies->read_vacancy_applicant_by_employer($this->user->id);
            $this->render($this->_role . '/applicants',array('applicants'=>$result));
        }catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage(),true);
            redirect($this->_role.'/account');
        }
    }

    public function download_resume($vacancy_applicant_id){

        try{
            $result = $this->vacancies->read_vacancy_applicant_by_employer($this->user->id, $vacancy_applicant_id)->row();
            $this->vacancies->update_vacancy_applicant_status($vacancy_applicant_id, 'in progress');
            $this->download_file($result->resume_id);

        }catch (Exception $e){
            $this->set_alert_message('Error',$e->getMessage(),true);
            redirect($this->_role . '/vacancies/applicants');
        }

        //$this->download_file($files_id);
    }

}