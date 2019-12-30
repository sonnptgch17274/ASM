<?php require_once "../blocks/header.php"; ?>
<!-- about_area_start -->
<div class="limiter">
	<div class="container-table100">
		<form action="" method="POST">
			<h2>ADD NEW USER</h2>
		<table width="50%" border="0">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name"></td>
			</tr>

			<tr>
				<td>Email</td>
				<td><input type="text" name="email"></td>
			</tr>
	
			<tr>
				<td>Phone</td>
				<td><input type="text" name="phone"></td>
			</tr>

			<tr>
				<td>Address</td>
				<td><input type="text" name="address"></td>
			</tr>

			<tr>
				<td>Username</td>
				<td><input type="text" name="username"></td>
			</tr>

			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>

			<tr>
				<td>ID Role</td>
				<td>
					<select name="id_role">
						<option value=""></option>
						<option value="Admin">Admin</option>
						<option value="Trainer">Trainer</option>
						<option value="Trainee">Trainee</option>
					</select>
				</td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submit"></td>
			</tr>
		</table>
		</form>



<?php
require_once '../database.php';
$connect = mysqli_connect($hostname, $username, $password, $dbname);
				
if(isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
	$address = $_POST["address"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$id_role = $_POST["id_role"];
    if ($name ==""||$email ==""||$phone == ""||$address == ""||$username == ""|| $password == ""|| $id_role == "") 
    {
        echo "Please fill the blank!";
    }

    else{
        $sql = "INSERT INTO tbluser VALUES (null, '$name','$email','$phone', '$address', '$username', '$password', '$id_role')";
		mysqli_query($connect,$sql);
		if($sql == true){
			echo "Successfully Added <a href='listUser.php'>Click Here to Continue</a>"; 
		}
	}
}
?>
</div>

<?php require_once "../blocks/footer.php"; ?>
 