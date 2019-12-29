<?php
require_once 'database.php';
$connect = mysqli_connect($hostname, $username, $password, $dbname);
session_start();

function get_user($username, $password){

$con = mysqli_connect('localhost', 'root', '','edusys');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
	$sql = mysqli_query($con,"SELECT * FROM tbluser WHERE username= '$username' AND password= '$password'");

	if(mysqli_num_rows($sql) > 0){

		$row = mysqli_fetch_array($sql, MYSQLI_ASSOC );
		$_SESSION['currUser'] = $row['username'];
		if ($row['Role'] == 'Admin') {
			$_SESSION['currAdmin'] = $row['Role'];
			header("location:pages/adminstrator.php");
		}
		else if($row['Role'] == 'Trainer'){
			$_SESSION['currUser'] = $row['Role'];
			header("location:trainer/index.php");
		}
// 			header("location:index.php");
		else if($row['Role'] == 'Trainee'){
			$_SESSION['currUser'] = $row['Role'];
			header("location:trainee/index.php");
		}

	} else{
		echo "<script> alert('Invalid Username')</script>";
	}
}

?>
