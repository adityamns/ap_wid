<?php

/* Main Siak Paginator Class */

class Siak_paginator{
	
	private $current_page = false;
	private $total_items = false;
	private $items_per_page = false;
	private $url = false;
	private $param = false;
	private $output = false;
	

	public function __construct(){
	
	}

	public function initialize($settings = array()){

		if(isset($settings['current_page'])){
			$this->current_page = $settings['current_page'];
		}
		if(isset($settings['total_items'])){
			$this->total_items = $settings['total_items'];
		}
		if(isset($settings['items_per_page'])){
			$this->items_per_page = $settings['items_per_page'];
		}
		if(isset($settings['css_classes'])){
			$this->css_classes = $settings['css_classes'];
		}
		if(isset($settings['url'])){
			$this->url = $settings['url'];
		}
		if(isset($settings['param'])){
			$this->param = $settings['param'];
		}
		$this->getPages();

	}
	
	public function getOutput(){
		echo $this->output;
	}
	

	private function getPages(){
		$numPages = ceil($this->total_items / $this->items_per_page);
		$numPages = $numPages * 10; 
		var_dump($numPages); die();
		$this->output = '<ul class="'.$this->css_classes.'"><li>';
		
		if($this->current_page != 1){
			$this->output .= '<a href="'.$this->url.'/" title="Previous Page">';
		}
		
		$this->output .= '&lt;';
		
		if($this->current_page != 1){
			$this->output .= '</a>';
		}
		
		$this->output .= '</li>';
		
		for($i=10; $i <= $numPages; $i++){

			$this->output .= '<li';
			
			if($this->current_page == $i){
				$this->output .= ' class="selected"';
			}
			
			$this->output .= '><a href="'.$this->url.'/'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
		}
		
		$this->output .= '<li>';
		
		if($this->current_page != $numPages){
			$this->output .= '<a href="'.$this->url.'/'.($numPages).'" title="Next Page">';
		}
		
		$this->output .= '&gt;';
		
		if($this->current_page != $numPages){
			$this->output .= '</a>';
		}
		
		$this->output .= '</li></ul>';
	}
}

?>