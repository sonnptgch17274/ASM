<?php 

require_once './database.php';
$connect = mysqli_connect($hostname, $username, $password, $dbname);
				
if(isset($_GET["id_cat"]))
{	
    $id = $_GET["id_cat"];
    $sql = "DELETE FROM tblcategory WHERE ID_Cat=" . $id;
    mysqli_query($connect,$sql);	
    if ($sql == true){
        header("location: pages/listCategory.php");
    }				    
}

if(isset($_GET["id"])){	
    $id = $_GET["id"];
    $sql = "DELETE FROM tbluser WHERE iduser=" . $id;
    mysqli_query($connect,$sql);	
        if ($sql == true){
            header("location: pages/listUser.php");
        }				
}

if(isset($_GET["idcourse"])){	
    $id = $_GET["idcourse"];
    $sql = "DELETE FROM tblcourse WHERE ID_Course=" . $id;    
    mysqli_query($connect,$sql);
    if($sql == true){
        header("location: trainer/viewCourse.php");
    }
			
}

if(isset($_GET["idtopic"])){	
    $id = $_GET["idtopic"];
    $sql = "DELETE FROM tbltopic WHERE ID_Topic=" . $id;    
    mysqli_query($connect,$sql);	
    if($sql == true){
        header("location: trainer/viewTopic.php");
    }
			
}

if(isset($_GET["iduser"])){	
    $id = $_GET["iduser"];
    $sql = "DELETE FROM tbluser WHERE iduser=" . $id;
    mysqli_query($connect,$sql);	
        if ($sql == true){
            header("location: trainer/listUser.php");
        }				
}
            
?>


