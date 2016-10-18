<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: MY_Controller
 *
 * @see CI_Controller
 */
class MY_Controller extends CI_Controller {
	/**
	 * @var string $platform which the default platform is "desktop"
	 */
	private $_unit = 'desktop';
	
	public $user = '';
    public $js_header = '';
    public $js_footer = '';
	
	/**
	 * __construct()
	 *
	 * Override $platform class variable.
	 */
	public function __construct() {
		parent::__construct();
		$this->user = $this->session->userdata('login');
		// load common models and libraries here;
	}

	public function render($body, $data){
		
		$role = ((isset($this->user->role_name) === true)?$this->user->role_name:"");
		$data['javascripts_header'] = $this->js_header;
        $data['javascripts_footer'] = $this->js_footer;
        $this->switch_header($role,$data);
        $this->load->view($this->_unit . '/' . $body);
        $this->load->view($this->_unit . '/common/footer');
    }
	
	private function switch_header($role,$data){
        $data['role'] = $role;
		switch ($role) {
			case 'Employer':
				$this->load->view($this->_unit . '/employer/header',$data);
				break;
			case 'Moderator':
				$this->load->view($this->_unit . '/moderator/header',$data);
				break;	
			default:
				$this->load->view($this->_unit . '/common/header',$data);
				break;
		}
	}
	
	public function redirect(){
		if(isset($this->session->userdata('login')->role_name) === true){
			switch ($this->session->userdata('login')->role_name) {
				case 'Employer':
					redirect('employer/account');					
					break;
				case 'Job Seeker':
					redirect('jobseeker/account');					
					break;
				case 'Moderator':
					redirect('moderator/account');					
					break;		
				default:
					redirect('registration');		
					break;
			}
		}
	}
}

class MY_Controller_Employer extends MY_Controller {

	private $_unit = 'desktop';
	public $user = '';
	public $_role = 'employer';
    public $js_header = '';
    public $js_footer = '';

	/**
	 * Load all the common models and libraries here.
	 * For a more specific model/library, load it in their respective
	 * child controller class.
	 */
	public function __construct() {

		parent::__construct();
		
		$this->user = $this->session->userdata('login');
		
		if(isset($this->user->id) === false && $this->user->role_name != 'Employer'){
			redirect('login');
		}
		
	}
	
	public function render($body, $data){
        $data['javascripts_header'] = $this->js_header;
        $data['javascripts_footer'] = $this->js_footer;
		$this->load->view($this->_unit . '/' . $this->_role . '/header',$data);
        $this->load->view($this->_unit . '/' . $body);
        $this->load->view($this->_unit . '/' . $this->_role . '/footer');	
	}
	
	public function redirect(){
		if(isset($this->session->userdata('login')->role_name) === true){
			switch ($this->session->userdata('login')->role_name) {
				case 'Employer':
					redirect('employer/account');					
					break;
				case 'Job Seeker':
					redirect('jobseeker/account');					
					break;	
				default:
					redirect('registration');		
					break;
			}
		}else{
			redirect('login');
		}
	}

}


class MY_Controller_Moderator extends MY_Controller {

	private $_unit = 'desktop';
	
	public $user = '';
	
	public $_role = 'moderator';
    public $js_header = '';
    public $js_footer = '';

	/**
	 * Load all the common models and libraries here.
	 * For a more specific model/library, load it in their respective
	 * child controller class.
	 */
	public function __construct() {

		parent::__construct();
		
		$this->user = $this->session->userdata('login');
		
		if(isset($this->user->id) === false && $this->user->role_name != 'Employer'){
			redirect('login');
		}
		
	}
	
	public function render($body, $data){

        $data['javascripts_header'] = $this->js_header;
        $data['javascripts_footer'] = $this->js_footer;
		$this->load->view($this->_unit . '/' . $this->_role . '/header',$data);
        $this->load->view($this->_unit . '/' . $body);
        $this->load->view($this->_unit . '/' . $this->_role . '/footer');	
	}
	
	public function redirect(){
		if(isset($this->session->userdata('login')->role_name) === true){
			switch ($this->session->userdata('login')->role_name) {
				case 'Employer':
					redirect('employer/account');					
					break;
				case 'Job Seeker':
					redirect('jobseeker/account');					
					break;
				case 'Moderator':
					redirect('moderator/account');					
					break;		
				default:
					redirect('registration');		
					break;
			}
		}else{
			redirect('login');
		}
	}

}

