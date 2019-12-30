<?php require_once "../blocks/headerTrainer.php"?>
       <!-- about_area_start -->
       <div class="limiter">
		<div class="container-table100">
        <form action="" method="POST">
		<table width="50%" border="0">
        <h2 data-aos="fade-left">UPDATE COURSE</h2>
    <?php
    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);
    
    if(isset($_GET['id'])){
    $id = $_GET["id"];
    }
    $sql = "SELECT * FROM tblcourse WHERE ID_Course=" .$id;
    $rows = query($sql);

    for($i=0; $i<count($rows); $i++)
    {
    ?>
        <div>
            <tr>
                <td>Course Name</td>
                <td><input type="text" value="<?= $rows[$i][1] ?>" name="name" ></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" value="<?= $rows[$i][2] ?>" name="des" ></td>
            </tr>
			<tr>
                <td>Category</td>
                <td>
        <?php
        require_once '../database.php';
        $connect = mysqli_connect($hostname, $username, $password, $dbname);
        
        $sql = "SELECT * FROM tblcategory";
        $rows = query($sql);

        ?>
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
    if(isset($_POST["submit"]))
        {
            $name = $_POST["name"];
            $des = $_POST["des"];
            $id_cat = $_POST["id_cat"];
            if ($name==""|| $des=="" || $id_cat =="") 
                {
                    echo "Please fill the blank!";
                }
            else
                {
                    $sql = "select * from tblcourse";
                    $sql = "UPDATE tblcourse SET Course_Name='$name', Description='$des', ID_Cat=$id_cat WHERE ID_Course=" . $id;

                    mysqli_query($connect,$sql);
                    if($sql)
                    echo "Successfully Added <a href='viewCourse.php'>Click Here to Continue</a>";
                }
                
        }
?>


 
                        </table>
				</div>
			</div>
		</div>
	</div>
    <?php require_once "../blocks/footer.php"; ?>
    <script> 
        function myFunc() { 
            alert("Ok");
            return false;
        } 
    </script> 