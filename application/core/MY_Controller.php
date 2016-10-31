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
    public $_alert_message = '';
    public $_alert_type = '';
	public $_unit = 'desktop';
	
	public $user = '';
    public $css_header = '';
    public $js_header = '';
    public $js_footer = '';
    public $js_common = '';
    public $js_variables = array();
    public $js_variables_render = '';
    public $data = array();
    public $role_name = '';
    public $_role = '';
    public $controller = '';
    public $user_view = '';

    public $jquery_switch = 'On';
    public $main_ng_switch = 'On';
	
	/**
	 * __construct()
	 *
	 * Override $platform class variable.
	 */
	public function __construct() {
		parent::__construct();
		$this->user = $this->session->userdata('login');
        if(isset($this->user->id) === false){
            $this->user = json_encode(array('id'=>0));
        }
        $this->role_name = ((isset($this->user->role_name) === true)?$this->user->role_name:"");
        $this->_role = ((isset($this->user->role) === true)?$this->user->role:"");
        $this->data['role_name'] = $this->role_name;

        if($this->session->flashdata('alert_type')){
            $this->_alert_type = $this->session->flashdata('alert_type');
        }

        if($this->session->flashdata('alert_message')){
            $this->_alert_message = $this->session->flashdata('alert_message');
        }

        $this->data['controller'] = $this->controller;
        $this->js_common = javascript(array('helper'));
        $this->js_variables = array(
            'base_url'      => base_url(),
            'controller'    => $this->controller,
            'jquery_switch' => ($this->jquery_switch === 'On')
        );


	}

	public function render($body, $data){
        $this->js_variables['role'] = $this->_role;
        $this->js_variables['base_uri'] = base_url($this->_role.'/'.$this->controller);

        $this->js_variables_render = javascript_variable($this->js_variables);
		$this->data['javascripts_header'] = $this->js_header;
        $this->data['css_header'] = $this->css_header;
        $this->data['javascripts_footer'] = $this->js_variables_render.$this->js_footer.$this->js_common;
        $this->data['jquery_switch'] = ($this->jquery_switch === 'On');
        $this->data['main_ng_switch'] = ($this->main_ng_switch === 'On');

        $this->data = array_merge($data, $this->data,$this->get_alert_message());

        $this->switch_header($this->role_name,$this->data);

        $this->load->view($this->_unit . '/' . $body);
        $this->load->view($this->_unit . '/common/footer');
    }

    public function render_logged_in($body, $data=array()){
        $this->data['css_header'] = $this->css_header;
        $this->data['jquery_switch'] = ($this->jquery_switch === 'On');
        $this->data['main_ng_switch'] = ($this->main_ng_switch === 'On');

        $this->js_variables['role'] = $this->_role;
        $this->js_variables['base_uri'] = base_url($this->_role.'/'.$this->controller);

        $this->js_variables_render = javascript_variable($this->js_variables);
        $data['javascripts_header'] = $this->js_header;

        $data['javascripts_footer'] = $this->js_variables_render.$this->js_footer.$this->js_common;


        $data = array_merge($this->get_alert_message(),$data,$this->data);

        $this->load->view($this->_unit . '/' . $this->_role . '/header',$data);
        $this->load->view($this->_unit . '/' . $body);
        $this->load->view($this->_unit . '/' . $this->_role . '/footer');
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
            case 'Job Seeker':
                $this->load->view($this->_unit . '/jobseeker/header',$data);
                break;
			default:
				$this->load->view($this->_unit . '/common/header',$data);
				break;
		}
	}

    public function get_alert_message(){
        return array('alert_message' => $this->_alert_message, 'alert_type' => $this->_alert_type);
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

    public function set_alert_message($type,$message,$flash=false){
        if($flash === true){
            $this->session->set_flashdata('alert_type',$type);
            $this->session->set_flashdata('alert_message',$message);
        }else{
            $this->_alert_type = $type;
            $this->_alert_message = $message;
        }
    }

    public function download_file($files_id){
        $this->load->model('Files_model','files');
        $this->load->library('file_management',array(),'file_u');
        try{
            if((int)$this->user->id < 1){
                throw new UnexpectedValueException('You need to login In order to download file',400);
            }
            $file = $this->files->read_file_by_id($files_id)->row();
            $this->file_u->download($file->location, $file->name, $file->type);
        }catch(Exception $e){
            $this->set_alert_message('Error',$e->getMessage(),true);
            redirect($this->_role.'/account');
        }
    }

    public function upload_file($user_file_type, $file_index){

        $return = true;


        $data = array(
            'index' => $file_index,
            'move_to' => $this->user->id . '/files/'
        );
        //
        if(isset($_FILES[$file_index])){

            $this->load->library('file_management',$data,'file_upload');

            if(count($this->file_upload->get_file_uploaded()) > 0){
                $this->file_upload->move();
                $result = $this->file_upload->get_result();

                if((int)$result['error'] > 0){
                    $error_message = '';
                    foreach($result['error_message'] as $message){
                        $error_message .= $message.'<br />';
                    }
                    $this->set_alert_message('Error',$error_message);
                    $return = false;
                }else{

                    $data = $result['data'];

                    try{

                        $this->file->create_user_file($this->user->id, $data['location'], $data['name'], $data['size'], $data['type'], $user_file_type, 'Active');
                        $this->set_alert_message('Success','Changes Saved',true);

                    }catch (Exception $e){
                        $this->set_alert_message('Error',$e->getMessage());
                        $return = false;
                    }
                }
            }else{
                $this->set_alert_message('Error','Uploading error set 1');
            }
        }

        return $return;
    }

    public function ng_materials(){
        /**
         * <script type="text/javascript" src="http://eugene/assets/js/angular/angular-route.min.js"> </script>
        <script type="text/javascript" src="http://eugene/assets/js/angular/svg-assets-cache.js"> </script>
         */
        return array(
            'angular/angular-animate.min',
            'angular/angular-aria.min',
            'angular/angular-material.min',
            'angular/angular-messages.min',
            'angular/angular-route.min',
            'angular/svg-assets-cache'
        );
    }

}

