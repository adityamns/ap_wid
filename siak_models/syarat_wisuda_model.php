<?php
if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Syarat_wisuda_model extends Siak_model {
  function __construct(){
    parent::__construct();
    
    $this->table = "dok_syarat_wisuda";
  }
  
}