<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Miscellaneous_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function pagination_config(){
		
		$config = array();
		
		$config['per_page'] = LIST_LIMIT; 
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#" style="color:black"><b>';
		$config['cur_tag_close'] = '</b></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		return $config;
	}
	
	public function read_user_states(){
		$sql = "
			SELECT *
			FROM user_states
		";
		return $this->common($sql);
	}
	
	public function read_roles(){
		$sql = "
			SELECT *
			FROM roles
			WHERE name != 'Admin'
		";
		return $this->common($sql);
	}
	
	public function read_vacancy_states(){
		$sql = "
			SELECT *
			FROM vacancy_states
		";
		return $this->common($sql);
	}
	
	public function read_industries(){
		return $this->common("SELECT * FROM job_industries");
	}

    public function read_provinces(){
        return $this->common("SELECT * FROM provinces;");
    }
	
	public function read_provinces_cities(){
		$sql = "
			SELECT
				provinces.id province_id,
				provinces.name province, 
				cities.id city_id,
				cities.name city
			FROM cities
			INNER JOIN provinces ON provinces.id = cities.provinces_id
			ORDER BY provinces.name, cities.name ASC
		";
		
		return $this->common($sql);	
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


    /**
     * @param $id
     * @param $field
     * @param $value
     * @param $table
     * @return array
     */
    public function update_field($id,$field,$value,$table){
        check_int($id,'id');
        check_string($field,'field');
        check_string($value,'value');
        check_string($table,'table');

        $sql = "UPDATE `{$table}` SET `{$field}` = " . $this->db->escape($value) . " WHERE id = " . $this->db->escape($id) . ";";
        return $this->common($sql);
    }
	
}