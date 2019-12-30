<?php require_once "../blocks/headerTrainer.php"; ?>
       <!-- about_area_start -->
       <div class="limiter">
		<div class="container-table100">
    <?php
    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);
    
    $sql = "SELECT * FROM tbluser";
    $rows = query($sql);

    ?>
		<form action="MailFunc.php" method="get" id="usrform">
        <h2>MAILER</h2>
		<table width="50%" border="0">
      <tr>
				<td>From</td>
				<td><input type="text" name="from" value="<?=$_SESSION['Email']?>" disabled></td>
			</tr>
			<tr>
				<td>Title</td>
				<td><input type="text" name="subj"></td>
			</tr>

			<tr>
				<td>Body</td>
				<td><textarea rows="4" cols="40" name="body" form="usrform">
          Enter text here...</textarea> 
        </td>
            </tr>

			<tr>
                <td>Receiver</td>
                <td>

    <div>
          <select type="num" name="reciv">
              <option value=""></option>
              <?php
              for($i=0; $i<count($rows); $i++)
              { ?>
              <option value="<?= $rows[$i][2] ?>"><?= $rows[$i][2] ?></option>
              <?php
          } 
          ?>
          </select>
    </div>
								<tr>
				<td></td>
				<td><input type="submit" name="submit" style="width:50px;color: #fff;background-color: #8842d5;border-radius: 5px;"></td>
			</tr>
		</table>
		</form>

<p>&nbsp;</p>
        </div>
		</div>
	</div>
    <?php require_once "../blocks/footer.php"; ?>