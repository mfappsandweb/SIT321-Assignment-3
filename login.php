<?php
session_start();

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
       SARMS - Login
    </title>  


    <!-- styles -->
   
	<!-- scripts -->	
  
</head>

<body onload="">
<div id="errors">
	<?php
		if (!empty($_SESSION['errors'])) 
		{  
			$displayerrors = $_SESSION['errors'];
			echo ''.$displayerrors;
			unset($_SESSION['errors']);
		} 
	?></div>
	<div>
		<form action="loginHandler.php" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="login_email" id="login_email" placeholder="email">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="login_password" name="login_password"  placeholder="password">
			</div>

			<p class="text-center">
				<button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
			</p>
		</form>                       

	</div>
	
</body>
</html>