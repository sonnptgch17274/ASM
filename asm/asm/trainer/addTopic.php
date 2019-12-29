<?php require_once "../blocks/headerTrainer.php"; ?>
       <!-- about_area_start -->
       <div class="limiter">
		<div class="container-table100">
        <form action="" method="POST">
        <h2>ADD NEW COURSE</h2>
		<table width="50%" border="0">
			<tr>
				<td>Title</td>
				<td><input type="text" name="name"></td>
			</tr>

			<tr>
				<td>Description</td>
				<td><input type="text" name="des"></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td><input type="text" name="date"></td>
            </tr>

			<tr>
                <td>Category</td>
                <td>
    <?php
    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);
    
    $sql = "SELECT * FROM tblcourse";
    $rows = query($sql);

    ?>
    <div>
        <tr>
            <th> 
                <select type="num" name="cat">
                    <option value=""></option>
                    <?php
                    for($i=0; $i<count($rows); $i++)
                    { ?>
                    <option value="<?= $rows[$i][0] ?>"><?= $rows[$i][1] ?></option>
                    <?php
                } 
                ?>
                </select>
            </th>
            </td>
        </tr>
    </div>
					
				</td>

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
    $date = $_POST["date"];
    $cat = $_POST["cat"];
    if ($name ==""||$des ==""||$date==""||$cat == "") 
    {
        echo "Please fill the blank!";
    }

    else{
        $sql = "INSERT INTO tbltopic (Title, Description, Deadline, ID_Course) VALUES ('$name','$des', '$date',$cat)";
        mysqli_query($connect,$sql) or die("Unable to connect");

    }

    


}


?>
		</div>
	</div>
    <?php require_once "../blocks/footer.php"; ?>