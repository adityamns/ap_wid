<?php
class Siak_breadcrumbs {
	private $breadcrumbs = array();
	private $separator = ' / ';
	private $start = ''; //'<div id="breadcrumb">';
	private $end = ''; //'</div>';

	public function __construct($params = array()){
		if (count($params) > 0){
			$this->initialize($params);
		}		
	}
	
	private function initialize($params = array()){
		if (count($params) > 0){
			foreach ($params as $key => $val){
				if (isset($this->{'_' . $key})){
					$this->{'_' . $key} = $val;
				}
			}
		}
	}

	//==== Breadcrumbs ====//
	function add($params = array()){	
		if (is_array($params)){
			if (isset($params['title']) && isset($params['href'])){
				$this->breadcrumbs[count($this->breadcrumbs)] = $params;
			}
		}
		// echo 'jan-cuk!!';
		// if (!$title OR !$href) return;
		// $this->breadcrumbs[] = array('title' => $title, 'href' => $href);
	}
	//==== End Breadcrumbs ====//
	
	function output(){

		if ($this->breadcrumbs) {
			
			$output = $this->start;

			foreach ($this->breadcrumbs as $key => $crumb) {
				if ($key){ 
					$output .= $this->separator;
				}

				if (end(array_keys($this->breadcrumbs)) == $key) {
// 					$output .= '<span>' . $crumb['title'] . '</span>';	
					$output .= '<li><strong>'.$crumb['title'].'</strong></li>'; //=> add new
				} else {
// 					$output .= '<a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a>';
					$output .= '<li><strong><a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a></strong></li>'; //=> add new
				}
			}
		
			return $output . $this->end . PHP_EOL;
		}
		
		return '';
	}

}
?>