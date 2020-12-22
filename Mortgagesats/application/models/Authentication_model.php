<?php
Class Authentication_model extends CI_Model {
	
	 
	function VerifyLoginDetails($Email,$Password)
	{	
		$data = [];
		$this->db->select('*');
	  $this->db->where('Email',$Email);	
	  $this->db->where('Password',$Password);	
	  $this->db->where('IsActive',1);
	  $data = $this->db->get('mUser')->row_array();
	  if ($data) {
	  
		  if(count($data)>0)
		  {
		  	$this->session->set_userdata($data);
		  	return $data;
		  } else {
		  	return '0';
		  }

	  }else{
	  	return '0';
	  }
	}
 	
 	function GetActiveOrganizations()
	{	
	  $this->db->where('IsActive',1);
	  $data = $this->db->get('mOrg')->result();
	  if(count($data)>0)
	  {
	  	return $data;
	  } else {
	  	return 0;
	  }
	}

	function CheckEmailRegistered($Email)
	{
	  $this->db->select('*, mUser.Name AS UserName');
	  $this->db->from('mUser');
	  $this->db->where('mUser.Email',$Email);	 
	  $this->db->where('mUser.IsActive',1);
	  $data = $this->db->get()->row();
	  if(count($data)>0)
	  {
	  	return $data;
	  } else {
	  	return '0';
	  }
	}

	function Change_password($Email,$Password)
	{
	  $this->db->where('Email',$Email);
	  $this->db->update('mUser', $Password); 
	  if($this->db->affected_rows()>0) 
	  {
	   return 1;
	  }
	  else
	  {
	   return 0;
	  }	
	}

}