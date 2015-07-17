<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($data){
    	
        $sql = "CALL sp_user_create(
        	".$this->db->escape($data['role_name']).",
        	".$this->db->escape($data['first_name']).",
        	".$this->db->escape($data['last_name']).",
        	".$this->db->escape($data['email']).",
        	".$this->db->escape($data['password']).",
        	".$this->db->escape($data['user_state']).",
        	@message,
        	@return_id
        )";
		
		$this->common($sql);
		
		$result = $this->common("SELECT @message alert");
		
		$result = $result->row();
		
		if($result->alert == 'Duplicate'){
			throw new UnexpectedValueException('Email alreary exist!');
		}
    }
	
	public function update($data){
		
		$sql = "
			CALL sp_user_update(
			" . $this->db->escape($data['user_id']) . ",
			" . $this->db->escape($data['role_name']) . ",
			" . $this->db->escape($data['first_name']) . ",
			" . $this->db->escape($data['last_name']) . ",
			" . $this->db->escape($data['email']) . ",
			" . $this->db->escape($data['password']) . ",
			" . $this->db->escape($data['user_state']) . ",	
			@message,
        	@return_id
        )";
		
		$this->common($sql);
		
		$result = $this->common("SELECT @message alert");
		
		$result = $result->row();
		
		if($result->alert == 'Duplicate'){
			throw new UnexpectedValueException('Email alreary exist!');
		}
	}
	
	public function read_row($user_id){
		$sql = "
			SELECT 
				users.*,
				users.username email,
				0 repeat_password,
				user_profiles.first_name,
				user_profiles.last_name,
				roles.name role,
				roles.name role_name,
				user_states.name user_state 
			FROM users
			INNER JOIN user_profiles on users.id = user_profiles.users_id
			INNER JOIN user_roles on users.id = user_roles.users_id
			INNER JOIN roles on roles.id = user_roles.roles_id 
			INNER JOIN user_states on user_states.id = users.user_states_id
			WHERE users.id = " . $user_id . " LIMIT 1";
		
		$result = $this->common($sql);
		$return = '';
		if($result->row() === null){
			throw new UnexpectedValueException('Record Not Found');	
		}else{
			$return = $result->row_array();
		}
		
		return $return;
		
	}
	
	public	function read($limit = 0, $offset = 0, $count = false, $sort = '', $order = ''){
		
		$limit_ = "LIMIT {$offset}, {$limit}";	
		$order = "ORDER BY {$sort} {$order}";
		
		$select = "
				users.*,
				user_profiles.first_name,
				user_profiles.last_name,
				roles.name role_name,
				user_states.name user_state
		";	
		if($count===true){
			$limit_ = "";
			$select = "COUNT(*) total";
			$order = '';
		}		
		
		$sql = "
			SELECT 
				{$select} 
			FROM users
			INNER JOIN user_profiles on users.id = user_profiles.users_id
			INNER JOIN user_roles on users.id = user_roles.users_id
			INNER JOIN roles on roles.id = user_roles.roles_id 
			INNER JOIN user_states on user_states.id = users.user_states_id
			{$order}
			{$limit_}
			";
		
		$return = $this->common($sql);
		
		if($count === true){
			$row = $return->row();
			$return = $row->total;
		}
		
		return $return;
	}
	
	public function authenticate($data){
		
		$return = false;
		
		$sql = "
			SELECT 
				users.*,
				user_profiles.first_name,
				user_profiles.last_name,
				roles.name role_name,
				user_states.name user_state 
			FROM users
			INNER JOIN user_profiles on users.id = user_profiles.users_id
			INNER JOIN user_roles on users.id = user_roles.users_id
			INNER JOIN roles on roles.id = user_roles.roles_id 
			INNER JOIN user_states on user_states.id = users.user_states_id
			WHERE users.username = " . $this->db->escape($data['email']) . " LIMIT 1";
		
		$result = $this->common($sql);
		
		$result = $result->row();
		
		if($result->password === md5($data['password'])){
			$this->session->set_userdata('login',$result);
			$return = true;
		}else{
			throw new UnexpectedValueException('Account not found!');
		}
			
		return $return;
	}

    /**
     * @param string $sql
     * @throws InvalidArgumentException if $sql is not string
     * @throws RuntimeException if query fails
     * @return array
     */
    private function common($sql){

        if(is_string($sql) === false || strlen(trim($sql)) < 1){
            throw new InvalidArgumentException('Invalid parameter $sql passed, must be a string', 400);
        }

        $res = $this->db->query($sql);

        if(isset($res->conn_id) == false){
            throw new RuntimeException('Internal query fail! ' . $sql, 400);
        }

        return $res;
    }

}