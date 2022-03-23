<?php
include ('config/db_connect.php');
include ('view/header.php');	

$agent_username = $agent_password  = $agent_email = $agent_firstname = $agent_lastname = '';
	$errors = array('agent_agent_username'=>'', 'agent_password'=>'','agent_email'=>'', 'agent_firstname'=>'','agent_lastname'=>'');

	if(isset($_POST['submit'])){


		//check username
		if(empty($_POST['agent_username'])){
			$errors['agent_username'] = "A username is required <br/>";
		} else {
			$agent_username = $_POST['agent_username'];
		}

		//check password
		if(empty($_POST['agent_password'])){
			$errors['agent_password'] = "A password is required <br/>";
		} else {
			$agent_assword = $_POST['agent_password'];
		}

		if(empty($_POST['agent_email'])){
			$errors['agent_email'] = "An email is required <br/>";
		} else {
			$agent_email = $_POST['agent_email'];
			if(!filter_var($agent_email, FILTER_VALIDATE_EMAIL)){
				$errors['agent_email'] = "EMAIL MUST BE VALID EMAIL ADDRESS";
			}
		}

		if(empty($_POST['agent_firstname'])){
			$errors['agent_firstname'] = "A firstname is required <br/>";
		} else {
			$agent_firstname = $_POST['agent_firstname'];
		}

		if(empty($_POST['agent_lastname'])){
			$errors['agent_lastname'] = "A lastname is required <br/>";
		} else {
			$lagent_astname = $_POST['agent_lastname'];
		}

		if(array_filter($errors)){
			//echo 'errors in the form';
		} else{

			$agent_username = mysqli_real_escape_string($conn, $_POST['agent_username']);
			$agent_password = mysqli_real_escape_string($conn, $_POST['agent_password']);
			$agent_email = mysqli_real_escape_string($conn, $_POST['agent_email']);
			$agent_firstname = mysqli_real_escape_string($conn, $_POST['agent_firstname']);
			$agent_lastname = mysqli_real_escape_string($conn, $_POST['agent_lastname']);
			
			//create sql
			$sql = "INSERT INTO agents(agent_username, agent_password, agent_email, agent_firstname, agent_lastname) VALUES('$agent_username', '$agent_password','$agent_email','$agent_firstname','$agent_lastname')";

			//save to db and check
			if(mysqli_query($conn, $sql)){
				//success
				header('Location: login.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}


		}

		} //end post check

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register page</title>
</head>
<body>
	<section class = "container" grey-text>
		<h4 class = "center">Register here</h4>
		<table class="centertable2">
			<div class="container">
    				<div class="col-md-6">
        				<form class="white" action="<?php echo $_SERVER[ 'PHP_SELF'] ?>" method="POST">
        	<tr>
        		<th>
  					<label>Username:</label>
  				</th>
  				<th align="left">
  					<input type = "text" name = "agent_username" value = "<?php echo htmlspecialchars($agent_username) ?>">
  					
  				</th>
  			</tr>
  			<tr>
        		<th>
  					<label>Password:</label>

  					</th>
  					<th align="left">
  					<input type = "password" name = "agent_password" value = "<?php echo htmlspecialchars($agent_password) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_password']; ?> </div>
  					</th>
  			</tr>
  			<tr>
        		<th>
  					<label>Email:</label>
  				</th>
  					 <th align="left">
  					<input type = "text" name = "agent_email" value = "<?php echo htmlspecialchars($agent_email) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_email']; ?> </div>
 					</th>
  			</tr>
  			<tr>
        		<th>
  					<label>First name:</label>
  					</th>
  					 <th align="left">
  					<input type = "text" name = "agent_firstname" value = "<?php echo htmlspecialchars($agent_firstname) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_firstname']; ?> </div>
  					</th>
  			</tr>
  			<tr>
        		<th>
  					<label>Last name:</label>
  					</th>
  					 <th align="left">
  					<input type = "text" name = "agent_lastname" value = "<?php echo htmlspecialchars($agent_lastname) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_lastname']; ?> </div>
  					</th>
  			</tr>
  			<tr>
        		<th>
        			<tr>
        				<th colspan="2">
  					<div class="center">
  						<input type="submit" name="submit" value = "Register" class = "btn brand z-deth-0">
					</div>
				</th>
			</tr>
				</form>
    				</div>
    			</div>
    		</table>
	</section>
</body>

</html>