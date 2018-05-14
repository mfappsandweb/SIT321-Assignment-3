<?php
session_start();
include('Database.php');
include('User.php');
class LoginHandler{
//loginProcess
//extract  login_email and login_password from request
//query db for user
//if exists hash the password and compare to db record
//if OK set loaction to homepage
//not ok set location back to login.php with error msg.

	private $emailIn; 
	private $passwordIn;
	private $user;
	private $nextPage;
		
	function __construct() {
        $this->emailIn = isset($_POST['login_email']) ? $_POST['login_email'] : null;
        $this->passwordIn = isset($_POST['login_password']) ? $_POST['login_password'] : null;
		$this->nextPage = 'Location: login.php';
        //$this->site_salt = md5(Constants.SITE_SALT);//put this in constants class
    }

    function start() {
        if (empty($this->emailIn) || empty($this->passwordIn) ) {
			$error = "<small><ul style='color: red'>";
			$error = $error."<li>Incomplete login request - please complete all fields</li>";
			$error =  $error."</ul></small>";				
			$_SESSION['errors'] = $error;
			header("Location: login.php");
			$this->nextPage = 'Location: login.php';
            
        } else
        {
			$connect =  Database::getConnection();
			
			$stmt = oci_parse($connect,'SELECT user_id,email,user_type,salty_password,user_salt
										FROM sarms_user WHERE email = :emailIn');
			oci_bind_by_name($stmt, ':emailIn', $this->emailIn);
			oci_execute($stmt);
		
			if (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
			
				$email = $row['EMAIL'];
				$user_salt = $row['USER_SALT'];	
				$salty_password = $row['SALTY_PASSWORD'];	
					if($email== $this->emailIn && md5(md5(Constants.SITE_SALT).$user_salt.$this->passwordIn) == $salty_password )
					{
						//user authenticated - add to session			
						
						$_SESSION['user_ID'] = $row['USER_ID'];
						$_SESSION['user_Type'] = $row['USER_TYPE'];
						
						$this->nextPage = 'Location: homepage.php';
					
					} else {
						$error = "<small><ul style='color: red'>";
						$error = $error."<li>incorrect user name or password. Please try again";				
						$error =  $error."</li></ul></small>";				
						$_SESSION['errors'] = $error;
						$this->nextPage = 'Location: login.php';
					}
				oci_free_statement($stmt);		
				oci_close($connect); 
			} else {
				$error = "<small><ul style='color: red'>";
				$error = $error."<li>no user not lgged in</li>";
				$error =  $error."</ul></small>";				
				$_SESSION['errors'] = $error;
				$this->nextPage = 'Location: login.php';
			}	            
        }
		header($this->nextPage);
    }

	
}

$loginHandler = new LoginHandler();
if(!empty($_POST))
{
    $loginHandler->start();
}
?>