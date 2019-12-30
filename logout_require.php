
<?php

 require("share_role.php");
 if (!isset($_SESSION['currUser'])) {
 	header("url=login.php");
 }
 else{
 if(!isset($_SESSION['currAdmin'])){
	header("url=index.php");
 } else{
	echo "<p style='color:Black;font-weight: bold; font-family: Poppins,cursive, sans-serif ; font-size:12pt; '>" ."Welcome! ". $_SESSION['currName'] . "</p>";
	echo "<a style='color:Black; font-family: Poppins, sans-serif ; font-size:12pt;text-decoration: underline;' href='../login.php'>Log out</a> </br>"; 
	if ($_SESSION['googleid'] == null)
	 {
		echo "<a style='color:Black; font-family: Poppins, sans-serif ; font-size:13pt;text-decoration: underline;' href='../updateGID.php'>Please update your google accout</a>";	 
	}
	 
	}
}
 	//echo "<a href='http://localhost/ASM/asm/login.php'>Log out</a>";

 ?>