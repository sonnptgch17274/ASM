<?php require_once "../blocks/header.php"; ?>

    <form action="" method="POST">
    <table width="50%" border="0">
            
    <?php
    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);
    
    if(isset($_GET['id'])){
    $id = $_GET["id"];
    }
    $sql = "SELECT * FROM tblcategory WHERE ID_Cat=" .$id;
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

            if ($name=="" ) 
                {
                    echo "Please fill the blank!";
                }
            else
                {
                    $sql = "select * from tblcategory where IDCat= '$id'";
                    $sql = "UPDATE tblcategory SET Cat_Name='$name' WHERE ID_Cat=" . $id;

                    mysqli_query($connect,$sql);
                }
        }
?>
	</div>
<?php require_once "../blocks/footer.php"; ?>