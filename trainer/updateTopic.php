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
    $sql = "SELECT * FROM tbltopic WHERE ID_Topic=" .$id;
    $rows = query($sql);
    for($i=0; $i<count($rows); $i++)
    {
    ?>
        <div>
            <tr>
                <td>Title</td>
                <td><input type="text" value="<?= $rows[$i][1] ?>" name="name" ></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" value="<?= $rows[$i][2] ?>" name="des" ></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td><input type="text" value="<?= $rows[$i][3] ?>" name="date" ></td>
            </tr>

            <tr>
                <td>Course</td>
                <td>
        <?php
        require_once '../database.php';
        $connect = mysqli_connect($hostname, $username, $password, $dbname);
        
        $sql = "SELECT * FROM tblcourse";
        $rows = query($sql);

        ?>
                <select type="num" name="id_course">
                    <?php
                    for($i=0; $i<count($rows); $i++)
                    { ?>
                    <option value="<?= $rows[$i][0] ?>"><?= $rows[$i][1] ?></option>
                    <?php
                } 
                ?>
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
            $des = $_POST["des"];
            $date = $_POST["date"];
            $id_course = $_POST["id_course"];
            if ($name ==""||$des ==""||$date=="" || $id_course=="") 
                {
                    echo "Please fill the blank!";
                }
            else
                {
                    $sql = "select * from tbltopic";
                    $sql = "UPDATE tbltopic SET Title='$name', Description='$des', Deadline='$date', ID_Course=$id_course WHERE ID_Topic=" . $id;

                    mysqli_query($connect,$sql);
                    
                }
                if($sql)
                echo "Successfully Updated <a href='viewTopic.php'>Click Here to Continue</a>";


        }
?>
		</div>
	</div>
    <?php require_once "../blocks/footer.php"; ?>