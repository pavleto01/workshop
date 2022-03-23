<?php
	include('config/db_connect.php');
	include ('view/header.php');	
	$car_license = $car_model = $VIN = $owner = $car_brand = $car_firm = $owner_address = $owner_email = $owner_phone1 = $owner_phone2 = $owner_phone3 = $car_note = $car_km ='';
	$errors = array('car_license'=>'', 'car_model'=>'', 'VIN'=>'', 'owner'=>'','car_brand'=>'', 'car_firm'=>'', 'owner_address'=>'', 'owner_email'=>'','owner_phone1'=>'', 'owner_phone2'=>'','owner_phone3'=>'','car_note'=>'','car_km'=>'');
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

		if(empty($_POST['car_license'])){
			$errors['car_license'] = "A car_license is required <br/>";
		} else {
			$car_license = $_POST['car_license'];
		}

		//check car_model
		if(empty($_POST['car_model'])){
			$errors['car_model'] = "A car_model is required <br/>";
		} else {
			$car_model = $_POST['car_model'];
		}

		//check VIN
		if(empty($_POST['VIN'])){
			$errors['VIN'] = "VIN is required <br/>";
		} else {
			$VIN = $_POST['VIN'];
		}

		if(empty($_POST['car_km'])){
			$errors['car_km'] = "KM is required <br/>";
		} else {
			$car_km = $_POST['car_km'];
		}

		//check owner
		if(empty($_POST['car_firm'])){
			$errors['car_firm'] = "owner is required <br/>";
		} else {
			$car_firm = $_POST['car_firm'];
		}

		if(empty($_POST['car_brand'])){
			$errors['car_brand'] = "Brand is required <br/>";
		} else {
			$car_brand = $_POST['car_brand'];
		}

		if(empty($_POST['owner_address'])){
			$errors['owner_address'] = "Address is required <br/>";
		} else {
			$owner_address = $_POST['owner_address'];
		}

		if(empty($_POST['owner_email'])){
			$errors['owner_email'] = "Email is required <br/>";
		} else {
			$owner_email = $_POST['owner_email'];
		}

		if(empty($_POST['owner_phone1'])){
			$errors['owner_phone1l'] = "Phone 1 is required <br/>";
		} else {
			$owner_phone1 = $_POST['owner_phone1'];
		}


		session_start();

	if($_SERVER['QUERY_STRING'] == 'noname'){

		session_unset();

	}

		if(array_filter($errors)){
			//echo 'errors in the form';
		} else{

			$car_license = mysqli_real_escape_string($conn, $_POST['car_license']);
			$car_model = mysqli_real_escape_string($conn, $_POST['car_model']);
			$VIN = mysqli_real_escape_string($conn, $_POST['VIN']);
			$car_brand = mysqli_real_escape_string($conn, $_POST['car_brand']);
			$car_firm = mysqli_real_escape_string($conn, $_POST['car_firm']);
			$owner_address = mysqli_real_escape_string($conn, $_POST['owner_address']);
			$owner_email = mysqli_real_escape_string($conn, $_POST['owner_email']);
			$owner_phone1 = mysqli_real_escape_string($conn, $_POST['owner_phone1']);
			$owner_phone2 = mysqli_real_escape_string($conn, $_POST['owner_phone2']);
			$owner_phone3 = mysqli_real_escape_string($conn, $_POST['owner_phone3']);
			$car_note = mysqli_real_escape_string($conn, $_POST['car_note']);
			$car_km = mysqli_real_escape_string($conn, $_POST['car_km']);
			
			//create sql
			$sql = "INSERT INTO cars(car_license, car_model, VIN, car_firm,car_brand,owner_address,owner_email,owner_phone1,owner_phone2,owner_phone3,car_note,car_km) VALUES('$car_license', '$car_model', '$VIN', '$car_firm','$car_brand','$owner_address','$owner_email','$owner_phone1','$owner_phone2','$owner_phone3','$car_note','$car_km')";

			//save to db and check
			if(mysqli_query($conn, $sql)){
				//success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
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

	<section class = "container" grey-text>
			<h4 class = "center">Add car</h4>
			<table class="centertable2">
				<form class="white" action="<?php echo $_SERVER[ 'PHP_SELF'] ?>" method="POST">
					<tr>
						<th>
  					<h4>Car license*:</h4>

  					<input type = "text" name = "car_license" value = "<?php echo htmlspecialchars($car_license) ?>">
  					<div class = "red-text"> <?php echo $errors['car_license']; ?> </div>
  				</th>
  			
						<th>
  					<h4>Car brand*:</h4>
  			
  					<input type = "text" name = "car_brand" value = "<?php echo htmlspecialchars($car_brand) ?>">
  					<div class = "red-text"> <?php echo $errors['car_brand']; ?> </div>
  					</th>
  			
						<th>
  					<h4>Car model*:</h4>
  					
  					<input type = "text" name = "car_model" value = "<?php echo htmlspecialchars($car_model) ?>">
  					<div class = "red-text"> <?php echo $errors['car_model']; ?> </div>
  					</th>

						<th>
  					<h4>VIN*:</h4>
  					  					<input type = "text" name = "VIN" value = "<?php echo htmlspecialchars($VIN) ?>">
  					<div class = "red-text"> <?php echo $errors['VIN']; ?> </div>
  				</th>
			</tr>

			<tr>
  				<th>
  					<h4>KM in*:</h4>
  					  					<input type = "text" name = "car_km" value = "<?php echo htmlspecialchars($car_km) ?>">
  					<div class = "red-text"> <?php echo $errors['car_km']; ?> </div>
  				</th>
						<th>
  					<h4>Firm/owner*:</h4>
  					<input type = "text" name = "car_firm" value = "<?php echo htmlspecialchars($car_firm) ?>">
  					<div class = "red-text"> <?php echo $errors['car_firm']; ?> </div>
  				</th>
  			
						<th>
  					<h4>Address*:</h4>
  					<input type = "text" name = "owner_address" value = "<?php echo htmlspecialchars($owner_address) ?>">
  					<div class = "red-text"> <?php echo $errors['owner_address']; ?> </div>
  				</th>
  			
						<th>
  					<h4>Email*:</h4>
  					<input type = "text" name = "owner_email" value = "<?php echo htmlspecialchars($owner_email) ?>">
  					<div class = "red-text"> <?php echo $errors['owner_email']; ?> </div>
  				</th>
  			</tr>
  			<tr>
						<th>
  					<h4>Telephone number 1*:</h4>
  					<input type = "text" name = "owner_phone1" value = "<?php echo htmlspecialchars($owner_phone1) ?>">
  					<div class = "red-text"> <?php echo $errors['owner_phone1']; ?> </div>
  				</th>
  			
  				
						<th>
  					<h4>Telephone number 2:</h4>
  					<input type = "text" name = "owner_phone2" value = "<?php echo htmlspecialchars($owner_phone2) ?>">
  					<div class = "red-text"> <?php echo $errors['owner_phone2']; ?> </div>
  				</th>
  			
						<th>
  					<h4>Telephone number 3:</h4>
  					<input type = "text" name = "owner_phone3" value = "<?php echo htmlspecialchars($owner_phone3) ?>">
  					<div class = "red-text"> <?php echo $errors['owner_phone3']; ?> </div>
  				</th>
  			<th>
  					<h4>Note:</h4>
  					<textarea rows="4" cols="20" name = "car_note" value = "<?php echo htmlspecialchars($car_note) ?>"></textarea>
  				</th>
  			</tr>
  			<tr>
  				<th colspan="4">
  					<div class="center">
  						<input type="submit" name="submit" value = "submit" class = "btn brand z-deth-0">
					</div>
				</th>
			</tr>
				</form>
				</table>
		</section>


</body>
</html>