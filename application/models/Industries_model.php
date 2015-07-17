<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Industries_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function read_row($id){
		$sql = "SELECT id, name, name industry FROM job_industries WHERE id = {$id} LIMIT 1;";
		$result = $this->common($sql);
		$return = '';
		if($result->row() === null){
			throw new UnexpectedValueException('Record Not Found');	
		}else{
			$return = $result->row_array();
		}
		
		return $return;
	}
	
	public function create($industry){
		$sql = "CALL sp_industry_create(
			".$this->db->escape($industry).",
			@message,
        	@return_id
		)";
		
		$this->common($sql);
		
		$result = $this->common("SELECT @message alert");
		
		$result = $result->row();
		
		if($result->alert == 'Duplicate'){
			throw new UnexpectedValueException('Industry '.$industry.' alreary exist!');
		}
	}
	
	public function update($id, $industry){
		$sql = "CALL sp_industry_update(
			".$this->db->escape($id).",
			".$this->db->escape($industry).",
			@message,
        	@return_id
		)";
		
		$this->common($sql);
		
		$result = $this->common("SELECT @message alert");
		
		$result = $result->row();
		
		if($result->alert == 'Duplicate'){
			throw new UnexpectedValueException('Industry '.$industry.' alreary exist!');
		}
	}
	
	public function delete($id){
		$sql = "DELETE FROM job_industries WHERE id = " . $id . ";";
		return $this->common($sql);
	}	
	
	public function read($limit = 0, $offset = 0, $count = false, $sort = '', $order = ''){
		$limit_ = "LIMIT {$offset}, {$limit}";	
		$order = "ORDER BY {$sort} {$order}";
		
		$select = "*";	
		if($count===true){
			$limit_ = "";
			$select = "COUNT(*) total";
			$order = '';
		}		
		
		$sql = "
			SELECT 
				{$select} 
			FROM job_industries
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