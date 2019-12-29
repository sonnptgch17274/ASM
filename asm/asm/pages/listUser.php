<?php require_once "../blocks/header.php"; ?>
       <!-- about_area_start -->
       <div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
				<h2 data-aos="fade-left">LIST USER</h2>
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
				<h3><a href="addUser.php">Click to Add User</a></h3>
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column2">Name</th>
								<th class="column2">Email</th>
								<th class="column2">Phone</th>
								<th class="column2">Address</th>
                                <th class="column2">Username</th>
                                <th class="column2">Password</th>
                                <th class="column2">Role</th>
                                <th class="column2">Edit</th>
                                <th class="column2">Delete</th>
							</tr>
						</thead>
                        <tbody id="myTable">
                        <?php 
    require_once '../database.php';
            $sql = "Select * from tbluser";
            $rows = query($sql);
            for($i=0; $i<count($rows); $i++)
            {
            ?>
                <div>
                    <tr>
                        <td><?= $rows[$i][1] ?></td>
                        <td><?= $rows[$i][2] ?></td>
                        <td><?= $rows[$i][3] ?></td>
                        <td><?= $rows[$i][4] ?></td>
                        <td><?= $rows[$i][5] ?></td>
                        <td><?= $rows[$i][6] ?></td>
                        <td><?= $rows[$i][7] ?></td>
                        <td><a href="http://localhost/ASM/asm/pages/updateUser.php?id=<?= $rows[$i][0] ?>">Edit</a></td>
                        <td><a href="http://localhost/ASM/asm/function.php?id=<?= $rows[$i][0] ?>" name="delete" onclick="myFunction()">Delete</a></td>
                        <div class="clear-both"></div>  
                    </tr>
                </div>
        <?php 
            }
    ?><!-- require php -->
      </tbody>
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