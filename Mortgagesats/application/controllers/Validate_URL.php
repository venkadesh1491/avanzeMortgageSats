<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validate_URL extends CI_Controller {

	function __construct()
	{
	  parent::__construct();
	}

	public function index()
	{	
	  $url = $_SERVER['HTTP_HOST'];
	  
	  $domain = $this->IsValidDomain($url);
	  if($domain==1)
	  {
	    $this->session->set_userdata('IsValidDomain',1);	
	    redirect('Login');
	  } else {
	    $this->load->view('404');	
	  }
	}   

	function IsValidDomain($url)
	{
	  $this->db->where('BackgroundUrl',$url);
	  $valid = $this->db->get('mOrg')->num_rows();
	  if($valid>0)
	  {
	  	return 1;
	  } else {
	  	return 0;
	  }
	}

	function error()
	{
	   $this->load->view('404');
	}

	function Access_denied()
	{
	  $this->load->view('Access_denied'); 
	}

	function CheckURL()
	{
	  $url = $_SERVER['HTTP_HOST'];
	  
	  $domain = $this->IsValidDomain($url);
	  if($domain==1)
	  {
	    $this->session->set_userdata('IsValidDomain',1);	 
	  } else {
	  	$this->session->set_userdata('IsValidDomain',0);	
	  } 
	}
}
