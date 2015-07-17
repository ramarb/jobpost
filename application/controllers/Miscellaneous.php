<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Miscellaneous extends CI_Controller {


    

    public function __construct() {
        parent::__construct();
		
		$this->load->model('Miscellaneous_model','miscellaneous');
    }

	public function index(){
		
	}
	
	public function industry_categories(){
		$industry_categories = array();
		foreach ($this->miscellaneous->read_industry_categories()->result() as $key => $value) {
			$industry_categories[$value->job_industry_id][] = $value;
		}
		
        echo json_encode($industry_categories);
	}
	
	
	public function addresses(){
		
		$locations = array();
		
		foreach ($this->miscellaneous->read_provinces_cities()->result() as $key => $value) {
			$locations[$value->province_id][] = $value;
		}
		
        echo json_encode($locations);
	}
	
	public function form(){
		$this->load->view('desktop/common/industry_categories');
	}
}