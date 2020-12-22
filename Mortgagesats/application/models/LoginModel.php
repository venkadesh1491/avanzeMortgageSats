<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LoginModel extends CI_Model {

	
	function __construct()
	{ 
		parent::__construct();
	}

	function CheckLogin($Username,$Password)
	{
		$this->db->select('*');	
		$this->db->from('mUsers');
		$this->db->join('mRole', 'mRole.RoleUID=mUsers.RoleUID', 'left');
		$this->db->where(array('LoginID'=>$Username,'Password'=>$Password,'mUsers.Active'=>1)); 
		$query = $this->db->get();
		if($query->num_rows() >0)
		{
			$result = $query->result();
			// echo '<pre>'; print_r($result); exit;
			foreach($result as $data)
			{
			  $UserUID = $data->UserUID;
			  $UserName = $data->UserName;
			  $Password = $data->Password;
			  $Firstlogin =  $data->FirstLogin;
			  $RoleUID = $data->RoleUID;
			  $RoleType = $data->RoleTypeUID;
			  $PasscodeVerify = $data->PasscodeVerify;
			  $Email = $data->EmailID;
			}
			if($Firstlogin == 1)
			{
				$data = array('Temp_UserUID'=>$UserUID);
				$this->session->set_userdata($data);
				return array('Firstlogin'=>$Firstlogin,'Password'=>$Password,'RoleType' => $RoleType,'RoleUID'=>$RoleUID);
			}
			else if($PasscodeVerify)
			{

				$data = array('Temp_UserUID'=>$UserUID,'UserName'=>$UserName,'RoleUID'=>$RoleUID, 'RoleType' => $RoleType, 'PasscodeVerification'=>$PasscodeVerify,'Email'=>$Email);
				$this->session->set_userdata($data);
				return array('Firstlogin'=>$Firstlogin,'Password'=>$Password,'RoleType' => $RoleType,'RoleUID'=>$RoleUID);
			}
			else
			{
				$data = array('UserUID'=>$UserUID,'UserName'=>$UserName,'RoleUID'=>$RoleUID, 'RoleType' => $RoleType, 'PasscodeVerification'=>$PasscodeVerify,'Email'=>$Email);
				$this->session->set_userdata($data);
				return array('Firstlogin'=>$Firstlogin,'Password'=>$Password,'RoleType' => $RoleType,'RoleUID'=>$RoleUID);
			}
		}
		else
		{
			return false;
		}
	}

	function PasscodeStore($UserUID,$Passcode)
	{
	  $data['UserUID'] = $UserUID;
	  $data['Passcode'] = $Passcode;
	  $data['Validity'] = date('Y-m-d H:i:s');
	  if($this->db->insert('mUserPassCodeVerify',$data))
	  {
	  	return 1;
	  } else {
	  	return 0;
	  }
	}
function VerifyPasscode($UserUID)
	{
	  $this->db->where('UserUID',$UserUID);
	  $this->db->order_by('VerifyUID','DESC');
	  return $this->db->get('mUserPassCodeVerify')->row();
	}
	function DeletePasscode($UserUID)
	{
	   $this->db->where('UserUID',$UserUID);
	   $this->db->delete('mUserPassCodeVerify');
	}
	function CheckLoginExist($loginid)
    {

    	$this->db->select('LoginID,EmailID,UserName');	
		$this->db->from('mUsers');
		$this->db->where(array('LoginID'=>$loginid)); 
		$this->db->or_where(array('EmailID'=>$loginid)); 
		$query = $this->db->get();
    	if($query->num_rows() > 0)
        {
            $result = $query->result();
			return $result;
        }
        else{
            return false;
        }
    }

    function SaveDynamicAccessCode($Email,$DynamicAccessCode)
	{
		$fieldArray = array(
	          "DynamicAccessCode"=>$DynamicAccessCode,  
	    );
		$this->db->where(array("EmailID"=>$Email));    
        $result = $this->db->update('mUsers', $fieldArray);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function CheckAccessCode($accesscode)
    {
		$this->db->select('*');	
		$this->db->from('mUsers');
		$this->db->where(array('DynamicAccessCode'=>$accesscode)); 
		$query = $this->db->get();
    	if($query->num_rows() > 0)
        {
			return true;
        }
        else{
            return false;
        }
    }

	function UpdatePassword($accesscode,$cpassword)
	{
		$fieldArray = array(
	          "DynamicAccessCode"=>'',  
	          "Password"=>$cpassword,
	          'PasswordUpdatedDate'=>date('Y-m-d H:i:s')
	        );
		$this->db->where(array("DynamicAccessCode"=>$accesscode));    
        $result = $this->db->update('mUsers', $fieldArray);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

  function ChangePassword($UserUID,$cpassword,$firstlogin)
  {

  		if($firstlogin == 1)
  		{
  		    $fieldArray = array(
		          "Password"=>$cpassword,  
		          "FirstLogin"=>'0',
		          'PasswordUpdatedDate'=>date('Y-m-d H:i:s')
		    );

  		}else{

		    $fieldArray = array(
		          "Password"=>$cpassword,  
		          'PasswordUpdatedDate'=>date('Y-m-d H:i:s')
		    );
  		}
		$this->db->where(array("UserUID"=>$UserUID));    
        $result = $this->db->update('mUsers', $fieldArray);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
  }


	  function CheckOldPassword($oldpassword,$UserUID)
	  {
		$this->db->select('*');	
		$this->db->from('mUsers');
		$this->db->where(array('UserUID'=>$UserUID)); 
		$query = $this->db->get();
	    if($query->num_rows() > 0)
	    {
	      $result = $query->result();
	      foreach($result as $data)
	      {
	        $Pass = $data->Password;
	      }
	      $EncPassword = md5($oldpassword);
	      if($Pass == $EncPassword)
	      {
	        
	        return true;
	      }
	      else
	      {
	        
	        return false;
	      }
	    }
	  }


	  function PasswordStore($UserUID,$Password)
	{
	  $data['UserUID'] = $UserUID;
	  $data['Password'] = $Password;
	  $data['CreatedOn'] = date('Y-m-d H:i:s');
	  if($this->db->insert('mUserPasswordVerification',$data))
	  {
	  	return 1;
	  } else {
	  	return 0;
	  }
	}


		function getUserDetails($accesscode)
    {
		$query=$this->db->query("select * from mUsers where DynamicAccessCode=".$accesscode);
		return $query->row_array();
    }


    	function getUserDetailsByAccesscode($accesscode)
    {
  
		$query=$this->db->query("select mp.* from mUserPasswordVerification mp, mUsers mu where mu.UserUID=mp.UserUID and  mu.DynamicAccessCode=".$accesscode." ORDER BY mp.PassVerifyUID DESC LIMIT 5");
		return $query->result();
    }

    	function getUserDetailsByUserID($UserUID)
    {
  
		$query=$this->db->query("select mp.* from mUserPasswordVerification mp, mUsers mu where mu.UserUID=mp.UserUID and  mu.UserUID=".$UserUID." ORDER BY mp.PassVerifyUID DESC LIMIT 5");
		return $query->result();
    }

    function checkUserByCreatedDate($LoginID){
    	$query=$this->db->query("SELECT  EmailID FROM mUsers WHERE  PasswordUpdatedDate <= CURDATE() - INTERVAL 30 DAY  AND LoginID='".$LoginID."'");
    	return $query->row_array();
    }
}
?>