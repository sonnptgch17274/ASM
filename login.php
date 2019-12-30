
<!DOCTYPE html>
<html>
<head>
	<title>Log in </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" a href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="login-box">
	    <h1>Log In</h1>
		<?php
require ("share_role.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$username = $_POST['username'];
	$password = $_POST['password'];

	get_user($username, $password);
}

?>
	    <form action="#" method="POST">
	    <div class="textbox">
	    	<i class="fa fa-user"></i>
	    	<input type="text" placeholder="username" name="username" value="">
	    </div>

	    <div class="textbox">
	    	<i class="fa fa-lock"></i>
	    	<input type="password" placeholder="password" name="password" value="">
	    </div>
        <input class="btn" type="submit" name="" value="Log In">
		
		<input class="btn" type="button" name="" value="Login with Google" onclick="location.href='google.php';">
	    <link rel="forgot password " type="text/css" href="" name ="forgot password ?">	<i class="fa fa-question-circle"></i> forgot password ?	
	    </form>
    </div>
</body>
</html>