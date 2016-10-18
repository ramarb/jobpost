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

        $this->check_sp_result();
	}
	
	public function update($id, $industry){
		$sql = "CALL sp_industry_update(
			".$this->db->escape($id).",
			".$this->db->escape($industry).",
			@message,
        	@return_id
		)";
		
		$this->common($sql);

        $this->check_sp_result();
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
	

}