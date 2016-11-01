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
            " . $this->db->escape(date('Y-m-d',strtotime($data['birth_date']))) . ",
            " . $this->db->escape($data['achievements']) . ",
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
				users.id,
				users.username,
				users.username email,
                '' AS password,
				0 repeat_password,
				user_profiles.first_name,
				user_profiles.last_name,
				roles.name role,
				roles.name role_name,
				roles.id AS roles_id,
				user_states.name user_state,
				user_profiles.birth_date,
				FLOOR(DATEDIFF (NOW(), user_profiles.birth_date)/365) AS age,
				user_profiles.achievements,
				user_work_experieces.position,
                user_work_experieces.company,
				(
				    SELECT
				      files.location
				    FROM user_files
				    INNER JOIN user_file_types ON user_file_types.id = user_files.user_file_types_id
				    INNER JOIN files ON files.id = user_files.files_id
				    WHERE user_files.users_id = {$user_id}
				      AND user_file_types.name = '".USER_FILE_TYPE_PROFILE_PHOTO."'
				      ORDER BY files.date_added DESC
				      LIMIT 1
				) AS profile_picture,
                companies.name,
                companies.name AS company,
                companies.description,
                companies.address,
                companies.contact_number,
                companies.job_categories_id AS category,
                companies.cities_id AS city,
                job_industries.id AS industry,
				provinces.id AS province,
                '' AS title,
                '' AS salary

			FROM users
			INNER JOIN user_profiles on users.id = user_profiles.users_id
			INNER JOIN user_roles on users.id = user_roles.users_id
			INNER JOIN roles on roles.id = user_roles.roles_id 
			INNER JOIN user_states on user_states.id = users.user_states_id
			LEFT JOIN companies ON companies.users_id = users.id
            LEFT JOIN job_categories ON job_categories.id = companies.job_categories_id
            LEFT JOIN job_industries ON job_industries.id = job_categories.job_industries_id
            LEFT JOIN cities ON cities.id = companies.cities_id
            LEFT JOIN provinces ON provinces.id = cities.provinces_id
			LEFT JOIN user_work_experieces on user_work_experieces.users_id = users.id AND user_work_experieces.is_primary = 1
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

    public function read_job_seekers(){
        $sql = "
			SELECT
				users.id,
				users.username,
				users.username email,
                '' AS password,
				0 repeat_password,
				user_profiles.first_name,
				user_profiles.last_name,
				roles.name role,
				roles.name role_name,
				user_states.name user_state,
				user_profiles.birth_date,
				FLOOR(DATEDIFF (NOW(), user_profiles.birth_date)/365) AS age,
				user_profiles.achievements,
				user_work_experieces.position,
                user_work_experieces.company,
				(
				    SELECT
				      files.location
				    FROM user_files
				    INNER JOIN user_file_types ON user_file_types.id = user_files.user_file_types_id
				    INNER JOIN files ON files.id = user_files.files_id
				    WHERE user_files.users_id = users.id
				      AND user_file_types.name = '".USER_FILE_TYPE_PROFILE_PHOTO."'
				      ORDER BY files.date_added DESC
				      LIMIT 1
				) AS profile_picture

			FROM users
			INNER JOIN user_profiles on users.id = user_profiles.users_id
			INNER JOIN user_roles on users.id = user_roles.users_id
			INNER JOIN roles on roles.id = user_roles.roles_id
			INNER JOIN user_states on user_states.id = users.user_states_id
			LEFT JOIN user_work_experieces on user_work_experieces.users_id = users.id AND user_work_experieces.is_primary = 1

			WHERE roles.name = 'Job Seeker'
			";

        return $this->common($sql);
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
		
		if(isset($result->password) == true && $result->password === md5($data['password'])){
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

        $fields = array('users_id','position','year_from','month_from','year_to','month_to','is_present','monthly_salary','company','description');

        foreach($fields as $index => $value){
            if($value === 'users_id'){
                check_int($$value, $value);
            }elseif(in_array($value,array('users_id','position','year_from','month_from','company')) === true){
                check_string($$value, $value);
            }
        }

        $date_from = date('Y-m-d',strtotime($year_from . ' ' . $month_from));
        $date_to = date('Y-m-d',strtotime($year_to . ' ' . $month_to));

        if((int)$is_present === 1){
            $date_to = '';
        }


        $sql = "INSERT INTO user_work_experieces(users_id,position,date_from,".((strlen($date_to) > 0)?"date_to,":"")."is_present,monthly_salary,company,description)
            VALUES(
                ".$this->db->escape($users_id).",
                ".$this->db->escape($position).",
                ".$this->db->escape($date_from).",
                ".((strlen($date_to) > 0)?"".$this->db->escape($date_to).",":"")."
                ".$this->db->escape($is_present).",
                ".$this->db->escape($monthly_salary).",
                ".$this->db->escape($company).",
                ".$this->db->escape($description)."
            );";

        return $this->common($sql);
    }

    /**
     * @param $users_id
     * @param $data
     * @return array
     */
    public function update_user_work_experience($users_id,$data){
        $id = $data['id'];
        check_int($id,'id');
        check_int($users_id,'users_id');

        foreach($data as $index => $value){
            if($value === 'users_id'){
                check_int($value, $index);
            }elseif(in_array($index,array('users_id','position','year_from','month_from','company')) === true){
                check_string($value, $index);
            }
        }

        $date_from = date('Y-m-d',strtotime($data['year_from'] . ' ' . $data['month_from']));
        $date_to = date('Y-m-d',strtotime($data['year_to'] . ' ' . $data['month_to']));

        $data['monthly_salary'] = '';
        $data['is_present'] = 0;

        if($data['month_to'] === 'Present'){
            $data['is_present'] = 1;
            $date_to = '';
        }


        $sql = "UPDATE user_work_experieces
            SET
                position = ".$this->db->escape($data['position']).",
                date_from = ".$this->db->escape($date_from).",
                ".((strlen($date_to) > 0)?"date_to = ".$this->db->escape($date_to).",":"")."
                is_present = ".$this->db->escape($data['is_present']).",
                monthly_salary = ".$this->db->escape($data['monthly_salary']).",
                company = ".$this->db->escape($data['company']).",
                description = ".$this->db->escape($data['description'])."
            WHERE id = {$id} AND users_id = {$users_id}
        ";

        return $this->common($sql);
    }

    /**
     * @param $id
     * @return array
     */
    public function  delete_user_work_experience_by_owner($users_id, $id){
        check_int($id,'id');
        check_int($users_id);
        return $this->common("DELETE FROM user_work_experieces WHERE id = " . $this->db->escape($id) . " AND users_id = {$users_id} LIMIT 1;");
    }

    /**
     * @param $users_id
     * @return array
     */
    public function read_user_work_experience($users_id){
        check_int($users_id,'user_id');
        $sql = " SELECT
              *,
               DATE_FORMAT(date_from,'%M') AS month_from,
               DATE_FORMAT(date_from,'%Y') AS year_from,
               DATE_FORMAT(date_to,'%M') AS month_to,
               DATE_FORMAT(date_to,'%Y') AS year_to
          FROM user_work_experieces
          WHERE users_id = {$users_id}
          ORDER BY is_primary ASC, is_present ASC, date_from DESC;";
        return $this->common($sql);
    }

    /**
     * @param $users_id
     * @param $id
     * @return array
     */
    public function read_user_work_experience_by_id($users_id, $id){
        check_int($users_id,'user_id');
        check_int($id,'id');
        $sql = " SELECT
            *,
               DATE_FORMAT(date_from,'%M') AS month_from,
               DATE_FORMAT(date_from,'%Y') AS year_from,
               DATE_FORMAT(date_to,'%M') AS month_to,
               DATE_FORMAT(date_to,'%Y') AS year_to
        FROM user_work_experieces
        WHERE users_id = {$users_id} AND id = {$id}
        ORDER BY is_primary ASC, is_present ASC, date_from DESC;";

        return $this->common($sql);
    }

    /**
     * @param $users_id
     * @param $user_work_experiences_id
     */
    public function set_primary_work_experience($users_id, $user_work_experiences_id){
        check_int($users_id);
        check_int($user_work_experiences_id);

        $sql = "CALL sp_set_primary_work_experience(
            ".$this->db->escape($users_id).",
            ".$this->db->escape($user_work_experiences_id).",
            @message
        );";

        $this->common($sql);

        $this->check_sp_result();
    }

    /**
     * @param $users_id
     * @param $data
     * @return array
     */
    public function create_company($users_id, $data){

        check_int($users_id,'user_id');

        $sql = "CALL sp_company_create(
                    ".$this->db->escape($users_id).",
                    ".$this->db->escape($data['name']).",
                    ".$this->db->escape($data['description']).",
                    ".$this->db->escape($data['job_categories_id']).",
                    ".$this->db->escape($data['cities_id']).",
                    ".$this->db->escape($data['address']).",
                    ".$this->db->escape($data['contact_number']).",
                    @message,
                    @return_id
                );";
        $this->common($sql);
        $this->check_sp_result();
    }

}