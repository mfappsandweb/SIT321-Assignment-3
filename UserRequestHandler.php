<?php
session_start();
include('Database.php');
include('User.php');

//check we have user id and type in session
 $action = $_POST["action"];
	switch($action) { //Switch case for value of action
		case "queryMyData": 		
			queryMyUserData(); 		
		break;
		case "queryOthersData": 		
			queryOthersUserData(); 		
		break;
		case "update": 		
			updateUserData(); 		
		break;
		case "delete": 		
			deleteUserData(); 		
		break;
    }
	function updateUserData() {
		//check we have user id and type in session
		//2 types of update 
		//user updates own details for email,phone1
		//admin updates other users all details
	}
	function createUser() {
		//check usertype admin
		//check we have user id and type in session
	}
	function uploadUserData() {
		//check usertype admin
		//check we have user id and type in session
	}
	function deleteUserData() {
		//check usertype admin
	}
	function queryMyUserData() {
		$user_id = $_SESSION['user_ID'];
		queryUserData($user_id );
	}
	function queryOthersUserData() {
		$user_Type =  $_SESSION['user_Type'];
		$user_id =  isset($_POST['user_ID']) ? $_POST['user_ID'] : null;
		if($user_Type === Constants.ADMIN) {
			queryUserData($user_id );
		}
	}
	
	function queryUserData($user_id){
	//check we have user id and type in session
	//query user from database using id and user type
	//create a user object
	//
		if (!empty($_SESSION['user_ID'])) 
		{  
			$user_id = $_SESSION['user_ID'];
			
			//query db
			$connect =  Database::getConnection();
				
			$stmt = oci_parse($connect,'SELECT user_id,fname,lname,email,phone1,phone2,user_type
											FROM sarms_user WHERE user_id = :user_id');
			oci_bind_by_name($stmt, ':user_id', $user_id);
			oci_execute($stmt);
			if (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
				$user = new User();
				$user->setUserId($row['USER_ID']);
				$user->setUserFname($row['FNAME']);
				$user->setUserLname($row['LNAME']);
				$user->setUserEmail($row['EMAIL']);
				$user->setUserPhone1($row['PHONE!']);
				$user->setUserPhone2($row['PHONE2']);			
			
			}
			oci_free_statement($stmt);		
			oci_close($connect); 
			
			echo $user->toString();
		} else {

			//not logged in kill destroy session
		}  
		
	}// end queryUserData
?>