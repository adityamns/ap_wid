<?php

/* Main Siak Controller Class */
/* NB : For "$this->siak_model" or "$this->siak_view", see the main class of Siak Model or Siak View */

class Siak_controller{

	public $js   = array();
	public $css  = array();
	public $role = array();
	public $set  = array();
	// Build a construct method
	function __construct(){
		$this->siak_view = new Siak_view();
		$this->siak_validation = new Siak_validation();
		$this->siak_paginator = new Siak_paginator();
		$this->siak_session = new Siak_session();
		$this->siak_breadcrumbs = new Siak_breadcrumbs();
		$this->uri = new Siak_Uri();
		$this->siak_js();
		$this->siak_css();
		$this->siak_roles();
	}

	// Automaticly Load model for each class
	public function siak_load_model($name){
		$path = 'siak_models/'.$name.'_model.php';
		if (file_exists($path)) {
			require $path;
			$modelName = $name.'_Model';
			$this->siak_model = new $modelName();
		}
	}

	// Check log session
	public function siak_logstat(){
		Siak_session::siak_init();
		$logged = Siak_session::siak_get('loggedIn');
		$status = Siak_session::siak_get('status');
		if ($logged == false || $status == "2") {
			header('location:'.URL.'siak_login');
			exit();
		}
	}

	// Check log session
	public function siak_logstat1(){
		Siak_session::siak_init();
		$logged = Siak_session::siak_get('loggedIn');
		$status = Siak_session::siak_get('status');
		if ($logged == true || $status == "1") {
			header('location:'.URL.'siak_dashboard');
			exit();
		}
	}

	// xml http request Insert data
	public function siak_xhrInsert(){
		$this->siak_model->siak_xhrInsert();
	}

	// xml http request Get data
	function siak_xhrGetListings(){
		$this->siak_model->siak_xhrGetListings();
	}

	// xml http request Delete data
	function siak_xhrDeleteListings(){
		$this->siak_model->siak_xhrDeleteListings();
	}

	// Set user's roles
	public function siak_roles(){
		$this->siak_view->siak_userdata = $this->siak_session->siak_getAll();
		// $this->siak_view->siak_userdata = array(1,2,3);
	}

	// Rendering view template
	public function siak_render($path){
		$this->siak_view->siak_render($path);
	}

	// Rendering js
	public function siak_js(){
		$this->siak_view->siak_js = $this->js;
	}

	// Rendering css
	public function siak_css(){
		$this->siak_view->siak_css = $this->css;
	}

	public function siak_data_list(){
		$this->siak_model->siak_data_list();
	}

	public function index(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list();
		$this->siak_view->siak_render('siak_users/index', false);
	}

}

?>