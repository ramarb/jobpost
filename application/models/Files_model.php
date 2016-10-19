<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: ramon
 * Date: 10/19/16
 * Time: 9:41 AM
 */

class Files_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function create_user_file($user_id, $location, $name, $size, $type, $file_type, $file_state){
        //sp_user_files_create(1,'location','ramon','5000','kita','Resume','Active',@message,@ret_id);

        check_int($user_id,'user_id');
        check_string($location,'location');
        check_string($name, 'name');
        check_string($size,'size');
        check_string($type,'type');
        check_string($file_type,'file_type');
        check_string($file_state,'file_state');

        $sql = "CALL sp_user_files_create(
            ".$this->db->escape($user_id).",
            ".$this->db->escape($location).",
            ".$this->db->escape($name).",
            ".$this->db->escape($size).",
            ".$this->db->escape($type).",
            ".$this->db->escape($file_type).",
            ".$this->db->escape($file_state).",
            @message,
        	@return_id
        );";
        $this->common($sql);
        $this->check_sp_result();

    }


}