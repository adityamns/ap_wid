<?php

/* Siak login controller class */

class Siak_login extends Siak_controller{
	
	function __construct(){
		$this->css = array('siak_views/siak_login/css/default.css','siak_public/siak_css/siak_login.css');
		parent::__construct();
		parent::siak_logstat1();
	}

	function asd(){
		echo "string";
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Secure Login";
		$this->siak_view->siak_render('siak_login/index', false);
		// parent::siak_render('siak_login/index', true);
	}

	function siak_run(){
		$rules = array(
			'username' => 'username',
			'password' => 'required',
			);
		if ($this->siak_validation->siak_validate($_POST, $rules) == TRUE) {
			$this->siak_model->siak_run();
		}else{
			if($this->siak_validation->user_errors['err_username'] != NULL) {
				$this->siak_view->label = '<label class="control-label" for="inputWarning2">'.$this->siak_validation->user_errors['err_username'].'</label>';
				$this->siak_view->warn = 'has-warning';
			}else{
				$this->siak_view->label = '<label class="control-label">Username</label>';
			}
			
			if($this->siak_validation->requ_errors['err_required'] != NULL){
				$this->siak_view->label2 = '<label class="control-label" for="inputWarning2">'.$this->siak_validation->requ_errors['err_required'].'</label>';
				$this->siak_view->warn2 = 'has-warning';
			}else{
				$this->siak_view->label2 = '<label class="control-label">Password</label>';
			}
			$this->siak_view->siak_render('siak_login/index', false);
		}
	}


}

?>