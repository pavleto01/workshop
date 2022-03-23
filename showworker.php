<?php
	include('config/db_connect.php');
	include ('view/header.php');	


  	if(!isset($_SESSION['agent_username']))
{
  ?>
  		<script type="text/javascript">
    		window.location.href = "login.php";
			</script>
<?php
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/main.css">
	<title>Workshop</title>
	<style>
	table{
   margin-left: auto;
  margin-right: auto;
  width: 80%;
  border-collapse: collapse;
}

th{
 	background-color: #D6EEEE;
}

 th, td {
 	border-style:solid;
  border-color: #96D4D4;
}
</style>
</head>
<body>
	<table>
		<div class="alert alert-success">
			<h2 style="text-align:center; ">List of agents</h2>
		</div>
		<thead>
			<tr>
				<th style="text-align:center; color:blue; width: 10%">Agent ID</th>
				<th style="text-align:center; color:blue; width: 10%">Agent first name</th>
				<th style="text-align:center; color:blue; width: 10%">Agent last name</th>
				<th style="text-align:center; color:blue; width: 10%">Permission</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$sql = "SELECT * from agents";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$id_agent=$row['id_agent'];
		?>
			<tr>
				<td style="text-align:center; "><?php echo $row['id_agent'] ?></td>
				<td style="text-align:center; "><?php echo $row['agent_firstname'] ?></td>
				<td style="text-align:center; "><?php echo $row['agent_lastname'] ?></td>
				<td style="text-align:center; ">
				<?php  
				if($row['perm'] == 1){echo "FULL";}
				else { echo "PARTIAL";}
					?>
				</td>
			</tr>
		<?php  } ?>						 
		</tbody>
	</table>			

</body>
</html>