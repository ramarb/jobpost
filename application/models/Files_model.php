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

    /**
     * @param $type
     * @param $user_id
     * @return array
     */
    public function read_files_by_type_owner($type, $user_id, $limit = ''){

        check_int($user_id,'user_id');
        check_string($type,'type');

        $sql = "SELECT
                    user_files.id AS user_files_id,
                    user_file_types.name type,
                    files.name file_name,
                    files.date_added,
                    files.id files_id

                FROM user_files
                    INNER JOIN user_file_states ON user_file_states.id = user_files.user_file_states_id
                    INNER JOIN user_file_types ON user_file_types.id = user_files.user_file_types_id
                    INNER JOIN files ON files.id = user_files.files_id
                    INNER JOIN users ON users.id = user_files.users_id
                WHERE users.id = {$user_id} AND user_file_types.name = '{$type}'
                ORDER BY files.date_added DESC
                ".(((int)$limit > 0)?"LIMIT {$limit}":"")."
                ;";

        return $this->common($sql);
    }

    /**
     * @param $files_id
     */
    public function read_file_by_id($files_id){
        check_int($files_id);
        $sql = "SELECT * FROM files WHERE id = {$files_id}";
        return $this->common($sql);
    }


}