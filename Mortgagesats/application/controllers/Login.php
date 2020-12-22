<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{ 
		
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Authentication_model');
		$this->load->library('parser'); 
		$this->load->library('user_agent');
		$this->load->model('Common_model');
		
	}

	function index()
	{ 
		if(!$this->session->has_userdata('IsLogged'))
		{  
		   
		   $data['domain'] = '';
		   $this->load->view('Login/login',$data);
		} else {   
		   
			  redirect(base_url('main')); 
			
		}	 		
	}

	function forgot()
	{
	   if(!$this->session->has_userdata('IsLogged'))
	   {  
		 $org = $this->Common_model->GetOrgDetailsByURL($_SERVER['HTTP_HOST']);
		 $data['domain'] = $org->Name;
		 $this->load->view('forgot_password',$data);
	   } else { 
		 if(hasPermission('viewDashboard')>0) 
		 { 
		  redirect(base_url('Dashboard')); 				
		 } 
		 else
		 {
		  redirect(base_url('Welcome')); 
		 }
	   }		
	}

	function Authentication()
	{
		$ulog['Browser'] = $this->agent->browser().' '.$this->agent->version();
		$ulog['IpAddress'] = $_SERVER['REMOTE_ADDR'];
		$out = array();
		exec("wmic cpu get DataWidth", $out);
		$bits = strstr(implode("", $out), "64") ? 64 : 32;
		if($this->agent->is_mobile())
		{
		  $ulog['Platform'] = $this->agent->mobile();
		} else {
  		  $ulog['Platform'] = $this->agent->platform().' - x'.$bits.' bits';
		}
		$domain = $_SERVER['HTTP_HOST'];
		$this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('Password', 'Password', 'required'); 
		if($this->form_validation->run() == TRUE) 
		{
			$Email = $this->input->post('Email');
			$Password = md5($this->input->post('Password'));

			$IsLogged = $this->Authentication_model->VerifyLoginDetails($Email,$Password);
			//echo "<pre>";print_r($IsLogged);
			if($IsLogged)
			{
				
			       
				$details = array('UserUID'=>$IsLogged['UserUID'],'IsLogged'=>1);

				$this->session->set_userdata($details);   
				$result = array("validation_error" => 0,'type'=>'success','redirect'=>base_url().'main','message'=>$this->lang->line('Login'));
			
			} else {
				$result = array("validation_error" => 1,'type'=>'danger','message'=>$this->lang->line('InvalidLogin'));	  
			}
		} else {
			$result = array("validation_error" => 1,'type'=>'danger','message'=>validation_errors());
		}
		echo json_encode($result);
	}

	function logout()
	{    
		$this->session->sess_destroy();
		redirect(base_url());	
	}

	function GetNewPassword()
	{
 	  $this->load->library('email');
 	  $config = $this->emailConfig();
	  $this->email->initialize($config);
	  $this->load->library('user_agent');
	  $this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
	  if($this->form_validation->run() == TRUE) 
	  {
	  	$Email = $this->input->post('Email');
	  	$Account = $this->Authentication_model->CheckEmailRegistered($Email); 
	  	if(is_object($Account))
	  	{ 
	  	  $edata['name'] = $Account->UserName;
	  	  $edata['operating_system'] = $this->agent->platform(); 
	  	  $edata['browser_name'] = $this->agent->browser().' '.$this->agent->version(); 
	  	  $edata['support_url'] =  'support@cinbox.com';
		  $edata['passreset_url'] = $Account->BackgroundUrl.'/Login/reset?access_token='.base64_encode($Email).'&expire='.base64_encode(date('Y-m-d H:i:s')); 
		  $edata['ProductName'] = 'Compliance Inbox';
		  $subject = 'Your account password reset link for Compliance Inbox';
		  $body = $this->parser->parse('email/forgot_password.html',$edata,TRUE); 
		  $result = $this->email
		    ->from($this->config->item('EMAIL_FROM'))
		    ->to($Email)
		    ->subject($subject)
		    ->message($body)
		    ->send();
		  $result = array("validation_error" => 0,'type'=>'success','message'=>'We have e-mailed your password reset link!. Check your email inbox.');  
	  	} else {
          $result = array("validation_error" => 1,'type'=>'danger','message'=>'The email '.$Email.' address is not registered!.');
	  	} 

	  } else {
	  	$result = array("validation_error" => 1,'type'=>'danger','message'=>validation_errors());
	  }
	  echo json_encode($result);
	}

	function reset()
	{
	  if(isset($_GET['access_token']) && isset($_GET['expire']))
	  {
	  	$Email = base64_decode($_GET['access_token']);

	  	// validate reset link expire
	  	$expire = base64_decode($_GET['expire']); 
	  	$now = date('Y-m-d H:i:s');
	  	$validtime = abs(round((strtotime($now) - strtotime($expire)) /60));
	  	if($validtime>30)
	  	{
	  	  redirect(base_url('error'));
	  	  exit;	
	  	}

	  	$Account = $this->Authentication_model->CheckEmailRegistered($Email); 
	  	if(is_object($Account))
	  	{	
	  	  $data['User'] = $Email;	
	      $this->load->view('change_password',$data);
	    } else {
	      redirect(base_url('error'));	
	    }
	  } else {
	  	redirect(base_url('error'));	
	  }
	}

	function emailConfig()
	{
		$config['useragent']        = 'PHPMailer';             
		$config['protocol']         = 'smtp';                  
		$config['mailpath']         = '/usr/sbin/sendmail';
		$config['smtp_host']        = $this->config->item('EMAILER_HOST');
		$config['smtp_user']        = $this->config->item('EMAIL_USERNAME');
		$config['smtp_pass']        = $this->config->item('EMAIL_PASSWORD');
		$config['smtp_port']        = $this->config->item('EMAIL_PORT');
		$config['smtp_timeout']     = 60;                      
		$config['smtp_crypto']      = '';                   
		$config['smtp_debug']       = 0;                       
		$config['debug_output']     = 'html';                  
		$config['smtp_auto_tls']    = true;                    
		$config['smtp_conn_options'] = array();                
		$config['wordwrap']         = true;
		$config['wrapchars']        = 76;
		$config['mailtype']         = 'html';                  
		$config['charset']          = "iso-8859-1";            
		$config['validate']         = true;
		$config['priority']         = 3;                       
		$config['crlf']             = "\r\n";                  
		$config['newline']          = "\r\n";                  
		$config['bcc_batch_mode']   = false;
		$config['bcc_batch_size']   = 200;
		$config['encoding']         = 'base64';
		$config['dkim_domain']      = '';              
		$config['dkim_private']     = '';            
		$config['dkim_private_string'] = '';
		$config['dkim_selector']    = ''; 
		$config['dkim_passphrase']  = '';              
		$config['dkim_identity']    = '';  
		return $config; 
	}

	function ResetPassword()
	{
	  $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]|alpha_numeric');
	  $this->form_validation->set_rules('CPassword', 'Confirm Password', 'required|matches[Password]|min_length[6]|alpha_numeric'); 
	  if($this->form_validation->run() == TRUE) 
	  {
	  	$Email = $this->input->post('Email');
	  	$Token = $this->input->post('access_token');
	  	if(base64_encode(md5($Email)) == $Token)
	  	{
	  	  $Password['Password'] = md5($this->input->post('Password'));	
	  	  $Reset = $this->Authentication_model->Change_password($Email,$Password);
	  	  if($Reset==1)
	  	  {
	  	  	$result = array("validation_error" => 0,'type'=>'success','message'=>'Your password has been reset successfully!');
	  	  } else {
	  	  	$result = array("validation_error" => 1,'type'=>'danger','message'=>'Your request could not be processed!.');	  		
	  	  }
	  	} else {
	  	  $result = array("validation_error" => 1,'type'=>'danger','message'=>'Access token invalid try again!.');	  	
	  	}
	  } else {
	  	$result = array("validation_error" => 1,'type'=>'danger','message'=>validation_errors());
	  }
	  echo json_encode($result);
	}
}
