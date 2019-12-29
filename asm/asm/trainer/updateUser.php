<?php require_once "../blocks/headerTrainer.php"; ?>
       <!-- about_area_start -->
       <div class="limiter">
		<div class="container-table100">
        <form action="" method="POST">
		<table width="50%" border="0">
            
    <?php
    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);
    
    if(isset($_GET['id'])){
    $id = $_GET["id"];
    }
    $sql = "SELECT * FROM tbluser WHERE iduser=" .$id;
    $rows = query($sql);
    for($i=0; $i<count($rows); $i++)
    {
    ?>
        <div>
        <tr>
                    <td>Name</td>
                    <td><input type="text" value="<?= $rows[$i][1] ?>" name="name" ></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type="text" value="<?= $rows[$i][2] ?>" name="email" ></td>
                </tr>
                
                <tr>
                    <td>Phone</td>
                    <td><input type="text" value="<?= $rows[$i][3] ?>" name="phone"></td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td><input type="text" value="<?= $rows[$i][4] ?>" name="address"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" value="<?= $rows[$i][5] ?>" name="username"></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="text" value="<?= $rows[$i][6] ?>" name="password"></td>
                </tr>

                <tr>
                    <td>Role</td>
                    <td>
                        <select value="<?= $rows[$i][7] ?>" name="id_role" >
                            <option value="Trainee">Trainee</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit"></td>
                </tr>
            
        </div>
<?php }
?>
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

            if ($name=="" ||$email=="" ||$phone=="" ||$address=="" ||$username=="" ||$password=="" ||$id_role=="") 
                {
                    echo "Please fill the blank!";
                }
            else
                {
                    $sql = "select * from tbluser where iduser= '$id'";
                    $sql = "UPDATE tbluser SET Name='$name',Email='$email',Phone='$phone',Address='$address',username='$username', password='$password', Role='$id_role' WHERE iduser=" . $id;

                    mysqli_query($connect,$sql);
                }
                if($sql)
                echo "Successfully Updated <a href='listUser.php'>Click Here to Continue</a>";

        }
?>  
	</div>
<?php require_once "../blocks/footer.php"; ?>