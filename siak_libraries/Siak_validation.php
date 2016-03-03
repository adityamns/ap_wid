<?php

/* Main Siak Validation Class */

class Siak_validation{
	
	function __construct(){

	}

	public $user_errors = array();
	public $requ_errors = array();
	public $roles_errors = array();
	public $int_errors = array();
	public $string_errors = array();
	public $array_errors = array();

	public function siak_validate($data, $rules){
		$valid = TRUE;
		foreach ($rules as $fieldname => $rule) {
			$callbacks = explode('|', $rule);
			foreach ($callbacks as $callback) {
				$value = isset($data[$fieldname]) ? $data[$fieldname] : NULL;
				if ($this->$callback($value, $fieldname) == FALSE) $valid = FALSE;
			}
		}
		return $valid;
	}

	public function username($value, $fieldname){
		$valid = !empty($value);
		if ($valid == FALSE) $this->user_errors['err_username'] = " is required";
		return $valid;
	}

	public function required($value, $fieldname){
		$valid = !empty($value);
		if ($valid == FALSE) $this->requ_errors['err_required'] = " is required";
		return $valid;
	}

	public function roles($value, $fieldname){
		$values = array('owner','admin');
		$valid = in_array($value, $values);
		if($valid == FALSE) $roles_errors['err_roles'] = "The " . $fieldname . " is required";
		return $valid;
	}

	public function integer($value, $fieldname){
		$valid = is_int($value);
		if($valid == FALSE) $int_errors['err_int'] = "The " . $fieldname . " is not integer";
		return $valid;
	}

	public function string($value, $fieldname){
		$valid = is_string($value);
		if($valid == FALSE) $string_errors['err_string'] = "The " . $fieldname . " is not string";
		return $valid;
	}

	public function arrays($value, $fieldname){
		$valid = is_array($value);
		if ($valid == FALSE) $array_errors['err_array'] = "The " . $fieldname . " is not array";
	}


}

?>