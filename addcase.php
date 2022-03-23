<?php
	include('config/db_connect.php');
	include ('view/header.php');	
	$case_type = $bulstat = $car_id = $part_type = $km_in = $safo_type = $owner = $ow_address = $ow_phone1 = $ow_phone2 = $ow_phone3 = $payment_type = $sum = $note = $caseID  = $worker_name = '';
	$errors = array('id_case'=>'','bulstat'=>'','case_type'=>'','car_id'=>'', 'part_type'=>'', 'km_in'=>'', 'safo_type'=>'', 'caseID'=>'','worker_name'=>'', 'owner'=>'', 'ow_address'=>'', 'ow_phone1'=>'', 'ow_phone2'=>'', 'ow_phone3'=>'', 'payment_type'=>'', 'sum'=>'', 'note'=>'');
if(!isset($_SESSION['agent_username']))
{
  ?>
  		<script type="text/javascript">
    		window.location.href = "login.php";
			</script>
<?php
  exit;
}

	if(isset($_POST['submit'])){

		if(empty($_POST['case_type'])){
			$errors['case_type'] = "A case_type is required <br/>";
		} else {
			$case_type = $_POST['case_type'];
		}

		if(!empty($_POST['car_id'])){
			$car_id = $_POST['car_id'];
		}

		//check km_in
		if(empty($_POST['km_in'])){
			$errors['km_in'] = "A km_in is required <br/>";
		} else {
			$km_in = $_POST['km_in'];
		}

		//check safo_type
		if(empty($_POST['safo_type'])){
			$errors['safo_type'] = "safo_type is required <br/>";
		} else {
			$safo_type = $_POST['safo_type'];
		}

		//check owner
		if(empty($_POST['owner'])){
			$errors['owner'] = "owner is required <br/>";
		} else {
			$owner = $_POST['owner'];
		}

			//check payment_type
		if(empty($_POST['payment_type'])){
			$errors['payment_type'] = "A payment type is required <br/>";
		} else {
			$payment_type = $_POST['payment_type'];
		}

			//check sum
		
		if(empty($_POST['bulstat'])){
			$errors['bulstat'] = "Bulstat is required <br/>";
		} else {
			$bulstat = $_POST['bulstat'];
		}


		//session_start();

	if($_SERVER['QUERY_STRING'] == 'noname'){

		session_unset();

	}

		if(array_filter($errors)){
			//echo 'errors in the form';
		} else{
	
			$case_type  = mysqli_real_escape_string($conn, $_POST['case_type']);
			$car_id  = mysqli_real_escape_string($conn, $_POST['car_id']);
			$part_type  = mysqli_real_escape_string($conn, $_POST['part_type']);
			$km_in = mysqli_real_escape_string($conn, $_POST['km_in']);
			$safo_type = mysqli_real_escape_string($conn, $_POST['safo_type']);
			$owner = mysqli_real_escape_string($conn, $_POST['owner']);
			$payment_type = mysqli_real_escape_string($conn, $_POST['payment_type']);
			$bulstat = mysqli_real_escape_string($conn, $_POST['bulstat']);
			$sum = mysqli_real_escape_string($conn, $_POST['sum']);
			$note = mysqli_real_escape_string($conn, $_POST['note']);
			$ow_address = mysqli_real_escape_string($conn, $_POST['ow_address']);
			$ow_phone1 = mysqli_real_escape_string($conn, $_POST['ow_phone1']);
			$ow_phone2 = mysqli_real_escape_string($conn, $_POST['ow_phone2']);
			$ow_phone3 = mysqli_real_escape_string($conn, $_POST['ow_phone3']);
			$workerID = mysqli_real_escape_string($conn, $_POST['workerID']);
			//create sql


			$sql1 = "INSERT INTO cases(case_type,car_id,part_type, km_in, safo_type,ow_address,ow_phone1,ow_phone2,ow_phone3,owner,payment_type,bulstat, sum, note) VALUES('$case_type', '$car_id','$part_type', '$km_in', '$safo_type', '$ow_address', '$ow_phone1','$ow_phone2','$ow_phone3','$owner','$payment_type','$bulstat', '$sum', '$note');";
	
			
			$sql2 = "SET @caseid = last_insert_id();";

			$sql3 = "INSERT INTO caseworkers(caseID, workerID) VALUES (@caseid,'$workerID');";

			$sql4 = "INSERT INTO caseworkers(caseID, workerID) VALUES (@caseid,'$idagent');";

			$sql5 = "INSERT INTO caseworkers(caseID, workerID) VALUES (@caseid, 1);";

		if($idagent == 1){
			if(mysqli_query($conn, $sql1)){
				$id = mysqli_insert_id($conn);
				if(mysqli_query($conn, $sql2) & mysqli_query($conn, $sql3) & mysqli_query($conn, $sql4)){
					  ?>
  		<script type="text/javascript">
    		window.location.href = "casedetails.php?id=<?php echo $id  ?>";
			</script>
<?php }
			
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			}
			if($idagent != 1){

				if(mysqli_query($conn, $sql1)){
				$id = mysqli_insert_id($conn);
				if(mysqli_query($conn, $sql2) & mysqli_query($conn, $sql3) & mysqli_query($conn, $sql4) & mysqli_query($conn, $sql5)){
					  ?>
  		<script type="text/javascript">
    		window.location.href = "casedetails.php?id=<?php echo $id  ?>";
			</script>
<?php }
			
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			}


		
		}

		}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php
      
        if(isset($_POST['car'])) {
    ?>
    <table class="centertable2">
    <section class = "container" grey-text>
			<h4 class = "center">Add case</h4>
				<form class="white" action="<?php echo $_SERVER[ 'PHP_SELF'] ?>" method="POST">
					<tr>
					<th>
  					<div class="from-group">
  						<label hidden for = "">Case type:</label>
  					</th>
  					<th align="left">
   							<select hidden name="case_type" class="form-control">
      						<option value="car">Car</option>
      						</select>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="from-group">
  						<label for = "">Car:</label>
  						</th>
  					<th align="left">
   							<select name="car_id" class="form-control">
   							<option value=0>--Select car--</option>
      						<?php

      							$query = "SELECT * FROM cars";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_car'];?>> <?php echo $row['car_model']."/".$row['car_license'] ?> </option>
      				<?php } ?>
   							</select>
					</div>
				</th>
			</tr>
			
				
				
			<tr>
				<th>
  					<label>KM in:</label>
  					</th>
  					<th align="left">
  					<input type = "text" name = "km_in" value = "<?php echo htmlspecialchars($km_in) ?>">
  					<div class = "red-text"> <?php echo $errors['km_in']; ?> </div>
  				</th>
  			</tr>
				<tr>
					<th>
  					<div class="from-group">
  						<label for = "">Safo type:</label>
  						</th>
  					<th align="left">
   							<select name="safo_type" class="form-control">
      						<option value="">--Select safo type--</option>
      						<option value="FV">FV</option>
      						<option value="CP">CP</option>
      						<option value="transfer">Transfer</option>
   							</select>
					</div>
				</th>
			</tr>


			<tr>
				<th>
					<div class="from-group">
  						<label for = "">Payment type:</label>
  						</th>
  					<th align="left">
   							<select name="payment_type" class="form-control">
      						<option value="">--Select payment type--</option>
      						<option value="cash">Cash</option>
      						<option value="card">Card</option>
      						<option value="bank">Bank</option>
   							</select>
					</div>
					</th>
				</tr>

				<tr>
				<th>
  					<label>Bulstat:</label>
  					</th>
  					<th align="left">
  					<input type = "text" name = "bulstat" value = "<?php echo htmlspecialchars($bulstat) ?>">
  					<div class = "red-text"> <?php echo $errors['bulstat']; ?> </div>
  				</th>
  			</tr>


  			<tr>
  				<th colspan="2">
  					<div class="form-group">
					<label>Add worker *: </label>
					
					<br>
					<?php
    					$query = "SELECT * FROM agents WHERE id_agent != 1 AND id_agent != $idagent";
    					$result = mysqli_query($conn, $query);
    					while($row = mysqli_fetch_array($result)){
  				  	?>
  				<input type="radio" name="workerID" value="<?php echo $row['id_agent'];?>" > <?php echo $row['agent_firstname']." ".$row['agent_lastname'] ?><br />
				<?php } ?>
				</div>
  					</th>
  				</tr>

  				<tr>
  					<th colspan="2">
					<label>Note:</label>
  					<div>
  					<textarea rows="4" cols="50" name = "note" value = "<?php echo htmlspecialchars($note) ?>"></textarea>
					</div>
				</th>
			</tr>

		
  					<div>
  					<textarea hidden rows="4" cols="50" name = "part_type" value = "<?php echo htmlspecialchars($part_type) ?>">-</textarea>
					</div>
				
  					<div>
  					<textarea hidden rows="4" cols="50" name = "owner" value = "<?php echo htmlspecialchars($owner) ?>">-</textarea>
					</div>
			

  					<div>
  					<textarea hidden  rows="4" cols="50" name = "ow_address" value = "<?php echo htmlspecialchars($ow_address) ?>">-</textarea>
					</div>


  					<div>
  					<textarea hidden rows="4" cols="50" name = "ow_phone1" value = "<?php echo htmlspecialchars($ow_phone1) ?>">-</textarea>
					</div>
	

  					<div>
  					<textarea hidden rows="4" cols="50" name = "ow_phone2" value = "<?php echo htmlspecialchars($ow_phone2) ?>">-</textarea>
					</div>

					<div>
  					<textarea hidden rows="4" cols="50" name = "ow_phone3" value = "<?php echo htmlspecialchars($ow_phone3) ?>">-</textarea>
					</div>


					
			<tr>
				<th colspan="2">
  				<div class="center">
  						<input type="submit" name="submit" value = "Submit" class = "btn brand z-deth-0">
					</div>
				</th>
			</tr>
				</form>
		</section>
		</table>

		<?php } ?>
		

  				<?php
      
        		if(isset($_POST['other'])) {

    			?>
    			<section class = "container" grey-text>
			<h4 class = "center">Add case</h4>
			<table class="centertable2">
				
				<form class="white" action="<?php echo $_SERVER[ 'PHP_SELF'] ?>" method="POST">
						<tr>
							<th>
  					<div class="from-group">
  						<label for = "">Part type:</label>
  					</th>
  					<th align="left">
   							<select name="part_type" class="form-control">
      					<option value ="Alternator">Alternator</option>
      					<option value ="Starter">Starter</option>
      					<option value ="Compressor">Compressor</option>
      					<option value ="Accumulator">Accumulator</option>
      					<option value ="Other">Other</option>
      						</select>
					</div>
				</th>
			</tr>
						
						<div>
  					<textarea hidden rows="4" cols="50" name = "case_type" value = "<?php echo htmlspecialchars($case_type) ?>">Part</textarea>
					</div>
					
  					<div>
  					<textarea hidden rows="4" cols="50" name = "km_in" value = "<?php echo htmlspecialchars($km_in) ?>">-</textarea>
					</div>

			<tr>
					<th>
  					<div class="from-group">
  						<label for = "">Safo type:</label>
  						</th>
  					<th align="left">
   							<select name="safo_type" class="form-control">
      						<option value="">--Select safo type--</option>
      						<option value="FV">FV</option>
      						<option value="CP">CP</option>
      						<option value="transfer">Transfer</option>
   							</select>
					</div>
					</th>
			</tr>

			<tr>
					<th>
					<div class="from-group">
  						<label for = "">Payment type:</label>
  						</th>
  					<th align="left">
   							<select name="payment_type" class="form-control">
      						<option value="">--Select payment type--</option>
      						<option value="cash">Cash</option>
      						<option value="card">Card</option>
      						<option value="bank">Bank</option>
   							</select>
					</div>
					</th>
			</tr>
			<tr>
					<th>
  					<label>Firm/owner:</label>
  					</th>
  					<th align="left">
  					<input type = "text" name = "owner" value = "<?php echo htmlspecialchars($owner) ?>">
  					<div class = "red-text"> <?php echo $errors['owner']; ?> </div>
					</th>
			</tr>
			<tr>
				<th>
  					<label>Bulstat:</label>
  					</th>
  					<th align="left">
  					<input type = "text" name = "bulstat" value = "<?php echo htmlspecialchars($bulstat) ?>">
  					<div class = "red-text"> <?php echo $errors['bulstat']; ?> </div>
  				</th>
  			</tr>
  			<tr>
					<th>
  					<label>Firm/owner address:</label>
  					</th>
  					<th align="left">
  					<input type = "text" name = "ow_address" value = "<?php echo htmlspecialchars($ow_address) ?>">

					</th>
			</tr>
			<tr>
					<th>
  					<label>Telephone 1:</label>
  					</th>
  					<th align="left">
  					<input type = "text" name = "ow_phone1" value = "<?php echo htmlspecialchars($ow_phone1) ?>">
					</th>
			</tr>
			<tr>
					<th>
  					<label>Telephone 2:</label>
  					</th>
  					<th align="left">
  					<input type = "text" name = "ow_phone2" value = "<?php echo htmlspecialchars($ow_phone) ?>">

					</th>
			</tr>
			<tr>
					<th>
  					<label>Telephone 3:</label>
  					</th>
  					<th align="left">
  					<input type = "text" name = "ow_phone3" value = "<?php echo htmlspecialchars($ow_phone3) ?>">

					</th>
			</tr>

			<tr>
					<th colspan="2">
					<div class="form-group">
					<label>Add worker *:</label>
					<br>
					<?php
    					$query = "SELECT * FROM agents WHERE id_agent != 1";
    					$result = mysqli_query($conn, $query);
    					while($row = mysqli_fetch_array($result)){
  				  	?>
				
  				<input type="radio" name="workerID" value="<?php echo $row['id_agent'];?>" > <?php echo $row['agent_firstname']." ".$row['agent_lastname'] ?><br />
					
				<?php } ?>
				</div>
				 </th>
			</tr>
				
			<tr>
				<th colspan="2">
  					<label>Note:</label>
					<div>
  					<textarea rows="4" cols="50" name = "note" value = "<?php echo htmlspecialchars($note) ?>"></textarea>
  				</div>
  				</th>
  			</tr>

  					<textarea hidden rows="4" cols="50" name = "car_id" value = "<?php echo htmlspecialchars($car_id) ?>">1</textarea>


  					<tr>
  						<th colspan="2">
  				<div class="center">
  						<input type="submit" name="submit" value = "Submit" class = "btn brand z-deth-0">
					</div>

				</th>
			</tr>
					
				</form>
			
		</section>
		</table>
		<?php } ?>
		<h3 class="center">Choose car or part to add</h3>

		<form method="post" class="center">
       		 <input type="submit" name="car"
              		  value="Car"/>
          
       		 <input type="submit" name="other"
             		   value="Parts"/>
    	</form>
  					


</body>
</html>