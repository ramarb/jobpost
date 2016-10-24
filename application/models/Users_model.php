<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param $data
     */
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

        $this->check_sp_result();
    }

    /**
     * @param $data
     */
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

        $this->check_sp_result();
	}

    /**
     * @param $user_id
     * @return string
     */
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

    /**
     * @param int $limit
     * @param int $offset
     * @param bool $count
     * @param string $sort
     * @param string $order
     * @return array
     */
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

    /**
     * @param $data
     * @return bool
     */
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
     * @param $users_id
     * @param $vacancies_id
     */
    public function create_vacancy_applicant($users_id,$vacancies_id){
        check_int($users_id,'user_id');
        check_int($vacancies_id,'vacancies_id');

        $sql = "CALL sp_vacancy_applicant_create(
            " . $this->db->escape($users_id) . ",
			" . $this->db->escape($vacancies_id) . ",
			@message,
        	@return_id
        )";

        $this->common($sql);
        $this->check_sp_result();
    }

    /**
     * @param $users_id
     * @param $position
     * @param $year_from
     * @param $month_from
     * @param $year_to
     * @param $month_to
     * @param $is_present
     * @param $monthly_salary
     * @param $company
     * @param $description
     * @return array
     */
    public function create_user_work_experience($users_id,$position,$year_from,$month_from,$year_to,$month_to,$is_present,$monthly_salary,$company,$description){
        /**
         * id	int(11)	NO	PRI		auto_increment
        users_id	int(11)	NO	MUL
        position	varchar(250)	YES
        year_from	varchar(5)	YES
        month_from	varchar(45)	YES
        year_to	varchar(5)	YES
        month_to	varchar(45)	YES
        is_present	int(11)	YES
        monthly_salary	float	YES
        company	varchar(250)	YES
        description	int(11)	YES

         */
        $fields = array('users_id','position','year_from','month_from','year_to','month_to','is_present','monthly_salary','company','description');

        foreach($fields as $index => $value){
            if($value === 'users_id'){
                check_int($$value, $value);
            }else{
                check_string($$value, $value);
            }
        }


        $sql = "INSERT INTO user_work_experieces(users_id,position,year_from,month_from,year_to,month_to,is_present,monthly_salary,company,description)
            VALUES(
                ".$this->db->escape($users_id).",
                ".$this->db->escape($position).",
                ".$this->db->escape($year_from).",
                ".$this->db->escape($month_from).",
                ".$this->db->escape($year_to).",
                ".$this->db->escape($month_to).",
                ".$this->db->escape($is_present).",
                ".$this->db->escape($monthly_salary).",
                ".$this->db->escape($company).",
                ".$this->db->escape($description)."
            );";

        return $this->common($sql);
    }

    /**
     * @param $id
     * @param $data
     * @return array
     */
    public function update_user_work_experience($id,$data){

        check_int($id,'id');

        foreach($data as $index => $value){
            if($value === 'users_id'){
                check_int($value, $index);
            }else{
                check_string($value, $index);
            }
        }
        $sql = "UPDATE user_work_experieces
            SET
                users_id = ".$this->db->escape($data['users_id']).",
                position = ".$this->db->escape($data['position']).",
                year_from = ".$this->db->escape($data['year_from']).",
                month_from = ".$this->db->escape($data['month_from']).",
                year_to = ".$this->db->escape($data['year_to']).",
                month_to = ".$this->db->escape($data['month_to']).",
                is_present = ".$this->db->escape($data['is_present']).",
                monthly_salary = ".$this->db->escape($data['monthly_salary']).",
                company = ".$this->db->escape($data['company']).",
                description = ".$this->db->escape($data['description'])."
            WHERE id = ".$this->db->escape($id)."
        ";

        return $this->common($sql);
    }

    /**
     * @param $id
     * @return array
     */
    public function  delete_user_work_experience($id){
        check_int($id,'id');
        return $this->common("DELETE FROM user_work_experieces WHERE id = " . $this->db->escape($id) . " LIMIT 1;");
    }

    /**
     * @param $users_id
     * @return array
     */
    public function read_user_work_experience($users_id){
        check_int($users_id,'user_id');
        $sql = " SELECT * FROM user_work_experieces where users_id = {$users_id};";
        return $this->common($sql);
    }

}