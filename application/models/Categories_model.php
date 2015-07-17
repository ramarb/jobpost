<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categories_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function read_row($id){
		$sql = "
			SELECT 
				job_categories.*,
				job_categories.name category,
				job_industries.name industry,
				job_industries.id industry_id
			FROM job_categories
			INNER JOIN job_industries ON job_industries.id = job_categories.job_industries_id
			WHERE job_categories.id = {$id} LIMIT 1;";
		$result = $this->common($sql);
		$return = '';
		if($result->row() === null){
			throw new UnexpectedValueException('Record Not Found');	
		}else{
			$return = $result->row_array();
		}
		
		return $return;
	}
	
	public function create($data){
		$sql = "CALL sp_category_create(
			".$this->db->escape($data['industry_id']).",
			".$this->db->escape($data['category']).",
			@message,
        	@return_id
		)";
		
		$this->common($sql);
		
		$result = $this->common("SELECT @message alert");
		
		$result = $result->row();
		
		if($result->alert == 'Duplicate'){
			throw new UnexpectedValueException('Category '.$data['category'].' alreary exist!');
		}
	}
	
	public function update($data){
		$sql = "CALL sp_category_update(
			".$this->db->escape($data['category_id']).",
			".$this->db->escape($data['industry_id']).",
			".$this->db->escape($data['category']).",
			@message,
        	@return_id
		)";
		
		$this->common($sql);
		
		$result = $this->common("SELECT @message alert");
		
		$result = $result->row();
		
		if($result->alert == 'Duplicate'){
			throw new UnexpectedValueException('Category '.$data['category'].' alreary exist!');
		}
	}
	
	public function delete($id){
		$sql = "DELETE FROM job_categories WHERE id = " . $id . ";";
		return $this->common($sql);
	}	
	
	public function read($limit = 0, $offset = 0, $count = false, $sort = '', $order = ''){
		$limit_ = "LIMIT {$offset}, {$limit}";	
		$order = "ORDER BY {$sort} {$order}";
		
		$select = "
				job_categories.*,
				job_industries.name industry
		";	
		if($count===true){
			$limit_ = "";
			$select = "COUNT(*) total";
			$order = '';
		}		
		
		$sql = "
			SELECT 
				{$select} 
			FROM job_categories
			INNER JOIN job_industries ON job_industries.id = job_categories.job_industries_id
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

        if(!$res){
            throw new RuntimeException('Internal query fail! ' . $sql, 400);
        }

        return $res;
    }
}