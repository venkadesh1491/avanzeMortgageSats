<?php
Class Common_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->LoggedUID = $this->session->userdata('UserUID');	
		$Detail = $this->GetIsLoggedUserDetails();
		if(is_object($Detail))
		{
		 $this->RoleUID = $Detail->RoleUID;
		}
	}




	function GetActiveServices()
	{
		$this->db->select('*');
		$this->db->from('mService'); 
		$this->db->where('mService.IsActive',1); 
		$data=$this->db->get()->result();
		if(count($data)>0)
		{
			return $data;
		} else {
			return 0;
		}	
	}

	function GetUserPerm($UserUID,$FunctionArray)
	{
		$this->db->select('*');
		$this->db->from('mPerm');
		$this->db->join('mRolePerm','mRolePerm.PermUID = mPerm.PermUID','LEFT');
		$this->db->join('mUserPerm','mUserPerm.PermUID = mRolePerm.PermUID','LEFT');
		$this->db->where('mUserPerm.UserUID',$UserUID);
		$this->db->where('mPerm.IsActive',1);
		$this->db->where_in('mPerm.Function',$FunctionArray);
		$this->db->group_by('mRolePerm.PermUID');
		$data = $this->db->get()->result();

		if(count($data)>0)
		{
			return $data;
		} else {
			return 0;
		}
	}

	function GetAllUserPerm($UserPerm,$UserFunction)
	{
		$hasPermission = [];
		if($UserPerm){
			foreach ($UserPerm as $key => $value) {
				$PermUID = $value->PermUID; 
				$Function = $value->Function; 
				if($UserFunction == $Function){
					$hasPermission[] = $UserFunction;
				} else{
					$hasPermission[] = '';				
				}
			}
		}
		return $hasPermission;
	}



	function GetIsLoggedUserDetails($User='', $Column='')
	{
		if($User=='')
		{
		  $UserUID = $this->session->userdata('UserUID');
		} else {
		  $UserUID = $User;	  
		}
		$this->db->select('*');
		$this->db->from('mUser');
		// $this->db->where('mUser.IsActive',1);
		$this->db->where('mUser.UserUID',$UserUID);
		$this->db->join('mUserPerm','mUser.UserUID = mUserPerm.UserUID','LEFT');
		$this->db->join('mRole','mRole.RoleUID = mUserPerm.RoleUID','LEFT');
		$this->db->group_by('mUserPerm.UserUID');
		$result = $this->db->get()->row(); 
		if($Column=='')
		{
		  return $result; 				
		} else {
		  return $result->$Column.'<br> <small class="text-mutd font-weight-bold">('.$result->RoleName.')</small>';	
		}	
	}




	
	function GetStatus()
	{
		$this->db->select('*');
		$this->db->from('mStatus');
		$this->db->where('IsActive',1);
		return $this->db->get()->result();
	}





	function GetActiveRoles()
	{
	  $this->db->where('IsActive',1);
	  $data = $this->db->get('mRole')->result();
	  if(count($data)>0)
	  {
	 	return $data;
	  } else {
	 	return 0;
	  }
	}

	function GetTableMaxID($TableName,$PrimaryCol)
	{
		$this->db->select_max($PrimaryCol);
		$query = $this->db->get($TableName);
		if($query->num_rows()>0)
		{
			$result = $query->row();
			return $result->$PrimaryCol+1;
		} else {
			return 1;
		}	
	}

	function GetTableStatus($TableName,$PrimaryCol)
	{
		$result = $this->db->query('SHOW TABLE STATUS WHERE `Name` = "'.$TableName.'"')->row();
		if($result->Auto_increment!=NULL)
		{
			return $result->Auto_increment;
		} else {
			$this->db->select_max($PrimaryCol);
			$query = $this->db->get($TableName);
			if($query->num_rows()>0)
			{
				$result = $query->row();
				return $result->$PrimaryCol+1;
			} else {
				return 1;
			}	
		}
	}

	function GetTableValue($TableName,$UniqueID,$Column,$RecordType='')
 	{
 	   list($UniqueCol,$UniqueUID) = explode('=',$UniqueID);	
 	   $Columns = implode(',', $Column);
 	   
 	   $where[$UniqueCol] = $UniqueUID; 
 	   $this->db->select($Columns);
 	   $this->db->where($where); 
       $Record = $this->db->get($TableName); 
       return $Record->row();
 	}
 	


	function GetUserRoleByUserID($UserUID)
	{
		$this->db->select('RoleUID');	
		$this->db->where('UserUID',$UserUID);
		$this->db->from('mUserPerm');		
		$this->db->group_by('mUserPerm.RoleUID');
		$data = $this->db->get()->row();
		if(count($data)>0)
		{
			return $data;
		} else {
			return 0;
		}
	}

	function GetUserPermission($UserUID)
	{
		$this->db->select('PermUID');
		$this->db->from('mUserPerm');
		$this->db->where('UserUID',$UserUID);
		$data = $this->db->get()->result();
		if(count($data)>0)
		{
			return $data;
		} else {
			return 0;
		}
	}

	function GetPermissionByRoleUID($RoleUID,$OrgUID)
	{
		$this->db->select('mPerm.PermUID, mPerm.PermName, mPerm.PermSection');
		$this->db->from('mPerm');	
		$this->db->join('mRolePerm','mRolePerm.PermUID = mPerm.PermUID','LEFT'); 
		$this->db->where('mRolePerm.RoleUID',$RoleUID);
		$this->db->where('mPerm.IsActive',1);
		$this->db->group_by('mRolePerm.PermUID'); 
		$data = $this->db->get()->result();
		if(count($data)>0)
		{
			return $data;
		} else {
			return array();
		}
	}

	function GetPermission($OrgUID='')
	{	
		$this->db->select('PermSection');
		if($this->OrgUID!=0)
		{
		  if($OrgUID!=0 || $OrgUID=='')
		  {
			$this->db->where('PermUID IN (SELECT mRolePerm.PermUID FROM mRole LEFT JOIN mRolePerm ON mRole.RoleUID = mRolePerm.RoleUID WHERE mRole.Global = 1 AND mRole.OrgUID=0)');
		  }	
		}
		$this->db->where('IsActive',1);
		$this->db->group_by('PermSection'); 
		$this->db->order_by('PermSection', 'asc');
		$data = $this->db->get('mPerm')->result();
		if(count($data)>0)
		{
			return $data;
		} else {
			return 0;
		}
	}

	function GetOrganizationSettings($OrgUID='')
	{
		if(empty($OrgUID))
		{
		  $OrgUID = $this->OrgUID;
		} else if($OrgUID == 'Default'){
		  $OrgUID = $this->getOrgUIDbyURL();
		}
		$this->db->where('OrgUID',$OrgUID);
		$data = $this->db->get('mSetting')->result();
		if(count($data)>0)
		{
			return $data;
		} else {
			return array();
		}  
	}

	function getOrgUIDbyURL()
	{
		$url = $_SERVER['HTTP_HOST'];
		$this->db->where('BackgroundUrl',$url);
		$orgdetail = $this->db->get('mOrg')->row();
		if(is_object($orgdetail))
		{
		   return $orgdetail->OrgUID;
		} else {
		  return 0;
		}
	}

	function editOrganizationSettings($OrgUID)
	{ 
		$data = $this->db->query('SELECT * FROM ( (SELECT * FROM mSetting WHERE OrgUID = '.$OrgUID.') UNION ALL (SELECT * FROM mSetting WHERE OrgUID = 0 AND `Name` NOT IN (SELECT `Name` FROM mSetting WHERE OrgUID = '.$OrgUID.')) ) AS Result GROUP BY Name');
		$data = $data->result();
		if(count($data)>0)
		{
		  return $data;
		} else {
			return array();
		}  
	}

	function GetDefaultSettings()
	{
		$this->db->where('OrgUID',0);
		$data = $this->db->get('mSetting')->result();
		if(count($data)>0)
		{
			return $data;
		} else {
			return 0;
		}
	}

	function Generate_password($length) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr(str_shuffle( $chars ), 0, $length);
		return $password;
	}

	function GetUsersByRole($RoleUID)
	{
	   $this->db->select('*');	
	   $this->db->where('RoleUID',$RoleUID);
	   $this->db->from('mUserPerm');		
	   $this->db->join('mUser','mUser.UserUID = mUserPerm.UserUID','LEFT');
	   $this->db->group_by('mUserPerm.UserUID');
	   $data = $this->db->get()->result();
	   if(count($data)>0)
	   {
		return $data;
	   } else {
		return 0;
	   }	
	}

	function GetChatUserByOrg($OrgUID)
	{
		$this->db->select('mUser.*,tChatMessage.Message, tChatMessage.ReceiverUID');
		$this->db->from('mUserPerm');
		$this->db->join('mUser','mUser.UserUID = mUserPerm.UserUID','LEFT');
		$this->db->join('tChatMessage','tChatMessage.ReceiverUID = mUser.UserUID','LEFT');
		$this->db->where_not_in('mUserPerm.UserUID',$this->LoggedUID);
		$this->db->where_not_in('mUserPerm.RoleUID',6);
		$this->db->where('mUserPerm.OrgUID',$OrgUID);
		$this->db->where('mUser.IsActive',1);
		$this->db->where('mUser.OrgUID',$OrgUID);
		$this->db->order_by('tChatMessage.ChatedOn, tChatMessage.IsRead','DESC');
		$this->db->group_by('mUserPerm.UserUID');
		return $this->db->get()->result();
	}

	function GetChatNotification($SenderUID)
	{
	   $this->db->select('count(*) AS Unread');
	   $this->db->from('tChatMessage'); 
	   $this->db->where('IsRead',0);
	   $this->db->where('SenderUID',$SenderUID);
	   $this->db->where('ReceiverUID',$this->LoggedUID); 
	   $this->db->where('OrgUID',$this->OrgUID);
	   $this->db->group_by('ReceiverUID');
	   $this->db->order_by('ChatedOn','DESC');
	   $data = $this->db->get()->row();
	   if(is_object($data)>0)
	   {
	   	 return $data->Unread;
	   } else {
	   	 return 0;
	   }
	} 

	function UpdateLastActivity()
	{
	  $this->db->set('LastActivity',date('Y-m-d H:i:s'));
	  $this->db->where('UserUID',$this->LoggedUID);	
	  $this->db->where('OrgUID',$this->OrgUID);	
	  $this->db->update('mUser');
	}

	function GetLastActivity($UserUID='')
	{
	  $this->db->select('LastActivity');
	  $this->db->from('mUser');
	  if($UserUID!='')
	  {
	  	$this->db->where('UserUID',$UserUID);
	  } else {
	   $this->db->where('UserUID',$this->LoggedUID);
	  }
	  $this->db->where('OrgUID',$this->OrgUID);
	  $this->db->order_by('LastActivity','DESC');
	  $this->db->limit(1);
	  $data = $this->db->get()->row();
	  if(is_object($data))
	  {
	  	return $data->LastActivity;
	  } else {
	  	return 0;
	  }
	}
 
	function GetUserDetailsByUID($UserUID)
	{
		$this->db->select('*');
		$this->db->from('mUser');
		$this->db->where('mUser.UserUID',$UserUID); 
		$this->db->where('mUser.IsActive',1);
		return $this->db->get()->row(); 	
	}

	function getUserColumnDetails($Column, $UserUID)
	{
		$this->db->select($Column);
		$this->db->from('mUser');
		$this->db->where('mUser.UserUID',$UserUID); 
		$this->db->where('mUser.IsActive',1);
		$data = $this->db->get()->row(); 	
		if(is_object($data))
		{
		  return $data->$Column; 	 
		} else {
		  return 'Empty';	
		}
	}

	function getParticularActivityColumn($Activity, $TaskUID, $Column)
	{
	 	$this->db->select($Column);
		$this->db->from('tActivity');
		$this->db->where('tActivity.TaskUID',$TaskUID); 
		$this->db->where('tActivity.ActivityUID',$Activity); 
		$data = $this->db->get()->row(); 	
		if(is_object($data))
		{
		  return $data->$Column; 	 
		} else {
		  return '';	
		}  	
	}

	function getStatusColumn($Column='', $StatusUID)
	{
	   $this->db->select('*');
	   $this->db->where('StatusUID', $StatusUID);
	   $data = $this->db->get('mStatus')->row();		
	   if(is_object($data))
	   {
	   	return $data->$Column; 	 
	   } else {
	   	return '';	
	   }
	}

	function getTaskTitle($TaskUID)
	{
		$this->db->where('TaskUID',$TaskUID);
		$this->db->where('OrgUID',$this->OrgUID);
		$this->db->where('IsActive',1);
		$data = $this->db->get('tTask')->row();
		if(is_object($data))
		{
		  return $data->Title;
		} else {
		  return '';
		}
	}

	function GetUsersEmail()
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

	function GetCompanyWeekOff($CompanyUID, $OrgUID='')
	{
	   $this->db->select('OffDay');	
	   $this->db->where('CompanyUID',$CompanyUID);
	   if(empty($OrgUID))
	   {
	   	 $OrgUID = $this->OrgUID;
	   }
	   $this->db->where('OrgUID',$OrgUID);
	   return $this->db->get('mWeekOff')->result_array();
	}

	function GetRegulatoryComplianceList()
	{
	   $this->db->select('*');	
	   return $this->db->get('mRegulatoryCompliance')->result_array();
	}	
}
