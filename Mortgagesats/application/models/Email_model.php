<?php
Class Email_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->OrgUID = $this->session->userdata('UserOrgUID');	
		$this->LoggedUID = $this->session->userdata('UserUID');
	}

	function GetUserEmail()
	{
		$this->db->select('Email');
		$this->db->from('mUser'); 
		$this->db->where('OrgUID',$this->OrgUID); 
		$data=$this->db->get()->result();
		if(count($data)>0)
		{
			return $data;
		} else {
			return 0;
		}	
	}

	function CheckAvailableEmail($Email)
	{
	  $this->db->select('Email');
	  $this->db->from('mUser');
	  $this->db->where('OrgUID',$this->OrgUID);	 
	  $this->db->where('Email',$Email);	 
	  $this->db->where('IsActive',1);
	  $data = $this->db->get()->row();
	  if($data != '')
	  {
	  	return $data;
	  } else {
	  	return false;
	  }
	}

	function GetSentList(){
		$this->db->select('*,tSentEmail.CreatedDate AS EmailDate');
		$this->db->from('tSentEmail'); 
		$this->db->join('mUser','mUser.UserUID=tSentEmail.CreatedBy','left'); 
		$this->db->where('tSentEmail.OrgUID',$this->OrgUID); 
		$this->db->where('tSentEmail.CreatedBy',$this->LoggedUID); 
		$this->db->order_by('tSentEmail.CreatedDate','DESC'); 
		$data=$this->db->get()->result();
		if(count($data)>0)
		{
			return $data;
		} else {
			return 0;
		}	

	}

	function SaveEmailInfo($data)
	{
		$this->db->trans_begin();
		$this->db->insert('tSentEmail',$data);
		$data['SentEmailUID'] = $this->db->insert_id();
		$InsertRow = $this->db->affected_rows();
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 0;
		} else {			
			if(!empty($data['Cc']))
			{
			  $Audit['Cc'] = $data['Cc'];
			}
			if(!empty($data['Bcc']))
			{
			  $Audit['Bcc'] = $data['Bcc'];
			}
			$Audit['EmailTo'] = $data['EmailTo'];
			$Audit['Subject'] = $data['Subject'];
			logAuditTrail('ADD','tSentEmail','SentEmailUID='.$data['SentEmailUID'],'',$Audit);
			$this->db->trans_commit();
			return $data['SentEmailUID'];
		}
	}

}
