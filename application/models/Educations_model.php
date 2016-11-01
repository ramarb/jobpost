<?php
/**
 * Created by PhpStorm.
 * User: ramon
 * Date: 11/1/16
 * Time: 11:39 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Educations_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create($users_id, $data){

        check_int($users_id,'users_id');

        $sql = "CALL sp_education_create_update(
            '0',
            ".$this->db->escape($users_id).",
            ".$this->db->escape($data['education_types_id']).",
            ".$this->db->escape($data['course']).",
            ".$this->db->escape($data['school']).",
            ".$this->db->escape($data['date_from']).",
            ".$this->db->escape($data['date_to']).",
            ".$this->db->escape($data['cities_id']).",
            ".$this->db->escape($data['address']).",
            ".$this->db->escape($data['achievements']).",
            @message,
        	@return_id
        );";

        $this->common($sql);
        $this->check_sp_result();

    }

    public function update($users_id,$educations_id,$data){
        check_int($users_id,'users_id');
        check_int($educations_id,'educations_id');

        $sql = "CALL sp_education_create_update(
            ".$this->db->escape($educations_id).",
            ".$this->db->escape($users_id).",
            ".$this->db->escape($data['education_types_id']).",
            ".$this->db->escape($data['course']).",
            ".$this->db->escape($data['school']).",
            ".$this->db->escape($data['date_from']).",
            ".$this->db->escape($data['date_to']).",
            ".$this->db->escape($data['cities_id']).",
            ".$this->db->escape($data['address']).",
            ".$this->db->escape($data['achievements']).",
            @message,
        	@return_id
        );";

        $this->common($sql);
        $this->check_sp_result();
    }

    public function read($users_id){
        check_int($users_id,'users_id');

        $sql = "SELECT
                    educations.*,
                    education_types.name AS education_type,
                    educations.cities_id AS city,
                    provinces.id AS province

                FROM educations
                LEFT JOIN education_types ON education_types.id = educations.education_types_id
                LEFT JOIN cities ON cities.id = educations.cities_id
                LEFT JOIN provinces ON provinces.id = cities.provinces_id
                WHERE users_id = {$users_id}";

        return $this->common($sql);
    }

}