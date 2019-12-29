<?php require_once "../blocks/headerTrainer.php"; ?>
       <!-- about_area_start -->
       <div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
				<h2 data-aos="fade-left">LIST COURSE</h2>
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
				<h3><a href="addCourse.php">Click to Add Course</a></h3>
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column2">Course Name</th>
								<th class="column2">Description</th>
                                <th class="column2">Category</th>
                                <th class="column2">Edit</th>
                                <th class="column2">Delete</th>
							</tr>
						</thead>
                        <tbody id="myTable">
                               <!-- require php -->
    <?php
    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);
    $sql = "SELECT * FROM tblcourse  LEFT OUTER JOIN tblcategory ON tblcourse.ID_Cat = tblcategory.ID_Cat";  
    $rows = query($sql);
    for($i=0; $i<count($rows); $i++)
    {
    ?>
    <div>
        <tr>
            <th> <?= $rows[$i][1] ?> </th>
            <th> <?= $rows[$i][2] ?> </th>
            <th> <?= $rows[$i][5] ?> </th>  
            <th><a href="http://localhost/ASM/asm/trainer/updateCourse.php?id=<?= $rows[$i][0] ?>">Edit</a></th>
            <th><a href="http://localhost/ASM/asm/function.php?idcourse=<?= $rows[$i][0] ?>" name="delete" onclick="myFunction()">Delete</a></th>
        </tr>
    </div>
<?php }
?>
    </tbody>
		</table>
		</form>

 
                        </table>
				</div>
			</div>
		</div>
	</div>
    <?php require_once "../blocks/footer.php"; ?>
    <script>
    function myFunction(){
        alert("Are you sure to delete?");
    }
    </script> 
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
