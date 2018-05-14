<?php
require_once('class/User.php');
require_once('class/constants.php');
session_start();


if (empty($_SESSION['user_ID'])) 
{  	
	header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SARMS - Student At Risk Monitor">
    <meta name="author" content="MDeed,xxx,xxx,xxx">
    <meta name="keywords" content="Student At Risk">

    <title>
       SARMS - Homepage
    </title>  


    <!-- styles -->
   <link rel="stylesheet" type="text/css" href="css/sitestyle.css" />
	<!-- scripts -->	
	<script src="js/ajax.js" type="text/javascript"></script>  
</head>

<body onload="postUserRequest('queryMyData')">
	
<div  id="header" ><p>menu here</p></div>
<div id="content">
	<div id="topContent" >
		<div id="errors">
			<?php
				if (!empty($_SESSION['errors'])) 
				{  
					$displayerrors = $_SESSION['errors'];
					echo ''.$displayerrors;
					unset($_SESSION['errors']);
				} 
			?>
		</div>		
		<form id="userDetails" action="UserRequestHandler.php">

		<div class="formDiv">
		<label for="userid" class="leftLabel">ID</label>		
		<input id="userid" class="formInput" type="text" />		
		</div>
		
		<div class="formDiv">
		<label for="fname" class="leftLabel">First Name</label>		
		<input id="fname" class="formInput" type="text" />
		</div>
		
		
		<div class="formDiv">	
		<label for="lname" class="leftLabel">Surname</label>		
		<input id="lname" class="formInput" type="text" />
		</div>
		
		<div class="formDiv">
		<label for="email" class="leftLabel">Email</label>		
		<input id="email" class="formInput" type="text" />		
		</div>
		
		<div class="formDiv">
		<label for="phone1" class="leftLabel">Phone1</label>		
		<input id="phone1" class="formInput" type="text" />
		</div>
		
		
		<div class="formDiv">	
		<label for="phone2" class="leftLabel">Phone2</label>		
		<input id="phone2" class="formInput" type="text" />
		</div>
		
	</form>
	</div>
	
	<div id="centreContent" >
	<p>blah 2blah<br /></p>
	<p>blah2 blah<br /></p>
	<p>blah2 blah<br /></p>
	<p>blah blah<br /></p>
	<p>blah blah<br /></p>
	<p>blah 2blah<br /></p>
		<p>blah 2blah<br /></p>
	<p>blah2 blah<br /></p>
	<p>blah2 blah<br /></p>
	<p>blah blah<br /></p>
	<p>blah blah<br /></p>
	<p>blah 2blah<br /></p>
	</div>
	<div id="bottomContent" >
	<p>bbottom<br /></p>
	<p>blah3 blah<br /></p>
	<p>blah3 blah<br /></p>
	
	</div>
	

	
</div>
	
</body>
</html> 