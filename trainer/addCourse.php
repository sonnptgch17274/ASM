<?php require_once "../blocks/headerTrainer.php"; ?>
       <!-- about_area_start -->
       <div class="limiter">
		<div class="container-table100">

		<form action="" method="POST">
        <h2>ADD NEW COURSE</h2>
		<table width="50%" border="0">
			<tr>
				<td>Course Name</td>
				<td><input type="text" name="name"></td>
			</tr>

			<tr>
				<td>Description</td>
				<td><input type="text" name="des"></td>
            </tr>

			<tr>
                <td>ID Cat</td>
                <td>
    <?php
    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);
    
    $sql = "SELECT * FROM tblcategory";
    $rows = query($sql);

    ?>
    <div>
    

                <select type="num" name="id_cat">
                    <option value=""></option>
                    <?php
                    for($i=0; $i<count($rows); $i++)
                    { ?>
                    <option value="<?= $rows[$i][0] ?>"><?= $rows[$i][1] ?></option>
                    <?php
                } 
                ?>
                </select>


    </div>
					
				</td>
                </tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submit"></td>
			</tr>
		</table>
		</form>

<p>&nbsp;</p>
        </div>

<?php
require_once '../database.php';
$connect = mysqli_connect($hostname, $username, $password, $dbname)or die("Unable to connect to");
				
if(isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $des = $_POST["des"];
    $id_cat = $_POST["id_cat"];
    if ($name ==""||$des ==""||$id_cat == "") 
    {
        echo "Please fill the blank!";
    }

    else{
        $sql = "INSERT INTO tblcourse(ID_Course, Course_Name, Description, ID_Cat) VALUES (null, '$name','$des',$id_cat)";
        mysqli_query($connect,$sql) or die("Unable to connect");
    }
    if($sql)
    echo "Successfully Added <a href='viewCourse.php'>Click Here to Continue</a>";
    


}


?>
		</div>
	</div>
    <?php require_once "../blocks/footer.php"; ?>