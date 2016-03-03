<?php

/* Siak login controller class */

class Siak_locked extends Siak_controller{
	
	function __construct(){
		$this->css = array('siak_views/siak_lock/css/style_locked.css');
		parent::__construct();
	}

	function asd(){
		echo "string";
	}

	function index(){
		$this->siak_view->siak_render('siak_lock/index', false);
		// parent::siak_render('siak_login/index', true);
	}

	function siak_run_lock(){
		$rules = array(
			'password' => 'required',
			);
		if ($this->siak_validation->siak_validate($_POST, $rules) == TRUE) {
			$this->siak_model->siak_run_lock();
		}else{
			if($this->siak_validation->requ_errors['err_required'] != NULL){
				$this->siak_view->label2 = '<label class="control-label" for="inputWarning2">'.$this->siak_validation->requ_errors['err_required'].'</label>';
				$this->siak_view->warn2 = 'has-warning';
			}else{
				$this->siak_view->label2 = '<label class="control-label">Password</label>';
			}
			$this->siak_view->siak_render('siak_lock/index', false);
		}
	}


}

?>