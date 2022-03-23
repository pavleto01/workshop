<?php
  
  error_reporting(E_ALL ^ E_WARNING);
	session_start();
  date_default_timezone_set("Europe/Sofia");
	if($_SERVER['QUERY_STRING'] == 'noname'){

		session_unset();

	}

	
	$username = $_SESSION['agent_username'];
	$email = $_SESSION['agent_email'];
	$idagent = $_SESSION['id_agent'];
	$fname = $_SESSION['agent_firstname'];
	$lname = $_SESSION['agent_lastname'];
 	$sperm = $_SESSION['perm'];

?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 5px 5px;
}

.header a {
  font-size: 18px; 
  line-height: 30px;
  border-radius: 4px;
}




.header-right {
  float: right;
}

.header-left {
  float: left;
}
.center {
border: 0px white;
text-align: center;
}
.centertable {
  margin-left: auto;
  margin-right: auto;
  width: 90%;
  border:2px dodgerblue solid;
  border-collapse: collapse;
}

.centertable2 {
  margin-left: auto;
  margin-right: auto;

 
}

.centerfooter {
  margin-left: auto;
  margin-right: auto;
  width: 8em;
}
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
</head>
<body>

<div class="header">
  <div class="header-right">
    <a href="index.php">Cases</a>
    <a href="addcase.php">[+]</a>
	<a href="showcars.php" >Cars</a>
  <a href="addcar.php" >[+]</a>
    <?php if($sperm == 1) {?>
    <a href="showworker.php" class="btn brand" z-depth-0>Workers</a>
    <a href="register.php">[+]</a>
    <?php } 

    if(!isset($_SESSION['agent_username']))
  {
     ?>
    <a href="login.php">Log in</a>
  <?php } else { ?>
    <a href="logout.php">Log out</a>
  <?php } ?>

  </div>
</div>


</body>
</html>