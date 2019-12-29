<?php require_once "../blocks/headerTrainee.php"; ?>
       <!-- about_area_start -->
       <div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
				<h2 data-aos="fade-left">LIST COURSE</h2>
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column2">Course Name</th>
								<th class="column2">Description</th>
                                <th class="column2">View</th>
							</tr>
						</thead>
                               <!-- require php -->
                               <tbody id="myTable">
    <?php
    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);
    
    if(isset($_GET['id'])){
    $id = $_GET["id"];
    }
    $sql = "SELECT * FROM tblcourse WHERE ID_Cat=" .$id;
    $rows = query($sql);
    for($i=0; $i<count($rows); $i++)
    {
    ?>
    <div>
        <tr>
            <th> <?= $rows[$i][1] ?> </th>
            <th> <?= $rows[$i][2] ?> </th>
            <th><a href="http://localhost/ASM/asm/trainee/viewTopic.php?id=<?= $rows[$i][0] ?>">View</a></th>
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
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>