class MY_Controller_Employer extends MY_Controller {

	/**
	 * Load all the common models and libraries here.
	 * For a more specific model/library, load it in their respective
	 * child controller class.
	 */
	public function __construct() {

		parent::__construct();
		
		$this->user = $this->session->userdata('login');
        $this->_role = 'employer';
        $this->data['_role'] = $this->_role;
        $this->data['role'] = $this->_role;
		
		if(isset($this->user->id) === false && $this->user->role_name != 'Employer'){
			redirect('login');
		}

        if($this->user->role_name !== 'Employer'){
            $this->redirect();
        }
		
	}
	
	public function render($body, $data = array()){
        $this->render_logged_in($body,$data);
	}

}

class MY_Controller_Job_Seeker extends MY_Controller {

    /**
     * Load all the common models and libraries here.
     * For a more specific model/library, load it in their respective
     * child controller class.
     */
    public function __construct() {

        parent::__construct();

        $this->user = $this->session->userdata('login');
        $this->_role = 'jobseeker';
        $this->data['_role'] = $this->_role;
        $this->data['role'] = $this->_role;

        if(isset($this->user->id) === false && $this->user->role_name != 'Job Seeker'){
            redirect('login');
        }

        if($this->user->role_name !== 'Job Seeker'){
            $this->redirect();
        }

    }

    public function render($body, $data = array()){
        $this->render_logged_in($body,$data);
    }

}


class MY_Controller_Moderator extends MY_Controller {

	/**
	 * Load all the common models and libraries here.
	 * For a more specific model/library, load it in their respective
	 * child controller class.
	 */
	public function __construct() {

		parent::__construct();
		
		$this->user = $this->session->userdata('login');
        $this->_role = 'moderator';
        $this->data['_role'] = $this->_role;
        $this->data['role'] = $this->_role;

		
		if(isset($this->user->id) === false && $this->user->role_name != 'Moderator'){
			redirect('login');
		}

        if($this->user->role_name !== 'Moderator'){
            $this->redirect();
        }
		
	}
	
	public function render($body, $data = array()){
        $this->render_logged_in($body,$data);
	}

}

