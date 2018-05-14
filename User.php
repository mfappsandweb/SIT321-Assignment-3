<?php
class User{


	private $user_id; 
	private $fname;
	private $lname;
	private $email;
	private $phone1;
	private $phone2;
	private $user_type;
	private $user_salt;
		
	function __construct() {
        
    }
	public function setUserId($id)
	{
		$this->user_id = $id;
	}
	public function getUserID()
	{
		return $this->user_id;		
	}
	public function setUserType($user_type)
	{
		$this->user_type = $user_type;
	}
	public function getUserType()
	{
		return $this->user_type;		
	}
	public function setUserFname($fname)
	{
		$this->fname = $fname;
	}
	public function getUserFname()
	{
		return $this->fname;		
	}
	public function setUserLname($lname)
	{
		$this->lname = $lname;
	}
	public function getUserLname()
	{
		return $this->lname;		
	}
	public function setUserEmail($email)
	{
		$this->email = $email;
	}
	public function getUserEmail()
	{
		return $this->email;		
	}				
	public function setUserPhone1($phone1)
	{
		$this->phone1 = $phone1;
	}
	public function getUserPhone1()
	{
		return $this->phone1;		
	}
	public function setUserPhone2($phone2)
	{
		$this->phone2 = $phone2;
	}
	public function getUserPhone2()
	{
		if($this->phone2 != null)
		{
			return $this->phone2;
		}else {
			return " ";
		}		
	}
	public function setUserSalt($user_salt)
	{
		$this->user_salt = $user_salt;
	}
	public function getUserSalt()
	{
		return $this->user_salt;		
	}	
	public function toString() {
        
		$return = 'userid.'.$this->getUserID();
		if($this->getUserFname() != null) $return = $return.',fname.'.$this->getUserFname();
		if($this->getUserLname() != null) $return = $return.',lname.'.$this->getUserLname();
		if($this->getUserEmail() != null) $return = $return.',email.'.$this->getUserEmail();
		if($this->getUserPhone1() != null) $return = $return.',phone1.'.$this->getUserPhone1();
		if($this->getUserPhone2() != null) $return = $return.',phone2.'.$this->getUserPhone2();
		return $return;
          
    }
}
?>