<?php require_once "../blocks/header.php"; ?>
       <!-- about_area_start -->
<div class="limiter">
    <div class="container-table100">
        <form action="" method="POST">
            <h2>ADD CATEGORY</h2>
        <table width="50%" border="0">
            <tr>
                <td>ID</td>
                <td><input type="num" name="id"></td>
            </tr>

			<tr>
				<td>Name</td>
				<td><input type="text" name="name"></td>
            </tr>
            
			<tr>
				<td></td>
				<td><input type="submit" name="submit3" onclick="myFunction()"></td>
			</tr>

		</table>
		</form>


<?php 
require_once '../database.php';
$connect = mysqli_connect($hostname, $username, $password, $dbname);
				
if(isset($_POST["submit3"]))
{
    $id = $_POST["id"];
    $name = $_POST["name"];
    if ($name =="") 
    {
        echo "Please fill the blank!";
    }
    else{
        $sql = "INSERT INTO tblcategory VALUES ('$id', '$name')";
        mysqli_query($connect,$sql);
    }
    if($sql)
    echo "Successfully Added <a href='listCategory.php'>Click Here to Continue</a>";
}
?>

</div>
<?php require_once "../blocks/footer.php"; ?>


