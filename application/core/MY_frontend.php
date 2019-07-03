<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_frontend extends MX_Controller {
	// protected $data;
	
	function __construct(){
		parent::__construct();
		
		$this->load->module('frontend/template');
	}

}
?>