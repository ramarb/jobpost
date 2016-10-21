<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: ramon
 * Date: 10/18/16
 * Time: 11:52 AM
 */

class File_management {

    private $path = '';
    private $allowed_file_type = array('doc','pdf','png','gif','jpg','jpeg');
    private $file_name = '';
    private $file_uploaded = array();

    private $file_extension = '';
    private $error = 0;
    private $error_messages = array();
    private $allowed_file_size = 100000;
    private $result = array();
    private $success = 0;
    private $real_file_name = '';


    public function __construct($data = array()){



        if(isset($data['index']) === true && strlen(trim($data['index'])) > 0){
            $this->extract_raw($data['index']);
        }

        if(isset($data['move_to']) === true && strlen(trim($data['move_to'])) > 0){
            $this->set_path($data['move_to']);
        }

        if(isset($data['name']) === true && strlen(trim($data['name'])) > 0){
            $this->set_file_name($data['name']);
        }
    }

    public function set_path($directory){
        $this->path = UPLOAD_PATH . $directory;
    }

    public function extract_raw($index){
        $this->file_uploaded = $_FILES[$index];
        $this->file_name = $this->file_uploaded['name'];
        $this->extract_extension();
        return $this->file_uploaded;
    }

    public function get_file_uploaded(){
        return $this->file_uploaded;
    }

    private function extract_extension(){
        if(strlen($this->file_name) > 0){
            $array = explode('.',$this->file_name);
            $this->file_extension = $array[(count($array)-1)];
        }

        return $this->file_extension;
    }

    public function set_file_name($name){
        $this->file_name = $name . '.' . $this->file_extension;
    }

    public function get_file_name(){
        return $this->file_name;
    }

    public function get_file_extension(){
        return $this->file_extension;
    }

    private function is_allowed_file_size(){
        return ((double)$this->allowed_file_size < (double)$this->file_uploaded['size']);
    }

    private function is_allowed_file_type($name = ''){
        if($name !== ''){
            $this->extract_extension($name);
        }

        return in_array($this->file_extension,$this->allowed_file_type);
    }

    private function is_writable(){
        return is_writable(UPLOAD_PATH);
    }

    private function make_dir(){
        check_string($this->path, 'path');

        $array = explode("/",$this->path);
        $concat = '';
        foreach($array as $index => $value){
            if(strlen(trim($value)) > 0){
                $concat .= '/' . $value;
                if(file_exists($concat) === false){
                    mkdir($concat);
                }
            }

        }
    }

    public function move(){

        if($this->is_writable() === false){
            $this->set_error('Directory is not writable');
        }else{
            $this->make_dir();
        }

        if($this->is_allowed_file_size() === false){
            $this->set_error('Allowed file size is '.$this->allowed_file_size.' but you uploaded ' .  $this->file_uploaded['size']);
        }

        if($this->is_allowed_file_type() === false){
            $this->set_error('File type not allowed('.$this->file_extension.')');
        }

        if($this->error == 0){
            $unique_name = uniqid().'.'.$this->file_extension;

            $this->real_file_name = $this->path.$unique_name;

            move_uploaded_file($this->file_uploaded['tmp_name'],$this->real_file_name);

            $this->file_uploaded['location'] = str_replace(UPLOAD_PATH,'',$this->real_file_name);

            $this->success = 1;
        }

        $this->result = array(
            'error' => $this->error,
            'error_message' => $this->error_messages,
            'success' => $this->success,
            'data' => $this->file_uploaded
        );

    }

    private function set_error($message){
        $this->error++;
        $this->error_messages[] = $message;
    }

    public function get_result(){
        return $this->result;
    }

    public function download($location, $name = '', $type = 'application/x-file-to-save'){

        check_string($location,'location');
        $file_name = ((strlen(trim($name))) > 0)?$name:basename($location);
        $file = UPLOAD_PATH.$location;

        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Cache-Control: public");
        header("Content-Type: ".$type);
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:".filesize($file));
        header("Content-Disposition: attachment; filename=".$file_name);
        readfile($file);


        die();
    }



//Array
//(
//      [file] => Array
//      (
//          [name] => Crying.jpg
//          [type] => image/jpeg
//          [tmp_name] => /tmp/phpbeqRRg
//          [error] => 0
//          [size] => 123897
//      )
//
//)
}