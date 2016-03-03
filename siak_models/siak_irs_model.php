<?php
if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Siak_irs_model extends Siak_model{
  function __construct(){
    parent::__construct();
    $this->table = "alumni";
  }
}