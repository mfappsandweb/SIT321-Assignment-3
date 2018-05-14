<?php
require_once('class/Database.php');
session_start();

//bootstrap our first user, so we can login as admin and create new users. We should delete this once first admin is setup

//include my db stuff
//hash password and save to db as new cust

$user_id = '123456789';
$fname = 'Joe';
$lname = 'Bloggs';
$email = 'markdeed@gmail.com';
$password = 'password';
$phone1 = '0452036977';
$user_type = "admin";

try
{

	$user_salt = md5(microtime());
	$salty_password = md5(md5(Constants.SITE_SALT).$user_salt.$password);
	$errorCount = 0;
	//add to database if not already in there - user names, email usersalt and double hashed password
		
	$connect =  Database::getConnection();
	
	//check if user already exists 	
	$stmt = oci_parse($connect,'SELECT user_id FROM sarms_user WHERE user_id = :user_id');
		
		//bind the form values to sql statement placeholders - prevent sql injection
		oci_bind_by_name($stmt, ':user_id', $user_id);
		
		oci_execute($stmt);
		$rowcount = 0;
		while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {			
			$rowcount++;
		}
		
		//insert a new user if doesn't exist
		if($rowcount == 0) {		
		
			$stmt = oci_parse($connect,"INSERT INTO sarms_user (user_id,fname,lname,email,phone1,user_type,salty_password,user_salt)values (:user_id,:fname,:lname,:email,:phone1,:user_type,:salty_password,:user_salt)");
						
			//bind the form values to sql statement placeholders - prevent sql injection
			oci_bind_by_name($stmt, ":user_id", $user_id);	
			oci_bind_by_name($stmt, ":fname", $fname);
			oci_bind_by_name($stmt, ":lname", $lname);			
			oci_bind_by_name($stmt, ":email", $email);
			oci_bind_by_name($stmt, ":phone1", $phone1);
			oci_bind_by_name($stmt, ":user_type", $user_type);
			oci_bind_by_name($stmt, ":salty_password", $salty_password);
			oci_bind_by_name($stmt, ":user_salt", $user_salt);
			
			//execute the insert and tally any errors			
			$r = oci_execute($stmt, OCI_NO_AUTO_COMMIT);
			
			if (!$r) {
				
				$error = "<small><ul style='color: red'>";
				$error = $error."<li>There was an error registering. Login as admin or refresh database.</li>";
				
				$error =  $error."</ul></small>";				
				$_SESSION['errors'] = $error;
				
				// Close the connection and free compiled statement
				oci_rollback($connect);  // rollback changes to all tables
				oci_free_statement($stmt);		
				oci_close($connect); 
				header("Location: login.php");
							
			}else{
				
				$r = oci_commit($connect); // commit				
				
				session_start();
			
				$error = "<small><ul style='color: red'><li>done. You can now login.</li></ul></small>";						
				$_SESSION['errors'] = $error;				
				oci_free_statement($stmt);		
				oci_close($connect); 
				header("Location: login.php");
			}
		}else 
		{
			session_start();
			//already have admin in database. 
				$error = "<small><ul style='color: red'><li>This account is already registered.</li></ul></small>";						
				$_SESSION['errors'] = $error;
				oci_free_statement($stmt);		
				oci_close($connect); 
				header("Location: login.php");
				
			
		}
		
		$r = oci_commit($connect); // commit everything at once
		oci_free_statement($stmt);		
		oci_close($connect); 
		header("Location: login.php");
		exit();
}catch(Exception $e) {
	session_start();
			
	$error = "<small><ul style='color: red'><li>error</li></ul></small>";						
	$_SESSION['errors'] = $error;
	
  header("Location: login.php");
}
	
?>