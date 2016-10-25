<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: ramon
 * Date: 10/17/16
 * Time: 2:31 PM
 */

function p($expression,$exit = false){
	echo '<pre>';
	print_r($expression);
	echo '</pre>';
	if($exit)die;
}

function javascript($javascripts){
	$ret = '';
	$size = count($javascripts) - 1;
	foreach($javascripts as $index => $value){
		$ret .= '<script type="text/javascript" src="'.base_url('assets/js/'.$value.'.js').'"> </script>'."\n".(($index < $size)?"\t":"");
	}
	return $ret;
}

function check_int_allow_null($param, $param_name = 'param_name'){
	if($param !== '' && (int)$param < 1){
		throw new InvalidArgumentException($param_name.' must be int greater than zero or null',500);
	}
}

function check_int($param, $param_name = 'param_name'){
	if($param !== '' && (int)$param < 1){
		throw new InvalidArgumentException($param_name.' must be int greater than zero',500);
	}
}

function check_string($param, $param_name = 'param_name'){
	if(strlen(trim($param)) < 1){
		throw new InvalidArgumentException($param_name.' must be a none empty string',500);
	}
}

function check_array($param, $param_name = 'param_name'){
	if(is_array($param) == false || count($param) < 1){
		throw new InvalidArgumentException($param_name.' must be a none empty array',500);
	}
}

function set_form_json_data($array){
    return '<script type="application/javascript">
    var form_data = ' . json_encode($array) . ';
</script>';
}