<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Vacancies_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function read_industry_categories(){
    	$sql = "
    		SELECT
    			job_industries.id job_industry_id,
    			job_industries.name job_industry,
    			job_categories.id job_category_id,
    			job_categories.name job_category
    		FROM job_categories
    		INNER JOIN job_industries ON job_industries.id = job_categories.job_industries_id
    		ORDER BY job_industries.name, job_categories.name
    		 
    	";
		return $this->common($sql);
    }
	
	public function create($user_id, $data){
		
		 $sql = "CALL sp_vacancy_create(
		 	".$this->db->escape($user_id).",
		 	".$this->db->escape($data['category']).",
		 	".$this->db->escape($data['city']).",
		 	".$this->db->escape($data['company']).",
		 	".$this->db->escape($data['title']).",
		 	".$this->db->escape($data['description']).",
		 	".$this->db->escape($data['salary']).",
		 	".$this->db->escape($data['address']).",
		 	@message,
		 	@return_id	
		 )";
		 $this->common($sql);
         $this->check_sp_result();
		 
	}
	
	public function update($role, $user_id, $vacancy_id, $data){
		
		$where = "WHERE users_id = {$user_id} AND id = {$vacancy_id}";
		
		if($role === 'Moderator'){
			$where = "WHERE id = {$vacancy_id}";
		}
		
		$sql = "
			UPDATE vacancies 
			SET
				job_categories_id = ".$this->db->escape($data['category']).",
				cities_id = ".$this->db->escape($data['city']).",
				address = ".$this->db->escape($data['address']).",
				company = ".$this->db->escape($data['company']).",
				title = ".$this->db->escape($data['title']).",
				description = ".$this->db->escape($data['description']).",
				salary = ".$this->db->escape($data['salary'])."
			{$where} 
			LIMIT 1	
		";
		
		return $this->common($sql);
	}
	
	public function read_row($role, $user_id, $vacancy_id){
			
		$where = "WHERE users_id = {$user_id} AND vacancies.id = {$vacancy_id}";
		
		if($role === 'Moderator'){
			$where = "WHERE vacancies.id = {$vacancy_id}";
		}	
		
		$sql = "
			SELECT
				vacancies.*,
				job_industries.id industry,
				job_industries.name industry_name,
				job_categories.id category,
				job_categories.name category_name,
				provinces.id province,
				provinces.name provice_name,
				cities.id city,
				cities.name city_name,
				vacancy_states.name vacancy_state
			FROM vacancies
			INNER JOIN cities ON cities.id = vacancies.cities_id
			INNER JOIN provinces ON provinces.id = cities.provinces_id
			INNER JOIN job_categories ON job_categories.id = vacancies.job_categories_id
			INNER JOIN job_industries ON job_industries.id = job_categories.job_industries_id
			INNER JOIN vacancy_states ON vacancy_states.id = vacancies.vacancy_states_id
			{$where}
			LIMIT 1
		";
		
		$return = $this->common($sql);
		
		if($return->num_rows() > 0){
			$return = $return->row_array();
		}else{
			throw new UnexpectedValueException('Record not found!');
		}
		
		return $return;
		
	}
	
	public function read_row_by_public($vacancy_id){
			
		$where = "WHERE vacancies.id = {$vacancy_id}";
		
		$sql = "
			SELECT
				vacancies.*,
				job_industries.id industry,
				job_industries.name industry_name,
				job_categories.id category,
				job_categories.name category_name,
				provinces.id province,
				provinces.name provice_name,
				cities.id city,
				cities.name city_name,
				vacancy_states.name vacancy_state
			FROM vacancies
			INNER JOIN cities ON cities.id = vacancies.cities_id
			INNER JOIN provinces ON provinces.id = cities.provinces_id
			INNER JOIN job_categories ON job_categories.id = vacancies.job_categories_id
			INNER JOIN job_industries ON job_industries.id = job_categories.job_industries_id
			INNER JOIN vacancy_states ON vacancy_states.id = vacancies.vacancy_states_id
			{$where}
			LIMIT 1
		";
		
		$return = $this->common($sql);
		
		if($return->num_rows() > 0){
			$return = $return->row();
		}else{
			throw new UnexpectedValueException('Record not found!');
		}
		
		return $return;
		
	}

	public function read_by_owner($user_id,$limit=2,$offset=0,$count=false){
			
		$limit_ = "LIMIT {$offset}, {$limit}";	
		
		$select = "
				vacancies.*,
				job_industries.name industry,
				job_categories.name category,
				provinces.name provice,
				cities.name city,
				vacancy_states.name vacancy_state
		";	
		if($count===true){
			$limit_ = "";
			$select = "COUNT(*) total";
		}		
		
		$sql = "
			SELECT
				{$select}
			FROM vacancies
			INNER JOIN cities ON cities.id = vacancies.cities_id
			INNER JOIN provinces ON provinces.id = cities.provinces_id
			INNER JOIN job_categories ON job_categories.id = vacancies.job_categories_id
			INNER JOIN job_industries ON job_industries.id = job_categories.job_industries_id
			INNER JOIN vacancy_states ON vacancy_states.id = vacancies.vacancy_states_id
			WHERE vacancies.users_id = {$user_id}
			ORDER BY vacancies.date_added DESC
			{$limit_}
		";
		
		$return = $this->common($sql);
		
		if($count === true){
			$row = $return->row();
			$return = $row->total;
		}
		
		return $return;
	}
	
	public function read_by_moderator($limit=2,$offset=0,$count=false,$sort='', $order=''){
		$limit_ = "LIMIT {$offset}, {$limit}";	
		$order = "ORDER BY {$sort} {$order}";
		$select = "
				vacancies.*,
				job_industries.name industry,
				job_categories.name category,
				provinces.name provice,
				cities.name city,
				vacancy_states.name vacancy_state
		";	
		if($count===true){
			$limit_ = "";
			$select = "COUNT(*) total";
			$order = '';
		}		
		
		$sql = "
			SELECT
				{$select}
			FROM vacancies
			INNER JOIN cities ON cities.id = vacancies.cities_id
			INNER JOIN provinces ON provinces.id = cities.provinces_id
			INNER JOIN job_categories ON job_categories.id = vacancies.job_categories_id
			INNER JOIN job_industries ON job_industries.id = job_categories.job_industries_id
			INNER JOIN vacancy_states ON vacancy_states.id = vacancies.vacancy_states_id
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
	
	public function read_by_public($keyword = '', $limit = 0, $offset = 0, $count = false, $sort = '', $order = ''){
			
		$limit_ = "LIMIT {$offset}, {$limit}";	
		$order = "ORDER BY {$sort} {$order}";
        $where = array();

        if(is_array($keyword) === true && count($keyword) > 0){

            if(isset($keyword['provinces_id']) === true &&  (int)$keyword['provinces_id'] > 0){
                $provinces_id = (int)$keyword['provinces_id'];
                $where[] = "cities.id IN(
                    SELECT id FROM cities WHERE cities.provinces_id = {$provinces_id}
                )";
            }

            if(isset($keyword['cities_id']) === true &&  (int)$keyword['cities_id'] > 0){
                $cities_id = (int)$keyword['cities_id'];
                $where[] = "cities.id = {$cities_id}";
            }

            if(isset($keyword['job_industries_id']) === true &&  (int)$keyword['job_industries_id'] > 0){
                $job_industries_id = (int)$keyword['job_industries_id'];
                $where[] = "job_categories.id IN(
                    SELECT id FROM job_categories WHERE job_categories.job_industries_id = {$job_industries_id}
                )";
            }

            if(isset($keyword['job_categories_id']) === true &&  (int)$keyword['job_categories_id'] > 0){
                $job_categories_id = (int)$keyword['job_categories_id'];
                $where[] = "job_categories_id = {$job_categories_id}";
            }

            if(isset($keyword['keyword']) === true){
                $keyword = $keyword['keyword'];
            }else{
                $keyword = '';
            }
        }

		if(strlen(trim($keyword))>0){
			$where[] = "MATCH(vacancies.title, vacancies.description, vacancies.company, job_categories.name, job_industries.name) AGAINST(".$this->db->escape($keyword)." IN BOOLEAN MODE)";
		}

        if(count($where) > 0){
            $where = "WHERE " . implode(" AND ", $where);
        }else{
            $where = '';
        }
		
		$select = "
				vacancies.*,
				job_industries.name industry,
				job_categories.name category,
				provinces.name provice,
				cities.name city,
				vacancy_states.name vacancy_state
		";	
		if($count===true){
			$limit_ = "";
			$select = "COUNT(*) total";
			$order = '';
		}		
		
		$sql = "
			SELECT
				{$select}
			FROM vacancies
			INNER JOIN cities ON cities.id = vacancies.cities_id
			INNER JOIN provinces ON provinces.id = cities.provinces_id
			INNER JOIN job_categories ON job_categories.id = vacancies.job_categories_id
			INNER JOIN job_industries ON job_industries.id = job_categories.job_industries_id
			INNER JOIN vacancy_states ON vacancy_states.id = vacancies.vacancy_states_id
			{$where}
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
     * @param $users_id
     * @return array
     */
    public function read_vacancy_applicant_by_employer($users_id, $id = ''){
        check_int($users_id);
        $sql = "SELECT
                    vacancy_applicants.id,
                    vacancy_applicants.vacancies_id,
                    vacancy_applicant_states.name AS vacancy_applicant_state,
                    vacancies.title,
                    applicant_profile.first_name,
                    applicant_profile.last_name,
                    user_work_experieces.position,
                    (SELECT files.id
                        FROM files
                        INNER JOIN user_files ON user_files.files_id = files.id
                        WHERE user_files.users_id = applicant.id
                        ORDER BY files.date_added DESC
                        LIMIT 1
                    ) AS resume_id

                FROM vacancy_applicants
                INNER JOIN vacancies ON vacancies.id = vacancy_applicants.vacancies_id
                INNER JOIN vacancy_applicant_states on vacancy_applicant_states.id = vacancy_applicants.vacancy_applicant_states_id
                INNER JOIN users AS applicant ON applicant.id = vacancy_applicants.users_id
                INNER JOIN user_profiles AS applicant_profile ON applicant_profile.users_id = applicant.id
                LEFT JOIN user_work_experieces ON user_work_experieces.users_id = applicant.id AND user_work_experieces.is_present = 1
                INNER JOIN users AS vacancy_owner ON vacancy_owner.id = vacancies.users_id
                WHERE vacancy_owner.id = {$users_id}
                " . (((int)$id > 0)?"   AND vacancy_applicants.id = {$id}":"") . "
                ";

        return $this->common($sql);

    }

    /**
     * @param $id
     * @param $status
     * @return array
     */
    public function update_vacancy_applicant_status($id, $status){
        check_int($id,'id');
        check_string($status,'status');
        $sql = "UPDATE vacancy_applicants
            SET vacancy_applicant_states_id = (
                SELECT id FROM vacancy_applicant_states WHERE name = ".$this->db->escape($status)."
            )
            WHERE id = {$id};
        ";

        return $this->common($sql);
    }

}